<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="robots" content="index, follow" />
    <title> @if(Route::is('frontend'))   Home @elseif(Route::is('frontend.product')) Products @elseif(Route::is('frontend.product.single')) {{ $product->name }} @elseif(Route::is('frontend.wishlist.index')) Wishlist @elseif(Route::is('cart.index')) Carts @elseif(Route::is('checkout.index')) Checkout @elseif(Route::is('my-account.index')) Profile @elseif(Route::is('my-account.personal.information.edit')) Update Profile @elseif(Route::is('my-account.orders')) Orders @elseif(Route::is('my-account.delivered.order')) Delevered Orders @elseif(Route::is('my-account.orders.track')) Track Orders @elseif(Route::is('login'))Login @endif | {{ basicSettings()->site_title }}</title>
    <meta name="description" content="{{ basicSettings()->tagline }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Add site Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon/'.basicSettings()->icon) }}" type="image/png">


    <!-- vendor css (Icon Font) -->
    <!-- <link rel="stylesheet" href="assets/css/vendor/bootstrap.bundle.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="assets/css/vendor/font.awesome.css" /> -->

    <!-- plugins css (All Plugins Files) -->
    <!-- <link rel="stylesheet" href="assets/css/plugins/animate.css" />
    <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/jquery-ui.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/nice-select.css" />
    <link rel="stylesheet" href="assets/css/plugins/venobox.css" /> -->

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/vendor.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/plugins.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css')}}">
    @yield('inline_style')
    <!-- Main Style -->
    <!-- <link rel="stylesheet" href="assets/css/style.css" /> -->

</head>

