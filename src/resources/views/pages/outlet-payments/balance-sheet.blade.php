@extends('layout.default')
@section('title', 'Outlet Transactions')
@section('content')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Outlet Transaction</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">All Transaction</a>
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
            <div class="d-flex flex-row justify-content-center">

                <div class="col-xl-8">
                    <div class="card card-custom bgi-no-repeat gutter-b"
                        style="height:200px; background-color: #1F2044; background-position: calc(100% + 0.5rem) 100%; background-size: 60% auto; background-image: url({{ asset('media/svg/patterns/rhone-2.svg') }})">
                        <!--begin::Body-->
                        <div class="card-body d-flex align-items-center">
                            <div>
                                <h3 class="text-white font-weight-bolder line-height-lg mb-5">
                                    Outlet Accounts Balance Sheet
                                    <p class="text-white font-weight-light font-size-sm">with respect to payment methods</p>
                                </h3>

                                <a href="{{ route('outlet-payment-transactions.index') }}"
                                    class="btn btn-success font-weight-bold px-6 py-3">View Transactions</a>
                                <button class="btn btn-success font-weight-bold px-6 py-3" data-toggle="modal"
                                    data-target="#transferModal">Cash Transfer</button>
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-center">

                <div class="col-xl-8">
                    @foreach ($balance_sheet as $key => $payment_method)
                        @php
                            $id = str_replace(' ', '_', $key);
                        @endphp
                        <div class="card card-custom mb-5">
                            <!--begin::Body-->
                            <a href="{{ route('outlet-payment-transactions.index', ['payment_method_id' => $payment_method->first()->payment_method_id]) }}"
                                class="card-body d-flex align-items-center justify-content-between flex-wrap text-dark">
                                <div class="mr-2">
                                    <h2 class="font-weight-bolder">{{ $key }}</h2>
                                    <span class="text-muted">
                                        Click to see transactions
                                    </span>
                                </div>
                                <div class="font-weight-boldest font-size-h1">
                                    Rs {{ App\Classes\CurrencyFormatter::get($payment_method->first()->balance ?? 0) }}
                                </div>
                            </a>
                            <!--end::Body-->

                        </div>
                    @endforeach
                </div>
            </div>
            <!--end::Teachers-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
    <div class="modal fade" id="transferModal" tabindex="-1" role="dialog" data-backdrop="static"
        aria-labelledby="transferModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('outlet-cash-transfer') }}" method="post" id="transferForm">
                    @csrf
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title" id="transferModalLabel">Cash Transfer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-xl-6">
                                <label>
                                    Transfer From
                                </label>
                                <select name="account_from" id="account_from" title="Select" data-size="3"
                                    class="form-control selectpicker">
                                    @foreach ($payment_methods as $payment_method)
                                        <option value="{{ $payment_method->id }}">
                                            {{ $payment_method->payment_title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-6">
                                <label>
                                    Transfer To
                                </label>
                                <select name="account_to" id="account_to" title="Select" data-size="3"
                                    class="form-control selectpicker">
                                    @foreach ($payment_methods as $payment_method)
                                        <option value="{{ $payment_method->id }}">
                                            {{ $payment_method->payment_title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-xl-6">
                                <label for="">Amount</label>
                                <input type="text" autocomplete="off" placeholder="Enter Amount" name="amount" id="amount"
                                    class="form-control text-left">
                            </div>
                            <div class="col-xl-6">
                                <label for="">Purpose</label>
                                <textarea rows="1" placeholder="Purpose" name="purpose" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light-primary font-weight-bold btn-pill"
                            data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary font-weight-bold btn-pill">Transfer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection




{{-- Scripts Section --}}

@section('scripts')
    <script src="{{ asset('js/outlet_accounts/cash_transfer_validation.js') }}"></script>
    <script>
        $("#amount").inputmask("decimal", {
            rightAlignNumerics: false,
            allowMinus: false,
        });

        function exchange() {
            $(".selectpicker").find('option').prop('disabled', false);
            var account_from_val = $('#account_from').find(':selected').val();
            var account_to_val = $('#account_to').find(':selected').val();
            $('#account_from').selectpicker('val', account_to_val);
            $('#account_to').selectpicker('val', account_from_val);
        }

        function disableDropdownOption(d1, d2) {
            var d1_val = $('#' + d1).find(':selected').val();
            $('#' + d2).find("option").prop("disabled", false);
            $('#' + d2).selectpicker('refresh');
            $('#' + d2).find("[value='" + d1_val + "']").prop("disabled", true);
            $('#' + d2).selectpicker('refresh');
        }
        $('#account_from').on('changed.bs.select', () => {
            disableDropdownOption('account_from', 'account_to')
        });
        $('#account_to').on('changed.bs.select', () => {
            disableDropdownOption('account_to', 'account_from')
        });


        $("#transferModal").on("hidden.bs.modal", function(e) {
            $("#transferModal").modal("hide");
            $("#transferForm").trigger("reset");
            $(".selectpicker").find('option').prop('disabled', false);
            $(".selectpicker").selectpicker("refresh");
        });
    </script>
@endsection
