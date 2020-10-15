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

                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12.7071 6.70711C13.0976 6.31658 13.0976 5.68342 12.7071 5.29289C12.3166 4.90237 11.6834 4.90237 11.2929 5.29289L5.29289 11.2929C4.91431 11.6715 4.90107 12.2811 5.26285 12.6757L10.7628 18.6757C11.136 19.0828 11.7686 19.1103 12.1757 18.7372C12.5828 18.364 12.6103 17.7314 12.2372 17.3243L7.38414 12.0301L12.7071 6.70711Z"
                        fill="#F3F7F8" />
                    <path opacity="0.3"
                        d="M19.7071 6.70711C20.0976 6.31658 20.0976 5.68342 19.7071 5.29289C19.3166 4.90237 18.6834 4.90237 18.2929 5.29289L12.2929 11.2929C11.9143 11.6715 11.9011 12.2811 12.2628 12.6757L17.7628 18.6757C18.136 19.0828 18.7686 19.1103 19.1757 18.7372C19.5828 18.364 19.6103 17.7314 19.2372 17.3243L14.3841 12.0301L19.7071 6.70711Z"
                        fill="#F3F7F8" />
                </svg>

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
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3"
                                    d="M8 6C8 4.89543 7.10457 4 6 4C4.89543 4 4 4.89543 4 6C4 7.10457 4.89543 8 6 8C7.10457 8 8 7.10457 8 6Z"
                                    fill="#A9B3BE" />
                                <path
                                    d="M8 12C8 10.8954 7.10457 10 6 10C4.89543 10 4 10.8954 4 12C4 13.1046 4.89543 14 6 14C7.10457 14 8 13.1046 8 12Z"
                                    fill="#A9B3BE" />
                                <path
                                    d="M14 6C14 4.89543 13.1046 4 12 4C10.8954 4 10 4.89543 10 6C10 7.10457 10.8954 8 12 8C13.1046 8 14 7.10457 14 6Z"
                                    fill="#A9B3BE" />
                                <path
                                    d="M14 12C14 10.8954 13.1046 10 12 10C10.8954 10 10 10.8954 10 12C10 13.1046 10.8954 14 12 14C13.1046 14 14 13.1046 14 12Z"
                                    fill="#A9B3BE" />
                                <path
                                    d="M20 6C20 4.89543 19.1046 4 18 4C16.8954 4 16 4.89543 16 6C16 7.10457 16.8954 8 18 8C19.1046 8 20 7.10457 20 6Z"
                                    fill="#A9B3BE" />
                                <path
                                    d="M20 12C20 10.8954 19.1046 10 18 10C16.8954 10 16 10.8954 16 12C16 13.1046 16.8954 14 18 14C19.1046 14 20 13.1046 20 12Z"
                                    fill="#A9B3BE" />
                                <path
                                    d="M8 18C8 16.8954 7.10457 16 6 16C4.89543 16 4 16.8954 4 18C4 19.1046 4.89543 20 6 20C7.10457 20 8 19.1046 8 18Z"
                                    fill="#A9B3BE" />
                                <path
                                    d="M14 18C14 16.8954 13.1046 16 12 16C10.8954 16 10 16.8954 10 18C10 19.1046 10.8954 20 12 20C13.1046 20 14 19.1046 14 18Z"
                                    fill="#A9B3BE" />
                                <path
                                    d="M20 18C20 16.8954 19.1046 16 18 16C16.8954 16 16 16.8954 16 18C16 19.1046 16.8954 20 18 20C19.1046 20 20 19.1046 20 18Z"
                                    fill="#A9B3BE" />
                            </svg>


                        </span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>

                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3"
                                    d="M4.85714 1H11.7364C12.0911 1 12.4343 1.12568 12.7051 1.35474L17.4687 5.38394C17.8057 5.66895 18 6.08788 18 6.5292V19.0833C18 20.8739 17.9796 21 16.1429 21H4.85714C3.02045 21 3 20.8739 3 19.0833V2.91667C3 1.12612 3.02045 1 4.85714 1ZM8 12C7.44772 12 7 12.4477 7 13C7 13.5523 7.44772 14 8 14H15C15.5523 14 16 13.5523 16 13C16 12.4477 15.5523 12 15 12H8ZM8 16C7.44772 16 7 16.4477 7 17C7 17.5523 7.44772 18 8 18H11C11.5523 18 12 17.5523 12 17C12 16.4477 11.5523 16 11 16H8Z"
                                    fill="#829496" />
                                <path
                                    d="M6.85714 3H14.7364C15.0911 3 15.4343 3.12568 15.7051 3.35474L20.4687 7.38394C20.8057 7.66895 21 8.08788 21 8.5292V21.0833C21 22.8739 20.9796 23 19.1429 23H6.85714C5.02045 23 5 22.8739 5 21.0833V4.91667C5 3.12612 5.02045 3 6.85714 3ZM8 12C7.44772 12 7 12.4477 7 13C7 13.5523 7.44772 14 8 14H15C15.5523 14 16 13.5523 16 13C16 12.4477 15.5523 12 15 12H8ZM8 16C7.44772 16 7 16.4477 7 17C7 17.5523 7.44772 18 8 18H11C11.5523 18 12 17.5523 12 17C12 16.4477 11.5523 16 11 16H8Z"
                                    fill="#829496" />
                            </svg>

                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">My Cases</span>

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
                                    <span class="menu-text">Assigned Cases</span>

                                </a>
                            </li>
                            @if(in_array(\Auth::user()->account_type, ['CH']))
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{ route('cases.working_on') }}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Ongoing Cases</span>

                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @if(in_array(\Auth::user()->account_type,['SP']))
                <li class="menu-item " aria-haspopup="true">
                    <a href="{{ route('handlers.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3"
                                    d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                    fill="#A9B3BE" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.9999 16C12.5522 16 12.9999 16.4477 12.9999 17C12.9999 17.5523 12.5522 18 11.9999 18C11.4477 18 10.9999 17.5523 10.9999 17C10.9999 16.4477 11.4477 16 11.9999 16ZM10.5909 14.868V13.209H11.8509C13.4469 13.209 14.6019 11.991 14.6019 10.395C14.6019 8.799 13.4469 7.581 11.8509 7.581C10.2339 7.581 9.12094 8.799 9.12094 10.395H7.33594C7.33594 7.875 9.30994 5.922 11.8509 5.922C14.3919 5.922 16.3869 7.875 16.3869 10.395C16.3869 12.915 14.3919 14.868 11.8509 14.868H10.5909Z"
                                    fill="#A9B3BE" />
                            </svg>

                        </span>
                        <span class="menu-text">Case Handlers</span>
                    </a>
                </li>
                @endif
                @if(in_array(\Auth::user()->account_type, ['SP', 'AD']))
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8 3V3.5C8 4.32843 8.67157 5 9.5 5H14.5C15.3284 5 16 4.32843 16 3.5V3H18C19.1046 3 20 3.89543 20 5V21C20 22.1046 19.1046 23 18 23H6C4.89543 23 4 22.1046 4 21V5C4 3.89543 4.89543 3 6 3H8Z"
                                    fill="#A9B3BE" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11 2C11 1.44772 11.4477 1 12 1C12.5523 1 13 1.44772 13 2H14.5C14.7761 2 15 2.22386 15 2.5V3.5C15 3.77614 14.7761 4 14.5 4H9.5C9.22386 4 9 3.77614 9 3.5V2.5C9 2.22386 9.22386 2 9.5 2H11Z"
                                    fill="#A9B3BE" />
                                <path opacity="0.3"
                                    d="M16 9H11C10.4477 9 10 9.44772 10 10C10 10.5523 10.4477 11 11 11H16C16.5523 11 17 10.5523 17 10C17 9.44772 16.5523 9 16 9Z"
                                    fill="#A9B3BE" />
                                <path opacity="0.3"
                                    d="M9 10C9 9.44772 8.55228 9 8 9C7.44772 9 7 9.44772 7 10C7 10.5523 7.44772 11 8 11C8.55228 11 9 10.5523 9 10Z"
                                    fill="#A9B3BE" />
                                <path opacity="0.3"
                                    d="M9 14C9 13.4477 8.55228 13 8 13C7.44772 13 7 13.4477 7 14C7 14.5523 7.44772 15 8 15C8.55228 15 9 14.5523 9 14Z"
                                    fill="#A9B3BE" />
                                <path opacity="0.3"
                                    d="M16 13H11C10.4477 13 10 13.4477 10 14C10 14.5523 10.4477 15 11 15H16C16.5523 15 17 14.5523 17 14C17 13.4477 16.5523 13 16 13Z"
                                    fill="#A9B3BE" />
                                <path opacity="0.3"
                                    d="M9 18C9 17.4477 8.55228 17 8 17C7.44772 17 7 17.4477 7 18C7 18.5523 7.44772 19 8 19C8.55228 19 9 18.5523 9 18Z"
                                    fill="#A9B3BE" />
                                <path opacity="0.3"
                                    d="M16 17H11C10.4477 17 10 17.4477 10 18C10 18.5523 10.4477 19 11 19H16C16.5523 19 17 18.5523 17 18C17 17.4477 16.5523 17 16 17Z"
                                    fill="#A9B3BE" />
                            </svg>

                            <!--end::Svg Icon-->
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

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.5 21H20.5C21.3284 21 22 20.3284 22 19.5V8.5C22 7.67157 21.3284 7 20.5 7H10L7.43934 4.43934C7.15804 4.15804 6.7765 4 6.37868 4H3.5C2.67157 4 2 4.67157 2 5.5V19.5C2 20.3284 2.67157 21 3.5 21Z"
                                    fill="#A9B3BE" />
                                <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12 17.2277L9.80187 18.4353C9.53879 18.5798 9.2134 18.4741 9.07509 18.1992C9.02001 18.0897 9.00101 17.9643 9.02102 17.8424L9.44081 15.2846L7.66252 13.4732C7.44968 13.2564 7.44533 12.9004 7.65279 12.6779C7.73541 12.5894 7.84366 12.5317 7.96078 12.5139L10.4183 12.1408L11.5174 9.81362C11.6489 9.53509 11.9716 9.42074 12.2381 9.5582C12.3443 9.61294 12.4302 9.70271 12.4826 9.81362L13.5816 12.1408L16.0391 12.5139C16.3333 12.5586 16.5371 12.844 16.4943 13.1514C16.4773 13.2738 16.4222 13.3869 16.3374 13.4732L14.5591 15.2846L14.9789 17.8424C15.0292 18.1486 14.8324 18.4393 14.5395 18.4918C14.4228 18.5127 14.3028 18.4928 14.1981 18.4353L12 17.2277Z"
                                    fill="#A9B3BE" />
                            </svg>


                        </span>
                        <span class="menu-text">Generate Report</span>
                    </a>
                </li>
                @if(in_array(\Auth::user()->account_type, ['AD']))
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                    <path
                                        d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                        fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">FAQ</span>
                        <i class="menu-arrow"></i>
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
                    <a href="#" class="menu-link">
                        <span class="svg-icon menu-icon">

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3"
                                    d="M14.0008 7C14.0008 7.55228 14.4483 8 15.0003 8C15.5524 8 15.9999 7.55228 15.9999 7V6C15.9999 3.79086 14.2098 2 12.0016 2H6.0051C3.79692 2 2.00684 3.79086 2.00684 6L2.00684 18C2.00684 20.2091 3.79692 22 6.0051 22H12.0086C14.2168 22 16.0068 20.2091 16.0068 18V17C16.0068 16.4477 15.5593 16 15.0073 16C14.4552 16 14.0077 16.4477 14.0077 17V18C14.0077 19.1046 13.1127 20 12.0086 20H6.0051C4.90101 20 4.00597 19.1046 4.00597 18L4.00597 6C4.00597 4.89543 4.90101 4 6.0051 4H12.0016C13.1057 4 14.0008 4.89543 14.0008 6V7Z"
                                    fill="#1F877A" />
                                <path opacity="0.3"
                                    d="M19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11L9 11C8.44771 11 8 11.4477 8 12C8 12.5523 8.44771 13 9 13L19 13Z"
                                    fill="#1F877A" />
                                <path
                                    d="M17.2929 9.70711C16.9024 9.31658 16.9024 8.68342 17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289L21.7071 11.2929C22.0976 11.6834 22.0976 12.3166 21.7071 12.7071L18.7071 15.7071C18.3166 16.0976 17.6834 16.0976 17.2929 15.7071C16.9024 15.3166 16.9024 14.6834 17.2929 14.2929L19.5858 12L17.2929 9.70711Z"
                                    fill="#1F877A" />
                            </svg>


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
        <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
            <h3 class="font-weight-bold m-0">Ongoing Cases
                <small class="text-muted font-size-sm ml-2">.</small></h3>
            <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
                <i class="ki ki-close icon-xs text-muted"></i>
            </a>
        </div>
        <!--end::Header-->
        <!--begin::Content-->
        <div class="offcanvas-content pr-5 mr-n5">

            @foreach(\Auth::user()->cases_working_on()->get() as $case)
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

                                <span class="description">FFM Expediated</span>
                            </div>
                            <div class="notifications-card-col">
                                <p class="title">CATEGORY:</p>

                                <span class="description">FFM Expediated</span>
                            </div>
                        </div>

                    </div>
                    <div class="notifications-cards">
                        <span class="label label-warning">Response to Defincency</span>
                        <p class="subject my-1">Access Bank Merger</p>

                        <div class="d-flex">
                            <div class="notifications-card-col">
                                <p class="title">CATEGORY:</p>

                                <span class="description">FFM Expediated</span>
                            </div>
                            <div class="notifications-card-col">
                                <p class="title">CATEGORY:</p>

                                <span class="description">FFM Expediated</span>
                            </div>
                        </div>

                    </div>
                    <div class="notifications-cards">
                        <span class="label">New Case Assinged</span>
                        <p class="subject my-1">Access Bank Merger</p>

                        <div class="d-flex">
                            <div class="notifications-card-col">
                                <p class="title">CATEGORY:</p>

                                <span class="description">FFM Expediated</span>
                            </div>
                            <div class="notifications-card-col">
                                <p class="title">CATEGORY:</p>

                                <span class="description">FFM Expediated</span>
                            </div>
                        </div>

                    </div>
                    <div class="notifications-cards">
                        <span class="label">New Case Assinged</span>
                        <p class="subject my-1">Access Bank Merger</p>

                        <div class="d-flex">
                            <div class="notifications-card-col">
                                <p class="title">CATEGORY:</p>

                                <span class="description">FFM Expediated</span>
                            </div>
                            <div class="notifications-card-col">
                                <p class="title">CATEGORY:</p>

                                <span class="description">FFM Expediated</span>
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
</div>

