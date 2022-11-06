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
use File;

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
            'discount_price' => $request->discount_price ?? null,
            'product_thumbnail' => $request->product_thumbnail,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_bn' => $request->short_descp_bn,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_bn' => $request->long_descp_bn,   
            'hot_deals'=> $request->hot_deals ?? null,
            'featured'=>$request->featured ?? null,
            'special_offer'=>$request->special_offer ?? null,
            'special_deal'=>$request->special_deal ?? null,
            'status' => $request->status ?? 0,
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

    public function manageProducts(){
        $products = Product::latest()->get();

        return view('backend.product.manage_product', compact('products'));
    }

    public function editProduct($id){
        $product = Product::find($id);
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $multPhotos = MultiImage::where('product_id', $id)->get();
        return view('backend.product.edit_product', compact('product','brands', 'categories','multPhotos'));
     }

     public function updateProduct(Request $request, $id){
        $request->validate([
            'brand_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_id' => 'required',
            'product_name_en' => ['required', 'min:2', 'unique:products,product_name_en,'.$id],
            'product_name_bn' => ['required', 'min:2', 'unique:products,product_name_bn,'.$id],
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
            'hot_deals'=>'nullable',
            'featured'=>'nullable',
            'special_offer'=>'nullable',
            'special_deal'=>'nullable',
            'status' => 'nullable'
        ]);

            Product::findOrFail($id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
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
            'discount_price' => $request->discount_price ?? null,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_bn' => $request->short_descp_bn,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_bn' => $request->long_descp_bn,   
            'hot_deals'=> $request->hot_deals ?? null,
            'featured'=>$request->featured ?? null,
            'special_offer'=>$request->special_offer ?? null,
            'special_deal'=>$request->special_deal ?? null,
            'status' => $request->status ?? 0,
            'created_at' => Carbon::now()
        ]);    
        
        return redirect()->route('manage.product')->with('success','Successfully Updated');
     }
     public function updateMultiImage(Request $request){
        
         $imgs = $request->product_image;
         $id =  $request->image_id;

                $imgData = MultiImage::findOrFail($request->image_id);
                if(File::exists(public_path('storage/'.$imgData->product_image))){
                    File::delete(public_path('storage/'.$imgData->product_image));
                }
                $name_gen = hexdec(uniqid()).'.'.$imgs->getClientOriginalExtension();
                $resizedImg = Image::make($imgs)->resize(917,1000)->save('storage/images/product/multi-image/' .$name_gen);
                $request->product_image = 'images/product/multi-image/'. $name_gen;
                
                MultiImage::where('id', $id)->update([
                    'product_image' => $request->product_image
                ]);
       
            return redirect()->back()->with('success','Product Image updated Successfully');
     }

     public function deleteMultiImage($id){
        $imgData = MultiImage::findOrFail($id);
        if(File::exists(public_path('storage/'.$imgData->product_image))){
                    File::delete(public_path('storage/'.$imgData->product_image));
        }
        $imgData->delete();

        return redirect()->back()->with('success','Product Image deleted Successfully');
     }

     public function addMultiImage(Request $request){

        
        $images = $request->file('product_image');

        foreach($images as $image){
            $img = $image;
            $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            $resizedImg = Image::make($img)->resize(917,1000)->save('storage/images/product/multi-image/' .$name_gen);
            $request->product_image = 'images/product/multi-image/'. $name_gen;

            MultiImage::insert([
                'product_id' => $request->product_id,
                'product_image' => $request->product_image,
                'created_at' => Carbon::now()
            ]);
        }

        return redirect()->back()->with('success','Product Image added Successfully');
     }

     public function updateThumbnailImage(Request $request){

        
        $request->validate([
            'product_thumbnail' => 'required|image|mimes:png,jpg, jpeg'
        ]);

        $imgData = Product::findOrFail($request->product_id);
        if(File::exists(public_path('storage/'.$imgData->product_thumbnail))){
                    File::delete(public_path('storage/'.$imgData->product_thumbnail));
        }

        $img = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        $resizedImg = Image::make($img)->resize(917,1000)->save('storage/images/product/thumbnail/' .$name_gen);
        $request->product_thumbnail = 'images/product/thumbnail/'. $name_gen;

        $imgData->update([
            'product_thumbnail' =>  $request->product_thumbnail,
            'created_at' => Carbon::now()
        ]);

        return redirect()->back()->with('success','Product Thumbnail added Successfully');
     }

     public function updateProductStaus(Request $request){
        $request->validate([
            'product_id' => 'required'
        ]);

        $data = Product::findOrFail($request->product_id);
        $data->update([
            'status' => $data->status ? 0 : 1
        ]);

        return redirect()->back()->with('success', 'Status Updated Successfully');
     }

    public function deleteProduct($id){
        $data = Product::findOrFail($id);
        $images = MultiImage::where('product_id', $id)->get();

        foreach($images as $image){
            if(File::exists(public_path('storage/'.$image->product_image))){
                File::delete(public_path('storage/'.$image->product_image));       
            }

            $image->delete();
        }
        if(File::exists(public_path('storage/'.$data->product_thumbnail))){
                    File::delete(public_path('storage/'.$data->product_thumbnail));
        }

        $data->delete();

        return redirect()->back()->with('success', 'Product Deleted Successfully');
    }
}
