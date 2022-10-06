<x-frontend.layouts.master>
    <div class="sign-in-page" style="min-height: 32.1vh">
        <div class="row">
            <!-- Sign-in -->
            <div class="col-md-10 col-sm-12 sign-in">
                <h4 class="">Forgot your password</h4>
                <p class="">Forgot your password? No problem. Just let us know your email address and we will email
                    you a password reset link that will allow you to choose a new one.</p>


                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form class="register-form outer-top-xs" action="{{ route('password.email') }}" method="POST"
                    role="form">
                    @csrf
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                        <input type="email" name="email" class="form-control unicase-form-control text-input"
                            id="exampleInputEmail1">
                    </div>

                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Email Password Reset
                        Link</button>
                </form>
            </div>
            <!-- Sign-in -->

        </div><!-- /.row -->
    </div><!-- /.sigin-in-->
    <!-- ============================================== BRANDS CAROUSEL ============================================== -->
    <div id="brands-carousel" class="logo-slider wow fadeInUp">

        <div class="logo-slider-inner">
            <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                <div class="item m-t-15">
                    <a href="#" class="image">
                        <img data-echo="{{ asset('frontend/assets/images/brands/brand1.png') }}"
                            src="assets/images/blank.gif" alt="">
                    </a>
                </div>
                <!--/.item-->

                <div class="item m-t-10">
                    <a href="#" class="image">
                        <img data-echo="{{ asset('frontend/assets/images/brands/brand2.png') }}"
                            src="assets/images/blank.gif" alt="">
                    </a>
                </div>
                <!--/.item-->

                <div class="item">
                    <a href="#" class="image">
                        <img data-echo="{{ asset('frontend/assets/images/brands/brand3.png') }}"
                            src="assets/images/blank.gif" alt="">
                    </a>
                </div>
                <!--/.item-->

                <div class="item">
                    <a href="#" class="image">
                        <img data-echo="{{ asset('frontend/assets/images/brands/brand4.png') }}"
                            src="assets/images/blank.gif" alt="">
                    </a>
                </div>
                <!--/.item-->

                <div class="item">
                    <a href="#" class="image">
                        <img data-echo="{{ asset('frontend/assets/images/brands/brand5.png') }}"
                            src="assets/images/blank.gif" alt="">
                    </a>
                </div>
                <!--/.item-->

                <div class="item">
                    <a href="#" class="image">
                        <img data-echo="{{ asset('frontend/assets/images/brands/brand6.png') }}"
                            src="assets/images/blank.gif" alt="">
                    </a>
                </div>
                <!--/.item-->

                <div class="item">
                    <a href="#" class="image">
                        <img data-echo="{{ asset('frontend/assets/images/brands/brand7.png') }}"
                            src="assets/images/blank.gif" alt="">
                    </a>
                </div>
                <!--/.item-->

                <div class="item">
                    <a href="#" class="image">
                        <img data-echo="{{ asset('frontend/assets/images/brands/brand8.png') }}"
                            src="assets/images/blank.gif" alt="">
                    </a>
                </div>
                <!--/.item-->

                <div class="item">
                    <a href="#" class="image">
                        <img data-echo="{{ asset('frontend/assets/images/brands/brand9.png') }}"
                            src="assets/images/blank.gif" alt="">
                    </a>
                </div>
                <!--/.item-->

                <div class="item">
                    <a href="#" class="image">
                        <img data-echo="{{ asset('frontend/assets/images/brands/brand1.png') }}"
                            src="assets/images/blank.gif" alt="">
                    </a>
                </div>
                <!--/.item-->
            </div><!-- /.owl-carousel #logo-slider -->
        </div><!-- /.logo-slider-inner -->
    </div>

</x-frontend.layouts.master>
