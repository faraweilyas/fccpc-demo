@extends('layouts.backend.admin')

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Case Analysis</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                        </li>
                        @if(in_array(\Auth::user()->account_type, ['SP']))
                            <li class="breadcrumb-item">
                                <a href="{{ route('cases.unassigned') }}" class="text-muted">New Cases</a>
                            </li>
                        @endif
                        <li class="breadcrumb-item">
                            <a href="{{ route('cases.assigned') }}" class="text-muted">Assigned Cases</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a
                                href="{{ route('cases.analyze', ['case' => $case->id]) }}"
                                class="text-muted"
                            >
                                Analyze Case
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">Checklist Documents</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @if (count($checklistGroupDocuments) > 0)
        <div class="conatiner-fl px-5 py-5 ">
            <div class="card-custom relative">
                <h5 class="text-bold mb-10">Submitted Documents</h5>
                <div class="accordion accordion-solid accordion-toggle-plus mt-10" id="accordionExample">
                    @php
                        $cases = \Auth::user()->cases_working_on()->where('case_id', $case->id)->get();
                        $submittedDocuments = $case->submittedDocumentsComplete($case->case_category);
                        $x = 1;
                    @endphp
                    @foreach ($submittedDocuments as $date => $documents)
                        <div class="card">
                            <div class="card-header" id="headingOne{{ $x }}">
                                <div
                                    class="card-title @if($x !== 1) collapsed @endif"
                                    data-toggle="collapse"
                                    data-target="#collapseOne{{ $x }}"
                                >
                                    <i class="flaticon-folder-1"></i>Date: {{ datetimeToText($date, '%d %B. %Y at %I:%M %p') }}
                                </div>
                            </div>
                            <div id="collapseOne{{ $x }}" class="collapse @if($x == 1) show @endif" data-parent="#accordionExample">
                                <div class="card-body">
                                    @if (!$case->isCaseChecklistsApproved())
                                        <div class="row justify-content-end">
                                            @if ($cases->count() > 0)
                                                @if ($x == 1)
                                                    @if(!$case->isCaseOnHold())
                                                        <button
                                                            class="btn btn-success-transparent-timestamp btn-sm px-3 mx-5 float-right my-5"
                                                            onclick="window.location.href = '{{ route('cases.checklist-approval', ['case' => $case->id, 'date' => $date]) }}';"
                                                        >
                                                            Continue Document Approval
                                                        </button>
                                                    @endif
                                                @endif
                                            @else
                                                @if ($x == 1)
                                                    @if ($case->active_handlers->count() <= 0)
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="alert alert-primary alert-warning fade show lightish-yellow lightish-yellow-border" role="alert">
                                                                    <div class="alert-text text-dark">
                                                                        <i class="la la-info-circle text-dark"></i>&nbsp;Please assign a case handler to continue document approval!
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <button
                                                            class="btn btn-success-transparent-timestamp btn-sm px-3 mx-5 start_doc_approval float-right my-5"
                                                            data-link="{{ route('cases.checklist-approval', ['case' => $case->id, 'date' => $date]) }}"
                                                            data-workingon-link="{{ route('cases.update_working_on', [$case->id, $case->active_handlers[0]->id]) }}"
                                                        >
                                                            Start Document Approval
                                                        </button>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                    @endif
                                    <div class="row">
                                        @foreach ($documents as $document)
                                            @if (!empty($document->group_id))
                                                <div class="col-md-4 ">
                                                    <div class="download-card">
                                                        <img src="{{ pc_asset(BE_IMAGE.'png/pdf.png') }}" alt="pdf" />
                                                        <p><b>{{ $document->group->name }} documents</b></p>
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
                                                                            {{ ucfirst($document->group->name).' Form '.$file_count }}
                                                                        </a>&nbsp;<i class="la la-download text-primary"></i>
                                                                    </span>
                                                                </div>
                                                                @php
                                                                    $file_count++;
                                                                @endphp
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            $x++;
                        @endphp
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <img class="mw-40" src="{{ pc_asset(BE_IMAGE.'/png/close.png') }}">
                                </div>
                            </div>
                            <div class="row mt-6">
                                <div class="col-md-12 text-center">
                                    <p>
                                        <strong>No document was submitted.</strong>
                                    </p>
                                    <a href="#" class="btn btn-danger font-weight-bold text-uppercase mr-5 px-9 py-4">
                                        Issue a deficiency
                                    </a>
                                    <a
                                        data-turbolinks="false"
                                        href="{{ route('cases.analyze', ['case' => $case->id]) }}"
                                        class="btn btn-secondary font-weight-bold text-uppercase mr-5 px-9 py-4"
                                    >
                                        Go back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('custom.css')
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'reports.css') }}" />
@endsection
