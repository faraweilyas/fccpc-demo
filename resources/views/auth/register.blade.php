@extends('layouts.backend.base')

@section('base_content')
    <div class="d-flex flex-column flex-root">
        <div class="login login-signin-on login-3 d-flex flex-row-fluid" id="kt_login">
            <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url({{ asset(BE_MEDIA.'bg/bg-3.jpg') }});">
                <div class="login-form text-center p-7 position-relative overflow-hidden">
                    <div class="d-flex flex-center mb_15">
                        <a href="{{ route('home.index') }}">
                            <img src="{{ asset(FE_IMAGE.'icons/fccpc_logo.jpg') }}" class="maxh_130" />
                        </a>
                    </div>
                    <div class="login-signup">
                        <div class="mb-20">
                            <h3>Sign Up</h3>
                            <div class="text-dark font-weight-bold">Create a new admin account</div>
                        </div>
                        <form class="form" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-5">
                                        <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="First Name" name="first_name" />
                                        @error('first_name')
                                            <span class="text-danger mb-5 float-left display__block">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-5">
                                        <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Last Name" name="last_name" />
                                        @error('last_name')
                                            <span class="text-danger mb-5 float-left display__block">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-5">
                                <input class="form-control h-auto form-control-solid py-4 px-8" type="email" placeholder="Email" name="email" autocomplete="off" />
                                @error('email')
                                    <span class="text-danger mb-5 float-left display__block">*{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-5">
                                <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Password" name="password" />
                                @error('password')
                                    <span class="text-danger mb-5 float-left display__block">*{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-5">
                                <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Confirm Password" name="password_confirmation" />
                                @error('password_confirmation')
                                    <span class="text-danger mb-5 float-left display__block">*{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group d-flex flex-wrap flex-center mt-10">
                                <input type="hidden" name="account_type" value="AD" />
                                <button type="submit" id="kt_login_signup_submit2" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">Sign Up</button>
                            </div>
                        </form>
                        <div class="mt-10">
                            <p>
                                <span class="opacity-70">Already have an account yet?</span>
                                <a href="{{ route('login') }}" id="kt_login_signup2" class="text-muted text-hover-primary font-weight-bold">Sign In!</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
