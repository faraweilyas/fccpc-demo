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
                            <button class="btn btn-danger-pale-ts no-border mx-lg-5"    data-toggle="modal"
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
                        @php $checklist_count = 1 @endphp
                        @foreach($checklistGroup->checklists as $checklist)
                        @php
                        $checked = (in_array($checklist->id, $checklistIds)) ? "consent-card-active" : '';
                        @endphp
                        <div class="col-lg-6">
                            <div class="consent-card {{ $checked }}">
                                <div class="d-flex">
                                    <div class="form-check" style="padding: 0px">
                                        {{-- <input class="form-check-input" type="radio" name="exampleRadios" value="active" checked="true"  />
                                        <label class="form-check-label margin-t">
                                            Approve
                                        </label> --}}
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input class="form-check-input" type="radio"
                                                    name="exampleRadios{{ $checklist_count }}" value="approve">
                                                <span></span>
                                                Approve
                                            </label>
                                            <label class="radio">
                                                <input class="form-check-input" type="radio"
                                                    name="exampleRadios{{ $checklist_count }}" value="deficient">
                                                <span></span>
                                                Deficient
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <p>
                                    {{ ucfirst($checklist->name) }}
                                </p>
                            </div>
                        </div>
                        @php $checklist_count++ @endphp
                        @endforeach
                    </div>
                </div>
                @php $x++ @endphp
                @endif
                <input class="checklist_group_count" type="hidden" value="{{ $x }}">
                @endforeach
                <div class="d-flex justify-center align-center align-items-center align-self-end">
                    <button class="btn btn-success-pale-ts no-border mx-5 px-8 py-3" id="prev">
                        Previous
                    </button>
                    <button class="btn btn-success-pale-ts no-border mx-5 px-8 py-3" id="next">
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


<div class="modal fade" id="Issue" data-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Issue a Deficiency Notice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

        </div>
    </div>
</div>

@endsection

@section('custom.css')
<link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'reports.css') }}" />
@endsection


@section('custom.javascript')

<script>
    var counter = 1;
    var arr_lenght = $(".checklist_group_count").val();

    $(document).ready(function () {
        $('#step-1').show();
        $('#prev').hide();




        $('#prev').click(function () {
            if (counter > 1) {
                $('#next').show();
                $('#approve').hide();
                counter--;
                $('[id^=step]').hide();
                $(`#step-${counter}`).show();
                $(window).scrollTop(0);
            } else {
                $('#next').show();
                $('#approve').hide();
                counter = 1;
                $('[id^=step]').hide();
                $(`#step-${counter}`).show();
                $(window).scrollTop(0);
                return false;
            }


            if (counter === 1) {
                $('#prev').hide();

            }

        })
        $('#next').click(function () {



            if (counter < arr_lenght) {
                $('#prev').show();

                counter++;
                $('[id^=step]').hide();
                $(`#step-${counter}`).show();
                $(window).scrollTop(0);

            }

            if (parseInt(counter) === parseInt(arr_lenght)) {
                $('#next').hide();

                $('#approve').show();
            }


        })



    })

</script>
@endsection
