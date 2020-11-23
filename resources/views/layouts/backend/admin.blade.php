@extends('layouts.backend.user')

@section('aside_bar')
<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
    <div class="brand flex-column-auto" id="kt_brand">
        <a href="/dashboard" class="brand-logo">
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
        <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
            <span class="svg-icon svg-icon svg-icon-xl">
               <x-icons.arrow-white-right></x-icons.arrow-white-right>
            </span>
        </button>
    </div>

    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">

        <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
            data-menu-dropdown-timeout="500">

            <ul class="menu-nav">

                <li class="menu-item " aria-haspopup="true">
                    <a href="{{ route('dashboard.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                                 <x-icons.dashboard></x-icons.dashboard>
                        </span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                @if(!in_array(\Auth::user()->account_type, ['AD']))
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <x-icons.mycases></x-icons.mycases>
                        </span>
                        <span class="menu-text">@if(!in_array(\Auth::user()->account_type, ['SP'])) My @endif
                            Cases</span>

                        <img src="{{ pc_asset(BE_IMAGE.'svg/drop_down.svg') }}" alt="arrow" />

                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">My Cases</span>
                                </span>
                            </li>
                            @if(in_array(\Auth::user()->account_type, ['SP']))
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{ route('cases.unassigned') }}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">New Cases</span>
                                </a>
                            </li>
                            @endif
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{ route('cases.assigned') }}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text"> @if(in_array(\Auth::user()->account_type, ['CH'])) New
                                        @else Assigned @endif Cases</span>
                                </a>
                            </li>
                            @if(in_array(\Auth::user()->account_type, ['CH', 'SP']))
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{ route('cases.working_on') }}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Ongoing Cases</span>
                                </a>
                            </li>
                            @endif
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{ route('cases.on-hold') }}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Cases On Hold</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @if(in_array(\Auth::user()->account_type,['SP']))
                <li class="menu-item " aria-haspopup="true">
                    <a href="{{ route('handlers.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <x-icons.case-handler></x-icons.case-handler>
                        </span>
                        <span class="menu-text">Case Handlers</span>
                    </a>
                </li>
                @endif
                @if(in_array(\Auth::user()->account_type, ['SP', 'AD']))
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <x-icons.enquire></x-icons.enquire>
                        </span>
                        <span class="menu-text">Enquiries</span>
                        <img src="{{ pc_asset(BE_IMAGE.'svg/drop_down.svg') }}" alt="arrow" />
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Enquiries</span>
                                </span>
                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{ in_array(\Auth::user()->account_type, ['SP', 'AD']) ? route('enquiries.logs') : route('enquiries.assigned-logs') }}"
                                    class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Enquiry log</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
                <li class="menu-item " aria-haspopup="true">
                    <a href="{{ route('dashboard.report') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <x-icons.generate-report></x-icons.generate-report>
                        </span>
                        <span class="menu-text">Generate Report</span>
                    </a>
                </li>
                @endif
                @if(in_array(\Auth::user()->account_type, ['AD']))
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu_icon_custom">
                            <x-icons.users></x-icons.users>
                        </span>
                        <span class="menu-text">Users</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{ route('dashboard.create_user') }}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Create User</span>
                                </a>
                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{ route('dashboard.users') }}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Users</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <x-icons.faq></x-icons.faq>
                        </span>
                        <span class="menu-text">FAQ</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{ route('faq.create') }}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Create FAQ</span>
                                </a>
                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{ route('faq.faqs') }}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">FAQs</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
                <li class="menu-item " aria-haspopup="true">
                    <a href="{{ route('dashboard.profile') }}" class="menu-link">
                        <span class="svg-icon menu_icon_custom">
                            <x-icons.settings></x-icons.settings>
                        </span>
                        <span class="menu-text">Profile</span>
                    </a>
                </li>
                <li class="menu-item" aria-haspopup="true">
                    <a href="#" class="menu-link">
                        <span class="svg-icon menu_icon_custom">
                            <x-icons.sign-out></x-icons.sign-out>
                        </span>
                        <span class="menu-text" href="{{ route('logout') }}" title="Logout"
                            onclick="event.preventDefault(); document.getElementById('form-logout').submit();">Sign
                            Out</span>
                        <form id="form-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
        <!--begin::Header-->
        <div class="offcanvas-header offcanvas-header-navs d-flex align-items-center justify-content-between mb-5">
            <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary flex-grow-1 px-10"
                role="tablist">

                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#kt_quick_user_panel">Ongoing Cases</a>
                </li>

            </ul>
            <div class="offcanvas-close mt-n1 pr-5">
                <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
                    <i class="ki ki-close icon-xs text-muted"></i>
                </a>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Content-->
        <div class="offcanvas-content pr-5 mr-n5">
            @php
            $cases = \Auth::user()->cases_working_on()->get();
            @endphp
            @foreach($cases as $case)
            <!-- case-handler -->
            <div class="notifications-cards cr-pointer"
                onclick="window.location.href = '{{ route('cases.analyze', [$case->id]) }}';">
                <div class="d-flex">
                    <div class="notifications-card-col w-100">
                        <p class="subject my-1">{{ $case->subject }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="notifications-card-col w-75">
                        <p class="subject my-1">{{ $case->applicant_firm }}</p>
                        <p class="title">CATEGORY:</p>

                        <span class="description">{!! $case->getCategoryHtml() !!}</span>
                    </div>
                    <div class="notifications-card-col">
                        <p class="title">PARTIES:</p>

                        <span class="description">{!! $case->generateCasePartiesBadge('mr_10 mb-2') !!}</span>
                    </div>
                </div>
            </div>
            <!-- case-handler -->
            @endforeach
        </div>
        <!--end::Content-->
    </div>


    <div id="kt_quick_panel" class="offcanvas offcanvas-right pt-5 pb-10">
        <!--begin::Header-->
        <div class="offcanvas-header offcanvas-header-navs d-flex align-items-center justify-content-between mb-5">
            <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary flex-grow-1 px-10"
                role="tablist">

                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#kt_quick_panel_notifications">Notifications</a>
                </li>

            </ul>
            <div class="offcanvas-close mt-n1 pr-5">
                <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_panel_close">
                    <i class="ki ki-close icon-xs text-muted"></i>
                </a>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Content-->
        <div class="offcanvas-content px-10">
            <div class="tab-content">

                <!--begin::Tabpane-->
                <div class="tab-pane fade show pt-3 pr-5 mr-n5 active" id="kt_quick_panel_notifications"
                    role="tabpanel">


                    <!--begin::Nav-->
                    <!-- <div class="navi navi-icon-circle navi-spacer-x-0"> -->
                    <div class="notifications-cards">
                        <span class="label">New Case Assinged</span>
                        <p class="subject my-1">Access Bank Merger</p>

                        <div class="d-flex">
                            <div class="notifications-card-col">
                                <p class="title">CATEGORY:</p>

                                <span class="description">FFM Expedited</span>
                            </div>
                            <div class="notifications-card-col">
                                <p class="title">CATEGORY:</p>

                                <span class="description">FFM Expedited</span>
                            </div>
                        </div>

                    </div>
                    <div class="notifications-cards">
                        <span class="label label-warning">Response to Defincency</span>
                        <p class="subject my-1">Access Bank Merger</p>

                        <div class="d-flex">
                            <div class="notifications-card-col">
                                <p class="title">CATEGORY:</p>

                                <span class="description">FFM Expedited</span>
                            </div>
                            <div class="notifications-card-col">
                                <p class="title">CATEGORY:</p>

                                <span class="description">FFM Expedited</span>
                            </div>
                        </div>

                    </div>
                    <div class="notifications-cards">
                        <span class="label">New Case Assinged</span>
                        <p class="subject my-1">Access Bank Merger</p>

                        <div class="d-flex">
                            <div class="notifications-card-col">
                                <p class="title">CATEGORY:</p>

                                <span class="description">FFM Expedited</span>
                            </div>
                            <div class="notifications-card-col">
                                <p class="title">CATEGORY:</p>

                                <span class="description">FFM Expedited</span>
                            </div>
                        </div>

                    </div>
                    <div class="notifications-cards">
                        <span class="label">New Case Assinged</span>
                        <p class="subject my-1">Access Bank Merger</p>

                        <div class="d-flex">
                            <div class="notifications-card-col">
                                <p class="title">CATEGORY:</p>

                                <span class="description">FFM Expedited</span>
                            </div>
                            <div class="notifications-card-col">
                                <p class="title">CATEGORY:</p>

                                <span class="description">FFM Expedited</span>
                            </div>
                        </div>

                    </div>
                    <!-- </div> -->
                    <!--end::Nav-->
                </div>
                <!--end::Tabpane-->

            </div>
        </div>
        <!--end::Content-->
    </div>



    <div id="kt_quick_cart" class="offcanvas offcanvas-right p-10">
        <!--begin::Header-->
        <div class="offcanvas-header d-flex align-items-center justify-content-between pb-7">
            <h4 class="font-weight-bold m-0" style="font-weight: 700 !important">Fee Calculator</h4>
            <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_cart_close">
                <i class="ki ki-close icon-xs text-muted"></i>
            </a>
        </div>
        <!--end::Header-->
        <!--begin::Content-->
        <div class="offcanvas-content">
            <!--begin::Wrapper-->
          

            <div class="row fee-calc-container my-10">
                <div class="col-md-12">
                    <div class="form-group fee-calc-form-group">
                        <label>Type of Transaction</label>
                        <select class="form-control fee-calc-form" id="typeOfTransaction" name="typeOfTransaction">
                            <option value="local" selected="">Domestic</option>
                            <option value="ffm">Foreign to Foreign</option>
                            <option value="ffx">Foreign to Foreign Expedited</option>
                        </select>
                    </div>

                    <div class="form-group fee-calc-form-group">
                        <label>Combined Turnover</label>
                        <input type="text" id="combinedTurnover" name="combinedTurnover"
                            class="form-control custom-input fee-calc-form form-no-bg" />
                    </div>
                </div>

                <div class="col-md-12 fee-table-container">
                    <div class="fee__calculator--table">
                        <table class="table fee-calc-table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">SERVICE</th>
                                    <th scope="col">PRICE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Filling fee</td>
                                    <td class="fillingFee">₦0.00</td>
                                </tr>

                                <tr>
                                    <td>Processing fee</td>
                                    <td class="processingFee">₦0.00</td>
                                </tr>

                                <tr>
                                    <td>Expedited fee</td>
                                    <td class="expeditedFee">-</td>
                                </tr>
                                <tr class="fee__calculator-total">
                                    <td>
                                        <b>Total</b>
                                    </td>
                                    <td class="totalAmount">₦0.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Content-->
    </div>
</div>

@endsection

@section('top_navigation')

<!-- Top navigation -->
<div class="header-top header-top-custom">
    <div class="container">

        <div class="map mr-20 mb-3">
            <div class="quick-search quick-search-inline ml-4 w-300px" id="kt_quick_search_inline">
                <div class="input-group rounded bg-light">
                    <input type="text" class="form-control h-45px search-input" placeholder="Search..." id="search" />
                </div>
                <div class="autoComplete">
                </div>
            </div>
        </div>
        <div class="topbar">


            <!--begin::Toggle-->

            <!--begin::Toggle-->


            @if(!in_array(\Auth::user()->account_type, ['AD']))
            <div class="topbar-item mx-2" id="kt_quick_panel_toggle">
                <div class="btn btn-icon btn-hover-transparent-white w-auto d-flex align-items-center btn-lg px-2">
                    <span class="symbol symbol-35 mx-2">
                        <img src="{{ pc_asset(BE_IMAGE.'svg/Notification_2.svg') }}" alt="Notification_2" />
                    </span>
                    <a href="#">
                        <span class="text-white font-weight-bolder font-size-sm d-none d-md-inline">
                            Notifications
                        </span>
                    </a>
                </div>
            </div>
            <div class="topbar-item mx-2" id="kt_quick_user_toggle">
                <div class="btn btn-icon btn-hover-transparent-white w-auto d-flex align-items-center btn-lg px-2">
                    <span class="symbol symbol-35 mx-2">
                        <img src="{{ pc_asset(BE_IMAGE.'svg/Layout_horizontal.svg') }}" alt="Layout_horizontal" />
                    </span>
                    <a href="#">
                        <span class="text-white font-weight-bolder font-size-sm d-none d-md-inline">
                            Ongoing Cases
                        </span>
                    </a>
                </div>
            </div>
            <div class="topbar-item mx-2" id="kt_quick_cart_toggle">
                <div class="btn btn-icon btn-hover-transparent-white w-auto d-flex align-items-center btn-lg px-2">
                    <span class="symbol symbol-35 mx-2">
                        <img src="{{ pc_asset(BE_IMAGE.'svg/fee_calculator.svg') }}" alt="Layout_horizontal" />
                    </span>
                    <a href="#">
                        <span class="text-white font-weight-bolder font-size-sm d-none d-md-inline">
                            Fee
                        </span>
                    </a>
                </div>
            </div>
            @endif
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
                        <a href="{{ route('logout') }}" title="Logout"
                            onclick="event.preventDefault(); document.getElementById('form-logout').submit();">
                            <span class="text-white font-weight-bold font-size-sm d-none d-md-inline">
                                <span class="svg-icon svg-icon-xl svg-icon-white">
                                    <x-icons.sign-out></x-icons.sign-out>
                                </span>
                                <form id="form-logout" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                                Sign Out
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom.css')
<link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_PLUGIN.'custom/jqueryui/jquery-ui.css') }}" />
@endsection

@section('custom.javascript')
<script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/jqueryui/jquery-ui.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection
