@extends('layout.default-sales')
@section('title', 'Sales Dashboard')
@section('styles')
    <style>
        .product_items:hover {
            box-shadow: 2px 3px 10px rgba(0, 0, 0, 0.100);
            cursor: pointer;
            transition: all 0.2s;
        }

        .product_items {
            border: 1px solid #e4e6fc;

        }

        #custom-scroll::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0);
            border-radius: 10px;
            background-color: #F5F5F5;
        }

        #custom-scroll::-webkit-scrollbar {
            height: 8px !important;
            /* width: 8px !important; */
            background-color: #F5F5F5;
        }

        #custom-scroll::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px #999;
            background-color: #999;
        }

    </style>
@endsection
@section('content')



    {{-- {{gettype(session('url'))}} --}}
    {{-- {{session('url')}} --}}
    {{-- @if (session()->has('url'))
   <script>
        var url = "{{Session::get('url')}}";
        window.open(url, '_blank', 'width=320');
    </script>
@endif --}}


    <div class="content d-flex flex-column flex-column-fluid pb-0" id="kt_content">

        <div class="d-flex flex-column-fluid ">
            <!--begin::Container-->
            <div class="container-fluid px-10">

                <!--begin::Teachers-->
                <div class="row justify-content-center">
                    <div class="col-xl-5">
                        {{-- <div class="container" id="categories-contianer">
                            <div class="row" id="categories-area"></div>
                        </div> --}}
                        <!--begin::Card-->
                        <div class="card card-custom card-stretch gutter-b">

                            <ul class="tab nav nav-tabs" style="overflow-x:auto; flex-wrap:nowrap" id="custom-scroll">
                                {{-- <li class="nav-item"> --}}
                                <button class="tablinks col-3 py-2 btn btn-secondary active ml-3 mb-3 mt-2"
                                    onclick="openTab(event, 'All Products')">All</button>
                                {{-- </li> --}}
                                @foreach ($categories as $category)
                                    {{-- <li class="nav-item" style="display:inline-block !important;"> --}}
                                    <button class="tablinks col-4 py-2 ml-2 mb-3 mt-2 btn btn-secondary"
                                        style="display:inline-block !important;"
                                        onclick="openTab(event, '{{ $category->category_title }}')">{{ $category->category_title }}</button>
                                    {{-- </li> --}}
                                @endforeach
                                {{-- <div class="ps__rail-y" style="top: 0px; height: 200px; right: -2px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 40px;"></div></div> --}}
                            </ul>

                            {{-- <div class="row mb-5 mt-5">
                                <button class="btn btn-primary ml-5 mb-3">All Products</button>
                                @foreach ($categories as $category)
                                    <button class="btn btn-success ml-5 mb-3" id="{{ $category->category_title }}"
                                        value="{{ $category->id }}" onclick="get_products(this)">{{ $category->category_title }}</button>
                                @endforeach
                            </div> --}}

                            {{-- <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" role="tab" data-toggle="tab"
                                        href="#all-products">All Products</a>
                                </li>
                                @foreach ($categories as $category)
                                    <li class="nav-item">
                                        <a class="nav-link mb-3" role="tab" data-toggle="tab"
                                            href="#{{ $category->category_title }}">{{ $category->category_title }}</a>
                                    </li>

                                @endforeach

                            </ul> --}}

                            <div class="card-body card-scroll" id="my-scroll">
                                <div class="tabcontent" id="All Products">
                                    <div class="row">

                                        @foreach ($products as $product)
                                            <div class="col-4 text-center product_items p-4" id="{{ $product->id }}"
                                                onclick="addToCart(this)" class="products">
                                                <p>{{ $product->units_in_stock }} </p>
                                                @if ($product->product_feature_img == 'placeholder.jpg')
                                                    <img src="/storage/{{ $product->product_feature_img }}" height="100px"
                                                        width="100px">
                                                @else
                                                    <img src="/storage/products/{{ $product->product_feature_img }}"
                                                        height="100px" width="100px">
                                                @endif
                                                <br>
                                                <span style="font-weight: bold">{{ $product->product_title }}</span><br>
                                                <span style="color:#0f2391">{{ $product->retail_price }} PKR</span><br>


                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @foreach ($categories as $category)
                                    <div class="tabcontent" id="{{ $category->category_title }}" hidden>
                                        <div class="row">
                                            @foreach ($products as $product)
                                                @if ($product->category_id == $category->id)
                                                    <div class="col-4 text-center product_items p-4"
                                                        id="{{ $product->id }}" onclick="addToCart(this)"
                                                        class="products">
                                                        @if ($product->product_feature_img == 'placeholder.jpg')
                                                            <img src="/storage/{{ $product->product_feature_img }}"
                                                                height="100px" width="100px">
                                                        @else
                                                            <img src="/storage/products/{{ $product->product_feature_img }}"
                                                                height="100px" width="100px">
                                                        @endif
                                                        <br>
                                                        <span
                                                            style="font-weight: bold">{{ $product->product_title }}</span><br>
                                                        <span style="color:#0f2391">{{ $product->retail_price }}
                                                            PKR</span>

                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                                {{-- <div class="tab-content">
                                    <div class="row" id="all-products" role="tabpanel" class="tab-pane" class="active">

                                        @foreach ($products as $product)

                                            <div class="col-4 text-center mb-8 product_items" id="{{ $product->id }}"
                                                onclick="addToCart(this)" class="products">

                                                <img src="/storage/products/{{ $product->product_feature_img }}"
                                                    height="100px" width="100px">

                                                <br>
                                                <span style="font-weight: bold">{{ $product->product_title }}</span><br>
                                                <span style="color:#0f2391">{{ $product->retail_price }} PKR</span>

                                            </div>

                                        @endforeach
                                    </div>
                                    @foreach ($categories as $category)
                                    <div class="row" id="{{ $category->category_title }}" role="tabpanel"
                                        class="tab-pane" class="active">

                                        @foreach ($products as $product)

                                            @if ($product->category_id == $category->id)
                                            <div class="col-4 text-center mb-8 product_items" id="{{ $product->id }}"
                                                onclick="addToCart(this)" class="products">

                                                <img src="/storage/products/{{ $product->product_feature_img }}"
                                                    height="100px" width="100px">

                                                <br>
                                                <span
                                                    style="font-weight: bold">{{ $product->product_title }}</span><br>
                                                <span style="color:#0f2391">{{ $product->retail_price }} PKR</span>

                                            </div>
                                            @endif

                                        @endforeach
                                    </div>
                                @endforeach
                                </div> --}}
                            </div>



                        </div>
                        <!--end::Card-->
                    </div>

                    <!--begin::Aside-->

                    <div class="col-xl-7">
                        <!--begin::List Widget 17-->
                        <div class="card card-custom gutter-b">
                            <!--begin::Header-->
                            <!--end::Header-->
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
                                                        class="form-control form-control-sm  selectpicker">
                                                        {{-- <option data-customer="0" value="0">Walk-In Client</option> --}}
                                                        @foreach ($customers as $customer)
                                                            <option data-customer="{{ $customer->allow_credit }}"
                                                                value="{{ $customer->id }}">
                                                                {{ $customer->customer_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary py-0" type="button"
                                                            data-toggle="modal" data-target="#customer_model">
                                                            <span class="svg-icon svg-icon-success svg-icon-2x ">
                                                                <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Plus.svg--><svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none"
                                                                        fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24" />
                                                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12"
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
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-2">

                                                <div class="input-group">
                                                    <input type="text" name="remarks" id="" class="form-control"
                                                        placeholder="Remarks">
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
                                            {{-- <div class="form-group mb-2">
                                            <input type="checkbox" name="" id="">
                                            <input type="text" name="remarks" id="" class="form-control " placeholder="Remarks">
                                        </div> --}}
                                        </div>

                                    </div>

                                    <div class="card-scroll kt_blockui_content" id="my-scroll">
                                        <table class="table nowrap" id="product_table">
                                            <thead>
                                                <tr>
                                                    <th id="scroll-table-header" width="1000px">Product</th>
                                                    <th id="scroll-table-header" class="text-center">Price</th>
                                                    <th id="scroll-table-header" class="text-center" width="500px">
                                                        Quantity</th>
                                                    <th id="scroll-table-header" class="text-center" width="500px">
                                                        Discount</th>
                                                    <th id="scroll-table-header" class="text-center" width="500px">
                                                        Discount%</th>
                                                    <th id="scroll-table-header" class="text-center">Total</th>
                                                    <th id="scroll-table-header"></th>
                                                </tr>
                                            </thead>



                                            <tbody id="product-cart">

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
                                                <span class="font-weight-bold">Discount ( <span
                                                        id="main_discount_label">0</span>% )
                                                    <a href="#" class="font-weight-bolder text-primary "
                                                        id="edit_discount">Edit</a>
                                                </span>
                                                <span class="font-weight-bold">Tax ( <span id="tax">0</span>% )
                                                    <!-- <a href="#" class="font-weight-bolder text-primary">Edit</a> -->
                                                    <a href="#" class="font-weight-bolder text-primary "
                                                        id="edit_tax">Edit</a>
                                                </span>

                                                <span class="font-weight-bold">Total:
                                                    <span id="sub-total" class="ml-2 font-weight-bolder">0.00</span>
                                                </span>

                                                <input type="hidden" name="total_bill" id="total_bill">
                                            </div>
                                            <div class="form-group row mb-1" id="dis_fields" style="display: none;">
                                                <div class="col-xl-6 mb-md-0 mb-1">
                                                    <!-- <input type="number" id="main_discount" value="0" placeholder="Discount Value" class="form-control"> -->
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <!-- <span class="input-group-text">$</span> -->
                                                            <span class="input-group-text">Discount</span>
                                                        </div>
                                                        <input type="number" name="so_discount_value" id="main_discount"
                                                            value="0" placeholder="Discount Value" class="form-control"
                                                            aria-label="Amount (to the nearest dollar)" />
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Discount %</span>
                                                        </div>
                                                        <input type="number" max="100" name="so_discount_percentage"
                                                            id="main_discount_per" value="0"
                                                            placeholder="Discount Percentage" class="form-control"
                                                            aria-label="Amount (to the nearest dollar)" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-1" id="tax_fields" style="display: none;">
                                                <div class="col-xl-6 mb-md-0 mb-1">
                                                    <!-- <input type="number" id="main_discount" value="0" placeholder="Discount Value" class="form-control"> -->
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <!-- <span class="input-group-text">$</span> -->
                                                            <span class="input-group-text">Tax</span>
                                                        </div>
                                                        <input type="number" name="so_tax_value" id="tax_value" value="0"
                                                            placeholder="Tax Value" class="form-control"
                                                            aria-label="Amount (to the nearest dollar)" />
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Tax %</span>
                                                        </div>
                                                        <input type="number" name="so_tax_percentage" id="tax_per" value="0"
                                                            placeholder="Tax Percentage" class="form-control"
                                                            aria-label="Amount (to the nearest dollar)" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex align-items-center justify-content-between bg-light-info p-2">
                                                <span class="h4 m-0">Total Payable:
                                                    <a href="#" class="h6 text-primary" id="pay">Payment Type</a>
                                                </span>
                                                <span class="h1 m-0" id="grand-total">0.00</span>
                                                <input type="hidden" name="grand_total" id="amount_payable" value="0">
                                            </div>

                                            <div class="form-group row mb-0 mt-2" id="pay_fields" style="display: none;">
                                                <div class="col-xl-6 mt-1">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <!-- <span class="input-group-text">$</span> -->
                                                            <span class="input-group-text">Payment Type</span>
                                                        </div>
                                                        <select class="form-control  form-control-lg"
                                                            data-live-search="true" data-size="5" id="payment_type_dropdown"
                                                            name="payment_type">
                                                            {{-- <option value="">Select Payment Type</option> --}}
                                                            @foreach ($payment_types as $payment_type)
                                                                <option value="{{ $payment_type->id }}"
                                                                    {{ old('payment_type') == $payment_type->id ? 'selected' : '' }}>
                                                                    {{ $payment_type->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        <p class="text-danger"> {{ $errors->first('payment_type') }}
                                                        </p>

                                                    </div>
                                                </div>
                                                <div class="col-xl-6 mt-1">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend ">
                                                            <!-- <span class="input-group-text">$</span> -->
                                                            <span class="input-group-text">Payment Method</span>
                                                        </div>
                                                        <select name="payment_method_id" id="payment_method_dropdown"
                                                            class="form-control  form-control-lg" data-live-search="true"
                                                            data-size="5 ">
                                                            {{-- <option value="">Select Payment Type First</option> --}}
                                                        </select>
                                                        <p class="text-danger">
                                                            {{ $errors->first('payment_method_id') }}</p>
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
                                                    <input type="number" min="0" name="amount_paid" id="amount_paid"
                                                        placeholder="Paid" class="form-control" />
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
                                                <a href="#" class="btn btn-outline-danger font-weight-bolder py-3 w-100"
                                                    id="cancel">Cancel</a>
                                            </div>
                                            <div class="col-xl-4 mt-2">
                                                <!-- <button type="button" id="hold" class="btn btn-outline-warning font-weight-bolder w-75 py-3">Hold</button> -->
                                                <div class="btn-group w-100">
                                                    <button type="button" id="hold"
                                                        class="btn btn-outline-warning font-weight-bolder w-75 py-3">Hold</button>
                                                    <button type="button"
                                                        class="btn btn-outline-warning dropdown-toggle dropdown-toggle-split"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                                <a href="#" class="btn btn-outline-success font-weight-bolder py-3 w-100"
                                                    id="payment">Payment</a>
                                            </div>

                                            <input type="hidden" name="profit_value" value="0">
                                            <input type="hidden" name="profit_percentage" value="0">
                                            <input type="hidden" name="so_status">
                                            <input type="hidden" name="order_id" id="order_id" value="0">
                                            <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">

                                            <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
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
                            <input type="text" class="form-control" value="{{ old('customer_name') }}"
                                name="customer_name" placeholder="Customer Name" />
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

                        <input type="hidden" name="outlet_id" id="outlet-id" value="{{ session('outlet_id') }}">
                        <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">

                    </div>
                    <div class="modal-footer py-3">
                        <span id="customer_added"></span>
                        <button type="submit" class="btn btn-primary btn-shadow px-12" id="btn">Submit</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
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
    {{-- vendors --}}
    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
                tabcontent[i].hidden = false;
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
                // tablinks[i].className = tablinks[i].className.replace(" btn btn-secondary", "btn btn-primary");

            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
            // evt.currentTarget.className += " btn-primary"
        }
    </script>

    <script>
        function get_products(category) {
            var category_id = $(category).val();
            console.log(category_id);
            $.ajax({
                url: "/get-category-products?category_id=" + category_id,
                type: "GET",
                success: function(res) {
                    $("#products-area").html("");
                    console.log(res)

                }
            });
        }
    </script>
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js?v=7.0.5') }}"></script>
    <script>
        document.getElementByID
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
                            $("#payment_method_dropdown").append(
                                '<option value="">Select Payment Method</option>');
                            $("#payment_method_dropdown").val("");

                            $.each(res, function(key, value) {
                                if (key == 'Cash') {
                                    $("#payment_method_dropdown").append(
                                        '<option selected value="' + value + '">' + key +
                                        '</option>');
                                }

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

        $('#payment_type_dropdown').change(function() {
            var typeID = $(this).val();
            if (typeID) {
                console.log(typeID);
                $.ajax({
                    url: "{{ url('get-payment-method') }}?payment_type_id=" + typeID,
                    type: "Get",
                    success: function(res) {
                        if (res) {
                            $("#payment_method_dropdown").empty();
                            $("#payment_method_dropdown").append(
                                '<option value="">Select Payment Method</option>');

                            $("#payment_method_dropdown").val("");


                            $.each(res, function(key, value) {
                                $("#payment_method_dropdown").append('<option value="' + value +
                                    '">' + key +
                                    '</option>');


                                // if(old_state==value){
                                //     $("#state").selectpicker("val", [value]);
                                // }
                                console.log($("#payment_method_dropdown").val());
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
    {{-- Products Data --}}
    <script src="{{ asset('js/products/page.js') }}"></script>
    @include('pages.sales.sales2-js')
@endsection
