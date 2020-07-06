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
    <link rel="manifest" href="http://fccpc.gov.ng/uploads/favicons/site.webmanifest">
    <!-- Core CSS file -->
    <link rel="stylesheet" href="{{ pc_asset(FE_CSS.'photoSwipe.css') }}">
    <link rel="stylesheet" href="{{ pc_asset(FE_CSS.'default-skin.css') }}">
    <link rel="canonical" href="{{ agencyLink() }}" />
    <link href="{{ pc_asset(FE_CSS.'flickity.css') }}" rel="stylesheet" />
    <link href="{{ pc_asset(FE_CSS.'style.css') }}" rel="stylesheet" />
    <link href="{{ pc_asset(FE_CSS.'custom.css') }}" rel="stylesheet" />
    <link href="{{ pc_asset(FE_CSS.'custom.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'toaster.css') }}" />
    <link rel="canonical" href="{{ agencyLink() }}" />
    <!-- UI JS file -->
    <script src="{{ pc_asset(FE_JS.'photoswipe-ui.min.js') }}"></script>
    <script src="{{ pc_asset(FE_JS.'flickity.pkgd.min.js') }}"></script>
    <script type="application/ld+json">
    {"description":"FCCPC is the apex consumer protection agency in Nigeria established to improve the well-being of the people.","@type":"WebSite","headline":"Federal Competition and Consumer Protection Commission","url":"http://fccpc.gov.ng/","name":"Federal Competition and Consumer Protection Commission","@context":"https://schema.org"}</script>
