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
            text-align: center;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div>
        <p>#{{ $case->guest->tracking_id }}</p>
        <p>{{ datetimeToText(now(), 'customd') }}</p>
        <p>{{ $case->getApplicantName() }}</p>
        <p>{{ $case->applicant_address }}</p>
    </div>
    <div class="title">
        <h3><b>{{ $case->getApprovalLetterTitle($template_id) }}</b></h3>
        <h3><b>SUBJECT MATTER</b></h3>
    </div>
    <div class="content">
        {!! str_replace("<br />", '<br /><br />', nl2br(cleanTextArea($content))) !!}
    </div>
    <div>
        <p>
            {{ $case->getHandlerFullName() }}<br />
            {{ $case->getHandlerAccountType() }}<br />
            {{ $case->getApprovalLetterOfficer($template_id) }}
        </p>
    </div>
</body>
</html>
