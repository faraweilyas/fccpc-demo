@extends('layouts.backend.admin')

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Profile</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Profile</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 my-5">
                    <div class="card card__box__large">
                        <div class="card__box__large-content">
                            @if (auth()->user()->account_type == 'SP' && $user->account_type == 'CH')
                                <div class='row'>
                                    <div class='col-md-12'>
                                        <div class="card card-stretch gutter-b" style="border: none !important;">
                                            <div class="card-body d-flex flex-column" style="position: relative;">
                                                <div class="mt-10 mb-5">
                                                    <div class="row row-paddingless mb-10">
                                                        <div class="col">
                                                            <div class="d-flex align-items-center mr-2">
                                                                <div class="symbol symbol-45 symbol-light-info mr-4 flex-shrink-0">
                                                                    <div class="symbol-label">
                                                                        <span class="svg-icon svg-icon-lg svg-icon-info">
                                                                            <x-icons.square></x-icons.square>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div class="font-size-h4 text-dark-75 font-weight-bolder">{{ $user->active_cases_assigned(TRUE)->count() }}</div>
                                                                    <div class="font-size-sm text-muted font-weight-bold mt-1">Assigned Cases</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="d-flex align-items-center mr-2">
                                                                <div class="symbol symbol-45 symbol-light-danger mr-4 flex-shrink-0">
                                                                    <div class="symbol-label">
                                                                        <span class="svg-icon svg-icon-lg svg-icon-danger">
                                                                            <x-icons.square></x-icons.square>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div class="font-size-h4 text-dark-75 font-weight-bolder">
                                                                        {{ $user->deficient_cases(TRUE)->count() }}
                                                                    </div>
                                                                    <div class="font-size-sm text-muted font-weight-bold mt-1">
                                                                        Cases On Hold
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="d-flex align-items-center mr-2">
                                                                <div class="symbol symbol-45 symbol-light-success mr-4 flex-shrink-0">
                                                                    <div class="symbol-label">
                                                                        <span class="svg-icon svg-icon-lg svg-icon-success">
                                                                            <x-icons.square></x-icons.square>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div class="font-size-h4 text-dark-75 font-weight-bolder">
                                                                        {{ $user->cases_working_on(TRUE)->count() }}
                                                                    </div>
                                                                    <div class="font-size-sm text-muted font-weight-bold mt-1">
                                                                        Ongoing Cases
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="d-flex align-items-center mr-2">
                                                                <div class="symbol symbol-45 symbol-light-primary mr-4 flex-shrink-0">
                                                                    <div class="symbol-label">
                                                                        <span class="svg-icon svg-icon-lg svg-icon-primary">
                                                                            <x-icons.square></x-icons.square>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div class="font-size-h4 text-dark-75 font-weight-bolder">
                                                                        {{ $user->approved_cases(TRUE)->count() }}
                                                                    </div>
                                                                    <div class="font-size-sm text-muted font-weight-bold mt-1">
                                                                        Approved Cases
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="d-flex align-items-center mr-2">
                                                                <div class="symbol symbol-45 symbol-light-primary mr-4 flex-shrink-0">
                                                                    <div class="symbol-label">
                                                                        <span class="svg-icon svg-icon-lg svg-icon-primary">
                                                                            <x-icons.square></x-icons.square>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div class="font-size-h4 text-dark-75 font-weight-bolder">
                                                                        {{ $user->archived_cases(TRUE)->count() }}
                                                                    </div>
                                                                    <div class="font-size-sm text-muted font-weight-bold mt-1">Archived Cases</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="resize-triggers">
                                                    <div class="expand-trigger">
                                                        <div style="width: 414px; height: 429px;"></div>
                                                    </div>
                                                    <div class="contract-trigger"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="profile-image">{{ $user->getInitials() }}</div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="content-box">
                                                <span>Account Type:</span>
                                                <p>{{ $user->getAccountType() }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="content-box">
                                                <span>Email Address:</span>
                                                <p>{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="content-box">
                                                <span>First Name:</span>
                                                <p>{{ $user->first_name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="content-box">
                                                <span>Last Name:</span>
                                                <p>{{ $user->last_name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="content-box">
                                                <span>Phone Number:</span>
                                                <p>{{ $user->phone_number ?? '...' }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="content-box">
                                                <span>Status:</span>
                                                <p class="mt-2">{!! $user->getStatusHtml() !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content-box">
                                        <span>Address</span>
                                        <p>{{ $user->address ?? '...' }}</p>
                                    </div>
                                    @if (auth()->user()->isUserSame($user))
                                        <div class="row" style="justify-content: flex-end;">
                                            <div class="col-md-3">
                                                <button
                                                    class="btn btn-primary my-5"
                                                    onclick="window.location.href = '{{ route('dashboard.update_profile') }}';"
                                                >
                                                    Update Profile
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
