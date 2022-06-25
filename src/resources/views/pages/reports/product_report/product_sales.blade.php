@extends('layout.default')
@section('title', 'Product Sales Orders')
@section('content')


<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">Product Sales</h5>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="/outlets/reports/product-report" class="text-muted">Product Sales Report</a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="#" class="text-muted">{{ $product->product_title }}</a>
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
            <div class="flex-row-fluid ">
                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">Product Sales Orders
                                <span class="d-block text-muted pt-2 font-size-sm">Product: {{ $product->product_title }}</span>
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
                            @can('sales_access')
                            <!--begin::Button-->
                            <a href="{{route('sales.index')}}" class="btn btn-primary font-weight-bolder">
                                <i class="fas fa-shopping-bag icon-sm"></i>POS</a>
                            <!--end::Button-->

                            @endcan
                            @else
                            <a href="{{route('sales.index')}}" class="btn btn-primary font-weight-bolder">
                                <i class="fas fa-shopping-bag icon-sm"></i>POS</a>
                            <!--end::Button-->
                            @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="kt-form kt-form--fit mb-15">
                            <div class="row mb-6">
                                <div class="col-lg-3 mb-lg-0 mb-6">
                                    <label>Order ID:</label>
                                    <input type="number" class="form-control datatable-input" id="orderIdSearch" placeholder="E.g: 1" data-col-index="0">
                                </div>
                                <div class="col-lg-3 mb-lg-0 mb-6">
                                    <label>Customer Name:</label>
                                    <input type="text" class="form-control datatable-input" id="customerNameSearch" placeholder="E.g: Joe Root" data-col-index="1">
                                </div>
                                <div class="col-lg-3 mb-lg-0 mb-6">
                                    <label>Remarks:</label>
                                    <input type="text" class="form-control datatable-input" id="remarksSearch" placeholder="E.g: Paid" data-col-index="4">
                                </div>
                            </div>
                        </form>
                        <!--begin: Datatable-->
                        <table class="table table-separate table-head-custom table-checkable nowrap" id="kt_sales_table">
                            <thead>
                                <tr>
                                    <th data-priority="1">ID</th>
                                    <th>Customer</th>
                                    <th>Total Bill</th>
                                    <th>Discount Value</th>
                                    <th>Remarks</th>
                                    <th>Tax Value</th>
                                    <th>Tax Percentage</th>
                                    <th>Amount Payable</th>
                                    <th>Amount Paid</th>
                                    <th>Change Back</th>
                                    <th>Profit Value</th>
                                    <th>Profit Percentage</th>
                                    <th>Status</th>
                                    <th>Payment Type</th>
                                    <th>Payment Method</th>
                                    <th>Discount Percentage</th>
                                    <th>Order Completion Date</th>
                                    <th>Processing Person</th>
                                    <th>Created By</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th data-priority="2">View</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($product_sales_orders as $sales_order)
                                <tr>
                                    <td>
                                        {{$sales_order->id}}
                                    </td>
                                    <td>
                                        {{$sales_order->customer_name??'Walk-in Client'}}
                                    </td>
                                    <td>
                                        {{$sales_order->total_bill}}
                                    </td>
                                    <td>
                                        {{$sales_order->so_discount_value}}
                                    </td>
                                    <td>
                                        {{$sales_order->remarks??'-'}}
                                    </td>
                                    <td>
                                        {{$sales_order->so_tax_value}}
                                    </td>
                                    <td>
                                        {{$sales_order->so_tax_percentage}}
                                    </td>
                                    <td>
                                        {{$sales_order->amount_payable}}
                                    </td>
                                    <td>
                                        {{$sales_order->amount_paid}}
                                    </td>
                                    <td>
                                        {{$sales_order->change_back}}
                                    </td>
                                    <td>
                                        {{$sales_order->profit_value}}
                                    </td>
                                    <td>
                                        {{$sales_order->profit_percentage}}
                                    </td>
                                    <td>
                                        {{$sales_order->so_status}}
                                    </td>
                                    <td>
                                        {{$sales_order->payment_type}}
                                    </td>
                                    <td>
                                        {{$sales_order->payment_title}}
                                    </td>
                                    <td>
                                        {{$sales_order->so_discount_percentage}}
                                    </td>
                                    <td>
                                        {{$sales_order->order_completion_date}}
                                    </td>
                                    <td>
                                        {{$sales_order->employee_name}}
                                    </td>
                                    <td>
                                        {{$sales_order->employee_name}}
                                    </td>
                                    <td>
                                        {{$sales_order->created_at}}
                                    </td>
                                    <td>
                                        {{$sales_order->updated_at}}
                                    </td>
                                    <td>
                                        @if(!Auth::guard('web')->check())
                                        @can('sales_order_show')
                                        <a class="btn p-0" title="View" href="{{ route('sales-order-details',$sales_order->id)}}">
                                            <i class="text-primary h3 la la-eye"></i>
                                        </a>
                                        @endcan
                                        @else
                                        <a class="btn p-0" title="View" href="{{ route('sales-order-details',$sales_order->id)}}">
                                            <i class="text-primary h3 la la-eye"></i>
                                        </a>
                                        @endif
                                    </td>


                                </tr>
                                @empty
                                @endforelse

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
