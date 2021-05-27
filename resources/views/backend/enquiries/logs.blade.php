@extends('layouts.backend.admin')

@section('content')
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Pre-Notifications</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Pre-Notification Consultations</a>
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
                        <h3 class="card-label">All Pre-Notifications</h3>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-separate table-head-custom table-checkable" id="enquiries_log_datatable">
                        <thead>
                            <tr>
                                <th>Date Submitted</th>
                                <th class="text-center">Case Handler</th>
                                <th class="text-center">Type</th>
                                <th>Subject</th>
                                <th class="text-center">Name</th>
                                <th>Status</th>
                                <th class="text-left">Action(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enquiries as $item)
                            <tr>
                                <td data-sort='YYYYMMDD'>
                                    <div class="font-weight-bold text-dark mb-0" data-sort='YYYYMMDD'
                                        data-order=<fmt:formatDate pattern="yyyy-MM-dd" value={!! $item->
                                        getSubmittedAt('customdate') !!} />
                                        {!! $item->getSubmittedAt('customdate') !!}
                                    </div>
                                </td>
                                <td class="text-center">
                                    {{ $item->getHandlerName() }}
                                </td>
                                <td class="text-center">
                                    <span
                                        class="label label-lg font-weight-bold label-light-{{ $item->getEnquiryTypeHTML() }} text-dark label-inline">
                                        <b>{{ $item->getEnquiryType('strtoupper') }}</b>
                                    </span>
                                </td>
                                <td>{{ $item->subject }}</td>
                                <td class="text-center"><b>{{ $item->getFullName() }}</b></td>
                                <td><b>{{ $item->getStatus() }}</b></td>
                                <td class="text-left" nowrap="nowrap">
                                    <a href="#" class="btn btn-sm btn-light-warning mr-3" title="View Enquiry Info"
                                        data-toggle="modal" data-target="#viewEnqiryModal">
                                        <i class="flaticon-eye"></i>
                                    </a>
                                    @if(in_array(\Auth::user()->account_type, ['SP']) && $item->status == 'pending')
                                        <a href="#" class="assignEnquiryButton btn btn-sm btn-light-info mr-3"
                                            title="Assign Case Handler To Enquiry" data-toggle="modal" data-target="#assignEnquiryModal">
                                            <i class="flaticon-user-add"></i>
                                        </a>
                                    @endif
                                    @if ($item->file != '')
                                        <a href="{{ route('enquiries.download', ['file' => $item->file]) }}"
                                            target="__blank"
                                            class="btn btn-sm btn-light-primary mr-3" title="Download enquiry document">
                                            <i class="la la-download"></i>
                                        </a>
                                    @else
                                        <a href="#"
                                            class="btn btn-sm btn-light-danger mr-3" title="No Document">
                                            <i class="la la-download"></i>
                                        </a>
                                    @endif
                                    <div class="hide">
                                        <span class="enquiry_id">{{ $item->id }}</span>
                                        <span class="email">{{ $item->email }}</span>
                                        <span class="message">{{ $item->message }}</span>
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


@include("layouts.modals.enquiry")
@include("layouts.modals.enquiry-handler", [
'caseHandlers' => $caseHandlers
])
@endsection

@section('custom.css')
<link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_PLUGIN.'custom/datatables/datatables.bundle.css') }}" />
@endsection

@section('custom.javascript')
<script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/select2/js/select2.js') }}"></script>
<script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/datatables/datatables.bundle.js') }}" defer></script>
<script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'case-modal.js') }}"></script>
@endsection
