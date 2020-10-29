@extends('layouts.backend.admin') 

@section('content')
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">
                    Transaction Analysis
                </h5>
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
                        <a href="" class="text-muted">Checklist Documents</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@if(count($checklistGroupDocuments) > 0)
<div class="conatiner-fl px-5 py-5 ">

    <div class="card-custom relative">
        <h5 class="text-bold">Submitted Documents</h5>
        @if(in_array(\Auth::user()->account_type, ['SP']))
            @php 
                $cases = \Auth::user()->cases_working_on_by()->where('case_id', $case->id);
            @endphp
        @else
            @php 
                $cases = \Auth::user()->cases_working_on_to()->where('case_id', $case->id);
            @endphp
        @endif
        
        @if($cases->count() > 0)
            <a href="{{ route('cases.checklist-approval',[$case->id]) }}" class="btn btn-success-transparent-download">
                Continue Document Approval
            </a>
        @else
            <span id="start_doc_approval" class="btn btn-success-transparent-download" data-link="{{ route('cases.checklist-approval',[$case->id]) }}" data-workingon-link="{{ route('cases.update_working_on',[$case->id, \Auth::user()->id]) }}">
                Start Document Approval
            </span>
        @endif
        <div class="row">
            @foreach(\App\Models\ChecklistGroup::with('checklists')->get() as $checklistGroup)
            @php
            $document = $checklistGroupDocuments[$checklistGroup->id] ?? '';
            @endphp
            @if($document !== '')
            <div class="col-md-4 ">
                <div class="download-card">
                    <img src="{{ pc_asset(BE_IMAGE.'png/pdf.png') }}" alt="pdf" />

                    <p>{{ $checklistGroup->name }}</p>
                    <button class="btn btn-success-sm"
                        onclick="window.location.href = '{{ route('applicant.document.download', ['document' => $document->id]) }}';">Download</button>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
    @else
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card card-custom gutter-b example example-compact">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <img class="mw-40" src="data:image/png;base64,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">
                            </div>
                        </div>
                        <div class="row mt-6">
                            <div class="col-md-12 text-center">
                                <p><strong>No document was submitted.</strong></p>

                                <a href="#" class="btn btn-danger font-weight-bold text-uppercase mr-5 px-9 py-4">
                                    Issue a deficiency
                                </a>
                                <a data-turbolinks="false" href="{{ route('cases.analyze', ['case' => $case->id]) }}" class="btn btn-secondary font-weight-bold text-uppercase mr-5 px-9 py-4">
                                    Go back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('custom.css')
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'reports.css') }}" />
@endsection
