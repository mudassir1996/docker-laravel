@extends('layout.default')
@section('title', 'Subscription Details')
@section('content')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Subscription</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Subscription Details</a>
                        </li>
                        {{-- <li class="breadcrumb-item">
                            <a href="{{route('product-stock.index')}}" class="text-muted">In Stock</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">Add Stock</a>
                        </li> --}}
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
        <div class="container-fluid mt-5">
            <!--begin::Teachers-->
            <div class="d-flex flex-row-fluid justify-content-center">
                <!--begin::Content-->
                <div class="flex-row ">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2 class="font-weight-bolder">Subscription Details</h2>
                            </div>
                            <!--begin::Card title-->
                            <!--begin::Card toolbar-->
                            {{-- <div class="card-toolbar">
                                <button data-toggle="modal" data-target="#subscription_modal" class="btn btn-primary font-weight-bolder">Upgrade Plan</button>
                            </div> --}}
                            <!--end::Card toolbar-->
                        </div>
                        <div class="card-body pt-3">
                            <!--begin::Section-->
                            <div class="mb-10">
                                <!--begin::Details-->
                                <div class="d-flex flex-wrap py-5">
                                    <!--begin::Row-->
                                    <div class="flex-equal me-5">
                                        <!--begin::Details-->
                                        <table class="table fs-6 fw-bold gs-0 gy-2 gx-2 m-0 table-borderless">
                                            <!--begin::Row-->
                                            <tbody>
                                                <tr>
                                                    <td class="text-gray-400 min-w-175px w-175px">Subscribed Plan:</td>
                                                    <td class="text-gray-800 min-w-200px">
                                                        <span class="text-primary">{{ $sub_detail->plan_title }}</span>
                                                    </td>
                                                </tr>
                                                <!--end::Row-->
                                                <!--begin::Row-->
                                                <tr>
                                                    <td class="text-gray-400">Payment Method:</td>
                                                    <td class="text-gray-800">{{ ucfirst($sub_detail->payment_method) }}
                                                    </td>
                                                </tr>
                                                <!--end::Row-->
                                                <!--begin::Row-->
                                                <tr>
                                                    <td class="text-gray-400">Subscription Start Date:</td>
                                                    <td class="text-gray-800">{{ $sub_detail->subscription_start_date }}
                                                    </td>
                                                </tr>
                                                <!--end::Row-->
                                                <!--begin::Row-->
                                                <tr>
                                                    <td class="text-gray-400">Subscription End Date:</td>
                                                    <td class="text-gray-800">{{ $sub_detail->subscription_end_date }}
                                                    </td>
                                                </tr>
                                                <!--end::Row-->
                                            </tbody>
                                        </table>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <div class="flex-equal">
                                        <!--begin::Details-->
                                        <table class="table fs-6 fw-bold gs-0 gy-2 gx-2 m-0 table-borderless">
                                            <!--begin::Row-->
                                            <tbody>
                                                <tr>
                                                    <td class="text-gray-400 min-w-175px w-175px">Subscription Status</td>
                                                    <td class="text-gray-800 min-w-200px">
                                                        <span
                                                            class="label label-{{ $sub_detail->subscription_status == 'verified' ? 'success' : 'danger' }} label-inline font-weight-lighter mr-2">{{ ucfirst($sub_detail->subscription_status) }}</span>
                                                        {{-- <span class="{{$sub_detail->subscription_status=='verified'?'text-success':'text-danger'}}">{{ucfirst($sub_detail->subscription_status)}}</span> --}}
                                                    </td>
                                                </tr>
                                                <!--end::Row-->
                                                <!--begin::Row-->
                                                <tr>
                                                    <td class="text-gray-400">Total Bill</td>
                                                    <td class="text-gray-800">PKR
                                                        {{ number_format($sub_detail->total_bill) }}</td>
                                                </tr>
                                                <!--end::Row-->
                                                <!--begin::Row-->
                                                <tr>
                                                    <td class="text-gray-400">Discount Amount:</td>
                                                    <td class="text-gray-800">PKR
                                                        {{ $sub_detail->discount_amount ?? '0.00' }}</td>
                                                </tr>
                                                <!--end::Row-->
                                                <!--begin::Row-->
                                                <tr>
                                                    <td class="text-gray-400">Paid Bill:</td>
                                                    <td class="text-gray-800">PKR
                                                        {{ number_format($sub_detail->paid_bill) }}</td>
                                                </tr>
                                                <!--end::Row-->
                                            </tbody>
                                        </table>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Section-->
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
