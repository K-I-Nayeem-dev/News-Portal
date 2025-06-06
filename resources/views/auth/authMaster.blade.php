<div>
    <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
</div>
<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('dashboard_assets') }}/images/logos/favicon.png">

    <!-- Core Css -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets') }}/css/styles.css">

    <title>MaterialPro Template by WrapPixel</title>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('dashboard_assets') }}/images/logos/logo-icon.svg" alt="loader" class="lds-ripple img-fluid">
    </div>

        {{-- Content from Login And Register --}}
        @yield('auth')

    <!-- Import Js Files -->
    <script src="{{ asset('dashboard_assets') }}/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('dashboard_assets') }}/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="{{ asset('dashboard_assets') }}/js/theme/app.init.js"></script>
    <script src="{{ asset('dashboard_assets') }}/js/theme/theme.js"></script>
    <script src="{{ asset('dashboard_assets') }}/js/theme/app.min.js"></script>
    <script src="{{ asset('dashboard_assets') }}/js/theme/feather.min.js"></script>

    <!-- solar icons -->
    <script src="{{ asset('dashboard_assets') }}/npm/iconify-icon%401.0.8/dist/iconify-icon.min.js"></script>

</body>

</html>

