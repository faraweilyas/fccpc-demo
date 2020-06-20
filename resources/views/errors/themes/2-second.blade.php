@extends('errors.themes.layout')

@section('theme')
    <div class="d-flex flex-column flex-root">
        <div
            class="d-flex flex-row-fluid bgi-size-cover bgi-position-center"
            style="background-image: url({{ pc_asset(BE_MEDIA.'error/bg2.jpg') }});"
        >
            <div class="d-flex flex-row-fluid flex-column justify-content-end align-items-center text-center text-white pb-40">
                <h1 class="display-1 font-weight-bold">
                    @yield('code', 'Oops...')
                </h1>
                <span class="display-4 font-weight-boldest mb-8">
                    @yield('message', 'Looks like something went wrong.')
                </span>
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
