<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use File;

class BrandController extends Controller
{
    public function brandView(){
      $brands = Brand::latest()->get();

      return view('backend.brand.brand_view', compact('brands'));
    }

    public function storeBrand(Request $request){
      $request->validate([
        'brand_name_eng' => 'required|min:4|unique:brands,brand_name_eng',
        'brand_name_ban' => 'required|min:2|unique:brands,brand_name_ban',
        'brand_image' => "required|image|mimes:png,jpg,jpeg"
      ]);

      $img = $request->file('brand_image');
      $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
      $resizedImg = Image::make($img)->resize(870,370)->save('storage/images/brand/' .$name_gen);
      $request->brand_image = 'images/brand/'. $name_gen;
          
      Brand::insert([
        'brand_name_eng' => $request->brand_name_eng,
        'brand_name_ban' => $request->brand_name_ban,
        'brand_slug_en' => strtolower(str_replace(' ', '-' , $request->brand_name_eng)),
        'brand_slug_ban' => strtolower(str_replace(' ', '-' , $request->brand_name_ban)),
        'brand_image' =>  $request->brand_image
      ]);

      return redirect()->back()->with('success', 'Brand Inserted Successfully');

    }

    public function editBrand($id){
       $brand = Brand::findOrFail($id);

       return view('backend.brand.brand_edit', compact('brand'));
    }

    public function updateBrand(Request $request,$id){
      $request->validate([
          'brand_name_eng' => ['required', 'min:4', 'unique:brands,brand_name_eng,'.$id],
          'brand_name_ban' => ['required', 'min:2', 'unique:brands,brand_name_ban,'.$id],
          'brand_image' => ['nullable', 'image', 'mimes:png,jpg, jpeg'], 
      ],[
        'brand_name_eng.unique' => 'Brand name aready taken',
        'brand_name_ban.unique' => 'Brand name aready taken',
      ]);

     

      $data = Brand::find($id);

      if($request->hasFile('brand_image')){

          if(File::exists(public_path('storage/'.$data->brand_image))){
              File::delete(public_path('storage/'.$data->brand_image));
          }
          $img = $request->file('brand_image');
          $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();

          $resizedImg = Image::make($img)->resize(300,300)->save('storage/images/brand/' .$name_gen);
          $request->brand_image = 'images/brand/'. $name_gen;

          $data->brand_name_eng = $request->brand_name_eng;
          $data->brand_name_ban  = $request->brand_name_ban;
          $data->brand_slug_en = strtolower(str_replace(' ', '-' , $request->brand_name_eng));
          $data->brand_slug_ban = strtolower(str_replace(' ', '-' , $request->brand_name_ban));
          $data->brand_image = $request->brand_image;
          $data->save();
      }else{
          $data->brand_name_eng =$request->brand_name_eng;
          $data->brand_name_ban  = $request->brand_name_ban;
          $data->brand_slug_en = strtolower(str_replace(' ', '-' , $request->brand_name_eng));
          $data->brand_slug_ban = strtolower(str_replace(' ', '-' , $request->brand_name_ban));
          $data->save();
      }
      

   

      return redirect()->route('all.brand')->with('success', 'Successfully updated');
  }

  public function deleteBrand($id){

    $brandData = Brand::find($id);
        if(File::exists(public_path('storage/'.$brandData->brand_image))){
            File::delete(public_path('storage/'.$brandData->brand_image));
        }
        $brandData->delete();
        return redirect()->back()->with('success', 'Deleted Successfully!');
}
}
