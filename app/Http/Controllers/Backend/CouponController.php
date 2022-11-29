<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function viewCoupons(){
        $coupons = Coupon::orderBy('id', 'DESC')->get();
        return view('backend.coupon.coupon_view', compact('coupons'));
    }

    public function storeCoupon(Request $request){
        $request->validate([
          'coupon_name' => ['required', 'min:4' ,'unique:coupons,coupon_name'],
          'coupon_discount' => 'required',
          'coupon_validity' => "required",
        ],[
            'coupon_name.unique' => 'Coupon name aready taken',
        ]);
     
        Coupon::insert([
          'coupon_name' => strtoupper($request->coupon_name),
          'coupon_discount' => $request->coupon_discount,
          'coupon_validity' =>  $request->coupon_validity,
          'created_at' => Carbon::now()
        ]);
  
        return redirect()->back()->with('success', 'Coupon Inserted Successfully');
  
      }

      public function editCoupon($id){
        $coupon = Coupon::findOrFail($id);
        return view('backend.coupon.coupon_edit', compact('coupon'));
     }

     public function updateCoupon(Request $request,$id){
      $request->validate([
        'coupon_name' => ['required', 'min:4','unique:coupons,coupon_name,'.$id],
        'coupon_discount' => 'required',
        'coupon_validity' => "required",
      ],[
        'coupon_name.unique' => 'Coupon name aready taken',
      ]);

      $data = Coupon::find($id);
          $data->coupon_name = strtoupper($request->coupon_name);
          $data->coupon_discount  = $request->coupon_discount;
          $data->coupon_validity = $request->coupon_validity;
          $data->save();
      return redirect()->route('manage-coupon')->with('success', 'Successfully updated');
  }

public function updateCouponStatus(Request $request){
    $request->validate([
        'coupon_id' => 'required'
    ]);

    $data = Coupon::findOrFail($request->coupon_id);
    $data->update([
        'status' => $data->status ? 0 : 1
    ]);

    return redirect()->back()->with('success', 'Status Updated Successfully');
 }

 public function deleteCoupon($id){
    $data = Coupon::findOrFail($id)->delete();

    return redirect()->back()->with('success', 'Coupon Deleted Successfully');
}

}