</head>
<body class="is-home is-loading">

    {{-- Navigation --}}
    <a class="skip-link sr" href="#main"></a>
    <h1 class="sr">Federal Competition and Consumer Protection Commission</h1>
    <div class="maxwidth-sl top-nav mx-auto">
        <div class="wrapper top-break al-i-c j-c-c">
            <div class="d-flx logos sp-b al-i-c">
                <div class="d-flx al-i-c">
                    <div class="logo prefix">
                        <a href="/">
                            <img src="{{ asset(FE_IMAGE.'icons/fccpc_logo.jpg') }}" alt="">
                        </a>
                    </div>
                    <p class="smalllh"><a class="site-title" href="<?= route('home.index'); ?>">Federal Competition and Consumer Protection Commission</a></p>
                </div>
                <div class="small-logo suffix is-wider">
                    <img src="{{ asset(FE_IMAGE.'icons/coat_of_arm.png') }}" alt="">
                </div>
            </div>
            <div class="d-flx j-c-sb sp-t">
                <div class="menu-icon suffix openbtn"style="font-size: 24px">&#9776;
                    <span class="suffix smalltext">Menu</span>
                </div>
            </div>
        </div>
    </div>
    <nav class="desktopnav show-smallup">
        <h3 class="sr">Desktop navigation</h3>
        <div class="maxwidth-sl wrapper-x mx-auto">
            <ul class="none d-flx pos-rel main-nav">
                <li class="py-1 mg-1 main-list">
                    <a href="/">{!! config('app.name') !!}</a>
                </li>
                <li class="py-1 mg-1 main-list">
                    <a href="{{ route('home.fee.calculator') }}">Fee Calculator</a>
                </li>
                <li class="py-1 mg-1 main-list">
                    <a href="{{ route('home.faqs') }}">FAQs</a>
                </li>
                <li class="py-1 mg-1 main-list">
                    <a href="#">Application</a>
                    <ul class="none pos-abs sublist">
                        <li class="sub-list-item">
                            <a href="{{ route('applicant.show') }}">
                                <p>Submit Application</p>
                            </a>
                        </li>
                        <li class="sub-list-item">
                            <a href="{{ route('enquiries.index') }}">
                                <p>Make Enquiry</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="py-1 mg-1 main-list">
                    <a href="#">Admin</a>
                    <ul class="none pos-abs sublist">
                        <li class="sub-list-item">
                            <a href="{{ route('login') }}">
                                <p>Login</p>
                            </a>
                        </li>
                        <li class="sub-list-item">
                            <a href="{{ route('register') }}">
                                <p>Register</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div id="myNav" class="overlay">
        <button class="closebtn">×</button>
        <div class="overlay-content smalltext">
            <ul class="none">
                <li class="smalltext">
                    <a class="smalltext" href="/">{!! config('app.name') !!}</a>
                </li>
                <li>
                    <a class="smalltext" href="{{ route('applicant.show') }}">Submit Application</a>
                </li>
                <li>
                    <a class="smalltext" href="{{ route('enquiries.index') }}">Make Enquiry</a>
                </li>
                <li>
                    <a class="smalltext" href="{{ route('home.fee.calculator') }}">Fee Calculator</a>
                </li>
                <li>
                    <a class="smalltext" href="{{ route('login') }}">Login</a>
                </li>
                <li>
                    <a class="smalltext" href="{{ route('home.faqs') }}">FAQs</a>
                </li>
            </ul>
        </div>
    </div>

    {{-- Content --}}
    @yield('content')

    {{-- Footer --}}
    <footer class="main-footer nanotext co-platinum bg-primary">
        <div class="maxwidth-sl mx-auto">
            <div class="wrapper">
                <h2 class="sr">Give the footer a heading</h2>
                <div class="container mx-auto grid">
                    <div class="col-12 col-9-md">
                        <nav class="grid is-multi-col mostly-4">
                            <div>
                                <h3 class="co-white smalltext">About Us</h3>
                                <ul class="none">
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/about/commission/">
                                            The Commission
                                        </a>
                                    </li>
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/about/what-we-do/">
                                            What We Do
                                        </a>
                                    </li>
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/about/strategic-goals/">
                                            Strategic Goals
                                        </a>
                                    </li>
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/about/departments/">
                                            Departments & Units
                                        </a>
                                    </li>
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/about/people/">
                                            People
                                        </a>
                                    </li>
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/about/alliances/">
                                            Strategic Alliances
                                        </a>
                                    </li>
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/faqs/">
                                            FAQs
                                        </a>
                                    </li>
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/contact/">
                                            Contact
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="co-white smalltext">Consumers</h3>
                                <ul class="none">
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/consumers/rights/">
                                            Consumer Rights
                                        </a>
                                    </li>
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/consumers/responsibilities/">
                                            Consumer Responsibilities
                                        </a>
                                    </li>
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/consumers/complaints-handling-procedures/">
                                            Complaints Handling Procedures
                                        </a>
                                    </li>
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/consumers/import-prohibition-list">
                                            Import Prohibition List
                                        </a>
                                    </li>
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/consumers/absolutely-prohibited-list/">
                                            Absolutely Prohibited Product List
                                        </a>
                                    </li>
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/consumers/testimonials/">
                                            Testimonials
                                        </a>
                                    </li>
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/blog/">
                                            Consumer Blog
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="co-white smalltext">Businesses</h3>
                                <ul class="none">
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/businesses/obligations/">
                                            Business Obligations
                                        </a>
                                    </li>
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/businesses/sales-promotion-guidelines/">
                                            Sales Promotions Regulations and Guidelines
                                        </a>
                                    </li>
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/businesses/register-sales-promotion/">
                                            Register Sales Promotion
                                        </a>
                                    </li>
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/businesses/documents/">
                                            Sales Promotion Documents
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="co-white smalltext">Guidelines</h3>
                                <ul class="none">
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/guidelines/documents/">
                                            Relevant Documents
                                        </a>
                                    </li>
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/guidelines/mergers/">
                                            Merger Guidelines
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="co-white smalltext">Publications</h3>
                                <ul class="none">
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/publications/annual-reports/">
                                            Annual Reports
                                        </a>
                                    </li>
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/publications/materials/">
                                            Consumer Education Materials
                                        </a>
                                    </li>
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/publications/PBOR">
                                            PBOR
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="co-white smalltext">News & Events</h3>
                                <ul class="none">
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/news-events/releases/">
                                            Releases
                                        </a>
                                    </li>
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/news-events/speeches/">
                                            Speeches
                                        </a>
                                    </li>
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/news-events/announcements/">
                                            Announcements
                                        </a>
                                    </li>
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/news-events/alerts/">
                                            Alert/Advisory
                                        </a>
                                    </li>
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/news-events/events/">
                                            Events
                                        </a>
                                    </li>
                                    <li>
                                        <a class="co-gainsboro" href="http://fccpc.gov.ng/gallery/">
                                            Gallery
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="col-12 col-9-md offset-9-cols-from-left">
                        <div>
                            <h3 class="co-white smalltext">
                                Headquarters
                            </h3>
                            <p class="co-gainsboro">
                                <span class="co-white">Address:</span>
                                <span>No. 17 Nile Street, Maitama, Abuja.</span>
                            </p>
                            <p class="co-white">
                                <span class="co-white">Phone:</span>
                                <span class="co-white">0805 600 2020, 0805 600 3030</span>
                            </p>
                            <p class="co-white">
                                <span class="co-white">Email:</span>
                                <span>
                                    <a class="co-white" href="mailto:contact@fccpc.gov.ng">
                                        contact@fccpc.gov.ng
                                    </a>
                                </span>
                            </p>
                        </div>
                        <div>
                            <h3 class="co-white smalltext">
                                Social
                            </h3>
                            <ul class="none d-flx">
                                <li class="prefix is-even-wider">
                                    <a href="//facebook.com/cpcng" target="_blank">
                                        <svg fill="#fff" aria-labelledby="simpleicons-facebook-icon" role="img" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <title id="simpleicons-facebook-icon">Facebook icon</title>
                                            <path d="M22.676 0H1.324C.593 0 0 .593 0 1.324v21.352C0 23.408.593 24 1.324 24h11.494v-9.294H9.689v-3.621h3.129V8.41c0-3.099 1.894-4.785 4.659-4.785 1.325 0 2.464.097 2.796.141v3.24h-1.921c-1.5 0-1.792.721-1.792 1.771v2.311h3.584l-.465 3.63H16.56V24h6.115c.733 0 1.325-.592 1.325-1.324V1.324C24 .593 23.408 0 22.676 0"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="prefix is-even-wider">
                                    <a href="//twitter.com/cpcnig" target="_blank">
                                        <svg fill="#fff" aria-labelledby="simpleicons-twitter-icon" role="img" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <title id="simpleicons-twitter-icon">Twitter icon</title>
                                            <path d="M23.954 4.569c-.885.389-1.83.654-2.825.775 1.014-.611 1.794-1.574 2.163-2.723-.951.555-2.005.959-3.127 1.184-.896-.959-2.173-1.559-3.591-1.559-2.717 0-4.92 2.203-4.92 4.917 0 .39.045.765.127 1.124C7.691 8.094 4.066 6.13 1.64 3.161c-.427.722-.666 1.561-.666 2.475 0 1.71.87 3.213 2.188 4.096-.807-.026-1.566-.248-2.228-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.413.111-.849.171-1.296.171-.314 0-.615-.03-.916-.086.631 1.953 2.445 3.377 4.604 3.417-1.68 1.319-3.809 2.105-6.102 2.105-.39 0-.779-.023-1.17-.067 2.189 1.394 4.768 2.209 7.557 2.209 9.054 0 13.999-7.496 13.999-13.986 0-.209 0-.42-.015-.63.961-.689 1.8-1.56 2.46-2.548l-.047-.02z"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="prefix is-even-wider">
                                    <a href="//instagram.com/cpcnigeria" target="_blank">
                                        <svg fill="#fff" aria-labelledby="simpleicons-instagram-icon" role="img" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <title id="simpleicons-instagram-icon">Instagram icon</title>
                                            <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="co-white smalltext">
                                Apps
                            </h3>
                            <ul class="none">
                                <li class="prefix mb-1 d-ibl">
                                    <a class="d-blk" href="https://play.google.com/store/apps/details?id=com.softcom.cpc.android" target="_blank">
                                        <svg width="130px" id="Group_3856" data-name="Group 3856" xmlns="http://www.w3.org/2000/svg" viewBox="2520.515 1031 98.519 32.754">
                                            <path id="background" class="cls-1" d="M3.894,0H94.409a3.97,3.97,0,0,1,4,3.93V28.823a3.97,3.97,0,0,1-4,3.93H3.894a3.97,3.97,0,0,1-4-3.93V3.93A3.97,3.97,0,0,1,3.894,0Z" transform="translate(2520.622 1031)"/>
                                            <path id="Path_1621" data-name="Path 1621" class="cls-2" d="M80.009,169.011a.636.636,0,0,0-.009.112v14.885a.329.329,0,0,0,.2.338l7.928-7.556-8.12-7.779Zm.293-.318a.636.636,0,0,1,.429.086l6.595,3.654,3.4,1.883-2.283,2.176-8.141-7.8Zm10.019,10.2-1.685.933-1.31.725-6.14,3.4,7.248-6.87,1.888,1.809Zm.4-.219.027-.015,3.286-1.821c.385-.214.348-.507.023-.675-.254-.131-2.124-1.172-2.935-1.624l-2.372,2.248,1.97,1.887Z" transform="translate(2449.518 872.234)"/>
                                            <g id="Group_1724" data-name="Group 1724" transform="translate(2550.3 1036.649)">
                                                <path id="Path_1622" data-name="Path 1622" class="cls-2" d="M457.205,113.9l-.62.588c-.143.079-.286.171-.428.236a2.986,2.986,0,0,1-1.258.246,2.762,2.762,0,0,1-1.725-.509,3.378,3.378,0,0,1-1.322-2.749,2.949,2.949,0,0,1,2.97-3.013,2.511,2.511,0,0,1,1.335.365,2.181,2.181,0,0,1,.908,1.291l-3.047,1.238-1,.078a2.885,2.885,0,0,0,2.669,2.622,3.187,3.187,0,0,0,1.491-.41s.084-.044.024.016Zm-1.862-3.325c.245-.091.372-.17.372-.352a1.287,1.287,0,0,0-1.27-1.13,1.6,1.6,0,0,0-1.473,1.827c0,.221.026.457.039.693Zm-4.5,3.254c0,.505.09.584.514.624.221.026.442.038.66.064l-.478.286h-2.277c.3-.39.35-.429.35-.689v-.29l0-7.734h-1.005l.968-.469h1.848a.9.9,0,0,0-.572.831l0,7.377Zm-3.532-4.491a2.129,2.129,0,0,1-.167,3.6.924.924,0,0,0-.362.636.716.716,0,0,0,.335.56l.466.363a2.271,2.271,0,0,1,1.083,1.822c0,1.223-1.174,2.457-3.393,2.457-1.869,0-2.773-.9-2.773-1.86a1.87,1.87,0,0,1,.994-1.586,5.518,5.518,0,0,1,2.463-.6,1.377,1.377,0,0,1-.388-.886,1.184,1.184,0,0,1,.129-.507c-.141.014-.283.027-.412.027a2.048,2.048,0,0,1-2.141-2.043,2.343,2.343,0,0,1,.826-1.743,3.5,3.5,0,0,1,2.309-.716h2.658l-.826.47h-.8Zm-.907,5.759a1.975,1.975,0,0,0-.3-.014,5.074,5.074,0,0,0-1.364.212,1.48,1.48,0,0,0-1.12,1.364c0,.939.9,1.615,2.288,1.615,1.248,0,1.911-.609,1.911-1.43,0-.675-.429-1.032-1.415-1.748Zm.365-2.5a1.316,1.316,0,0,0,.323-.947c0-.932-.551-2.385-1.618-2.385a1.192,1.192,0,0,0-.9.43,1.5,1.5,0,0,0-.282.957c0,.868.5,2.308,1.6,2.308a1.307,1.307,0,0,0,.872-.363Zm-7.5,2.379a3.069,3.069,0,0,1-3.154-3.089,3.222,3.222,0,0,1,3.348-3.182,3.044,3.044,0,0,1,3.09,3.09A3.178,3.178,0,0,1,439.275,114.968Zm1.607-1.06a2.381,2.381,0,0,0,.39-1.456c0-1.157-.544-3.362-2.153-3.362a1.8,1.8,0,0,0-1.169.446,2,2,0,0,0-.6,1.6c0,1.3.633,3.437,2.205,3.437a1.652,1.652,0,0,0,1.324-.668Zm-8.493,1.06a3.068,3.068,0,0,1-3.154-3.089,3.223,3.223,0,0,1,3.349-3.182,3.043,3.043,0,0,1,3.089,3.09A3.177,3.177,0,0,1,432.389,114.968Zm1.608-1.06a2.4,2.4,0,0,0,.389-1.456c0-1.157-.546-3.362-2.154-3.362a1.79,1.79,0,0,0-1.167.446,2,2,0,0,0-.6,1.6c0,1.3.636,3.437,2.206,3.437a1.654,1.654,0,0,0,1.323-.668Zm-5.614.673-1.74.4a12.643,12.643,0,0,1-2.009.21A4.339,4.339,0,0,1,420,110.759a4.613,4.613,0,0,1,4.916-4.581,7.07,7.07,0,0,1,1.864.255,4.674,4.674,0,0,1,1.605.762l-1.011.966-.426.1.3-.487a3.462,3.462,0,0,0-2.6-1.151,3.372,3.372,0,0,0-3.368,3.614,4.317,4.317,0,0,0,4.306,4.47,3.6,3.6,0,0,0,1.545-.3v-1.975l-1.838.1.974-.527h2.579l-.315.306a.281.281,0,0,0-.12.2c-.013.111-.025.466-.025.591v1.493Zm32.578-.624v3.307h-.655V108.85h.655v.958a2.6,2.6,0,0,1,2.112-1.11c1.625,0,2.719,1.235,2.719,3.191s-1.094,3.2-2.719,3.2a2.6,2.6,0,0,1-2.112-1.135Zm4.159-2.018c0-1.489-.769-2.625-2.133-2.625a2.607,2.607,0,0,0-2.009,1.258v2.722a2.63,2.63,0,0,0,2.009,1.283C464.351,114.576,465.12,113.431,465.12,111.939Zm1.568-5.425h.672v8.454h-.672Zm7.976,10.167a1.538,1.538,0,0,0,.531.1c.4,0,.68-.164.93-.745l.478-1.086-2.581-6.143h.731l2.214,5.323,2.192-5.323h.741l-3.148,7.432a1.61,1.61,0,0,1-1.546,1.134,2.584,2.584,0,0,1-.655-.088l.112-.606Zm-1.849-1.722c-.044-.212-.077-.4-.1-.556a3.735,3.735,0,0,1-.032-.477,2.81,2.81,0,0,1-2.285,1.154,2.152,2.152,0,0,1-1.5-.479,1.672,1.672,0,0,1-.533-1.3,1.545,1.545,0,0,1,.773-1.335,3.551,3.551,0,0,1,2-.513h1.537v-.761a1.277,1.277,0,0,0-.447-1.033,1.908,1.908,0,0,0-1.262-.377,1.994,1.994,0,0,0-1.207.341,1.038,1.038,0,0,0-.457.858h-.674l-.014-.033a1.42,1.42,0,0,1,.636-1.219,2.764,2.764,0,0,1,1.753-.526,2.729,2.729,0,0,1,1.738.519,1.772,1.772,0,0,1,.657,1.484v3.022a4.794,4.794,0,0,0,.037.631,4.024,4.024,0,0,0,.131.607h-.759Zm-2.339-.44a2.46,2.46,0,0,0,1.372-.375,1.894,1.894,0,0,0,.831-.962V112h-1.543a2.514,2.514,0,0,0-1.461.4,1.151,1.151,0,0,0-.579.957,1.062,1.062,0,0,0,.369.845,1.483,1.483,0,0,0,1.011.322ZM420,100.821a2.005,2.005,0,0,1,2.16-1.982,1.969,1.969,0,0,1,1.654.793l-.586.316a1.394,1.394,0,1,0-1.068,2.257,1.54,1.54,0,0,0,.975-.344v-.592H421.9v-.592h1.951v1.43a2.3,2.3,0,0,1-1.691.7,2.012,2.012,0,0,1-2.16-1.987Zm4.786,1.929V98.9h2.86v.6h-2.127v.993H427.6v.595h-2.084v1.074h2.127v.595Zm4.8,0V99.493h-1.244v-.6h3.21v.6h-1.244v3.257Zm4.533-3.852h.7v3.852h-.7Zm2.7,3.852V99.493H435.58v-.6h3.21v.6h-1.244v3.257Zm4.358-1.926a2.136,2.136,0,1,1,2.13,1.984A1.988,1.988,0,0,1,441.183,100.824Zm3.5-.029a1.371,1.371,0,1,0-1.371,1.372A1.311,1.311,0,0,0,444.685,100.794Zm4.44,1.955-2.144-2.755v2.755h-.72V98.9H447l2.1,2.668V98.9h.721v3.852Z" transform="translate(-419.998 -98.839)"/>
                                            </g>
                                        </svg>
                                    </a>
                                </li>
                                <li class="prefix mb-1 d-ibl">
                                    <a class="d-blk" href="https://itunes.apple.com/us/app/consumer-protection-council/id1355501646?mt=8&ign-mpt=uo%3D4" target="_blank">
                                            <svg width="130px" id="Group_3855" data-name="Group 3855" xmlns="http://www.w3.org/2000/svg" viewBox="2412.736 1031 96.755 32.754">
                                            <path id="background" class="cls-1" d="M3.823,0H92.717a3.934,3.934,0,0,1,3.93,3.93V28.823a3.934,3.934,0,0,1-3.93,3.93H3.823a3.934,3.934,0,0,1-3.93-3.93V3.93A3.934,3.934,0,0,1,3.823,0Z" transform="translate(2412.844 1031)"/>
                                            <path id="Fill-2" class="cls-2" d="M12.6,12.742a4.224,4.224,0,0,1,2-3.537,4.345,4.345,0,0,0-3.4-1.841c-1.428-.151-2.817.858-3.544.858S5.79,7.384,4.585,7.4A4.517,4.517,0,0,0,.779,9.729c-1.644,2.85-.419,7.042,1.159,9.348.793,1.127,1.71,2.391,2.922,2.345,1.179-.046,1.625-.753,3.046-.753s1.828.753,3.059.727c1.271-.02,2.063-1.133,2.83-2.273a9.24,9.24,0,0,0,1.291-2.633A4.086,4.086,0,0,1,12.6,12.742" transform="translate(2421.319 1033.888)"/>
                                            <path id="Fill-3" class="cls-2" d="M15.092,2.974A4.156,4.156,0,0,0,16.042,0a4.214,4.214,0,0,0-2.732,1.415,3.985,3.985,0,0,0-.976,2.863,3.491,3.491,0,0,0,2.758-1.3" transform="translate(2416.497 1036.765)"/>
                                            <path id="Fill-4" class="cls-2" d="M8.151,9.988H6.5L5.6,7.145H2.452L1.594,9.988h-1.6L3.1.312H5.027ZM5.328,5.952,4.509,3.43c-.085-.262-.249-.865-.485-1.821H3.992c-.1.413-.249,1.022-.459,1.821L2.727,5.952Z" transform="translate(2442.874 1045.159)"/>
                                            <path id="Fill-5" class="cls-2" d="M22.223,8.061a3.929,3.929,0,0,1-.97,2.81,2.824,2.824,0,0,1-2.149.917,2.152,2.152,0,0,1-1.991-.989v3.662H15.561V6.947c0-.747-.02-1.507-.059-2.293h1.363l.085,1.107h.026a2.751,2.751,0,0,1,4.409-.275A3.8,3.8,0,0,1,22.223,8.061Zm-1.579.052a2.848,2.848,0,0,0-.459-1.677,1.588,1.588,0,0,0-1.349-.688,1.646,1.646,0,0,0-1.042.38,1.754,1.754,0,0,0-.609,1,2.121,2.121,0,0,0-.072.472V8.762a1.876,1.876,0,0,0,.465,1.284,1.548,1.548,0,0,0,1.212.524A1.6,1.6,0,0,0,20.153,9.9a2.959,2.959,0,0,0,.491-1.782Z" transform="translate(2436.801 1043.515)"/>
                                            <path id="Fill-6" class="cls-2" d="M35.4,8.061a3.929,3.929,0,0,1-.97,2.81,2.824,2.824,0,0,1-2.149.917A2.152,2.152,0,0,1,30.29,10.8v3.662H28.737V6.947c0-.747-.02-1.507-.059-2.293h1.363l.085,1.107h.026a2.751,2.751,0,0,1,4.409-.275A3.8,3.8,0,0,1,35.4,8.061Zm-1.579.052a2.848,2.848,0,0,0-.459-1.677,1.588,1.588,0,0,0-1.349-.688,1.646,1.646,0,0,0-1.042.38,1.79,1.79,0,0,0-.609,1,2.121,2.121,0,0,0-.072.472V8.762a1.876,1.876,0,0,0,.465,1.284,1.548,1.548,0,0,0,1.212.524A1.591,1.591,0,0,0,33.329,9.9a2.915,2.915,0,0,0,.491-1.782Z" transform="translate(2431.643 1043.515)"/>
                                            <path id="Fill-7" class="cls-2" d="M50.615,7.187A2.591,2.591,0,0,1,49.757,9.2a3.809,3.809,0,0,1-2.633.845,4.608,4.608,0,0,1-2.5-.6l.36-1.291a4.351,4.351,0,0,0,2.24.6,2.11,2.11,0,0,0,1.363-.393,1.284,1.284,0,0,0,.491-1.055,1.364,1.364,0,0,0-.4-.989,3.74,3.74,0,0,0-1.336-.747C45.63,4.934,44.785,4.01,44.785,2.8a2.458,2.458,0,0,1,.9-1.952A3.56,3.56,0,0,1,48.06.086a4.675,4.675,0,0,1,2.195.459L49.862,1.8A3.866,3.866,0,0,0,48,1.357a1.93,1.93,0,0,0-1.284.4,1.163,1.163,0,0,0-.386.878,1.176,1.176,0,0,0,.445.943,5,5,0,0,0,1.408.747A4.722,4.722,0,0,1,50.019,5.5a2.451,2.451,0,0,1,.6,1.684" transform="translate(2425.402 1045.247)"/>
                                            <path id="Fill-8" class="cls-2" d="M60.18,4.8H58.47V8.183c0,.858.3,1.291.9,1.291a2.875,2.875,0,0,0,.688-.072l.046,1.179a3.6,3.6,0,0,1-1.205.17,1.855,1.855,0,0,1-1.435-.563,2.735,2.735,0,0,1-.518-1.88V4.79H55.935V3.631h1.015V2.353l1.52-.459V3.631h1.71V4.8" transform="translate(2420.972 1044.539)"/>
                                            <path id="Fill-9" class="cls-2" d="M71.154,8.091a3.832,3.832,0,0,1-.917,2.64,3.283,3.283,0,0,1-2.555,1.061,3.144,3.144,0,0,1-2.45-1.015,3.688,3.688,0,0,1-.911-2.568,3.8,3.8,0,0,1,.937-2.653,3.269,3.269,0,0,1,2.535-1.035,3.188,3.188,0,0,1,2.47,1.022,3.641,3.641,0,0,1,.891,2.548Zm-1.6.033a3.126,3.126,0,0,0-.413-1.644,1.608,1.608,0,0,0-2.817,0,3.138,3.138,0,0,0-.413,1.677A3.11,3.11,0,0,0,66.319,9.8a1.591,1.591,0,0,0,2.8-.013A3.174,3.174,0,0,0,69.549,8.124Z" transform="translate(2417.689 1043.511)"/>
                                            <path id="Fill-10" class="cls-2" d="M81.432,6.017a2.872,2.872,0,0,0-.491-.039,1.463,1.463,0,0,0-1.264.616,2.337,2.337,0,0,0-.386,1.376v3.662H77.737V6.849c0-.806-.013-1.539-.046-2.195h1.349L79.1,5.991h.046a2.378,2.378,0,0,1,.773-1.107,1.886,1.886,0,0,1,1.12-.373,3.263,3.263,0,0,1,.386.026l.007,1.48" transform="translate(2412.455 1043.515)"/>
                                            <path id="Fill-11" class="cls-2" d="M91.237,7.8a3.543,3.543,0,0,1-.059.7H86.527a2.022,2.022,0,0,0,.675,1.579,2.323,2.323,0,0,0,1.52.485,5.219,5.219,0,0,0,1.88-.328l.242,1.074a5.821,5.821,0,0,1-2.339.432,3.388,3.388,0,0,1-2.548-.956,3.531,3.531,0,0,1-.924-2.561A4,4,0,0,1,85.9,5.6a2.968,2.968,0,0,1,2.437-1.12,2.589,2.589,0,0,1,2.28,1.12,3.789,3.789,0,0,1,.622,2.2Zm-1.48-.4a2.089,2.089,0,0,0-.3-1.192,1.352,1.352,0,0,0-1.232-.649,1.472,1.472,0,0,0-1.232.629,2.33,2.33,0,0,0-.459,1.205l3.223.007Z" transform="translate(2409.581 1043.528)"/>
                                            <path id="Fill-12" class="cls-2" d="M3.983,5.24H3.171l-.445-1.4H1.18L.754,5.24H-.032L1.494.484h.943Zm-1.4-1.985-.4-1.245c-.039-.124-.118-.426-.242-.9H1.933c-.052.2-.118.5-.229.9L1.311,3.255Z" transform="translate(2443.472 1036.772)"/>
                                            <path id="Fill-13" class="cls-2" d="M10.734,2.659l-1.3,3.433H8.7L7.439,2.659h.819l.583,1.815c.1.3.183.59.249.865h.02c.059-.249.144-.537.249-.865l.576-1.815h.8" transform="translate(2440.547 1035.92)"/>
                                            <path id="Fill-14" class="cls-2" d="M16.027,6.054l-.059-.393h-.02a1.179,1.179,0,0,1-1,.472A1,1,0,0,1,13.9,5.123c0-.845.734-1.284,2-1.284V3.774c0-.452-.242-.675-.714-.675a1.6,1.6,0,0,0-.9.255l-.157-.5a2.2,2.2,0,0,1,1.179-.295c.9,0,1.349.472,1.349,1.422V5.248a4.566,4.566,0,0,0,.052.819l-.688-.013Zm-.1-1.71c-.845,0-1.271.2-1.271.694a.486.486,0,0,0,.524.537.729.729,0,0,0,.747-.7Z" transform="translate(2438.019 1035.958)"/>
                                            <path id="Fill-15" class="cls-2" d="M20.938,1.147a.446.446,0,0,1-.452-.459.465.465,0,0,1,.93,0,.446.446,0,0,1-.478.459Zm-.367.563h.76V5.137h-.76Z" transform="translate(2435.439 1036.869)"/>
                                            <path id="Fill-16" class="cls-2" d="M24.1.075h.76v5H24.1Z" transform="translate(2434.023 1036.932)"/>
                                            <path id="Fill-17" class="cls-2" d="M29.3,6.049l-.059-.393h-.02a1.179,1.179,0,0,1-1,.472,1,1,0,0,1-1.048-1.009c0-.845.734-1.284,2-1.284V3.77c0-.452-.242-.675-.714-.675a1.6,1.6,0,0,0-.9.255l-.157-.5a2.2,2.2,0,0,1,1.179-.295c.9,0,1.349.472,1.349,1.422V5.237a5.416,5.416,0,0,0,.046.819H29.3V6.049Zm-.1-1.71c-.845,0-1.271.2-1.271.694a.486.486,0,0,0,.524.537.729.729,0,0,0,.747-.7Z" transform="translate(2432.823 1035.962)"/>
                                            <path id="Fill-18" class="cls-2" d="M35.644,5.159a1.167,1.167,0,0,1-1.081-.609h-.013L34.5,5.08h-.649c.02-.275.026-.583.026-.924V.075h.766V2.152h.013a1.178,1.178,0,0,1,1.094-.57c.825,0,1.4.707,1.4,1.736A1.651,1.651,0,0,1,35.644,5.159Zm-.157-2.981a.875.875,0,0,0-.838.911v.6a.838.838,0,0,0,.825.858c.57,0,.911-.465.911-1.205C36.385,2.65,36.031,2.178,35.487,2.178Z" transform="translate(2430.205 1036.932)"/>
                                            <path id="Fill-19" class="cls-2" d="M41.133.075h.76v5h-.76Z" transform="translate(2427.356 1036.932)"/>
                                            <path id="Fill-20" class="cls-2" d="M47.254,4.508H44.967a.984.984,0,0,0,1.081,1.015,2.577,2.577,0,0,0,.924-.164l.118.531a2.778,2.778,0,0,1-1.146.21,1.592,1.592,0,0,1-1.71-1.729A1.675,1.675,0,0,1,45.858,2.53a1.444,1.444,0,0,1,1.428,1.631,1.328,1.328,0,0,1-.033.347Zm-.694-.544c0-.531-.269-.9-.753-.9a.9.9,0,0,0-.832.9Z" transform="translate(2426.143 1035.971)"/>
                                            <path id="Fill-21" class="cls-2" d="M55.724,6.128a1.63,1.63,0,0,1-1.651-1.762,1.669,1.669,0,0,1,1.71-1.815,1.618,1.618,0,0,1,1.651,1.756A1.682,1.682,0,0,1,55.724,6.128Zm.033-3.02c-.55,0-.9.518-.9,1.232s.36,1.218.9,1.218.9-.55.9-1.238-.354-1.212-.891-1.212Z" transform="translate(2422.291 1035.962)"/>
                                            <path id="Fill-22" class="cls-2" d="M64.393,6.045h-.76V4.073c0-.609-.236-.911-.694-.911a.788.788,0,0,0-.76.838V6.039h-.76V3.6c0-.3-.007-.629-.026-.983h.668l.033.531h.02a1.233,1.233,0,0,1,1.087-.6c.721,0,1.192.55,1.192,1.448V6.045" transform="translate(2419.425 1035.967)"/>
                                            <path id="Fill-23" class="cls-2" d="M73.18,2.688h-.839V4.351c0,.426.151.635.445.635a1.667,1.667,0,0,0,.341-.033l.02.576a1.651,1.651,0,0,1-.59.085c-.6,0-.956-.334-.956-1.2V2.688h-.5v-.57h.5V1.489l.747-.229v.852h.838v.576" transform="translate(2415.624 1036.468)"/>
                                            <path id="Fill-24" class="cls-2" d="M79.234,5.08h-.76V3.121c0-.616-.236-.924-.694-.924a.747.747,0,0,0-.76.812V5.074h-.76v-5h.76V2.132h.013a1.152,1.152,0,0,1,1.028-.557c.727,0,1.173.563,1.173,1.461V5.08" transform="translate(2413.605 1036.932)"/>
                                            <path id="Fill-25" class="cls-2" d="M85.6,4.508H83.312a.984.984,0,0,0,1.081,1.015,2.577,2.577,0,0,0,.924-.164l.118.531a2.778,2.778,0,0,1-1.146.21,1.592,1.592,0,0,1-1.71-1.729A1.675,1.675,0,0,1,84.2,2.53a1.444,1.444,0,0,1,1.428,1.631,1.328,1.328,0,0,1-.033.347ZM84.9,3.964c0-.531-.269-.9-.753-.9a.9.9,0,0,0-.832.9Z" transform="translate(2411.132 1035.971)"/>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 bod-top pt-2 pb-1">
                        <div class="pb-1 co-gainsboro">
                            <p>This is the official website of the Federal Competition and Consumer Protection Commission (FCCPC)</p>
                        </div>
                        <div class="last-footer d-flx fw-w al-i-c">
                            <p class="m-0 co-white"><strong><a class="co-white" href="http://fccpc.gov.ng/copyright">Copyright</a> &copy; {{ date('Y') }} Federal Competition and Consumer Protection Commission</strong></p>
                            <ul class="d-flx none m-0 a-i-c">
                                <li class="suffix is-even-wider">
                                    <a class="m-0 co-white" href="/terms-of-use/">Terms of Use</a>
                                </li>
                                <li class="suffix is-even-wider">
                                    <a class="m-0 co-white" href="/privacy-policy/">Privacy Policy</a>
                                </li>
                                <li class="suffix is-even-wider">
                                    <a class="m-0 co-white" href="/sitemap/">Sitemap</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ pc_asset(FE_JS.'vue.min.js') }}"></script>
    <script src="{{ pc_asset(FE_JS.'main.js')    }}"></script>
    <script src="{{ pc_asset(BE_JS.'toaster.js') }}"></script>
    <script type="text/javascript">
        toastr.options = {
            "progressBar": true,
            "positionClass": "toast-bottom-right",
        };
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif
        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif
    </script>

    {{-- Custom JS --}}
    @yield('custom.javascript')

</body>
</html>

