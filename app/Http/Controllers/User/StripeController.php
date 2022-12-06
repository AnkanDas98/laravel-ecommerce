<?php

namespace App\Http\Controllers\User;

use Stripe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;

class StripeController extends Controller
{
    public function getStripeKey(){
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $amount = Session::has('coupon') ? Session::get('coupon')['total_amount'] : round(Cart::total());

        $stripeData = $stripe->paymentIntents->create(
            [
              'amount' => $amount * 100,
              'currency' => 'usd',
              'automatic_payment_methods' => ['enabled' => true],
              'metadata' => ['order_id' => uniqid(),'transection_id' => 'tx-'.uniqid(),]
            ]
          );

         

        return response()->json([
            'stripe_key' => env('STRIPE_KEY'),
            'stripe_secret' => env('STRIPE_SECRET'),
            'stripeData' => $stripeData
        ]);
    }

    public function stripeOrder(Request $request){

      $order_id = Order::insertGetId([
        'user_id' => Auth::id(),
        'division_id' => $request->divisonId,
        'district_id' => $request->districtId,
        'state_id' => $request->stateId,
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'post_code' => $request->postCode,
        'notes' => $request->note,
        'payment_type' => 'Stripe',
        'payment_method' => $request->paymentIntent['payment_method'],
        'transection_id' => 'tx-'.uniqid(),
      ]);
      
      
    }
}
