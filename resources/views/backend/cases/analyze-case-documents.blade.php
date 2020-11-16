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
        $cases = \Auth::user()->cases_working_on_by()->where('case_id', $case->id)->get();
        @endphp
        @else
        @php
        $cases = \Auth::user()->cases_working_on_to()->where('case_id', $case->id)->get();
        @endphp
        @endif

        <hr >

        @if($cases->count() > 0)
        <a href="{{ route('cases.checklist-approval',[$case->id]) }}" class="btn btn-success-transparent-download">
            Continue Document Approval
        </a>
        @else

        
       
        <div class="mt-20">
            <span id="start_doc_approval" class="btn btn-success-transparent-download"
                data-link="{{ route('cases.checklist-approval',[$case->id]) }}"
                data-workingon-link="{{ route('cases.update_working_on',[$case->id, \Auth::user()->id]) }}">
                Start Document Approval
            </span>
            
            @endif
           <div class="d-flex justify-content-end">
            <button  class="btn btn-success-transparent-timestamp btn-sm px-3">
                Start Document Approval
            </button>
            <button  class="btn btn-success-transparent-timestamp btn-sm px-3 mx-5">
                Continue Document Approval
            </button>
           </div>
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

        
    </div>
    @else
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card card-custom gutter-b example example-compact">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <img class="mw-40" src="{{ pc_asset(BE_IMG.'/png/close.png') }}">
                            </div>
                        </div>
                        <div class="row mt-6">
                            <div class="col-md-12 text-center">
                                <p><strong>No document was submitted.</strong></p>

                                <a href="#" class="btn btn-danger font-weight-bold text-uppercase mr-5 px-9 py-4">
                                    Issue a deficiency
                                </a>
                                <a data-turbolinks="false" href="{{ route('cases.analyze', ['case' => $case->id]) }}"
                                    class="btn btn-secondary font-weight-bold text-uppercase mr-5 px-9 py-4">
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
