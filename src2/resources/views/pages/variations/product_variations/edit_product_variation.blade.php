@extends('layout.default')
@section('title', 'Edit Product Variations')
@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Product Variations</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('variations.index') }}" class="text-muted">All Product Variations</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Edit Product Variation</a>
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
                                <h3 class="card-label">Edit Product Variation
                                    <!-- <span class="d-block text-muted pt-2 font-size-sm">Manage Customers</span> -->
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form method="post" action="{{ route('product-variations.update', $variation_product->id) }}"
                                id="Add_employee_form" enctype="multipart/form-data">
                                @method('PATCH')
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
                                            <div class="form-group">
                                                <label>Product</label>
                                                <input class="form-control  " type="text" name="product_id"
                                                    value="{{ $variation_product->product_title }}" disabled>

                                                <p class="text-danger"> {{ $errors->first('product_id') }}</p>
                                            </div>
                                        </div>


                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>Variation Attributes</label>
                                                <select class="form-control selectpicker" name="variation_attribute_id[]"
                                                    id="variation_attributes" title="Select Variation Attributes"
                                                    data-size="5" data-live-search="true" multiple>
                                                    @foreach ($variation_attributes as $id => $variation_attribute)
                                                        <option value="{{ $id }}"
                                                            {{ in_array($id, old('products', [])) || $variation_product->variation_attribute->contains($id)? 'selected': '' }}>
                                                            {{ $variation_attribute }}</option>
                                                    @endforeach
                                                    @error('variation_attribute_id')
                                                        {{ $message }}
                                                    @enderror
                                                </select>
                                                {{-- <p class="text-danger"> {{ $errors->first('variation_attribute_id') }}</p> --}}
                                            </div>
                                        </div>


                                    </div>
                                    <div class="form-group row">
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label>Cost Price</label>
                                                <input class="form-control  " id="cost" type="text" name="cost_price"
                                                    value="{{ $variation_product->cost_price }}">
                                                <p class="text-danger"> {{ $errors->first('cost_price') }}</p>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label>Retail Price</label>
                                                <input class="form-control  " id="retail" type="text" name="retail_price"
                                                    value="{{ $variation_product->retail_price }}">
                                                <p class="text-danger"> {{ $errors->first('retail_price') }}</p>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label>Units in Stock</label>
                                                <input class="form-control  " id="stock" type="text" name="units_in_stock"
                                                    value="{{ $variation_product->units_in_stock }}">
                                                <p class="text-danger"> {{ $errors->first('units_in_stock') }}</p>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="form-group row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>SKU</label>
                                                <input class="form-control  " type="text" id="sku" name="sku"
                                                    value="{{ $variation_product->sku }}">
                                                <p class="text-danger"> {{ $errors->first('sku') }}</p>
                                            </div>
                                        </div>


                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>Minimum Threshold</label>
                                                <input class="form-control  " type="text" id="threshold"
                                                    name="minimum_threshold"
                                                    value="{{ $variation_product->minimum_threshold }}">
                                                <p class="text-danger"> {{ $errors->first('minimum_threshold') }}</p>
                                            </div>
                                        </div>

                                    </div>

                                    <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                                    <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                                    <button type="submit" id="btn-submit"
                                        class="btn btn-primary btn-shadow px-12 mt-8">Submit</button>
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
    <script>
        $('#products').change(function() {
            var product_id = $(this).val();

            $.ajax({
                type: "GET",
                url: "/get-product-data/?product_id=" + product_id,
                // data: "data",
                dataType: "JSON",
                success: function(response) {
                    $('#cost').val(response.cost_price);
                    $('#retail').val(response.retail_price);
                    $('#stock').val(response.units_in_stock);
                    $('#sku').val(response.sku);
                    $('#threshold').val(response.minimum_threshold);
                }
            });
        });
    </script>
    <script>
        var avatar1 = new KTImageInput('kt_image_1');
    </script>

    <script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>


@endsection
