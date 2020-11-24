@extends('layouts.backend.admin')

@section('content')
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Faq Details</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Faq Details</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container">
        <div class="row">

            <div class="col-md-12 my-5">
                <div class="card card__box__large">
                    <div class="card__box__large-content">


                        <div class="row">
                            <div class="col-md-4">
                                <span>Question:</span>
                                <p class="faq-question-header">What is a meger?</p>
                            </div>

                            <div class="col-md-8 ">

                                <span>Description:</span>

                              <br/>
                              <br/>

                                <p class="faq-question-answer">

                                  Lorem, ipsum dolor sit amet consectetur adipisicing elit. Saepe autem aliquam,
                                    voluptate, architecto itaque at, dicta soluta consectetur laboriosam facere
                                    veritatis ut eius beatae minus. Necessitatibus cum magnam magni adipisci.
                                  Lorem, ipsum dolor sit amet consectetur adipisicing elit. Saepe autem aliquam,
                                    voluptate, architecto itaque at, dicta soluta consectetur laboriosam facere
                                    veritatis ut eius beatae minus. Necessitatibus cum magnam magni adipisci.
                                  Lorem, ipsum dolor sit amet consectetur adipisicing elit. Saepe autem aliquam,
                                    voluptate, architecto itaque at, dicta soluta consectetur laboriosam facere
                                    veritatis ut eius beatae minus. Necessitatibus cum magnam magni adipisci.
                                  
                                </p>


                            </div>

                        </div>




                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
