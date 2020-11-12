@extends('layouts.backend.admin')

@section('content')
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Users</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Users</a>
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
                        <h3 class="card-label">Users</h3>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th class="text-center">Account Type</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\User::where('id', '!=', \Auth::user()->id)->get() as $item)
                            <tr>
                                <td>{{ $item->getFullName() }}</td>
                                <td>{{ $item->email }}</td>
                                <td class="text-center">
                                    <span
                                        class="label label-lg font-weight-bold label-light-{{ $item->getAccountTypeHtml() }} label-inline">
                                        {{ $item->getAccountType() }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    {!! $item->getStatusHtml() !!}
                                </td>
                                <td class="text-center">
                                    @if($item->status == 'active')
                                    <a href="{{ route('dashboard.update_users_status', ['id' => $item->id]) }}"
                                        class="btn btn-sm btn-light-danger mr-3" title="Deactivate User">
                                        <i class="flaticon-user-settings"></i> Deactivate
                                    </a>
                                    @else
                                    <a href="{{ route('dashboard.update_users_status', ['id' => $item->id]) }}"
                                        class="btn btn-sm btn-light-success mr-3" title="Activate User">
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
@endsection

@section('custom.javascript')
<script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/select2/js/select2.js') }}"></script>
<script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/datatables/datatables.bundle.js') }}" defer></script>
<script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'case-modal.js') }}"></script>
@endsection
