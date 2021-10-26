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
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard_content" data-aos="fade-up" data-aos-delay="200">
                        {{-- Content  --}}
                        <div class="profile-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card ">
                                        <div class="card-header" style="background:#fb5d5d; ">
                                            <h3 class="card-title" style="color:white;">Personal Information </h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5>Name:
                                                        <strong>
                                                        @if (isset($personalInformation->user->name))
                                                        {{ $personalInformation->user->name }}
                                                        @endif
                                                        </strong></h5>
                                                    <h6>Username:
                                                        <strong>
                                                        @if (isset($personalInformation->username))
                                                        {{ $personalInformation->username }}
                                                        @endif
                                                    </strong> </h6>
                                                    <h6>Mobile:
                                                        <strong>
                                                            @if (isset($personalInformation->mobile))
                                                            {{ $personalInformation->mobile }}
                                                            @endif
                                                        </strong> </h6>
                                                    <h6>Email:
                                                        <strong>
                                                            @if (isset($personalInformation->user->email))
                                                            {{ $personalInformation->user->email }}
                                                            @endif
                                                        </strong> </h6>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6>Date of Birth:
                                                        <strong>
                                                            @if (isset($personalInformation->birth_date))
                                                            {{ $personalInformation->birth_date }}
                                                            @endif
                                                        </strong></h6>
                                                    <h6>Gender:
                                                        <strong>
                                                            @if (isset($personalInformation->gender))
                                                            {{ $personalInformation->gender }}
                                                            @endif
                                                        </strong></h6>
                                                    <h6>Street Address:
                                                        <strong>
                                                            @if (isset($personalInformation->street_address1))
                                                            {{ $personalInformation->street_address1 }}
                                                            @endif
                                                        </strong>
                                                        <strong>
                                                            @if (isset($personalInformation->street_address2))
                                                            {{ ','.$personalInformation->street_address2 }}
                                                            @endif
                                                        </strong>

                                                    </h6>
                                                    <h6>Upazila:
                                                        <strong>
                                                            @if (isset($personalInformation->upazila->name))
                                                            {{ $personalInformation->upazila->name }}
                                                            @endif
                                                        </strong></h6>
                                                    <h6>District:
                                                        <strong>
                                                            @if (isset($personalInformation->district->name))
                                                            {{ $personalInformation->district->name }}
                                                            @endif
                                                        </strong></h6>
                                                    <h6>Division:
                                                        <strong>
                                                            @if (isset($personalInformation->region->name))
                                                            {{ $personalInformation->region->name }}
                                                            @endif
                                                        </strong></h6>
                                                </div>
                                                <div class="col-md-12">
                                                    <a href="{{ route('my-account.personal.information.edit',$personalInformation->username) }}" class="btn-sm btn-primary">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
