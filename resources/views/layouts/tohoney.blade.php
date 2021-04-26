<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('tohoney_assets')}}/images/favicon.png">
    <!-- Place favicon.ico in the root directory -->
    <!-- all css here -->
    <!-- bootstrap v4.0.0-beta.2 css -->
    <link rel="stylesheet" href=" {{asset('tohoney_assets/css/bootstrap.min.css')}} ">
    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <link rel="stylesheet" href=" {{asset('tohoney_assets/css/owl.carousel.min.css')}} ">
    <!-- font-awesome v4.6.3 css -->
    <link rel="stylesheet" href=" {{asset('tohoney_assets/css/font-awesome.min.css')}} ">
    <!-- flaticon.css -->
    <link rel="stylesheet" href=" {{asset('tohoney_assets/css/flaticon.css')}} ">
    <!-- jquery-ui.css -->
    <link rel="stylesheet" href=" {{asset('tohoney_assets/css/jquery-ui.css')}} ">
    <!-- metisMenu.min.css -->
    <link rel="stylesheet" href=" {{asset('tohoney_assets/css/metisMenu.min.css')}} ">
    <!-- swiper.min.css -->
    <link rel="stylesheet" href=" {{asset('tohoney_assets/css/swiper.min.css')}} ">
    <!-- style css -->
    <link rel="stylesheet" href=" {{asset('tohoney_assets/css/styles.css')}} ">
    <!-- responsive css -->
    <link rel="stylesheet" href=" {{asset('tohoney_assets/css/responsive.css')}} ">
    <!-- modernizr css -->
    <script src=" {{asset('tohoney_assets/js/vendor/modernizr-2.8.3.min.js')}} "></script> 
    <!-- Select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <!--Start Preloader-->
    <div class="preloader-wrap">
        <div class="spinner"></div>
    </div>
