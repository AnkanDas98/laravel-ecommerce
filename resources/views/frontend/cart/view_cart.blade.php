<x-frontend.layouts.master>
    <x-slot name='pageTitle'>My Cart</x-slot>

    <div class="row" style="min-height: 44vh; margin-bottom: 17px">
        <div class="shopping-cart">
            <div class="shopping-cart-table">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <thead>
                                <tr>
                                    <th class="cart-romove item">Image</th>
                                    <th class="cart-description item">Product name</th>
                                    <th class="cart-product-name item">Product Color</th>
                                    <th class="cart-edit item">Product Size</th>
                                    <th class="cart-qty item">Quantity</th>
                                    <th class="cart-sub-total item">Subtotal</th>
                                    <th class="cart-total last-item">Remove</th>
                                </tr>
                            </thead>
                        </thead>
                        <tbody id="cartPage"
                            data-language={{ session()->get('language') == 'bangla' ? 'bangla' : 'English' }}>


                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-4 col-sm-12 estimate-ship-tax"></div>

            <div class="col-md-4 col-sm-12 estimate-ship-tax">

                <table class="table" id="couponForm">
                    <thead>
                        <tr>
                            <th>
                                <span class="estimate-title">Discount Code</span>
                                <p>Enter your coupon code if you have one..</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input id="couponInput" type="text"
                                        class="form-control unicase-form-control text-input" placeholder="You Coupon..">
                                    <span id="couponError" class="text-danger" style="display: none">Please Enter
                                        Coupon</span>
                                </div>
                                <div class="clearfix pull-right">
                                    <button id="couponBtn" type="submit" class="btn-upper btn btn-primary">APPLY
                                        COUPON</button>
                                </div>
                            </td>
                        </tr>
                    </tbody><!-- /tbody -->
                </table><!-- /table -->

            </div><!-- /.estimate-ship-tax -->

            <div class="col-md-4 col-sm-12 cart-shopping-total">
                <table class="table">
                    <thead id="applyCoupon">

                    </thead><!-- /thead -->
                    <tbody>
                        <tr>
                            <td>
                                <div class="cart-checkout-btn pull-right">
                                    <a href="{{ route('checkout') }}" id="checkoutBtn"
                                        class="btn btn-primary checkout-btn">PROCCED TO
                                        CHEKOUT</a>
                                </div>
                            </td>
                        </tr>
                    </tbody><!-- /tbody -->
                </table><!-- /table -->
            </div><!-- /.cart-shopping-total -->

        </div><!-- /.row -->
    </div>
    <!-- ============================================== Product Modal ============================================== -->
    <x-frontend.partials.product_modal />
    <!-- ============================================== End Product Modal ============================================== -->
</x-frontend.layouts.master>
