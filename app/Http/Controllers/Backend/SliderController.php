<?php

namespace App\Http\Controllers\Backend;

use File;
use Image;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    public function sliderView(){
        $sliders = Slider::latest()->get();

        return view('backend.slider.slider_view', compact('sliders'));
    }

    public function storeSlider(Request $request){
        $request->validate([
          'title' => 'required|min:4|unique:sliders,title',
          'description' => 'required|min:2',
          'slider' => "required|image|mimes:png,jpg,jpeg"
        ]);
  
        $img = $request->file('slider');
        $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        $resizedImg = Image::make($img)->resize(870,370)->save('storage/images/slider/' .$name_gen);
        $request->slider = 'images/slider/'. $name_gen;

            
        Slider::insert([
          'title' => $request->title,
          'description' => $request->description,
          'slider' =>  $request->slider
        ]);
  
        return redirect()->back()->with('success', 'Slider Inserted Successfully');
  
      }

      public function editSlider($id){
        $slider = Slider::findOrFail($id);
 
        return view('backend.slider.slider_edit', compact('slider'));
     }

     public function updateSlider(Request $request,$id){


      $request->validate([
          'title' => ['required', 'min:4', 'unique:sliders,title,'.$id],
          'description' => ['required', 'min:2'],
          'slider' => ['nullable', 'image', 'mimes:png,jpg, jpeg'], 
      ],[
        'title.unique' => 'Slider name aready taken',
      ]);

      $data = Slider::find($id);
      
      if($request->hasFile('slider')){
        
        if(File::exists(public_path('storage/'.$data->slider))){
              File::delete(public_path('storage/'.$data->slider));
          }
          $img = $request->file('slider');
          $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();

          $resizedImg = Image::make($img)->resize(870,370)->save('storage/images/slider/' .$name_gen);
          $request->slider = 'images/slider/'. $name_gen;

          $data->title = $request->title;
          $data->description  = $request->description;
          
          $data->slider = $request->slider;
          $data->save();
   
        }else{
          $data->title = $request->title;
          $data->description  = $request->description;
          $data->save();
        }
      return redirect()->route('all.slider')->with('success', 'Successfully updated');
  }

  public function updateSliderStaus(Request $request){
    $request->validate([
        'slider_id' => 'required'
    ]);

    $data = Slider::findOrFail($request->slider_id);
    $data->update([
        'status' => $data->status ? 0 : 1
    ]);

    return redirect()->back()->with('success', 'Status Updated Successfully');
 }

 public function deleteSlider($id){

  $slider = Slider::find($id);
      if(File::exists(public_path('storage/'.$slider->slider))){
          File::delete(public_path('storage/'.$slider->slider));
      }
      $slider->delete();
      return redirect()->back()->with('success', 'Deleted Successfully!');
}
}
