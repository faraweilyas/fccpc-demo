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
                         <div class="py-3 px-3">
                            @if(!empty($document))
                            <img class="mw-10" src="{{ $document->getIconText() }}" alt="pdf" />
                            <h4 class="py-5 cr-pointer" onclick="window.location.href = '{{ route('applicant.document.download', ['document' => $document->id]) }}';"> {{ $checklistGroup->name }}</h4>
                            @else
                                <img src="{{ pc_asset(BE_IMAGE.'pdf.png') }}" alt="pdf" />
                                <h4 class="py-5 text-danger"> {{ $checklistGroup->name }}</h4>
                            @endif
                         </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="info-title">
                                Additional Information:
                            </h4>
                            <h4>{{ $document->additional_info ?? '...' }}</h4>
                        </div>      
                    </div>
                  
                    @endforeach
                    <form class="form" id="kt_form">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />
                        <input type="hidden" id="tracking_id" name="tracking_id" value="{{ $guest->tracking_id }}">
                        <div class="grid-col-2-btn">
                            <button type="button" id="goback-btn" class="btn btn-primary font-weight-bold text-uppercase px-9 py-6" onclick="window.location.href = '{{ url('/application')}}/{{$guest->tracking_id }}/{{ $guest->case->case_category }}'">Go back to edit</button>
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
