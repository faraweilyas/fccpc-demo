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
                            <a href="{{ route('cases.generate_template', ['case' => $case]) }}" class="text-muted">Generate Template</a>
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
                                    @if ($template_id == 1)
                                        <textarea id="approval_content" name="approval_content" class="form-control" cols="6" rows="30">Your letter to the Federal Competition and Consumer Protection Commission dated {{ $case->getSubmittedAt() }}, on the above subject matter refers.&#10;Based on the information provided, the Commission has reviewed the transaction and is satisfied that the proposed {...} will not substantially affect or lessen competition in the {...} market.&#10;Consequently, the above transaction is hereby Approved.&#10;You are required to promptly inform the Commission of any material change in the information, which formed the basis of this approval.&#10;Please note that the time frame approved for the implementation of the transaction is a period of twelve (12) months from the date of this letter.&#10;In the event that any information supplied by the parties is false, misleading, or inaccurate, the Commission reserves the right to revoke its approval pursuant to Section 99(d) of the Federal Competition and Consumer Protection Act, 2018.</textarea>
                                    @elseif($template_id == 2)
                                        <textarea id="approval_content" name="approval_content" class="form-control" cols="6" rows="30">Your submission to the Federal Competition and Consumer Protection Commission dated {{ $case->getSubmittedAt() }}, on the above subject matter refers.&#10;Based on the information provided, the Commission has reviewed the transaction and has noted that the proposed (insert description of transaction) is likely to substantially impede /lessen competition in the market/ sector.&#10;Consequently, the above transaction is hereby approved subject to the following conditions:&#10;1. {...}.&#10;2. {...}.&#10;3. {...}.&#10;You are requested to comply with the above conditions within a period of six (6) or twelve (12) months from the date of this letter. (The time frame will depend on the conditions proposed by the parties).&#10;In the event that the outstanding obligation is not satisfied within a time the Commission considers reasonable, or any information supplied by parties is false, misleading, or inaccurate, the Commission reserves the right to revoke its approval pursuant to Section 99 (d) of the Federal Competition and Consumer Protection Act, 2018.&nbsp;Please note that the time frame approved for the implementation of the transaction is a period of twelve (12) months from the date of this letter.</textarea>
                                    @elseif($template_id == 3)
                                        <textarea id="approval_content" name="approval_content" class="form-control" cols="6" rows="30">Your submission to the Federal Competition and Consumer Protection Commission dated {{ $case->getSubmittedAt() }}, on the above subject matter refers.&#10;Based on the information provided, the Commission has reviewed the transaction and has noted that the proposed (insert description of transaction) raises the following substantial competition concerns.&#10;Consequently, the above transaction is hereby approved subject to the following conditions:&#10;1. {...}.&#10;2. {...}.&#10;3. {...}.&#10;In view of the aforementioned, the commission is unable to approve this transaction. Consequently, parties may make representation to the Commission, proposing remedies that will address the competition concerns; or detailing what technological efficiency or other pro-competitive advantage will be greater than, and offset the competition concerns and which will allow consumers a fair share of the resulting benefits; or stating what substantial public interest grounds may justify the proposed merger  transaction.&#10;Parties may make the above representation within xxxx days of receiving this notification. In the event that the Commission does not receive such representation within the stipulated time frame, it will enter a decision to deny approval of the transaction. Where the Commission receives further representation, it will conduct a second detailed review of the transaction before making its final decision.</textarea>
                                    @endif
                                    <div class="row" style="justify-content: start;">
                                        <div class="col-md-4">
                                            <button class="btn btn-primary mt-4" name="send"><i class="la la-send"></i>Send Mail</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-warning" formtarget="_blank" name="preview"><i class="la la-file"></i>Preview</a>
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
                                        @if ($template_id == 1)
                                            <p>
                                                Your letter to the Federal Competition and Consumer Protection Commission dated {{ $case->getSubmittedAt() }}, on the above subject matter refers.
                                            </p>
                                            <p>
                                                Based on the information provided, the Commission has reviewed the transaction and is satisfied that the proposed {...} will not substantially affect or lessen competition in the {......} market.
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
                                        @elseif($template_id == 2)
                                            <p>
                                                Your submission to the Federal Competition and Consumer Protection Commission dated {{ $case->getSubmittedAt() }}, on the above subject matter refers.
                                            </p>
                                            <p>
                                                Based on the information provided, the Commission has reviewed the transaction and has noted that the proposed (insert description of transaction) is likely to substantially impede /lessen competition in the market/ sector.
                                            </p>
                                            <p>Consequently, the above transaction is hereby approved subject to the following conditions:</p>
                                            <p>1. {...}.</p>
                                            <p>2. {...}.</p>
                                            <p>3. {...}.</p>
                                            <p>
                                                You are requested to comply with the above conditions within a period of six (6) or twelve (12) months from the date of this letter. (The time frame will depend on the conditions proposed by the parties).
                                            </p>
                                            <p>
                                                In the event that the outstanding obligation is not satisfied within a time the Commission considers reasonable, or any information supplied by parties is false, misleading, or inaccurate, the Commission reserves the right to revoke its approval pursuant to Section 99 (d) of the Federal Competition and Consumer Protection Act, 2018.
                                            </p>
                                            <p>
                                                Please note that the time frame approved for the implementation of the transaction is a period of twelve (12) months from the date of this letter.
                                            </p>
                                        @elseif($template_id == 3)
                                            <p>
                                                Your letter to the Federal Competition and Consumer Protection Commission dated {{ $case->getSubmittedAt() }}, on the above subject matter refers.
                                            </p>
                                            <p>
                                                Based on the information provided, the Commission has reviewed the transaction and has noted that the proposed (insert description of transaction) raises the following substantial competition concerns.
                                            </p>
                                            <p>
                                                Consequently, the above transaction is hereby approved subject to the following conditions:
                                            </p>
                                            <p>1. {...}.</p>
                                            <p>2. {...}.</p>
                                            <p>3. {...}.</p>
                                            <p>
                                                In view of the aforementioned, the commission is unable to approve this transaction. Consequently, parties may make representation to the Commission, proposing remedies that will address the competition concerns; or detailing what technological efficiency or other pro-competitive advantage will be greater than, and offset the competition concerns and which will allow consumers a fair share of the resulting benefits; or stating what substantial public interest grounds may justify the proposed merger  transaction.
                                            </p>
                                            <p>
                                                Parties may make the above representation within xxxx days of receiving this notification. In the event that the Commission does not receive such representation within the stipulated time frame, it will enter a decision to deny approval of the transaction. Where the Commission receives further representation, it will conduct a second detailed review of the transaction before making its final decision.
                                            </p>
                                        @endif
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
