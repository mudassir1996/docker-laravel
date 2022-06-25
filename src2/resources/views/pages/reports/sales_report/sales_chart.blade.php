@extends('layout.default')
@section('title', 'Sales Report')
@section('content')
<!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Sales Report</h5>
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
            <form action="{{route('sales_report.filter')}}" method="post">
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
        <div class="col-xl-12 mt-3">
            <div class="card">
                <div class="card-body ">
                   <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Top 10 Sales</a>
                    <div >
                        <table class="table table-head-custom nowrap mt-5">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Customer Name</th>
                                    <th>Products</th>
                                    <th>Amount</th>

                                </tr>
                            </thead>
                            <tbody>
                                   
                                @forelse($top_sales as $id => $top_sale)
                                <tr>
                                    <td>{{$id+1}}</td>
                                    <td>{{$top_sale->customer_name}}</td>
                                    <td>
                                        @php
                                        $quantity = 0;
                                        foreach ($top_sale->sales_order_detail as $sale_order_detail){
                                            $quantity+=$sale_order_detail->quantity;
                                        }
                                        echo $quantity;
                                        @endphp
                                    </td>
                                    <td>{{ $top_sale->amount_payable }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan=6>No Records</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-6 mt-10">
            <div class="card">
                <div class="card-body">
                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Top 10 Sold Products</a>
                    
                        <table class="table table-head-custom nowrap mt-5">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($top_products as $id => $top_product)

                                <tr>
                                    <td>{{$id+1}}</td>
                                    <td>{{$top_product->product_title}}</td>
                                    <td>{{abs($top_product->total_quantity)}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan=6>No Records</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    

                </div>
            </div>
        </div>
        <div class="col-xl-6 mt-10">
            <div class="card">
                <div class="card-body">
                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5" >Top 5 Cutomers</a>
                    <div>
                        <table class="table table-head-custom nowrap mt-5">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Customer Name</th>
                                    <th>Total Sales Amount</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($top_customers as $id => $top_customer)

                                <tr>
                                    <td>{{$id+1}}</td>
                                    <td>{{$top_customer->customer_name}}</td>
                                    <td>{{$top_customer->total_sales}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan=6>No Records</td>
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
            <div class="card">
                <div class="card-body">
                   <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Top Categories</a>
                        <table class="table table-separate table-head-custom nowrap table-checkable" id="kt_datatable_category_report">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Category</th>
                                    <th>Sales</th>
                                    <th>Products</th>
                                    <th>Amount</th>

                                </tr>
                            </thead>
                            <tbody>
                           
                                @forelse($top_categories as $id => $top_category)

                                <tr>
                                    <td>{{$id+1}}</td>
                                    <td>{{$top_category['category_name']}}</td>
                                    <td>{{$top_category['total_sales']}}</td>
                                    <td>{{$top_category['product_quantity']}}</td>
                                    <td>{{$top_category['product_amount']}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan=6>No Records</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                </div>
            </div>
        </div>

    </div>

{{-- </div> --}}



@endsection

{{-- Styles Section --}}
<!-- @section('styles')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection -->


{{-- Scripts Section --}}

@section('scripts')
{{--vendors--}}
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js?v=7.0.5')}}"></script>

{{-- Products Data --}}
<script src="{{asset('js/pages/crud/datatables/basic/reports_tables.js')}}"></script>
<script src="{{asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
@endsection
