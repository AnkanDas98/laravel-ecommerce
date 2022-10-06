<x-frontend.layouts.master>
    <div class="sign-in-page">
        <div class="row">
            <!-- Sign-in -->
            <div class="col-md-6 col-sm-6 sign-in">
                <h4 class="">Reset Password</h4>


                <form class="register-form outer-top-xs" action="{{ route('password.update') }}" method="POST"
                    role="form">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                        <input type="email" name="email" value="{{ old('email', $request->email) }}"
                            class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
                        <input type="password" name="password" class="form-control unicase-form-control text-input"
                            id="exampleInputPassword1">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="info-title" for="exampleInputPassword1">Confirm Password <span>*</span></label>
                        <input type="password" name="password_confirmation"
                            class="form-control unicase-form-control text-input" id="exampleInputPassword1">
                    </div>

                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Reset
                        Password</button>
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


{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}
