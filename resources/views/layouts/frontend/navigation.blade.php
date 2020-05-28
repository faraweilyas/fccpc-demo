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
	                <p class="smalllh"><a class="site-title" href="/">Federal Competition and Consumer Protection Commission</a></p>
	            </div>
	            <div class="small-logo suffix is-wider">
	                <img src="{{ asset(FE_IMAGE.'icons/coat_of_arm.png') }}" alt="">
	            </div>
	        </div>
	        <div class="d-flx j-c-sb sp-t">
	            <div class="menu-icon suffix openbtn"style="font-size: 24px">&#9776;
	                <span class="suffix smalltext">Menu</span>
	            </div>
	            <!-- <div>
	                <a href="http://user.cpc.softcom.ng/signin" target="_blank"><button class="btn p-1 btn-white">Sign In</button></a>
	                <a href="http://user.cpc.softcom.ng/complain" target="_blank"><button class="btn p-1 btn-red">File Complaint</button></a>
	            </div> -->
	        </div>
	    </div>
	</div>
	<nav class="desktopnav show-smallup">
	    <h3 class="sr">Desktop navigation</h3>
	    <div class="maxwidth-sl wrapper-x mx-auto">
	        <ul class="none d-flx pos-rel main-nav">
                <li class="py-1 mg-1 main-list">
                    <a href="/">M&amp;A - FCCPC</a>
                </li>
                <li class="py-1 mg-1 main-list">
                    <a href="#">Application</a>
                    <ul class="none pos-abs sublist">
                        <li class="sub-list-item">
                            <a href="{{ route('applicant.submit') }}">
                                <p>Submit Application</p>
                            </a>
                        </li>
                         <li class="sub-list-item">
                            <a href="#">
                                <p>Upload Supporting Documents</p>
                            </a>
                        </li>
                        <li class="sub-list-item">
                            <a href="#">
                                <p>Make Enquiry &amp; Others</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="py-1 mg-1 main-list">
                    <a href="{{ route('home.calculator') }}">Fee Calculator</a>
                </li>
                <li class="py-1 mg-1 main-list">
                    <a href="{{ route('home.faq') }}">FAQ</a>
                </li>
                <li class="py-1 mg-1 main-list">
                    <a href="#">Account</a>
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
                    <a class="smalltext" href="/">M&amp;A - FCCPC</a>
	            </li>
	            <li>
	                <a class="smalltext" href="{{ route('applicant.submit') }}">Submit Application</a>
	            </li>
	            <li>
	                <a class="smalltext" href="#">Add Supporting Documents</a>
	            </li>
	            <li>
	                <a class="smalltext" href="{{ route('home.calculator') }}">Fee Calculator</a>
	            </li>
	            <li>
	                <a class="smalltext" href="{{ route('home.faq') }}">FAQ</a>
	            </li>
	        </ul>
	    </div>
	</div>
