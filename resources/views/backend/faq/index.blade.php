@extends('layouts.backend.base')
@section('content')
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Create Faq</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Faq</a>
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
                            <h3 class="card-title">Create FAQ</h3>
                        </div>
                        <form method="POST" action="{{ route('dashboard.update_user') }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Question</label> <span class="text-danger">*</span>
                                            <input type="text" class="form-control" placeholder="Enter question" name="question" >
                                            <span class="form-text text-muted">Please enter question.</span>
                                            @error('question')
                                                <p class="text-danger text-left mt-2">* {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Answer</label> <span class="text-danger">*</span>
                                            <textarea type="text" class="form-control" cols="4" rows="4" name="answer"></textarea>
                                            <span class="form-text text-muted">Please enter answer.</span>
                                            @error('message')
                                                <p class="text-danger text-left mt-2">* {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label>Question Category</label> <span class="text-danger">*</span>
                                        <select class="form-control selectpicker">
                                            @foreach(\App\Enhancers\AppHelper::$faq_categories as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-8">
                                    <div class="col-md-8 text-right">
                                        <button type="submit" class="btn btn-primary mr-2"><i class="la la-cloud-upload"></i> Submit</button>
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
@endSection
