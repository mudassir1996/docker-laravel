@extends('layout.default')
@section('title', 'Add Transaction')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/flatpicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/flatpicker-theme.css') }}">
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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Supplier Transaction</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('customer-accounts.index') }}" class="text-muted">All Transactions</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Add Transaction</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid px-0">
            <!--begin::Teachers-->
            <div class="d-flex flex-row">
                <!--begin::Content-->
                <div class="flex-row-fluid">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-header flex-wrap py-5">
                            <div class="card-title">
                                <h3 class="card-label">Add Supplier Payment
                                    <!-- <span class="d-block text-muted pt-2 font-size-sm">Manage Accounts</span> -->
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form method="post" action="{{ route('supplier-accounts.store') }}"
                                id="customer_transaction_form">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group mb-8">
                                        <div class="alert alert-custom alert-default" role="alert">
                                            <div class="alert-icon">
                                                <span class="svg-icon svg-icon-primary svg-icon-xl">
                                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Info-circle.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                                            <rect fill="#000000" x="11" y="10" width="2" height="7"
                                                                rx="1" />
                                                            <rect fill="#000000" x="11" y="7" width="2" height="2" rx="1" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <div class="alert-text">Fill out the form below. The fields with (*) are
                                                required.</div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Supplier*</label>
                                                <select class="form-control    selectpicker" id="supplier"
                                                    data-live-search="true" data-size="5" title="Select Supplier"
                                                    name="supplier_id">
                                                    @foreach ($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}"
                                                            {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                                            {{ $supplier->supplier_title }}</option>
                                                    @endforeach
                                                </select>
                                                <p class="text-danger"> {{ $errors->first('supplier_id') }}</p>

                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Order ID</label>
                                                <input type="text" class="form-control   " id="order" name="order_id"
                                                    placeholder="Add Order ID" />
                                                {{-- <div class="input-group">
                                                    <input type="text" class="form-control   " id="order" name="order_id" placeholder="Add Order ID" />
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button" id="get_order">
                                                            Add Order
                                                        </button>
                                                    </div>
                                                </div> --}}


                                            </div>
                                            <!--end::Input-->
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Amount*</label>
                                                <input type="text"
                                                    class="form-control    {{ $errors->first('amount') ? 'is-invalid' : '' }}"
                                                    name="amount" value="{{ old('amount') }}" autocomplete="off"
                                                    placeholder="Add Amount" />
                                                <p class="text-danger"> {{ $errors->first('amount') }}</p>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Payment Date *</label>
                                                <input type="text"
                                                    class="form-control flatpickr   {{ $errors->first('payment_date') ? 'is-invalid' : '' }}"
                                                    value="{{ old('payment_date') }}" readonly name="payment_date"
                                                    placeholder="Payment date" />
                                                <p class="text-danger"> {{ $errors->first('payment_date') }}</p>
                                            </div>
                                            <!--end::Input-->
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <!--begin::Input-->
                                                <label for="type">Payment Type *</label>
                                                <select class="form-control   " data-live-search="true" data-size="5"
                                                    id="payment_type_dropdown" name="payment_type">
                                                    {{-- <option value="">Select Payment Type</option> --}}
                                                    @foreach ($payment_types as $payment_type)
                                                        <option value="{{ $payment_type->id }}"
                                                            {{ old('payment_type') == $payment_type->id ? 'selected' : '' }}>
                                                            {{ $payment_type->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <p class="text-danger"> {{ $errors->first('payment_type') }}</p>
                                                <p class="text-danger"> {{ $errors->first('allow_credit') }}</p>

                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <!--begin::Input-->
                                                <label>Payment Method *</label>
                                                <select name="payment_method_id" id="payment_method_dropdown"
                                                    class="form-control   " data-live-search="true" data-size="5 ">
                                                    @foreach ($payment_methods as $payment_method)
                                                        <option value="{{ $payment_method->id }}"
                                                            {{ old('payment_method_id') == $payment_method->id ? 'selected' : '' }}>
                                                            {{ $payment_method->payment_title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <p class="text-danger"> {{ $errors->first('payment_method_id') }}</p>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-xl 12">
                                            <div class="form-group">
                                                <label for="exampleTextarea">Description</label>
                                                <textarea class="form-control   " id="exampleTextarea" name="description"
                                                    rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <input type="hidden" name="hidden_allow_credit"
                                        value="{{ old('hidden_allow_credit') }}">
                                    <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                                    <input type="hidden" name="created_by" value="{{ session('employee_id') }}">
                                    <button type="submit" name="btnSubmit"
                                        class="btn btn-primary btn-shadow px-12 mt-8">Submit</button>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Teachers-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
    <!-- Order MODEL -->
    <div class="modal fade" id="order_model" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="add_category_form" class="add_category">

                    <div class="modal-header">
                        <h6 class="modal-title" id="category_model">Add Order</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <table class="table table-separate nowrap table-head-custom table-checkable credit-orders-table">
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Order Date</th>
                                    <th>Paid</th>
                                    <th>Total Bill</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
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

    <script src="{{ asset('js/customer_accounts/form_validation.js') }}"></script>
    <script src="{{ asset('js/pages/flatpicker.js') }}"></script>

    <script>
        $(".flatpickr").flatpickr({
            defaultDate: new Date(),
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            maxDate: new Date()
        });

        $('#get_order').on('click', function() {
            $('.credit-orders-table > tbody').empty();
            let supplier_id = $('#supplier').val();
            $.ajax({
                url: "{{ url('supplier/get-credit-orders') }}?supplier_id=" + supplier_id,
                type: "Get",
                success: function(res) {
                    // console.log(res['output']);
                    // hold_orders = res['hold_orders'];
                    // $('.hold-orders-table > tbody').append(res['output']);
                    $('#order_model').modal('toggle');
                    $('.credit-orders-table > tbody').append(res);
                }

            });
        });


        function select_credit_order(id) {
            $('#order_model').modal('toggle');
            $('#order').val(id);
        }
    </script>
    {{-- <script>
        $(document).ready(function() {
            old_method = "{{ old('payment_method_id') }}";
            var selected = '';
            var typeID = $('#payment_type_dropdown').val();
            if (typeID) {
                $.ajax({
                    url: "{{ url('get-payment-method') }}?payment_type_id=" + typeID,
                    type: "Get",
                    success: function(res) {
                        if (res) {
                            $("#payment_method_dropdown").empty();
                            $.each(res, function(key, value) {
                                let selected='';
                                if(old_method==value){
                                    selected='selected';
                                }
                                else if (key == 'Cash') {
                                    selected='selected';
                                }
                                
                                $("#payment_method_dropdown").append(
                                '<option '+selected+' value="' + value + '">' + key +
                                '</option>');
                                
                            });
                        } else {
                            $("#payment_method_dropdown").empty();
                           
                        }
                    }
                });
            } else {
                $("#payment_method_dropdown").empty();
            }
        });
        $('#payment_type_dropdown').change(function() {
            var typeID = $(this).val();
            if (typeID) {
                console.log(typeID);
                $.ajax({
                    url: "{{ url('get-payment-method') }}?payment_type_id=" + typeID,
                    type: "Get",
                    success: function(res) {
                        if (res) {
                            $("#payment_method_dropdown").empty();
                           
                            $.each(res, function(key, value) {
                                $("#payment_method_dropdown").append('<option value="' + value +
                                    '">' + key +
                                    '</option>');
                                // if(old_state==value){
                                //     $("#state").selectpicker("val", [value]);
                                // }
                                // console.log($("#payment_method_dropdown").val());
                            });
                        } else {
                            $("#payment_method_dropdown").empty();
                            $("#payment_method_dropdown").append(
                                '<option value="">Select Payment Type First</option>');
                            $("#payment_method_dropdown").val("");
                        }
                    }
                });
            } else {
                $("#payment_method_dropdown").empty();
                $("#payment_method_dropdown").append('<option value="">Select Payment Type First</option>');
                $("#payment_method_dropdown").val("");
            }
        });
    </script> --}}


@endsection
