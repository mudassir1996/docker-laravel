@extends('layout.default-outlets')
@section('title', 'Add Outlet')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/wizard/wizard-2.css') }}">
    <style>
        input {
            height: 30px !important;
        }

        .bootstrap-select .dropdown-menu.inner>li>a {
            padding: 0.4rem;
        }

        .bootstrap-select>.dropdown-toggle.btn-light,
        .bootstrap-select>.dropdown-toggle.btn-secondary {
            padding: 0.3rem 0.4rem !important;
        }

        .wizard-step {
            cursor: pointer;
        }

    </style>
@endsection
@section('content')

    <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
        <!--begin::Subheader-->
        {{-- <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->
                        <a href="/outlets">
                            <h5 class="text-dark text-hover-primary font-weight-bold my-1 mr-5">Outlet</h5>
                        </a>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="#" class="text-muted">Add Outlet</a>
                            </li>
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->

            </div>
        </div> --}}
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Teachers-->
                <div class="d-flex flex-row">
                    <!--begin::Content-->
                    <div class="flex-row-fluid ml-lg-8">
                        <!--begin::Card-->
                        <div class="card card-custom">
                            <div class="card-body p-0">
                                <!--begin: Wizard-->
                                <div class="wizard wizard-2" id="kt_wizard_v2" data-wizard-state="first"
                                    data-wizard-clickable="false">
                                    <!--begin: Wizard Nav-->
                                    @include('pages.outlet.wizard.nav')
                                    <!--end: Wizard Nav-->
                                    <!--begin: Wizard Body-->
                                    <div class="wizard-body px-8 py-2 py-lg-10">
                                        <!--begin: Wizard Form-->
                                        <div class="row">
                                            <div class="col-xxl-12">
                                                <form class="form fv-plugins-bootstrap fv-plugins-framework"
                                                    action="{{ route('outlets.store') }}" id="kt_form" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <!--begin: Wizard Step 1-->
                                                    @include(
                                                        'pages.outlet.wizard.steps.step_1'
                                                    )
                                                    <!--end: Wizard Step 1-->
                                                    <!--begin: Wizard Step 2-->
                                                    @include(
                                                        'pages.outlet.wizard.steps.step_2'
                                                    )
                                                    <!--end: Wizard Step 2-->
                                                    <!--begin: Wizard Step 3-->
                                                    @include(
                                                        'pages.outlet.wizard.steps.step_3'
                                                    )
                                                    <!--end: Wizard Step 3-->
                                                    <!--begin: Wizard Step 4-->
                                                    @include(
                                                        'pages.outlet.wizard.steps.step_4'
                                                    )
                                                    <!--end: Wizard Step 4-->
                                                    <!--begin: Wizard Step 5-->
                                                    {{-- @include('pages.outlet.wizard.steps.step_5') --}}
                                                    <!--end: Wizard Step 5-->
                                                    <!--begin: Wizard Actions-->
                                                    @include(
                                                        'pages.outlet.wizard._offcanvas.import_categories'
                                                    )
                                                    @include(
                                                        'pages.outlet.wizard._offcanvas.import_products'
                                                    )
                                                    @include(
                                                        'pages.outlet.wizard._offcanvas.import_companies'
                                                    )
                                                    @include(
                                                        'pages.outlet.wizard._offcanvas.import_expenses'
                                                    )
                                                    @include(
                                                        'pages.outlet.wizard._offcanvas.import_payment_types'
                                                    )
                                                    @include(
                                                        'pages.outlet.wizard._offcanvas.import_payment_methods'
                                                    )
                                                    <div class="d-flex justify-content-between border-top pt-5">
                                                        <div class="mr-2">
                                                            <button type="button"
                                                                class="btn btn-light-danger font-weight-bolder text-uppercase px-9 py-4"
                                                                data-wizard-type="action-prev">Previous</button>
                                                        </div>
                                                        <div>
                                                            <button
                                                                class="btn btn-success font-weight-bolder text-uppercase px-9 py-4"
                                                                data-wizard-type="action-submit">Submit</button>
                                                            {{-- <button type="button"
                                                                class="btn btn-light-primary font-weight-bolder text-uppercase px-9 py-4 skip"
                                                                data-wizard-type="action-skip">Skip</button> --}}
                                                            <button type="button"
                                                                class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4 btn-next"
                                                                data-wizard-type="action-next">Next</button>
                                                        </div>
                                                    </div>
                                                    <!--end: Wizard Actions-->
                                                </form>
                                            </div>
                                            <!--end: Wizard-->
                                        </div>
                                        <!--end: Wizard Form-->
                                    </div>
                                    <!--end: Wizard Body-->
                                </div>
                                <!--end: Wizard-->
                            </div>
                            {{-- <div class="card-header flex-wrap py-5">
                                <div class="card-title">
                                    <h3 class="card-label">Add Outlet
                                        <!-- <span class="d-block text-muted pt-2 font-size-sm">Manage Accounts</span> -->
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <!--begin::Form-->
                                <form method="post" action="{{ route('outlets.store') }}" id="add_outlet_form"
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
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <circle fill="#000000" opacity="0.3" cx="12" cy="12"
                                                                    r="10" />
                                                                <rect fill="#000000" x="11" y="10" width="2" height="7"
                                                                    rx="1" />
                                                                <rect fill="#000000" x="11" y="7" width="2" height="2"
                                                                    rx="1" />
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
                                                    <label>Outlet Title *</label>
                                                    <input type="text"
                                                        class="form-control     {{ $errors->first('outlet_title') ? 'is-invalid' : '' }}"
                                                        value="{{ old('outlet_title') }}" name="outlet_title"
                                                        placeholder="Outlet Title"  id="outlet_title"/>
                                                    <p class="text-danger"> {{ $errors->first('outlet_title') }}</p>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Slogan</label>
                                                    <input type="text" class="form-control   "
                                                        value="{{ old('outlet_slogan') }}" name="outlet_slogan"
                                                        placeholder="Slogan" />
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Phone *</label>
                                                    <input type="text"
                                                        class="form-control    {{ $errors->first('outlet_phone') ? 'is-invalid' : '' }}"
                                                        value="{{ old('outlet_phone') }}" name="outlet_phone"
                                                        placeholder="Outlet Phone" id="outlet_phone"/>
                                                    <p class="text-danger"> {{ $errors->first('outlet_phone') }}</p>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Alternate Phone</label>
                                                    <input type="text" class="form-control   "
                                                        value="{{ old('outlet_alt_phone') }}" name="outlet_alt_phone"
                                                        placeholder="Alternate Phone" />
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control   "
                                                        value="{{ old('outlet_email') }}" name="outlet_email"
                                                        placeholder="Outlet Email" />
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" class="form-control   "
                                                        value="{{ old('outlet_address') }}" name="outlet_address"
                                                        placeholder="Outlet Address" />
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                        </div>

                                        <div class="form-group row">


                                            <div class="col-xl-4">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Country *</label>
                                                    <select class="form-control    selectpicker"
                                                        data-live-search="true" data-size="5" id="country"
                                                        name="outlet_country">
                                                        <option value="">Select country</option>
                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country->id }}"
                                                                {{ old('outlet_country') == $country->id ? 'selected' : '' }}>
                                                                {{ $country->country_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger"> {{ $errors->first('outlet_country') }}</p>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-4">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>State *</label>
                                                    <select class="form-control    selectpicker"
                                                        data-live-search="true" data-size="5" id="state"
                                                        name="outlet_state">
                                                        <option value="">Select country first</option>
                                                    </select>
                                                    <p class="text-danger"> {{ $errors->first('outlet_state') }}</p>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-4">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>City *</label>
                                                    <select class="form-control    selectpicker"
                                                        data-live-search="true" data-size="5" id="city" name="outlet_city">
                                                        <option value="">Select state first</option>
                                                    </select>
                                                    <p class="text-danger"> {{ $errors->first('outlet_city') }}</p>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <!--begin::Input-->
                                                    <label>Business Type *</label>
                                                    <select
                                                        class="form-control selectpicker {{ $errors->first('business_type_id') ? 'is-invalid' : '' }}"
                                                        title="Select Business" data-size="5" data-live-search="true"
                                                        name="business_type_id">
                                                        @foreach ($businesses as $business)
                                                            <option value="{{ $business->id }}"
                                                                {{ old('business_type_id') == $business->id ? 'selected' : '' }}>
                                                                {{ $business->business_title }}</option>
                                                        @endforeach
                                                    </select>
                                                    <!--end::Input-->
                                                    <p class="text-danger"> {{ $errors->first('business_type_id') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label
                                                        class="">Opening Date</label>
                                                <input type="
                                                        text" class="form-control  " id="kt_datepicker_outlet"
                                                        value="{{ old('outlet_opening_date') }}"
                                                        name="outlet_opening_date" readonly placeholder="Select date" />
                                                </div>
                                            </div>


                                        </div>

                                        <div class="form-group row">
                                            <div class="col-xl-12">
                                                <div class="form-group">
                                                    <label for="exampleTextarea">Description</label>
                                                    <textarea class="form-control   " id="exampleTextarea"
                                                        name="outlet_description"
                                                        rows="5">{{ old('outlet_description') }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mb-0">
                                            <div class="image-input image-input-outline" id="kt_image_1">

                                                <div class="image-input-wrapper"
                                                    style="background-image: url({{ asset('storage/placeholder.jpg') }})">
                                                </div>

                                                <label
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="change" data-toggle="tooltip" title=""
                                                    data-original-title="Change avatar">
                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                    <input type="file" name="outlet_feature_img" accept=".jpg,.png" />
                                                    
                                                </label>

                                                <span
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>
                                            </div>
                                            <span class="form-text">Outlet Logo</span>
                                            @error('outlet_feature_img')
                                                {{ $message }}
                                            @enderror
                                        </div>


                                        <input type="hidden" name="registration_details_id" value="1">
                                        <input type="hidden" name="location_point_id" value="1">
                                        <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-shadow px-12 mt-8" id="btn-submit">Submit</button>
                                        </div>
                                    </div>

                                </form>
                                <!--end::Form-->
                            </div> --}}
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
    </div>
@endsection
{{-- Scripts Section --}}

@section('scripts')
    <script src="{{ asset('js/outlets/wizard.js') }}"></script>
    @include('pages.outlet.wizard.location')
    <script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/custom/seeder.js') }}"></script>
    <script src="{{ asset('js/outlets/wizard/imports.js') }}"></script>
    <script src="{{ asset('js/outlets/wizard/search.js') }}"></script>
    <script src="{{ asset('js/outlets/wizard/select-items.js') }}"></script>
    <script src="{{ asset('js/outlets/wizard/add_outlet.js') }}"></script>

@endsection
