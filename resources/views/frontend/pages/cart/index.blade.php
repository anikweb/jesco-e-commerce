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
                                            <td class="product-price-cart"><span class="amount">???{{ $offer_price }}</span></td>
                                            <td class="product-quantity" data-id="{{ $cart->id }}" data-loop="{{ $loop->index }}">
                                                <div class="cart-plus-minus"><div class="dec qtybutton">-</div>
                                                    <input class="cart-plus-minus-box qty-box{{$cart->id}}" type="text" name="qtybutton" value="{{$cart->quantity}}">
                                                <div class="inc qtybutton">+</div></div>
                                            </td>
                                            <td class="product-subtotal proSubtotal{{$cart->id}}">???{{ $subtotal =  $cart->quantity * $offer_price   }}</td>
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
                                        <a href="{{ route('frontend.product') }}">Continue Shopping</a>
                                    </div>
                                    <div class="cart-clear">
                                        <a href="{{ url()->current() }}" >Update Shopping Cart</a>
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
                                    <h4 class="cart-bottom-title section-bg-gray">Use Voucher Code</h4>
                                </div>
                                <div class="discount-code">
                                    <p>Enter your voucher code if you have one.</p>

                                            @if (session('error'))
                                                <div class="text-danger">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    {{ session('error') }}
                                                </div>
                                            @endif
                                            @if ($voucher)
                                            <div class="text-success">
                                                <i class="fa fa-check-circle"></i>
                                               <span>You applied Voucher</span>
                                            </div>
                                        @endif

                                            @if ($voucher)
                                                <input type="text" id="add_voucher_input" value="{{$voucher->name}}" style="border: 3px solid green; background:gray; color:#fff" disabled>
                                                <button id="remove_voucher_btn" class="cart-btn-2" type="submit">Remove Voucher</button>
                                            @else
                                            @php
                                                session()->forget(['s_voucher','s_discount'])
                                            @endphp
                                                <input type="text" id="add_voucher_input">
                                                <button id="add_voucher_btn" class="cart-btn-2" type="submit">Apply Voucher</button>
                                            @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12 mt-md-30px">
                            <div class="grand-totall">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                                </div>
                                <h5>Sub-Total <span class="grand-subtotal">???{{ $cartTotalPrice }}</span></h5>
                                @if ($voucher)
                                    <h5>Discount (<em class="text-primary"> {{ $voucher->name }} </em>) <span>???{{ ($cartTotalPrice*$voucher->discount)/100 }}</span></h5>
                                    <h4 class="grand-totall-title">Total <span>???{{ $cartTotalPrice - ($cartTotalPrice*$voucher->discount)/100  }}</span></h4>
                                @else
                                <h4 class="grand-totall-title">Grand Total <span>???{{ $cartTotalPrice }}</span></h4>

                                @endif
                                <a href="{{ route('checkout.index') }}">Proceed to Checkout</a>
                            </div>
                        </div>
                        @php
                            session()->put('s_subtotal',$cartTotalPrice);
                            session()->put('s_total',$cartTotalPrice);
                            if($voucher){
                                session()->put('s_discount',($cartTotalPrice*$voucher->discount)/100);
                                session()->put('s_voucher',$voucher->name);
                                session()->put('s_total',$cartTotalPrice - ($cartTotalPrice*$voucher->discount)/100);
                            }
                        @endphp
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_js')
    <script>
        $("#add_voucher_btn").click(function(){
            var voucherInput =  $("#add_voucher_input").val();
            if(voucherInput !=''){
                window.location.href = "{{ route('cart.index') }}/"+voucherInput;
            }
        });
        $("#remove_voucher_btn").click(function(){
            window.location.href = "{{ route('cart.remove.voucher') }}";
        });
       $('.product-quantity').click(function(){
        // /{id}
        var cart_id = $(this).attr('data-id');
        var quantity = $('.qty-box'+cart_id).val();
        //    alert(cart_id);
            $.ajax({
                type: "GET",
                url: "{{ url('cart/quantity/update') }}/"+cart_id+"/"+quantity,
                success:function(res){
                    if(res){
                        console.log('.proSubtotal'+cart_id);
                        $('.proSubtotal'+cart_id).html('???'+res*quantity);
                        // location.reload();

                    }
                }
            });

       });
    </script>
@endsection
