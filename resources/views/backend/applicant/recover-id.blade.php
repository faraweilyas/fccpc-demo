@extends('layouts.backend.old.base')

@section('custom.css')
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'pages/users/login-3.css') }}" />
@endsection

@section('base_content')
    <div class="d-flex flex-column flex-root">
        <div class="login login-signin-on login-3 d-flex flex-row-fluid" id="kt_login">
            <div
                class="position-absolute top-0 right-0 text-right mt-5 mb-15 mb-lg-0 flex-column-auto justify-content-center py-5 px-10">
                <span class="font-weight-bold ">Do you need help?</span>
                <a data-turbolinks="false" href="{{ route('home.index') }}" class="font-weight-bold ml-2" id="kt_login_signup">Home</a> |
                <a data-turbolinks="false" href="{{ route('home.faqs') }}" class="font-weight-bold ml-2" id="kt_login_signup">FAQ</a> |
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
                            <h3>Application ID Recovery</h3>
                            <div class="font-weight-bold text-black-sm">
                                Provide the information below to request for your application ID
                            </div>
                        </div>
                        <form class="form" method="POST" action="{{ route('applicant.authenticate.track') }}">
                            @csrf
                            <div class="form-group">
                                <input
                                    type="email"
                                    value="{{ old('email') }}"
                                    placeholder="Email:"
                                    name="email"
                                    class="form-control h-auto form-control-solid py-4 px-8"
                                    autocomplete="off"
                                    required
                                />
                                <p class="my-2">
                                    @error('email')
                                        <span class="text-danger mb-5 float-left display__block">*{{ $message }}</span>
                                    @enderror
                                </p>
                            </div>
                            <div class="form-group text-left">
                                <label>Do you have access to email provided?</label>
                                <div class="radio-inline">
                                    <label class="radio">
                                        <input
                                            type="radio"
                                            name="access"
                                            value="yes"
                                        />
                                        Yes<span></span>
                                    </label>
                                    <label class="radio">
                                        <input
                                            type="radio"
                                            name="access"
                                            value="NO"
                                        />
                                        No<span></span>
                                    </label>
                                </div>
                                <p class="my-2">
                                    @error('access')
                                        <span class="text-danger mb-5 float-left display__block">*{{ $message }}</span>
                                    @enderror
                                </p>
                            </div>
                            <div class="form-group">
                                <select id="get_categories" class="form-control" name="category">
                                    <option>Select Category</option>
                                    @foreach(\AppHelper::get('case_categories') as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                <p class="my-2">
                                    @error('category')
                                        <span class="text-danger mb-5 float-left display__block">*{{ $message }}</span>
                                    @enderror
                                </p>
                            </div>
                            <div class="form-group">
                                <input
                                    type="text"
                                    value="{{ old('subject') }}"
                                    placeholder="Subject:"
                                    name="subject"
                                    class="form-control h-auto form-control-solid py-4 px-8"
                                    autocomplete="off"
                                    required
                                />
                                <p class="my-2">
                                    @error('subject')
                                        <span class="text-danger mb-5 float-left display__block">*{{ $message }}</span>
                                    @enderror
                                </p>
                            </div>
                            <div class="form-group text-left">
                                <label>Parties</label> <span class="text-danger">*</span>
                                <div class="fields">
                                    <div class="field-item">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Enter party name"
                                                    name="party[]"
                                                    required
                                                />
                                                <div class="d-md-none mb-2"></div>
                                            </div>
                                            <div class="col-lg-6">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Enter party name"
                                                    name="party[]"
                                                />
                                                <div class="d-md-none mb-2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-12 text-right">
                                        <a href="javascript:;" id="add-party-fields">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                <x-icons.add-more></x-icons.add-more>
                                            </span>
                                            <span class="text-primary">&nbsp;&nbsp;Add More</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-left">
                                <label>Transaction Type</label>
                                <div class="radio-inline">
                                    <label class="radio">
                                        <input
                                            type="radio"
                                            name="type"
                                            value="SM"
                                        />
                                        Small<span></span>
                                    </label>
                                    <label class="radio">
                                        <input
                                            type="radio"
                                            name="type"
                                            value="LG"
                                        />
                                        Large<span></span>
                                    </label>
                                </div>
                                <p class="my-2">
                                    @error('type')
                                        <span class="text-danger mb-5 float-left display__block">*{{ $message }}</span>
                                    @enderror
                                </p>
                            </div>
                        </div>
                            <button
                                id="kt_login_signin_submit"
                                type="submit"
                                class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4"
                            >
                                Submit
                            </button>
                        </form>
                        <div class="mt-10">
                            <p>
                                <a
                                    href="{{ route('applicant.track') }}"
                                    id="kt_login_signup2"
                                    class="text-hover-primary font-weight-bold text-black-sm"
                                >
                                    Manage Application
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom.javascript')
    <script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'id-recovery.js') }}"></script>
@endsection
