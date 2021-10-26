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
                            <h4>Forgot Password</h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <p>Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            <i class="fa fa-check"></i>
                                            {{ session('status') }}
                                        </div>
                                        @endif
                                       @error('email')
                                       <div class="alert alert-danger">
                                        {{ $message }}
                                       </div>
                                       @enderror
                                    <form action="{{ route('password.email') }}" method="post">
                                        @csrf

                                        @error('password')
                                            <div class="text-danger">
                                                <i class="fa fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <input type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter your email" autofocus  />
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

