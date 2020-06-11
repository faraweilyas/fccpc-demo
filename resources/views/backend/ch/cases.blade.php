@extends('layouts.backend.base')
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
                    @if($type == 'new')
                    <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                        <thead>
                            <tr>
                                <th class="text-center">Ref No</th>
                                <th>Subject</th>
                                <th class="text-center">Transaction Type</th>
                                <th>Parties</th>
                                <th class="text-center">Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cases as $case)
                            <tr>
                                <td class="text-center">
                                    <b>{{ $case->getRefNO() }}</b>
                                </td>
                                <td>{{ ucwords($case->subject) }}</td>
                                <td class="text-center">
                                    <b>{{ $case->getTransactionType() }}</b>
                                </td>
                                <td>
                                    {!! $case->generateCasePartiesBadge() !!}
                                </td>
                                <td class="text-center">
                                    <b>{{ $case->getCaseCategory('strtoupper') }}</b>
                                </td>
                                <td>
                                    <a href="javascript:;" class="btn btn-sm btn-icon" title="Edit details" data-toggle="modal" data-target="#assignCaseModal{{ $case->id }}">
                                        <i class="la la-edit"></i>Assign
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @elseif ($type == 'assigned')
                    <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                        <thead>
                            <tr>
                                <th>Ref No</th>
                                <th>Subject</th>
                                <th>Transaction Type</th>
                                <th>Case Handler</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Cases::where('status', 2)->get() as $case)
                            <tr>
                                <td>
                                    <span class="label label-lg font-weight-bold label-light-primary label-inline">{{ $case->ref_no }}</span>
                                </td>
                                <td>{{ ucwords($case->subject) }}</td>
                                <td>
                                    <span class="label label-lg font-weight-bold label-light-secondary text-dark label-inline">{{ $case->transaction_type }}</span>
                                </td>
                                <td>
                                    {{ \App\User::find($case->case_handler_id)->getFullName() }}
                                </td>
                                <td>
                                    <span class="label label-lg font-weight-bold label-light-info text-dark label-inline">{{ $case->getCaseCategory('ucfirst') }}</span>
                                </td>
                                <td>
                                    <span class="label label-lg font-weight-bold label-light-{{ $case->getCaseStatusHTML() }} text-dark label-inline">{{ $case->getCaseStatus('ucfirst') }}</span>
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
                    @elseif ($type == 'hold')
                    <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                        <thead>
                            <tr>
                                <th>Ref No</th>
                                <th>Subject</th>
                                <th>Transaction Type</th>
                                <th>Case Handler</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Cases::where('status', 3)->get() as $case)
                            <tr>
                                <td>
                                    <span class="label label-lg font-weight-bold label-light-primary label-inline">{{ $case->ref_no }}</span>
                                </td>
                                <td>{{ ucwords($case->subject) }}</td>
                                <td>
                                    <span class="label label-lg font-weight-bold label-light-secondary text-dark label-inline">{{ $case->transaction_type }}</span>
                                </td>
                                <td>
                                    {{ \App\User::find($case->case_handler_id)->getFullName() }}
                                </td>
                                <td>
                                    <span class="label label-lg font-weight-bold label-light-info text-dark label-inline">{{ $case->getCaseCategory('ucfirst') }}</span>
                                </td>
                                <td>
                                    <span class="label label-lg font-weight-bold label-light-{{ $case->getCaseStatusHTML() }} text-dark label-inline">{{ $case->getCaseStatus('ucfirst') }}</span>
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
                    @elseif($type == 'approved')
                    <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                        <thead>
                            <tr>
                                <th>Ref No</th>
                                <th>Subject</th>
                                <th>Transaction Type</th>
                                <th>Parties</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Cases::where('status', 4)->get() as $case)
                            <tr>
                                <td>
                                    <span class="label label-lg font-weight-bold label-light-primary label-inline">{{ $case->ref_no }}</span>
                                </td>
                                <td>{{ ucwords($case->subject) }}</td>
                                <td>
                                    <span class="label label-lg font-weight-bold label-light-secondary text-dark label-inline">{{ $case->transaction_type }}</span>
                                </td>
                                <td>
                                    {{ $case->parties }}
                                </td>
                                <td>
                                    <span class="label label-lg font-weight-bold label-light-warning text-dark label-inline">{{ $case->getCaseCategory() }}</span>
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
                    @elseif($type == 'archived')
                    <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                        <thead>
                            <tr>
                                <th>Ref No</th>
                                <th>Subject</th>
                                <th>Transaction Type</th>
                                <th>Parties</th>
                                <th>Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Cases::where('status', 5)->get() as $case)
                            <tr>
                                <td>
                                    <span class="label label-lg font-weight-bold label-light-primary label-inline">{{ $case->ref_no }}</span>
                                </td>
                                <td>{{ ucwords($case->subject) }}</td>
                                <td>
                                    <span class="label label-lg font-weight-bold label-light-secondary text-dark label-inline">{{ $case->transaction_type }}</span>
                                </td>
                                <td>
                                    {{ $case->parties }}
                                </td>
                                <td>
                                    <span class="label label-lg font-weight-bold label-light-warning text-dark label-inline">{{ $case->getCaseCategory() }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@foreach(\App\Models\Cases::whereIn('status', array(1,2,3,4))->get() as $case)
<div class="modal fade" id="assignCaseModal{{$case->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assign case handler to case</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form method="POST" action="{{ route('cases.assign', ['id' => $case->id]) }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Subject</label>
                            <input type="text" class="form-control" value="{{ ucfirst($case->subject) }}" disabled>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <label>Select case handler</label><br>
                            <select class="form-control select2" id="case_handler" name="case_handler" style="width: 100%;">
                                @foreach(\App\User::where('status', 1)->where('accountType', 'CH')->get() as $handler)
                                    <option value="{{ $handler->id }}">{{ $handler->getFullName() }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">Assign</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endSection('content')
