<div class="tab-pane fade " id="v-pills-pos-settings" role="tabpanel" aria-labelledby="v-pills-pos-settings-tab">
    <div class="card card-custom mt-5">
        <div class="card-header pt-4 min-h-50px">
            <div class="card-title">
                <h2>POS Setting</h2>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('pos-settings.update') }}" method="post">
                @csrf
                @method('PUT')

                <div class="row">
                    @foreach ($outlet_pos_settings as $outlet_pos_setting)
                        <div class="col-md-12 mb-4">
                            <!--begin::Label-->
                            <label class="font-weight-bold mt-3 form-label d-flex align-items-center" role="button">
                                <span>{{ ucwords(str_replace('_', ' ', $outlet_pos_setting->key)) }}</span>
                            </label>
                            <!--end::Label-->
                            <div class="d-flex mt-3">
                                <!--begin::Radio-->
                                <div class="radio-inline">
                                    <label class="radio radio-primary">
                                        <input type="radio" name="pos_settings[{{ $outlet_pos_setting->key }}]"
                                            value="1" {{ $outlet_pos_setting->value == 1 ? 'checked' : '' }} />
                                        <span></span>
                                        Yes
                                    </label>
                                    <label class="radio radio-primary">
                                        <input type="radio" name="pos_settings[{{ $outlet_pos_setting->key }}]"
                                            value="0" {{ $outlet_pos_setting->value == 0 ? 'checked' : '' }} />
                                        <span></span>
                                        No
                                    </label>

                                </div>
                                <!--end::Radio-->
                            </div>
                        </div>
                    @endforeach
                    {{-- <div class="col-md-4">
                        <!--begin::Label-->
                        <label class="font-weight-bold mt-3 form-label d-flex align-items-center" role="button">
                            <span>Product Level Discounts</span>
                            <i class="fas fa-exclamation-circle ml-1" data-toggle="tooltip"
                                title="Allow adding discount on every single product."></i>
                        </label>
                        <!--end::Label-->
                        <div class="d-flex mt-3">
                            <!--begin::Radio-->
                            <div class="radio-inline">
                                <label class="radio radio-primary">
                                    <input type="radio" name="product_level_descount" value="1" checked="checked" />
                                    <span></span>
                                    Yes
                                </label>
                                <label class="radio radio-primary">
                                    <input type="radio" name="product_level_descount" value="0" />
                                    <span></span>
                                    No
                                </label>

                            </div>
                            <!--end::Radio-->
                        </div>
                    </div> --}}
                </div>
                {{-- <div class="row mb-4">
                    <div class="col-md-4">
                        <!--begin::Label-->
                        <label class="font-weight-bold mt-3 form-label d-flex align-items-center" role="button">
                            <span>Bill Level Discounts</span>
                            <i class="fas fa-exclamation-circle ml-1" data-toggle="tooltip"
                                title="Allow adding discount on bills."></i>
                        </label>
                        <!--end::Label-->
                        <div class="d-flex mt-3">
                            <!--begin::Radio-->
                            <div class="radio-inline">
                                <label class="radio radio-primary">
                                    <input type="radio" name="bill_level_descount" value="1" checked="checked" />
                                    <span></span>
                                    Yes
                                </label>
                                <label class="radio radio-primary">
                                    <input type="radio" name="bill_level_descount" value="0" />
                                    <span></span>
                                    No
                                </label>

                            </div>
                            <!--end::Radio-->
                        </div>
                    </div>

                </div> --}}
                <div class="text-right mt-3">
                    <button class="btn btn-primary px-8">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
