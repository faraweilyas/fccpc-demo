@extends('layouts.frontend.base')

@section('content')
    <div class="page-content my-5">
        <div class="container row-top">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="home__headers">Resources & Application Forms</h2>
                    <div class="custom-bar"></div>
                    <div class="row">
                        <div class="col-xl-4 mb__20">
                            <div class="card card-custom gutter-b card-stretch shadow">
                                <div class="card-header border-0 pt-5 bg__white">
                                    <div class="card-title">
                                        <div class="card-label">
                                            <div class="font-weight-bolder">Download Form 1</div>
                                            <div class="font-size-sm text-muted mt-2">Notice of Merger & Guidance Notes</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="flex-grow-1 text-center" style="position: relative;">
                                        <a class="" href="{{ route('application.download_form', ['form' => 'form_1.docx']) }}" title="Download Form 1">
                                            <img src="{{ BE_MEDIA.'/svg/icons/Files/DownloadFileGreen.svg' }}" class="download__btn" />
                                        </a>
                                    </div>
                                    <div class="mt-10 mb-5">
                                        <p class="download-text">This form should be completed jointly by parties to the proposed transaction. The requested information may be provided in this form or in appendices arranged according to corresponding section numbers in the form. All documents should be bound together.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 mb__20">
                            <div class="card card-custom gutter-b card-stretch shadow">
                                <div class="card-header border-0 pt-5 bg__white">
                                    <div class="card-title">
                                        <div class="card-label">
                                            <div class="font-weight-bolder">Download Form 2</div>
                                            <div class="font-size-sm text-muted mt-2">Notice of Merger - Simplified Procedure</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="flex-grow-1 text-center" style="position: relative;">
                                        <a class="" href="{{ route('application.download_form', ['form' => 'form_2.docx']) }}" title="Download Form 2">
                                            <img src="{{ BE_MEDIA.'/svg/icons/Files/DownloadFileGreen.svg' }}" class="download__btn" />
                                        </a>
                                    </div>
                                    <div class="mt-10 mb-5">
                                        <p class="download-text">This form should be completed jointly by parties to the proposed transaction. The requested information may be provided in this form or in appendices arranged according to corresponding section numbers in the form. All documents should be bound together.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 mb__20">
                            <div class="card card-custom gutter-b card-stretch shadow">
                                <div class="card-header border-0 pt-5 bg__white">
                                    <div class="card-title">
                                        <div class="card-label">
                                            <div class="font-weight-bolder">Download Form 4</div>
                                            <div class="font-size-sm text-muted mt-2">Application for Negative Clearance</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="flex-grow-1 text-center" style="position: relative;">
                                        <a class="" href="{{ route('application.download_form', ['form' => 'form_4.docx']) }}" title="Download Form 4">
                                            <img src="{{ BE_MEDIA.'/svg/icons/Files/DownloadFileGreen.svg' }}" class="download__btn" />
                                        </a>
                                    </div>
                                    <div class="mt-10 mb-5">
                                        <p class="download-text">This form should be completed jointly by parties to the proposed transaction. The requested information may be provided in this form or in appendices arranged according to corresponding section numbers in the form. All documents should be bound together.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h2 class="home__headers">Quick Links</h2>
                    <div class="card__box card__box-stack shadow card__box-stack-active" id="control-1"
                        onclick="window.location.href = '{{ route('applicant.show') }}';">
                        <img class="card__box-stack-img" src="{{ FE_IMAGE.'png/folder.png' }}" alt="book-open" />
                        <div class="card__box--content">
                            <p>Submit Application</p>
                        </div>
                    </div>
                    <div class="card__box card__box-stack shadow" id="control-3"
                        onclick="window.location.href = '{{ route('enquiries.index') }}';">
                        <img class="card__box-stack-img" src="{{ FE_IMAGE.'svg/book-open.svg' }}" alt="user-bg" />
                        <div class="card__box--content">
                            <p>Enquiry</p>
                        </div>
                    </div>
                    <div class="card__box card__box-stack shadow" id="control-2"
                        onclick="window.location.href = '{{ route('home.fee.calculator') }}';">
                        <img class="card__box-stack-img" src="{{ FE_IMAGE.'png/calculator.png' }}" alt="user-bg" />
                        <div class="card__box--content">
                            <p>Fee Calculator</p>
                        </div>
                    </div>
                    <div class="card__box card__box-stack shadow" id="control-4"
                        onclick="window.location.href = '{{ route('home.faqs') }}';">
                        <div>
                            <img class="card__box-stack-img" src="{{ FE_IMAGE.'png/questioncircle.png' }}" alt="user-bg" />
                        </div>
                        <div class="card__box--content">
                            <p>Frequently Asked Questions</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
