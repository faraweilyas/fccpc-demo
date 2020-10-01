@extends('layouts.backend.old.guest')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
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
    </div>
@endsection
