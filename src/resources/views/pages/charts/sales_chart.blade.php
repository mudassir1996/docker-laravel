@extends('layout.default')
@section('title', 'Sales Chart')
@section('content')



<!-- <div class="card" style="width: 35%">
    <div class="card-body">
        <div>

        </div>
    </div>
</div> -->

<div class="card" style="width: 40%">

    <div class="card-body d-flex flex-column p-2">
        <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
            <div class="d-flex flex-column mr-2">
                <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5">Weekly Sales</a>
                <span class="text-muted font-weight-bold mt-2">Your Weekly Sales Chart</span>
            </div>
            <!-- <span class="symbol symbol-light-success symbol-45">
                <span class="symbol-label font-weight-bolder font-size-h6">+57</span>
            </span> -->
        </div>
        <div>
            {!! $salesChart->container() !!}
        </div>
    </div>
</div>

@endsection