@extends('layout.default')
@section('title', 'Edit Roles')
@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Employee Management</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Roles</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('roles.index') }}" class="text-muted">Manage Roles</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Edit Roles</a>
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
    <div class="d-flex flex-column flex-lg-row">
        <!--begin::Sidebar-->
        <div class="flex-column flex-lg-row-auto w-100 w-lg-200px w-xl-300px mb-10">
            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2 class="mb-0">{{ $role->role_title }}</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Permissions-->
                    <div class="d-flex flex-column text-gray-600">
                        @foreach ($role->permissions as $permission)
                            @if ($loop->iteration < 5)
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary mr-3" style="height: 4px !important"></span>
                                    {{ $permission->permission_title }}
                                </div>
                            @endif
                        @endforeach
                        <div class="d-flex align-items-center py-2 d-none">
                            <span class="bullet bg-primary mr-3" style="height: 4px !important"></span>
                            <em>and more...</em>
                        </div>
                    </div>
                    <!--end::Permissions-->
                </div>
                <!--end::Card body-->
                <!--begin::Card footer-->
                <div class="card-footer pt-0">
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('role_edit'))
                        {{-- <button type="button" class="btn btn-light btn-active-primary" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_update_role">Edit Role</button> --}}
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-light btn-active-primary mt-3">Edit
                            Role</a>
                    @endif

                </div>
                <!--end::Card footer-->
            </div>
            <!--end::Card-->

        </div>
        <!--end::Sidebar-->
        <!--begin::Content-->
        <div class="flex-lg-row-fluid ml-lg-10">
            <!--begin::Card-->
            <div class="card card-custom mb-6 mb-xl-9">
                <!--begin::Card header-->
                <div class="card-header pt-5 border-0">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2 class="d-flex align-items-center">Employees Assigned

                        </h2>
                    </div>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">


                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table" id="roles_view_table">
                        <!--begin::Table head-->
                        <thead class="text-muted font-weight-bolder text-uppercase">
                            <tr>
                                <!--begin::Table row-->
                                <th>Employee</th>
                                <th>Assigned Date</th>
                                <th>Actions</th>
                                <!--end::Table row-->
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="font-weight-bold text-dark-50">
                            @foreach ($assigned_employees as $assigned_employee)
                                <tr>
                                    <!--begin::User=-->
                                    <td class="align-middle">
                                        {{ $assigned_employee['employee_name'] }}
                                    </td>
                                    <!--end::user=-->
                                    <!--begin::Joined date=-->
                                    <td class="align-middle">{{ $assigned_employee['created_at'] }}</td>
                                    <!--end::Joined date=-->
                                    <!--begin::Action=-->
                                    <td class="align-middle">
                                        <a class="btn p-0" title="Edit"
                                            href="{{ route('employee-login.edit', $assigned_employee['id']) }}">

                                            <i class="text-success h3 la la-edit"></i>

                                        </a>

                                    </td>
                                    <!--end::Action=-->
                                </tr>
                            @endforeach


                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content-->
    </div>
@endsection
{{-- Scripts Section --}}

@section('scripts')
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js?v=7.0.5') }}"></script>

    <script>
        $('#roles_view_table').DataTable({
            responsive: true,
            columnDefs: [{
                    responsivePriority: 1,
                    targets: 0
                },
                {
                    responsivePriority: 2,
                    targets: -1
                },
            ],
            pagingType: "full_numbers",
            order: [0, "desc"],
            dom: "frtip",
        });
        $('#btn-submit').click(() => {
            var role_title = $('#role_title').val();
            $('#role_title').val(role_title.trim());
        });
    </script>

    <script src="{{ asset('js/roles/form_validation.js') }}"></script>
@endsection
