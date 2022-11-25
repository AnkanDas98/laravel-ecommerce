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
        </div><!-- /.row -->
    </div>
    <!-- ============================================== Product Modal ============================================== -->
    <x-frontend.partials.product_modal />
    <!-- ============================================== End Product Modal ============================================== -->
</x-frontend.layouts.master>
