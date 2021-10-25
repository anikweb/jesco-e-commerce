@extends('frontend.master')

@section('content')
 <!-- login area start -->
 <div class="login-register-area pt-100px pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-bs-toggle="tab" href="#lg1">
                            <h4>login</h4>
                        </a>
                        @if (basicSettings()->new_registration==2)
                            <a data-bs-toggle="tab" href="#lg2">
                                <h4>register</h4>
                            </a>
                        @endif
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="{{ route('login') }}" method="post">
                                        @csrf
                                        @error('email')
                                            <div class="text-danger">
                                                <i class="fa fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <input type="text" name="email" class="@error('email') is-invalid @enderror" placeholder="E-mail" />
                                        @error('password')
                                            <div class="text-danger">
                                                <i class="fa fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <input type="password" class="@error('password')is-invalid @enderror" name="password" placeholder="Password" autocomplete="current-password"  />
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <input type="checkbox" id="remember" name="remember"/>
                                                <label class="flote-none" for="remember">Remember me</label>
                                                <a href="#">Forgot Password?</a>
                                            </div>
                                            <button type="submit"><span>Login</span></button>
                                        </div>
                                    </form>
                                    <div class="row mt-3">
                                        {{-- Github Login --}}
                                            <div class="col-md-5 mx-auto mt-2 bg-dark p-2 ">
                                                <a href="{{ url('github/redirect') }}" class="d-inline-block">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <img  width="20px" src="{{ asset('assets/images/socail-login/255-2558173_github-logo-png-transparent-png.png') }}" alt="github">
                                                        </div>
                                                        <div class="col-md-10">
                                                            <p class="text-white">Continue With Github</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        {{-- Gmail Login
                                        <div class="col-md-5 mt-2 mx-auto bg-primary p-2 ">
                                            <a href="" class="d-inline-block">
                                                <div class="row">
                                                    <div class="col-md-2 bg">
                                                        <img width="20px" src="{{ asset('assets/images/socail-login/gmail.png') }}" alt="github">
                                                    </div>
                                                    <div class="col-md-10">
                                                        <p class="text-white">Continue With Gmail</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="lg2" class="tab-pane">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="{{ route('register') }}" method="post">
                                        @csrf
                                        <input type="text" name="name" placeholder="Full Name" />
                                        <input type="email" name="email" placeholder="Email" />
                                        <input type="password" name="password" placeholder="Password" autocomplete="new-password" />
                                        <input type="password" name="password_confirmation" placeholder="Confirm Password" />
                                        <div class="button-box">
                                            <button type="submit"><span>Register now</span></button>
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
<!-- login area end -->

@endsection
