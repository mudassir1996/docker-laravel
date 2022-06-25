<div class="card card-custom mb-3" style="background: #f9f9f9">
    <div class="card-body py-4">
        <div class="form-group row mb-2">
            <div class="col-xl-3 pr-0 mb-2">
                <label for="">Invoice Date</label>
                <p class=" font-weight-bolder  ">
                    {{-- <i class="fas fa-calendar text-dark text-hover-primary invoice_date_picker mr-1" role="button"></i> --}}
                    <span class="invoice_date_picker_date">

                        {{ date('d-m-Y', strtotime($airline_order->order_completion_date)) }}
                    </span>

                </p>

                <input type="hidden" name="invoice_date" id="invoice_date" value="{{ date('d-m-Y', time()) }}">
            </div>
            <div class="col-xl-3 pr-0">
                <label for="">Invoice Category</label>
                <p class="font-weight-bolder  ">{{ ucfirst($airline_order->category_title) }}</p>
            </div>
            <div class="col-xl-3 pr-0">
                <label for="">Receipt No.</label>
                <p class="font-weight-bolder  ">{{ $airline_order->id }}</p>
                {{-- <input type="text" name="" id="" disabled style="height:30px" class="form-control p-2"
                    placeholder="Receipt No"> --}}
            </div>
            <div class="col-xl-3 pr-0">
                <label for="">Status</label>
                <p class="font-weight-bolder  ">Refunded</p>
            </div>

            <div class="col-xl-3 pr-0">
                <label for="client">Client</label>
                <p class="font-weight-bolder  ">{{ ucfirst($airline_order->customer_party_title) }}</p>
            </div>
            <div class="col-xl-3 pr-0">
                <label for="agent">Agent/Airline</label>
                <p class="font-weight-bolder  ">{{ ucfirst($airline_order->supplier_party_title) }}</p>
            </div>
        </div>
    </div>
</div>
