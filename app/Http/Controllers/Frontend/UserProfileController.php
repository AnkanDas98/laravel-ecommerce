<?php

namespace App\Http\Controllers\Frontend;

use File;
use Image;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function userProfile(){
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.profile.user_profile', compact('userData'));

    }

    public function userProfileUpdate(Request $request){
        $id = Auth::user()->id;
        $request->validate([
            'name' => ['required', 'min:4'],
            'email' => ['required', 'email'],
            'profile_image' => ['nullable', 'image', 'mimes:png,jpg, jpeg'],
            'phone' => [ 'nullable','unique:users,phone,'.$id]
        ]);
  
       
  
        $data = User::find($id);
  
        if($request->hasFile('profile_image')){
  
            if(File::exists(public_path('storage/'.$data->profile_image))){
                File::delete(public_path('storage/'.$data->profile_image));
            }
            $img = $request->file('profile_image');
            $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
  
            $resizedImg = Image::make($img)->resize(128,128)->save('storage/images/user/' .$name_gen);
            $request->profile_image = 'images/user/'. $name_gen;
            $data->email = $request->email;
            $data->name = $request->name;
            $data->profile_image = $request->profile_image;
            $request->phone && $data->phone = $request->phone;
            $data->save();
        }else{
           $data->email = $request->email;
           $data->name = $request->name;
           $request->phone && $data->phone = $request->phone;
           $data->save();
        }
        
  
     
  
        return redirect()->route('user.profile')->with('success', 'Successfully updated');
    }

    public function editPassword(){
        return view('frontend.profile.user_change_password');
     }

     public function updatePassword(Request $request){
        $validateData = $request->validate([
           'old_password' => ['required', 'min:6'],
           'new_password' => ['required', 'min:6'],
           'confirm_password' => 'required|same:new_password'
        ]);
  
        $user= User::find(Auth::user()->id);
  
        if(Hash::check($validateData['old_password'], $user->password)){
           $user->password = bcrypt($validateData['new_password']);
           $user->save();
           return redirect()->back()->with('success', 'Password Changes Successfully');
        }else{
         
           return redirect()->back()->with('info', 'Old password is not match with our record');
        }
     }
  
}
