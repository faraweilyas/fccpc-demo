@extends('layouts.backend.old.guest')


@section('content')

<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Application</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ $guest->applicationPath() }}" class="text-muted">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#" class="text-muted">Review Application</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<style>
    .btn-success {
        background: #227a4e !important;
        border-color: #227a4e !important;
        font-size: 1.5rem;

    }



    .rmv-top {
        top: -15rem !important;
    }

    .rmv-left {
        left: 50%;
    }

    .rmv-height {
        height: fit-content !important;
        padding-bottom: 0rem !important;
    }

    .add-mgbottom {
        margin-bottom: 8rem !important;
    }

    .checklist-header {
        font-size: 2rem;
        font-weight: bold;
        color: #4f4f4f;
        margin: 1.5rem 0;
    }

    .checklist-list {
        font-size: 1.5rem;
        margin: 1.5rem 0;
    }

    .checklist-list-sub {
        font-size: 1.5rem;
        margin: 1.5rem 1rem;
    }

    .login-bg {
        background: #fff !important;
        position: absolute;
        height: auto;
        padding: auto;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
    }

    .bottom {
        bottom: -25%;
    }

    .bottom-2 {
        bottom: -68%;
    }

    .bottom-3 {
        bottom: -36%;
    }


    .wd-ft {
        width: 100%;
    }

    .card__box-stack {
        height: auto;
        background: #fff;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin: 1rem 0;
        cursor: pointer;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }

    .card__box-stack .card__box-stack-img {
        margin-top: 2rem;
        height: 5rem;
    }

    .card__box-stack .card__box--content {
        margin-top: 1rem;
        margin-left: 1rem;
        padding: 1rem;
    }

    .card__box-stack .card__box--content p {
        font-size: 1.5rem;
        color: #4f4f4f;
    }

    .card__box-stack .card__box--content span {
        font-size: 1.2rem;
        color: #227a4e;
    }

    .card__box-stack:hover,
    .card__box-stack:focus,
    .card__box-stack:visited {
        -webkit-transform: translateX(1rem);
        transform: translateX(1rem);
    }

    .card__box-stack-active {
        border: 2px solid #227a4e;
    }

    .card__box--white {
        background: #fff;
        background-image: url('../images/png/linesx2.png');
        background-size: 40rem;
        background-position: center;
        background-repeat: no-repeat;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        cursor: pointer;
    }

    .card__box--active {
        background: #227a4e;
        background-image: url('../images/png/linesx2.png');
        background-size: 40rem;
        background-position: center;
        background-repeat: no-repeat;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        cursor: pointer;
    }

    .card__box--active>p {
        color: #fff !important;
    }

    .card__box--active>span {
        color: #fff !important;
    }

    .card__box--active>img {
        display: none !important;
        color: #fff !important;
    }

    .card__box--white .card__box-text-intro {
        font-weight: bold;
        font-size: 2rem;
        color: #227a4e;
    }

    .card__box--white .card__box-text-span {
        font-size: 1.5rem;
        color: #227a4e;
    }

    .card__box--white .card__box-icon {
        -webkit-transition: all 2s ease-in-out;
        transition: all 2s ease-in-out;
        position: absolute;
        top: 5rem;
        right: 2rem;
    }

    .card__box--white:hover,
    .card__box--white:focus,
    .card__box--white:visited {
        -webkit-transform: translateX(1rem);
        transform: translateX(1rem);
    }

    .card__box-status {
        padding: 0.5rem;
    }

    .card__box-status a {
        margin: 1rem;
        font-size: 1.5rem;
        color: #4f4f4f;
        text-decoration: underline;
    }

    .card__box__large {
        background: #fff;
        height: auto;
        padding-bottom: 15rem;
    }

    .card__box__large .card__box__large-content {
        padding: 5rem;
    }

    .card__box__large .card__box__large-content .card__box__large-content--intro {
        padding: 3rem;
    }

    .card__box__large .card__box__large-content .card__box__large-content--intro p {
        font-size: 2rem;
    }

    .card__box__large .card__box__large-content .card__box__large-content--intro a {
        font-size: 2rem;
        color: #227a4e;
        text-decoration: underline;
    }

    .card__box__large .card__box__large-content--success {
        padding: 5rem 0;
        text-align: center;
    }

    .card__box__large .card__box__large-content--success p {
        font-size: 3rem;
        color: #227a4e;
    }

    .card__box__large .card__box__large-content--success p:nth-child(3) {
        font-size: 1.5rem;
        color: #4f4f4f;
    }


    .rmv-mg {
        margin-left: 0px;
        margin-right: 0px;
    }

    .grid-col-4 {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-gap: 4rem;
        margin-bottom: 2rem;
    }

    .grid-col-3 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 3rem;
    }

    .doc-card {
        border: 1px solid #e9e9e9;
        box-sizing: border-box;
        border-radius: 8px;
        height: fit-content;
        width: 90%;
        padding: 2rem 2rem 2rem 3rem;
        margin-bottom: 2rem;
    }

    .doc-card-lg {
        padding: 2rem 2rem 2rem 3rem !important;
        width: 100% !important;
    }

    .doc-card h3 {
        margin-top: 2rem;
        margin-bottom: 4rem;
    }

    .grid-row-2 {
        display: grid;
        grid-template-rows: repeat(2, 1fr);
        grid-gap: 1rem;
        padding-bottom: 2rem;
    }

    .grid-col-2 {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        padding-bottom: 2rem;
    }

    .grid-col-2-btn {
        display: grid;
        grid-template-columns: 1fr 2fr;
        padding-bottom: 2rem;
        grid-gap: 2rem;
    }

    .grid-col-2-files {
        display: grid;
        grid-template-columns: 1fr 2fr;
        padding-bottom: 2rem;
        grid-gap: 2rem;
    }

    .grid-col-2-files h4 {
        justify-self: flex-start;
        margin-left: -28%;
    }

    .width-100 {
        width: 100%;
        margin: 0 !important;
    }

    .grid-fix {
        align-self: flex-end;
    }

    .grid-fix2 {
        justify-self: flex-end;
    }

    .mg-left-fix {
        margin-left: 3rem;
    }

    .rmv-maxw {
        max-width: 100%;
    }

    .in-prog {
        background: rgba(244, 162, 97, 0.2);
        border-radius: 5px;
        text-align: center;
        padding: 0.5rem 1rem 0.3rem 1rem;
        width: fit-content;
        color: #f4a261;
    }

    .in-prog h3 {
        font-size: 14px;
    }

    .not-paid {
        background: rgba(231, 40, 40, 0.2);
        border-radius: 5px;
        text-align: center;
        padding: 0.5rem 1rem 0.3rem 1rem;
        width: fit-content;
        height: fit-content;
        color: #e72828;
    }

    .not-paid h3 {
        font-size: 14px;
    }

    .font-fix {
        font-size: 1.5rem !important;
    }

    .back-btn {
        margin-left: 2rem;
    }

    .back-btn i:hover {
        color: #227a4e;
        font-size: 33px;
    }

    .review-description {
        font-size: 14px;
        width: 50%;
        padding-bottom: 2rem;
    }

    .section-header {
        color: #227a4e;
        font-size: 14px;
        padding-bottom: 1.5rem;
    }

    .info-title {
        color: #484b74;
    }

    .file-section {
        padding-bottom: 2rem;
    }

    .file-section h4 {
        display: inline;
    }

    .flex {
        display: flex !important;
    }

    .toggle-password {
        position: absolute;
        left: auto;
        right: 10px;
        text-indent: 32px;
        top: 20px;
        cursor: pointer;
    }

    .justify-center {
        justify-content: center;
    }

    @-webkit-keyframes slideInRight {
        0% {
            opacity: 0;
            -webkit-transform: translateX(2rem);
            transform: translateX(2rem);
        }

        80% {
            -webkit-transform: translateX(-1rem);
            transform: translateX(-1rem);
        }

        100% {
            opacity: 1;
            -webkit-transform: translate(0);
            transform: translate(0);
        }
    }

    @keyframes slideInRight {
        0% {
            opacity: 0;
            -webkit-transform: translateX(2rem);
            transform: translateX(2rem);
        }

        80% {
            -webkit-transform: translateX(-1rem);
            transform: translateX(-1rem);
        }

        100% {
            opacity: 1;
            -webkit-transform: translate(0);
            transform: translate(0);
        }
    }


    @media only screen and (min-width: 280px) and (max-width: 565px) {

        .card__box__large {
            padding-bottom: 15rem;
        }

        .card__box__large .card__box__large-content {
            padding: 0rem;
        }

        .card__box__large .card__box__large-content .card__box__large-content--intro {
            padding: 3rem;
        }

        .card__box__large .card__box__large-content .card__box__large-content--intro p {
            font-size: 2rem;
        }

        .card__box__large .card__box__large-content .card__box__large-content--intro a {
            font-size: 2rem;
            color: #227a4e;
            text-decoration: underline;
        }

        .card__box__large .card__box__large-content--success {
            padding: 5rem 0;
            text-align: center;
        }

        .card__box__large .card__box__large-content--success p {
            font-size: 3rem;
            color: #227a4e;
        }

        .card__box__large .card__box__large-content--success p:nth-child(3) {
            font-size: 1.5rem;
            color: #4f4f4f;
        }
    }

    @media (min-width: 992px) {
        .rmv-flex {
            -ms-flex: 0 0 66.666667%;
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

    @media (max-width: 960px) {
        .header_logo {
            top: 2.2rem;
            padding: 0rem 2rem;
        }

        .header_logo a {
            color: #fff;
            font-size: 1.5rem;
        }

        .login__box .login__box--content img {
            margin: 2rem 8rem;
        }

        .bottom-2 {
            bottom: -20%;
        }

        .fee__calculator--active {
            width: 75%;
        }

        .fee__calculator .fee__calculator-btn {
            left: 80%;
        }
    }

    @media (max-width: 840px) {
        .no_display {
            display: none !important;
        }

        .fee__calculator--active {
            width: 100%;
        }

        .l-mg1 {
            margin-left: 2.5rem;
        }
    }

    @media (width: 1024px) {
        .fee__calculator--active {
            width: 45%;
        }
    }

    @media (max-width: 375px) {
        .col__8-center {
            position: relative;
            bottom: 0%;
        }

        .crumb__box span {
            font-size: 0.8rem;
            margin: 0.3rem;
        }
    }

    @media (min-width: 380px) and (max-width: 414px) {
        .crumb__box span {
            font-size: 1rem;
            margin: 0.3rem;
        }
    }

    @media (width: 320px) {
        .col__8-center {
            position: relative;
            bottom: 0%;
        }

        .crumb__box span {
            font-size: 0.5rem;
            margin: 0.3rem;
        }

        .mq_rmv-left {
            left: 23% !important;
            margin-top: -220% !important;
            max-width: 48.666667% !important;
        }

        .wd-ft {
            width: 100% !important;
        }
    }

    @media (width: 280px) {
        .col__8-center {
            position: relative;
            bottom: 0%;
        }

        .checklist-header {
            font-size: 1.5rem;
        }

        .checklist-list {
            font-size: 1.5rem;
            margin: 1.5rem 0;
        }

        .header_logo {
            padding: 0rem 1rem;
        }

        .crumb__box span {
            font-size: 0.8rem;
            margin: 0.2rem;
        }

        .crumb__box p {
            color: #4f4f4f;
            font-size: 0rem;
        }
    }

    @media (min-width: 411px) and (max-width: 540px) {
        .col__8-center {
            transform: translate(-50%, 50%);
        }
    }

    @media (width: 768px) {
        .col__8-center {
            position: relative;
            bottom: 0%;
        }

        .col-md-8 {
            -ms-flex: 0 0 66.666667%;
            flex: none;
            max-width: 80.666667%;
        }

        .nd2 {
            display: none !important;
        }

        .header_logo a {
            font-size: 2.5rem;
        }

        .header_logo {
            top: 1.2rem;
        }

        .rmv-left {
            left: 23% !important;
            margin-top: -10% !important;
            max-width: 48.666667% !important;
        }

        .grid-col-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 4rem;
            margin-bottom: 2rem;
        }

        .grid-col-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 3rem;
        }

        .grid-row-2 {
            display: grid;
            grid-template-rows: repeat(2, 1fr);
            grid-gap: 1rem;
            width: 120px;
        }

        .grid-row-2 h3 {
            font-size: 1rem;
        }

        .grid-row-2 h4 {
            font-size: 1rem;
        }

        .grid-fix2 button {
            font-size: 1rem !important;
        }

        .wd-ft {
            width: 220%;
        }

        .doc-card {
            padding: 2rem 1rem 2rem 3rem;
        }

        .doc-card h3 {
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .font-fix {
            font-size: 1rem !important;
        }
    }

    @media (max-width: 823px) {
        .grid-col-4 {
            display: grid;
            grid-template-columns: 1fr;
            grid-gap: 2rem;
            margin-bottom: 2rem;
        }

        .grid-col-4 h4 {
            font-size: 1rem;
        }

        .grid-col-3 {
            display: grid;
            grid-template-columns: 1fr;
            grid-gap: 3rem;
            padding-bottom: 4rem;
        }

        .grid-row-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 1rem;
            width: 100%;
        }

        .grid-row-2 h3 {
            font-size: 1rem;
        }

        .grid-row-2 h4 {
            font-size: 1rem;
        }

        .grid-fix2 button {
            font-size: 1rem !important;
        }

        .wd-ft {
            width: 220%;
        }

        .doc-card {
            padding: 2rem 1rem 2rem 3rem;
        }

        .doc-card h3 {
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .font-fix {
            font-size: 1rem !important;
        }

        .grid-col-2 {
            display: grid;
            grid-template-columns: 1fr;
            padding-bottom: 2rem;
        }

        .grid-fix2 {
            justify-self: center !important;
            padding-top: 2rem;
        }

        .grid-fix2 button {
            font-size: 1rem !important;
            width: 125%;
        }

        .grid-col-2-btn {
            display: grid;
            grid-template-columns: 1fr;
            grid-gap: 2rem;
        }

        .file-section h4 {
            font-size: 1rem;
        }

        .review-description {
            width: 80%;
        }

        .grid-col-2-files h4 {
            font-size: 1rem;
        }

        /* .width-100 {
    margin-left: -0.1rem;
  } */
        .my-select {
            margin-left: -1.5rem;
            margin-bottom: 0rem;
        }

        div.dataTables_wrapper div.dataTables_filter input {
            margin-left: -0.1em !important;
        }
    }

    @media (width: 540px) {
        .rmv-left {
            left: 23% !important;
            margin-top: -120% !important;
            max-width: 48.666667% !important;
        }
    }

    @media (min-width: 341px) and (max-width: 700px) {
        .rmv-left {
            left: 23% !important;
            max-width: 48.666667% !important;
        }
    }

    /* @media (min-width: 567px) and (max-width: 667px) {
  .col__8-center {
  }
} */

    @media (min-width: 701px) and (max-width: 736px) {
        .grid-row-2 h3 {
            font-size: 1rem;
        }

        .doc-card h3 {
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .grid-col-3 {
            display: grid;
            grid-template-columns: 1fr;
            grid-gap: 3rem;
        }

        .grid-col-4 {
            display: grid;
            grid-template-columns: 1fr;
            grid-gap: 2rem;
            margin-bottom: 2rem;
        }

        .grid-row-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 1rem;
            width: 100%;
        }
    }

    @media (width: 360px) {
        .grid-col-4 h4 {
            font-size: 1rem !important;
        }
    }

</style>


<div id="kt_wizard_v2" class="container py-5">
    <div class="row">
        <div class="col-md-12 ">
            <div class="card__box card__box__large  rmv-height add-mgbottom " id="applications">
                <div class="card__box__large-content">
                    <h3 class="checklist-header">
                        Summary of Application
                    </h3>

                    <p class="review-description">
                        Review your entries for any kind of error. Kindly
                        note that you cannot edit information once it has
                        been submitted.
                    </p>

                    <p class="section-header">
                        Application Case Information
                    </p>

                    <div class="grid-col-2">
                        <div class="grid-row-2">
                            <h4 class="info-title">Subject</h4>
                            <h4>{{ $guest->case->subject }}</h4>
                        </div>
                        <div class="grid-row-2">
                            <h4 class="info-title">Filling Fees</h4>
                            <h4>Paid</h4>
                        </div>
                        <div class="grid-row-2">
                            <h4 class="info-title">Parties:</h4>
                            <h4>{!! $guest->case->generateCasePartiesBadge('mr_10 mb-2') !!}</h4>
                        </div>
                        <div class="grid-row-2">
                            <h4 class="info-title">Processing Fees:</h4>
                            <h4>Not Paid</h4>
                        </div>
                        <div class="grid-row-2">
                            <h4 class="info-title">
                                Transaction Type:
                            </h4>
                            <h4>{{ $guest->case->getType() }}</h4>
                        </div>
                    </div>

                    <p class="section-header">
                        Contact Information
                    </p>
                    <div class="grid-col-2">
                        <div class="grid-row-2">
                            <h4 class="info-title">
                                Applicant/Representing Firm
                            </h4>
                            <h4>{{ $guest->case->applicant_firm }}</h4>
                        </div>
                        <div class="grid-row-2">
                            <h4 class="info-title">Contact Person</h4>
                            <h4>{{ $guest->case->getApplicantName() }}</h4>
                        </div>
                        <div class="grid-row-2">
                            <h4 class="info-title">Email address:</h4>
                            <h4>{{ $guest->case->applicant_email }}</h4>
                        </div>
                        <div class="grid-row-2">
                            <h4 class="info-title">Phone number:</h4>
                            <h4>{{ $guest->case->applicant_phone_number }}</h4>
                        </div>
                        <div class="grid-row-2">
                            <h4 class="info-title">Address:</h4>
                            <h4>{{ $guest->case->applicant_address }}</h4>
                        </div>
                    </div>

                    <p class="section-header">Relevant Documents</p>
                    @foreach($documents as $document)
                    <div class="grid-col-2">

                        <div class="grid-col-2-files my-5" key={item[0]}>
                            <img src="{{ pc_asset(BE_IMAGE.'pdf.png') }}" alt="pdf" />

                            <h4> {{ $document->file }}</h4>
                            <button class="btn btn-success" onclick="window.location.href = '{{ route('applicant.document.download', ['document' => $document->id]) }}';">
                                Download
                            </button>
                        </div>
                        <div class="grid-row-2">
                            <h4 class="info-title">
                                Additional Information:
                            </h4>
                            <h4>{{ $document->additional_info }}</h4>
                        </div>
                    </div>
                    @endforeach
                    <form class="form" id="kt_form">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />
                        <input type="hidden" id="tracking_id" name="tracking_id" value="{{ $guest->tracking_id }}">
                        <div class="grid-col-2-btn">
                            <button id="goback-btn" class="btn btn-success width-100" onclick="window.location.href = '/application/{{ $guest->tracking_id }}/{{ $guest->case->case_category }}'">
                                Go back to edit
                            </button>
                            <button id="upload-info" class="btn btn-success" data-wizard-type="action-submit">
                                Submit
                            </button> 
                            <button id="upload-img" class="btn btn-success hide" disabled>
                                <i class="fas fa-spinner fa-pulse"></i>&nbsp;Uploading...
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom.javascript')
    <script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'create-application.js') }}"></script>
@endsection
