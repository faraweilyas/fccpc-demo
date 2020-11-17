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
            <a href="{{ route('dashboard.profile') }}">
                <button class="btn p-0 ml-2">
                    <span class="svg-icon svg-icon-xl svg-icon-white">
                        <x-icons.profile></x-icons.profile>

                    </span>
                </button>
            </a>
            <a
                href="{{ route('logout') }}"
                title="Logout"
                onclick="event.preventDefault(); document.getElementById('mobile-form-logout').submit();"
            >
                <button class="btn p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                    <span class="svg-icon svg-icon-xl svg-icon-white">
                        <x-icons.sign-out></x-icons.sign-out>
                    </span>
                </button>
            </a>
            <form id="mobile-form-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>

@endsection

@section('navigation')

    <!-- Top navigation -->
    <div class="header-top hide-small-md">
        <div class="container">
            <div class="d-none d-lg-flex align-items-center mr-3">
                <a data-turbolinks="false" href="/" class="mr-20">
                    <h3 class="text-white text-bold font-weight-bolder text-dark">{!! config("app.name") !!}</h3>
                </a>
            </div>
            <div class="topbar">
                <div class="topbar-item">
                    <div class="btn btn-icon btn-hover-transparent-white w-auto d-flex align-items-center btn-lg px-2">
                        <a href="{{ route('dashboard.profile') }}">
                            <div class="d-flex flex-column text-right pr-3">
                                <span class="text-white opacity-50 font-weight-bold font-size-sm d-none d-md-inline">
                                    {{ Auth::user()->getAccountType() }}
                                </span>
                                <span class="text-white font-weight-bolder font-size-sm d-none d-md-inline">
                                    {{ Auth::user()->getFullName() }}
                                </span>
                            </div>
                        </a>
                        <span class="symbol symbol-35">
                            <span class="symbol-label font-size-h5 font-weight-bold text-white bg-white-o-30">
                                {{ Auth::user()->getInitials() }}
                            </span>
                        </span>
                    </div>
                </div>
                <div class="topbar-item">
                    <div class="btn btn-icon btn-hover-transparent-white w-auto d-flex align-items-center btn-lg px-2">
                        <div class="d-flex flex-column text-right pr-3">
                            <a href="{{ route('logout') }}" title="Logout" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">
                                <span class="text-white font-weight-bold font-size-sm d-none d-md-inline">
                                    <span class="svg-icon svg-icon-xl svg-icon-white">
                                        <x-icons.sign-out></x-icons.sign-out>

                                    </span>
                                    <form id="form-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                    Sign Out
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="header-bottom">
        <div class="container">
            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                <div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile header-menu-layout-default">
                    <ul class="menu-nav">
                        <li class="menu-item menu-item-open menu-item-here menu-item-submenu menu-item-rel menu-item-open menu-item-here">
                            <a href="{{ route('dashboard.index') }}" class="menu-link">
                                <span class="menu-text">Dashboard</span>
                                <span class="menu-desc">...</span>
                                <i class="menu-arrow"></i>
                            </a>
                        </li>

                        @if(!in_array(\Auth::user()->account_type, ['AD']))
                        <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
                            <a href="javascript:;" class="menu-link menu-toggle">
                                <span class="menu-text">Cases</span>
                                <span class="menu-desc">...</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                <ul class="menu-subnav">
                                    @if(in_array(\Auth::user()->account_type, ['SP']))
                                    <li class="menu-item menu-item-submenu" aria-haspopup="true">
                                        <a href="{{ route('cases.unassigned') }}" class="menu-link">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                               <x-icons.case-file></x-icons.case-file>
                                            </span>
                                            &nbsp;&nbsp;<span class="menu-text">New Cases</span></a>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    @endif
                                    <li class="menu-item menu-item-submenu" aria-haspopup="true">
                                        <a href="{{ route('cases.assigned') }}" class="menu-link">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                               <x-icons.assigned-cases></x-icons.assigned-cases>
                                            </span>
                                            &nbsp;&nbsp;<span class="menu-text">Assigned Cases</span></a>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endif

                        @if(in_array(\Auth::user()->account_type,['SP']))
                        <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
                            <a href="javascript:;" class="menu-link menu-toggle">
                                <span class="menu-text">Case Handlers</span>
                                <span class="menu-desc">...</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                <ul class="menu-subnav">
                                    <li class="menu-item menu-item-submenu" aria-haspopup="true">
                                        <a href="{{ route('handlers.create') }}" class="menu-link">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                               <x-icons.new-case-handler></x-icons.new-case-handler>
                                            </span>
                                            &nbsp;&nbsp;<span class="menu-text">New Case Handler</span></a>
                                        </a>
                                    </li>
                                     <li class="menu-item menu-item-submenu" aria-haspopup="true">
                                        <a href="{{ route('handlers.index') }}" class="menu-link">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                               <x-icons.view-case-handler></x-icons.view-case-handler> 
                                            </span>
                                            &nbsp;&nbsp;<span class="menu-text">View Handlers</span></a>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endif

                        @if(in_array(\Auth::user()->account_type, ['AD']))
                        <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
                            <a href="javascript:;" class="menu-link menu-toggle">
                                <span class="menu-text">Users</span>
                                <span class="menu-desc">...</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                <ul class="menu-subnav">
                                    <li class="menu-item menu-item-submenu" aria-haspopup="true">
                                        <a href="{{ route('dashboard.create_user') }}" class="menu-link">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                <x-icons.new-case-handler></x-icons.new-case-handler>
                                            </span>
                                            &nbsp;&nbsp;<span class="menu-text">Create User</span></a>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu" aria-haspopup="true">
                                        <a href="{{ route('dashboard.users') }}" class="menu-link">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                <x-icons.profile></x-icons.profile>
                                                </span>
                                            &nbsp;&nbsp;<span class="menu-text">View Users</span></a>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endif
                        @if(in_array(\Auth::user()->account_type, ['SP', 'AD']))
                        <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
                            <a href="javascript:;" class="menu-link menu-toggle">
                                <span class="menu-text">Enquiries</span>
                                <span class="menu-desc">...</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                <ul class="menu-subnav">
                                    <li class="menu-item menu-item-submenu" aria-haspopup="true">
                                        <a href="{{ in_array(\Auth::user()->account_type, ['SP', 'AD']) ? route('enquiries.logs') : route('enquiries.assigned-logs') }}" class="menu-link">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                <x-icons.text-file></x-icons.text-file>
                                            </span>
                                            &nbsp;&nbsp;<span class="menu-text">Enquiry log</span></a>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endif
                        @if(in_array(\Auth::user()->account_type,['AD']))
                        <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
                            <a href="javascript:;" class="menu-link menu-toggle">
                                <span class="menu-text">FAQ</span>
                                <span class="menu-desc">...</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                <ul class="menu-subnav">
                                    <li class="menu-item menu-item-submenu" aria-haspopup="true">
                                        <a href="{{ route('faq.create') }}" class="menu-link">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                <x-icons.faq-plus></x-icons.faq-plus>
                                            </span>
                                            &nbsp;&nbsp;<span class="menu-text">Create FAQ</span></a>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu" aria-haspopup="true">
                                        <a href="{{ route('faq.faqs') }}" class="menu-link">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                <x-icons.text-file></x-icons.text-file>
                                            </span>
                                            &nbsp;&nbsp;<span class="menu-text">FAQs</span></a>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection


