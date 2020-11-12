@extends('layouts.backend.admin')

@section('content')
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Enquiries Log</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Enquiries Log</a>
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
                        <h3 class="card-label">Enquiries Log</h3>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Type</th>
                                <th>Date Submitted</th>
                                <th>Action(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enquiries as $item)
                            <tr>
                                <td><b>{{ $item->getFullName() }}</b></td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone_number }}</td>
                                <td>
                                    <span
                                        class="label label-lg font-weight-bold label-light-{{ $item->getEnquiryTypeHTML() }} text-dark label-inline">
                                        <b>{{ $item->getEnquiryType('strtoupper') }}</b>
                                    </span>
                                </td>
                                <td>{{ datetimeToText($item->created_at, 'customd') }}</td>
                                <td nowrap="nowrap">
                                    @if($item->file != '')
                                    <div class="dropdown dropdown-inline">
                                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon"
                                            data-toggle="dropdown">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                            <ul class="nav nav-hoverable flex-column">
                                                @if(in_array(\Auth::user()->accountType,['SP'])):
                                                <li class="nav-item">
                                                    <a class="nav-link" href="javascript:;" title="Assign Enquiry"
                                                        data-toggle="modal"
                                                        data-target="#assignEnquiryModal{{ $item->id }}">
                                                        <i class="nav-icon la la-edit"></i>
                                                        <span class="nav-text">Assign</span>
                                                    </a>
                                                </li>
                                                @endif
                                                <li class="nav-item">
                                                    <a class="nav-link"
                                                        href="{{ route('enquiries.download', ['file' => $item->file]) }}">
                                                        <i class="nav-icon la la-leaf"></i>
                                                        <span class="nav-text">Download File</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
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
