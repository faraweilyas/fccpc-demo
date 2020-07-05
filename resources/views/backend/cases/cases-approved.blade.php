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
                                    <th>Parties</th>
                                    <th>Category</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Models\Cases::all() as $case)
                                <tr>
                                    <td class="text-center">
                                        <b>{{ $case->getRefNO() }}</b>
                                    </td>
                                    <td>{{ ucwords($case->subject) }}</td>
                                    <td class="text-center">
                                        <span class="label label-lg font-weight-bold label-light-secondary text-dark label-inline"><b>{{ $case->getType() }}</b></span>
                                    </td>
                                    <td>
                                        {!! $case->generateCasePartiesBadge() !!}
                                    </td>
                                    <td>
                                        <b>{{ $case->getCategory('strtoupper') }}</b>
                                    </td>
                                    <td>
                                        <a href="{{ route('cases.review', ['id' => $case->id]) }}" class="btn btn-sm btn-icon text-hover-primary" title="View Case">
                                            <i class="la la-info-circle"></i>&nbsp;&nbsp;Review
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
