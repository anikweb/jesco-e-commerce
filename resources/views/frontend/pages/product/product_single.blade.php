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
                                    <li class="old-price not-cut"> @if ($product->attribute->min('offer_price') < $product->attribute->max('regular_price')) <del class="rPrice">৳{{ $product->attribute->max('regular_price') }}</del> @endif  <span class="text-primary offer_price">৳{{ $product->attribute->min('offer_price') }}</span></li>
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
                            </div>
                            <div class="sizeName">
                                {{-- Size will execute  by ajax --}}
                            </div>
                            <div class="size">
                                {{-- Size will execute  by ajax --}}
                            </div>
                            <div class="pro-details-quality">
                                <div class="cart-plus-minus"><div class="dec qtybutton">-</div>
                                    <input class="cart-plus-minus-box" type="text" name="quantity" value="1">
                                <div class="inc qtybutton">+</div></div>
                                <div class="pro-details-cart">
                                    @if ($product->attribute->sum('quantity') != 0)
                                        <button type="submit" class="add-cart" href="#">Add To Cart</button>
                                    @else
                                        <button class="stockout-btn" style="hover:none;" href="#"> Out of Stock</button>
                                    @endif

                                </div>
                                <div class="pro-details-compare-wishlist pro-details-wishlist ">
                                    <a href="wishlist.html"><i class="pe-7s-like"></i></a>
                                </div>
                                <div class="pro-details-compare-wishlist pro-details-compare">
                                    <a href="compare.html"><i class="pe-7s-refresh-2"></i></a>
                                </div>
                            </div>
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
                            <p>{{ $product->description }}</p>
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
                // alert(colorId);
                $.ajax({
                    type: "GET",
                    url: "{{ url('get/color/size') }}/"+colorId+'/'+productId,
                    success:function(res){
                        if(res){
                            // console.log(res);
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
                                    $('.offer_price').html(.price);
                                    $('.rPrice').html('৳'.rPrice);
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
