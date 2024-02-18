<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TrashedController extends Controller
{
    public function index()
    {
        $productsCrapped = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->select('products.*')->whereNotNull('products.deleted_at')->get();
        $categoriesCrapped = Category::onlyTrashed()->get();
        return view('trashed.index', compact('productsCrapped', 'categoriesCrapped'));
    }
}
