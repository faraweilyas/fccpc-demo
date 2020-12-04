@extends('layouts.backend.old.guest')

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Select Enquiry Type</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('enquiries.index') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">Enquiry</a>
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
                    <div class="col-md-4 pb-10">
                        <a href="{{ route('enquiries.create', ['type' => 'gen']) }}">
                            <div class="card card-custom gutter-b card__with__bg " style="height: 300px">
                                <div class="card-body">
                                    <span class="svg-icon svg-icon-2x">
                                        <x-icons.file-tag></x-icons.file-tag>
                                    </span>
                                    <span class="svg-icon svg-icon-2x float-right">
                                        <x-icons.arrow-right></x-icons.arrow-right>
                                    </span>
                                    <div class="font-weight-bolder font-size-h2 mt-3 text-dark">General Enquiry</div>
                                    <span class="font-weight-bold font-size-lg mt-1">
                                        <br />
                                        <small class="text-black">Submit all enquiries about merger transactions here</small>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 pb-10">
                        <a href="{{ route('enquiries.create', ['type' => 'prn']) }}">
                            <div class="card card-custom gutter-b card__with__bg " style="height: 300px">
                                <div class="card-body">
                                    <span class="svg-icon svg-icon-2x">
                                        <x-icons.arrow-meet></x-icons.arrow-meet>
                                    </span>
                                    <span class="svg-icon svg-icon-2x float-right">
                                        <x-icons.arrow-right></x-icons.arrow-right>
                                    </span>
                                    <div class="font-weight-bolder font-size-h2 mt-3 text-dark">PRE NOTIFICATION Enquiry</div>
                                    <span class="font-weight-bold font-size-lg mt-1">
                                        <br />
                                        <small class="text-black">Click here to make  pre-notification enquiries</small>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 pb-10">
                        <a href="{{ route('enquiries.create', ['type' => 'cop']) }}">
                            <div class="card card-custom gutter-b card__with__bg " style="height: 300px">
                                <div class="card-body">
                                    <span class="svg-icon svg-icon-2x">
                                        <x-icons.arrow-crop></x-icons.arrow-crop>
                                    </span>
                                    <span class="svg-icon svg-icon-2x float-right">
                                        <x-icons.arrow-right></x-icons.arrow-right>
                                    </span>
                                    <div class="font-weight-bolder font-size-h2 mt-3 text-dark">Complaint</div>
                                    <span class="font-weight-bold font-size-lg mt-1">
                                        <br />
                                        <small class="text-black">Click here to submit a complaint relating to a merger transaction</small>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
