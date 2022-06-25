{{-- @extends('layout.default')
@section('title', 'Customer')
@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Customer</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('customers.index') }}" class="text-muted">All Customers</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">View Customer</a>
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
                <!--begin::Aside-->
                <div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <!--begin::Body-->
                        <div class="card-body pt-15">
                            <!--begin::User-->
                            <div class="text-center mb-5">
                                <div class="symbol symbol-90 symbol-circle symbol-xl-100">
                                    <div class="symbol-label"
                                        style='background-image:url("{{ Storage::disk('public')->exists('customers/' . $customer->customer_feature_img) ? asset('storage/customers/' . $customer->customer_feature_img) : asset('storage/' . $customer->customer_feature_img) }}")'>
                                    </div>
                                    <i class="symbol-badge symbol-badge-bottom bg-success"></i>
                                </div>
                                <h4 class="font-weight-bold my-2">{{ $customer->customer_name }}</h4>
                                <div class="text-muted">{{ $customer->customer_phone }}</div>
                            </div>
                            <!--end::User-->
                            <div class="separator separator-dashed my-2"></div>
                            <div class="pb-5 font-size-lg">
                                <!--begin::Details item-->
                                <div class="font-weight-bolder mt-5">Email</div>
                                <div class="text-gray-600">{{ $customer->customer_email ?? '-' }}</div>
                                <!--begin::Details item-->
                                <!--begin::Details item-->
                                <div class="font-weight-bolder mt-5">Address</div>
                                <div class="text-gray-600">
                                    {{ $customer->customer_address ?? '-' }}
                                </div>
                                <!--begin::Details item-->
                                <!--begin::Details item-->
                                <div class="font-weight-bolder mt-5">CNIC</div>
                                <div class="text-gray-600">{{ $customer->customer_cnic ?? '-' }}
                                </div>
                                <!--begin::Details item-->
                                <!--begin::Details item-->
                                <div class="font-weight-bolder mt-5">DOB</div>
                                <div class="text-gray-600">{{ $customer->customer_dob ?? '-' }}</div>
                                <!--begin::Details item-->
                                <!--begin::Details item-->
                                <div class="mt-5 px-5 d-flex justify-content-between">
                                    @if (!Auth::guard('web')->check())
                                        @can('customer_edit')
                                            <a href="{{ route('customers.edit', $customer->id) }}"
                                                class="btn btn-primary btn-shadow font-weight-bolder mr-6 px-8 font-size-sm">
                                                <span class="svg-icon">
                                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-02-01-052524/theme/html/demo1/dist/../src/media/svg/icons/Design/Edit.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                        viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path
                                                                d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                                fill="#000000" fill-rule="nonzero"
                                                                transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) " />
                                                            <rect fill="#000000" opacity="0.3" x="5" y="20"
                                                                width="15" height="2" rx="1" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>Edit</a>
                                        @endcan
                                    @else
                                        <a href="{{ route('customers.edit', $customer->id) }}"
                                            class="btn btn-primary btn-shadow font-weight-bolder mr-6 px-8 font-size-sm">
                                            <span class="svg-icon">
                                                <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-02-01-052524/theme/html/demo1/dist/../src/media/svg/icons/Design/Edit.svg--><svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                    viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path
                                                            d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                            fill="#000000" fill-rule="nonzero"
                                                            transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) " />
                                                        <rect fill="#000000" opacity="0.3" x="5" y="20"
                                                            width="15" height="2" rx="1" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>Edit</a>
                                    @endif
                                    <form action="{{ route('customers.destroy', $customer->id) }}"
                                        id="delete_item_from{{ $customer->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        @if (!Auth::guard('web')->check())
                                            @can('customer_delete')
                                                <a onclick="deleteConfirmation('delete_item_from{{ $customer->id }}')"
                                                    class="btn btn-danger btn-shadow font-weight-bolder px-8 font-size-sm">
                                                    <span class="svg-icon">
                                                        <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-02-01-052524/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24"
                                                                    height="24" />
                                                                <path
                                                                    d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z"
                                                                    fill="#000000" fill-rule="nonzero" />
                                                                <path
                                                                    d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                                    fill="#000000" opacity="0.3" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>Delete</a>
                                            @endcan
                                        @else
                                            <a onclick="deleteConfirmation('delete_item_from{{ $customer->id }}')"
                                                class="btn btn-danger btn-shadow font-weight-bolder px-8 font-size-sm">
                                                <span class="svg-icon">
                                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-02-01-052524/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24"
                                                                height="24" />
                                                            <path
                                                                d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z"
                                                                fill="#000000" fill-rule="nonzero" />
                                                            <path
                                                                d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                                fill="#000000" opacity="0.3" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>Delete</a>
                                        @endif
                                    </form>
                                </div>

                                <!--begin::Details item-->
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Aside-->
                <!--begin::Content-->
                <div class="flex-row-fluid ml-lg-8">
                    <div class="row mb-3">
                        <div class="col">
                            <!--begin::Card-->
                            <div class="card pt-4 h-md-100 mb-6 mb-md-0">
                                <!--begin::Card header-->
                                <div class="card-header border-0 py-2">
                                    <!--begin::Card title-->
                                    <div class="card-title mb-0">
                                        <h2 class="font-weight-bolder ">Reward Points</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="font-weight-bolder">
                                        <div class="d-flex align-items-center">
                                            <span class="svg-icon svg-icon-info svg-icon-2x">
                                                <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Heart.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none"
                                                        fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24" />
                                                        <path
                                                            d="M16.5,4.5 C14.8905,4.5 13.00825,6.32463215 12,7.5 C10.99175,6.32463215 9.1095,4.5 7.5,4.5 C4.651,4.5 3,6.72217984 3,9.55040872 C3,12.6834696 6,16 12,19.5 C18,16 21,12.75 21,9.75 C21,6.92177112 19.349,4.5 16.5,4.5 Z"
                                                            fill="#000000" fill-rule="nonzero" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <div class="ml-2">4,571
                                                <span class="text-muted fs-4 fw-bold">Points earned</span>
                                            </div>
                                        </div>
                                        <div class="fs-7 fw-normal text-muted">Earn reward points with every purchase.
                                        </div>
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <div class="col">
                            <!--begin::Card-->
                            <div class="card pt-4 h-md-100 mb-6 mb-md-0">
                                <!--begin::Card header-->
                                <div class="card-header border-0 py-2">
                                    <!--begin::Card title-->
                                    <div class="card-title mb-0">
                                        <h2 class="font-weight-bolder ">Reward Points</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="font-weight-bolder">
                                        <div class="d-flex align-items-center">
                                            <span class="svg-icon svg-icon-info svg-icon-2x">
                                                <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Heart.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none"
                                                        fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24" />
                                                        <path
                                                            d="M16.5,4.5 C14.8905,4.5 13.00825,6.32463215 12,7.5 C10.99175,6.32463215 9.1095,4.5 7.5,4.5 C4.651,4.5 3,6.72217984 3,9.55040872 C3,12.6834696 6,16 12,19.5 C18,16 21,12.75 21,9.75 C21,6.92177112 19.349,4.5 16.5,4.5 Z"
                                                            fill="#000000" fill-rule="nonzero" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <div class="ml-2">4,571
                                                <span class="text-muted fs-4 fw-bold">Points earned</span>
                                            </div>
                                        </div>
                                        <div class="fs-7 fw-normal text-muted">Earn reward points with every purchase.
                                        </div>
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                    </div>
                    <!--begin::Advance Table Widget 5-->
                    <div class="card card-custom gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Agents Stats</span>
                                <span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+ new
                                    members</span>
                            </h3>
                            <div class="card-toolbar">
                                <a href="#" class="btn btn-info font-weight-bolder font-size-sm">New Report</a>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-0">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-head-custom table-vertical-center"
                                    id="kt_advance_table_widget_2">
                                    <thead>
                                        <tr class="text-uppercase">
                                            <th class="pl-0" style="width: 40px">
                                                <label class="checkbox checkbox-lg checkbox-inline mr-2">
                                                    <input type="checkbox" value="1">
                                                    <span></span>
                                                </label>
                                            </th>
                                            <th class="pl-0" style="min-width: 100px">order id</th>
                                            <th style="min-width: 120px">country</th>
                                            <th style="min-width: 150px">
                                                <span class="text-primary">Data &amp; status</span>
                                                <span class="svg-icon svg-icon-sm svg-icon-primary">
                                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Navigation/Down-2.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                            <rect fill="#000000" opacity="0.3" x="11"
                                                                y="4" width="2" height="10"
                                                                rx="1"></rect>
                                                            <path
                                                                d="M6.70710678,19.7071068 C6.31658249,20.0976311 5.68341751,20.0976311 5.29289322,19.7071068 C4.90236893,19.3165825 4.90236893,18.6834175 5.29289322,18.2928932 L11.2928932,12.2928932 C11.6714722,11.9143143 12.2810586,11.9010687 12.6757246,12.2628459 L18.6757246,17.7628459 C19.0828436,18.1360383 19.1103465,18.7686056 18.7371541,19.1757246 C18.3639617,19.5828436 17.7313944,19.6103465 17.3242754,19.2371541 L12.0300757,14.3841378 L6.70710678,19.7071068 Z"
                                                                fill="#000000" fill-rule="nonzero"
                                                                transform="translate(12.000003, 15.999999) scale(1, -1) translate(-12.000003, -15.999999)">
                                                            </path>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </th>
                                            <th style="min-width: 150px">company</th>
                                            <th style="min-width: 130px">status</th>
                                            <th class="pr-0 text-right" style="min-width: 160px">action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="pl-0 py-6">
                                                <label class="checkbox checkbox-lg checkbox-inline">
                                                    <input type="checkbox" value="1">
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td class="pl-0">
                                                <a href="#"
                                                    class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">56037-XDER</a>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">Brasil</span>
                                                <span class="text-muted font-weight-bold">Code: BR</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">05/28/2020</span>
                                                <span class="text-muted font-weight-bold">Paid</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">Intertico</span>
                                                <span class="text-muted font-weight-bold">Web, UI/UX Design</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="label label-lg label-light-primary label-inline">Approved</span>
                                            </td>
                                            <td class="pr-0 text-right">
                                                <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Settings-1.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24"
                                                                    height="24"></rect>
                                                                <path
                                                                    d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z"
                                                                    fill="#000000"></path>
                                                                <path
                                                                    d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z"
                                                                    fill="#000000" opacity="0.3"></path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                                <a href="#"
                                                    class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Write.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24"
                                                                    height="24"></rect>
                                                                <path
                                                                    d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                                    fill="#000000" fill-rule="nonzero"
                                                                    transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)">
                                                                </path>
                                                                <path
                                                                    d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                                    fill="#000000" fill-rule="nonzero" opacity="0.3">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                                <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Trash.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24"
                                                                    height="24"></rect>
                                                                <path
                                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                                    fill="#000000" fill-rule="nonzero"></path>
                                                                <path
                                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                                    fill="#000000" opacity="0.3"></path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pl-0 py-6">
                                                <label class="checkbox checkbox-lg checkbox-inline">
                                                    <input type="checkbox" value="1">
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td class="pl-0">
                                                <a href="#"
                                                    class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">05822-FXSP</a>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">Belarus</span>
                                                <span class="text-muted font-weight-bold">Code: BY</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">02/04/2020</span>
                                                <span class="text-muted font-weight-bold">Rejected</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">Agoda</span>
                                                <span class="text-muted font-weight-bold">Houses &amp; Hotels</span>
                                            </td>
                                            <td>
                                                <span class="label label-lg label-light-warning label-inline">In
                                                    Progress</span>
                                            </td>
                                            <td class="pr-0 text-right">
                                                <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Settings-1.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24"
                                                                    height="24"></rect>
                                                                <path
                                                                    d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z"
                                                                    fill="#000000"></path>
                                                                <path
                                                                    d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z"
                                                                    fill="#000000" opacity="0.3"></path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                                <a href="#"
                                                    class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Write.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24"
                                                                    height="24"></rect>
                                                                <path
                                                                    d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                                    fill="#000000" fill-rule="nonzero"
                                                                    transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)">
                                                                </path>
                                                                <path
                                                                    d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                                    fill="#000000" fill-rule="nonzero" opacity="0.3">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                                <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Trash.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24"
                                                                    height="24"></rect>
                                                                <path
                                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                                    fill="#000000" fill-rule="nonzero"></path>
                                                                <path
                                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                                    fill="#000000" opacity="0.3"></path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pl-0 py-6">
                                                <label class="checkbox checkbox-lg checkbox-inline">
                                                    <input type="checkbox" value="1">
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td class="pl-0">
                                                <a href="#"
                                                    class="text-dark-75 font-weight-bolder text-hover-primary ont-size-lg">00347-BCLQ</a>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">Phillipines</span>
                                                <span class="text-muted font-weight-bold">Code: PH</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">23/12/2020</span>
                                                <span class="text-muted font-weight-bold">Paid</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">RoadGee</span>
                                                <span class="text-muted font-weight-bold">Transportation</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="label label-lg label-light-success label-inline">Success</span>
                                            </td>
                                            <td class="pr-0 text-right">
                                                <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Settings-1.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24"
                                                                    height="24"></rect>
                                                                <path
                                                                    d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z"
                                                                    fill="#000000"></path>
                                                                <path
                                                                    d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z"
                                                                    fill="#000000" opacity="0.3"></path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                                <a href="#"
                                                    class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Write.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24"
                                                                    height="24"></rect>
                                                                <path
                                                                    d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                                    fill="#000000" fill-rule="nonzero"
                                                                    transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)">
                                                                </path>
                                                                <path
                                                                    d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                                    fill="#000000" fill-rule="nonzero" opacity="0.3">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                                <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Trash.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24"
                                                                    height="24"></rect>
                                                                <path
                                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                                    fill="#000000" fill-rule="nonzero"></path>
                                                                <path
                                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                                    fill="#000000" opacity="0.3"></path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pl-0 py-6">
                                                <label class="checkbox checkbox-lg checkbox-inline">
                                                    <input type="checkbox" value="1">
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td class="pl-0">
                                                <a href="#"
                                                    class="text-dark font-weight-bolder text-hover-primary font-size-lg">4472-QREX</a>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">Argentina</span>
                                                <span class="text-muted font-weight-bold">Code: AR</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">17/09/2021</span>
                                                <span class="text-muted font-weight-bold">Pending</span>
                                            </td>
                                            <td>
                                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">The
                                                    Hill</span>
                                                <span class="text-muted font-weight-bold">Insurance</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="label label-lg label-light-danger label-inline">Rejected</span>
                                            </td>
                                            <td class="pr-0 text-right">
                                                <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Settings-1.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24"
                                                                    height="24"></rect>
                                                                <path
                                                                    d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z"
                                                                    fill="#000000"></path>
                                                                <path
                                                                    d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z"
                                                                    fill="#000000" opacity="0.3"></path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                                <a href="#"
                                                    class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Write.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24"
                                                                    height="24"></rect>
                                                                <path
                                                                    d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                                    fill="#000000" fill-rule="nonzero"
                                                                    transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)">
                                                                </path>
                                                                <path
                                                                    d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                                    fill="#000000" fill-rule="nonzero" opacity="0.3">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                                <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Trash.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24"
                                                                    height="24"></rect>
                                                                <path
                                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                                    fill="#000000" fill-rule="nonzero"></path>
                                                                <path
                                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                                    fill="#000000" opacity="0.3"></path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--end::Table-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Advance Table Widget 5-->
                </div>
                <!--end::Content-->
            </div>
            {{-- <div class="d-flex flex-row">
                <!--begin::Layout-->
                <div class="flex-row-fluid">
                    <!--begin::Section-->
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xxl-12">
                            <!--begin::Engage Widget 14-->
                            <div class="card card-custom card-stretch gutter-b">
                                <div class="card-body p-15 pb-20">
                                    <div class="row mb-17">
                                        <div class="col-xxl-5 mb-11 mb-xxl-0">
                                            <!--begin::Image-->
                                            <div class="card card-custom card-stretch">
                                                <div class="bgi-no-repeat bgi-size-cover rounded shadow-sm min-h-265px" style="background-image: url('{{Storage::disk('public')->exists('customers/'.$customer->customer_feature_img)?asset('storage/customers/'.$customer->customer_feature_img):asset('storage/'.$customer->customer_feature_img)}}')"></div>
                                                
                                            </div>
                                            <!--end::Image-->
                                        </div>
                                        <div class="col-xxl-7 pl-xxl-11">
                                            <h2 class="font-weight-bolder text-dark mb-7" style="font-size: 32px;">{{$customer->customer_name}}</h2>
                                            <div class="d-flex">
                                                <div class="font-size-h4 text-dark-50 mr-5">Total Orders
                                                    <span class="text-info font-weight-boldest ml-2">{{$total_orders}}</span>
                                                </div>
                                                <div class="font-size-h4 mb-7 text-dark-50">Balance
                                                    <span class="text-info font-weight-boldest ml-2">PKR {{$balance->balance??'0.00'}}</span>
                                                </div>
                                            </div>
                                            <div class="line-height-xl">{{$customer->customer_description}}</div>
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <!--begin::Info-->
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Gender</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">{{$customer->customer_gender??'-'}}</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Allow Credit</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">{{$customer->allow_credit?'Yes':'No'}}</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Phone</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">{{$customer->customer_phone??'-'}}</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Email</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">{{$customer->customer_email??'-'}}</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Date of Birth</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">
                                                    {{$customer->customer_dob??'-'}}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">CNIC</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">
                                                    {{$customer->customer_cnic??'-'}}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Address</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">
                                                    {{$customer->customer_address??'-'}}
                                                </span>
                                            </div>
                                        </div>
                                       
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Created By</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">
                                                    {{$customer->employee_name}}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Created At</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">{{$customer->created_at}}</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Updated At</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">{{$customer->updated_at}}</span>
                                            </div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--begin::Buttons-->
                                    <div class="d-flex">
                                        @if (!Auth::guard('web')->check())
                                        @can('customer_edit')
                                        <a href="{{ route('customers.edit',$customer->id)}}" class="btn btn-primary btn-shadow font-weight-bolder mr-6 px-8 font-size-sm">
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
                                        <a href="{{ route('customers.edit',$customer->id)}}" class="btn btn-primary btn-shadow font-weight-bolder mr-6 px-8 font-size-sm">
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
                                        <form action="{{ route('customers.destroy',$customer->id)}}" id="delete_item_from{{$customer->id}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            @if (!Auth::guard('web')->check())
                                            @can('customer_delete')
                                            <a onclick="deleteConfirmation('delete_item_from{{$customer->id}}')" class="btn btn-danger btn-shadow font-weight-bolder px-8 font-size-sm">
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
                                            <a onclick="deleteConfirmation('delete_item_from{{$customer->id}}')" class="btn btn-danger btn-shadow font-weight-bolder px-8 font-size-sm">
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
            </div> --}}
{{-- </div> --}}
<!--end::Container-->
{{-- </div> --}}
<!--end::Entry-->
{{-- @endsection --}}



