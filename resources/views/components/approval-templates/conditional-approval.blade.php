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
<textarea id="approval_content" name="approval_content" class="form-control" cols="6" rows="30">Your above request refers.

The Federal Competition and Consumer Protection Commission (Commission) has reviewed your notification and all the information provided.

The Commission is not satisfied that the information you have provided is sufficient to determine that the proposed [insert description of transaction] will not substantially lessen or prevent competition in the relevant market.

Your transaction is hereby approved subject to the following conditions:
1. ……………………………………………………………
2. ……………………………………………………………
3. ……………………………………………………………

You are requested to comply with the above conditions within a period of [insert as appropriate: the time frame will depend on the conditions proposed by the parties] from the date of this letter.

In the event that the outstanding obligation is not satisfied within a time the Commission considers reasonable, or any information supplied by the parties is false, misleading, or inaccurate, the Commission reserves the right to revoke its approval pursuant to Section 99(1)(a), (b), and (d) of the Federal Competition and Consumer Protection Act, 2018.


………………………
{{ $case->getHandlerFullName() }}, {{ $case->getHandlerAccountType() }}
<b>For: Executive Vice Chairman / Chief Executive Officer</b></textarea>
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
                <div class="col-md-12">
                    {{-- {{ $case->getSubmittedAt() }} --}}
                    <p>{{ datetimeToText(now(), 'customd') }}<br /></p>
                    <p>{{ $case->getApplicantName() }}</p>
                    <p>{{ $case->applicant_address }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h6 class="text-center text-underline"><b>{{ $case->getApprovalLetterTitle($template) }}</b></h6>
                    <h6 class="text-left text-underline"><b>RE: {{ $case->subject }}</b></h6>
                    <br />
                    <h6 class="text-left"><b>ACQUIRER(S): {{ $case->getCasePartiesText() }}</b></h6>
                    <h6 class="text-left"><b>TARGET(S): {{ '...' }}</b></h6>
                    <h6 class="text-left"><b>CASE ID: #{{ $case->guest->tracking_id }}</b></h6>
                    <br />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 approval_content">
                    <p>Your above request refers.</p>

                    <p>The Federal Competition and Consumer Protection Commission (Commission) has reviewed your notification and all the information provided.</p>

                    <p>The Commission is not satisfied that the information you have provided is sufficient to determine that the proposed [insert description of transaction] will not substantially lessen or prevent competition in the relevant market.</p>

                    <p>Your transaction is hereby approved subject to the following conditions:<br />
                    1. ……………………………………………………………<br />
                    2. ……………………………………………………………<br />
                    3. ……………………………………………………………</p>

                    <p>You are requested to comply with the above conditions within a period of [insert as appropriate: the time frame will depend on the conditions proposed by the parties] from the date of this letter.</p>

                    <p>In the event that the outstanding obligation is not satisfied within a time the Commission considers reasonable, or any information supplied by the parties is false, misleading, or inaccurate, the Commission reserves the right to revoke its approval pursuant to Section 99(1)(a), (b), and (d) of the Federal Competition and Consumer Protection Act, 2018.</p>

                    <p>
                        <br />
                        ………………………<br />
                        {{ $case->getHandlerFullName() }}, {{ $case->getHandlerAccountType() }}<br />
                        <b>For: Executive Vice Chairman / Chief Executive Officer</b>
                    </p>
                </div>
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
