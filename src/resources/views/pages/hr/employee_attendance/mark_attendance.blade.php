@extends('layout.default')
@section('title', 'Add Employee Attendance')
@section('styles')
    <style>
        #radioBtn .notActive {
            color: #000;
            background-color: #fff;
        }
    </style>
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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Employee Attendance</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('employee-salary.index') }}" class="text-muted">All Employee Attendances</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Add Employee Attendance</a>
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
                    <div class="card card-custom card-sticky" id="kt_page_sticky_card">
                        <div class="card-header flex-wrap py-5">
                            <div class="card-title">
                                <h3 class="card-label">Add Employee Attendance
                                    <span class="d-block text-muted pt-2 font-size-sm">{{Carbon\Carbon::today()->format('D, M d, Y')}}</span>
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <button onclick="markAllPresent()" class="btn btn-success font-weight-bolder">All Present</button>
                                {{-- <button data-toggle="modal" data-target="#subscription_modal" class="btn btn-danger font-weight-bolder">All Absent</button> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form method="post" action="{{ route('employee-attendance.store') }}" id="add_employee_form" enctype="multipart/form-data">
                                @csrf
                                <table class="table table-separate table-head-custom">
                                    <thead>
                                        <tr>
                                            <th>Employee Name</th>
                                            <th>Status</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employees as $employee)
                                            <tr>
                                                <td>
                                                    {{$employee->employee_name}}
                                                    <input type="hidden" name="employee_id[]" value="{{$employee->id}}">
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div id="radioBtn" class="">
                                                            <?php
                                                            if ($employee_attendances->where('employee_id', $employee->id)->first()!='') {
                                                                $emp_att_id=$employee_attendances->where('employee_id', $employee->id)->first()->attendance_status_id;
                                                                $att_status_tag=$attendance_statuses->where('id', $emp_att_id)->first()->tag;
                                                            }else {
                                                                $emp_att_id=0;
                                                                $att_status_tag='';
                                                            }
                                                                $class='';
                                                                foreach ($attendance_statuses as $attendance_status){
                                                                    if ($attendance_status->tag=='present'){
                                                                        $class='success';
                                                                    }else if($attendance_status->tag=='absent'){
                                                                        $class='danger';
                                                                    }
                                                                    else if($attendance_status->tag=='leave'){
                                                                        $class='dark';
                                                                    }

                                                                    
                                                            ?>

                                                                    <a class="btn btn-{{$class}} btn-sm {{$emp_att_id==$attendance_status->id?'active':'notActive'}} " data-toggle="attendance{{$employee->id}}" data-title="{{$attendance_status->tag}}">{{substr($attendance_status->title,0, 1)}}</a>
                                                            <?php
                                                                }
                                                            ?>
                                                        </div>
                                                        <input type="hidden" name="attendance[]" value="{{$att_status_tag}}" id="attendance{{$employee->id}}" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control " placeholder="Remarks" name="remarks[]">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button class="btn btn-primary px-12 btn-shadow">Submit</button>
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
        function markAllPresent(){
            var rowCount = $('.table tbody tr').length;
            for (let index = 0; index < rowCount; index++) {
                a=$('.table tbody tr:eq('+index+') td:eq(1) .input-group #radioBtn a');
                var tog = a.data('toggle');

                $('#' + tog).prop('value', 'present');
                $('a[data-toggle="' + tog + '"]').not('[data-title="present"]').removeClass('active').addClass('notActive');
                $('a[data-toggle="' + tog + '"][data-title="present"]').removeClass('notActive').addClass('active');
            }
        }

        $('#radioBtn a').on('click', function () {
            var title = $(this).data('title');
            var tog = $(this).data('toggle');
            $('#' + tog).prop('value', title);

            $('a[data-toggle="' + tog + '"]').not('[data-title="' + title + '"]').removeClass('active').addClass('notActive');
            $('a[data-toggle="' + tog + '"][data-title="' + title + '"]').removeClass('notActive').addClass('active');
        })
    </script>
    
    {{-- <script src="{{ asset('js/employees/form_validation.js') }}"></script> --}}
   


@endsection