@extends('layout.default')
@section('title', 'Outlet Registration')
@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Outlet</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">Outlet Registration</a>
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
        <div class="container-fluid">
            <div class="d-flex flex-row">
                <!--begin::Layout-->
                <div class="flex-row-fluid">
                    <!--begin::Section-->
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xxl-12">
                            <!--begin::Engage Widget 14-->
                            <div class="card card-custom card-stretch gutter-b">
                                <div class="card-body p-10 pb-10">
                                    <div class="row mb-5">
                                        <div class="col-xxl-12">
                                            <h2 class="font-weight-bolder text-dark mb-7" style="font-size: 32px;">Registration Details</h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @if($reg_detail!=NULL)
                                        <!--begin::Info-->
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Registered Name</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">{{$reg_detail->registered_name}}</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Registered Address</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">{{$reg_detail->registered_address}}</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Registration Date</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">{{$reg_detail->registration_date}}</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-12">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Description</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">{{$reg_detail->description}}</span>
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Created At</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">{{$reg_detail->created_at}}</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Updated At</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">{{$reg_detail->updated_at}}</span>
                                            </div>
                                        </div>
                                        <!--end::Info-->
                                        @else
                                        <div class="col-4 col-md-2">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Record Not Found</span>
                                                @if(!Auth::guard('web')->check())
                                                @can('outlet_registration_create')
                                                <!--begin::Button-->
                                                <a href="{{route('registration.create')}}" class="btn btn-primary font-weight-bolder">
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
                                                    </span>New Record</a>
                                                <!--end::Button-->

                                                @endcan
                                                @else
                                                <a href="{{route('registration.create')}}" class="btn btn-primary font-weight-bolder">
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
                                                    </span>New Record</a>
                                                <!--end::Button-->
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                    </div>

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
</div>
@endsection