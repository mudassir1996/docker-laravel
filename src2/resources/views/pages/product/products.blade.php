@extends('layout.default')
@section('title', 'Products')
@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Product</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">All Products</a>
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
            <div class="row">
                @if(!$top_products->isEmpty())
                <!--begin::Aside-->
                <div class="col-md-3 col-xxl-3">
                    <!--begin::List Widget 17-->
                    <div class="card card-custom gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Latest Products</span>
                                <span class="text-muted mt-3 font-weight-bold font-size-sm">Sub heading goes here</span>
                            </h3>
                            <div class="card-toolbar">
                                <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
                                    <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ki ki-bold-more-hor"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                        <!--begin::Navigation-->
                                        <ul class="navi navi-hover py-5">
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="flaticon2-drop"></i>
                                                    </span>
                                                    <span class="navi-text">New Group</span>
                                                </a>
                                            </li>
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="flaticon2-list-3"></i>
                                                    </span>
                                                    <span class="navi-text">Contacts</span>
                                                </a>
                                            </li>
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="flaticon2-rocket-1"></i>
                                                    </span>
                                                    <span class="navi-text">Groups</span>
                                                    <span class="navi-link-badge">
                                                        <span class="label label-light-primary label-inline font-weight-bold">new</span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="flaticon2-bell-2"></i>
                                                    </span>
                                                    <span class="navi-text">Calls</span>
                                                </a>
                                            </li>
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="flaticon2-gear"></i>
                                                    </span>
                                                    <span class="navi-text">Settings</span>
                                                </a>
                                            </li>
                                            <li class="navi-separator my-3"></li>
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="flaticon2-magnifier-tool"></i>
                                                    </span>
                                                    <span class="navi-text">Help</span>
                                                </a>
                                            </li>
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="flaticon2-bell-2"></i>
                                                    </span>
                                                    <span class="navi-text">Privacy</span>
                                                    <span class="navi-link-badge">
                                                        <span class="label label-light-danger label-rounded font-weight-bold">5</span>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!--end::Navigation-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-4">
                            <!--begin::Container-->
                            <div>

                                @foreach($top_products as $id => $top_product)

                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-8">
                                    <!--begin::Symbol-->
                                    <div class="symbol mr-5 pt-1">
                                        @php
                                        Storage::disk('public')->exists('products/'.$top_product->product_feature_img)?$image=asset('storage/products/'.$top_product->product_feature_img):$image=asset('storage/'.$top_product->product_feature_img)
                                        @endphp
                                        <div class="symbol-label min-w-65px min-h-100px" style="background-image: url('{{$image}}')">
                                        </div>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Title-->
                                        <a href="{{route('products.show', $top_product->id)}}" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$top_product->product_title}}</a>
                                        <!--end::Title-->
                                        <!--begin::Text-->
                                        <span class="pb-2 pt-2">
                                            <span class="text-primary font-weight-boldest font-size-lg">{{$top_product->retail_price}}</span>
                                            <span class="text-muted ml-1 font-size-sm">(In Stock {{$top_product->units_in_stock}})</span>
                                        </span>
                                        <!--end::Text-->
                                        <!--begin::Action-->
                                        <div>
                                            @if(!Auth::guard('web')->check())

                                            @can('product_show')
                                            <a href="{{route('products.show', $top_product->id)}}">
                                                <button type="button" class="btn btn-light font-weight-bolder font-size-sm py-2">View Product</button>
                                            </a>
                                            @endcan
                                            @else
                                            <a href="{{route('products.show', $top_product->id)}}">
                                                <button type="button" class="btn btn-light font-weight-bolder font-size-sm py-2">View Product</button>
                                            </a>
                                            @endif

                                        </div>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Item-->
                                @endforeach
                            </div>

                            <!--end::Container-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::List Widget 17-->

                </div>
                <!--end::Aside-->
                @endif
                <!--begin::Content-->
                <div class="col-md-9 col-xxl-9">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-header flex-wrap py-5">
                            <div class="card-title">
                                <h3 class="card-label">Products
                                    <span class="d-block text-muted pt-2 font-size-sm">Manage Products</span>
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
                                                <a href="#" id="export_print" class="navi-link">
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
                                            <li class="navi-item">
                                                <a href="#" id="export_excel" class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="la la-file-excel-o"></i>
                                                    </span>
                                                    <span class="navi-text">Excel</span>
                                                </a>
                                            </li>
                                            <li class="navi-item">
                                                <a href="#" id="export_csv" class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="la la-file-text-o"></i>
                                                    </span>
                                                    <span class="navi-text">CSV</span>
                                                </a>
                                            </li>
                                            <li class="navi-item">
                                                <a href="#" id="export_pdf" class="navi-link">
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
                                @can('product_create')
                                <!--begin::Button-->
                                <a href="{{route('products.create')}}" class="btn btn-primary font-weight-bolder">
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
                                <a href="{{route('products.create')}}" class="btn btn-primary font-weight-bolder">
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
                        <div class="card-body">
                            <!--begin: Datatable-->
                            <table class="table table-separate table-responsive nowrap table-head-custom table-checkable" id="kt_product_table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Barcode</th>
                                        <th>Allow Half</th>
                                        <th>Status</th>
                                        <th>Category</th>
                                        <th>Company</th>
                                        <th>Created By</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!$products->isEmpty())
                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>
                                            <div class="symbol symbol-75  flex-shrink-0">
                                                <div class="symbol-label"> <img class="h-100 align-self-end" src="{{Storage::disk('public')->exists('products/'.$product->product_feature_img) ? asset('storage/products/'.$product->product_feature_img) : asset('storage/'.$product->product_feature_img)}}" alt="{{$product->product_title}}"> </div>
                                            </div>
                                        </td>
                                        <td>{{$product->product_title}}</td>
                                        <td>{{substr($product->product_description, 0, 40)}}...</td>
                                        <td>{{$product->product_barcode}}</td>
                                        <td>{{$product->product_allow_half}}</td>
                                        <td>{{$product->product_status}}</td>
                                        <td>
                                            {{$product->category_title}}
                                        </td>
                                        <td>
                                            {{$product->company_title}}
                                        </td>
                                        <td>
                                            {{$product->username}}
                                        </td>
                                        <td>{{$product->created_at}}</td>
                                        <td>{{$product->updated_at}}</td>
                                        <td>
                                            <form action="{{ route('products.destroy',$product->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                @if(!Auth::guard('web')->check())

                                                @can('product_show')
                                                <a class="btn p-0" title="View" href="{{ route('products.show',$product->id)}}">
                                                    <i class="text-primary h3 la la-eye"></i>
                                                </a>
                                                @endcan

                                                @can('product_edit')
                                                <a class="btn p-0" title="Edit" href="{{ route('products.edit',$product->id)}}">
                                                    <i class="text-success h3 la la-edit"></i>
                                                </a>
                                                @endcan

                                                @can('product_delete')
                                                <button class="btn p-0" title="Delete" type="submit"><i class="text-danger h3 la la-trash"></i></button>
                                                @endcan

                                                @else
                                                <a class="btn p-0" title="View" href="{{route('products.show', $product->id)}}">
                                                    <i class="text-primary h3 la la-eye"></i>
                                                </a>

                                                <a class="btn p-0" title="Edit" href="{{ route('products.edit',$product->id)}}">
                                                    <i class="text-success h3 la la-edit"></i>
                                                </a>

                                                <button class="btn p-0" title="Delete" type="submit"><i class="text-danger h3 la la-trash"></i></button>
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