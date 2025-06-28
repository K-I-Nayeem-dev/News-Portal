<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>

    <link rel="stylesheet" href="https://unpkg.com/@icon/themify-icons/themify-icons.css">

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('dashboard_assets') }}/images/logos/favicon.png">

    <!-- Core Css -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets') }}/css/styles.css">

    {{-- font Awesome Cdn --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>MaterialPro Template by WrapPixel</title>

</head>

<body>
    {{-- <div class="toast toast-onload align-items-center text-bg-secondary border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body hstack align-items-start gap-6">
        <i class="ti ti-alert-circle fs-6"></i>
        <div>
            <h5 class="text-white fs-3 mb-1">Welcome to MaterialPro</h5>
            <h6 class="text-white fs-2 mb-0">Easy to costomize the Template!!!</h6>
        </div>
        <button type="button" class="btn-close btn-close-white fs-2 m-0 ms-auto shadow-none" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div> --}}
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('dashboard_assets') }}/images/logos/logo-icon.svg" alt="loader"
            class="lds-ripple img-fluid">
    </div>
    <div id="main-wrapper">
        <!-- Sidebar Start -->
        <aside class="left-sidebar with-vertical">
            <div><!-- ---------------------------------- -->
                <!-- Start Vertical Layout Sidebar -->
                <!-- ---------------------------------- -->
                <!-- Sidebar scroll-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <!-----------Profile------------------>
                    <div class="user-profile position-relative"
                        style="background: url({{ asset('dashboard_assets') }}/images/backgrounds/user-info.jpg) no-repeat;">
                        <!-- User profile image -->
                        <div class="profile-img">
                            @if (!Auth::user()->profile_picture)
                                <img src="{{ asset('dashboard_assets') }}/images/profile/user-1.jpg"
                                    alt="materialpro-img" class="img-fluid rounded-circle" width="120"
                                    height="120">
                            @else
                                <img style="border-radius: 50%" width="50" height="50"
                                    src="{{ asset('uploads/profile_pictures/' . Auth::user()->profile_picture) }}"
                                    alt="{{ Auth::user()->name  }}">
                            @endif
                        </div>
                        <!-- User profile text-->
                        <div class="profile-text hide-menu pt-1 dropdown">
                            <a href="javascript:void(0)"
                                class="dropdown-toggle u-dropdown w-100 text-white d-block position-relative id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-expanded="false">{{ auth()->user()->name }} {{ Auth::user()->role ?  ' ('. Auth::user()->role .') ': ' ' }}</a>
                            <div class="dropdown-menu animated flipInY" aria-labelledby="dropdownMenuLink">

                                <a class="dropdown-item d-flex gap-2" href="{{ route('profile.index') }}"> <i
                                        data-feather="user" class="feather-sm text-info "></i> My Profile </a>
                                <a class="dropdown-item d-flex gap-2" href="app-notes.html"> <i
                                        data-feather="credit-card" class="feather-sm text-info "></i> My Notes </a>
                                <a class="dropdown-item d-flex gap-2" href="app-email.html"> <i data-feather="mail"
                                        class="feather-sm text-success "></i> Inbox </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item d-flex gap-2" href="{{ route('profile.edit') }}"> <i
                                        data-feather="settings" class="feather-sm text-warning "></i> Account Setting
                                </a>
                                <div class="dropdown-divider ms-2"></div>
                                <div class="d-flex align-items-center ms-3">
                                    <i data-feather="log-out" class="feather-sm text-danger"></i>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button style="background-color: transparent; border: none;"
                                            href="{{ route('logout') }}"
                                            class="text-danger btn btn-danger ms-1 btn-sm">Log Out</button>
                                    </form>
                                </div>
                                <div class="dropdown-divider"></div>

                                {{-- <div class="px-3 py-2">
                                    <a href="page-user-profile.html"
                                        class="btn d-block w-100 btn-info rounded-pill">View Profile</a>
                                </div> --}}

                            </div>
                        </div>
                    </div>
                    <!-----------Profile End------------------>


                    <ul id="sidebarnav">
                        <!-- ---------------------------------- -->
                        <!-- Home -->
                        <!-- ---------------------------------- -->

                        <li class="nav-small-cap" id="get-url">
                            <iconify-icon icon="solar:menu-dots-bold" class="nav-small-cap-icon fs-4"></iconify-icon>
                            <span class="hide-menu">Personal</span>
                        </li>
                        <!-- ---------------------------------- -->
                        <!-- Dashboard -->
                        <!-- ---------------------------------- -->

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('dashboard') }}">
                                <iconify-icon icon="solar:screencast-2-linear" class="aside-icon"></iconify-icon>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>

                        <!-- ---------------------------------- -->
                        <!-- Front Pages -->
                        <!-- ---------------------------------- -->
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <iconify-icon icon="solar:home-angle-linear" class="aside-icon"></iconify-icon>
                                <span class="hide-menu">News</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="{{ route('news.index') }}" class="sidebar-link sublink">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <iconify-icon icon="solar:stop-circle-line-duotone"></iconify-icon>
                                        </div>
                                        <span class="hide-menu">Show News</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('news.create') }}" class="sidebar-link sublink">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <iconify-icon icon="solar:stop-circle-line-duotone"></iconify-icon>
                                        </div>
                                        <span class="hide-menu">Create News</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('breaking_news.index') }}">
                                <iconify-icon icon="solar:screencast-2-linear" class="aside-icon"></iconify-icon>
                                <span class="hide-menu">Breaking News</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('categories.index') }}">
                                <iconify-icon icon="solar:screencast-2-linear" class="aside-icon"></iconify-icon>
                                <span class="hide-menu">Category</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('sub_categories.index') }}">
                                <iconify-icon icon="solar:screencast-2-linear" class="aside-icon"></iconify-icon>
                                <span class="hide-menu">Sub Categories</span>
                            </a>
                        </li>

                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'editor')
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('watermark.index') }}">
                                    <iconify-icon icon="solar:screencast-2-linear" class="aside-icon"></iconify-icon>
                                    <span class="hide-menu">Watermart</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('invitations.index') }}">
                                    <iconify-icon icon="solar:screencast-2-linear" class="aside-icon"></iconify-icon>
                                    <span class="hide-menu">Invite Member</span>
                                </a>
                            </li>
                        @endif
                    </ul>


                </nav>

                <!-- End Sidebar scroll-->
            </div>
        </aside>
        <!--  Sidebar End -->
        <div class="page-wrapper">
            <!--  Header Start -->
            <header class="topbar rounded-0 border-0 bg-primary">
                <div class="with-vertical"><!-- ---------------------------------- -->
                    <!-- Start Vertical Layout Header -->
                    <!-- ---------------------------------- -->
                    <nav class="navbar navbar-expand-lg px-lg-0 px-3 py-0">
                        <div class="d-none d-lg-block">
                            <div class="brand-logo d-flex align-items-center justify-content-between">
                                <a href="{{ route('dashboard') }}"
                                    class="text-nowrap logo-img d-flex align-items-center gap-2">
                                    <b class="logo-icon">
                                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                        <!-- Dark Logo icon -->
                                        <img src="{{ asset('dashboard_assets') }}/images/logos/logo-light-icon.svg"
                                            alt="homepage" class="dark-logo">
                                        <!-- Light Logo icon -->
                                        <img src="{{ asset('dashboard_assets') }}/images/logos/logo-light-icon.svg"
                                            alt="homepage" class="light-logo">
                                    </b>
                                    <!--End Logo icon -->
                                    <!-- Logo text -->
                                    <span class="logo-text">
                                        <!-- dark Logo text -->
                                        <img src="{{ asset('dashboard_assets') }}/images/logos/logo-light-text.svg"
                                            alt="homepage" class="dark-logo ps-2">
                                        <!-- Light Logo text -->
                                        <img src="{{ asset('dashboard_assets') }}/images/logos/logo-light-text.svg"
                                            class="light-logo ps-2" alt="homepage">
                                    </span>
                                </a>
                            </div>
                        </div>

                        <ul class="navbar-nav gap-2">

                            <li class="nav-item nav-icon-hover-bg rounded-circle">
                                <a class="nav-link nav-icon-hover sidebartoggler" id="headerCollapse"
                                    href="javascript:void(0)">
                                    <iconify-icon icon="solar:list-bold"></iconify-icon>
                                </a>
                            </li>
                            <!-- ------------------------------- -->
                            <!-- start notification Dropdown -->
                            <!-- ------------------------------- -->
                            <li class="nav-item d-none d-lg-block search-box nav-icon-hover-bg rounded-circle">
                                <a class="nav-link nav-icon-hover d-none d-md-flex waves-effect waves-dark"
                                    href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <iconify-icon icon="solar:magnifer-linear"></iconify-icon>
                                </a>
                            </li>

                        </ul>

                        <div class="d-block d-lg-none">
                            <div class="brand-logo d-flex align-items-center justify-content-between">
                                <a href="index.html" class="text-nowrap logo-img d-flex align-items-center gap-2">
                                    <b class="logo-icon">
                                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                        <!-- Dark Logo icon -->
                                        <img src="{{ asset('dashboard_assets') }}/images/logos/logo-light-icon.svg"
                                            alt="homepage" class="dark-logo">
                                        <!-- Light Logo icon -->
                                        <img src="{{ asset('dashboard_assets') }}/images/logos/logo-light-icon.svg"
                                            alt="homepage" class="light-logo">
                                    </b>
                                    <!--End Logo icon -->
                                    <!-- Logo text -->
                                    <span class="logo-text">
                                        <!-- dark Logo text -->
                                        <img src="{{ asset('dashboard_assets') }}/images/logos/logo-light-text.svg"
                                            alt="homepage" class="dark-logo ps-2">
                                        <!-- Light Logo text -->
                                        <img src="{{ asset('dashboard_assets') }}/images/logos/logo-light-text.svg"
                                            class="light-logo ps-2" alt="homepage">
                                    </span>
                                </a>
                            </div>
                        </div>
                        <ul
                            class="navbar-nav flex-row  gap-2 align-items-center justify-content-center d-flex d-lg-none">
                            <li class="nav-item dropdown nav-icon-hover-bg rounded-circle">
                                <a class="navbar-toggler nav-link text-white nav-icon-hover border-0"
                                    href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="">
                                        <i class="ti ti-dots fs-7"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                            <div class="d-flex align-items-center justify-content-between py-2 py-lg-0">
                                <ul
                                    class="navbar-nav flex-row  align-items-center justify-content-center d-flex d-lg-none">
                                    <li class="nav-item dropdown">
                                        <a href="javascript:void(0)"
                                            class="nav-link d-flex d-lg-none align-items-center justify-content-center"
                                            type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar"
                                            aria-controls="offcanvasWithBothOptions">
                                            <iconify-icon icon="solar:menu-dots-circle-linear"></iconify-icon>
                                        </a>
                                    </li>
                                    <li class="nav-item hover-dd dropdown nav-icon-hover-bg rounded-circle">
                                        <a class="nav-link nav-icon-hover waves-effect waves-dark"
                                            href="javascript:void(0)" id="drop2" aria-expanded="false">
                                            <iconify-icon icon="solar:bell-bing-line-duotone"></iconify-icon>
                                            <div class="notify">
                                                <span class="heartbit"></span>
                                                <span class="point"></span>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu py-0 content-dd  dropdown-menu-animate-up overflow-hidden"
                                            aria-labelledby="drop2">

                                            <div class="py-3 px-4 bg-primary">
                                                <div class="mb-0 fs-6 fw-medium text-white">Notifications</div>
                                                <div class="mb-0 fs-2 fw-medium text-white">You have 4 Notifications
                                                </div>
                                            </div>
                                            <div class="p-3">
                                                <a class="d-flex btn btn-primary  align-items-center justify-content-center gap-2"
                                                    href="javascript:void(0);">
                                                    <span>Check all Notifications</span>
                                                    <iconify-icon icon="solar:alt-arrow-right-outline"
                                                        class="iconify-sm"></iconify-icon>
                                                </a>
                                            </div>





                                        </div>
                                    </li>
                                    <li class="nav-item hover-dd dropdown nav-icon-hover-bg rounded-circle">
                                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                            aria-expanded="false">
                                            <iconify-icon icon="solar:inbox-line-line-duotone"></iconify-icon>
                                            <div class="notify">
                                                <span class="heartbit"></span>
                                                <span class="point"></span>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu py-0 content-dd dropdown-menu-animate-up overflow-hidden"
                                            aria-labelledby="drop2">

                                            <div class="py-3 px-4 bg-secondary">
                                                <div class="mb-0 fs-6 fw-medium text-white">Messages</div>
                                                <div class="mb-0 fs-2 fw-medium text-white">You have 5 new messages
                                                    asdfsdfsafa</div>
                                            </div>
                                            <div class="message-body" data-simplebar="">
                                                <a href="javascript:void(0)"
                                                    class="p-3 d-flex align-items-center dropdown-item gap-3 border-bottom">
                                                    <span class="user-img position-relative d-inline-block">
                                                        <img src="{{ asset('dashboard_assets') }}/images/profile/user-2.jpg"
                                                            alt="user" class="rounded-circle w-100 round-40">
                                                        <span
                                                            class="profile-status bg-success position-absolute rounded-circle"></span>
                                                    </span>
                                                    <div class="w-80">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-1">Mathew Anderson</h6>
                                                            <span class="fs-2 d-block text-muted">9:30 AM</span>
                                                        </div>
                                                        <span class="fs-2 d-block text-truncate text-muted">Just see
                                                            the my new admin!</span>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="p-3 d-flex align-items-center dropdown-item gap-3 border-bottom">
                                                    <span class="user-img position-relative d-inline-block">
                                                        <img src="{{ asset('dashboard_assets') }}/images/profile/user-3.jpg"
                                                            alt="user" class="rounded-circle w-100 round-40">
                                                        <span
                                                            class="profile-status bg-success position-absolute rounded-circle"></span>
                                                    </span>
                                                    <div class="w-80">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-1">Bianca Anderson</h6>
                                                            <span class="fs-2 d-block text-muted">9:10 AM</span>
                                                        </div>

                                                        <span class="fs-2 d-block text-truncate text-muted">Just a
                                                            reminder that you have event</span>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="p-3 d-flex align-items-center dropdown-item gap-3 border-bottom">
                                                    <span class="user-img position-relative d-inline-block">
                                                        <img src="{{ asset('dashboard_assets') }}/images/profile/user-4.jpg"
                                                            alt="user" class="rounded-circle w-100 round-40">
                                                        <span
                                                            class="profile-status bg-success position-absolute rounded-circle"></span>
                                                    </span>
                                                    <div class="w-80">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-1">Andrew Johnson</h6>
                                                            <span class="fs-2 d-block text-muted">9:08 AM</span>
                                                        </div>
                                                        <span class="fs-2 d-block text-truncate text-muted">You can
                                                            customize this template as you want</span>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="p-3 d-flex align-items-center dropdown-item gap-3 border-bottom">
                                                    <span class="user-img position-relative d-inline-block">
                                                        <img src="{{ asset('dashboard_assets') }}/images/profile/user-5.jpg"
                                                            alt="user" class="rounded-circle w-100 round-40">
                                                        <span
                                                            class="profile-status bg-success position-absolute rounded-circle"></span>
                                                    </span>
                                                    <div class="w-80">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-1">Miyra Strokes</h6>
                                                            <span class="fs-2 d-block text-muted">9:30 AM</span>
                                                        </div>
                                                        <span class="fs-2 d-block text-truncate text-muted">Just see
                                                            the my new admin!</span>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="p-3 d-flex align-items-center dropdown-item gap-3 border-bottom">
                                                    <span class="user-img position-relative d-inline-block">
                                                        <img src="{{ asset('dashboard_assets') }}/images/profile/user-6.jpg"
                                                            alt="user" class="rounded-circle w-100 round-40">
                                                        <span
                                                            class="profile-status bg-success position-absolute rounded-circle"></span>
                                                    </span>
                                                    <div class="w-80">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-1">Mark, Stoinus & Rishvi..</h6>
                                                            <span class="fs-2 d-block text-muted">9:10 AM</span>
                                                        </div>
                                                        <span class="fs-2 d-block text-truncate text-muted">Just a
                                                            reminder that you have event</span>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="p-3 d-flex align-items-center dropdown-item gap-3 border-bottom">
                                                    <span class="user-img position-relative d-inline-block">
                                                        <img src="{{ asset('dashboard_assets') }}/images/profile/user-7.jpg"
                                                            alt="user" class="rounded-circle w-100 round-40">
                                                        <span
                                                            class="profile-status bg-success position-absolute rounded-circle"></span>
                                                    </span>
                                                    <div class="w-80">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-1">Eliga Rush</h6>
                                                            <span class="fs-2 d-block text-muted">9:08 AM</span>
                                                        </div>
                                                        <span class="fs-2 d-block text-truncate text-muted">You can
                                                            customize this template as you want</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="p-3">
                                                <a class="d-flex btn btn-secondary  align-items-center justify-content-center gap-2"
                                                    href="javascript:void(0);">
                                                    <span>Check all Messages</span>
                                                    <iconify-icon icon="solar:alt-arrow-right-outline"
                                                        class="iconify-sm"></iconify-icon>
                                                </a>
                                            </div>

                                        </div>
                                    </li>
                                </ul>
                                <ul
                                    class="navbar-nav gap-2 flex-row ms-auto align-items-center justify-content-center">

                                    <li class="nav-item nav-icon-hover-bg rounded-circle">
                                        <a class="nav-link nav-icon-hover moon dark-layout" href="javascript:void(0)">
                                            <iconify-icon icon="solar:moon-line-duotone"
                                                class="moon"></iconify-icon>
                                        </a>
                                        <a class="nav-link nav-icon-hover sun light-layout" href="javascript:void(0)">
                                            <iconify-icon icon="solar:sun-2-line-duotone"
                                                class="sun"></iconify-icon>
                                        </a>
                                    </li>

                                    <li
                                        class="nav-item hover-dd dropdown nav-icon-hover-bg rounded-circle d-none d-lg-block">
                                        <a class="nav-link nav-icon-hover waves-effect waves-dark"
                                            href="javascript:void(0)" id="drop2" aria-expanded="false">
                                            <iconify-icon icon="solar:bell-bing-line-duotone"></iconify-icon>

                                            @if (Auth::user()->name)
                                                <div class="notify">
                                                    <span class="heartbit"></span>
                                                    <span class="point"></span>
                                                </div>
                                            @endif

                                        </a>
                                        <div class="dropdown-menu py-0 content-dd  dropdown-menu-animate-up overflow-hidden dropdown-menu-end"
                                            aria-labelledby="drop2">

                                            <div class="py-3 px-4 bg-primary">
                                                <div class="mb-0 fs-6 fw-medium text-white">Notifications</div>
                                                <div class="mb-0 fs-2 fw-medium text-white">You have 0 Notifications
                                                </div>
                                            </div>
                                            <div class="p-3">
                                                <a class="d-flex btn btn-primary  align-items-center justify-content-center gap-2"
                                                    href="javascript:void(0);">
                                                    <span>Check all Notifications</span>
                                                    <iconify-icon icon="solar:alt-arrow-right-outline"
                                                        class="iconify-sm"></iconify-icon>
                                                </a>
                                            </div>





                                        </div>
                                    </li>


                                    <!-- ------------------------------- -->
                                    <!-- end notification Dropdown -->
                                    <!-- ------------------------------- -->

                                    <!-- ------------------------------- -->
                                    <!-- start profile Dropdown -->
                                    <!-- ------------------------------- -->
                                    <li class="nav-item hover-dd dropdown">
                                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                            aria-expanded="false">
                                            @if (!Auth::user()->profile_picture)
                                                <img src="{{ asset('dashboard_assets') }}/images/profile/user-1.jpg"
                                                    alt="materialpro-img" class="img-fluid rounded-circle"
                                                    width="120" height="120">
                                            @else
                                                <img style="border-radius: 50%" width="25" height="25"
                                                    src="{{ asset('uploads/profile_pictures/' . Auth::user()->profile_picture) }}"
                                                    alt="{{ Auth::user()->name }}">
                                            @endif
                                        </a>
                                        <div class="dropdown-menu content-dd overflow-hidden pt-0 dropdown-menu-end user-dd"
                                            aria-labelledby="drop2">
                                            <div class="profile-dropdown position-relative" data-simplebar="">
                                                <div class=" py-3 border-bottom">
                                                    <div class="d-flex align-items-center px-3">
                                                        @if (!Auth::user()->profile_picture)
                                                            <img src="{{ asset('dashboard_assets') }}/images/profile/user-1.jpg"
                                                                alt="materialpro-img" class="img-fluid rounded-circle"
                                                                width="120" height="120">
                                                        @else
                                                            <img style="border-radius: 50%" width="50"
                                                                height="50"
                                                                src="{{ asset('uploads/profile_pictures/' . Auth::user()->profile_picture) }}"
                                                                alt="{{ Auth::user()->name }}">
                                                        @endif
                                                        <div class="ms-3">
                                                            <h5 class="mb-1 fs-4">{{ Auth::user()->name }}</h5>
                                                            <p class="mb-0 fs-2 d-flex align-items-center text-muted">
                                                                {{ Auth::user()->email }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="message-body pb-3">
                                                    <div class="px-3 pt-3">
                                                        <div class="h6 mb-0 dropdown-item py-8 px-3 rounded-2 link">
                                                            <a href="{{ url('/profile') }}"
                                                                class=" d-flex  align-items-center ">
                                                                My Profile
                                                            </a>
                                                        </div>
                                                        <div class="h6 mb-0 dropdown-item py-8 px-3 rounded-2 link">
                                                            <a href="javascript:void(0)"
                                                                class=" d-flex  align-items-center ">
                                                                My Projects
                                                            </a>
                                                        </div>
                                                        <div class="h6 mb-0 dropdown-item py-8 px-3 rounded-2 link">
                                                            <a href="app-email.html"
                                                                class=" d-flex  align-items-center ">
                                                                Inbox
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="px-3">
                                                        <div class="h6 mb-0 dropdown-item py-8 px-3 rounded-2 link">
                                                            <a href="{{ route('profile.edit') }}"
                                                                class=" d-flex  align-items-center  ">
                                                                Account Settings
                                                            </a>
                                                        </div>
                                                        <div class="mt-2 ms-2">
                                                            <form id="logout-form" action="{{ route('logout') }}"
                                                                method="POST">
                                                                @csrf
                                                                <button href="{{ route('logout') }}"
                                                                    class="text-white btn btn-danger">Log Out</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </li>


                                    <!-- ------------------------------- -->
                                    <!-- end profile Dropdown -->
                                    <!-- ------------------------------- -->
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <!-- ---------------------------------- -->
                    <!-- End Vertical Layout Header -->
                    <!-- ---------------------------------- -->

                    <!-- ------------------------------- -->
                    <!-- apps Dropdown in Small screen -->
                    <!-- ------------------------------- -->
                    <!--  Mobilenavbar -->
                    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="mobilenavbar"
                        aria-labelledby="offcanvasWithBothOptionsLabel">
                        <nav class="sidebar-nav scroll-sidebar">
                            <div class="offcanvas-header justify-content-between">
                                <a href="index.html" class="text-nowrap logo-img d-block">
                                    <b class="logo-icon">
                                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                        <!-- Dark Logo icon -->
                                        <img src="{{ asset('dashboard_assets') }}/images/logos/logo-icon.svg"
                                            alt="homepage">
                                    </b>
                                    <!--End Logo icon -->
                                    <!-- Logo text -->
                                    <span class="logo-text">
                                        <!-- dark Logo text -->
                                        <img src="{{ asset('dashboard_assets') }}/images/logos/logo-text.svg"
                                            alt="homepage" class="dark-logo ps-2">
                                        <!-- Light Logo text -->
                                        <img src="{{ asset('dashboard_assets') }}/images/logos/logo-light-text.svg"
                                            class="light-logo ps-2" alt="homepage">
                                    </span>
                                </a>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="app-header with-horizontal">
                    <nav class="navbar navbar-expand-xl container-fluid">
                        <ul class="navbar-nav gap-2 align-items-center">
                            <li class="nav-item d-block d-xl-none">
                                <a class="nav-link sidebartoggler ms-n3" id="sidebarCollapse"
                                    href="javascript:void(0)">
                                    <iconify-icon icon="solar:hamburger-menu-line-duotone"></iconify-icon>
                                </a>
                            </li>
                            <li class="nav-item d-none d-xl-block">
                                <div class="brand-logo d-flex align-items-center justify-content-between">
                                    <a href="index.html" class="text-nowrap logo-img d-flex align-items-center gap-2">
                                        <b class="logo-icon">
                                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                            <!-- Dark Logo icon -->
                                            <img src="{{ asset('dashboard_assets') }}/images/logos/logo-light-icon.svg"
                                                alt="homepage" class="dark-logo">
                                            <!-- Light Logo icon -->
                                            <img src="{{ asset('dashboard_assets') }}/images/logos/logo-light-icon.svg"
                                                alt="homepage" class="light-logo">
                                        </b>
                                        <!--End Logo icon -->
                                        <!-- Logo text -->
                                        <span class="logo-text">
                                            <!-- dark Logo text -->
                                            <img src="{{ asset('dashboard_assets') }}/images/logos/logo-light-text.svg"
                                                alt="homepage" class="dark-logo ps-2">
                                            <!-- Light Logo text -->
                                            <img src="{{ asset('dashboard_assets') }}/images/logos/logo-light-text.svg"
                                                class="light-logo ps-2" alt="homepage">
                                        </span>
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item d-none d-lg-block search-box">
                                <a class="nav-link nav-icon-hover d-none d-md-flex waves-effect waves-dark"
                                    href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <iconify-icon icon="solar:magnifer-linear"></iconify-icon>
                                </a>
                            </li>
                        </ul>


                        <a class="navbar-toggler nav-icon-hover p-0 border-0 text-white" href="javascript:void(0)"
                            data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="p-2">
                                <i class="ti ti-dots fs-7"></i>
                            </span>
                        </a>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                            <div class="d-flex align-items-center justify-content-between">
                                <ul
                                    class="navbar-nav gap-2 flex-row ms-auto align-items-center justify-content-center">
                                    <!-- ------------------------------- -->
                                    <!-- start language Dropdown -->
                                    <!-- ------------------------------- -->
                                    <li class="nav-item hover-dd dropdown nav-icon-hover-bg rounded-circle">
                                        <a class="nav-link" href="javascript:void(0)" id="drop2"
                                            aria-expanded="false">
                                            <img src="{{ asset('dashboard_assets') }}/images/svgs/icon-flag-en.svg"
                                                alt="" width="20px" height="20px" class="round-20">
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                            aria-labelledby="drop2">
                                            <div class="message-body">
                                                <a href="javascript:void(0)"
                                                    class="d-flex align-items-center gap-2 py-2 px-4 dropdown-item">
                                                    <div class="position-relative">
                                                        <img src="{{ asset('dashboard_assets') }}/images/svgs/icon-flag-en.svg"
                                                            alt="" width="20px" height="20px"
                                                            class="round-20">
                                                    </div>
                                                    <p class="mb-0 fs-3">English</p>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="d-flex align-items-center gap-2 py-2 px-4 dropdown-item">
                                                    <div class="position-relative">
                                                        <img src="{{ asset('dashboard_assets') }}/images/svgs/icon-flag-cn.svg"
                                                            alt="" width="20px" height="20px"
                                                            class="round-20">
                                                    </div>
                                                    <p class="mb-0 fs-3">Chinese</p>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="d-flex align-items-center gap-2 py-2 px-4 dropdown-item">
                                                    <div class="position-relative">
                                                        <img src="{{ asset('dashboard_assets') }}/images/svgs/icon-flag-fr.svg"
                                                            alt="" width="20px" height="20px"
                                                            class="round-20">
                                                    </div>
                                                    <p class="mb-0 fs-3">French</p>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="d-flex align-items-center gap-2 py-2 px-4 dropdown-item">
                                                    <div class="position-relative">
                                                        <img src="{{ asset('dashboard_assets') }}/images/svgs/icon-flag-sa.svg"
                                                            alt="" width="20px" height="20px"
                                                            class="round-20">
                                                    </div>
                                                    <p class="mb-0 fs-3">Arabic</p>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- ------------------------------- -->
                                    <!-- end language Dropdown -->
                                    <!-- ------------------------------- -->
                                    <li class="nav-item nav-icon-hover-bg rounded-circle">
                                        <a class="nav-link nav-icon-hover moon dark-layout" href="javascript:void(0)">
                                            <iconify-icon icon="solar:moon-line-duotone"
                                                class="moon"></iconify-icon>
                                        </a>
                                        <a class="nav-link nav-icon-hover sun light-layout" href="javascript:void(0)">
                                            <iconify-icon icon="solar:sun-2-line-duotone"
                                                class="sun"></iconify-icon>
                                        </a>
                                    </li>



                                    <li
                                        class="nav-item hover-dd dropdown nav-icon-hover-bg rounded-circle  d-none d-lg-block">
                                        <a class="nav-link nav-icon-hover waves-effect waves-dark"
                                            href="javascript:void(0)" id="drop2" aria-expanded="false">
                                            <iconify-icon icon="solar:bell-bing-line-duotone"></iconify-icon>
                                            <div class="notify">
                                                <span class="heartbit"></span>
                                                <span class="point"></span>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu py-0 content-dd  dropdown-menu-animate-up dropdown-menu-end overflow-hidden"
                                            aria-labelledby="drop2">

                                            <div class="py-3 px-4 bg-primary">
                                                <div class="mb-0 fs-6 fw-medium text-white">Notifications</div>
                                                <div class="mb-0 fs-2 fw-medium text-white">You have 4 Notifications
                                                </div>
                                            </div>
                                            <div class="message-body" data-simplebar="">
                                                <a href="javascript:void(0)"
                                                    class="p-3 d-flex align-items-center  dropdown-item gap-3   border-bottom">
                                                    <span
                                                        class="flex-shrink-0 bg-primary-subtle rounded-circle round-40 d-flex align-items-center justify-content-center fs-6 text-primary">
                                                        <iconify-icon
                                                            icon="solar:widget-3-line-duotone"></iconify-icon>
                                                    </span>
                                                    <div class="w-80">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-1">Launch Admin</h6>
                                                            <span class="fs-2 d-block text-muted ">9:30 AM</span>
                                                        </div>
                                                        <span class="fs-2 d-block text-truncate text-muted">Just see
                                                            the my new admin!</span>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="p-3 d-flex align-items-center dropdown-item gap-3  border-bottom">
                                                    <span
                                                        class="flex-shrink-0 bg-secondary-subtle rounded-circle round-40 d-flex align-items-center justify-content-center fs-6 text-secondary">
                                                        <iconify-icon
                                                            icon="solar:calendar-mark-line-duotone"></iconify-icon>
                                                    </span>
                                                    <div class="w-80">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-1">Event today</h6>
                                                            <span class="fs-2 d-block text-muted ">9:10 AM</span>
                                                        </div>

                                                        <span class="fs-2 d-block text-truncate text-muted">Just a
                                                            reminder that you have event</span>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="p-3 d-flex align-items-center dropdown-item gap-3  border-bottom">
                                                    <span
                                                        class="flex-shrink-0 bg-danger-subtle rounded-circle round-40 d-flex align-items-center justify-content-center fs-6 text-danger">
                                                        <iconify-icon
                                                            icon="solar:settings-minimalistic-line-duotone"></iconify-icon>
                                                    </span>
                                                    <div class="w-80">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-1">Settings</h6>
                                                            <span class="fs-2 d-block text-muted ">9:08 AM</span>
                                                        </div>
                                                        <span class="fs-2 d-block text-truncate text-muted">You can
                                                            customize this template as you want</span>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="p-3 d-flex align-items-center dropdown-item gap-3  border-bottom">
                                                    <span
                                                        class="flex-shrink-0 bg-warning-subtle rounded-circle round-40 d-flex align-items-center justify-content-center fs-6 text-warning">
                                                        <iconify-icon
                                                            icon="solar:link-circle-line-duotone"></iconify-icon>
                                                    </span>
                                                    <div class="w-80">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-1">Luanch Admin</h6>
                                                            <span class="fs-2 d-block text-muted ">9:30 AM</span>
                                                        </div>
                                                        <span class="fs-2 d-block text-truncate text-muted">Just see
                                                            the my new admin!</span>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="p-3 d-flex align-items-center dropdown-item gap-3  border-bottom">
                                                    <span
                                                        class="flex-shrink-0 bg-success-subtle rounded-circle round-40 d-flex align-items-center justify-content-center">
                                                        <i data-feather="calendar"
                                                            class="feather-sm fill-white text-success"></i>
                                                    </span>
                                                    <div class="w-80">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-1">Event today</h6>
                                                            <span class="fs-2 d-block text-muted ">9:10 AM</span>
                                                        </div>
                                                        <span class="fs-2 d-block text-truncate text-muted">Just a
                                                            reminder that you have event</span>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="p-3 d-flex align-items-center dropdown-item gap-3  border-bottom">
                                                    <span
                                                        class="flex-shrink-0 bg-info-subtle rounded-circle round-40 d-flex align-items-center justify-content-center">
                                                        <i data-feather="settings"
                                                            class="feather-sm fill-white text-info"></i>
                                                    </span>
                                                    <div class="w-80">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-1">Settings</h6>
                                                            <span class="fs-2 d-block text-muted ">9:08 AM</span>
                                                        </div>
                                                        <span class="fs-2 d-block text-truncate text-muted">You can
                                                            customize this template as you want</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="p-3">
                                                <a class="d-flex btn btn-primary  align-items-center justify-content-center gap-2"
                                                    href="javascript:void(0);">
                                                    <span>Check all Notifications</span>
                                                    <iconify-icon icon="solar:alt-arrow-right-outline"
                                                        class="iconify-sm"></iconify-icon>
                                                </a>
                                            </div>





                                        </div>
                                    </li>

                                    <li
                                        class="nav-item hover-dd dropdown nav-icon-hover-bg rounded-circle d-none d-lg-block">
                                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                            aria-expanded="false">
                                            <iconify-icon icon="solar:inbox-line-line-duotone"></iconify-icon>
                                            <div class="notify">
                                                <span class="heartbit"></span>
                                                <span class="point"></span>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu py-0 content-dd dropdown-menu-animate-up  dropdown-menu-end overflow-hidden"
                                            aria-labelledby="drop2">

                                            <div class="py-3 px-4 bg-secondary">
                                                <div class="mb-0 fs-6 fw-medium text-white">Messages</div>
                                                <div class="mb-0 fs-2 fw-medium text-white">You have 5 new messages
                                                    sadfasdfasdf</div>
                                            </div>
                                            <div class="message-body" data-simplebar="">
                                                <a href="javascript:void(0)"
                                                    class="p-3 d-flex align-items-center dropdown-item gap-3 border-bottom">
                                                    <span class="user-img position-relative d-inline-block">
                                                        <img src="{{ asset('dashboard_assets') }}/images/profile/user-2.jpg"
                                                            alt="user" class="rounded-circle w-100 round-40">
                                                        <span
                                                            class="profile-status bg-success position-absolute rounded-circle"></span>
                                                    </span>
                                                    <div class="w-80">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-1">Mathew Anderson</h6>
                                                            <span class="fs-2 d-block text-muted">9:30 AM</span>
                                                        </div>
                                                        <span class="fs-2 d-block text-truncate text-muted">Just see
                                                            the my new admin!</span>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="p-3 d-flex align-items-center dropdown-item gap-3 border-bottom">
                                                    <span class="user-img position-relative d-inline-block">
                                                        <img src="{{ asset('dashboard_assets') }}/images/profile/user-3.jpg"
                                                            alt="user" class="rounded-circle w-100 round-40">
                                                        <span
                                                            class="profile-status bg-success position-absolute rounded-circle"></span>
                                                    </span>
                                                    <div class="w-80">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-1">Bianca Anderson</h6>
                                                            <span class="fs-2 d-block text-muted">9:10 AM</span>
                                                        </div>

                                                        <span class="fs-2 d-block text-truncate text-muted">Just a
                                                            reminder that you have event</span>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="p-3 d-flex align-items-center dropdown-item gap-3 border-bottom">
                                                    <span class="user-img position-relative d-inline-block">
                                                        <img src="{{ asset('dashboard_assets') }}/images/profile/user-4.jpg"
                                                            alt="user" class="rounded-circle w-100 round-40">
                                                        <span
                                                            class="profile-status bg-success position-absolute rounded-circle"></span>
                                                    </span>
                                                    <div class="w-80">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-1">Andrew Johnson</h6>
                                                            <span class="fs-2 d-block text-muted">9:08 AM</span>
                                                        </div>
                                                        <span class="fs-2 d-block text-truncate text-muted">You can
                                                            customize this template as you want</span>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="p-3 d-flex align-items-center dropdown-item gap-3 border-bottom">
                                                    <span class="user-img position-relative d-inline-block">
                                                        <img src="{{ asset('dashboard_assets') }}/images/profile/user-5.jpg"
                                                            alt="user" class="rounded-circle w-100 round-40">
                                                        <span
                                                            class="profile-status bg-success position-absolute rounded-circle"></span>
                                                    </span>
                                                    <div class="w-80">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-1">Miyra Strokes</h6>
                                                            <span class="fs-2 d-block text-muted">9:30 AM</span>
                                                        </div>
                                                        <span class="fs-2 d-block text-truncate text-muted">Just see
                                                            the my new admin!</span>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="p-3 d-flex align-items-center dropdown-item gap-3 border-bottom">
                                                    <span class="user-img position-relative d-inline-block">
                                                        <img src="{{ asset('dashboard_assets') }}/images/profile/user-6.jpg"
                                                            alt="user" class="rounded-circle w-100 round-40">
                                                        <span
                                                            class="profile-status bg-success position-absolute rounded-circle"></span>
                                                    </span>
                                                    <div class="w-80">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-1">Mark, Stoinus & Rishvi..</h6>
                                                            <span class="fs-2 d-block text-muted">9:10 AM</span>
                                                        </div>
                                                        <span class="fs-2 d-block text-truncate text-muted">Just a
                                                            reminder that you have event</span>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="p-3 d-flex align-items-center dropdown-item gap-3 border-bottom">
                                                    <span class="user-img position-relative d-inline-block">
                                                        <img src="{{ asset('dashboard_assets') }}/images/profile/user-7.jpg"
                                                            alt="user" class="rounded-circle w-100 round-40">
                                                        <span
                                                            class="profile-status bg-success position-absolute rounded-circle"></span>
                                                    </span>
                                                    <div class="w-80">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-1">Eliga Rush</h6>
                                                            <span class="fs-2 d-block text-muted">9:08 AM</span>
                                                        </div>
                                                        <span class="fs-2 d-block text-truncate text-muted">You can
                                                            customize this template as you want</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="p-3">
                                                <a class="d-flex btn btn-secondary  align-items-center justify-content-center gap-2"
                                                    href="javascript:void(0);">
                                                    <span>Check all Messages</span>
                                                    <iconify-icon icon="solar:alt-arrow-right-outline"
                                                        class="iconify-sm"></iconify-icon>
                                                </a>
                                            </div>

                                        </div>
                                    </li>


                                    <!-- ------------------------------- -->
                                    <!-- start profile Dropdown -->
                                    <!-- ------------------------------- -->
                                    <li class="nav-item hover-dd dropdown">
                                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                            aria-expanded="false">
                                            @if (!Auth::user()->profile_picture)
                                                <img src="{{ asset('dashboard_assets') }}/images/profile/user-1.jpg"
                                                    alt="materialpro-img" class="img-fluid rounded-circle"
                                                    width="120" height="120">
                                            @else
                                                <img style="border-radius: 50%" width="50" height="50"
                                                    src="{{ asset('uploads/profile_pictures/' . Auth::user()->profile_picture) }}"
                                                    alt="{{ Auth::user()->name }}">
                                            @endif
                                        </a>
                                        <div class="dropdown-menu content-dd overflow-hidden pt-0 dropdown-menu-end user-dd"
                                            aria-labelledby="drop2">
                                            <div class="profile-dropdown position-relative" data-simplebar="">
                                                <div class=" py-3 border-bottom">
                                                    <div class="d-flex align-items-center px-3">
                                                        <img src="{{ asset('dashboard_assets') }}/images/profile/user-1.jpg"
                                                            class="rounded-circle round-50" alt="">
                                                        <div class="ms-3">
                                                            <h5 class="mb-1 fs-4">{{ Auth::user()->name }}</h5>
                                                            <p class="mb-0 fs-2 d-flex align-items-center text-muted">
                                                                {{ Auth::user()->email }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="message-body pb-3">
                                                    <div class="px-3 pt-3">
                                                        <div class="h6 mb-0 dropdown-item py-8 px-3 rounded-2 link">
                                                            <a href="{{ route('profile.index') }}"
                                                                class=" d-flex  align-items-center ">
                                                                My Profile
                                                            </a>
                                                        </div>
                                                        <div class="h6 mb-0 dropdown-item py-8 px-3 rounded-2 link">
                                                            <a href="javascript:void(0)"
                                                                class=" d-flex  align-items-center ">
                                                                My Projects
                                                            </a>
                                                        </div>
                                                        <div class="h6 mb-0 dropdown-item py-8 px-3 rounded-2 link">
                                                            <a href="app-email.html"
                                                                class=" d-flex  align-items-center ">
                                                                Inbox
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="px-3">
                                                        <div
                                                            class="py-8 px-3 d-flex justify-content-between dropdown-item align-items-center h6 mb-0  rounded-2 link">
                                                            <a href="javascript:void(0)" class="">
                                                                Mode
                                                            </a>
                                                            <div>
                                                                <a class="moon dark-layout" href="javascript:void(0)">
                                                                    <iconify-icon icon="solar:moon-line-duotone"
                                                                        class="moon"></iconify-icon>
                                                                </a>
                                                                <a class="sun light-layout" href="javascript:void(0)">
                                                                    <iconify-icon icon="solar:sun-2-line-duotone"
                                                                        class="sun"></iconify-icon>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="h6 mb-0 dropdown-item py-8 px-3 rounded-2 link">
                                                            <a href="{{ route('profile.edit') }}"
                                                                class=" d-flex  align-items-center  ">
                                                                Account Settings
                                                            </a>
                                                        </div>
                                                        <div class="h6 mb-0 dropdown-item py-8 px-3 rounded-2 link">
                                                            <a href="authentication-login.html"
                                                                class=" d-flex  align-items-center ">
                                                                Sign Out
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </li>

                                    <!-- ------------------------------- -->
                                    <!-- end profile Dropdown -->
                                    <!-- ------------------------------- -->
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </header>
            <!--  Header End -->
            <aside class="left-sidebar with-horizontal">
                <!-- Sidebar scroll-->
                <div>
                    <!-- Sidebar navigation-->
                    <nav id="sidebarnavh" class="sidebar-nav scroll-sidebar container-fluid">
                        <ul id="sidebarnav">
                            <!-- ============================= -->
                            <!-- Home -->
                            <!-- ============================= -->
                            <li class="nav-small-cap">
                                <iconify-icon icon="solar:menu-dots-bold" class="nav-small-cap-icon"></iconify-icon>
                                <span class="hide-menu">Home</span>
                            </li>
                            <!-- =================== -->
                            <!-- Dashboard -->
                            <!-- =================== -->
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <iconify-icon icon="solar:screencast-2-linear" class="aside-icon"></iconify-icon>
                                    <span class="hide-menu">Dashboard</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    <li class="sidebar-item">
                                        <a href="index.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Modern Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="index2.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Awesome Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="index3.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Classy Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="index4.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Analytical Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="index5.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Minimal Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="index6.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">General Dashboard</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- ============================= -->
                            <!-- Front Pages -->
                            <!-- ============================= -->
                            <li class="nav-small-cap">
                                <iconify-icon icon="solar:document-text-line-duotone"
                                    class="nav-small-cap-icon"></iconify-icon>
                                <span class="hide-menu">Front Pages</span>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <iconify-icon icon="solar:programming-linear" class="aside-icon"></iconify-icon>
                                    <span class="hide-menu">Front Pages</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    <li class="sidebar-item">
                                        <a href="frontend-landingpage.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Homepage</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="frontend-aboutpage.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">About Us</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="frontend-blogpage.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Blog</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="frontend-blogdetailpage.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Blog Details</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="frontend-contactpage.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Contact Us</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="frontend-portfoliopage.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Portfolio</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="frontend-pricingpage.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Pricing</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- ============================= -->
                            <!-- Apps -->
                            <!-- ============================= -->
                            <li class="nav-small-cap">
                                <iconify-icon icon="solar:menu-dots-bold" class="nav-small-cap-icon"></iconify-icon>
                                <span class="hide-menu">Apps</span>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link two-column has-arrow" href="javascript:void(0)"
                                    aria-expanded="false">
                                    <iconify-icon icon="solar:archive-linear" class="aside-icon"></iconify-icon>
                                    <span class="hide-menu">Apps</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    <li class="sidebar-item">
                                        <a href="app-calendar.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Calendar</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="app-kanban.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Kanban</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="app-chat.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Chat</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="app-email.html" aria-expanded="false">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Email</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="app-contact.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Contact Table</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="app-contact2.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Contact List</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="app-notes.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Notes</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="app-invoice.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Invoice</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="page-user-profile.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">User Profile</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="blog-posts.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Posts</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="blog-detail.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Detail</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="eco-shop.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Shop</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="eco-shop-detail.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Shop Detail</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="eco-product-list.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">List</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="eco-checkout.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Checkout</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="eco-add-product.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Add Product</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="eco-edit-product.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Edit Product</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- ============================= -->
                            <!-- PAGES -->
                            <!-- ============================= -->
                            <li class="nav-small-cap">
                                <iconify-icon icon="solar:menu-dots-bold" class="nav-small-cap-icon"></iconify-icon>
                                <span class="hide-menu">PAGES</span>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <iconify-icon icon="solar:programming-linear" class="aside-icon"></iconify-icon>
                                    <span class="hide-menu">Pages</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    <li class="sidebar-item">
                                        <a href="page-faq.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">FAQ</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="{{ route('profile.edit') }}" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Account Setting</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="page-pricing.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Pricing</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="widgets-cards.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Card</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="widgets-banners.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Banner</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="widgets-charts.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Charts</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="../landingpage/index.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Landing Page</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="icon-tabler.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Tabler Icon</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="icon-solar.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Solar Icon</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- ============================= -->
                            <!-- UI -->
                            <!-- ============================= -->
                            <li class="nav-small-cap">
                                <iconify-icon icon="solar:menu-dots-bold" class="nav-small-cap-icon"></iconify-icon>
                                <span class="hide-menu">UI</span>
                            </li>
                            <!-- =================== -->
                            <!-- UI Elements -->
                            <!-- =================== -->
                            <li class="sidebar-item mega-dropdown">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <iconify-icon icon="solar:text-underline-cross-linear"
                                        class="aside-icon"></iconify-icon>
                                    <span class="hide-menu">UI</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    <li class="sidebar-item">
                                        <a href="ui-accordian.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Accordian</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="ui-badge.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Badge</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="ui-buttons.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Buttons</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="ui-dropdowns.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Dropdowns</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="ui-modals.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Modals</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="ui-tab.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Tab</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="ui-tooltip-popover.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Tooltip & Popover</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="ui-notification.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Alerts</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="ui-progressbar.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Progressbar</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="ui-pagination.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Pagination</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="ui-typography.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Typography</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="ui-bootstrap-ui.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Bootstrap UI</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="ui-breadcrumb.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Breadcrumb</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="ui-offcanvas.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Offcanvas</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="ui-lists.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Lists</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="ui-grid.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Grid</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="ui-carousel.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Carousel</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="ui-scrollspy.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Scrollspy</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="ui-spinner.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Spinner</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="ui-link.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Link</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- ============================= -->
                            <!-- Forms -->
                            <!-- ============================= -->
                            <li class="nav-small-cap">
                                <iconify-icon icon="solar:menu-dots-bold" class="nav-small-cap-icon"></iconify-icon>
                                <span class="hide-menu">Forms</span>
                            </li>
                            <!-- =================== -->
                            <!-- Forms -->
                            <!-- =================== -->
                            <li class="sidebar-item">
                                <a class="sidebar-link two-column has-arrow" href="javascript:void(0)"
                                    aria-expanded="false">
                                    <iconify-icon icon="solar:book-2-linear" class="aside-icon"></iconify-icon>
                                    <span class="hide-menu">Forms</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    <!-- form elements -->
                                    <li class="sidebar-item">
                                        <a href="form-inputs.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Forms Input</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="form-input-groups.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Input Groups</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="form-input-grid.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Input Grid</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="form-checkbox-radio.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Checkbox & Radios</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="form-bootstrap-switch.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Bootstrap Switch</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="form-select2.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Select2</span>
                                        </a>
                                    </li>
                                    <!-- form inputs -->
                                    <li class="sidebar-item">
                                        <a href="form-basic.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Basic Form</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="form-vertical.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Form Vertical</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="form-horizontal.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Form Horizontal</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="form-actions.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Form Actions</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="form-row-separator.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Row Separator</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="form-bordered.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Form Bordered</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="form-detail.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Form Detail</span>
                                        </a>
                                    </li>
                                    <!-- form wizard -->
                                    <li class="sidebar-item">
                                        <a href="form-wizard.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Form Wizard</span>
                                        </a>
                                    </li>
                                    <!-- Quill Editor -->
                                    <li class="sidebar-item">
                                        <a href="form-editor-quill.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Quill Editor</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- ============================= -->
                            <!-- Tables -->
                            <!-- ============================= -->
                            <li class="nav-small-cap">
                                <iconify-icon icon="solar:menu-dots-bold" class="nav-small-cap-icon"></iconify-icon>
                                <span class="hide-menu">Tables</span>
                            </li>
                            <!-- =================== -->
                            <!-- Bootstrap Table -->
                            <!-- =================== -->
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <iconify-icon icon="solar:sidebar-minimalistic-linear"
                                        class="aside-icon"></iconify-icon>
                                    <span class="hide-menu">Tables</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    <li class="sidebar-item">
                                        <a href="table-basic.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Basic Table</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="table-dark-basic.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Dark Basic Table</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="table-sizing.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Sizing Table</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="table-layout-coloured.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Coloured Table</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="table-datatable-basic.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Basic Initialisation</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="table-datatable-api.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">API</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="table-datatable-advanced.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Advanced Initialisation</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- ============================= -->
                            <!-- Charts -->
                            <!-- ============================= -->
                            <li class="nav-small-cap">
                                <iconify-icon icon="solar:menu-dots-bold" class="nav-small-cap-icon"></iconify-icon>
                                <span class="hide-menu">Charts</span>
                            </li>
                            <!-- =================== -->
                            <!-- Apex Chart -->
                            <!-- =================== -->
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <iconify-icon icon="solar:pie-chart-3-linear" class="aside-icon"></iconify-icon>
                                    <span class="hide-menu">Charts</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    <li class="sidebar-item">
                                        <a href="chart-apex-line.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Line Chart</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="chart-apex-area.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Area Chart</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="chart-apex-bar.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Bar Chart</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="chart-apex-pie.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Pie Chart</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="chart-apex-radial.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Radial Chart</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="chart-apex-radar.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Radar Chart</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- multi level -->
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <iconify-icon icon="solar:layers-minimalistic-linear"
                                        class="aside-icon"></iconify-icon>
                                    <span class="hide-menu">Multi DD</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    <li class="sidebar-item">
                                        <a href="../docs/index.html" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Documentation</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="javascript:void(0)" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Page 1</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="javascript:void(0)" class="sidebar-link has-arrow">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Page 2</span>
                                        </a>
                                        <ul aria-expanded="false" class="collapse second-level">
                                            <li class="sidebar-item">
                                                <a href="javascript:void(0)" class="sidebar-link">
                                                    <i class="ti ti-circle"></i>
                                                    <span class="hide-menu">Page 2.1</span>
                                                </a>
                                            </li>
                                            <li class="sidebar-item">
                                                <a href="javascript:void(0)" class="sidebar-link">
                                                    <i class="ti ti-circle"></i>
                                                    <span class="hide-menu">Page 2.2</span>
                                                </a>
                                            </li>
                                            <li class="sidebar-item">
                                                <a href="javascript:void(0)" class="sidebar-link">
                                                    <i class="ti ti-circle"></i>
                                                    <span class="hide-menu">Page 2.3</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="javascript:void(0)" class="sidebar-link">
                                            <i class="ti ti-circle"></i>
                                            <span class="hide-menu">Page 3</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- End Sidebar navigation -->
                </div>
                <!-- End Sidebar scroll-->
            </aside>

            @yield('dashboard')

            <script>
                function handleColorTheme(e) {
                    $("html").attr("data-color-theme", e);
                    $(e).prop("checked", !0);
                }
            </script>
            <button
                class="btn btn-primary p-3 rounded-circle d-flex align-items-center justify-content-center customizer-btn"
                type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                aria-controls="offcanvasExample">
                <i class="icon ti ti-settings fs-7 text-white"></i>
            </button>

            <div class="offcanvas customizer offcanvas-end" tabindex="-1" id="offcanvasExample"
                aria-labelledby="offcanvasExampleLabel">
                <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
                    <h4 class="offcanvas-title fw-semibold" id="offcanvasExampleLabel">
                        Settings
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body h-n80" data-simplebar="">
                    <h6 class="fw-semibold fs-4 mb-2">Theme</h6>

                    <div class="d-flex flex-row gap-3 customizer-box" role="group">
                        <input type="radio" class="btn-check light-layout " name="theme-layout"
                            id="light-layout" autocomplete="off">
                        <label class="btn p-9 btn-outline-primary rounded" for="light-layout"> <iconify-icon
                                icon="solar:sun-2-outline" class="icon fs-7 me-2"></iconify-icon>Light</label>
                        <input type="radio" class="btn-check dark-layout" name="theme-layout" id="dark-layout"
                            autocomplete="off">
                        <label class="btn p-9 btn-outline-primary rounded" for="dark-layout"><iconify-icon
                                icon="solar:moon-outline" class="icon fs-7 me-2"></iconify-icon>Dark</label>
                    </div>

                    <h6 class="mt-5 fw-semibold fs-4 mb-2">Theme Direction</h6>
                    <div class="d-flex flex-row gap-3 customizer-box" role="group">
                        <input type="radio" class="btn-check" name="direction-l" id="ltr-layout"
                            autocomplete="off">
                        <label class="btn p-9 btn-outline-primary rounded" for="ltr-layout"><iconify-icon
                                icon="solar:align-left-linear" class="icon fs-7 me-2"></iconify-icon>LTR</label>

                        <input type="radio" class="btn-check" name="direction-l" id="rtl-layout"
                            autocomplete="off">
                        <label class="btn p-9 btn-outline-primary rounded" for="rtl-layout">
                            <iconify-icon icon="solar:align-right-linear" class="icon fs-7 me-2"></iconify-icon>RTL
                        </label>
                    </div>

                    <h6 class="mt-5 fw-semibold fs-4 mb-2">Theme Colors</h6>

                    <div class="d-flex flex-row flex-wrap gap-3 customizer-box color-pallete" role="group">
                        <input type="radio" class="btn-check" name="color-theme-layout" id="Blue_Theme"
                            autocomplete="off">
                        <label
                            class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center rounded"
                            onclick="handleColorTheme('Blue_Theme')" for="Blue_Theme" data-bs-toggle="tooltip"
                            data-bs-placement="top" data-bs-title="BLUE_THEME">
                            <div
                                class="color-box rounded-circle d-flex align-items-center justify-content-center skin-1">
                                <i class="ti ti-check text-white d-flex icon fs-5"></i>
                            </div>
                        </label>

                        <input type="radio" class="btn-check" name="color-theme-layout" id="Aqua_Theme"
                            autocomplete="off">
                        <label
                            class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center rounded"
                            onclick="handleColorTheme('Aqua_Theme')" for="Aqua_Theme" data-bs-toggle="tooltip"
                            data-bs-placement="top" data-bs-title="AQUA_THEME">
                            <div
                                class="color-box rounded-circle d-flex align-items-center justify-content-center skin-2">
                                <i class="ti ti-check text-white d-flex icon fs-5"></i>
                            </div>
                        </label>

                        <input type="radio" class="btn-check" name="color-theme-layout" id="Purple_Theme"
                            autocomplete="off">
                        <label
                            class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center rounded"
                            onclick="handleColorTheme('Purple_Theme')" for="Purple_Theme" data-bs-toggle="tooltip"
                            data-bs-placement="top" data-bs-title="PURPLE_THEME">
                            <div
                                class="color-box rounded-circle d-flex align-items-center justify-content-center skin-3">
                                <i class="ti ti-check text-white d-flex icon fs-5"></i>
                            </div>
                        </label>

                        <input type="radio" class="btn-check" name="color-theme-layout"
                            id="green-theme-layout" autocomplete="off">
                        <label
                            class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center rounded"
                            onclick="handleColorTheme('Green_Theme')" for="green-theme-layout"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="GREEN_THEME">
                            <div
                                class="color-box rounded-circle d-flex align-items-center justify-content-center skin-4">
                                <i class="ti ti-check text-white d-flex icon fs-5"></i>
                            </div>
                        </label>

                        <input type="radio" class="btn-check" name="color-theme-layout" id="cyan-theme-layout"
                            autocomplete="off">
                        <label
                            class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center rounded"
                            onclick="handleColorTheme('Cyan_Theme')" for="cyan-theme-layout"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="CYAN_THEME">
                            <div
                                class="color-box rounded-circle d-flex align-items-center justify-content-center skin-5">
                                <i class="ti ti-check text-white d-flex icon fs-5"></i>
                            </div>
                        </label>

                        <input type="radio" class="btn-check" name="color-theme-layout"
                            id="orange-theme-layout" autocomplete="off">
                        <label
                            class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center rounded"
                            onclick="handleColorTheme('Orange_Theme')" for="orange-theme-layout"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="ORANGE_THEME">
                            <div
                                class="color-box rounded-circle d-flex align-items-center justify-content-center skin-6">
                                <i class="ti ti-check text-white d-flex icon fs-5"></i>
                            </div>
                        </label>
                    </div>

                    <h6 class="mt-5 fw-semibold fs-4 mb-2">Layout Type</h6>
                    <div class="d-flex flex-row gap-3 customizer-box" role="group">
                        <div>
                            <input type="radio" class="btn-check" name="page-layout" id="vertical-layout"
                                autocomplete="off">
                            <label class="btn p-9 btn-outline-primary rounded" for="vertical-layout">
                                <iconify-icon icon="solar:slider-vertical-minimalistic-linear"
                                    class="icon fs-7 me-2"></iconify-icon>Vertical
                            </label>
                        </div>
                        <div>
                            <input type="radio" class="btn-check" name="page-layout" id="horizontal-layout"
                                autocomplete="off">
                            <label class="btn p-9 btn-outline-primary rounded" for="horizontal-layout">
                                <iconify-icon icon="solar:slider-minimalistic-horizontal-outline"
                                    class="icon fs-7 me-2"></iconify-icon>
                                Horizontal
                            </label>
                        </div>
                    </div>

                    <h6 class="mt-5 fw-semibold fs-4 mb-2">Container Option</h6>

                    <div class="d-flex flex-row gap-3 customizer-box" role="group">
                        <input type="radio" class="btn-check" name="layout" id="boxed-layout"
                            autocomplete="off">
                        <label class="btn p-9 btn-outline-primary rounded" for="boxed-layout">
                            <iconify-icon icon="solar:cardholder-linear" class="icon fs-7 me-2"></iconify-icon>
                            Boxed
                        </label>

                        <input type="radio" class="btn-check" name="layout" id="full-layout"
                            autocomplete="off">
                        <label class="btn p-9 btn-outline-primary rounded" for="full-layout">
                            <iconify-icon icon="solar:scanner-linear" class="icon fs-7 me-2"></iconify-icon> Full
                        </label>
                    </div>

                    <h6 class="fw-semibold fs-4 mb-2 mt-5">Sidebar Type</h6>
                    <div class="d-flex flex-row gap-3 customizer-box" role="group">
                        <a href="javascript:void(0)" class="fullsidebar">
                            <input type="radio" class="btn-check" name="sidebar-type" id="full-sidebar"
                                autocomplete="off">
                            <label class="btn p-9 btn-outline-primary rounded" for="full-sidebar"><iconify-icon
                                    icon="solar:sidebar-minimalistic-outline" class="icon fs-7 me-2"></iconify-icon>
                                Full</label>
                        </a>
                        <div>
                            <input type="radio" class="btn-check " name="sidebar-type" id="mini-sidebar"
                                autocomplete="off">
                            <label class="btn p-9 btn-outline-primary rounded" for="mini-sidebar">
                                <iconify-icon icon="solar:siderbar-outline"
                                    class="icon fs-7 me-2"></iconify-icon>Collapse
                            </label>
                        </div>
                    </div>

                    <h6 class="mt-5 fw-semibold fs-4 mb-2">Card With</h6>

                    <div class="d-flex flex-row gap-3 customizer-box" role="group">
                        <input type="radio" class="btn-check" name="card-layout" id="card-with-border"
                            autocomplete="off">
                        <label class="btn p-9 btn-outline-primary rounded" for="card-with-border"><iconify-icon
                                icon="solar:library-broken" class="icon fs-7 me-2"></iconify-icon>Border</label>

                        <input type="radio" class="btn-check" name="card-layout" id="card-without-border"
                            autocomplete="off">
                        <label class="btn p-9 btn-outline-primary rounded" for="card-without-border">
                            <iconify-icon icon="solar:box-outline " class="icon fs-7 me-2"></iconify-icon>Shadow
                        </label>
                    </div>
                </div>
            </div>

            <script>
                function handleColorTheme(e) {
                    document.documentElement.setAttribute("data-color-theme", e);
                }
            </script>
        </div>

        <!--  Search Bar -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content rounded-1">
                    <div class="modal-header border-bottom">
                        <input type="search" class="form-control fs-2" placeholder="Search here"
                            id="search">
                        <a href="javascript:void(0)" data-bs-dismiss="modal" class="lh-1">
                            <i class="ti ti-x fs-5 ms-3"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="dark-transparent sidebartoggler"></div>

    <!-- Import Js Files -->
    {{-- <script src="{{ asset('dashboard_assets') }}/js/breadcrumb/breadcrumbChart.js"></script> --}}
    {{-- <script src="{{ asset('dashboard_assets') }}/libs/apexcharts/dist/apexcharts.min.js"></script> --}}
    <script src="{{ asset('dashboard_assets') }}/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('dashboard_assets') }}/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="{{ asset('dashboard_assets') }}/js/theme/app.init.js"></script>
    <script src="{{ asset('dashboard_assets') }}/js/theme/theme.js"></script>
    <script src="{{ asset('dashboard_assets') }}/js/theme/app.min.js"></script>
    <script src="{{ asset('dashboard_assets') }}/js/theme/sidebarmenu.js"></script>
    <script src="{{ asset('dashboard_assets') }}/js/theme/feather.min.js"></script>

    <!-- solar icons -->
    <script src="{{ asset('dashboard_assets') }}/npm/iconify-icon%401.0.8/dist/iconify-icon.min.js"></script>

    <!-- highlight.js (code view) -->
    <script src="{{ asset('dashboard_assets') }}/js/highlights/highlight.min.js"></script>
    <script>
        hljs.initHighlightingOnLoad();


        document.querySelectorAll("pre.code-view > code").forEach((codeBlock) => {
            codeBlock.textContent = codeBlock.innerHTML;
        });
    </script>
    {{-- <script src="{{ asset('dashboard_assets') }}/js/dashboards/dashboard1.js"></script> --}}

</body>

</html>
