@extends('layout.default')
@section('title', 'Purchase Report')
@section('content')
<!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Purchase Report</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    {{-- <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Daily Summary Report</a>
                        </li>
                    </ul> --}}
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
            <form action="{{route('purchase_report.filter')}}" method="post">
                @csrf
                <div class="card-header p-4 d-flex flex-column">
                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Filter</a>
                </div>
                <div class="card-body d-flex flex-column p-5">
                    <div class="form-group row mb-1">
                        <div class="col-xl-2">
                            <div class="form-group mb-0">
                                <label for="">From Date</label>
                                <input type="text" id="datepicker_from" readonly value="{{(request()->from_date!='')?request()->from_date:''}}" class="form-control form-control-sm" name="from_date" placeholder="Select Date">
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group mb-0">
                                <label for="">To Date</label>
                                <input type="text" id="datepicker_to" readonly value="{{(request()->to_date!='')?request()->to_date:''}}" class="form-control form-control-sm" name="to_date" placeholder="Select Date">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-shadow mt-8 col-1" type="submit">Search</button>
                </div>

            </form>
        </div>
    </div>
</div>

    <div class="row">
        <div class="col-xl-6 mt-3">
            <div class="card card-custom">
                <div class="card-body">
                   <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Top 10 Purchases</a>
                    <div class="card-scroll" style="height: 460px">
                        <table class="table nowrap mt-5">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Supplier Name</th>
                                    <th>Products</th>
                                    <th>Amount</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($top_purchases as $id => $top_purchase)
                                <tr>
                                    <td>{{ $id+1 }}</td>
                                    <td>
                                     
                                        {{$top_purchase->supplier_name}}</td>
                                    <td>
                                        @php
                                        $quantity = 0;
                                        foreach ($top_purchase->purchase_order_details as $purchase_order_detail){
                                            $quantity+=$purchase_order_detail->purchased_quantity;
                                        }
                                        echo $quantity;
                                    @endphp
                                    </td>
                                    <td>{{ $top_purchase->amount_payable }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan=6 class="text-center">No Record</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-6 mt-3">
            <div class="card card-custom">
                <div class="card-body">
                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Top 10 Purchased Products</a>
                    <div class="card-scroll" style="height: 460px">
                        <table class="table nowrap mt-5">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 0
                                @endphp
                                @forelse($top_products as $top_product)

                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{$top_product->product_title}}</td>
                                    <td>{{abs($top_product->total_quantity)}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan=6 class="text-center">No Record</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row mt-6">
        <div class="col-xl-12 mt-3">
            <div class="card card-custom">
                <div class="card-body">

                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Top 5 Suppliers</a>
                    <div class="card-scroll" style="height: 273px">
                        <table class="table nowrap mt-5">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Supplier Name</th>
                                    <th>Total Purchases</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($top_suppliers as $id => $top_supplier)
                                <tr>
                                    <td>{{ $id+1 }}</td>
                                    <td>{{$top_supplier->supplier_title}}</td>
                                    <td>{{ $top_supplier->total_purchases }}</td>
                                    <td>{{$top_supplier->total_amount}}</td>
                                </tr>
                               
                                @empty
                                <tr>
                                    <td colspan=6 class="text-center">No Record</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>



    </div>

    <div class="row mt-6">
        <div class="col-xl-6 mt-3">
            <div class="card card-custom">
                <div class="card-body">
                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Top Categories</a>
                    <div class="card-scroll" style="height: 273px">
                        <table class="table nowrap mt-5">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Category</th>
                                    <th>Purchases</th>
                                    <th>Products</th>
                                    <th>Amount</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($top_categories as $id => $top_category)
                                <tr>
                                    <td>{{ $id+1 }}</td>
                                    <td>{{$top_category['category_name']}}</td>
                                    <td>{{$top_category['total_purchases']}}</td>
                                    <td>{{$top_category['product_quantity']}}</td>
                                    <td>{{$top_category['product_amount']}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan=6 class="text-center">No Record</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-6 mt-3">
            <div class="card card-custom">
                <div class="card-body">
                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Top Companies</a>
                    <div class="card-scroll" style="height: 273px">
                        <table class="table nowrap mt-5">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Company</th>
                                    <th>Purchases</th>
                                    <th>Products</th>
                                    <th>Amount</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($top_companies as $id => $top_company)

                                <tr>
                                    <td>{{ $id+1 }}</td>
                                    <td>
                                        {{$top_company['company_name']}}
                                    </td>
                                    <td>{{$top_company['total_purchases']}}</td>
                                    <td>{{$top_company['product_quantity']}}</td>
                                    <td>{{$top_company['product_amount']}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan=6 class="text-center">No Record</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>




@endsection

@section('scripts')
<script src="{{asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
@endsection
