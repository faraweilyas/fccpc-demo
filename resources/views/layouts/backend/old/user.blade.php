@extends('layouts.backend.old.base')

@section('base_content')
    @yield('mobile_navigation')
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-row flex-column-fluid page">
            <div id="kt_quick_cart" class="offcanvas offcanvas-right p-10 ">
                <div class="offcanvas-header d-flex align-items-center justify-content-between pb-7">
                    <h4 class="font-weight-bold m-0" style="font-weight: 700 !important">Fee Calculator</h4>
                    <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_cart_close">
                        <i class="ki ki-close icon-xs text-muted"></i>
                    </a>
                </div>
                <div class="offcanvas-content">
                    <div class="row fee-calc-container my-10">
                        <div class="col-md-12">
                            <div class="form-group fee-calc-form-group">
                                <label>Type of Transaction</label>
                                <select class="form-control fee-calc-form" id="typeOfTransaction" name="typeOfTransaction">
                                     <option value="" selected="">Select type:</option>
                                    <option value="local">Merger</option>
                                    <option value="ffm">Simplified Procedure</option>
                                    <option value="ffx">Negative Clearance</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Number of Parties:</label>
                                <input type="number" id="parties_number" name="parties_number" class="form-control" min="2" value="2" />
                            </div>
                            <div class="form-group">
                                <div class="checkbox-inline">
                                    <label class="checkbox">
                                    <input type="checkbox" name="expedited" id="expedited">Expedited
                                    <span></span></label>
                                </div>
                            </div>
                            <div class="transaction-category-section">
                                <div class="form-group">
                                    <label>Purchase Consideration:</label>
                                    <input value="50000000000" type="text" id="purchase_consideration" name="purchase_consideration" class="form-control" placeholder="Enter your purchase consideration:" />
                                </div>
                                <div class="form-group">
                                    <label>Transaction Category:</label>
                                    <div class="radio">
                                        <label style="margin-right: 15px;">
                                            <input type="radio" class="transaction_category" name="transaction_category" value="domestic" /> Domestic
                                        </label>
                                        <label>
                                            <input type="radio" class="transaction_category" name="transaction_category" value="ffm" /> Foreign To Foreign
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group hide">
                                    <label>The acquiring undertaking (including group companies where relevant):</label>
                                    <input value="30000000000" type="text" id="turnover_a" name="turnover_a" class="form-control" placeholder="Enter amount:" />
                                </div>
                                <div class="form-group hide">
                                    <label>The target undertaking:</label>
                                    <input value="15000000000" type="text" id="turnover_b" name="turnover_b" class="form-control" placeholder="Enter amount:" />
                                </div>
                                <div class="form-group hide">
                                    <label>For foreign to foreign mergers, the annual turnover of Nigerian component is required:</label>
                                    <input value="60000000000" type="text" id="turnover_c" name="turnover_c" class="form-control" placeholder="Enter amount:" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Annual Turnover:</label>
                                <input type="text" id="annual_turnover" name="annual_turnover" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-md-12 fee-table-container">
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
                                            <td><span class="applicationFee">₦0.00</span></td>
                                        </tr>
                                        <tr>
                                            <td>Processing fee</td>
                                            <td><span class="processingFee">₦0.00</span></td>
                                        </tr>
                                        <tr>
                                            <td>Expedited fee</td>
                                            <td><span class="expeditedFee">₦0.00</span></td>
                                        </tr>
                                        <tr class="fee__calculator-total">
                                            <td><b>Total</b></td>
                                            <td><span class="totalAmount">₦0.00</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="show-generate-fee" class="col-md-12">
                            <input id="generate-fee" type="button" class="btn btn-primary float-right" name="" value="Generate Fee" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <div id="kt_header" class="header flex-column header-fixed">
                    @yield('navigation')
                </div>
                @yield('content')
                <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
                    <div class="container">
                        <div class="row">
                          <div class="col-md-8">
                            <span style="font-size: 1rem">This is the official website of the Federal Competition and Consumer Protection Commission (FCCPC)
                              <br>Copyright © 2020 Federal Competition and Consumer Protection Commission</span>
                          </div>
                          <div class="col-md-4">
                            <br/>
                            <span class="float-right float-right-inverse" style="font-size: 1rem">  Powered by <a href="https://techbarn.ng/" target="_blank" class="text-dark">techbarn </span>

                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
