<div class="tab-pane fade my-8" id="v-pills-payment-method" role="tabpanel" aria-labelledby="v-pills-payment-method-tab">
    <div class="d-flex flex-row justify-content-center">

        <div class="col-xl-12">
            <div class="card card-custom bgi-no-repeat gutter-b"
                style="height:150px; background-position: calc(100% + 0.5rem) 100%; background-size: 50% auto; background-image: url({{ asset('media/svg/patterns/taieri.svg') }})">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center">
                    <div>
                        <h2 class="font-weight-bolder line-height-lg mb-5">
                            Outlet Payment Methods
                            <p class="text-muted font-weight-bold font-size-sm">
                                Manage payment methods of your outlet
                            </p>
                        </h2>
                        <a href="{{ route('payment-methods.create') }}" class="btn btn-primary font-weight-bolder">Add
                            New</a>


                    </div>
                </div>
                <!--end::Body-->
            </div>
        </div>
    </div>
    <div class="d-flex flex-row justify-content-center">

        <div class="col-xl-12">
            <form action="{{ route('payment-methods.store') }}" method="post">
                @csrf
                @foreach ($payment_methods as $key => $payment_method)
                    @php
                        $id = str_replace(' ', '_', $payment_method->payment_title);
                    @endphp
                    <div class="card card-custom mb-5">
                        <!--begin::Body-->
                        <div class="card-body ">
                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                <div class="mr-2">
                                    <h3 class="font-weight-bolder text-dark-70">
                                        {{ $payment_method->payment_title }}</h3>
                                </div>
                                <div class="d-flex align-items-center">
                                    @if ($payment_method->active)
                                        <a href="{{ route('payment-methods.edit', $payment_method->payment_method_id) }}"
                                            class="btn btn-icon btn-xs btn-warning mr-1" data-toggle="tooltip"
                                            data-placement="top" title="" data-original-title="Edit">

                                            <i class=" fas fa-pencil-alt icon-sm"></i>
                                        </a>
                                    @endif
                                    @if (!$payment_method->my_method)
                                        <span class="switch switch-primary switch-sm switch-icon">
                                            <label>
                                                <input type="checkbox" name="active[]"
                                                    value="{{ $payment_method->payment_title }}"
                                                    {{ $payment_method->active == 1 ? 'checked' : '' }} />
                                                <span></span>
                                            </label>
                                        </span>
                                    @else
                                        <button type="button" class="btn btn-icon btn-xs btn-danger mr-1"
                                            data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Delete"
                                            onclick="deleteMethod('{{ json_encode($payment_method->payment_method_id) }}')">
                                            <i class=" fas fa-trash icon-sm"></i>
                                        </button>
                                    @endif

                                </div>
                            </div>
                            <div class="text-dark-50 font-size-lg mt-2">
                                {{ $payment_method->payment_description }}
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="text-right">
                    <button type="submit" class="btn btn-primary font-weight-bolder" on>
                        <i class="fas fa-save icon-sm"></i>Save</button>
                </div>
            </form>

        </div>
    </div>
</div>
