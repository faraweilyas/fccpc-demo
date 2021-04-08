@extends('layouts.backend.admin')

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Approval Letter Management</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">Approval Letter Management</a>
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
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="la la-mail-bulk"></i>&nbsp;Approval Letter Workspace</h3>
                            </div>
                            <form method="POST" action="{{ route('cases.send_approval_letter', ['case' => $case, 'template_id' => $template_id]) }}">
                                @csrf
                                <div class="card-body approval_body">
                                    <textarea id="approval_content" name="approval_content" class="form-control" cols="6" rows="20">Your letter to the Federal Competition and Consumer Protection Commission dated {{ $case->getSubmittedAt() }}, on the above subject matter refers.&#10;Based on the information provided, the Commission has reviewed the transaction and is satisfied that the proposed {......} will not substantially affect or lessen competition in the {......} market.&#10;Consequently, the above transaction is hereby Approved.&#10;You are required to promptly inform the Commission of any material change in the information, which formed the basis of this approval.&#10;Please note that the time frame approved for the implementation of the transaction is a period of twelve (12) months from the date of this letter.&#10;In the event that any information supplied by the parties is false, misleading, or inaccurate, the Commission reserves the right to revoke its approval pursuant to Section 99(d) of the Federal Competition and Consumer Protection Act, 2018.</textarea>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-primary mt-4"><i class="la la-send"></i>Send Mail</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="la la-mail-bulk"></i>&nbsp;Approval Letter Preview</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>#{{ $case->guest->tracking_id }}</p>
                                        <p>{{ datetimeToText(now(), 'customd') }}</p>
                                        <p>{{ $case->getApplicantName() }}</p>
                                        <p>{{ $case->applicant_address }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6 class="text-center text-underline"><b>{{ $case->getApprovalLetterTitle($template_id) }}</b></h6>
                                        <h6 class="text-center text-underline"><b>SUBJECT MATTER</b></h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 approval_content">
                                        <p>
                                            Your letter to the Federal Competition and Consumer Protection Commission dated {{ $case->getSubmittedAt() }}, on the above subject matter refers.
                                        </p>
                                        <p>
                                            Based on the information provided, the Commission has reviewed the transaction and is satisfied that the proposed {......} will not substantially affect or lessen competition in the {......} market.
                                        </p>
                                        <p>
                                            Consequently, the above transaction is hereby Approved.
                                        </p>
                                        <p>
                                            You are required to promptly inform the Commission of any material change in the information, which formed the basis of this approval.
                                        </p>
                                        <p>
                                            Please note that the time frame approved for the implementation of the transaction is a period of twelve (12) months from the date of this letter.
                                        </p>
                                        <p>
                                            In the event that any information supplied by the parties is false, misleading, or inaccurate, the Commission reserves the right to revoke its approval pursuant to Section 99(d) of the Federal Competition and Consumer Protection Act, 2018.
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                            {{ $case->getHandlerFullName() }}<br />
                                            {{ $case->getHandlerAccountType() }}<br />
                                            {{ $case->getApprovalLetterOfficer($template_id) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom.javascript')
<script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'template-mgmt.js') }}"></script>>
@endsection
