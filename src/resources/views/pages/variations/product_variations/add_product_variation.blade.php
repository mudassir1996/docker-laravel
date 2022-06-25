@extends('layout.default')
@section('title', 'Add Product Variations')
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
                            <a href="#" class="text-muted">Add Product Variation</a>
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
                                <h3 class="card-label">Add Product Variation
                                    <!-- <span class="d-block text-muted pt-2 font-size-sm">Manage Customers</span> -->
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form method="post" action="{{ route('product-variations.store') }}" id="Add_employee_form"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-xl-2">
                                        <label>Select Product</label>
                                        <select name="product_id" class="form-control selectpicker" data-size="5"
                                            data-live-search="true">
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->product_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xl-2">
                                        <label>Cost Price</label>
                                        <input type="text" placeholder="cost price" id="cost_price" class="form-control  ">
                                    </div>
                                    <div class="col-xl-2">
                                        <label>Retail Price</label>
                                        <input type="text" placeholder="cost price" id="retail_price"
                                            class="form-control  ">
                                    </div>
                                    <div class="col-xl-2">
                                        <label>Units</label>
                                        <input type="text" placeholder="cost price" id="units" class="form-control  ">
                                    </div>
                                    <div class="col-xl-2">
                                        <label>SKU</label>
                                        <input type="text" placeholder="cost price" id="sku" class="form-control  ">
                                    </div>
                                    <div class="col-xl-2">
                                        <label>Minimum</label>
                                        <input type="text" placeholder="cost price" id="minimum" class="form-control  ">
                                    </div>

                                </div>
                                <h3 class="mb-4">Variations</h3>
                                <div class="form-group row align-items-center" id="variations">
                                    @foreach ($variations as $variation)
                                        <div class="col-xl-3 attr">
                                            <label>{{ $variation->variation_title }}</label>
                                            <select name="variation_attr" id="{{ $loop->iteration }}"
                                                class="form-control selectpicker data" data-size="5"
                                                title="Select Variation" data-live-search="true" multiple>
                                                @foreach ($variation->variation_attributes as $variation_attribute)
                                                    <option value="{{ $variation_attribute->value }}">
                                                        {{ $variation_attribute->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endforeach
                                    <div class="col-xl-3">
                                        <button type="button" class="btn btn-primary mt-7" id="combo_btn">Add
                                            Variation</button>
                                    </div>
                                </div>
                                <table class="table table-separate table-head-custom" style="display: none">
                                    <thead>
                                        <tr>
                                            <td>
                                                Variation
                                            </td>
                                            <td>
                                                Cost Price
                                            </td>
                                            <td>
                                                Retial Price
                                            </td>
                                            <td>
                                                Units
                                            </td>
                                            <td>
                                                SKU
                                            </td>
                                            <td>
                                                Minimum Threshold
                                            </td>
                                            <td>

                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody id="list">

                                    </tbody>
                                </table>
                                <div class="card-footer text-right">
                                    <button type="submit" style="display: none" id="add_variation"
                                        class="btn btn-primary btn-shadow font-weight-bolder text-uppercase px-9 mr-2">Save
                                        Variation</button>
                                </div>
                                <!--end::Form-->
                            </form>
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
        function combos(list, n = 0, result = [], current = []) {
            if (n === list.length) result.push(current)
            else list[n].forEach(item => combos(list, n + 1, result, [...current, item]))
            return result
        }


        $('#combo_btn').click(() => {
            let variation = [];
            for (let index = 0; index < $('[name="variation_attr"]').length; index++) {
                if ($('[name="variation_attr"]').eq(index).val() != '') {
                    variation.push($('[name="variation_attr"]').eq(index).val());
                }
            }
            let variation_combo = [];
            variation_combo = combos(variation);
            variation.length > 0 ? $('.table').show() : $('.table').hide();
            variation.length > 0 ? $('#add_variation').show() : $('#add_variation').hide();
            $('#list').empty()

            let output = '';
            for (let i = 0; i < variation_combo.length; i++) {
                output = '<tr id="row_' + i + '">' +
                    '<td id="combo">' +
                    '<input type="hidden" name="variation_combo[]" value="' + variation_combo[i] + '">';
                for (let j = 0; j < variation_combo[i].length; j++) {
                    output += '<span class="badge badge-primary mr-1">' + variation_combo[i][j] + '</span>';

                }
                output += '</td>' +
                    '<td>' +
                    '<input type="text" placeholder="cost price" name="cost_price[]" value="' + $('#cost_price')
                    .val() + '" class="form-control">' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" placeholder="retail price" name="retail_price[]"  value="' + $(
                        '#retail_price').val() + '" class="form-control">' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" placeholder="units" name="units_in_stock[]"  value="' + $('#units').val() +
                    '" class="form-control">' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" placeholder="SKU" name="sku[]"  value="' + $('#sku').val() +
                    '" class="form-control">' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" placeholder="Minimum Threshold" name="minimum_threshold[]"  value="' + $(
                        '#minimum').val() + '" class="form-control">' +
                    '</td>' +
                    '<td>' +
                    '<a href="javascript:;" id="' + i +
                    '" class="btn font-weight-bold btn-danger btn-icon remove">' +
                    '<i class="la la-remove"></i>' +
                    '</a>' +
                    '</td>' +
                    '</tr>';
                // console.log(output);

                $('#list').append(output);
            }

        });
        $(document).on('click', '.remove', function() {
            var row_id = $(this).attr("id");
            $('#row_' + row_id + '').remove();
        });
    </script>

    <script>
        $("#save-category").on("click", function(event) {
            event.preventDefault();
            $("#save-category").attr("disabled", true);
            let _token = $('meta[name="csrf-token"]').attr("content");
            let category_title = $("input[name=category_title]").val();
            let created_by = $("input[name=created_by]").val();
            let outlet_id = $("input[name=outlet_id]").val();
            // data = document.getElementById("add_customer_form"),
            $.ajax({
                url: "{{ route('categories.add-category') }}",
                type: "POST",
                data: {
                    category_title: category_title,
                    created_by: created_by,
                    outlet_id: outlet_id,
                    _token: _token,
                },
                success: function(response) {
                    // console.log(response);
                    $("#category_model").modal("toggle");
                    $("#save-category").attr("disabled", false);
                    toastr.success("Category Added");
                    $("[name='category_title']").val("");

                    $.ajax({
                        url: "{{ url('get-category') }}?id=" + response,
                        type: "Get",
                        success: function(res) {
                            $.each(res, function(key, value) {
                                $("#category").append(
                                    "<option value='" + key + "'>" + value +
                                    "</option>"
                                );
                            });
                            $("#category").selectpicker("refresh");
                            var newVal = $("#category option:last").val();
                            $("#category").selectpicker("val", [newVal]);

                        },
                    });
                },
                error: function(response) {
                    $("#category_model").modal("toggle");
                    $("#save-category").attr("disabled", false);
                    toastr.error("Error! Please try again");
                    $("[name='category_title']").val("");
                },
            });
        });
    </script>


@endsection
