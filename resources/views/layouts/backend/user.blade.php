@extends('layouts.backend.base')

@section('base_content')

    @yield('mobile_navigation')

    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-row flex-column-fluid page">
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <div id="kt_header" class="header flex-column header-fixed">

                    @yield('navigation')

                </div>

                @yield('content')

                {{-- <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
                    <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted font-weight-bold mr-2">{{ date('Y') }} &copy;</span>
                            <a href="{{ COMPANY_LINK }}" target="_blank" class="footer-brand-logo">
                                <img class="max-h-20px" src="{{ BE_IMAGE.'logo/techbarn-logo.png' }}" alt="techbarn logo"/>
                            </a>
                        </div>
                    </div>
                </div> --}}

                </div>
        </div>
    </div>

@endsection
