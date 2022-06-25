@extends('layout.default-blank')
@section('title', 'Register')
@section('styles')
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="{{ asset('css/pages/login/login-1.css?v=7.0.5') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-1 login-signup-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
            <!--begin::Aside-->
            <div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #E30423;">
                <!--begin::Aside Top-->
                <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                    <!--begin::Aside header-->
                    <p class="text-center display-2 font-weight-bold mb-10 text-light" style="font-family: logo-font;">
                        MgtOs
                    </p>
                    <!--end::Aside header-->
                    <!--begin::Aside title-->
                    <h3 class="font-weight-bolder text-center font-size-h5 font-size-h2-lg text-light">Manage Your Business
                        <!-- <br />at one place -->
                    </h3>
                    <!--end::Aside title-->
                </div>
                <!--end::Aside Top-->
                <!--begin::Aside Bottom-->
                @php
                    $side_image = asset('media/svg/illustrations/login-visual-1.svg');
                @endphp
                <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center"
                    style="background-image: url({{ $side_image }})"></div>
                <!--end::Aside Bottom-->
            </div>
            <!--begin::Aside-->
            <!--begin::Content-->
            <div
                class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
                <!--begin::Content body-->
                <div class="d-flex flex-column-fluid flex-center">
                    <!--begin::Signup-->
                    <div class="login-form login-signup ">
                        <!--begin::Form-->
                        <form method="POST" action="{{ route('register') }}" class="form"
                            novalidate="novalidate" id="kt_login_signup_form" autocomplete="off">
                            @csrf
                            <!--begin::Title-->
                            <div class="pb-13 pt-lg-0 pt-5">
                                <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Sign Up</h3>
                                <span class="text-muted font-weight-bold font-size-h4">Already have an account?
                                    <a href="{{ route('login') }}" id="kt_login_signup"
                                        class="text-primary font-weight-bolder">Sign In Here</a></span>
                            </div>
                            <!--end::Title-->
                            <!--begin::Form group-->
                            <div class="form-group">
                                <input
                                    class="form-control form-control-solid h-auto py-5 px-6 rounded-lg font-size-h6 @error('first_name') is-invalid @enderror"
                                    type="text" placeholder="First Name" value="{{ old('first_name') }}" name="first_name"
                                    id="first_name" autocomplete="off" />
                                @error('first_name')
                                    <div class="fv-plugins-message-container">
                                        <div data-field="first_name" data-validator="notEmpty" class="fv-help-block">
                                            {{ $message }}</div>
                                    </div>
                                @enderror
                            </div>
                            <!--end::Form group-->
                            <!--begin::Form group-->
                            <div class="form-group">
                                <input
                                    class="form-control form-control-solid h-auto py-5 px-6 rounded-lg font-size-h6 @error('last_name') is-invalid @enderror"
                                    type="text" placeholder="Last Name" value="{{ old('last_name') }}" name="last_name"
                                    id="last_name" autocomplete="off" />
                                @error('last_name')
                                    <div class="fv-plugins-message-container">
                                        <div data-field="last_name" data-validator="notEmpty" class="fv-help-block">
                                            {{ $message }}</div>
                                    </div>
                                @enderror
                            </div>
                            <!--end::Form group-->
                            <!--begin::Form group-->
                            <div class="form-group">
                                <input
                                    class="form-control form-control-solid h-auto py-5 px-6 rounded-lg font-size-h6 @error('email') is-invalid @enderror"
                                    type="email" placeholder="Email/Phone" value="{{ old('email') }}" name="email"
                                    id="email" autocomplete="off" />
                                @error('email')
                                    <div class="fv-plugins-message-container">
                                        <div data-field="email" data-validator="notEmpty" class="fv-help-block">
                                            {{ $message }}</div>
                                    </div>
                                @enderror
                            </div>
                            <!--end::Form group-->
                            {{-- <!--begin::Form group-->
                        <div class="form-group">
                            <input class="form-control form-control-solid h-auto py-5 px-6 rounded-lg font-size-h6 @error('phone') is-invalid @enderror" type="text" placeholder="Phone (92**********)" value="{{old('phone')}}" id="phone" name="phone" autocomplete="off" />
                            @error('phone')
                            <div class="fv-plugins-message-container">
                                <div data-field="phone" data-validator="notEmpty" class="fv-help-block">{{$message}}</div>
                            </div>
                            @enderror
                        </div>
                        <!--end::Form group--> --}}
                            <!--begin::Form group-->
                            <div class="form-group">
                                <input
                                    class="form-control form-control-solid h-auto py-5 px-6 rounded-lg font-size-h6 password @error('password') is-invalid @enderror"
                                    type="password" placeholder="Password" name="password" autocomplete="off" />
                                <span class="visible_active" id="password"></span>
                                @error('password')
                                    <div class="fv-plugins-message-container">
                                        <div data-field="password" data-validator="notEmpty" class="fv-help-block">
                                            {{ $message }}</div>
                                    </div>
                                @enderror
                            </div>
                            <!--end::Form group-->
                            <!--begin::Form group-->
                            <div class="form-group">
                                <input
                                    class="form-control form-control-solid h-auto py-5 px-6 rounded-lg font-size-h6 password_confirm"
                                    type="password" placeholder="Confirm password" name="password_confirmation"
                                    autocomplete="off" />
                                <span class="visible_active" id="password_confirm"></span>
                            </div>
                            <!--end::Form group-->
                            <!--begin::Form group-->

                            <div class="form-group">
                                <input
                                    class="form-control form-control-solid h-auto py-5 px-6 rounded-lg font-size-h6 password_confirm"
                                    type="text" placeholder="Add Refferal Code" name="referral_code" autocomplete="off" />

                            </div>
                            <!--end::Form group-->
                            <!--begin::Form group-->
                            <div class="form-group">
                                <label class="checkbox mb-0">
                                    <input type="checkbox" name="agree" />
                                    <span class="mr-2"></span>
                                    I Agree the
                                    <a target="_blank" href="https://mgtos.com/terms-conditions/">&nbspterms and
                                        conditions</a>.
                                </label>
                            </div>
                            <!--end::Form group-->
                            <!--begin::Form group-->
                            <div class="form-group d-flex flex-wrap pb-lg-0 pb-3">
                                <input type="submit"
                                    class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4"
                                    id="kt_login_signup_submit" value="Submit" />
                            </div>
                            <!--end::Form group-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Signup-->

                </div>
                <!--end::Content body-->
                <!--begin::Content footer-->
                <div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
                    <a href="#" class="text-primary font-weight-bolder font-size-h5">Terms</a>
                    <a href="#" class="text-primary ml-10 font-weight-bolder font-size-h5">Plans</a>
                    <a href="#" class="text-primary ml-10 font-weight-bolder font-size-h5">Contact Us</a>
                </div>
                <!--end::Content footer-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Login-->
    </div>
    <!--end::Main-->
@endsection
@section('scripts')
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('js/pages/custom/login/login-general.js?v=7.0.5') }}"></script>
    <script>
        $('#kt_login_signup_submit').click(() => {
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();

            $('#first_name').val(first_name.trim());
            $('#last_name').val(last_name.trim());
        });
    </script>
    <!--end::Page Scripts-->
@endsection
