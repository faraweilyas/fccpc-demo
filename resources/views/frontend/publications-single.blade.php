@extends('layouts.frontend.base')

@section('content')
<div class="page-content  my-5">
    <div class="container container-sm row-top  ">
        <div class="row row-top home-content-header">
            <h2 class=" publications-header faq-content-header mx-4">
                <a href={{url('/publications')}} style="color: #999">Publications /</a> TNP Takes its services to Abuja,
                Sets Up New
            </h2>
        </div>

        <div class="row publication-container ">
            <div class="col-md-3 read-more-img-sm">

                <div class="publication-header">
                    <h3>TNP Takes Its Services To Abuja...</h3>
                </div>
                <div class="publication-content">
                    <p>
                        TNP, Nigeria’s “Glocal” and commercially oriented
                        law firm and a collaborating firm of Andersen Global
                        has made yet another...
                    </p>
                </div>
                <div class="read-more-link">
                    <a href="{{ route('home.publications.view', ['publication' => 2]) }}">Read More</a>
                </div>


                <div class="publication-header">
                    <h3>TNP Takes Its Services To Abuja...</h3>
                </div>
                <div class="publication-content">
                    <p>
                        TNP, Nigeria’s “Glocal” and commercially oriented
                        law firm and a collaborating firm of Andersen Global
                        has made yet another...
                    </p>
                </div>
                <div class="read-more-link">
                    <a href="{{ route('home.publications.view', ['publication' => 2]) }}">Read More</a>
                </div>
            </div>
            <div class="col-md-9 read-more-main-img">

                <div class="publication-content read-more-content">
                    <p>
                        NP, Nigeria’s “Glocal” and commercially oriented law
                        firm and a collaborating firm of Andersen Global has
                        made yet another bold move by taking its business
                        into the city of Abuja, Nigeria’s Federal Capital.
                        This new development is in line with the firm’s goal
                        to boost service delivery to meet the business needs
                        of our clients.
                        <br />
                        <br />
                        The Abuja office is set to offer services in line
                        with TNP’s outstanding track record of delivering
                        expert legal advice and value to its clients’
                        businesses across multiple practice sectors which
                        include; Capital Markets, Commercial Dispute
                        Resolution, Corporate Finance, Infrastructure,
                        Construction & Real Estate; Technology, Media &
                        Telecommunications; Energy & Natural Resources;
                        Setup, Compliance & Restructuring; Corporate
                        Commercial, M&A, Private Equity and Business
                        Advisory.
                        <br />
                        <br />
                        Speaking about this development, the firm’s Managing
                        Partner, Baba Alokolaro said that the launch was
                        borne out of an increased demand for the firm’s
                        services.
                        <br />
                        <br />
                        “In our culture of constantly exploring new
                        possibilities to deliver results and solutions for
                        our clients’ businesses, the opening of this new
                        office is strategic with our growth plan and will
                        further aid our clients’ compliance and regulatory
                        business needs,” he said.
                        <br />
                        <br />
                        TNP is comprised of innovative, keen and
                        result-oriented lawyers who are dedicated to being
                        highly responsive and accessible. With over a decade
                        as business savvy lawyers, the firm remains
                        committed to delivering excellence and value with
                        its global outlook and local footprints.
                    </p>
                </div>
            </div>

        </div>
    </div>

</div>
@endSection
