@php
$plans = DB::table('plans')->get();
$payment_methods = DB::table('payment_methods')
    ->leftJoin('payment_types', 'payment_types.id', 'payment_methods.payment_type_id')
    ->where('payment_types.value', 0)
    ->where('payment_methods.outlet_id', session('outlet_id'))
    ->get();
@endphp

<!-- COMPANY MODEL -->
<div class="modal fade " style="z-index: 10001;" id="subscription_modal" class="style-1" data-backdrop="static"
    tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content overlay overlay-block">

            <div class="overlay-layer" style="z-index: 10002">
                <div class="spinner spinner-primary"></div>
            </div>
            <div class="modal-header">
                <h6 class="modal-title" id="subscription_modal">Upgrade Subscription</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-none" id="success_msg">
                    <div class="text-center px-4">
                        <img style="width:100px" alt="" src="{{ asset('media/crown.png') }}">
                    </div>
                    <div class="card-px text-center pb-20 my-10">
                        <h1 class="font-size-h1 font-weight-boldest mb-10">Thank you for subscribing!</h1>
                        <p class="font-size-lg font-weight-bold mb-10">Your account will have all premium access within
                            24 hours.
                            <br>If you have any query feel free to ask
                        </p>
                        <a href="{{ route('subscription.index') }}" class="btn btn-primary">See Subscription
                            Details</a>
                    </div>
                </div>

                <div class="container d-block " id="plan_form">
                    <div class="card-deck mb-3 text-center">
                        @foreach ($plans as $plan)
                            <div class="card mb-4  plans" id="{{ 'plan' . $plan->id }}">
                                <div class="card-header">
                                    <h4 class="my-0 font-weight-normal">{{ $plan->plan_title }}</h4>
                                </div>
                                <div class="card-body">
                                    <h1 class="card-title pricing-card-title">PKR
                                        {{ number_format($plan->plan_amount) }}</h1>
                                    <ul class="list-unstyled mt-3 mb-4">
                                        {!! $plan->plan_description !!}
                                    </ul>
                                    <button type="button" onclick="selectPlan({{ $plan->id }})"
                                        class="btn btn-lg btn-block btn-outline-primary">Select</button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!--begin::Form-->
                    <div class="card-body ">
                        <div class="form-group row">
                            <div class="col-xl-6">
                                <!--begin::Input-->
                                <div class="form-group">
                                    <label for="exampleTextarea">Payment Method</label>
                                    <select name="payment_method" class="form-control  selectpicker" id="">
                                        <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>
                                            Cash
                                        </option>
                                        <option value="easypaisa"
                                            {{ old('payment_method') == 'easypaisa' ? 'selected' : '' }}>
                                            EasyPaisa
                                        </option>
                                    </select>

                                </div>
                                <!--end::Input-->
                            </div>
                            <div class="col-xl-6">
                                <!--begin::Input-->
                                <div class="form-group">
                                    <label for="exampleTextarea">Plan</label>

                                    <select name="plan_id" data-live-search="true" data-size="5"
                                        class="form-control selectpicker" id="subscription-plan">
                                        <option value="">Select Plan....</option>
                                        @foreach ($plans as $plan)
                                            <option value="{{ $plan->id }}">{{ $plan->plan_title }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                                <!--end::Input-->
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-xl-4">
                                <!--begin::Input-->
                                <div class="form-group">
                                    <label for="exampleTextarea">Total Bill</label>
                                    <input type="text" name="total_bill" class="form-control" id="total-bill"
                                        readonly>
                                </div>
                                <!--end::Input-->
                            </div>
                            <div class="col-xl-4">
                                <!--begin::Input-->
                                <div class="form-group">
                                    <label>Promo Code</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="promo_key" id="promo_key"
                                            placeholder="Enter Promo Code" autocomplete="false" />
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" id="apply_promo"
                                                type="button">Apply</button>
                                        </div>
                                    </div>

                                </div>
                                <!--end::Input-->
                            </div>
                            <div class="col-xl-4">
                                <!--begin::Input-->
                                <div class="form-group">
                                    <label for="exampleTextarea">Paid Bill</label>
                                    <input type="text" name="paid_bill" id="paid-bill" class="form-control" value=""
                                        readonly>
                                </div>
                                <!--end::Input-->
                            </div>
                        </div>

                        <input type="hidden" name="discount_amount" value="0" id="discount_amount">
                    </div>
                    <div class="card-footer">
                        <a href="javascript:void(0)" id="btn-subscribe" class="btn btn-primary mr-2">Submit</a>
                    </div>

                    <!--end::Form-->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#kt_metronic_8_engage_dismiss').click(() => {
        $('#sub-msg').fadeOut();
    });
</script>
<script src="{{ asset('js/subscription/sub.js') }}"></script>
{{-- @section('scripts')
    
@endsection --}}
