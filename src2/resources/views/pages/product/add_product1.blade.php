@extends('layout.default')
@section('title', 'Add Product')
@section('content')
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
                        <form method="post" action="{{ route('products.store') }}" id="add_product_form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body pb-2">
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label for="product-type">Product Type *</label>

                                        <select class="form-control selectpicker" id="product-type" name="product_type"
                                            data-live-search="true">
                                            <option value="simple"
                                                {{ old('product_type') == 'simple' ? 'selected' : '' }}>
                                                Simple Product</option>
                                            {{-- @foreach ($product_types as $product_type) --}}
                                            <option value="variant"
                                                {{ old('product_type') == 'variant' ? 'selected' : '' }}>
                                                Variant Product</option>
                                            {{-- @endforeach --}}
                                        </select>
                                        <span class="form-text text-muted"> {{ $errors->first('product_type') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>Product Title *</label>
                                        <input type="text" id="product_title"
                                            class="form-control {{ $errors->first('product_title') ? 'is-invalid' : '' }}"
                                            value="{{ old('product_title') }}" name="product_title"
                                            placeholder="Product Title" />
                                        <span class="form-text text-muted"> {{ $errors->first('product_title') }}</span>
                                        {{-- <label>Full Name:</label>
                                        <input type="email" class="form-control" placeholder="Enter full name"/>
                                        <span class="form-text text-muted">Please enter your full name</span> --}}
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Barcode *</label>
                                        <div class="input-group">
                                            <input type="text" id="product_barcode"
                                                class="form-control {{ $errors->first('product_barcode') ? 'is-invalid' : '' }}"
                                                value="{{ old('product_barcode') }}" name="product_barcode"
                                                placeholder="Barcode" />
                                            <div class="input-group-append">
                                                <a href="javascript:void(0)" class="btn btn-secondary pt-3 " id="generate">
                                                    Generate
                                                </a>
                                            </div>
                                            <span class="form-text text-muted">
                                                {{ $errors->first('product_barcode') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <label for="exampleTextarea">Description</label>
                                        <textarea class="form-control" id="exampleTextarea" name="product_description"
                                            rows="1">{{ old('product_description') }}</textarea>
                                        {{-- <span class="form-text text-muted">Please enter your username</span> --}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    @foreach ($custom_fields as $custom_field)
                                        <div class="col-lg-4">
                                            <label>{{ $custom_field->title }}
                                                {{ $custom_field->is_required ? '*' : '' }}</label>
                                            <input type="hidden" class="form-control" value="{{ $custom_field->id }}"
                                                name="custom_field_id[]">
                                            <input type="text" class="form-control"
                                                value="{{ $custom_field->default_value }}"
                                                placeholder="Enter {{ $custom_field->title }}"
                                                name="custom_field_value[]" {{ $custom_field->is_required ? 'required' : '' }}
                                                {{ strpos($custom_field->data_type, 'date') !== false ? 'readonly' : '' }}
                                                id="{{ strpos($custom_field->data_type, 'date') !== false ? 'kt_datepicker_starting' : '' }}">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label for="category">Category *</label>
                                        <div class="input-group">
                                            <select class="form-control selectpicker " id="category" name="category_id"
                                                data-live-search="true" title="Choose one of the following...">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->category_title }}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button" data-toggle="modal"
                                                    data-target="#category_model">
                                                    Add New
                                                </button>
                                            </div>
                                        </div>
                                        <span class="form-text text-muted">{{ $errors->first('category_id') }}</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="company">Company *</label>
                                        <div class="input-group">
                                            <select class="form-control selectpicker" data-live-search="true" data-size="5"
                                                id="company" name="company_id" title="Choose one of the following...">
                                                @foreach ($companies as $company)
                                                    <option value="{{ $company->id }}"
                                                        {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                                        {{ $company->company_title }}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button" data-toggle="modal"
                                                    data-target="#company_model">
                                                    Add New
                                                </button>
                                            </div>
                                        </div>
                                        <span class="form-text text-muted">{{ $errors->first('company_id') }}</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <!--begin::Input-->
                                        <label for="status">Status</label>
                                        <select class="form-control selectpicker" id="status" name="product_status">
                                            <option>Active</option>
                                            <option>Inactive</option>
                                        </select>
                                        <!--end::Input-->
                                        {{-- <span class="form-text text-muted">Please enter your address</span> --}}
                                    </div>
                                </div>
                                <div class="form-group row mb-2" id="simple-product-fields">
                                    <div class="col-lg-4">
                                        <label class="col-form-label">Stock Keeping?</label>
                                        <span class="switch switch-outline switch-icon switch-success">
                                            <label data-toggle="tooltip" title="Manage stock at product level."
                                                data-menu-toggle="hover">
                                                <input type="checkbox" name="stock_keeping" id="keep_stock"
                                                    {{ old('stock_keeping') == 1 ? 'checked' : '' }} value="1" />
                                                <span></span>
                                            </label>
                                        </span>
                                        <label class="col-form-label">Allow Half</label>
                                        <span class="switch switch-outline switch-icon switch-success">
                                            <label data-toggle="tooltip"
                                                title="Product which you want to sell in decimal quantity."
                                                data-menu-toggle="hover">
                                                <input type="checkbox" name="product_allow_half" value="1" />
                                                <span></span>
                                            </label>
                                        </span>
                                        {{-- </div> --}}
                                    </div>
                                    <div id="retail_price" class="col-lg-4">
                                        {{-- <div class="col-xl-12"> --}}

                                        <!--begin::Input-->
                                        <label>Cost Price *</label>
                                        <input type="text"
                                            class="form-control {{ $errors->first('cost_price') ? 'is-invalid' : '' }}"
                                            name="cost_price" value="{{ old('cost_price') }}" placeholder="Cost Price" />
                                        <!--end::Input-->
                                        <span class="form-text text-muted">{{ $errors->first('cost_price') }}</span>
                                        {{-- </div> --}}
                                        {{-- <div class="col-xl-12" > --}}

                                        <!--begin::Input-->
                                        <label>Retail Price *</label>
                                        <input type="text"
                                            class="form-control {{ $errors->first('retail_price') ? 'is-invalid' : '' }}"
                                            name="retail_price" value="{{ old('retail_price') }}"
                                            placeholder="Retail Price" />
                                        <!--end::Input-->
                                        <span class="form-text text-muted">{{ $errors->first('retail_price') }}</span>
                                        {{-- </div> --}}
                                    </div>
                                    <div id="stock_keeping_fields" class="col-lg-4">
                                        <div class="col-xl-12">
                                            <!--begin::Input-->
                                            <label>Minimum Threshold</label>
                                            <input type="text" class="form-control" name="minimum_threshold"
                                                value="{{ old('minimum_threshold') }}" placeholder="Minimum Threshold" />
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-12">
                                            <!--begin::Input-->
                                            <label>SKU</label>
                                            <input type="text" class="form-control" name="sku"
                                                value="{{ old('sku') }}" placeholder="SKU" />
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mt-3">
                                            <div class="image-input image-input-outline" id="kt_image_1">

                                                <div class="image-input-wrapper"
                                                    style="background-image: url({{ asset('storage/placeholder.jpg') }})">
                                                </div>

                                                <label
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="change" data-toggle="tooltip" title=""
                                                    data-original-title="Change avatar">
                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                    <input type="file" name="product_feature_img" accept=".jpg,.png" />
                                                </label>

                                                <span
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>
                                            </div>
                                            <span class="form-text">Product Image</span>
                                            @error('product_feature_img')
                                                {{ $message }}
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                {{-- <div class="form-group row"> --}}
                                <div class="form-group row" id="variation-fields">
                                    <div class="col-xl-4">
                                        <label>Units in Stock</label>
                                        <input type="text" class="form-control" name="units_in_stock"
                                            value="{{ old('units_in_stock') }}" placeholder="Units in Stock" />
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label>Variation Type</label>
                                            <select class="form-control   selectpicker" title="Select Variation"
                                                data-live-search="true" data-size="5" name="variation_id"
                                                id="variation_type">
                                                @foreach ($variations as $variation)
                                                    <option value="{{ $variation->id }}"
                                                        {{ old('variation_id') == $variation->id ? 'selected' : '' }}>
                                                        {{ $variation->variation_title }}</option>
                                                @endforeach
                                            </select>
                                            <p class="text-danger"> {{ $errors->first('variation_id') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label>Variation Attributes</label>
                                            <select class="form-control selectpicker" name="variation_attribute_id[]"
                                                id="variation_attributes" title="Select Variation Attributes" data-size="5"
                                                data-live-search="true" multiple="multiple">
                                                @error('variation_attribute_id')
                                                    {{ $message }}
                                                @enderror
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- </div> --}}
                                <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                                <input type="hidden" name="created_by" value="{{ session('employee_id') }}">

                            </div>

                            <div class="card-footer pt-2">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <button type="submit" name="submit_btn" id="btn-submit" value="0"
                                            class="btn btn-primary btn-shadow px-12">Submit</button>
                                        <button class="btn btn-primary btn-shadow ml-5 px-12" id="btn-submit2"
                                            name="submit_btn" id="submit-add-stock" value="1">Submit & Add
                                            Stock</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
                                            <option value="{{ $supplier->id }}">{{ $supplier->supplier_title }}
                                            </option>
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

            $('#variation-fields').addClass('d-none');
            $('#variation_attributes').attr("disabled", true);
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
        $('#product-type').change(function() {
            var type = $(this).val();
            if (type == 'variant') {
                $('#simple-product-fields').addClass('d-none');
                $('#stock_keeping_fields').removeClass('d-none');
                $('#variation-fields').removeClass('d-none');


            } else if (type == 'simple') {
                $('#simple-product-fields').removeClass('d-none');
                $('#stock_keeping_fields').addClass('d-none');
                $('#variation-fields').addClass('d-none');
            }
        });
        $('#variation_type').change(function() {
            var variation_id = $(this).val();
            $('#variation_attributes').attr("disabled", false);

            $.ajax({
                type: "GET",
                url: "/get-variation-attributes?variation_id=" + variation_id,
                dataType: "JSON",
                success: function(response) {
                    // console.log(response);
                    let attributes = $.each(response, function(key, value) {
                        $("#variation_attributes").append(
                            "<option value='" +
                            key + "'>" + value +
                            "</option>"
                        );
                    });
                    $("#variation_attributes").selectpicker("refresh");
                    // var newVal = $("#variation_attributes option:last").val();
                    // $("#variation_attributes").selectpicker("val", [newVal]);
                    // console.log($("#variation_attributes").html());
                }
            });
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

    <script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/pages/crud/forms/widgets/form-repeater.js?v=7.2.9') }}"></script>
@endsection
