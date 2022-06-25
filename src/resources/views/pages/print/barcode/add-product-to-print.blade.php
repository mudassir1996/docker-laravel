@extends('layout.default')
@section('title', 'Print Barcode')
@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Barcode</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Print Barcode</a>
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
                                <h3 class="card-label">Barcode
                                    <span class="d-block text-muted pt-2 font-size-sm">Print Barcode</span>
                                </h3>
                            </div>

                        </div>
                        <div class="card-body">

                            <!--begin: Datatable-->

                            <table class="table table-separate table-head-custom table-checkable nowrap"  id="kt_print_barcode">
                                <thead>
                                    <tr>

                                        <th>Prduct Name</th>
                                        <th>Barcode</th>
                                        <th></th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!$products->isEmpty())
                                    @foreach($products as $product)
                                    <tr>


                                        <td>{{$product->product_title}}</td>

                                        <td>{{$product->product_barcode}}</td>

                                        <td><a href="{{ route('barcode.add-quantity', $product->id) }}" class="btn btn-primary" onclick="window.open(this.href,'popUpWindow','height=600,width=450,left=10,top=10,,scrollbars=yes,menubar=no'); return false;">Add</a></td>


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

    {{-- Product Import Model --}}
    <div class="modal fade" id="upload_model" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{route('products.import')}}"  enctype="multipart/form-data" method="post" class="add_category">
                @csrf
                <div class="modal-header p-4">
                    <h6 class="modal-title" id="upload_model">Import Products</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p>The field labels marked with * are required input fields.</p>
                    <p>The correct column order is (product_title*, product_description, product_barcode*, product_allow_half*, cost_price*, retail_price*, stock_keeping*, units_in_stock*, sku*, minimum_threshold*, category_id, company_id) and you must follow this.</p>
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
                                <a href="{{route('download.product-csv')}}" class="btn btn-success btn-block font-weight-bolder">
                                    <span class="svg-icon svg-icon-md">
                                        <!--begin::Svg Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"/>
                                                <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                <path d="M14.8875071,11.8306874 L12.9310336,11.8306874 L12.9310336,9.82301606 C12.9310336,9.54687369 12.707176,9.32301606 12.4310336,9.32301606 L11.4077349,9.32301606 C11.1315925,9.32301606 10.9077349,9.54687369 10.9077349,9.82301606 L10.9077349,11.8306874 L8.9512614,11.8306874 C8.67511903,11.8306874 8.4512614,12.054545 8.4512614,12.3306874 C8.4512614,12.448999 8.49321518,12.5634776 8.56966458,12.6537723 L11.5377874,16.1594334 C11.7162223,16.3701835 12.0317191,16.3963802 12.2424692,16.2179453 C12.2635563,16.2000915 12.2831273,16.1805206 12.3009811,16.1594334 L15.2691039,12.6537723 C15.4475388,12.4430222 15.4213421,12.1275254 15.210592,11.9490905 C15.1202973,11.8726411 15.0058187,11.8306874 14.8875071,11.8306874 Z" fill="#000000"/>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>Download</a>

                            </div>
                        </div>

                    </div>

                    <input type="hidden" name="outlet_id" value="{{session('outlet_id')}}">
                    <input type="hidden" name="created_by" value="{{session('employee_id')}}">
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
{{--vendors--}}
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js?v=7.0.5')}}"></script>

{{-- Products Data --}}

<script>
    var OUTLET_TITLE="{{session('outlet_title')}}";
    var OUTLET_ADDRESS="{{session('outlet_address')}}";
    var OUTLET_PONE="{{session('outlet_phone')}}";
</script>
    <script src="{{asset('js/pages/crud/datatables/basic/paginations.js?v=7.0.5')}}"></script>

@endsection