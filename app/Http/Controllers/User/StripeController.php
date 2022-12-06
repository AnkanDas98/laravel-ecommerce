<?php

namespace App\Http\Controllers\User;

use Auth;
use Stripe;
use Carbon\Carbon;
use App\Models\Order;
use App\Mail\OrderMail;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

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
              'metadata' => ['order_id' => uniqid()]
            ]
          );
        return response()->json([
            'stripe_key' => env('STRIPE_KEY'),
            'stripe_secret' => env('STRIPE_SECRET'),
            'stripeData' => $stripeData
        ]);
    }

    public function stripeOrder(Request $request){
  
      \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

      $paymentIntent = \Stripe\PaymentIntent::retrieve([
        'id' =>  $request->paymentIntentId,
      ]);

      $amount = Session::has('coupon') ? Session::get('coupon')['total_amount'] : round(Cart::total());
      
      
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
        'payment_method' => $paymentIntent->charges->data[0]->payment_method,
        'transaction_id' => $paymentIntent->charges->data[0]->balance_transaction,
        'currency' => $paymentIntent->charges->data[0]->currency,
        'amount' => $amount,
        'order_number' => $paymentIntent->charges->data[0]->metadata->order_id,
        'invoice_no' => 'STARBY'.mt_rand(10000000,999999999),
        'order_date' =>  Carbon::now()->format('d F Y'),
        'order_year' => Carbon::now()->format('F'),
        'order_month' => Carbon::now()->format('Y'),
        'status' => 'Pending',
        'created_at' => Carbon::now()
      ]);

    
      $carts = Cart::content();
      foreach($carts as $cart){
        OrderItem::insert([
          'order_id' => $order_id,
          'product_id' => $cart->id,
          'color' => $cart->options->color,
          'size' => $cart->options->size,
          'qty' => $cart->qty,
          'price' => $cart->price,
          'created_at' => Carbon::now()
        ]);
      }
      $invoice = Order::findOrFail($order_id);
      $data = [
        'invoice_no' => $invoice->invoice_no,
        'amount' => $amount,
        'name' => $invoice->name,
        'email' => $invoice->email,
        'phone' => $invoice->phone,
        'transaction_id' => $invoice->transaction_id
      ];

      Mail::to($request->email)->send(new OrderMail($data, $carts));

      if(Session::has('coupon')){
        Session::forget('coupon');
      }

      Cart::destroy();

      return response()->json(['success'=> 'Your order Place Successfully']);
    }
}