@extends('layout.default')
@section('title', 'View Customer')
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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Customer</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="{{ route('customers.index') }}" class="text-muted">Customer List</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#" class="text-muted">View Customer</a>
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
            <div class="container">
                <div class="d-flex row justify-content-center">
                    <div class="col-xl-10">
                        <!--begin:::Tabs-->
                        <ul class="nav nav-tabs border-0 font-size-lg font-weight-bold" role="tablist">
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link pb-4 active" data-bs-toggle="tab" href="#kt_customer_details"
                                    data-toggle="pill">Customer Details</a>
                            </li>
                            <!--end:::Tab item-->
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link pb-4" data-bs-toggle="tab" href="#kt_sales_history"
                                    data-toggle="pill">Sales
                                    History</a>
                            </li>
                            <!--end:::Tab item-->
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link pb-4" data-bs-toggle="tab" href="#kt_account_history"
                                    data-toggle="pill">Account History</a>
                            </li>
                            <!--end:::Tab item-->

                        </ul>
                        <!--end:::Tabs-->
                        <!--begin::Tab content-->
                        <div class="tab-content">
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade active show" id="kt_customer_details" role="tabpanel"
                                aria-labelledby="kt_customer_details">
                                <div class="card card-custom card-stretch gutter-b">
                                    <div class="card-body p-15 pb-20">
                                        <div class="row mb-17">
                                            <div class="col-xxl-3 mb-11 mb-xxl-0">
                                                <!--begin::Image-->
                                                <img class="img-thumb-lg"
                                                    src="{{ Storage::disk('public')->exists('customers/' . $customer->customer_feature_img) ? asset('storage/customers/' . $customer->customer_feature_img) : asset('storage/' . $customer->customer_feature_img) }}">
                                                <!--end::Image-->
                                            </div>
                                            <div class="col-xxl-9 pl-xxl-11">
                                                <h2 class="font-weight-bolder text-dark mb-4" style="font-size: 32px;">
                                                    {{ $customer->customer_name }}</h2>
                                                <div class="font-size-h2 mb-4 text-dark-50">Balance
                                                    <span class="text-info font-weight-boldest ml-2">
                                                        Rs
                                                        {{ App\Classes\CurrencyFormatter::get($balance->balance ?? '0.00') }}</span>
                                                </div>
                                                <div class="line-height-xl">{{ $customer->customer_description }}</div>
                                            </div>
                                        </div>
                                        <div class="row mb-6">
                                            <!--begin::Info-->
                                            <div class="col-6 col-md-4">
                                                <div class="mb-8 d-flex flex-column">
                                                    <span class="text-dark font-weight-bold mb-4">Gender</span>
                                                    <span
                                                        class="text-muted font-weight-bolder font-size-lg">{{ $customer->customer_gender ?? '-' }}</span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="mb-8 d-flex flex-column">
                                                    <span class="text-dark font-weight-bold mb-4">Allow Credit</span>
                                                    <span
                                                        class="text-muted font-weight-bolder font-size-lg">{{ $customer->allow_credit ? 'Yes' : 'No' }}</span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="mb-8 d-flex flex-column">
                                                    <span class="text-dark font-weight-bold mb-4">Phone Number</span>
                                                    <span
                                                        class="text-muted font-weight-bolder font-size-lg">{{ $customer->customer_phone ?? '-' }}</span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="mb-8 d-flex flex-column">
                                                    <span class="text-dark font-weight-bold mb-4">Email</span>
                                                    <span
                                                        class="text-muted font-weight-bolder font-size-lg">{{ $customer->customer_email ?? '-' }}</span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="mb-8 d-flex flex-column">
                                                    <span class="text-dark font-weight-bold mb-4">DOB</span>
                                                    <span class="text-muted font-weight-bolder font-size-lg">
                                                        {{ $customer->customer_dob ?? '-' }}

                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="mb-8 d-flex flex-column">
                                                    <span class="text-dark font-weight-bold mb-4">CNIC</span>
                                                    <span class="text-muted font-weight-bolder font-size-lg">
                                                        {{ $customer->customer_cnic ?? '-' }}

                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="mb-8 d-flex flex-column">
                                                    <span class="text-dark font-weight-bold mb-4">Address</span>
                                                    <span class="text-muted font-weight-bolder font-size-lg">
                                                        {{ $customer->customer_address ?? '-' }}

                                                    </span>
                                                </div>
                                            </div>


                                            <div class="col-6 col-md-4">
                                                <div class="mb-8 d-flex flex-column">
                                                    <span class="text-dark font-weight-bold mb-4">Outlet</span>
                                                    <span class="text-muted font-weight-bolder font-size-lg">

                                                        {{ $customer->outlet_title }}

                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="mb-8 d-flex flex-column">
                                                    <span class="text-dark font-weight-bold mb-4">Created By</span>
                                                    <span class="text-muted font-weight-bolder font-size-lg">
                                                        {{ $customer->employee_name }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="mb-8 d-flex flex-column">
                                                    <span class="text-dark font-weight-bold mb-4">Created At</span>
                                                    <span
                                                        class="text-muted font-weight-bolder font-size-lg">{{ date('d-m-Y h:i A', strtotime($customer->created_at)) }}</span>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="mb-8 d-flex flex-column">
                                                    <span class="text-dark font-weight-bold mb-4">Updated At</span>
                                                    <span
                                                        class="text-muted font-weight-bolder font-size-lg">{{ date('d-m-Y h:i A', strtotime($customer->updated_at)) }}</span>
                                                </div>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--begin::Buttons-->
                                        <div class="d-flex">
                                            @if (auth()->guard('web')->check() ||
                                                auth()->user()->can('customer_edit'))
                                                <a href="{{ route('customers.edit', $customer->id) }}"
                                                    class="btn btn-primary btn-shadow font-weight-bolder mr-6 px-8 font-size-sm">
                                                    <span class="svg-icon">
                                                        <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-02-01-052524/theme/html/demo1/dist/../src/media/svg/icons/Design/Edit.svg--><svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24"
                                                                    height="24" />
                                                                <path
                                                                    d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                                    fill="#000000" fill-rule="nonzero"
                                                                    transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) " />
                                                                <rect fill="#000000" opacity="0.3" x="5"
                                                                    y="20" width="15" height="2"
                                                                    rx="1" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>Edit</a>
                                            @endif
                                            @if (auth()->guard('web')->check() ||
                                                auth()->user()->can('customer_delete'))
                                                <form action="{{ route('customers.destroy', $customer->id) }}"
                                                    id="delete_item_from{{ $customer->id }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a onclick="deleteConfirmation('delete_item_from{{ $customer->id }}')"
                                                        class="btn btn-danger btn-shadow font-weight-bolder px-8 font-size-sm">
                                                        <span class="svg-icon">
                                                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-02-01-052524/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none"
                                                                    fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24"
                                                                        height="24" />
                                                                    <path
                                                                        d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z"
                                                                        fill="#000000" fill-rule="nonzero" />
                                                                    <path
                                                                        d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                                        fill="#000000" opacity="0.3" />
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>Delete</a>
                                                </form>
                                            @endif
                                        </div>
                                        <!--end::Buttons-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Tab pane-->
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade" id="kt_sales_history" role="tabpanel"
                                aria-labelledby="kt_sales_history">
                                <div class="card card-custom card-stretch gutter-b">
                                    <div class="card-body p-15">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <h2 class="mb-5">Sales History</h2>

                                                <table class="table table-head-custom">
                                                    <thead>
                                                        <th>OrderID</th>
                                                        <th>Order Date</th>
                                                        <th>Total Bill</th>
                                                        <th>Payment Type</th>

                                                    </thead>
                                                    <tbody>
                                                        @forelse ($sales_orders as $sales_order)
                                                            <tr>
                                                                <td>
                                                                    @if (auth()->guard('web')->check() ||
                                                                        auth()->user()->can('sales_order_show'))
                                                                        <a href="{{ route('sales-order-details', $sales_order->id) }}"
                                                                            target="_blank">
                                                                            {{ $sales_order->id }}
                                                                        </a>
                                                                    @else
                                                                        {{ $sales_order->id }}
                                                                    @endif

                                                                </td>
                                                                <td>
                                                                    {{ $sales_order->order_completion_date }}
                                                                </td>
                                                                <td>
                                                                    {{ $sales_order->amount_payable }}
                                                                </td>
                                                                <td>
                                                                    {{ $sales_order->payment_type_title }}
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="4" class="text-center">No Orders Found
                                                                </td>

                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Tab pane-->
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade" id="kt_account_history" role="tabpanel"
                                aria-labelledby="kt_account_history">
                                <div class="card card-custom card-stretch gutter-b">
                                    <div class="card-body p-15">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <h2 class="mb-5">Account History</h2>

                                                <table class="table table-head-custom">
                                                    <thead>
                                                        <th>Transaction ID</th>
                                                        <th>Transaction Date</th>
                                                        <th>Amount</th>
                                                        <th>Balance</th>
                                                        <th>Payment Type</th>
                                                    </thead>
                                                    <tbody>

                                                        @forelse ($customer_accounts as $customer_account)
                                                            <tr>
                                                                <td>
                                                                    @if (auth()->guard('web')->check() ||
                                                                        auth()->user()->can('customer_account_show'))
                                                                        <a href="{{ route('customer-accounts.show', $customer_account->id) }}"
                                                                            target="_blank">
                                                                            {{ $customer_account->id }}
                                                                        </a>
                                                                    @else
                                                                        {{ $customer_account->id }}
                                                                    @endif

                                                                </td>
                                                                <td>
                                                                    {{ $customer_account->payment_date }}
                                                                </td>
                                                                <td>
                                                                    {{ $customer_account->amount }}
                                                                </td>
                                                                <td>
                                                                    {{ $customer_account->balance }}
                                                                </td>
                                                                <td>
                                                                    {{ $customer_account->payment_type_title }}
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="4" class="text-center">No Orders Found
                                                                </td>

                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Tab pane-->

                        </div>
                        <!--end::Tab content-->
                    </div>

                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
@endsection
