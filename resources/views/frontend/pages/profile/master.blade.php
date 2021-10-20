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
                                <a href="{{ route('my-account.index') }}" class="nav-link @if (Route::is('my-account.index')) active @endif">Dashboard</a>
                            </li>
                            <li>
                                <a href="{{ route('my-account.delivered.order') }}"  class="nav-link @if (Route::is('my-account.delivered.order')) active @endif" >Delivered Orders</a>
                            </li>
                            <li>
                                <a href="{{ route('my-account.personal.information') }}"  class="nav-link @if (Route::is('my-account.personal.information')||Route::is('my-account.personal.information.edit')) active @endif">Personal Information</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard_content" data-aos="fade-up" data-aos-delay="200">
                        {{-- Content  --}}
                        @yield('profile_content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
