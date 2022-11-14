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

        $colorsEng = [];
        
            if (strstr($product->product_color_en, ',')) {
                $splitColors = explode(',', $product->product_color_en);
                foreach ($splitColors as $color) {
                    array_push($colorsEng, ucfirst($color));
                }
            } else {
                array_push($colorsEng, ucfirst($product->product_color_en));
            }
        
        $productColorsEng = array_unique($colorsEng);

       
        $colorsBan = [];
            if (strstr($product->product_color_bn, ',')) {
                $splitColors = explode(',', $product->product_color_bn);
                foreach ($splitColors as $color) {
                    array_push($colorsBan, ucfirst($color));
                }
            } else {
                array_push($colorsBan, ucfirst($product->product_color_en));
            }
        $productColorsBan = array_unique($colorsBan);

        $sizeEng = [];
            if (strstr($product->product_size_en, ',')) {
                $splitSize = explode(',', $product->product_size_en);
                foreach ($splitSize as $size) {
                    array_push($sizeEng, ucfirst($size));
                }
            } else {
                array_push($sizeEng, ucfirst($product->product_size_en));
            }
        $productSizeEng = array_unique($sizeEng);

        $sizeBan = [];
            if (strstr($product->product_size_bn, ',')) {
                $splitSize = explode(',', $product->product_size_bn);
                foreach ($splitSize as $size) {
                    array_push($sizeBan, ucfirst($size));
                }
            } else {
                array_push($sizeBan, ucfirst($product->product_size_bn));
            }
        $productSizeBan = array_unique($sizeBan);

       
        $relatedProducts = Product::where('category_id', $product->category_id)->orderBy('id', 'DESC')->get();
           
        return view('frontend.product.product_detail', compact('product', 'multiImages', 'productColorsBan', 'productColorsEng', 'productSizeEng','productSizeBan', 'relatedProducts'));
    }

    public function productByTag(Request $request){
        $tag = $request->query('tag');
      
        if($request->query('lang') == 'eng'){
            $products = Product::where('status', 1)->where('product_tags_en', 'LIKE', '%' . $tag . '%')->paginate(3);

             return view('frontend.tags.tags_view', compact('products'));
        }

        $products = Product::where('status', 1)->where('product_tags_bn', 'LIKE', '%' . $tag . '%')->paginate(3);

        return view('frontend.tags.tags_view', compact('products'));
    }

   

    public function productByCategory(Request $request, $id, $slug){

        

        if($request->query('type') == 'subcategory'){

            $products = Product::where('subcategory_id', $id)->where('status', 1)->paginate(3);
            return view('frontend.tags.tags_view', compact('products'));
        }
    
        $products = Product::where('subsubcategory_id', $id)->where('status', 1)->paginate(3);
        return view('frontend.tags.tags_view', compact('products'));
    }

    public function productPreview($id){
        $product = Product::find($id);
        $categoryEng = $product['category']['category_name_eng'];
        $categoryBan = $product['category']['category_name_ban'];

        $brandEng = $product['brand']['brand_name_eng'];
        $brandBan = $product['brand']['brand_name_ban'];
        $colorsEng = [];
        
            if (strstr($product->product_color_en, ',')) {
                $splitColors = explode(',', $product->product_color_en);
                foreach ($splitColors as $color) {
                    array_push($colorsEng, ucfirst($color));
                }
            } else {
                array_push($colorsEng, ucfirst($product->product_color_en));
            }
        
        $productColorsEng = array_unique($colorsEng);

       
        $colorsBan = [];
            if (strstr($product->product_color_bn, ',')) {
                $splitColors = explode(',', $product->product_color_bn);
                foreach ($splitColors as $color) {
                    array_push($colorsBan, ucfirst($color));
                }
            } else {
                array_push($colorsBan, ucfirst($product->product_color_en));
            }
        $productColorsBan = array_unique($colorsBan);

        $sizeEng = [];
        if($product->product_size_en){
            if (strstr($product->product_size_en, ',')) {
                $splitSize = explode(',', $product->product_size_en);
                foreach ($splitSize as $size) {
                    array_push($sizeEng, ucfirst($size));
                }
            } else {
                array_push($sizeEng, ucfirst($product->product_size_en));
            }
        }
        $productSizeEng = array_unique($sizeEng);

        $sizeBan = [];
        if($product->product_size_bn){
            if (strstr($product->product_size_bn, ',')) {
                $splitSize = explode(',', $product->product_size_bn);
                foreach ($splitSize as $size) {
                    array_push($sizeBan, ucfirst($size));
                }
            } else {
                array_push($sizeBan, ucfirst($product->product_size_bn));
            }
        }
        $productSizeBan = array_unique($sizeBan);

       

       return response()->json([
            'product' => $product,
            'categoryEng' => $categoryEng,
            'categoryBan' => $categoryBan,
            'brandEng'=> $brandEng,
            'brandBan'=> $brandBan,
            'productSizeEng' => $productSizeEng,
            'productSizeBan' => $productSizeBan,
            'productColorsEng' => $productColorsEng,
            'productColorsBan' => $productColorsBan
       ]);
        
           
        
    }

}
