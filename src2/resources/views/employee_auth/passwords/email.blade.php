@extends('layout.default-blank')
@section('title', 'Reset Password')
@section('styles')
<!--begin::Page Custom Styles(used by this page)-->
<link href="{{asset('css/pages/login/login-1.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
        <!--begin::Aside-->
        <div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #2b354e;">
            <!--begin::Aside Top-->
            <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                <!--begin::Aside header-->
                <p class="text-center display-2 font-weight-bold mb-10 text-light">
                    <!-- <img src="{{asset('media/logos/logo-light.png')}}" class="max-h-70px" alt="" /> -->
                    MgtOS
                </p>
                <!--end::Aside header-->
                <!--begin::Aside title-->
                <h3 class="font-weight-bolder text-center font-size-h5 font-size-h2-lg text-light">Manage Everything
                    <!-- <br />at one place -->
                </h3>
                <!--end::Aside title-->
            </div>
            <!--end::Aside Top-->
            <!--begin::Aside Bottom-->
            @php
            $side_image=asset('media/svg/illustrations/login-visual-1.svg');
            @endphp
            <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url({{$side_image}})"></div>
            <!--end::Aside Bottom-->
        </div>
        <!--begin::Aside-->
        <!--begin::Content-->
        <div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
            <!--begin::Content body-->
            <div class="d-flex flex-column-fluid flex-center">
                <!--begin::Signin-->
                <div class="login-form login-signin">
                    <!--begin::Form-->
                    <form class="form" method="POST" action="{{ route('password.email') }}" novalidate="novalidate" id="kt_login_signin_form">
                        @csrf
                        <!--begin::Title-->
                        <div class="pb-8 pt-lg-0 pt-5">
                            <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Forgotten Password ?</h3>
                            <span class="text-muted font-weight-bold font-size-h4">Enter your email to reset your password.
                            {{-- <br>
                                <a href="{{ route('login') }}" id="kt_login_signup" class="text-primary font-weight-bolder">Sign In Here</a> --}}
                            </span>

                        </div>
                        <!--begin::Title-->
                        <!--begin::Form group-->
                        <div class="form-group">
                            <input class="form-control form-control-solid font-size-h6 h-auto py-5 px-6 rounded-lg @error('email') is-invalid @enderror" type="text" name="email" value="{{old('email')}}" autocomplete="off" placeholder="Email" autofocus />
                            @error('email')
                            <div class="fv-plugins-message-container">
                                <div data-field="email" data-validator="notEmpty" class="fv-help-block">{{$message}}</div>
                            </div>
                            @enderror
                        </div>
                        <!--end::Form group-->
                        <!--begin::Action-->
                        <div class="pb-lg-0 pb-5">
                            <input type="submit" value="Send Password Reset Link" class="btn btn-primary font-weight-bolder font-size-h6  my-3 mr-4" id="kt_login_signin_submit" value="Submit" />

                        </div>
                        <!--end::Action-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Signin-->

            </div>
            <!--end::Content body-->
            <!--begin::Content footer-->
            <div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
                <a href="{{route('employee.login')}}" class="text-primary font-weight-bolder font-size-h5">Employee Login</a>
                <a href="#" class="text-primary ml-10 font-weight-bolder font-size-h5">Terms</a>
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
<script src="{{asset('js/pages/custom/login/login-general.js?v=7.0.5')}}"></script>
<!--end::Page Scripts-->
@endsection