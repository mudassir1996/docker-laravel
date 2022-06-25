@extends('layout.default')
@section('title', 'Purchase Order')

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
                                <a href="#" class="text-muted">Inventory Purchase Orders</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('purchase-orders.index')}}" class="text-muted">Purchase Orders</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#" class="text-muted">Purchase Order Details</a>
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
                    <div class="card card-custom mb-8">
                        <div class="card-body ">
                            <!-- begin: Invoice-->
                            <!-- begin: Invoice header-->
                            <div class="row justify-content-center bgi-size-cover bgi-no-repeat py-8 px-8 py-md-27 px-md-0" style="background-image: url('{{asset('media/bg/bg-6.jpg')}}')">
                                <div class="col-md-9">
                                    <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                                        <h1 class="display-4 text-white font-weight-boldest mb-10">INVOICE</h1>
                                        <div class="d-flex flex-column align-items-md-end px-0">
                                            <!--begin::Logo-->
                                            <a href="#" class="mb-5">
                                                <!-- <img src="{{asset('media/logos/logo-light.png')}}" alt="" /> -->
                                                <h1 class="display-5 text-white text-uppercase font-weight-boldest">{{$order->outlet_title}}</h1>
                                            </a>
                                            <!--end::Logo-->
                                            <span class="text-white d-flex flex-column align-items-md-end opacity-70">
                                                <span>{{$order->outlet_address}}</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="border-bottom w-100 opacity-20"></div>
                                    <div class="d-flex justify-content-between text-white pt-6">
                                        <div class="d-flex flex-column flex-root">
                                            <span class="font-weight-bolder mb-2">REQUESTED DATE</span>
                                            <span class="opacity-70 mb-3">{{$order->po_request_date??'-'}}</span>
                                            <span class="font-weight-bolder mb-2">PURCHASED DATE</span>
                                            <span class="opacity-70">{{$order->po_purchased_date=='0000-00-00'?'-':$order->po_purchased_date}}</span>
                                        </div>
                                        <div class="d-flex flex-column flex-root">
                                            <span class="font-weight-bolder mb-2">STATUS.</span>
                                            <span class="opacity-70">{{ucfirst( $order->po_status)}}</span>
                                        </div>
                                        <div class="d-flex flex-column flex-root">
                                            <span class="font-weight-bolder mb-2">INVOICE NO.</span>
                                            <span class="opacity-70">{{$order->po_number}}</span>
                                        </div>
                                        <div class="d-flex flex-column flex-root">
                                            <span class="font-weight-bolder mb-2">INVOICE FROM.</span>
                                            <span class="opacity-70">{{$order->supplier_title}}, {{$order->supplier_address}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end: Invoice header-->
                            <!-- begin: Invoice body-->
                            <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                                <div class="col-md-9">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="pl-0 font-weight-bold text-muted text-uppercase">Item</th>
                                                    <th class="text-right font-weight-bold text-muted text-uppercase">Quantity</th>
                                                    <th class="text-right font-weight-bold text-muted text-uppercase">Rate</th>
                                                    <th class="text-right font-weight-bold text-muted text-uppercase">Discount</th>
                                                    <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($order_details as $key=> $order_detail)
                                                
                                                <tr class="font-weight-boldest font-size-lg">
                                                    <td class="pl-0 pt-7">{{$order_detail->product_title}}</td>
                                                    <td class="text-right pt-7">{{$order_detail->purchased_quantity == '0' ? $order_detail->requested_quantity : $order_detail->purchased_quantity}}</td>
                                                    <td class="text-right pt-7">{{$order_detail->new_cost_price ?? $order_detail->old_cost_price}}</td>
                                                    <td class="text-right pt-7">{{$order_detail->discount_value??0.00}}</td>
                                                    <td class="text-danger pr-0 pt-7 text-right">{{$order_detail->item_total??0.00}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- end: Invoice body-->
                            <!-- begin: Invoice footer-->
                            <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0">
                                <div class="col-md-9">
                                    <div class="d-flex justify-content-between flex-column flex-md-row font-size-lg">
                                        <div class="d-flex flex-column mb-10 mb-md-0">
                                            {{-- <div class="font-weight-bolder font-size-lg mb-3">BANK TRANSFER</div>
                                            <div class="d-flex justify-content-between mb-3">
                                                <span class="mr-15 font-weight-bold">Account Name:</span>
                                                <span class="text-right">Barclays UK</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3">
                                                <span class="mr-15 font-weight-bold">Account Number:</span>
                                                <span class="text-right">1234567890934</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span class="mr-15 font-weight-bold">Code:</span>
                                                <span class="text-right">BARC0032UK</span>
                                            </div> --}}
                                        </div>
                                        <div class="d-flex flex-column text-md-right">
                                            <span class="mb-1">Total Bill</span>
                                            <span class="font-size-h4 font-weight-boldest text-danger mb-3">{{$order->total_bill??0.00}}</span>
                                            <span class="mb-1">Discount</span>
                                            <span class="font-size-h4 font-weight-boldest text-danger mb-3">{{$order->po_discount_value??0.00}}</span>
                                            <span class="font-size-xl font-weight-bolder mb-1">PAYABLE AMOUNT</span>
                                            <span class="font-size-h1 font-weight-boldest text-danger">{{$order->amount_payable??0.00}}</span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end: Invoice footer-->
                            <!-- begin: Invoice action-->
                            <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                                <div class="col-md-9">
                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-light-primary font-weight-bold" onclick="window.print();">Download Invoice</button>
                                        <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">Print Invoice</button>
                                    </div>
                                </div>
                            </div>
                            <!-- end: Invoice action-->
                            <!-- end: Invoice-->

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