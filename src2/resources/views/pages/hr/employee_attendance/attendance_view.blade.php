@extends('layout.default')
@section('styles')
    <link href="{{asset('plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.2.8')}}" rel="stylesheet" type="text/css" >
@endsection
@section('title', 'Employee Attendances')

@section('content')



    <!--begin::Subheader-->

    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">

        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">

            <!--begin::Info-->

            <div class="d-flex align-items-center flex-wrap mr-1">

                <!--begin::Page Heading-->

                <div class="d-flex align-items-baseline flex-wrap mr-5">

                    <!--begin::Page Title-->

                    <h5 class="text-dark font-weight-bold my-1 mr-5">Employee Attendances</h5>

                    <!--end::Page Title-->

                    <!--begin::Breadcrumb-->

                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">

                        <li class="breadcrumb-item">

                            <a href="" class="text-muted">All Employee Attendances</a>

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
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">
                                    {{$employee->employee_name}}
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <a href="{{route('employee-attendance.create')}}" class="btn btn-light-primary font-weight-bold">
                                    <i class="ki ki-plus "></i> Add Attendance
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="kt_calendar"></div>
                        </div>
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



{{-- Styles Section --}}

{{-- <!-- @section('styles')

    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />

@endsection --> --}}





{{-- Scripts Section --}}



@section('scripts')

    {{-- vendors --}}
@include('pages.hr.employee_attendance.attendance_calender')
    <script src="{{ asset('plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.2.8') }}"></script>



    {{-- Products Data --}}

    {{-- <script src="{{ asset('js/pages/crud/datatables/basic/paginations.js?v=7.0.5') }}"></script> --}}
    {{-- <script src="{{ asset('js/pages/features/calendar/attendance.js?v=7.2.8') }}"></script> --}}




@endsection
