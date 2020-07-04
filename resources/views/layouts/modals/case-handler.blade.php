<div class="modal fade" id="assignCaseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assign case handler to case</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            {{-- <form method="POST" action="{{ route('cases.assign', ['id' => $case->id]) }}"> --}}
            <form method="POST" action="#">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Subject</label>
                            <input type="text" class="form-control" value="#" disabled>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <label>Select case handler</label><br>
                            <select class="form-control select2" id="case_handler" name="case_handler" style="width: 100%;">
                                @foreach(\App\Models\User::where('status', 'active')->where('account_type', 'CH')->get() as $handler)
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