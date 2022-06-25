@extends('layout.default')
@section('title', 'Add Transaction')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/wizard/wizard-3.css?v=7.2.9') }}">
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
                            <div class="wizard wizard-3" id="kt_wizard_v3" data-wizard-state="first"
                                data-wizard-clickable="true">
                                <!--begin: Wizard Nav-->
                                <div class="wizard-nav">
                                    <div class="wizard-steps px-8 py-8 px-lg-15 py-lg-3">
                                        <!--begin::Wizard Step 1 Nav-->
                                        <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                                            <div class="wizard-label">
                                                <h3 class="wizard-title">
                                                    <span>1.</span>Header
                                                </h3>
                                                <div class="wizard-bar"></div>
                                            </div>
                                        </div>
                                        <!--end::Wizard Step 1 Nav-->
                                        <!--begin::Wizard Step 2 Nav-->
                                        <div class="wizard-step" data-wizard-type="step" data-wizard-state="pending">
                                            <div class="wizard-label">
                                                <h3 class="wizard-title">
                                                    <span>2.</span>Body
                                                </h3>
                                                <div class="wizard-bar"></div>
                                            </div>
                                        </div>
                                        <!--end::Wizard Step 2 Nav-->
                                        <!--begin::Wizard Step 3 Nav-->
                                        <div class="wizard-step" data-wizard-type="step" data-wizard-state="pending">
                                            <div class="wizard-label">
                                                <h3 class="wizard-title">
                                                    <span>3.</span>Footer
                                                </h3>
                                                <div class="wizard-bar"></div>
                                            </div>
                                        </div>
                                        <!--end::Wizard Step 3 Nav-->
                                    </div>
                                </div>
                                <!--end: Wizard Nav-->
                                <!--begin: Wizard Body-->
                                <div class="row justify-content-center py-10 px-8 py-lg-12 px-lg-10">
                                    <div class="col-xl-12 col-xxl-12">
                                        <!--begin: Wizard Form-->
                                        <form action="{{ route('invoice.invoice-data') }}" method="POST"
                                            class="form fv-plugins-bootstrap fv-plugins-framework" id="kt_form">
                                            @csrf
                                            <!--begin: Wizard Step 1-->
                                            <div class="pb-5" data-wizard-type="step-content"
                                                data-wizard-state="current">
                                                <div class="accordion accordion-toggle-arrow" id="accordionExample1">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div class="card-title" data-toggle="collapse"
                                                                data-target="#collapseOne1">
                                                                Header Templates
                                                            </div>
                                                        </div>
                                                        <div id="collapseOne1" class="collapse show"
                                                            data-parent="#accordionExample1">
                                                            <div class="card-body">
                                                                <ul class="row m-0 p-0 nav nav-pills nav-danger"
                                                                    role="tablist">
                                                                    @for ($i = 0; $i < 1; $i++)
                                                                        <!--begin::Item-->
                                                                        <li class="d-flex col-sm-2 mb-3">
                                                                            <a class="nav-link border py-4 d-flex flex-grow-1 rounded flex-column align-items-center text-dark-50 header_template {{ $i == 0 ? 'active' : '' }}"
                                                                                data-toggle="pill"
                                                                                id="header-v{{ $i + 1 }}" href="#">
                                                                                <img class="w-100"
                                                                                    src="https://i2.wp.com/www.cupcom.com.br/wp-content/uploads/2020/06/site-4-1.jpg?fit=1024%2C576&ssl=1">
                                                                                <span style="font-size: 1rem;"
                                                                                    class="nav-text font-size-lg py-2 font-weight-bold text-center">Header
                                                                                    v{{ $i + 1 }}</span>
                                                                            </a>
                                                                        </li>
                                                                        <!--end::Item-->
                                                                    @endfor
                                                                </ul>
                                                                <input type="hidden" value="header-v1"
                                                                    name="header_template">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4 class="mb-10 mt-10 font-weight-bold text-dark">Select Header Data</h4>
                                                <div class="form-group row">
                                                    @foreach ($invoice_std_headers as $invoice_std_header)
                                                        <div class="col-3 mb-4">
                                                            <label class="checkbox">
                                                                <input type="checkbox" value="{{ $invoice_std_header->id }}"
                                                                    checked name="header_data[]" />
                                                                <span class="mr-3"></span>
                                                                {{ ucwords(str_replace('_', ' ', $invoice_std_header->option)) }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <h4 class="mb-5 mt-10 font-weight-bold text-dark">Custom Data</h4>


                                                <div class="form-group row">
                                                    <div class="col-xl-4">
                                                        <input id="kt_tagify_1" class="form-control   tagify"
                                                            name="header_custom_fields" placeholder="Add Custom Fields">
                                                        <span class="form-text text-muted">Add values seperated with
                                                            commas</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end: Wizard Step 1-->
                                            <!--begin: Wizard Step 2-->
                                            <div class="pb-5" data-wizard-type="step-content">
                                                <div class="accordion accordion-toggle-arrow" id="accordionExample2">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div class="card-title" data-toggle="collapse"
                                                                data-target="#collapseOne2">
                                                                Body Templates
                                                            </div>
                                                        </div>
                                                        <div id="collapseOne2" class="collapse show"
                                                            data-parent="#accordionExample2">
                                                            <div class="card-body">
                                                                <ul class="row m-0 p-0 nav nav-pills nav-danger"
                                                                    role="tablist">
                                                                    @for ($i = 0; $i < 1; $i++)
                                                                        <!--begin::Item-->
                                                                        <li class="d-flex col-sm-2 mb-3">
                                                                            <a class="nav-link border py-4 d-flex flex-grow-1 rounded flex-column align-items-center text-dark-50 body_template {{ $i == 0 ? 'active' : '' }}"
                                                                                data-toggle="pill"
                                                                                id="body-v{{ $i + 1 }}" href="#">
                                                                                <img class="w-100"
                                                                                    src="https://i2.wp.com/www.cupcom.com.br/wp-content/uploads/2020/06/site-4-1.jpg?fit=1024%2C576&ssl=1">
                                                                                <span style="font-size: 1rem;"
                                                                                    class="nav-text font-size-lg py-2 font-weight-bold text-center">Body
                                                                                    v{{ $i + 1 }}</span>
                                                                            </a>
                                                                        </li>
                                                                        <!--end::Item-->
                                                                    @endfor
                                                                </ul>
                                                                <input type="hidden" value="body-v1" name="body_template">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4 class="mb-10 mt-10 font-weight-bold text-dark">Select Body columns</h4>
                                                <div class="form-group row">

                                                    @foreach ($invoice_std_body_headers as $invoice_std_body_header)
                                                        <div class="col-3 mb-4">
                                                            <label class="checkbox">
                                                                <input type="checkbox"
                                                                    value="{{ $invoice_std_body_header->id }}" checked
                                                                    name="body_header[]" />
                                                                <span class="mr-3"></span>
                                                                {{ ucwords(str_replace('_', ' ', $invoice_std_body_header->option)) }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                {{-- <h4 class="mb-5 mt-10 font-weight-bold text-dark">Custom Columns</h4>
                                                <div class="form-group row">
                                                    <div class="col-xl-4">
                                                        <input id="kt_tagify_2" class="form-control   tagify" name="body_header_custom_fields" placeholder="Add Custom Fields">
                                                        <span class="form-text text-muted">Add values seperated with commas</span>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <!--end: Wizard Step 2-->
                                            <!--begin: Wizard Step 3-->
                                            <div class="pb-5" data-wizard-type="step-content">
                                                <div class="accordion accordion-toggle-arrow" id="accordionExample3">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div class="card-title" data-toggle="collapse"
                                                                data-target="#collapseOne3">
                                                                Footer Templates
                                                            </div>
                                                        </div>
                                                        <div id="collapseOne3" class="collapse show"
                                                            data-parent="#accordionExample3">
                                                            <div class="card-body">
                                                                <ul class="row m-0 p-0 nav nav-pills nav-danger"
                                                                    role="tablist">
                                                                    @for ($i = 0; $i < 1; $i++)
                                                                        <!--begin::Item-->
                                                                        <li class="d-flex col-sm-2 mb-3">
                                                                            <a class="nav-link border py-4 d-flex flex-grow-1 rounded flex-column align-items-center text-dark-50 footer_template {{ $i == 0 ? 'active' : '' }}"
                                                                                data-toggle="pill"
                                                                                id="footer-v{{ $i + 1 }}" href="#">
                                                                                <img class="w-100"
                                                                                    src="https://i2.wp.com/www.cupcom.com.br/wp-content/uploads/2020/06/site-4-1.jpg?fit=1024%2C576&ssl=1">
                                                                                <span style="font-size: 1rem;"
                                                                                    class="nav-text font-size-lg py-2 font-weight-bold text-center">Footer
                                                                                    v{{ $i + 1 }}</span>
                                                                            </a>
                                                                        </li>
                                                                        <!--end::Item-->
                                                                    @endfor
                                                                </ul>
                                                                <input type="hidden" value="footer-v1"
                                                                    name="footer_template">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4 class="mb-10 mt-10 font-weight-bold text-dark">Select Footer Data</h4>
                                                <div class="form-group row">
                                                    @foreach ($invoice_std_footers as $invoice_std_footer)
                                                        <div class="col-3 mb-4">
                                                            <label class="checkbox">
                                                                <input type="checkbox"
                                                                    value="{{ $invoice_std_footer->id }}" checked
                                                                    name="footer_data[]" />
                                                                <span class="mr-3"></span>
                                                                {{ ucwords(str_replace('_', ' ', $invoice_std_footer->option)) }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <h4 class="mb-5 mt-10 font-weight-bold text-dark">Custom Footer Data</h4>


                                                <div class="form-group row">
                                                    <div class="col-xl-4">
                                                        <input id="kt_tagify_3" class="form-control   tagify"
                                                            name="footer_custom_fields" placeholder="Add Custom Fields">
                                                        <span class="form-text text-muted">Add values seperated with
                                                            commas</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end: Wizard Step 3-->

                                            <!--begin: Wizard Actions-->
                                            <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                                <div class="mr-2">
                                                    <button type="button"
                                                        class="btn btn-light-primary font-weight-bolder text-uppercase px-9 py-4"
                                                        data-wizard-type="action-prev">Previous</button>
                                                </div>
                                                <div>
                                                    <button type="submit"
                                                        class="btn btn-success font-weight-bolder text-uppercase px-9 py-4"
                                                        data-wizard-type="action-submit">Submit</button>
                                                    <button type="button"
                                                        class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4"
                                                        data-wizard-type="action-next">Next</button>
                                                </div>
                                            </div>
                                            <!--end: Wizard Actions-->
                                        </form>
                                        <!--end: Wizard Form-->
                                    </div>
                                </div>
                                <!--end: Wizard Body-->
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
@endsection
{{-- Scripts Section --}}

@section('scripts')
    <script src="{{ asset('js/pages/custom/wizard/wizard-3.js?v=7.2.9') }}"></script>
    <script src="{{ asset('js/pages/crud/forms/widgets/tagify.js') }}"></script>

    <script>
        $('.header_template').click(function() {
            $('input[name="header_template"]').val($(this).attr('id'));
        })
    </script>
    <script>
        $('.body_template').click(function() {
            $('input[name="body_template"]').val($(this).attr('id'));
        })
    </script>
    <script>
        $('.footer_template').click(function() {
            $('input[name="footer_template"]').val($(this).attr('id'));
        })
    </script>
@endsection
