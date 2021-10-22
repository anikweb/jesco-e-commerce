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
                        <li class="breadcrumb-item active">Account</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <div class="account-dashboard pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <!-- Nav tabs -->
                    <div class="dashboard_tab_button" data-aos="fade-up" data-aos-delay="0">
                        <ul role="tablist" class="nav flex-column dashboard-list">
                            <li>
                                <a href="{{ route('my-account.orders') }}"  class="nav-link" >My Orders</a>
                            </li>
                            <li>
                                <a href="{{ route('my-account.delivered.order') }}"  class="nav-link @if (Route::is('my-account.delivered.order')) active @endif" >Delivered Orders</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard_content" data-aos="fade-up" data-aos-delay="200">
                        {{-- Content  --}}
                        <div class="profile-content">
                            <div class="table_page table-responsive">
                                <table style="width: 99% !important">
                                    <thead>
                                        <tr>
                                            <th>Invoice</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>invoice</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($billings as $billing)
                                            @if ($billing->order_summary->first()->current_status == 4 )
                                                <tr>
                                                    <td>{{ $billing->order_summary->first()->invoice_no }}</td>
                                                    <td>{{ $billing->created_at->format('D-M-y') }}</td>
                                                    <td>
                                                        @foreach ($billing->order_summary as $order_summary)
                                                        {{ '৳'.$order_summary->total_price }}
                                                        @endforeach
                                                    </td>
                                                    <td><a href="{{ route('my-account.invoice.download',$billing->id) }}" class="view"><i class="fa fa-download"></i> Download Invoice</a></td>
                                                </tr>
                                            @endif
                                        @empty
                                        <tr>
                                            <td colspan="3"> <i class="fa fa-exclamation-circle"></i> Empty</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="p-3">
                                    {{ $billings->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
