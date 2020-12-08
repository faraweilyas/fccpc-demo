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
                                            src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgaGVpZ2h0PSIxMTdweCIgdmVyc2lvbj0iMS4xIiB2aWV3Qm94PSIwIDAgMTE3IDExNyIgd2lkdGg9IjExN3B4IiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj48dGl0bGUvPjxkZXNjLz48ZGVmcy8+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIiBpZD0iUGFnZS0xIiBzdHJva2U9Im5vbmUiIHN0cm9rZS13aWR0aD0iMSI+PGcgZmlsbC1ydWxlPSJub256ZXJvIiBpZD0iY29ycmVjdCI+PHBhdGggZD0iTTM0LjUsNTUuMSBDMzIuOSw1My41IDMwLjMsNTMuNSAyOC43LDU1LjEgQzI3LjEsNTYuNyAyNy4xLDU5LjMgMjguNyw2MC45IEw0Ny42LDc5LjggQzQ4LjQsODAuNiA0OS40LDgxIDUwLjUsODEgQzUwLjYsODEgNTAuNiw4MSA1MC43LDgxIEM1MS44LDgwLjkgNTIuOSw4MC40IDUzLjcsNzkuNSBMMTAxLDIyLjggQzEwMi40LDIxLjEgMTAyLjIsMTguNSAxMDAuNSwxNyBDOTguOCwxNS42IDk2LjIsMTUuOCA5NC43LDE3LjUgTDUwLjIsNzAuOCBMMzQuNSw1NS4xIFoiIGZpbGw9IiMxN0FCMTMiIGlkPSJTaGFwZSIvPjxwYXRoIGQ9Ik04OS4xLDkuMyBDNjYuMSwtNS4xIDM2LjYsLTEuNyAxNy40LDE3LjUgQy01LjIsNDAuMSAtNS4yLDc3IDE3LjQsOTkuNiBDMjguNywxMTAuOSA0My42LDExNi42IDU4LjQsMTE2LjYgQzczLjIsMTE2LjYgODguMSwxMTAuOSA5OS40LDk5LjYgQzExOC43LDgwLjMgMTIyLDUwLjcgMTA3LjUsMjcuNyBDMTA2LjMsMjUuOCAxMDMuOCwyNS4yIDEwMS45LDI2LjQgQzEwMCwyNy42IDk5LjQsMzAuMSAxMDAuNiwzMiBDMTEzLjEsNTEuOCAxMTAuMiw3Ny4yIDkzLjYsOTMuOCBDNzQuMiwxMTMuMiA0Mi41LDExMy4yIDIzLjEsOTMuOCBDMy43LDc0LjQgMy43LDQyLjcgMjMuMSwyMy4zIEMzOS43LDYuOCA2NSwzLjkgODQuOCwxNi4yIEM4Ni43LDE3LjQgODkuMiwxNi44IDkwLjQsMTQuOSBDOTEuNiwxMyA5MSwxMC41IDg5LjEsOS4zIFoiIGZpbGw9IiM0QTRBNEEiIGlkPSJTaGFwZSIvPjwvZz48L2c+PC9zdmc+"
                                        />
                                    </div>
                                </div>
                                <div class="row mt-6">
                                    <div class="col-md-12 text-center">
                                        <p>
                                            <strong>Your application <b>{{ $guest->getTrackingID() }}</b> is still being reviewed.</strong>
                                        </p>
                                        <p>
                                            <strong>Our representative would get back to you.</strong>
                                        </p>
                                        <a
                                            href="{{ $guest->applicantPath() }}"
                                            class="btn btn-primary font-weight-bold text-uppercase mr-5 px-9 py-4"
                                        >
                                            Create a New Application
                                        </a>
                                        <a
                                            data-turbolinks="false"
                                            href="/"
                                            class="btn btn-secondary font-weight-bold text-uppercase mr-5 px-9 py-4"
                                        >
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
                                <h3 class="card-title">Upload Deficient Document</h3>
                                 <button
                                    id="review-deficient"
                                    data-id="{{ $guest->tracking_id }}"
                                    class="btn btn-primary font-weight-bold text-uppercase px-9 my-3 float-right mr__10">
                                        Review Application
                                </button>
                            </div>
                            <div class="card-body p-0">
                                <div
                                    class="wizard wizard-2"
                                    id="kt_wizard_v2"
                                    data-wizard-state="step-first"
                                    data-wizard-clickable="true"
                                >
                                    <div class="wizard-nav border-right py-8 px-8 py-lg-20 px-lg-10">
                                        <div class="wizard-steps">
                                            @foreach(\App\Models\ChecklistGroup::all() as $checklistGroup)
                                                @if ((in_array($checklistGroup->id, $deficientGroupIds)))
                                                    <div class="wizard-step" data-wizard-type="step">
                                                        <div class="wizard-wrapper">
                                                            <div class="wizard-icon">
                                                                <x-icons.text-document></x-icons.text-document>
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
                                                <form class="form new-case-form" id="kt_form" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />
                                                    <input
                                                        type="hidden"
                                                        id="tracking_id"
                                                        name="tracking_id"
                                                        value="{{ $guest->tracking_id }}"
                                                    />

                                                    @foreach(\App\Models\ChecklistGroup::with('checklists')->get() as $checklistGroup)
                                                        @if ((in_array($checklistGroup->id, $deficientGroupIds)))
                                                            @php
                                                                $document = $unSubmittedDocuments[$checklistGroup->id] ?? '';
                                                                $documentChecklists = (!empty($document)) ? $document->checklists->pluck('id')->toArray() : [];
                                                            @endphp
                                                            <div class="pb-5" data-wizard-type="step-content" data-form='DeficientChecklistDocument'>
                                                                <div class="row mt-4">
                                                                    <div class="col-md-12">
                                                                        <div class="card card-custom gutter-b example example-compact">
                                                                            <div class="card-header">
                                                                                <h3 class="card-title">{{ ucfirst($checklistGroup->name) }}</h3>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <p>
                                                                                    Upload the {{ strtolower($checklistGroup->name) }} as a single PDF file containing the relevant information listed below.
                                                                                </p>
                                                                                <div class="row mt-4">
                                                                                    @foreach($checklistGroup->checklists as $checklist)
                                                                                        @php
                                                                                            $checked = (in_array($checklist->id, $documentChecklists)) ? "checked='checked'" : '';
                                                                                        @endphp
                                                                                        @if ((in_array($checklist->id, $checklistIds)))
                                                                                            <div class="col-md-12">
                                                                                                <label class="checkbox mb-4">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        value="{{ $checklist->id }}"
                                                                                                        id="checklist_id"
                                                                                                        {{ $checked }}
                                                                                                    />
                                                                                                    <span></span>
                                                                                                    <small>
                                                                                                        {{ ucfirst($checklist->name) }}
                                                                                                    </small>
                                                                                                </label>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </div>
                                                                                <div class="row">
                                                                                    @if ($checklistGroup->isGroupFees())
                                                                                        <div class="col-md-6 mb-4 ml-8">
                                                                                            <input
                                                                                                type="text"
                                                                                                class="form-control amount_paid"
                                                                                                name="amount_paid"
                                                                                                value="{{ $case->amount_paid }}"
                                                                                                placeholder="Enter Amount Paid:"
                                                                                                id="amount_paid"
                                                                                            />
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="row mt-4">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group mb-1">
                                                                                            <textarea class="form-control" id="additional_info" rows="6" name="{{ Str::camel($checklistGroup->label) }}_additional_info" placeholder="Additional Information...">{{ $document->additional_info ?? '' }}</textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row mt-4">
                                                                                    <div class="col-md-3">
                                                                                        <div class="uploadButton tw-mb-4">
                                                                                            <input
                                                                                                accept=".pdf"
                                                                                                id="checklist_doc"
                                                                                                class="js-file-upload-input ember-view"
                                                                                                type="file"
                                                                                                name="{{ Str::camel($checklistGroup->label) }}_doc"
                                                                                                data-doc-name="checklist_doc_name_{{ $checklistGroup->id}}"
                                                                                            />
                                                                                            <span class="btn btn--small btn--brand">
                                                                                                Upload File
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                    @if (!empty($document))
                                                                                        <div class="col-md-3 my-1">
                                                                                            <span>
                                                                                                <img onclick="window.location.href='{{ route('applicant.document.download', ['document' => $document->id]) }}';"
                                                                                                    class="max-h-30px mr-3 doc-cursor-pointer"
                                                                                                    src="{{ $document->getIconText() }}"
                                                                                                    title="Download Document"
                                                                                                />
                                                                                            </span>
                                                                                        </div>
                                                                                    @endif
                                                                                    <input
                                                                                        type="hidden"
                                                                                        id="uploaded_doc"
                                                                                        value="{{ !empty($document) ? $document->file : '' }}"
                                                                                    />
                                                                                    <input
                                                                                        type="hidden"
                                                                                        id="checklist_doc_name"
                                                                                        value="{{ strtolower($checklist->name) }}"
                                                                                    />
                                                                                    <input
                                                                                        type="hidden"
                                                                                        id="doc_id"
                                                                                        value="{{ !empty($document) ? $document->id : '' }}"
                                                                                    />
                                                                                    <input
                                                                                        type="hidden"
                                                                                        id="group_id"
                                                                                        value="{{ $checklistGroup->id }}"
                                                                                    />
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
                                                                disabled
                                                            >
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
                                                                id="save-deficient-doc"
                                                                class="btn btn-primary font-weight-bold text-uppercase px-9 py-4"
                                                                data-wizard-type="action-submit"
                                                                data-review-route="/application/applicant/{{ $guest->tracking_id }}/review-deficient/1"
                                                            >
                                                                Save & Review
                                                            </button>
                                                            <button
                                                                id="save-info"
                                                                class="btn btn-primary font-weight-bold text-uppercase px-9 py-4"
                                                                data-wizard-type="action-next"
                                                            >
                                                                Save
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
