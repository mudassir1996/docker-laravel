@extends('layout.default')
@section('title', 'Role')
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
                            <a href="{{route('roles.index')}}" class="text-muted">Manage Roles</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">View Roles</a>
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
            <div class="d-flex flex-row">
                <!--begin::Layout-->
                <div class="flex-row-fluid">
                    <!--begin::Section-->
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xxl-12">
                            <!--begin::Engage Widget 14-->
                            <div class="card card-custom card-stretch gutter-b">
                                <div class="card-body p-15 pb-20">
                                    <div class="row mb-17">
                                        <div class="col-xxl-12">
                                            <h2 class="font-weight-bolder text-dark mb-7" style="font-size: 32px;">{{$role->role_title}}</h2>
                                            <div class="line-height-xl">{{$role->description}}</div>
                                        </div>
                                        <div class="col-xxl-12">
                                            <p class="text-dark font-weight-bold ">Permissions</p>
                                            @foreach($role->permissions as $permission)
                                            <span class="badge badge-success my-1">{{$permission->permission_title}}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <!--begin::Info-->

                                    

                                        <div class="col-4 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Created By</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">
                                                    {{$role->username}}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-4 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Created At</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">{{$role->created_at}}</span>
                                            </div>
                                        </div>
                                        <div class="col-4 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Updated At</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">{{$role->updated_at}}</span>
                                            </div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--begin::Buttons-->
                                    <div class="d-flex">
                                        @if(!Auth::guard('web')->check())
                                        @can('role_edit')
                                        <a href="{{ route('roles.edit',$role->id)}}" class="btn btn-primary btn-shadow font-weight-bolder mr-6 px-8 font-size-sm">
                                            <span class="svg-icon">
                                                <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-02-01-052524/theme/html/demo1/dist/../src/media/svg/icons/Design/Edit.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) " />
                                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>Edit</a>
                                        @endcan
                                        @else
                                        <a href="{{ route('roles.edit',$role->id)}}" class="btn btn-primary btn-shadow font-weight-bolder mr-6 px-8 font-size-sm">
                                            <span class="svg-icon">
                                                <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-02-01-052524/theme/html/demo1/dist/../src/media/svg/icons/Design/Edit.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) " />
                                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>Edit</a>
                                        @endif

                                        <form action="{{ route('roles.destroy',$role->id)}}" id="delete_item_from{{$role->id}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            @if(!Auth::guard('web')->check())
                                            @can('role_delete')
                                            <a onclick="deleteConfirmation('delete_item_from{{$role->id}}')" class="btn btn-danger btn-shadow font-weight-bolder px-8 font-size-sm">
                                                <span class="svg-icon">
                                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-02-01-052524/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero" />
                                                            <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>Delete</a>
                                            @endcan
                                            @else
                                            <a onclick="deleteConfirmation('delete_item_from{{$role->id}}')" class="btn btn-danger btn-shadow font-weight-bolder px-8 font-size-sm">
                                                <span class="svg-icon">
                                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-02-01-052524/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero" />
                                                            <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>Delete</a>
                                            @endif

                                        </form>
                                    </div>
                                    <!--end::Buttons-->
                                </div>
                            </div>
                            <!--end::Engage Widget 14-->
                        </div>
                    </div>
                    <!--end::Section-->
                </div>
                <!--end::Layout-->
            </div>
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