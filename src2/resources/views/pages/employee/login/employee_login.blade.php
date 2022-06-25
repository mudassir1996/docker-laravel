@extends('layout.default')
@section('title', 'Employee Login')
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
                            <a href="#" class="text-muted">Manage Login</a>
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
                                <h3 class="card-label">Manage Employee Login
                                    {{-- <span class="d-block text-muted pt-2 font-size-sm">Manage Employee Login</span> --}}
                                </h3>
                            </div>
                            <div class="card-toolbar">

                                @if (!Auth::guard('web')->check())
                                    @can('employee_login_create')
                                        <!--begin::Button-->
                                        <a href="{{ route('employee-login.create') }}"
                                            class="btn btn-primary font-weight-bolder">
                                            <span class="svg-icon svg-icon-md">
                                                <!--begin::Svg Icon -->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                    viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                                        <path
                                                            d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z"
                                                            fill="#000000" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>New Employee Login</a>
                                        <!--end::Button-->
                                    @endcan
                                @else
                                    <a href="{{ route('employee-login.create') }}"
                                        class="btn btn-primary font-weight-bolder">
                                        <span class="svg-icon svg-icon-md">
                                            <!--begin::Svg Icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                                    <path
                                                        d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z"
                                                        fill="#000000" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>New Employee Login</a>
                                    <!--end::Button-->
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin: Datatable-->
                            <table class="table table-separate table-head-custom table-checkable nowrap" id="kt_datatable">
                                <thead>
                                    <tr>

                                        <th>Employee</th>
                                        <th>Email</th>
                                        <th>Roles</th>
                                        <th>Created By</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th data-priority="2">Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$employee_logins->isEmpty())
                                        @foreach ($employee_logins as $employee_login)
                                            <tr>

                                                <td>{{ $employee_login->employee_name }}</td>
                                                <td>{{ $employee_login->email }}</td>
                                                <td>
                                                    @foreach ($employee_login->roles as $key => $item)
                                                        <span
                                                            class="badge badge-success my-1">{{ $item->role_title }}</span>
                                                    @endforeach
                                                </td>

                                                <td>
                                                    {{ $employee_login->creater_employee }}
                                                </td>
                                                <td>{{ $employee_login->created_at }}</td>
                                                <td>{{ $employee_login->updated_at }}</td>
                                                <td>
                                                    <form
                                                        action="{{ route('employee-login.destroy', $employee_login->id) }}"
                                                        id="delete_item_from{{ $employee_login->id }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        @if (!Auth::guard('web')->check())
                                                            @can('employee_login_edit')
                                                                <a class="btn p-0" title="Edit"
                                                                    href="{{ route('employee-login.edit', $employee_login->id) }}">
                                                                    <i class="text-success h3 la la-edit"></i>
                                                                </a>
                                                            @endcan

                                                            @can('employee_login_delete')
                                                                <a class="btn p-0" title="Delete"
                                                                    onclick="deleteConfirmation('delete_item_from{{ $employee_login->id }}')"><i
                                                                        class="text-danger h3 la la-trash"></i></a>
                                                            @endcan
                                                        @else
                                                            <a class="btn p-0" title="Edit"
                                                                href="{{ route('employee-login.edit', $employee_login->id) }}">
                                                                <i class="text-success h3 la la-edit"></i>
                                                            </a>

                                                            <a class="btn p-0" title="Delete"
                                                                onclick="deleteConfirmation('delete_item_from{{ $employee_login->id }}')"><i
                                                                    class="text-danger h3 la la-trash"></i></a>
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
    {{-- vendors --}}
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js?v=7.0.5') }}"></script>

    {{-- Products Data --}}
    <script src="{{ asset('js/pages/crud/datatables/basic/paginations.js?v=7.0.5') }}"></script>


@endsection
