@extends('layouts.backend.admin')

@section('content')
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Generate Report</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Generate Report</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>



<div class="container py-5">

    <div class="row my-sm-20">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="d-flex py-4">

                <img src="{{ pc_asset(BE_IMAGE.'svg/book-open.svg') }}" alt="book-open" />

                <div class="gr-header-content">
                    <p>New Report</p>
                    <span>Create your new report</span>
                </div>
            </div>
            <form method="POST" action="{{ route('dashboard.report') }}">
                @csrf
                <div class="card__box card__box__large  rmv-height add-mgbottom " id="applications">
                    <div class="card__box__large-content">
                        <div class="form-group">
                            <label>Start Date</label>
                            <input class="form-control" type="date" name="start_date" />
                        </div>
                        <div class="form-group">
                            <label>End Date</label>
                            <input class="form-control" type="date" name="end_date" />
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label>Select Case Handler</label>
                                <select class="form-control form-control-table select2" id="caseHandler" name="caseHandler" style="width: 100%;">
                                   @foreach($handlers as $handler)
                                        <option value="{{ $handler->id }}">{{ $handler->getFullName() }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mt-4">
                                <div class="view-doc-link">
                                    <a href="#" data-toggle="modal" data-target="#generateReportModal">
                                        Custom Filter
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-success btn-block">
                                    Submit Request
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>



<div class="modal fade" id="generateReportModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Custom Filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form method="POST" action="{{ route('dashboard.report.custom') }}">
                @csrf
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">

                            <label>Case Type</label>
                            <select class="form-control form-control-table" name="type">
                                @foreach(\AppHelper::get('case_types') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="col-md-12 mt-4">

                            <label>Case Category</label>
                            <select class="form-control form-control-table" name="category">
                                @foreach(\AppHelper::get('case_categories') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>


                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="caseID">
                    <button type="submit" class="btn btn-light-primary font-weight-bold">Submit Request</button>
                    <button type="button" class="btn btn-light-danger font-weight-bold"
                        data-dismiss="modal">Close</button>

                </div>
            </form>
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
