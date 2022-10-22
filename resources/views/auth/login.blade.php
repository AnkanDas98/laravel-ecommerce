<x-frontend.layouts.master>
    <x-slot name='pageTitle'>Login</x-slot>
    <div class="sign-in-page">
        <div class="row">
            <!-- Sign-in -->
            <div class="col-md-6 col-sm-6 sign-in">
                <h4 class="">Sign in</h4>
                <p class="">Hello, Welcome to your account.</p>
                <div class="social-sign-in outer-top-xs">
                    <a href="#" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with Facebook</a>
                    <a href="#" class="twitter-sign-in"><i class="fa fa-twitter"></i> Sign In with Twitter</a>
                </div>
                <form class="register-form outer-top-xs" action="{{ route('login') }}" method="POST" role="form">
                    @csrf
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                        <input type="email" name="email" class="form-control unicase-form-control text-input"
                            id="exampleInputEmail1">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
                        <input type="password" name="password" class="form-control unicase-form-control text-input"
                            id="exampleInputPassword1">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="radio outer-xs">
                        <label>
                            <input type="radio" name="remember" id="optionsRadios2" value="option2">Remember me!
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-password pull-right">Forgot your
                                Password?</a>
                        @endif
                    </div>
                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
                </form>
            </div>
            <!-- Sign-in -->

            <!-- create a new account -->
            <div class="col-md-6 col-sm-6 create-new-account">
                <h4 class="checkout-subtitle">Create a new account</h4>
                <p class="text title-tag-line">Create your new account.</p>
                <form class="register-form outer-top-xs" action="{{ route('register') }}" method="POST" role="form">
                    @csrf
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
                        <input type="email" name="register_email" class="form-control unicase-form-control text-input"
                            id="exampleInputEmail2">
                        @error('register_email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Name <span>*</span></label>
                        <input type="text" name="name" class="form-control unicase-form-control text-input"
                            id="exampleInputEmail1">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Phone Number</label>
                        <input type="tel" name="phone" class="form-control unicase-form-control text-input"
                            id="exampleInputEmail1">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Password <span>*</span></label>
                        <input type="password" name="register_password"
                            class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                        @error('register_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Confirm Password <span>*</span></label>
                        <input type="password" name="register_password_confirmation"
                            class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                        @error('register_password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
                </form>


            </div>
            <!-- create a new account -->
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
