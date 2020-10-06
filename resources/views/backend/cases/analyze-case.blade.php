@extends('layouts.backend.admin')

@section('content')
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Case Analysis</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Analyze Cases</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Analyze Case</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>




<div class="conatiner px-5 py-5 relative">

    <button class="btn btn-success-transparent">Request Extension</button>


    <div class="row px-3">
        <div class="tab-custom">
            <div class="tab-link active">
                <img src="{{ pc_asset(BE_IMAGE.'svg/position.svg') }}" alt="position">
                <a class="nav-link active" href="#">Documentation
                    <span>Duration: 10 days</span>
                </a>
            </div>
            <div class="tab-link">
                <img src="{{ pc_asset(BE_IMAGE.'svg/Position-sqaure.svg') }}" alt="Position-sqaure">
                <a class="nav-link active" href="#">Documentation
                    <span>Duration: 10 days</span>
                </a>
            </div>
            <div class="tab-link">
                <img src="{{ pc_asset(BE_IMAGE.'svg/Position-sqaure.svg') }}" alt="Position-sqaure">
                <a class="nav-link active" href="#">Documentation
                    <span>Duration: 10 days</span>
                </a>
            </div>
            <div class="tab-link">
                <img src="{{ pc_asset(BE_IMAGE.'svg/Position-sqaure.svg') }}" alt="Position-sqaure">
                <a class="nav-link active" href="#">Documentation
                    <span>Duration: 10 days</span>
                </a>
            </div>
        </div>

        <span class="duration pull-right">Total Duration: 60 days</span>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card-custom">
                <h5>Case Information</h5>

                <div class="row py-5">
                    <div class="col-md-3">
                        <p>REF NO:</p>
                        <span>FCCPC/BC/M&A/00/20/VOLNo
                        </span>
                    </div>
                    <div class="col-md-3">
                        <p>CASE TYPE:</p>
                        <span>Application
                        </span>
                    </div>
                    <div class="col-md-3">
                        <p>CASE REP:</p>
                        <span>T & A Legal
                        </span>
                    </div>
                    <div class="col-md-3">
                        <p>STATUS:</p>
                        <span class="label-custom-warning">IN-PROGRESS
                        </span>
                    </div>
                </div>

                <div class="row py-5">
                    <div class="col-md-3">
                        <p>MATTER NAME:</p>
                        <span>Access Bank Merger
                        </span>
                    </div>
                    <div class="col-md-3">
                        <p>PARTIES:</p>
                        <span>Access Bank, Diamond Bank,
                            Central Bank of Nigeria
                        </span>
                    </div>
                    <div class="col-md-3">
                        <p>CATEGORY:</p>
                        <span>FFM Expediated
                        </span>
                    </div>
                    <div class="col-md-3">
                        <p>PAID/NOT PAID::</p>
                        <span class="label-custom-danger">NOT PAID
                        </span>
                    </div>
                </div>

                <div class="row py-5">
                    <div class="col-md-3">
                        <p>CONTACT REP INFO:</p>
                        <span>Olusegun Aribido
                            segunaribido@gmail.com,
                            09048374824
                        </span>
                    </div>
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-success-sm my-5">View Document Checklist</button>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <!--  -->
    <div class="row">
        <div class="col-md-12">
            <div class="card-custom">
                <h5>Analysis Document & Recommendation</h5>

                <div class="row py-5">
                    <div class="col-md-6 my-5">

                        <div id="drop-area"><input type="file" id="fileElem"><label class="drop-label"
                                for="fileElem"><img src="{{ pc_asset(BE_IMAGE.'svg/file.svg') }}" alt="file">
                                <br>
                                <br>Drop
                                file here or click
                                to upload.</label></div>
                    </div>
                    <div class="col-md-6 my-5">
                        <textarea class="form-control form-control-teaxtarea" name="" id="" cols="30" rows="10">
													State your recommendation
												</textarea>

                        <br>

                        <button class="btn btn-success-sm my-5 pull-right">Issue Recommendation</button>

                    </div>

                </div>



            </div>
        </div>
    </div>
    <!--  -->

    <!--  -->
    <div class="row">
        <div class="col-md-12">
            <div class="card-custom">
                <h5>Analysis Document & Recommendation</h5>

                <div class="row py-5">
                    <div class="col-md-6 my-5">

                        <div class="doc-card">
                            <div class="row">
                                <div class="col-md-2"><img src="{{ pc_asset(BE_IMAGE.'png/pdf.png') }}" alt="pdf"></div>
                                <div class="col-md-4">
                                    <div class="doc-name">Analysis document</div>
                                </div>
                                <div class="col-md-6 align-center"><button class="btn btn-success-sm"
                                        type="submit">Download</button>
                                    <div class="view-doc-link"><a href="#">View</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 my-5">
                        <span class="text-muted">REASON/RECOMMENDATION:</span>

                        <br>
                        <br>
                        <br>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley of type and scrambled it to make a type specimen book.
                            <br>
                            <br>
                            <br>
                            It has survived not only five centuries.</p>


                    </div>

                </div>



            </div>
        </div>
    </div>
    <!--  -->
</div>

@endsection



@section('custom.css')
<link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'reports.css') }}" />
@endsection
