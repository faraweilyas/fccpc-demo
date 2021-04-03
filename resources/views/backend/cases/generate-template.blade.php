@extends('layouts.backend.admin')

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Generate Approval Letter</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">Generate Approval Letter</a>
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
                                <h3>Generate Approval Letter</h3>
                            </div>
                            <form method="POST" action="{{ route('cases.generate_template', ['case' => $case]) }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group">
                                            <label><b>Select Template</b></label>
                                            <div class="radio-inline">
                                                <label class="radio">
                                                    <input
                                                        type="radio"
                                                        name="template"
                                                        checked
                                                        value="temp_1"
                                                    />
                                                    Template 1<span></span>
                                                </label>
                                                <label class="radio">
                                                    <input
                                                        type="radio"
                                                        name="template"
                                                        value="temp_2"
                                                    />
                                                    Template 2<span></span>
                                                </label>
                                                <label class="radio">
                                                    <input
                                                        type="radio"
                                                        name="template"
                                                        value="temp_3"
                                                    />
                                                    Template 3<span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7 text-right">
                                            <button type="submit" class="btn btn-primary mr-2"><i
                                                    class="la la-cog"></i> Generate</button>
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
