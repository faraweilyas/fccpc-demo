@extends('layouts.backend.admin')

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <h5 class="text-dark font-weight-bold my-2 mr-5">{{ $case }}</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">{{ $case }}</a>
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
                            <h3 class="card-label">{{ $case }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                            <thead>
                                <tr>
                                    <th class="text-center">Ref No</th>
                                    <th>Subject</th>
                                    <th class="text-center">Transaction Type</th>
                                    {{-- <th>Parties</th> --}}
                                    <th class="text-center">Category</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Models\Cases::where('user_id',  null)->get() as $case)
                                <tr>
                                    <td class="text-center">
                                        <b>{{ $case->getRefNO() }}</b>
                                    </td>
                                    <td class="case-subject">{{ ucwords($case->subject) }}</td>
                                    <td class="text-center">
                                        <b>{{ $case->getType() }}</b>
                                    </td>
                                    {{-- <td>
                                        {!! $case->generateCasePartiesBadge() !!}
                                    </td> --}}
                                    <td class="text-center">
                                        <b>{{ $case->getCategory('strtoupper') }}</b>
                                    </td>
                                    <td nowrap="nowrap">
                                        <div class="dropdown dropdown-inline">
                                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                <ul class="nav nav-hoverable flex-column">
                                                    <li class="nav-item nav-item-hover">
                                                        <a class="nav-link nav-link-padding" href="#" title="Assign Case Handler">
                                                            <i class="nav-icon la la-info"></i>
                                                            <span class="nav-text">View</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item nav-item-hover">
                                                        <a class="nav-link nav-link-padding" href="#" data-toggle="modal" data-target="#assignCaseModal" title="Assign Case Handler">
                                                            <i class="nav-icon la la-edit"></i>
                                                            <span class="nav-text">Assign</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
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
    <!-- Modals -->
    @include("layouts.modals.case-handler")
@endsection

@section('custom.javascript')
    <script src="{{ pc_asset(BE_JS.'jquery.min.js') }}"></script>
    <script src="{{ pc_asset(BE_JS.'pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="{{ pc_asset(BE_APP_JS.'case-modal.js') }}"></script>
@endsection
