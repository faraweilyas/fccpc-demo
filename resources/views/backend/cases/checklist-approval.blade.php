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
                        <a href="{{ route('cases.analyze', ['case' => $case->id]) }}" class="text-muted">Analyze
                            Case</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('cases.analyze-documents', ['case' => $case->id]) }}"
                            class="text-muted">Checklist Documents</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Checklist Approval</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-custom">
                @php $x = 1 @endphp
                @foreach(\App\Models\ChecklistGroup::with('checklists')->get() as $checklistGroup)
                @php
                $document = $checklistGroupDocuments[$checklistGroup->id] ?? '';
                @endphp
                @if($document !== '')
                <div class="row my-3 py-5 hide" id="step-{{ $x }}">
                    <h5 class="text-bold w-50">

                        {{ $checklistGroup->name }}
                        <div class="pull-button-right">
                            <button class="btn btn-danger-pale-ts no-border mx-lg-5" data-toggle="modal"
                                data-target="#Issue">
                                Issue a Deficiency Notice
                            </button>

                            <button class="btn btn-success no-border"
                                onclick="window.location.href = '{{ route('applicant.document.download', ['document' => $document->id]) }}';">
                                Download Checklist Document
                            </button>
                        </div>
                    </h5>

                    <br>
                    <br>
                    <br>
                    <div class="row">
                        @foreach($checklistGroup->checklists as $checklist)
                        @php
                        $checked = (in_array($checklist->id, $checklistIds)) ? "consent-card-active" : '';
                        $checklist_document = $document->checklists->where('id',
                        $checklist->id)->first()->checklist_document ?? NULL;
                        $checklist_document_status = $checklist_document->status ?? NULL;
                        @endphp
                        <div class="col-lg-6">
                            <div class="consent-card {{ $checked }}">
                                <div class="d-flex">
                                    <div class="form-check" style="padding: 0px">
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input class="form-check-input save_approval" type="radio"
                                                    name="exampleRadios{{ $checklist->id }}" value="approved"
                                                    @if($checklist_document_status=='approved' ) checked="checked"
                                                    @endif data-document-id="{{ $document->id }}"
                                                    data-checklist-id="{{ $checklist->id }}" @empty($checked) disabled
                                                    @endif>
                                                <span></span>
                                                Approve
                                            </label>
                                            <label class="radio">
                                                <input class="form-check-input save_approval" type="radio"
                                                    name="exampleRadios{{ $checklist->id }}" value="deficient"
                                                    @if($checklist_document_status=='deficient' ) checked="checked"
                                                    @endif data-document-id="{{ $document->id }}"
                                                    data-checklist-id="{{ $checklist->id }}" @empty($checked) disabled
                                                    @endif>
                                                <span></span>
                                                Deficient
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="check_name" value="{{ $checklistGroup->name }}">
                                <p>
                                    {{ ucfirst($checklist->name) }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @php $x++ @endphp
                @endif
                <input class="checklist_group_count" type="hidden" value="{{ $x - 1 }}">
                @endforeach
                <div class="btn-group">
                    <button class="btn btn-success-pale-ts no-border mx-1" id="prev">
                        Previous
                    </button>
                    <button class="btn btn-success-pale-ts no-border mx-1 px-5" id="next">
                        Next 
                    </button>

                    <button class="btn btn-success no-border mx-5 px-8 py-3 hide" id="approve">
                        Approve Complete Documents in the Checklist
                    </button>
                </div>


            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Issue" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Request New Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form method="POST" action="#">
                @csrf
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">

                            <br />
                            <select class=" select2" multiple="multiple" id="add_more" name="caseHandler" style="width: 100%;">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                    </div>

                    <div class="py-5">
                        <br>
                        <br>

                        <p class="alert-custom ">
                            Extract of Board Resolutions of the Merging Companies duly certified by a Director
                            and the Company Secretary. (.pdf/.docx)
                        </p>

                        <p class="alert-custom">
                            Evidence of increase in Authorized Share Capital (where necessary)
                        </p>

                        <button class="btn btn-success btn-sm px-4 align-self-center ">Send
                            Request</button>

                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="caseID">
                    <button type="button" class="btn btn-light-danger font-weight-bold"
                        data-dismiss="modal">Close</button>

                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('custom.css')
<link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'reports.css') }}" />
@endsection


@section('custom.javascript')
<script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'checklist_approval.js') }}"></script>
<script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/select2/js/select2.min.js') }}"></script>



<script>
    $(document).ready(function () {
        $('#add_more').select2();

    })

</script>
@endsection
