@extends('layout.default')
@section('title', 'Update Stock')
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
                            <a href="" class="text-muted">Update Stock</a>
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
                                <h3 class="card-label">Update Stock
                                    <span class="d-block text-muted pt-2 font-size-sm"></span>
                                </h3>
                            </div>

                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form method="post" action="{{ route('update-stock.store') }}" id="add_product_stock"
                                enctype="multipart/form-data">
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
                                        <div class="col-xl-3">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label for="category">Product *</label>
                                                <select class="form-control    selectpicker" id="product_id"
                                                    name="product_id" data-live-search="true" data-size="5"
                                                    title="Choose one of the following...">
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}"
                                                            {{ old('product_id') == $product->id ? 'selected' : '' }}
                                                            data-allow-half={{ $product->product_allow_half }}>
                                                            {{ $product->product_title }}</option>
                                                    @endforeach
                                                </select>
                                                <p class="text-danger"> {{ $errors->first('product_id') }}</p>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <!--begin::Input-->
                                                <label>Status*</label>
                                                <select class="form-control    selectpicker" name="po_status"
                                                    data-live-search="true" data-size="5" id="po_status"
                                                    title="Choose one of the following...">

                                                    <option value="lost" {{ old('product_id') == 'lost' ? 'selected' : '' }}>
                                                        Lost</option>
                                                    <option value="stolen"
                                                        {{ old('product_id') == 'stolen' ? 'selected' : '' }}>Stolen</option>
                                                    <option value="invalid-entry"
                                                        {{ old('product_id') == 'invalid-entry' ? 'selected' : '' }}>Invalid
                                                        Entry</option>
                                                    <option value="expired"
                                                        {{ old('product_id') == 'expired' ? 'selected' : '' }}>Expired</option>
                                                    <option value="return-to-supplier"
                                                        {{ old('product_id') == 'expired' ? 'selected' : '' }}>Return to
                                                        Supplier</option>
                                                </select>
                                                <!--end::Input-->
                                                <p class="text-danger"> {{ $errors->first('po_status') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <!--begin::Input-->
                                                <label id="unit_label">Units*</label>
                                                <input type="text"
                                                    class="form-control    {{ $errors->first('units_in_stock') ? 'is-invalid' : '' }}"
                                                    id="units" name="units_in_stock" value="{{ old('units_in_stock') }}"
                                                    placeholder="Units" />
                                                <!--end::Input-->
                                                <p class="text-danger" id="unit_msg"> </p>
                                                <p class="text-danger"> {{ $errors->first('units_in_stock') }}</p>
                                            </div>
                                        </div>

                                        <div class="col-xl-3" id="supplier_select">
                                            <div class="form-group">
                                                <label>Supplier*</label>
                                                <select class="form-control    selectpicker" id="supplier"
                                                    name="supplier_id" data-live-search="true" data-size="5"
                                                    title="Choose one of the following...">

                                                </select>

                                                <p class="text-danger"> {{ $errors->first('supplier_id') }}</p>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="form-group row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <!--begin::Input-->
                                                <label>Cost Price *</label>
                                                <input type="text" class="form-control    {{$errors->first('cost_price')?'is-invalid':''}}" disabled id="cost_price" name="cost_price" value="{{ old('cost_price') }}" placeholder="Cost Price" />
                                                <!--end::Input-->
                                                <p class="text-danger"> {{$errors->first('cost_price')}}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <!--begin::Input-->
                                                <label>Units in Stock *</label>
                                                <input type="text" class="form-control    {{$errors->first('units_in_stock')?'is-invalid':''}}" id="units" name="units_in_stock" value="{{ old('units_in_stock') }}" placeholder="Units" />
                                                <!--end::Input-->
                                                <p class="text-danger"> {{$errors->first('units_in_stock')}}</p>
                                            </div>
                                        </div>

                                    </div> --}}


                                    {{-- <div class="form-group row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <!--begin::Input-->
                                                <label>Cost Price *</label>
                                                <input type="text" class="form-control    {{$errors->first('cost_price')?'is-invalid':''}}" id="cost_price" name="cost_price" value="{{ old('cost_price') }}" placeholder="Cost Price" />
                                                <!--end::Input-->
                                                <p class="text-danger"> {{$errors->first('cost_price')}}</p>
                                            </div>
                                        </div>
                                        
                                    </div> --}}
                                    {{-- <div class="form-group row">
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label for="category">Payment Type *</label>
                                                <select class="form-control    selectpicker " name="payment_type" data-live-search="true" data-size="5" title="Choose one of the following...">
                                                    <option value="credit" {{(old('payment_type')=='credit')?'selected':''}}>Credit</option>
                                                    <option value="debit" {{(old('payment_type')=='debit')?'selected':''}}>Debit</option>
                                                </select>
                                                <p class="text-danger"> {{$errors->first('payment_type')}}</p>
                                            </div>
                                            <!--end::Input-->
                                        </div>

                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label for="category">Payment Method *</label>
                                                <select class="form-control    selectpicker " name="payment_method_id" data-live-search="true" data-size="5" title="Choose one of the following...">
                                                    @foreach ($payment_methods as $id => $payment_method)
                                                    <option value="{{$id}}" {{(old('payment_method_id')==$id)?'selected':''}}>{{$payment_method}}</option>
                                                    @endforeach
                                                </select>
                                                <p class="text-danger"> {{$errors->first('payment_method_id')}}</p>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                    </div> --}}
                                    <div class="form-group row">
                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <label for="exampleTextarea">Remarks</label>
                                                <textarea class="form-control   " id="exampleTextarea" name="remarks"
                                                    rows="5">{{ old('remarks') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <input type="hidden" name="allow_half" id="hidden_allow_half"> --}}
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


    <!-- Supplier MODEL -->
    {{-- <div class="modal fade" id="supplier_model" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="add_supplier_form" class="add_supplier">

                <div class="modal-header">
                    <h6 class="modal-title" id="supplier_model">Add Supplier</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group row mb-0">
                        <div class="col-xl-6">
                            <div class="form-group mb-5">
                                <label>Supplier Name*</label>
                                <input type="text" class="form-control" autofocus="on" name="supplier_title" placeholder="Company Name" />
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <!--begin::Input-->
                            <div class="form-group">
                                <label>Company *</label>
                                <select class="form-control selectpicker" name="company_id[]" id="company" title="Select Company" data-size="5" data-live-search="true" multiple>
                                    @foreach ($companies as $id => $company)
                                    <option value="{{$id}}" {{(in_array($id, old('company_id', [])))?'selected':''}}>{{$company}}</option>
                                    @endforeach
                                    @error('company_id')
                                        {{$message}}
                                    @enderror
                                </select>
                            </div>
                            <!--end::Input-->
                        </div>
                    </div>
                    <input type="hidden" name="outlet_id" value="{{session('outlet_id')}}">
                    <input type="hidden" name="created_by" value="{{session('employee_id')}}">
                    <button type="submit" id="save-supplier" class="btn btn-primary btn-shadow px-12 mt-4">Save</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

@endsection


{{-- Scripts Section --}}

@section('scripts')

    {{-- Date Picker --}}
    <script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>
    <script>
        // ---------------------------------------------------------------------------------
        // var cost_price = $('#cost_price').val();
        // var units = parseFloat($('#units').val());
        // var total_bill = $('#total_bill');
        // let allow_half=0;

        // $('#supplier').attr('disabled', true);
        // $('#supplier').selectpicker('refresh');
        $('#supplier_select').hide();
        $('#po_status').change(function() {
            if ($('#po_status').val() == 'lost') {
                $('#supplier_select').hide();
                $('#unit_label').text('Units Lost*');
                $('#unit_msg').text('Add (-) sign to reduce the total quantity of units.');
                $('#units').attr('min', '0');
                $('#supplier').attr('disabled', true);
                $('#supplier').selectpicker('refresh');
            } else if ($('#po_status').val() == 'stolen') {
                $('#supplier_select').hide();
                $('#unit_label').text('Units Stolen*');
                $('#unit_msg').text('Add (-) sign to reduce the total quantity of units.');
                $('#supplier').attr('disabled', true);
                $('#supplier').selectpicker('refresh');
            } else if ($('#po_status').val() == 'expired') {
                $('#supplier_select').hide();
                $('#unit_label').text('Units Expired*');
                $('#unit_msg').text('Add (-) sign to reduce the total quantity of units.');
                $('#supplier').attr('disabled', true);
                $('#supplier').selectpicker('refresh');
            } else if ($('#po_status').val() == 'invalid-entry') {
                $('#supplier_select').hide();
                $('#unit_label').text('Units*');
                $('#unit_msg').text('Add (-) sign to reduce the total quantity of units.');
                $('#supplier').attr('disabled', true);
                $('#supplier').selectpicker('refresh');
            } else if ($('#po_status').val() == 'return-to-supplier') {
                $('#supplier_select').show();
                $('#unit_label').text('Units to return*');
                $('#unit_msg').text('Add (-) sign to reduce the total quantity of units.');
                $('#supplier').attr('disabled', false);
                $('#supplier').selectpicker('refresh');
            }
        });

        // $('#cost_price').keyup(
        //     function() {
        //         total_bill.val($('#cost_price').val() * $('#units').val());
        //         $('#total_bill_text').text($('#cost_price').val() * $('#units').val());
        //     }
        // );
        // $('#units').keyup(
        //     function() {
        //         total_bill.val($('#cost_price').val() * $('#units').val());
        //         $('#total_bill_text').text($('#cost_price').val() * $('#units').val());
        //     }
        // );


        $('#product_id').change(function() {
            $("#supplier").html("");
            $("#supplier").selectpicker("refresh");
            // allow_half = $(this).find(':selected').attr('data-allow-half');
            // $('#hidden_allow_half').val(allow_half);
            var productID = $(this).val();
            // console.log(productID)
            if (productID) {
                $.ajax({
                    url: "{{ url('get-product-supplier') }}?product_id=" + productID,
                    type: "Get",
                    success: function(res) {
                        if (res) {
                            // console.log(res)
                            // $("#cost_price").empty();
                            $.each(res, function(key, company) {
                                $.each(company.supplier, function(test, supplier) {

                                    $("#supplier").append("<option value='" + supplier
                                        .id + "'>" + supplier.supplier_title +
                                        "</option>");
                                    $("#supplier").selectpicker("refresh");

                                });
                            });

                        } else {

                        }
                    }
                });
            } else {

            }
        });

        // $('#units').on('keyup', function() {
        //     if(allow_half == 0){
        //         $('#units').val(Math.floor($('#units').val()));
        //     }
        // });
    </script>
    <script src="{{ asset('js/product_stock/update_form_validation.js') }}"></script>
@endsection
