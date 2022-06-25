@extends('layout.default')
@section('title', 'Edit Expense Transaction')
@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Expense</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">

                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Expense Transaction</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('expense-transaction.index') }}" class="text-muted">Expense Transaction
                                List</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Edit Expense Transaction</a>
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
                                <h3 class="card-label">Edit Expense Transaction
                                    <!-- <span class="d-block text-muted pt-2 font-size-sm">All Companies</span> -->
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form method="post"
                                action="{{ route('expense-transaction.update', $expense_transaction->id) }}"
                                id="add_expense_transaction_form" enctype="multipart/form-data">
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
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Title *</label>
                                                <input type="text" id="title"
                                                    class="form-control    {{ $errors->first('title') ? 'is-invalid' : '' }}"
                                                    value="{{ $expense_transaction->title }}" name="title"
                                                    placeholder="Expense Transaction Title" />
                                                <p class="text-danger"> {{ $errors->first('title') }}</p>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Amount *</label>
                                                <input type="number" step="0.1"
                                                    class="form-control   {{ $errors->first('amount') ? 'is-invalid' : '' }}"
                                                    value="{{ $expense_transaction->amount }}" name="amount"
                                                    placeholder="Expense Transaction Amount" />
                                                <p class="text-danger"> {{ $errors->first('amount') }}</p>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <!--begin::Input-->
                                                <label for="expense_category">Expense Category *</label>
                                                <div class="input-group">
                                                    <select class="form-control    selectpicker" data-live-search="true"
                                                        data-size="5" id="expense_category" name="expense_category_id"
                                                        title="Choose one of the following...">
                                                        @foreach ($expense_categories as $id => $expense_category)
                                                            <option value="{{ $id }}"
                                                                {{ $expense_transaction->expense_category_id == $id ? 'selected' : '' }}>
                                                                {{ $expense_category }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button" data-toggle="modal"
                                                            data-target="#expense_category_model">
                                                            Add New
                                                        </button>
                                                    </div>
                                                </div>
                                                <p class="text-danger"> {{ $errors->first('expense_category_id') }}</p>

                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <!--begin::Input-->
                                                <label for="referred_user_id">Referred User *</label>
                                                <select class="form-control    selectpicker" data-live-search="true"
                                                    data-size="5" id="referred_user_id" name="referred_user_id"
                                                    title="Choose one of the following...">
                                                    @foreach ($employees as $id => $employee)
                                                        <option value="{{ $id }}"
                                                            {{ $expense_transaction->referred_user_id == $id ? 'selected' : '' }}>
                                                            {{ $employee }}</option>
                                                    @endforeach
                                                </select>
                                                <p class="text-danger"> {{ $errors->first('referred_user_id') }}</p>

                                                <!--end::Input-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Payment Type *</label>
                                                <select class="form-control   selectpicker" data-live-search="true"
                                                    data-size="5" name="payment_type"
                                                    title=" Choose one of the following..."">
                                                    <option value=" debit"
                                                    {{ $expense_transaction->payment_type == 'debit' ? 'selected' : '' }}>Debit
                                                    </option>
                                                    <option value="credit"
                                                        {{ $expense_transaction->payment_type == 'credit' ? 'selected' : '' }}>
                                                        Credit</option>
                                                </select>
                                                <p class="text-danger">{{ $errors->first('payment_type') }}</p>
                                            </div>
                                            <!--end::Input-->

                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <!--begin::Input-->
                                                <label for="payment_method_id">Payment Method *</label>
                                                <select class="form-control    selectpicker" data-live-search="true"
                                                    data-size="5" id="payment_method_id" name="payment_method_id"
                                                    title="Choose one of the following...">
                                                    @foreach ($payment_methods as $id => $payment_method)
                                                        <option value="{{ $id }}"
                                                            {{ $expense_transaction->payment_method_id == $id ? 'selected' : '' }}>
                                                            {{ $payment_method }}</option>
                                                    @endforeach
                                                </select>
                                                <p class="text-danger"> {{ $errors->first('payment_method_id') }}</p>

                                                <!--end::Input-->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleTextarea">Description</label>
                                        <textarea class="form-control   " id="exampleTextarea" name="description"
                                            rows="5">{{ $expense_transaction->description }}</textarea>
                                    </div>

                                    <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                                    <input type="hidden" name="created_by" value="{{ session('employee_id') }}">
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
    <!-- EXPENSE CATEGORY MODEL -->
    <div class="modal fade" id="expense_category_model" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="add_expense_category_form" class="add_expense_category">

                    <div class="modal-header p-4">
                        <h6 class="modal-title" id="expense_category_model">Add Expense Category</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group row mb-0">
                            <div class="col-xl-12">
                                <div class="form-group mb-5">
                                    <label>Title*</label>
                                    <input type="text" class="form-control" autofocus id="title" name="title"
                                        placeholder="Expense Category Title" />

                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                        <input type="hidden" name="created_by" value="{{ session('employee_id') }}">
                        <button class="btn btn-primary btn-shadow px-12 mt-4" id="save-expense-category">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection



{{-- Scripts Section --}}

@section('scripts')
    <script>
        $('#btn-submit').click(() => {
            var title = $('#title').val();
            $('#title').val(title.trim());
        });
    </script>
    <script src="{{ asset('js/expense-transaction/form_validation.js') }}"></script>
    <script>
        $("#save-expense-category").on("click", function(event) {
            event.preventDefault();
            let _token = $('meta[name="csrf-token"]').attr("content");
            let title = $("#title").val();
            let created_by = $("input[name=created_by]").val();
            let outlet_id = $("input[name=outlet_id]").val();
            // data = document.getElementById("add_customer_form"),
            $.ajax({
                url: "{{ route('expense-category.add-expense-category') }}",
                type: "POST",
                data: {
                    title: title,
                    created_by: created_by,
                    outlet_id: outlet_id,
                    _token: _token,
                },
                success: function(response) {
                    $("#expense_category_model").modal("toggle");
                    toastr.success("Expense Category Added");
                    $("[name='title']").val("");

                    $.ajax({
                        url: "{{ url('get-expense-category') }}?id=" + response,
                        type: "Get",
                        success: function(res) {
                            $.each(res, function(key, value) {
                                $("#expense_category").append(
                                    "<option value='" + key + "'>" + value +
                                    "</option>"
                                );
                            });
                            $("#expense_category").selectpicker("refresh");
                            var newVal = $("#expense_category option:last").val();
                            $("#expense_category").selectpicker("val", [newVal]);

                        },
                    });
                },
                error: function(response) {
                    $("#expense_category_model").modal("toggle");
                    toastr.error("Error! Please try again");
                    $("[name='title']").val("");
                },
            });
        });
    </script>
@endsection
