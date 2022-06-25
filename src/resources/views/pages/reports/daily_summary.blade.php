@extends('layout.default')
@section('title', 'Daily Summary')
@section('content')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Daily Summary</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Daily Summary Report</a>
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



    <div class="row">
        <div class="col-xl-12 mb-6">
            <div class="card">
                <form action="{{ route('daily_summary.filter') }}" method="post">
                    @csrf

                    <div class="card-body d-flex flex-column p-5">
                        <div class="form-group row mb-1">
                            <div class="col-xl-2">
                                <div class="form-group">
                                    <label for="">From Date</label>
                                    <input type="text" id="datepicker_from" readonly
                                        value="{{ request()->from_date != '' ? request()->from_date : date('Y-m-d') }}"
                                        class="form-control form-control-sm" name="from_date" placeholder="Select Date">
                                </div>
                            </div>
                            <div class="col-xl-2">
                                <div class="form-group">
                                    <label for="">To Date</label>
                                    <input type="text" id="datepicker_to" readonly
                                        value="{{ request()->to_date != '' ? request()->to_date : date('Y-m-d') }}"
                                        class="form-control form-control-sm" name="to_date" placeholder="Select Date">
                                </div>
                            </div>
                            <div class="col-xl-2">
                                <button class="btn btn-primary mt-7" type="submit">Search</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-3 mb-5">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="text-dark font-weight-bolder font-size-h2 ">
                                            {{ number_format((float) $avgOrderQuantity, 2, '.', '') }}
                                        </div>
                                        <span class="text-muted font-weight-bold font-size-lg mt-1">Averege Product
                                            Quantity</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 mb-5">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="text-dark font-weight-bolder font-size-h2 ">PKR
                                            {{ App\Classes\CurrencyFormatter::get($avgOrderBill) }}</div>
                                        <span class="text-muted font-weight-bold font-size-lg mt-1">Averege Order
                                            Bill</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 mb-5">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="text-dark font-weight-bolder font-size-h2 ">
                                            PKR {{ App\Classes\CurrencyFormatter::get($grandTotal) }}</div>
                                        <span class="text-primary font-weight-bold font-size-lg mt-1">Grand
                                            Total</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 mb-5">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="text-dark font-weight-bolder font-size-h2 ">
                                            PKR {{ App\Classes\CurrencyFormatter::get($totalDiscount) }}
                                        </div>
                                        <span class="text-warning font-weight-bold font-size-lg mt-1">
                                            Total Discount
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 mb-5">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="text-dark font-weight-bolder font-size-h2 ">
                                            PKR {{ App\Classes\CurrencyFormatter::get($payableBill) }}
                                        </div>
                                        <span class="text-info font-weight-bold font-size-lg mt-1">
                                            Total Bill
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 mb-5">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="text-dark font-weight-bolder font-size-h2 ">
                                            PKR {{ App\Classes\CurrencyFormatter::get($totalProfit) }}
                                        </div>
                                        <span class="text-dark font-weight-bold font-size-lg mt-1">
                                            Total Profit
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 mb-5">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="text-dark font-weight-bolder font-size-h2 ">
                                            PKR {{ App\Classes\CurrencyFormatter::get($totalExpenses) }}
                                        </div>
                                        <span class="text-danger font-weight-bold font-size-lg mt-1">
                                            Total Expenses
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 mb-5">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="text-dark font-weight-bolder font-size-h2 ">
                                            PKR {{ App\Classes\CurrencyFormatter::get($totalIncome) }}
                                        </div>
                                        <span class="text-success font-weight-bold font-size-lg mt-1">
                                            Total Income
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>
@endsection
