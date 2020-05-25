@extends('layouts.backend.base-login')
@section('content')
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-signin-on login-3 d-flex flex-row-fluid" id="kt_login">
        <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url({{ asset(BE_MEDIA.'bg/bg-3.jpg') }}">
            <div class="login-form text-center p-7 position-relative overflow-hidden">
               <!--begin::Login Header-->
                <div class="d-flex flex-center mb_15">
                    <a href="{{ route('home.index') }}">
                        <img src="{{ asset(FE_IMAGE.'icons/fccpc_logo.jpg') }}" class="maxh_130" />
                    </a>
                </div>
                <!--end::Login Header-->
                <!--begin::Login Sign in form-->
                <div class="login-signin">
                    <div class="mb-20">
                        <h3>Registered Customers</h3>
                        <div class="text-dark font-weight-bold">If you have an account with us, please log in.</div>
                    </div>
                    <form class="form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group mb-5">
                            <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Email" name="email" autocomplete="off" />
                            @error('email')
                                <p class="text-danger text-left mt-2">* {{ $message }}</p> 
                            @enderror
                        </div>
                        <div class="form-group mb-5">
                            <input class="hide" type="password" />
                            <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Password" name="password" />
                            @error('password')
                                <p class="text-danger text-left mt-2">* {{ $message }}</p> 
                            @enderror
                        </div>
                        <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                            <label class="checkbox m-0 text-muted">
                            <input type="checkbox" name="remember" />Remember me
                            <span></span></label>
                        </div>
                        <button type="submit" id="kt_login_signin_submit2" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Sign In</button>
                    </form>
                </div>
                <!--end::Login Sign in form-->
            </div>
        </div>
    </div>
    <!--end::Login-->
</div>
@endSection