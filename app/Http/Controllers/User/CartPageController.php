<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
            return response()->json(['message' => 'Cart updated']);
        }else{
            Cart::update($rowId, $row->qty + 1);
            return response()->json(['message' => 'Cart updated']);
        }
    }
}
