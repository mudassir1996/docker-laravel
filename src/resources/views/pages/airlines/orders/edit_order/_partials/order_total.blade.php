<div class="card card-custom mb-3" style="background: #f9f9f9">
    <div class="card-body py-4">
        <div class="form-group mb-3 row align-items-center">
            <div class="col-xl-2 pr-0">
                <label for="">Recievable</label>
                <input type="text" name="" id="" style="height:30px"
                    class="form-control p-2 currency text-left recievable"
                    value="{{ $airline_order->total_recievable }}" placeholder="Total Recievable" disabled>
            </div>
            <div class="col-xl-2 pr-0">
                <label for="">Payable to Airline</label>
                <input type="text" name="" id="" style="height:30px"
                    class="form-control p-2 currency text-left payable-to-airline"
                    value="{{ $airline_order->airline_payable }}" placeholder="Payable to Airline" disabled>
            </div>
            <div class="col-xl-2 pr-0">
                <label for="">Other Payable</label>
                <input type="text" name="" id="" style="height:30px"
                    class="form-control p-2 currency text-left other-payable"
                    value="{{ $airline_order->other_payable }}" placeholder="Other Payable" disabled>
            </div>
            <div class="col-xl-2 pr-0">
                <label for="">Total Payable</label>
                <input type="text" name="" id="" style="height:30px"
                    class="form-control p-2 currency text-left total-payable"
                    value="{{ $airline_order->total_payable }}" placeholder="Total Payable" disabled>
            </div>
            <div class="col-xl-2 pr-0">
                <label for="">Total Income</label>
                <input type="text" name="" id="" style="height:30px"
                    class="form-control p-2 currency text-left total-income"
                    value="{{ $airline_order->total_income }}" placeholder="Total Income" disabled>
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-xl-3 pr-0">
                <label for="">Payment Type</label>
                <select class="form-control selectpicker payment-type" data-live-search="true" id="payment_type">
                    <option value="1">Not Paid</option>
                    <option value="0">Paid</option>
                </select>
            </div>
            <div class="col-xl-3 pr-0 payment-method-div" style="display: none;">
                <label for="">Payment Method</label>
                <select class="form-control selectpicker" id="payment_method" data-live-search="true">
                    @foreach ($payment_methods as $payment_method)
                        <option value="{{ $payment_method->id }}">
                            {{ $payment_method->payment_title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xl-3 pr-0 payment-method-div" style="display: none;">
                <label for="">Amount Paid</label>
                <input type="text" name="amount_paid" id="" style="height:30px"
                    class="form-control p-2 currency text-left amount-paid" autocomplete="off"
                    placeholder="Amount Paid">
                <span class="paid-amount-error text-danger"></span>
            </div>
            <div class="col-xl-3 pr-0 payment-method-div" style="display: none;">
                <label for="">Change Back</label>
                <input type="text" name="" id="" style="height:30px"
                    class="form-control p-2 currency text-left change-back" placeholder="Change Back" disabled>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-xl-3 pr-0 mt-4">
                <button type="button" id="save-order" class="btn btn-success btn-block font-weight-bolder">Save
                    order</button>
            </div>
        </div>
    </div>
</div>
