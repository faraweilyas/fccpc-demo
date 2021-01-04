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
                            <button
                                id="review-application"
                                data-id="{{ $guest->tracking_id }}"
                                class="btn btn-primary font-weight-bold text-uppercase px-9 py-4 float-right mr__10"
                            >
                                    Review Application
                            </button>
                        </div>
                    </div>
                    <div class="wizard wizard-2" id="kt_wizard_v2" data-wizard-state="step-first" data-wizard-clickable="true">
                        <div class="wizard-nav border-right py-8 px-8 py-lg-20 px-lg-10">
                            <div class="wizard-steps">
                                @if(strtolower($case_category_key) == 'reg')
                                    <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                                        <div class="wizard-wrapper">
                                            <div class="wizard-icon">
                                                <span class="svg-icon svg-icon-2x">
                                                    <x-icons.text-document></x-icons.text-document>
                                                </span>
                                            </div>
                                            <div class="wizard-label">
                                                <h3 class="wizard-title">Form 1A</h3>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
                                @foreach($filteredChecklistGroup as $group)
                                    <div class="wizard-step" data-wizard-type="step">
                                        <div class="wizard-wrapper">
                                            <div class="wizard-icon">
                                                <span class="svg-icon svg-icon-2x">
                                                    <x-icons.text-document></x-icons.text-document>
                                                </span>
                                            </div>
                                            <div class="wizard-label">
                                                <h3 class="wizard-title">{{ ucfirst($group->name) }} Form</h3>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @foreach($filteredChecklistGroupFees as $group)
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
                                    <form class="form new-case-form" id="kt_form" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />
                                        <input type="hidden" id="tracking_id" name="tracking_id" value="{{ $guest->tracking_id }}" />
                                        @if(strtolower($case_category_key) == 'reg')
                                            <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current" data-form='Form1AInfo'>
                                                <h4 class="mb-10 font-weight-bold text-dark">Non-Confidential Executive Summary For Publication</h4>
                                                <p>
                                                    Provide a non-confidential executive summary(up to 500 words) of the merger, specifying the parties to the merger, the nature of the merger(for example, merger, acquisition, or joint venture), the areas of activity of the parties to the merger, the markets on which the merger will have an impact, and the strategic and economic rationale for the merger.
                                                </p>
                                                <p>
                                                    It is intended that this Executive SUmmary will be published on the Commission's website and also served on employees' representatives under section 96(3) of the Act. The summary must be drafted so that it contains no confidential information or business secrets. This form should be completed jointly by parties to the proposed transaction.
                                                </p>
                                                <div class="form-group">
                                                    <textarea class="form-control" id="form1a_declaration_text" rows="6" name="form1a_declaration_text" placeholder="Additional Information...">{{ !empty($case->form_1A_Text) ? $case->form_1A_Text : '' }}</textarea>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="pb-5" data-wizard-type="step-content" @if(strtolower($case_category_key) !== 'reg') data-wizard-state="current" @endif data-form='CaseInfo'>
                                            <h4 class="mb-10 font-weight-bold text-dark">Transaction information</h4>
                                            <div class="form-group fv-plugins-icon-container">
                                                <label>Subject</label> <span class="text-danger">*</span>
                                                <input
                                                    type="text"
                                                    id="subject"
                                                    class="form-control"
                                                    placeholder="Enter subject name"
                                                    name="subject"
                                                    value="{{ $case->subject }}"
                                                />
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
                                                                    <input
                                                                        type="text"
                                                                        class="form-control"
                                                                        placeholder="Enter party name"
                                                                        name="party[]"
                                                                        value="{{ $party }}"
                                                                    />
                                                                    <div class="d-md-none mb-2"></div>
                                                                </div>
                                                            @empty
                                                                <div class="col-lg-5">
                                                                    <input
                                                                        type="text"
                                                                        class="form-control"
                                                                        placeholder="Enter party name"
                                                                        name="party[]"
                                                                    />
                                                                    <div class="d-md-none mb-2"></div>
                                                                </div>
                                                                <div class="col-lg-5">
                                                                    <input
                                                                        type="text"
                                                                        class="form-control"
                                                                        placeholder="Enter party name"
                                                                        name="party[]"
                                                                    />
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
                                                        <input
                                                            type="radio"
                                                            name="case_type"
                                                            {{ ($case->case_type == "SM") ? 'checked="checked"' : '' }}
                                                            value="SM"
                                                        />
                                                        Small<span></span> &nbsp;&nbsp;
                                                        <i
                                                            class="la la-info-circle text-hover-primary"
                                                            data-toggle="tooltip"
                                                            title="A small merger is a merger where the combined annual turnover of the acquirer and target in, into or from Nigeria is Five Hundred Million Naira (&#8358;500,000,000) and below. "
                                                        ></i>
                                                    </label>
                                                    <label class="radio">
                                                        <input
                                                            type="radio"
                                                            name="case_type"
                                                            {{ ($case->case_type == "LG") ? 'checked="checked"' : '' }}
                                                            value="LG"
                                                        />
                                                        Large<span></span> &nbsp;&nbsp;
                                                        <i
                                                            class="la la-info-circle text-hover-primary"
                                                            data-toggle="tooltip"
                                                            title="A large merger is a merger where the combined annual turnover of the acquirer and target in, into or from Nigeria equals or exceeds One Billion Naira (&#8358;1,000,000,000) OR the annual turnover of the target undertaking in, into or from Nigeria equals or exceeds Five Hundred Million Naira (&#8358;500,000,000). "
                                                        ></i>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pb-5" data-wizard-type="step-content" data-form='ContactInfo'>
                                            <h4 class="mb-10 font-weight-bold text-dark">Contact Information</h4>
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="form-group fv-plugins-icon-container">
                                                        <label>Applicant/Representing Firm</label> <span class="text-danger">*</span>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            placeholder="Enter applicant/representing firm"
                                                            name="applicant_firm"
                                                            value="{{ $case->applicant_firm }}"
                                                        />
                                                        <span class="form-text text-muted">Please enter your representing firm.</span>
                                                        <div class="fv-plugins-message-container"></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Contact Person</label> <span class="text-danger">*</span>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    placeholder="Enter full name"
                                                                    name="applicant_fullname"
                                                                    value="{{ $case->applicant_fullname }}"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group fv-plugins-icon-container">
                                                                <label>Email Address</label> <span class="text-danger">*</span>
                                                                <input
                                                                    type="email"
                                                                    class="form-control"
                                                                    placeholder="Enter email address"
                                                                    name="applicant_email"
                                                                    value="{{ $case->applicant_email }}"
                                                                />
                                                                <span class="form-text text-muted">Please enter your email address.</span>
                                                                <div class="fv-plugins-message-container"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group fv-plugins-icon-container">
                                                                <label>Telephone No</label> <span class="text-danger">*</span>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    placeholder="Enter telephone no"
                                                                    name="applicant_phone_number"
                                                                    value="{{ $case->applicant_phone_number }}"
                                                                />
                                                                <span class="form-text text-muted">Please enter your phone no.</span>
                                                                <div class="fv-plugins-message-container"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group fv-plugins-icon-container">
                                                        <label>Address</label> <span class="text-danger">*</span>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            placeholder="Enter address"
                                                            name="applicant_address"
                                                            value="{{ $case->applicant_address }}"
                                                        />
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
                                                                <input
                                                                    accept=".pdf"
                                                                    id="letter_of_appointment_doc"
                                                                    class="js-file-upload-input ember-view"
                                                                    type="file"
                                                                    name="letter_of_appointment_doc"
                                                                />
                                                                <span class="btn btn--small btn--brand">Upload File</span>
                                                            </div>
                                                        </div>
                                                        @if(!empty($case->letter_of_appointment))
                                                            <div class="col-md-3 my-1">
                                                                <span>
                                                                    <img
                                                                        onclick="window.location.href='{{ route('applicant.download_contact_loa', ['document' => $case->letter_of_appointment]) }}';"
                                                                        class="max-h-30px mr-3 doc-cursor-pointer"
                                                                        src="{{ $case->getLetterOfAppointmentIconText() }}"
                                                                        title="Download Document"
                                                                    />
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <p class="document-uploaded loa_doc_name"></p>
                                                    <input
                                                        id="previous_letter_of_appointment_doc_name"
                                                        type="hidden"
                                                        value="{{ $case->letter_of_appointment }}"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        @foreach($filteredChecklistGroup as $checklistGroup)
                                            @php
                                                $document = \App\Models\Document::where('case_id', $case->id)
                                                                ->where('group_id', $checklistGroup->id)
                                                                ->where('date_case_submitted', null)
                                                                ->first() ?? '';
                                            @endphp
                                            <div class="pb-5" data-wizard-type="step-content" data-form='ChecklistDocument'>
                                                <div class="row mt-4">
                                                    <div class="col-md-12">
                                                        <div class="card card-custom gutter-b example example-compact">
                                                            <div class="card-header">
                                                                <h3 class="card-title">{{ ucfirst($checklistGroup->name) }} Form</h3>
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
                                                                <div class="d-flex flex-column">
                                                                    <div class="flex-grow-1 text-center" style="position: relative;">
                                                                        <a class="" href="{{ route('application.download_form', ['form' => $checklistGroup->file]) }}" title="Download Form">
                                                                            <img src="{{ BE_MEDIA.'/svg/icons/Files/DownloadFileGreen.svg' }}" class="w--20" />
                                                                        </a>
                                                                        <a class="" href="{{ route('application.download_form', ['form' => $checklistGroup->file]) }}" title="Download Form">
                                                                            <p class="text-center">
                                                                                <b>Download Form</b>
                                                                            </p>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-4">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group mb-1">
                                                                            <textarea class="form-control" id="additional_info" rows="6" name="{{ Str::camel($checklistGroup->label) }}_additional_info" placeholder="Additional Information...">{{ !empty($document) ? $document->additional_info : '' }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-4">
                                                                    <div class="col-md-4">
                                                                        <div class="uploadButton tw-mb-4 ">
                                                                            <input
                                                                                accept=".pdf"
                                                                                id="checklist_doc"
                                                                                class="js-file-upload-input ember-view checklist_doc"
                                                                                type="file"
                                                                                name="{{ Str::camel($checklistGroup->label) }}_doc"
                                                                                data-doc-name="checklist_doc_name_{{ $checklistGroup->id}}"
                                                                                multiple
                                                                            />
                                                                            <span class="btn btn--small btn--brand">Upload Files</span>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <input
                                                                        type="hidden"
                                                                        id="doc_id"
                                                                        value="{{ !empty($document) ? $document->id : '' }}"
                                                                    />
                                                                    <input type="hidden" id="group_id" value="{{ $checklistGroup->id }}" />
                                                                </div>
                                                                <div id="checklist_doc_name_{{ $checklistGroup->id}}"></div>
                                                                @if(!empty($document))
                                                                    <div class="row mt-4">
                                                                        @php
                                                                            $file_count = 1;
                                                                        @endphp
                                                                        @foreach($document->getFileArray() as $key => $file)
                                                                            <div class="col-md-12 my-1">
                                                                                <span>

                                                                                    <img
                                                                                        onclick="window.location.href='{{ route('applicant.document.download', ['document' => $document->id, 'file' => $file]) }}';"
                                                                                        class="max-h-30px mr-3 doc-cursor-pointer"
                                                                                        src="{{ $document->getFileIconText($file) }}"
                                                                                        title="Download Document"
                                                                                    />
                                                                                    <a
                                                                                        href="{{ route('applicant.document.download', ['document' => $document->id, 'file' => $file]) }}"
                                                                                        class="text-dark text-hover-primary"
                                                                                    >
                                                                                        {{ ucfirst($checklistGroup->name).' Form '.$file_count }}
                                                                                    </a>&nbsp;<i class="la la-download text-primary"></i>
                                                                                </span>
                                                                            </div>
                                                                            @php
                                                                                $file_count++;
                                                                            @endphp
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @foreach($filteredChecklistGroupFees as $checklistGroup)
                                            @php
                                                $document = \App\Models\Document::where('case_id', $case->id)
                                                                ->where('group_id', $checklistGroup->id)
                                                                ->where('date_case_submitted', null)
                                                                ->first() ?? '';
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
                                                                <div class="row">
                                                                    @if ($checklistGroup->isGroupFees())
                                                                        <div class="col-md-12 mb-4">
                                                                            Application Fee: <span class="application_fee">{!! $case->getApplicationFee() !!}</span>
                                                                            <input
                                                                                type="hidden"
                                                                                class="form-control"
                                                                                name="application_fee"
                                                                                value="{{ $case->application_fee }}"
                                                                                id="application_fee"
                                                                            />
                                                                        </div>
                                                                        <div class="col-md-12 mb-4">
                                                                            Processing Fee: <span class="processing_fee">{!! $case->getProcessingFee() !!}</span>
                                                                            <input
                                                                                type="hidden"
                                                                                class="form-control"
                                                                                name="processing_fee"
                                                                                value="{{ $case->processing_fee }}"
                                                                                id="processing_fee"
                                                                            />
                                                                        </div>
                                                                        <div class="col-md-12 mb-4">
                                                                            Expedited Fee: <span class="expedited_fee">{!! $case->getExpeditedFee() !!}</span>
                                                                            <input
                                                                                type="hidden"
                                                                                class="form-control"
                                                                                name="expedited_fee"
                                                                                value="{{ $case->expedited_fee }}"
                                                                                id="expedited_fee"
                                                                            />
                                                                        </div>
                                                                        <div class="col-md-12 mb-4">
                                                                            Total Amount: <span class="amount_paid">{!! $case->getAmountPaid() !!}</span>
                                                                            <input
                                                                                type="hidden"
                                                                                class="form-control"
                                                                                name="amount_paid"
                                                                                value="{{ $case->amount_paid }}"
                                                                                id="amount_paid"
                                                                            />
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-4 ml-n4">
                                                                    <a href="#" id="kt_fee">
                                                                        <i class="la la-info-circle"></i>&nbsp;Generate Fee
                                                                    </a>
                                                                </div>
                                                                <div class="row mt-4">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group mb-1">
                                                                            <textarea class="form-control" id="additional_info" rows="6" name="{{ Str::camel($checklistGroup->label) }}_additional_info" placeholder="Additional Information...">{{ !empty($document) ? $document->additional_info : '' }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-4">
                                                                    <div class="col-md-4">
                                                                        <div class="uploadButton tw-mb-4 ">
                                                                            <input
                                                                                accept=".pdf"
                                                                                id="checklist_doc"
                                                                                class="js-file-upload-input ember-view checklist_doc"
                                                                                type="file"
                                                                                name="{{ Str::camel($checklistGroup->label) }}_doc"
                                                                                data-doc-name="checklist_doc_name_{{ $checklistGroup->id}}"
                                                                                multiple
                                                                            />
                                                                            <span class="btn btn--small btn--brand">Upload Files</span>
                                                                        </div>

                                                                    </div>
                                                                    <br>
                                                                    <input
                                                                        type="hidden"
                                                                        id="uploaded_doc"
                                                                        value="{{ !empty($document) ? $document->file : '' }}"
                                                                    />
                                                                    <input
                                                                        type="hidden"
                                                                        id="doc_id"
                                                                        value="{{ !empty($document) ? $document->id : '' }}"
                                                                    />
                                                                    <input type="hidden" id="group_id" value="{{ $checklistGroup->id }}" />
                                                                </div>
                                                                <div id="checklist_doc_name_{{ $checklistGroup->id}}"></div>
                                                                @if(!empty($document))
                                                                    <div class="row mt-4">
                                                                        @php
                                                                            $file_count = 1;
                                                                        @endphp
                                                                        @foreach($document->getFileArray() as $key => $file)
                                                                            <div class="col-md-12 my-1">
                                                                                <span>

                                                                                    <img
                                                                                        onclick="window.location.href='{{ route('applicant.document.download', ['document' => $document->id, 'file' => $file]) }}';"
                                                                                        class="max-h-30px mr-3 doc-cursor-pointer"
                                                                                        src="{{ $document->getFileIconText($file) }}"
                                                                                        title="Download Document"
                                                                                    />
                                                                                    <a
                                                                                        href="{{ route('applicant.document.download', ['document' => $document->id, 'file' => $file]) }}"
                                                                                        class="text-dark text-hover-primary"
                                                                                    >
                                                                                        {{
                                                                                            ucfirst($checklistGroup->name).' Form '.$file_count}}
                                                                                    </a>
                                                                                </span>
                                                                            </div>
                                                                            @php
                                                                                $file_count++;
                                                                            @endphp
                                                                        @endforeach
                                                                    </div>
                                                                @endif
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
                                                <button
                                                    class="btn btn-light-primary font-weight-bold text-uppercase px-9 py-4"
                                                    data-wizard-type="action-prev"
                                                >
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
                                                    Save & Review
                                                </button>
                                                <button
                                                    id="save-info"
                                                    class="btn btn-primary font-weight-bold text-uppercase px-9 py-4"
                                                    data-wizard-type="action-next"
                                                >
                                                    Save & Continue
                                                </button>
                                                <button
                                                    id="saving-img"
                                                    class="btn btn-primary font-weight-bold text-uppercase px-15 py-3 hide"
                                                    disabled
                                                >
                                                    <div class="spinner-grow text-white" role="status">
                                                      <span class="sr-only">Loading...</span>
                                                    </div>
                                                </button>
                                            </div>
                                            <input type="hidden" id="current-step" value="{{ $_GET['step'] ?? 1 }}" />
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
    <!-- Form 1A Declaration Modal -->
    <div
        class="modal fade"
        id="form1ADeclarationModal"
        data-backdrop="static"
        tabindex="-1"
        role="dialog"
        aria-labelledby="viewDeclarationModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewForm1AModalLabel">Form 1A Declaration</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-custom-approval" style="margin: -1.75rem; margin-bottom: -23px;">
                        <div class="card-body">
                            <p>
                                This Declaration must be signed by a duly authorised person or on behalf of each of the merger parties:
                            </p>
                            <p>
                                I declare that, to the best of my knowledge and belief, the information given in response to the questions in this Notice is true, correct, and complete in all material respects.
                            </p>
                            <p>
                                I understand that:
                            </p>
                            <p>
                                It is a criminal offence under section 112 of the Federal Competition and Consumer Protection Act, 2018 for a person knowingly to supply to the Commission information which is false or misleading in any material respect. This includes supplying such information to another person or any officer of the Commission knowing that the information is to be used for the purpose of supplying information to the Commission;
                            </p>
                            <p>
                                The Commission shall reject any Notice if it is discovered that it contains information which is false or misleading in any material respect;
                            </p>
                            <p>
                                The Commission conducts both Phase 1 and Phase 2 investigations. In the event that the merger is referred for a Phase 2 investigation, information provided to the Commission during the course of the Phase 1 investigation will also be used for the Phase 2 investigation; and
                            </p>
                            <p>
                                The Commission will publish to the public some information described in this Notice, and the fact that the merger has been notified, as prescribed by the Act.
                            </p>
                            <div class="form-group">
                                <input
                                    id="form1a_declaration_name"
                                    type="text"
                                    class="form-control-declaration w--60"
                                    name="form1a_declaration_name"
                                    placeholder="Full Name"
                                    value="{{ $case->form_1A_Name ?? '' }}"
                                />
                            </div>
                            <div class="form-group">
                                <input
                                    id="form1a_declaration_position"
                                    type="text"
                                    class="form-control-declaration w--60"
                                    name="form1a_declaration_position"
                                    placeholder="Position"
                                    value="{{ $case->form_1A_Position ?? '' }}"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        id="save-form1A-info"
                        type="button"
                        class="btn btn-light-primary font-weight-bold"
                    >
                        Save
                    </button>
                    <button
                        id="save-form1A-upload-img"
                        type="button"
                        class="btn btn-primary font-weight-bold py-2 px-10 hide"
                        disabled
                    >
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

@section('custom.css')
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'pages/wizard/wizard-2.css') }}" />
@endsection

@section('custom.javascript')
    <script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/select2/js/select2.js') }}"></script>
    <script src="{{ pc_asset(BE_APP_JS.'functions.js') }}"></script>
    <script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'create-application.js') }}"></script>
    <script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'custom.js') }}"></script>
@endsection
