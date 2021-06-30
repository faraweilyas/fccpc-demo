<!DOCTYPE html>
<html>
<head>
    <title>Approval Letter</title>
    <style type="text/css">
        body {
            color: #222222;
            font-family: Segoe UI Regular;
            font-size: 14px;
            line-height: 150%;
        }

        .title h3 {
            font-weight: bold;
            text-decoration: underline;
        }

        .title h3.head {
            text-align: center;
        }

        .content b
        {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div>
        <p>{{ datetimeToText(now(), 'customd') }}</p>
        <p>{{ $case->getApplicantName() }}</p>
        <p>{!! nl2br($case->applicant_address) !!}</p>
    </div>
    <div class="title">
        <h3 class='head'><b>{{ $case->getApprovalLetterTitle($template) }}</b></h3>
        <h3 class="text-left text-underline"><b>RE: {{ $case->subject }}</b></h3>
        <br />
        <h3 class="text-left"><b>ACQUIRER(S): {{ $case->getCasePartiesText() }}</b></h3>
        <h3 class="text-left"><b>TARGET(S): {{ '...' }}</b></h3>
        <h3 class="text-left"><b>CASE ID: #{{ $case->guest->tracking_id }}</b></h3>
        <br />
    </div>
    <div class="content">
        {!! nl2br(cleanTextArea($content)) !!}
        {{-- {!! str_replace("<br />", '<br /><br />', nl2br(cleanTextArea($content))) !!} --}}
    </div>
    {{-- <div>
        <p>
            {{ $case->getHandlerFullName() }}<br />
            {{ $case->getHandlerAccountType() }}<br />
            {{ $case->getApprovalLetterOfficer($template) }}
        </p>
    </div> --}}
</body>
</html>
