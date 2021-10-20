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
        <form id="checkout_form" action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-7">
                    <div class="billing-info-wrap">
                        <h3>Billing Details</h3>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="billing-info mb-4">
                                    <label for="name">Name</label>
                                    <input type="text" value="{{ Auth::user()->name }}" name="name" id="name" @error('name') style="border:1px solid red" @enderror>
                                    @error('name')
                                        <div class="text-danger">
                                            <i class="fa fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-info mb-4">
                                    <label for="company">Company / Shop Name <em class="text-muted">(optional)</em> </label>
                                    <input type="text" name="company" id="company" placeholder="Enter company / shop name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" value="{{ $cusPerInfo->mobile }}" id="phone" placeholder="Enter phone or mobile number" @error('phone') style="border:1px solid red" @enderror>
                                    @error('phone')
                                        <div class="text-danger">
                                            <i class="fa fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4">
                                    <label for="email">Email Address</label>
                                    <input type="text" name="email" value="{{ $cusPerInfo->user->email }}" id="email" placeholder="Enter email address.">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="billing-select mb-4">
                                    <label for="region_id">Region</label>
                                    <select name="region_id" id="region_id" @error('region_id') style="border:1px solid red" @enderror>
                                        <option value="">Select</option>
                                        @foreach ($divisions as $division)
                                            <option @if($cusPerInfo->region_id == $division->id ) selected @enderror value="{{ $division->id }}">{{ $division->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('region_id')
                                        <div class="text-danger">
                                            <i class="fa fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="billing-select mb-4">
                                    <label for="district_id">City</label>
                                    <select name="district_id" id="district_id" @error('district_id') style="border:1px solid red" @enderror>
                                        <option value="{{ $cusPerInfo->district_id }}">{{ $cusPerInfo->district->name }}</option>
                                    </select>
                                    @error('district_id')
                                        <div class="text-danger">
                                            <i class="fa fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="billing-select mb-4">
                                    <label for="upazila_id">Upazila</label>
                                    <select name="upazila_id" id="upazila_id" @error('upazila_id') style="border:1px solid red" @enderror>
                                        <option value="{{  $cusPerInfo->upazila_id }}">{{ $cusPerInfo->upazila->name }}</option>
                                    </select>
                                    @error('upazila_id')
                                        <div class="text-danger">
                                            <i class="fa fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-info mb-4">
                                    <label for="street_address1">Street Address</label>
                                    <input class="billing-address" value="{{ $cusPerInfo->street_address1 }}" placeholder="Street Address" type="text" name="street_address1" id="street_address1">
                                    <input placeholder="Street Address" value="{{ $cusPerInfo->street_address2 }}" type="text" name="street_address2">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4">
                                    <label for="zip_code">Postcode / ZIP</label>
                                    <input type="text" name="zip_code" value="{{ $cusPerInfo->zip_code }}" id="zip_code" placeholder="Enter postcode / zip code">
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
                                    <li class="order-total"><input style="height: auto; width:auto" type="radio"  id="cod" name="payment_method" value="cod"> <label for="cod">Cash on delivery</label></li>
                                    <li class="order-total"><input style="height: auto; width:auto" type="radio" id="Online"  name="payment_method" value="online"> <label for="Online">Online</label></li>
                                </ul>
                                @error('payment_method')
                                    <div class="text-danger">
                                        <i class="fa fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
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
@php
    $total = (session()->get('s_subtotal') - session()->get('s_discount') + 20);
    session()->put('s_total',$total);
@endphp
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
@section('footer_js')
    <script>
        $(document).ready(function(){
            $("#region_id").change(function(){
                var region_id = $("#region_id").val();
                // alert(region_id);
                $.ajax({
                    type:"GET",
                    url:"{{url('get/district')}}/"+region_id,
                    success:function(res){
                        if(res){
                            $("#district_id").empty();
                            $("#district_id").append('<option>Select</option>');
                            $.each(res,function(key,value){
                                $("#district_id").append('<option value="'+value.id+'">'+value.name+'</option>');
                            });
                            $("#district_id").change(function(){
                                var district_id = $("#district_id").val();
                               $.ajax({
                                    type:"GET",
                                    url:"{{url('get/upazila')}}/"+district_id,
                                    success:function(res){
                                        if(res){
                                            $("#upazila_id").empty();
                                            $("#upazila_id").append('<option>Select</option>');
                                            $.each(res,function(key,value){
                                                $("#upazila_id").append('<option value="'+value.id+'">'+value.name+'</option>');
                                            });
                                        }else{
                                            $("#state").empty();
                                        }
                                    }
                                });
                            });
                        }else{
                            $("#state").empty();
                        }
                    }
                });
            });

            $('#cod').change(function(){
                $("#checkout_form").attr("action","{{ route('checkout.store') }}");

            });
            $('#Online').change(function(){
                $("#checkout_form").attr("action","{{ url('/pay') }}");
            });
        });
    </script>
@endsection
