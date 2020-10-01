@extends('layouts.backend.old.user')

@section('mobile_navigation')

    <div id="kt_header_mobile" class="header-mobile bg-primary header-mobile-fixed">
        <a data-turbolinks="false" href="/">
            <h3 class="text-white text-bold font-weight-bolder text-dark">{!! config("app.name") !!}</h3>
        </a>
        <div class="d-flex align-items-center">
            <button class="btn p-0 burger-icon burger-icon-left ml-4" id="kt_header_mobile_toggle">
                <span></span>
            </button>
            <a href="/">
                <button class="btn p-0 ml-2">
                    <span class="svg-icon svg-icon-xl svg-icon-white">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                            </g>
                        </svg>
                    </span>
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
                    <h3 class="text-white text-bold font-weight-bolder text-dark">{!! config("app.name") !!}</h3>
                </a>
            </div>
            @isset($guest)
                <div class="topbar">
                    <div class="topbar-item">
                        <div class="btn btn-icon btn-hover-transparent-white w-auto d-flex align-items-center btn-lg px-2">
                            <a href="#">
                                <div class="d-flex flex-column text-right pr-3">
                                    <span class="text-white opacity-50 font-weight-bold font-size-sm d-none d-md-inline">
                                        {{ $guest->email }}
                                    </span>
                                    <span class="text-white font-weight-bolder font-size-sm d-none d-md-inline">
                                        {{ $guest->getTrackingID() }}
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
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path d="M14.0069431,7.00607258 C13.4546584,7.00607258 13.0069431,6.55855153 13.0069431,6.00650634 C13.0069431,5.45446114 13.4546584,5.00694009 14.0069431,5.00694009 L15.0069431,5.00694009 C17.2160821,5.00694009 19.0069431,6.7970243 19.0069431,9.00520507 L19.0069431,15.001735 C19.0069431,17.2099158 17.2160821,19 15.0069431,19 L3.00694311,19 C0.797804106,19 -0.993056895,17.2099158 -0.993056895,15.001735 L-0.993056895,8.99826498 C-0.993056895,6.7900842 0.797804106,5 3.00694311,5 L4.00694793,5 C4.55923268,5 5.00694793,5.44752105 5.00694793,5.99956624 C5.00694793,6.55161144 4.55923268,6.99913249 4.00694793,6.99913249 L3.00694311,6.99913249 C1.90237361,6.99913249 1.00694311,7.89417459 1.00694311,8.99826498 L1.00694311,15.001735 C1.00694311,16.1058254 1.90237361,17.0008675 3.00694311,17.0008675 L15.0069431,17.0008675 C16.1115126,17.0008675 17.0069431,16.1058254 17.0069431,15.001735 L17.0069431,9.00520507 C17.0069431,7.90111468 16.1115126,7.00607258 15.0069431,7.00607258 L14.0069431,7.00607258 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.006943, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-9.006943, -12.000000) "/>
                                                    <rect fill="#000000" opacity="0.3" transform="translate(14.000000, 12.000000) rotate(-270.000000) translate(-14.000000, -12.000000) " x="13" y="6" width="2" height="12" rx="1"/>
                                                    <path d="M21.7928932,9.79289322 C22.1834175,9.40236893 22.8165825,9.40236893 23.2071068,9.79289322 C23.5976311,10.1834175 23.5976311,10.8165825 23.2071068,11.2071068 L20.2071068,14.2071068 C19.8165825,14.5976311 19.1834175,14.5976311 18.7928932,14.2071068 L15.7928932,11.2071068 C15.4023689,10.8165825 15.4023689,10.1834175 15.7928932,9.79289322 C16.1834175,9.40236893 16.8165825,9.40236893 17.2071068,9.79289322 L19.5,12.0857864 L21.7928932,9.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(19.500000, 12.000000) rotate(-90.000000) translate(-19.500000, -12.000000) "/>
                                                </g>
                                            </svg>
                                        </span>
                                        Sign Out
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </div>

@endsection
