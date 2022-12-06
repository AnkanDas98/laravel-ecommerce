<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShipDivison;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
        if(Session::has('coupon')){
            if(Cart::count() == 0){
                Session::forget('coupon');
                return response()->json(['status' => 200]);
            }
            $coupon_name = session()->get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * ($coupon->coupon_discount / 100)),
                'total_amount' => round(Cart::total() - Cart::total() * ($coupon->coupon_discount / 100))
            ]);
        }
        return response()->json(['status' => 200]);
    }

    public function applyCoupon(Request $request){
        $coupon = Coupon::where('coupon_name', $request->coupon)->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->first();

        if($coupon){
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * ($coupon->coupon_discount / 100)),
                'total_amount' => round(Cart::total() - Cart::total() * ($coupon->coupon_discount / 100))
            ]);

            return response()->json(['success' => 'Coupon applied successfully']);
        }else{
            return response()->json(['error' => 'Invalid Coupon']);
        }
    }

    public function calculateCoupon(){
        if(Session::has('coupon')){
            return response()->json([
                'subTotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ]);
        }else{
            return response()->json(['total' => Cart::total()]);
        }
    }

    public function removeCoupon(){
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon remove successfully']);
    }

    public function checkout(){
        if(Auth::check()){
            
            $carts = Cart::content();
            $cartQty = Cart::count();
            $cartTotal = Cart::total();
            $divisons = ShipDivison::orderBy('divison_name', "ASC")->get();
            return view('frontend.checkout.checkout_view',compact('carts', 'cartQty', 'cartTotal','divisons'));
        }else{
            return redirect()->route('login')->with('error', 'Please login first');
        }
    }
}
