<x-frontend.layouts.master>
    <x-slot name='pageTitle'>Starby</x-slot>
    <!-- ========================================== SECTION – HERO ========================================= -->
    <!-- ========================================= SECTION – HERO : END ========================================= -->

    <div class="row">
        <!-- ============================================== SIDEBAR ============================================== -->
        <x-frontend.partials.sidebar />
        <!-- /.sidemenu-holder -->
        <!-- ============================================== SIDEBAR : END ============================================== -->

        <!-- ============================================== CONTENT ============================================== -->
        <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
            <x-frontend.partials.hero />
            <!-- ============================================== INFO BOXES ============================================== -->
            <div class="info-boxes wow fadeInUp">
                <div class="info-boxes-inner">
                    <div class="row">
                        <div class="col-md-6 col-sm-4 col-lg-4">
                            <div class="info-box">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h4 class="info-box-heading green">money back</h4>
                                    </div>
                                </div>
                                <h6 class="text">30 Days Money Back Guarantee</h6>
                            </div>
                        </div>
                        <!-- .col -->

                        <div class="hidden-md col-sm-4 col-lg-4">
                            <div class="info-box">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h4 class="info-box-heading green">free shipping</h4>
                                    </div>
                                </div>
                                <h6 class="text">Shipping on orders over $99</h6>
                            </div>
                        </div>
                        <!-- .col -->

                        <div class="col-md-6 col-sm-4 col-lg-4">
                            <div class="info-box">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h4 class="info-box-heading green">Special Sale</h4>
                                    </div>
                                </div>
                                <h6 class="text">Extra $5 off on all items </h6>
                            </div>
                        </div>
                        <!-- .col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.info-boxes-inner -->

            </div>
            <!-- /.info-boxes -->
            <!-- ============================================== INFO BOXES : END ============================================== -->

            <!-- ============================================== SCROLL TABS ============================================== -->
            <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                <div class="more-info-tab clearfix ">
                    <h3 class="new-product-title pull-left">New Products</h3>
                    <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                        <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a>
                        </li>

                        @foreach ($categories as $category)
                            <li><a data-transition-type="backSlide" href="#category{{ $category->id }}"
                                    data-toggle="tab">{{ session()->get('language') == 'bangla' ? $category->category_name_ban : $category->category_name_eng }}</a>
                            </li>
                        @endforeach
                        {{-- <li><a data-transition-type="backSlide" href="#laptop" data-toggle="tab">Electronics</a></li>
                        <li><a data-transition-type="backSlide" href="#apple" data-toggle="tab">Shoes</a></li> --}}
                    </ul>
                    <!-- /.nav-tabs -->
                </div>
                <div class="tab-content outer-top-xs">
                    <div class="tab-pane in active" id="all">
                        <div class="product-slider">
                            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">

                                @foreach ($products as $product)
                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image"> <a href="detail.html"><img
                                                                src="{{ asset('storage/' . $product->product_thumbnail) }}"
                                                                alt="{{ $product->product_name_en }}"
                                                                title="{{ $product->product_name_en }}"></a>
                                                    </div>
                                                    <!-- /.image -->

                                                    <div class="tag new">

                                                        <span>{{ $product->discount_price ? $product->discount_price . '%' : 'new' }}</span>

                                                    </div>
                                                </div>
                                                <!-- /.product-image -->

                                                <div class="product-info text-left">
                                                    <h3 class="name"><a
                                                            href="{{ url('/product/detail/' . $product->id . '/' . $product->product_slug_en) }}">{{ session()->get('language') == 'bangla' ? $product->product_name_bn : $product->product_name_en }}</a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>
                                                    <div class="product-price">
                                                        @if ($product->discount_price)
                                                            <span class="price">
                                                                ${{ round($product->selling_price - $product->selling_price * ($product->discount_price / 100)) }}
                                                            </span>
                                                            <span class="price-before-discount">$
                                                                {{ $product->selling_price }}
                                                            </span>
                                                        @else
                                                            <span class="price">${{ $product->selling_price }}</span>
                                                        @endif
                                                    </div>
                                                    <!-- /.product-price -->

                                                </div>
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">
                                                            <li class="add-cart-button btn-group">
                                                                <button id="productPreviewBtn"
                                                                    class="btn btn-primary icon" title="Add to Cart"
                                                                    type="button" data-toggle="modal"
                                                                    data-target="#productModal"
                                                                    data-product-id={{ $product->id }}
                                                                    data-language={{ session()->get('language') == 'bangla' ? 'bangla' : 'English' }}>
                                                                    <i class="fa fa-shopping-cart"></i> </button>
                                                                <button class="btn btn-primary cart-btn"
                                                                    type="button">Add
                                                                    to cart</button>
                                                            </li>


                                                            <li> <button id="addToWishListBtn"
                                                                    class="btn btn-primary icon" title="Wishlist"
                                                                    type="button" data-product-id={{ $product->id }}
                                                                    data-language={{ session()->get('language') == 'bangla' ? 'bangla' : 'English' }}>
                                                                    <i class="fa fa-heart"></i> </button> </li>


                                                            <li class="lnk"> <a data-toggle="tooltip"
                                                                    class="add-to-cart" href="detail.html"
                                                                    title="Compare"> <i class="fa fa-signal"
                                                                        aria-hidden="true"></i> </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /.action -->
                                                </div>
                                                <!-- /.cart -->
                                            </div>
                                            <!-- /.product -->

                                        </div>
                                        <!-- /.products -->
                                    </div>
                                    <!-- /.item -->
                                @endforeach
                            </div>
                            <!-- /.home-owl-carousel -->
                        </div>
                        <!-- /.product-slider -->
                    </div>
                    <!-- /.tab-pane -->
                    @foreach ($categories as $category)
                        <div class="tab-pane" id="category{{ $category->id }}">
                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                                    @php
                                        $product = App\Models\Product::where('category_id', $category->id)
                                            ->orderBy('id', 'DESC')
                                            ->get();
                                    @endphp

                                    @forelse ($product as $product)
                                        <div class="item item-carousel">
                                            <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="detail.html"><img
                                                                    src="{{ asset('storage/' . $product->product_thumbnail) }}"
                                                                    alt="{{ $product->product_name_en }}"
                                                                    title="{{ $product->product_name_en }}"></a>
                                                        </div>
                                                        <!-- /.image -->

                                                        <div class="tag sale">
                                                            <span>{{ $product->discount_price ? $product->discount_price . '%' : 'new' }}</span>
                                                        </div>
                                                    </div>
                                                    <!-- /.product-image -->

                                                    <div class="product-info text-left">
                                                        <h3 class="name"><a
                                                                href="{{ url('/product/detail/' . $product->id . '/' . $product->product_slug_en) }}">{{ session()->get('language') == 'bangla' ? $product->product_name_bn : $product->product_name_en }}</a>
                                                        </h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="description"></div>
                                                        <div class="product-price">
                                                            @if ($product->discount_price)
                                                                <span class="price">
                                                                    ${{ round($product->selling_price - $product->selling_price * ($product->discount_price / 100)) }}
                                                                </span>
                                                                <span class="price-before-discount">$
                                                                    {{ $product->selling_price }}
                                                                </span>
                                                            @else
                                                                <span
                                                                    class="price">${{ $product->selling_price }}</span>
                                                            @endif
                                                        </div>
                                                        <!-- /.product-price -->

                                                    </div>
                                                    <!-- /.product-info -->
                                                    <div class="cart clearfix animate-effect">
                                                        <div class="action">
                                                            <ul class="list-unstyled">
                                                                <li class="add-cart-button btn-group">
                                                                    <button class="btn btn-primary icon"
                                                                        data-toggle="dropdown" type="button"> <i
                                                                            class="fa fa-shopping-cart"></i> </button>
                                                                    <button class="btn btn-primary cart-btn"
                                                                        type="button">Add to cart</button>
                                                                </li>
                                                                <li class="lnk wishlist"> <a class="add-to-cart"
                                                                        href="detail.html" title="Wishlist"> <i
                                                                            class="icon fa fa-heart"></i> </a> </li>
                                                                <li class="lnk"> <a class="add-to-cart"
                                                                        href="detail.html" title="Compare"> <i
                                                                            class="fa fa-signal"
                                                                            aria-hidden="true"></i>
                                                                    </a> </li>
                                                            </ul>
                                                        </div>
                                                        <!-- /.action -->
                                                    </div>
                                                    <!-- /.cart -->
                                                </div>
                                                <!-- /.product -->

                                            </div>
                                            <!-- /.products -->
                                        </div>

                                    @empty
                                        <h5 class="text-danger w-100" style="text-align: center;">No Product Found!
                                        </h5>
                                    @endforelse

                                    <!-- /.item -->


                                </div>
                                <!-- /.home-owl-carousel -->
                            </div>
                            <!-- /.product-slider -->
                        </div>
                    @endforeach

                    <!-- /.tab-pane -->



                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.scroll-tabs -->
            <!-- ============================================== SCROLL TABS : END ============================================== -->
            <!-- ============================================== WIDE PRODUCTS ============================================== -->
            <div class="wide-banners wow fadeInUp outer-bottom-xs">
                <div class="row">
                    <div class="col-md-7 col-sm-7">
                        <div class="wide-banner cnt-strip">
                            <div class="image"> <img class="img-responsive"
                                    src="{{ asset('frontend/assets/images/banners/home-banner1.jpg') }}"
                                    alt=""> </div>
                        </div>
                        <!-- /.wide-banner -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-5 col-sm-5">
                        <div class="wide-banner cnt-strip">
                            <div class="image"> <img class="img-responsive"
                                    src="{{ asset('frontend/assets/images/banners/home-banner2.jpg') }}"
                                    alt=""> </div>
                        </div>
                        <!-- /.wide-banner -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.wide-banners -->

            <!-- ============================================== WIDE PRODUCTS : END ============================================== -->
            <!-- ============================================== FEATURED PRODUCTS ============================================== -->
            <section class="section featured-product wow fadeInUp">
                <h3 class="section-title">Featured products</h3>
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                    @foreach ($features as $item)
                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image"> <a
                                                href="{{ url('/product/detail/' . $item->id . '/' . $item->product_slug_en) }}"><img
                                                    src="{{ asset('storage/' . $item->product_thumbnail) }}"
                                                    alt="{{ $item->product_name_en }}"></a> </div>
                                        <!-- /.image -->

                                        <div class="tag hot">
                                            <span>{{ $item->discount_price ? $item->discount_price . '%' : 'hot' }}</span>
                                        </div>
                                    </div>
                                    <!-- /.product-image -->

                                    <div class="product-info text-left">
                                        <h3 class="name"><a
                                                href="{{ url('/product/detail/' . $item->id . '/' . $item->product_slug_en) }}">{{ session()->get('language') == 'bangla' ? $item->product_name_bn : $item->product_name_en }}</a>
                                        </h3>
                                        <div class="rating rateit-small"></div>
                                        <div class="description"></div>
                                        <div class="product-price">
                                            @if ($item->discount_price)
                                                <span class="price">
                                                    ${{ round($item->selling_price - $item->selling_price * ($item->discount_price / 100)) }}
                                                </span>
                                                <span class="price-before-discount">$
                                                    {{ $item->selling_price }}
                                                </span>
                                            @else
                                                <span class="price">${{ $item->selling_price }}</span>
                                            @endif
                                        </div>
                                        <!-- /.product-price -->

                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">
                                                <li class="add-cart-button btn-group">
                                                    <button id="productPreviewBtn" class="btn btn-primary icon"
                                                        title="Add to Cart" type="button" data-toggle="modal"
                                                        data-target="#productModal"
                                                        data-product-id={{ $item->id }}
                                                        data-language={{ session()->get('language') == 'bangla' ? 'bangla' : 'English' }}>
                                                        <i class="fa fa-shopping-cart"></i> </button>

                                                    <button class="btn btn-primary cart-btn" type="button">Add to
                                                        cart</button>
                                                </li>
                                                <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                        title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                                <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                        title="Compare"> <i class="fa fa-signal"
                                                            aria-hidden="true"></i>
                                                    </a> </li>
                                            </ul>
                                        </div>
                                        <!-- /.action -->
                                    </div>
                                    <!-- /.cart -->
                                </div>
                                <!-- /.product -->

                            </div>
                            <!-- /.products -->
                        </div>
                        <!-- /.item -->
                    @endforeach
                </div>
                <!-- /.home-owl-carousel -->
            </section>
            <!-- /.section -->
            <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->
            <!-- ============================================== WIDE PRODUCTS ============================================== -->
            <div class="wide-banners wow fadeInUp outer-bottom-xs">
                <div class="row">
                    <div class="col-md-12">
                        <div class="wide-banner cnt-strip">
                            <div class="image"> <img class="img-responsive"
                                    src="assets/images/banners/home-banner.jpg" alt=""> </div>
                            <div class="strip strip-text">
                                <div class="strip-inner">
                                    <h2 class="text-right">New Mens Fashion<br>
                                        <span class="shopping-needs">Save up to 40% off</span>
                                    </h2>
                                </div>
                            </div>
                            <div class="new-label">
                                <div class="text">NEW</div>
                            </div>
                            <!-- /.new-label -->
                        </div>
                        <!-- /.wide-banner -->
                    </div>
                    <!-- /.col -->

                </div>
                <!-- /.row -->
            </div>
            <!-- /.wide-banners -->
            <!-- ============================================== WIDE PRODUCTS : END ============================================== -->

            <!-- ============================================== Skip Product 0 ============================================== -->
            <section class="section featured-product wow fadeInUp">
                <h3 class="section-title">
                    {{ $skip_product_0[0]['category'][session()->get('language') == 'bangla' ? 'category_name_ban' : 'category_name_eng'] }}
                </h3>
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                    @foreach ($skip_product_0 as $item)
                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image"> <a
                                                href="{{ url('/product/detail/' . $item->id . '/' . $item->product_slug_en) }}"><img
                                                    src="{{ asset('storage/' . $item->product_thumbnail) }}"
                                                    alt="{{ $item->product_name_en }}"></a> </div>
                                        <!-- /.image -->

                                        <div class="tag hot">
                                            <span>{{ $item->discount_price ? $item->discount_price . '%' : 'hot' }}</span>
                                        </div>
                                    </div>
                                    <!-- /.product-image -->

                                    <div class="product-info text-left">
                                        <h3 class="name"><a
                                                href="{{ url('/product/detail/' . $item->id . '/' . $item->product_slug_en) }}">{{ session()->get('language') == 'bangla' ? $item->product_name_bn : $item->product_name_en }}</a>
                                        </h3>
                                        <div class="rating rateit-small"></div>
                                        <div class="description"></div>
                                        <div class="product-price">
                                            @if ($item->discount_price)
                                                <span class="price">
                                                    ${{ round($item->selling_price - $item->selling_price * ($item->discount_price / 100)) }}
                                                </span>
                                                <span class="price-before-discount">$
                                                    {{ $item->selling_price }}
                                                </span>
                                            @else
                                                <span class="price">${{ $item->selling_price }}</span>
                                            @endif
                                        </div>
                                        <!-- /.product-price -->

                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">
                                                <li class="add-cart-button btn-group">
                                                    <button class="btn btn-primary icon" data-toggle="dropdown"
                                                        type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                    <button class="btn btn-primary cart-btn" type="button">Add to
                                                        cart</button>
                                                </li>
                                                <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                        title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                                <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                        title="Compare"> <i class="fa fa-signal"
                                                            aria-hidden="true"></i>
                                                    </a> </li>
                                            </ul>
                                        </div>
                                        <!-- /.action -->
                                    </div>
                                    <!-- /.cart -->
                                </div>
                                <!-- /.product -->

                            </div>
                            <!-- /.products -->
                        </div>
                        <!-- /.item -->
                    @endforeach
                </div>
                <!-- /.home-owl-carousel -->
            </section>
            <!-- /.section -->
            <!-- ============================================== Skip Product 0 : END ============================================== -->

            <!-- ============================================== Skip Product 1 ============================================== -->
            <section class="section featured-product wow fadeInUp">
                <h3 class="section-title">
                    {{ $skip_product_1[0]['category'][session()->get('language') == 'bangla' ? 'category_name_ban' : 'category_name_eng'] }}
                </h3>
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                    @foreach ($skip_product_1 as $item)
                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image"> <a
                                                href="{{ url('/product/detail/' . $item->id . '/' . $item->product_slug_en) }}"><img
                                                    src="{{ asset('storage/' . $item->product_thumbnail) }}"
                                                    alt="{{ $item->product_name_en }}"></a> </div>
                                        <!-- /.image -->

                                        <div class="tag hot">
                                            <span>{{ $item->discount_price ? $item->discount_price . '%' : 'hot' }}</span>
                                        </div>
                                    </div>
                                    <!-- /.product-image -->

                                    <div class="product-info text-left">
                                        <h3 class="name"><a
                                                href="{{ url('/product/detail/' . $item->id . '/' . $item->product_slug_en) }}">{{ session()->get('language') == 'bangla' ? $item->product_name_bn : $item->product_name_en }}</a>
                                        </h3>
                                        <div class="rating rateit-small"></div>
                                        <div class="description"></div>
                                        <div class="product-price">
                                            @if ($item->discount_price)
                                                <span class="price">
                                                    ${{ round($item->selling_price - $item->selling_price * ($item->discount_price / 100)) }}
                                                </span>
                                                <span class="price-before-discount">$
                                                    {{ $item->selling_price }}
                                                </span>
                                            @else
                                                <span class="price">${{ $item->selling_price }}</span>
                                            @endif
                                        </div>
                                        <!-- /.product-price -->

                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">
                                                <li class="add-cart-button btn-group">
                                                    <button class="btn btn-primary icon" data-toggle="dropdown"
                                                        type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                    <button class="btn btn-primary cart-btn" type="button">Add to
                                                        cart</button>
                                                </li>
                                                <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                        title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                                <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                        title="Compare"> <i class="fa fa-signal"
                                                            aria-hidden="true"></i>
                                                    </a> </li>
                                            </ul>
                                        </div>
                                        <!-- /.action -->
                                    </div>
                                    <!-- /.cart -->
                                </div>
                                <!-- /.product -->

                            </div>
                            <!-- /.products -->
                        </div>
                        <!-- /.item -->
                    @endforeach
                </div>
                <!-- /.home-owl-carousel -->
            </section>
            <!-- /.section -->
            <!-- ============================================== Skip Product 1 : END ============================================== -->

            <!-- ============================================== Skip Product 2 ============================================== -->
            <section class="section featured-product wow fadeInUp">
                <h3 class="section-title">
                    {{ $skip_product_2[0]['brand'][session()->get('language') == 'bangla' ? 'brand_name_ban' : 'brand_name_eng'] }}
                </h3>
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                    @foreach ($skip_product_2 as $item)
                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image"> <a
                                                href="{{ url('/product/detail/' . $item->id . '/' . $item->product_slug_en) }}"><img
                                                    src="{{ asset('storage/' . $item->product_thumbnail) }}"
                                                    alt="{{ $item->product_name_en }}"></a> </div>
                                        <!-- /.image -->

                                        <div class="tag hot">
                                            <span>{{ $item->discount_price ? $item->discount_price . '%' : 'hot' }}</span>
                                        </div>
                                    </div>
                                    <!-- /.product-image -->

                                    <div class="product-info text-left">
                                        <h3 class="name"><a
                                                href="{{ url('/product/detail/' . $item->id . '/' . $item->product_slug_en) }}">{{ session()->get('language') == 'bangla' ? $item->product_name_bn : $item->product_name_en }}</a>
                                        </h3>
                                        <div class="rating rateit-small"></div>
                                        <div class="description"></div>
                                        <div class="product-price">
                                            @if ($item->discount_price)
                                                <span class="price">
                                                    ${{ round($item->selling_price - $item->selling_price * ($item->discount_price / 100)) }}
                                                </span>
                                                <span class="price-before-discount">$
                                                    {{ $item->selling_price }}
                                                </span>
                                            @else
                                                <span class="price">${{ $item->selling_price }}</span>
                                            @endif
                                        </div>
                                        <!-- /.product-price -->

                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">
                                                <li class="add-cart-button btn-group">
                                                    <button class="btn btn-primary icon" data-toggle="dropdown"
                                                        type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                    <button class="btn btn-primary cart-btn" type="button">Add to
                                                        cart</button>
                                                </li>
                                                <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                        title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                                <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                        title="Compare"> <i class="fa fa-signal"
                                                            aria-hidden="true"></i>
                                                    </a> </li>
                                            </ul>
                                        </div>
                                        <!-- /.action -->
                                    </div>
                                    <!-- /.cart -->
                                </div>
                                <!-- /.product -->

                            </div>
                            <!-- /.products -->
                        </div>
                        <!-- /.item -->
                    @endforeach
                </div>
                <!-- /.home-owl-carousel -->
            </section>
            <!-- /.section -->
            <!-- ============================================== Skip Product 2 : END ============================================== -->

            <!-- ============================================== BEST SELLER ============================================== -->

            <div class="best-deal wow fadeInUp outer-bottom-xs">
                <h3 class="section-title">Best seller</h3>
                <div class="sidebar-widget-body outer-top-xs">
                    <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
                        <div class="item">
                            <div class="products best-product">
                                <div class="product">
                                    <div class="product-micro">
                                        <div class="row product-micro-row">
                                            <div class="col col-xs-5">
                                                <div class="product-image">
                                                    <div class="image"> <a href="#"> <img
                                                                src="assets/images/products/p20.jpg" alt="">
                                                        </a> </div>
                                                    <!-- /.image -->

                                                </div>
                                                <!-- /.product-image -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col2 col-xs-7">
                                                <div class="product-info">
                                                    <h3 class="name"><a href="#">Floral Print Buttoned</a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="product-price"> <span class="price"> $450.99
                                                        </span> </div>
                                                    <!-- /.product-price -->

                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.product-micro-row -->
                                    </div>
                                    <!-- /.product-micro -->

                                </div>
                                <div class="product">
                                    <div class="product-micro">
                                        <div class="row product-micro-row">
                                            <div class="col col-xs-5">
                                                <div class="product-image">
                                                    <div class="image"> <a href="#"> <img
                                                                src="assets/images/products/p21.jpg" alt="">
                                                        </a> </div>
                                                    <!-- /.image -->

                                                </div>
                                                <!-- /.product-image -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col2 col-xs-7">
                                                <div class="product-info">
                                                    <h3 class="name"><a href="#">Floral Print Buttoned</a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="product-price"> <span class="price"> $450.99
                                                        </span> </div>
                                                    <!-- /.product-price -->

                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.product-micro-row -->
                                    </div>
                                    <!-- /.product-micro -->

                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="products best-product">
                                <div class="product">
                                    <div class="product-micro">
                                        <div class="row product-micro-row">
                                            <div class="col col-xs-5">
                                                <div class="product-image">
                                                    <div class="image"> <a href="#"> <img
                                                                src="assets/images/products/p22.jpg" alt="">
                                                        </a> </div>
                                                    <!-- /.image -->

                                                </div>
                                                <!-- /.product-image -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col2 col-xs-7">
                                                <div class="product-info">
                                                    <h3 class="name"><a href="#">Floral Print Buttoned</a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="product-price"> <span class="price"> $450.99
                                                        </span> </div>
                                                    <!-- /.product-price -->

                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.product-micro-row -->
                                    </div>
                                    <!-- /.product-micro -->

                                </div>
                                <div class="product">
                                    <div class="product-micro">
                                        <div class="row product-micro-row">
                                            <div class="col col-xs-5">
                                                <div class="product-image">
                                                    <div class="image"> <a href="#"> <img
                                                                src="assets/images/products/p23.jpg" alt="">
                                                        </a> </div>
                                                    <!-- /.image -->

                                                </div>
                                                <!-- /.product-image -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col2 col-xs-7">
                                                <div class="product-info">
                                                    <h3 class="name"><a href="#">Floral Print Buttoned</a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="product-price"> <span class="price"> $450.99
                                                        </span> </div>
                                                    <!-- /.product-price -->

                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.product-micro-row -->
                                    </div>
                                    <!-- /.product-micro -->

                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="products best-product">
                                <div class="product">
                                    <div class="product-micro">
                                        <div class="row product-micro-row">
                                            <div class="col col-xs-5">
                                                <div class="product-image">
                                                    <div class="image"> <a href="#"> <img
                                                                src="assets/images/products/p24.jpg" alt="">
                                                        </a> </div>
                                                    <!-- /.image -->

                                                </div>
                                                <!-- /.product-image -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col2 col-xs-7">
                                                <div class="product-info">
                                                    <h3 class="name"><a href="#">Floral Print Buttoned</a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="product-price"> <span class="price"> $450.99
                                                        </span> </div>
                                                    <!-- /.product-price -->

                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.product-micro-row -->
                                    </div>
                                    <!-- /.product-micro -->

                                </div>
                                <div class="product">
                                    <div class="product-micro">
                                        <div class="row product-micro-row">
                                            <div class="col col-xs-5">
                                                <div class="product-image">
                                                    <div class="image"> <a href="#"> <img
                                                                src="assets/images/products/p25.jpg" alt="">
                                                        </a> </div>
                                                    <!-- /.image -->

                                                </div>
                                                <!-- /.product-image -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col2 col-xs-7">
                                                <div class="product-info">
                                                    <h3 class="name"><a href="#">Floral Print Buttoned</a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="product-price"> <span class="price"> $450.99
                                                        </span> </div>
                                                    <!-- /.product-price -->

                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.product-micro-row -->
                                    </div>
                                    <!-- /.product-micro -->

                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="products best-product">
                                <div class="product">
                                    <div class="product-micro">
                                        <div class="row product-micro-row">
                                            <div class="col col-xs-5">
                                                <div class="product-image">
                                                    <div class="image"> <a href="#"> <img
                                                                src="assets/images/products/p26.jpg" alt="">
                                                        </a> </div>
                                                    <!-- /.image -->

                                                </div>
                                                <!-- /.product-image -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col2 col-xs-7">
                                                <div class="product-info">
                                                    <h3 class="name"><a href="#">Floral Print Buttoned</a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="product-price"> <span class="price"> $450.99
                                                        </span> </div>
                                                    <!-- /.product-price -->

                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.product-micro-row -->
                                    </div>
                                    <!-- /.product-micro -->

                                </div>
                                <div class="product">
                                    <div class="product-micro">
                                        <div class="row product-micro-row">
                                            <div class="col col-xs-5">
                                                <div class="product-image">
                                                    <div class="image"> <a href="#"> <img
                                                                src="assets/images/products/p27.jpg" alt="">
                                                        </a> </div>
                                                    <!-- /.image -->

                                                </div>
                                                <!-- /.product-image -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col2 col-xs-7">
                                                <div class="product-info">
                                                    <h3 class="name"><a href="#">Floral Print Buttoned</a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="product-price"> <span class="price"> $450.99
                                                        </span> </div>
                                                    <!-- /.product-price -->

                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.product-micro-row -->
                                    </div>
                                    <!-- /.product-micro -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.sidebar-widget-body -->
            </div>
            <!-- /.sidebar-widget -->
            <!-- ============================================== BEST SELLER : END ============================================== -->

            <!-- ============================================== BLOG SLIDER ============================================== -->
            <section class="section latest-blog outer-bottom-vs wow fadeInUp">
                <h3 class="section-title">latest form blog</h3>
                <div class="blog-slider-container outer-top-xs">
                    <div class="owl-carousel blog-slider custom-carousel">
                        <div class="item">
                            <div class="blog-post">
                                <div class="blog-post-image">
                                    <div class="image"> <a href="blog.html"><img
                                                src="assets/images/blog-post/post1.jpg" alt=""></a> </div>
                                </div>
                                <!-- /.blog-post-image -->

                                <div class="blog-post-info text-left">
                                    <h3 class="name"><a href="#">Voluptatem accusantium doloremque
                                            laudantium</a></h3>
                                    <span class="info">By Jone Doe &nbsp;|&nbsp; 21 March 2016 </span>
                                    <p class="text">Sed quia non numquam eius modi tempora incidunt ut labore et
                                        dolore magnam aliquam quaerat voluptatem.</p>
                                    <a href="#" class="lnk btn btn-primary">Read more</a>
                                </div>
                                <!-- /.blog-post-info -->

                            </div>
                            <!-- /.blog-post -->
                        </div>
                        <!-- /.item -->

                        <div class="item">
                            <div class="blog-post">
                                <div class="blog-post-image">
                                    <div class="image"> <a href="blog.html"><img
                                                src="assets/images/blog-post/post2.jpg" alt=""></a> </div>
                                </div>
                                <!-- /.blog-post-image -->

                                <div class="blog-post-info text-left">
                                    <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla
                                            pariatur</a></h3>
                                    <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                    <p class="text">Sed quia non numquam eius modi tempora incidunt ut labore et
                                        dolore magnam aliquam quaerat voluptatem.</p>
                                    <a href="#" class="lnk btn btn-primary">Read more</a>
                                </div>
                                <!-- /.blog-post-info -->

                            </div>
                            <!-- /.blog-post -->
                        </div>
                        <!-- /.item -->

                        <!-- /.item -->

                        <div class="item">
                            <div class="blog-post">
                                <div class="blog-post-image">
                                    <div class="image"> <a href="blog.html"><img
                                                src="assets/images/blog-post/post1.jpg" alt=""></a> </div>
                                </div>
                                <!-- /.blog-post-image -->

                                <div class="blog-post-info text-left">
                                    <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla
                                            pariatur</a></h3>
                                    <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                    <p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                        accusantium</p>
                                    <a href="#" class="lnk btn btn-primary">Read more</a>
                                </div>
                                <!-- /.blog-post-info -->

                            </div>
                            <!-- /.blog-post -->
                        </div>
                        <!-- /.item -->

                        <div class="item">
                            <div class="blog-post">
                                <div class="blog-post-image">
                                    <div class="image"> <a href="blog.html"><img
                                                src="assets/images/blog-post/post2.jpg" alt=""></a> </div>
                                </div>
                                <!-- /.blog-post-image -->

                                <div class="blog-post-info text-left">
                                    <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla
                                            pariatur</a></h3>
                                    <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                    <p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                        accusantium</p>
                                    <a href="#" class="lnk btn btn-primary">Read more</a>
                                </div>
                                <!-- /.blog-post-info -->

                            </div>
                            <!-- /.blog-post -->
                        </div>
                        <!-- /.item -->

                        <div class="item">
                            <div class="blog-post">
                                <div class="blog-post-image">
                                    <div class="image"> <a href="blog.html"><img
                                                src="assets/images/blog-post/post1.jpg" alt=""></a> </div>
                                </div>
                                <!-- /.blog-post-image -->

                                <div class="blog-post-info text-left">
                                    <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla
                                            pariatur</a></h3>
                                    <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                    <p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                        accusantium</p>
                                    <a href="#" class="lnk btn btn-primary">Read more</a>
                                </div>
                                <!-- /.blog-post-info -->

                            </div>
                            <!-- /.blog-post -->
                        </div>
                        <!-- /.item -->

                    </div>
                    <!-- /.owl-carousel -->
                </div>
                <!-- /.blog-slider-container -->
            </section>
            <!-- /.section -->
            <!-- ============================================== BLOG SLIDER : END ============================================== -->

            <!-- ============================================== FEATURED PRODUCTS ============================================== -->
            <section class="section wow fadeInUp new-arriavls">
                <h3 class="section-title">New Arrivals</h3>
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                    <div class="item item-carousel">
                        <div class="products">
                            <div class="product">
                                <div class="product-image">
                                    <div class="image"> <a href="detail.html"><img
                                                src="assets/images/products/p19.jpg" alt=""></a> </div>
                                    <!-- /.image -->

                                    <div class="tag new"><span>new</span></div>
                                </div>
                                <!-- /.product-image -->

                                <div class="product-info text-left">
                                    <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                    <div class="rating rateit-small"></div>
                                    <div class="description"></div>
                                    <div class="product-price"> <span class="price"> $450.99 </span> <span
                                            class="price-before-discount">$ 800</span> </div>
                                    <!-- /.product-price -->

                                </div>
                                <!-- /.product-info -->
                                <div class="cart clearfix animate-effect">
                                    <div class="action">
                                        <ul class="list-unstyled">
                                            <li class="add-cart-button btn-group">
                                                <button class="btn btn-primary icon" data-toggle="dropdown"
                                                    type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                <button class="btn btn-primary cart-btn" type="button">Add to
                                                    cart</button>
                                            </li>
                                            <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                    title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                            <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                    title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i>
                                                </a> </li>
                                        </ul>
                                    </div>
                                    <!-- /.action -->
                                </div>
                                <!-- /.cart -->
                            </div>
                            <!-- /.product -->

                        </div>
                        <!-- /.products -->
                    </div>
                    <!-- /.item -->

                    <div class="item item-carousel">
                        <div class="products">
                            <div class="product">
                                <div class="product-image">
                                    <div class="image"> <a href="detail.html"><img
                                                src="assets/images/products/p28.jpg" alt=""></a> </div>
                                    <!-- /.image -->

                                    <div class="tag new"><span>new</span></div>
                                </div>
                                <!-- /.product-image -->

                                <div class="product-info text-left">
                                    <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                    <div class="rating rateit-small"></div>
                                    <div class="description"></div>
                                    <div class="product-price"> <span class="price"> $450.99 </span> <span
                                            class="price-before-discount">$ 800</span> </div>
                                    <!-- /.product-price -->

                                </div>
                                <!-- /.product-info -->
                                <div class="cart clearfix animate-effect">
                                    <div class="action">
                                        <ul class="list-unstyled">
                                            <li class="add-cart-button btn-group">
                                                <button class="btn btn-primary icon" data-toggle="dropdown"
                                                    type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                <button class="btn btn-primary cart-btn" type="button">Add to
                                                    cart</button>
                                            </li>
                                            <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                    title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                            <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                    title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i>
                                                </a> </li>
                                        </ul>
                                    </div>
                                    <!-- /.action -->
                                </div>
                                <!-- /.cart -->
                            </div>
                            <!-- /.product -->

                        </div>
                        <!-- /.products -->
                    </div>
                    <!-- /.item -->

                    <div class="item item-carousel">
                        <div class="products">
                            <div class="product">
                                <div class="product-image">
                                    <div class="image"> <a href="detail.html"><img
                                                src="assets/images/products/p30.jpg" alt=""></a> </div>
                                    <!-- /.image -->

                                    <div class="tag hot"><span>hot</span></div>
                                </div>
                                <!-- /.product-image -->

                                <div class="product-info text-left">
                                    <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                    <div class="rating rateit-small"></div>
                                    <div class="description"></div>
                                    <div class="product-price"> <span class="price"> $450.99 </span> <span
                                            class="price-before-discount">$ 800</span> </div>
                                    <!-- /.product-price -->

                                </div>
                                <!-- /.product-info -->
                                <div class="cart clearfix animate-effect">
                                    <div class="action">
                                        <ul class="list-unstyled">
                                            <li class="add-cart-button btn-group">
                                                <button class="btn btn-primary icon" data-toggle="dropdown"
                                                    type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                <button class="btn btn-primary cart-btn" type="button">Add to
                                                    cart</button>
                                            </li>
                                            <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                    title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                            <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                    title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i>
                                                </a> </li>
                                        </ul>
                                    </div>
                                    <!-- /.action -->
                                </div>
                                <!-- /.cart -->
                            </div>
                            <!-- /.product -->

                        </div>
                        <!-- /.products -->
                    </div>
                    <!-- /.item -->

                    <div class="item item-carousel">
                        <div class="products">
                            <div class="product">
                                <div class="product-image">
                                    <div class="image"> <a href="detail.html"><img
                                                src="assets/images/products/p1.jpg" alt=""></a> </div>
                                    <!-- /.image -->

                                    <div class="tag hot"><span>hot</span></div>
                                </div>
                                <!-- /.product-image -->

                                <div class="product-info text-left">
                                    <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                    <div class="rating rateit-small"></div>
                                    <div class="description"></div>
                                    <div class="product-price"> <span class="price"> $450.99 </span> <span
                                            class="price-before-discount">$ 800</span> </div>
                                    <!-- /.product-price -->

                                </div>
                                <!-- /.product-info -->
                                <div class="cart clearfix animate-effect">
                                    <div class="action">
                                        <ul class="list-unstyled">
                                            <li class="add-cart-button btn-group">
                                                <button class="btn btn-primary icon" data-toggle="dropdown"
                                                    type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                <button class="btn btn-primary cart-btn" type="button">Add to
                                                    cart</button>
                                            </li>
                                            <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                    title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                            <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                    title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i>
                                                </a> </li>
                                        </ul>
                                    </div>
                                    <!-- /.action -->
                                </div>
                                <!-- /.cart -->
                            </div>
                            <!-- /.product -->

                        </div>
                        <!-- /.products -->
                    </div>
                    <!-- /.item -->

                    <div class="item item-carousel">
                        <div class="products">
                            <div class="product">
                                <div class="product-image">
                                    <div class="image"> <a href="detail.html"><img
                                                src="assets/images/products/p2.jpg" alt=""></a> </div>
                                    <!-- /.image -->

                                    <div class="tag sale"><span>sale</span></div>
                                </div>
                                <!-- /.product-image -->

                                <div class="product-info text-left">
                                    <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                    <div class="rating rateit-small"></div>
                                    <div class="description"></div>
                                    <div class="product-price"> <span class="price"> $450.99 </span> <span
                                            class="price-before-discount">$ 800</span> </div>
                                    <!-- /.product-price -->

                                </div>
                                <!-- /.product-info -->
                                <div class="cart clearfix animate-effect">
                                    <div class="action">
                                        <ul class="list-unstyled">
                                            <li class="add-cart-button btn-group">
                                                <button class="btn btn-primary icon" data-toggle="dropdown"
                                                    type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                <button class="btn btn-primary cart-btn" type="button">Add to
                                                    cart</button>
                                            </li>
                                            <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                    title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                            <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                    title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i>
                                                </a> </li>
                                        </ul>
                                    </div>
                                    <!-- /.action -->
                                </div>
                                <!-- /.cart -->
                            </div>
                            <!-- /.product -->

                        </div>
                        <!-- /.products -->
                    </div>
                    <!-- /.item -->

                    <div class="item item-carousel">
                        <div class="products">
                            <div class="product">
                                <div class="product-image">
                                    <div class="image"> <a href="detail.html"><img
                                                src="assets/images/products/p3.jpg" alt=""></a> </div>
                                    <!-- /.image -->

                                    <div class="tag sale"><span>sale</span></div>
                                </div>
                                <!-- /.product-image -->

                                <div class="product-info text-left">
                                    <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                    <div class="rating rateit-small"></div>
                                    <div class="description"></div>
                                    <div class="product-price"> <span class="price"> $450.99 </span> <span
                                            class="price-before-discount">$ 800</span> </div>
                                    <!-- /.product-price -->

                                </div>
                                <!-- /.product-info -->
                                <div class="cart clearfix animate-effect">
                                    <div class="action">
                                        <ul class="list-unstyled">
                                            <li class="add-cart-button btn-group">
                                                <button class="btn btn-primary icon" data-toggle="dropdown"
                                                    type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                <button class="btn btn-primary cart-btn" type="button">Add to
                                                    cart</button>
                                            </li>
                                            <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                    title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                            <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                    title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i>
                                                </a> </li>
                                        </ul>
                                    </div>
                                    <!-- /.action -->
                                </div>
                                <!-- /.cart -->
                            </div>
                            <!-- /.product -->

                        </div>
                        <!-- /.products -->
                    </div>
                    <!-- /.item -->
                </div>
                <!-- /.home-owl-carousel -->
            </section>
            <!-- /.section -->
            <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->
        </div>
        <!-- /.homebanner-holder -->

    </div>

    </div>
    <!-- ============================================== CONTENT : END ============================================== -->
    </div>
    <!-- /.row -->
    <!-- ============================================== BRANDS CAROUSEL ============================================== -->
    <div id="brands-carousel" class="logo-slider wow fadeInUp">
        <div class="logo-slider-inner">
            <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                <div class="item m-t-15"> <a href="#" class="image"> <img
                            data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
                    </a> </div>
                <!--/.item-->

                <div class="item m-t-10"> <a href="#" class="image"> <img
                            data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
                    </a> </div>
                <!--/.item-->

                <div class="item"> <a href="#" class="image"> <img
                            data-echo="assets/images/brands/brand3.png" src="assets/images/blank.gif" alt="">
                    </a> </div>
                <!--/.item-->

                <div class="item"> <a href="#" class="image"> <img
                            data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
                    </a> </div>
                <!--/.item-->

                <div class="item"> <a href="#" class="image"> <img
                            data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
                    </a> </div>
                <!--/.item-->

                <div class="item"> <a href="#" class="image"> <img
                            data-echo="assets/images/brands/brand6.png" src="assets/images/blank.gif" alt="">
                    </a> </div>
                <!--/.item-->

                <div class="item"> <a href="#" class="image"> <img
                            data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
                    </a> </div>
                <!--/.item-->

                <div class="item"> <a href="#" class="image"> <img
                            data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
                    </a> </div>
                <!--/.item-->

                <div class="item"> <a href="#" class="image"> <img
                            data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
                    </a> </div>
                <!--/.item-->

                <div class="item"> <a href="#" class="image"> <img
                            data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
                    </a> </div>
                <!--/.item-->
            </div>
            <!-- /.owl-carousel #logo-slider -->
        </div>
        <!-- /.logo-slider-inner -->

    </div>
    <!-- /.logo-slider -->
    <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div>
    <!-- /.container -->
    </div>
    <!-- /#top-banner-and-menu -->
    <!-- ============================================== Product Modal ============================================== -->
    <x-frontend.partials.product_modal />
    <!-- ============================================== End Product Modal ============================================== -->
</x-frontend.layouts.master>
