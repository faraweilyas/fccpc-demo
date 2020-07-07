@extends('layouts.backend.admin')

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Archived Cases</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">Archived Cases</a>
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
                            <h3 class="card-label">Archived Cases</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-separate table-head-custom table-checkable" id="unassigned_cases_datatable">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Reference NO</th>
                                    <th>Subject</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Submited At</th>
                                    <th class="text-center">Action(s)</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $id = 1;
                                @endphp

                                @foreach($cases as $case)
                                    <tr>
                                        <td class="text-center">{{ $id }}</td>
                                        <td>
                                            <div class="font-weight-bolder text-primary mb-0">
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
                                        <td class="text-center">
                                            <div class="font-weight-bold text-success mb-0">
                                                {!! $case->getSubmittedAt() !!}
                                            </div>
                                        </td>
                                        <td nowrap="nowrap">
                                            <a
                                                href="#"
                                                class="btn btn-sm btn-light-warning mr-3"
                                                title="View Case Info"
                                                data-toggle="modal"
                                                data-target="#viewCaseModal"
                                            >
                                                <i class="flaticon-eye"></i> View
                                            </a>
                                            <a
                                                href="#"
                                                class="btn btn-sm btn-light-info mr-3"
                                                title="Assign Case Handler"
                                                data-toggle="modal"
                                                data-target="#assignCaseModal"
                                            >
                                                <i class="flaticon-user-add"></i> Assign
                                            </a>
                                            <div class="hide">
                                                {{-- Case --}}
                                                <span class="reference_no">{{ $case->getRefNO() }}</span>
                                                <span class="subject">{{ $case->subject }}</span>
                                                <span class="category">{!! $case->getCategoryHtml() !!}</span>
                                                <span class="type">{!! $case->getTypeHtml() !!}</span>
                                                <span class="parties">{!! $case->generateCasePartiesBadge('mr_10 mb-2') !!}</span>
                                                <span class="submitted_at">{!! $case->getSubmittedAt() !!}</span>
                                                {{-- Applicant --}}
                                                <span class="firm">{!! $case->applicant_firm !!}</span>
                                                <span class="name">{!! $case->getApplicantName() !!}</span>
                                                <span class="email">{!! $case->applicant_email !!}</span>
                                                <span class="phone_number">{!! $case->applicant_phone_number !!}</span>
                                                <span class="address">{!! $case->applicant_address !!}</span>
                                                {{-- Checklist --}}
                                                {{-- Documents --}}
                                            </div>
                                        </td>
                                    </tr>

                                    @php $id++; @endphp

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modals -->
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
