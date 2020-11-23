@extends('layouts.backend.admin')

@section('content')
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Dashboard</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                @if(in_array(\Auth::user()->account_type, ['AD']))
                <div class="col-lg-3 my-5" onclick="window.location.href = '{{ route('dashboard.users') }}';">
                    <div class="dashboard-card purple">
                        <p>Users</p>
                        <span>{{ \App\Models\User::where('status', 'active')->count() }}</span>
                        <img src="{{ pc_asset(BE_IMAGE.'svg/dd_angle.svg') }}" alt="double angle" />
                    </div>
                </div>
                <div class="col-lg-3 my-5" onclick="window.location.href = '{{ route('faq.faqs') }}';">
                    <div class="dashboard-card blue">
                        <p>FAQs</p>
                        <span>{{ \App\Models\Faq::all()->count() }}</span>
                        <img src="{{ pc_asset(BE_IMAGE.'svg/dd_angle.svg') }}" alt="double angle" />
                    </div>
                </div>
                @endif
                @if(in_array(\Auth::user()->account_type, ['SP']))
                <div class="col-lg-3 my-5" onclick="window.location.href = '{{ route('cases.unassigned') }}';">
                    <div class="dashboard-card purple">
                        <p>New Cases</p>
                        <span>{{ $cases->unassignedCases()->count() }}</span>
                        <img src="{{ pc_asset(BE_IMAGE.'svg/dd_angle.svg') }}" alt="double angle" />
                    </div>
                </div>
                @endif
                @if(!in_array(\Auth::user()->account_type, ['AD']))
                <div class="col-lg-3 my-5" onclick="window.location.href = '{{ route('cases.assigned') }}';">
                    <div class="dashboard-card blue">
                        <p>@if(in_array(\Auth::user()->account_type, ['CH'])) New @else Assigned @endif Cases</p>
                        @if(in_array(\Auth::user()->account_type, ['CH']))
                        <span>{{ \Auth::user()->active_cases_assigned_to()->count() }}</span>
                        @else
                        <span>{{ \Auth::user()->active_cases_assigned_by()->count() }}</span>
                        @endif
                        <img src="{{ pc_asset(BE_IMAGE.'svg/dd_angle.svg') }}" alt="double angle" />
                    </div>
                </div>
                <div class="col-lg-3 my-5" onclick="window.location.href = '{{ route('cases.working_on') }}';">
                    <div class="dashboard-card orange">
                        <p>Ongoing</p>
                        <span>{{ \Auth::user()->cases_working_on()->count() }}</span>
                        <img src="{{ pc_asset(BE_IMAGE.'svg/dd_angle.svg') }}" alt="double angle" />
                    </div>
                </div>
                <div class="col-lg-3 my-5" onclick="window.location.href = '{{ route('cases.on-hold') }}';">
                    <div class="dashboard-card redish-orange">
                        <p>On Hold</p>
                        <span>{{ \Auth::user()->deficient_cases()->count() }}</span>
                        <img src="{{ pc_asset(BE_IMAGE.'svg/dd_angle.svg') }}" alt="double angle" />
                    </div>
                </div>
                <div class="col-lg-3 my-5">
                    <div class="dashboard-card">
                        <p>All Cases</p>
                        <span>{{ $cases->submittedCases()->count() }}</span>
                        <img src="{{ pc_asset(BE_IMAGE.'svg/dd_angle.svg') }}" alt="double angle" />
                    </div>
                </div>
                @endif
            </div>
            @if(!in_array(\Auth::user()->account_type, ['AD']))
            <div class="row mt-10">
                <div class="col-lg-8">
                    <div class="card card-custom bg-gray-100 card-stretch gutter-b">
                        <div class="card-header h-auto border-0">
                            <div class="card-title py-5">
                                <h3 class="card-label">
                                    <span class="d-block text-dark font-weight-bolder">Transactions Over Time</span>
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <ul class="nav nav-pills nav-pills-sm nav-dark-75" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link py-2 px-4 active" data-toggle="tab"
                                            href="#local">
                                            <span class="nav-text font-size-sm">Local</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link py-2 px-4" data-toggle="tab"
                                            href="#ffm">
                                            <span class="nav-text font-size-sm">FFM</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link py-2 px-4" data-toggle="tab"
                                            href="#ffx">
                                            <span class="nav-text font-size-sm">FFM Expedited</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active text-center my-25" id="local" role="tabpanel">
                                    <span id="report-loader">
                                        <img src="{{ BE_IMAGE.'report_loading.gif' }}" />
                                    </span>
                                    <div id="local_chart" class="hide"></div>
                                </div>
                                <div class="tab-pane fade my-25" id="ffm" role="tabpanel">
                                    <div id="ffm_chart"></div>
                                </div>
                                <div class="tab-pane fade my-25" id="ffx" role="tabpanel">
                                    <div id="ffx_chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-10">
                <div class="col-lg-12">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">New Cases</span>
                            </h3>
                            <div class="card-toolbar">
                            </div>
                        </div>
                        <div class="card-body pt-2 pb-0 mt-n3">
                            <div class="tab-content mt-5" id="myTabTables11">
                                <div class="tab-pane fade show active" id="kt_tab_pane_11_3" role="tabpanel"
                                    aria-labelledby="kt_tab_pane_11_3">
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-vertical-center">
                                            <thead>
                                                <tr>
                                                    <th class="p-0 min-w-200px"></th>
                                                    <th class="p-0 min-w-100px"></th>
                                                    <th class="p-0 min-w-125px"></th>
                                                    <th class="p-0 min-w-110px"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($new_cases as $case)
                                                <tr>
                                                    <td class="pl-0">
                                                        <a href="#"
                                                            class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $case->getSubject() }}</a>
                                                        <div>
                                                            <span class="font-weight-bolder">Email:</span>
                                                            <a class="text-muted font-weight-bold text-hover-primary"
                                                                href="#">{!! $case->applicant_email !!}</a>
                                                        </div>
                                                    </td>
                                                    <td class="text-right">
                                                        <span
                                                            class="text-dark-75 font-weight-bolder d-block font-size-lg">{!!
                                                            $case->getAmountPaid() !!}</span>
                                                        <span class="text-muted font-weight-bold">Paid</span>
                                                    </td>
                                                    <td class="text-right">
                                                        <span
                                                            class="text-muted font-weight-500">{{ implode(', ', $case->getCaseParties(false)) }}</span>
                                                    </td>
                                                    <td class="text-right">
                                                        {!! $case->getCategoryHtml() !!}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('custom.javascript')
    <script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'chart-report.js') }}"></script>
@endsection
