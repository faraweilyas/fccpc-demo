<div class="modal fade" id="viewCaseModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="viewCaseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewCaseModalLabel">View Case</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-custom" style="margin: -1.75rem; margin-bottom: -23px;">
                    <div class="card-header card-header-tabs-line justify-content-centre">
                        <div class="card-title">
                            <h3 class="card-label">&nbsp;&nbsp;</h3>
                        </div>
                        <div class="card-toolbar">
                            <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#case_tab">
                                        <span class="nav-icon"><i class="flaticon-folder-1"></i></span>
                                        <span class="nav-text">Case</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#applicant_tab">
                                        <span class="nav-icon"><i class="flaticon2-user"></i></span>
                                        <span class="nav-text">Applicant</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#fees_tab">
                                        <span class="nav-icon"><i class="flaticon-list-2"></i></span>
                                        <span class="nav-text">Fees</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#documents_tab">
                                        <span class="nav-icon"><i class="flaticon2-folder"></i></span>
                                        <span class="nav-text">Documents</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">

                            {{-- Case --}}
                            <div class="tab-pane fade show active" id="case_tab" role="tabpanel">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">Case Handler:</span>
                                    <span class="text-dark" id="case_handler">...</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">Reference NO:</span>
                                    <span class="text-muted text-hover-primary" id="refrenceNo">#</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">Submitted On:</span>
                                    <span class="text-dark" id="submittedAt">...</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">Category:</span>
                                    <span class="text-muted" id="category">...</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">Type:</span>
                                    <span class="text-muted" id="type">...</span>
                                </div>
                                <div class='mb-1'>
                                    <span class="font-weight-bold mr-2">Parties:</span>
                                    <br />
                                    <span id="parties">...</span>
                                </div>
                                <div class="">
                                    <span class="font-weight-bold mr-2">Subject:</span>
                                    <br />
                                    <span id="subject">...</span>
                                </div>
                            </div>

                            {{-- Applicant --}}
                            <div class="tab-pane fade" id="applicant_tab" role="tabpanel">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">Firm:</span>
                                    <span class="text-dark" id="applicant_firm">...</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">Name:</span>
                                    <span class="text-dark" id="applicant_name">...</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">Email:</span>
                                    <span class="text-dark text-hover-info" id="applicant_email">...</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">Phone Number:</span>
                                    <span class="text-body text-hover-info" id="applicant_phone_number">...</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">Letter Of Appointment:</span>
                                    <span class="text-body text-hover-info">
                                        <a id="letter_of_appointment" href="#" class="text-muted text-hover-success mr-2">
                                            <span class="flaticon2-download icon-1x"></span> Download
                                        </a>
                                    </span>
                                </div>
                                <div class="">
                                    <span class="font-weight-bold mr-2">Address:</span>
                                    <br />
                                    <span id="applicant_address">...</span>
                                </div>
                            </div>

                            {{-- Checklist --}}
                            <div class="tab-pane fade" id="fees_tab" role="tabpanel">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">Category:</span>
                                    <span class="text-muted" id="category_fee">...</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">Combined Turnover:</span>
                                    <span class="text-body text-hover-info" id="combined_turnover">...</span>
                                </div>
                                <table class="table">
                                    <th class='fees_tab__head'>SERVICE</th>
                                    <th class='fees_tab__head'>PRICE</th>
                                    <tr>
                                        <td>Filling Fee</td>
                                        <td id="filling_fee">₦0.00</td>
                                    </tr>
                                    <tr>
                                        <td>Processing Fee</td>
                                        <td id="processing_fee">₦0.00</td>
                                    </tr>
                                    <tr>
                                        <td>Expedited Fee</td>
                                        <td id="expedited_fee">₦0.00</td>
                                    </tr>
                                    <tr>
                                        <td>Total:</td>
                                        <td id="total_fee">₦0.00</td>
                                    </tr>
                                </table>
                            </div>

                            {{-- Documents --}}
                            <div class="tab-pane fade" id="documents_tab" role="tabpanel">
                                <div id="document_items" class="d-flex flex-column font-size-sm font-weight-bold">
                                    ...
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="analyze-case" type="button" class="btn btn-light-primary font-weight-bold">Analyse Case</button>
                <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
