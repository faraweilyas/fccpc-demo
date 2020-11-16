@extends('layouts.backend.old.guest')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            @if(!$isDeficient)
            <div class="row mt-40">
                <div class="col-md-6 mx-auto">
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <img
                                        src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgaGVpZ2h0PSIxMTdweCIgdmVyc2lvbj0iMS4xIiB2aWV3Qm94PSIwIDAgMTE3IDExNyIgd2lkdGg9IjExN3B4IiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj48dGl0bGUvPjxkZXNjLz48ZGVmcy8+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIiBpZD0iUGFnZS0xIiBzdHJva2U9Im5vbmUiIHN0cm9rZS13aWR0aD0iMSI+PGcgZmlsbC1ydWxlPSJub256ZXJvIiBpZD0iY29ycmVjdCI+PHBhdGggZD0iTTM0LjUsNTUuMSBDMzIuOSw1My41IDMwLjMsNTMuNSAyOC43LDU1LjEgQzI3LjEsNTYuNyAyNy4xLDU5LjMgMjguNyw2MC45IEw0Ny42LDc5LjggQzQ4LjQsODAuNiA0OS40LDgxIDUwLjUsODEgQzUwLjYsODEgNTAuNiw4MSA1MC43LDgxIEM1MS44LDgwLjkgNTIuOSw4MC40IDUzLjcsNzkuNSBMMTAxLDIyLjggQzEwMi40LDIxLjEgMTAyLjIsMTguNSAxMDAuNSwxNyBDOTguOCwxNS42IDk2LjIsMTUuOCA5NC43LDE3LjUgTDUwLjIsNzAuOCBMMzQuNSw1NS4xIFoiIGZpbGw9IiMxN0FCMTMiIGlkPSJTaGFwZSIvPjxwYXRoIGQ9Ik04OS4xLDkuMyBDNjYuMSwtNS4xIDM2LjYsLTEuNyAxNy40LDE3LjUgQy01LjIsNDAuMSAtNS4yLDc3IDE3LjQsOTkuNiBDMjguNywxMTAuOSA0My42LDExNi42IDU4LjQsMTE2LjYgQzczLjIsMTE2LjYgODguMSwxMTAuOSA5OS40LDk5LjYgQzExOC43LDgwLjMgMTIyLDUwLjcgMTA3LjUsMjcuNyBDMTA2LjMsMjUuOCAxMDMuOCwyNS4yIDEwMS45LDI2LjQgQzEwMCwyNy42IDk5LjQsMzAuMSAxMDAuNiwzMiBDMTEzLjEsNTEuOCAxMTAuMiw3Ny4yIDkzLjYsOTMuOCBDNzQuMiwxMTMuMiA0Mi41LDExMy4yIDIzLjEsOTMuOCBDMy43LDc0LjQgMy43LDQyLjcgMjMuMSwyMy4zIEMzOS43LDYuOCA2NSwzLjkgODQuOCwxNi4yIEM4Ni43LDE3LjQgODkuMiwxNi44IDkwLjQsMTQuOSBDOTEuNiwxMyA5MSwxMC41IDg5LjEsOS4zIFoiIGZpbGw9IiM0QTRBNEEiIGlkPSJTaGFwZSIvPjwvZz48L2c+PC9zdmc+">
                                </div>
                            </div>
                            <div class="row mt-6">
                                <div class="col-md-12 text-center">
                                    <p><strong>Your application <b>{{ $guest->getTrackingID() }}</b> is still being
                                            reviewed.</strong></p>
                                    <p><strong>Our representative would get back to you.</strong></p>

                                    <a href="{{ $guest->applicantPath() }}"
                                        class="btn btn-primary font-weight-bold text-uppercase mr-5 px-9 py-4">
                                        Create a New Application
                                    </a>
                                    <a data-turbolinks="false" href="/"
                                        class="btn btn-secondary font-weight-bold text-uppercase mr-5 px-9 py-4">
                                        Return Home
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Upload Deficient Document (PDF/DOCX)</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="wizard wizard-2" id="kt_wizard_v2" data-wizard-state="step-first"
                                data-wizard-clickable="true">
                                <div class="wizard-nav border-right py-8 px-8 py-lg-20 px-lg-10">
                                    <div class="wizard-steps">
                                        @foreach(\App\Models\ChecklistGroup::all() as $checklistGroup)
                                        @if((in_array($checklistGroup->id, $newDeficientGroupIds)))
                                        <div class="wizard-step" data-wizard-type="step">
                                            <div class="wizard-wrapper">
                                                <div class="wizard-icon">
                                                    <span class="svg-icon svg-icon-2x">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path
                                                                    d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                                                    fill="#000000" opacity="0.3" />
                                                                <path
                                                                    d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                                                    fill="#000000" />
                                                                <rect fill="#000000" opacity="0.3" x="10" y="9"
                                                                    width="7" height="2" rx="1" />
                                                                <rect fill="#000000" opacity="0.3" x="7" y="9" width="2"
                                                                    height="2" rx="1" />
                                                                <rect fill="#000000" opacity="0.3" x="7" y="13"
                                                                    width="2" height="2" rx="1" />
                                                                <rect fill="#000000" opacity="0.3" x="10" y="13"
                                                                    width="7" height="2" rx="1" />
                                                                <rect fill="#000000" opacity="0.3" x="7" y="17"
                                                                    width="2" height="2" rx="1" />
                                                                <rect fill="#000000" opacity="0.3" x="10" y="17"
                                                                    width="7" height="2" rx="1" />
                                                            </g>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="wizard-label">
                                                    <h3 class="wizard-title">{{ ucfirst($checklistGroup->name) }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="wizard-body py-8 px-8 py-lg-20 px-lg-10">
                                    <div class="row">
                                        <div class="offset-xxl-2 col-xxl-8">
                                            <form class="form new-case-form" id="kt_form" method="POST"
                                                enctype="multipart/form-data">

                                                <input type="hidden" name="_token" id="token"
                                                    value="{{ csrf_token() }}" />
                                                <input type="hidden" id="tracking_id" name="tracking_id"
                                                    value="{{ $guest->tracking_id }}">
                                                @foreach(\App\Models\ChecklistGroup::with('checklists')->get() as
                                                $checklistGroup)
                                                @php
                                                $document = $checklistGroupDocuments[$checklistGroup->id] ?? '';
                                                @endphp
                                                @if((in_array($checklistGroup->id, $newDeficientGroupIds)))
                                                <div class="pb-5" data-wizard-type="step-content"
                                                    data-form='DeficientChecklistDocument'>
                                                    <div class="row mt-4">
                                                        <div class="col-md-12">
                                                            <div
                                                                class="card card-custom gutter-b example example-compact">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">{{ ucfirst($checklistGroup->name) }}</h3>
                                                                </div>
                                                                <div class="card-body">
                                                                    <p>
                                                                        Upload the {{ strtolower($checklistGroup->name) }} as a
                                                                        single PDF file containing the relevant information listed
                                                                        below.
                                                                    </p>
                                                                    <div class="row mt-4">
                                                                        @foreach($checklistGroup->checklists as
                                                                        $checklist)
                                                                            @php
                                                                                $checklist_document =
                                                                                $document->checklists->where('id',
                                                                                $checklist->id)->first()->checklist_document ??
                                                                                NULL;
                                                                                $checklist_document_status =
                                                                                $checklist_document->status ?? NULL;
                                                                                $checked = (in_array($checklist->id,
                                                                                $checklistIds) && $checklist_document_status !==
                                                                                'deficient') ? "checked='true'" : '';
                                                                            @endphp
                                                                            @if((in_array($checklist->id, $checklistIds)))
                                                                                <div
                                                                                    class="col-md-12 @if($checklist_document_status !== 'deficient') hide @endif">
                                                                                    <label class="checkbox mb-4">
                                                                                        <input type="checkbox"
                                                                                            value="{{ $checklist->id }}"
                                                                                            id="checklist_id" {{ $checked }} />
                                                                                        <span></span>
                                                                                        <small>{{ ucfirst($checklist->name) }}
                                                                                        </small>
                                                                                    </label>
                                                                                </div>
                                                                            @endif
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
                                                                            <div class="uploadButton tw-mb-4">
                                                                                <input accept=".doc, .docx, .pdf"
                                                                                    id="checklist_doc"
                                                                                    class="js-file-upload-input ember-view"
                                                                                    type="file"
                                                                                    name="{{ Str::camel($checklistGroup->label) }}_doc"
                                                                                    data-doc-name="checklist_doc_name_{{ $checklistGroup->id}}">
                                                                                <span
                                                                                    class="btn btn--small btn--brand">Upload
                                                                                    File</span>
                                                                            </div>
                                                                        </div>
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
                                                                    </div>
                                                                    <p
                                                                        class="document-uploaded checklist_doc_name_{{ $checklistGroup->id}}">
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @endforeach
                                                <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                                    <div id="upload-img" class="hide">
                                                        <button
                                                            class="btn btn-primary font-weight-bold text-uppercase px-9 py-4"
                                                            disabled><i
                                                                class="fas fa-spinner fa-pulse"></i>&nbsp;Uploading...</button>
                                                    </div>
                                                    <div id="previous-btn" class="mr-2">
                                                        <button
                                                            class="btn btn-light-primary font-weight-bold text-uppercase px-9 py-4"
                                                            data-wizard-type="action-prev">Previous</button>
                                                    </div>
                                                    <div id="save-btns">
                                                        <button id="upload-info"
                                                            class="btn btn-primary font-weight-bold text-uppercase px-9 py-4"
                                                            data-wizard-type="action-submit">Save & Upload Case
                                                            Documents</button>
                                                        <button id="save-info"
                                                            class="btn btn-primary font-weight-bold text-uppercase px-9 py-4"
                                                            data-wizard-type="action-next">Save</button>
                                                        <button id="saving-img"
                                                            class="btn btn-primary font-weight-bold text-uppercase px-9 py-4 hide"
                                                            disabled><i
                                                                class="fas fa-spinner fa-pulse"></i>&nbsp;Saving...</button>
                                                    </div>
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
            @endif
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
@endsection
