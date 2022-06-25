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
            <form action="{{route('daily_summary.filter')}}" method="post">
                @csrf
                <div class="card-header p-4 d-flex flex-column">
                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Filter</a>
                </div>
                <div class="card-body d-flex flex-column p-5">
                    <div class="form-group row mb-1">
                        <div class="col-xl-2">
                            <div class="form-group">
                                <label for="">From Date</label>
                                <input type="text" id="datepicker_from" readonly value="{{(request()->from_date!='')?request()->from_date:''}}" class="form-control form-control-sm" name="from_date" placeholder="Select Date">
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group">
                                <label for="">To Date</label>
                                <input type="text" id="datepicker_to" readonly value="{{(request()->to_date!='')?request()->to_date:''}}" class="form-control form-control-sm" name="to_date" placeholder="Select Date">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-shadow mt-8 col-4 col-xl-1" type="submit">Search</button>
                </div>

            </form>
        </div>
    </div> 
</div>
<div class="row mt-12 justify-content-center">
    <div class="col-xl-6 mb-5">
        <div class="card" style="height: 360px;" >
            <div class="card-body">
                <div class="d-flex flex-column mr-2 pb-5">
                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">In Coming</a>
                    <span class="text-muted font-weight-bold mt-2">From {{$fromDate}} to {{$toDate}}</span>
                </div>
                <div>
                    <table class="table nowrap" >
                        <tr>
                            <td scope="row">Cash Sales</td>
                            <td>{{ $IncashSales->sum('amount_payable') }}</td>
                        </tr>
                
                        <tr>
                            <td scope="row">Split Bill (Paid)</td>
                            <td>{{ $InsplitBillSales->sum('amount_paid') }}</td>
                        </tr>

                        <tr>
                            <td scope="row">Customer Cash In</td>
                            <td>{{ $IncustomerSales->sum('amount') }}</td>
                        </tr>

                        <tr class="font-size-h5 font-weight-bolder">
                            <td scope="row" >Total</td>
                            <td>{{ $IncashSales->sum('amount_payable') + $InsplitBillSales->sum('amount_paid') + $IncustomerSales->sum('amount')}}</td>
                        </tr>
                    </table>
                </div>
                
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card card-custom" style="height: 360px;">
            <div class="card-body">
                <div class="d-flex flex-column mr-2 pb-5">
                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Out Going</a>
                    <span class="text-muted font-weight-bold mt-2">From {{$fromDate}} to {{$toDate}}</span>
                </div>
               
                <table class="table nowrap ">
                    <tr>
                        <td scope="row">Credit Sales</td>
                        <td>{{ $OutcreditSales->sum('amount_payable') }}</td>
                    </tr>
                    <tr>
                        <td scope="row">Split Bill (Not Paid)</td>
                        <td>{{ abs($OutsplitBillSales->sum('change_back')) }}</td>
                    </tr>

                    <tr>
                        <td scope="row">Customer Cash In</td>
                        <td>{{ $OutcustomerSales->sum('amount') }}</td>
                    </tr>
                    <tr>
                        <td scope="row">Expenses</td>
                        <td>{{ $expenses->sum('amount') }}</td>
                    </tr>
                    <tr>
                        <td scope="row">Purchase Orders</td>
                        <td>{{ $purchaseOrders->sum('amount_payable') }}</td>
                    </tr>

                    <tr class="font-size-h5 font-weight-bolder">
                        <td scope="row">Total Sales</td>
                        <td>
                            {{ $purchaseOrders->sum('amount_payable') +  $OutcreditSales->sum('amount_payable') + abs($OutsplitBillSales->sum('change_back')) + $OutcustomerSales->sum('customer_amount') + $expenses->sum('amount')}}
                        </td>
                    </tr>
                </table>
               
                
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')
<script src="{{asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
@endsection
