<div class="card card-custom mb-3" id="discount" style="background: #f9f9f9">
    <div class="card-header align-items-center min-h-50px">
        <h3 class="card-title">
            Order Discount
        </h3>
    </div>
    <div class="card-body py-3">
        <div class="card-scroll" style="max-height: 200px; overflow-x:hidden; overflow-y:auto; ">
            <div id="discount_repeater">
                <div class="form-group row mb-0">
                    <div data-repeater-list="" class="col-lg-12">
                        @foreach ($airline_order->discount_details as $discount_detail)
                            <div data-repeater-item
                                class="form-group row align-items-center mb-2 discount-repeater-item">
                                <div class="col-md-3 col-3 pr-2">
                                    <label class="discount-label">Discount 1</label>
                                    <p class="font-weight-bolder  m-0">
                                        {{ $discount_detail->title }}</p>
                                </div>
                                <div class="col-md-3 col-3 px-0">
                                    <label>Value</label>
                                    <p class="font-weight-bolder  m-0">
                                        {{ $discount_detail->value }}</p>
                                </div>
                                <div class="col-md-3 col-3 px-0">
                                    <label>Percentage</label>
                                    <p class="font-weight-bolder  m-0">
                                        {{ $discount_detail->percentage }}%</p>
                                </div>
                                @if ($discount_detail->description != '')
                                    <div class="col-md-3 col-3 pl-2">
                                        <a href="javascript:;" data-toggle="collapse" style="height: 30px; width:30px"
                                            data-target="#discount-collapse1" aria-expanded="false"
                                            aria-controls="collapseExample"
                                            class="btn font-weight-bold btn-light-success btn-icon mt-8 discount-collapse-btn">
                                            <i class="la la-angle-down"></i>
                                        </a>
                                    </div>
                                    <div class="collapse discount-collapse col-md-8 mt-2 pr-0" id="discount-collapse1">
                                        <p class=" m-0">
                                            {{ $discount_detail->description }}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between py-2">
        <span class="font-weight-bold font-size-lg">Total Discount</span>
        <input type="hidden" id="total-discount-value">
        <span class="font-weight-bold font-size-lg">PKR <span
                id="total-discount-label">{{ $airline_order->discount_value }}</span></span>
    </div>
</div>
