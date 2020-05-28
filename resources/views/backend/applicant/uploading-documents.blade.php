@extends('layouts.backend.base')
@section('content')
<!--begin::Content-->
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
	<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<!--begin::Info-->
		<div class="d-flex align-items-center flex-wrap mr-1">
			<!--begin::Page Heading-->
			<div class="d-flex align-items-baseline mr-5">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold my-2 mr-5">Upload Supporting Documents</h5>
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item">
						<a href="{{ route('applicant.index', ['id' => $id]) }}" class="text-muted">Home</a>
					</li>
				</ul>
				<!--end::Page Title-->
			</div>
			<!--end::Page Heading-->
		</div>
		<!--end::Info-->
	</div>
</div>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="row mt-4">
				<div class="col-md-12">
					<div class="card card-custom gutter-b example example-compact">
						<div class="card-header">
							<h3 class="card-title">Upload Case Document (PDF/DOCX)</h3>
						</div>
						<form method="GET">
							<div class="card-body">
								<div class="form-group">
									<div class="row">
										<div class="col-md-3">
											<label class="checkbox mb-4">
												<input type="checkbox">
												<div class="uploadButton tw-mb-4">
		                                       	   <input accept=".doc, .docx, .pdf" id="ember369" class="js-file-upload-input ember-view" type="file" name="file">
		                                            <span class="btn btn--small btn--brand">Attach Drivers License</span>
		                                        </div>
												<span></span>
											</label>
										</div>
										<div class="col-md-3">
											<label class="checkbox mb-4">
												<input type="checkbox">
												<div class="uploadButton tw-mb-4">
		                                       	   <input accept=".doc, .docx, .pdf" id="ember369" class="js-file-upload-input ember-view" type="file" name="file">
		                                            <span class="btn btn--small btn--brand">Attach Passport</span>
		                                        </div>
												<span></span>
											</label>
										</div>
										<div class="col-md-3">
											<label class="checkbox mb-4">
												<input type="checkbox">
												<div class="uploadButton tw-mb-4">
		                                       	   <input accept=".doc, .docx, .pdf" id="ember369" class="js-file-upload-input ember-view" type="file" name="file">
		                                            <span class="btn btn--small btn--brand">Attach ID Card</span>
		                                        </div>
												<span></span>
											</label>
										</div>
										<div class="col-md-3">
											<label class="checkbox mb-4">
												<input type="checkbox">
												<div class="uploadButton tw-mb-4">
		                                       	   <input accept=".doc, .docx, .pdf" id="ember369" class="js-file-upload-input ember-view" type="file" name="file">
		                                            <span class="btn btn--small btn--brand">Attach Visa</span>
		                                        </div>
												<span></span>
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer text-center">
								<button type="submit" class="btn btn-primary mr-2"><i class="la la-cloud-upload"></i> Upload Documents</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--end::Entry-->
</div>
<!--end::Content-->
@endSection