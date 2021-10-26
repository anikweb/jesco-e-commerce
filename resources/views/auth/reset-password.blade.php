@extends('frontend.master')

@section('content')
 <!-- login area start -->
 <div class="login-register-area pt-100px pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a>
                            <h4>Reset Password</h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                                <div><i class="fa fa-exclamation-circle"></i>{{ $error }}</div>
                                            @endforeach
                                        </div>
                                    @endif
                                    <form action="{{ route('password.update') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" value="{{ old('email',$request->email) }}" placeholder="Enter your email" autofocus  />
                                        <label for="password">New Password</label>
                                        <input type="password" name="password" id="password" value="{{ old('password') }}" placeholder="Enter new password" autofocus  />
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password') }}" placeholder="Confirm password" autofocus  />
                                        <div class="button-box">
                                            <button type="submit"><span>Reset password</span></button>
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

