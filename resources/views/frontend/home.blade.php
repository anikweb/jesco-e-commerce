@extends('frontend.master')
@section('inline_style')
<style>


</style>
@endsection()
@section('content')
        <!-- Hero/Intro Slider Start -->
        <div class="section ">
            <div class="hero-slider swiper-container slider-nav-style-1 slider-dot-style-1">
                <!-- Hero slider Active -->
                <div class="swiper-wrapper">
                    <!-- Single slider item -->
                    @foreach ($sliders as $slider)
                        <div class="hero-slide-item-2 slider-height swiper-slide d-flex bg-color">
                            <div class="container align-self-center">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-5 col-md-5 col-sm-5 align-self-center sm-center-view">
                                        <div class="hero-slide-content hero-slide-content-2 slider-animated-1">
                                            @if ($slider->promotions)
                                                <span class="category">{{ $slider->promotions }}</span>
                                            @endif
                                            <h2 class="title">{{ $slider->title }}</h2>
                                            @if ($slider->url)
                                                <a target="_blank" href="{{ $slider->url }}" class="btn btn-lg slider-btn btn-hover-dark"> Shop Now <i class="fa fa-shopping-basket ml-15px" aria-hidden="true"></i></a>

                                            @endif
                                        </div>
                                    </div>
                                    <div
                                        class="col-xl-6 col-lg-7 col-md-7 col-sm-7 d-flex justify-content-center position-relative">
                                        <div class="show-case">
                                            <div class="hero-slide-image">
                                                <img src="{{ asset('assets/images/slider-image/'.$slider->image) }}" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination swiper-pagination-white"></div>
                <!-- Add Arrows -->
                <div class="swiper-buttons">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>

        <!-- Hero/Intro Slider End -->

        <!-- Feature Area Srart -->
        <div class="feature-area  mt-n-65px">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <!-- single item -->
                        <div class="single-feature">
                            <div class="feature-icon">
                                <img src="{{ asset('assets/images/icons/1.png') }}" alt="">
                            </div>
                            <div class="feature-content">
                                <h4 class="title">Free Shipping</h4>
                                <span class="sub-title">Capped at $39 per order</span>
                            </div>
                        </div>
                    </div>
                    <!-- single item -->
                    <div class="col-lg-4 col-md-6 mb-md-30px mb-lm-30px mt-lm-30px">
                        <div class="single-feature">
                            <div class="feature-icon">
                                <img src="{{ asset('assets/images/icons/2.png') }}" alt="">
                            </div>
                            <div class="feature-content">
                                <h4 class="title">Card Payments</h4>
                                <span class="sub-title">12 Months Installments</span>
                            </div>
                        </div>
                    </div>
                    <!-- single item -->
                    <div class="col-lg-4 col-md-6">
                        <div class="single-feature">
                            <div class="feature-icon">
                                <img src="{{ asset('assets/images/icons/3.png') }}" alt="">
                            </div>
                            <div class="feature-content">
                                <h4 class="title">Easy Returns</h4>
                                <span class="sub-title">Shop With Confidence</span>
                            </div>
                        </div>
                        <!-- single item -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Feature Area End -->

        <!-- Product Area Start -->
        <div class="product-area pt-100px pb-100px">
            <div class="container">
                <!-- Section Title & Tab Start -->
                <div class="row">
                    <!-- Section Title Start -->
                    <div class="col-12">
                        <div class="section-title text-center mb-0">
                            <h2 class="title">#Product</h2>
                            <!-- Tab Start -->
                            <div class="nav-center">
                                <ul class="product-tab-nav nav align-items-center justify-content-center">
                                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                                            href="#tab-product--all">All</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                            href="#tab-product--new">New</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Tab End -->
                        </div>
                    </div>
                    <!-- Section Title End -->
                </div>
                <!-- Section Title & Tab End -->

                <div class="row">
                    <div class="col">
                        <div class="tab-content mb-30px0px">
                            <!-- All tab start -->
                            <div class="tab-pane fade show active" id="tab-product--all">
                                <div class="row">
                                    @if ($productAll)
                                        @foreach ($productAll as $product)
                                            <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up"
                                                data-aos-delay="200">
                                                <!-- Single Prodect -->
                                                <div class="product">
                                                    <div class="thumb">
                                                        <a href="{{ route('frontend.product.single',$product->slug) }}" class="image">
                                                            <img src="{{ asset('assets/images/product').'/'.$product->created_at->format('Y/m/d/').$product->id.'/thumbnail/'.$product->thumbnail }}" alt="{{ $product->name }}" />
                                                        </a>
                                                        <div class="actions">
                                                            @php
                                                                $w = $wishlistProduct->where('cookie_id',Cookie::get('jesco_ecommerce'))->where('product_id',$product->id)->first();
                                                            @endphp

                                                            @if ($w)
                                                                <button type="button" style='background:#fb5d5d;color:#ffffff' data-id="{{ $product->id }}" href="javascript:void(0)" class="action wishlist add-wishlist wishlist-product{{$product->id}}"  title="Wishlist">
                                                                    <i class="pe-7s-like"></i>
                                                                </button>
                                                            @else
                                                                <button type="button" data-id="{{ $product->id }}" href="javascript:void(0)" class="action wishlist add-wishlist wishlist-product{{$product->id}}"  title="Wishlist">
                                                                    <i class="pe-7s-like"></i>
                                                                </button>
                                                            @endif
                                                            <a href="#" class="action quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                            <a href="compare.html" class="action compare" title="Compare">
                                                                <i class="pe-7s-refresh-2"></i>
                                                            </a>
                                                        </div>
                                                        <a href="{{ route('frontend.product.single',$product->slug) }}" title="Add To Cart"  class="add-to-cart">Add To Cart</a>
                                                    </div>
                                                    <div class="content">
                                                        <span class="ratings">
                                                            <span class="rating-wrap">
                                                                <span class="star" style="width: 100%"></span>
                                                            </span>
                                                            <span class="rating-num">( 5 Review )</span>
                                                            <span style="position: absolute; right:0" class="badge rounded bg-primary text-white">{{ $product->category->name }}</span>

                                                        </span>
                                                        <h5 class="title" ><a href="#">{{ $product->name }}</a>
                                                        </h5>

                                                        <span class="price">
                                                            <span class="new">???{{ $product->attribute->min('offer_price') }}</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <!-- All tab end -->
                            <!-- New tab start -->
                            <div class="tab-pane fade" id="tab-product--new">
                                <div class="row">
                                    @if ($productNew)
                                        @foreach ($productNew as $product)
                                            <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up"
                                                data-aos-delay="200">
                                                <!-- Single Prodect -->
                                                <div class="product">
                                                    <div class="thumb">
                                                        <a href="{{ route('frontend.product.single',$product->slug) }}" class="image">
                                                            <img src="{{ asset('assets/images/product').'/'.$product->created_at->format('Y/m/d/').$product->id.'/thumbnail/'.$product->thumbnail }}" alt="{{ $product->name }}" />
                                                        </a>
                                                        <div class="actions">
                                                            <button type="button" data-id="{{ $product->id }}" href="javascript:void(0)" class="action wishlist add-wishlist wishlist-product{{$product->id}}"  title="Wishlist">
                                                                <i class="pe-7s-like"></i>
                                                            </button>
                                                            <a href="#" class="action quickview" data-link-action="quickview"
                                                                title="Quick view" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                            <a href="compare.html" class="action compare" title="Compare"><i
                                                                    class="pe-7s-refresh-2"></i></a>
                                                        </div>
                                                        <a href="{{ route('frontend.product.single',$product->slug) }}" title="Add To Cart" class="add-to-cart">Add To Cart</a>
                                                    </div>
                                                    <div class="content">
                                                        <span class="ratings">
                                                            <span class="rating-wrap">
                                                                <span class="star" style="width: 100%"></span>
                                                            </span>
                                                            <span class="rating-num">( 5 Review )</span>
                                                            <span style="position: absolute; right:0" class="badge rounded bg-primary text-white">{{ $product->category->name }}</span>
                                                        </span>
                                                        <h5 class="title"><a href="single-product.html">{{ $product->name }}</a>
                                                        </h5>
                                                        <span class="price">
                                                            <span class="new">???{{ $product->attribute->min('regular_price') }}</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <!-- New tab end -->
                        </div>
                        <a href="{{ route('frontend.product') }}" class="btn btn-lg btn-primary btn-hover-dark m-auto"> Load More <i
                                class="fa fa-arrow-right ml-15px" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Area End -->

        <!-- Banner Area Start -->
        <div class="banner-area pt-100px pb-100px plr-15px">
            <div class="row m-0">
                <div class="col-12 col-lg-4 mb-md-30px mb-lm-30px">
                    <div class="single-banner-2">
                        <img src="{{ asset('assets/images/banner/4.jpg') }}" alt="">
                        <div class="item-disc">
                            <h4 class="title">Best Collection <br>
                                For Women</h4>
                            <a href="shop-left-sidebar.html" class="shop-link btn btn-primary ">Shop Now <i
                                    class="fa fa-shopping-basket ml-5px" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 center-col mb-md-30px mb-lm-30px">
                    <div class="single-banner-2">
                        <img src="{{ asset('assets/images/banner/5.jpg') }}" alt="">
                        <div class="item-disc">
                            <h4 class="title">Best Collection <br>
                                For Men</h4>
                            <a href="shop-left-sidebar.html" class="shop-link btn btn-primary">Shop Now <i
                                    class="fa fa-shopping-basket ml-5px" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="single-banner-2">
                        <img src="{{ asset('assets/images/banner/6.jpg') }}" alt="">
                        <div class="item-disc">
                            <h4 class="title">New Collection <br>
                                For Kids</h4>
                            <a href="shop-left-sidebar.html" class="shop-link btn btn-primary">Shop Now <i
                                    class="fa fa-shopping-basket ml-5px" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner Area End -->

        <!-- Product Area Start -->
        <div class="product-area pt-100px pb-100px">
            <div class="container">
                <!-- Section Title & Tab Start -->
                <div class="row">
                    <!-- Section Title Start -->
                    <div class="col-lg col-md col-12">
                        <div class="section-title mb-0">
                            <h2 class="title">#newarrivals</h2>
                        </div>
                    </div>
                    <!-- Section Title End -->

                    <!-- Tab Start -->
                    <div class="col-lg-auto col-md-auto col-12">
                        <ul class="product-tab-nav nav">
                            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                                    href="#tab-product-all">All</a></li>
                        </ul>
                    </div>
                    <!-- Tab End -->
                </div>
                <!-- Section Title & Tab End -->

                <div class="row">
                    <div class="col">
                        <div class="tab-content top-borber">
                            <!-- 1st tab start -->
                            <div class="tab-pane fade show active" id="tab-product-all">
                                <div class="new-product-slider swiper-container slider-nav-style-1 small-nav">
                                    <div class="new-product-wrapper swiper-wrapper">
                                        @if ($productNew)
                                            @foreach ($productNew as $product)
                                                <div class="new-product-item swiper-slide">
                                                <!-- Single Prodect -->
                                                    <div class="product">
                                                        <div class="thumb">
                                                            <a href="{{ route('frontend.product.single',$product->slug) }}" class="image">
                                                                <img src="{{ asset('assets/images/product').'/'.$product->created_at->format('Y/m/d/').$product->id.'/thumbnail/'.$product->thumbnail }}" alt="{{ $product->name }}" />
                                                            </a>
                                                            <div class="actions">
                                                                <button type="button" data-id="{{ $product->id }}" href="javascript:void(0)" class="action wishlist add-wishlist wishlist-product{{$product->id}}"  title="Wishlist">
                                                                    <i class="pe-7s-like"></i>
                                                                </button>
                                                                <a href="#" class="action quickview" data-link-action="quickview"
                                                                    title="Quick view" data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                                <a href="compare.html" class="action compare" title="Compare"><i
                                                                        class="pe-7s-refresh-2"></i></a>
                                                            </div>
                                                            <a href="{{ route('frontend.product.single',$product->slug) }}" title="Add To Cart" class="add-to-cart">Add To Cart</a>
                                                        </div>
                                                        <div class="content">
                                                            <span class="ratings">
                                                                <span class="rating-wrap">
                                                                    <span class="star" style="width: 100%"></span>
                                                                </span>
                                                                <span class="rating-num">( 5 Review )</span>
                                                                <span style="position: absolute; right:0" class="badge rounded bg-primary text-white">{{ $product->category->name }}</span>
                                                            </span>
                                                            <h5 class="title"><a href="single-product.html">{{ $product->name }}</a>
                                                            </h5>
                                                            <span class="price">
                                                                <span class="new">???{{ $product->attribute->min('regular_price') }}</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <!-- Single Prodect -->
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <!-- Add Arrows -->
                                    <div class="swiper-buttons">
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- 1st tab end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Area End -->

        <!-- Deal Area Start -->
        <div class="deal-area deal-bg deal-bg-2" data-bg-image="{{ asset('assets/images/deal-img/deal-bg-2.jpg') }}">
            <div class="container ">
                <div class="row">
                    <div class="col-12">
                        <div class="deal-inner position-relative pt-100px pb-100px">
                            <div class="deal-wrapper">
                                <span class="category">#FASHION SHOP</span>
                                <h3 class="title">Deal Of The Day</h3>
                                <div class="deal-timing">
                                    <div data-countdown="2021/05/15"></div>
                                </div>
                                <a href="shop-left-sidebar.html" class="btn btn-lg btn-primary btn-hover-dark m-auto"> Shop
                                    Now <i class="fa fa-shopping-basket ml-15px" aria-hidden="true"></i></a>
                            </div>
                            <div class="deal-image">
                                <img class="img-fluid" src="{{ asset('assets/images/deal-img/woman.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Deal Area End -->
        <!--  Blog area Start -->
        <div class="main-blog-area pb-100px pt-100px">
            <div class="container">
                <!-- section title start -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center mb-30px0px">
                            <h2 class="title">#blog</h2>
                            <p class="sub-title">Lorem ipsum dolor sit amet consectetur adipisicing eiusmod.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- section title start -->

                <div class="row">
                    <div class="col-lg-4 mb-md-30px mb-lm-30px">
                        <div class="single-blog">
                            <div class="blog-image">
                                <a href="blog-single-left-sidebar.html"><img src="{{ asset('assets/images/blog-image/1.jpg') }}"
                                        class="img-responsive w-100" alt=""></a>
                            </div>
                            <div class="blog-text">
                                <div class="blog-athor-date">
                                    <a class="blog-date height-shape" href="#"><i class="fa fa-calendar"
                                            aria-hidden="true"></i> 24 Aug, 2021</a>
                                    <a class="blog-mosion" href="#"><i class="fa fa-commenting" aria-hidden="true"></i> 1.5
                                        K</a>
                                </div>
                                <h5 class="blog-heading"><a class="blog-heading-link"
                                        href="blog-single-left-sidebar.html">There are many variations of
                                        passages of Lorem</a></h5>

                                <a href="blog-single-left-sidebar.html" class="btn btn-primary blog-btn"> Read More<i
                                        class="fa fa-arrow-right ml-5px" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- End single blog -->
                    <div class="col-lg-4 mb-md-30px mb-lm-30px">
                        <div class="single-blog ">
                            <div class="blog-image">
                                <a href="blog-single-left-sidebar.html"><img src="{{ asset('assets/images/blog-image/2.jpg') }}"
                                        class="img-responsive w-100" alt=""></a>
                            </div>
                            <div class="blog-text">
                                <div class="blog-athor-date">
                                    <a class="blog-date height-shape" href="#"><i class="fa fa-calendar"
                                            aria-hidden="true"></i> 24 Aug, 2021</a>
                                    <a class="blog-mosion" href="#"><i class="fa fa-commenting" aria-hidden="true"></i> 1.5
                                        K</a>
                                </div>
                                <h5 class="blog-heading"><a class="blog-heading-link"
                                        href="blog-single-left-sidebar.html">It is a long established factoi
                                        ader will be distracted</a></h5>

                                <a href="blog-single-left-sidebar.html" class="btn btn-primary blog-btn"> Read More<i
                                        class="fa fa-arrow-right ml-5px" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- End single blog -->
                    <div class="col-lg-4">
                        <div class="single-blog">
                            <div class="blog-image">
                                <a href="blog-single-left-sidebar.html"><img src="{{ asset('assets/images/blog-image/3.jpg') }}"
                                        class="img-responsive w-100" alt=""></a>
                            </div>
                            <div class="blog-text">
                                <div class="blog-athor-date">
                                    <a class="blog-date height-shape" href="#"><i class="fa fa-calendar"
                                            aria-hidden="true"></i> 24 Aug, 2021</a>
                                    <a class="blog-mosion" href="#"><i class="fa fa-commenting" aria-hidden="true"></i> 1.5
                                        K</a>
                                </div>
                                <h5 class="blog-heading"><a class="blog-heading-link"
                                        href="blog-single-left-sidebar.html">Contrary to popular belieflo
                                        lorem Ipsum is not</a></h5>
                                <a href="blog-single-left-sidebar.html" class="btn btn-primary blog-btn"> Read More<i
                                        class="fa fa-arrow-right ml-5px" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- End single blog -->
                </div>
            </div>
        </div>
        <!--  Blog area End -->

@endsection
@section('footer_js')
<script>
        $(document).ready(function(){
            $('.add-wishlist').click(function(){
                var product_id = $(this).attr('data-id');
                $.ajax({
                    type: "GET",
                    url: "{{ url('wishlist/add') }}/"+product_id,
                    success:function(res){
                        console.log(res);
                        if(res.product_id == product_id){
                            var buttonWishlist = "<button type='button' href='javascript:void(0)' style='background:#fb5d5d;color:#ffffff'  class='action wishlist' data-id='{{ $product->id }}' title='Wishlist'><i class='pe-7s-like'></i></button>";
                            $(".wishlist-product"+res.product_id).html(buttonWishlist);
                        }else{
                            var buttonWishlist = "<button type='button' href='javascript:void(0)' class='action wishlist' data-id='{{ $product->id }}' title='Wishlist'><i class='pe-7s-like'></i></button>";
                            $(".wishlist-product"+product_id).html(buttonWishlist);
                        }
                    }
                });
            });

        });
</script>
@endsection

