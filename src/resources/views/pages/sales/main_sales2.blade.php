@extends('layout.default-outlets')
@section('title', 'Sales Dashboard')
@section('content')

<div class="content d-flex flex-column flex-column-fluid pb-0" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap ml-5">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->

                    <h5 class="text-dark font-weight-bold my-1 mr-5">Sales</h5>

                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">Dashboard</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Actions-->
                <a href="#" class="btn btn-light font-weight-bold btn-sm">Actions</a>
                <!--end::Actions-->
                <!--begin::Dropdown-->
                <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
                    <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="svg-icon svg-icon-success svg-icon-2x">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Files/File-plus.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 m-0">
                        <!--begin::Navigation-->
                        <ul class="navi navi-hover">
                            <li class="navi-header font-weight-bold py-4">
                                <span class="font-size-lg">Choose Label:</span>
                                <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
                            </li>
                            <li class="navi-separator mb-3 opacity-70"></li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-text">
                                        <span class="label label-xl label-inline label-light-success">Customer</span>
                                    </span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-text">
                                        <span class="label label-xl label-inline label-light-danger">Partner</span>
                                    </span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-text">
                                        <span class="label label-xl label-inline label-light-warning">Suplier</span>
                                    </span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-text">
                                        <span class="label label-xl label-inline label-light-primary">Member</span>
                                    </span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-text">
                                        <span class="label label-xl label-inline label-light-dark">Staff</span>
                                    </span>
                                </a>
                            </li>
                            <li class="navi-separator mt-3 opacity-70"></li>
                            <li class="navi-footer py-4">
                                <a class="btn btn-clean font-weight-bold btn-sm" href="#">
                                    <i class="ki ki-plus icon-sm"></i>Add new</a>
                            </li>
                        </ul>
                        <!--end::Navigation-->
                    </div>
                </div>
                <!--end::Dropdown-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
    <div class="d-flex flex-column-fluid ">
        <!--begin::Container-->
        <div class="container-fluid px-30">
            <!--begin::Teachers-->
            <div class="row justify-content-center">
                <div class="col-xl-7">
                    <!--begin::Card-->
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-body">
                            <!--begin::Engage Widget 15-->
                            <div class="card card-custom mt-6">
                                <div class="card-body rounded p-0 d-flex " style="background-color:#DAF0FD;">
                                    <div class="d-flex flex-column w-100 p-5">
                                        <h4 class="font-weight-bolder text-dark">Search Goods</h4>

                                        <!--begin::Form-->
                                        <form class="d-flex flex-center  px-4 bg-white rounded">
                                            <span class="svg-icon svg-icon-lg svg-icon-primary">
                                                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Search.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                        <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <input type="text" id="search" class="form-control border-0 font-weight-bold pl-2" placeholder="Search Goods">
                                        </form>
                                        <!--end::Form-->
                                    </div>
                                    <!-- <div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover" style="background-image: url(/metronic/theme/html/demo1/dist/assets/media/svg/illustrations/progress.svg);"></div> -->
                                </div>
                            </div>
                            <!--end::Engage Widget 15-->

                            <!--begin::Section-->
                            <!--begin::Products-->
                            <div class="row mt-8" id="my-scroll" style="overflow-y: scroll; height:550px">
                            </div>
                            <!--end::Products-->
                            <!--end::Section-->
                        </div>
                    </div>
                    <!--end::Card-->
                </div>

                <!--begin::Aside-->

                <div class="col-xl-5">
                    <!--begin::List Widget 17-->
                    <div class="card card-custom gutter-b">
                        <!--begin::Header-->
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body ">
                            <form action="{{route('sales.store')}}" id="sales_order_form" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-0 align-items-center">
                                    <div class="col-xl-11 pr-xl-1">
                                        <div class="form-group mb-2">
                                            <select name="customer_id" id="customer" data-live-search="true" class="form-control form-control-sm  selectpicker">
                                                <option value="0">Walk-In Client</option>
                                                @foreach($customers as $id => $customer)
                                                <option value="{{$id}}">{{$customer}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-xl-1">
                                        <div class="form-group mb-2">
                                            <a href="#" data-toggle="modal" data-target="#customer_model">
                                                <span class="svg-icon svg-icon-success svg-icon-2x ">
                                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Plus.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                                            <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="text" name="remarks" id="" class="form-control " placeholder="Remarks">
                                </div>
                                <div id="my-scroll" style="overflow-y: scroll; height:350px;">
                                    <table class="table nowrap" id="product_table">
                                        <thead>
                                            <tr>
                                                <th id="scroll-table-header" width="1000px">Product</th>
                                                <th id="scroll-table-header" class="text-center">Price</th>
                                                <th id="scroll-table-header" class="text-center" width="500px">Qty</th>
                                                <th id="scroll-table-header" class="text-center" width="200px">Discount</th>
                                                <th id="scroll-table-header" class="text-center" width="200px">Discount%</th>
                                                <th id="scroll-table-header" class="text-center">Total</th>
                                                <th id="scroll-table-header"></th>
                                            </tr>
                                        </thead>

                                        <tbody>


                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer pb-0 px-0 pt-4">
                                    <div class="d-flex  flex-column mb-md-0">
                                        <!-- <div class="font-weight-bolder font-size-lg mb-3">BANK TRANSFER</div> -->
                                        <div class="d-flex justify-content-between mb-2  bg-light-success p-3">
                                            <span class="font-weight-bold">Total Items:</span>
                                            <span class=""><span id="total-items">0</span> ( <span id="total-quantities">0.00</span> )</span>
                                            <span class="font-weight-bold">Total:</span>
                                            <span id="sub-total">0.00</span>
                                            <input type="hidden" name="total_bill" id="total_bill">
                                        </div>
                                        <div class="d-flex justify-content-between p-3 bg-gray-100 mb-2">
                                            <span class="font-weight-bold">Discount ( <span id="main_discount_label">0</span>% )
                                                <a href="#" class="font-weight-bolder text-primary" id="edit_discount">Edit</a>
                                            </span>

                                            <span class="font-weight-bold">Tax ( <span id="tax">0</span>% )
                                                <!-- <a href="#" class="font-weight-bolder text-primary">Edit</a> -->
                                                <a href="#" class="font-weight-bolder text-primary" id="edit_tax">Edit</a>
                                            </span>


                                        </div>
                                        <div class="form-group row mb-2" id="dis_fields" style="display: none;">
                                            <div class="col-xl-6 mb-md-0 mb-2">
                                                <!-- <input type="number" id="main_discount" value="0" placeholder="Discount Value" class="form-control"> -->
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <!-- <span class="input-group-text">$</span> -->
                                                        <span class="input-group-text">Discount</span>
                                                    </div>
                                                    <input type="number" name="so_discount_value" id="main_discount" value="0" placeholder="Discount Value" class="form-control" aria-label="Amount (to the nearest dollar)" />
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Discount %</span>
                                                    </div>
                                                    <input type="number" max="100" name="so_discount_percentage" id="main_discount_per" value="0" placeholder="Discount Percentage" class="form-control" aria-label="Amount (to the nearest dollar)" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2" id="tax_fields" style="display: none;">
                                            <div class="col-xl-6 mb-md-0 mb-2">
                                                <!-- <input type="number" id="main_discount" value="0" placeholder="Discount Value" class="form-control"> -->
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <!-- <span class="input-group-text">$</span> -->
                                                        <span class="input-group-text">Tax</span>
                                                    </div>
                                                    <input type="number" name="so_tax_value" id="tax_value" value="0" placeholder="Tax Value" class="form-control" aria-label="Amount (to the nearest dollar)" />
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Tax %</span>
                                                    </div>
                                                    <input type="number" name="so_tax_percentage" id="tax_per" value="0" placeholder="Tax Percentage" class="form-control" aria-label="Amount (to the nearest dollar)" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between bg-light-info p-3">
                                            <span class="h4 m-0">Total Payable:
                                                <a href="#" class="h6 text-primary" id="pay">Pay</a>
                                            </span>
                                            <span class="h1 m-0" id="grand-total">0.00</span>
                                            <input type="hidden" name="grand_total" id="amount_payable">
                                        </div>

                                        <div class="form-group row mb-2 mt-2" id="pay_fields" style="display: none;">
                                            <div class="col-xl-6 mb-md-0 mb-2">
                                                <!-- <input type="number" id="main_discount" value="0" placeholder="Discount Value" class="form-control"> -->
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <!-- <span class="input-group-text">$</span> -->
                                                        <span class="input-group-text">Paid</span>
                                                    </div>
                                                    <input type="number" name="amount_paid" id="amount_paid" placeholder="Paid" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Change Back</span>
                                                    </div>
                                                    <input type="number" name="change_back" id="change_back" placeholder="Change Back" class="form-control" aria-label="Amount (to the nearest dollar)" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6 mt-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <!-- <span class="input-group-text">$</span> -->
                                                    <span class="input-group-text">Payment Type</span>
                                                </div>
                                                <select name="payment_type" class="form-control">
                                                    <option value="credit">Credit</option>
                                                    <option value="debit">Debit</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 mt-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend ">
                                                    <!-- <span class="input-group-text">$</span> -->
                                                    <span class="input-group-text">Payment Method</span>
                                                </div>
                                                <select name="payment_method_id" class="form-control">
                                                    @foreach($payment_methods as $id => $payment_method)
                                                    <option value="{{$id}}">{{$payment_method}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 mt-2">
                                            <a href="#" class="btn btn-danger font-weight-bolder py-3 w-100" id="cancel">Cancel</a>
                                        </div>
                                        <div class="col-xl-4 mt-2">
                                            <a href="#" class="btn btn-warning font-weight-bolder py-3 w-100" id="hold">Hold</a>
                                            <!-- <div class="btn-group dropup w-100" id="hold">
                                                <a class="btn btn-warning font-weight-bolder">Hold</a>
                                                <a class="btn btn-warning px-0 dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="col-xl-4 mt-2">
                                            <a href="#" class="btn btn-success font-weight-bolder py-3 w-100" id="payment">Payment</a>
                                        </div>

                                        <input type="hidden" name="profit_value" value="0">
                                        <input type="hidden" name="profit_percentage" value="0">
                                        <input type="hidden" name="so_status">
                                        <input type="hidden" name="outlet_id" value="{{session('outlet_id')}}">
                                        <input type="hidden" name="created_by" value="{{Auth::user()->id}}">
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
<div class="modal fade" id="customer_model" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="add_customer_form" class="add_customer">

                <div class="modal-header ">
                    <h5 class="modal-title" id="customer_model">Add Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group row mb-2">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label>Customer Name*</label>
                                <input type="text" class="form-control" value="{{old('customer_name')}}" name="customer_name" placeholder="Customer Name" />

                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label>Phone*</label>
                                <input type="text" class="form-control" value="{{old('customer_phone')}}" name="customer_phone" placeholder="Phone" />

                            </div>
                        </div>
                    </div>

                    
                    
                    <div class="form-group row mb-2">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <!--begin::Input-->
                                <label for="gender">Gender *</label>
                                <select class="form-control" id="gender" name="customer_gender">
                                    <option value="">Select Gender</option>
                                    <option {{(old('customer_gender')=='Male')?'selected':''}}>Male</option>
                                    <option {{(old('customer_gender')=='Female')?'selected':''}}>Female</option>
                                </select>
                                <!--end::Input-->
                            </div>
                        </div>
                    </div>
                    
                    
                    <input type="hidden" name="outlet_id" value="{{session('outlet_id')}}">
                    <input type="hidden" name="created_by" value="{{Auth::user()->id}}">

                </div>
                <div class="modal-footer py-2">
                    <span id="customer_added"></span>
                    <button class="btn btn-primary" id="btn">Submit</button>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection
{{-- Scripts Section --}}

@section('scripts')

<script src="{{asset('js/products/picture_preview.js')}}"></script>
<script src="{{asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('js/products/page.js')}}"></script>
<!-- <script src="{{asset('js/sales/sales.js')}}"></script> -->
@include('pages.sales.sales-js')
@endsection