@extends('layout.default')
@section('title', 'SPP Chart')
@section('content')


<div class="row">
    
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body d-flex flex-column p-2">
                <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                    <div class="d-flex flex-column mr-2">
                        <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Report</a>
                        <span class="text-muted font-weight-bold mt-2"></span>
                    </div>
                </div>
                <div>
                    <table class="table nowrap ">
                        <thead>
                            <tr>
                                <th>Sold Quantity</th>
                                <th>Purchased Quantity</th>
                                <th>Total Sales</th>
                                <th>Total Purchases</th>
                                <th>Estimated Profit</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>{{$sold_quantity??0}}</td>
                                <td>{{$purchased_quantity??0}}</td>
                                <td>{{$sales_total??0}}</td>
                                <td>{{$purchase_total??0}}</td>
                                <td>{{$profit??0}}</td>

                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body d-flex flex-column p-2">
                <div>
                    {!! $salesChart->container() !!}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script src="{{asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
@endsection