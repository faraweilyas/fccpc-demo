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
                    <div class="d-flex flex-center mb_15 mt-20">
                        <a data-turbolinks="false" href="{{ route('home.index') }}">
                            <img src="{{ asset(FE_IMAGE.'icons/fccpc_logo.jpg') }}" class="maxh_130" />
                        </a>
                    </div>
                    <div class="login-signin">
                        <div class="mb-20">
                            <h3>{{ __('Reset Password') }}</h3>
                        </div>
                        <form class="form" method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group mb-5">
                                @error('email')
                                    <span class="text-danger mb-5 float-left display__block">*{{ $message }}</span>
                                @enderror
                                <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Email" name="email" autocomplete="off" />
                            </div>
                            <div class="form-group mb-5">
                                @error('password')
                                    <span class="text-danger mb-5 float-left display__block">*{{ $message }}</span>
                                @enderror
                                <input class="hide" type="password" />
                                <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Password" name="password" />
                            </div>
                            <div class="form-group mb-5">
                                <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Password" name="password_confirmation" />
                            </div>
                            <div class="form-group text-center mt-10">
                                <button type="submit" id="kt_login_signin_submit2" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
