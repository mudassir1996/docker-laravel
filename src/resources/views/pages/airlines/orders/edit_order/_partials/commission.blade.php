<div class="card card-custom mb-3" id="commission" style="background: #f9f9f9">
    <div class="card-header align-items-center min-h-50px">
        <h3 class="card-title">
            Order Commission
        </h3>
    </div>
    <div class="card-body py-3">
        <div class="card-scroll" style="max-height: 200px; overflow-x:hidden; overflow-y:auto; ">
            <div id="commission_repeater">
                <div class="form-group row mb-0">
                    <div data-repeater-list="" class="col-lg-12">
                        @foreach ($airline_order->commission_details as $commission_detail)
                            <div data-repeater-item
                                class="form-group row align-items-center mb-2 commission-repeater-item">
                                <div class="col-md-3 col-3 pr-2">
                                    <label class="commission-label">Commisson 1</label>
                                    <p class="font-weight-bolder  m-0">
                                        {{ $commission_detail->title }}</p>
                                </div>
                                <div class="col-md-3 col-3 px-0">
                                    <label>Value</label>
                                    <p class="font-weight-bolder  m-0">
                                        {{ $commission_detail->value }}</p>
                                </div>
                                <div class="col-md-3 col-3 px-0">
                                    <label>Percentage</label>
                                    <p class="font-weight-bolder  m-0">
                                        {{ $commission_detail->percentage }}%</p>
                                </div>
                                @if ($commission_detail->description != '')
                                    <div class="col-md-3 col-3 pl-2">
                                        <a href="javascript:;" data-toggle="collapse" style="height: 30px; width:30px"
                                            data-target="#commission-collapse1" aria-expanded="false"
                                            aria-controls="collapseExample"
                                            class="btn font-weight-bold btn-light-success btn-icon mt-8 commission-collapse-btn">
                                            <i class="la la-angle-down"></i>
                                        </a>
                                    </div>
                                    <div class="collapse commission-collapse col-md-8 mt-2 pr-0"
                                        id="commission-collapse1">
                                        <p class=" m-0">
                                            {{ $commission_detail->description }}</p>
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
        <span class="font-weight-bold font-size-lg">Total Commission</span>
        <input type="hidden" id="total-commission-value">
        <span class="font-weight-bold font-size-lg">PKR <span id="total-commission-label">0.00</span></span>
    </div>
</div>
