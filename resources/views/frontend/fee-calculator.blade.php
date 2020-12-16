@extends('layouts.frontend.base')
@section('content')
<div class="page-content my-5">
  <div class="container row-top">
    <div>
      <h2 class="fee-calc-header">Fee Calculator</h2>

      <p class="fee-calc-subh py-5">
        <span class="cr-pointer" data-toggle="modal" data-target="#feesGuideline">Fees Guideline for Domestic Merger</span>
      </p>
    </div>
    <div class="row fee-calc-container">
      <div class="col-md-4">
        <div class="form-group ">
          <label>Type of Transaction</label>
            <select class="form-control fee-calc-form" id="typeOfTransaction" name="typeOfTransaction">
                <option value="local" selected="">Merger</option>
                <option value="ffm">Simplified Procedure</option>
                <option value="ffx">Negative Clearance</option>
            </select>
        </div>

        <div class="form-group ">
          <label>Combined Turnover</label>
          <input type="text" id="combinedTurnover" name="combinedTurnover" class="form-control" placeholder="Enter your combined turnover:" />
        </div>
      </div>
      <div class="col-md-2"></div>
      <div class="col-md-6 ">
        <div class="fee__calculator--table">
          <table class="table fee-calc-table">
            <thead class="thead-light">
              <tr>
                <th scope="col">SERVICE</th>
                <th scope="col">PRICE</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Application fee</td>
                <td>
                    <span class="fillingFee">₦0.00</span>
                </td>
              </tr>

              <tr>
                <td>Processing fee</td>
                <td>
                    <span class="processingFee">₦0.00</span>
                </td>
              </tr>

              <tr>
                <td>Expedited fee</td>
                <td>
                    <span class="expeditedFee">-</span>
                </td>
              </tr>
              <tr class="fee__calculator-total">
                <td>
                  <b>Total</b>
                </td>
                <td>
                    <span class="totalAmount">₦0.00</span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal Popup -->
<div class="modal" id="feesGuideline" tabindex="-1" role="dialog" aria-labelledby="feesGuidelineModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mx-auto text-center" id="ffmGuidelineModalTitle">Foreign-to-Foreign Merger Fees Guideline</h5>
            </div>
            <div class="modal-body">
                <p class="modal_guideline__header">Applicable Fees for Foreign-to-Foreign Merger Notifications</p>
                <p>As approved by the Federal Competition and Consumer Protection
                Commission (the Commission), the following fees shall apply with respect
                to foreign-to-foreign mergers with a nexus to Nigeria:</p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">&nbsp;</th>
                            <th scope="col">Threshold</th>
                            <th scope="col">Fees</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Merger with combined turnover of N1billion and above</td>
                            <td>&#8358;3,000,000.00 or 0.1% of the combined turnover, whichever is higher</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Merger where target undertaking has turnover of up to &#8358;500 million and between N1 billion</td>
                            <td>&#8358;2,000,000.00</td>
                        </tr>
                    </tbody>
                </table>
                <p class="modal_guideline__sub__header">Applicable Fees for Foreign-to-Foreign Merger Notifications: EXPEDITED PROCEDURE</p>
                <ol>
                    <li>The Commission, in the interest of transactional efciency, shall adopt an expedited procedure, for foreign to foreign mergers where it will conduct a review under the simplifed procedure.</li>
                    <li>Under the expedited procedure, the Commission shall conclude its review and issue its decision within 15 (fifteen) business days.</li>
                    <li>The expedited procedure fee is &#8358;5,000,000 (five million Naira) to be paid in addition to the application fee.</li>
                </ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary close-ffmGuideline" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom.javascript')
    <script src="{{ pc_asset(BE_APP_JS.'functions.js') }}"></script>
    <script src="{{ pc_asset(BE_APP_JS.'app.js') }}"></script>
@endsection
