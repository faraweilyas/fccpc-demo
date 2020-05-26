@extends('layouts.backend.base-login')
@section('content')
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-signin-on login-3 d-flex flex-row-fluid" id="kt_login">
        <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url({{ asset(BE_MEDIA.'bg/bg-3.jpg') }});">
            <div class="login-form text-center p-7 position-relative overflow-hidden">
                <!--begin::Login Header-->
                <div class="d-flex flex-center mb_15">
                    <a href="{{ route('home.index') }}">
                        <img src="{{ asset(FE_IMAGE.'icons/fccpc_logo.jpg') }}" class="maxh_130" />
                    </a>
                </div>
                <!--end::Login Header-->
                <!--begin::Login Sign up form-->
                <div class="login-signup">
                    <div class="mb-20">
                        <h3>Sign Up</h3>
                        <div class="text-dark font-weight-bold">Enter your details to create your account</div>
                    </div>
                    <form class="form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-5">
                                    <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="First Name" name="firstName" />
                                    @error('firstName')
                                        <p class="text-danger text-left mt-2">* {{ $message }}</p> 
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-5">
                                    <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Last Name" name="lastName" />
                                    @error('lastName')
                                        <p class="text-danger text-left mt-2">* {{ $message }}</p> 
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-5">
                            <input class="form-control h-auto form-control-solid py-4 px-8" type="email" placeholder="Email" name="email" autocomplete="off" />
                            @error('email')
                                <p class="text-danger text-left mt-2">* {{ $message }}</p> 
                            @enderror
                        </div>
                        <div class="form-group mb-5">
                            <input class="hide" type="password" />
                            <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Password" name="password" />
                        </div>
                        <div class="form-group mb-5">
                            <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Confirm Password" name="password_confirmation" />
                            @error('password')
                                <p class="text-danger text-left mt-2">* {{ $message }}</p> 
                            @enderror
                        </div>
                        <div class="form-group d-flex flex-wrap flex-center mt-10">
                            <input type="hidden" name="accountType" value="AD" />
                            <button type="submit" id="kt_login_signup_submit2" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">Sign Up</button>
                        </div>
                    </form>
                    <div class="mt-10">
                        <span class="opacity-70 mr-4">Already have an account yet?</span>
                        <a href="{{ route('login') }}" id="kt_login_signup2" class="text-muted text-hover-primary font-weight-bold">Sign In!</a>
                    </div>
                </div>
                <!--end::Login Sign up form-->
            </div>
        </div>
    </div>
    <!--end::Login-->
</div>
@endSection