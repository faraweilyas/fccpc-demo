@extends('layouts.backend.admin')

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Ongoing Cases</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">Ongoing Cases</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="card card-custom">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">Ongoing Cases</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-separate table-head-custom table-checkable" id="assigned_cases_datatable">
                            <thead>
                                <tr>
                                    @if (in_array(\Auth::user()->account_type, ['CH']))
                                    <th>Submitted On</th>
                                    @endif
                                    <th>Reference NO</th>
                                    <th>Subject</th>
                                    @if (in_array(\Auth::user()->account_type, ['SP']))
                                    <th>Case Handler</th>
                                    @endif
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Action(s)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cases as $case)
                                <tr>
                                    @if (in_array(\Auth::user()->account_type, ['CH']))
                                    <td>
                                        {!! $case->getSubmittedAt() !!}
                                    </td>
                                    @endif
                                    <td>
                                        <div class="font-weight-bolder mb-0">
                                            {!! $case->getRefNO() !!}
                                        </div>
                                    </td>
                                    <td class="case-subject">
                                        {{ $case->getSubject() }}
                                    </td>
                                    @if (in_array(\Auth::user()->account_type, ['SP']))
                                    <td>
                                        {{ $case->active_handlers->first()->getFullName() }}
                                    </td>
                                    @endif
                                    <td class="text-center">
                                        {!! $case->getCategoryHtml() !!}
                                    </td>
                                    <td class="text-center">
                                        {!! $case->getTypeHtml() !!}
                                    </td>
                                    <td nowrap="nowrap" class="text-center">
                                        @if(in_array(\Auth::user()->account_type, ['SP']))
                                        <a href="#" class="btn btn-sm btn-light-warning mr-3" title="View Case Info"
                                            data-toggle="modal" data-target="#viewCaseModal">
                                            <i class="flaticon-eye"></i> View
                                        </a>
                                        @else
                                        <a href="{{ route('cases.analyze', ['case' => $case->id]) }}"
                                            class="btn btn-sm btn-light-warning mr-3" title="Analyse Case">
                                            <i class="flaticon-eye"></i> View
                                        </a>
                                        @endif
                                        @if(in_array(\Auth::user()->account_type, ['SP']))
                                        <a href="#" class="btn btn-sm btn-light-info mr-3" title="Reassign Case Handler"
                                            data-toggle="modal" data-target="#reassignCaseModal">
                                            <i class="flaticon-user-add"></i> Re-Assign
                                        </a>
                                        @endif
                                        <div class="hide">
                                            {{-- Case --}}
                                            <span class="case_id">{{ $case->id }}</span>
                                            <span
                                                class="case_handler">{{ $case->active_handlers->first()->getFullName() }}</span>
                                            <span class="case_handler_id">{{ $case->active_handlers->first()->id }}</span>
                                            <span class="reference_no">{{ $case->getRefNO() }}</span>
                                            <span class="subject">{{ $case->subject }}</span>
                                            <span class="category">{!! $case->getCategoryHtml() !!}</span>
                                            <span class="type">{!! $case->getTypeHtml() !!}</span>
                                            <span class="amount_paid">{!! $case->getAmountPaid() !!}</span>
                                            <span class="parties">{!! $case->generateCasePartiesBadge('mr_10 mb-2')
                                                !!}</span>
                                            <span class="submitted_at">{!! $case->getSubmittedAt() !!}</span>
                                            {{-- Applicant --}}
                                            <span class="firm">{!! $case->applicant_firm !!}</span>
                                            <span class="name">{!! $case->getApplicantName() !!}</span>
                                            <span class="email">{!! $case->applicant_email !!}</span>
                                            <span class="phone_number">{!! $case->applicant_phone_number !!}</span>
                                            <span class="letter_of_appointment"
                                                data-param={{ $case->letter_of_appointment ?? 'nil'}}>{{ route('applicant.download_contact_loa', ['document' => $case->letter_of_appointment ?? 'nil']) }}</span>
                                            <span class="address">{!! $case->applicant_address !!}</span>
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

    @include("layouts.modals.case")
    @include("layouts.modals.case-handler", [
        'caseHandlers' => $caseHandlers
    ])
@endsection

@section('custom.css')
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_PLUGIN.'custom/datatables/datatables.bundle.css') }}" />
@endsection

@section('custom.javascript')
    <script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/select2/js/select2.js') }}"></script>
    <script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/datatables/datatables.bundle.js') }}" defer></script>
    <script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'case-modal.js') }}"></script>
@endsection
