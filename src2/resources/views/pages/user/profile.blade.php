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

                        <h5 class="text-dark font-weight-bold my-1 mr-5">User</h5>

                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="#" class="text-muted">Edit Profile</a>
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
                                <form method="post" action="{{ route('users.update', $user_detail->id) }}"
                                    id="edit_profile_form" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
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
                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10">
                                                                </circle>
                                                                <rect fill="#000000" x="11" y="10" width="2" height="7"
                                                                    rx="1"></rect>
                                                                <rect fill="#000000" x="11" y="7" width="2" height="2"
                                                                    rx="1"></rect>
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
                                                    <label>Email<span
                                                            class="ml-2 text-muted font-size-sm">(readonly)</span></label>
                                                    <input type="text" class="form-control   "
                                                        value="{{ Auth::user()->email }}" readonly />
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Username<span
                                                            class="ml-2 text-muted font-size-sm">(readonly)</span></label>
                                                    <input type="text" class="form-control  "
                                                        value="{{ Auth::user()->username }}" readonly />
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control   " name="first_name"
                                                        value="{{ $user_detail->first_name }}" placeholder="First Name" />
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control   " name="last_name"
                                                        value="{{ $user_detail->last_name }}" placeholder="Last Name" />
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input type="text" class="form-control   " name="phone"
                                                        value="{{ $user_detail->phone }}" placeholder="Phone Number" />
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>CNIC</label>
                                                    <input type="text" class="form-control   " name="cnic"
                                                        value="{{ $user_detail->cnic }}" placeholder="CNIC Number" />
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-xl-4">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <select class="form-control   " id="country" name="country_id">
                                                        <option value="">Select country</option>
                                                        @php
                                                            $country_id = '';
                                                        @endphp
                                                        @foreach ($countries as $country)
                                                            @if ($user_detail->country_id == $country->id)
                                                                @php
                                                                    $country_id = $country->id;
                                                                @endphp
                                                            @endif
                                                            <option value="{{ $country->id }}"
                                                                {{ $user_detail->country_id == $country->id ? 'selected' : '' }}>
                                                                {{ $country->country_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-4">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <select class="form-control   " id="state" name="state_id">
                                                        <option value="">Select State</option>
                                                        @php
                                                            $state_id = '';
                                                            $states = Illuminate\Support\Facades\DB::table('states')
                                                                ->where('country_id', $country_id)
                                                                ->get();
                                                        @endphp
                                                        @foreach ($states as $state)
                                                            @if ($user_detail->state_id == $state->id)
                                                                @php
                                                                    $state_id = $state->id;
                                                                @endphp
                                                            @endif
                                                            <option value="{{ $state->id }}"
                                                                {{ $user_detail->state_id == $state->id ? 'selected' : '' }}>
                                                                {{ $state->state_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-4">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <select class="form-control   " id="city" name="city_id">
                                                        <option value="">Select City</option>
                                                        @php
                                                            $cities = Illuminate\Support\Facades\DB::table('cities')
                                                                ->where('state_id', $state_id)
                                                                ->get();
                                                        @endphp
                                                        @foreach ($cities as $city)
                                                            <option value="{{ $city->id }}"
                                                                {{ $user_detail->city_id == $city->id ? 'selected' : '' }}>
                                                                {{ $city->city_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control  " value="{{ $user_detail->address }}"
                                                name="address" placeholder="Address" />
                                        </div>

                                        <div class="form-group mb-0">
                                            <div class="image-input image-input-outline" id="kt_image_1">
                                                @php
                                                    if ($user_detail->profile_img != '') {
                                                        $image = Storage::disk('public')->exists('users/' . $user_detail->profile_img) ? asset('storage/users/' . $user_detail->profile_img) : asset('storage/placeholder.jpg');
                                                    } else {
                                                        $image = asset('storage/placeholder.jpg');
                                                    }
                                                @endphp

                                                {{-- {{$user_detail->profile_img}} --}}
                                                <div class="image-input-wrapper"
                                                    style="background-image: url('{{ $image }}')"></div>

                                                <label
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="change" data-toggle="tooltip" title=""
                                                    data-original-title="Change avatar">
                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                    <input type="file" name="profile_img" accept=".jpg,.png" />
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
