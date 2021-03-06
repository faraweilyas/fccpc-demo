@extends('layouts.frontend.base')

@section('content')
    <div class="page-content my-5" style="margin-bottom: 10rem !important">
        <div class="container row-top">
            <div class="row">
                <div class="col-md-9 mx-auto">
                    <div style='font-size: 18px;'>
                        <p>Section 96(2) of the Federal Competition and Consumer Protection Act, 2018 (FCCPA), and Regulations 16(1)(2) of the Merger Review Regulations, 2020 (MRR), requires publication of merger notifications.</p>
                        <p>In accordance with these enactments a notification received by the Commission is hereunder published.</p>
                        <p>Comments by interested persons must reach the Commission within seven (7) business days of the publication.</p>
                        <p>Only comments that address competition or relevant/ancillary matters are considered relevant. <br />Comments may be sent to the Commission by email <a href="mailto:mergernotification@fccpc.gov.ng">(mergernotification@fccpc.gov.ng), using the Subject/Title of the Notification as email subject.</a></p>
                    </div>
                    <div class="form-group">
                        <form id="faqSearchForm" method="GET" action="{{ route('home.publications') }}">
                            <input
                                class="form-control faq-search-input"
                                type="text"
                                name="query"
                                placeholder="Search"
                                value="{{ $_GET['query'] ?? "" }}"
                            />
                        </form>
                    </div>
                </div>
            </div>
            <div class="row" style="align-items: baseline;">
                {{-- <div class="col-md-4">
                    <div class="form-group">
                        <form id="publication_search" method="GET" action="{{ route('home.publications') }}">
                            <input
                                class="form-control publication-search-input"
                                type="text"
                                name="query"
                                placeholder="Search"
                                value="{{ $_GET['query'] ?? "" }}"
                            /><br />
                            <div class="accordion mt-10" id="accordionExample">
                               <div class="card">
                                    <div class="card-header bg_transparent" id="headingOne">
                                      <h5 class="mb-0">
                                        <button class="btn btn-link publication__btn" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                         Case Type&nbsp;<i class="fa fa-arrow-up fa-1x"></i>
                                        </button>
                                      </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body publication__checkbox">
                                            <label class="form-check">
                                                <input class="form-check-input" type="checkbox" name="case_type1" value="SM" @isset($_GET['case_type1']) checked @endif>
                                                <span class="form-check-label">
                                                    Small
                                                </span>
                                            </label>
                                            <label class="form-check">
                                                <input class="form-check-input" type="checkbox" name="case_type2" value="LG" @isset($_GET['case_type2']) checked @endif>
                                                <span class="form-check-label">
                                                    Large
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header bg_transparent" id="headingTwo">
                                      <h5 class="mb-0">
                                        <button class="btn btn-link publication__btn" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                         Case Category&nbsp;<i class="fa fa-arrow-up fa-1x"></i>
                                        </button>
                                      </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                        <div class="card-body publication__checkbox">
                                            <label class="form-check">
                                                <input class="form-check-input" type="checkbox" name="case_category1" value="REG" @isset($_GET['case_category1']) checked @endif>
                                                <span class="form-check-label">
                                                    Merger (Form 1)
                                                </span>
                                            </label>
                                            <label class="form-check">
                                                <input class="form-check-input" type="checkbox" name="case_category2" value="FFM" @isset($_GET['case_category2']) checked @endif>
                                                <span class="form-check-label">
                                                    Simplified Procedure (Form 2)
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </form>
                    </div>
                </div> --}}
                <div class="col-md-8 mx-auto case__info">
                    @foreach($publications as $publication)
                        <div class="mb__20">
                            {{-- <hr /> --}}
                            <a href="{{ route('home.publications.view', ['slug' => $publication->slug]) }}">
                                <h3 class="publication_title">{{ ucfirst($publication->case->subject) }}</h3>
                            </a>
                            <span>Case type: {{ $publication->case->getCategoryText() }}</span>
                            <span>Case Parties: {{ $publication->case->getCasePartiesForPublication() }}</span>
                            <span>Published: {{ $publication->getPublishedAt() }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
           <div class="row">
               <div class="col-md-12">
                    {{ $publications->links() }}
                </div>
           </div>
        </div>
    </div>
@endsection

@section('custom.javascript')
   <script type="text/javascript" src="{{ pc_asset(FE_JS.'publication.js') }}"></script>
@endsection
