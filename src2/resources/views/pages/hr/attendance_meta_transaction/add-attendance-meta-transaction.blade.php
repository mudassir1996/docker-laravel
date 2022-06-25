@extends('layout.default')
@section('title', 'Add Employee Attendance Meta Transaction')
@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Employee Attendance Meta Transaction</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('employee-salary.index') }}" class="text-muted">All Employee Attendance
                                Meta Transactions</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Add Employee Attendance Meta Transaction</a>
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
                                <h3 class="card-label">Add Employee Attendance Meta Transaction
                                    <!-- <span class="d-block text-muted pt-2 font-size-sm">Manage Customers</span> -->
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form method="post" action="{{ route('employee-attendance-meta.store') }}"
                                id="Add_employee_form" enctype="multipart/form-data">

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
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Employee</label>
                                                <select class="form-control   selectpicker" title="Select Employee"
                                                    data-live-search="true" data-size="5" name="employee_id" id="employee">
                                                    @foreach ($employees as $employee)
                                                        <option value="{{ $employee->id }}"
                                                            {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                                            {{ $employee->employee_name }}</option>
                                                    @endforeach
                                                </select>
                                                <p class="text-danger"> {{ $errors->first('employee_id') }}</p>

                                            </div>
                                            <!--end::Input-->
                                        </div>


                                        <div class="col-xl-4">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Employee Attendance Meta</label>
                                                <select class="form-control   selectpicker" title="Select Attendance Meta"
                                                    data-live-search="true" data-size="5"
                                                    name="employee_attendance_meta_id">
                                                    @foreach ($employee_attendance_metas as $employee_attendance_meta)
                                                        <option value="{{ $employee_attendance_meta->id }}"
                                                            {{ old('employee_attendance_meta_id') == $employee_attendance_meta->id ? 'selected' : '' }}>
                                                            {{ $employee_attendance_meta->title }}</option>
                                                    @endforeach
                                                </select>
                                                <p class="text-danger">
                                                    {{ $errors->first('employee_attendance_meta_id') }}</p>

                                            </div>
                                            <!--end::Input-->
                                        </div>

                                        <div class="col-xl-4">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input type="text" class="form-control  " placeholder="Select Date"
                                                    name="date" readonly id="kt_datetimepicker_3">
                                                <p class="text-danger"> {{ $errors->first('date') }}</p>
                                            </div>
                                            <!--end::Input-->
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label>Per Hour Wage</label>
                                                <input type="text" class="form-control  "
                                                    value="{{ old('per_hour_wage') }}" name="per_hour_wage"
                                                    id="per-hour-wage" disabled>
                                                <p class="text-danger"> {{ $errors->first('per_hour_wage') }}</p>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label>Hours</label>
                                                <input type="text" class="form-control  " value="{{ old('hours') }}"
                                                    name="hours" id="hours" disabled>
                                                <p class="text-danger"> {{ $errors->first('hours') }}</p>
                                            </div>
                                        </div>


                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label>Amount</label>
                                                <input type="text" class="form-control  " value="{{ old('amount') }}"
                                                    name="amount" id="amount" disabled>
                                                <p class="text-danger"> {{ $errors->first('amount') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-xl 12">
                                            <div class="form-group">
                                                <label for="exampleTextarea">Remarks</label>
                                                <textarea class="form-control  " id="exampleTextarea" name="remarks"
                                                    rows="5">{{ old('remarks') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                                    <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
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
    <script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}"></script>
    <script>
        var default_per_hour_wage;

        $('#employee').change(function() {
            var id = $(this).val();
            $('#hours').removeAttr('disabled');
            $('#per-hour-wage').removeAttr('disabled');
            $('#amount').removeAttr('disabled');
            $('#hours').val('');
            $('#per-hour-wage').val('');
            $('#amount').val('');
            $('#amount').attr('readonly', true);
            $.ajax({
                type: "get",
                url: "/get-employee-salary-data?employee_id=" + id,
                dataType: "json",
                success: function(response) {
                    $('#hours').val(response.working_hours_per_day);
                    var wage = $('#per-hour-wage').val(response.per_hour_wage);
                    default_per_hour_wage = wage.val();
                    $('#amount').val(response.working_hours_per_day * response.per_hour_wage);
                }
            });
        });

        $('#hours').keyup(function() {
            var hours = $(this).val();
            $('#per-hour-wage').val(default_per_hour_wage);
            $('#amount').val(hours * default_per_hour_wage);
        });

        $('#per-hour-wage').keyup(function() {
            var per_hour_wage = $(this).val();
            var hours = $('#hours').val();
            $('#amount').val(hours * per_hour_wage);

        });
    </script>
    <script>
        $('#btn-submit').click(() => {
            var employee_name = $('#employee_name').val();
            $('#employee_name').val(employee_name.trim());
        });
    </script>
    <script src="{{ asset('js/employees/form_validation.js') }}"></script>
    <script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>


@endsection
