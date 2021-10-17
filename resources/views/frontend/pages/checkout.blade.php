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
                    <li class="breadcrumb-item active">Checkout</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>
<div class="checkout-area pt-100px pb-100px">
    <div class="container">
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-7">
                    <div class="billing-info-wrap">
                        <h3>Billing Details</h3>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="billing-info mb-4">
                                    <label for="name">Name</label>
                                    <input type="text" value="{{ Auth::user()->name }}" name="name" id="name">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-info mb-4">
                                    <label for="company">Company / Shop Name <em class="text-muted">(optional)</em> </label>
                                    <input type="text" name="company" id="company">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" id="phone">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4">
                                    <label for="email">Email Address</label>
                                    <input type="text" name="email" id="email">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="billing-select mb-4">
                                    <label for="region_id">Region</label>
                                    <select name="region_id" id="region_id">
                                        <option value="1">Mymensingh</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="billing-select mb-4">
                                    <label for="district_id">City</label>
                                    <select name="district_id" id="district_id">
                                        <option value="1">Mymensingh</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="billing-select mb-4">
                                    <label for="upazila_id">Upazila</label>
                                    <select name="upazila_id" id="upazila_id">
                                        <option value="1">Mymensingh Sadar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-info mb-4">
                                    <label for="street_address1">Street Address</label>
                                    <input class="billing-address" placeholder="Street Address" type="text" name="street_address1" id="street_address1">
                                    <input placeholder="Street Address" type="text" name="street_address2">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4">
                                    <label for="zip_code">Postcode / ZIP</label>
                                    <input type="text" name="zip_code" id="zip_code">
                                </div>
                            </div>

                        </div>
                        <div class="additional-info-wrap">
                            <h4>Additional information</h4>
                            <div class="additional-info">
                                <label for="note">Order notes</label>
                                <textarea placeholder="Notes about your order, e.g. special notes for delivery. " name="note" id="note"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-5 mt-md-30px mt-lm-30px ">
                    <div class="your-order-area">
                        <h3>Your order</h3>
                        <div class="your-order-wrap gray-bg-4">
                            <div class="your-order-product-info">


                                <div class="your-order-bottom">
                                    <ul>
                                        <li class="your-order-shipping">Shipping</li>
                                        <li>Free shipping</li>
                                    </ul>
                                </div>
                                <div class="your-order-total">
                                    <ul>
                                        <li class="order-total">Subtotal</li>
                                        <li class="text-dark">৳{{ session()->get('s_subtotal') }}</li>
                                    </ul>
                                    @if (session()->get('s_discount'))
                                        <ul>
                                            <li class="order-total">Discount ( {{ session()->get('s_voucher') }} )</li>
                                            <li class="text-dark">৳{{ session()->get('s_discount') }}</li>
                                        </ul>
                                    @endif
                                    @if (session()->get('s_discount'))
                                        <ul>
                                            <li class="order-total tx-20 " style="color:#fb5d5d; font-size:28px !important;">Total</li>
                                            <li style="font-size:22px !important;">৳{{  (session()->get('s_subtotal') - session()->get('s_discount')) }}</li>
                                        </ul>
                                    @endif
                                </div>
                            </div>
                            <div class="payment-method">
                                <ul>
                                    <li class="order-total"><input style="height: auto; width:auto" type="radio" id="cod" name="payment_method" value="cod"> <label for="cod">Cash on delivery</label></li>
                                    <li class="order-total"><input style="height: auto; width:auto" type="radio" id="Online" name="payment_method" value="online"> <label for="Online">Online</label></li>
                                </ul>
                            </div>
                        </div>
                        <div class="Place-order mt-25">
                            <button type="submit" class="btn-hover" >Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('inline_style')
<style>
.your-order-area .Place-order button {
    background-color: #fb5d5d;
    color: #fff;
    display: block;
    font-weight: 700;
    letter-spacing: 1px;
    line-height: 1;
    padding: 18px 20px;
    text-align: center;
    text-transform: uppercase;
    border-radius: 0;
    z-index: 9;
    width:100%;
}
.your-order-area .Place-order button:hover {
    background-color: #000;
}
</style>
@endsection
