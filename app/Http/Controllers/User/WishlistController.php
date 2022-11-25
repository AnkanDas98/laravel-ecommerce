<?php

namespace App\Http\Controllers\User;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function store(Request $request){
        if(Auth::check()){

            $exist = Wishlist::where('user_id', Auth::user()->id)->where('product_id', $request->productId)->first();

            if($exist){
                return response()->json(['error' => 'Already in the wishlist'], 200);
            }else{
                Wishlist::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => $request->productId,
                    ]);
                    return response()->json(['success' => 'Added to Wishlist'], 200);
            }

            
        }else{
            return response()->json(['error' => 'Login first to add product to wishlist'], 200);
        }
    }

    public function viewWishList(){
     

        return view('frontend.wishlist.view_wishlist');
    }

    public function getWishlist(){
        $wishlists = Wishlist::with('product')->where('user_id', Auth::user()->id)->get();
        return response()->json([
            'wishlists' => $wishlists
        ]);
    }

    public function removeWishList($id){
        Wishlist::where('user_id', Auth::user()->id)->where('product_id', $id)->delete();
        return response()->json(['status' => 200]);
    }
}
