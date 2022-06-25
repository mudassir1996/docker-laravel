@extends('layout.default')
@section('title', 'Assign Company')
@section('content')


    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Assign Company to Supplier</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('suppliers.index') }}" class="text-muted">All Supplier</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Assign Company</a>
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
                                <h3 class="card-label">Assign Company
                                    <!-- <span class="d-block text-muted pt-2 font-size-sm">All Suppliers</span> -->
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form method="post" action="{{ route('assign-company.store') }}" id="add_supplier_form"
                                enctype="multipart/form-data">
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
                                            <div class="form-group ">
                                                <label>Supplier *</label>
                                                <div class="input-group">
                                                    <select class="form-control   selectpicker " title="Select Supplier"
                                                        data-size="5" data-actions-box="true" data-live-search="true"
                                                        id="supplier" name="supplier_id">
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}">
                                                                {{ $supplier->supplier_title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <p class="text-danger"> {{ $errors->first('supplier_id') }}</p>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group ">
                                                <label>Company *</label>
                                                <div class="input-group">
                                                    <select class="form-control   selectpicker " title="Select Company"
                                                        data-size="5" data-actions-box="true" data-live-search="true"
                                                        id="company" name="company_id">

                                                    </select>
                                                </div>
                                                <p class="text-danger"> {{ $errors->first('company_id') }}</p>
                                                <div id="assigned-companies">
                                                </div>
                                            </div>

                                            <!--end::Input-->
                                        </div>

                                    </div>
                                    <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                                    <input type="hidden" name="created_by" value="{{ session('employee_id') }}">
                                    <button type="submit" id="btn-submit"
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
@endsection



{{-- Scripts Section --}}

@section('scripts')
    <script src="{{ asset('js/suppliers/form_validation.js') }}"></script>
    <script>
        let supplierID = $('#supplier').val();
        if (supplierID == '') {
            $.ajax({
                url: "{{ url('outlets/get-supplier-companies') }}?supplier_id=" + supplierID,
                type: "Get",
                success: function(res) {
                    //    for (let index = 0; index < res.length; index++) {
                    //        $('#assigned-companies').text(res[index].company_title)

                    //    }
                    $('#assigned-companies').html('Assigned companies <br>');
                    $.each(res, function(key, value) {
                        $('#assigned-companies').append(
                            '<p class="mb-0 mt-3 mx-1 badge badge-success">' + value.company_title +
                            '</p>')
                    });


                },
            });
            $.ajax({
                url: "{{ url('outlets/get-not-supplier-companies') }}?supplier_id=" + supplierID,
                type: "Get",
                success: function(res) {
                    //    for (let index = 0; index < res.length; index++) {
                    //        $('#assigned-companies').text(res[index].company_title)

                    //    }
                    $("#company").empty();
                    $("#company").selectpicker("refresh");
                    $.each(res, function(key, value) {
                        $("#company").append(
                            "<option value='" + value.id + "'>" + value.company_title + "</option>"
                        );
                        $("#company").selectpicker("refresh");
                    });


                },
            });
        }
        $("#supplier").on("change", function() {
            let supplierID = $('#supplier').val();

            $.ajax({
                url: "{{ url('outlets/get-supplier-companies') }}?supplier_id=" + supplierID,
                type: "Get",
                success: function(res) {
                    //    for (let index = 0; index < res.length; index++) {
                    //        $('#assigned-companies').text(res[index].company_title)

                    //    }
                    $('#assigned-companies').html('Assigned companies <br>');
                    $.each(res, function(key, value) {
                        $('#assigned-companies').append(
                            '<p class="mb-0 mt-3 mx-1 badge badge-success">' + value
                            .company_title + '</p>')
                    });


                },
            });
            $.ajax({
                url: "{{ url('outlets/get-not-supplier-companies') }}?supplier_id=" + supplierID,
                type: "Get",
                success: function(res) {
                    //    for (let index = 0; index < res.length; index++) {
                    //        $('#assigned-companies').text(res[index].company_title)

                    //    }
                    $("#company").empty();
                    $("#company").selectpicker("refresh");
                    $.each(res, function(key, value) {
                        $("#company").append(
                            "<option value='" + value.id + "'>" + value.company_title +
                            "</option>"
                        );
                        $("#company").selectpicker("refresh");
                    });


                },
            });
        });
    </script>

@endsection
