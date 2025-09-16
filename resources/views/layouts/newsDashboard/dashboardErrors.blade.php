<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon icon-->
    {{-- <link rel="shortcut icon" type="image/png" href="{{ asset('dashboard_assets') }}/images/logos/favicon.png"> --}}

    <!-- Core Css -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets') }}/css/styles.css">

    <title>MaterialPro Template by WrapPixel</title>
</head>

<body>
    <div id="main-wrapper">
        <div
            class="position-relative overflow-hidden min-vh-100 w-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-lg-4">
                        <div class="text-center">
                            <img src="{{ asset('dashboard_assets/images/backgrounds/errorimg.svg') }}" alt="Error Image"
                                class="img-fluid" width="500">

                            <h1 class="fw-semibold mb-3">Oops!!!</h1>

                            @if (Request::is('invitation-invalid'))
                                <h4 class="fw-semibold mb-4">This invitation link is invalid, expired, or already used.
                                </h4>
                            @else
                                <h4 class="fw-semibold mb-4">This page you are looking for could not be found.</h4>

                                {{-- Show button only for fallback / 404 --}}
                                <a class="btn btn-primary mt-3" href="{{ route('dashboard') }}" role="button">
                                    Go Back to Home
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="dark-transparent sidebartoggler"></div> --}}
    <!-- Import Js Files -->
    {{-- <script src="{{ asset('dashboard_assets') }}/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('dashboard_assets') }}/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="{{ asset('dashboard_assets') }}/js/theme/app.init.js"></script>
    <script src="{{ asset('dashboard_assets') }}/js/theme/theme.js"></script>
    <script src="{{ asset('dashboard_assets') }}/js/theme/app.min.js"></script>
    <script src="{{ asset('dashboard_assets') }}/js/theme/feather.min.js"></script> --}}

    <!-- solar icons -->
    <script src="{{ asset('dashboard_assets') }}/npm/iconify-icon%401.0.8/dist/iconify-icon.min.js"></script>

</body>

</html>
