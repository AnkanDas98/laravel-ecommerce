<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Http\Controllers\Controller;
use Image;

class ProductController extends Controller
{
    public function addProduct(){
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();

        return view('backend.product.add_product', compact('categories','brands'));
    }

    public function getSubSubCategory($id){
        $subSubCat = SubSubCategory::where('sub_category_id', $id)->orderBy('sub_sub_category_name_eng', "ASC")->get();
        return json_encode($subSubCat);
      }

    public function storeProduct(Request $request){
        $request->validate([
            'brand_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_id' => 'required',
            'product_name_en' => ['required', 'min:2', 'unique:products,product_name_en'],
            'product_name_bn' => ['required', 'min:2', 'unique:products,product_name_bn'],
            'product_code' => 'required|min:3',
            'product_qty' => 'required',
            'product_tags_en' => ['required', 'min:2'],
            'product_tags_bn' => ['required', 'min:2'],
            'product_size_en' => ['required', 'min:2'],
            'product_size_bn' => ['required', 'min:2'],
            'product_color_en' => ['required', 'min:2'],
            'product_color_bn' => ['required', 'min:2'],
            'selling_price' => 'required',
            'discount_price' => 'nullable',
            'short_descp_en' => 'required|min:10',
            'short_descp_bn' => 'required|min:10',
            'long_descp_en' => 'required|min:20',
            'long_descp_bn' => 'required|min:20',
            'product_thumbnail' => 'required|image|mimes:jpg,bmp,png,jpeg',
            'hot_deals'=>'nullable',
            'featured'=>'nullable',
            'special_offer'=>'nullable',
            'special_deal'=>'nullable',
            'status' => 'nullable'
        ]);

        $img = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        $resizedImg = Image::make($img)->resize(917,1000)->save('storage/images/product/thumbnail/' .$name_gen);
        $request->product_thumbnail = 'images/product/thumbnail/'. $name_gen;

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' =>$request->product_name_en,
            'product_name_bn' =>$request->product_name_bn,
            'product_slug_en' => strtolower(str_replace(' ', '-' , $request->product_name_en)),
            'product_slug_bn' => strtolower(str_replace(' ', '-' , $request->product_name_bn)),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_bn' => $request->product_tags_bn,
            'product_size_en' => $request->product_size_en,
            'product_size_bn' => $request->product_size_bn,
            'product_color_en' =>$request->product_color_en,
            'product_color_bn' =>$request->product_color_bn,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->selling_price ?? null,
            'product_thumbnail' => $request->product_thumbnail,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_bn' => $request->short_descp_bn,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_bn' => $request->long_descp_bn,   
            'hot_deals'=> $request->hot_deals ?? null,
            'featured'=>$request->featured ?? null,
            'special_offer'=>$request->special_offer ?? null,
            'special_deal'=>$request->special_deal ?? null,
            'status' => 1,
            'created_at' => Carbon::now()
        ]);

        

        $images = $request->file('product_image');

        foreach($images as $image){
            $img = $image;
            $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            $resizedImg = Image::make($img)->resize(917,1000)->save('storage/images/product/multi-image/' .$name_gen);
            $request->product_image = 'images/product/multi-image/'. $name_gen;

            MultiImage::insert([
                'product_id' => $product_id,
                'product_image' => $request->product_image,
                'created_at' => Carbon::now()
            ]);
        }

        
         
        return redirect()->back()->with('success','Product added Successfully');
    }

}
