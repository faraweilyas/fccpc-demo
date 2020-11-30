@extends('layouts.backend.user')

@section('aside_bar')
    <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
        <div class="brand flex-column-auto" id="kt_brand">
            <a href="/dashboard" class="brand-logo">
                @if (\Auth::user()->account_type == 'SP')
                    <img src="{{ pc_asset(BE_IMAGE.'svg/supervisor.svg') }}" alt="supervisor" />
                @elseif (\Auth::user()->account_type == 'AD')
                    <x-icons.map-admin></x-icons.map-admin>
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
                            <span class="menu-text">@if (!in_array(\Auth::user()->account_type, ['SP'])) My @endif
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
                                <x-icons.user-profile-shield></x-icons.user-profile-shield>
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
        {{-- Notifications --}}
        <div id="kt_quick_panel" class="offcanvas offcanvas-right pt-5 pb-10">
            <div class="offcanvas-header offcanvas-header-navs d-flex align-items-center justify-content-between mb-5">
                <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary flex-grow-1 px-10"
                    role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#" id="toggle_notification">Notifications</a>
                    </li>
                </ul>
                <div class="offcanvas-close mt-n1 pr-5">
                    <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_panel_close">
                        <i class="ki ki-close icon-xs text-muted"></i>
                    </a>
                </div>
            </div>
            <div class="offcanvas-content px-10">
                <div class="tab-content">
                    <div
                        class="tab-pane fade show pt-3 pr-5 mr-n5 active"
                        id="kt_quick_panel_notifications"
                        role="tabpanel"
                    >
                        @php
                            $unreadNotifications    = auth()->user()->unreadNotifications;
                            $readNotifications      = auth()->user()->readNotifications;
                        @endphp
                        @forelse ($unreadNotifications as $notification)
                            @php
                                $data           = (object) $notification->data;
                                $action         = getNotificationAction($data->action);
                                $action_style   = getNotificationActionStyle($data->action);
                                $message        = $data->message;
                            @endphp
                            @if ($data->action == "newuser")
                                @php
                                    $user       = \App\Models\User::find($data->user_id);
                                @endphp
                                <div class="notifications-cards mark-notification" data-id="{{ $notification->id }}">
                                    <p class="message my-1">{!! $message !!}</p>
                                    <span class="not_label label label-{{ $action_style }}">{{ $action }}</span>
                                    <p class="my-1">
                                        <span class='subject mr-3'>{{ $user->getFullName() }}</span>
                                        <span class='message'>{{ $user->email }}</span>
                                    </p>
                                    <div class="d-flex">
                                        <div class="notifications-card-col">
                                            <p class="title">Status:</p>
                                            <span class="description">{!! $user->getStatusHtml('uppercase') !!}</span>
                                        </div>
                                        <div class="notifications-card-col">
                                            <p class="title">Date Registered:</p>
                                            <span class="description">{{ $user->getCreatedAt() }}</span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                @php
                                    $case = \App\Models\Cases::find($data->case_id);
                                @endphp
                                <div class="notifications-cards mark-notification" data-id="{{ $notification->id }}">
                                    <p class="message my-1">{!! $message !!}</p>
                                    <span class="not_label label label-{{ $action_style }}">{{ $action }}</span>
                                    <p class="subject my-1">{{ $case->subject }}</p>
                                    <div class="d-flex">
                                        <div class="notifications-card-col">
                                            <p class="title">Category:</p>
                                            <span class="description">{!! $case->getCategory('ucwords') !!}</span>
                                        </div>
                                        <div class="notifications-card-col">
                                            <p class="title">Parties:</p>
                                            <span class="description">{{ $case->getCasePartiesText(FALSE) }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="no-notification">
                                <div class="mr-10"><x-icons.caught-up></x-icons.caught-up></div>
                                <span class="mx-5">You're All Caught Up!</span>
                            </div>
                        @endforelse
                        <hr class='notification_divider' />
                        @if($readNotifications->count() > 0)
                            <p class="my-10">
                                <span class='float-left'>Read</span>
                                <span id="clear-notification" class='float-right cr-pointer text-hover-primary'>Clear</span>
                            </p>
                            <div class="clear-fix"></div>
                            <div id="read-notifications">
                                @foreach ($readNotifications as $notification)
                                    @php
                                        $data           = (object) $notification->data;
                                        $action         = getNotificationAction($data->action);
                                        $action_style   = getNotificationActionStyle($data->action);
                                        $message        = $data->message;
                                    @endphp
                                    @if ($data->action == "newuser")
                                        @php
                                            $user       = \App\Models\User::find($data->user_id);
                                        @endphp
                                        <div class="notifications-cards">
                                            <p class="message my-1">{!! $message !!}</p>
                                            <span class="not_label label label-{{ $action_style }}">{{ $action }}</span>
                                            <p class="my-1">
                                                <span class='subject mr-3'>{{ $user->getFullName() }}</span>
                                                <span class='message'>{{ $user->email }}</span>
                                            </p>
                                            <div class="d-flex">
                                                <div class="notifications-card-col">
                                                    <p class="title">Status:</p>
                                                    <span class="description">{!! $user->getStatusHtml('uppercase') !!}</span>
                                                </div>
                                                <div class="notifications-card-col">
                                                    <p class="title">Date Registered:</p>
                                                    <span class="description">{{ $user->getCreatedAt() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        @php
                                            $case = \App\Models\Cases::find($data->case_id);
                                        @endphp
                                        <div class="notifications-cards">
                                            <p class="message my-1">{!! $message !!}</p>
                                            <span class="not_label label label-{{ $action_style }}">{{ $action }}</span>
                                            <p class="subject my-1">{{ $case->subject }}</p>
                                            <div class="d-flex">
                                                <div class="notifications-card-col">
                                                    <p class="title">Category:</p>
                                                    <span class="description">{!! $case->getCategory('ucwords') !!}</span>
                                                </div>
                                                <div class="notifications-card-col">
                                                    <p class="title">Parties:</p>
                                                    <span class="description">{{ $case->getCasePartiesText(FALSE) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- Ongoing Cases --}}
        <div id="kt_quick_user" class="offcanvas offcanvas-right pt-5 pb-10">
            <div class="offcanvas-header offcanvas-header-navs d-flex align-items-center justify-content-between mb-5">
                <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary flex-grow-1 px-10"
                    role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#" id="toggle_ongoing_case">Ongoing Cases</a>
                    </li>
                </ul>
                <div class="offcanvas-close mt-n1 pr-5">
                    <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
                        <i class="ki ki-close icon-xs text-muted"></i>
                    </a>
                </div>
            </div>
            <div class="offcanvas-content px-10">
                @php
                    $cases_working_on       = \Auth::user()->cases_working_on()->get();
                    $count_cases_working_on = count($cases_working_on);
                @endphp
                <div class="tab-content">
                    <div
                        class="tab-pane fade show pt-3 pr-5 mr-n5 active"
                        id="kt_quick_panel_notifications"
                        role="tabpanel"
                    >
                        @forelse ($cases_working_on as $case)
                            <div
                                class="notifications-cards cr-pointer"
                                onclick="window.location.href = '{{ route('cases.analyze', [$case->id]) }}';"
                            >
                                <p class="firm my-1">{{ $case->applicant_firm }} </p>
                                <p class="subject my-1">{{ $case->subject }}</p>
                                <div class="d-flex">
                                    <div class="notifications-card-col">
                                        <p class="title">Category:</p>
                                        <span class="description">{{ $case->getCategory('ucwords') }}</span>
                                    </div>
                                    <div class="notifications-card-col">
                                        <p class="title">Parties:</p>
                                        <span class="description">{{ $case->getCasePartiesText(FALSE) }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="no-notification">
                                <div class="mr-10"><x-icons.caught-up></x-icons.caught-up></div>
                                <span class="mx-5">You don't have cases you're working on!</span>
                                <br />
                                <a
                                    class="btn btn-transparent mt-10"
                                    style="margin-top: 3.5rem"
                                    href="{{ route('cases.assigned') }}"
                                >
                                    New Cases
                                </a>
                            </div>
                        @endforelse
                        <hr class='notification_divider' />
                    </div>
                </div>
            </div>
        </div>
        {{-- Fee Calculator --}}
        <div id="kt_quick_cart" class="offcanvas offcanvas-right pt-5 pb-10">
            <div class="offcanvas-header offcanvas-header-navs d-flex align-items-center justify-content-between mb-5">
                <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary flex-grow-1 px-10"
                    role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#" id="toggle_notification">Fee Calculator</a>
                    </li>
                </ul>
                <div class="offcanvas-close mt-n1 pr-5">
                    <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_cart_close">
                        <i class="ki ki-close icon-xs text-muted"></i>
                    </a>
                </div>
            </div>
            <div class="offcanvas-content px-10">
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
        </div>
    </div>
@endsection

@section('top_navigation')
    <div class="header-top header-top-custom">
        <div class="container">
            <div class="map mr-20 mb-3">
                <div class="quick-search quick-search-inline ml-4 w-300px" id="kt_quick_search_inline">
                    <form method="get" class="quick-search-form">
                        <div class="input-group rounded bg-light">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <span class="svg-icon svg-icon-lg">
                                        <x-icons.search></x-icons.search>
                                    </span>
                                </span>
                            </div>
                            <input type="text" class="form-control h-45px search-input" placeholder="Search..." id="search" autocomplete="off" />
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="quick-search-close ki ki-close icon-sm" style="display: none;"></i>
                                </span>
                            </div>
                        </div>
                    </form>
                    <div class="autoComplete"></div>
                </div>
            </div>
            <div class="topbar">
                @php
                    $countUnreadNotifications = auth()->user()->countUnreadNotifications();
                @endphp
                <div class="topbar-item" id="kt_quick_panel_toggle">
                    <div class="btn btn-icon btn-hover-transparent-white w-auto d-flex align-items-center btn-lg px-2">
                        <span class="symbol symbol-35 mx-2">
                            <img src="{{ pc_asset(BE_IMAGE.'svg/Notification_2.svg') }}" alt="Notification_2" />
                        </span>
                        <a href="#">
                            @empty (!$countUnreadNotifications)
                                <span class="badge">{{ $countUnreadNotifications }}</span>
                            @endempty
                            <span class="text-white font-weight-bolder font-size-sm d-none d-md-inline">
                                Notifications
                            </span>
                        </a>
                    </div>
                </div>
                @if (!in_array(\Auth::user()->account_type, ['AD']))
                    <div class="topbar-item" id="kt_quick_user_toggle">
                        <div class="btn btn-icon btn-hover-transparent-white w-auto d-flex align-items-center btn-lg px-2">
                            <span class="symbol symbol-35 mx-2">
                                <img src="{{ pc_asset(BE_IMAGE.'svg/Layout_horizontal.svg') }}" alt="Layout_horizontal" />
                            </span>
                            <a href="#">
                                @empty (!$count_cases_working_on)
                                <span class="badge">{{ $count_cases_working_on }}</span>
                                @endempty
                                <span class="text-white font-weight-bolder font-size-sm d-none d-md-inline">
                                    Ongoing Cases
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="topbar-item" id="kt_quick_cart_toggle">
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
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection
