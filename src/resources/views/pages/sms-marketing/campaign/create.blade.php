@extends('layout.default')
@section('title', 'Add Compaign')

@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Compaigns</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('campaigns.index') }}" class="text-muted">All Compaigns</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted">Add Compaign</a>
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
                <!--begin::Aside-->

                <!--end::Aside-->
                <!--begin::Content-->
                <div class="flex-row-fluid">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-header flex-wrap py-5">
                            <div class="card-title">
                                <h3 class="card-label">
                                    Add Campaign
                                </h3>
                            </div>

                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                            <form method="post" action="{{ route('campaigns.store') }}" id="add_campaign_form">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-xl-4 mb-3">
                                        <label>Campaign Title *</label>
                                        <input type="text" name="campaign_title" id="campaign_title"
                                            class="form-control  {{ $errors->first('campaign_title') ? 'is-invalid' : '' }}"
                                            value="{{ old('campaign_title') }}" placeholder="Campaign Title" />
                                        <span class="text-danger"> {{ $errors->first('campaign_title') }}</span>
                                    </div>
                                    <div class="col-xl-4 mb-3">
                                        <label for="exampleTextarea">Status *</label>
                                        <select name="status" class="form-control selectpicker">
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-4 mb-3">
                                        <label>Schedule *</label>
                                        <select name="schedule" class="form-control selectpicker" title="Set Schedule">
                                            <option value="daily">Daily</option>
                                            <option value="weekly">Weekly</option>
                                            <option value="monthly">Monthly</option>
                                        </select>
                                    </div>

                                </div>
                                <div class=" row">
                                    <div class="col-12">
                                        <p class="font-weight-bolder font-size-lg">
                                            Select saved recepients or add other recepients
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-xl-4 mb-3">
                                        <label>Recepients *</label>
                                        <select class="form-control selectpicker recepients" data-live-search="true"
                                            data-actions-box="true" data-size=5 title="Select Recepients" id="recepients"
                                            name="recepients[]" multiple>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->customer_phone }}">
                                                    {{ $customer->customer_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger"> {{ $errors->first('recepients[]') }}</span>
                                    </div>
                                    <div class="col-xl-4 mb-3">
                                        <label for="exampleTextarea">Other Recepients</label>
                                        <input id="kt_tagify_1" class="form-control" name="other_recepients"
                                            placeholder="Add Other Recepients">
                                        <span class="form-text text-muted">Add phone numbers seperated with
                                            commas</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">SMS Variables</label>
                                    <div>
                                        <button type="button"
                                            class="btn btn-primary sms-variable-button">[customer-name]</button>
                                        <button type="button"
                                            class="btn btn-primary sms-variable-button">[outlet-name]</button>
                                        <button type="button"
                                            class="btn btn-primary sms-variable-button">[outlet-phone]</button>
                                        <button type="button"
                                            class="btn btn-primary sms-variable-button">[outlet-address]</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea">SMS Text *</label>
                                    <textarea class="form-control" id="sms_text" name="sms_text" rows="5">{{ old('sms_text') }}</textarea>
                                </div>

                                <button type="submit" id="btn-submit"
                                    class="btn btn-primary btn-shadow px-12 mt-8">Submit</button>

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
            var campaign_title = $('#campaign_title').val();
            $('#campaign_title').val(campaign_title.trim());
            var sms_text = $('#sms_text').val();
            $('#sms_text').val(sms_text.trim());
        });

        $(document).on('click', '.sms-variable-button', function() {
            buttonText = $(this).text();
            $("#sms_text").val(function(i, text) {
                return text + buttonText + " ";
            });
            // $("#sms_text").append($(this).text() + " ");
        })
        // var tagify = new Tagify(document.getElementById('kt_tagify_1'));
    </script>
    <script src="{{ asset('js/campaign/form_validation.js') }}"></script>


@endsection