@endsection

@section('top_navigation')

<!-- Top navigation -->
<div class="header-top header-top-custom">
    <div class="container">

        <div class="map mr-20 mb-3">
            <div class="quick-search quick-search-inline ml-4 w-300px" id="kt_quick_search_inline">
                <!--begin::Form-->
                <form method="get" class="quick-search-form">
                    <div class="input-group rounded bg-light">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <span class="svg-icon svg-icon-lg">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            <path
                                                d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                                fill="#000000" fill-rule="nonzero" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                        </div>
                        <input type="text" class="form-control h-45px" placeholder="Search..." id="search" />
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="quick-search-close ki ki-close icon-sm"></i>
                            </span>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
                <!--begin::Search Toggle-->
                <div id="kt_quick_search_toggle" data-toggle="dropdown" data-offset="0px,1px"></div>
                <!--end::Search Toggle-->
                <!--begin::Dropdown-->
                <div class="dropdown-menu dropdown-menu-left dropdown-menu-lg dropdown-menu-anim-up">
                    <div class="quick-search-wrapper scroll" data-scroll="true" data-height="350"
                        data-mobile-height="200"></div>
                </div>
                <!--end::Dropdown-->
            </div>
        </div>
        <div class="topbar">


            <!--begin::Toggle-->

            <!--begin::Toggle-->



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
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M14.0069431,7.00607258 C13.4546584,7.00607258 13.0069431,6.55855153 13.0069431,6.00650634 C13.0069431,5.45446114 13.4546584,5.00694009 14.0069431,5.00694009 L15.0069431,5.00694009 C17.2160821,5.00694009 19.0069431,6.7970243 19.0069431,9.00520507 L19.0069431,15.001735 C19.0069431,17.2099158 17.2160821,19 15.0069431,19 L3.00694311,19 C0.797804106,19 -0.993056895,17.2099158 -0.993056895,15.001735 L-0.993056895,8.99826498 C-0.993056895,6.7900842 0.797804106,5 3.00694311,5 L4.00694793,5 C4.55923268,5 5.00694793,5.44752105 5.00694793,5.99956624 C5.00694793,6.55161144 4.55923268,6.99913249 4.00694793,6.99913249 L3.00694311,6.99913249 C1.90237361,6.99913249 1.00694311,7.89417459 1.00694311,8.99826498 L1.00694311,15.001735 C1.00694311,16.1058254 1.90237361,17.0008675 3.00694311,17.0008675 L15.0069431,17.0008675 C16.1115126,17.0008675 17.0069431,16.1058254 17.0069431,15.001735 L17.0069431,9.00520507 C17.0069431,7.90111468 16.1115126,7.00607258 15.0069431,7.00607258 L14.0069431,7.00607258 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3"
                                                transform="translate(9.006943, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-9.006943, -12.000000) " />
                                            <rect fill="#000000" opacity="0.3"
                                                transform="translate(14.000000, 12.000000) rotate(-270.000000) translate(-14.000000, -12.000000) "
                                                x="13" y="6" width="2" height="12" rx="1" />
                                            <path
                                                d="M21.7928932,9.79289322 C22.1834175,9.40236893 22.8165825,9.40236893 23.2071068,9.79289322 C23.5976311,10.1834175 23.5976311,10.8165825 23.2071068,11.2071068 L20.2071068,14.2071068 C19.8165825,14.5976311 19.1834175,14.5976311 18.7928932,14.2071068 L15.7928932,11.2071068 C15.4023689,10.8165825 15.4023689,10.1834175 15.7928932,9.79289322 C16.1834175,9.40236893 16.8165825,9.40236893 17.2071068,9.79289322 L19.5,12.0857864 L21.7928932,9.79289322 Z"
                                                fill="#000000" fill-rule="nonzero"
                                                transform="translate(19.500000, 12.000000) rotate(-90.000000) translate(-19.500000, -12.000000) " />
                                        </g>
                                    </svg>
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
<script>
    $(document).ready(function () {
        $('#kt-search').click(function () {
            $(this).toggleClass('show');
            $('#show_search').toggleClass('show');
        });

        var availableTags = [
            "ActionScript",
            "AppleScript",
            "Asp",
            "BASIC",
            "C",
            "C++",
            "Clojure",
            "COBOL",
            "ColdFusion",
            "Erlang",
            "Fortran",
            "Groovy",
            "Haskell",
            "Java",
            "JavaScript",
            "Lisp",
            "Perl",
            "PHP",
            "Python",
            "Ruby",
            "Scala",
            "Scheme"
        ];
        $("#search").autocomplete({
            source: availableTags
        });

    })

</script>
@endsection
