@extends('errors.themes.layout')

@section('error_style')
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'pages/error/error-5.css') }}" />
@endsection

@section('theme')
<div class="d-flex flex-column flex-root">
    <div
        class="error error-5 d-flex flex-row-fluid bgi-size-cover bgi-position-center"
        style="background-image: url({{ pc_asset(BE_MEDIA.'error/bg5.jpg') }});"
    >
        <div class="container d-flex flex-row-fluid flex-column justify-content-md-center p-12">
            <h1 class="error-title font-weight-boldest text-info mt-10 mt-md-0 mb-12">
                @yield('code', 'Oops...')
            </h1>
            <p class="font-weight-boldest display-4">
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
