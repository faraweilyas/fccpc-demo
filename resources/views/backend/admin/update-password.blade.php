@extends('layouts.backend.admin')

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Update Password</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">Update Password</a>
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
                    <div class="col-md-8 mx-auto">
                        <div class="card card-custom gutter-b example example-compact">
                            <div class="card-header">
                                <h3 class="card-title">Update Password</h3>
                            </div>
                            <form method="POST" action="{{ route('dashboard.update_password') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>New Password</label> <span class="text-danger">*</span>
                                                <input
                                                    type="password"
                                                    class="form-control"
                                                    placeholder="Enter password"
                                                    name="password"
                                                />
                                                @error('password')
                                                    <p class="text-danger text-left mt-2">* {{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Confirm Password</label> <span class="text-danger">*</span>
                                                <input
                                                    type="password"
                                                    class="form-control"
                                                    placeholder="Retype password"
                                                    name="password_confirmation"
                                                />
                                                @error('password_confirmation')
                                                    <p class="text-danger text-left mt-2">* {{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary mr-2">
                                                <i class="la la-cloud-upload"></i> Update Password
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
