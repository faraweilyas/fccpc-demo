@extends('layouts.backend.admin')

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <h5 class="text-dark font-weight-bold my-2 mr-5">ID Requests</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">ID Requests</a>
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
                            <h3 class="card-label">ID Requests</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-separate table-head-custom table-checkable" id="assigned_cases_datatable">
                            <thead>
                                <tr>
                                    <th>Requested On</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th class="text-center">Action(s)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($requests as $request)
                                <tr>
                                    <td data-sort='YYYYMMDD'>
                                        <div class="font-weight-bold text-dark mb-0" data-sort='YYYYMMDD'
                                            data-order=<fmt:formatDate pattern="yyyy-MM-dd" value={!! $request->
                                            getSubmittedAt('customdate') !!} />
                                            {!! $request->getSubmittedAt('customdate') !!}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="font-weight-bolder mb-0">
                                            {{ $request->email }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="font-weight-bolder mb-0">
                                            {{ $request->subject }}
                                        </div>
                                    </td>
                                    <td nowrap="nowrap" class="text-center">
                                        <a href="#"
                                            class="btn btn-sm btn-light-primary mr-3" title="Analyse Case">
                                            <i class="flaticon-paper-plane"></i> Send
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom.css')
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_PLUGIN.'custom/datatables/datatables.bundle.css') }}" />
@endsection

@section('custom.javascript')
    <script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/select2/js/select2.js') }}"></script>
    <script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/datatables/datatables.bundle.js') }}" defer></script>
    <script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'case-modal.js') }}"></script>
@endsection
