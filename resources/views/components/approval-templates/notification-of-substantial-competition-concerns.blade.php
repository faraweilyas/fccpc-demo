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
                <textarea id="approval_content" name="approval_content" class="form-control" cols="6" rows="30">Your submission to the Federal Competition and Consumer Protection Commission (Commission) dated [insert date] on the above subject matter refers.&#10;&#10;Based on the information provided, the Commission has reviewed the transaction and has noted that the proposed [insert description of transaction] raises the following substantial competition concerns:&#10;&#10;<ul><ol>1. ……………………………………………………………</ol><ol>2. ……………………………………………………………</ol><ol>3. ……………………………………………………………</ol></ul>&#10;In view of the aforementioned, the Commission is unable to approve this transaction.&#10;&#10;Consequently, parties may make representations to the Commission, proposing remedies that will address the competition concerns; or detailing any technological efficiencies or other pro-competitive advantage which will result from the transaction; and will be greater than, and offset, the competition concerns; and will allow consumers receive a fair share of the resulting benefits; or stating what substantial public interest grounds may justify the proposed transaction.&#10;&#10;Parties may make the above representation within [insert time] of receiving this notification. In the event that the Commission does not receive such representation within the stipulated time frame, it will enter a decision to deny approval of the transaction. Where the Commission receives further representation, it will conduct a second detailed review of the transaction before making its final decision.&#10;&#10;………………………&#10;{{ $case->getHandlerFullName() }}, {{ $case->getHandlerAccountType() }}&#10;<b>For: Executive Vice Chairman / Chief Executive Officer</b></textarea>
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
                    <p>{!! nl2br($case->applicant_address) !!}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h6 class="text-center text-underline"><br /><b>{{ $case->getApprovalLetterTitle($template) }}</b></h6>
                    <h6 class="text-left text-underline"><b>RE: {{ $case->subject }}</b></h6>
                    <br />
                    <h6 class="text-left"><b>ACQUIRER(S): {{ $case->getCasePartiesText() }}</b></h6>
                    <h6 class="text-left"><b>TARGET(S): {{ '...' }}</b></h6>
                    <h6 class="text-left"><b>CASE ID: #{{ $case->guest->tracking_id }}</b></h6>
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
