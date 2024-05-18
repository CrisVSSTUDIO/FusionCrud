<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use App\Models\Category;
use Phpml\Metric\Accuracy;
use Illuminate\Http\Request;
use Phpml\Clustering\DBSCAN;
use Phpml\Association\Apriori;
use Phpml\Dataset\ArrayDataset;
use Illuminate\Support\Facades\DB;
use Phpml\Regression\LeastSquares;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Phpml\Classification\NaiveBayes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Phpml\CrossValidation\StratifiedRandomSplit;

class AnalyticsController extends Controller
{
    //
    public function index()
    {
        $averageProductsPerDay = round($this->averageAssets());
        $predictions = $this->naiveBayes();
        //list($isVirtual, $isNotVirtual) = $this->virtualCategories();
        list($product_name, $product_count) = $this->assetPerCategory();
        list($perYear, $yearCount) = $this->assetsPerDate();
        list($apriori) = $this->patterns();
        return view('analytics.index', ['created_at' => json_encode($product_name), 'rowcount' => json_encode($product_count), 'averageProductsPerDay' => $averageProductsPerDay, 'perYear' => json_encode($perYear), 'yearCount' => json_encode($yearCount), 'apriori' => json_encode($apriori),'predictions' => json_encode($predictions)]);
    }
    public function assetPerCategory()
    {
        //this function here, does a "traditional" sql query to get the date and counting the number of elements found, grouping them by date and fetching the data in an efficient way.
        //it will  be used for statistics
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.category_name', DB::raw('count(*) as total'))

            ->groupBy('categories.category_name')
            ->take(5000)->get();
        if (count($products)) {
            foreach ($products as $product) {
                $product_name[] = $product->category_name;
                $product_count[] = $product->total;
            }
            return array($product_name, $product_count);
        }
    }

    public function assetsPerDate()
    {
        try {
            $prevNextFiveYears = Date('Y') + 5;
            $multi_array = array();
            $productsCount = Product::selectRaw('strftime("%Y",created_at) as date, COUNT(*) as count')
                ->groupBy('date')
                ->take(5000)->get();
            if (count($productsCount)) {
                foreach ($productsCount as $productPerYear) {
                    $perYear[] = $productPerYear->date;
                    $yearCount[] = $productPerYear->count;
                }
                foreach ($perYear as $year) {
                    $multi_array[] = array($year);
                }
                $regression = new LeastSquares();
                $regression->train($multi_array, $yearCount);
                $predict_value = $regression->predict([$prevNextFiveYears]);
                array_push($yearCount, $predict_value);
                array_push($perYear, $prevNextFiveYears);
                return array($yearCount, $perYear);
            }
        } catch (Exception $e) {
            Redirect::to('/')->withErrors([$e->getMessage()]);
        }
    }

    public function averageAssets()
    {
        $productsCount = Product::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->cursor();
        if (count($productsCount)) {
            $averageProductsPerDay = $productsCount->sum('count') / $productsCount->count();
            return $averageProductsPerDay;
        }
    }

    /* public function virtualCategories()
    {

        $virtualCount = Category::select('category_name', 'virtuality')->groupBy('category_name', 'virtuality')->cursor();
        $isVirtual = [];
        $isNotVirtual = [];
        foreach ($virtualCount as $virtual) {
            if ($virtual->virtuality == 1) {
                $isVirtual[] = $virtual->category_name;
            } else {
                $isNotVirtual[] = $virtual->category_name;
            }
        }

        return array(count($isVirtual), count($isNotVirtual));
    }*/

    public function runPythonScript()
    {
        $arg1 = "potato";
        $arg2 = "fdjdf";
        $result = shell_exec("python /path/to/your/python/script.py " . escapeshellarg($arg1) . " " . escapeshellarg($arg2));
        return $result;
    }
    public function patterns()
    {
        $associator = new Apriori($support = 0.5, $confidence = 0.5);
        $samples = [];
        $labels  = [];
        $uploads = Product::select('upload')->take(5000)->get();
        if (count($uploads)) {
            foreach ($uploads as $upload) {
                $filextension[] = pathinfo($upload->upload, PATHINFO_EXTENSION);
            }
            array_push($samples, $filextension);
            $associator->train($samples, $labels);
            //dd($associator->getRules()) ;
            //dd($associator->apriori());
            return array($associator->apriori());
        }
    }
    public function naiveBayes()
    {
        $assetsUpload = Product::select('upload')->whereNull('deleted_at')
            ->pluck('upload')->toArray();

        $fileTypes = [];
        $fileSizes = [];

        foreach ($assetsUpload as $upload) {
            array_push($fileTypes, Storage::mimeType($upload));
            array_push($fileSizes, Storage::size($upload));
        }
        // Check if the arrays are not empty
        if (empty($fileTypes) || empty($fileSizes)) {
            // Log a message instead of throwing an exception
            dd("No files");
        }

        // Prepare the dataset
        $samples = [];
        foreach ($fileSizes as $size) {
            $samples[] = [$size]; // Each sample should be an array
        }

        // Create the dataset
        $dataset = new ArrayDataset($samples, $fileTypes);

        // Split the dataset
        $split = new StratifiedRandomSplit($dataset, 0.5); // 20% for testing
        // Create and Test the Naive Bayes classifier
        $classifier = new NaiveBayes();;
        $classifier->train($split->getTrainSamples(), $split->getTrainLabels());

        // Predict file types for test samples
        $predictions = $classifier->predict($samples);
        $accuracy = Accuracy::score(
            $fileTypes,
            $predictions
        );


        // Return predictions
        return ($predictions);
        /*         return array($predictions, $accuracy);
 */
    }
}