<body>

    <!-- Top Bar -->

    <div class="header-to-bar"> HELLO EVERYONE! 25% Off All Products </div>

    <!-- Top Bar -->
   <!-- Header Area Start -->
    <header>
        <div class="header-main sticky-nav ">
            <div class="container position-relative">
                <div class="row">
                    <div class="col-auto align-self-center">
                        <div class="header-logo">
                            <a href="{{ route('frontend') }}"><img src="{{ asset('assets/images/logo/'.basicSettings()->logo) }}" alt="{{ basicSettings()->site_title }}" /></a>
                        </div>
                    </div>
                    <div class="col align-self-center d-none d-lg-block">
                        <div class="main-menu">
                            <ul>
                                <li class="dropdown"><a href="{{ route('frontend') }}">Home </a>
                                </li>
                                <li class="dropdown position-static">
                                    <a href="{{ route('frontend.product') }}">Products </a>
                                </li>
                                <li class="dropdown "><a href="#">Blogs <i class="pe-7s-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="#">Blog Grid Page</a></li>
                                        <li><a href="#">Blog Single Page</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Contact us</a></li>
                                @auth
                                    <li class="dropdown "><a href="javascript:void(0)">Welcome, {{ Auth::user()->name }} <i class="pe-7s-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            @if (auth()->user()->roles->first()->name == 'Customer')
                                                <li><a href="{{ route('my-account.index') }}">Profile</a></li>
                                                <li><a href="{{ route('my-account.orders') }}">My Orders</a></li>
                                                <li><a href="{{ route('my-account.orders.track') }}">Track Order</a></li>
                                                <li><a href="#">Security</a></li>
                                            @else
                                                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>

                                            @endif
                                            <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                                                @csrf
                                            </form>
                                            <li><a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">Logout</a></li>

                                        </ul>
                                    </li>
                                @else
                                <li class="dropdown "><a href="{{ route('login') }}">Login</a></li>

                                @endauth
                            </ul>
                        </div>
                    </div>
                    <!-- Header Action Start -->
                    <doffcanvas-menu mb-4iv class="col col-lg-auto align-self-center pl-0">
                        <div class="header-actions">

                            <!-- Single Wedge Start -->
                            <a href="#" class="header-action-btn" data-bs-toggle="modal" data-bs-target="#searchActive">
                                <i class="pe-7s-search"></i>
                            </a>
                            <!-- Single Wedge End -->
                            <!-- Single Wedge Start -->
                            <a href="#offcanvas-wishlist" class="header-action-btn offcanvas-toggle">
                                <i class="pe-7s-like"></i>
                                <span class="header-action-num">{{ wishlistItem()->count() }}</span>
                            </a>
                            <!-- Single Wedge End -->
                            <a href="#offcanvas-cart"
                                class="header-action-btn header-action-btn-cart offcanvas-toggle pr-0">
                                <i class="pe-7s-shopbag"></i>
                                <span class="header-action-num">{{ cartsItem()->count() }}</span>
                                <!-- <span class="cart-amount">€30.00</span> -->
                            </a>
                            <a href="#offcanvas-mobile-menu"
                                class="header-action-btn header-action-btn-menu offcanvas-toggle d-lg-none">
                                <i class="pe-7s-menu"></i>
                            </a>
                        </div>
                        <!-- Header Action End -->
                    </doffcanvas-menu>
                </div>
            </div>
    </header>
    <!-- Header Area End -->
     <div class="offcanvas-overlay"></div>

    <!-- OffCanvas Wishlist Start -->
    <div id="offcanvas-wishlist" class="offcanvas offcanvas-wishlist">
        <div class="inner">
            <div class="head">
                <span class="title">Wishlist</span>
                <button class="offcanvas-close">×</button>
            </div>
            <div class="body customScroll">
                <ul class="minicart-product-list">

                    @forelse (wishlistItem() as $wishlist)
                    <li>
                        <a href="single-product.html" class="image"><img src="{{ asset('assets/images/product').'/'.$wishlist->product->created_at->format('Y/m/d/').$wishlist->product->id.'/thumbnail/'.$wishlist->product->thumbnail }}" alt="{{ $wishlist->product->name }}"
                                alt="Cart product Image"></a>
                        <div class="content">
                            @php
                                $offer_price = App\Models\Product_Attribute::where('product_id',$wishlist->product_id)->min('offer_price');
                            @endphp
                            <a href="single-product.html" class="title">{{ $wishlist->product->name }}</a>

                            <span class="quantity-price">{{ $wishlist->quantity }} x <span class="amount">৳{{ $offer_price }}</span></span>
                            <a href="#" class="remove">×</a>
                        </div>
                    </li>
                    @empty
                        <li class="bg-gray p-3 rounded"> <span class="lead"> <i class="fa fa-exclamation-circle"></i>  No wishlist to show!
                        </span></li>
                    @endforelse

                </ul>
            </div>
            <div class="foot">
                <div class="buttons">
                    <a href="{{ route('frontend.wishlist.index') }}" class="btn btn-dark btn-hover-primary mt-30px">view wishlist</a>
                </div>
            </div>
        </div>
    </div>
    <!-- OffCanvas Wishlist End -->
    <!-- OffCanvas Cart Start -->
    <div id="offcanvas-cart" class="offcanvas offcanvas-cart">
        <div class="inner">
            <div class="head">
                <span class="title">Cart</span>
                <button class="offcanvas-close">×</button>
            </div>
            <div class="body customScroll">
                <ul class="minicart-product-list">

                    @forelse (cartsItem() as $cart)
                    <li>
                        <a href="single-product.html" class="image"><img src="{{ asset('assets/images/product').'/'.$cart->product->created_at->format('Y/m/d/').$cart->product->id.'/thumbnail/'.$cart->product->thumbnail }}" alt="{{ $cart->product->name }}"
                                alt="Cart product Image"></a>
                        <div class="content">
                            @php
                                $offer_price = App\Models\Product_Attribute::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->first()->offer_price;
                            @endphp
                            <a href="single-product.html" class="title">{{ $cart->product->name }}</a>

                            <span class="quantity-price">{{ $cart->quantity }} x <span class="amount">৳{{ $offer_price }}</span></span>
                            <a href="#" class="remove">×</a>
                        </div>
                    </li>
                    @empty
                        <li class="bg-gray p-3 rounded"> <span class="lead"> <i class="fa fa-exclamation-circle"></i>  No carts to show!
                        </span></li>
                    @endforelse

                </ul>
            </div>
            <div class="foot">
                <div class="buttons mt-30px">
                    <a href="{{ route('cart.index') }}" class="btn btn-dark btn-hover-primary mb-30px">view cart</a>
                </div>
            </div>
        </div>
    </div>
    <!-- OffCanvas Cart End -->

    <!-- OffCanvas Menu Start -->
    <div id="offcanvas-mobile-menu" class="offcanvas offcanvas-mobile-menu">
        <button class="offcanvas-close"></button>

        <div class="inner customScroll">

            <div class="offcanvas-menu mb-4">
                <ul>
                    <li class="dropdown"><a href="{{ route('frontend') }}">Home </a>
                    </li>
                    <li class="dropdown position-static">
                        <a href="{{ route('frontend.product') }}">Products </a>
                    </li>
                    <li class="dropdown "><a href="#">Blogs <i class="pe-7s-angle-down"></i></a>
                        <ul class="sub-menu">
                            <li><a href="#">Blog Grid Page</a></li>
                            <li><a href="#">Blog Single Page</a></li>
                        </ul>
                    </li>
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Contact us</a></li>
                    @auth
                        <li class="dropdown "><a href="javascript:void(0)">Welcome, {{ Auth::user()->name }} <i class="pe-7s-angle-down"></i></a>
                            <ul class="sub-menu">
                                @if (auth()->user()->roles->first()->name == 'Customer')
                                    <li><a href="{{ route('my-account.index') }}">Profile</a></li>
                                    <li><a href="{{ route('my-account.orders') }}">My Orders</a></li>
                                    <li><a href="{{ route('my-account.orders.track') }}">Track Order</a></li>
                                    <li><a href="#">Security</a></li>
                                @else
                                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>

                                @endif
                                <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                                <li><a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">Logout</a></li>

                            </ul>
                        </li>
                    @else
                    <li class="dropdown "><a href="{{ route('login') }}">Login</a></li>

                    @endauth
                </ul>
            </div>
            <!-- OffCanvas Menu End -->
            <div class="offcanvas-social mt-auto">
                <ul>
                    <li>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-google"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-youtube"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- OffCanvas Menu End -->
    @yield('content')

     <!-- Footer Area Start -->
     <div class="footer-area">
        <div class="footer-container">
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <!-- Start single blog -->
                        <div class="col-md-6 col-lg-3 mb-md-30px mb-lm-30px">
                            <div class="single-wedge">
                                <div class="footer-logo">
                                    <a href="{{ route('frontend') }}"><img src="{{ asset('assets/images/logo/'.basicSettings()->logo) }}" alt=""></a>
                                </div>
                                <p class="about-text">{{ basicSettings()->tagline }}</p>
                                <ul class="link-follow">
                                    <li>
                                        <a class="m-0" title="Twitter" href="#"><i class="fa fa-twitter"
                                                aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        <a title="Tumblr" href="#"><i class="fa fa-tumblr" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a title="Facebook" href="#"><i class="fa fa-facebook" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a title="Instagram" href="#"><i class="fa fa-instagram" aria-hidden="true"></i>
                                            </i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- End single blog -->
                        <!-- Start single blog -->
                        <div class="col-md-3 col-sm-6 col-lg-2 mb-md-30px mb-lm-30px pl-lg-50px">
                            <div class="single-wedge">
                                <h4 class="footer-herading">Quick Links</h4>
                                <div class="footer-links">
                                    <div class="footer-row">
                                        <ul class="align-items-center">
                                            <li class="li"><a class="single-link" href="#">Support
                                                </a></li>
                                            <li class="li"><a class="single-link" href="#">Helpline</a></li>
                                            <li class="li"><a class="single-link" href="#">Courses</a></li>
                                            <li class="li"><a class="single-link" href="about.html">About</a></li>
                                            <li class="li"><a class="single-link" href="#">Event</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End single blog -->
                        <!-- Start single blog -->
                        <div class="col-md-3 col-lg-2 col-sm-6 mb-lm-30px pl-lg-50px">
                            <div class="single-wedge">
                                <h4 class="footer-herading">Other Page</h4>
                                <div class="footer-links">
                                    <div class="footer-row">
                                        <ul class="align-items-center">
                                            <li class="li"><a class="single-link" href="about.html"> About </a>
                                            </li>
                                            <li class="li"><a class="single-link" href="blog-grid.html">Blog</a></li>
                                            <li class="li"><a class="single-link" href="#">Speakers</a></li>
                                            <li class="li"><a class="single-link" href="contact.html">Contact</a></li>
                                            <li class="li"><a class="single-link" href="#">Tricket</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End single blog -->
                        <!-- Start single blog -->
                        <div class="col-md-3 col-lg-2 col-sm-6 mb-lm-30px pl-lg-50px">
                            <div class="single-wedge">
                                <h4 class="footer-herading">Company</h4>
                                <div class="footer-links">
                                    <div class="footer-row">
                                        <ul class="align-items-center">
                                            <li class="li"><a class="single-link" href="index.html">Jesco</a>
                                            </li>
                                            <li class="li"><a class="single-link" href="#">Shop</a></li>
                                            <li class="li"><a class="single-link" href="#">Contact us</a></li>
                                            <li class="li"><a class="single-link" href="#">Log in</a></li>
                                            <li class="li"><a class="single-link" href="#">Help</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End single blog -->
                        <!-- Start single blog -->
                        <div class="col-md-4 col-lg-3 col-sm-6">
                            <div class="single-wedge">

                                <h4 class="footer-herading">Store Information.</h4>
                                <div class="footer-links">
                                    <!-- News letter area -->
                                    <p class="address">2005 Your Address Goes Here. <br>
                                        896, Address 10010, HGJ</p>
                                    <p class="phone">Phone/Fax:<a href="tel:0123456789">0123456789</a></p>
                                    <p class="mail">Email:<a href="mailto:demo@example.com">demo@example.com</a></p>
                                    <img src="assets/images/icons/payment.png" alt="" class="payment-img img-fulid">

                                    <!-- News letter area  End -->
                                </div>
                            </div>
                        </div>
                        <!-- End single blog -->
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center " style="color:#002340">
                            <p class="copy-text">&copy; {{ date('Y').'-'.(date('y')+1) }} <strong>{{ basicSettings()->site_title }}</strong> <i class="fa fa-heart"
                                    aria-hidden="true"></i> Developed By <a class="company-name" target="_blank" href="https:/aniknandi.com/">
                                    <strong> Anik Kumar Nandi</strong></a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Area End -->

    <!-- Search Modal Start -->
    <div class="modal popup-search-style" id="searchActive">
        <button type="button" class="close-btn" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
        <div class="modal-overlay">
            <div class="modal-dialog p-0" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h2>Search Your Product</h2>
                        <form class="navbar-form position-relative" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search here...">
                            </div>
                            <button type="submit" class="submit-btn"><i class="pe-7s-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Modal End -->

    <!-- Login Modal Start -->
    <div class="modal popup-login-style" id="loginActive">
        <button type="button" class="close-btn" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
        <div class="modal-overlay">
            <div class="modal-dialog p-0" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="login-content">
                            <h2>Log in</h2>
                            <h3>Log in your account</h3>
                            <form action="#">
                                <input type="text" placeholder="Username">
                                <input type="password" placeholder="Password">
                                <div class="remember-forget-wrap">
                                    <div class="remember-wrap">
                                        <input type="checkbox">
                                        <p>Remember</p>
                                        <span class="checkmark"></span>
                                    </div>
                                    <div class="forget-wrap">
                                        <a href="#">Forgot your password?</a>
                                    </div>
                                </div>
                                <button type="button">Log in</button>
                                <div class="member-register">
                                    <p> Not a member? <a href="login.html"> Register now</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Login Modal End -->

    <!-- Global Vendor, plugins JS -->

    <!-- Vendor JS -->
    <!-- Vendor JS -->
    <!-- <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="assets/js/vendor/jquery-migrate-3.3.2.min.js"></script>
    <script src="assets/js/vendor/modernizr-3.11.2.min.js"></script> -->

    <!--Plugins JS-->
    <!-- <script src="assets/js/plugins/swiper-bundle.min.js"></script>
    <script src="assets/js/plugins/jquery-ui.min.js"></script>
    <script src="assets/js/plugins/jquery.nice-select.min.js"></script>
    <script src="assets/js/plugins/countdown.js"></script>
    <script src="assets/js/plugins/scrollup.js"></script>
    <script src="assets/js/plugins/jquery.zoom.min.js"></script>
    <script src="assets/js/plugins/venobox.min.js"></script>
    <script src="assets/js/plugins/ajax-mail.js"></script> -->

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <script src="{{ asset('assets/js/vendor/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/plugins.min.js') }}"></script>

    <!-- Main Js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @yield('footer_js')
</body>


<!-- Mirrored from template.hasthemes.com/jesco/jesco/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 25 Sep 2021 07:19:34 GMT -->
</html>

