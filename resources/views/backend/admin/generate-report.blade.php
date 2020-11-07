@extends('layouts.backend.admin')

@section('content')
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Generate Report</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Generate Report</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container py-5">
    <div class="row ">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="d-flex py-4">

                <img src="{{ pc_asset(BE_IMAGE.'svg/book-open.svg') }}" alt="book-open" />

                <div class="gr-header-content">
                    <p>New Report</p>
                    <span id="toggle-report" class="create-report-link">Create your new report</span>
                </div>
            </div>
            <form method="GET" action="{{ route('dashboard.report.show', ['show' => 'show']) }}">
                <div class="card__box card__box__large  rmv-height add-mgbottom " id="applications">
                    <span class="hide check_generator">@if(!empty($show)) true @endif</span>
                    <div class="card__box__large-content">
                        <div class="form-group">
                            <label>Select Start Date To End Date:</label>
                            <input type="text" id="start_date_end_date" class="form-control" name="start_date_end_date"  />
                        </div>

                        @if (in_array(\Auth::user()->account_type, ['CH']))
                            <input type="hidden" name="handler_id[]" value="{{ \Auth::user()->id }}">
                        @else
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Select Case Handler</label>
                                    <select class="form-control form-control-table select2" id="get_handler"
                                        name="handler_id[]" style="width: 100%;" multiple="multiple">
                                        @foreach($caseHandlers as $handler)
                                        <option value="{{ $handler->id }}">{{ $handler->getFullName() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-4 mt-4">
                                <div class="checkbox-inline">
                                    <label class="checkbox checkbox-primary">
                                    <input id="custom-filter-check" type="checkbox" name="custom-filter-check">
                                    <span></span></label>Custom Filter
                                </div>
                            </div>
                        </div>
                        <div id="custom-filter" class="row mt-4 hide">
                            <div class="col-md-12">
                                <label>Transaction Type</label>
                                <select class="form-control form-control-table" name="type">
                                    @foreach(\AppHelper::get('case_types') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label>Transaction Category</label>
                                <select class="form-control form-control-table" name="category">
                                    @foreach(\AppHelper::get('case_categories') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success btn-block">
                                    Submit Request
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@if(!empty($show))
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card-report card-custom-report">
                <div class="card-header flex-wrap">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-md-8">
                                <h3 class="card-label">New Cases</h3>
                            </div>
                            <div class="col-md-4 text-right">
                                <span class="float-right"><button class="btn btn-success-ts no-border mx-5" onclick="window.location.href = '{{ route('dashboard.report.export', ['start_date_end_date' => $_GET['start_date_end_date'], 'category' => $_GET['category'], 'type' => $_GET['type']]) }}';">Export CSV</button></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-separate table-head-custom table-checkable" id="generated_cases_datatable">
                        <thead>
                            <tr>
                                <th>Submitted On</th>
                                <th>Reference NO</th>
                                <th>Subject</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Action(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cases as $case)
                                <tr>
                                    <td>
                                        <div class="font-weight-bold text-dark mb-0">
                                            {!! $case->getSubmittedAt('customdate') !!}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="font-weight-bolder mb-0">
                                            {!! $case->getRefNO() !!}
                                        </div>
                                    </td>
                                    <td class="case-subject">
                                        {{ $case->getSubject() }}
                                    </td>
                                    <td class="text-center">
                                        {!! $case->getCategoryHtml() !!}
                                    </td>
                                    <td class="text-center">
                                        {!! $case->getTypeHtml() !!}
                                    </td>
                                    <td nowrap="nowrap" class="text-center">
                                        <a
                                            href="#"
                                            class="btn btn-sm btn-light-warning mr-3"
                                            title="View Case Info"
                                            data-toggle="modal"
                                            data-target="#viewCaseModal"
                                        >
                                            <i class="flaticon-eye"></i> View
                                        </a>
                                        <div class="hide">
                                            {{-- Case --}}
                                            <span class="case_id">{{ $case->id }}</span>
                                            <span class="assigned_handler_id"></span>
                                            <span class="reference_no">{{ $case->getRefNO() }}</span>
                                            <span class="subject">{{ $case->subject }}</span>
                                            <span class="category">{!! $case->getCategoryHtml() !!}</span>
                                            <span class="type">{!! $case->getTypeHtml() !!}</span>
                                            <span class="amount_paid">{!! $case->getAmountPaid() !!}</span>
                                            <span class="parties">{!! $case->generateCasePartiesBadge('mr_10 mb-2') !!}</span>
                                            <span class="submitted_at">{!! $case->getSubmittedAt() !!}</span>
                                            {{-- Applicant --}}
                                            <span class="firm">{!! $case->applicant_firm !!}</span>
                                            <span class="name">{!! $case->getApplicantName() !!}</span>
                                            <span class="email">{!! $case->applicant_email !!}</span>
                                            <span class="phone_number">{!! $case->applicant_phone_number !!}</span>
                                            <span class="letter_of_appointment" data-param={{ $case->letter_of_appointment ?? 'nil'}}>{{ route('applicant.download_contact_loa', ['document' => $case->letter_of_appointment ?? 'nil']) }}</span>
                                            <span class="address">{!! $case->applicant_address !!}</span>
                                            {{-- Checklist --}}
                                            {{-- Documents --}}
                                        </div>
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
@endif
<!-- Modals -->
@include("layouts.modals.case")
@endsection

@section('custom.css')
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'reports.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_PLUGIN.'custom/flatpickr/flatpickr.min.css') }}" />
@endsection

@section('custom.javascript')
<script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/select2/js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/flatpickr/flatpickr.js') }}"></script>
<script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/datatables/datatables.bundle.js') }}" defer></script>
<script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'case-modal.js') }}"></script>
<script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'report.js') }}" defer></script>
@endsection
