@extends('layout.default')
@section('title', 'Edit Customer')
@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Customer</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('customers.index') }}" class="text-muted">All Customers</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Edit Customer</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid px-0">
            <!--begin::Teachers-->
            <div class="d-flex flex-row">
                <!--begin::Content-->
                <div class="flex-row-fluid">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-header flex-wrap py-5">
                            <div class="card-title">
                                <h3 class="card-label">Edit Customer
                                    <!-- <span class="d-block text-muted pt-2 font-size-sm">Manage Customers</span> -->
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form method="post" action="{{ route('customers.update', $customer->id) }}"
                                id="add_customer_form" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <div class="card-body">
                                    <div class="form-group mb-8">
                                        <div class="alert alert-custom alert-default" role="alert">
                                            <div class="alert-icon">
                                                <span class="svg-icon svg-icon-primary svg-icon-xl">
                                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Info-circle.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                                            <rect fill="#000000" x="11" y="10" width="2" height="7"
                                                                rx="1" />
                                                            <rect fill="#000000" x="11" y="7" width="2" height="2" rx="1" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <div class="alert-text">Fill out the form below. The fields with (*) are
                                                required.</div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Customer Name*</label>
                                                <input type="text" id="customer_name"
                                                    class="form-control    {{ $errors->first('customer_name') ? 'is-invalid' : '' }}"
                                                    value="{{ $customer->customer_name }}" name="customer_name"
                                                    placeholder="Customer Name" />
                                                <p class="text-danger"> {{ $errors->first('customer_name') }}</p>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text"
                                                    class="form-control    {{ $errors->first('customer_phone') ? 'is-invalid' : '' }}"
                                                    value="{{ $customer->customer_phone }}" name="customer_phone"
                                                    placeholder="Phone" />
                                                <p class="text-danger"> {{ $errors->first('customer_phone') }}</p>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Customer Email</label>
                                                <input type="text" class="form-control   "
                                                    value="{{ $customer->customer_email }}" name="customer_email"
                                                    placeholder="Customer Email" />
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control   "
                                                    value="{{ $customer->customer_address }}" name="customer_address"
                                                    placeholder="Customer Address" />

                                            </div>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Date of Birth</label>
                                                <input type="text" class="form-control   " id="kt_datepicker_3"
                                                    value="{{ $customer->customer_dob ?? '' }}" readonly name="customer_dob"
                                                    placeholder="Customer Date of Birth" />
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>CNIC</label>
                                                <input type="text" class="form-control   " name="customer_cnic"
                                                    value="{{ $customer->customer_cnic }}" placeholder="Customer CNIC" />

                                            </div>
                                            <!--end::Input-->
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <!--begin::Input-->
                                                <label for="company">Gender</label>
                                                <select class="form-control   " id="company" name="customer_gender">
                                                    <option value="">Select Gender</option>
                                                    <option @if (strtolower($customer->customer_gender) == 'male') selected @endif>
                                                        Male</option>
                                                    <option @if (strtolower($customer->customer_gender) == 'female') selected @endif>
                                                        Female</option>
                                                </select>
                                                <!--end::Input-->
                                                <p class="text-danger"> {{ $errors->first('customer_gender') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group ">
                                                <label class="col-12 col-form-label">Allow Credit Purchases</label>
                                                <div class="col-12">
                                                    <span class="switch switch-outline switch-icon switch-success">
                                                        <label>
                                                            <input type="checkbox" name="allow_credit"
                                                                {{ $customer->allow_credit == 1 ? 'checked' : '' }}
                                                                value="1" />
                                                            <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-xl 12">
                                            <div class="form-group">
                                                <label for="exampleTextarea">Description</label>
                                                <textarea class="form-control   " id="exampleTextarea"
                                                    name="customer_description"
                                                    rows="5">{{ $customer->customer_description }}</textarea>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group mb-0">
                                        <div class="image-input image-input-outline" id="kt_image_1">
                                            @php
                                                $image = Storage::disk('public')->exists('customers/' . $customer->customer_feature_img) ? asset('storage/customers/' . $customer->customer_feature_img) : asset('storage/' . $customer->customer_feature_img);
                                            @endphp
                                            <div class="image-input-wrapper"
                                                style="background-image: url('{{ asset($image) }}')"></div>

                                            <label
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="change" data-toggle="tooltip" title=""
                                                data-original-title="Change avatar">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file" name="customer_feature_img" accept=".jpg,.png" />
                                                {{-- <input type="hidden" name="profile_avatar_remove"/> --}}
                                            </label>

                                            <span
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>
                                        </div>
                                        <span class="form-text">Customer Image</span>
                                        @error('customer_feature_img')
                                            {{ $message }}
                                        @enderror
                                    </div>

                                    <input type="hidden" name="outlet_id" value="{{ session('outlet_id') }}">
                                    <input type="hidden" name="created_by" value="{{ session('employee_id') }}">
                                    <button type="submit" id="btn-submit"
                                        class="btn btn-primary btn-shadow px-12 mt-8">Submit</button>
                                </div>

                            </form>
                            <!--end::Form-->
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Teachers-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection

{{-- Scripts Section --}}

@section('scripts')
    <script>
        $('#btn-submit').click(() => {
            var customer_name = $('#customer_name').val();
            $('#customer_name').val(customer_name.trim());
        });
    </script>
    <script>
        var avatar1 = new KTImageInput('kt_image_1');
    </script>
    <script src="{{ asset('js/customers/form_validation.js') }}"></script>
    <script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>


@endsection
