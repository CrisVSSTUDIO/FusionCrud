<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;

class ProductController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('permission:create-product|edit-product|delete-product', ['only' => ['index','show']]);
       $this->middleware('permission:create-product', ['only' => ['create','store']]);
       $this->middleware('permission:edit-product', ['only' => ['edit','update']]);
       $this->middleware('permission:delete-product', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products =  Product::join('categories', 'products.category_id', '=', 'categories.id')->select('products.id', 'products.name', 'products.description', 'products.upload', 'products.slug', 'categories.category_name')->cursor();
        // $categoryProducts = Category::with('products')->where('slug', $category_slug)->get();
        //gets all products related to that category in an optimized way
        return view('products.index', compact('products')); //return the view all that data

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create', [
            'categories' => Category::select('id','category_name')->orderBy('id','DESC')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //

        $request->validated();
        $path = $request->file('upload')->storeAs('public', time() . '_' . $request->file('upload')->getClientOriginalName());
        $product = new Product([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'slug' => Str::slug($request->get('name')),
            'upload' => $path,
            'category_id' => $request->input('category')

        ]);
        $product->save();
        return redirect('/products')->with('success', 'product criado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
        /*    $product = $product->load('tags');
       $alltags = Tag::select('id', 'tag_name')->get();
        $category_slug = DB::table('categories')->select('slug')->where('id', '=', $product->category_id)->value('slug'); */
        $categories=Category::select('id','category_name')->orderBy('id','DESC')->get();
        return view('products.show', compact('product','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $request->validated();
       /*  if ($request->has('tags')) {
            $tagIds = $request->input('tags');
            $product->tags()->attach($tagIds, ['product_id' => $product->id]);
        }

        if ($request->has('productags')) {
            $tagIds = $request->input('productags');
            $product->tags()->detach($tagIds);
        } */
        $product->update([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'slug' => Str::slug($request->get('name')),
            'category_id' => $request->get('category'),
            'upload' => $request->hasFile('upload') ? $request->file('upload')->storeAs('public', time() . '_' . $request->file('upload')->getClientOriginalName()) : $product->upload
        ]);

        return back()->with('success', 'product atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();
        return redirect('products')->with('success', 'Asset removido com sucesso!');
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return redirect('products' )->with('success', 'product restaurado com sucesso!');
    }
    public function forceDelete($id)
    {
        $product =Product::onlyTrashed()->findOrFail($id);
        if ($product->upload) {
            Storage::delete($product->upload);
        }
/*         $product->tags()->detach();
 */        $product->forceDelete();
        return redirect('products')->with('success', 'product removido permanentemente com sucesso!');
    }
    public function downloadFile(Product $product)
    {
        $file = Product::where('id', $product->id)->value('upload');
        return Storage::download($file);
    }
}
