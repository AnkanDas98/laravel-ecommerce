<?php

namespace App\Http\Controllers\User;

use Auth;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class AllUserController extends Controller
{
    public function showOrders(){
        $orders = Order::with('divison', 'district', 'state')->where('user_id', Auth::id())->orderBy('id', 'DESC')->get();

        return view('frontend.user.order.order_view', compact('orders'));
    }

    public function orderDetails($id){
        $order = Order::where('id', $id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::where('order_id', $id)->orderBy('id', 'DESC')->get();

        return view('frontend.user.order.order_details',compact('order', 'orderItem'));
    }

    public function invoiceDownload($id){
        $order = Order::with('divison', 'district', 'state')->where('id', $id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $id)->orderBy('id', 'DESC')->get();

        $pdf = Pdf::loadView('frontend.user.order.order_invoice', compact('order', 'orderItem'));
        return $pdf->download('invoice.pdf');

        //  return view('frontend.user.order.order_invoice',compact('order', 'orderItem'));
       
    }
}
