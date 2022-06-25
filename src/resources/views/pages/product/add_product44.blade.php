@extends('layout.default')
@section('title', 'Add Product')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/wizard/wizard-1.css?v=7.2.9') }}">
@endsection
@section('content')
    <form class="form fv-plugins-bootstrap fv-plugins-framework" method="POST" action="{{ route('products.store') }}"
        id="add_product_form">
        @csrf
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Add Product</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="{{ route('products.index') }}" class="text-muted">All Product</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#" class="text-muted">Add Product</a>
                            </li>
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->

                <div class="d-flex align-items-center">
                    <!--begin::Actions-->
                    <button type="submit" class="btn btn-primary btn-shadow font-weight-bolder text-uppercase px-9 mr-2"
                        name="submit_btn" id="btn-submit">Save Product</button>
                    <button type="submit" class="btn btn-primary btn-shadow font-weight-bolder text-uppercase px-9"
                        name="submit_btn" id="btn-submit2">Submit & Add Stock</button>
                    <!--end::Actions-->
                </div>

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
                            <div class="card-body">
                                <div class="row justify-content-center px-8 px-lg-10">
                                    <div class="col-xl-12 col-xxl-9">
                                        <!--begin::Form Wizard-->

                                        <!--begin::Step 1-->
                                        <div class="pb-5" data-wizard-type="step-content">
                                            {{-- <h3 class="mb-10 font-weight-bold text-dark">Project Details:</h3> --}}
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="form-group row fv-plugins-icon-container has-success">
                                                        {{-- <div class="col-lg-4 col-xl-4">
                                                            <label>Product Type</label>
                                                            <select class="form-control selectpicker" id="product-type" name="product_type"
                                                                data-live-search="true">
                                                                <option value="simple"
                                                                    {{ old('product_type') == 'simple' ? 'selected' : '' }}>
                                                                    Simple Product</option>
                                                                
                                                                <option value="variant"
                                                                    {{ old('product_type') == 'variant' ? 'selected' : '' }}>
                                                                    Variant Product</option>
                                                                
                                                            </select>
                                                            <div class="fv-plugins-message-container"></div>
                                                        </div> --}}
                                                        <div class="col-lg-6 col-xl-6">
                                                            <label class="">Product Title <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" id="product_title" class="form-control  "
                                                                value="{{ old('product_title') }}" name="product_title"
                                                                placeholder="Product Title" />
                                                            <div class="fv-plugins-message-container">
                                                                <div data-field="product_title" data-validator="notEmpty"
                                                                    class="fv-help-block">
                                                                    {{ $errors->first('product_title') }}
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-xl-6">
                                                            <label class="">Barcode <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input type="text" id="product_barcode"
                                                                    class="form-control  "
                                                                    value="{{ old('product_barcode') }}"
                                                                    name="product_barcode" placeholder="Barcode" />
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-secondary" type="button"
                                                                        id="generate">
                                                                        Generate
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="fv-plugins-message-container">
                                                                {{ $errors->first('product_barcode') }}
                                                            </div>
                                                        </div>


                                                    </div>

                                                    <div class="form-group row fv-plugins-icon-container has-success">
                                                        <div class="col-lg-4 col-xl-4">
                                                            <label>Status</label>
                                                            <select class="form-control   selectpicker" id="status"
                                                                name="product_status">
                                                                <option>Active</option>
                                                                <option>Inactive</option>
                                                            </select>
                                                            <div class="fv-plugins-message-container"></div>
                                                        </div>
                                                        <div class="col-lg-4 col-xl-4">
                                                            <label>Category <span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <select class="form-control    selectpicker " id="category"
                                                                    name="category_id" data-live-search="true" data-size="5"
                                                                    title="Choose one of the following...">
                                                                    <option value="">Select Category</option>
                                                                    @foreach ($categories as $category)
                                                                        <option value="{{ $category->id }}"
                                                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                                            {{ $category->category_title }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-primary" type="button"
                                                                        data-toggle="modal" data-target="#category_model">
                                                                        Add New
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="fv-plugins-message-container">
                                                                {{ $errors->first('category_id') }}
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-xl-4">
                                                            <label>Company <span class="text-danger">*</span></label>
                                                            <div class="input-group ">
                                                                <select class="form-control   selectpicker"
                                                                    data-live-search="true" data-size="5" id="company"
                                                                    name="company_id"
                                                                    title="Choose one of the following...">
                                                                    @foreach ($companies as $company)
                                                                        <option value="{{ $company->id }}"
                                                                            {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                                                            {{ $company->company_title }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-primary" type="button"
                                                                        data-toggle="modal" data-target="#company_model">
                                                                        Add New
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="fv-plugins-message-container">
                                                                {{ $errors->first('company_id') }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row fv-plugins-icon-container has-success mb-0">
                                                        <div class="col-lg-6 col-xl-6">
                                                            <label>Description</label>
                                                            <textarea class="form-control" id="exampleTextarea"
                                                                name="product_description" placeholder="Product Description"
                                                                rows="4">{{ old('product_description') }}</textarea>
                                                            <div class="fv-plugins-message-container"></div>
                                                        </div>
                                                        <div class="col-lg-3 col-xl-3">
                                                            <div class="col-lg-12 col-xl-12">
                                                                <label class="col-form-label">Allow Half</label>
                                                                <span
                                                                    class="switch switch-outline switch-icon switch-success">
                                                                    <label data-toggle="tooltip"
                                                                        title="Product which you want to sell in decimal quantity."
                                                                        data-menu-toggle="hover">
                                                                        <input type="checkbox" name="product_allow_half"
                                                                            value="1" />
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                                <div class="fv-plugins-message-container"></div>
                                                            </div>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <label>Stock Keeping?</label>
                                                                <span
                                                                    class="switch switch-outline switch-icon switch-success">
                                                                    <label data-toggle="tooltip"
                                                                        title="Manage stock at product level."
                                                                        data-menu-toggle="hover">
                                                                        <input type="checkbox" name="stock_keeping"
                                                                            id="keep_stock"
                                                                            {{ old('stock_keeping') == 1 ? 'checked' : '' }}
                                                                            value="1" />
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-xl-3">
                                                            <div class="image-input image-input-outline" id="kt_image_1">
                                                                <div class="image-input-wrapper"
                                                                    style="background-image: url({{ asset('storage/placeholder.jpg') }})">
                                                                </div>
                                                                <label
                                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                    data-action="change" data-toggle="tooltip" title=""
                                                                    data-original-title="Change avatar">
                                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                                    <input type="file" name="product_feature_img"
                                                                        accept=".jpg,.png" />
                                                                </label>
                                                                <span
                                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                    data-action="cancel" data-toggle="tooltip"
                                                                    title="Cancel avatar">
                                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                                </span>
                                                            </div>
                                                            <p>Product Image</p>

                                                            <div class="fv-plugins-message-container"></div>
                                                        </div>

                                                    </div>


                                                    <div id="retail_price">
                                                        <div class="form-group row fv-plugins-icon-container has-success">
                                                            <div class="col-lg-6 col-xl-6">
                                                                <label>Cost Price <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="cost_price"
                                                                    value="{{ old('cost_price') }}"
                                                                    placeholder="Cost Price" />
                                                                <div class="fv-plugins-message-container">
                                                                    {{ $errors->first('cost_price') }}
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-xl-6">
                                                                <label>Retail Price <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    name="retail_price" value="{{ old('retail_price') }}"
                                                                    placeholder="Retail Price" />
                                                                <div class="fv-plugins-message-container">
                                                                    {{ $errors->first('retail_price') }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{ $errors }}
                                                    <div id="stock_keeping_fields">
                                                        <div class="form-group row fv-plugins-icon-container has-success">
                                                            <div class="col-lg-6 col-xl-6">
                                                                <label>Minimum Threshold</label>
                                                                <input type="text" class="form-control"
                                                                    name="minimum_threshold"
                                                                    value="{{ old('minimum_threshold') }}"
                                                                    placeholder="Minimum Threshold" />
                                                                <div class="fv-plugins-message-container">

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-xl-6">
                                                                <label>SKU</label>
                                                                <input type="text" class="form-control" name="sku"
                                                                    value="{{ old('sku') }}" placeholder="SKU" />
                                                                <div class="fv-plugins-message-container"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Step 1-->


                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <div>
                                                <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                                                <input type="hidden" name="created_by"
                                                    value="{{ session('employee_id') }}">

                                                {{-- <button type="button" class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-next">Next Step</button> --}}
                                            </div>
                                        </div>
                                        <!--end::Actions-->

                                        <!--end::Form Wizard-->
                                    </div>
                                </div>
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
    </form>
    <!-- COMPANY MODEL -->
    <div class="modal fade" id="company_model" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="add_company_form" class="add_company">

                    <div class="modal-header">
                        <h6 class="modal-title" id="company_model">Add Company</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group row mb-0">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label>Company Name*</label>
                                    <input type="text" class="form-control" autofocus="on" name="company_title"
                                        placeholder="Company Name" />
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label>Supplier *</label>
                                    <select class="form-control selectpicker" id="supplier" title="Select Supplier"
                                        data-size="5" data-live-search="true" name="supplier_id[]" multiple="multiple">
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->supplier_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                            <input type="hidden" name="created_by" value="{{ session('employee_id') }}">
                            <div class="col-xl-12">
                                <button type="submit" id="save-company"
                                    class="btn btn-primary btn-shadow px-12 mt-4">Save</button>
                            </div>
                        </div>


                    </div>
                </form>
                <div class="modal-footer d-block">
                    <form id="add_supplier_form" class="add_supplier">
                        <div class="form-group row mb-0">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label>Add Supplier if its not in the dropdown above.</label>
                                    <input type="text" class="form-control" autofocus="on" name="supplier_title"
                                        placeholder="Supplier Name" />
                                </div>
                            </div>
                            <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                            <input type="hidden" name="created_by" value="{{ session('employee_id') }}">
                            <div class="col-xl-6">
                                <button type="submit" id="save-supplier"
                                    class="btn btn-primary btn-shadow px-12 mt-8">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- CATEGORY MODEL -->
    <div class="modal fade" id="category_model" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="add_category_form" class="add_category">

                    <div class="modal-header p-4">
                        <h6 class="modal-title" id="category_model">Add Category</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group row mb-0">
                            <div class="col-xl-12">
                                <div class="form-group mb-5">
                                    <label>Category Name*</label>
                                    <input type="text" class="form-control" autofocus name="category_title"
                                        placeholder="Category Name" />

                                </div>
                            </div>

                        </div>

                        <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                        <input type="hidden" name="created_by" value="{{ session('employee_id') }}">
                        <button class="btn btn-primary btn-shadow px-12 mt-4" id="save-category">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection


{{-- Scripts Section --}}

@section('scripts')
    <script>
        $('#btn-submit').click(() => {
            var product_title = $('#product_title').val();
            var product_barcode = $('#product_barcode').val();

            $('#product_title').val(product_title.trim());
            $('#product_barcode').val(product_barcode.trim());
        });
        $('#btn-submit2').click(() => {
            var product_title = $('#product_title').val();
            var product_barcode = $('#product_barcode').val();

            $('#product_title').val(product_title.trim());
            $('#product_barcode').val(product_barcode.trim());
        });
    </script>
    <script src="{{ asset('js/products/form_validation.js') }}"></script>
    <script>
        $("#save-company").on("click", function(event) {
            event.preventDefault();
            let _token = $('meta[name="csrf-token"]').attr("content");
            let company_title = $("input[name=company_title]").val();
            let supplier_id = $("#supplier").val();
            let created_by = $("input[name=created_by]").val();
            let outlet_id = $("input[name=outlet_id]").val();
            $("#save-company").attr("disabled", true);
            // data = document.getElementById("add_customer_form"),
            $.ajax({
                url: "{{ route('companies.add-company') }}",
                type: "POST",
                data: {
                    company_title: company_title,
                    supplier_id: supplier_id,
                    created_by: created_by,
                    outlet_id: outlet_id,
                    _token: _token,
                },
                success: function(response) {
                    // console.log(response);
                    $("#company_model").modal("toggle");

                    toastr.success("Company Added");
                    $("[name='company_title']").val("");
                    $("#supplier").selectpicker("refresh");
                    $("#supplier").selectpicker("val", '');

                    $.ajax({
                        url: "{{ url('get-company') }}?id=" + response,
                        type: "Get",
                        success: function(res) {
                            $("#save-company").attr("disabled", false);
                            $.each(res, function(key, value) {
                                $("#company").append(
                                    "<option value='" + key + "'>" + value +
                                    "</option>"
                                );
                            });
                            $("#company").selectpicker("refresh");
                            var newVal = $("#company option:last").val();
                            $("#company").selectpicker("val", [newVal]);


                        },
                    });
                },
                error: function(response) {
                    $("#company_model").modal("toggle");
                    $("#save-company").attr("disabled", false);
                    toastr.error("Error! Please try again");
                    $("[name='company_title']").val("");
                    $("#supplier").selectpicker("refresh");
                    $("#supplier").selectpicker("val", '');
                },
            });
        });

        $("#save-supplier").on("click", function(event) {
            $("#save-supplier").attr("disabled", true);
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
                    $("#save-supplier").attr("disabled", false);
                    $("[name='supplier_title']").val("");

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
                    toastr.error("Error! Please try again");
                    $("#save-supplier").attr("disabled", false);
                    $("[name='supplier_title']").val("");
                },
            });
        });




        $("#save-category").on("click", function(event) {
            event.preventDefault();
            $("#save-category").attr("disabled", true);
            let _token = $('meta[name="csrf-token"]').attr("content");
            let category_title = $("input[name=category_title]").val();
            let created_by = $("input[name=created_by]").val();
            let outlet_id = $("input[name=outlet_id]").val();
            // data = document.getElementById("add_customer_form"),
            $.ajax({
                url: "{{ route('categories.add-category') }}",
                type: "POST",
                data: {
                    category_title: category_title,
                    created_by: created_by,
                    outlet_id: outlet_id,
                    _token: _token,
                },
                success: function(response) {
                    // console.log(response);
                    $("#category_model").modal("toggle");
                    $("#save-category").attr("disabled", false);
                    toastr.success("Category Added");
                    $("[name='category_title']").val("");

                    $.ajax({
                        url: "{{ url('get-category') }}?id=" + response,
                        type: "Get",
                        success: function(res) {
                            $.each(res, function(key, value) {
                                $("#category").append(
                                    "<option value='" + key + "'>" + value +
                                    "</option>"
                                );
                            });
                            $("#category").selectpicker("refresh");
                            var newVal = $("#category option:last").val();
                            $("#category").selectpicker("val", [newVal]);

                        },
                    });
                },
                error: function(response) {
                    $("#category_model").modal("toggle");
                    $("#save-category").attr("disabled", false);
                    toastr.error("Error! Please try again");
                    $("[name='category_title']").val("");
                },
            });
        });
    </script>
    <script>
        $('#submit-add-stock').click(function() {
            $('#add_product_form').submit();
        });

        var keep_stock = $('#keep_stock');
        keep_stock.change(function() {

            $if_checked = $(this).is(':checked');
            if ($if_checked == true) {
                $('#retail_price').addClass('d-none');
                $('#stock_keeping_fields').removeClass('d-none');
                $('#btn-submit2').removeClass('d-none');
            } else {
                $('#retail_price').removeClass('d-none');
                $('#stock_keeping_fields').addClass('d-none');
                $('#btn-submit2').addClass('d-none');
            }
        });

        $(document).ready(function() {


            $if_checked = keep_stock.is(':checked');


            if ($if_checked == true) {
                $('#retail_price').addClass('d-none');
                $('#stock_keeping_fields').removeClass('d-none');
                $('#btn-submit2').removeClass('d-none');
            } else {
                $('#retail_price').removeClass('d-none');
                $('#stock_keeping_fields').addClass('d-none');
                $('#btn-submit2').addClass('d-none');
            }

        });
    </script>
    <script>
        $('#generate').click(() => {
            $.ajax({
                url: "{{ route('barcode.generate') }}",
                type: "Get",
                success: function(res) {
                    $('#product_barcode').val(res.barcode);

                },
            });
        });
    </script>

    <script>
        var avatar1 = new KTImageInput('kt_image_1');
    </script>

    {{-- <script src="{{asset('js/pages/custom/projects/add-project.js?v=7.2.9')}}"></script> --}}
@endsection
