@extends('layouts.frontend.base')

@section('content')
    <div class="page-content my-5">
        <div class="container row-top">
            <div class="row home-content-header">
                <div class="col-md-7 home-content-header1">
                    <h2>Mergers and Aquisition Portal</h2>
                    <div class="custom-bar"></div>
                </div>
                <div class="col-md-5 home-content-header2">
                    <h2 >Quick Links</h2>
                </div>
            </div>
            <div class="row row-space home-content-container">
                <div class="col-xs-12 col-md-12 col-lg-7 no_display ">
                    <p class="text-paragh my-5">The Federal Competition and Consumer Protection Commission is a statutory body established under the FCCPA 2018 and empowered to review and analyse all mergers and other business combinations or arrangement to ensure that such combination does not substantially prevent or lessen competition.</p>
                </div>
                <div class="col-xs-12 col-md-12 col-lg-5">
                    <div
                        class="card__box card__box-stack shadow card__box-stack-active"
                        id="control-1"
                        onclick="window.location.href = '{{ route('applicant.show') }}';"
                    >
                        <img
                            class="card__box-stack-img"
                            src="{{ FE_IMAGE.'png/folder.png' }}"
                            alt="book-open"
                        />
                        <div class="card__box--content">
                            <p>Submit Application</p>
                        </div>
                    </div>
                    <div
                        class="card__box card__box-stack shadow"
                        id="control-3"
                        onclick="window.location.href = '{{ route('enquiries.index') }}';"
                    >
                        <img
                            class="card__box-stack-img"
                            src="{{ FE_IMAGE.'svg/book-open.svg' }}"
                            alt="user-bg"
                        />
                        <div class="card__box--content">
                            <p>Enquiry</p>
                        </div>
                    </div>
                    <div
                        class="card__box card__box-stack shadow"
                        id="control-2"
                        onclick="window.location.href = '{{ route('home.fee.calculator') }}';"
                    >
                        <img
                            class="card__box-stack-img"
                            src="{{ FE_IMAGE.'png/calculator.png' }}"
                            alt="user-bg"
                        />
                        <div class="card__box--content">
                            <p>Fee Calculator</p>
                        </div>
                    </div>
                    <div
                        class="card__box card__box-stack shadow"
                        id="control-4"
                        onclick="window.location.href = '{{ route('home.faqs') }}';"
                    >
                        <div>
                            <img
                                class="card__box-stack-img"
                                src="{{ FE_IMAGE.'png/questioncircle.png' }}"
                                alt="user-bg"
                            />
                        </div>
                        <div class="card__box--content">
                            <p>Frequently Asked Questions</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endSection
