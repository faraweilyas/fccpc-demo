<div class="modal fade" id="assignCaseModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assign Case Handler</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form method="POST" action="#">
                @csrf
                <div class="modal-body">
                    <div class="py-9">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="font-weight-bold mr-2">Reference NO:</span>
                            <span class="text-muted text-hover-primary" id="refrenceNo">#</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="font-weight-bold mr-2">Submitted On:</span>
                            <span class="text-muted" id="submittedAt">...</span>
                        </div>
                        <div>
                            <span class="font-weight-bold mr-2">Subject:</span>
                            <br />
                            <span id="subject">...</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Select case handler:</label>
                            <br />
                            <select class="form-control select2" id="caseHandler" name="caseHandler" style="width: 100%;">
                                @foreach($supervisors as $supervisor)
                                    <option value="{{ $supervisor->id }}">{{ $supervisor->getFullName() }}</option>
                                @endforeach
                                @foreach($caseHandlers as $handler)
                                    <option value="{{ $handler->id }}">{{ $handler->getFullName() }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="caseID" />
                    <button type="button" id="assignCaseButton" class="btn btn-light-primary font-weight-bold">Assign</button>
                    <button type="button" id="unassignCaseButton" class="btn btn-light-danger font-weight-bold hide">Unassign</button>
                    <button id="assigningCaseButton" class="btn btn-primary font-weight-bold py-2 px-8 hide" disabled>
                        <div class="spinner-grow text-white" role="status">
                          <span class="sr-only">Loading...</span>
                        </div>
                    </button>
                    <button id="unassigningCaseButton" class="btn btn-danger font-weight-bold py-2 px-8 hide" disabled>
                        <div class="spinner-grow text-white" role="status">
                          <span class="sr-only">Loading...</span>
                        </div>
                    </button>
                    <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="reassignCaseModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reassign Case Handler</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form method="POST" action="#">
                @csrf
                <div class="modal-body">
                    <div class="py-9">
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
                            <span class="text-muted" id="submittedAt">...</span>
                        </div>
                        <div>
                            <span class="font-weight-bold mr-2">Subject:</span>
                            <br />
                            <span id="subject">...</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Select new case handler:</label>
                            <br />
                            <select class="form-control select2" id="newCaseHandler" name="newCaseHandler" style="width: 100%;">
                                @foreach($supervisors as $supervisor)
                                    <option value="{{ $supervisor->id }}">{{ $supervisor->getFullName() }}</option>
                                @endforeach
                                @foreach($caseHandlers as $handler)
                                    <option value="{{ $handler->id }}">{{ $handler->getFullName() }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="reassigncaseID" />
                    <input type="hidden" id="oldCaseHandlerID" />
                    <div id="re-unassigning-handler">
                        <button type="submit" id="reassignCaseButton" class="btn btn-light-primary font-weight-bold">Re-Assign</button>
                    </div>
                    <div id="re-assigning-handler" class="hide">
                        <button class="btn btn-primary font-weight-bold py-2 px-8" disabled>
                            <div class="spinner-grow text-white" role="status">
                              <span class="sr-only">Loading...</span>
                            </div>
                        </button>
                    </div>
                    <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
