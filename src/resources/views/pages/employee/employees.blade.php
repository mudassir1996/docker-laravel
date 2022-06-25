@extends('layout.default')

@section('title', 'Employees')

@section('content')



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

                            <a href="" class="text-muted">All Employees</a>

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

                                <h3 class="card-label">Employees

                                    <span class="d-block text-muted pt-2 font-size-sm">Manage Employees</span>

                                </h3>

                            </div>

                            <div class="card-toolbar">

                                <!--begin::Dropdown-->

                                <div class="dropdown dropdown-inline mr-2">

                                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                        <span class="svg-icon svg-icon-md">

                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->

                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                                                    <rect x="0" y="0" width="24" height="24" />

                                                    <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />

                                                    <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />

                                                </g>

                                            </svg>

                                            <!--end::Svg Icon-->

                                        </span>Export</button>

                                    <!--begin::Dropdown Menu-->

                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">

                                        <!--begin::Navigation-->

                                        <ul class="navi flex-column navi-hover py-2">

                                            <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>

                                            <li class="navi-item">

                                                <a href="{{ route('print.employees') }}" target="_blank" class="navi-link">

                                                    <span class="navi-icon">

                                                        <i class="la la-print"></i>

                                                    </span>

                                                    <span class="navi-text">Print</span>

                                                </a>

                                            </li>

                                            <li class="navi-item">

                                                <a href="#" id="export_copy" class="navi-link">

                                                    <span class="navi-icon">

                                                        <i class="la la-copy"></i>

                                                    </span>

                                                    <span class="navi-text">Copy</span>

                                                </a>

                                            </li>

                                            {{-- <li class="navi-item">
                                                <a href="#" id="export_excel" class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="la la-file-excel-o"></i>
                                                    </span>
                                                    <span class="navi-text">Excel</span>
                                                </a>
                                            </li> --}}

                                            <li class="navi-item">

                                                <a href="#" id="export_csv" class="navi-link">

                                                    <span class="navi-icon">

                                                        <i class="la la-file-text-o"></i>

                                                    </span>

                                                    <span class="navi-text">CSV</span>

                                                </a>

                                            </li>

                                            <li class="navi-item">

                                                <a href="{{ route('print.employees') }}" target="_blank" class="navi-link">


                                                    <span class="navi-icon">

                                                        <i class="la la-file-pdf-o"></i>

                                                    </span>

                                                    <span class="navi-text">PDF</span>

                                                </a>

                                            </li>

                                        </ul>

                                        <!--end::Navigation-->

                                    </div>

                                    <!--end::Dropdown Menu-->

                                </div>

                                <!--end::Dropdown-->

                                @if(!Auth::guard('web')->check())

                                @can('employee_create')

                                <!--begin::Button-->

                                <a href="{{route('employees.create')}}" class="btn btn-primary font-weight-bolder">

                                    <span class="svg-icon svg-icon-md">

                                        <!--begin::Svg Icon -->

                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                                                <rect x="0" y="0" width="24" height="24" />

                                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />

                                                <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000" />

                                            </g>

                                        </svg>

                                        <!--end::Svg Icon-->

                                    </span>New Employee</a>

                                <!--end::Button-->



                                @endcan

                                @else

                                <a href="{{route('employees.create')}}" class="btn btn-primary font-weight-bolder">

                                    <span class="svg-icon svg-icon-md">

                                        <!--begin::Svg Icon -->

                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                                                <rect x="0" y="0" width="24" height="24" />

                                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />

                                                <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000" />

                                            </g>

                                        </svg>

                                        <!--end::Svg Icon-->

                                    </span>New Employee</a>

                                <!--end::Button-->

                                @endif

                            </div>

                        </div>

                        <div class="card-body">

                            <!--begin: Datatable-->

                            <table class="table table-separate table-head-custom table-checkable nowrap" id="kt_datatable_employees">

                                <thead>

                                    <tr>

                                       

                                        <th>Image</th>

                                        <th>Name</th>

                                        <th>Description</th>

                                        <th>Gender</th>

                                        <th>Phone</th>

                                        <th>Email</th>

                                        <th>Date of Birth</th>

                                        <th>CNIC</th>

                                        <th>Address</th>

                                        <th>Status</th>

                                        <th>Created By</th>

                                        <th>Created At</th>

                                        <th>Updated At</th>

                                        <th data-priority="2">Actions</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @if(!$employees->isEmpty())

                                    @foreach($employees as $employee)

                                    <tr>

                                       

                                        <td>

                                            <div class="symbol symbol-75  flex-shrink-0">

                                                <div class="symbol-label"> <img class="h-100 w-100 align-self-end" src="{{Storage::disk('public')->exists('employees/'.$employee->employee_feature_img)?asset('storage/employees/'.$employee->employee_feature_img):asset('storage/'.$employee->employee_feature_img)}}" alt="{{$employee->employee_name}}"> </div>

                                            </div>



                                        </td>

                                        <td>{{$employee->employee_name}}</td>

                                        <td>{{substr($employee->employee_description, 0, 40)}}...</td>

                                        <td>{{ucfirst($employee->employee_gender)}}</td>

                                        <td>{{$employee->employee_phone}}</td>

                                        <td>{{$employee->employee_email}}</td>

                                        <td>{{$employee->employee_dob}}</td>

                                        <td>{{$employee->employee_cnic}}</td>

                                        <td>{{$employee->employee_address}}</td>

                                        <td>{{ucfirst($employee->employee_status)}}</td>

                                        <td>

                                            {{$employee->username}}

                                        </td>

                                        <td>{{$employee->created_at}}</td>

                                        <td>{{$employee->updated_at}}</td>

                                        <td>

                                            <form action="{{ route('employees.destroy',$employee->id)}}" id="delete_item_from{{$employee->id}}" method="post">

                                                @csrf

                                                @method('DELETE')

                                                @if(!Auth::guard('web')->check())

                                                @can('employee_edit')

                                                <a class="btn p-0" title="Edit" href="{{ route('employees.edit',$employee->id)}}">

                                                    <i class="text-success h3 la la-edit"></i>

                                                </a>

                                                @endcan


                                                @if (!$loop->last)
                                                    
                                                @can('employee_delete')

                                                <a class="btn p-0" title="Delete" onclick="deleteConfirmation('delete_item_from{{$employee->id}}')"><i class="text-danger h3 la la-trash"></i></a>

                                                @endcan
                                                @endif



                                                @else

                                            


                                                <a class="btn p-0" title="Edit" href="{{ route('employees.edit',$employee->id)}}">

                                                    <i class="text-success h3 la la-edit"></i>

                                                </a>



                                                @if (!$loop->last)
                                                    <a class="btn p-0" title="Delete" onclick="deleteConfirmation('delete_item_from{{$employee->id}}')"><i class="text-danger h3 la la-trash"></i></a>
                                                @endif

                                                @endif

                                            </form>

                                        </td>



                                    </tr>

                                    @endforeach

                                    @endif

                                </tbody>

                            </table>

                            <!--end: Datatable-->

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



{{-- Styles Section --}}

<!-- @section('styles')

<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />

@endsection -->





{{-- Scripts Section --}}



@section('scripts')

{{--vendors--}}

<script src="{{asset('plugins/custom/datatables/datatables.bundle.js?v=7.0.5')}}"></script>



{{-- Products Data --}}

<script src="{{asset('js/pages/crud/datatables/basic/paginations.js?v=7.0.5')}}"></script>





@endsection