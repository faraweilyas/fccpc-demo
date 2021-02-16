@extends('layouts.backend.base')

@section('custom.css')
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'pages/users/login-3.css') }}" />
@endsection

@section('base_content')
    <div class="d-flex flex-column flex-root">
        <div class="login login-signin-on login-3 d-flex flex-row-fluid" id="kt_login">
            <div
                class="position-absolute top-0 right-0 text-right mt-5 mb-15 mb-lg-0 flex-column-auto justify-content-center py-5 px-10">
                <span class="font-weight-bold text-dark-50">Do you need help?</span>
                <a data-turbolinks="false" href="{{ route('home.index') }}" class="font-weight-bold ml-2"
                    id="kt_login_signup">Home</a> |
                <a data-turbolinks="false" href="{{ route('home.faqs.category', ['category' => 'GEN']) }}" class="font-weight-bold ml-2"
                    id="kt_login_signup">FAQ</a> |
                <a data-turbolinks="false" href="{{ route('home.fee.calculator') }}" class="font-weight-bold ml-2"
                    id="kt_login_signup">Fee Calculator</a>
            </div>
            <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url({{ asset(BE_MEDIA.'bg/bg-3.jpg') }}">
                <div class="login-form text-center p-7 position-relative overflow-hidden">
                    <div class="d-flex flex-center mb_15">
                        <a data-turbolinks="false" href="{{ route('home.index') }}">
                            <img src="{{ asset(FE_IMAGE.'icons/fccpc_logo.jpg') }}" class="maxh_130" />
                        </a>
                    </div>
                    <div class="login-signin">
                        <div class="mb-20">
                            <h3>Login</h3>
                            <div class="text-dark font-weight-bold">If you have an account with us, please log in.</div>
                        </div>
                        <form class="form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group mb-5">
                                <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Email" name="email" autocomplete="off" />
                                <p>
                                    @error('email')
                                        <span class="text-danger mb-5 float-left display__block">*{{ $message }}</span>
                                    @enderror
                                </p>
                            </div>
                            <div class="form-group mb-5">
                                <input class="hide" type="password" />
                                <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Password" name="password" />
                                <p>
                                    @error('password')
                                        <span class="text-danger mb-5 float-left display__block">*{{ $message }}</span>
                                    @enderror
                                </p>
                            </div>
                            <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                                <label class="checkbox m-0 text-muted">
                                <input type="checkbox" name="remember" />Remember me
                                <span></span></label>
                                <a href="{{ route('password.request') }}" id="kt_login_forgot" class="text-muted font-weight-bold text-hover-primary">Forgot Password?</a>
                            </div>
                            <button type="submit" id="kt_login_signin_submit2" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Sign In</button>
                        </form>
                        <div class="mt-10">
                            <p>
                                <span class="opacity-70">Don't have an account yet?</span>
                                <a href="{{ route('register') }}" id="kt_login_signup2" class="text-muted text-hover-primary font-weight-bold"> Sign Up!</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
