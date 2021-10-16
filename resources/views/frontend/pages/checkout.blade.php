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
        <div class="row">
            <div class="col-lg-7">
                <div class="billing-info-wrap">
                    <h3>Billing Details</h3>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="billing-info mb-4">
                                <label>Name</label>
                                <input type="text" value="{{ Auth::user()->name }}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="billing-info mb-4">
                                <label>Company / Shop Name <em class="text-muted">(optional)</em> </label>
                                <input type="text">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="billing-select mb-4">
                                <label>Country</label>
                                <select>
                                    <option>Select a country</option>
                                    <option>Azerbaijan</option>
                                    <option>Bahamas</option>
                                    <option>Bahrain</option>
                                    <option>Bangladesh</option>
                                    <option>Barbados</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="billing-info mb-4">
                                <label>Street Address</label>
                                <input class="billing-address" placeholder="House number and street name" type="text">
                                <input placeholder="Apartment, suite, unit etc." type="text">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="billing-info mb-4">
                                <label>Town / City</label>
                                <input type="text">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-4">
                                <label>State / County</label>
                                <input type="text">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-4">
                                <label>Postcode / ZIP</label>
                                <input type="text">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-4">
                                <label>Phone</label>
                                <input type="text">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-4">
                                <label>Email Address</label>
                                <input type="text">
                            </div>
                        </div>
                    </div>

                    <div class="additional-info-wrap">
                        <h4>Additional information</h4>
                        <div class="additional-info">
                            <label>Order notes</label>
                            <textarea placeholder="Notes about your order, e.g. special notes for delivery. " name="message"></textarea>
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
                        <a class="btn-hover" href="#">Place Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
