@extends('frontend.master')
@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">{{ $product->name }}</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('frontend') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('frontend.product') }}">Product</a></li>
                        <li class="breadcrumb-item active">{{ $product->name }}</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <div class="product-details-area pt-100px pb-100px">
        <div class="container">
            <form action="{{ route('cart.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                        <!-- Swiper -->
                        <div class="swiper-container zoom-top swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events">
                            <div class="swiper-wrapper" id="swiper-wrapper-4d2af9454fd6102e9" aria-live="polite" style="transform: translate3d(0px, 0px, 0px);">
                                <div class="swiper-slide zoom-image-hover swiper-slide-active" role="group" aria-label="2 / 4" style="width: 576px; position: relative; overflow: hidden;">
                                    <img class="img-responsive m-auto" src="{{ asset('assets/images/product').'/'.$product->created_at->format('Y/m/d/').$product->id.'/thumbnail/'.$product->thumbnail }}" alt="{{ $product->name }}" >
                                    <img role="presentation" src="{{ asset('assets/images/product').'/'.$product->created_at->format('Y/m/d/').$product->id.'/thumbnail/'.$product->thumbnail }}" alt="{{ $product->name }}" class="zoomImg" style="position: absolute; top: 0px; left: 0px; opacity: 0; width: 800px; height: 800px; border: none; max-width: none; max-height: none;">
                                </div>
                                @foreach ($product->imageGallery as $imageGallery)
                                    <div class="swiper-slide zoom-image-hover @if ($loop->index == 0) swiper-slide-next @endif " role="group" aria-label="2 / 4" style="width: 576px; position: relative; overflow: hidden;">
                                        <img class="img-responsive m-auto" src="{{ asset('assets/images/product').'/'.$product->created_at->format('Y/m/d/').$product->id.'/image_galleries/'.$imageGallery->name }}" alt="{{ $product->name }}" >
                                        <img role="presentation" src="{{ asset('assets/images/product').'/'.$product->created_at->format('Y/m/d/').$product->id.'/image_galleries/'.$imageGallery->name }}" alt="{{ $product->name }}" class="zoomImg" style="position: absolute; top: 0px; left: 0px; opacity: 0; width: 800px; height: 800px; border: none; max-width: none; max-height: none;">
                                    </div>
                                @endforeach
                            </div>
                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                        <div class="swiper-container zoom-thumbs mt-3 mb-3 swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events swiper-container-free-mode swiper-container-thumbs">
                            <div class="swiper-wrapper" id="swiper-wrapper-ea361bf3b6fb3105a" aria-live="polite" style="transform: translate3d(0px, 0px, 0px);">
                                <div class="swiper-slide swiper-slide-visible swiper-slide-active swiper-slide-thumb-active" role="group" aria-label="1 / 4" style="width: 129.5px; margin-right: 10px;">
                                    <img class="img-responsive m-auto" src="{{ asset('assets/images/product').'/'.$product->created_at->format('Y/m/d/').$product->id.'/thumbnail/'.$product->thumbnail }}" alt="{{ $product->name }}">
                                </div>
                                @foreach ($product->imageGallery as $imageGallery)
                                    <div class="swiper-slide swiper-slide-visible  @if ($loop->index == 0) swiper-slide-active swiper-slide-thumb-active @elseif ($loop->index == 1) swiper-slide-next @endif" role="group" aria-label="1 / 4" style="width: 129.5px; margin-right: 10px;">
                                        <img class="img-responsive m-auto" src="{{ asset('assets/images/product').'/'.$product->created_at->format('Y/m/d/').$product->id.'/image_galleries/'.$imageGallery->name }}" alt="{{ $product->name }}">
                                    </div>
                                @endforeach
                            </div>
                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                        <div class="product-details-content quickview-content">
                            <h2>{{ $product->name }}</h2>
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="pricing-meta">
                                <ul>
                                    <li class="old-price not-cut"> @if($product->attribute->min('offer_price')!=$product->attribute->max('regular_price')) <del class="rPrice">৳{{ $product->attribute->max('regular_price') }}</del> @endif <span class="text-primary offer_price">৳{{ $product->attribute->min('offer_price') }}</span></li>
                                </ul>
                            </div>
                            <div class="pro-details-rating-wrap">
                                <div class="rating-product">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <span class="read-review"><a class="reviews" href="#">( 5 Customer Review )</a></span>
                            </div>
                            <p class="mt-30px mb-0">{{ $product->summary }}</p>

                            <div class="colorName badge text-white bg-primary">
                                Colors
                            </div>
                            <div class="color">
                                @foreach ($product->attribute->unique('color_id') as $attribute)
                                    <label for="color_id{{$attribute->id}}">
                                        <input class="color_id" id="color_id{{$attribute->id}}" name="color_id" data-product="{{ $product->id }}" value="{{ $attribute->color_id }}" style="width: auto; height:auto" type="radio"> {{ Str::title($attribute->color->name) }}
                                    </label>
                                @endforeach
                                @error('color_id')
                                    <div class="text-danger">
                                        <i class="fa fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="sizeName">
                                {{-- Size will execute  by ajax --}}
                            </div>
                            <div class="size">
                                {{-- Size will execute  by ajax --}}
                            </div>
                            @error('size_id')
                                <div class="text-danger">
                                    <i class="fa fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="pro-details-quality">
                                <div class="cart-plus-minus"><div class="dec qtybutton">-</div>
                                    <input class="cart-plus-minus-box" type="text" name="quantity" value="1">
                                <div class="inc qtybutton">+</div></div>
                                <div class="pro-details-cart">
                                    <button type="submit" class="add-cart" href="#">Add To Cart</button>
                                </div>
                                <div class="pro-details-compare-wishlist pro-details-wishlist ">
                                    <a href="wishlist.html"><i class="pe-7s-like"></i></a>
                                </div>
                                <div class="pro-details-compare-wishlist pro-details-compare">
                                    <a href="compare.html"><i class="pe-7s-refresh-2"></i></a>
                                </div>
                            </div>
                            @error('quantity')
                                <div class="text-danger">
                                    <i class="fa fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="pro-details-sku-info pro-details-same-style  d-flex">
                                <span>SKU: </span>
                                <ul class="d-flex">
                                    <li>
                                        <a href="#">{{ $product->sku }}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="pro-details-categories-info pro-details-same-style d-flex">
                                <span>Categories: </span>
                                <ul class="d-flex">
                                    <li>
                                        <a href="#">{{ $product->category->name }}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="pro-details-social-info pro-details-same-style d-flex">
                                <span>Share: </span>
                                <ul class="d-flex">
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
                </div>
            </form>
        </div>
    </div>
    <div class="description-review-area pb-100px" data-aos="fade-up" data-aos-delay="200">
        <div class="container">
            <div class="description-review-wrapper">
                <div class="description-review-topbar nav">
                    <a data-bs-toggle="tab" href="#des-details2">Information</a>
                    <a class="active" data-bs-toggle="tab" href="#des-details1">Description</a>
                    <a data-bs-toggle="tab" href="#des-details3">Reviews (02)</a>
                </div>
                <div class="tab-content description-review-bottom">
                    <div id="des-details2" class="tab-pane">
                        <div class="product-anotherinfo-wrapper text-start">
                            <ul>
                                <li><span>Weight</span> 400 g</li>
                                <li><span>Dimensions</span>10 x 10 x 15 cm</li>
                                <li><span>Materials</span> 60% cotton, 40% polyester</li>
                                <li><span>Other Info</span> American heirloom jean shorts pug seitan letterpress</li>
                            </ul>
                        </div>
                    </div>
                    <div id="des-details1" class="tab-pane active">
                        <div class="product-description-wrapper">
                            <p>

                                Lorem ipsum dolor sit amet, consectetur adipisi elit, incididunt ut labore et. Ut enim
                                ad minim veniam, quis nostrud exercita ullamco laboris nisi ut aliquip ex ea commol
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                                eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                                qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste
                                natus error sit voluptatem accusantiulo doloremque laudantium, totam rem aperiam, eaque
                                ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt
                                explicabo. Nemo enim ipsam voluptat quia voluptas sit aspernatur aut odit aut fugit, sed
                                quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro
                                quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed
                                quia non numquam eius modi tempora incidunt ut labore

                            </p>
                        </div>
                    </div>
                    <div id="des-details3" class="tab-pane">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="review-wrapper">
                                    <div class="single-review">
                                        <div class="review-img">
                                            <img src="assets/images/review-image/1.png" alt="">
                                        </div>
                                        <div class="review-content">
                                            <div class="review-top-wrap">
                                                <div class="review-left">
                                                    <div class="review-name">
                                                        <h4>White Lewis</h4>
                                                    </div>
                                                    <div class="rating-product">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <div class="review-left">
                                                    <a href="#">Reply</a>
                                                </div>
                                            </div>
                                            <div class="review-bottom">
                                                <p>
                                                    Vestibulum ante ipsum primis aucibus orci luctustrices posuere
                                                    cubilia Curae Suspendisse viverra ed viverra. Mauris ullarper
                                                    euismod vehicula. Phasellus quam nisi, congue id nulla.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-review child-review">
                                        <div class="review-img">
                                            <img src="assets/images/review-image/2.png" alt="">
                                        </div>
                                        <div class="review-content">
                                            <div class="review-top-wrap">
                                                <div class="review-left">
                                                    <div class="review-name">
                                                        <h4>White Lewis</h4>
                                                    </div>
                                                    <div class="rating-product">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <div class="review-left">
                                                    <a href="#">Reply</a>
                                                </div>
                                            </div>
                                            <div class="review-bottom">
                                                <p>Vestibulum ante ipsum primis aucibus orci luctustrices posuere
                                                    cubilia Curae Sus pen disse viverra ed viverra. Mauris ullarper
                                                    euismod vehicula.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="ratting-form-wrapper pl-50">
                                    <h3>Add a Review</h3>
                                    <div class="ratting-form">
                                        <form action="#">
                                            <div class="star-box">
                                                <span>Your rating:</span>
                                                <div class="rating-product">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="rating-form-style">
                                                        <input placeholder="Name" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="rating-form-style">
                                                        <input placeholder="Email" type="email">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="rating-form-style form-submit">
                                                        <textarea name="Your Review" placeholder="Message"></textarea>
                                                        <button class="btn btn-primary btn-hover-color-primary " type="submit" value="Submit">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="related-product-area pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center mb-30px0px line-height-1">
                        <h2 class="title m-0">Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="new-product-slider swiper-container slider-nav-style-1 small-nav swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events">
                <div class="new-product-wrapper swiper-wrapper" id="swiper-wrapper-f4fd3d408cc7f314" aria-live="polite" style="transform: translate3d(-1206px, 0px, 0px); transition-duration: 0ms;"><div class="new-product-item swiper-slide swiper-slide-duplicate" data-swiper-slide-index="2" role="group" aria-label="1 / 14" style="width: 271.5px; margin-right: 30px;">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="assets/images/product-image/10.jpg" alt="Product">
                                    <img class="hover-image" src="assets/images/product-image/2.jpg" alt="Product">
                                </a>
                                <span class="badges">
                                    <span class="sale">-7%</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 90%"></span>
                                    </span>
                                    <span class="rating-num">( 4.5 Review )</span>
                                </span>
                                <h5 class="title"><a href="single-product.html">Women's Long
                                        Sleeve
                                        Shirts</a></h5>
                                <span class="price">
                                    <span class="new">$30.50</span>
                                    <span class="old">$38.00</span>
                                </span>
                            </div>
                        </div>
                    </div><div class="new-product-item swiper-slide swiper-slide-duplicate" data-swiper-slide-index="3" role="group" aria-label="2 / 14" style="width: 271.5px; margin-right: 30px;">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="assets/images/product-image/11.jpg" alt="Product">
                                    <img class="hover-image" src="assets/images/product-image/11.jpg" alt="Product">
                                </a>
                                <span class="badges">
                                    <span class="new">Sale</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 70%"></span>
                                    </span>
                                    <span class="rating-num">( 3.5 Review )</span>
                                </span>
                                <h5 class="title"><a href="single-product.html">Parrera
                                        Sunglasses -
                                        Lomashop</a></h5>
                                <span class="price">
                                    <span class="new">$38.50</span>
                                </span>
                            </div>
                        </div>
                        <!-- Single Prodect -->
                    </div><div class="new-product-item swiper-slide swiper-slide-duplicate" data-swiper-slide-index="4" role="group" aria-label="3 / 14" style="width: 271.5px; margin-right: 30px;">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="assets/images/product-image/3.jpg" alt="Product">
                                    <img class="hover-image" src="assets/images/product-image/4.jpg" alt="Product">
                                </a>
                                <span class="badges">
                                    <span class="sale">-10%</span>
                                    <span class="new">New</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 80%"></span>
                                    </span>
                                    <span class="rating-num">( 4 Review )</span>
                                </span>
                                <h5 class="title"><a href="single-product.html">Ardene Microfiber
                                        Tights</a>
                                </h5>
                                <span class="price">
                                    <span class="new">$38.50</span>
                                    <span class="old">$48.50</span>
                                </span>
                            </div>
                        </div>
                        <!-- Single Prodect -->
                    </div><div class="new-product-item swiper-slide swiper-slide-duplicate swiper-slide-prev" data-swiper-slide-index="5" role="group" aria-label="4 / 14" style="width: 271.5px; margin-right: 30px;">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="assets/images/product-image/1.jpg" alt="Product">
                                    <img class="hover-image" src="assets/images/product-image/2.jpg" alt="Product">
                                </a>
                                <span class="badges">
                                    <span class="new">New</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 100%"></span>
                                    </span>
                                    <span class="rating-num">( 5 Review )</span>
                                </span>
                                <h5 class="title"><a href="single-product.html">Women's Elizabeth
                                        Coat
                                    </a>
                                </h5>
                                <span class="price">
                                    <span class="new">$38.50</span>
                                </span>
                            </div>
                        </div>
                        <!-- Single Prodect -->
                    </div>
                    <div class="new-product-item swiper-slide swiper-slide-active" data-swiper-slide-index="0" role="group" aria-label="5 / 14" style="width: 271.5px; margin-right: 30px;">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="assets/images/product-image/8.jpg" alt="Product">
                                    <img class="hover-image" src="assets/images/product-image/6.jpg" alt="Product">
                                </a>
                                <span class="badges">
                                    <span class="new">New</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 100%"></span>
                                    </span>
                                    <span class="rating-num">( 5 Review )</span>
                                </span>
                                <h5 class="title"><a href="single-product.html">Women's Elizabeth
                                        Coat
                                    </a>
                                </h5>
                                <span class="price">
                                    <span class="new">$38.50</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="new-product-item swiper-slide swiper-slide-next" data-swiper-slide-index="1" role="group" aria-label="6 / 14" style="width: 271.5px; margin-right: 30px;">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="assets/images/product-image/9.jpg" alt="Product">
                                    <img class="hover-image" src="assets/images/product-image/5.jpg" alt="Product">
                                </a>
                                <span class="badges">
                                    <span class="sale">-10%</span>
                                    <span class="new">New</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 80%"></span>
                                    </span>
                                    <span class="rating-num">( 4 Review )</span>
                                </span>
                                <h5 class="title"><a href="single-product.html">Ardene Microfiber
                                        Tights</a>
                                </h5>
                                <span class="price">
                                    <span class="new">$38.50</span>
                                    <span class="old">$48.50</span>
                                </span>
                            </div>
                        </div>
                        <!-- Single Prodect -->
                    </div>
                    <div class="new-product-item swiper-slide" data-swiper-slide-index="2" role="group" aria-label="7 / 14" style="width: 271.5px; margin-right: 30px;">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="assets/images/product-image/10.jpg" alt="Product">
                                    <img class="hover-image" src="assets/images/product-image/2.jpg" alt="Product">
                                </a>
                                <span class="badges">
                                    <span class="sale">-7%</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 90%"></span>
                                    </span>
                                    <span class="rating-num">( 4.5 Review )</span>
                                </span>
                                <h5 class="title"><a href="single-product.html">Women's Long
                                        Sleeve
                                        Shirts</a></h5>
                                <span class="price">
                                    <span class="new">$30.50</span>
                                    <span class="old">$38.00</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="new-product-item swiper-slide" data-swiper-slide-index="3" role="group" aria-label="8 / 14" style="width: 271.5px; margin-right: 30px;">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="assets/images/product-image/11.jpg" alt="Product">
                                    <img class="hover-image" src="assets/images/product-image/11.jpg" alt="Product">
                                </a>
                                <span class="badges">
                                    <span class="new">Sale</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 70%"></span>
                                    </span>
                                    <span class="rating-num">( 3.5 Review )</span>
                                </span>
                                <h5 class="title"><a href="single-product.html">Parrera
                                        Sunglasses -
                                        Lomashop</a></h5>
                                <span class="price">
                                    <span class="new">$38.50</span>
                                </span>
                            </div>
                        </div>
                        <!-- Single Prodect -->
                    </div>
                    <div class="new-product-item swiper-slide" data-swiper-slide-index="4" role="group" aria-label="9 / 14" style="width: 271.5px; margin-right: 30px;">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="assets/images/product-image/3.jpg" alt="Product">
                                    <img class="hover-image" src="assets/images/product-image/4.jpg" alt="Product">
                                </a>
                                <span class="badges">
                                    <span class="sale">-10%</span>
                                    <span class="new">New</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 80%"></span>
                                    </span>
                                    <span class="rating-num">( 4 Review )</span>
                                </span>
                                <h5 class="title"><a href="single-product.html">Ardene Microfiber
                                        Tights</a>
                                </h5>
                                <span class="price">
                                    <span class="new">$38.50</span>
                                    <span class="old">$48.50</span>
                                </span>
                            </div>
                        </div>
                        <!-- Single Prodect -->
                    </div>
                    <div class="new-product-item swiper-slide swiper-slide-duplicate-prev" data-swiper-slide-index="5" role="group" aria-label="10 / 14" style="width: 271.5px; margin-right: 30px;">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="assets/images/product-image/1.jpg" alt="Product">
                                    <img class="hover-image" src="assets/images/product-image/2.jpg" alt="Product">
                                </a>
                                <span class="badges">
                                    <span class="new">New</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 100%"></span>
                                    </span>
                                    <span class="rating-num">( 5 Review )</span>
                                </span>
                                <h5 class="title">
                                    <a href="single-product.html">Women's Elizabeth Coat
                                    </a>
                                </h5>
                                <span class="price">
                                    <span class="new">$38.50</span>
                                </span>
                            </div>
                        </div>
                        <!-- Single Prodect -->
                    </div>
                <div class="new-product-item swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active" data-swiper-slide-index="0" role="group" aria-label="11 / 14" style="width: 271.5px; margin-right: 30px;">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="assets/images/product-image/8.jpg" alt="Product">
                                    <img class="hover-image" src="assets/images/product-image/6.jpg" alt="Product">
                                </a>
                                <span class="badges">
                                    <span class="new">New</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 100%"></span>
                                    </span>
                                    <span class="rating-num">( 5 Review )</span>
                                </span>
                                <h5 class="title"><a href="single-product.html">Women's Elizabeth
                                        Coat
                                    </a>
                                </h5>
                                <span class="price">
                                    <span class="new">$38.50</span>
                                </span>
                            </div>
                        </div>
                    </div><div class="new-product-item swiper-slide swiper-slide-duplicate swiper-slide-duplicate-next" data-swiper-slide-index="1" role="group" aria-label="12 / 14" style="width: 271.5px; margin-right: 30px;">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="assets/images/product-image/9.jpg" alt="Product">
                                    <img class="hover-image" src="assets/images/product-image/5.jpg" alt="Product">
                                </a>
                                <span class="badges">
                                    <span class="sale">-10%</span>
                                    <span class="new">New</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 80%"></span>
                                    </span>
                                    <span class="rating-num">( 4 Review )</span>
                                </span>
                                <h5 class="title"><a href="single-product.html">Ardene Microfiber
                                        Tights</a>
                                </h5>
                                <span class="price">
                                    <span class="new">$38.50</span>
                                    <span class="old">$48.50</span>
                                </span>
                            </div>
                        </div>
                        <!-- Single Prodect -->
                    </div><div class="new-product-item swiper-slide swiper-slide-duplicate" data-swiper-slide-index="2" role="group" aria-label="13 / 14" style="width: 271.5px; margin-right: 30px;">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="assets/images/product-image/10.jpg" alt="Product">
                                    <img class="hover-image" src="assets/images/product-image/2.jpg" alt="Product">
                                </a>
                                <span class="badges">
                                    <span class="sale">-7%</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 90%"></span>
                                    </span>
                                    <span class="rating-num">( 4.5 Review )</span>
                                </span>
                                <h5 class="title"><a href="single-product.html">Women's Long
                                        Sleeve
                                        Shirts</a></h5>
                                <span class="price">
                                    <span class="new">$30.50</span>
                                    <span class="old">$38.00</span>
                                </span>
                            </div>
                        </div>
                    </div><div class="new-product-item swiper-slide swiper-slide-duplicate" data-swiper-slide-index="3" role="group" aria-label="14 / 14" style="width: 271.5px; margin-right: 30px;">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="assets/images/product-image/11.jpg" alt="Product">
                                    <img class="hover-image" src="assets/images/product-image/11.jpg" alt="Product">
                                </a>
                                <span class="badges">
                                    <span class="new">Sale</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 70%"></span>
                                    </span>
                                    <span class="rating-num">( 3.5 Review )</span>
                                </span>
                                <h5 class="title"><a href="single-product.html">Parrera
                                        Sunglasses -
                                        Lomashop</a></h5>
                                <span class="price">
                                    <span class="new">$38.50</span>
                                </span>
                            </div>
                        </div>
                        <!-- Single Prodect -->
                    </div></div>
                <!-- Add Arrows -->
                <div class="swiper-buttons">
                    <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-f4fd3d408cc7f314"></div>
                    <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-f4fd3d408cc7f314"></div>
                </div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
        </div>
    </div>
