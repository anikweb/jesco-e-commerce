@extends('backend.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                      @if ($order->current_status ==1)
                      <li class="breadcrumb-item"><a href="{{ route('dashboard.orders.index') }}">Picup in Progress</a></li>
                      @elseif($order->current_status ==2)
                      <li class="breadcrumb-item"><a href="{{ route('dashboard.orders.shipped') }}">Shipped</a></li>
                      @elseif($order->current_status ==3)
                      <li class="breadcrumb-item"><a href="{{ route('dashboard.orders.outForDelivered') }}">Out for Delivery</a></li>
                      @elseif($order->current_status ==4)
                      <li class="breadcrumb-item"><a href="{{ route('dashboard.orders.delivered') }}">Delivered</a></li>
                      @elseif($order->current_status ==5)
                      <li class="breadcrumb-item"><a href="{{ route('dashboard.orders.canceled') }}">Canceled</a></li>
                        @endif
                      <li class="breadcrumb-item active">Details</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
       <div class="row">
           <div class="col-md-12">
               <div class="card card-primary">
                   <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-dolly"></i> Invoice No: {{ $order->invoice_no }}</h3>
                   </div>
                   <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($order->current_status !=5)
                                <h2>Status:
                                    <span class="badge badge-success">
                                        @if ($order->current_status ==1)
                                           <i class="fa fa-dolly"></i> Picup in Progress
                                        @elseif($order->current_status ==2)
                                        <i class="fa fa-shipping-fast"></i>  Shipped
                                        @elseif($order->current_status ==3)
                                        <i class="fa fa-dolly-flatbed"></i> Out for Delivery
                                        @elseif($order->current_status ==4)
                                        <i class="fa fa-truck-loading"></i> Delivered
                                        @endif
                                    </span>
                                </h2>
                            @else
                                <h2>Status:
                                    <span class="badge badge-danger">
                                        @if ($order->current_status ==5)
                                        <i class="fa fa-exclamation-circle"></i> Canceled
                                        @endif
                                    </span>
                                </h2>
                            @endif
                            <h5>
                                @if($order->delivered_date)
                                    Delivered Date <strong>{{ Carbon\Carbon::parse($order->delivered_date)->format('Y-m-d, h:i A') }}
                                    </strong>
                                @endif
                            </h5>
                            <h3>Bill To</h3>
                            <p style="padding: 0;margin:0">Client: <strong>{{ $order->billing_details->name }}</strong> </p>
                            <p style="padding: 0;margin:0">Company: <strong>{{ $order->billing_details->company }}</strong> </p>
                            <p style="padding: 0;margin:0">Address: <strong> @if($order->billing_details->street_adress1) {{ $order->billing_details->street_adress1}} @endif @if($order->billing_details->street_adress2) {{ ', '.$order->billing_details->street_adress2 }} @endif {{ ','.$order->billing_details->upazila->name.','.$order->billing_details->district->name.','.$order->billing_details->division->name }}  </strong> </p>
                            @if ($order->billing_details->email)
                            <p style="padding: 0;margin:0">Email: <strong>{{ $order->billing_details->email }}</strong> </p>
                            @endif
                            @if ($order->billing_details->phone)
                            <p style="padding: 0;margin:0">Email: <strong>{{ $order->billing_details->phone }}</strong> </p>
                            @endif
                            <p style="padding: 0;margin:0">Order Date and time: <strong> {{ $order->billing_details->created_at->format('d-M-Y, h:i A') }} </strong> </p>
                            <p style="padding: 0 0 15px 0;margin:0">Order Note: <strong>{{ $order->billing_details->note }}</strong> </p>

                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Product</th>
                                            <th>Thumbnail</th>
                                            <th>Summary</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>Shipping Charge</th>
                                            <th>QTY</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($order->order_details as $order_details)
                                            <tr>
                                                <td>{{ $loop->index +1 }}</td>
                                                <td>{{ $order_details->product->name }}</td>
                                                <td>
                                                    <img src="{{ asset('assets/images/product').'/'.$order_details->product->created_at->format('Y/m/d/').$order_details->product->id.'/thumbnail/'.$order_details->product->thumbnail }}" alt="{{ $order_details->product->name }}" width="80px">
                                                   </td>
                                                <td>{{ $order_details->product->summary }}</td>
                                                <td>{{ Str::title($order_details->product->attribute->first()->color->name )}}</td>
                                                <td>{{ $order_details->product->attribute->first()->size_id}}</td>
                                                <td>{{ $order_details->product->attribute->first()->offer_price.'/-' }}</td>
                                                <td>20/-</td>
                                                <td>{{ $order_details->quantity }}</td>
                                                @php
                                                    $total = $total + ($order_details->product->attribute->first()->offer_price *  $order_details->quantity)+(20);
                                                @endphp
                                                <td>{{ ($order_details->product->attribute->first()->offer_price *  $order_details->quantity)+(20) }}/-</td>
                                            </tr>

                                        @endforeach
                                        <tr>
                                            <td colspan="9" class="text-right font-weight-bold">Sub Total</td>
                                            <td>{{ $total.'/-' }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="9" class="text-right font-weight-bold">Discount</td>
                                            @if ($order->discount)
                                            <td>{{ $order->discount.'/-' }}</td>
                                            @else
                                            <td>0</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td colspan="9" class="text-right font-weight-bold">Total</td>
                                            <td>{{ $total - $order->discount.'/-' }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="9" class="text-right font-weight-bold">Payment</td>
                                            <td>
                                                @if ($order->payment_status == 1)
                                                    Unpaid
                                                @elseif($order->payment_status == 2)
                                                    Paid
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
        @if (session('success'))
            toastr["success"]("{{ session('success') }}");
        @elseif(session('error'))
            toastr["error"]("{{ session('error') }}");
        @endif
    </script>

@endsection
