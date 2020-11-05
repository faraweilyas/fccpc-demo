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
                        $x                  = 1;
                        $deficient_count    = $checklistStatusCount->deficient ?? 0;
                    @endphp

                    @foreach(\App\Models\ChecklistGroup::with('checklists')->get() as $checklistGroup)

                        @php $document = $checklistGroupDocuments[$checklistGroup->id] ?? ''; @endphp
                        @if ($document !== '')
                            <div class="row my-3 py-5 hide" id="step-{{ $x }}">
                                <h5 class="text-bold w-50">

                                    {{ $checklistGroup->name }}
                                    <div class="pull-button-right">
                                        <button id="deficient-basket" class="btn btn-light-primary font-weight-bold mx-lg-5 py-3" data-toggle="modal"
                                            data-target="#Issue" data-case-id="{{ $case->id }}">
                                            <span class="svg-icon svg-icon-xl">

                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Cart3.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="20" height="20"></rect>
                                                        <path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#fff" fill-rule="nonzero" opacity="0.3"></path>
                                                        <path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#fff"></path>
                                                    </g>
                                                </svg>

                                                <!--end::Svg Icon-->
                                                <span class="checklist-deficient-count">{{ $checklistStatusCount->deficient ?? 0 }}</span>
                                                {{-- Deficiencies --}}
                                                {{-- <span class="checklist-deficient-text">Deficiencies</span> --}}
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
                                        $checklist_document = $document->checklists->where('id', $checklist->id)->first()->checklist_document ?? NULL;
                                        $checklist_document_status = $checklist_document->status ?? NULL;
                                        $checked = (in_array($checklist->id, $checklistIds) && !is_null($checklist_document->selected_at ?? NULL)) ? "consent-card-active" : '';
                                    @endphp
                                    <div class="col-lg-6">
                                        <div class="consent-card {{ $checked }}">
                                            <div class="d-flex">
                                                <div class="form-check" style="padding: 0px">
                                                    <div class="radio-inline">
                                                        @empty($checked)
                                                        <span class="switch switch-sm">
                                                            <label>
                                                                <input type="checkbox" class="save_approval" name="select" @if($checklist_document_status=='deficient' ) checked="checked" @endif value="deficient"
                                                                @if($checklist_document_status=='deficient' ) checked="checked"
                                                                @endif data-document-id="{{ $document->id }}"
                                                                data-checklist-id="{{ $checklist->id }}" data-case-id="{{ $case->id }}" data-switch-box="true">
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
                                                                data-checklist-id="{{ $checklist->id }}" data-case-id="{{ $case->id }}" data-switch-box="false">
                                                            <span></span>
                                                            Approve
                                                        </label>
                                                        <label class="radio">
                                                            <input class="form-check-input save_approval" type="radio"
                                                                name="exampleRadios{{ $checklist->id }}" value="deficient"
                                                                @if($checklist_document_status=='deficient' ) checked="checked"
                                                                @endif data-document-id="{{ $document->id }}"
                                                                data-checklist-id="{{ $checklist->id }}" data-case-id="{{ $case->id }}" data-switch-box="false">
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
                            Approve Complete Documents in the Checklist
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hide">
        <span class="case_id">{{ $case->id }}</span>
        {{-- Applicant --}}
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
                    <button type="button" class="btn btn-light-danger font-weight-bold"
                        data-dismiss="modal">Close</button>
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
        $(document).ready(function()
        {
            $('#cart').click(function()
            {
                $('#cart-dropdown').toggleClass('show');
            });
        });
    </script>
@endsection
