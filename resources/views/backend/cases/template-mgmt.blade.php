@extends('layouts.backend.admin')

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Approval Letter Management</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a
                                href="{{ route('cases.generate_template', ['case' => $case]) }}"
                                class="text-muted"
                            >
                                Generate Template
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">Approval Letter Management</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="row">
                    @if ($template_id == 1)
                        <x-approval-templates.approval :case="$case" template="1" />
                    @endif
                    @if ($template_id == 2)
                        <x-approval-templates.conditional-approval :case="$case" template="2" />
                    @endif
                    @if ($template_id == 3)
                        <x-approval-templates.notification-of-substantial-competition-concerns :case="$case" template="3" />
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom.javascript')
<script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'template-mgmt.js') }}"></script>>
@endsection
