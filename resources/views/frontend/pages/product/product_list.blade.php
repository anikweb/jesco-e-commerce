@extends('frontend.master')
@section('content')

    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Shop</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('frontend') }}">Home</a></li>
                        <li class="breadcrumb-item active">Shop</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <div class="shop-category-area pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Shop Top Area Start -->

                    <!-- Shop Top Area End -->
                    <!-- Shop Bottom Area Start -->
                    <div class="shop-bottom-area">
                        <!-- Tab Content Area Start -->
                        <div class="row">
                            <div class="col">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="shop-grid">
                                        <div class="row mb-n-30px">
                                            @if ($productLatest)
                                                @foreach ($productLatest as $product)
                                                    <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up"
                                                        data-aos-delay="200">
                                                        <!-- Single Prodect -->
                                                        <div class="product">
                                                            <div class="thumb">
                                                                <a href="{{ route('frontend.product.single',$product->slug) }}" class="image">
                                                                    <img src="{{ asset('assets/images/product').'/'.$product->created_at->format('Y/m/d/').$product->id.'/thumbnail/'.$product->thumbnail }}" alt="{{ $product->name }}" />
                                                                </a>
                                                                <div class="actions">
                                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                                            class="pe-7s-like"></i></a>
                                                                    <a href="#" class="action quickview" data-link-action="quickview"
                                                                        title="Quick view" data-bs-toggle="modal"
                                                                        data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                                            class="pe-7s-refresh-2"></i></a>
                                                                </div>
                                                                <button title="Add To Cart" class="add-to-cart">Add To Cart</button>
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
                                                                    <span class="new">{{ $product->attribute->min('offer_price') }}</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Tab Content Area End -->

                        <!--  Pagination Area Start -->
                            <div class="load-more-items text-center mt-30px" data-aos="fade-up">
                                {{ $productLatest->links() }}
                            </div>

                        <!--  Pagination Area End -->
                    </div>
                    <!-- Shop Bottom Area End -->
                </div>
            </div>
        </div>
    </div>
@endsection
