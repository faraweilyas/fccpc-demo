@extends('layouts.backend.old.guest')

@section('content')
<div class="subheader py-2 py-lg-4 subheader-transparent mt-xs-20 mt-sm-18 mt-md-20 mt-lg-0 subheader-applicants" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="sub-header-desktop subheader-applicants">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Application</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ $guest->applicationPath() }}" class="text-muted">Select transaction category</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">{{ $case_category }} Transaction</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sub-header-mobile">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Application</h5>
            </div>
            <div class="d-flex align-items-baseline mr-5">
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ $guest->applicationPath() }}" class="text-muted">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">{{ $case_category }} Transaction</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container">

        <div class="card card-custom">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4 mt-4">
                        <button id="review-application" data-id="{{ $guest->tracking_id }}"
                            class="btn btn-primary font-weight-bold text-uppercase px-9 py-4 float-right mr__10">Review
                            Application</button>
                    </div>
                </div>
                <div class="wizard wizard-2" id="kt_wizard_v2" data-wizard-state="step-first"
                    data-wizard-clickable="true">
                    <div class="wizard-nav border-right py-8 px-8 py-lg-20 px-lg-10">
                        <div class="wizard-steps">
                            <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                                <div class="wizard-wrapper">
                                    <div class="wizard-icon">
                                        <span class="svg-icon svg-icon-2x">
                                            <x-icons.transaction></x-icons.transaction>
                                        </span>
                                    </div>
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">Transaction Information</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="wizard-step" data-wizard-type="step">
                                <div class="wizard-wrapper">
                                    <div class="wizard-icon">
                                        <span class="svg-icon svg-icon-2x">
                                            <x-icons.contact></x-icons.contact>
                                        </span>
                                    </div>
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">Contact Information</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="wizard-step" data-wizard-type="step">
                                <div class="wizard-wrapper">
                                    <div class="wizard-icon">
                                        <span class="svg-icon svg-icon-2x">
                                            <x-icons.text-document></x-icons.text-document>
                                        </span>
                                    </div>
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">Application Documentation</h3>
                                    </div>
                                </div>
                            </div>
                            @foreach(\App\Models\ChecklistGroup::all() as $group)
                            <div class="wizard-step" data-wizard-type="step">
                                <div class="wizard-wrapper">
                                    <div class="wizard-icon">
                                        <span class="svg-icon svg-icon-2x">
                                            <x-icons.text-document></x-icons.text-document>
                                        </span>
                                    </div>
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">{{ ucfirst($group->name) }}</h3>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="wizard-body py-8 px-8 py-lg-20 px-lg-10">
                        <div class="row">
                            <div class="offset-xxl-2 col-xxl-8">
                                <form class="form new-case-form" id="kt_form" method="POST"
                                    enctype="multipart/form-data">

                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />
                                    <input type="hidden" id="tracking_id" name="tracking_id"
                                        value="{{ $guest->tracking_id }}">

                                    <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current"
                                        data-form='CaseInfo'>
                                        <h4 class="mb-10 font-weight-bold text-dark">Transaction information</h4>
                                        <div class="form-group fv-plugins-icon-container">
                                            <label>Subject</label> <span class="text-danger">*</span>
                                            <input type="text" id="subject" class="form-control"
                                                placeholder="Enter subject name" name="subject"
                                                value="{{ $case->subject }}">
                                            <span class="form-text text-muted">Please enter subject.</span>
                                            <div class="fv-plugins-message-container"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Parties</label> <span class="text-danger">*</span>
                                            <div class="fields">
                                                <div class="field-item">
                                                    <div class="row">
                                                        @forelse ($case_parties as $party)
                                                        <div class="col-lg-5 mb-4">
                                                            <input type="text" class="form-control"
                                                                placeholder="Enter party name" name="party[]"
                                                                value="{{ $party }}">
                                                            <div class="d-md-none mb-2"></div>
                                                        </div>
                                                        @empty
                                                        <div class="col-lg-5">
                                                            <input type="text" class="form-control"
                                                                placeholder="Enter party name" name="party[]">
                                                            <div class="d-md-none mb-2"></div>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <input type="text" class="form-control"
                                                                placeholder="Enter party name" name="party[]">
                                                            <div class="d-md-none mb-2"></div>
                                                        </div>
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-lg-12">
                                                    <a href="javascript:;" id="add-party-fields">
                                                        <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                            <x-icons.add-more></x-icons.add-more>
                                                        </span>
                                                        <span class="text-primary">&nbsp;&nbsp;Add More</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Transaction Type</label>
                                            <div class="radio-inline">
                                                <label class="radio">
                                                    <input type="radio" name="case_type"
                                                        {{ ($case->case_type == "SM") ? 'checked="checked"' : '' }}
                                                        value="SM" />
                                                    Small<span></span> &nbsp;&nbsp;
                                                    <i class="la la-info-circle text-hover-primary"
                                                        data-toggle="tooltip"
                                                        title="A small merger is a merger where the combined annual turnover of the acquirer and target in, into or from Nigeria is Five Hundred Million Naira (&#8358;500,000,000) and below. "></i>
                                                </label>
                                                <label class="radio">
                                                    <input type="radio" name="case_type"
                                                        {{ ($case->case_type == "LG") ? 'checked="checked"' : '' }}
                                                        value="LG" />
                                                    Large<span></span> &nbsp;&nbsp;
                                                    <i class="la la-info-circle text-hover-primary"
                                                        data-toggle="tooltip"
                                                        title="A large merger is a merger where the combined annual turnover of the acquirer and target in, into or from Nigeria equals or exceeds One Billion Naira (&#8358;1,000,000,000) OR the annual turnover of the target undertaking in, into or from Nigeria equals or exceeds Five Hundred Million Naira (&#8358;500,000,000). "></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pb-5" data-wizard-type="step-content" data-form='ContactInfo'>
                                        <h4 class="mb-10 font-weight-bold text-dark">Contact Information</h4>
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="form-group fv-plugins-icon-container">
                                                    <label>Applicant/Representing Firm</label> <span
                                                        class="text-danger">*</span>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter applicant/representing firm"
                                                        name="applicant_firm" value="{{ $case->applicant_firm }}">
                                                    <span class="form-text text-muted">Please enter your representing
                                                        firm.</span>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Contact Person</label> <span class="text-danger">*</span>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <input type="text" class="form-control"
                                                                placeholder="Enter full name" name="applicant_fullname"
                                                                value="{{ $case->applicant_fullname }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group fv-plugins-icon-container">
                                                            <label>Email Address</label> <span
                                                                class="text-danger">*</span>
                                                            <input type="email" class="form-control"
                                                                placeholder="Enter email address" name="applicant_email"
                                                                value="{{ $case->applicant_email }}">
                                                            <span class="form-text text-muted">Please enter your email
                                                                address.</span>
                                                            <div class="fv-plugins-message-container"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group fv-plugins-icon-container">
                                                            <label>Telephone No</label> <span
                                                                class="text-danger">*</span>
                                                            <input type="text" class="form-control"
                                                                placeholder="Enter telephone no"
                                                                name="applicant_phone_number"
                                                                value="{{ $case->applicant_phone_number }}">
                                                            <span class="form-text text-muted">Please enter your phone
                                                                no.</span>
                                                            <div class="fv-plugins-message-container"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group fv-plugins-icon-container">
                                                    <label>Address</label> <span class="text-danger">*</span>
                                                    <input type="text" class="form-control" placeholder="Enter address"
                                                        name="applicant_address" value="{{ $case->applicant_address }}">
                                                    <span class="form-text text-muted">Please enter your address.</span>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-md-12">
                                                        <p>
                                                            <label>Letter Of Appointment</label>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row mt-n2">
                                                    <div class="col-md-3">
                                                        <div class="uploadButton tw-mb-4 ">
                                                            <input accept=".pdf" id="letter_of_appointment_doc"
                                                                class="js-file-upload-input ember-view" type="file"
                                                                name="letter_of_appointment_doc">
                                                            <span class="btn btn--small btn--brand">Upload File</span>
                                                        </div>
                                                    </div>
                                                    @if(!empty($case->letter_of_appointment))
                                                    <div class="col-md-3 my-1">
                                                        <span>
                                                            <img onclick="window.location.href = '{{ route('applicant.download_contact_loa', ['document' => $case->letter_of_appointment]) }}';"
                                                                class="max-h-30px mr-3 doc-cursor-pointer"
                                                                src="{{ $case->getLetterOfAppointmentIconText() }}"
                                                                title="Download Document" />
                                                        </span>
                                                    </div>
                                                    @endif
                                                </div>
                                                <p class="document-uploaded doc_name"></p>
                                                <input id="previous_letter_of_appointment_doc_name" type="hidden"
                                                    value="{{ $case->letter_of_appointment }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        id="application-documentation-section"
                                        class="pb-5"
                                        data-wizard-type="step-content"
                                        data-form='ApplicationDocumentation'
                                    >
                                        <h6 class="font-weight-bold text-dark text-center section__breaker">This section requires you to upload all relevant application document in a searchable PDF format.
                                        </h6>
                                        <p class="mt-20 mb-10">Please upload application forms below.</p>
                                        <div class="row">
                                            @php
                                                $application_forms  = \AppHelper::get('application_forms', NULL);
                                                $formObjects        = $case->formatApplicationForms();
                                            @endphp
                                            @foreach ($application_forms as $key => $form)
                                                <div class="col-md-12 mb-4">
                                                    <p class="">Upload {{ $form }}</p>
                                                    <div class="uploadButton tw-mb-4">
                                                        <input
                                                            class="js-file-upload-input ember-view application_form_doc"
                                                            type="file"
                                                            name="application_form_doc_{{ $key }}"
                                                            id="application_form_doc_{{ $key }}"
                                                            data-form="application_form_doc_name_{{ $key }}"
                                                            style="width: 19%;"
                                                        />
                                                        <span class="btn btn--small btn--brand">Upload File</span>
                                                        @if (!empty($old_form = $formObjects[$key] ?? []))
                                                            <a href="{{ route('applicant.download_form_doc', ['document' => $old_form->file]) }}">
                                                                <img
                                                                    class="align_icon"
                                                                    src="{{ $case->getApplicationFormIconText($old_form->file) }}"
                                                                    title="Download {{ ucfirst($old_form->name) }} Document"
                                                                />
                                                            </a>
                                                        @endif
                                                        <p class="document-uploaded application_form_doc_name_{{ $key }}"></p>
                                                    </div>
                                                </div>
                                                <div class='clear-fix'></div>
                                            @endforeach
                                        </div>
                                        <input id="previous_application_forms_name" type="hidden" value="{{ $case->application_forms }}">
                                    </div>
                                    @foreach(\App\Models\ChecklistGroup::with('checklists')->get() as $checklistGroup)
                                        @php
                                            $document = $checklistGroupDocuments[$checklistGroup->id] ?? '';
                                        @endphp
                                        <div class="pb-5" data-wizard-type="step-content" data-form='ChecklistDocument'>
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card card-custom gutter-b example example-compact">
                                                        <div class="card-header">
                                                            <h3 class="card-title">{{ ucfirst($checklistGroup->name) }}</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <p>
                                                                Upload the {{ strtolower($checklistGroup->name) }} as a
                                                                single PDF file containing the relevant information listed
                                                                below.
                                                            </p>
                                                            <p>
                                                                Check all applicable boxes and use the additional
                                                                information section to explain reasons for any unavailable
                                                                information.
                                                            </p>
                                                            <div class="row mt-4">
                                                                @foreach($checklistGroup->checklists as $checklist)
                                                                @php
                                                                $checked = (in_array($checklist->id, $checklistIds)) ?
                                                                "checked='checked'" : '';
                                                                @endphp
                                                                <div class="col-md-12">
                                                                    <label class="checkbox mb-4">
                                                                        <input type="checkbox" class="checklist_id"
                                                                            value="{{ $checklist->id }}" {{ $checked }} />
                                                                        <span></span>
                                                                        <small
                                                                            class="fs--100">{{ ucfirst($checklist->name) }}</small>
                                                                    </label>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            <div class="row">
                                                                @if ($checklistGroup->isGroupFees())
                                                                <div class="col-md-6 mb-4 ml-8">
                                                                    <input type="text" class="form-control amount_paid"
                                                                        name="amount_paid" value="{{ $case->amount_paid }}"
                                                                        placeholder="Enter Amount Paid:" id="amount_paid" />
                                                                </div>
                                                                @endif
                                                            </div>
                                                            <div class="row mt-4">
                                                                <div class="col-md-12">
                                                                    <div class="form-group mb-1">
                                                                        <textarea class="form-control" id="additional_info"
                                                                            rows="6"
                                                                            name="{{ Str::camel($checklistGroup->label) }}_additional_info"
                                                                            placeholder="Additional Information...">{{ !empty($document) ? $document->additional_info : '' }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-4">
                                                                <div class="col-md-3">
                                                                    <div class="uploadButton tw-mb-4 ">
                                                                        <input accept=".pdf" id="checklist_doc"
                                                                            class="js-file-upload-input ember-view"
                                                                            type="file"
                                                                            name="{{ Str::camel($checklistGroup->label) }}_doc"
                                                                            data-doc-name="checklist_doc_name_{{ $checklistGroup->id}}">
                                                                        <span class="btn btn--small btn--brand">Upload
                                                                            File</span>
                                                                    </div>

                                                                </div>
                                                                <br>

                                                                @if(!empty($document))
                                                                <div class="col-md-3 my-1">
                                                                    <span>
                                                                        <img onclick="window.location.href = '{{ route('applicant.document.download', ['document' => $document->id]) }}';"
                                                                            class="max-h-30px mr-3 doc-cursor-pointer"
                                                                            src="{{ $document->getIconText() }}"
                                                                            title="Download Document" />
                                                                    </span>
                                                                </div>
                                                                @endif
                                                                <input type="hidden" id="uploaded_doc"
                                                                    value="{{ !empty($document) ? $document->file : '' }}">
                                                                <input type="hidden" id="checklist_doc_name"
                                                                    value="{{ strtolower($checklist->name) }}">
                                                                <input type="hidden" id="doc_id"
                                                                    value="{{ !empty($document) ? $document->id : '' }}">
                                                                <input type="hidden" id="group_id" value="{{ $checklistGroup->id }}">
                                                            </div>
                                                            <p
                                                                class="document-uploaded checklist_doc_name_{{ $checklistGroup->id}}">
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                        <div id="upload-img" class="hide">
                                            <button class="btn btn-primary font-weight-bold text-uppercase px-9 py-4" disabled>
                                                <i class="fas fa-spinner fa-pulse"></i>&nbsp;Uploading...
                                            </button>
                                        </div>
                                        <div id="previous-btn" class="mr-2">
                                            <button class="btn btn-light-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-prev">
                                                Previous
                                            </button>
                                        </div>
                                        <div id="save-btns">
                                            <button
                                                id="save-transaction-info"
                                                class="btn btn-primary font-weight-bold text-uppercase px-9 py-4"
                                                data-wizard-type="action-submit"
                                                data-review-route="/application/applicant/{{ $guest->tracking_id }}/review/1"
                                            >
                                                Save &nbsp; Review
                                            </button>
                                            <button
                                                id="save-info"
                                                class="btn btn-primary font-weight-bold text-uppercase px-9 py-4"
                                                data-wizard-type="action-next"
                                            >
                                                Save &nbsp; Continue
                                            </button>
                                            <button id="saving-img" class="btn btn-primary font-weight-bold text-uppercase px-15 py-3 hide"
                                                disabled>
                                                <div class="spinner-grow text-white" role="status">
                                                  <span class="sr-only">Loading...</span>
                                                </div>
                                            </button>
                                        </div>
                                        <input type="hidden" id="current-step" value="{{ $_GET['step'] ?? 1 }}">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom.css')
<link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'pages/wizard/wizard-2.css') }}" />
@endsection

@section('custom.javascript')
<script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/select2/js/select2.js') }}"></script>
<script src="{{ pc_asset(BE_APP_JS.'functions.js') }}"></script>
<script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'create-application.js') }}"></script>
<script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'custom.js') }}"></script>
@endsection
