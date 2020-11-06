<div class="modal fade" id="assignEnquiryModal" tabindex="-1" role="dialog" aria-labelledby="assignEnquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assign case handler to enquiry</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <label>Select case handler</label><br>
                            <select class="form-control select2" id="case_handler" name="case_handler" style="width: 100%;">
                                @foreach($caseHandlers as $handler)
                                    <option value="{{ $handler->id }}">{{ $handler->getFullName() }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">Assign</button>
                </div>
            </form>
        </div>
    </div>
</div>