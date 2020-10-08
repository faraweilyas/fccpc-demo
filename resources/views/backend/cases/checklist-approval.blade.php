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
                    <li class="breadcrumb-item">
                        <a href="{{ route('cases.analyze-documents', ['case' => $case->id]) }}"
                            class="text-muted">Analyze Case</a>
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
                <h5 class="text-bold">
                    Consent and resolution documents
                    <button class="btn btn-danger-pale-ts no-border mx-5">
                        Issue a Deficiency Notice
                    </button>
                    {{-- <button class="btn btn-success-ts no-border mx-5">
                        Request Absent Document
                    </button> --}}
                    <button class="btn btn-success no-border">
                        Download Checklist Document
                    </button>
                </h5>

                <div class="row my-3 py-5" id="step-1">
                    <div class="consent-content">
                        <div class="consent-card">
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value=""
                                        checked="true" />
                                    <label class="form-check-label margin-t">
                                        Approved
                                    </label>
                                </div>
                                <div class="form-check mx-5">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="" />
                                    <label class="form-check-label margin-t">
                                        Deficient
                                    </label>
                                </div>
                            </div>

                            <p>
                                Extract of Board Resolutions of the Merging
                                Companies duly certified by a Director and the
                                Company Secretary
                            </p>
                        </div>

                        <div class="consent-card">
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value=""
                                        checked="true" />
                                    <label class="form-check-label margin-t">
                                        Approved
                                    </label>
                                </div>
                                <div class="form-check mx-5">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="" />
                                    <label class="form-check-label margin-t">
                                        Deficient
                                    </label>
                                </div>
                            </div>

                            <p>
                                Extract of Board Resolutions of the Merging
                                Companies duly certified by a Director and the
                                Company Secretary
                            </p>
                        </div>
                    </div>
                    <div class="consent-content">
                        <div class="consent-card">
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value=""
                                        checked="true" />
                                    <label class="form-check-label margin-t">
                                        Approved
                                    </label>
                                </div>
                                <div class="form-check mx-5">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="" />
                                    <label class="form-check-label margin-t">
                                        Deficient
                                    </label>
                                </div>
                            </div>

                            <p>
                                Extract of Board Resolutions of the Merging
                                Companies duly certified by a Director and the
                                Company Secretary
                            </p>
                        </div>

                        <div class="consent-card">
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value=""
                                        checked="true" />
                                    <label class="form-check-label margin-t">
                                        Approved
                                    </label>
                                </div>
                                <div class="form-check mx-5">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="" />
                                    <label class="form-check-label margin-t">
                                        Deficient
                                    </label>
                                </div>
                            </div>

                            <p>
                                Extract of Board Resolutions of the Merging
                                Companies duly certified by a Director and the
                                Company Secretary
                            </p>
                        </div>
                    </div>
                    <div class="consent-content">
                        <div class="consent-card">
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value=""
                                        checked="true" />
                                    <label class="form-check-label margin-t">
                                        Approved
                                    </label>
                                </div>
                                <div class="form-check mx-5">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="" />
                                    <label class="form-check-label margin-t">
                                        Deficient
                                    </label>
                                </div>
                            </div>

                            <p>
                                Extract of Board Resolutions of the Merging
                                Companies duly certified by a Director and the
                                Company Secretary
                            </p>
                        </div>

                        <div class="consent-card">
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value=""
                                        checked="true" />
                                    <label class="form-check-label margin-t">
                                        Approved
                                    </label>
                                </div>
                                <div class="form-check mx-5">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="" />
                                    <label class="form-check-label margin-t">
                                        Deficient
                                    </label>
                                </div>
                            </div>

                            <p>
                                Extract of Board Resolutions of the Merging
                                Companies duly certified by a Director and the
                                Company Secretary
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row my-3 py-5 hide" id="step-2">
                    <h2>Step 2</h2>
                    <div class="consent-content">
                        <div class="consent-card">
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value=""
                                        checked="true" />
                                    <label class="form-check-label margin-t">
                                        Approved
                                    </label>
                                </div>
                                <div class="form-check mx-5">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="" />
                                    <label class="form-check-label margin-t">
                                        Deficient
                                    </label>
                                </div>
                            </div>

                            <p>
                                Extract of Board Resolutions of the Merging
                                Companies duly certified by a Director and the
                                Company Secretary
                            </p>
                        </div>

                        <div class="consent-card">
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value=""
                                        checked="true" />
                                    <label class="form-check-label margin-t">
                                        Approved
                                    </label>
                                </div>
                                <div class="form-check mx-5">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="" />
                                    <label class="form-check-label margin-t">
                                        Deficient
                                    </label>
                                </div>
                            </div>

                            <p>
                                Extract of Board Resolutions of the Merging
                                Companies duly certified by a Director and the
                                Company Secretary
                            </p>
                        </div>
                    </div>
                    <div class="consent-content">
                        <div class="consent-card">
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value=""
                                        checked="true" />
                                    <label class="form-check-label margin-t">
                                        Approved
                                    </label>
                                </div>
                                <div class="form-check mx-5">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="" />
                                    <label class="form-check-label margin-t">
                                        Deficient
                                    </label>
                                </div>
                            </div>

                            <p>
                                Extract of Board Resolutions of the Merging
                                Companies duly certified by a Director and the
                                Company Secretary
                            </p>
                        </div>

                        <div class="consent-card">
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value=""
                                        checked="true" />
                                    <label class="form-check-label margin-t">
                                        Approved
                                    </label>
                                </div>
                                <div class="form-check mx-5">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="" />
                                    <label class="form-check-label margin-t">
                                        Deficient
                                    </label>
                                </div>
                            </div>

                            <p>
                                Extract of Board Resolutions of the Merging
                                Companies duly certified by a Director and the
                                Company Secretary
                            </p>
                        </div>
                    </div>
                    <div class="consent-content">
                        <div class="consent-card">
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value=""
                                        checked="true" />
                                    <label class="form-check-label margin-t">
                                        Approved
                                    </label>
                                </div>
                                <div class="form-check mx-5">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="" />
                                    <label class="form-check-label margin-t">
                                        Deficient
                                    </label>
                                </div>
                            </div>

                            <p>
                                Extract of Board Resolutions of the Merging
                                Companies duly certified by a Director and the
                                Company Secretary
                            </p>
                        </div>

                        <div class="consent-card">
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value=""
                                        checked="true" />
                                    <label class="form-check-label margin-t">
                                        Approved
                                    </label>
                                </div>
                                <div class="form-check mx-5">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="" />
                                    <label class="form-check-label margin-t">
                                        Deficient
                                    </label>
                                </div>
                            </div>

                            <p>
                                Extract of Board Resolutions of the Merging
                                Companies duly certified by a Director and the
                                Company Secretary
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row my-3 py-5 hide" id="step-3">
                    <h2>Step 3</h2>
                    <div class="consent-content">
                        <div class="consent-card">
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value=""
                                        checked="true" />
                                    <label class="form-check-label margin-t">
                                        Approved
                                    </label>
                                </div>
                                <div class="form-check mx-5">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="" />
                                    <label class="form-check-label margin-t">
                                        Deficient
                                    </label>
                                </div>
                            </div>

                            <p>
                                Extract of Board Resolutions of the Merging
                                Companies duly certified by a Director and the
                                Company Secretary
                            </p>
                        </div>

                        <div class="consent-card">
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value=""
                                        checked="true" />
                                    <label class="form-check-label margin-t">
                                        Approved
                                    </label>
                                </div>
                                <div class="form-check mx-5">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="" />
                                    <label class="form-check-label margin-t">
                                        Deficient
                                    </label>
                                </div>
                            </div>

                            <p>
                                Extract of Board Resolutions of the Merging
                                Companies duly certified by a Director and the
                                Company Secretary
                            </p>
                        </div>
                    </div>
                    <div class="consent-content">
                        <div class="consent-card">
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value=""
                                        checked="true" />
                                    <label class="form-check-label margin-t">
                                        Approved
                                    </label>
                                </div>
                                <div class="form-check mx-5">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="" />
                                    <label class="form-check-label margin-t">
                                        Deficient
                                    </label>
                                </div>
                            </div>

                            <p>
                                Extract of Board Resolutions of the Merging
                                Companies duly certified by a Director and the
                                Company Secretary
                            </p>
                        </div>

                        <div class="consent-card">
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value=""
                                        checked="true" />
                                    <label class="form-check-label margin-t">
                                        Approved
                                    </label>
                                </div>
                                <div class="form-check mx-5">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="" />
                                    <label class="form-check-label margin-t">
                                        Deficient
                                    </label>
                                </div>
                            </div>

                            <p>
                                Extract of Board Resolutions of the Merging
                                Companies duly certified by a Director and the
                                Company Secretary
                            </p>
                        </div>
                    </div>
                    <div class="consent-content">
                        <div class="consent-card">
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value=""
                                        checked="true" />
                                    <label class="form-check-label margin-t">
                                        Approved
                                    </label>
                                </div>
                                <div class="form-check mx-5">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="" />
                                    <label class="form-check-label margin-t">
                                        Deficient
                                    </label>
                                </div>
                            </div>

                            <p>
                                Extract of Board Resolutions of the Merging
                                Companies duly certified by a Director and the
                                Company Secretary
                            </p>
                        </div>

                        <div class="consent-card">
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value=""
                                        checked="true" />
                                    <label class="form-check-label margin-t">
                                        Approved
                                    </label>
                                </div>
                                <div class="form-check mx-5">
                                    <input class="form-check-input" type="radio" name="exampleRadios" value="" />
                                    <label class="form-check-label margin-t">
                                        Deficient
                                    </label>
                                </div>
                            </div>

                            <p>
                                Extract of Board Resolutions of the Merging
                                Companies duly certified by a Director and the
                                Company Secretary
                            </p>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-center align-center align-items-center align-self-end">
                    <button class="btn btn-success-pale-ts no-border mx-5" id="prev">
                        Previous
                    </button>
                    <button class="btn btn-success-pale-ts no-border mx-5" id="next">
                        Save & Contiune
                    </button>

                    <button class="btn btn-success no-border mx-5">
                        Approve Complete Documents in the Checklist
                    </button>
                </div>


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

    $(document).ready(function () {
        $('#prev').click(function () {
            if (counter > 1) {
                counter--;
                $('[id^=step]').hide();
                $(`#step-${counter}`).show();
                console.log(counter);
            } else {
                counter = 1;
                $('[id^=step]').hide();
                $(`#step-${counter}`).show();
                console.log(counter);
                return false;
            }

        })
        $('#next').click(function () {
            counter++;
            $('[id^=step]').hide();
            $(`#step-${counter}`).show();
            console.log(counter);

        })



    })

</script>
@endsection
