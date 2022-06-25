@extends('layout.default')
@section('title', 'Payment Categories')
{{-- Styles Section --}}
@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Payment Category</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">All Payment Categories</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <input type="text" role="button" id="daterangepicker" readonly
                value="{{ request()->date_range != '' ? request()->date_range : '' }}" class="btn btn-primary px-12"
                name="date_range" placeholder="Select Date">

        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Teachers-->
            <div class="d-flex flex-row mt-5">
                <div class="container w-75">
                    <div class="row">
                        <div class="col-xl-4 text-center">
                            <a href="#" class="card bg-success">
                                <!--begin::Body-->
                                <div class="card-body p-4">

                                    <div class="text-inverse-success font-weight-bold font-size-h5 mb-2">
                                        <i class="fas fa-arrow-down text-light"></i>
                                        Cash In
                                    </div>
                                    <div class="font-weight-bold text-inverse-success font-size-h2">
                                        Rs. {{ $cash_in_amount }}
                                    </div>
                                </div>
                                <!--end::Body-->
                            </a>
                        </div>
                        <div class="col-xl-4 text-center">
                            <a href="#" class="card bg-danger">
                                <!--begin::Body-->
                                <div class="card-body p-4">

                                    <div class="text-inverse-danger font-weight-bold font-size-h5 mb-2">
                                        <i class="fas fa-arrow-up text-light"></i>
                                        Cash Out
                                    </div>
                                    <div class="font-weight-bold text-inverse-danger font-size-h2">
                                        Rs. {{ $cash_out_amount }}
                                    </div>
                                </div>
                                <!--end::Body-->
                            </a>
                        </div>
                        <div class="col-xl-4 text-center">
                            <a href="#" class="card bg-primary">
                                <!--begin::Body-->
                                <div class="card-body p-4">

                                    <div class="text-inverse-danger font-weight-bold font-size-h5 mb-2">
                                        <i class="fas fa-money-bill-alt text-light"></i>
                                        Final Balance
                                    </div>
                                    <div class="font-weight-bold text-inverse-danger font-size-h2">
                                        Rs. {{ $final_balance }}
                                    </div>
                                </div>
                                <!--end::Body-->
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row mt-5 ">
                <div class="container w-75">
                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                                Cashbook
                            </div>
                            <div class="card-toolbar">
                                <button type="button" id="cashIn" class="btn btn-light-success mr-2">
                                    <i class="fas fa-plus-circle"></i>
                                    Cash In
                                </button>
                                <button type="button" id="cashOut" class="btn btn-light-danger">
                                    <i class="fas fa-minus-circle"></i>
                                    Cash Out
                                </button>
                            </div>
                        </div>
                        <div class="card-body py-2">
                            <table class="table" id="kt_datatable_payment_category">
                                <thead>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Cash In</th>
                                    <th>Cash Out</th>
                                </thead>
                                <tbody>
                                    @foreach ($cashbook as $cashbook_data)
                                        <tr>
                                            <td>{{ $cashbook_data->title ?? '-' }}</td>
                                            <td>{{ date('Y-m-d', strtotime($cashbook_data->payment_date)) }}</td>
                                            @if ($cashbook_data->transaction_type == 'cash_in')
                                                <td>{{ $cashbook_data->amount }}</td>
                                                <td></td>
                                            @else
                                                <td></td>
                                                <td>{{ $cashbook_data->amount }}</td>
                                            @endif
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
            <!--end::Teachers-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
    <!-- Modal-->
    <div class="modal  fade" id="cashbookModal" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cashbookModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form action="{{ route('cashbook.store') }}" method="POST" id="cashbookForm">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="transaction_type" id="transaction_type">
                        <div class="form-group mb-3">
                            <label for="title">
                                Title
                            </label>
                            <input type="text" id="title" placeholder="Enter Title" name="title"
                                class="form-control text-left" autocomplete="off">
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-xl-6">
                                <label for="amount">
                                    Amount
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="amount" placeholder="Enter Amount" name="amount"
                                    class="form-control text-left" autocomplete="off">
                            </div>
                            <div class="col-xl-6">
                                <label>Payment Category</label>
                                <select class="form-control selectpicker " title="Select Payment Category" data-size="5"
                                    data-actions-box="true" data-live-search="true" name="payment_category_id">
                                    @foreach ($payment_categories as $payment_category)
                                        <option value="{{ $payment_category->id }}">
                                            {{ $payment_category->payment_category_title }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-xl-6">
                                <label for="amount">
                                    Date
                                </label>
                                <input type="text" id="payment_date" placeholder="Enter Amount"
                                    value="{{ Carbon\Carbon::today()->format('Y-m-d') }}" readonly name="payment_date"
                                    class="form-control">
                            </div>

                            <div class="col-xl-6">
                                <label>Payment Method <span class="text-danger">*</span></label>
                                <select class="form-control selectpicker " title="Select Payment Method" data-size="5"
                                    data-actions-box="true" data-live-search="true" name="payment_method_id">
                                    @foreach ($payment_methods as $payment_method)
                                        <option value="{{ $payment_method->id }}">
                                            {{ $payment_method->payment_title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="form-group row mb-3">

                            <div class="col-xl-6">
                                <label for="">Remarks</label>
                                <textarea name="remarks" id="" placeholder="Enter remarks" rows="1" class="form-control"></textarea>
                            </div>
                            <div class="col-xl-6">
                                <div id="supplierCustomerBtn" class="mt-8">
                                    <button type="button" id="supplierBtn"
                                        class="btn btn-outline-primary btn-pill btn-sm">
                                        Add Supplier
                                    </button>
                                    <button type="button" id="customerBtn"
                                        class="btn btn-outline-primary btn-pill btn-sm">
                                        Add Customer
                                    </button>
                                </div>
                                <div id="supplierSelect" style="display: none;">
                                    <label>Supplier</label>
                                    <span class="text-danger font-size-xs" role="button"
                                        id="supplierRemove">Remove</span>
                                    <select class="form-control selectpicker " title="Select Supplier" data-size="5"
                                        data-actions-box="true" data-live-search="true" name="supplier_id">
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">
                                                {{ $supplier->supplier_title }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                                <div id="customerSelect" style="display: none;">
                                    <label>Customer</label>
                                    <span class="text-danger font-size-xs" role="button"
                                        id="customerRemove">Remove</span>
                                    <select class="form-control selectpicker " title="Select Customer" data-size="5"
                                        data-actions-box="true" data-live-search="true" name="customer_id">
                                        @foreach ($customers as $customer)
                                            @if (!$loop->last)
                                                <option value="{{ $customer->id }}">
                                                    {{ $customer->customer_name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold"
                            data-dismiss="modal">Close</button>
                        <button class="btn btn-primary font-weight-bold">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

{{-- Scripts Section --}}

@section('scripts')
    {{-- vendors --}}
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js?v=7.0.5') }}"></script>

    {{-- Payment Categories Datatable --}}
    <script src="{{ asset('js/cashbook/payment_category_table.js') }}"></script>
    <script src="{{ asset('js/cashbook/cashbook.js') }}"></script>
    <script src="{{ asset('js/cashbook/cashbook_validation.js') }}"></script>
    <script src="{{ asset('js/pages/crud/forms/widgets/rangepicker.js') }}"></script>
    <script>
        $("#daterangepicker").on("apply.daterangepicker", function() {
            $(this).val();
            window.location.href = "/outlets/cashbook?date_range=" + $(this).val();
            // $("#date_range").val(start.format($("#buttonRangepicker span").text()));
            // $("#filterForm").submit();
        });
    </script>
@endsection
