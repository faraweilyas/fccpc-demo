@extends('layouts.backend.old.guest')


@section('content')

<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Application</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ $guest->applicationPath() }}" class="text-muted">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('application.show', ['guest' => $guest->tracking_id, 'case_category' => $guest->case->case_category]) }}" class="text-muted">Create Application</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#" class="text-muted">Review Application</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>




<div id="kt_wizard_v2" class="container py-5">
    <div class="row">
        <div class="col-md-12 ">
            <div class="card__box card__box__large  rmv-height add-mgbottom " id="applications">
                <div class="card__box__large-content">
                    <h3 class="checklist-header">
                        Summary of Application
                    </h3>

                    <p class="review-description">
                        Review your entries for any kind of error. Kindly
                        note that you cannot edit information once it has
                        been submitted.
                    </p>

                    <p class="section-header">
                        Application Case Information
                    </p>

                    <div class="grid-col-2">
                        <div class="grid-row-2">
                            <h4 class="info-title">Subject</h4>
                            <h4>{{ $case->subject }}</h4>
                        </div>
                        <div class="grid-row-2">
                            {{-- <h4 class="info-title">Filling Fees</h4>
                            <h4>Paid</h4> --}}
                        </div>
                        <div class="grid-row-2">
                            <h4 class="info-title">Parties:</h4>
                            <h4>{!! $case->generateCasePartiesBadge('mr_10 mb-2') !!}</h4>
                        </div>
                        <div class="grid-row-2">
                            {{-- <h4 class="info-title">Processing Fees:</h4>
                            <h4>Not Paid</h4> --}}
                        </div>
                        <div class="grid-row-2">
                            <h4 class="info-title">
                                Transaction Type:
                            </h4>
                            <h4>{{ $case->getType() }}</h4>
                        </div>
                    </div>

                    <p class="section-header">
                        Contact Information
                    </p>
                    <div class="grid-col-2">
                        <div class="grid-row-2">
                            <h4 class="info-title">
                                Applicant/Representing Firm
                            </h4>
                            <h4>{{ $case->applicant_firm }}</h4>
                        </div>
                        <div class="grid-row-2">
                            <h4 class="info-title">Contact Person</h4>
                            <h4>{{ $case->getApplicantName() }}</h4>
                        </div>
                        <div class="grid-row-2">
                            <h4 class="info-title">Email address:</h4>
                            <h4>{{ $case->applicant_email }}</h4>
                        </div>
                        <div class="grid-row-2">
                            <h4 class="info-title">Phone number:</h4>
                            <h4>{{ $case->applicant_phone_number }}</h4>
                        </div>
                        <div class="grid-row-2">
                            <h4 class="info-title">Address:</h4>
                            <h4>{{ $case->applicant_address }}</h4>
                        </div>
                    </div>

                    <p class="section-header">Relevant Documents</p>
                    {{-- @foreach($documents as $document) --}}
                    @foreach(\App\Models\ChecklistGroup::with('checklists')->get() as $checklistGroup)
                    @php
                        $document = $checklistGroupDocuments[$checklistGroup->id] ?? '';
                    @endphp
                    <div class="row">
                        <div class="col-md-6 my-5" key={item[0]}>
                         <div class="d-flex py-3 px-3">
                            @if(!empty($document))
                            <img class="mw-10 cr-pointer" src="{{ $document->getIconText() }}" alt="pdf" height="50px" onclick="window.location.href = '{{ route('applicant.document.download', ['document' => $document->id]) }}';"/>
                            <h4 class="py-5 mx-5 w-75 text-hover-primary cr-pointer" onclick="window.location.href = '{{ route('applicant.document.download', ['document' => $document->id]) }}';"> {{ $checklistGroup->name }}</h4>
                            @else
                                <span class="svg-icon svg-icon-danger svg-icon-4x ml-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M4.5,3 L19.5,3 C20.3284271,3 21,3.67157288 21,4.5 L21,19.5 C21,20.3284271 20.3284271,21 19.5,21 L4.5,21 C3.67157288,21 3,20.3284271 3,19.5 L3,4.5 C3,3.67157288 3.67157288,3 4.5,3 Z M8,5 C7.44771525,5 7,5.44771525 7,6 C7,6.55228475 7.44771525,7 8,7 L16,7 C16.5522847,7 17,6.55228475 17,6 C17,5.44771525 16.5522847,5 16,5 L8,5 Z M10.5857864,14 L9.17157288,15.4142136 C8.78104858,15.8047379 8.78104858,16.4379028 9.17157288,16.8284271 C9.56209717,17.2189514 10.1952621,17.2189514 10.5857864,16.8284271 L12,15.4142136 L13.4142136,16.8284271 C13.8047379,17.2189514 14.4379028,17.2189514 14.8284271,16.8284271 C15.2189514,16.4379028 15.2189514,15.8047379 14.8284271,15.4142136 L13.4142136,14 L14.8284271,12.5857864 C15.2189514,12.1952621 15.2189514,11.5620972 14.8284271,11.1715729 C14.4379028,10.7810486 13.8047379,10.7810486 13.4142136,11.1715729 L12,12.5857864 L10.5857864,11.1715729 C10.1952621,10.7810486 9.56209717,10.7810486 9.17157288,11.1715729 C8.78104858,11.5620972 8.78104858,12.1952621 9.17157288,12.5857864 L10.5857864,14 Z" fill="#000000"/>
                                        </g>
                                    </svg>
                                </span>
                                <h4 class="py-5 mx-5 text-danger w-75" title="No document submitted"> {{ $checklistGroup->name }}</h4>
                            @endif
                         </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="info-title info-title-margin">
                                Additional Information:
                            </h4>
                            <h4 class="info-title-description">@if(!empty($document->additional_info)) {{ $document->additional_info }} @else ... @endif</h4>
                        </div>  
                         
                    </div>
                  
                    @endforeach
                    <form class="form" id="kt_form">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />
                        <input type="hidden" id="tracking_id" name="tracking_id" value="{{ $guest->tracking_id }}">
                      
                        <div class="grid-col-2-btn my-20">
                            <button type="button" id="goback-btn" class="btn btn-primary font-weight-bold text-uppercase px-9 py-6" onclick="window.location.href = '{{ route('application.show', ['guest' => $guest->tracking_id, 'case_category' => $guest->case->case_category, 'step' => $step]) }}'">Go back to edit</button>
                            <button id="upload-info" class="btn btn-primary font-weight-bold text-uppercase px-9 py-6" data-wizard-type="action-submit">Submit</button>
                            <button id="upload-img" class="btn btn-success hide" disabled>
                                <i class="fas fa-spinner fa-pulse"></i>&nbsp;Uploading...
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom.javascript')
    <script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'create-application.js') }}"></script>
@endsection
