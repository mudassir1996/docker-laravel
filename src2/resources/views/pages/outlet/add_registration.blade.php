@extends('layout.default')
@section('title', 'Add Registration')
@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
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
                                <a href="" class="text-muted">Add Registration Details</a>
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
            <div class="container-fluid">
                <!--begin::Teachers-->
                <div class="d-flex flex-row">
                    <!--begin::Content-->
                    <div class="flex-row-fluid ml-lg-8">
                        <!--begin::Card-->
                        <div class="card card-custom">
                            <div class="card-header flex-wrap py-5">
                                <div class="card-title">
                                    <h3 class="card-label">Add Registration
                                        <!-- <span class="d-block text-muted pt-2 font-size-sm">Manage Accounts</span> -->
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <!--begin::Form-->
                                <form method="post" action="{{ route('registration.store') }}"
                                    id="add_outlet_registration" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group mb-8">
                                            <div class="alert alert-custom alert-default" role="alert">
                                                <div class="alert-icon">
                                                    <span class="svg-icon svg-icon-primary svg-icon-xl">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Tools/Compass.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path
                                                                    d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z"
                                                                    fill="#000000" opacity="0.3" />
                                                                <path
                                                                    d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z"
                                                                    fill="#000000" fill-rule="nonzero" />
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
                                            <div class="col-xl-4">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Registered Name *</label>
                                                    <input type="text"
                                                        class="form-control    {{ $errors->first('registered_name') ? 'is-invalid' : '' }}"
                                                        value="{{ old('registered_name') }}" name="registered_name"
                                                        placeholder="Registered Name" />
                                                    <p class="text-danger"> {{ $errors->first('registered_name') }}</p>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-4">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Registered Address *</label>
                                                    <input type="text"
                                                        class="form-control    {{ $errors->first('registered_address') ? 'is-invalid' : '' }}"
                                                        value="{{ old('registered_address') }}" name="registered_address"
                                                        placeholder="Registered Address" />
                                                    <p class="text-danger"> {{ $errors->first('registered_address') }}
                                                    </p>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="form-group">
                                                    <label class="">Registration Date *</label>
                                                    <input type="text"
                                                        class="form-control   {{ $errors->first('registration_date') ? 'is-invalid' : '' }}"
                                                        value="{{ old('registration_date') }}" id="kt_datepicker_3"
                                                        name="registration_date" readonly
                                                        placeholder="Select Registration date" />
                                                    <p class="text-danger"> {{ $errors->first('registration_date') }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-xl-12">
                                                <div class="form-group">
                                                    <label for="exampleTextarea">Description</label>
                                                    <textarea class="form-control   " id="exampleTextarea"
                                                        name="description" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="status" value="unverified">
                                        <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                                        <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                                        <button type="submit" class="btn btn-primary btn-shadow px-12 mt-8">Submit</button>
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
    </div>
@endsection
{{-- Scripts Section --}}

@section('scripts')
    <script src="{{ asset('js/outlets/registration/form_validation.js') }}"></script>
    <script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/products/picture_preview.js') }}"></script>
@endsection
