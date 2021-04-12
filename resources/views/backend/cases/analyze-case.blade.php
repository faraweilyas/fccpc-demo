@extends('layouts.backend.admin')

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Case Analysis</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                        </li>
                        @if(in_array(\Auth::user()->account_type, ['SP']))
                            <li class="breadcrumb-item">
                                <a href="{{ route('cases.unassigned') }}" class="text-muted">New Cases</a>
                            </li>
                        @endif
                        <li class="breadcrumb-item">
                            <a href="{{ route('cases.assigned') }}" class="text-muted">Assigned Cases</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">Analyse Case</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="conatiner px-5 py-5 relative">
        @if (!$case->isCaseOnHold() && $case->isCaseChecklistsApproved())
            <button
                class="btn btn-success-transparent mr-40"
                data-toggle="modal"
                data-target="#viewDeficiencyModal"
            >
                Request For Document
            </button>
        @endif
        @if ($case->active_handlers->count() > 0)
            @if((strtolower($case->case_category) == 'reg' || strtolower($case->case_category) == 'ffm') && in_array(auth()->user()->account_type, ['SP', 'CH']))
                <button
                        class="btn btn-success-transparent"
                        onclick="window.location.href='{{ route('cases.publish', ['case' => $case]) }}'"
                >
                   Publish Form 1A
                </button>
            @endif
        @endif
        @php
            $approvedIcon       = ($case->isCaseChecklistsApproved()) ? 'Position-square-white.svg' : 'Position-square.svg';
            $recommendationIcon = ($case->isRecommendationIssued())   ? 'Position-square-white.svg' : 'Position-square.svg';
            $approvalIcon       = ($case->isApprovalApproved())   ? 'Position-square-white.svg' : 'Position-square.svg';
        @endphp
        <div class="row px-3">
            <div class="tab-custom">
                <div class="tab-link @if($case->isCaseOnHold()) bg-warning @else active @endif px-5 py-5">
                    <img src="{{ pc_asset(BE_IMAGE.'svg/Position.svg') }}" alt="position">
                    <a class="nav-link @if($case->isCaseOnHold()) text-white @else active @endif fs__13_rem" href="#">Documentation
                    </a>
                </div>
                <div class="tab-link @if($case->isCaseChecklistsApproved()) @if($case->isCaseOnHold()) bg-warning @else active @endif @endif px-5 py-5">
                    <img src="{{ pc_asset(BE_IMAGE.'svg/'.$approvedIcon) }}" alt="Position-square">
                    <a class="nav-link @if($case->isCaseChecklistsApproved()) text-white @else active @endif fs__13_rem" href="#">Case Analysis
                    </a>
                </div>
                <div class="tab-link @if($case->isRecommendationIssued()) @if($case->isCaseOnHold()) bg-warning @else active @endif @endif px-5 py-5">
                    <img src="{{ pc_asset(BE_IMAGE.'svg/'.$recommendationIcon) }}" alt="Position-square">
                    <a class="nav-link @if($case->isRecommendationIssued()) text-white @else active @endif fs__13_rem" href="#">Approval
                    </a>
                </div>
                <div class="tab-link @if ($case->isApprovalApproved()) @if($case->isCaseOnHold()) bg-warning @else active @endif @endif px-5 py-5">
                    <img src="{{ pc_asset(BE_IMAGE.'svg/'.$approvalIcon) }}" alt="Position-square">
                    <a class="nav-link @if($case->isApprovalApproved()) text-white @else active @endif fs__13_rem" href="#">Publication
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-custom">
                    @if($case->isCaseOnHold())
                        <div class="ribbon ribbon-clip ribbon-left">
                            <div class="ribbon-target" style="top: 15px;">
                                <span class="ribbon-inner bg-warning"></span>On Hold
                            </div>
                        </div>
                    @endif
                    <h5 class="text_dark_blue">Case Information</h5>
                    <div class="row py-5">
                        <div class="col-md-3">
                            <p><b>SUBJECT:</b></p>
                            <span>
                                {{ $case->subject }}
                            </span>
                        </div>
                        <div class="col-md-3">
                            <p><b>PARTIES:</b></p>
                            <span>
                                {!! $case->generateCasePartiesBadge('mr_10 mb-2') !!}
                            </span>
                        </div>
                        <div class="col-md-3">
                            <p><b>TRANSACTION TYPE:</b></p>
                            <span>
                                {!! $case->getTypeHtml() !!}
                            </span>
                        </div>
                        <div class="col-md-3">
                            <p><b>CASE TYPE:</b></p>
                            <span>
                                {!! $case->getCategoryHtml() !!}
                            </span>
                        </div>
                    </div>
                    <div class="row py-5">
                        <div class="col-md-3">
                            <p><b>FEES:</b></p>
                            <p class="info-title">
                                Application Fee: {!! $case->getApplicationFee() !!}
                            </p>
                            <p class="info-title">
                                Processing Fee: {!! $case->getProcessingFee() !!}
                            </p>
                            <p class="info-title">
                                Expedited Fee: {!! $case->getExpeditedFee() !!}
                            </p>
                            <p class="info-title">
                                Amount Paid: {!! $case->getAmountPaid() !!}
                            </p>
                        </div>
                        <div class="col-md-3">
                            <p><b>REF NO:</b></p>
                            <span>
                                {!! $case->getRefNO() !!}
                            </span>
                            <p class="mt-5">
                                <b>Application ID:</b>
                            </p>
                            <p>
                                <span>
                                    {{ $case->guest->tracking_id }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-3">
                            <p><b>TRANSACTION REP:</b></p>
                            <span>
                                {!! $case->applicant_firm !!}
                            </span>
                        </div>
                        <div class="col-md-3">
                            <p><b>ADDRESS:</b></p>
                            <span>
                                {!! $case->applicant_address !!}
                            </span>
                        </div>
                    </div>
                    <div class="row py-5">
                        <div class="col-md-3">
                            <p class="text_dark_blue"><b>CONTACT REP INFO:</b></p>
                            <span>
                                {!! $case->getApplicantName() !!}<br />
                                {!! $case->applicant_email !!}<br />
                                {!! $case->applicant_phone_number !!}
                            </span>
                        </div>
                        <div class="col-md-4">
                            @if((strtolower($case->case_category) == 'reg' || strtolower($case->case_category) == 'ffm') && in_array(auth()->user()->account_type, ['SP', 'CH']))
                                <p class="text_dark_blue"><b>FORM 1A:</b></p>
                                <a
                                    href="#"
                                    class="form_1A_link"
                                    data-toggle="modal"
                                    data-target="#viewForm1AModal"
                                >
                                    View Form
                                </a>
                            @endif
                        </div>
                        <div class="col-md-2 text-right">
                            @if (!$case->isAssigned() && in_array(\Auth::user()->account_type, ['SP']))
                                <button
                                    class="btn btn-light-warning my-5"
                                    data-toggle="modal"
                                    data-target="#assignAnalyzeCaseModal"
                                    style='font-size: 1rem; padding: 1rem;'
                                >
                                    Assign
                                </button>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <button
                                class="btn btn-success-sm my-5"
                                onclick="window.location.href = '{{ route('cases.analyze-documents', ['case' => $case->id]) }}';"
                            >
                                View Documents Submitted
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($case->isCaseChecklistsApproved())
            @if ($case->isActiveUsersCase() && $case->checkApprovalRejection())
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-custom">
                            <h5>Analysis Document & Recommendation</h5>
                            <form
                                method="POST"
                                action="{{ route('cases.issue-recommendation', ['case' => $case->id]) }}"
                                enctype="multipart/form-data"
                            >
                                @csrf
                                <div class="row py-5">
                                    <div class="col-md-6 my-5">
                                        <div id="drop-area">
                                            <input accept=".doc,.docx,.pdf" type="file" id="fileElem" name="file" class="approval-file">
                                            <label class="drop-label" for="fileElem">
                                                <img src="{{ pc_asset(BE_IMAGE.'svg/file.svg') }}" alt="file">
                                                <br />Click to upload.
                                            </label>
                                        </div>
                                        <p class="text-primary my-3 doc_name"></p>
                                        <p class="text-danger mt-5">
                                            @error('file')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>
                                    <div class="col-md-6 my-5">
                                        <textarea class="form-control form-control-teaxtarea" name="recommendation" id="" cols="30"
                                            rows="10" >{{ $case->getRecommendation() }}</textarea>
                                        <p class="text-danger mt-5">
                                            @error('recommendation')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                        <br>
                                        <button type="submit" class="btn btn-success-sm my-5 pull-right">Issue Recommendation</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            @if ($case->isRecommendationIssued())
                @php
                    $recommendation_data = $case->active_handlers->first()->case_handler;
                @endphp
                @if (auth()->user()->isSupervisor() && $case->isApprovalRequested())
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-custom">
                                @if ($case->isApprovalRejected())
                                    <div class="ribbon ribbon-clip ribbon-left">
                                        <div class="ribbon-target" style="top: 15px;">
                                            <span class="ribbon-inner bg-danger"></span>Rejected
                                        </div>
                                    </div>
                                @endif
                                @if ($case->isApprovalApproved())
                                    <div class="ribbon ribbon-clip ribbon-left">
                                        <div class="ribbon-target" style="top: 15px;">
                                            <span class="ribbon-inner bg-success"></span>Approved
                                        </div>
                                    </div>
                                @endif
                                <h5>Analysis Document & Recommendation</h5>
                                <div class="row py-5">
                                    <div class="col-md-6 my-5">
                                        <div class="doc-card">
                                            <div class="row">
                                                <div class="col-md-2"><img src="{{ pc_asset(BE_IMAGE.'png/pdf.png') }}" alt="pdf"></div>
                                                <div class="col-md-4">
                                                    <div class="doc-name">Analysis document</div>
                                                </div>
                                                <div class="col-md-6 align-center">
                                                    <button
                                                        class="btn btn-success-sm"
                                                        type="button"
                                                        onclick="window.open('{{ route('cases.download_analysis_document', ['document' => $case->getAnalysisDocument()]) }}', '_blank');"
                                                    >
                                                        Download
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 my-5">
                                        <span><b>REASON/RECOMMENDATION:</b></span>
                                        <p>
                                            {!! nl2br($case->getRecommendation() ) !!}
                                        </p>
                                    </div>
                                </div>
                                @if ($case->isApprovalApproved() && !$case->isApprovalLetterSent())
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <button type="button" onclick="window.location.href='{{ route('cases.generate_template', ['case' => $case]) }}'" class="btn btn-success-sm my-5">Generate Approval Template</button>
                                        </div>
                                    </div>
                                @endif
                                @if (!$case->checkApprovalStatus())
                                    <form action="{{ route('cases.resolve-recommendation', ['case' => $case->id]) }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 my-5">
                                                <p class="mb-5"><b>COMMENT:</b></p>
                                                <textarea
                                                    class="form-control form-control-teaxtarea"
                                                    name="comment"
                                                    id=""
                                                    cols="30"
                                                    rows="10"
                                                ></textarea>
                                                <p class="text-danger mt-5">
                                                    @error('recommendation')
                                                        {{ $message }}
                                                    @enderror
                                                </p>
                                                <br>
                                                <div class="text-right">
                                                    <input type="submit" class="btn btn-success-sm my-5" name="status" value="Approve" />
                                                    <input type="submit" class="btn btn-danger-sm my-5" name="status" value="Reject" />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                @if($case->isActiveUsersCase())
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-custom">
                                @if ($case->isApprovalRejected())
                                    <div class="ribbon ribbon-clip ribbon-left">
                                        <div class="ribbon-target" style="top: 15px;">
                                            <span class="ribbon-inner bg-danger"></span>Rejected
                                        </div>
                                    </div>
                                @endif
                                @if ($case->isApprovalApproved())
                                    <div class="ribbon ribbon-clip ribbon-left">
                                        <div class="ribbon-target" style="top: 15px;">
                                            <span class="ribbon-inner bg-success"></span>Approved
                                        </div>
                                    </div>
                                @endif
                                <h5>Analysis Document & Recommendation</h5>
                                <div class="row py-5">
                                    <div class="col-md-6 my-5">
                                        <div class="doc-card">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <img src="{{ pc_asset(BE_IMAGE.'png/pdf.png') }}" alt="pdf" />
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="doc-name">Analysis document</div>
                                                </div>
                                                <div class="col-md-6 align-center">
                                                    <button
                                                        class="btn btn-success-sm"
                                                        type="button"
                                                        onclick="window.location.href = '{{ route('cases.download_analysis_document', ['document' => $case->getAnalysisDocument()]) }}';"
                                                    >
                                                        Download
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 my-5">
                                        <span><b>REASON/RECOMMENDATION:</b></span>
                                        <p>
                                            {!! nl2br($case->getRecommendation() ) !!}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    @if ($case->checkApprovalStatus())
                                        <div class="col-md-6">
                                            <p class="mb-5"><b>COMMENT:</b></p>
                                            <p>
                                                {!! nl2br($case->getApprovalComment() ) !!}
                                            </p>
                                        </div>
                                    @endif
                                    @if (!$case->isApprovalRequested())
                                        <div class="col-md-12 text-right">
                                            <form action="{{ route('cases.request-approval', ['case' => $case->id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success-sm my-5">Request Approval</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                                @if ($case->isApprovalApproved() && !$case->isApprovalLetterSent())
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <button type="button" onclick="window.location.href='{{ route('cases.generate_template', ['case' => $case]) }}'" class="btn btn-success-sm my-5">Generate Approval Template</button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @endif
    </div>
    <div
        class="modal fade"
        id="assignAnalyzeCaseModal"
        data-backdrop="static"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assign Case Handler</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form method="POST" action="#">
                    @csrf
                    <div class="modal-body">
                        <div class="py-9">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">Reference NO:</span>
                                <span class="text-muted text-hover-primary">{!! $case->getRefNO() !!}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">Submitted On:</span>
                                <span class="text-muted">{!! $case->getSubmittedAt() !!}</span>
                            </div>
                            <div>
                                <span class="font-weight-bold mr-2">Subject:</span>
                                <br />
                                <span>{{ $case->subject }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Select case handler:</label>
                                <br />
                                <select class="form-control select2" id="case_handler_dropdown" name="caseHandler"
                                    style="width: 100%;">
                                    @foreach($supervisors as $supervisor)
                                    <option value="{{ $supervisor->id }}">{{ $supervisor->getFullName() }}</option>
                                    @endforeach
                                    @foreach($caseHandlers as $handler)
                                    <option value="{{ $handler->id }}">{{ $handler->getFullName() }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="caseID">
                        <button
                            type="button"
                            id="assignAnalyzeCaseButton"
                            class="btn btn-light-primary font-weight-bold"
                            data-case-id="{{ $case->id }}"
                        >
                            Assign
                        </button>
                        <button id="assigningCaseButton" class="btn btn-primary font-weight-bold py-2 px-8 hide" disabled>
                            <div class="spinner-grow text-white" role="status">
                              <span class="sr-only">Loading...</span>
                            </div>
                        </button>
                        <button
                            type="button"
                            class="btn btn-light-danger font-weight-bold"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="viewForm1AModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="viewForm1AModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewCaseModalLabel">Form 1A</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="font-weight-bold mr-2">Date:</span>
                        <span class="text-dark">{{ $case->getForm1ADate() }}</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="font-weight-bold mr-2">Name:</span>
                        <span class="text-dark">{{ $case->form_1A_Name ?? '...' }}</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="font-weight-bold mr-2">Positon:</span>
                        <span class="text-dark">{{ $case->form_1A_Position ?? '...' }}</span>
                    </div>
                    <div class="mt-4">
                        <span class="font-weight-bold mr-2">Text:</span>
                        <br />
                        <span id="text">{!! nl2br($case->form_1A_Text) ?? '...' !!}</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('cases.generate_form1A_pdf', ['case' => $case]) }}" target="__blank">
                        <button type="submit" class="btn btn-light-primary font-weight-bold">Preview</button>
                    </a>
                    <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewDeficiencyModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="viewDeficiencyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewCaseModalLabel">Issue Deficiency</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-custom-approval" style="margin: -1.75rem; margin-bottom: -23px;">
                        <div class="card-header card-header-tabs-line" style="justify-content: center;border-bottom: none;">
                            <div class="card-toolbar">
                                <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#deficiency_tab">
                                            <span class="nav-icon"><i class="flaticon-list-2"></i></span>
                                            <span class="nav-text">Deficiency</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#applicant_tab">
                                            <span class="nav-icon"><i class="flaticon2-user"></i></span>
                                            <span class="nav-text">Applicant</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">

                                {{-- Deficiencies --}}
                                <div class="tab-pane fade show active" id="deficiency_tab" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-1">
                                                <textarea class="form-control" id="additional_info" rows="3" name="additional_info" placeholder="Additional Information..." required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Applicant --}}
                                <div class="tab-pane fade" id="applicant_tab" role="tabpanel">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="font-weight-bold mr-2">Firm:</span>
                                        <span class="text-dark" id="applicant_firm">{!! $case->applicant_firm !!}</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="font-weight-bold mr-2">Name:</span>
                                        <span class="text-dark" id="applicant_name">{!! $case->getApplicantName() !!}</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="font-weight-bold mr-2">Email:</span>
                                        <span class="text-dark text-hover-info" id="applicant_email">{!! $case->applicant_email !!}</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="font-weight-bold mr-2">Phone Number:</span>
                                        <span class="text-body text-hover-info" id="applicant_phone_number">{!! $case->applicant_phone_number !!}</span>
                                    </div>
                                    <div class="">
                                        <span class="font-weight-bold mr-2">Address:</span>
                                        <br />
                                        <span id="applicant_address">{!! $case->applicant_address !!}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="saving-deficiency" type="button" class="btn btn-primary font-weight-bold py-2 px-8 hide" disabled>
                        <div class="spinner-grow text-white" role="status">
                          <span class="sr-only">Loading...</span>
                        </div>
                    </button>
                    <button
                        id="issue-deficiency"
                        type="button"
                        class="btn btn-light-primary font-weight-bold"
                        data-analyze-case-route="{{ route('cases.analyze', ['case' => $case->id]) }}"
                        data-case-id={{ $case->id }}
                    >
                        Issue Deficiency
                    </button>
                    <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom.css')
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'reports.css') }}" />
@endsection

@section('custom.javascript')
    <script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/select2/js/select2.js') }}"></script>
    <script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/datatables/datatables.bundle.js') }}" defer></script>
    <script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'case-modal.js') }}"></script>
@endsection
