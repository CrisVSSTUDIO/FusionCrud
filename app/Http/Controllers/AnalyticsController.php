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
use Illuminate\Support\Facades\Log;
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
        return view('analytics.index', ['created_at' => json_encode($product_name), 'rowcount' => json_encode($product_count), 'averageProductsPerDay' => $averageProductsPerDay, 'perYear' => json_encode($perYear), 'yearCount' => json_encode($yearCount), 'apriori' => json_encode($apriori), 'predictions' => json_encode($predictions)]);
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
        // Retrieve file types and sizes from the database
        $files = Asset::select('id', 'filetype', 'filesize')
            ->where('user_id', Auth::user()->id)
            ->whereNull('deleted_at')
            ->orderBy('filesize')
            ->take(500)
            ->get();

        // Check if files collection is not empty
        if ($files->isEmpty()) {
            Log::error("No files found for user with ID: " . Auth::user()->id);
            return;
        }

        // Prepare the dataset
        $samples = $files->pluck('filesize')->map(function ($size) {
            return [$size];
        })->all();
        $labels = $files->pluck('filetype')->all();

        // Create the dataset
        $dataset = new ArrayDataset($samples, $labels);

        // Split the dataset
        $split = new StratifiedRandomSplit($dataset);

        // Create and Test the Naive Bayes classifier
        $classifier = new NaiveBayes();
        $classifier->train($split->getTrainSamples(), $split->getTrainLabels());

        // Predict file types for test samples
        $predictions = $classifier->predict($samples);
        $classificationRport = new ClassificationReport($labels, $predictions);
        $accuracy = Accuracy::score($labels, $predictions);

        // Update database records with predictions
        foreach ($predictions as $index => $prediction) {
            DB::table('assets')
                ->where('id', $files[$index]->id)
                ->update(['filetype_prediction' => $prediction]);
        }
        // Return accuracy and predictions
        return ['accuracy' => $accuracy, 'predictions' => $predictions];
    }
    public function kMeans()
    {
        $samples = [];
        $labels = [];
        // Retrieve file types and sizes from the database
        $files = Asset::select('filesize', 'filetype')
            ->where('user_id', Auth::user()->id)
            ->whereNull('deleted_at')
            ->orderBy('filesize') // Corrected orderby clause
            ->get();
        $samples = [];
        $labels = [];
        // Retrieve file types and sizes from the database
        $files = Asset::select('filesize', 'filetype')
            ->where('user_id', Auth::user()->id)
            ->whereNull('deleted_at')
            ->orderBy('filesize')
            ->get();

        // Check if files collection is not empty
        if ($files->isEmpty()) {
            Log::error("No files found for user with ID: " . Auth::user()->id);
            return;
        }

        // Prepare the data for clustering
        foreach ($files as $file) {
            $samples[] = [$file->filesize]; // Each sample should be an array of features
            $labels[] = $file->filetype;
        }

        $kmeans = new KMeans(2); // Specify the number of clusters
        $clusters = $kmeans->cluster($samples);

        // Combine the clusters with labels
        $labeledClusters = [];
        foreach ($clusters as $clusterIndex => $cluster) {
            foreach ($cluster as $sampleIndex => $sample) {
                $labeledClusters[$labels[$sampleIndex]][] = $sample[0];
            }
        }
        return $labeledClusters;
        // Check if files collection is not empty
        if ($files->isEmpty()) {
            Log::error("No files found for user with ID: " . Auth::user()->id);
            return;
        }
        foreach ($files as $file) {
            array_push($labels, $file->filetype);
            array_push($samples, $file->filesize);
        }
        $res = array_fill_keys(array_values($labels), $samples);
        $kmeans = new DBSCAN($epsilon = 2, $minSamples = 3);;
        $potato = $kmeans->cluster($res);
        dd($potato);
    }
}
