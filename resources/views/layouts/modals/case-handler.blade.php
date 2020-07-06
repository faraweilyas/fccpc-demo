<div class="modal fade" id="assignCaseModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assign Case Handler</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            {{-- <form method="POST" action="{{ route('cases.assign', ['id' => $case->id]) }}"> --}}
            <form method="POST" action="#">
                @csrf
                <div class="modal-body">
                    <div class="py-9">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="font-weight-bold mr-2">Reference NO:</span>
                            <span class="text-muted text-hover-primary" id="refrenceNo">#</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="font-weight-bold mr-2">Submitted At:</span>
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
                            <select class="form-control select2" id="case_handler" name="case_handler" style="width: 100%;">
                                @foreach($caseHandlers as $handler)
                                    <option value="{{ $handler->id }}">{{ $handler->getFullName() }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-light-primary font-weight-bold">Assign</button>
                </div>
            </form>
        </div>
    </div>
</div>
