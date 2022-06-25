@extends('layout.default')
@section('title', 'Add Employee')
@section('content')

    @php
    $premium = DB::table('subscriptions')
        ->where('outlet_id', session('outlet_id'))
        ->where('subscription_status', 'verified')
        ->whereDate('subscription_start_date', '<=', Carbon\Carbon::today()->format('Y-m-d h:i:s'))
        ->whereDate('subscription_end_date', '>=', Carbon\Carbon::today()->format('Y-m-d h:i:s'))
        ->first();
    @endphp

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Employee</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('employees.index') }}" class="text-muted">All Employees</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Add Employee</a>
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
                                <h3 class="card-label">Add Employee
                                    <!-- <span class="d-block text-muted pt-2 font-size-sm">Manage Customers</span> -->
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form method="post" action="{{ route('employees.store') }}" id="add_employee_form"
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
                                            <div class="form-group">
                                                <label>Employee Name*</label>
                                                <input type="text" id="employee_name"
                                                    class="form-control {{ $errors->first('employee_name') ? 'is-invalid' : '' }}"
                                                    value="{{ old('employee_name') }}" name="employee_name"
                                                    placeholder="Employee Name" />
                                                <p class="text-danger"> {{ $errors->first('employee_name') }}</p>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Phone *</label>
                                                <input type="text" class="form-control   "
                                                    value="{{ old('employee_phone') }}" name="employee_phone"
                                                    placeholder="Phone" />

                                            </div>
                                            <!--end::Input-->
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Employee Email</label>
                                                <input type="text" class="form-control   "
                                                    value="{{ old('employee_email') }}" name="employee_email"
                                                    placeholder="Employee Email" />
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control   "
                                                    value="{{ old('employee_address') }}" name="employee_address"
                                                    placeholder="Employee Address" />

                                            </div>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Date of Birth</label>
                                                <input type="text" class="form-control   " id="kt_datepicker_3" readonly
                                                    name="employee_dob" value="{{ old('employee_dob') }}"
                                                    placeholder="Employee Date of Birth" />
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>CNIC</label>
                                                <input type="text" class="form-control   "
                                                    value="{{ old('employee_cnic') }}" name="employee_cnic"
                                                    placeholder="Employee CNIC" />

                                            </div>
                                            <!--end::Input-->
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <!--begin::Input-->
                                                <label for="gender">Gender *</label>
                                                <select class="form-control   " id="gender" name="employee_gender">
                                                    <option value="">Select Gender</option>
                                                    <option value="male"
                                                        {{ old('employee_gender') == 'male' ? 'selected' : '' }}>Male
                                                    </option>
                                                    <option value="female"
                                                        {{ old('employee_gender') == 'female' ? 'selected' : '' }}>Female
                                                    </option>
                                                </select>
                                                <p class="text-danger"> {{ $errors->first('employee_gender') }}</p>
                                                <!--end::Input-->
                                            </div>
                                            @if ($premium)
                                                <a href="javascript:void(0)" class="btn btn-dark px-3 btn-sm"
                                                    id="salary-btn">{{ old('have_salary') == 1 ? 'Cancel' : 'Add Salary' }}</a>
                                            @endif
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <!--begin::Input-->
                                                <label for="status">Status</label>
                                                <select class="form-control   " id="status" name="employee_status">
                                                    <option value="active"
                                                        {{ old('employee_status') == 'active' ? 'selected' : '' }}>Active
                                                    </option>
                                                    <option value="inactive"
                                                        {{ old('employee_status') == 'inactive' ? 'selected' : '' }}>
                                                        Inactive
                                                    </option>
                                                </select>
                                                <!--end::Input-->
                                            </div>

                                        </div>
                                    </div>
                                    @if ($premium)
                                        <hr>
                                    @endif


                                    @if ($premium)
                                        <div id="salary"
                                            style="display:{{ old('have_salary') == 1 ? 'block' : 'none' }}">
                                            <div class="form-group row">
                                                <div class="col-xl-6">
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <label>Salary Type</label>
                                                        <select class="form-control    selectpicker" data-live-search="true"
                                                            data-size="5" name="salary_type_id" title="Select Salary Type">
                                                            {{-- <option value="">Select Payment Type</option> --}}
                                                            @foreach ($salary_types as $salary_type)
                                                                <option value="{{ $salary_type->id }}"
                                                                    {{ old('salary_type_id') == $salary_type->id ? 'selected' : '' }}>
                                                                    {{ $salary_type->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        <p class="text-danger"> {{ $errors->first('salary_type_id') }}
                                                        </p>

                                                    </div>
                                                    <!--end::Input-->
                                                </div>

                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Salary Amount</label>
                                                        <input type="text" class="form-control  "
                                                            value="{{ old('salary_amount') }}" name="salary_amount"
                                                            placeholder="Employee Salary" />
                                                        <p class="text-danger"> {{ $errors->first('salary_amount') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-xl-4">
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <label>Working Hours Per Day</label>
                                                        <input type="text" class="form-control   "
                                                            value="{{ old('working_hours_per_day') }}"
                                                            name="working_hours_per_day"
                                                            placeholder="Working Hours Per Day" />
                                                        <p class="text-danger">
                                                            {{ $errors->first('working_hours_per_day') }}</p>

                                                    </div>
                                                    <!--end::Input-->
                                                </div>

                                                <div class="col-xl-4">
                                                    <div class="form-group">
                                                        <label>Joining Date</label>
                                                        <input type="text" class="form-control   "
                                                            value="{{ old('joining_date') }}" name="joining_date"
                                                            placeholder="Joining Date" id="kt_datepicker_joining" readonly>
                                                        <p class="text-danger"> {{ $errors->first('joining_date') }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4">
                                                    <div class="form-group">
                                                        <label>Starting Date</label>
                                                        <input type="text" class="form-control   "
                                                            value="{{ old('starting_date') }}" name="starting_date"
                                                            placeholder="Starting Date" id="kt_datepicker_starting"
                                                            readonly>
                                                        <p class="text-danger"> {{ $errors->first('starting_date') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif



                                    <div class="form-group row">
                                        <div class="col-xl 12">
                                            <div class="form-group">
                                                <label for="exampleTextarea">Description</label>
                                                <textarea class="form-control   " id="exampleTextarea" name="employee_description"
                                                    rows="5">{{ old('employee_description') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="image-input image-input-outline" id="kt_image_1">

                                            <div class="image-input-wrapper"
                                                style="background-image: url({{ asset('storage/placeholder.jpg') }})">
                                            </div>

                                            <label
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="change" data-toggle="tooltip" title=""
                                                data-original-title="Change avatar">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file" name="employee_feature_img" accept=".jpg,.png" />
                                                {{-- <input type="hidden" name="profile_avatar_remove"/> --}}
                                            </label>

                                            <span
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>
                                        </div>
                                        <span class="form-text">Employee Image</span>
                                        @error('employee_feature_img')
                                            {{ $message }}
                                        @enderror
                                    </div>

                                    <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                                    <input type="hidden" name="created_by" value="{{ session('employee_id') }}">
                                    <input type="hidden" name="have_salary" id="have_salary"
                                        value="{{ old('have_salary') ?? 0 }}">
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
    <script>
        $('input[name="employee_phone"]').inputmask("mask", {
            mask: "\\923999999999",
        });
        $('#salary-btn').click(() => {
            // console.log('test');
            $('#salary').slideToggle(() => {
                if ($("input[name=have_salary]").val() == 0) {
                    $("input[name=have_salary]").val(1)
                    $('#salary-btn').text('Cancel')
                } else if ($("input[name=have_salary]").val() == 1) {
                    $("input[name=have_salary]").val(0)
                    $('#salary-btn').text('Add Salary')
                }
            });
        });
        $('#btn-submit').click(() => {

            var employee_name = $('#employee_name').val();
            $('#employee_name').val(employee_name.trim());
        });
    </script>
    <script>
        var avatar1 = new KTImageInput('kt_image_1');
    </script>
    <script src="{{ asset('js/employees/form_validation.js') }}"></script>
    <script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>


@endsection
