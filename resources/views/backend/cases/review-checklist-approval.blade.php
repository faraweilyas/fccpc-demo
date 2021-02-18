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
            <div class="card-custom relative">
                @php
                $x = 1;
                $deficient_count = $checklistStatus->count() ?? 0;
                @endphp
                @foreach($submittedDocuments as $document)
                @if ($document->group_id)
                <div class="row my-3 py-5 hide" id="step-{{ $x }}">
                    <h5 class="text-bold w-50 px-5">{{ $document->group->name }}</h5>
                    <div class="row mt-25 ml-1">
                        @php
                            $file_count = 1;
                        @endphp
                        @foreach($document->getFileArray() as $key => $file)
                            <div class="col-md-12 my-1">
                                <span>
                                    <a
                                        href="{{ route('applicant.document.download', ['document' => $document->id, 'file' => $file]) }}"
                                        class="text-dark text-hover-primary"
                                        target="__blank"
                                    >
                                        {{ ucfirst($document->group->name).' Doc_'.$file_count }}&nbsp;<i class="la la-download text-primary"></i>
                                    </a>
                                </span>
                            </div>
                            @php
                                $file_count++;
                            @endphp
                        @endforeach
                    </div>
                    <div class="height-75">
                        <div class="row py-5 margin-top">
                            <div class="col-md-12 ">
                                <p><b>Additional Information:</b></p>
                                <p>{{ $document->getAdditionalInfo() }}</p>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($document->group->checklists as $checklist)
                            @php
                                $checklist_document_status = $document->getChecklistDocumentStatus($checklist);
                                $checklist_reason = $document->getChecklistDocumentReason($checklist);
                                $checked = $document->getCheckedChecklistDocument($checklist, $checklistIds);
                            @endphp
                            <div class="col-lg-6">
                                <div class="consent-card {{ $checked }}">
                                    <div class="d-flex">
                                        <div class="form-check" style="padding: 0px">
                                            <div class="radio-inline">
                                                <label class="radio">
                                                    <input class="form-check-input" type="radio"
                                                        @if($checklist_document_status=='approved' ) checked="checked"
                                                        @endif>
                                                    <span></span>
                                                    Approve
                                                </label>
                                                <label class="radio">
                                                    <input class="form-check-input" type="radio"
                                                        @if($checklist_document_status=='deficient' ) checked="checked"
                                                        @endif>
                                                    <span></span>
                                                    Deficient
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <p>{!! ucfirst($checklist->name) !!}</p>
                                    <textarea
                                        class="form-control @if($checklist_document_status !== 'deficient' ) hide @endif" rows="3" placeholder="Reason (If Deficient)">{{ $checklist_reason }}</textarea>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                @php $x++ @endphp
                @endif
                <input class="checklist_group_count" type="hidden" value="{{ $submittedDocuments->count() }}" />
                @endforeach
                @if($submittedDocuments->count() > 1)
                    <div class="btn-group">
                        <button class="btn btn-success-pale-ts no-border mx-1 px-10 py-4" id="prev">Previous</button>
                        <button class="btn btn-success-pale-ts no-border mx-1 px-10 py-4" id="next">Next</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom.css')
<link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'reports.css') }}" />
@endsection

@section('custom.javascript')
<script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'checklist_approval.js') }}"></script>
<script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/select2/js/select2.min.js') }}"></script>
@endsection
