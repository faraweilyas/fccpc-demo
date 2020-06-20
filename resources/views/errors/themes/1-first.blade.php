@extends('errors.themes.layout')

@section('theme')
    <div class="d-flex flex-column flex-root">
        <div
            class="d-flex flex-row-fluid flex-column bgi-size-cover bgi-position-center bgi-no-repeat p-10 p-sm-30"
            style="background-image: url({{ pc_asset(BE_MEDIA.'error/bg1.jpg') }});"
        >
            <h1 class="font-weight-boldest text-dark-75 mt-15" style="font-size: 10rem">
                @yield('code', 'Oops...')
            </h1>
            <p class="font-size-h3 text-muted font-weight-normal">
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
@endsection
