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

        .approval_address
        {
            font-weight: 600;
            line-height: 1.7;
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
        <h3 class='head'><br /><b>{{ $case->getApprovalLetterTitle($template) }}</b></h3>
        <h3 class="text-left text-underline"><b>{{ $header }}</b></h3>
        <br />
        <h3 class="text-left approval_address">{!! nl2br(cleanTextArea($address)) !!}</h3>
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
