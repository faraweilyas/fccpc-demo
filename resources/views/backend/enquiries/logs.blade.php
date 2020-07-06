@extends('layouts.backend.admin')

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Enquiries</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">Enquiries</a>
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
                            <h3 class="card-label">All Enquiries</h3>
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
                                @foreach(\App\Models\Enquiry::all()->sortByDesc('id') as $item)
                                <tr>
                                    <td><b>{{ $item->getFullName() }}</b></td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td>
                                        <span class="label label-lg font-weight-bold label-light-{{ $item->getEnquiryTypeHTML() }} text-dark label-inline">
                                            <b>{{ $item->getEnquiryType('strtoupper') }}</b>
                                        </span>
                                    </td>
                                    <td>{{ datetimeToText($item->created_at, 'customd') }}</td>
                                    <td nowrap="nowrap">
                                        <div class="dropdown dropdown-inline">
                                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                <ul class="nav nav-hoverable flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="javascript:;" title="Assign Enquiry" data-toggle="modal" data-target="#assignEnquiryModal{{ $item->id }}">
                                                            <i class="nav-icon la la-edit"></i>
                                                            <span class="nav-text">Assign</span>
                                                        </a>
                                                    </li>
                                                    @if ($item->file != '')
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{ route('enquiries.download', ['file' => $item->file]) }}">
                                                            <i class="nav-icon la la-leaf"></i>
                                                            <span class="nav-text">Download File</span>
                                                        </a>
                                                    </li>
                                                    @endif
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
    @php $x = 1; @endphp
    @foreach(\App\Models\Enquiry::all() as $item)
    <div class="modal fade" id="assignEnquiryModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assign case handler to enquiry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form method="POST" action="{{ route('enquiries.assign', ['id' => $item->id]) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <label>Select case handler</label><br>
                                <select class="form-control" id="case_handler{{ $x }}" name="case_handler" style="width: 100%;">
                                    @foreach(User::where('status', 1)->where('account_type', 'CH')->get() as $handler)
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
    @php $x++; @endphp
    @endforeach
@endsection

@section('custom.javascript')
    <script src="{{ pc_asset(BE_JS.'jquery.min.js') }}"></script>
    <script src="{{ pc_asset(BE_JS.'pages/crud/forms/widgets/select2.js') }}"></script>
@endsection
