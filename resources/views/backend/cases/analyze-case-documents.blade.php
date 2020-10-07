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
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Documents Checklist</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="conatiner-fl px-5 py-5 relative">
    <div class="row">
        <div class="col-md-12">
            <div class="card-custom">
                <h5 class="text-bold">Completed / Submitted</h5>
                <a href="{{ route('cases.checklist-approval',array($case->id)) }}"
                    class="btn btn-success-transparent-download">
                    Start Document Approval
                </a>

                <div class="download-content py-5 my-5">
                    <div class="download-card">
                        <img src="{{ pc_asset(BE_IMAGE.'png/pdf.png') }}" alt="pdf" />

                        <p>Letter of intent to merge</p>
                        <button class="btn btn-success-sm">View Details</button>
                    </div>
                    <div class="download-card">
                        <img src="{{ pc_asset(BE_IMAGE.'png/pdf.png') }}" alt="pdf" />

                        <p>Letter of intent to merge</p>
                        <button class="btn btn-success-sm">View Details</button>
                    </div>
                    <div class="download-card">
                        <img src="{{ pc_asset(BE_IMAGE.'png/pdf.png') }}" alt="pdf" />

                        <p>Letter of intent to merge</p>
                        <button class="btn btn-success-sm">View Details</button>
                    </div>
                </div>

                <div class="download-content my-3">
                    <div class="download-card">
                        <img src="{{ pc_asset(BE_IMAGE.'png/pdf.png') }}" alt="pdf" />

                        <p>Letter of intent to merge</p>
                        <button class="btn btn-success-sm">View Details</button>
                    </div>
                    <div class="download-card">
                        <img src="{{ pc_asset(BE_IMAGE.'png/pdf.png') }}" alt="pdf" />

                        <p>Letter of intent to merge</p>
                        <button class="btn btn-success-sm">View Details</button>
                    </div>
                    <div class="download-card">
                        <img src="{{ pc_asset(BE_IMAGE.'png/pdf.png') }}" alt="pdf" />

                        <p>Letter of intent to merge</p>
                        <button class="btn btn-success-sm">View Details</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection
@section('custom.css')
<link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'reports.css') }}" />
@endsection
