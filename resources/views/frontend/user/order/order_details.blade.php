<x-frontend.layouts.master>
    <x-slot name='pageTitle'>User Dashboard</x-slot>
    <div class="body-content mt-3" style="min-height: 48.1vh;">
        <div class="container">
            <div class="row">
                <x-frontend.partials.user_sidebar />

                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Order Deatail</h4>
                        </div>
                        <hr>
                        <div class="card-body" style="background: #e9ebfc">
                            <table class="table">
                                <tr>
                                    <th>Shipping Name :</th>
                                    <th>{{ $order->name }}</th>
                                </tr>
                                <tr>
                                    <th>Email :</th>
                                    <th>{{ $order->email }}</th>
                                </tr>

                                <tr>
                                    <th>Phone :</th>
                                    <th>{{ $order->phone }}</th>
                                </tr>
                                <tr>
                                    <th>Divison :</th>
                                    <th>{{ $order->divison->divison_name }}</th>
                                </tr>
                                <tr>
                                    <th>District :</th>
                                    <th>{{ $order->district->district_name }}</th>
                                </tr>

                                <tr>
                                    <th>State :</th>
                                    <th>{{ $order->state->state_name }}</th>
                                </tr>

                                <tr>
                                    <th>Post Code :</th>
                                    <th>{{ $order->post_code }}</th>
                                </tr>

                                <tr>
                                    <th>Order Date :</th>
                                    <th>{{ $order->order_date }}</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Order Detail <span class="text-danger">Invoice: {{ $order->invoice_no }}</span> </h4>
                        </div>
                        <hr>
                        <div class="card-body" style="background: #e9ebfc">
                            <table class="table">
                                <tr>
                                    <th>Name :</th>
                                    <th>{{ $order->user->name }}</th>
                                </tr>


                                <tr>
                                    <th>Phone :</th>
                                    <th>{{ $order->user->phone }}</th>
                                </tr>
                                <tr>
                                    <th>Payment Type :</th>
                                    <th>{{ $order->payment_type }}</th>
                                </tr>
                                <tr>
                                    <th>Tranx Id :</th>
                                    <th>{{ $order->transaction_id }}</th>
                                </tr>

                                <tr>
                                    <th>Invoice :</th>
                                    <th class="text-info">{{ $order->invoice_no }}</th>
                                </tr>

                                <tr>
                                    <th>Total :</th>
                                    <th>৳{{ $order->amount }}</th>
                                </tr>

                                <tr>
                                    <th>Order</th>
                                    <th><span class="badge badge-pill badge-warning"
                                            style="background: #418DB9">{{ $order->status }}</span></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr style="background: #e2e2e2">
                                        <td class="col-md-1">
                                            <label for="">Image</label>
                                        </td>

                                        <td class="col-md-3">
                                            <label for="">Product Name</label>
                                        </td>

                                        <td class="col-md-3">
                                            <label for="">Product Code</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for="">Color</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for="">Size</label>
                                        </td>

                                        <td class="col-md-1">
                                            <label for="">Qty</label>
                                        </td>

                                        <td class="col-md-1">
                                            <label for="">Price</label>
                                        </td>
                                    </tr>

                                    @foreach ($orderItem as $item)
                                        <tr>
                                            <td class="col-md-1">
                                                <img src="{{ asset('storage/' . $item->product->product_thumbnail) }}"
                                                    alt="{{ $item->product->product_name_en }}"
                                                    style="width: 50px;height: 50px;">
                                            </td>

                                            <td class="col-md-1">
                                                <label for=""> {{ $item->product->product_name_en }} </label>
                                            </td>

                                            <td class="col-md-3">
                                                <label for="">{{ $item->product->product_code }}</label>
                                            </td>

                                            <td class="col-md-2">
                                                <label for="">{{ $item->color }}</label>
                                            </td>

                                            <td class="col-md-2">
                                                <label for="">{{ $item->size }}</label>
                                            </td>

                                            <td class="col-md-2">
                                                <label for="">{{ $item->qty }}</label>
                                            </td>

                                            <td class="col-md-3">
                                                <label for="">৳{{ $item->price * $item->qty }}</label>
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
    </div>
</x-frontend.layouts.master>
