<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
   public function index () {
    $products = Product::where('status', 1)->orderBy('id', 'DESC')->get();
    $categories = Category::orderBy('category_name_eng', 'ASC')->get();
    $features =  Product::where('featured', 1)->orderBy('id', 'DESC')->get();
    $skip_category_0 = Category::skip(0)->first();
    $skip_product_0 = Product::where('category_id', $skip_category_0->id)->orderBy('id', 'DESC')->get();
    $skip_category_1 = Category::skip(5)->first();
    $skip_product_1 = Product::where('category_id', $skip_category_1->id)->orderBy('id', 'DESC')->get();
    $skip_brand_0 = Brand::skip(6)->first();
    $skip_product_2 = Product::where('brand_id', $skip_brand_0->id)->orderBy('id', 'DESC')->get();
    return view('frontend.index', compact('categories','products', 'features', 'skip_product_0','skip_product_1','skip_product_2'));
    }

    public function productDetail($id, $slug){
        $product = Product::find($id);
        $multiImages = MultiImage::where('product_id', $product->id)->orderBy('id', 'DESC')->get();
        return view('frontend.product.product_detail', compact('product', 'multiImages'));
    }

    public function productByTagEng(Request $request){
        $tag = $request->query('tag');

        $products = Product::where('status', 1)->where('product_tags_en', 'LIKE', '%' . $tag . '%')->paginate(3);

        return view('frontend.tags.tags_view', compact('products'));
    }

    public function productByTagBan(Request $request){
        $tag = $request->query('tag');

        $products = Product::where('product_tags_bn', 'LIKE', '%' . $tag . '%')->paginate(3);

      

        return view('frontend.tags.tags_view', compact('products'));
       
    }
}
