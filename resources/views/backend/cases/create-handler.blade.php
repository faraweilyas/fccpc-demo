@extends('layouts.backend.admin')

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <h5 class="text-dark font-weight-bold my-2 mr-5">New Case Handler</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">New Case Handler</a>
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Create New Case Handler</h3>
                            </div>
                            <form method="POST" action="{{ route('handlers.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label> <span class="text-danger">*</span>
                                                <input type="text" class="form-control" placeholder="Enter first name"
                                                    name="firstName">
                                                <span class="form-text text-muted">Please enter first name.</span>
                                                @error('firstName')
                                                <p class="text-danger text-left mt-2">* {{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label> <span class="text-danger">*</span>
                                                <input type="text" class="form-control" placeholder="Enter last name"
                                                    name="lastName">
                                                <span class="form-text text-muted">Please enter last name.</span>
                                                @error('lastName')
                                                <p class="text-danger text-left mt-2">* {{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Email</label> <span class="text-danger">*</span>
                                                <input type="email" class="form-control" placeholder="Enter email"
                                                    name="email">
                                                <span class="form-text text-muted">Please enter email.</span>
                                                @error('email')
                                                <p class="text-danger text-left mt-2">* {{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7 text-right">
                                            <button type="submit" class="btn btn-primary mr-2"><i
                                                    class="la la-cloud-upload"></i> Create Handler</button>
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
