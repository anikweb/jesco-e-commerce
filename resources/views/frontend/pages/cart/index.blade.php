@extends('frontend.master')
@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Shop</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <div class="cart-main-area pt-100px pb-100px">
        <div class="container">
            <h3 class="cart-page-title">Your cart items </h3>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <form action="#">
                        <div class="table-content table-responsive cart-table-content">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Until Price</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cartTotalPrice =0;
                                    @endphp
                                    @forelse ($carts as $cart)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <a href="#"><img class="img-responsive ml-15px" src="{{ asset('assets/images/product').'/'.$cart->product->created_at->format('Y/m/d/').$cart->product->id.'/thumbnail/'.$cart->product->thumbnail }}" alt="{{ $cart->product->name }}"></a>
                                            </td>
                                            <td class="product-name"><a href="#">{{ $cart->product->name }}</a></td>
                                            @php
                                                $offer_price = App\Models\Product_Attribute::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->first()->offer_price;
                                            @endphp
                                            <td class="product-price-cart"><span class="amount">৳{{ $offer_price }}</span></td>
                                            <td class="product-quantity">
                                                <div class="cart-plus-minus"><div class="dec qtybutton">-</div>
                                                    <input class="cart-plus-minus-box" type="text" name="qtybutton" value="{{$cart->quantity}}">
                                                <div class="inc qtybutton">+</div></div>
                                            </td>
                                            <td class="product-subtotal">৳{{ $subtotal =  $cart->quantity * $offer_price   }}</td>
                                            @php
                                                $cartTotalPrice = $cartTotalPrice + $subtotal;
                                            @endphp
                                            <td class="product-remove">
                                                <a href="#"><i class="fa fa-pencil"></i></a>
                                                <a href="{{ route('cart.delete',$cart->id) }}"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="lead">
                                            <i class="fa fa-exclamation-circle"></i> No carts to show!
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cart-shiping-update-wrapper">
                                    <div class="cart-shiping-update">
                                        <a href="#">Continue Shopping</a>
                                    </div>
                                    <div class="cart-clear">
                                        <button>Update Shopping Cart</button>
                                        <a href="{{ route('cart.all.delete') }}">Clear Shopping Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-lm-30px">
                            <div class="discount-code-wrapper">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gray">Use Coupon Code</h4>
                                </div>
                                <div class="discount-code">
                                    <p>Enter your coupon code if you have one.</p>
                                    <form>
                                        <input type="text" required="" name="name">
                                        <button class="cart-btn-2" type="submit">Apply Coupon</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12 mt-md-30px">
                            <div class="grand-totall">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                                </div>
                                <h5>Total <span>৳{{ $cartTotalPrice }}</span></h5>
                                <h4 class="grand-totall-title">Grand Total <span>$260.00</span></h4>
                                <a href="checkout.html">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
