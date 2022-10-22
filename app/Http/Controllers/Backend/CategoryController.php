<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function viewCategory(){
        $categories = Category::latest()->get();
      
        return view('backend.category.category_view', compact('categories'));
      }

    public function storeCategory(Request $request){
        $request->validate([
          'category_name_eng' => 'required|min:4|unique:categories,category_name_eng',
          'category_name_ban' => 'required|min:2|unique:categories,category_name_ban',
          'category_icon' => "required|min:2"
        ]);
             
        Category::insert([
          'category_name_eng' => $request->category_name_eng,
          'category_name_ban' => $request->category_name_ban,
          'category_slug_eng' => strtolower(str_replace(' ', '-' , $request->category_name_eng)),
          'category_slug_ban' => strtolower(str_replace(' ', '-' , $request->category_name_ban)),
          'category_icon' =>  $request->category_icon
        ]);
  
        return redirect()->back()->with('success', 'Category Inserted Successfully');
  
      }

      public function editCategory($id){
        $category = Category::findOrFail($id);
 
        return view('backend.category.category_edit', compact('category'));
     }

     public function updateCategory(Request $request,$id){
        $request->validate([
            'category_name_eng' => ['required', 'min:4', 'unique:categories,category_name_eng,'.$id],
            'category_name_ban' => ['required', 'min:2', 'unique:categories,category_name_ban,'.$id],
            'category_icon' => ['required', 'min:2'], 
        ],[
          'category_name_eng.unique' => 'category name aready taken',
          'category_name_ban.unique' => 'category name aready taken',
        ]);
  
       
  
        $data = category::find($id);
            $data->category_name_eng = $request->category_name_eng;
            $data->category_name_ban  = $request->category_name_ban;
            $data->category_slug_eng = strtolower(str_replace(' ', '-' , $request->category_name_eng));
            $data->category_slug_ban = strtolower(str_replace(' ', '-' , $request->category_name_ban));
            $data->category_icon = $request->category_icon;
            $data->save();
       
        
  
        return redirect()->route('all.category')->with('success', 'Successfully updated');
    }

    public function deleteCategory($id){

        Category::find($id)->delete();   
        return redirect()->back()->with('success', 'Deleted Successfully!');
    }
}
