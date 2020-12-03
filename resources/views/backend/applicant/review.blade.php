@extends('layouts.backend.old.guest')


@section('content')
<div class="subheader py-2 py-lg-4 subheader-transparent mt-xs-20 mt-sm-18 mt-md-20 mt-lg-0" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5 sm-d-flex">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Application</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ $guest->applicationPath() }}" class="text-muted">Select transaction category</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('application.show', ['guest' => $guest->tracking_id, 'case_category' => $guest->case->case_category]) }}"
                            class="text-muted">Create Application</a>
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
                    <div class="row">
                        <div class="col-md-12 text-right pull__right__position">
                            <button class="btn btn-light-primary font-weight-bold ">
                                <span class="svg-icon svg-icon-primary svg-icon-2x cr-pointer" onclick="window.print()"
                                    title="Print Transaction Summary">
                                    <x-icons.print></x-icons.print>

                                    Print
                                </span>
                            </button>
                        </div>
                    </div>
                    <h3 class="checklist-header">APPLICATION SUMMARY</h3>

                    <p class="review-description">
                        Review your entries for any kind of error. Kindly note that you cannot edit information once it
                        has been submitted.
                    </p>

                    <p class="section-header">APPLICATION TRANSACTION INFORMATION</p>

                    <div class="grid-col-2">
                        <div class="grid-row-2 d-flex">
                            <h4 class="info-title">Subject:</h4>
                            <h4>{{ $case->subject }}</h4>
                        </div>

                        <div class="grid-row-2 d-flex">
                            <h4 class="info-title">Parties:</h4>
                            <h4>{!! $case->generateCasePartiesBadge('mr_10 mb-2') !!}</h4>
                        </div>

                        <div class="grid-row-2 d-flex">
                            <h4 class="info-title">Transaction Type:</h4>
                            <h4>{{ $case->getType() }}</h4>
                        </div>

                        <div class="grid-row-2 d-flex">
                            <h4 class="info-title">Transaction Category:</h4>
                            <h4>{{ $case->getCategoryText() }}</h4>
                        </div>
                    </div>
                    <p class="section-header">CONTACT INFORMATION</p>
                    <div class="grid-col-2">
                        <div class="grid-row-2 d-flex">
                            <h4 class="info-title">Applicant/Representing Firm:</h4>
                            <h4>{{ $case->applicant_firm }}</h4>
                        </div>
                        <div class="grid-row-2 d-flex">
                            <h4 class="info-title">Contact Person:</h4>
                            <h4>{{ $case->getApplicantName() }}</h4>
                        </div>
                        <div class="grid-row-2 d-flex">
                            <h4 class="info-title">Email address:</h4>
                            <a href="mailto:{{ $case->applicant_email }}" class="text-black-custom">
                                <h4>{{ $case->applicant_email }}</h4>
                            </a>
                        </div>
                        <div class="grid-row-2 d-flex">
                            <h4 class="info-title">Phone number:</h4>
                            <a href="tel:{{ $case->applicant_phone_number }}" class="text-black-custom">
                                <h4>{{ $case->applicant_phone_number }}</h4>
                            </a>
                        </div>
                        <div class="grid-row-2 d-flex">
                            <h4 class="info-title">Address:</h4>
                            <h4>{{ $case->applicant_address }}</h4>
                        </div>
                        <div class="grid-row-2 d-flex">
                            <div class="d-flex mt-n7">
                                @if(!empty($case->letter_of_appointment))
                                <img class="mw-10 cr-pointer" src="{{ $case->getLetterOfAppointmentIconText() }}"
                                    alt="pdf" height="50px"
                                    onclick="window.location.href = '{{ route('applicant.download_contact_loa', ['document' => $case->letter_of_appointment]) }}';" />
                                <h4 class="py-5 mx-5 w-75 text-hover-primary cr-pointer"
                                    onclick="window.location.href = '{{ route('applicant.download_contact_loa', ['document' => $case->letter_of_appointment]) }}';">
                                    Letter Of Appointment</h4>
                                @else
                                <span class="svg-icon svg-icon-danger svg-icon-4x ml-n1" onClick="printPdf(2)">
                                    <x-icons.letter-file></x-icons.letter-file>
                                   
                                </span>
                                <h4 class="py-5 mx-5 text-danger w-75" title="No document submitted">Letter Of
                                    Appointment</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="section-header">FEES</p>
                            <div class="grid-col-2">
                                <div class="grid-row-2 d-flex">
                                    <h4 class="info-title">Amount Paid:</h4>
                                    <h4>{!! $case->getAmountPaid() !!}</h4>
                                </div>
                            </div>    
                        </div>
                        <div class="col-md-6">
                            <p class="section-header">APPLICATION FORMS</p>
                            <div class="row mt-n2">
                                @if(!empty($case->application_forms))
                                    @php
                                        $applicantion_forms_array = explode(',', $case->application_forms);
                                    @endphp
                                    @foreach($applicantion_forms_array as $key => $value)
                                    @php 
                                        $new_applicantion_forms_array = explode(':', $applicantion_forms_array[$key]);
                                    @endphp
                                    <div class="col-md-1 my-2">
                                        <span>
                                            <img onclick="window.location.href = '{{ route('applicant.download_form_doc', ['document' => $new_applicantion_forms_array[1]]) }}';"
                                                class="max-h-30px mr-3 doc-cursor-pointer w--200"
                                                src="{{ $case->getApplicationFormIconText($new_applicantion_forms_array[1]) }}"
                                                title="Download {{ $new_applicantion_forms_array[0] }} Document" />
                                        </span>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <p class="section-header mt-10">RELEVANT DOCUMENTS</p>
                    {{-- @foreach($documents as $document) --}}
                    @foreach(\App\Models\ChecklistGroup::with('checklists')->get() as $checklistGroup)
                    @php
                    $document = $checklistGroupDocuments[$checklistGroup->id] ?? '';
                    @endphp
                    <div class="row">
                        <div class="col-md-6 my-5" key={item[0]}>
                            <div class="d-flex py-3 px-3">
                                @if(!empty($document))
                                <img class="mw-10 cr-pointer" src="{{ $document->getIconText() }}" alt="pdf"
                                    height="50px"
                                    onclick="window.location.href = '{{ route('applicant.document.download', ['document' => $document->id]) }}';" />
                                <h4 class="py-5 mx-5 w-75 text-hover-primary cr-pointer"
                                    onclick="window.location.href = '{{ route('applicant.document.download', ['document' => $document->id]) }}';">
                                    {{ $checklistGroup->name }}</h4>
                                @else
                                <span class="svg-icon svg-icon-danger svg-icon-4x ml-n1" onClick="printPdf(2)">
                                    <x-icons.letter-file></x-icons.letter-file>
                                </span>
                                <h4 class="py-5 mx-5 text-danger w-75" title="No document submitted">
                                    {{ $checklistGroup->name }}</h4>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="info-title info-title-margin">
                                Additional Information:
                            </h4>
                            <h4 class="info-title-description">@if(!empty($document->additional_info)) {!!
                                nl2br($document->additional_info) !!} @else ... @endif</h4>
                        </div>

                    </div>

                    @endforeach
                    <form class="form" id="kt_form">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />
                        <input type="hidden" id="tracking_id" name="tracking_id" value="{{ $guest->tracking_id }}">

                        <div class="grid-col-2-btn my-20">
                            <button type="button" id="goback-btn"
                                class="btn btn-primary font-weight-bold text-uppercase px-9 py-6"
                                onclick="window.location.href = '{{ route('application.show', ['guest' => $guest->tracking_id, 'case_category' => $guest->case->case_category, 'step' => $step]) }}'">Go
                                back to edit</button>
                            <button type="button" id="fill-declaration"
                                class="btn btn-primary font-weight-bold text-uppercase px-9 py-6"
                                title="View Declaration" data-toggle="modal"
                                data-target="#viewDeclarationModal">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Declaration Modal --}}
<div class="modal fade" id="viewDeclarationModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="viewDeclarationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewCaseModalLabel">Declaration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-custom-approval" style="margin: -1.75rem; margin-bottom: -23px;">
                    <div class="card-body">
                        <p>
                            I, <span><input id="declaration_name" type="text" class="form-control-declaration w--30"
                                    name="declaration_name" value="{{ $case->applicant_fullname ?? '' }}" /></span> the appointed representative of <span><input
                                    id="declaration_rep" type="text" class="form-control-declaration w--30"
                                    name="declaration_rep" value="{{ $case->applicant_firm ?? '' }}"/>, hereby declare that all the information submitted by me
                                in the application form is correct, true and valid.
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="upload-info" type="button" class="btn btn-light-primary font-weight-bold"
                    data-wizard-type="action-submit">Submit Case</button>
                <button id="upload-img" type="button"
                    class="btn btn-primary font-weight-bold py-2 px-10 hide" disabled>
                    <div class="spinner-grow text-white" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
                </button>
                <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom.javascript')
<script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'create-application.js') }}"></script>
@endsection
