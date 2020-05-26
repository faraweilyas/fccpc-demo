<div class="header-bottom">
	<!--begin::Container-->
	<div class="container">
		<!--begin::Header Menu Wrapper-->
		<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
			<!--begin::Header Menu-->
			<div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile header-menu-layout-default">
				<!--begin::Header Nav-->
				<ul class="menu-nav">
					<li class="menu-item menu-item-open menu-item-here menu-item-submenu menu-item-rel menu-item-open menu-item-here">
						<a href="{{ route('dashboard') }}" class="menu-link">
							<span class="menu-text">Dashboard</span>
							<span class="menu-desc">...</span>
							<i class="menu-arrow"></i>
						</a>
					</li>
					@if(!in_array(\Auth::user()->accountType, ['AD']))
					<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
						<a href="javascript:;" class="menu-link menu-toggle">
							<span class="menu-text">Case</span>
							<span class="menu-desc">...</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="menu-submenu menu-submenu-classic menu-submenu-left">
							<ul class="menu-subnav">
								<li class="menu-item menu-item-submenu" aria-haspopup="true">
									<a href="{{ route('cases.index', ['type' => 'new']) }}" class="menu-link">
										<span class="svg-icon svg-icon-primary svg-icon-2x">
											<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo9\dist/../src/media/svg/icons\General\Clipboard.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											        <rect x="0" y="0" width="24" height="24"/>
											        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
											        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
											        <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"/>
											        <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"/>
											    </g>
											</svg>
											<!--end::Svg Icon-->
										</span>
										&nbsp;&nbsp;<span class="menu-text">New Cases</span></a>
										<i class="menu-arrow"></i>
									</a>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true">
									<a href="{{ route('cases.index', ['type' => 'assigned']) }}" class="menu-link">
										<span class="svg-icon svg-icon-primary svg-icon-2x">
											<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo9\dist/../src/media/svg/icons\Communication\Clipboard-check.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											        <rect x="0" y="0" width="24" height="24"/>
											        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
											        <path d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z" fill="#000000"/>
											        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
											    </g>
											</svg>
											<!--end::Svg Icon-->
										</span>
										&nbsp;&nbsp;<span class="menu-text">Assigned Cases</span></a>
										<i class="menu-arrow"></i>
									</a>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true">
									<a href="{{ route('cases.index', ['type' => 'hold']) }}" class="menu-link">
										<span class="svg-icon svg-icon-primary svg-icon-2x">
										<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo9\dist/../src/media/svg/icons\Files\File-minus.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											        <polygon points="0 0 24 0 24 24 0 24"/>
											        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
											        <rect fill="#000000" x="9" y="12" width="6" height="2" rx="1"/>
											    </g>
											</svg>
											<!--end::Svg Icon-->
										</span>
										&nbsp;&nbsp;<span class="menu-text">Cases On Hold</span></a>
										<i class="menu-arrow"></i>
									</a>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true">
									<a href="{{ route('cases.index', ['type' => 'approved']) }}" class="menu-link">
										<span class="svg-icon svg-icon-primary svg-icon-2x">
											<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo9\dist/../src/media/svg/icons\Navigation\Check.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											        <polygon points="0 0 24 0 24 24 0 24"/>
											        <path d="M6.26193932,17.6476484 C5.90425297,18.0684559 5.27315905,18.1196257 4.85235158,17.7619393 C4.43154411,17.404253 4.38037434,16.773159 4.73806068,16.3523516 L13.2380607,6.35235158 C13.6013618,5.92493855 14.2451015,5.87991302 14.6643638,6.25259068 L19.1643638,10.2525907 C19.5771466,10.6195087 19.6143273,11.2515811 19.2474093,11.6643638 C18.8804913,12.0771466 18.2484189,12.1143273 17.8356362,11.7474093 L14.0997854,8.42665306 L6.26193932,17.6476484 Z" fill="#000000" fill-rule="nonzero" transform="translate(11.999995, 12.000002) rotate(-180.000000) translate(-11.999995, -12.000002) "/>
											    </g>
											</svg>
											<!--end::Svg Icon-->
										</span>
										&nbsp;&nbsp;<span class="menu-text">Approved Cases</span></a>
										<i class="menu-arrow"></i>
									</a>
								</li>
								@if(in_array(\Auth::user()->accountType, ['SP']))
								<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
									<a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon svg-icon-primary svg-icon-2x">
											<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo9\dist/../src/media/svg/icons\Communication\Group.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											        <polygon points="0 0 24 0 24 24 0 24"/>
											        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
											        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
											    </g>
											</svg>
											<!--end::Svg Icon-->
										</span>
										&nbsp;&nbsp;<span class="menu-text">Case Handlers</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu menu-submenu-classic menu-submenu-right">
										<ul class="menu-subnav">
											<li class="menu-item" aria-haspopup="true">
												<a href="{{ route('handlers.create') }}" class="menu-link">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">New Case Handler</span>
												</a>
											</li>
											<li class="menu-item" aria-haspopup="true">
												<a href="{{ route('handlers.index') }}" class="menu-link">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">View Handlers</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								@endif
							</ul>
						</div>
					</li>
					@endif
					@if(in_array(\Auth::user()->accountType, ['AD']))
					<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
						<a href="javascript:;" class="menu-link menu-toggle">
							<span class="menu-text">Users</span>
							<span class="menu-desc">...</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="menu-submenu menu-submenu-classic menu-submenu-left">
							<ul class="menu-subnav">
								<li class="menu-item menu-item-submenu" aria-haspopup="true">
									<a href="{{ route('dashboard.create_user') }}" class="menu-link">
										<span class="svg-icon svg-icon-primary svg-icon-2x">
											<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo9\dist/../src/media/svg/icons\Communication\Add-user.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											        <polygon points="0 0 24 0 24 24 0 24"/>
											        <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
											        <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
											    </g>
											</svg>
											<!--end::Svg Icon-->
										</span>
										&nbsp;&nbsp;<span class="menu-text">Create User</span></a>
										<i class="menu-arrow"></i>
									</a>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true">
									<a href="{{ route('dashboard.users') }}" class="menu-link">
										<span class="svg-icon svg-icon-primary svg-icon-2x">
											<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo9\dist/../src/media/svg/icons\Communication\Adress-book2.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											        <rect x="0" y="0" width="24" height="24"/>
											        <path d="M18,2 L20,2 C21.6568542,2 23,3.34314575 23,5 L23,19 C23,20.6568542 21.6568542,22 20,22 L18,22 L18,2 Z" fill="#000000" opacity="0.3"/>
											        <path d="M5,2 L17,2 C18.6568542,2 20,3.34314575 20,5 L20,19 C20,20.6568542 18.6568542,22 17,22 L5,22 C4.44771525,22 4,21.5522847 4,21 L4,3 C4,2.44771525 4.44771525,2 5,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z" fill="#000000"/>
											    </g>
											</svg>
											<!--end::Svg Icon-->
											</span>
										&nbsp;&nbsp;<span class="menu-text">View Users</span></a>
										<i class="menu-arrow"></i>
									</a>
								</li>
							</ul>
						</div>
					</li>
					@endif
					<li class="menu-item menu-item-submenu menu-item-rel">
						<a href="#" class="menu-link">
							<span class="menu-text">Requests</span>
							<span class="menu-desc">...</span>
							<i class="menu-arrow"></i>
						</a>
					</li>
					<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
						<a href="javascript:;" class="menu-link menu-toggle">
							<span class="menu-text">Queries</span>
							<span class="menu-desc">...</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="menu-submenu menu-submenu-classic menu-submenu-left">
							<ul class="menu-subnav">
								<li class="menu-item menu-item-submenu" aria-haspopup="true">
									<a href="#" class="menu-link">
										<span class="svg-icon svg-icon-primary svg-icon-2x">
											<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo9\dist/../src/media/svg/icons\Files\File.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											        <polygon points="0 0 24 0 24 24 0 24"/>
											        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
											        <rect fill="#000000" x="6" y="11" width="9" height="2" rx="1"/>
											        <rect fill="#000000" x="6" y="15" width="5" height="2" rx="1"/>
											    </g>
											</svg>
											<!--end::Svg Icon-->
										</span>
										&nbsp;&nbsp;<span class="menu-text">Query log</span></a>
										<i class="menu-arrow"></i>
									</a>
								</li>
							</ul>
						</div>
					</li>
					<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
						<a href="javascript:;" class="menu-link menu-toggle">
							<span class="menu-text">Analytics</span>
							<span class="menu-desc">...</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="menu-submenu menu-submenu-classic menu-submenu-left">
							<ul class="menu-subnav">
								<li class="menu-item menu-item-submenu" aria-haspopup="true">
									<a href="#" class="menu-link">
										<span class="svg-icon svg-icon-primary svg-icon-2x">
										<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo9\dist/../src/media/svg/icons\Media\Equalizer.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										        <rect x="0" y="0" width="24" height="24"/>
										        <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"/>
										        <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"/>
										        <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"/>
										        <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"/>
										    </g>
										</svg>
										<!--end::Svg Icon-->
										</span>
										&nbsp;&nbsp;<span class="menu-text">Generate Report</span></a>
										<i class="menu-arrow"></i>
									</a>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true">
									<a href="#" class="menu-link">
										<span class="svg-icon svg-icon-primary svg-icon-2x">
											<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo9\dist/../src/media/svg/icons\General\Settings-2.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											        <rect x="0" y="0" width="24" height="24"/>
											        <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"/>
											    </g>
											</svg>
											<!--end::Svg Icon-->
										</span>
										&nbsp;&nbsp;<span class="menu-text">Administration</span></a>
										<i class="menu-arrow"></i>
									</a>
								</li>
							</ul>
						</div>
					</li>
				</ul>
				<!--end::Header Nav-->
			</div>
			<!--end::Header Menu-->
		</div>
		<!--end::Header Menu Wrapper-->
	</div>
	<!--end::Container-->
</div>
