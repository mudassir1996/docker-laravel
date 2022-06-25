@extends('layout.default')
@section('title', 'View Transaction')
@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Customer Transaction</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{route('customer-accounts.index')}}" class="text-muted">All Transactions</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">View Transaction</a>
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

                                        <div class="col-xxl-12 ">
                                            <h2 class="font-weight-bolder text-dark mb-7" style="font-size: 32px;">
                                                {{$customer_account->customer_name}}
                                            </h2>
                                            <div class="font-size-h2 mb-7 text-dark-50">Payment
                                                <span class="text-info font-weight-boldest ml-2">PKR {{$customer_account->amount}}</span>
                                            </div>
                                            <div class="line-height-xl">{{$customer_account->description}}</div>
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <!--begin::Info-->
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Payment Method</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">
                                                    {{$customer_account->payment_title}}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Payment Type</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">
                                                    {{ ucfirst($customer_account->payment_type_title) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Payment Date</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">{{$customer_account->payment_date}}</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Order ID</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">{{$customer_account->order_id}}</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Created By</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">
                                                    {{$customer_account->employee_name}}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Created At</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">{{$customer_account->created_at}}</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Updated At</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">{{$customer_account->updated_at}}</span>
                                            </div>
                                        </div>
                                        <!--end::Info-->
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
@endsection