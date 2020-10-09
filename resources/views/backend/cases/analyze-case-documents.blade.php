@extends('layouts.backend.admin') @section('content')
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">
                    Case Analysis
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

<div class="conatiner-fl px-5 py-5 ">

    <div class="card-custom relative">
        <h5 class="text-bold">Submitted Checklist Document</h5>
        <a href="{{ route('cases.checklist-approval',[$case->id]) }}" class="btn btn-success-transparent-download">
            Start Document Approval
        </a>



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

@endsection
@section('custom.css')
<link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'reports.css') }}" />
@endsection
