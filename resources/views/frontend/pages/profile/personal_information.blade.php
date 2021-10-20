@extends('frontend.pages.profile.master')
@section('profile_content')
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
                                <h5>Name: <strong>{{ $personalInformation->user->name }}</strong></h5>
                                <h6>Username: <strong>{{ $personalInformation->username }}</strong> </h6>
                                <h6>Mobile: <strong>{{ $personalInformation->mobile }}</strong> </h6>
                                <h6>Email: <strong>{{ $personalInformation->user->email }}</strong> </h6>
                            </div>
                            <div class="col-md-6">
                                <h6>Date of Birth: <strong>{{ $personalInformation->birth_date }}</strong></h6>
                                <h6>Gender: <strong>{{ Str::title($personalInformation->gender) }}</strong> </h6>
                                <h6>Street Address: <strong>@if ($personalInformation->street_address1) {{ Str::title($personalInformation->street_address1) }} @endif @if ($personalInformation->street_address2) {{ ','.$personalInformation->street_address2 }} @endif </strong> </h6>
                                <h6>Upazila: <strong>{{ $personalInformation->upazila->name }}</strong> </h6>
                                <h6>District: <strong>{{ $personalInformation->district->name }}</strong> </h6>
                                <h6>Division: <strong>{{ $personalInformation->region->name }}</strong> </h6>
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
@endsection
