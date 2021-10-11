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
                    <div class="shop-top-bar d-flex">
                        <!-- Left Side start -->
                        <p><span>{{ count($productLatest) }}</span> Product Found of <span>{{ count($productAll) }}</span></p>
                        <!-- Left Side End -->
                        <!-- Right Side Start -->
                        <div class="select-shoing-wrap d-flex align-items-center">
                            <div class="shot-product">
                                <p>Sort By:</p>
                            </div>
                            <div class="shop-select">
                                <select class="shop-sort" style="display: none;">
                                    <option data-display="Relevance">Relevance</option>
                                    <option value="1"> Name, A to Z</option>
                                    <option value="2"> Name, Z to A</option>
                                    <option value="3"> Price, low to high</option>
                                    <option value="4"> Price, high to low</option>
                                </select><div class="nice-select shop-sort" tabindex="0"><span class="current">Relevance</span><ul class="list"><li data-value="Relevance" data-display="Relevance" class="option selected">Relevance</li><li data-value="1" class="option"> Name, A to Z</li><li data-value="2" class="option"> Name, Z to A</li><li data-value="3" class="option"> Price, low to high</li><li data-value="4" class="option"> Price, high to low</li></ul></div>

                            </div>
                        </div>
                        <!-- Right Side End -->
                    </div>
                    <!-- Shop Top Area End -->

                    <!-- Shop Bottom Area Start -->
                    <div class="shop-bottom-area">

                        <!-- Tab Content Area Start -->
                        <div class="row">
                            <div class="col">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="shop-grid">
                                        <div class="row mb-n-30px">
                                            @foreach ($productLatest as $product)
                                                <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up"
                                                    data-aos-delay="200">
                                                    <!-- Single Prodect -->
                                                    <div class="product">
                                                        <div class="thumb">
                                                            <a href="{{ route('frontend.product.single',$product->slug) }}" class="image">
                                                                <img src="{{ asset('assets/images/product').'/'.$product->created_at->format('Y/m/d/').$product->id.'/thumbnail/'.$product->thumbnail }}" alt="{{ $product->name }}" />
                                                            </a>
                                                            <span class="badges">
                                                                @if ($product->attribute->sum('quantity') == 0)
                                                                    <span class="new bg-danger">Sold</span>
                                                                @endif
                                                            </span>
                                                            <div class="actions">
                                                                <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                                        class="pe-7s-like"></i></a>
                                                                <a href="#" class="action quickview" data-link-action="quickview"
                                                                    title="Quick view" data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal"><i class="pe-7s-search"></i></a>
                                                                <a href="compare.html" class="action compare" title="Compare"><i
                                                                        class="pe-7s-refresh-2"></i></a>
                                                            </div>
                                                            @if ($product->attribute->sum('quantity') != 0)
                                                                <button title="Add To Cart" class="add-to-cart">Add To Cart</button>
                                                            @else
                                                                <button title="Add To Cart" disabled class="add-to-cart">Out of Stock</button>
                                                            @endif
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
