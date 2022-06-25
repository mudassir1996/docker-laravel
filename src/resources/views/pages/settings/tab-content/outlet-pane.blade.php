<div class="tab-pane fade show active" id="v-pills-outlet" role="tabpanel" aria-labelledby="v-pills-outlet-tab">
    <form method="post" action="{{ route('outlets.update', $outlet->id) }}" id="add_outlet_form"
        enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <div class="col-xl-6">
                    <!--begin::Input-->
                    <label>Outlet Title *</label>
                    <input type="text" id="outlet_title" class="form-control   " name="outlet_title"
                        value="{{ $outlet->outlet_title }}" placeholder="Outlet Title" />
                    <!--end::Input-->
                </div>
                <div class="col-xl-6">
                    <label>Slogan</label>
                    <input type="text" class="form-control   " value="{{ $outlet->outlet_slogan }}"
                        name="outlet_slogan" placeholder="Slogan" />
                </div>
            </div>

            <div class="form-group row">
                <div class="col-xl-6">
                    <label>Phone *</label>
                    <input type="text" id="outlet_phone" class="form-control   " value="{{ $outlet->outlet_phone }}"
                        name="outlet_phone" placeholder="Outlet Phone" />
                </div>
                <div class="col-xl-6">
                    <label>Alternate Phone</label>
                    <input type="text" class="form-control   " value="{{ $outlet->outlet_alt_phone }}"
                        name="outlet_alt_phone" placeholder="Alternate Phone" />
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xl-6">
                    <label>Email</label>
                    <input type="text" class="form-control   " value="{{ $outlet->outlet_email }}" name="outlet_email"
                        placeholder="Outlet Email" />
                </div>
                <div class="col-xl-6">
                    <label>Address</label>
                    <input type="text" class="form-control   " value="{{ $outlet->outlet_address }}"
                        name="outlet_address" placeholder="Outlet Address" />
                </div>
            </div>

            <div class="form-group row">


                <div class="col-xl-4">
                    <!--begin::Input-->
                    <label>Country *</label>
                    <select class="form-control   " id="country" name="outlet_country">
                        <option value="">Select country</option>
                        @php
                            $country_id = '';
                        @endphp
                        @foreach ($countries as $country)
                            @if ($outlet->outlet_country == $country->id)
                                @php
                                    $country_id = $country->id;
                                @endphp
                            @endif
                            <option value="{{ $country->id }}"
                                {{ $outlet->outlet_country == $country->id ? 'selected' : '' }}>
                                {{ $country->country_name }}
                            </option>
                        @endforeach
                    </select>
                    <!--end::Input-->
                </div>
                <div class="col-xl-4">
                    <label>State *</label>
                    <select class="form-control   " id="state" name="outlet_state">
                        <option value="">Select State</option>
                        @php
                            $state_id = '';
                            $states = Illuminate\Support\Facades\DB::table('states')
                                ->where('country_id', $country_id)
                                ->get();
                        @endphp
                        @foreach ($states as $state)
                            @if ($outlet->outlet_state == $state->id)
                                @php
                                    $state_id = $state->id;
                                @endphp
                            @endif
                            <option value="{{ $state->id }}"
                                {{ $outlet->outlet_state == $state->id ? 'selected' : '' }}>
                                {{ $state->state_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xl-4">
                    <!--begin::Input-->
                    <label>City *</label>
                    <select class="form-control   " id="city" name="outlet_city">
                        <option value="">Select City</option>
                        @php
                            $cities = Illuminate\Support\Facades\DB::table('cities')
                                ->where('state_id', $state_id)
                                ->get();
                        @endphp

                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}"
                                {{ $outlet->outlet_city == $city->id ? 'selected' : '' }}>
                                {{ $city->city_name }}

                            </option>
                        @endforeach
                    </select>
                    <!--end::Input-->
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xl-6">
                    <!--begin::Input-->
                    <label>Business Type *</label>
                    <select class="form-control   " name="business_type_id">
                        <option value="">Select Business</option>
                        @foreach ($businesses as $business)
                            <option value="{{ $business->id }}"
                                {{ $outlet->business_type_id == $business->id ? 'selected' : '' }}>
                                {{ $business->business_title }}</option>
                        @endforeach

                    </select>
                    <!--end::Input-->
                </div>
                <div class="col-xl-6">
                    <label class="">Opening Date</label>
                    <input type="text" class="form-control  " id="kt_datepicker_outlet"
                        value="{{ $outlet->outlet_opening_date ?? '' }}" name="outlet_opening_date" readonly
                        placeholder="Select date" />
                </div>


            </div>

            <div class="form-group row">
                <div class="col-xl-8">
                    <label for="exampleTextarea">Description</label>
                    <textarea class="form-control" id="exampleTextarea" name="outlet_description"
                        rows="3">{{ $outlet->outlet_description }}</textarea>
                </div>
                <div class="col-xl-4">
                    <div class="image-input image-input-outline" id="kt_image_1">
                        @php
                            $image = Storage::disk('public')->exists('outlets/' . $outlet->outlet_feature_img) ? asset('storage/outlets/' . $outlet->outlet_feature_img) : asset('storage/' . $outlet->outlet_feature_img);
                        @endphp
                        <div class="image-input-wrapper" style="background-image: url('{{ $image }}')">
                        </div>

                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="outlet_feature_img" accept=".jpg,.png" />
                            {{-- <input type="hidden" name="profile_avatar_remove"/> --}}
                        </label>

                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                    </div>
                    <span class="form-text">Outlet Logo</span>
                    @error('outlet_feature_img')
                        {{ $message }}
                    @enderror
                </div>
            </div>


            <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
            <button type="submit" id="btn-submit" class="btn btn-primary btn-shadow px-12">Submit</button>
        </div>
    </form>
</div>
