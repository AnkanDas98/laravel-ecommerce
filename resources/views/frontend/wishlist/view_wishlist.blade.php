<x-frontend.layouts.master>
    <x-slot name='pageTitle'>Wishlist</x-slot>

    <div class="my-wishlist-page" style="min-height: 44vh; margin-bottom: 17px">
        <div class="row">
            <div class="col-md-12 my-wishlist">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="4" class="heading-title">My Wishlist</th>
                            </tr>
                        </thead>
                        <tbody id="wishlist"
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
