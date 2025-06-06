@extends('auth.authMaster')

@section('auth')
    <div id="main-wrapper" class="auth-customizer-none">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 w-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3 auth-card">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="index.html"
                                    class="text-nowrap logo-img d-flex align-items-center justify-content-center gap-2 mb-4 w-100">
                                    <b class="logo-icon">
                                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                        <!-- Dark Logo icon -->
                                        <img src="{{ asset('dashboard_assets') }}/images/logos/logo-icon.svg" alt="homepage"
                                            class="dark-logo">
                                        <!-- Light Logo icon -->
                                        <img src="{{ asset('dashboard_assets') }}/images/logos/logo-light-icon.svg"
                                            alt="homepage" class="light-logo">
                                    </b>
                                    <!--End Logo icon -->
                                    <!-- Logo text -->
                                    <span class="logo-text">
                                        <!-- dark Logo text -->
                                        <img src="{{ asset('dashboard_assets') }}/images/logos/logo-text.svg" alt="homepage"
                                            class="dark-logo ps-2">
                                        <!-- Light Logo text -->
                                        <img src="{{ asset('dashboard_assets') }}/images/logos/logo-light-text.svg"
                                            class="light-logo ps-2" alt="homepage">
                                    </span>
                                </a>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Username</label>
                                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" >

                                        @error('email')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">

                                        @error('password')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>
                                    <div class="d-flex align-items-center justify-content-end mb-4">
                                        <a class="text-primary fw-medium" href="{{ route('password.request') }}">Forgot Password ?</a>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 mb-4">Sign In</button>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-medium">Don't Have Account ?</p>
                                        <a class="text-primary fw-medium ms-2" href="{{ route('register') }}">Create anaccount</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function handleColorTheme(e) {
                    document.documentElement.setAttribute("data-color-theme", e);
                }
            </script>
        </div>
    </div>
    <div class="dark-transparent sidebartoggler"></div>
@endsection
