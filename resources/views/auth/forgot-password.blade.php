@extends('auth.authMaster')

@section('auth')
    <div id="main-wrapper" class="auth-customizer-none">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 w-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3 auth-card">
                        <div class="card mb-0">
                            <div class="card-body pt-5">
                                <a href="index.html"
                                    class="text-nowrap logo-img d-flex align-items-center justify-content-center gap-2 mb-4 w-100">
                                    <b class="logo-icon">
                                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                        <!-- Dark Logo icon -->
                                        <img src="{{ asset('dashboard_assets') }}/images/logos/logo-icon.svg" alt="homepage" class="dark-logo">
                                        <!-- Light Logo icon -->
                                        <img src="{{ asset('dashboard_assets') }}/images/logos/logo-light-icon.svg" alt="homepage"
                                            class="light-logo">
                                    </b>
                                    <!--End Logo icon -->
                                    <!-- Logo text -->
                                    <span class="logo-text">
                                        <!-- dark Logo text -->
                                        <img src="{{ asset('dashboard_assets') }}/images/logos/logo-text.svg" alt="homepage"
                                            class="dark-logo ps-2">
                                        <!-- Light Logo text -->
                                        <img src="{{ asset('dashboard_assets') }}/images/logos/logo-light-text.svg" class="light-logo ps-2"
                                            alt="homepage">
                                    </span>
                                </a>
                                <div class="mb-5 text-center">
                                    <p class="mb-0 ">
                                        Please enter the email address associated with your account and We will email you a
                                        link to reset your password.
                                    </p>
                                </div>
                                <form>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <a href="javascript:void(0)" class="btn btn-primary w-100 py-8 mb-3">Forgot Password</a>
                                    <a href="{{ route('login') }}"class="btn bg-primary-subtle text-primary w-100 py-8">Back to Login</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
