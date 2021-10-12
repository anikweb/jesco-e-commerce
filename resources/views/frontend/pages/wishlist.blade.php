@extends('frontend.master')
@section('content')
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">Wishlist</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{ route('frontend') }}">Home</a></li>
                    <li class="breadcrumb-item active">Wishlist</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>
<div class="cart-main-area pt-100px pb-100px">
    <div class="container">
        <h3 class="cart-page-title">Your Wishlist Item</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="#">
                    <div class="table-content table-responsive cart-table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($wishlists as $wishlist)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="#"><img class="img-responsive ml-15px rounded" src="{{ asset('assets/images/product').'/'.$wishlist->product->created_at->format('Y/m/d/').$wishlist->product->id.'/thumbnail/'.$wishlist->product->thumbnail }}" alt="{{ $wishlist->product->name }}"></a>
                                        </td>
                                        <td class="product-name"><a href="#">{{ $wishlist->product->name }}</a></td>
                                        <td class="product-wishlist-cart">
                                            <a href="#"> <i class="fa fa-cart-plus"></i> Add to cart</a>
                                            <a href="{{ route('frontend.wishlist.remove',$wishlist->product_id) }}"> <i class="fa fa-trash"></i> Remove</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="6" class="lead"> <i class="fa fa-exclamation-circle"></i> No Wishlists Available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
