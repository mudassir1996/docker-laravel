@extends('layout.default')
@section('title', 'Add Supplier')
@section('content')


    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Supplier</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('suppliers.index') }}" class="text-muted">All Supplier</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Add Supplier</a>
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
                        {{-- <div class="card-header flex-wrap py-5">
                            <div class="card-title">
                                <h3 class="card-label">
                                    Add Supplier
                                </h3>
                            </div>
                        </div> --}}

                        <div class="accordion accordion-toggle-arrow" id="supplierAccordion">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title" data-toggle="collapse" data-target="#mgtosSupplierCollapse">
                                        Add MgtOs Supplier
                                    </div>
                                </div>
                                <div id="mgtosSupplierCollapse" class="collapse show" data-parent="#supplierAccordion">
                                    <div class="card-body pb-0">
                                        <div class="container">
                                            <div class="overlay  rounded">
                                                <div class="overlay-wrapper p-5">
                                                    {{-- <h3 class="mb-8">Search Supplier</h3> --}}
                                                    <form action="#" id="add_mgtos_supplier_form">
                                                        <div class="form-group row">
                                                            <div class="col-xl-4">
                                                                <label for="">Supplier Phone</label>
                                                                <input type="text" name="supplier_phone"
                                                                    class="form-control" placeholder="Supplier Phone"
                                                                    autocomplete="no">
                                                            </div>
                                                            <div class="col-xl-4">
                                                                <label for="">Supplier Public Key</label>
                                                                <input type="text" name="supplier_public_key"
                                                                    class="form-control" placeholder="Supplier Public Key"
                                                                    autocomplete="no">
                                                            </div>
                                                            <div class="col-xl-4 mt-8">
                                                                <button type="button" class="btn btn-primary px-12"
                                                                    id="addMgtosSupplierBtn">
                                                                    Search
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="overlay-layer rounded bg-dark-o-10" style="display: none;">
                                                    <div class="alert alert-custom alert-white" role="alert">
                                                        <div class="alert-icon">
                                                            <div class="spinner spinner-primary"></div>
                                                        </div>
                                                        <div class="alert-text ml-3">
                                                            Searching...
                                                        </div>

                                                    </div>
                                                    {{-- <div class="spinner spinner-primary"></div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ml-12 mb-5" id="supplier_details" style="display: none;">
                                        <div class="col-xl-6">
                                            <div class="card card-custom gutter-b shadow">
                                                <form action="{{ route('suppliers.store') }}" method="post">
                                                    @csrf
                                                    <!--begin::Body-->
                                                    <div class="card-body">
                                                        <!--begin::Header-->
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Info-->
                                                            <div class="d-flex flex-column flex-grow-1">
                                                                <input type="hidden" name="result_supplier_phone">
                                                                <input type="hidden" name="result_supplier_public_key">
                                                                <a href="#"
                                                                    class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder"
                                                                    id="result_supplier_title">
                                                                </a>
                                                                <span class="text-muted font-weight-bold"
                                                                    id="result_supplier_phone">
                                                                </span>
                                                            </div>
                                                            <!--end::Info-->
                                                            <button type="button" class="btn btn-secondary mr-2 px-6"
                                                                id="cancelBtn">
                                                                Cancel
                                                            </button>
                                                            <button class="btn btn-primary px-6">
                                                                Save
                                                            </button>

                                                        </div>
                                                        <!--end::Header-->
                                                        <p id="no_companies">
                                                            No Companies Found
                                                        </p>
                                                        <!--begin::Body-->
                                                        <div class="pt-5" id="result_supplier_companies">
                                                            <p class="text-dark-75 mb-1 font-size-lg font-weight-bolder">
                                                                Select Companies
                                                            </p>
                                                            <div class="form-group">
                                                                <div class="checkbox-inline" id="companies">

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!--end::Body-->
                                                    </div>
                                                    <!--end::Body-->
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title collapsed" data-toggle="collapse"
                                        data-target="#newSupplierCollapse">
                                        Add New Supplier
                                    </div>
                                </div>
                                <div id="newSupplierCollapse" class="collapse" data-parent="#supplierAccordion">
                                    <div class="card-body">
                                        <!--begin::Form-->
                                        <form method="post" action="{{ route('suppliers.store') }}" id="add_supplier_form"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row">
                                                <div class="col-xl-4">
                                                    <!--begin::Input-->
                                                    <label>Supplier Title *</label>
                                                    <input type="text" id="supplier_title"
                                                        class="form-control    {{ $errors->first('supplier_title') ? 'is-invalid' : '' }}"
                                                        value="{{ old('supplier_title') }}" name="supplier_title"
                                                        placeholder="Supplier Title" />
                                                    <span class="text-danger">
                                                        {{ $errors->first('supplier_title') }}</span>
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-xl-4">
                                                    <!--begin::Input-->
                                                    <label>Supplier Email</label>
                                                    <input type="text" class="form-control   "
                                                        value="{{ old('supplier_email') }}" name="supplier_email"
                                                        placeholder="Supplier Email" />
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-xl-4">
                                                    <!--begin::Input-->
                                                    <label>Supplier Address</label>
                                                    <input type="text" class="form-control   "
                                                        value="{{ old('supplier_address') }}" name="supplier_address"
                                                        placeholder="Supplier Address" />
                                                    <!--end::Input-->
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <div class="col-xl-4">
                                                    <!--begin::Input-->
                                                    <label>Company *</label>
                                                    <div class="input-group">
                                                        <select class="form-control   selectpicker " title="Select Company"
                                                            data-size="3" data-actions-box="true" data-live-search="true"
                                                            id="company" name="company_id[]" multiple>
                                                            @foreach ($companies as $id => $company)
                                                                <option value="{{ $id }}"
                                                                    {{ in_array($id, old('company_id', [])) ? 'selected' : '' }}>
                                                                    {{ $company }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" type="button"
                                                                data-toggle="modal" data-target="#company_model">
                                                                Add New
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-xl-4">
                                                    <!--begin::Input-->
                                                    <label>CNIC</label>
                                                    <input type="text" class="form-control   " name="supplier_cnic"
                                                        value="{{ old('supplier_cnic') }}" placeholder="Supplier CNIC" />
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-xl-4">
                                                    <!--begin::Input-->
                                                    <label>Supplier Phone</label>
                                                    <input type="text" class="form-control   " name="supplier_phone"
                                                        value="{{ old('supplier_phone') }}"
                                                        placeholder="Supplier Phone" />
                                                    <!--end::Input-->
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-xl-6">
                                                    <label for="exampleTextarea">Description</label>
                                                    <textarea class="form-control   " id="exampleTextarea" name="supplier_description"
                                                        rows="5">{{ old('supplier_description') }}</textarea>
                                                </div>
                                                <div class="col-xl-6">
                                                    <span class="form-text">Supplier Image</span>
                                                    <div class="image-input image-input-outline" id="kt_image_1">

                                                        <div class="image-input-wrapper"
                                                            style="background-image: url({{ asset('storage/placeholder.jpg') }})">
                                                        </div>

                                                        <label
                                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                            data-action="change" data-toggle="tooltip" title=""
                                                            data-original-title="Change avatar">
                                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                                            <input type="file" name="supplier_feature_img"
                                                                accept=".jpg,.png" />
                                                        </label>

                                                        <span
                                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                            data-action="cancel" data-toggle="tooltip"
                                                            title="Cancel avatar">
                                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                        </span>
                                                    </div>

                                                    @error('supplier_feature_img')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                            <button type="submit" id="btn-submit"
                                                class="btn btn-primary btn-shadow px-12">Submit</button>

                                        </form>
                                        <!--end::Form-->
                                    </div>
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


    <!-- COMPANY MODEL -->
    <div class="modal fade" id="company_model" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="add_company_form" class="add_company">

                    <div class="modal-header p-4">
                        <h6 class="modal-title" id="company_model">Add Company</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="form-group row mb-0">
                            <div class="col-xl-12">
                                <div class="form-group mb-3">
                                    <label>Company Name*</label>
                                    <input type="text" class="form-control" autofocus="on" name="company_title"
                                        placeholder="Company Name" />
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                        <input type="hidden" name="created_by" value="{{ session('employee_id') }}">
                        <button class="btn btn-primary btn-shadow px-12 mt-4" id="save-company">Save</button>
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
            var supplier_title = $('#supplier_title').val();
            $('#supplier_title').val(supplier_title.trim());
        });
    </script>
    <script src="{{ asset('js/suppliers/form_validation.js') }}"></script>
    <script>
        $("#save-company").on("click", function(event) {
            event.preventDefault();
            $('#save-company').attr('disabled', true);
            let _token = $('meta[name="csrf-token"]').attr("content");
            let company_title = $("input[name=company_title]").val();
            let created_by = $("input[name=created_by]").val();
            let outlet_id = $("input[name=outlet_id]").val();
            $.ajax({
                url: "{{ route('companies.add-company') }}",
                type: "POST",
                data: {
                    company_title: company_title,
                    created_by: created_by,
                    outlet_id: outlet_id,
                    _token: _token,
                },
                success: function(response) {
                    // console.log(response);
                    $("#company_model").modal("toggle");
                    $('#save-company').attr('disabled', false);
                    toastr.success("Company Added");
                    $("[name='company_title']").val("");

                    $.ajax({
                        url: "{{ url('get-company') }}?id=" + response,
                        type: "Get",
                        success: function(res) {
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
                    toastr.error("Error! Please try again");
                    $("[name='company_title']").val("");
                    $('#save-company').attr('disabled', false);
                },
            });
        });
    </script>

    <script>
        $('input[name="supplier_phone"]').inputmask("mask", {
            mask: "\\923999999999",
        });
        $('input[name="supplier_public_key"]').inputmask("mask", {
            mask: "999999",
        });
        $("#addMgtosSupplierBtn").on("click", function(event) {
            mgtosSupplierFv.validate().then(function(status) {
                if (status == "Valid") {
                    $(".overlay").addClass('overlay-block');
                    $(".overlay-layer").show();
                    $('#supplier_details').hide();
                    $.ajax({
                        url: "{{ route('suppliers.search-supplier') }}",
                        type: "POST",
                        data: {
                            supplier_phone: $('input[name="supplier_phone"]').val(),
                            supplier_public_key: $('input[name="supplier_public_key"]').val(),
                            _token: $('meta[name="csrf-token"]').attr("content"),
                        },
                        complete: function() {
                            $(".overlay").removeClass('overlay-block');
                            $(".overlay-layer").hide();
                        },
                        success: function(response) {
                            $('#result_supplier_title').text(response.outlet_title);
                            $('#result_supplier_phone').text(response.outlet_phone);
                            $('input[name="result_supplier_phone"]').val($(
                                'input[name="supplier_phone"]').val());
                            $('input[name="result_supplier_public_key"]').val($(
                                'input[name="supplier_public_key"]').val());
                            $('input[name="supplier_phone"]').val("");
                            $('input[name="supplier_public_key"]').val("");
                            if (response.companies.length > 0) {
                                $("#no_companies").hide();
                                $("#result_supplier_companies").show();
                                var checkbox = '';
                                $.each(response.companies, function(key, company) {
                                    checkbox += '<label class="checkbox">' +
                                        '<input type="checkbox" value="' + company
                                        .company_title +
                                        '" name="company_title[]" />' +
                                        '<span></span>' +
                                        company.company_title +
                                        '</label>'
                                });
                                $('#companies').html(checkbox);
                            } else {
                                $("#result_supplier_companies").hide();
                                $("#no_companies").show();
                            }

                            $('#supplier_details').show();


                        },
                        error: function(response) {
                            toastr.error(response.responseText);
                        }
                    });
                }
            });

        });
        $("#cancelBtn").click(function() {
            $('#supplier_details').hide();
        });
    </script>
@endsection
