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
    <link rel="stylesheet" href="{{ pc_asset(FE_CSS.'main.css') }}" />
    <link rel="stylesheet" href="{{ pc_asset(FE_CSS.'custom.css') }}" />
</head>
<body class="content">
    <header class="fixed-top bg-dark shadow">
      <div class="header">
        <div class="header_logo">
          <a href="#">
            <img src="{{ FE_IMAGE.'png/logo.png' }}" alt="" />
          </a>
        </div>

        <div class="header__content">
          <a class="header__title" href="/">
            Federal Competition and Consumer Protection Commission
          </a>
        </div>

        <div class="header_logo">
          <a href="#">
            <img src="{{ FE_IMAGE.'png/coat_of_arm.png' }}" height="50px" />
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
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="/">
                M & A HOME
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home.fee.calculator') }}">Fee Calculator</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home.publications') }}">Publications</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Applications</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home.faqs') }}">Faqs</a>
            </li>

            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="http://example.com"
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
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <div class="container-fluid">
        @yield('content')
        <div class="landing-footer">
            <div class="landing-footer-info">
              <div class="container">
                <div class="footer-info-content">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="row">
                        <div class="col-md-6 footer-content-section">
                          <div class="row footer-info-content-header">
                            About Us
                          </div>
                          <div class="row footer-info-content-text">
                            The Commission
                          </div>
                          <div class="row footer-info-content-text">
                            What We Do
                          </div>
                          <div class="row footer-info-content-text">
                            Strategic Goals
                          </div>
                          <div class="row footer-info-content-text">
                            Departments & Units
                          </div>
                          <div class="row footer-info-content-text">
                            People
                          </div>
                          <div class="row footer-info-content-text">
                            Strategic Alliances
                          </div>
                          <div class="row footer-info-content-text">
                            FAQs
                          </div>
                          <div class="row footer-info-content-text">
                            Contact
                          </div>
                        </div>
                        <div class="col-md-6 footer-content-section">
                          <div class="row footer-info-content-header">
                            Consumers
                          </div>
                          <div class="row footer-info-content-text">
                            Consumer Rights
                          </div>
                          <div class="row footer-info-content-text">
                            Consumer Responsibilities
                          </div>
                          <div class="row footer-info-content-text">
                            Complaints Handling
                          </div>
                          <div class="row footer-info-content-text">
                            Procedures
                          </div>
                          <div class="row footer-info-content-text">
                            Import Prohibition List
                          </div>
                          <div class="row footer-info-content-text">
                            Absolutely Prohibited Product
                          </div>
                          <div class="row footer-info-content-text">
                            List
                          </div>
                          <div class="row footer-info-content-text">
                            Testimonials
                          </div>
                          <div class="row footer-info-content-text">
                            Consumer Blog
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
                            Business Obligations
                          </div>
                          <div class="row footer-info-content-text">
                            Sales Promotions Regulations and Guidelines
                          </div>
                          <div class="row footer-info-content-text">
                            Register Sales Promotion
                          </div>
                          <div class="row footer-info-content-text">
                            Sales Promotion Documents
                          </div>
                        </div>
                        <div class="col-md-4 footer-content-section">
                          <div class="row footer-info-content-header">
                            News & Events
                          </div>
                          <div class="row footer-info-content-text">
                            Releases
                          </div>
                          <div class="row footer-info-content-text">
                            Speeches
                          </div>
                          <div class="row footer-info-content-text">
                            Annoucements
                          </div>
                          <div class="row footer-info-content-text">
                            Alert/Advisory
                          </div>
                          <div class="row footer-info-content-text">
                            Events
                          </div>
                          <div class="row footer-info-content-text">
                            Gallery
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
                          <div class="row footer-info-content-header">
                            Guidelines
                          </div>
                          <div class="row footer-info-content-text">
                            Relevant Documents
                          </div>
                          <div class="row footer-info-content-text">
                            Merger Guidelines
                          </div>
                        </div>
                        <div class="col-md-6 footer-content-section">
                          <div class="row footer-info-content-header">
                            Publications
                          </div>
                          <div class="row footer-info-content-text">
                            Annual Reports
                          </div>
                          <div class="row footer-info-content-text">
                            Consumer Education Materials
                          </div>
                          <div class="row footer-info-content-text">
                            PBOR
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
                            Twitter
                          </div>
                          <div class="row footer-info-content-text">
                            Instagram
                          </div>
                          <div class="row footer-info-content-text">
                            Facebook
                          </div>
                        </div>
                        <div class="col-md-4 footer-content-section">
                          <div class="row footer-info-content-header">
                            APPS
                          </div>
                          <div class="row footer-info-content-text">
                            <img src="{{ FE_IMAGE.'png/playstore.png' }}" alt="playstore" />
                          </div>
                          <br />
                          <div class="row footer-info-content-text">
                            <img src="{{ FE_IMAGE.'png/appstore.png' }}" alt="appstore" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="landing-footer-text">
              <div class="container">
                <span>Built by Techbarn</span>
                <img src="{{ FE_IMAGE.'png/techbarn.png' }}" alt="techbarn" />
              </div>
            </div>
          </div>
        </div>
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
    <script
      src="https://code.jquery.com/jquery-3.5.1.min.js"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
      crossorigin="anonymous"
    ></script>
    <script type="text/javascript" src="{{ pc_asset(FE_JS.'app.js') }}"></script>
    @yield('custom.javascript')
</body>
</html>

