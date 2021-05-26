@extends('layouts.backend.old.user')

@section('mobile_navigation')
    <div id="kt_header_mobile" class="header-mobile bg-primary header-mobile-fixed">
        <a data-turbolinks="false" href="/">
            <h3 class="text-white text-bold font-weight-bolder " style="color: white !important">{!! config("app.name") !!}</h3>
        </a>
        <div class="d-flex align-items-center">
            <a href="/">
                <button class="btn p-0 ml-2">
                    <span class="svg-icon svg-icon-xl svg-icon-white">
                        <x-icons.sign-out></x-icons.sign-out>
                    </span>
                    <span class="text-white">Sign Out</span>
                </button>
            </a>
        </div>
    </div>
@endsection

@section('navigation')
    <div class="header-top">
        <div class="container">
            <div class="d-none d-lg-flex align-items-center mr-3">
                <a data-turbolinks="false" href="/" class="mr-20">
                    <h3 class="text-white text-bold font-weight-bolder " style="color: white !important">{!! config("app.name") !!}</h3>
                </a>
            </div>
            @isset($guest)
                <div class="topbar">
                    <div class="topbar-item mx-2" id="kt_quick_cart_toggle">
                        <div class="btn btn-icon btn-hover-transparent-white w-auto d-flex align-items-center btn-lg px-2">
                            <span class="symbol symbol-35 mx-2">
                                <img src="{{ pc_asset(BE_IMAGE.'svg/fee_calculator.svg') }}" alt="Layout_horizontal" />
                            </span>
                            <a href="#">
                                <span class="text-white font-weight-bolder font-size-sm d-none d-md-inline">
                                    Fee Calculator
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="topbar-item">
                        <div class="btn btn-icon btn-hover-transparent-white w-auto d-flex align-items-center btn-lg px-2">
                            <a href="#">
                                <div class="d-flex flex-column text-right pr-3">
                                    <span class="text-white font-weight-bolder font-size-sm d-none d-md-inline">
                                        {{ $guest->getTrackingID() }}
                                    </span>
                                    <span class="text-white opacity-50 font-weight-bold font-size-sm d-none d-md-inline">
                                        {{ $guest->email }}
                                    </span>
                                </div>
                            </a>
                            <span class="symbol symbol-35">
                                <span class="symbol-label font-size-h5 font-weight-bold text-white bg-white-o-30">
                                    {{ $guest->getInitials() }}
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="topbar-item">
                        <div class="btn btn-icon btn-hover-transparent-white w-auto d-flex align-items-center btn-lg px-2">
                            <div class="d-flex flex-column text-right pr-3">
                                <a data-turbolinks="false" href="/" title="Logout">
                                    <span class="text-white font-weight-bold font-size-sm d-none d-md-inline">
                                        <span class="svg-icon svg-icon-xl svg-icon-white">
                                            <x-icons.sign-out></x-icons.sign-out>
                                        </span>
                                        Sign Out
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </div>
@endsection

@section('custom.css')
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_LAYOUT_CSS.'style.bundle.css') }}" />
@endsection

