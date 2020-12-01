@extends('layouts.backend.old.guest')

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-transparent mt-xs-20 mt-sm-18 mt-md-20 mt-lg-0 " id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Application</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ $guest->applicationPath() }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Select transaction category</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 pb-10">
                        <a href="{{ $guest->createApplicationPath('reg') }}">
                            @php
                                $regStyle = $guest->case->selectedCategoryStyle('REG');
                                $ffmStyle = $guest->case->selectedCategoryStyle('FFM');
                                $ffxStyle = $guest->case->selectedCategoryStyle('FFX');
                            @endphp
                            <div class="card card-custom gutter-b card__with__bg {{ $regStyle->bg }}" style="height: 300px">
                                <div class="card-body">
                                    <span class="svg-icon svg-icon-2x {{ $regStyle->svg }}">
                                        <x-icons.file-tag></x-icons.file-tag>
                                    </span>
                                    <span class="svg-icon svg-icon-2x float-right {{ $regStyle->svg }}">
                                        <x-icons.arrow-right></x-icons.arrow-right>
                                    </span>
                                    <div class="font-weight-bolder font-size-h2 mt-3 {{ $regStyle->text }}">Domestic Merger</div>
                                    <span class="font-weight-bold font-size-lg mt-1 {{ $regStyle->textsm }}">
                                        <br />
                                        <small class="text-black">A merger transaction between 2 Nigerian entities or between a Nigerian entity and a Foreign entity. Applications take 60 days</small>
                                    </span>
                                </div>
                            </div>
                        </a>
                        <a
                            href="{{ route('application.checklist-documents', ['guest' => $guest->guest_tracking_id, 'case_category' => 'REG']) }}"
                            class="checklist-list"
                        >
                            View Domestic Merger Document Checklist
                        </a>
                    </div>
                    <div class="col-md-4 pb-10">
                        <a href="{{ $guest->createApplicationPath('ffm') }}">
                            <div class="card card-custom gutter-b card__with__bg {{ $ffmStyle->bg }}" style="height: 300px">
                                <div class="card-body">
                                    <span class="svg-icon svg-icon-2x {{ $ffmStyle->svg }}">
                                        <x-icons.arrow-meet></x-icons.arrow-meet>
                                    </span>
                                    <span class="svg-icon svg-icon-2x float-right {{ $ffmStyle->svg }}">
                                        <x-icons.arrow-right></x-icons.arrow-right>
                                    </span>
                                    <div class="font-weight-bolder font-size-h2 mt-3 {{ $ffmStyle->text }}">Foreign to Foreign Merger</div>
                                    <span class="font-weight-bold font-size-lg mt-1 {{ $ffmStyle->textsm }}">
                                        <br />
                                        <small class="text-black">A transaction between 2 Foreign entities which has a local effect in Nigeria. Application takes 60 days</small>
                                    </span>
                                </div>
                            </div>
                        </a>
                        <a
                            href="{{ route('application.checklist-documents', ['guest' => $guest->guest_tracking_id, 'case_category' => 'FFM']) }}"
                            class="checklist-list"
                        >
                            View Foreign to Foreign Merger Document Checklist
                        </a>
                    </div>
                    <div class="col-md-4 pb-10">
                        <a href="{{ $guest->createApplicationPath('ffx') }}">
                            <div class="card card-custom gutter-b  card__with__bg {{ $ffxStyle->bg }}"
                                style="height: 300px">
                                <div class="card-body">
                                    <span class="svg-icon svg-icon-2x {{ $ffxStyle->svg }}">
                                        <x-icons.arrow-crop></x-icons.arrow-crop>
                                    </span>
                                    <span class="svg-icon svg-icon-2x float-right {{ $ffxStyle->svg }}">
                                        <x-icons.arrow-right></x-icons.arrow-right>
                                    </span>
                                    <div class="font-weight-bolder font-size-h2 mt-3 {{ $ffxStyle->text }}">Expedited Merger</div>
                                    <span class="font-weight-bold font-size-lg mt-1 {{ $ffxStyle->textsm }}">
                                        <br />
                                        <small class="text-black">A transaction between 2 Foreign entities which has a local effect in Nigeria. Application takes 15 days</small>
                                    </span>
                                </div>
                            </div>
                        </a>
                        <a
                            href="{{ route('application.checklist-documents', ['guest' => $guest->guest_tracking_id, 'case_category' => 'FFX']) }}"
                            class="checklist-list"
                        >
                            View Expedited Document Checklist
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card card-custom gutter-b card-stretch">
                            <div class="card-header border-0 pt-5">
                                <div class="card-title">
                                    <div class="card-label">
                                        <div class="font-weight-bolder">Download Form 1</div>
                                        <div class="font-size-sm text-muted mt-2">Notice of Merger & Guidance Notes</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="flex-grow-1 text-center" style="position: relative;">
                                    <a class="" href="{{ route('application.download_form', ['form' => 'form_1.docx']) }}" title="Download Form 1">
                                        <span class="svg-icon svg-icon-primary svg-icon-10x">
                                            <x-icons.download-btn></x-icons.download-btn>
                                        </span>
                                    </a>
                                </div>
                                <div class="mt-10 mb-5">
                                    <p class="download-text">This form should be completed jointly by parties to the proposed transaction. The requested information may be provided in this form or in appendices arranged according to corresponding section numbers in the form. All documents should be bound together.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card card-custom gutter-b card-stretch">
                            <div class="card-header border-0 pt-5">
                                <div class="card-title">
                                    <div class="card-label">
                                        <div class="font-weight-bolder">Download Form 2</div>
                                        <div class="font-size-sm text-muted mt-2">Notice of Merger - Simplified Procedure</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="flex-grow-1 text-center" style="position: relative;">
                                    <a class="" href="{{ route('application.download_form', ['form' => 'form_2.docx']) }}" title="Download Form 2">
                                        <span class="svg-icon svg-icon-primary svg-icon-10x">
                                            <x-icons.download-btn></x-icons.download-btn>
                                        </span>
                                    </a>
                                </div>
                                <div class="mt-10 mb-5">
                                    <p class="download-text">This form should be completed jointly by parties to the proposed transaction. The requested information may be provided in this form or in appendices arranged according to corresponding section numbers in the form. All documents should be bound together.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card card-custom gutter-b card-stretch">
                            <div class="card-header border-0 pt-5">
                                <div class="card-title">
                                    <div class="card-label">
                                        <div class="font-weight-bolder">Download Form 4</div>
                                        <div class="font-size-sm text-muted mt-2">Application for Negative Clearance</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="flex-grow-1 text-center" style="position: relative;">
                                    <a class="" href="{{ route('application.download_form', ['form' => 'form_4.docx']) }}" title="Download Form 1">
                                        <span class="svg-icon svg-icon-primary svg-icon-10x">
                                            <x-icons.download-btn></x-icons.download-btn>
                                        </span>
                                    </a>
                                </div>
                                <div class="mt-10 mb-5">
                                    <p class="download-text">This form should be completed jointly by parties to the proposed transaction. The requested information may be provided in this form or in appendices arranged according to corresponding section numbers in the form. All documents should be bound together.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
