@extends('layouts.frontend.base')

@section('content')
    <div class="page-content my-5">
        <div class="container row-top">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="home__headers">Mergers and Aquisition Portal</h2>
                    <div class="custom-bar"></div>
                    <p class="home__content">
                        The Federal Competition and Consumer Protection Commission is empowered to review and analyse all mergers and other
                        business combinations or arrangements to ensure that such combinations do not substantially prevent
                        or lessen competition.
                    </p>
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
                        onclick="window.location.href = '{{ route('enquiries.create', ['type' => 'prn']) }}';">
                        <img class="card__box-stack-img" src="{{ FE_IMAGE.'svg/book-open.svg' }}" alt="user-bg" />
                        <div class="card__box--content">
                            <p>Pre-Notification</p>
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
                        onclick="window.location.href = '{{ route('home.faqs.category', ['category' => 'GEN']) }}';">
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
