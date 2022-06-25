@extends('layout.default')
@section('title', 'Edit Roles')
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
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid px-0">
            <!--begin::Teachers-->
            <div class="d-flex flex-row">
                <!--begin::Aside-->

                <!--end::Aside-->
                <!--begin::Content-->
                <div class="flex-row-fluid">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-header flex-wrap py-5">
                            <div class="card-title">
                                <h3 class="card-label">Edit Role
                                    <!-- <span class="d-block text-muted pt-2 font-size-sm">All Categories</span> -->
                                </h3>
                            </div>

                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form method="post" action="{{ route('roles.update', $role->id) }}" id="add_role_form"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
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
                                    <div class="from-group row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>Roles Title *</label>
                                                <input type="text" id="role_title" name="role_title"
                                                    class="form-control   {{ $errors->first('role_title') ? 'is-invalid' : '' }}"
                                                    value="{{ $role->role_title }}" placeholder="Role Title" />
                                                <p class="text-danger"> {{ $errors->first('role_title') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group ">
                                                <label>Permissions *</label>
                                                <div class="input-group">
                                                    <select class="form-control   selectpicker" title="Select Permission"
                                                        data-size="5" data-actions-box="true" data-live-search="true"
                                                        name="permission_id[]" multiple>
                                                        @foreach ($permissions as $id => $permission)
                                                            <option value="{{ $id }}"
                                                                {{ in_array($id, old('permissions', [])) || $role->permissions->contains($id) ? 'selected' : '' }}>
                                                                {{ $permission }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <p class="text-danger"> {{ $errors->first('permission_id') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleTextarea">Description</label>
                                        <textarea class="form-control   " id="exampleTextarea" name="description" rows="5">{{ $role->description }}</textarea>
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
            var role_title = $('#role_title').val();
            $('#role_title').val(role_title.trim());
        });
    </script>
    <script src="{{ asset('js/roles/form_validation.js') }}"></script>
@endsection
