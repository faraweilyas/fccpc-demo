@extends('layouts.frontend.base')

@section('content')
<div class="page-content my-5">

    <style>
        .height {
            height: 60vh !important;
        }

        .not__found {

            padding: 5rem 0;
            text-align: center
        }

        .not__found h1 {
            font-size: 26rem;
            font-weight: bold;
            margin-left: -5rem;

        }

        .not__found p {
            font-size: 1.5rem;
            font-weight: bold;

        }

    </style>
    <div class="container  container-sm height">


        <div class="row row-top">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="not__found ">
                    <h1>404</h1>
                    <p>Not Found?<p>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>


    </div>
</div>
@endsection
