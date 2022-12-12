<x-frontend.layouts.master>
    <x-slot name='pageTitle'>User Dashboard</x-slot>
    <div class="body-content mt-3" style="min-height: 48.1vh;">
        <div class="container">
            <div class="row">
                <x-frontend.partials.user_sidebar />
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr style="background: #e2e2e2">
                                    <td class="col-md-1">
                                        <label for="">Date</label>
                                    </td>

                                    <td class="col-md-3">
                                        <label for="">Total</label>
                                    </td>

                                    <td class="col-md-3">
                                        <label for="">Payment</label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for="">Invoice</label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for="">Orders</label>
                                    </td>

                                    <td class="col-md-1">
                                        <label for="">Action</label>
                                    </td>
                                </tr>

                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="col-md-1">
                                            <label for="">{{ $order->order_date }}</label>
                                        </td>

                                        <td class="col-md-3">
                                            <label for="">৳{{ $order->amount }}</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for="">{{ $order->payment_type }}</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for="">{{ $order->invoice_no }}</label>
                                        </td>


                                        <td class="col-md-2">
                                            <label for=""><span class="badge badge-pill badge-warning"
                                                    style="background: #418DB9">{{ $order->status }}</span> </label>
                                        </td>

                                        <td class="col-md-1">
                                            <a href="{{ url('/user/order/details/' . $order->id) }}"
                                                class="btn btn-sm btn-primary"><i class="fa fa-eye"></i>View</a>
                                            <a href="{{ url('/user/invoice/download/' . $order->id) }}" target="_blank"
                                                class="btn btn-sm btn-danger" style="margin-top: 5px;"><i
                                                    class="fa fa-download"></i>Invoice</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-frontend.layouts.master>
