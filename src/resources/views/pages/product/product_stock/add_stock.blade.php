@extends('layout.default')
@section('title', 'Add Stock')
@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Product</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Product Stock</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('product-stock.index') }}" class="text-muted">In Stock</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">Add Stock</a>
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
                                <h3 class="card-label">Add Stock
                                    <span class="d-block text-muted pt-2 font-size-sm"></span>
                                </h3>
                            </div>

                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form method="post" action="{{ route('product-stock.store') }}" id="add_product_stock"
                                autocomplete="off">
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
                                                <label for="category">Product *</label>
                                                <select class="form-control    selectpicker" id="product_id"
                                                    name="product_id" data-live-search="true" data-size="5"
                                                    title="Choose one of the following...">
                                                    <option value="">--Select Nothing--</option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}"
                                                            {{ $product_id == $product->id ? 'selected' : '' }}
                                                            {{ old('product_id') == $product->id ? 'selected' : '' }}
                                                            data-allow-half={{ $product->product_allow_half }}
                                                            data-company={{ $product->company_title }}>
                                                            {{ $product->product_title }}</option>
                                                    @endforeach
                                                </select>
                                                <p class="text-danger"> {{ $errors->first('product_id') }}</p>
                                            </div>
                                            <!--end::Input-->
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <!--begin::Input-->
                                                <label for="category">Supplier *</label>
                                                <div class="input-group">
                                                    <select class="form-control    selectpicker" id="supplier"
                                                        name="supplier_id" data-live-search="true" data-size="5"
                                                        title="Choose one of the following...">

                                                    </select>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button" data-toggle="modal"
                                                            data-target="#assignCompanyModal">
                                                            Assign Company
                                                        </button>
                                                    </div>
                                                </div>
                                                <p class="text-dark my-1"><span id="product-company"></span></p>
                                                <p class="text-danger"> {{ $errors->first('supplier_id') }}</p>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <!--begin::Input-->
                                                <label>Date *</label>
                                                <input type="text" class="form-control   " id="kt_datepicker_3"
                                                    name="po_purchased_date" value="{{ old('po_purchased_date') }}"
                                                    placeholder="Date" readonly />
                                                <!--end::Input-->
                                                <p class="text-danger"> {{ $errors->first('po_purchased_date') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <!--begin::Input-->
                                                <label>Units in Stock *</label>
                                                <input type="text"
                                                    class="form-control    {{ $errors->first('units_in_stock') ? 'is-invalid' : '' }}"
                                                    id="units" name="units_in_stock" value="{{ old('units_in_stock') }}"
                                                    placeholder="Units" />
                                                <!--end::Input-->
                                                <p class="text-danger"> {{ $errors->first('units_in_stock') }}</p>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="form-group row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <!--begin::Input-->
                                                <label>Cost Price *</label>
                                                <input type="text"
                                                    class="form-control    {{ $errors->first('cost_price') ? 'is-invalid' : '' }}"
                                                    id="cost_price" name="cost_price" value="{{ old('cost_price') }}"
                                                    placeholder="Cost Price" />
                                                <!--end::Input-->
                                                <p class="text-danger"> {{ $errors->first('cost_price') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <!--begin::Input-->
                                                <label>Retail Price *</label>
                                                <input type="text"
                                                    class="form-control    {{ $errors->first('retail_price') ? 'is-invalid' : '' }}"
                                                    name="retail_price" value="{{ old('retail_price') }}"
                                                    placeholder="Retail Price" />
                                                <!--end::Input-->
                                                <p class="text-danger"> {{ $errors->first('retail_price') }}</p>
                                            </div>
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
                                                    {{-- <option value="">Select Payment Type First</option> --}}
                                                </select>
                                                <p class="text-danger"> {{ $errors->first('payment_method_id') }}</p>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <label for="exampleTextarea">Remarks</label>
                                                <textarea class="form-control   " id="exampleTextarea" name="remarks"
                                                    rows="5">{{ old('remarks') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2">
                                        <div class="justify-content-between row">
                                            <input type="hidden" value="0" name="total_bill" id="total_bill">
                                            <h2>Total Bill:</h2>
                                            <h2 id="total_bill_text">0</h2>
                                        </div>
                                    </div>
                                    <input type="hidden" name="allow_half" id="hidden_allow_half">
                                    <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                                    <input type="hidden" name="created_by" value="{{ session('employee_id') }}">
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-shadow px-12">Submit</button>
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


    <!-- Supplier MODEL -->
    <div class="modal fade" id="assignCompanyModal" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="add_supplier_form" class="add_supplier" autocomplete="off">
                    <div class="modal-header">
                        <h6 class="modal-title" id="assignCompanyModalLabel">Assign Company to Supplier</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row mb-0">
                            <div class="col-xl-6">
                                <!--begin::Input-->
                                <div class="form-group ">
                                    <label>Supplier *</label>
                                    <div class="input-group">
                                        <select class="form-control   selectpicker " title="Select Supplier" data-size="5"
                                            data-actions-box="true" data-live-search="true" id="assign_supplier_id">
                                            @foreach ($suppliers as $id => $supplier)
                                                <option value="{{ $id }}">{{ $supplier }}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" data-toggle="modal"
                                                data-target="#addSupplierModal">
                                                Add New
                                            </button>
                                        </div>
                                    </div>

                                </div>
                                <!--end::Input-->
                            </div>
                            <div class="col-xl-6">
                                <!--begin::Input-->
                                <div class="form-group">
                                    <label>Company *</label>
                                    <select class="form-control selectpicker" id="assign_company_id" title="Select Company"
                                        data-size="5" data-live-search="true">
                                    </select>
                                    <div id="assigned-companies">
                                    </div>
                                </div>
                                <!--end::Input-->
                            </div>
                        </div>
                        <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                        <input type="hidden" name="created_by" value="{{ session('employee_id') }}">
                        <button type="submit" id="assign_company_btn"
                            class="btn btn-primary btn-shadow px-12 mt-4">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addSupplierModal" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="add_supplier_form" class="add_supplier" autocomplete="off">
                    <div class="modal-header">
                        <h6 class="modal-title" id="addSupplierModalLabel">Add New Supplier</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row mb-0">
                            <div class="col-xl-6">
                                <!--begin::Input-->
                                <div class="form-group ">
                                    <label>Supplier title*</label>
                                    <input type="text" name="supplier_title" class="form-control">

                                </div>
                                <!--end::Input-->
                            </div>
                        </div>
                        <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                        <input type="hidden" name="created_by" value="{{ session('employee_id') }}">
                        <button type="submit" id="new_supplier_btn"
                            class="btn btn-primary btn-shadow px-12 mt-4">Save</button>
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

    {{-- Date Picker --}}
    <script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>
    <script>
        function getSupplierCompanies() {
            let supplierID = $('#assign_supplier_id').val();

            $.ajax({
                url: "{{ url('outlets/get-supplier-companies') }}?supplier_id=" + supplierID,
                type: "Get",
                success: function(res) {
                    $('#assigned-companies').html('Assigned companies <br>');
                    // console.log(res.length);
                    if (res.length == 0) {
                        $('#assigned-companies').text('Companies not assigned yet.')
                    } else {
                        $.each(res, function(key, value) {
                            $('#assigned-companies').append(
                                '<p class="mb-0 mt-3 mx-1 badge badge-success">' + value
                                .company_title + '</p>')
                        });
                    }


                },
            });
            $.ajax({
                url: "{{ url('outlets/get-not-supplier-companies') }}?supplier_id=" + supplierID,
                type: "Get",
                success: function(res) {
                    $("#assign_company_id").empty();
                    $("#assign_company_id").selectpicker("refresh");
                    $.each(res, function(key, value) {
                        $("#assign_company_id").append(
                            "<option value='" + value.id + "'>" + value.company_title + "</option>"
                        );
                        $("#assign_company_id").selectpicker("refresh");
                    });


                },
            });
        }
        $("#assign_supplier_id").on("change", function() {
            getSupplierCompanies();
        });
    </script>
    <script>
        $("#assign_company_btn").on("click", function(event) {
            event.preventDefault();
            $("#assign_company_btn").attr("disabled", true);
            let _token = $('meta[name="csrf-token"]').attr("content");
            let supplier_id = $('#assign_supplier_id').val();
            let company_id = $("#assign_company_id").val();
            // console.log(supplier_id);
            let created_by = $("input[name=created_by]").val();
            let outlet_id = $("input[name=outlet_id]").val();
            $.ajax({
                url: "{{ route('assign-company.store') }}",
                type: "POST",
                data: {
                    supplier_id: supplier_id,
                    company_id: company_id,
                    created_by: created_by,
                    outlet_id: outlet_id,
                    _token: _token,
                },
                success: function(response) {
                    // console.log(response);
                    $("#assignCompanyModal").modal("toggle");
                    toastr.success("Company assigned to supplier");
                    $("#assign_company_btn").attr("disabled", false);
                    $('#assign_supplier_id').empty();
                    $("#assign_company_id").empty();
                    $('#assigned-companies').html('');
                    $("#assign_company_id").selectpicker('refresh');
                    $("#assign_supplier_id").selectpicker('refresh');
                    // $("#company").selectpicker('val','');

                    $.ajax({
                        url: "{{ url('get-supplier') }}?id=" + response,
                        type: "Get",
                        success: function(res) {
                            // console.log(res);
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
                    // $("#assignCompanyModal").modal("toggle");
                    toastr.error("Error! Please fill all fields");
                    $("#assign_company_btn").attr("disabled", false);
                    // $("[name='supplier_title']").val("");
                },
            });
        });

        $("#new_supplier_btn").on("click", function(event) {
            $("#new_supplier_btn").attr("disabled", true);
            event.preventDefault();
            let _token = $('meta[name="csrf-token"]').attr("content");
            let supplier_title = $("input[name=supplier_title]").val();
            let created_by = $("input[name=created_by]").val();
            let outlet_id = $("input[name=outlet_id]").val();
            // data = document.getElementById("add_customer_form"),
            $.ajax({
                url: "{{ route('suppliers.add-products-supplier') }}",
                type: "POST",
                data: {
                    supplier_title: supplier_title,
                    created_by: created_by,
                    outlet_id: outlet_id,
                    _token: _token,
                },
                success: function(response) {
                    $("#addSupplierModal").modal("toggle");
                    toastr.success("Supplier Added Successfully");
                    $("#new_supplier_btn").attr("disabled", false);
                    $("[name='supplier_title']").val("");

                    $.ajax({
                        url: "{{ url('get-supplier') }}?id=" + response,
                        type: "Get",
                        success: function(res) {
                            $.each(res, function(key, value) {
                                $("#assign_supplier_id").append(
                                    "<option value='" + key + "'>" + value +
                                    "</option>"
                                );
                            });
                            $("#assign_supplier_id").selectpicker("refresh");
                            var newVal = $("#assign_supplier_id option:last").val();
                            $("#assign_supplier_id").selectpicker("val", [newVal]);
                            getSupplierCompanies();


                        },
                    });
                },
                error: function(response) {
                    toastr.error("Error! Please try again");
                    $("#new_supplier_btn").attr("disabled", false);
                    $("[name='supplier_title']").val("");
                },
            });
        });

        // ---------------------------------------------------------------------------------
        var cost_price = $('#cost_price').val();
        var units = parseFloat($('#units').val());
        var total_bill = $('#total_bill');
        let allow_half = 0;


        $('#cost_price').keyup(
            function() {
                total_bill.val($('#cost_price').val() * $('#units').val());
                $('#total_bill_text').text($('#cost_price').val() * $('#units').val());
            }
        );
        $('#units').keyup(
            function() {
                total_bill.val($('#cost_price').val() * $('#units').val());
                $('#total_bill_text').text($('#cost_price').val() * $('#units').val());
            }
        );


        $('#product_id').change(function() {
            allow_half = $(this).find(':selected').attr('data-allow-half');
            product_company = $('#product_id').find(':selected').attr('data-company');
            $('#product-company').text('Product Company: ' + product_company);

            $('#hidden_allow_half').val(allow_half);
            var productID = $(this).val();
            $("#supplier").html("");
            $("#supplier").selectpicker("refresh");

            if (productID) {
                $.ajax({
                    url: "{{ url('product-cost') }}?product_id=" + productID,
                    type: "Get",
                    success: function(res) {
                        if (res) {
                            $("#cost_price").empty();
                            $.each(res, function(key, value) {
                                $("#cost_price").val(value);
                            });

                        } else {
                            $("#cost_price").empty();
                        }
                    }
                });
                $.ajax({
                    url: "{{ url('get-product-supplier') }}?product_id=" + productID,
                    type: "Get",
                    success: function(res) {
                        if (res) {
                            // console.log(res)
                            // $("#cost_price").empty();
                            $.each(res, function(key, company) {
                                $.each(company.supplier, function(test, supplier) {

                                    $("#supplier").append("<option value='" + supplier
                                        .id + "'>" + supplier.supplier_title +
                                        "</option>");
                                    $("#supplier").selectpicker("refresh");

                                });
                            });

                        } else {

                        }
                    }
                });
            } else {
                $("#cost_price").empty();
            }
        });

        var productID = $('#product_id').val();
        if (productID != '') {
            allow_half = $('#product_id').find(':selected').attr('data-allow-half');
            product_company = $('#product_id').find(':selected').attr('data-company');
            $('#product-company').text('Product Company: ' + product_company);
            $('#hidden_allow_half').val(allow_half);
            $("#supplier").html("");
            $("#supplier").selectpicker("refresh");
            $.ajax({
                url: "{{ url('product-cost') }}?product_id=" + productID,
                type: "Get",
                success: function(res) {
                    if (res) {
                        $("#cost_price").empty();
                        $.each(res, function(key, value) {
                            $("#cost_price").val(value);
                        });

                    } else {
                        $("#cost_price").empty();
                    }
                }
            });
            $.ajax({
                url: "{{ url('get-product-supplier') }}?product_id=" + productID,
                type: "Get",
                success: function(res) {
                    if (res) {
                        // console.log(res)
                        // $("#cost_price").empty();
                        $.each(res, function(key, company) {
                            $.each(company.supplier, function(test, supplier) {

                                $("#supplier").append("<option value='" + supplier.id + "'>" +
                                    supplier.supplier_title + "</option>");
                                $("#supplier").selectpicker("refresh");

                            });
                        });

                    } else {

                    }
                }
            });
        } else {
            $("#cost_price").empty();
        }

        // $('#units').on('keyup', function() {
        //     if(allow_half == 0){
        //         $('#units').val(Math.floor($('#units').val()));
        //     }
        // });
    </script>
    <script>
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
                                let selected = '';
                                if (old_method == value) {
                                    selected = 'selected';
                                } else if (key == 'Cash') {
                                    selected = 'selected';
                                }

                                $("#payment_method_dropdown").append(
                                    '<option ' + selected + ' value="' + value + '">' +
                                    key +
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
    </script>
    <script src="{{ asset('js/product_stock/form_validation.js') }}"></script>
@endsection
