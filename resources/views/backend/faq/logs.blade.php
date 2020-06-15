@extends('layouts.backend.base')
@section('content')
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Faq Log</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Faq Log</a>
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
                                <th>Creator</th>
                                <th>Question</th>
                                <th class="text-center">Answer</th>
                                <th class="text-center">Category</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Faq::all() as $item)
                            <tr>
                                <td><b>{{ $item->getCreatorFullName() }}</b></td>
                                <td>{{ $item->question }}</td>
                                <td class="text-center" data-toggle="tooltip" title="{{ $item->answer }}">
                                    {{ $item->getAnswer() }}
                                </td>
                                <td class="text-center">
                                    {{ $item->getCategory() }}
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
                                                    <a class="nav-link text-hover-primary" href="{{ route('faq.destroy', ['id' => $item->id]) }}">
                                                        <i class="nav-icon la la-edit"></i>
                                                        <span class="nav-text">Edit</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('faq.destroy', ['id' => $item->id]) }}" class="nav-link text-hover-danger" title="Remove Faq">
                                                        <i class="la la-times-circle"></i>&nbsp;&nbsp;Remove
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
@endsection
