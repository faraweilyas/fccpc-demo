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
                        <a href="{{ route('cases.analyze', ['case' => $case->id]) }}" class="text-muted">Analyze
                            Case</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('cases.analyze-documents', ['case' => $case->id]) }}"
                            class="text-muted">Checklist Documents</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Checklist Approval</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-custom">
                @php
                $x = 1;
                $deficient_count = $checklistStatusCount->deficient ?? 0;
                @endphp

                @foreach(\App\Models\ChecklistGroup::with('checklists')->get() as $checklistGroup)

                @php $document = $checklistGroupDocuments[$checklistGroup->id] ?? ''; @endphp
                @if ($document !== '')
                <div class="row my-3 py-5 hide" id="step-{{ $x }}">
                    <h5 class="text-bold w-50">

                        {{ $checklistGroup->name }}
                        <div class="pull-button-right">
                            <button id="deficient-basket" class="btn btn-light-primary font-weight-bold mx-lg-5 py-3"
                                data-toggle="modal" data-target="#Issue" data-case-id="{{ $case->id }}">
                                <span class="svg-icon svg-icon-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M4.5,21 L21.5,21 C22.3284271,21 23,20.3284271 23,19.5 L23,8.5 C23,7.67157288 22.3284271,7 21.5,7 L11,7 L8.43933983,4.43933983 C8.15803526,4.15803526 7.77650439,4 7.37867966,4 L4.5,4 C3.67157288,4 3,4.67157288 3,5.5 L3,19.5 C3,20.3284271 3.67157288,21 4.5,21 Z"
                                                fill="#000000" opacity="0.3" />
                                            <path
                                                d="M2.5,19 L19.5,19 C20.3284271,19 21,18.3284271 21,17.5 L21,6.5 C21,5.67157288 20.3284271,5 19.5,5 L9,5 L6.43933983,2.43933983 C6.15803526,2.15803526 5.77650439,2 5.37867966,2 L2.5,2 C1.67157288,2 1,2.67157288 1,3.5 L1,17.5 C1,18.3284271 1.67157288,19 2.5,19 Z"
                                                fill="#000000" />
                                        </g>
                                    </svg>
                                    <span
                                        class="checklist-deficient-count">{{ $checklistStatusCount->deficient ?? 0 }}</span>

                                </span>
                            </button>

                            <button class="btn btn-success no-border px-10 py-4"
                                onclick="window.location.href = '{{ route('applicant.document.download', ['document' => $document->id]) }}';">
                                Download Checklist Document
                            </button>
                        </div>
                    </h5>
                    <div class="row py-5 margin-top">
                        <div class="col-md-12">
                            <p><b>Additional Information:</b></p>
                            <p>
                                @empty($document->additional_info) ... @else {{ $document->additional_info }} @endif
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($checklistGroup->checklists as $checklist)
                        @php
                        $checklist_document = $document->checklists->where('id',
                        $checklist->id)->first()->checklist_document ?? NULL;
                        $checklist_document_status = $checklist_document->status ?? NULL;
                        $checked = (in_array($checklist->id, $checklistIds) && !is_null($checklist_document->selected_at
                        ?? NULL)) ? "consent-card-active" : '';
                        @endphp
                        <div class="col-lg-6">
                            <div class="consent-card {{ $checked }}">
                                <div class="d-flex">
                                    <div class="form-check" style="padding: 0px">
                                        <div class="radio-inline">
                                            @empty($checked)
                                            <span class="switch switch-sm">
                                                <label>
                                                    <input type="checkbox" class="save_approval" name="select"
                                                        @if($checklist_document_status=='deficient' ) checked="checked"
                                                        @endif value="deficient"
                                                        @if($checklist_document_status=='deficient' ) checked="checked"
                                                        @endif data-document-id="{{ $document->id }}"
                                                        data-checklist-id="{{ $checklist->id }}"
                                                        data-case-id="{{ $case->id }}" data-switch-box="true">
                                                    <span></span>
                                                </label>
                                                Deficient
                                            </span>
                                            @else
                                            <label class="radio">
                                                <input class="form-check-input save_approval" type="radio"
                                                    name="exampleRadios{{ $checklist->id }}" value="approved"
                                                    @if($checklist_document_status=='approved' ) checked="checked"
                                                    @endif data-document-id="{{ $document->id }}"
                                                    data-checklist-id="{{ $checklist->id }}"
                                                    data-case-id="{{ $case->id }}" data-switch-box="false">
                                                <span></span>
                                                Approve
                                            </label>
                                            <label class="radio">
                                                <input class="form-check-input save_approval" type="radio"
                                                    name="exampleRadios{{ $checklist->id }}" value="deficient"
                                                    @if($checklist_document_status=='deficient' ) checked="checked"
                                                    @endif data-document-id="{{ $document->id }}"
                                                    data-checklist-id="{{ $checklist->id }}"
                                                    data-case-id="{{ $case->id }}" data-switch-box="false">
                                                <span></span>
                                                Deficient
                                            </label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <p>
                                    {{ ucfirst($checklist->name) }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @php $x++ @endphp
                @endif
                <input class="checklist_group_count" type="hidden" value="{{ count($checklistGroupDocuments) }}" />
                @endforeach
                <div class="btn-group">
                    <button class="btn btn-success-pale-ts no-border mx-1 px-10 py-4" id="prev">
                        Previous
                    </button>
                    <button class="btn btn-success-pale-ts no-border mx-1 px-10 py-4" id="next">
                        Next
                    </button>
                    <button class="btn btn-warning no-border mx-5 px-10 py-4 hide" id="deficiency" data-toggle="modal"
                        data-target="#viewDeficiencyModal">
                        Issue Deficiency
                    </button>
                    <button class="btn btn-success no-border px-10 py-4 hide" id="approve">
                        Approve Checklist
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="hide">
    <span class="case_id">{{ $case->id }}</span>

    <span class="firm">{!! $case->applicant_firm !!}</span>
    <span class="name">{!! $case->getApplicantName() !!}</span>
    <span class="email">{!! $case->applicant_email !!}</span>
    <span class="phone_number">{!! $case->applicant_phone_number !!}</span>
    <span class="address">{!! $case->applicant_address !!}</span>
</div>
<div class="modal fade" id="Issue" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Deficient Documents</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="deficient_cases_list" class="py-5">
                    @foreach($case->getCaseSubmittedChecklistByStatus('deficient') as $checklist)
                    <div>
                        <p class="alert-custom ">
                            {{ $checklist->name }}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="caseID">
                <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@include("layouts.modals.deficiency")
@endsection

@section('custom.css')
<link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'reports.css') }}" />
@endsection

@section('custom.javascript')
<script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'checklist_approval.js') }}"></script>
<script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#cart').click(function () {
            $('#cart-dropdown').toggleClass('show');
        });
    });

</script>
@endsection
