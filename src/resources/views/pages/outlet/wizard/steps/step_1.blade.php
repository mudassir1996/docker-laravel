<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
    <h4 class="mb-10 font-weight-bold text-dark">Enter your Outlet
        Details</h4>
    <div class="container outlet-form" style="height: 50vh !important; overflow:auto; overflow-x:hidden;">
        <div class="form-group row mb-2 ">
            <div class="col-xl-6">
                <!--begin::Input-->

                <label>Outlet Title *</label>
                <input type="text" class="form-control {{ $errors->first('outlet_title') ? 'is-invalid' : '' }}"
                    value="{{ old('outlet_title') }}" name="outlet_title" placeholder="Outlet Title"
                    id="outlet_title" />
                @error('outlet_title')
                    <p class="text-danger">
                        {{ $message }}</p>
                @enderror

                <!--end::Input-->
            </div>
            <div class="col-xl-6">
                <!--begin::Input-->

                <label>Slogan</label>
                <input type="text" class="form-control   " value="{{ old('outlet_slogan') }}" name="outlet_slogan"
                    placeholder="Slogan" />

                <!--end::Input-->
            </div>
        </div>

        <div class="form-group row mb-2">
            <div class="col-xl-6">
                <!--begin::Input-->

                <label>Phone *</label>
                <input type="text" class="form-control {{ $errors->first('outlet_phone') ? 'is-invalid' : '' }}"
                    value="{{ old('outlet_phone') }}" name="outlet_phone" placeholder="Outlet Phone"
                    id="outlet_phone" />
                @error('outlet_phone')
                    <p class="text-danger">
                        {{ $message }}</p>
                @enderror

                <!--end::Input-->
            </div>
            <div class="col-xl-6">
                <!--begin::Input-->

                <label>Alternate Phone</label>
                <input type="text" class="form-control   " value="{{ old('outlet_alt_phone') }}"
                    name="outlet_alt_phone" placeholder="Alternate Phone" />

                <!--end::Input-->
            </div>
        </div>
        <div class="form-group row mb-4">
            <div class="col-xl-6">
                <!--begin::Input-->

                <label>Email</label>
                <input type="text" class="form-control   " value="{{ old('outlet_email') }}" name="outlet_email"
                    placeholder="Outlet Email" />

                <!--end::Input-->
            </div>
            <div class="col-xl-6">
                <!--begin::Input-->

                <label>Address</label>
                <input type="text" class="form-control   " value="{{ old('outlet_address') }}" name="outlet_address"
                    placeholder="Outlet Address" />

                <!--end::Input-->
            </div>
        </div>

        <div class="form-group row mb-2">


            <div class="col-xl-4">
                <!--begin::Input-->

                <label>Country *</label>
                <select class="form-control selectpicker" data-live-search="true" data-size="5" id="country"
                    name="outlet_country">
                    <option value="">Select country</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}"
                            {{ old('outlet_country') == $country->id ? 'selected' : '' }}
                            {{ Str::lower($country->country_name) == 'pakistan' ? 'selected' : '' }}>
                            {{ $country->country_name }}</option>
                    @endforeach
                </select>
                @error('outlet_country')
                    <p class="text-danger">
                        {{ $message }}</p>
                @enderror

                <!--end::Input-->
            </div>
            <div class="col-xl-4">
                <!--begin::Input-->

                <label>State *</label>
                <select class="form-control    selectpicker" data-live-search="true" data-size="5" id="state"
                    name="outlet_state">
                    <option value="">Select country first</option>
                </select>
                @error('outlet_state')
                    <p class="text-danger">
                        {{ $message }}</p>
                @enderror

                <!--end::Input-->
            </div>
            <div class="col-xl-4">
                <!--begin::Input-->

                <label>City *</label>
                <select class="form-control    selectpicker" data-live-search="true" data-size="5" id="city"
                    name="outlet_city">
                    <option value="">Select state first</option>
                </select>
                @error('outlet_city')
                    <p class="text-danger">
                        {{ $message }}</p>
                @enderror

                <!--end::Input-->
            </div>
        </div>
        <div class="form-group row mb-2">
            <div class="col-xl-6">

                <!--begin::Input-->
                <label>Business Type *</label>
                <select
                    class="form-control selectpicker {{ $errors->first('business_type_id') ? 'is-invalid' : '' }}"
                    title="Select Business" data-size="5" data-live-search="true" name="business_type_id">
                    @foreach ($businesses as $business)
                        <option value="{{ $business->id }}"
                            {{ old('business_type_id') == $business->id ? 'selected' : '' }}>
                            {{ $business->business_title }}</option>
                    @endforeach
                </select>
                <!--end::Input-->
                @error('business_type_id')
                    <p class="text-danger">
                        {{ $message }}</p>
                @enderror
            </div>
            <div class="col-xl-6">

                <label class="">Opening Date</label>
                <input type="text" class="form-control  " id="kt_datepicker_outlet"
                    value="{{ old('outlet_opening_date') }}" name="outlet_opening_date" readonly
                    placeholder="Select date" />

            </div>


        </div>
        <div class="form-group row mb-2">
            <div class="col-xl-6">
                <!--begin::Input-->
                <label>Supplier?</label>
                <span class="switch switch-icon switch-success">
                    <label data-toggle="tooltip" title="Are you a supplier?" data-menu-toggle="hover">
                        <input type="checkbox" name="is_supplier" id="is_supplier"
                            {{ old('is_supplier') == 1 ? 'checked' : '' }} value="1" />
                        <span></span>
                    </label>
                </span>
                <!--end::Input-->
                @error('is_supplier')
                    <span class="text-danger">
                        {{ $message }}</span>
                @enderror
            </div>

            <div class="col-xl-6" style="display: none;" id="supplier_key">
                <label class="">Public Key</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="public_key" name="public_key" />
                    <div class="input-group-append">
                        <span class="input-group-text" id="pub_key_gen" style="padding: 0.3rem 0.6rem"
                            role="button">Generate</span>
                    </div>
                </div>
            </div>


        </div>

        <div class="form-group row  mb-2">
            <div class="col-xl-6">

                <label for="exampleTextarea">Description</label>
                <textarea class="form-control   " id="exampleTextarea" name="outlet_description"
                    rows="5">{{ old('outlet_description') }}</textarea>

            </div>
            <div class="col-xl-6">
                <div class="form-group mb-0">
                    <span class="form-text">Outlet Logo</span>
                    <div class="image-input image-input-outline" id="kt_image_1">

                        <div class="image-input-wrapper"
                            style="background-image: url({{ asset('storage/placeholder.jpg') }})">
                        </div>

                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="outlet_feature_img" accept=".jpg,.png" />

                        </label>

                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                    </div>

                    @error('outlet_feature_img')
                        <p class="text-danger">
                            {{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>


    </div>
</div>
