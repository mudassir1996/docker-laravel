@extends('layout.default')
@section('title', 'Roles')
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
                            <a href="#" class="text-muted">Manage Roles</a>
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
    <div class="row">
        @foreach ($roles as $role)
            <!--begin::Col-->
            <div class="col-md-4 mb-6">
                <!--begin::Card-->
                <div class="card card-custom h-md-100">
                    <!--begin::Card header-->
                    <div class="card-header border-0 min-h-40px pt-4">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>{{ $role->role_title }}</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0 pb-2">
                        <!--begin::Users-->
                        <div class="font-weight-bolder text-dark-50">Total users with this role:
                            {{ count($role->employees) }}</div>
                        <!--end::Users-->

                    </div>
                    <!--end::Card body-->
                    <!--begin::Card footer-->
                    <div class="card-footer flex-wrap pt-2 pb-5 border-0">
                        @if (auth()->guard('web')->check() ||
                            auth()->user()->can('role_show'))
                            <a href="{{ route('roles.show', $role->id) }}"
                                class="btn btn-light btn-hover-primary btn-sm my-1 mr-2 font-weight-bolder">View Role</a>
                        @endif
                        @if (auth()->guard('web')->check() ||
                            auth()->user()->can('role_edit'))
                            <a href="{{ route('roles.edit', $role->id) }}"
                                class="btn btn-light btn-hover-primary btn-sm my-1 mr-2 font-weight-bolder">Edit Role</a>
                        @endif

                    </div>
                    <!--end::Card footer-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
        @endforeach
        @if (auth()->guard('web')->check() ||
            auth()->user()->can('role_create'))
            <div class="col-md-4">
                <!--begin::Card-->
                <a href="{{ route('roles.create') }}">
                    <div class="card h-md-100">
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-center py-3">
                            <!--begin::Button-->
                            <button type="button" class="btn btn-clear d-flex flex-column flex-center "
                                data-bs-toggle="modal" data-bs-target="#kt_modal_add_role">
                                <!--begin::Illustration-->
                                <span class="svg-icon svg-success svg-icon-6x mb-2">
                                    <svg width="230" height="228" viewBox="0 0 230 228" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M85 144.369V228H145V144.632L228.868 145L229.132 85.0003L145 84.6313V0H85V84.3681L1.13158 84.0003L0.868408 144L85 144.369Z"
                                            fill="#CFCFCF" />
                                    </svg>
                                </span>
                                <!--end::Illustration-->
                                <!--begin::Label-->
                                <div class="font-weight-bolder font-size-h5 text-dark-50 text-hover-primary">Add New Role
                                </div>
                                <!--end::Label-->
                            </button>
                            <!--begin::Button-->
                        </div>
                        <!--begin::Card body-->
                    </div>
                </a>
                <!--begin::Card-->
            </div>
        @endif


    </div>



@endsection



{{-- Scripts Section --}}

@section('scripts')
    {{-- vendors --}}
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js?v=7.0.5') }}"></script>

    {{-- Products Data --}}
    <script src="{{ asset('js/pages/crud/datatables/basic/paginations.js?v=7.0.5') }}"></script>


@endsection
