@extends('layout.default')
@section('title', 'Edit Payment')
@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Payments</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('customer-accounts.index') }}" class="text-muted">All Transactions</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">Edit Payment</a>
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
                                <h3 class="card-label">Edit Payment
                                    <!-- <span class="d-block text-muted pt-2 font-size-sm">Manage Accounts</span> -->
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form method="post" action="{{ route('customer-accounts.update', $customer_account->id) }}"
                                id="add_accounts_form" enctype="multipart/form-data">
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
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Customer*</label>
                                                <select class="form-control   " name="customer_id">
                                                    <option value="">Select Customer</option>
                                                    @foreach ($customers as $customer)
                                                        <option value="{{ $customer->id }}"
                                                            {{ $customer_account->customer_id == $customer->id ? 'selected' : '' }}>
                                                            {{ $customer->customer_name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Order ID</label>
                                                <input type="number" value="{{ $customer_account->order_id }}"
                                                    class="form-control    " name="order_id" placeholder="Add Order ID" />

                                            </div>
                                            <!--end::Input-->
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Amount*</label>
                                                <input type="number" step="0.1" class="form-control   " name="amount"
                                                    value="{{ $customer_account->amount }}" placeholder="Add Amount" />

                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <!--begin::Input-->
                                                <label for="type">Payment Type *</label>
                                                <select class="form-control   " id="type" name="payment_type">
                                                    <option value="">Select Payment Type</option>
                                                    <option value="credit"
                                                        {{ $customer_account->payment_type == 'credit' ? 'selected' : '' }}>
                                                        Credit</option>
                                                    <option value="debit"
                                                        {{ $customer_account->payment_type == 'debit' ? 'selected' : '' }}>Debit
                                                    </option>
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Payment Date *</label>
                                                <input type="text" class="form-control   " id="kt_datetimepicker_3"
                                                    value="{{ $customer_account->payment_date }}" readonly
                                                    name="payment_date" placeholder="Payment date" />
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <!--begin::Input-->
                                                <label>Payment Method *</label>
                                                <select class="form-control   " name="payment_method_id">
                                                    <option value="">Select Product Type</option>
                                                    @foreach ($payment_methods as $payment_method)
                                                        <option value="{{ $payment_method->id }}"
                                                            {{ $customer_account->payment_method_id == $payment_method->id ? 'selected' : '' }}>
                                                            {{ $payment_method->payment_title }}</option>
                                                    @endforeach
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-xl 12">
                                            <div class="form-group">
                                                <label for="exampleTextarea">Description</label>
                                                <textarea class="form-control   " id="exampleTextarea" name="description"
                                                    rows="5">{{ $customer_account->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <input type="hidden" name="order_id" value="1"> -->

                                    <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                                    <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
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

    <script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('js/customer_accounts/form_validation.js') }}"></script>

@endsection
