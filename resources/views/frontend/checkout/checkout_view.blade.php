<x-frontend.layouts.master>

    <x-slot name='pageTitle'>Checkout</x-slot>

    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li class="active">Checkout</li>
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>
    <div class="checkout-box">
        <div class="row">
            <form class="register-form" action="{{ route('store.checkout') }}" method="POST">
                @csrf
                <div class="col-md-8">
                    <div class="panel-group checkout-steps" id="accordion">
                        <!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">

                            <div id="collapseOne" class="panel-collapse collapse in">
                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <div class="row">

                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                            <h4 class="checkout-subtitle">
                                                <b>Shipping Address</b>
                                            </h4>
                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">Shipping Name
                                                    <span>*</span></label>
                                                <input type="text"
                                                    class="form-control unicase-form-control text-input"
                                                    id="exampleInputEmail1" name="shipping_name"
                                                    value="{{ auth()->user()->name }}" placeholder="Full Name" />
                                                @error('shipping_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">Email
                                                    <span>*</span></label>
                                                <input type="email"
                                                    class="form-control unicase-form-control text-input"
                                                    id="exampleInputEmail1" name="shipping_email"
                                                    value="{{ auth()->user()->email }}" placeholder="Email" />
                                                @error('shipping_email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">Phone
                                                    <span>*</span></label>
                                                <input type="number"
                                                    class="form-control unicase-form-control text-input"
                                                    id="exampleInputEmail1" name="shipping_phone"
                                                    value="{{ auth()->user()->phone }}" placeholder="Phone" />
                                                @error('shipping_phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">Post Code
                                                    <span>*</span></label>
                                                <input type="text"
                                                    class="form-control unicase-form-control text-input"
                                                    id="exampleInputEmail1" name="post_code" placeholder="Post Code" />
                                                @error('post_code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>

                                        <!-- already-registered-login -->
                                        <div class="col-md-6 col-sm-6 already-registered-login">

                                            <div class="form-group">
                                                <h5><b>Devison</b> <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="divison_id" id="selectDivison" class="form-control"
                                                        aria-invalid="false">
                                                        <option value="">Select Category</option>
                                                        @foreach ($divisons as $divison)
                                                            <option value="{{ $divison->id }}">
                                                                {{ $divison->divison_name }}
                                                            </option>
                                                        @endforeach
                                                        @error('divison_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5><b>District</b> <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="district_id" id="selectDistrict" class="form-control"
                                                        aria-invalid="false">
                                                        <option value="">Select Divison</option>
                                                        @error('district_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5><b>State</b> <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="state_id" id="selectState" class="form-control"
                                                        aria-invalid="false">
                                                        <option value="">Select State</option>

                                                        @error('state_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <h5><b>Notes</b> <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea class="form-control" name="notes" id="" cols="42" rows="10" placeholder="Notes"></textarea>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>



                                        <!-- already-registered-login -->
                                    </div>
                                </div>
                                <!-- panel-body  -->
                            </div>
                            <!-- row -->
                        </div>
                        <!-- checkout-step-01  -->

                    </div>
                    <!-- /.checkout-steps -->
                </div>
                <div class="col-md-4">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">
                                        Your Checkout Progress
                                    </h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        @foreach ($carts as $item)
                                            <li>
                                                <strong>Image: </strong>
                                                <img src="{{ asset('storage/' . $item->options->image) }}"
                                                    style="height: 50px;width: 50px;" alt="" srcset="">
                                            </li>
                                            <li>
                                                <strong>Qty: </strong>
                                                {{ $item->qty }}

                                                <strong>Color: </strong>
                                                {{ $item->options->color }}

                                                <strong>Size: </strong>
                                                {{ $item->options->size ? $item->options->size : '...' }}
                                                <hr>
                                            </li>
                                        @endforeach

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

                <div class="col-md-4">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">
                                        Select Payment Method
                                    </h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Stripe</label>
                                        <input type="radio" name="payment_method" value="stripe">
                                        <img src="{{ asset('storage/images/stripe.svg') }}" width="35px"
                                            height="35px" alt="stripe logo">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Card</label>
                                        <input type="radio" name="payment_method" value="card">
                                        <img src="{{ asset('frontend/assets/images/payments/3.png') }}"
                                            width="38px" height="38px" alt="visa card">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Cash</label>
                                        <input type="radio" name="payment_method" value="cash">
                                        <img src="{{ asset('storage/images/cash-payment.png') }}" width="38px"
                                            height="38px" alt="cash payment">
                                    </div>
                                </div>
                                <hr>
                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Payment
                                    Step</button>
                            </div>
                        </div>
                    </div>
                    <!-- checkout-progress-sidebar -->
                </div>

            </form>
        </div>
        <!-- /.row -->
    </div>
</x-frontend.layouts.master>
