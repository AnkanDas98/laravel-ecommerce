<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
   public function index () {
    $products = Product::where('status', 1)->orderBy('id', 'DESC')->get();
    $categories = Category::orderBy('category_name_eng', 'ASC')->get();
        return view('frontend.index', compact('categories','products'));
    }
}
