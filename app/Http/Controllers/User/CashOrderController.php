<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Carbon\Carbon;
use App\Models\Order;
use App\Mail\OrderMail;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CashOrderController extends Controller
{
    public function cashOrder(Request $request){

        
        $amount = Session::has('coupon') ? Session::get('coupon')['total_amount'] : round(Cart::total());
        $order_id = Order::insertGetId([
          'user_id' => Auth::id(),
          'division_id' => $request->divison_id,
          'district_id' => $request->district_id,
          'state_id' => $request->state_id,
          'name' => $request->shipping_name,
          'email' => $request->shipping_email,
          'phone' => $request->shipping_phone,
          'post_code' => $request->post_code,
          'notes' => $request->notes,
          'payment_type' => 'Cash on Delivery',
          'currency' => 'BDT',
          'amount' => $amount,
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
          'transaction_id' => $invoice->transaction_id ? $invoice->transaction_id : ''
        ];
  
        Mail::to($request->email)->send(new OrderMail($data, $carts));
  
        if(Session::has('coupon')){
          Session::forget('coupon');
        }
  
        Cart::destroy();
  
        return redirect()->route('dashboard')->with('success', 'Order Successful');
    }
}
