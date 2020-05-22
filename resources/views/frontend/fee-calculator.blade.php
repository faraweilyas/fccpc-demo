@extends('layouts.frontend.base')
@section('content')
<main>
    	<section class=" maxwidth-sl-2 mx-auto top-heading">
		    <div class="wrapper">
		        <div class="py-2 breadcrumbs ff-sans-serif pb-h d-ifx al-i-c">
				    <a href="#" class="opacity-7-link">
					    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon" style="transform:translateY(-2px)">
					        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
					        <polyline points="9 22 9 12 15 12 15 22"></polyline>
					    </svg>
				    </a>
				    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-cheveron-right">
				      <defs>
				        <style>
				          svg {
				            width: 15px;
				          }
				      
				        </style>
				      </defs>
				      <polyline points="9 18 15 12 9 6"></polyline>
				    </svg>
			        Fee Calculator
				</div>
		        <div id="orderWizardContact">
		        	<div class="">
		        		<div id="personalData" class="row">
		        			<div class="col-md-6 form__bottom">
		        				<div id="orderContainer">
		        					<form name="order-form" id="orderForm" method="POST" data-parsley-validate="" novalidate="" action="order_send.php">
		        						<div class="row">
		        							<div class="col-md-6 col-sm-6">
		        								<div class="form-group">
		        									<label for="typeOfTransaction">Type of transaction:</label>
		        									<select class="form-control" id="typeOfTransaction" name="typeOfTransaction"> 
		        										<option value="local" selected="">Regular</option> 
		        										<option value="ffm">Foreign to Foreign</option> 
		        									</select>
		        								</div>
		        							</div>
		        							<div class="col-md-6 col-sm-6"> 
		        								<div class="form-group"> 
		        									<label for="combinedTurnover">Combined turnover:</label> 
		        									<input type="text" name="combinedTurnover" class="form-control" id="combinedTurnover" placeholder="Enter your combined turnover:" required=""> 
		        								</div> 
		        							</div>
		        						</div>
		        						<div class="row form__spacing"> 
						        			<div class="col-md-6"> 
						        				<div class="form-group expeditedOption"> 
						        					<div class="pure-checkbox"> 
						        						<input id="expedited" name="expedited" type="checkbox" value="yes" required="" data-parsley-multiple="expedited"> 
						        						<label for="expedited">Do you want to fast track?</label> 
						        					</div> 
						        				</div> 
						        			</div> 
						        			<div class="col-md-6"> 
						        				<p> 
						        					<a href="#" class="localGuideline" data-toggle="modal" data-target="#localGuideline" style="display: none;">Fees Guideline for Regular Merger</a> 
						        					<a href="#" class="ffmGuideline" data-toggle="modal" data-target="#ffmGuideline" style="">Fees Guideline for Foreign-to-Foreign Merger</a> 
						        				</p> 
						        			</div> 
						        		</div>
		        					</form>
		        				</div>
		        			</div>
		        			<div class="col-md-6 form__bottom">
		        				<table class="table table-striped">
		        					<thead class="thead-fccpc">
		        						<tr> 
		        							<th scope="col">#</th> 
		        							<th scope="col">Service</th> 
		        							<th scope="col">Price</th> 
		        						</tr>
		        					</thead>
		        					<tbody> 
		        						<tr> 
		        							<th scope="row">-</th> 
		        							<td>Filling fee</td> 
		        							<td class="font-weight-bold text-monospace"> 
		        								<span class="fillingFee">₦0.00</span> 
		        							</td> 
		        						</tr> 
		        						<tr> 
		        							<th scope="row">-</th> 
		        							<td>Processing fee</td> 
		        							<td class="font-weight-bold text-monospace"> 
		        								<span class="processingFee">₦0.00</span> 
		        							</td> 
		        						</tr> 
		        						<tr> 
		        							<th scope="row">-</th> 
		        							<td>Expedited fee</td> 
		        							<td class="font-weight-bold text-monospace"> 
		        								<span class="expeditedFee">-</span> 
		        							</td> 
		        						</tr> 
		        						<tr> 
		        							<th scope="row">&nbsp;</th> 
		        							<td class="font-weight-bolder">Total</td> 
		        							<td class="font-weight-bolder"> 
		        								<span class="totalAmount">₦0.00</span> 
		        							</td> 
		        						</tr> 
		        					</tbody>
		        				</table>
		        			</div>
		        		</div>
		        	</div>
		        </div>
		    </div>
		</section>
		<!-- Modal Popup -->
	    <div class="modal fade hide" id="localGuideline" tabindex="-1" role="dialog" aria-labelledby="localGuidelineModalTitle" aria-hidden="true">
	        <div class="modal-dialog modal-lg" role="document">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h5 class="modal-title mx-auto text-center" id="localGuidelineModalTitle">Local Merger Fees Guideline</h5>
	                </div>
	                <div class="modal-body">...</div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-primary close-localGuideline" data-dismiss="modal">Close</button>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- Modal Popup -->
	    <div class="modal fade hide" id="ffmGuideline" tabindex="-1" role="dialog" aria-labelledby="ffmGuidelineModalTitle" aria-hidden="true">
	        <div class="modal-dialog modal-lg" role="document">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h5 class="modal-title mx-auto text-center" id="ffmGuidelineModalTitle">Foreign-to-Foreign Merger Fees Guideline</h5>
	                </div>
	                <div class="modal-body">
	                    <p class="modal_guideline__header">Applicable Fees for Foreign-to-Foreign Merger Notifications</p>
	                    <p>As approved by the Federal Competition and Consumer Protection
	                    Commission (the Commission), the following fees shall apply with respect
	                    to foreign-to-foreign mergers with a nexus to Nigeria:</p>
	                    <table class="table table-bordered">
	                        <thead>
	                            <tr>
	                                <th scope="col">&nbsp;</th>
	                                <th scope="col">Threshold</th>
	                                <th scope="col">Fees</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                            <tr>
	                                <th scope="row">1</th>
	                                <td>Merger with combined turnover of N1billion and above</td>
	                                <td>&#8358;3,000,000.00 or 0.1% of the combined turnover, whichever is higher</td>
	                            </tr>
	                            <tr>
	                                <th scope="row">2</th>
	                                <td>Merger where target undertaking has turnover of up to &#8358;500 million and between N1 billion</td>
	                                <td>&#8358;2,000,000.00</td>
	                            </tr>
	                        </tbody>
	                    </table>
	                    <p class="modal_guideline__sub__header">Applicable Fees for Foreign-to-Foreign Merger Notifications: EXPEDITED PROCEDURE</p>
	                    <ol>
	                        <li>The Commission, in the interest of transactional efciency, shall adopt an expedited procedure, for foreign to foreign mergers where it will conduct a review under the simplifed procedure.</li>
	                        <li>Under the expedited procedure, the Commission shall conclude its review and issue its decision within 15 (fifteen) business days.</li>
	                        <li>The expedited procedure fee is &#8358;5,000,000 (five million Naira) to be paid in addition to the application fee.</li>
	                    </ol>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-primary close-ffmGuideline" data-dismiss="modal">Close</button>
	                </div>
	            </div>
	        </div>
	    </div>
    </main>
@endSection
<script src="{{ FE_JS.'jquery.min.js' }}"></script>
<script src="{{ BE_JS.'functions.js'  }}"></script>
<script src="{{ BE_JS.'app.js' 	      }}"></script>