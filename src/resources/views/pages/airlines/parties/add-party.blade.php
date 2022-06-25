@extends('layout.default')
@section('title', 'Add Party')
@section('content')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Parties</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('parties.index') }}" class="text-muted">All Parties</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Add Party</a>
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
                                <h3 class="card-label">Add Party
                                    <!-- <span class="d-block text-muted pt-2 font-size-sm">Manage Customers</span> -->
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form method="post" action="{{ route('parties.store') }}" id="add_party_form"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Title *</label>
                                                <input type="text" id="party_title" class="form-control   "
                                                    value="{{ old('party_title') }}" name="party_title"
                                                    placeholder="Title" />
                                                <p class="text-danger"> {{ $errors->first('party_title') }}</p>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Reg. No</label>
                                                <input type="text" class="form-control   " value="{{ old('party_regno') }}"
                                                    name="party_regno" placeholder="Registration No." />

                                            </div>
                                            <!--end::Input-->
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" class="form-control   " name="party_phone"
                                                    placeholder="Phone" />
                                                <p class="text-danger"> {{ $errors->first('party_phone') }}</p>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control   " value="{{ old('party_email') }}"
                                                    name="party_email" placeholder="Email" />
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control   "
                                                    value="{{ old('party_address') }}" name="party_address"
                                                    placeholder="Address" />
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group ">
                                                <label class="col-12 col-form-label">Allow Credit</label>
                                                <div class="col-12">
                                                    <span class="switch switch-outline switch-icon switch-success">
                                                        <label>
                                                            <input type="checkbox" name="allow_credit"
                                                                {{ old('allow_credit') == 1 ? 'checked' : '' }} value="1" />
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
                                                    name="party_description"
                                                    rows="5">{{ old('party_description') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0">
                                        <div class="image-input image-input-outline" id="kt_image_1">

                                            <div class="image-input-wrapper"
                                                style="background-image: url({{ asset('storage/placeholder.jpg') }})">
                                            </div>

                                            <label
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="change" data-toggle="tooltip" title=""
                                                data-original-title="Change avatar">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file" name="party_feature_img" accept=".jpg,.png" />
                                                {{-- <input type="hidden" name="profile_avatar_remove"/> --}}
                                            </label>

                                            <span
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>
                                        </div>
                                        <span class="form-text">Party Image</span>
                                        @error('party_feature_img')
                                            {{ $message }}
                                        @enderror
                                    </div>

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
            var party_title = $('#party_title').val();
            $('#party_title').val(party_title.trim());
        });
    </script>
    <script>
        var avatar1 = new KTImageInput('kt_image_1');
    </script>
    <script src="{{ asset('js/airlines/parties/form_validation.js') }}"></script>
@endsection
