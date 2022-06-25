@extends('layout.default-sales')
@section('title', 'Sales Dashboard')
@section('content')
    @php
    $premium = App\Classes\Subscriber::isPremium();
    @endphp
    <div class="d-none bg-danger text-center text-light py-3" id="return_order_msg">
        <h4 class="mb-0">This is return order</h4>
    </div>
    <div class="d-none bg-warning text-center text-light py-3" id="hold_order_msg">
        <h4 class="mb-0">This is hold order</h4>
    </div>
    <div class="content d-flex flex-column flex-column-fluid pb-0 mt-5" id="kt_content">
        <div class="d-flex flex-column-fluid ">
            <!--begin::Container-->
            <div class="container-fluid px-10">
                {{-- @include('layout.sub_message_sales') --}}
                <!--begin::Teachers-->
                <div class="row justify-content-center">
                    <div class="col-xl-5">
                        <!--begin::Card-->
                        <div class="card card-custom card-stretch gutter-b">
                            <div class="card-header card-header-tabs-line">
                                <div class="card-toolbar">
                                    <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1_2">Search By
                                                Name</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_1_3">Search By
                                                Barcode</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_1_4">
                                                Search orders
                                            </a>
                                        </li>
                                        {{-- <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2_2">Return Order</a>
                                    </li> --}}
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body px-4">
                                <!--begin::Engage Widget 15-->
                                <div class="card card-custom">
                                    <div class="card-body rounded p-0 d-flex ">
                                        <div class="tab-content w-100">
                                            <div class="tab-pane fade show active" id="kt_tab_pane_1_2" role="tabpanel">
                                                <div class="d-flex flex-column w-100 p-5" style="background-color:#DAF0FD;">
                                                    <h4 class="font-weight-bolder text-dark">Search Goods</h4>
                                                    <!--begin::Form-->
                                                    <div class="d-flex flex-center  px-4 bg-white rounded">
                                                        <span class="svg-icon svg-icon-lg svg-icon-primary">
                                                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Search.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none"
                                                                    fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24"
                                                                        height="24"></rect>
                                                                    <path
                                                                        d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                                                        fill="#000000" fill-rule="nonzero" opacity="0.3">
                                                                    </path>
                                                                    <path
                                                                        d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                                                        fill="#000000" fill-rule="nonzero"></path>
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                        <input type="text" id="search" autofocus
                                                            class="form-control border-0 font-weight-bold pl-2"
                                                            placeholder="Search Goods" autocomplete="off">
                                                    </div>
                                                    <!--end::Form-->
                                                </div>
                                                <div class="card-scroll px-4" id="my-scroll">
                                                    <table class="table nowrap" id="product_search_table">
                                                        <thead>
                                                            <tr>
                                                                <th id="scroll-table-header" width="700px">Product</th>
                                                                <th id="scroll-table-header" width="700px">Barcode</th>
                                                                <th id="scroll-table-header" width="200px">Price</th>
                                                                <th id="scroll-table-header" width="200px">In stock</th>
                                                                <th id="scroll-table-header" width="200px">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="kt_tab_pane_1_3" role="tabpanel">
                                                <div class="d-flex flex-column w-100 p-5" style="background-color:#DAF0FD;">
                                                    <h4 class="font-weight-bolder text-dark">Enter Barcode</h4>
                                                    <!--begin::Form-->
                                                    <div class="d-flex flex-center  px-4 bg-white rounded">
                                                        <span class="svg-icon svg-icon-lg svg-icon-primary">
                                                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Search.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none"
                                                                    fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24"
                                                                        height="24"></rect>
                                                                    <path
                                                                        d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                                                        fill="#000000" fill-rule="nonzero"
                                                                        opacity="0.3">
                                                                    </path>
                                                                    <path
                                                                        d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                                                        fill="#000000" fill-rule="nonzero"></path>
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                        <input type="text" id="bardcode-search" autofocus
                                                            class="form-control border-0 font-weight-bold pl-2"
                                                            placeholder="Search Goods" autocomplete="off">
                                                    </div>
                                                    <!--end::Form-->
                                                </div>
                                                <div class="card-scroll px-4" id="my-scroll">
                                                    <table class="table nowrap" id="product_search_table">
                                                        <thead>
                                                            <tr>
                                                                <th id="scroll-table-header" width="700px">Product</th>
                                                                <th id="scroll-table-header" width="700px">Barcode</th>
                                                                <th id="scroll-table-header" width="200px">Price</th>
                                                                <th id="scroll-table-header" width="200px">In stock</th>
                                                                <th id="scroll-table-header" width="200px">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="kt_tab_pane_1_4" role="tabpanel">
                                                <div class="d-flex flex-column w-100 p-5"
                                                    style="background-color:#DAF0FD;">
                                                    <h4 class="font-weight-bolder text-dark">Enter Order ID</h4>
                                                    <!--begin::Form-->
                                                    <div class="d-flex flex-center  px-4 bg-white rounded">
                                                        <span class="svg-icon svg-icon-lg svg-icon-primary">
                                                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Search.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none"
                                                                    fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24"
                                                                        height="24"></rect>
                                                                    <path
                                                                        d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                                                        fill="#000000" fill-rule="nonzero"
                                                                        opacity="0.3">
                                                                    </path>
                                                                    <path
                                                                        d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                                                        fill="#000000" fill-rule="nonzero"></path>
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                        <input type="text" id="return-search"
                                                            class="form-control border-0 font-weight-bold pl-2"
                                                            placeholder="Order ID">
                                                    </div>
                                                    <!--end::Form-->
                                                </div>
                                                <div class="card-scroll px-4" id="my-scroll">
                                                    <table class="table nowrap" id="return_orders_table">
                                                        <thead>
                                                            <tr>
                                                                <th id="scroll-table-header" width="200px">Order ID</th>
                                                                <th id="scroll-table-header" width="400px">Date</th>
                                                                <th id="scroll-table-header" width="200px">Total Bill
                                                                </th>
                                                                <th id="scroll-table-header"></th>
                                                                <th id="scroll-table-header"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($sales_orders as $sales_order)
                                                                <tr class="order_list">
                                                                    <td class="font-weight-bolder orderId align-middle">
                                                                        {{ $sales_order->id }}
                                                                    </td>
                                                                    <td class="font-weight-bolder align-middle">
                                                                        {{ date('d-m-Y', strtotime($sales_order->order_completion_date)) }}
                                                                    </td>
                                                                    <td class="font-weight-bolder align-middle">
                                                                        {{ $sales_order->amount_payable }}
                                                                    </td>
                                                                    <td class="font-weight-bolder align-middle">
                                                                        <a href="#"
                                                                            onclick="select_return_order('{{ json_encode($sales_order) }}')"
                                                                            class="btn font-weight-bolder btn-sm btn-outline-primary">Edit</a>

                                                                    </td>
                                                                    <td class="font-weight-bolder align-middle">
                                                                        <a href="#"
                                                                            class="btn font-weight-bolder btn-sm btn-outline-primary dropdown-toggle"
                                                                            data-toggle="dropdown" aria-expanded="false">
                                                                            Print
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-md py-5">
                                                                            <ul
                                                                                class="navi navi-hover navi-link-rounded-lg">
                                                                                <li class="navi-item">
                                                                                    <a class="navi-link" href="#"
                                                                                        onclick="invoiceThermal('{{ url('outlets/gen-invoice/' . $sales_order->id . '?page=a4') }}')">
                                                                                        <span
                                                                                            class="navi-text">Thermal</span>
                                                                                    </a>
                                                                                </li>
                                                                                <li class="navi-item">
                                                                                    <a class="navi-link" href="#"
                                                                                        onclick="invoiceA4('{{ url('outlets/gen-invoice/' . $sales_order->id . '?page=a4') }}')">
                                                                                        <span class="navi-text">A4</span>
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Engage Widget 15-->
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--begin::Aside-->
                    <div class="col-xl-7">
                        <!--begin::List Widget 17-->
                        <div class="card card-custom gutter-b">
                            <!--begin::Body-->
                            <div class="card-body py-5">
                                <form action="{{ route('sales.store') }}" id="sales_order_form" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row mb-0 align-items-center">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-2">
                                                <div class="input-group">
                                                    <select name="customer_id" id="customer" data-live-search="true"
                                                        data-size="5" class="form-control form-control-sm selectpicker"
                                                        {{ !$premium ? 'disabled' : '' }}>
                                                        @foreach ($customers as $customer)
                                                            @php
                                                                $selected = '';
                                                                if (strtolower($customer->customer_name) == 'walk-in customer' || strtolower($customer->customer_name) == 'walkin customer' || strtolower($customer->customer_name) == 'walk in customer') {
                                                                    $selected = 'selected';
                                                                }
                                                            @endphp

                                                            <option data-customer="{{ $customer->allow_credit }}"
                                                                {{ $selected }} value="{{ $customer->id }}">
                                                                {{ ucfirst($customer->customer_name) }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if (!$premium)
                                                        <input type="hidden" name="customer_id"
                                                            value="{{ $customers->first()->id }}" />
                                                    @endif

                                                    @if ($premium)
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary py-0" type="button"
                                                                data-toggle="modal" data-target="#customer_model">
                                                                <span class="svg-icon svg-icon-success svg-icon-2x ">
                                                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Plus.svg--><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                        width="24px" height="24px" viewBox="0 0 24 24"
                                                                        version="1.1">
                                                                        <g stroke="none" stroke-width="1" fill="none"
                                                                            fill-rule="evenodd">
                                                                            <rect x="0" y="0"
                                                                                width="24" height="24" />
                                                                            <circle fill="#000000" opacity="0.3"
                                                                                cx="12" cy="12"
                                                                                r="10" />
                                                                            <path
                                                                                d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z"
                                                                                fill="#000000" />
                                                                        </g>
                                                                    </svg>
                                                                    <!--end::Svg Icon-->
                                                                </span>
                                                            </button>
                                                        </div>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        <div class="{{ $premium ? 'col-xl-3' : 'col-xl-6' }}">
                                            <div class="form-group mb-2">
                                                <div class="input-group">
                                                    <input type="text" name="remarks" id="remarks"
                                                        class="form-control" placeholder="Remarks">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <label class="checkbox checkbox-inline checkbox-primary">
                                                                <input type="checkbox" name="remarks_print" />
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($premium)
                                            <div class="col-xl-3">
                                                <div class="form-group mb-2">
                                                    <div class="checkbox-list" id="">
                                                        <label class="checkbox checkbox-primary">
                                                            <input type="checkbox" name="send_sms_invoice" />
                                                            <span class="border border-primary"></span>
                                                            Send invoice on sms
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-scroll kt_blockui_content" id="my-scroll">
                                        <table class="table nowrap" id="product_table">
                                            <thead>
                                                <tr>
                                                    <th id="scroll-table-header" width="1000px">
                                                        Product
                                                    </th>
                                                    <th id="scroll-table-header" class="text-center" width="500px">
                                                        Price
                                                    </th>
                                                    <th id="scroll-table-header" class="text-center" width="500px">
                                                        Quantity</th>
                                                    @if (App\Classes\PosSettings::checkSetting('product_level_discount'))
                                                        <th id="scroll-table-header" class="text-center" width="500px">
                                                            Discount</th>
                                                        <th id="scroll-table-header" class="text-center" width="500px">
                                                            Discount%</th>
                                                    @endif
                                                    <th id="scroll-table-header" class="text-center">
                                                        Total
                                                    </th>
                                                    <th id="scroll-table-header"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer pb-0 px-0 pt-2">
                                        <div class="d-flex  flex-column mb-md-0">
                                            <!-- <div class="font-weight-bolder font-size-lg mb-3">BANK TRANSFER</div> -->
                                            <div class="d-flex justify-content-between mb-1  bg-light-success p-3">
                                                <span class="font-weight-bold">Total Items:
                                                    <span class="ml-2"><span id="total-items">0</span> ( <span
                                                            id="total-quantities">0.00</span> )</span>
                                                </span>

                                                @if (App\Classes\PosSettings::checkSetting('bill_level_discount'))
                                                    <span class="font-weight-bold">Discount ( <span
                                                            id="main_discount_label">0</span>% )
                                                        <a href="#" class="font-weight-bolder text-primary "
                                                            id="edit_discount">Edit</a>
                                                    </span>
                                                @endif

                                                <span class="font-weight-bold">Tax ( <span id="tax">0</span>% )
                                                    <a href="#" class="font-weight-bolder text-primary "
                                                        id="edit_tax">Edit</a>
                                                </span>
                                                <span class="font-weight-bold">Total:
                                                    <span id="sub-total" class="ml-2 font-weight-bolder">0.00</span>
                                                </span>
                                                <input type="hidden" name="total_bill" id="total_bill">
                                            </div>
                                            @if (App\Classes\PosSettings::checkSetting('bill_level_discount'))
                                                <div class="form-group row mb-1" id="dis_fields" style="display: none;">
                                                    <div class="col-xl-6 mb-md-0 mb-1">
                                                        <!-- <input type="number" id="main_discount" value="0" placeholder="Discount Value" class="form-control"> -->
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <!-- <span class="input-group-text">$</span> -->
                                                                <span class="input-group-text">Discount</span>
                                                            </div>
                                                            <input type="number" name="so_discount_value"
                                                                id="main_discount" value="0"
                                                                placeholder="Discount Value" class="form-control"
                                                                aria-label="Amount (to the nearest dollar)" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Discount %</span>
                                                            </div>
                                                            <input type="number" max="100"
                                                                name="so_discount_percentage" id="main_discount_per"
                                                                value="0" placeholder="Discount Percentage"
                                                                class="form-control"
                                                                aria-label="Amount (to the nearest dollar)" />
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="form-group row mb-1" id="tax_fields" style="display: none;">
                                                <div class="col-xl-6 mb-md-0 mb-1">

                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                            <span class="input-group-text">Tax</span>
                                                        </div>
                                                        <input type="number" name="so_tax_value" id="tax_value"
                                                            value="0" placeholder="Tax Value" class="form-control"
                                                            aria-label="Amount (to the nearest dollar)" />
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Tax %</span>
                                                        </div>
                                                        <input type="number" name="so_tax_percentage" id="tax_per"
                                                            value="0" placeholder="Tax Percentage"
                                                            class="form-control"
                                                            aria-label="Amount (to the nearest dollar)" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex align-items-center justify-content-between bg-light-info p-2">
                                                <span class="h4 m-0">Total Payable:
                                                    <a href="#" class="h6 text-primary" id="pay">Payment
                                                        Type</a>
                                                </span>
                                                <div class="checkbox-list" style="display: none;" id="change_checkbox">
                                                    <label class="checkbox checkbox-primary">
                                                        <input type="checkbox" name="change_to_customer_account" />
                                                        <span class="border border-primary"></span>
                                                        Change Back to customer account
                                                    </label>
                                                </div>
                                                <span class="h1 m-0" id="grand-total">0.00</span>
                                                <input type="hidden" name="grand_total" id="amount_payable"
                                                    value="0">
                                            </div>
                                            <div class="form-group row mb-0 mt-2" id="pay_fields" style="display: none;">
                                                <div class="col-xl-6 mt-1">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <!-- <span class="input-group-text">$</span> -->
                                                            <span class="input-group-text">Payment Type</span>
                                                        </div>
                                                        <select class="form-control" id="payment_type_dropdown"
                                                            name="payment_type">
                                                            {{-- <option value="">Select Payment Type</option> --}}
                                                            @foreach ($payment_types as $payment_type)
                                                                <option value="{{ $payment_type->id }}"
                                                                    data-value="{{ $payment_type->value }}"
                                                                    {{ $payment_type->value == 0 ? 'selected' : '' }}>
                                                                    {{ $payment_type->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 mt-1">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend ">
                                                            <!-- <span class="input-group-text">$</span> -->
                                                            <span class="input-group-text">Payment Method</span>
                                                        </div>
                                                        <select name="payment_method_id" id="payment_method_dropdown"
                                                            class="form-control">
                                                            {{-- <option value="">Select Payment Type First</option> --}}
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-6 mb-md-0 mt-2" id="paid_field">
                                                <!-- <input type="number" id="main_discount" value="0" placeholder="Discount Value" class="form-control"> -->
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <!-- <span class="input-group-text">$</span> -->
                                                        <span class="input-group-text">Paid</span>
                                                    </div>
                                                    <input type="number" min="0" name="amount_paid"
                                                        id="amount_paid" placeholder="Paid" autocomplete="No"
                                                        class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-xl-6 mt-2" id="change_field">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Change Back</span>
                                                    </div>
                                                    <input type="number" name="change_back" id="change_back" readonly
                                                        placeholder="Change Back" class="form-control"
                                                        aria-label="Amount (to the nearest dollar)" />
                                                </div>
                                            </div>
                                            <div class="col-xl-4 mt-2">
                                                <a href="#"
                                                    class="btn btn-outline-danger font-weight-bolder py-3 w-100"
                                                    id="cancel">Cancel</a>
                                            </div>
                                            <div class="col-xl-4 mt-2">
                                                <!-- <button type="button" id="hold" class="btn btn-outline-warning font-weight-bolder w-75 py-3">Hold</button> -->
                                                <div class="btn-group w-100">
                                                    <button type="button" id="hold"
                                                        class="btn btn-outline-warning font-weight-bolder w-75 py-3">Hold</button>
                                                    <button type="button"
                                                        class="btn btn-outline-warning dropdown-toggle dropdown-toggle-split"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a href="#" class="dropdown-item" id="view-hold-order">View
                                                            Orders</a>
                                                    </div>
                                                </div>
                                                <!-- <a href="#" class="btn btn-outline-warning font-weight-bolder py-3 w-100" id="hold">Hold</a> -->
                                            </div>
                                            <div class="col-xl-4 mt-2">
                                                <a href="#"
                                                    class="btn btn-outline-success font-weight-bolder py-3 w-100"
                                                    id="payment">Payment</a>
                                            </div>
                                            <input type="hidden" name="profit_value" value="0">
                                            <input type="hidden" name="profit_percentage" value="0">
                                            <input type="hidden" name="so_status">
                                            <input type="hidden" name="order_id" id="order_id" value="0">
                                            <input type="hidden" name="order_type" id="order_type" value="">
                                            <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                                            <input type="hidden" name="created_by"
                                                value="{{ session('employee_id') }}">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::List Widget 17-->
                    </div>
                    <!--end::Aside-->
                </div>
                <!--end::Teachers-->
            </div>
            <!--end::Container-->
        </div>
    </div>

    <!-- Model -->
    @if ($premium)
        <div class="modal fade" id="customer_model" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form id="add_customer_form" class="add_customer">
                        <div class="modal-header ">
                            <h5 class="modal-title" id="customer_model">Add Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Customer Name*</label>
                                <input type="text" class="form-control" name="customer_name"
                                    placeholder="Customer Name" />
                            </div>
                            <div class="form-group">
                                <label>Customer Phone</label>
                                <input type="text" class="form-control" name="customer_phone"
                                    placeholder="Customer Phone" />
                            </div>
                            <div class="form-group">
                                <label>Customer Address</label>
                                <input type="text" class="form-control" name="customer_address"
                                    placeholder="Customer Address" />
                            </div>
                            <div class="form-group ">
                                <label class="col-12 col-form-label">Allow Credit Purchases</label>
                                <div class="col-12">
                                    <span class="switch switch-outline switch-icon switch-success">
                                        <label>
                                            <input type="checkbox" name="allow_credit"
                                                {{ old('allow_credit') == 1 ? 'checked' : '' }} value="1" />
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                            <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                            <input type="hidden" name="created_by" value="{{ session('employee_id') }}">
                        </div>
                        <div class="modal-footer py-3">
                            <span id="customer_added"></span>
                            <button type="submit" class="btn btn-primary btn-shadow px-12"
                                id="btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- On hold orders Model -->
    <div class="modal fade" id="hold_order_model" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title" id="customer_model">Orders On Hold</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <table class="table table-separate nowrap table-head-custom table-checkable hold-orders-table">
                        <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Customer Name</th>
                                <th>Order Date</th>
                                <th>Total Bill</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- Scripts Section --}}

@section('scripts')
    {{-- Products Data --}}
    <script src="{{ asset('js/products/page.js') }}"></script>
    <script src="{{ asset('js/sales/sales2.js') }}"></script>
    <script>
        @if (App\Classes\PosSettings::checkSetting('edit_retail_price'))
            allowRetailEdit = true;
        @endif
        @if (App\Classes\PosSettings::checkSetting('product_level_discount'))
            allowProductLevelDiscount = true;
        @endif
    </script>
    <script>
        $(document).ready(function() {
            old_method = "{{ old('payment_method_id') }}";
            var selected = '';
            var typeID = $('#payment_type_dropdown').val();
            if (typeID) {
                $.ajax({
                    url: "{{ url('get-payment-method') }}?payment_type_id=" + typeID,
                    type: "Get",
                    success: function(res) {
                        if (res) {
                            $("#payment_method_dropdown").empty();
                            $.each(res, function(key, value) {
                                let selected = '';
                                if (old_method == value) {
                                    selected = 'selected';
                                } else if (key == 'Cash') {
                                    selected = 'selected';
                                }
                                $("#payment_method_dropdown").append(
                                    '<option ' + selected + ' value="' + value + '">' +
                                    key +
                                    '</option>');
                            });
                        } else {
                            $("#payment_method_dropdown").empty();
                        }
                    }
                });
            } else {
                $("#payment_method_dropdown").empty();
            }
        });
        $('#payment_type_dropdown').change(function() {
            var typeID = $(this).val();
            if (typeID) {
                $.ajax({
                    url: "{{ url('get-payment-method') }}?payment_type_id=" + typeID,
                    type: "Get",
                    success: function(res) {
                        if (res) {
                            $("#payment_method_dropdown").empty();
                            $.each(res, function(key, value) {
                                $("#payment_method_dropdown").append('<option value="' + value +
                                    '">' + key +
                                    '</option>');
                            });
                        } else {
                            $("#payment_method_dropdown").empty();
                            $("#payment_method_dropdown").append(
                                '<option value="">Select Payment Type First</option>');
                            $("#payment_method_dropdown").val("");
                        }
                    }
                });
            } else {
                $("#payment_method_dropdown").empty();
                $("#payment_method_dropdown").append('<option value="">Select Payment Type First</option>');
                $("#payment_method_dropdown").val("");
            }
        });
    </script>
    <script>
        function invoiceA4(url) {
            a4Window = window.open(url, '_blank', 'resizable=0,width=400,height=600');
        }

        function invoiceThermal(url) {
            thermalWindow = window.open(url, '_blank', 'resizable=0,width=400,height=600');
        }
    </script>
    @if (request()->order_id)
        @php
            $order = $sales_orders->where('id', request()->order_id)->first();
        @endphp
        <script>
            var order = "{{ json_encode($order) }}";
            select_return_order(order);
        </script>
    @endif
@endsection
