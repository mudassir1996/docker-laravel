@extends('layout.default-blank')
@section('title', 'Verify Account')
@section('styles')
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="{{ asset('css/pages/login/login-1.css?v=7.0.5') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
            <!--begin::Aside-->
            <div class="login-aside d-flex flex-column flex-row-auto"
                style="{{ auth()->guard('employee')->check()? 'background-color: #2b354e;': 'background-color: #D4192C;' }}">
                <!--begin::Aside Top-->
                <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                    <!--begin::Aside header-->
                    <p class="text-center display-2 font-weight-bold mb-10 text-light logo-font">
                        MgtOS
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
                <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center"
                    style="background-image: url({{ asset('media/svg/illustrations/login-visual-1.svg') }})"></div>
                <!--end::Aside Bottom-->
            </div>
            <!--begin::Aside-->
            <!--begin::Content-->
            <div
                class="col-12 flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
                <!--begin::Content body-->
                <div class="d-flex flex-column-fluid flex-center">
                    <div class="card w-75">
                        <div class="card-header py-3">
                            <div class="row align-items-center">
                                <div class="col-xl-6 ">
                                    @if (is_numeric(auth()->user()->username))
                                        {{ __('Verify Your Phone Number') }}
                                    @elseif (filter_var(auth()->user()->username, FILTER_VALIDATE_EMAIL))
                                        {{ __('Verify Your Email') }}
                                    @endif

                                </div>
                                <div class="col-xl-6 text-right">
                                    <form id="logout-form"
                                        action="{{ auth()->guard('employee')->check()? route('employee.logout'): route('logout') }}"
                                        method="POST">
                                        @csrf
                                        <input type="submit" value="Logout" class="btn btn-dark px-12">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif

                            @if (is_numeric(auth()->user()->username))
                                {{ __('Before proceeding, please verify your phone number.') }}
                            @elseif (filter_var(auth()->user()->username, FILTER_VALIDATE_EMAIL))
                                {{ __('Before proceeding, please verify your email.') }}
                            @endif


                            <br>
                            <br>

                            @if (Auth::guard('web')->check())
                                @if (is_numeric(auth()->user()->username))
                                    <a href="{{ route('verification.send.code') }}" class="btn btn-primary px-12">Verify
                                        by
                                        Phone</a>
                                @elseif (filter_var(auth()->user()->username, FILTER_VALIDATE_EMAIL))
                                    <a href="{{ route('verification.email') }}" class="btn btn-primary px-12">Verify by
                                        email</a>
                                @endif
                            @else
                                <a href="{{ route('verification.send.code') }}" class="btn btn-primary px-12">Verify
                                    by
                                    Phone</a>
                            @endif



                            {{-- {{ __('If you did not receive the email') }}, --}}
                            @php
                                $resend_route = '';
                                if (Auth::guard('web')->check()) {
                                    $resend_route = 'verification.resend';
                                } elseif (Auth::guard('employee')->check()) {
                                    $resend_route = 'employee_verification.resend';
                                }
                            @endphp

                        </div>
                    </div>
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
    <!--end::Page Scripts-->
@endsection