@endsection
@section('inline_style')
<style>
    .stockout-btn{
        position: relative;
        padding: 0 35px;
        height: 50px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        border-radius: 5px;
        box-shadow: none;
        text-transform: uppercase;
        display: inline-block;
        margin-left: 10px;
        background: #fb5d5d;
        color: #fff;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        letter-spacing: 2px;
        cursor:context-menu !important;
    }
</style>
@endsection
@section('footer_js')
    <script>
        $(document).ready(function(){
            $('.color_id').change(function(){
                var colorId = $(this).val();
                var productId = $(this).attr('data-product');
                // alert(productId);
                $.ajax({
                    type: "GET",
                    url: "{{ url('get/color/size') }}/"+colorId+'/'+productId,
                    success:function(res){
                        if(res){
                            console.log(res);
                            // if(res !='none'){
                                $('.size').empty();
                                $('.sizeName').empty();
                                $('.sizeName').append('<div class="badge text-white bg-info">Sizes</div>');
                                // $('.sizeAdd').empty();
                                $('.size').html(res);
                                $('.sizeCheck').change(function(){
                                    var price = $(this).attr('data-price');
                                    var quantity = $(this).attr('data-quantity');
                                    var rPrice = $(this).attr('data-rPrice');
                                    $('.offer_price').html('৳'+price);
                                    $('.rPrice').html(rPrice);
                                });
                            // }
                            // if(res =='none'){
                            //     // $('.size').empty();
                            //     // $('.sizeName').empty();
                            //     // $('.sizeName').append('<div class="badge text-white bg-info">Sizes</div>');
                            //     // // $('.sizeAdd').empty();
                            //     // $('.size').html(res);
                            //     // $('.sizeCheck').change(function(){
                            //         var price = $(this).attr('data-price');
                            //         var quantity = $(this).attr('data-quantity');
                            //         var rPrice = $(this).attr('data-rPrice');
                            //         $('.offer_price').html(price);
                            //         $('.rPrice').html(rPrice);
                            //     // });
                            // }
                        }
                    }
                });
            });
        });
    </script>
@endsection
