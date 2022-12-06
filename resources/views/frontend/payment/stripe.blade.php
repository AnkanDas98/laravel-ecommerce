<x-frontend.layouts.master>

    <x-slot name='pageTitle'>Stripe Payment</x-slot>

    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li class="active">Stripe</li>
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>
    <div class="checkout-box" style="min-height: 46vh">
        <div class="row">


            <div class="col-md-6">
                <!-- checkout-progress-sidebar -->
                <div class="checkout-progress-sidebar">
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">
                                    Your Shopping Amount
                                </h4>
                            </div>
                            <div class="">
                                <ul class="nav nav-checkout-progress list-unstyled">

                                    <li>
                                        @if (Session::has('coupon'))
                                            <strong>SubTotal: </strong> ৳ {{ $cartTotal }}
                                            <hr>
                                            <strong>Coupon: </strong>{{ session()->get('coupon')['coupon_name'] }}
                                            ({{ session()->get('coupon')['coupon_discount'] }}%)
                                            <hr>
                                            <strong>Coupon Discount: </strong>
                                            ৳{{ session()->get('coupon')['discount_amount'] }}
                                            <hr>
                                            <strong>Grand Total: </strong>
                                            ৳{{ session()->get('coupon')['total_amount'] }}
                                            <hr>
                                        @else
                                            <strong>SubTotal: </strong> ৳ {{ $cartTotal }}
                                            <hr>
                                            <strong>Grand Total: </strong> ৳ {{ $cartTotal }}
                                            <hr>
                                        @endif
                                    </li>
                                    <li>
                                        <a href="#">Payment Method</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- checkout-progress-sidebar -->
            </div>

            <div class="col-md-6">
                <!-- checkout-progress-sidebar -->
                <div class="checkout-progress-sidebar">
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">
                                    Select Payment Method
                                </h4>
                            </div>
                            <form id="payment-form" style="height: 29vh;display: grid; grid-template-rows: 1fr 1fr;">
                                <input type="hidden" id="shipName" value="{{ $data['shipping_name'] }}">
                                <input type="hidden" id="shipEmail" value="{{ $data['shipping_email'] }}">
                                <input type="hidden" id="shipPhone" value="{{ $data['shipping_phone'] }}">
                                <input type="hidden" id="shipPostCode" value="{{ $data['post_code'] }}">
                                <input type="hidden" id="shipDivisonCode" value="{{ $data['divison_id'] }}">
                                <input type="hidden" id="shipDistrictCode" value="{{ $data['district_id'] }}">
                                <input type="hidden" id="shipStateCode" value="{{ $data['state_id'] }}">
                                <input type="hidden" id="shipNotes" value="{{ $data['notes'] }}">
                                <div id="payment-element" style="height: 100%;">
                                    <!-- Elements will create form elements here -->
                                </div>
                                <button class="btn btn-primary btn-sm btn-block" style="align-self: end;"
                                    id="submit">Submit</button>
                                <div id="error-message">
                                    <!-- Display error message to your customers here -->
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!-- checkout-progress-sidebar -->
            </div>
        </div>
        <!-- /.row -->
    </div>
</x-frontend.layouts.master>
