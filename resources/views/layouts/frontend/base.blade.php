<html lang="en">
<head>
    <title>{{ $details->title }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="{{ author() }}">
    <meta name="description" content="{{ $details->description }}" />
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta name="generator" content="Jekyll v3.8.5" />
    <meta property="og:title" content="Federal Competition and Consumer Protection Commission" />
    <meta property="og:locale" content="en_US" />
    <meta name="description" content="{{ $details->description }}" />
    <meta property="og:description" content="{{ $details->description }}" />
    <meta property="og:url" content="{{ agencyLink() }}" />
    <meta property="og:site_name" content="Federal Competition and Consumer Protection Commission" />
    <link rel="shortcut icon" href="{{ BE_IMAGE.'favicon/fccpc_favicon.ico' }}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/fontawesome.min.css" integrity="sha512-shT5e46zNSD6lt4dlJHb+7LoUko9QZXTGlmWWx0qjI9UhQrElRb+Q5DM7SVte9G9ZNmovz2qIaV7IWv0xQkBkw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ pc_asset(FE_CSS.'main.css') }}" />
    <link rel="stylesheet" href="{{ pc_asset(FE_CSS.'custom.css') }}" />
</head>
<body >
    <header class="fixed-top bg-dark shadow">
      <div class="header">
        <div class="header_logo">
          <a href="/">
            <img src="{{ FE_IMAGE.'png/logo.png' }}" alt="" style="height: 80px;object-fit: contain;"/>
          </a>
        </div>

        <div class="header__content">
          <a class="header__title" href="/">
            Federal Competition and Consumer Protection Commission
          </a>
        </div>

        <div class="header_logo">
          <a href="#">
            <img src="{{ FE_IMAGE.'png/coat_of_arm.png' }}" style="height: 50px;object-fit: contain;" />
          </a>
        </div>
      </div>

      <nav class="navbar navbar-expand-md navbar-dark">
        <a class="navbar-brand" href="#">
          <!-- <img src="/images/png/logo.png" alt="" /> -->
        </a>
        <button
          class="navbar-toggler collapsed"
          type="button"
          data-toggle="collapse"
          data-target="#navbarsExampleDefault"
          aria-controls="navbarsExampleDefault"
          aria-expanded="false"
          aria-label="Toggle navigation"
          style="position: absolute;right: 10px;"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="/">
                M & A
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('applicant.show') }}">Submit Application</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('enquiries.create', ['type' => 'prn']) }}">Pre-Notification</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home.publications') }}">Publications</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home.fee.calculator') }}">Fee Calculator</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home.faqs.category', ['category' => 'GEN']) }}">FAQs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('applicant.track') }}">Manage Application</a>
            </li>
            <li class="nav-item dropdown administrator-right">
                <a class="nav-link" href="{{ route('login') }}">Sign In</a>
              {{-- <a
                class="nav-link dropdown-toggle"
                href="#"
                id="dropdown01"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                Admininstrator
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                <a class="dropdown-item" href="{{ route('register') }}">Register</a>
              </div> --}}
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <div class="container-fluid">
        @yield('content')
        <div class="landing-footer">
            <div class="landing-footer-info">
              <div class="container-fluid">
                <div class="footer-info-content">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="row">
                        <div class="col-md-6 footer-content-section">
                          <div class="row footer-info-content-header">
                            About Us
                          </div>
                           <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/about/commission/">
                                    The Commission
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/about/what-we-do/">
                                    What We Do
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/about/strategic-goals/">
                                    Strategic Goals
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/about/departments/">
                                    Departments &amp; Units
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/about/people/">
                                    People
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/about/alliances/">
                                    Strategic Alliances
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/faqs/">
                                    FAQs
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/contact/">
                                    Contact
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 footer-content-section">
                          <div class="row footer-info-content-header">
                            Consumers
                          </div>
                           <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/consumers/rights/">
                                    Consumer Rights
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/consumers/responsibilities/">
                                    Consumer Responsibilities
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/consumers/complaints-handling-procedures/">
                                    Complaints Handling Procedures
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/consumers/testimonials/">
                                    Testimonials
                                </a>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="row">
                        <div class="col-md-4 footer-content-section">
                            <div class="row footer-info-content-header">
                                Businesses
                            </div>
                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/businesses/obligations/">
                                    Business Obligations
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/businesses/register-sales-promotion/">
                                    Register Sales Promotion
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/businesses/documents/">
                                    Sales Promotion Documents
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/businesses/mergers/">
                                    Mergers
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 footer-content-section">
                          <div class="row footer-info-content-header">
                            News & Events
                          </div>
                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/news-events/releases/">
                                    Releases
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/news-events/announcements/">
                                    Announcements
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/news-events/alerts/">
                                    Alert/Advisory
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/news-events/speeches/">
                                    Speeches
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/blog/">
                                    Blog
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/news-events/events/">
                                    Events
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/gallery/">
                                    Gallery
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 footer-content-section">
                          <div class="row footer-info-content-header">
                            Headquarters
                          </div>
                          <div class="row footer-info-content-text">
                            Address: No. 17 Nile Street, Maitama, Abuja.
                          </div>
                          <br />
                          <div class="row footer-info-content-text">
                            Phone: 0805 600 2020, 0805 600 3030
                          </div>
                          <br />
                          <div class="row footer-info-content-text">
                            Email: contact@fccpc.gov.ng
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5">
                      <div class="row">
                        <div class="col-md-6 footer-content-section">
                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/guidelines/documents/">
                                    FCCPA
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/guidelines/sales-promotion-guidelines/">
                                    Regulations
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/guidelines/merger-guidelines/">
                                    Guidelines
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/guidelines/other-guidelines/">
                                    Other Guidelines
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 footer-content-section">
                           <div class="row footer-info-content-header">
                                Publications
                           </div>
                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/publications/materials/">
                                    Business/Consumer Education
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/publications/absolutely-prohibited-list/">
                                    Absolutely Prohibited Product List
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/publications/import-prohibition-list/">
                                    Import Prohibition List
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/publications/PBOR">
                                    PBOR
                                </a>
                            </div>

                            <div class="row footer-info-content-text">
                                <a class="co-gainsboro" target="__blank" href="https://www.fccpc.gov.ng/publications/annual-reports/">
                                    Annual Reports
                                </a>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="row">
                        <div class="col-md-4 footer-content-section">
                          <div class="row footer-info-content-header">
                            Socials
                          </div>
                          <div class="row footer-info-content-text">
                            <a href="//twitter.com/cpcnig" target="__blank">Twitter</a>
                          </div>
                          <div class="row footer-info-content-text">
                            <a href="//instagram.com/cpcnigeria" target="__blank">Instagram</a>
                          </div>
                          <div class="row footer-info-content-text">
                            <a href="//facebook.com/cpcng" target="__blank">Facebook</a>
                          </div>
                        </div>
                        <div class="col-md-4 footer-content-section">
                          <div class="row footer-info-content-header">
                            APPS
                          </div>
                          <div class="row footer-info-content-text">
                            <a href="https://play.google.com/store/apps/details?id=com.softcom.cpc.android" target="__blank"><img src="{{ FE_IMAGE.'png/playstore.png' }}" alt="playstore" /></a>
                          </div>
                          <br />
                          <div class="row footer-info-content-text">
                            <a href="https://itunes.apple.com/us/app/consumer-protection-council/id1355501646?mt=8&ign-mpt=uo%3D4" target="__blank"><img src="{{ FE_IMAGE.'png/appstore.png' }}" target="__blank" alt="appstore" /></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="landing-footer-text">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-8">
                    <span style="font-size: 1.3rem">This is the official website of the Federal Competition and Consumer Protection Commission (FCCPC)
                      <br>Copyright © 2020 Federal Competition and Consumer Protection Commission</span>
                  </div>
                  <div class="col-md-4">

                    <br/>
                    <span class="float-right float-right-inverse" style="font-size: 1.5rem">  Powered by <a href="https://techbarn.ng/" target="_blank">techbarn </span>

                  </div>
                </div>
                {{-- <img src="{{ FE_IMAGE.'png/techbarn.png' }}" alt="techbarn" /> --}}
              </div>
            </div>
          </div>
        </div>
    <script type="text/javascript" src="{{ pc_asset(FE_JS.'jquery.min.js') }}"></script>
    <script
      src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
      integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"
      integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J"
      crossorigin="anonymous"
    ></script>
    <script type="text/javascript" src="{{ pc_asset(FE_JS.'app.js') }}"></script>
    @yield('custom.javascript')
</body>
</html>

