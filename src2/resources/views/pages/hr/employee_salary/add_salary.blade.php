@extends('layout.default')
@section('title', 'Add Employee Salary')
@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Employee Salaries</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('employee-salary.index') }}" class="text-muted">All Employee Salaries</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Add Employee Salary</a>
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
                    <div class="card card-custom ">
                        <div class="card-header flex-wrap py-5">
                            <div class="card-title">
                                <h3 class="card-label">Add Employee Salary
                                    <!-- <span class="d-block text-muted pt-2 font-size-sm">Manage Customers</span> -->
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form method="post" action="{{ route('employee-salary.store') }}" id="add_employee_form"
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
                                        <div class="col-xl-4">
                                            <label>Employee</label>
                                            <select name="employee_id" class="form-control selectpicker">
                                                @foreach ($employees as $employee)
                                                    <option value="{{ $employee->id }}">{{ $employee->employee_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xl-4">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Salary Type</label>
                                                <select class="form-control    selectpicker" data-live-search="true"
                                                    data-size="5" name="salary_type_id">

                                                    @foreach ($salary_types as $salary_type)
                                                        <option value="{{ $salary_type->id }}"
                                                            {{ old('salary_type_id') == $salary_type->id ? 'selected' : '' }}>
                                                            {{ $salary_type->title }}</option>
                                                    @endforeach
                                                </select>
                                                <p class="text-danger"> {{ $errors->first('salary_type_id') }}</p>

                                            </div>
                                            <!--end::Input-->
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label>Salary Amount</label>
                                                <input type="text" class="form-control  "
                                                    value="{{ old('salary_amount') }}" name="salary_amount"
                                                    placeholder="Employee Salary" />
                                                <p class="text-danger"> {{ $errors->first('salary_amount') }}</p>
                                            </div>
                                        </div>

                                        {{-- <div class="col-xl-4">
                                            <div class="form-group">
                                                <label>Per Hour Wage</label>
                                                <input type="text" class="form-control   "
                                                    value="{{ $employee_salary->per_hour_wage }}" name="per_hour_wage"
                                                    placeholder="Per Hour Wage" />
                                                <p class="text-danger"> {{ $errors->first('per_hour_wage') }}</p>
                                            </div>
                                        </div> --}}
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-xl-4">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Working Hours</label>
                                                <input type="text" class="form-control   "
                                                    value="{{ old('working_hours_per_day') }}"
                                                    name="working_hours_per_day" placeholder="Working Hours" />
                                                <p class="text-danger"> {{ $errors->first('working_hours_per_day') }}
                                                </p>

                                            </div>
                                            <!--end::Input-->
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label>Joining Date</label>
                                                <input type="text" class="form-control   "
                                                    value="{{ old('joining_date') }}" name="joining_date"
                                                    placeholder="Employee Salary" id="kt_datepicker_joining" readonly>
                                                <p class="text-danger"> {{ $errors->first('joining_date') }}</p>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label>Starting Date</label>
                                                <input type="text" class="form-control   "
                                                    value="{{ old('starting_date') }}" name="starting_date"
                                                    placeholder="Salary Date" id="kt_datepicker_starting" readonly>
                                                <p class="text-danger"> {{ $errors->first('starting_date') }}</p>
                                            </div>
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
    <script>
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
