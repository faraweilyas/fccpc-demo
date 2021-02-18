<!DOCTYPE html>
<html>
<head>
    <title>Form 1A</title>
</head>
<body>
    <h1>Form 1A Submission</h1>
    <p><b>Applicant Information :</b></p>
    <p>
        Name : {{ $case->form_1A_Name ?? '...' }}
    </p>
    <p>
        Position : {{ $case->form_1A_Name ?? '...' }}
    </p>
    <p>
        Date Submitted : {{ $case->form_1A_Name ?? '...' }}
    </p>
    <p>
        <b>Text :</b>
    </p>
    <p>
        {!! nl2br($case->form_1A_Text) ?? '...' !!}
    </p>
</body>
</html>
