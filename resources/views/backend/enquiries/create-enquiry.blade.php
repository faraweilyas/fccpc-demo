@extends('layouts.backend.old.guest')

@section('content')
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5 sm-d-flex">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Create {{ $enquiry }}</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('enquiries.index') }}" class="text-muted">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">{{ $enquiry }}</a>
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
                            <h3 class="card-title">{{ $enquiry }}</h3>
                        </div>
                        <form method="POST" action="{{ route('enquiries.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="type" value="{{ $type }}" />
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Subject:</label><span class="text-danger">*</span>
                                            <input type="text" name="subject" value="{{ old('subject') }}"
                                                class="form-control" placeholder="Enter subject:" />
                                            <span class="form-text text-muted">Please enter subject.</span>
                                            @error('subject')
                                                <p class="text-danger text-left mt-2">* {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Representing Firm:</label><span class="text-danger">*</span>
                                            <input type="text" name="firm" value="{{ old('firm') }}"
                                                class="form-control" placeholder="Enter representing firm:" />
                                            <span class="form-text text-muted">Please enter representing firm.</span>
                                            @error('firm')
                                                <p class="text-danger text-left mt-2">* {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name:</label> <span class="text-danger">*</span>
                                            <input type="text" name="first_name" value="{{ old('first_name') }}"
                                                class="form-control" placeholder="Enter first name:" />
                                            <span class="form-text text-muted">Please enter first name.</span>
                                            @error('first_name')
                                                <p class="text-danger text-left mt-2">* {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name:</label> <span class="text-danger">*</span>
                                            <input type="text" name="last_name" value="{{ old('last_name') }}"
                                                class="form-control" placeholder="Enter last name:" />
                                            <span class="form-text text-muted">Please enter last name.</span>
                                            @error('last_name')
                                            <p class="text-danger text-left mt-2">* {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email:</label> <span class="text-danger">*</span>
                                            <input type="text" name="email" value="{{ old('email') }}"
                                                class="form-control" placeholder="Enter email:" />
                                            <span class="form-text text-muted">Please enter email.</span>
                                            @error('email')
                                                <p class="text-danger text-left mt-2">* {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number:</label> <span class="text-danger">*</span>
                                            <input type="text" name="phone_number" value="{{ old('phone_number') }}"
                                                class="form-control" placeholder="Enter phone number:" />
                                            <span class="form-text text-muted">Please enter phone number.</span>
                                            @error('phone_number')
                                                <p class="text-danger text-left mt-2">* {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Message:</label> <span class="text-danger">*</span>
                                            <textarea type="text" name="message" class="form-control" cols="4"
                                                rows="4">{{ old('message') }}</textarea>
                                            <span class="form-text text-muted">Please enter message.</span>
                                            @error('message')
                                                <p class="text-danger text-left mt-2">* {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <div class="uploadButton tw-mb-4">
                                            <input type="file" name="file" id="enquiry_doc"
                                                class="js-file-upload-input ember-view" />
                                            <span class="btn btn--small btn--brand img-info">Attach Document</span>
                                        </div>
                                        <p class="document-uploaded enquiry_doc_name"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7 text-right">
                                        <button type="submit" class="btn btn-primary mr-2"><i
                                                class="la la-cloud-upload"></i> Submit</button>
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
