<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function store(Request $request){
        $product = Product::findOrfail($request->product_id);

        Cart::add([
            'id' => $request->product_id,
            'name' =>  session()->get('language') == 'bangla' ? $product->product_name_bn : $product->product_name_en ,
            'qty' => $request->product_qty,
            'weight' => 1,
            'price' => $product->discount_price ? round($product->selling_price - $product->selling_price * ($product->discount_price / 100)) : $product->selling_price,
            'options' => [
                'image' => $product->product_thumbnail,
                'size' => $request->product_size ? $request->product_size : null,
                'color' => $request->product_color
            ]
            ]);

        // return redirect('/')->with('success', 'Added to Cart');
        return redirect()->back()->with('success', 'Added to Cart');
        
    }

    public function getCartData(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json([
            'carts' =>   $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal)
        ]);
    }

    public function removeCartItem($id){
        Cart::remove($id);
        return response()->json(['status' => 200]);
    }
}
