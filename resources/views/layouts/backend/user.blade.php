@extends('layouts.backend.base_layout')

@section('base_content')
<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
    <a href="/dashboard" style="color: #fff">
      @if (\Auth::user()->account_type == 'SP')
          <img src="{{ pc_asset(BE_IMAGE.'svg/supervisor.svg') }}" alt="supervisor" />
      @elseif (\Auth::user()->account_type == 'AD')
          <img src="{{ pc_asset(BE_IMAGE.'svg/ma_fccpc.svg') }}" alt="ma_fccpc" />
      @elseif (\Auth::user()->account_type == 'CH')
          <img src="{{ pc_asset(BE_IMAGE.'svg/case_handler.svg') }}" alt="case_handler" />
      @else
          <img src="{{ pc_asset(BE_IMAGE.'svg/ma_fccpc.svg') }}" alt="ma_fccpc" />
      @endif
    </a>
    <div class="d-flex align-items-center">
      <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
        <span></span>
      </button>
      <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle" onclick="window.location.href = '{{ route('dashboard.profile') }}';">
        <span class="svg-icon svg-icon-xl svg-icon-white">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
            viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <polygon points="0 0 24 0 24 24 0 24" />
              <path
                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                fill="#000000" fill-rule="nonzero" opacity="0.3" />
              <path
                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                fill="#000000" fill-rule="nonzero" />
            </g>
          </svg>
        </span>
      </button>
    </div>
  </div>
  <div class="d-flex flex-column flex-root">
    <div class="d-flex flex-row flex-column-fluid page">
   @yield('aside_bar')
      <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
        <div id="kt_header" class="header header-fixed">
          @yield('top_navigation')
        </div>
        <div class="content d-flex flex-column flex-column-fluid">
          @yield('content')
        </div>
      </div>
    </div>
  </div>
@endsection
