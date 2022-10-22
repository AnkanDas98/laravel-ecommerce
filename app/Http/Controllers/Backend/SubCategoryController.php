<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    public function viewSubCategory(){
        $subCategories = SubCategory::latest()->get();
        $categories = Category::orderBy('category_name_eng', 'ASC')->get();
        return view('backend.category.sub_category_view', compact('categories', 'subCategories'));
      }

    public function storeSubCategory(Request $request){
        $request->validate([
          'category_id' => 'required',
          'sub_category_name_eng' => 'required|min:4|unique:sub_categories,sub_category_name_eng',
          'sub_category_name_ban' => 'required|min:2|unique:sub_categories,sub_category_name_ban',
        ]);
             
        SubCategory::insert([
          'category_id' =>$request->category_id,
          'sub_category_name_eng' => $request->sub_category_name_eng,
          'sub_category_name_ban' => $request->sub_category_name_ban,
          'sub_category_slug_eng' => strtolower(str_replace(' ', '-' , $request->sub_category_name_eng)),
          'sub_category_slug_ban' => strtolower(str_replace(' ', '-' , $request->sub_category_name_ban)),
        ]);
  
        return redirect()->back()->with('success', 'Category Inserted Successfully');
  
      }

      public function editSubCategory($id){
        $subCategory = SubCategory::findOrFail($id);
        $categories = Category::latest()->get();
        return view('backend.category.sub_category_edit', compact('subCategory', 'categories'));
     }

     public function updateSubCategory(Request $request,$id){

        $request->validate([
            'category_id' => 'required',
            'sub_category_name_eng' => ['required', 'min:4', 'unique:sub_categories,sub_category_name_eng,'.$id],
            'sub_category_name_ban' => ['required', 'min:2', 'unique:sub_categories,sub_category_name_ban,'.$id],
        ],[
          'sub_category_name_eng.unique' => 'Sub category name aready taken',
          'sub_category_name_ban.unique' => 'Sub category name aready taken',
        ]);
  
       
  
            $data = SubCategory::find($id);
            $data->category_id = $request->category_id;
            $data->sub_category_name_eng = $request->sub_category_name_eng;
            $data->sub_category_name_ban  = $request->sub_category_name_ban;
            $data->sub_category_slug_eng = strtolower(str_replace(' ', '-' , $request->sub_category_name_eng));
            $data->sub_category_slug_ban = strtolower(str_replace(' ', '-' , $request->sub_category_name_ban));
            $data->save();
       
        
  
        return redirect()->route('all.subCategory')->with('success', 'Successfully updated');
    }

    public function deleteSubCategory($id){

        SubCategory::find($id)->delete();   
        return redirect()->back()->with('success', 'Deleted Successfully!');
    }


    // ---------------------Sub Sub Category ----------------------------/
    public function viewSubSubCategory(){
      $subSubCategories = SubSubCategory::latest()->get();
      $categories = Category::orderBy('category_name_eng', 'ASC')->get();
      return view('backend.category.sub_subCategory_view', compact('categories', 'subSubCategories'));
    }

    public function getSubCategory($id){
      $subCat = SubCategory::where('category_id', $id)->orderBy('sub_category_name_eng', "ASC")->get();
      return json_encode($subCat);
    }

    public function storeSubSubCategory(Request $request){
      $request->validate([
        'category_id' => 'required',
        'sub_category_id' => 'required',
        'sub_sub_category_name_eng' => 'required|min:4',
        'sub_sub_category_name_ban' => 'required|min:2',
      ]);
           
      SubSubCategory::insert([
        'category_id' =>$request->category_id,
        'sub_category_id' =>$request->sub_category_id,
        'sub_sub_category_name_eng' => $request->sub_sub_category_name_eng,
        'sub_sub_category_name_ban' => $request->sub_sub_category_name_ban,
        'sub_sub_category_slug_eng' => strtolower(str_replace(' ', '-' , $request->sub_sub_category_name_eng)),
        'sub_sub_category_slug_ban' => strtolower(str_replace(' ', '-' , $request->sub_sub_category_name_ban)),
      ]);

      return redirect()->back()->with('success', 'Sub Category Inserted Successfully');
    }

    public function editSubSubCategory($id){
      $subSubCategory = SubSubCategory::findOrFail($id);
      $categories = Category::latest()->get();
      return view('backend.category.sub_subCategory_edit', compact('subSubCategory', 'categories'));
   }

   public function updateSubSubCategory(Request $request,$id){

 

    $request->validate([
        'category_id' => 'required',
        'sub_category_id' => 'required',
        'sub_sub_category_name_eng' => ['required', 'min:4', 'unique:sub_sub_categories,sub_sub_category_name_eng,'.$id],
        'sub_sub_category_name_ban' => ['required', 'min:2', 'unique:sub_sub_categories,sub_sub_category_name_ban,'.$id],
    ],[
      'sub_sub_category_name_eng.unique' => 'Sub subcategory name aready taken',
      'sub_sub_category_name_ban.unique' => 'Sub subcategory name aready taken',
    ]);

   

        $data = SubSubCategory::find($id);
        $data->category_id = $request->category_id;
        $data->sub_category_id = $request->sub_category_id;
        $data->sub_sub_category_name_eng = $request->sub_sub_category_name_eng;
        $data->sub_sub_category_name_ban  = $request->sub_sub_category_name_ban;
        $data->sub_sub_category_slug_eng = strtolower(str_replace(' ', '-' , $request->sub_sub_category_name_eng));
        $data->sub_sub_category_slug_ban = strtolower(str_replace(' ', '-' , $request->sub_sub_category_name_ban));
        $data->save();
   
    

    return redirect()->route('all.sub.subCategory')->with('success', 'Successfully updated');
}

    public function deleteSubSubCategory($id){

      SubSubCategory::find($id)->delete();   
      return redirect()->back()->with('success', 'Deleted Successfully!');
  }

}
