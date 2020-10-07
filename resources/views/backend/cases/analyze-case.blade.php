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
                        <p><b>REF NO:</b></p>
                        <span>
                            {!! $case->getRefNO() !!}
                        </span>
                    </div>
                    <div class="col-md-3">
                        <p><b>TRANSACTION TYPE:</b></p>
                        <span>
                            {!! $case->getTypeHtml() !!}
                        </span>
                    </div>
                    <div class="col-md-3">
                        <p><b>TRANSACTION REP:</b></p>
                        <span>
                            {!! $case->applicant_firm !!}
                        </span>
                    </div>
                   {{--  <div class="col-md-3">
                        <p>STATUS:</p>
                        <span class="label-custom-warning">IN-PROGRESS
                        </span>
                    </div> --}}
                    <div class="col-md-3">
                        <p><b>Address:</b></p>
                        <span>
                            {!! $case->applicant_address !!}
                        </span>
                    </div>
                </div>

                <div class="row py-5">
                    <div class="col-md-3">
                        <p><b>MATTER NAME:</b></p>
                        <span>
                            {{ $case->getSubject() }}
                        </span>
                    </div>
                    <div class="col-md-3">
                        <p><b>PARTIES:</b></p>
                        <span>
                            {!! $case->generateCasePartiesBadge('mr_10 mb-2') !!}
                        </span>
                    </div>
                    <div class="col-md-3">
                        <p><b>CATEGORY:</b></p>
                        <span>
                            {!! $case->getCategoryHtml() !!}
                        </span>
                    </div>
                   {{--  <div class="col-md-3">
                        <p>PAID/NOT PAID::</p>
                        <span class="label-custom-danger">NOT PAID
                        </span>
                    </div> --}}
                </div>

                <div class="row py-5">
                    <div class="col-md-3">
                        <p>CONTACT REP INFO:</p>
                        <span>{!! $case->getApplicantName() !!}<br/>
                            {!! $case->applicant_email !!}<br/>
                            {!! $case->applicant_phone_number !!}
                        </span>
                    </div>
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-success-sm my-5" onclick="window.location.href = '{{ route('cases.analyze-documents', ['case' => $case->id]) }}';">View Document Checklist</button>
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

                        <div id="drop-area">
                            <input type="file" id="fileElem">
                            <label class="drop-label" for="fileElem">
                                <img src="{{ pc_asset(BE_IMAGE.'svg/file.svg') }}" alt="file">
                                <br>
                                <br>Drop
                                file here or click
                                to upload.</label>
                        </div>
                    </div>
                    <div class="col-md-6 my-5">
                        <textarea class="form-control form-control-teaxtarea" name="" id="" cols="30" rows="10">State your recommendation</textarea>

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
