@extends('layout.default')
@section('title', 'Sales Invoice')
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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Sales</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="{{ route('sales-orders') }}" class="text-muted">Sales Orders</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#" class="text-muted">Sales Invoice</a>
                            </li>
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->
                <div class="d-flex align-items-center">

                    <div class="dropdown dropdown-inline">
                        <a href="#" class="btn btn-light-primary font-weight-bold dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false">
                            <span class="svg-icon">
                                <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Devices\Printer.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path
                                            d="M16,17 L16,21 C16,21.5522847 15.5522847,22 15,22 L9,22 C8.44771525,22 8,21.5522847 8,21 L8,17 L5,17 C3.8954305,17 3,16.1045695 3,15 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,15 C21,16.1045695 20.1045695,17 19,17 L16,17 Z M17.5,11 C18.3284271,11 19,10.3284271 19,9.5 C19,8.67157288 18.3284271,8 17.5,8 C16.6715729,8 16,8.67157288 16,9.5 C16,10.3284271 16.6715729,11 17.5,11 Z M10,14 L10,20 L14,20 L14,14 L10,14 Z"
                                            fill="#000000" />
                                        <rect fill="#000000" opacity="0.3" x="8" y="2" width="8" height="2" rx="1" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span> Print
                        </a>
                        <div class="dropdown-menu dropdown-menu-md py-5">
                            <ul class="navi navi-hover navi-link-rounded-lg">
                                <li class="navi-item">
                                    <a class="navi-link" href="#" onclick="invoiceThermal()">
                                        <span class="navi-text">Thermal</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a class="navi-link" href="#" onclick="invoiceA4()">
                                        <span class="navi-text">A4</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid px-0">
                <!--begin::Teachers-->
                <div class="d-flex  justify-content-center flex-row">
                    <!--begin::Content-->
                    <div class="col-12 ml-lg-8" id="invoice">
                        <!--begin::Card-->
                        <div class="card card-custom">
                            <div class="card-body border border-dark py-0 ">
                                <!--begin::Layout-->
                                <div class="d-flex flex-column flex-xl-row">
                                    <!--begin::Content-->
                                    <div class="flex-lg-row-fluid me-xl-18 mb-10 mb-xl-0">
                                        <!--begin::Invoice 2 content-->
                                        <div class="mt-8">
                                            <!--begin::Top-->
                                            <div class="d-flex justify-content-center pb-4">
                                                <!--begin::Logo-->

                                                @php
                                                    Storage::disk('public')->exists('outlets/' . $sales_order->outlet_feature_img) ? ($image = asset('storage/outlets/' . $sales_order->outlet_feature_img)) : ($image = '');
                                                @endphp

                                                @if ($image != '')
                                                    <img src="{{ $image }}" width="200px">
                                                @else
                                                    <h1>{{ $sales_order->outlet_title }}</h1>
                                                @endif

                                                <!--end::Logo-->
                                            </div>
                                            <!--end::Top-->
                                            <!--begin::Top-->
                                            <div class="d-flex justify-content-center">
                                                <div class="font-weight-bolder text-center font-size-h5 text-dark">
                                                    {{ $sales_order->outlet_title }}, {{ $sales_order->outlet_address }}
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="text-center font-size-lg text-dark">
                                                    Mobile: {{ $sales_order->outlet_phone }}
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center pb-5">
                                                <div class="text-center font-size-lg text-dark">
                                                    {{ $sales_order->outlet_slogan }}
                                                </div>
                                            </div>
                                            <!--end::Top-->
                                            <!--begin::Wrapper-->
                                            <div class="m-0 ">
                                                <!--begin::Label-->
                                                <div class="font-weight-bolder mt-2 font-size-h4 text-dark mb-8">Invoice
                                                    #{{ $sales_order->id }}</div>
                                                <!--end::Label-->
                                                <!--begin::Row-->
                                                <div class="row justify-content-between mb-5">
                                                    <!--end::Col-->
                                                    <div class="col-sm-4">
                                                        <!--end::Label-->
                                                        <div class="font-weight-bold font-size-sm text-dark-50 ">Issue Date:
                                                        </div>
                                                        <!--end::Label-->
                                                        <!--end::Col-->
                                                        <div class="font-weight-bolder font-size-sm text-dark-75">
                                                            {{ Carbon\Carbon::now() }}</div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--end::Col-->
                                                    <div class="col-sm-4">
                                                        <!--end::Label-->
                                                        <div class="font-weight-bold font-size-sm text-dark-50">Customer
                                                            Name:</div>
                                                        <!--end::Label-->
                                                        <!--end::Col-->
                                                        <div class="font-weight-bolder font-size-sm text-dark-75">
                                                            {{ $sales_order->customer_name ?? 'Walk-in' }}</div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--end::Col-->
                                                    <div class="col-sm-4">
                                                        <!--end::Label-->
                                                        <div class="font-weight-bold font-size-sm text-dark-50">Customer
                                                            Phone:</div>
                                                        <!--end::Label-->
                                                        <!--end::Col-->
                                                        <div class="font-weight-bolder font-size-sm text-dark-75">
                                                            {{ $sales_order->customer_phone ?? '-' }}</div>
                                                        <!--end::Col-->
                                                    </div>

                                                </div>
                                                <!--end::Row-->
                                                <!--begin::Row-->
                                                <div class="row justify-content-between mb-5">
                                                    <!--end::Col-->
                                                    <div class="col-sm-4">
                                                        <!--end::Label-->
                                                        <div class="font-weight-bold font-size-sm text-dark-50 ">Payment
                                                            Type:</div>
                                                        <!--end::Label-->
                                                        <!--end::Col-->
                                                        <div class="font-weight-bolder font-size-sm text-dark-75">
                                                            {{ ucfirst($sales_order->payment_type_title) }}</div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--end::Col-->
                                                    <div class="col-sm-4">
                                                        <!--end::Label-->
                                                        <div class="font-weight-bold font-size-sm text-dark-50">Paid Method:
                                                        </div>
                                                        <!--end::Label-->
                                                        <!--end::Info-->
                                                        <div class="font-weight-bolder font-size-sm text-dark-75">
                                                            {{ ucfirst($sales_order->payment_title) }}</div>
                                                        <!--end::Info-->
                                                    </div>
                                                    <!--end::Col-->


                                                </div>
                                                <!--end::Row-->
                                                <!--begin::Content-->
                                                <div class="flex-grow-1">
                                                    <!--begin::Table-->
                                                    <div class="">
                                                        <table class="table table-bordered mb-9">
                                                            <thead>
                                                                <tr class="font-size-lg font-weight-bolder">
                                                                    <th class="pb-2">#</th>
                                                                    <th class="min-w-80px  pb-2">Description</th>
                                                                    <th class="min-w-80px text-end pb-2">Price</th>
                                                                    <th class="min-w-70px text-end pb-2">Qty.</th>
                                                                    <th class="min-w-70px text-end pb-2">Discount</th>
                                                                    <th class="min-w-50px text-end pb-2">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($order_details as $id => $order_detail)
                                                                    <tr class="font-size-sm ">
                                                                        <td class="align-middle py-1">{{ $id + 1 }}
                                                                        </td>
                                                                        <td class="align-middle max-w-80px py-1">
                                                                            {{ $order_detail->product_title }}
                                                                        </td>
                                                                        <td class="align-middle py-1">
                                                                            {{ $order_detail->retail_price }}</td>
                                                                        <td class="align-middle py-1">
                                                                            {{ $order_detail->quantity }}</td>
                                                                        <td class="align-middle py-1">
                                                                            {{ $order_detail->discount_value }}</td>
                                                                        <td class="align-middle py-1">
                                                                            {{ $order_detail->amount_payable }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!--end::Table-->
                                                    <!--begin::Container-->
                                                    <div class="d-flex justify-content-end h-100">

                                                        <!--begin::Section-->
                                                        <div class="col-7 p-0">
                                                            <table>
                                                                <thead>
                                                                    <tr class="font-size-h4">
                                                                        <th class="align-middle py-1">Remarks:</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="max-w-300px">
                                                                            Thank You for your confidence in
                                                                            {{ $sales_order->outlet_title }}
                                                                        </td>
                                                                    </tr>


                                                                </tbody>
                                                            </table>

                                                        </div>
                                                        <!--end::Section-->
                                                        <!--begin::Section-->
                                                        <div class="col-5 p-0">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr class="font-size-sm ">
                                                                        <th class="align-middle py-1">Subtotal:</th>
                                                                        <th class="align-middle py-1">
                                                                            {{ $sales_order->total_bill }}</th>
                                                                    </tr>
                                                                    <tr class="font-size-sm ">
                                                                        <th class="align-middle py-1">Discount:</th>
                                                                        <th class="align-middle py-1">
                                                                            {{ $sales_order->so_discount_value }}</th>
                                                                    </tr>
                                                                    <tr class="font-size-sm ">
                                                                        <th class="align-middle py-1">Total Bill:</th>
                                                                        <th class="align-middle py-1">
                                                                            {{ $sales_order->amount_payable }}</th>
                                                                    </tr>
                                                                    <tr class="font-size-sm ">
                                                                        <th class="align-middle py-1">Cash Paid:</th>
                                                                        <th class="align-middle py-1">
                                                                            {{ $sales_order->amount_paid }}</th>
                                                                    </tr>
                                                                    <tr class="font-size-sm ">
                                                                        <th class="align-middle py-1">Change Due:</th>
                                                                        <th class="align-middle py-1">
                                                                            {{ $sales_order->change_back }}</th>
                                                                    </tr>
                                                                    @if ($balance != '')
                                                                        <tr class="font-size-sm ">
                                                                            <th class="align-middle py-1">Previous Balance:
                                                                            </th>
                                                                            <th class="align-middle py-1">
                                                                                {{ $balance }}</th>
                                                                        </tr>
                                                                    @endif
                                                                </thead>
                                                            </table>

                                                        </div>
                                                        <!--end::Section-->
                                                    </div>
                                                    <div class="text-center mb-1">
                                                        Solution by: www.mgtos.com
                                                    </div>
                                                    <!--end::Container-->
                                                </div>
                                                <!--end::Content-->
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                        <!--end::Invoice 2 content-->
                                    </div>
                                    <!--end::Content-->

                                </div>
                                <!--end::Layout-->
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
    </div>

@endsection

{{-- Scripts Section --}}

@section('scripts')

    {{-- Datatable --}}
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js?v=7.0.5') }}"></script>
    <script src="{{ asset('js/pages/crud/datatables/basic/paginations.js?v=7.0.5') }}"></script>

    {{-- datepicker --}}
    <script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>

    {{-- custom --}}
    <script>
        function invoiceA4() {
            url = "{{ url('outlets/gen-invoice/' . $sales_order->id . '?page=a4') }}";
            a4Window = window.open(url, '_blank', 'resizable=0,width=400,height=600');
            // setTimeout(function() {
            //     a4Window.close();
            // }, 10000);
        }

        function invoiceThermal() {
            url = "{{ url('outlets/gen-invoice/' . $sales_order->id . '?page=thermal') }}";
            thermalWindow = window.open(url, '_blank', 'resizable=0,width=400,height=600');
            // setTimeout(function() {
            //     thermalWindow.close();
            // }, 10000);
        }
    </script>
@endsection
