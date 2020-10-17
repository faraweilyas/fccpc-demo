@extends('layouts.backend.admin')

@section('content')
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Case Analysis</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}" class="text-muted">Home</a>
                    </li>
                    @if(in_array(\Auth::user()->account_type, ['SP']))
                    <li class="breadcrumb-item">
                        <a href="{{ route('cases.unassigned') }}" class="text-muted">New Cases</a>
                    </li>
                    @endif
                    <li class="breadcrumb-item">
                        <a href="{{ route('cases.assigned') }}" class="text-muted">Assigned Cases</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('cases.analyze', ['case' => $case->id]) }}" class="text-muted">Analyze
                            Case</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('cases.analyze-documents', ['case' => $case->id]) }}"
                            class="text-muted">Checklist Documents</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Checklist Approval</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-custom">
                @php $x = 1 @endphp
                @php
                $deficient_count = $checklistStatusCount->deficient ?? 0;
                @endphp
                @foreach(\App\Models\ChecklistGroup::with('checklists')->get() as $checklistGroup)
                @php
                $document = $checklistGroupDocuments[$checklistGroup->id] ?? '';
                @endphp
                @if($document !== '')
                <div class="row my-3 py-5 hide" id="step-{{ $x }}">

                    <h5 class="text-bold w-50">

                        {{ $checklistGroup->name }}
                        <div class="pull-button-right">
                            <button id="deficient-basket" class="btn btn-light-primary font-weight-bold mx-lg-5 py-3" data-toggle="modal"
                                data-target="#Issue" data-case-id="{{ $case->id }}">
                                <span class="svg-icon svg-icon-xl">

                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Cart3.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="20" height="20"></rect>
                                            <path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#fff" fill-rule="nonzero" opacity="0.3"></path>
                                            <path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#fff"></path>
                                        </g>
                                    </svg>

                                    <!--end::Svg Icon-->
                                    <span class="checklist-deficient-count">{{ $checklistStatusCount->deficient ?? 0 }}</span>
                                    {{-- Deficiencies --}}
                                    {{-- <span class="checklist-deficient-text">Deficiencies</span> --}}
                                </span>
                            </button>
                            {{-- <button class="btn btn-success no-border mx-lg-5 px-10 " id="cart">
                                <span class="svg-icon svg-icon-xl">

                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Cart3.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="20" height="20"></rect>
                                            <path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#fff" fill-rule="nonzero" opacity="0.3"></path>
                                            <path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#fff"></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </button> --}}

                            <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-xl dropdown-menu-anim-up " id="cart-dropdown">
                                <form>
                                    <!--begin::Header-->
                                    <div class="d-flex align-items-center py-10 px-8 bgi-size-cover bgi-no-repeat rounded-top"
                                        style="background: #135c40">
                                        <span class="btn btn-md btn-icon bg-white-o-15 mr-4">
                                            <i class="flaticon2-shopping-cart-1 text-success"></i>
                                        </span>
                                        <h4 class="text-white m-0 flex-grow-1 mr-3">My Cart</h4>
                                        <button type="button" class="btn btn-success btn-sm px-3">2 Items</button>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Scroll-->
                                    <div class="scroll scroll-push ps" data-scroll="true" data-height="250" data-mobile-height="200"
                                        style="height: 250px; overflow: hidden;">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center justify-content-between p-8">
                                            <div class="d-flex flex-column mr-2">
                                                <a href="#"
                                                    class="font-weight-bold text-dark-75 font-size-lg text-hover-primary">iBlender</a>
                                                <span class="text-muted">Best kichen gadget in 2020</span>
                                                <div class="d-flex align-items-center mt-2">
                                                    <span class="font-weight-bold mr-1 text-dark-75 font-size-lg">$ 350</span>
                                                    <span class="text-muted mr-1">for</span>
                                                    <span class="font-weight-bold mr-2 text-dark-75 font-size-lg">5</span>
                                                    <a href="#" class="btn btn-xs btn-light-success btn-icon mr-2">
                                                        <i class="ki ki-minus icon-xs"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-xs btn-light-success btn-icon">
                                                        <i class="ki ki-plus icon-xs"></i>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Separator-->
                                        <div class="separator separator-solid"></div>
                                        <!--end::Separator-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center justify-content-between p-8">
                                            <div class="d-flex flex-column mr-2">
                                                <a href="#"
                                                    class="font-weight-bold text-dark-75 font-size-lg text-hover-primary">SmartCleaner</a>
                                                <span class="text-muted">Smart tool for cooking</span>
                                                <div class="d-flex align-items-center mt-2">
                                                    <span class="font-weight-bold mr-1 text-dark-75 font-size-lg">$ 650</span>
                                                    <span class="text-muted mr-1">for</span>
                                                    <span class="font-weight-bold mr-2 text-dark-75 font-size-lg">4</span>
                                                    <a href="#" class="btn btn-xs btn-light-success btn-icon mr-2">
                                                        <i class="ki ki-minus icon-xs"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-xs btn-light-success btn-icon">
                                                        <i class="ki ki-plus icon-xs"></i>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Separator-->
                                        <div class="separator separator-solid"></div>
                                        <!--end::Separator-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center justify-content-between p-8">
                                            <div class="d-flex flex-column mr-2">
                                                <a href="#"
                                                    class="font-weight-bold text-dark-75 font-size-lg text-hover-primary">CameraMax</a>
                                                <span class="text-muted">Professional camera for edge cutting shots</span>
                                                <div class="d-flex align-items-center mt-2">
                                                    <span class="font-weight-bold mr-1 text-dark-75 font-size-lg">$ 150</span>
                                                    <span class="text-muted mr-1">for</span>
                                                    <span class="font-weight-bold mr-2 text-dark-75 font-size-lg">3</span>
                                                    <a href="#" class="btn btn-xs btn-light-success btn-icon mr-2">
                                                        <i class="ki ki-minus icon-xs"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-xs btn-light-success btn-icon">
                                                        <i class="ki ki-plus icon-xs"></i>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Separator-->
                                        <div class="separator separator-solid"></div>
                                        <!--end::Separator-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center justify-content-between p-8">
                                            <div class="d-flex flex-column mr-2">
                                                <a href="#" class="font-weight-bold text-dark text-hover-primary">4DPrinter</a>
                                                <span class="text-muted">Manufactoring unique objects</span>
                                                <div class="d-flex align-items-center mt-2">
                                                    <span class="font-weight-bold mr-1 text-dark-75 font-size-lg">$ 1450</span>
                                                    <span class="text-muted mr-1">for</span>
                                                    <span class="font-weight-bold mr-2 text-dark-75 font-size-lg">7</span>
                                                    <a href="#" class="btn btn-xs btn-light-success btn-icon mr-2">
                                                        <i class="ki ki-minus icon-xs"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-xs btn-light-success btn-icon">
                                                        <i class="ki ki-plus icon-xs"></i>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                        <!--end::Item-->
                                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                        </div>
                                        <div class="ps__rail-y" style="top: 0px; right: 5px;">
                                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                        </div>
                                    </div>
                                    <!--end::Scroll-->
                                    <!--begin::Summary-->
                                    <div class="p-8">
                                        <div class="d-flex align-items-center justify-content-between mb-4">
                                            <span class="font-weight-bold text-muted font-size-sm mr-2">Total</span>
                                            <span class="font-weight-bolder text-dark-50 text-right">$1840.00</span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mb-7">
                                            <span class="font-weight-bold text-muted font-size-sm mr-2">Sub total</span>
                                            <span class="font-weight-bolder text-primary text-right">$5640.00</span>
                                        </div>
                                        <div class="text-right">
                                            <button type="button" class="btn btn-primary text-weight-bold">Place Order</button>
                                        </div>
                                    </div>
                                    <!--end::Summary-->
                                </form>
                            </div>

                            <button class="btn btn-success no-border px-10 py-4"
                                onclick="window.location.href = '{{ route('applicant.document.download', ['document' => $document->id]) }}';">
                                Download Checklist Document
                            </button>
                        </div>
                    </h5>
                    <div class="row py-5">
                        <div class="col-md-12">
                            <p><b>Additional Information:</b></p>
                            <p>
                                @empty($document->additional_info) ... @else {{ $document->additional_info }} @endif
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($checklistGroup->checklists as $checklist)
                        @php
                        $checklist_document = $document->checklists->where('id', $checklist->id)->first()->checklist_document ?? NULL;
                        $checklist_document_status = $checklist_document->status ?? NULL;
                        $checked = (in_array($checklist->id, $checklistIds) && !is_null($checklist_document->selected_at)) ? "consent-card-active" : '';
                        @endphp
                        <div class="col-lg-6">
                            <div class="consent-card {{ $checked }}">
                                <div class="d-flex">
                                    <div class="form-check" style="padding: 0px">
                                        <div class="radio-inline">
                                            @empty($checked)
                                            <span class="switch switch-sm">
                                                <label>
                                                    <input type="checkbox" class="save_approval" name="select" @if($checklist_document_status=='deficient' ) checked="checked" @endif value="deficient"
                                                    @if($checklist_document_status=='deficient' ) checked="checked"
                                                    @endif data-document-id="{{ $document->id }}"
                                                    data-checklist-id="{{ $checklist->id }}" data-case-id="{{ $case->id }}" data-switch-box="true">
                                                    <span></span>
                                                </label>
                                                Deficient
                                            </span>
                                            @else
                                            <label class="radio">
                                                <input class="form-check-input save_approval" type="radio"
                                                    name="exampleRadios{{ $checklist->id }}" value="approved"
                                                    @if($checklist_document_status=='approved' ) checked="checked"
                                                    @endif data-document-id="{{ $document->id }}"
                                                    data-checklist-id="{{ $checklist->id }}" data-case-id="{{ $case->id }}" data-switch-box="false">
                                                <span></span>
                                                Approve
                                            </label>
                                            <label class="radio">
                                                <input class="form-check-input save_approval" type="radio"
                                                    name="exampleRadios{{ $checklist->id }}" value="deficient"
                                                    @if($checklist_document_status=='deficient' ) checked="checked"
                                                    @endif data-document-id="{{ $document->id }}"
                                                    data-checklist-id="{{ $checklist->id }}" data-case-id="{{ $case->id }}" data-switch-box="false">
                                                <span></span>
                                                Deficient
                                            </label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <p>
                                    {{ ucfirst($checklist->name) }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @php $x++ @endphp
                @endif
                <input class="checklist_group_count" type="hidden" value="{{ count($checklistGroupDocuments) }}">
                @endforeach
                <div class="btn-group">
                    <button class="btn btn-success-pale-ts no-border mx-1 px-10 py-4" id="prev">
                        Previous
                    </button>
                    <button class="btn btn-success-pale-ts no-border mx-1 px-10 py-4" id="next">
                        Next
                    </button>
                    {{-- @if($deficient_count > 0)
                    <button class="btn btn-warning no-border mx-5 px-10 py-4 hide" id="deficiency" data-toggle="modal"
                                data-target="#viewDeficiencyModal">
                        Issue Deficiency
                    </button>
                    @else
                    <button class="btn btn-success no-border px-10 py-4 hide" id="approve">
                        Approve Complete Documents in the Checklist
                    </button>
                    @endif --}}
                    <button class="btn btn-warning no-border mx-5 px-10 py-4 hide" id="deficiency" data-toggle="modal"
                                data-target="#viewDeficiencyModal">
                        Issue Deficiency
                    </button>
                    <button class="btn btn-success no-border px-10 py-4 hide" id="approve">
                        Approve Complete Documents in the Checklist
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="hide">
    <span class="case_id">{{ $case->id }}</span>
    {{-- Applicant --}}
    <span class="firm">{!! $case->applicant_firm !!}</span>
    <span class="name">{!! $case->getApplicantName() !!}</span>
    <span class="email">{!! $case->applicant_email !!}</span>
    <span class="phone_number">{!! $case->applicant_phone_number !!}</span>
    <span class="address">{!! $case->applicant_address !!}</span>
</div>
<div class="modal fade" id="Issue" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Deficient Documents</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="deficient_cases_list" class="py-5">
                    @foreach($case->getCaseSubmittedChecklistByStatus('deficient') as $checklist)
                    <div>
                        <p class="alert-custom ">
                            {{ $checklist->name }}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="caseID">
                <button type="button" class="btn btn-light-danger font-weight-bold"
                    data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
@include("layouts.modals.deficiency")
@endsection

@section('custom.css')
<link rel="stylesheet" type="text/css" href="{{ pc_asset(BE_CSS.'reports.css') }}" />
@endsection


@section('custom.javascript')
<script type="text/javascript" src="{{ pc_asset(BE_APP_JS.'checklist_approval.js') }}"></script>
<script type="text/javascript" src="{{ pc_asset(BE_PLUGIN.'custom/select2/js/select2.min.js') }}"></script>



<script>
    $(document).ready(function () {
        $('#cart').click(function(){
            $('#cart-dropdown').toggleClass('show');
            console.log('worked');
        });

    })

</script>
@endsection
