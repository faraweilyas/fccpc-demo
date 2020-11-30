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
                            <a href="" class="text-muted">Profile</a>
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
                                    <div class="content-box ">
                                        <span>Address</span>
                                        <p>{{ $user->address ?? '...' }}</p>
                                    </div>
                                    @if (auth()->user()->isUserSame($user))
                                    <div class="row" style="justify-content: flex-end;">
                                        <div class="col-md-3">
                                            <button class="btn btn-primary my-5"
                                                onclick="window.location.href = '{{ route('dashboard.profile') }}';">Update Profile</button>
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
