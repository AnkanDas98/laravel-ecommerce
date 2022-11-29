<?php

namespace App\Http\Controllers\User;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartPageController extends Controller
{
    public function viewCart(){
        return view('frontend.cart.view_cart');
    }

    public function getCart(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json([
            'carts' =>   $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal)
        ]);
    }

    public function updateCart($rowId,Request $request){
        
        $row = Cart::get($rowId);
        if($request->query('type') == 'decrement'){
            Cart::update($rowId, $row->qty - 1);
            if(Session::has('coupon')){
                $coupon_name = session()->get('coupon')['coupon_name'];
                $coupon = Coupon::where('coupon_name', $coupon_name)->first();
                Session::put('coupon', [
                    'coupon_name' => $coupon->coupon_name,
                    'coupon_discount' => $coupon->coupon_discount,
                    'discount_amount' => round(Cart::total() * ($coupon->coupon_discount / 100)),
                    'total_amount' => round(Cart::total() - Cart::total() * ($coupon->coupon_discount / 100))
                ]);
            }
            return response()->json(['message' => 'Cart updated']);
        }else{
            Cart::update($rowId, $row->qty + 1);
            if(Session::has('coupon')){
                $coupon_name = session()->get('coupon')['coupon_name'];
                $coupon = Coupon::where('coupon_name', $coupon_name)->first();
                Session::put('coupon', [
                    'coupon_name' => $coupon->coupon_name,
                    'coupon_discount' => $coupon->coupon_discount,
                    'discount_amount' => round(Cart::total() * ($coupon->coupon_discount / 100)),
                    'total_amount' => round(Cart::total() - Cart::total() * ($coupon->coupon_discount / 100))
                ]);
            }
            return response()->json(['message' => 'Cart updated']);
        }
    }
}
