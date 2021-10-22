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
                        <li class="breadcrumb-item active">Track</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <div class="account-dashboard pt-100px pb-100px">
        <div class="container">
            <div class="row">

                <div class="col-sm-12 col-md-12 col-lg-12">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard_content" data-aos="fade-up" data-aos-delay="200">
                        <div class="tab-pane fade active show" id="account-details">
                            <h3>Track Order </h3>
                            <div class="login">
                                <div class="login_form_container">
                                    <div class="account_login_form">
                                        <div class="input-group mb-3">
                                            <input type="text" id="track-input-box" class="form-control" placeholder="Enter Invoice No">
                                            <div class="input-group-append">
                                                <button id="track-input-btn" style="border-radius: inherit;background: #000; padding: 15px; color: #ffffff;height: 50px;width: 70px;" class="btn" type="button"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card search-result" style="display: none">
                        <div class="card-header bg-primary ">
                            <h3 class="card-title text-white "> Track Order</h3>
                        </div>
                        <div class="card-body">
                            <h3 style="background:#3cbf155e" class="d-inline p-2 rounded">Status: <span class="status"></span></h3>
                            <div class="table_page table-responsive mt-3">
                                <table style="width: 99% !important">
                                    <thead>
                                        <tr>
                                            <th>Invoice</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            {{-- <th>Details</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="invoice-data"></td>
                                            <td class="date-data"></td>
                                            <td class="amount-data"></td>
                                            {{-- <td class="details-data"></td> --}}
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card search-fail" style="display: none">
                        <div class="card-header bg-primary ">
                            <h3 class="card-title text-white "> Track Order</h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="bg-danger p-3">
                                <p class="lead text-light"><i class="fa fa-exclamation-circle"></i> No Orders Found by this Invoice <span class="fail-invoice"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_js')
    <script>
        $(document).ready(function(){
            $("#track-input-btn").click(function(){
                var invoice_no = $("#track-input-box").val();
                // alert(invoice_no);
                $.ajax({
                    type: "GET",
                    url: "{{ url('my-account/orders/track/search') }}/"+invoice_no,
                    success:function(res){
                        if(res.invoice_no){
                            $('.search-fail').hide();
                            $(".search-result").show();
                            console.log(res);
                            $('.invoice-data').html(res.invoice_no);
                            var timestamp = res.created_at;
                            var date = new Date(timestamp);
                            // console.log(date.getTime())
                            // console.log(date)
                            $('.date-data').html(date.getDate()+'-'+date.getMonth()+'-'+date.getFullYear());
                            $('.amount-data').html('৳'+res.total_price);
                            if(res.current_status == 1){
                                $('.status').html('Picup in Progress');
                            }else if (res.current_status == 2){
                                $('.status').html('Shipped');
                            }else if (res.current_status == 3){
                                $('.status').html('Out for Delivery');
                            }else if (res.current_status == 4){
                                $('.status').html('Delivered');
                            }else if (res.current_status == 5){
                                $('.status').html('Canceled');
                            }
                            // $('.details-data').html('<a href="#"> <i class="fa fa-eye"></i> Details</a>');

                        }else{
                            $(".search-result").hide();
                            $('.search-fail').show();
                            $('.fail-invoice').html('\''+invoice_no+'\'');
                        }
                    }
                });
            });
        });
    </script>
@endsection
