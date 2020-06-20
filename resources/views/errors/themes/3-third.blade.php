@extends('errors.themes.layout')

@section('error_style')
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'pages/error/error-3.css') }}" />
@endsection

@section('theme')
    <div class="d-flex flex-column flex-root">
        <div
            class="error error-3 d-flex flex-row-fluid bgi-size-cover bgi-position-center"
            style="background-image: url({{ pc_asset(BE_MEDIA.'error/bg3.jpg') }});"
        >
            <div class="px-10 px-md-30 py-10 py-md-0 d-flex flex-column justify-content-md-center">
                <h1 class="error-title text-stroke text-transparent">
                    @yield('code', 'Oops...')
                </h1>
                <p class="display-4 font-weight-boldest text-white mb-12">
                    @yield('message', 'Looks like something went wrong.')
                </p>
                <p class="font-size-h4 line-height-md">
                    <a href="{{ url()->previous() }}" class="btn btn-light mr-2">
                        <i class="flaticon2-fast-back"></i> Go Back
                    </a>
                    &nbsp;or &nbsp;
                    <a href="{{ route('home.index') }}" class="btn btn-light mr-2">
                        <i class="flaticon-home"></i> Go Home
                    </a>
                </p>
            </div>
        </div>
    </div>
@endsection
