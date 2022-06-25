@extends('layout.default')
@section('title', 'Edit Stock')
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
                            <a href="#" class="text-muted">Product Stock</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('product-stock.index') }}" class="text-muted">In Stock</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Edit Stock</a>
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
                                <h3 class="card-label">Edit Stock
                                    <span class="d-block text-muted pt-2 font-size-sm"></span>
                                </h3>
                            </div>

                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form method="post" action="{{ route('product-stock.update', $product_stock->id) }}"
                                id="add_product_form">
                                @csrf
                                @method('PATCH')
                                <div class="card-body">
                                    <div class="form-group mb-8">
                                        <div class="alert alert-custom alert-default" role="alert">
                                            <div class="alert-icon">
                                                <span class="svg-icon svg-icon-primary svg-icon-xl">
                                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Info-circle.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                                            <rect fill="#000000" x="11" y="10" width="2" height="7"
                                                                rx="1" />
                                                            <rect fill="#000000" x="11" y="7" width="2" height="2" rx="1" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <div class="alert-text">Fill out the form below. The fields with (*) are
                                                required.</div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-xl-4">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Product Title</label>
                                                <input type="text" class="form-control   "
                                                    value="{{ $product_stock->product_title }}" disabled />

                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-4">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Stock Avaliable</label>
                                                <input type="text" class="form-control   "
                                                    value="{{ $product_stock->units_in_stock }}" disabled />

                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-4">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Cost Price</label>
                                                <input type="text" class="form-control   "
                                                    value="{{ $product_stock->cost_price }}" disabled />

                                            </div>
                                            <!--end::Input-->
                                        </div>



                                    </div>



                                    <div class="form-group row">
                                        <div class="col-xl-5">
                                            <div class="form-group">
                                                <!--begin::Input-->
                                                <label>Retail Price *</label>
                                                <input type="number"
                                                    class="form-control    {{ $errors->first('retail_price') ? 'is-invalid' : '' }}"
                                                    value="{{ $product_stock->retail_price }}" name="retail_price"
                                                    placeholder="Retail Price" />
                                                <!--end::Input-->
                                                <p class="text-danger"> {{ $errors->first('retail_price') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-5">
                                            <!--begin::Input-->
                                            <div class="form-group ">
                                                <label>Minimum Threshold</label>

                                                <input type="number" class="form-control   "
                                                    value="{{ $product_stock->minimum_threshold }}"
                                                    name="minimum_threshold" placeholder="Minimum Threshold" />

                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="form-group ">
                                            <label class="col-12 col-form-label">Stock Keeping?</label>
                                            <div class="col-12">
                                                <span class="switch switch-outline switch-icon switch-success">
                                                    <label>
                                                        <input type="checkbox" name="stock_keeping" id="keep_stock"
                                                            {{ $product_stock->stock_keeping == 1 ? 'checked' : '' }}
                                                            value="1" />
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>

                                    </div>







                                    <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                                    <input type="hidden" name="created_by" value="{{ session('employee_id') }}">
                                    <button type="submit" class="btn btn-primary btn-shadow px-12 mt-8">Submit</button>

                                </div>
                            </form>
                            <!--end::Form-->
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
    <script src="{{ asset('js/products/form_validation.js') }}"></script>

@endsection
