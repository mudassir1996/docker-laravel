@extends('layout.default')
@section('title', 'Companies')
@section('content')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Company</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">All Companies</a>
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
                                <h3 class="card-label">Company
                                    <span class="d-block text-muted pt-2 font-size-sm">All Companies</span>
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <!--begin::Dropdown-->
                                <div class="dropdown dropdown-inline mr-2">
                                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="svg-icon svg-icon-md">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path
                                                        d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                                                        fill="#000000" opacity="0.3" />
                                                    <path
                                                        d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                                                        fill="#000000" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>Export</button>
                                    <!--begin::Dropdown Menu-->
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <!--begin::Navigation-->
                                        <ul class="navi flex-column navi-hover py-2">
                                            <li
                                                class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">
                                                Choose an option:</li>
                                            <li class="navi-item">
                                                <a href="{{ route('print.companies') }}" target="_blank"
                                                    class="navi-link">
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
                                                <a href="{{ route('print.companies') }}" target="_blank"
                                                    class="navi-link">
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
                                @if (!Auth::guard('web')->check())
                                    @can('company_create')
                                        <div class="btn-group">
                                            <a type="button" href="{{ route('companies.create') }}"
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
                                                </span>New Company</a>
                                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="#" type="button" class="dropdown-item" data-toggle="modal"
                                                    data-target="#upload_model">Import companies</a>
                                                <a href="#" class="dropdown-item">Import Standard companies</a>
                                            </div>
                                        </div>
                                    @endcan
                                @else
                                    <div class="btn-group">
                                        <a type="button" href="{{ route('companies.create') }}"
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
                                            </span>New Company</a>
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="#" type="button" class="dropdown-item" data-toggle="modal"
                                                data-target="#upload_model">Import companies</a>
                                            <a href="{{ route('standard-company') }}" class="dropdown-item">Import
                                                Standard
                                                companies</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @isset($already_exists)
                            @for ($i = 0; $i < count($already_exists); $i++)
                                {{ $already_exists[$i] }}
                            @endfor
                        @endisset
                        <div class="card-body">
                            <!--begin: Datatable-->
                            <table class="table table-separate nowrap table-head-custom table-checkable"
                                id="kt_datatable_company">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Created By</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th data-priority="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$companies->isEmpty())
                                        @foreach ($companies as $company)
                                            <tr>
                                                <td>
                                                    <div class="symbol symbol-75  flex-shrink-0">
                                                        <div class="symbol-label"> <img class="h-100 w-100 align-self-end"
                                                                src="{{ Storage::disk('public')->exists('companies/' . $company->company_feature_img)? asset('storage/companies/' . $company->company_feature_img): asset('storage/placeholder.jpg') }}"
                                                                alt="{{ $company->company_title }}"> </div>
                                                    </div>
                                                </td>
                                                <td>{{ $company->company_title }}</td>
                                                <td>{{ substr($company->company_description, 0, 40) }}...</td>
                                                <td>{{ $company->company_address }}</td>
                                                <td>{{ $company->company_email }}</td>
                                                <td>{{ $company->company_phone }}</td>
                                                <td>
                                                    {{ $company->employee_name }}
                                                </td>
                                                <td>{{ $company->created_at }}</td>
                                                <td>{{ $company->updated_at }}</td>
                                                <td>
                                                    <form action="{{ route('companies.destroy', $company->id) }}"
                                                        id="delete_item_from{{ $company->id }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        @if (!Auth::guard('web')->check())
                                                            @can('company_show')
                                                                <a class="btn p-0" title="View"
                                                                    href="{{ route('companies.show', $company->id) }}">
                                                                    <i class="text-primary h3 la la-eye"></i>
                                                                </a>
                                                            @endcan

                                                            @can('company_edit')
                                                                <a class="btn p-0" title="Edit"
                                                                    href="{{ route('companies.edit', $company->id) }}">
                                                                    <i class="text-success h3 la la-edit"></i>
                                                                </a>
                                                            @endcan

                                                            @can('company_delete')
                                                                <a class="btn p-0" title="Delete"
                                                                    onclick="deleteConfirmation('delete_item_from{{ $company->id }}')"><i
                                                                        class="text-danger h3 la la-trash"></i></a>
                                                            @endcan

                                                        @else
                                                            <a class="btn p-0" title="View"
                                                                href="{{ route('companies.show', $company->id) }}">
                                                                <i class="text-primary h3 la la-eye"></i>
                                                            </a>

                                                            <a class="btn p-0" title="Edit"
                                                                href="{{ route('companies.edit', $company->id) }}">
                                                                <i class="text-success h3 la la-edit"></i>
                                                            </a>

                                                            <a class="btn p-0" title="Delete"
                                                                onclick="deleteConfirmation('delete_item_from{{ $company->id }}')"><i
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

    {{-- Company Import Model --}}
    <div class="modal fade" id="upload_model" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('companies.import') }}" enctype="multipart/form-data" method="post"
                    class="add_category">
                    @csrf
                    <div class="modal-header p-4">
                        <h6 class="modal-title" id="upload_model">Import Companies</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <p>The field labels marked with * are required input fields.</p>
                            <p>The correct column order is (company_title*, company_address, company_email, company_phone,
                                company_description) and you must follow this.</p>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label>Upload CSV File *</label>
                                    <input type="file" class="form-control pt-2" name="file" />

                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label>Sample File</label>
                                    {{-- <a href="#" class="btn btn-success btn-block btn-md">Download</a> --}}
                                    <a href="{{ route('download.company-csv') }}"
                                        class="btn btn-success btn-block font-weight-bolder">
                                        <span class="svg-icon svg-icon-md">
                                            <!--begin::Svg Icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24" />
                                                    <path
                                                        d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z"
                                                        fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                    <path
                                                        d="M14.8875071,11.8306874 L12.9310336,11.8306874 L12.9310336,9.82301606 C12.9310336,9.54687369 12.707176,9.32301606 12.4310336,9.32301606 L11.4077349,9.32301606 C11.1315925,9.32301606 10.9077349,9.54687369 10.9077349,9.82301606 L10.9077349,11.8306874 L8.9512614,11.8306874 C8.67511903,11.8306874 8.4512614,12.054545 8.4512614,12.3306874 C8.4512614,12.448999 8.49321518,12.5634776 8.56966458,12.6537723 L11.5377874,16.1594334 C11.7162223,16.3701835 12.0317191,16.3963802 12.2424692,16.2179453 C12.2635563,16.2000915 12.2831273,16.1805206 12.3009811,16.1594334 L15.2691039,12.6537723 C15.4475388,12.4430222 15.4213421,12.1275254 15.210592,11.9490905 C15.1202973,11.8726411 15.0058187,11.8306874 14.8875071,11.8306874 Z"
                                                        fill="#000000" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>Download</a>

                                </div>
                            </div>

                        </div>

                        <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                        <input type="hidden" name="created_by" value="{{ session('employee_id') }}">
                        <button class="btn btn-primary btn-shadow px-12 mt-4" id="save-category">Upload</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

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
