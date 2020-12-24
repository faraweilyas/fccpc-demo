@extends('layouts.backend.old.base')

@section('base_content')
    @yield('mobile_navigation')
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-row flex-column-fluid page">
            <div id="kt_quick_cart" class="offcanvas offcanvas-right p-10 ">
                <div class="offcanvas-header d-flex align-items-center justify-content-between pb-7">
                    <h4 class="font-weight-bold m-0" style="font-weight: 700 !important">Fee Calculator 2</h4>
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
                                    <option value="local" selected="">Merge</option>
                                    <option value="ffm">Simplified Procedure</option>
                                    <option value="ffx">Negative Clearance</option>
                                </select>
                            </div>
                            <div class="form-group fee-calc-form-group">
                                <label>Combined Turnover</label>
                                <input
                                    type="text"
                                    id="combinedTurnover"
                                    name="combinedTurnover"
                                    class="form-control custom-input fee-calc-form form-no-bg"
                                />
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
                                            <td>Filling fee</td>
                                            <td class="fillingFee">₦0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Processing fee</td>
                                            <td class="processingFee">₦0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Expedited fee</td>
                                            <td class="expeditedFee">-</td>
                                        </tr>
                                        <tr class="fee__calculator-total">
                                            <td>
                                                <b>Total</b>
                                            </td>
                                            <td class="totalAmount">₦0.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
                    <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted font-weight-bold mr-2">{{ date('Y') }} &copy;</span>
                            <a href="{{ COMPANY_LINK }}" target="_blank" class="footer-brand-logo">
                                <img class="max-h-20px" src="{{ BE_IMAGE.'logo/techbarn-logo.png' }}" alt="techbarn logo" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
