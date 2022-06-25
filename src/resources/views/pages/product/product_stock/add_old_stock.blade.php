@extends('layout.default')
@section('title', 'Add Old Stock')
@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Product Stock</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('product-stock.index') }}" class="text-muted">In Stock</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">Add Old Stock</a>
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
                                <h3 class="card-label">Add Old Stock
                                    <span class="d-block text-muted pt-2 font-size-sm"></span>
                                </h3>
                            </div>

                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form method="post" action="{{ route('product-stock.store-old-stock') }}"
                                id="add_product_stock" autocomplete="off">
                                @csrf
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
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label for="category">Product *</label>
                                                <select class="form-control    selectpicker" id="product_id"
                                                    name="product_id" data-live-search="true" data-size="5"
                                                    title="Choose one of the following...">
                                                    <option value="">--Select Nothing--</option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}"
                                                            {{ $product_id == $product->id ? 'selected' : '' }}
                                                            {{ old('product_id') == $product->id ? 'selected' : '' }}
                                                            data-allow-half={{ $product->product_allow_half }}
                                                            data-company={{ $product->company_title }}>
                                                            {{ $product->product_title }}</option>
                                                    @endforeach
                                                </select>
                                                <p class="text-danger"> {{ $errors->first('product_id') }}</p>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <!--begin::Input-->
                                                <label>Units in Stock *</label>
                                                <input type="text"
                                                    class="form-control    {{ $errors->first('units_in_stock') ? 'is-invalid' : '' }}"
                                                    id="units" name="units_in_stock" value="{{ old('units_in_stock') }}"
                                                    placeholder="Units" />
                                                <!--end::Input-->
                                                <p class="text-danger"> {{ $errors->first('units_in_stock') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <!--begin::Input-->
                                                <label>Cost Price *</label>
                                                <input type="text"
                                                    class="form-control    {{ $errors->first('cost_price') ? 'is-invalid' : '' }}"
                                                    id="cost_price" name="cost_price" value="{{ old('cost_price') }}"
                                                    placeholder="Cost Price" />
                                                <!--end::Input-->
                                                <p class="text-danger"> {{ $errors->first('cost_price') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <!--begin::Input-->
                                                <label>Retail Price *</label>
                                                <input type="text"
                                                    class="form-control    {{ $errors->first('retail_price') ? 'is-invalid' : '' }}"
                                                    name="retail_price" value="{{ old('retail_price') }}"
                                                    placeholder="Retail Price" />
                                                <!--end::Input-->
                                                <p class="text-danger"> {{ $errors->first('retail_price') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <label for="exampleTextarea">Remarks</label>
                                                <textarea class="form-control   " id="exampleTextarea" name="remarks"
                                                    rows="5">{{ old('remarks') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2">
                                        <div class="justify-content-between row">
                                            <input type="hidden" value="0" name="total_bill" id="total_bill">
                                            <h2>Total Bill:</h2>
                                            <h2 id="total_bill_text">0</h2>
                                        </div>
                                    </div>
                                    <input type="hidden" name="allow_half" id="hidden_allow_half">
                                    <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                                    <input type="hidden" name="created_by" value="{{ session('employee_id') }}">
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-shadow px-12">Submit</button>
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

{{-- Scripts Section --}}

@section('scripts')

    {{-- Date Picker --}}
    <script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/product_stock/form_validation.js') }}"></script>
@endsection
