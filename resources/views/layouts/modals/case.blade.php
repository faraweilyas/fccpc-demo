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
                    <div class="card-header card-header-tabs-line" style="justify-content: flex-start;">
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
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">

                            {{-- Case --}}
                            <div class="tab-pane fade show active" id="case_tab" role="tabpanel">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">Amount Paid:</span>
                                    <span class="text-muted" id="amount_paid">...</span>
                                </div>
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
                                    <span class="font-weight-bold mr-2">Case Type:</span>
                                    <span class="text-muted" id="category">...</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">Transaction Type:</span>
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
                                <div class="">
                                    <span class="font-weight-bold mr-2">Address:</span>
                                    <br />
                                    <span id="applicant_address">...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @if(in_array(\Auth::user()->account_type, ['SP']))
                    <button id="analyze-case" type="button" class="btn btn-light-primary font-weight-bold">View More</button>
                @endif
                <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
