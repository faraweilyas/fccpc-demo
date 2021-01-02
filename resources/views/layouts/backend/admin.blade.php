@extends('layouts.backend.user')

@section('aside_bar')
<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
    <div class="brand flex-column-auto" id="kt_brand">
        <a href="/dashboard" class="brand-logo">
            @if (\Auth::user()->account_type == 'SP')
                <img src="{{ pc_asset(BE_IMAGE.'svg/supervisor.svg') }}" alt="supervisor" />
            @elseif (\Auth::user()->account_type == 'AD')
                <img src="{{ pc_asset(BE_IMAGE.'svg/admin.svg') }}" alt="admin" />
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
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{ route('cases.approved') }}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Approved Cases</span>
                                </a>
                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{ route('cases.archived') }}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Archived Cases</span>
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
                        <span class="menu-text">Pre-Notifications</span>
                        <img src="{{ pc_asset(BE_IMAGE.'svg/drop_down.svg') }}" alt="arrow" />
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Pre-Notifications</span>
                                </span>
                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{ in_array(\Auth::user()->account_type, ['SP', 'AD']) ? route('enquiries.logs') : route('enquiries.assigned-logs') }}"
                                    class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">logs</span>
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
                <li class="menu-item" aria-haspopup="true">
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
                <div class="tab-pane fade show pt-3 pr-5 mr-n5 active" id="kt_quick_panel_notifications" role="tabpanel">
                    @php
                        $unreadNotifications    = auth()->user()->unreadNotifications;
                        $readNotifications      = auth()->user()->readNotifications;
                        $unreadDisplay          = ($unreadNotifications->count() > 0) ? "" : "hide";
                        $readDisplay            = ($readNotifications->count() > 0) ? "" : "hide";
                    @endphp
                    <p class="mb-10 {{ $unreadDisplay }}">
                        <span class='float-left unread-title'>Unread Notifications</span>
                        <span id="mark-notifications" class='float-right cr-pointer text-hover-primary unread-clear'>Mark as read
                            <span class="show-marker hide"><x-icons.check></x-icons.check></span>
                        </span>
                    </p>
                    <div class="clear-fix"></div>
                    @forelse ($unreadNotifications as $notification)
                        @php
                            $data           = (object) $notification->data;
                            $action         = getNotificationAction($data->action);
                            $action_style   = getNotificationActionStyle($data->action);
                            $message        = $data->message;
                        @endphp
                        @if ($data->action == "newuser")
                            @php
                                $user = \App\Models\User::find($data->user_id);
                            @endphp
                            <div class="notifications-cards cr-pointer" onclick="window.location.href = '{{ route('dashboard.profile', ['user' => $user->id]) }}';">
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
                                <span class="float-right text-gray">{{ $notification->created_at->diffForHumans() }}</span>
                            </div>
                        @else
                            @php
                                $case = \App\Models\Cases::find($data->case_id);
                            @endphp
                            <div class="notifications-cards cr-pointer" onclick="window.location.href = '{{ route('cases.analyze', ['case' => $case->id]) }}';">
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
                                <span class="float-right text-gray">{{ $notification->created_at->diffForHumans() }}</span>
                            </div>
                        @endif
                    @empty
                        <div class="no-notification">
                            <div class="mr-10">
                                <x-icons.caught-up></x-icons.caught-up>
                            </div>
                            <span class="mx-5">You're All Caught Up!</span>
                        </div>
                    @endforelse
                    <hr class='notification_divider' />
                    <p class="my-10 {{ $readDisplay }}">
                        <span class='float-left unread-title'>Read Notifications</span>
                        <span id="clear-notification" class='float-right cr-pointer text-hover-primary unread-clear'>Clear</span>
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
                                    $user = \App\Models\User::find($data->user_id);
                                @endphp
                                <div class="notifications-cards cr-pointer" onclick="window.location.href = '{{ route('dashboard.profile', ['user' => $user->id]) }}';">
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
                                    <span class="float-right text-gray">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                            @else
                                @php
                                    $case = \App\Models\Cases::find($data->case_id);
                                @endphp
                                <div class="notifications-cards cr-pointer" onclick="window.location.href = '{{ route('cases.analyze', ['case' => $case->id]) }}';">
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
                                    <span class="float-right text-gray">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
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
            $cases_working_on = \Auth::user()->cases_working_on()->get();
            $count_cases_working_on = count($cases_working_on);
            @endphp
            <div class="tab-content">
                <div class="tab-pane fade show pt-3 pr-5 mr-n5 active" id="kt_quick_panel_notifications"
                    role="tabpanel">
                    @forelse ($cases_working_on as $case)
                    <div class="notifications-cards cr-pointer"
                        onclick="window.location.href = '{{ route('cases.analyze', [$case->id]) }}';">
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
                        <div class="mr-10">
                            <x-icons.caught-up></x-icons.caught-up>
                        </div>
                        <span class="mx-5">You don't have cases you're working on!</span>
                        <br />
                        <a class="btn btn-transparent mt-10" style="margin-top: 3.5rem"
                            href="{{ route('cases.assigned') }}">
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
    <div id="kt_quick_cart" class="offcanvas offcanvas-right pt-5 pb-10" style="overflow-y: auto;">
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
                             <option value="" selected="">Select type:</option>
                            <option value="local">Merger</option>
                            <option value="ffm">Simplified Procedure</option>
                            <option value="ffx">Negative Clearance</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Number of Parties:</label>
                        <input type="number" id="parties_number" name="parties_number" class="form-control" min="2" value="2" />
                    </div>
                    <div class="form-group">
                        <div class="checkbox-inline">
                            <label class="checkbox">
                            <input type="checkbox" name="expedited" id="expedited">
                            <span></span>Expedited</label>
                        </div>
                    </div>
                    <div class="transaction-category-section">
                        <div class="form-group">
                            <label>Purchase Consideration:</label>
                            <input value="50000000000" type="text" id="purchase_consideration" name="purchase_consideration" class="form-control" placeholder="Enter your purchase consideration:" />
                        </div>
                        <div class="form-group">
                            <label>Transaction Category:</label>
                            <div class="radio">
                                <label style="margin-right: 15px;">
                                    <input type="radio" class="transaction_category" name="transaction_category" value="domestic" /> Domestic
                                </label>
                                <label>
                                    <input type="radio" class="transaction_category" name="transaction_category" value="ffm" /> Foreign To Foreign
                                </label>
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label>The acquiring undertaking (including group companies where relevant):</label>
                            <input value="30000000000" type="text" id="turnover_a" name="turnover_a" class="form-control" placeholder="Enter amount:" />
                        </div>
                        <div class="form-group hide">
                            <label>The target undertaking:</label>
                            <input value="15000000000" type="text" id="turnover_b" name="turnover_b" class="form-control" placeholder="Enter amount:" />
                        </div>
                        <div class="form-group hide">
                            <label>For foreign to foreign mergers, the annual turnover of Nigerian component is required:</label>
                            <input value="60000000000" type="text" id="turnover_c" name="turnover_c" class="form-control" placeholder="Enter amount:" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Annual Turnover:</label>
                        <input type="text" id="annual_turnover" name="annual_turnover" class="form-control" disabled />
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
                                    <td>Application fee</td>
                                    <td><span class="applicationFee">₦0.00</span></td>
                                </tr>
                                <tr>
                                    <td>Processing fee</td>
                                    <td><span class="processingFee">₦0.00</span></td>
                                </tr>
                                <tr>
                                    <td>Expedited fee</td>
                                    <td><span class="expeditedFee">₦0.00</span></td>
                                </tr>
                                <tr class="fee__calculator-total">
                                    <td><b>Total</b></td>
                                    <td><span class="totalAmount">₦0.00</span></td>
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
                        <div class="input-group rounded bg-light-trans">
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
                                    <i class="spin-loader fa fa-spinner fa-spin" style="display: none;"></i>
                                    <i class="quick-search-close ki ki-close icon-sm" style="display: none;"></i>
                                </span>
                            </div>
                        </div>
                    </form>
                    {{-- <div class="autoComplete"></div> --}}
                </div>
                <div class="dropdown-search dropdown-menu dropdown-menu-left dropdown-menu-lg dropdown-menu-anim-up hide" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: -190px; transform: translate3d(203px, 68px, 0px);padding: 20px;">
                    <div class="quick-search-wrapper scroll ps ps--active-y" data-scroll="true" data-height="350" data-mobile-height="200" style="height: 350px; overflow: hidden;">
                        <div class="quick-search-result">
                            <!--begin::Message-->
                            <div class="text-muted d-none">
                                No record found
                            </div>
                            <!--end::Message-->
                            <!--begin::Section-->
                            <div class="font-size-sm text-primary font-weight-bolder text-uppercase mb-2">
                                Cases
                            </div>
                            <div class="mb-10">
                                <div class="d-flex align-items-center flex-grow-1 mb-2">
                                    <div class="symbol symbol-30 bg-transparent flex-shrink-0">
                                        <img src="https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/svg/files/doc.svg" alt="">
                                    </div>
                                    <div class="d-flex flex-column ml-3 mt-2 mb-2">
                                        <a href="#" class="font-weight-bold text-dark text-hover-primary">
                                        AirPlus Requirements
                                        </a>
                                        <span class="font-size-sm font-weight-bold text-muted">
                                        by Grog John
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Section-->
                        </div>
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps__rail-y" style="top: 0px; right: 0px; height: 350px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 146px;"></div>
                        </div>
                    </div>
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
                @endif
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
