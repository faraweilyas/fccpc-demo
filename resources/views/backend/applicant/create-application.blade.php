@extends('layouts.backend.old.guest')

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="sub-header-desktop">
                <div class="d-flex align-items-baseline mr-5">
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Application</h5>
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
                            <button id="review-application" data-id="{{ $guest->tracking_id }}" class="btn btn-primary font-weight-bold text-uppercase px-9 py-4 float-right mr__10">Review Application</button>
                        </div>
                    </div>
                    <div class="wizard wizard-2" id="kt_wizard_v2" data-wizard-state="step-first" data-wizard-clickable="true">
                        <div class="wizard-nav border-right py-8 px-8 py-lg-20 px-lg-10">
                            <div class="wizard-steps">
                                <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                                    <div class="wizard-wrapper">
                                        <div class="wizard-icon">
                                            <span class="svg-icon svg-icon-2x">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M12,21 C7.02943725,21 3,16.9705627 3,12 C3,7.02943725 7.02943725,3 12,3 C16.9705627,3 21,7.02943725 21,12 C21,16.9705627 16.9705627,21 12,21 Z M14.1654881,7.35483745 L9.61055177,10.3622525 C9.47921741,10.4489666 9.39637436,10.592455 9.38694497,10.7495509 L9.05991526,16.197949 C9.04337012,16.4735952 9.25341309,16.7104632 9.52905936,16.7270083 C9.63705011,16.7334903 9.74423017,16.7047714 9.83451193,16.6451626 L14.3894482,13.6377475 C14.5207826,13.5510334 14.6036256,13.407545 14.613055,13.2504491 L14.9400847,7.80205104 C14.9566299,7.52640477 14.7465869,7.28953682 14.4709406,7.27299168 C14.3629499,7.26650974 14.2557698,7.29522855 14.1654881,7.35483745 Z" fill="#000000" />
                                                    </g>
                                                </svg>
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
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24" />
                                                        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                        <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                                    </g>
                                                </svg>
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
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                        <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
                                                        <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
                                                        <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
                                                        <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
                                                        <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
                                                        <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
                                                    </g>
                                                </svg>
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
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                        <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
                                                        <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
                                                        <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
                                                        <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
                                                        <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
                                                        <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
                                                    </g>
                                                </svg>
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
                                        <input type="hidden" id="tracking_id" name="tracking_id" value="{{ $guest->tracking_id }}">

                                        <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current" data-form='CaseInfo'>
                                            <h4 class="mb-10 font-weight-bold text-dark">Transaction information</h4>
                                            <div class="form-group fv-plugins-icon-container">
                                                <label>Subject</label> <span class="text-danger">*</span>
                                                <input type="text" id="subject" class="form-control" placeholder="Enter subject name" name="subject" value="{{ $case->subject }}">
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
                                                                <input type="text" class="form-control" placeholder="Enter party name" name="party[]" value="{{ $party }}">
                                                                <div class="d-md-none mb-2"></div>
                                                            </div>
                                                            @empty
                                                            <div class="col-lg-5">
                                                                <input type="text" class="form-control" placeholder="Enter party name" name="party[]">
                                                                <div class="d-md-none mb-2"></div>
                                                            </div>
                                                            <div class="col-lg-5">
                                                                <input type="text" class="form-control" placeholder="Enter party name" name="party[]">
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
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24"/>
                                                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                                        <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000"/>
                                                                    </g>
                                                                </svg>
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
                                                        <input type="radio" name="case_type" {{ ($case->case_type == "SM") ? 'checked="checked"' : '' }} value="SM" />
                                                        Small<span></span> &nbsp;&nbsp;
                                                        <i class="la la-info-circle text-hover-primary" data-toggle="tooltip" title="A small merger is a merger where the combined annual turnover of the acquirer and target in, into or from Nigeria is Five Hundred Million Naira and below. "></i>
                                                    </label>
                                                    <label class="radio">
                                                        <input type="radio" name="case_type" {{ ($case->case_type == "LG") ? 'checked="checked"' : '' }} value="LG" />
                                                        Large<span></span> &nbsp;&nbsp;
                                                        <i class="la la-info-circle text-hover-primary" data-toggle="tooltip" title="A large merger is a merger where the combined annual turnover of the acquirer and target in, into or from Nigeria equals or exceeds One Billion Naira OR the annual turnover of the target undertaking in, into or from Nigeria equals or exceeds Five Hundred Million Naira. "></i>
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
                                                        <input type="text" class="form-control" placeholder="Enter applicant/representing firm" name="applicant_firm" value="{{ $case->applicant_firm }}">
                                                        <span class="form-text text-muted">Please enter your representing firm.</span>
                                                        <div class="fv-plugins-message-container"></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Contact Person</label> <span class="text-danger">*</span>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <input type="text" class="form-control" placeholder="Enter full name" name="applicant_fullname" value="{{ $case->applicant_fullname }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group fv-plugins-icon-container">
                                                                <label>Email Address</label> <span class="text-danger">*</span>
                                                                <input type="email" class="form-control" placeholder="Enter email address" name="applicant_email" value="{{ $case->applicant_email }}">
                                                                <span class="form-text text-muted">Please enter your email address.</span>
                                                                <div class="fv-plugins-message-container"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group fv-plugins-icon-container">
                                                                <label>Telephone No</label> <span class="text-danger">*</span>
                                                                <input type="text" class="form-control" placeholder="Enter telephone no" name="applicant_phone_number" value="{{ $case->applicant_phone_number }}">
                                                                <span class="form-text text-muted">Please enter your phone no.</span>
                                                                <div class="fv-plugins-message-container"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group fv-plugins-icon-container">
                                                        <label>Address</label> <span class="text-danger">*</span>
                                                        <input type="text" class="form-control" placeholder="Enter address" name="applicant_address" value="{{ $case->applicant_address }}">
                                                        <span class="form-text text-muted">Please enter your address.</span>
                                                        <div class="fv-plugins-message-container"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="application-documentation-section" class="pb-5" data-wizard-type="step-content" data-form='applicationDocumentation'>
                                            <h6 class="mb-10 font-weight-bold text-dark">You are about to enter the application documentation section.</h6>
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
                                                                Kindly upload {{ strtolower($checklistGroup->name) }}. Kindly check boxes of documents being submitted and in cases where document is not available, please state in additional information section.
                                                            </p>
                                                            <p>
                                                                Upload a single pdf file containing the letter of intent to merge.
                                                            </p>
                                                            <div class="row mt-4">
                                                                @foreach($checklistGroup->checklists as $checklist)
                                                                @php
                                                                    $checked = (in_array($checklist->id, $checklistIds)) ? "checked='checked'" : '';
                                                                @endphp
                                                                <div class="col-md-12">
                                                                    <label class="checkbox mb-4">
                                                                        <input type="checkbox" value="{{ $checklist->id }}" {{ $checked }} id="checklist_id" />
                                                                        <span></span>
                                                                        <small class="fs--100">{{ ucfirst($checklist->name) }}</small>
                                                                    </label>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            <div class="row mt-4">
                                                                <div class="col-md-12">
                                                                    <div class="form-group mb-1">
                                                                        <textarea class="form-control" id="additional_info" rows="6" name="{{ Str::camel($checklistGroup->label) }}_additional_info" placeholder="Additional Information...">{{ !empty($document) ? $document->additional_info : '' }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-4">
                                                                <div class="col-md-3">
                                                                    <div class="uploadButton tw-mb-4 ">
                                                                       <input accept=".doc, .docx, .pdf" id="checklist_doc" class="js-file-upload-input ember-view" type="file" name="{{ Str::camel($checklistGroup->label) }}_doc" data-doc-name="checklist_doc_name_{{ $checklistGroup->id}}">
                                                                        <span class="btn btn--small btn--brand checklist_doc_name_{{ $checklistGroup->id}}">Upload File</span>
                                                                    </div>

                                                                </div>
                                                                <br>
                                                               
                                                                @if(!empty($document))
                                                                <div class="col-md-3 my-1">
                                                                    <span>
                                                                        <img onclick="window.location.href = '{{ route('applicant.document.download', ['document' => $document->id]) }}';" class="max-h-30px mr-3 doc-cursor-pointer" src="{{ $document->getIconText() }}" title="Download Document" />
                                                                    </span>
                                                                </div>
                                                                @endif
                                                                <input type="hidden" id="uploaded_doc" value="{{ !empty($document) ? $document->file : '' }}">
                                                                <input type="hidden" id="checklist_doc_name" value="{{ strtolower($checklist->name) }}">
                                                                <input type="hidden" id="doc_id" value="{{ !empty($document) ? $document->id : '' }}">
                                                            </div>

                                                                <p class="document-uploaded">Letter Of Intent.docx</p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                            <div id="upload-img" class="hide">
                                                <button class="btn btn-primary font-weight-bold text-uppercase px-9 py-4" disabled><i class="fas fa-spinner fa-pulse"></i>&nbsp;Uploading...</button>
                                            </div>
                                            <div id="previous-btn" class="mr-2">
                                                <button class="btn btn-light-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-prev">Previous</button>
                                            </div>
                                            <div id="save-btns">
                                                <button id="save-transaction-info" class="btn btn-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-submit" data-review-route="/application/applicant/{{ $guest->tracking_id }}/review/1">Save & Review</button>
                                                <button id="save-info" class="btn btn-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-next">Save & Continue</button>
                                                <button id="saving-img" class="btn btn-primary font-weight-bold text-uppercase px-9 py-4 hide" disabled><i class="fas fa-spinner fa-pulse"></i>&nbsp;Saving...</button>
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
    <script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'create-application.js') }}"></script>
@endsection
