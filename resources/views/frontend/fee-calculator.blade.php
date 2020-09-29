@extends('layouts.frontend.base')
@section('content')
<div class="page-content my-5">
  <div class="container">
    <div>
      <h2 class="fee-calc-header">Fee Calculator</h2>

      <p class="fee-calc-subh py-5">
        Fees Guideline for Regular Merger
      </p>
    </div>
    <div class="row fee-calc-container">
      <div class="col-md-4">
        <div class="form-group ">
          <label>Type of Transaction</label>
            <select class="form-control fee-calc-form" id="typeOfTransaction" name="typeOfTransaction">
                <option value="local" selected="">Regular</option>
                <option value="ffm">Foreign to Foreign</option>
                <option value="ffx">Foreign to Foreign Expedited</option>
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
                <td>Filling fee</td>
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
@endSection
@section('custom.javascript')
    <script src="{{ pc_asset(BE_APP_JS.'functions.js') }}"></script>
    <script src="{{ pc_asset(BE_APP_JS.'app.js') }}"></script>
@endsection