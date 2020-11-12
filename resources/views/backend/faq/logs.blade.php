@extends('layouts.backend.admin')

@section('content')
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">FAQs</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">FAQs</a>
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
                        <h3 class="card-label">FAQs</h3>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-separate table-head-custom table-checkable" id="enquiries_log_datatable">
                        <thead>
                            <tr>
                                <th>Creator</th>
                                <th>Category</th>
                                <th>Question</th>
                                <th>Created</th>
                                <th class="text-center">Action(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Faq::all() as $item)
                            <tr>
                                <td>{{ $item->getCreator() }}</td>
                                <td>{!! $item->getCategoryHtml() !!}</td>
                                <td>{{ $item->getQuestion() }}</td>
                                <td>{{ datetimeToText($item->created_at, 'customd') }}</td>
                                <td nowrap="nowrap" class="text-center">
                                    <span href="#" class="btn btn-sm btn-light-warning" title="View Faq Info"
                                        data-toggle="modal" data-target="#viewFaqModal">
                                        <i class="flaticon-eye"></i>
                                    </span>
                                    <span href="#" class="btn btn-sm btn-light-primary crus" title="Edit Faq"
                                        {{-- onclick="window.location.href = '{{ route('faq.edit', ['faq' => $item->id]) }}';"
                                        --}}>
                                        <i class="flaticon-edit"></i>
                                    </span>
                                    <span href="#" class="btn btn-sm btn-light-danger delete_faq" title="Delete Faq"
                                        data-route="{{ route('faq.delete', ['faq' => $item->id]) }}">
                                        <i class="flaticon-delete"></i>
                                    </span>
                                    <div class="hide">
                                        {{-- Logs --}}
                                        <span class="creator">{{ $item->getCreator() }}</span>
                                        <span class="category">{!! $item->getCategoryHtml() !!}</span>
                                        <span class="question">{{ $item->question }}</span>
                                        <span class="answer">{!! nl2br($item->answer) !!}</span>
                                        <span class="created">{{ datetimeToText($item->created_at, 'customd') }}</span>
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

@include("layouts.modals.faq")
@endsection

@section('custom.css')
<link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_PLUGIN.'custom/datatables/datatables.bundle.css') }}" />
@endsection

@section('custom.javascript')
<script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/select2/js/select2.js') }}"></script>
<script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/datatables/datatables.bundle.js') }}" defer></script>
<script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'case-modal.js') }}"></script>
@endsection
