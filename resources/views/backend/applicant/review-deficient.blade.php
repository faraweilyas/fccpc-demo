@extends('layouts.backend.old.guest')

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-transparent mt-xs-20 mt-sm-18 mt-md-20 mt-lg-0" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Notification</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('application.upload', ['guest' => $guest->tracking_id, 'step' => $step]) }}"
                                class="text-muted">Notification</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Review Notification</a>
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
                                    <span
                                        class="svg-icon svg-icon-primary svg-icon-2x cr-pointer"
                                        onclick="window.print()"
                                        title="Print Transaction Summary"
                                    >
                                        <x-icons.print></x-icons.print>
                                        Print
                                    </span>
                                </button>
                            </div>
                        </div>
                        <h3 class="checklist-header">NOTIFICATION SUMMARY</h3>
                        <p class="review-description">
                            {{-- Please review your notification. You will not be able to make any changes once submitted. --}}
                        </p>
                        <p class="section-header">NOTIFICATION INFORMATION</p>
                        <div class="grid-col-2">
                            <div class="grid-row-2 d-flex">
                                <h4 class="info-title">Subject/Title of Transaction:</h4>
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
                        <p class="section-header">FEES</p>
                        <div class="grid-col-2">
                            <div class="grid-row-2 d-flex">
                                <h4 class="info-title">Amount Paid:</h4>
                                <h4>{!! $case->getAmountPaid() !!}</h4>
                            </div>
                        </div>
                        <p class="section-header">DOCUMENTS UPLOADED</p>
                        @foreach(\App\Models\ChecklistGroup::with('checklists')->orderBy('name', 'desc')->get() as $checklistGroup)
                            @if($case->isCaseChecklistsApproved())
                                @if($case->getCategoryKey() == $checklistGroup->category)
                                    @php
                                        $document = \App\Models\Document::where('case_id', $case->id)
                                                    ->where('group_id', $checklistGroup->id)
                                                    ->where('date_case_submitted', null)
                                                    ->first() ?? '';
                                    @endphp
                                    <div class="row">
                                        <div class="col-md-6 my-5" key={item[0]}>
                                            <div class="py-3 px-3">
                                                @if(!empty($document))
                                                    @php
                                                        $file_count = 1;
                                                    @endphp
                                                    @foreach($document->getFileArray() as $key => $file)
                                                        <div class="row">
                                                            <img
                                                                class="cr-pointer"
                                                                src="{{ $document->getFileIconText($file) }}"
                                                                alt="pdf"
                                                                style="height: 40px"
                                                                onclick="window.open('{{ $document->getDocumentLink($file) }}', '_blank');"
                                                            />
                                                            <h4
                                                                class="py-5 mx-5 text-hover-primary cr-pointer"
                                                                onclick="window.open('{{ $document->getDocumentLink($file) }}', '_blank');"
                                                            >
                                                                {{ $document->getDocumentName($file_count) }}
                                                                &nbsp; <i class="la la-download text-primary"></i>
                                                            </h4>
                                                        </div>
                                                        @php
                                                            $file_count++;
                                                        @endphp
                                                    @endforeach
                                                @else
                                                    <div class="row">
                                                        <span class="svg-icon svg-icon-danger svg-icon-4x">
                                                            <x-icons.close-file></x-icons.close-file>
                                                        </span>
                                                        <h4
                                                            class="py-5 mx-5 text-danger w-75"
                                                            title="No document submitted"
                                                        >
                                                            {{ $checklistGroup->name }}
                                                        </h4>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h4 class="info-title info-title-margin">
                                                Additional Information: ({{ $checklistGroup->name }})
                                            </h4>
                                            @if (!empty($document))
                                                <h4 class="info-title-description">{!! $document->getAdditionalInfo() !!}</h4>
                                            @else
                                                <h4 class="info-title-description">...</h4>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @else
                                @if ((in_array($checklistGroup->id, $deficientGroupIds)))
                                    @php
                                        $document = \App\Models\Document::where('case_id', $case->id)
                                                    ->where('group_id', $checklistGroup->id)
                                                    ->where('date_case_submitted', null)
                                                    ->first() ?? '';
                                    @endphp
                                    <div class="row">
                                        <div class="col-md-6 my-5" key={item[0]}>
                                            <div class="py-3 px-3">
                                                @if(!empty($document))
                                                    @php
                                                        $file_count = 1;
                                                    @endphp
                                                    @foreach($document->getFileArray() as $key => $file)
                                                        <div class="row">
                                                            <img
                                                                class="cr-pointer"
                                                                src="{{ $document->getFileIconText($file) }}"
                                                                alt="pdf"
                                                                style="height: 40px"
                                                                onclick="window.open('{{ $document->getDocumentLink($file) }}', '_blank');"
                                                            />
                                                            <h4
                                                                class="py-5 mx-5 text-hover-primary cr-pointer"
                                                                onclick="window.open('{{ $document->getDocumentLink($file) }}', '_blank');"
                                                            >
                                                                {{ $document->getDocumentName($file_count) }}
                                                                &nbsp; <i class="la la-download text-primary"></i>
                                                            </h4>
                                                        </div>
                                                        @php
                                                            $file_count++;
                                                        @endphp
                                                    @endforeach
                                                @else
                                                    <div class="row">
                                                        <span class="svg-icon svg-icon-danger svg-icon-4x">
                                                            <x-icons.close-file></x-icons.close-file>
                                                        </span>
                                                        <h4
                                                            class="py-5 mx-5 text-danger w-75"
                                                            title="No document submitted"
                                                        >
                                                            {{ $checklistGroup->name }}
                                                        </h4>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h4 class="info-title info-title-margin">
                                                Additional Information: ({{ $checklistGroup->name }})
                                            </h4>
                                            @if (!empty($document))
                                                <h4 class="info-title-description">{!! $document->getAdditionalInfo() !!}</h4>
                                            @else
                                                <h4 class="info-title-description">...</h4>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                        <form class="form" id="kt_form">
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />
                            <input type="hidden" id="tracking_id" name="tracking_id" value="{{ $guest->tracking_id }}">
                            <div class="grid-col-2-btn my-20">
                                <button
                                    type="button"
                                    id="goback-btn"
                                    class="btn btn-primary font-weight-bold text-uppercase px-9 py-6"
                                    onclick="window.location.href='{{ route('application.upload', ['guest' => $guest->tracking_id, 'step' => $step]) }}'"
                                >
                                    Go back to edit
                                </button>
                                <button
                                    type="button"
                                    id="upload-deficient-info"
                                    class="btn btn-primary font-weight-bold text-uppercase px-9 py-6"
                                    title="Submit Application" data-wizard-type="action-submit"
                                >
                                    Submit
                                </button>
                                <button
                                    id="upload-img"
                                    type="button"
                                    class="btn btn-primary font-weight-bold text-uppercase px-9 py-6 hide"
                                    disabled
                                >
                                    <div class="spinner-grow text-white" role="status">
                                      <span class="sr-only">Loading...</span>
                                    </div>
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
