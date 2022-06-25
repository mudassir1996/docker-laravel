@extends('layout.default')
@section('title', 'Add Purchase Order')

@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Inventory Purchase Order</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="" class="text-muted">Add Purchase Order</a>
                            </li>
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <!--begin::Actions-->
                    <a href="#" class="btn btn-light font-weight-bold btn-sm">Actions</a>
                    <!--end::Actions-->
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
                        <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <span class="svg-icon svg-icon-success svg-icon-2x">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Files/File-plus.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <path
                                            d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        <path
                                            d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z"
                                            fill="#000000" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 m-0">

                        </div>
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Teachers-->
                <div class="d-flex flex-row">
                    <!--begin::Content-->
                    <div class="flex-row-fluid ml-lg-8">
                        <form method="post" action="{{ route('purchase-orders.store') }}" id="po_form"
                            enctype="multipart/form-data">
                            <!--begin::Card-->
                            <div class="card card-custom mb-8">
                                <div class="card-header flex-wrap py-5">
                                    <div class="card-title">
                                        <h3 class="card-label">Add Purchase Order
                                            <!-- <span class="d-block text-muted pt-2 font-size-sm">Manage Accounts</span> -->
                                        </h3>
                                    </div>
                                </div>
                                <div class="card-body py-0">
                                    <!--begin::Form-->

                                    @csrf
                                    <div class="card-body">

                                        <div class="form-group row">
                                            <div class="col-xl-3">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Supplier</label>
                                                    <div class="input-group">
                                                        <select class="form-control selectpicker" data-live-search="true"
                                                            id="supplier" title="Select Supplier" data-size="5"
                                                            name="supplier_id">
                                                            @foreach ($suppliers as $id => $supplier)
                                                                <option value="{{ $id }}">{{ $supplier }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" type="button"
                                                                data-toggle="modal" data-target="#supplier_model">
                                                                Add
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-3">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Reference No</label>
                                                    <input type="text" class="form-control" name="po_number"
                                                        placeholder="Reference No" />
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-3">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Request Date</label>
                                                    <input type="text" class="form-control " id="req_datepicker"
                                                        name="po_request_date"
                                                        value="{{ Carbon\Carbon::today()->format('Y-m-d') }}"
                                                        placeholder="Select Date" readonly />
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-3">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Expected Date</label>
                                                    <input type="text" class="form-control" id="kt_datepicker_3"
                                                        name="po_expected_date" placeholder="Select Date" readonly />
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-3">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Purchased Date</label>
                                                    <input type="text" class="form-control purchased_date" disabled
                                                        id="kt_datepicker_3" name="po_purchased_date"
                                                        placeholder="Select Date" readonly />
                                                    <div class="fv-plugins-message-container">
                                                        <div data-field="po_purchased_date" data-validator="notEmpty"
                                                            id="error_pur_date" class="fv-help-block"></div>
                                                    </div>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-3">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>PO Status</label>
                                                    <select class="form-control status" name="po_status">
                                                        <option value="requested">Requested</option>
                                                        <option value="in-process">In-Process</option>
                                                        <option value="shipped">Shipped</option>
                                                        <option value="delivered">Delivered</option>
                                                    </select>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-3">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Payment Type</label>
                                                    <select class="form-control" name="payment_type">
                                                        <option value="credit">Credit</option>
                                                        <option value="debit">Debit</option>
                                                    </select>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-3">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Payment Method</label>
                                                    <select class="form-control" name="payment_method_id">
                                                        @foreach ($payment_methods as $id => $payment_method)
                                                            <option value="{{ $id }}">{{ $payment_method }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!--end::Input-->
                                            </div>

                                        </div>
                                        <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                                        <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                                    </div>
                                </div>
                                <div class="card-header bg-whitesmoke card-header-tabs-line">
                                    <div class="card-toolbar">
                                        <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1_4">
                                                    <span class="nav-text">Quick Search</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2_4">
                                                    <span class="nav-text">Advance Search</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body bg-whitesmoke pb-1">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel"
                                            aria-labelledby="kt_tab_pane_1_4">
                                            <div class="form-group">
                                                <!-- <label>Left Icon Input</label> -->
                                                <div class="input-icon">
                                                    <input type="text" class="form-control"
                                                        placeholder="Search by product name, brand, product type, supplier" />
                                                    <span><i class="flaticon2-search-1 icon-md"></i></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-xl-4 col-form-label">
                                                    <!-- Button trigger modal-->
                                                    <button type="button"
                                                        class="btn btn-success btn-shadow px-6 font-weight-bold" id="add"
                                                        data-toggle="modal" data-target="#itemsModel">
                                                        <span class="svg-icon svg-icon-md">
                                                            <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Plus.svg--><svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none"
                                                                    fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12"
                                                                        r="10" />
                                                                    <path
                                                                        d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z"
                                                                        fill="#000000" />
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                        Add Item
                                                    </button>
                                                </div>
                                                <div class="col-xl-4 col-form-label">
                                                    <div class="checkbox-inline">
                                                        <label class="checkbox font-weight-bold checkbox-outline mt-4">
                                                            <input type="checkbox" name="Checkboxes5" />
                                                            <span></span>
                                                            Auto-fill order with low stock items.
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-form-label">
                                                    <div class="checkbox-inline">
                                                        <label class="checkbox font-weight-bold checkbox-outline mt-4">
                                                            <input type="checkbox" name="Checkboxes5" />
                                                            <span></span>
                                                            Auto-fill backordered items.
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="kt_tab_pane_2_4" role="tabpanel"
                                            aria-labelledby="kt_tab_pane_2_4">
                                            ...
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--end::Card-->
                            <!--begin::Card-->
                            <div class="card card-custom mb-8">
                                <div class="card-header flex-wrap py-5">
                                    <div class="card-title">
                                        <h3 class="card-label">Order Details
                                            <!-- <span class="d-block text-muted pt-2 font-size-sm">Manage Employees</span> -->
                                        </h3>
                                    </div>
                                </div>

                                <!-- Modal-->
                                <div class="modal fade" id="itemsModel" data-backdrop="static" tabindex="-1"
                                    role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="itemsModel">Add Item</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <i aria-hidden="true" class="ki ki-close"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <div class="col-xl-12">
                                                        <div class="form-group mb-2">
                                                            <label for="product">Product</label>
                                                            <select class="form-control selectpicker"
                                                                data-live-search="true" data-size="5"
                                                                title="Select Supplier First" id="product" required>

                                                            </select>
                                                            <span class="text-danger" id="error_product"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-xl-6 mb-4">
                                                        <div class="form-group mb-2">
                                                            <label for="old_cost">Old Cost Price</label>
                                                            <input type="number" step="0.1" class="form-control"
                                                                id="old_cost" readonly placeholder="Old Cost Price">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 mb-4" id="cost">
                                                        <div class="form-group mb-2">
                                                            <label for="new_cost">New Cost Price</label>
                                                            <input type="number" step="0.1" class="form-control"
                                                                id="new_cost" placeholder="New Cost Price">
                                                        </div>
                                                    </div>


                                                    <div class="col-xl-6 mb-4">
                                                        <div class="form-group mb-2">
                                                            <label for="req_quantity">Requested Quantity</label>
                                                            <input type="number" step="0.1" class="form-control"
                                                                id="req_quantity" placeholder="Requested Quantity">
                                                            <span class="text-danger" id="error_req_quantity"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 mb-4" id="quantity">
                                                        <div class="form-group mb-2">
                                                            <label for="pur_quantity">Purchased Quantity</label>
                                                            <input type="number" step="0.1" class="form-control"
                                                                id="pur_quantity" placeholder="Purchased Quantity">
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-6 mb-4">
                                                        <div class="form-group mb-2">
                                                            <label for="discount_value">Discount Value</label>
                                                            <input type="number" step="0.1" class="form-control"
                                                                id="discount_value" placeholder="Discount Value">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 mb-4">
                                                        <div class="form-group mb-2">
                                                            <label for="discount_percentage">Discount Percentage</label>
                                                            <input type="number" step="0.1" class="form-control"
                                                                id="discount_percentage" placeholder="Discount Percentage">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-xl-12">
                                                        <div class="form-group mb-2">
                                                            <label for="p_remarks">Remarks</label>
                                                            <textarea id="p_remarks" rows="3"
                                                                class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-whitesmoke no-border">
                                                <input type="hidden" name="row_id" id="hidden_row_id" />
                                                <button type="button" id="save_item"
                                                    class="btn btn-primary btn-shadow px-12 font-weight-bold">Save
                                                    Item</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-3">
                                    <!--begin: Datatable-->
                                    <table class="table table-separate nowrap table-head-custom table-checkable"
                                        id="item_table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Old Cost Price</th>
                                                <th>Requested Quantity</th>
                                                <th>Total Bill</th>
                                                <th>Details</th>
                                                <th>Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <!--end: Datatable-->
                                </div>

                                <div class="card-footer">
                                    <div class="row justify-content-between px-8 px-md-0">
                                        <div class="col-md-8">
                                            <div class=" font-size-lg">
                                                <div class="form-group">
                                                    <label for="remarks">Remarks</label>
                                                    <textarea class="form-control" name="remarks" id="remarks"
                                                        rows="7"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex justify-content-end flex-column flex-md-row font-size-lg">
                                                <div class="d-flex flex-column mb-10 mb-md-0 w-100 bg-whitesmoke rounded">
                                                    <div class="py-5 px-4">
                                                        <div class="d-flex justify-content-between py-4 ">
                                                            <span class="font-weight-bold">Total Bill:</span>
                                                            <input type="hidden" name="total_bill" id="total_bill">
                                                            <span class="text-right font-weight-bolder">
                                                                <span id="items_total">0</span>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex justify-content-between py-4">
                                                            <span class="mr-5 font-weight-bold">Discount (<span
                                                                    id="main_percent_label">0</span>%) <span
                                                                    class="text-primary ml-3" id="edit_discount"
                                                                    style="cursor: pointer;">Edit</span></span>
                                                            <span class="text-right font-weight-bolder">
                                                                <span><span id="main_discount_label">0</span></span>
                                                            </span>
                                                        </div>

                                                        <div id="dis_fields" style="display: none;">
                                                            <div class="d-flex justify-content-between py-3">
                                                                <span class="mr-5 pt-2 font-weight-bold">Discount
                                                                    Value:</span>
                                                                <span class="text-right">
                                                                    <input type="number" step="0.1" id="main_discount_value"
                                                                        class="form-control form-control-sm"
                                                                        name="order_discount_value"
                                                                        placeholder="Discount Amount" />
                                                                </span>
                                                            </div>
                                                            <div class="d-flex justify-content-between py-3">
                                                                <span class="mr-5 pt-2 font-weight-bold">Discount %:</span>
                                                                <span class="text-right">
                                                                    <input type="number" step="0.1"
                                                                        id="main_discount_percentage"
                                                                        class="form-control form-control-sm"
                                                                        name="order_discount_percentage"
                                                                        placeholder="Discount Percentage" />
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="d-flex justify-content-between align-items-center rounded-bottom px-4 py-5 bg-dark text-light">
                                                        <span class="font-weight-bold ">Payable Amount:</span>
                                                        <span class="text-right font-weight-bolder">
                                                            <span class="display-4" id="payable_amount">0</span>
                                                        </span>
                                                        <input type="hidden" name="amount_payable" id="amount_payable">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row justify-content-end">
                                        <div class="col-xl-2">
                                            <button type="submit" class="btn btn-primary btn-shadow px-12">Submit
                                                Order</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Card-->
                        </form>
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Teachers-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!-- COMPANY MODEL -->
    <div class="modal fade" id="supplier_model" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="add_suppier_form" class="add_supplier">

                    <div class="modal-header p-4">
                        <h6 class="modal-title" id="supplier_model">Add Supplier</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body p-4">

                        <div class="form-group row mb-0">
                            <div class="col-xl-12">
                                <div class="form-group mb-3">
                                    <label>Supplier Name*</label>
                                    <input type="text" class="form-control" autofocus name="supplier_title"
                                        placeholder="Supplier Name" />

                                </div>
                            </div>
                            <div class="col-xl-12">
                                <!--begin::Input-->
                                <div class="form-group ">
                                    <label>Company *</label>
                                    <select class="form-control   selectpicker" title="Select Company" data-size="5"
                                        data-live-search="true" id="company" name="company_id[]" multiple required>
                                        @foreach ($companies as $id => $company)
                                            <option value="{{ $id }}"
                                                {{ in_array($id, old('company_id', [])) ? 'selected' : '' }}>
                                                {{ $company }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!--end::Input-->
                            </div>
                        </div>

                        <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                        <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">

                    </div>
                    <div class="modal-footer bg-whitesmoke no-border">
                        <button class="btn btn-primary btn-shadow px-12" id="save-supplier">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

{{-- Styles Section --}}
<!-- @section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection -->


{{-- Scripts Section --}}

@section('scripts')
    {{-- vendors --}}
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js?v=7.0.5') }}"></script>

    {{-- Products Data --}}
    <script src="{{ asset('js/pages/crud/datatables/basic/scrollable.js?v=7.0.5') }}"></script>

    {{-- Date Picker --}}
    <script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>

    {{-- Custom JS --}}
    <script>
        //////////////////////////////////////////
        $('#supplier').change(function() {
            var supplierID = $(this).val();


            if (supplierID) {
                $.ajax({
                    url: "{{ url('supplier-products') }}?supplier_id=" + supplierID,
                    type: "Get",
                    success: function(res) {
                        if (res) {
                            $("#product").empty();
                            $.each(res, function(key, value) {
                                $("#product").append(
                                    "<option value='" + value.id +
                                    "' data-subtext='In stock(" + value.units_in_stock +
                                    ")'>" + value.product_title + "</option>"
                                );
                                console.log(value.product_title);
                            });

                        } else {
                            $("#product").empty();
                        }
                    }
                });
            } else {
                $("#product").empty();
            }
        });
        $('#product').change(function() {
            var productID = $(this).val();
            // $.get('product-cost?product_id=' + productID, function(res) {
            //     console.log(res);
            // });

            if (productID) {
                $.ajax({
                    url: "{{ url('product-cost') }}?product_id=" + productID,
                    type: "Get",
                    success: function(res) {
                        if (res) {
                            $("#old_cost").empty();
                            $.each(res, function(key, value) {
                                $("#old_cost").val(value);
                            });

                        } else {
                            $("#old_cost").empty();
                        }
                    }
                });
            } else {
                $("#old_cost").empty();
            }
        });
    </script>
    <script src="{{ asset('js/po/items.js') }}"></script>
    <script src="{{ asset('js/po/form_validation.js') }}"></script>
    <script>
        $("#save-supplier").on("click", function(event) {
            event.preventDefault();
            let _token = $('meta[name="csrf-token"]').attr("content");
            let supplier_title = $("input[name=supplier_title]").val();
            let company_id = $("#company").val();
            let created_by = $("input[name=created_by]").val();
            let outlet_id = $("input[name=outlet_id]").val();
            $.ajax({
                url: "{{ route('suppliers.add-supplier') }}",
                type: "POST",
                data: {
                    supplier_title: supplier_title,
                    company_id: company_id,
                    created_by: created_by,
                    outlet_id: outlet_id,
                    _token: _token,
                },
                success: function(response) {
                    // console.log(response);
                    $("#supplier_model").modal("toggle");
                    toastr.success("Supplier Added");
                    $("[name='supplier_title']").val("");
                    $("#company").selectpicker('refresh');
                    // $("#company").selectpicker('val','');

                    $.ajax({
                        url: "{{ url('get-supplier') }}?id=" + response,
                        type: "Get",
                        success: function(res) {
                            $.each(res, function(key, value) {
                                $("#supplier").append(
                                    "<option value='" + key + "'>" + value +
                                    "</option>"
                                );
                            });
                            $("#supplier").selectpicker("refresh");
                            var newVal = $("#supplier option:last").val();
                            $("#supplier").selectpicker("val", [newVal]);
                        },
                    });
                },
                error: function(response) {
                    $("#supplier_model").modal("toggle");
                    toastr.error("Error! Please try again");
                    $("[name='supplier_title']").val("");
                },
            });
        });
    </script>

@endsection
