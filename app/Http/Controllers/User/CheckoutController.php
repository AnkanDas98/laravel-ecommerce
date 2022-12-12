<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    public function storeCheckout(Request $request){
       $request->validate([
        'shipping_name' => 'required',
        'shipping_email' => 'required|email',
        'shipping_phone' => 'required|min:11',
        'post_code' => 'required|min:2',
        'divison_id' => 'required',
        'district_id' => 'required',
        'state_id' => 'required',
        'notes' => 'nullable',
       ]);

       $data = [];
       $data['shipping_name'] = $request->shipping_name;
       $data['shipping_email'] = $request->shipping_email;
       $data['shipping_phone'] = $request->shipping_phone;
       $data['post_code'] = $request->post_code;
       $data['divison_id'] = $request->divison_id;
       $data['district_id'] = $request->district_id;
       $data['state_id'] = $request->state_id;
       $data['notes'] = $request->notes;

       $cartTotal = Cart::total();

       if($request->payment_method == 'stripe'){
        return view('frontend.payment.stripe',compact('data', 'cartTotal'));
       }elseif($request->payment_method == 'card'){
        return 'card';
       }else{
        return view('frontend.payment.cash',compact('data', 'cartTotal'));
       }
    }

    
}
