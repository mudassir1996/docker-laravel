@extends('layout.default')
@section('title', 'Add Payment Category')
@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Payment Category</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('categories.index') }}" class="text-muted">All Payment Categories</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Edit Payment Category</a>
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
                <!--begin::Aside-->

                <!--end::Aside-->
                <!--begin::Content-->
                <div class="flex-row-fluid">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-header flex-wrap py-5">
                            <div class="card-title">
                                <h3 class="card-label">Edit Payment Category
                                    <!-- <span class="d-block text-muted pt-2 font-size-sm">All Categories</span> -->
                                </h3>
                            </div>

                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form method="post" action="{{ route('payment-categories.update', $payment_category->id) }}"
                                id="add_payment_category_form" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="form-group row mb-2">
                                    <div class="col-xl-6">
                                        <label>Title *</label>
                                        <input type="text" name="payment_category_title" id="payment_category_title"
                                            class="form-control   {{ $errors->first('payment_category_title') ? 'is-invalid' : '' }}"
                                            value="{{ $payment_category->payment_category_title }}" placeholder="Title" />
                                        @error('payment_category_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-xl-6">
                                        <!--begin::Input-->
                                        <label for="payment_category_status">Status</label>
                                        <select class="form-control" id="payment_category_status"
                                            name="payment_category_status">
                                            <option value="active"
                                                {{ $payment_category->payment_category_status == 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="inactive"
                                                {{ $payment_category->payment_category_status == 'inactive' ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleTextarea">Description</label>
                                    <textarea class="form-control" id="exampleTextarea"
                                        name="payment_category_description"
                                        rows="5">{{ $payment_category->payment_category_description }}</textarea>
                                </div>
                                <button type="submit" id="btn-submit"
                                    class="btn btn-primary btn-shadow px-12">Submit</button>

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
            var payment_category_title = $('#payment_category_title').val();
            $('#payment_category_title').val(payment_category_title.trim());
        });
    </script>
    <script src="{{ asset('js/cashbook/payment_category_validation.js') }}"></script>
@endsection
