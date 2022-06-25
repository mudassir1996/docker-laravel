@extends('layout.default')
@section('title', 'View Expense Transaction')
@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Expense Transaction</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('customer-accounts.index') }}" class="text-muted">All Transactions</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">View Transaction</a>
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
    <div class="d-flex flex-column-fluid" id="customer-account-transaction">
        <!--begin::Container-->
        <div class="container-fluid px-0">
            <div class="d-flex flex-row">
                <!--begin::Layout-->
                <div class="flex-row-fluid">
                    <!--begin::Section-->
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xxl-12">
                            <!--begin::Engage Widget 14-->
                            <div class="card card-custom card-stretch gutter-b">
                                <div class="card-body p-15 pb-20">
                                    <div class="row mb-17">

                                        <div class="col-xxl-12 ">
                                            <div class="row">
                                                <div class="col-8">
                                                    <h2 class="font-weight-bolder text-dark mb-7" style="font-size: 32px;">
                                                        {{ $expense_transaction->title }}
                                                    </h2>
                                                </div>
                                                <div class="col-4">
                                                    <a href="/outlets/expense-transaction/print-expense-transaction/{{ $expense_transaction->id }}" class="btn btn-primary"
                                                        target="__blank">Print</a>
                                                </div>
                                            </div>
                                            <div class="font-size-h2 mb-7 text-dark-50">Payment
                                                <span class="text-info font-weight-boldest ml-2">PKR
                                                    {{ $expense_transaction->amount }}</span>
                                            </div>
                                            <div class="line-height-xl">{{ $expense_transaction->description }}</div>
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <!--begin::Info-->
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Payment Method</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">
                                                    {{ $expense_transaction->payment_method  }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Payment Type</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">
                                                    {{ ucfirst($expense_transaction->payment_type_title) }}
                                                </span>
                                            </div>
                                        </div>
                                        {{-- <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Payment Date</span>
                                                <span
                                                    class="text-muted font-weight-bolder font-size-lg">{{ $expense_transaction->payment_date }}</span>
                                            </div>
                                        </div> --}}
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Referred User</span>
                                                <span
                                                    class="text-muted font-weight-bolder font-size-lg">{{ $expense_transaction->referred_user }}</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Created By</span>
                                                <span class="text-muted font-weight-bolder font-size-lg">
                                                    {{ $expense_transaction->employee_name }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Created At</span>
                                                <span
                                                    class="text-muted font-weight-bolder font-size-lg">{{ $expense_transaction->created_at }}</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="mb-8 d-flex flex-column">
                                                <span class="text-dark font-weight-bold mb-4">Updated At</span>
                                                <span
                                                    class="text-muted font-weight-bolder font-size-lg">{{ $expense_transaction->updated_at }}</span>
                                            </div>
                                        </div>
                                        <!--end::Info-->
                                    </div>

                                </div>
                            </div>
                            <!--end::Engage Widget 14-->
                        </div>
                    </div>
                    <!--end::Section-->
                </div>
                <!--end::Layout-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection

{{-- @section('scripts')

    <script>
     function print_transaction()
     {
        var prtContent = document.getElementById("customer-account-transaction");

        prtContent.getElementsByClassName('btn btn-primary').innerHTML="";

        var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
        WinPrint.document.write(prtContent.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        // WinPrint.close();
     }
    </script>
@endsection --}}