<!-- search-form here -->
    <div class="search-area flex-style">
        <span class="closebar">Close</span>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 col-12">
                    <div class="search-form">
                        <form action="#">
                            <input type="text" placeholder="Search Here...">
                            <button><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- search-form here -->
    <!-- header-area start -->
    <header class="header-area">
        <div class="header-top bg-2">
            <div class="fluid-container">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <ul class="d-flex header-contact">
                            @if ( App\Models\Setting::where('setting_name','phone_Number')->first()->setting_value )
                            <li>
                                <i class="fa fa-phone"></i> {{ App\Models\Setting::where('setting_name','phone_Number')->first()->setting_value }}
                            </li>
                            @endif
                            @if ( App\Models\Setting::where('setting_name','email_address')->first()->setting_value )
                            <li>
                                <i class="fa fa-envelope"></i> {{ App\Models\Setting::where('setting_name','email_address')->first()->setting_value }}
                            </li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-md-6 col-12">
                        <ul class="d-flex account_login-area">
                            <li>
                                <a href="javascript:void(0);"><i class="fa fa-link">
                                    </i> Page Link <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown_style">
                                    <li><a href="{{ route('customer_login') }}">Login</a></li>
                                    <li><a href="{{ route('customer_register') }}">Register</a></li>
                                    <li><a href="{{ route('cart') }}">Cart</a></li>
                                    <li><a href="{{ route('checkout') }}">Checkout</a></li>
                                    {{-- <li><a href="wishlist.html">wishlist</a></li> --}}
                                </ul>
                            </li>
                                @auth
                                <li>
                                    <a href="javascript:void(0);">
                                        <i class="fa fa-user"></i> {{ Auth::user()->name }}<i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown_style">
                                        <li>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fa fa-power-off"></i>&nbsp;&nbsp;Sign Out
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                <li> <a href="{{ route('home') }}">Your Dashbroad</a></li>
                                @else
                                <li><a href="{{ route('customer_login') }}"> Login/Register </a></li>
                                @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="fluid-container">
                <div class="row">
                    <div class="col-lg-3 col-md-7 col-sm-6 col-6">
                        <div class="logo">
                            <a href="{{route('tohoney_home')}}">
                        <img src="{{asset('tohoney_assets')}}/images/logo.png" alt="logo">
                        </a>
                        </div>
                    </div>
                    <div class="col-lg-7 d-none d-lg-block">
                        <nav class="mainmenu">
                            <ul class="d-flex">
                                <li class="active"><a href="{{route('tohoney_home')}}">Home</a></li>
                                <li><a href="{{route('about')}}">About</a></li>
                                <li><a href="{{route('shop')}}">Shop</a></li>
                                {{-- <li>
                                    <a href="javascript:void(0);">Shop <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown_style">
                                        <li><a href="shop.html">Shop Page</a></li>
                                        <li><a href="single-product.html">Product Details</a></li>
                                        <li><a href="cart.html">Shopping cart</a></li>
                                        <li><a href="checkout.html">Checkout</a></li>
                                        <li><a href="wishlist.html">Wishlist</a></li>
                                        <li><a href="faq.html">FAQ</a></li>
                                    </ul>
                                </li> --}}
                                <li>
                                    <a href="javascript:void(0);">Blog <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown_style">
                                        <li><a href="blog.html">blog Page</a></li>
                                        <li><a href="blog-details.html">blog Details</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{route('contact')}}">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-4 col-lg-2 col-sm-5 col-4">
                        <ul class="search-cart-wrapper d-flex">
                            <li class="search-tigger"><a href="javascript:void(0);"><i class="flaticon-search"></i></a></li>
                            <li>
                                <a href="javascript:void(0);"><i class="flaticon-like"></i> <span>2</span></a>
                                <ul class="cart-wrap dropdown_style">
                                    <li class="cart-items">
                                        <div class="cart-img">
                                            <img src="{{asset('tohoney_assets')}}/images/cart/1.jpg" alt="">
                                        </div>
                                        <div class="cart-content">
                                            <a href="cart.html">Pure Nature Product</a>
                                            <span>QTY : 1</span>
                                            <p>$35.00</p>
                                            <i class="fa fa-times"></i>
                                        </div>
                                    </li>
                                    <li class="cart-items">
                                        <div class="cart-img">
                                            <img src="{{asset('tohoney_assets')}}/images/cart/3.jpg" alt="">
                                        </div>
                                        <div class="cart-content">
                                            <a href="cart.html">Pure Nature Product</a>
                                            <span>QTY : 1</span>
                                            <p>$35.00</p>
                                            <i class="fa fa-times"></i>
                                        </div>
                                    </li>
                                    <li>Subtotol: <span class="pull-right">$70.00</span></li>
                                    <li>
                                        <button>Check Out</button>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                @php
                                    $carts = App\Models\Cart::where('ip_address', request()->ip())->get();
                                    $subtotal = 0;
                                @endphp
                                <a href="javascript:void(0);"><i class="flaticon-shop"></i> <span>{{ $carts->count() }}</span></a>
                                <ul class="cart-wrap dropdown_style">
                                    @foreach ($carts as $cart)
                                        @if (isset(App\Models\Product::find($cart->product_id)->id))
                                        <li class="cart-items">
                                            <div class="cart-img">
                                                <img src="{{asset('uploads/product')}}/{{ App\Models\Product::find($cart->product_id)->product_image }}" alt="not-found" style="width: 70px">
                                            </div> 
                                            <div class="cart-content">
                                                <a href="{{route('product_details', $cart->product_id)}}">{{ App\Models\Product::find($cart->product_id)->product_name }}</a>

                                                <span>QTY : {{ $cart->quantity }}</span>

                                                <p>${{ App\Models\Product::find($cart->product_id)->product_price * $cart->quantity}}</p>
                                                @php
                                                    $subtotal += App\Models\Product::find($cart->product_id)->product_price * $cart->quantity;
                                                @endphp
                                                <a href="{{ route('cartdelete', $cart->id) }}">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                        </li>
                                        @else
                                        <li class="cart-items">
                                            <div class="cart-img">
                                                <img src="" alt="not-found" style="width: 70px">
                                            </div> 
                                            <div class="cart-content">
                                                <h6>Product Deleted</h6>

                                                <span>QTY : Null</span>

                                                <p>$0</p>
                                                @php
                                                    $subtotal += 0
                                                @endphp
                                                <a href="{{ route('cartdelete', $cart->id) }}">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                        </li>
                                        @endif
                                    @endforeach
                                    <li>Subtotol: <span class="pull-right">${{ $subtotal }}</span></li>
                                    <li>
                                        <a href="{{ route('cart') }}" class="btn btn-danger">Go Cart Page</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-1 col-sm-1 col-2 d-block d-lg-none">
                        <div class="responsive-menu-tigger">
                            <a href="javascript:void(0);">
                        <span class="first"></span>
                        <span class="second"></span>
                        <span class="third"></span>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- responsive-menu area start -->
            <div class="responsive-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-block d-lg-none">
                            <ul class="metismenu">
                                <li><a href="{{route('tohoney_home')}}">Home</a></li>
                                <li><a href="{{route('about')}}">About</a></li>
                                <li><a href="{{route('shop')}}">Shop</a></li>
                                {{-- <li class="sidemenu-items">
                                    <a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Shop </a>
                                    <ul aria-expanded="false">
                                        <li><a href="shop.html">Shop Page</a></li>
                                        <li><a href="single-product.html">Product Details</a></li>
                                        <li><a href="cart.html">Shopping cart</a></li>
                                        <li><a href="checkout.html">Checkout</a></li>
                                        <li><a href="wishlist.html">Wishlist</a></li>
                                        <li><a href="faq.html">FAQ</a></li>
                                    </ul>
                                </li> --}}
                                <li class="sidemenu-items">
                                    <a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Blog</a>
                                    <ul aria-expanded="false">
                                        <li><a href="blog.html">Blog</a></li>
                                        <li><a href="blog-details.html">Blog Details</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{route('contact')}}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- responsive-menu area start -->
        </div>
    </header>
    <!-- header-area end -->

    @yield('body')


    <!-- start social-newsletter-section -->
    <section class="social-newsletter-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="newsletter text-center">
                        <h3>Subscribe  Newsletter</h3>
                        <div class="newsletter-form">
                            <form>
                                <input type="text" class="form-control" placeholder="Enter Your Email Address...">
                                <button type="submit"><i class="fa fa-send"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end container -->
    </section>
    <!-- end social-newsletter-section -->
    <!-- .footer-area start -->
    <div class="footer-area">
        <div class="footer-top">
            <div class="container">
                <div class="footer-top-item">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="footer-top-text text-center">
                                <ul>
                                    <li><a href="{{ route('tohoney_home') }}">home</a></li>
                                    <li><a href="#">our story</a></li>
                                    <li><a href="#">feed shop</a></li>
                                    <li><a href="blog.html">how to eat blog</a></li>
                                    <li><a href="{{route('contact')}}">contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-12">
                        <div class="footer-icon">
                            <ul class="d-flex">
                            @if ( App\Models\Setting::where('setting_name','facebook_link')->first()->setting_value )
                            <li>
                                <a href="{{ App\Models\Setting::where('setting_name','facebook_link')->first()->setting_value }}"><i class="fa fa-facebook"></i></a>
                            </li>
                            @endif
                            @if ( App\Models\Setting::where('setting_name','twitter_link')->first()->setting_value )
                            <li>
                                <a href="{{ App\Models\Setting::where('setting_name','twitter_link')->first()->setting_value }}"><i class="fa fa-twitter"></i></a>
                            </li>
                            @endif
                            @if ( App\Models\Setting::where('setting_name','linkedin_link')->first()->setting_value )
                            <li>
                                <a href="{{ App\Models\Setting::where('setting_name','linkedin_link')->first()->setting_value }}"><i class="fa fa-linkedin"></i></a>
                            </li>
                            @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-8 col-sm-12">
                        <div class="footer-content">
                            @if ( App\Models\Setting::where('setting_name','footer_short_description')->first()->setting_value )
                            <p>{{ App\Models\Setting::where('setting_name','footer_short_description')->first()->setting_value }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-8 col-sm-12">
                        <div class="footer-adress">
                            <ul>
                            @if ( App\Models\Setting::where('setting_name','phone_Number')->first()->setting_value )
                            <li>
                                <span>Email: </span>{{ App\Models\Setting::where('setting_name','phone_Number')->first()->setting_value }}
                            </li>
                            @endif
                            @if ( App\Models\Setting::where('setting_name','email_address')->first()->setting_value )
                            <li>
                                <span>Phone Number: </span>{{ App\Models\Setting::where('setting_name','email_address')->first()->setting_value }}
                            </li>
                            @endif
                            @if ( App\Models\Setting::where('setting_name','address')->first()->setting_value )
                            <li>
                                <span>Address: </span>{{ App\Models\Setting::where('setting_name','address')->first()->setting_value }}
                            </li>
                            @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <div class="footer-reserved">
                            <ul>
                                <li>Copyright © {{ Carbon\Carbon::now()->format('Y') }} Tohoney All rights reserved.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .footer-area end -->
    <!-- jquery latest version -->
    <script src="{{asset('tohoney_assets/js/vendor/jquery-2.2.4.min.js')}}"></script>
    <!-- bootstrap js -->
    <script src="{{asset('tohoney_assets/js/bootstrap.min.js')}}"></script>
    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <script src="{{asset('tohoney_assets/js/owl.carousel.min.js')}}"></script>
    <!-- scrollup.js -->
    <script src="{{asset('tohoney_assets/js/scrollup.js')}}"></script>
    <!-- isotope.pkgd.min.js -->
    <script src="{{asset('tohoney_assets/js/isotope.pkgd.min.js')}}"></script>
    <!-- imagesloaded.pkgd.min.js -->
    <script src="{{asset('tohoney_assets/js/imagesloaded.pkgd.min.js')}}"></script>
    <!-- jquery.zoom.min.js -->
    <script src="{{asset('tohoney_assets/js/jquery.zoom.min.js')}}"></script>
    <!-- countdown.js -->
    <script src="{{asset('tohoney_assets/js/countdown.js')}}"></script>
    <!-- swiper.min.js -->
    <script src="{{asset('tohoney_assets/js/swiper.min.js')}}"></script>
    <!-- metisMenu.min.js -->
    <script src="{{asset('tohoney_assets/js/metisMenu.min.js')}}"></script>
    <!-- mailchimp.js -->
    <script src="{{asset('tohoney_assets/js/mailchimp.js')}}"></script>
    <!-- jquery-ui.min.js -->
    <script src="{{asset('tohoney_assets/js/jquery-ui.min.js')}}"></script>
    <!-- main js -->
    <script src="{{asset('tohoney_assets/js/scripts.js')}}"></script>
    <!-- select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
     @yield('tohoney_script')
</body>

</html>