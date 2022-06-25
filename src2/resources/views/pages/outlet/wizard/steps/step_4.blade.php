<div class="pb-5" data-wizard-type="step-content">
    <h4 class="mb-10 font-weight-bold text-dark">Select Subscription Plan</h4>
    <div class="container" style="height: 50vh !important; overflow:auto; overflow-x:hidden;">

        <div class="row pt-3">
            <div class="col-lg-12 mb-2">
                <label class="option shadow shadow-sm">
                    <span class="option-control">
                        <span class="radio">
                            <input type="radio" name="subscription_plan" checked="checked" value="free" />
                            <span></span>
                        </span>
                    </span>
                    <span class="option-label">
                        <span class="option-head">
                            <span class="option-title">
                                Go Free
                            </span>
                            <span class="option-focus">
                                Free
                            </span>

                        </span>

                    </span>
                </label>
            </div>
        </div>
        <div class="row pb-3">
            @foreach ($plans as $plan)
                <div class="col-lg-6 mb-2">
                    <label class="option shadow shadow-sm border border-secondary" data-toggle="modal"
                        data-target="#subscription-modal">
                        <span class="option-control">
                            <span class="radio">
                                <input type="radio" name="subscription_plan" value="{{ $plan->id }}" />
                                <span></span>
                            </span>
                        </span>
                        <span class="option-label">
                            <span class="option-head">
                                <span class="option-title">
                                    {{ $plan->plan_title }}
                                </span>
                                <span class="option-focus">
                                    PKR {{ number_format($plan->plan_amount) }}
                                </span>

                            </span>
                            <span class="option-body">

                                <ul class="list-unstyled font-size-lg">
                                    {!! $plan->plan_description !!}
                                </ul>
                            </span>
                        </span>
                    </label>
                </div>
            @endforeach
        </div>

        <!-- Modal-->
        <div class="modal fade" id="subscription-modal" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Select Payment Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Payment Method</label>
                            <select name="subscription_payment_method" id="subscription_payment_method"
                                class="form-control">
                                <option value="">Select</option>
                                <option value="cash">Cash</option>
                                <option value="easypaisa">EasyPaisa</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
