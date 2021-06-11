<!DOCTYPE html>
<html>
<head>
    <title>Form 1A</title>
    <style type="text/css">
        @page {
            margin: 1cm;
        }

        body {
            font-family: sans-serif;
            margin: 0.7cm 0;
            text-align: justify;
        }

        #header, #footer {
            position: fixed;
            left: 0;
            right: 0;
            color: #aaa;
            font-size: 0.7em;
        }

        #header {
            top: 0;
            border-bottom: 0.1pt solid #aaa;
        }

        #footer {
            bottom: 0;
            border-top: 0.1pt solid #aaa;
        }

        #header table, #footer table {
            width: 100%;
            border-collapse: collapse;
            border: none;
        }

        #header td, #footer td {
            padding: 0;
            width: 50%;
        }

        .page-number {
            text-align: center;
            margin-top: 5px;
        }

        .page-number:before {
            content: "Page " counter(page);
        }

        hr {
            page-break-after: always;
            border: 0;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div id="header">
        <table>
            <tr>
                <td>{!! $case->subject !!}</td>
                <td style="text-align: center;">https://mergers.fccpc.gov.ng/</td>
                <td style="text-align: right;">{{ datetimeToText(now(), "%d %b. %Y %I:%M %p") }}</td>
            </tr>
        </table>
    </div>

    <div id="footer">
        <table>
            <tr>
                <td>{!! $case->subject !!}</td>
                <td style="text-align: center;">https://mergers.fccpc.gov.ng/</td>
                <td style="text-align: right;">{{ datetimeToText(now(), "%d %b. %Y %I:%M %p") }}</td>
            </tr>
        </table>
        <div class="page-number"></div>
    </div>

    <h1>Form 1A</h1>
    <br />
    <p><b>Non-Confidential Executive Summary:</b></p>
    <br />
    <p>{!! nl2br($case->form_1A_Text) ?? '...' !!}</p>
    <br />

    <p><b>Declaration signed by:</b></p>
    <p style='margin-left:15px;letter-spacing:1px;'>
        Name: {{ $case->form_1A_Name ?? '...' }} <br />
        Position: {{ $case->form_1A_Position ?? '...' }} <br />
        Date: {{ datetimeToText($case->form_1A_Date, "customd") ?? '...' }} <br />
    </p>
</body>
</html>
