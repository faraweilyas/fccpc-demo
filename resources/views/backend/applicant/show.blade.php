@extends('layouts.backend.old.base')

@section('custom.css')
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'pages/users/login-3.css') }}" />
@endsection

@section('base_content')
    <div class="d-flex flex-column flex-root">
        <div class="login login-signin-on login-3 d-flex flex-row-fluid" id="kt_login">
            <div
                class="position-absolute top-0 right-0 text-right mt-5 mb-15 mb-lg-0 flex-column-auto justify-content-center py-5 px-10">
                <span class="font-weight-bold text-dark-50">Do you need help?</span>
                <a data-turbolinks="false" href="{{ route('home.index') }}" class="font-weight-bold ml-2" id="kt_login_signup">Home</a> |
                <a data-turbolinks="false" href="{{ route('home.faqs.category', ['category' => 'GEN']) }}" class="font-weight-bold ml-2" id="kt_login_signup">FAQ</a> |
                <a data-turbolinks="false" href="{{ route('home.fee.calculator') }}" class="font-weight-bold ml-2" id="kt_login_signup">
                    Fee Calculator
                </a>
            </div>
            <div
                class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat"
                style="background-image: url({{ asset(BE_MEDIA.'bg/bg-3.jpg') }}"
            >
                <div class="login-form text-center p-7 position-relative overflow-hidden">
                    <div class="d-flex flex-center mb_15">
                        <a data-turbolinks="false" href="{{ route('home.index') }}">
                            <img src="{{ asset(FE_IMAGE.'icons/fccpc_logo.jpg') }}" class="maxh_130" />
                        </a>
                    </div>
                    <div class="login-signin">
                        <div class="mb_30">
                            <h3>Merger Notification</h3>
                            <div class="font-weight-bold text-black-sm">Enter your email to begin:</div>
                            <small class="text-danger">
                                Note: the email provided would be used in all further correspondence on the notification.
                            </small>
                        </div>
                        <form class="form" method="POST" action="{{ route('applicant.store') }}">
                            @csrf
                            <div class="form-group mb-5">
                                <input type="email" placeholder="Email address:" name="email"
                                    class="form-control h-auto form-control-solid py-4 px-8" autocomplete="off" required />
                                @error('email')
                                <span class="text-danger mb-5 float-left display__block">*{{ $message }}</span>
                                @enderror
                            </div>
                            <button
                                id="kt_login_signin_submit"
                                type="submit"
                                class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4"
                            >
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
