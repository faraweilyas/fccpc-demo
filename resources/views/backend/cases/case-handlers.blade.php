@extends('layouts.backend.admin')

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Case Handlers</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">Case Handlers</a>
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
                            <h3 class="card-label">Case Handlers</h3>
                        </div>
                        <span class="float-right"><button class="btn btn-success-ts no-border mx-5"
                                onclick="window.location.href = '{{ route('handlers.create') }}';">New Case
                                Handler</button></span>
                    </div>
                    <div class="card-body">
                        <table class="table table-separate table-head-custom table-checkable" id="case_handlers_datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="text-center">Assigned Cases</th>
                                    <th class="text-center">Cases On Hold</th>
                                    <th class="text-center">Ongoing Cases</th>
                                    <th class="text-center">Approved Cases</th>
                                    <th>Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($handlers as $handler)
                                <tr>
                                    <td>
                                        <b>{{ $handler->getFullName() }}</b>
                                    </td>
                                    <td class="text-center">
                                        <a
                                            href="@if($handler->active_cases_assigned_to()->count() > 0) {{ route('cases.assigned', ['handler' => $handler->id]) }} @else # @endif">
                                            <span
                                                class="badge badge-success"><b>{{ $handler->active_cases_assigned_to()->count() }}</b></span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a
                                            href="@if($handler->deficient_cases(TRUE)->count() > 0) {{ route('cases.on-hold', ['handler' => $handler->id]) }} @else # @endif">
                                            <span
                                                class="badge badge-secondary"><b>{{ $handler->deficient_cases(TRUE)->count() }}</b></span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a
                                            href="@if($handler->cases_working_on(TRUE)->count() > 0) {{ route('cases.working_on', ['handler' => $handler->id]) }} @else # @endif">
                                            <span
                                                class="badge badge-secondary"><b>{{ $handler->cases_working_on(TRUE)->count() }}</b></span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a
                                            href="@if($handler->approved_cases(TRUE)->count() > 0) {{ route('cases.approved', ['handler' => $handler->id]) }} @else # @endif">
                                            <span
                                                class="badge badge-secondary"><b>{{ $handler->approved_cases(TRUE)->count() }}</b></span>
                                        </a>
                                    </td>
                                    <td>
                                        {!! $handler->getStatusHtml() !!}
                                    </td>
                                    <td class="text-center" nowrap="nowrap">
                                        @if($handler->status === "active")
                                        <a href="{{ route('handlers.update_status', ['handler' => $handler->id]) }}"
                                            class="btn btn-sm btn-light-danger mr-3" title="Deactivate Case Handler">
                                            <i class="flaticon-user-settings"></i> Deactivate
                                        </a>
                                        @elseif($handler->status === "inactive")
                                        <a href="{{ route('handlers.update_status', ['handler' => $handler->id]) }}"
                                            class="btn btn-sm btn-light-success mr-3" title="Activate Case Handler">
                                            <i class="flaticon-user-add"></i> Activate
                                        </a>
                                        @endif
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
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'reports.css') }}" />
@endsection

@section('custom.javascript')
    <script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/select2/js/select2.js') }}"></script>
    <script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/datatables/datatables.bundle.js') }}" defer></script>
    <script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'case-modal.js') }}"></script>
@endsection
