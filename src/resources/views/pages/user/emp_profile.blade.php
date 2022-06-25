@extends('layout.default-outlets')
@section('title', 'Edit Profile')
@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap ml-5">
                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->

                        <h5 class="text-dark font-weight-bold my-1 mr-5">Employee</h5>

                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="" class="text-muted">Edit Profile</a>
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
            <div class="container">
                <!--begin::Teachers-->
                <div class="d-flex flex-row">
                    <!--begin::Content-->
                    <div class="flex-row-fluid ml-lg-8">
                        <!--begin::Card-->
                        <div class="card card-custom">
                            <div class="card-header flex-wrap py-5">
                                <div class="card-title">
                                    <h3 class="card-label">Edit Profile
                                        <!-- <span class="d-block text-muted pt-2 font-size-sm">Manage Accounts</span> -->
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <!--begin::Form-->
                                <form method="post" action="{{ route('update-employee', $user_detail->id) }}"
                                    id="edit_profile_form" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
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
                                                <div class="alert-text">The example form below demonstrates common HTML
                                                    form elements that receive updated styles from Bootstrap with additional
                                                    classes.</div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Email<span
                                                            class="ml-2 text-muted font-size-sm">(readonly)</span></label>
                                                    <input type="text" class="form-control   "
                                                        value="{{ $user_detail->email }}" readonly />
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Name<span
                                                            class="ml-2 text-muted font-size-sm">(readonly)</span></label>
                                                    <input type="text" class="form-control  "
                                                        value="{{ $user_detail->employee_name }}" readonly />
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input type="text" class="form-control   " name="employee_phone"
                                                        value="{{ $user_detail->employee_phone }}"
                                                        placeholder="Phone Number" />
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" class="form-control  "
                                                        value="{{ $user_detail->employee_address }}" name="employee_address"
                                                        placeholder="Address" />
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
                                                    <input type="file" name="profile_img" />
                                                    {{-- <input type="hidden" name="profile_avatar_remove"/> --}}
                                                </label>

                                                <span
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>
                                            </div>
                                            <span class="form-text">Profile Image</span>
                                            @error('profile_img')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button type="submit"
                                                class="btn btn-primary btn-shadow px-12 mt-8">Submit</button>
                                        </div>
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
    <script>
        $('#country').change(function() {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    url: "{{ url('get-state') }}?country_id=" + countryID,
                    type: "Get",
                    success: function(res) {
                        if (res) {
                            $("#state").empty();
                            $("#state").append('<option value="">Select State</option>');
                            $("#city").empty();
                            $("#city").append('<option value="">Select City</option>');
                            $.each(res, function(key, value) {
                                $("#state").append('<option value="' + value + '">' + key +
                                    '</option>');
                            });

                        } else {
                            $("#state").empty();
                            $("#state").append('<option value="">Select country first</option>');
                            $("#city").empty();
                            $("#city").append('<option value="">Select State first</option>');
                        }
                    }
                });
            } else {
                $("#state").empty();
                $("#state").append('<option value="">Select country first</option>');
                $("#city").empty();
                $("#city").append('<option value="">Select State first</option>');
            }
        });
        $('#state').change(function() {
            var stateID = $(this).val();
            if (stateID) {
                $.ajax({
                    url: "{{ url('get-city') }}?state_id=" + stateID,
                    type: "Get",
                    success: function(res) {
                        if (res) {
                            $("#city").empty();
                            $("#city").append('<option value="">Select City</option>');
                            $.each(res, function(key, value) {
                                $("#city").append('<option value="' + value + '">' + key +
                                    '</option>');
                            });

                        } else {
                            $("#city").empty();
                            $("#city").append('<option value="">Select State first</option>');
                        }
                    }
                });
            } else {
                $("#city").empty();
                $("#city").append('<option value="">Select State first</option>');
            }
        });
    </script>
    <script src="{{ asset('js/profile/form_validation.js') }}"></script>
    <script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>
    <script>
        var avatar1 = new KTImageInput('kt_image_1');
    </script>


@endsection
