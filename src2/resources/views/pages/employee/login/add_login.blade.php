@extends('layout.default')
@section('title', 'Add Employee Login')
@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Employee Login</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Employee Management</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Login</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Add Login</a>
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
                                <h3 class="card-label">Add Login
                                    <!-- <span class="d-block text-muted pt-2 font-size-sm">Manage Customers</span> -->
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form method="post" action="{{ route('employee-login.store') }}" id="add_employee_form"
                                autocomplete="false">
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
                                            <label for="gender">Employee *</label>
                                            <select class="form-control  selectpicker" data-live-search="true"
                                                title="Select Employee" id="employee_id" name="employee_id">
                                                @foreach ($employees as $employee)
                                                    <option value="{{ $employee->id }}"
                                                        {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                                        {{ $employee->employee_name }}</option>
                                                @endforeach
                                            </select>
                                            <p class="text-danger"> {{ $errors->first('employee_id') }}</p>
                                            <!--end::Input-->
                                        </div>

                                        <div class="col-xl-6">
                                            <label>Role *</label>
                                            <div class="input-group">
                                                <select class="form-control selectpicker " title="Select Role" data-size="5"
                                                    data-live-search="true" data-actions-box="true" name="role_id[]"
                                                    multiple>
                                                    @foreach ($roles as $id => $role)
                                                        <option value="{{ $id }}"
                                                            {{ in_array($id, old('role_id', [])) ? 'selected' : '' }}>
                                                            {{ $role }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <p class="text-danger"> {{ $errors->first('role_id') }}</p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {{-- <div class="col-xl-4">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Email *</label>
                                                <input type="text" class="form-control {{$errors->first('email')?'is-invalid':''}}" name="email" id="email" placeholder="Email"/>
                                                <p class="text-danger"> {{$errors->first('email')}}</p>
                                            </div>
                                            <!--end::Input-->
                                        </div> --}}
                                        <div class="col-xl-4">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Email/Phone *</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->first('employee_username') ? 'is-invalid' : '' }}"
                                                    name="employee_username" value="{{ old('employee_username') }}"
                                                    id="phone" placeholder="Email/Phone" />
                                                <p class="text-danger"> {{ $errors->first('employee_username') }}</p>
                                            </div>
                                            <!--end::Input-->
                                        </div>

                                        <div class="col-xl-4">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Password *</label>
                                                <div class="input-group">
                                                    <input type="password"
                                                        class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}"
                                                        name="password" id="password" placeholder="Password" />
                                                    <div class="input-group-append">
                                                        <button type="button" id="show_pwd"
                                                            class="btn btn-outline-secondary btn-sm" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <p class="text-danger"> {{ $errors->first('password') }}</p>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <input type="hidden" name="created_by" value="{{ session('employee_id') }}">
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
@endsection


{{-- Scripts Section --}}

@section('scripts')
    <script src="{{ asset('js/employees/form_validation.js') }}"></script>
    <script>
        $('#show_pwd').click(function() {
            if ($('#password').attr('type') == 'password') {
                $('#password').attr('type', 'text');
                $('#show_pwd i').addClass("fa-eye");
                $('#show_pwd i').removeClass("fa-eye-slash");
            } else {
                $('#password').attr('type', 'password');
                $('#show_pwd i').removeClass("fa-eye");
                $('#show_pwd i').addClass("fa-eye-slash");
            }
        });
        $('#employee_id').change(function() {
            var employeeID = $(this).val();
            if (employeeID) {
                $.ajax({
                    url: "{{ url('get-employee') }}?employee_id=" + employeeID,
                    type: "Get",
                    success: function(res) {
                        if (jQuery.isEmptyObject(res)) {
                            $("#phone").val('');
                        } else {
                            $("#phone").val('');
                            $("#phone").val(res.employee_phone);
                        }
                    }
                });
            } else {
                $("#email").val('');
                $("#phone").val('');
            }
        });
    </script>


@endsection
