<div class="modal fade" id="viewDeficiencyModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="viewDeficiencyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewCaseModalLabel">Issue Deficiency</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-custom-approval" style="margin: -1.75rem; margin-bottom: -23px;">
                    <div class="card-header card-header-tabs-line" style="justify-content: center;border-bottom: none;">
                        <div class="card-toolbar">
                            <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#deficiency_tab">
                                        <span class="nav-icon"><i class="flaticon-list-2"></i></span>
                                        <span class="nav-text">Deficiencies</span>
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

                            {{-- Deficiencies --}}
                            <div class="tab-pane fade show active" id="deficiency_tab" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-1">
                                            <textarea class="form-control" id="additional_info" rows="3" name="additional_info" placeholder="Additional Information..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div id="deficiency_items" class="d-flex flex-column font-size-sm font-weight-bold mt-3">
                                ...
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
                <button id="saving-deficiency" type="button" class="btn btn-light-primary font-weight-bold hide" disabled><i class="fas fa-spinner fa-pulse"></i>&nbsp;Issue Deficiency...</button>
                <button id="issue-deficiency" type="button" class="btn btn-light-primary font-weight-bold">Issue Deficiency</button>
                <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
