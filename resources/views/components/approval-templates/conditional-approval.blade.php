<div class="col-md-5">
    <div class="card">
        <div class="card-header">
            <h3><i class="la la-mail-bulk"></i>&nbsp;Approval Letter Workspace</h3>
        </div>
        <form
            method="POST"
            action="{{ route('cases.send_approval_letter', ['case' => $case, 'template_id' => $template]) }}"
        >
            @csrf
            <div class="card-body approval_body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{-- <label>Email:</label> <span class="text-danger">*</span> --}}
                            <input
                                type="text"
                                id="approval_header"
                                name="approval_header"
                                class="form-control"
                                value="RE: {{ $case->subject }}"
                            />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{-- <label>Email:</label> <span class="text-danger">*</span> --}}
                            <textarea
                                id="approval_address"
                                name="approval_address"
                                class="form-control"
                            >ACQUIRER(S): {{ $case->getCasePartiesText() }}&#10;TARGET(S): {{ '...' }}&#10;CASE ID: #{{ $case->guest->tracking_id }}</textarea>
                        </div>
                    </div>
                </div>
                <textarea id="approval_content" name="approval_content" class="form-control" cols="6" rows="30">Your above request refers.&#10;&#10;The Federal Competition and Consumer Protection Commission (Commission) has reviewed your notification and all the information provided.&#10;&#10;The Commission is not satisfied that the information you have provided is sufficient to determine that the proposed [insert description of transaction] will not substantially lessen or prevent competition in the relevant market.&#10;&#10;Your transaction is hereby approved subject to the following conditions:&#10;&#10;<ul><ol>1. ?????????????????????????????????????????????????????????????????????</ol><ol>2. ?????????????????????????????????????????????????????????????????????</ol><ol>3. ?????????????????????????????????????????????????????????????????????</ol></ul>&#10;You are requested to comply with the above conditions within a period of [insert as appropriate: the time frame will depend on the conditions proposed by the parties] from the date of this letter.&#10;&#10;In the event that the outstanding obligation is not met within the timeframe stated above, the Commission considers reasonable, or any information supplied by the parties is false, misleading, or inaccurate, the Commission reserves the right to revoke its approval pursuant to Section 99(1)(a), (b), and (d) of the Federal Competition and Consumer Protection Act, 2018.&#10;&#10;???????????????????????????&#10;{{ $case->getHandlerFullName() }}, {{ $case->getHandlerAccountType() }}&#10;<b>For: Executive Vice Chairman / Chief Executive Officer</b></textarea>
                <div class="row" style="justify-content: start;">
                    <div class="col-md-4">
                        <button class="btn btn-primary mt-4" name="send"><i class="la la-send"></i>Send Mail</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-warning" formtarget="_blank" name="preview"><i class="la la-file"></i>Preview</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="col-md-7">
    <div class="card">
        <div class="card-header">
            <h3><i class="la la-mail-bulk"></i>&nbsp;Approval Letter Preview</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    {{-- {{ $case->getSubmittedAt() }} --}}
                    <p>{{ datetimeToText(now(), 'customd') }}<br /></p>
                    <p>{{ $case->getApplicantName() }}</p>
                    <p>{!! nl2br($case->applicant_address) !!}</p>
                </div>
                <div class="col-md-4">
                    <p>
                        <img
                            src="https://www.fccpc.gov.ng/uploads/favicons/apple-touch-icon.png"
                            alt=""
                            style="width: 130px;margin-top: -28px;"
                        />
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h6 class="text-center text-underline"><br /><b>{{ $case->getApprovalLetterTitle($template) }}</b></h6>
                    <h6 class="text-left text-underline approval_header" style='font-weight: 600;'>RE: {{ $case->subject }}</h6>
                    <br />
                    <h6 class="text-left approval_address">
                        ACQUIRER(S): {{ $case->getCasePartiesText() }}<br />
                        TARGET(S): {{ '...' }}<br />
                        CASE ID: #{{ $case->guest->tracking_id }}
                    </h6>
                    <br />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 approval_content"></div>
            </div>
            {{-- <div class="row">
                <div class="col-md-12">
                    <p>
                        {{ $case->getHandlerFullName() }}<br />
                        {{ $case->getHandlerAccountType() }}<br />
                        For: Chief Executive Officer.
                    </p>
                </div>
            </div> --}}
        </div>
    </div>
</div>
