@extends('errors.themes.layout')

@section('error_style')
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'pages/error/error-4.css') }}" />
@endsection

@section('theme')
    <div class="d-flex flex-column flex-root">
        <div
            class="error error-4 d-flex flex-row-fluid bgi-size-cover bgi-position-center"
            style="background-image: url({{ pc_asset(BE_MEDIA.'error/bg4.jpg') }});"
        >
            <div class="d-flex flex-column flex-row-fluid align-items-center align-items-md-start justify-content-md-center text-center text-md-left px-10 px-md-30 py-10 py-md-0 line-height-xs">
                <h1 class="error-title text-success font-weight-boldest line-height-sm">
                    @yield('code', 'Oops...')
                </h1>
                <p class="display-4 text-danger font-weight-boldest mt-md-0 line-height-md">
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
