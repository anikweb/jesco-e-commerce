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
                        <div class="tab-pane fade active show" id="account-details">
                            <h3 class="p-2 rounded" style="background: #fb5d5d; color:white">Personal Information </h3>
                            <div class="login">
                                <div class="login_form_container">
                                    <div class="account_login_form">
                                        <form action="{{ route('my-account.personal.information.update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="personal_information_id" value="{{ $personalInformation->id }}">
                                            <div class="default-form-box mb-20">
                                                <label for="name">Full Name</label>
                                                <input type="text" name="name" id="name" @error('name') style="border: 1px solid red" @enderror placeholder="Enter full name" value="{{ $personalInformation->user->name }}">
                                                @error('name')
                                                    <div class="text-danger">
                                                        <i class="fa fa-exclamation-circle"></i>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label for="username">Username</label>
                                                <input type="text" name="username" id="username" @error('username') style="border: 1px solid red" @enderror value="{{ $personalInformation->username }}">
                                                @error('username')
                                                    <div class="text-danger">
                                                        <i class="fa fa-exclamation-circle"></i>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label for="mobile">Mobile</label>
                                                <input type="text" name="mobile" id="mobile" @error('mobile') style="border: 1px solid red" @enderror value="@if(isset($personalInformation->mobile)){{$personalInformation->mobile}}@endif">
                                                @error('mobile')
                                                    <div class="text-danger">
                                                        <i class="fa fa-exclamation-circle"></i>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>Birthdate</label>
                                                <input type="date" name="birth_date" value="@if(isset($personalInformation->birth_date)){{$personalInformation->birth_date}}@endif">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="region_id">Region</label>
                                                    <select name="region_id" class="form-control" id="region_id">
                                                        <option value="">Select</option>
                                                        @foreach ($regions as $region)
                                                            <option @if ($personalInformation->region_id ==$region->id ) selected @endif value="{{ $region->id }}">{{ $region->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="district_id">District</label>
                                                    <select name="district_id" class="form-control" id="district_id">
                                                        <option  value="{{ $personalInformation->district_id }}">@if(isset($personalInformation->district->name)){{$personalInformation->district->name}}@endif</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="upazila_id">Upazila</label>
                                                    <select name="upazila_id" class="form-control" id="upazila_id">
                                                        <option value="{{ $personalInformation->upazila_id }}">@if(isset($personalInformation->upazila->name)){{ $personalInformation->upazila->name }}@endif</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label for="street_address1">Street Address 1</label>
                                                <input type="text" id="street_address1" name="street_address1" value="{{ $personalInformation->street_address1 }}">
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label for="street_address2">Street Address 2</label>
                                                <input type="text" name="street_address2" id="street_address2" value="{{ $personalInformation->street_address2 }}">
                                            </div>

                                            <div class="input-radio">
                                                <label >Gender: </label>
                                                <span class="custom-radio"><input type="radio" value="male" name="gender" @if ($personalInformation->gender =='male')checked @endif> Male</span>
                                                <span class="custom-radio"><input type="radio" value="female" name="gender" @if ($personalInformation->gender =='female')checked @endif> Female</span>
                                                <span class="custom-radio"><input type="radio" value="other" name="gender" @if ($personalInformation->gender =='other')checked @endif> Other</span>
                                            </div>
                                            <div class="save_button mt-3">
                                                <button class="btn" type="submit">Save Changes</button>
                                            </div>
                                        </form>
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
        });
    </script>
@endsection
