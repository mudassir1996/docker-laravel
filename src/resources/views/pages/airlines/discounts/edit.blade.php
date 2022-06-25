@extends('layout.default')
@section('title', 'Edit Outlet Discount')
@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Outlet Discount</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('outlet-discounts.index') }}" class="text-muted">All Discounts</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Edit Discount</a>
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
                                <h3 class="card-label">Edit Outlet Discount
                                    <!-- <span class="d-block text-muted pt-2 font-size-sm">All Categories</span> -->
                                </h3>
                            </div>

                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form method="post" action="{{ route('outlet-discounts.update', $outlet_discount->id) }}"
                                id="add_discount_form" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>Discount Title *</label>
                                                <input autocomplete="off" type="text" name="discount_title"
                                                    id="discount_title" class="form-control  "
                                                    value="{{ $outlet_discount->discount_title }}"
                                                    placeholder="Discount Title" />
                                                <p class="text-danger"> {{ $errors->first('discount_title') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>Discount Value *</label>
                                                <input autocomplete="off" type="text" name="discount_value"
                                                    id="discount_value" class="form-control  "
                                                    value="{{ $outlet_discount->discount_value }}"
                                                    placeholder="Discount Value" />
                                                <p class="text-danger"> {{ $errors->first('discount_value') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>Discount Type *</label>
                                                <select class="form-control selectpicker" id="discount_type"
                                                    name="discount_type">
                                                    <option value="percentage"
                                                        {{ $outlet_discount->discount_type == 'percentage' ? 'selected' : '' }}>
                                                        Percentage</option>
                                                    <option value="value"
                                                        {{ $outlet_discount->discount_type == 'value' ? 'selected' : '' }}>Value
                                                    </option>
                                                </select>
                                                <p class="text-danger"> {{ $errors->first('discount_type') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>Status *</label>
                                                <select class="form-control selectpicker" id="discount_status"
                                                    name="discount_status">
                                                    <option value="active"
                                                        {{ $outlet_discount->discount_status == 'active' ? 'selected' : '' }}>
                                                        Active</option>
                                                    <option value="inactive"
                                                        {{ $outlet_discount->discount_status == 'inactive' ? 'selected' : '' }}>
                                                        Inactive</option>
                                                </select>
                                                <p class="text-danger"> {{ $errors->first('discount_status') }}</p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleTextarea">Description</label>
                                        <textarea class="form-control   " id="exampleTextarea" name="discount_description"
                                            rows="5">{{ $outlet_discount->discount_description }}</textarea>
                                    </div>
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
        $('#btn-submit').click(() => {
            var discount_title = $('#discount_title').val();
            $('#discount_title').val(discount_title.trim());
        });
    </script>
    <script src="{{ asset('js/airlines/discounts/form_validation.js') }}"></script>
@endsection
