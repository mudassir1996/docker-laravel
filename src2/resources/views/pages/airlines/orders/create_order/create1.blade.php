@extends('layout.default')
@section('title', 'Add Outlet Discount')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/wizard/wizard-1.css?v=7.2.9') }}">
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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Outlet Discount</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('outlet-discounts.index') }}" class="text-muted">All Discounts</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Add Discount</a>
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
                    <div class="card card-custom">
                        <div class="card-body p-0">
                            <!--begin::Wizard-->
                            <div class="wizard wizard-1" id="kt_wizard" data-wizard-state="first"
                                data-wizard-clickable="false">
                                <!--begin::Wizard Nav-->
                                <div class="wizard-nav border-bottom">
                                    <div class="wizard-steps p-3 p-lg-5">
                                        <!--begin::Wizard Step 1 Nav-->
                                        <div class="wizard-step" id="wizard-step-1" data-wizard-type="step"
                                            data-wizard-state="current">
                                            <div class="wizard-label">
                                                {{-- <i class="wizard-icon flaticon-bus-stop"></i> --}}
                                                <h3 class="wizard-title">1. Setup Location</h3>
                                            </div>
                                            <span class="svg-icon svg-icon-xl wizard-arrow">
                                                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                    viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                        <rect fill="#000000" opacity="0.3"
                                                            transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                                            x="11" y="5" width="2" height="14" rx="1"></rect>
                                                        <path
                                                            d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                            fill="#000000" fill-rule="nonzero"
                                                            transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)">
                                                        </path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </div>
                                        <!--end::Wizard Step 1 Nav-->
                                        <!--begin::Wizard Step 2 Nav-->
                                        <div class="wizard-step" id="wizard-step-2" data-wizard-type="step"
                                            data-wizard-state="pending">
                                            <div class="wizard-label">
                                                {{-- <i class="wizard-icon flaticon-list"></i> --}}
                                                <h3 class="wizard-title">2. Enter Details</h3>
                                            </div>
                                            <span class="svg-icon svg-icon-xl wizard-arrow">
                                                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                    viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                        <rect fill="#000000" opacity="0.3"
                                                            transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                                            x="11" y="5" width="2" height="14" rx="1"></rect>
                                                        <path
                                                            d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                            fill="#000000" fill-rule="nonzero"
                                                            transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)">
                                                        </path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </div>
                                        <!--end::Wizard Step 2 Nav-->
                                    </div>
                                </div>
                                <!--end::Wizard Nav-->
                                <!--begin::Wizard Body-->
                                <div class="row justify-content-center my-10 px-8 my-lg-15 px-lg-10">
                                    <div class="col-xl-12 col-xxl-7">
                                        <!--begin::Wizard Form-->
                                        <form class="form fv-plugins-bootstrap fv-plugins-framework" id="kt_form">
                                            <!--begin::Wizard Step 1-->
                                            <div class="pb-5" data-wizard-type="step-content"
                                                data-wizard-state="current">
                                                <h3 class="mb-10 font-weight-bold text-dark">Setup Your Current Location
                                                </h3>
                                                <!--begin::Input-->
                                                <div class="form-group fv-plugins-icon-container">
                                                    <label>Address Line 1</label>
                                                    <input type="text" class="form-control form-control-solid  "
                                                        name="address1" placeholder="Address Line 1" value="Address Line 1">
                                                    <span class="form-text text-muted">Please enter your Address.</span>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Input-->
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Address Line 2</label>
                                                    <input type="text" class="form-control form-control-solid  "
                                                        name="address2" placeholder="Address Line 2" value="Address Line 2">
                                                    <span class="form-text text-muted">Please enter your Address.</span>
                                                </div>
                                                <!--end::Input-->
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <!--begin::Input-->
                                                        <div class="form-group fv-plugins-icon-container">
                                                            <label>Postcode</label>
                                                            <input type="text" class="form-control form-control-solid  "
                                                                name="postcode" placeholder="Postcode" value="3000">
                                                            <span class="form-text text-muted">Please enter your
                                                                Postcode.</span>
                                                            <div class="fv-plugins-message-container"></div>
                                                        </div>
                                                        <!--end::Input-->
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <!--begin::Input-->
                                                        <div class="form-group fv-plugins-icon-container">
                                                            <label>City</label>
                                                            <input type="text" class="form-control form-control-solid  "
                                                                name="city" placeholder="City" value="Melbourne">
                                                            <span class="form-text text-muted">Please enter your
                                                                City.</span>
                                                            <div class="fv-plugins-message-container"></div>
                                                        </div>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <!--begin::Input-->
                                                        <div class="form-group fv-plugins-icon-container">
                                                            <label>State</label>
                                                            <input type="text" class="form-control form-control-solid  "
                                                                name="state" placeholder="State" value="VIC">
                                                            <span class="form-text text-muted">Please enter your
                                                                State.</span>
                                                            <div class="fv-plugins-message-container"></div>
                                                        </div>
                                                        <!--end::Input-->
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <!--begin::Select-->
                                                        <div class="form-group fv-plugins-icon-container">
                                                            <label>Country</label>
                                                            <select name="country"
                                                                class="form-control form-control-solid  ">

                                                            </select>
                                                            <div class="fv-plugins-message-container"></div>
                                                        </div>
                                                        <!--end::Select-->
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Wizard Step 1-->
                                            <!--begin::Wizard Step 2-->
                                            <div class="pb-5" data-wizard-type="step-content">
                                                <h4 class="mb-10 font-weight-bold text-dark">Enter the Details of your
                                                    Delivery</h4>
                                                <!--begin::Input-->
                                                <div class="form-group fv-plugins-icon-container">
                                                    <label>Package Details</label>
                                                    <input type="text" class="form-control form-control-solid  "
                                                        name="package" placeholder="Package Details"
                                                        value="Complete Workstation (Monitor, Computer, Keyboard &amp; Mouse)">
                                                    <span class="form-text text-muted">Please enter your Pakcage
                                                        Details.</span>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Input-->
                                                <!--begin::Input-->
                                                <div class="form-group fv-plugins-icon-container">
                                                    <label>Package Weight in KG</label>
                                                    <input type="text" class="form-control form-control-solid  "
                                                        name="weight" placeholder="Package Weight" value="25">
                                                    <span class="form-text text-muted">Please enter your Package Weight in
                                                        KG.</span>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Input-->
                                                <div class="row">
                                                    <div class="col-xl-4">
                                                        <!--begin::Input-->
                                                        <div class="form-group fv-plugins-icon-container">
                                                            <label>Package Width in CM</label>
                                                            <input type="text" class="form-control form-control-solid  "
                                                                name="width" placeholder="Package Width" value="110">
                                                            <span class="form-text text-muted">Please enter your Package
                                                                Width in CM.</span>
                                                            <div class="fv-plugins-message-container"></div>
                                                        </div>
                                                        <!--end::Input-->
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <!--begin::Input-->
                                                        <div class="form-group fv-plugins-icon-container">
                                                            <label>Package Height in CM</label>
                                                            <input type="text" class="form-control form-control-solid  "
                                                                name="height" placeholder="Package Height" value="90">
                                                            <span class="form-text text-muted">Please enter your Package
                                                                Height in CM.</span>
                                                            <div class="fv-plugins-message-container"></div>
                                                        </div>
                                                        <!--end::Input-->
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <!--begin::Input-->
                                                        <div class="form-group fv-plugins-icon-container">
                                                            <label>Package Length in CM</label>
                                                            <input type="text" class="form-control form-control-solid  "
                                                                name="packagelength" placeholder="Package Length"
                                                                value="150">
                                                            <span class="form-text text-muted">Please enter your Package
                                                                Length in CM.</span>
                                                            <div class="fv-plugins-message-container"></div>
                                                        </div>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Wizard Step 2-->
                                            <!--begin::Wizard Actions-->
                                            <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                                <div class="mr-2">
                                                    <button type="button"
                                                        class="btn btn-light-primary font-weight-bolder text-uppercase px-9 py-4 prevoius"
                                                        data-wizard-type="action-prev">Previous</button>
                                                </div>
                                                <div>
                                                    <button type="button"
                                                        class="btn btn-success font-weight-bolder text-uppercase px-9 py-4"
                                                        data-wizard-type="action-submit">Submit</button>
                                                    <button type="button"
                                                        class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4 next"
                                                        data-wizard-type="action-next">Next</button>
                                                </div>
                                            </div>
                                            <!--end::Wizard Actions-->
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </form>
                                        <!--end::Wizard Form-->
                                    </div>
                                </div>
                                <!--end::Wizard Body-->
                            </div>
                            <!--end::Wizard-->
                        </div>
                        <!--end::Wizard-->
                    </div>
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
    <script src="{{ asset('js/pages/custom/wizard/wizard-1.js') }}"></script>
    <script>
        //  console.log($('.next'));
        document.addEventListener("keydown", function(event) {
            if (event.ctrlKey && event.key === 'ArrowLeft') {
                $('.prevoius').click();

            }
            if (event.ctrlKey && event.key === 'ArrowRight') {
                $('.next').click();

            }
        });
    </script>
    {{-- <script src="{{asset('js/pages/crud/forms/widgets/select2.js?v=7.2.9')}}"></script> --}}
@endsection
