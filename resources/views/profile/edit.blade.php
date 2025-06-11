@extends('layouts.newsDashboard.dashboard')

@section('dashboard')
    <div class="body-wrapper">
        <div class="container-fluid">
            <div class="font-weight-medium shadow-none position-relative overflow-hidden mb-7">
                <div class="card-body px-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-medium  mb-0">Account Setting</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="">Home
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">Account Setting</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-3"
                            id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button"
                            role="tab" aria-controls="pills-account" aria-selected="true">
                            <i class="ti ti-user-circle me-2 fs-6"></i>
                            <span class="d-none d-md-block">Account</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-3"
                            id="pills-security-tab" data-bs-toggle="pill" data-bs-target="#pills-security" type="button"
                            role="tab" aria-controls="pills-security" aria-selected="false">
                            <i class="ti ti-lock me-2 fs-6"></i>
                            <span class="d-none d-md-block">Security</span>
                        </button>
                    </li>
                </ul>
                <div class="card-body">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-account" role="tabpanel"
                            aria-labelledby="pills-account-tab" tabindex="0">
                            <div class="row">
                                <div class="col-lg-6 d-flex align-items-stretch">
                                    <div class="card w-100 border position-relative overflow-hidden">
                                        <div class="card-body p-4">
                                            <h4 class="card-title">Change Profile</h4>
                                            <p class="card-subtitle mb-4">Change your profile picture from here</p>
                                            <div class="text-center">
                                                <img src="{{ asset('dashboard_assets') }}/images/profile/user-1.jpg"
                                                    alt="materialpro-img" class="img-fluid rounded-circle" width="120"
                                                    height="120">
                                                <div class="d-flex align-items-center justify-content-center my-4 gap-6">
                                                    <button class="btn btn-primary">Upload</button>
                                                    <button class="btn bg-danger-subtle text-danger">Reset</button>
                                                </div>
                                                <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex align-items-stretch">
                                    <div class="card w-100 border position-relative overflow-hidden">
                                        <div class="card-body p-4">
                                            <h4 class="card-title">Change Password</h4>
                                            <p class="card-subtitle mb-4">To change your password please confirm here</p>
                                            <form>
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1" class="form-label">Current Password</label>
                                                    <input type="password" class="form-control" id="exampleInputPassword1">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword2" class="form-label">New Password</label>
                                                    <input type="password" class="form-control" id="exampleInputPassword2">
                                                </div>
                                                <div>
                                                    <label for="exampleInputPassword3" class="form-label">Confirm Password</label>
                                                    <input type="password" class="form-control" id="exampleInputPassword3">
                                                </div>

                                                <button type="submit" class="btn btn-primary mt-4">Change Password</button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card w-100 border position-relative overflow-hidden mb-0">
                                        <div class="card-body p-4">
                                            <h4 class="card-title">Personal Details</h4>
                                            <p class="card-subtitle mb-4">To change your personal detail , edit and save from here</p>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <form action="">
                                                        <div class="mb-3">
                                                                <label for="exampleInputtext" class="form-label">Your Name</label>
                                                                <input type="text" class="form-control" id="exampleInputtext" placeholder="Mathew Anderson">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleInputtext1" class="form-label">Email</label>
                                                                <input type="email" class="form-control" id="exampleInputtext1" placeholder="info@modernize.com">
                                                            </div>

                                                            <button class="btn btn-primary">Save</button>
                                                            <button class="btn bg-danger-subtle text-danger ms-2">Cancel</button>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card w-100 border position-relative overflow-hidden mb-0">
                                        <div class="card-body p-4">
                                            <h4 class="card-title">Phone</h4>
                                            @if (!Auth::user()->phone_number)
                                                <p class="card-subtitle mb-4">Status : <span class="badge bg-danger text-sm text-white">No Number Added</span> </p>
                                            @elseif(Auth::user()->phone_number && Auth::user()->phone_verify  == 0)
                                                <p class="card-subtitle mb-4">Status : <span class="badge bg-danger text-sm text-white">Not Verify</span> </p>
                                            @else
                                                <p class="card-subtitle mb-4">Status : <span class="badge bg-success text-sm text-white">Verify</span> </p>
                                            @endif
                                            <div class="row">
                                                <div class="col-12">

                                                    @if (!Auth::user()->phone_number)
                                                        <form method="POST" action="{{ route('phone.add') }}">

                                                            @csrf

                                                            <div class="mb-3">

                                                                <label for="phone_number" class="form-label">Phone number</label>
                                                                <input id="phone_number" type="number" class="form-control no-spinners" name="phone_number">


                                                                @error('phone_number')
                                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                                @enderror

                                                            </div>

                                                            <div>
                                                                <button class="btn btn-primary">Add Number</button>
                                                                {{-- <button class="btn bg-danger-subtle text-danger ms-2">Cancel</button> --}}
                                                            </div>

                                                            @if (session('phone_add'))
                                                                <div class=" alert alert-success mt-3 ">{{ session('phone_add') }}</div>
                                                            @endif

                                                        </form>

                                                    @elseif(Auth::user()->phone_number && Auth::user()->phone_verify  == 0)

                                                        @if (Auth::user()->otp_send == 0)

                                                            <form method="POST" action="{{ route('otp.send') }}">

                                                                @csrf

                                                                <div class="mb-3">

                                                                    {{-- <label for="phone_number" class="form-label">Verify Phone Number</label> --}}
                                                                    {{-- <input id="phone_number" type="number" class="form-control no-spinners" value="0"> --}}

                                                                    <p>Your Phone Number : {{ Auth::user()->phone_number }}</p>

                                                                </div>

                                                                <div>
                                                                    <button class="btn btn-primary">Want's To Verify</button>
                                                                    {{-- <button class="btn bg-danger-subtle text-danger ms-2">Cancel</button> --}}
                                                                </div>

                                                                @if (session('otp_send'))
                                                                    <div class=" alert alert-success mt-3 ">{{ session('otp_send') }}</div>
                                                                @endif
                                                            </form>

                                                        @else

                                                            <form method="POST" action="{{ route('verify.number') }}">

                                                                @csrf

                                                                <div class="mb-3">

                                                                    <label for="otp" class="form-label">Enter OTP</label>
                                                                    <input id="otp" type="number" class="form-control" name="otp">

                                                                        @if (session('wrong_otp'))
                                                                            <div class=" alert alert-danger mt-3 ">{{ session('wrong_otp') }}</div>
                                                                        @endif


                                                                    <div class="mt-3">
                                                                        <button class="btn btn-primary">Verify Number</button>
                                                                        {{-- <button class="btn bg-danger-subtle text-danger ms-2">Cancel</button> --}}
                                                                    </div>

                                                                        @error('otp')
                                                                            <p class="text-danger mt-2">{{ $message }}</p>
                                                                        @enderror

                                                                </div>

                                                            </form>

                                                        @endif

                                                    @else

                                                        <form method="POST" action="">

                                                            <div class="mb-3">
                                                                <p>Number : {{ Auth::user()->phone_number }}</p>
                                                            </div>

                                                            <div>
                                                                <button class="btn btn-primary">Update Phone Number</button>
                                                                {{-- <button class="btn bg-danger-subtle text-danger ms-2">Cancel</button> --}}
                                                            </div>

                                                            @if (session('verify_number'))
                                                                <div class=" alert alert-success mt-3 ">{{ session('verify_number') }}</div>
                                                            @endif

                                                        </form>

                                                    @endif


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-security" role="tabpanel"
                            aria-labelledby="pills-security-tab" tabindex="0">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="card border shadow-none">
                                        <div class="card-body p-4">
                                            <h4 class="card-title mb-3">Two-factor Authentication</h4>
                                            <div class="d-flex align-items-center justify-content-between pb-7">
                                                <p class="card-subtitle mb-0">Lorem ipsum, dolor sit amet consectetur
                                                    adipisicing elit. Corporis sapiente
                                                    sunt earum officiis laboriosam ut.</p>
                                                <button class="btn btn-primary">Enable</button>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between py-3 border-top">
                                                <div>
                                                    <h5 class="fs-4 fw-semibold mb-0">Authentication App</h5>
                                                    <p class="mb-0">Google auth app</p>
                                                </div>
                                                <button class="btn bg-primary-subtle text-primary">Setup</button>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between py-3 border-top">
                                                <div>
                                                    <h5 class="fs-4 fw-semibold mb-0">Another e-mail</h5>
                                                    <p class="mb-0">E-mail to send verification link</p>
                                                </div>
                                                <button class="btn bg-primary-subtle text-primary">Setup</button>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between py-3 border-top">
                                                <div>
                                                    <h5 class="fs-4 fw-semibold mb-0">SMS Recovery</h5>
                                                    <p class="mb-0">Your phone number or something</p>
                                                </div>
                                                <button class="btn bg-primary-subtle text-primary">Setup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-body p-4">
                                            <div
                                                class="text-bg-light rounded-1 p-6 d-inline-flex align-items-center justify-content-center mb-3">
                                                <i class="ti ti-device-laptop text-primary d-block fs-7" width="22"
                                                    height="22"></i>
                                            </div>
                                            <h4 class="card-title mb-0">Devices</h4>
                                            <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit Rem.
                                            </p>
                                            <button class="btn btn-primary mb-4">Sign out from all devices</button>
                                            <div
                                                class="d-flex align-items-center justify-content-between py-3 border-bottom">
                                                <div class="d-flex align-items-center gap-3">
                                                    <i class="ti ti-device-mobile text-dark d-block fs-7" width="26"
                                                        height="26"></i>
                                                    <div>
                                                        <h5 class="fs-4 fw-semibold mb-0">iPhone 14</h5>
                                                        <p class="mb-0">London UK, Oct 23 at 1:15 AM</p>
                                                    </div>
                                                </div>
                                                <a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle"
                                                    href="javascript:void(0)">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between py-3">
                                                <div class="d-flex align-items-center gap-3">
                                                    <i class="ti ti-device-laptop text-dark d-block fs-7" width="26"
                                                        height="26"></i>
                                                    <div>
                                                        <h5 class="fs-4 fw-semibold mb-0">Macbook Air</h5>
                                                        <p class="mb-0">Gujarat India, Oct 24 at 3:15 AM</p>
                                                    </div>
                                                </div>
                                                <a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle"
                                                    href="javascript:void(0)">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                            </div>
                                            <button class="btn bg-primary-subtle text-primary w-100 py-1">Need Help
                                                ?</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center justify-content-end gap-6">
                                        <button class="btn btn-primary">Save</button>
                                        <button class="btn bg-danger-subtle text-danger">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function handleColorTheme(e) {
            $("html").attr("data-color-theme", e);
            $(e).prop("checked", !0);
        }
    </script>
    <button class="btn btn-primary p-3 rounded-circle d-flex align-items-center justify-content-center customizer-btn"
        type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        <i class="icon ti ti-settings fs-7 text-white"></i>
    </button>

    <div class="offcanvas customizer offcanvas-end" tabindex="-1" id="offcanvasExample"
        aria-labelledby="offcanvasExampleLabel">
        <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
            <h4 class="offcanvas-title fw-semibold" id="offcanvasExampleLabel">
                Settings
            </h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body h-n80" data-simplebar>
            <h6 class="fw-semibold fs-4 mb-2">Theme</h6>

            <div class="d-flex flex-row gap-3 customizer-box" role="group">
                <input type="radio" class="btn-check light-layout " name="theme-layout" id="light-layout"
                    autocomplete="off" />
                <label class="btn p-9 btn-outline-primary rounded" for="light-layout"> <iconify-icon
                        icon="solar:sun-2-outline" class="icon fs-7 me-2"></iconify-icon>Light</label>
                <input type="radio" class="btn-check dark-layout" name="theme-layout" id="dark-layout"
                    autocomplete="off" />
                <label class="btn p-9 btn-outline-primary rounded" for="dark-layout"><iconify-icon
                        icon="solar:moon-outline" class="icon fs-7 me-2"></iconify-icon>Dark</label>
            </div>

            <h6 class="mt-5 fw-semibold fs-4 mb-2">Theme Direction</h6>
            <div class="d-flex flex-row gap-3 customizer-box" role="group">
                <input type="radio" class="btn-check" name="direction-l" id="ltr-layout" autocomplete="off" />
                <label class="btn p-9 btn-outline-primary rounded" for="ltr-layout"><iconify-icon
                        icon="solar:align-left-linear" class="icon fs-7 me-2"></iconify-icon>LTR</label>

                <input type="radio" class="btn-check" name="direction-l" id="rtl-layout" autocomplete="off" />
                <label class="btn p-9 btn-outline-primary rounded" for="rtl-layout">
                    <iconify-icon icon="solar:align-right-linear" class="icon fs-7 me-2"></iconify-icon>RTL
                </label>
            </div>

            <h6 class="mt-5 fw-semibold fs-4 mb-2">Theme Colors</h6>

            <div class="d-flex flex-row flex-wrap gap-3 customizer-box color-pallete" role="group">
                <input type="radio" class="btn-check" name="color-theme-layout" id="Blue_Theme" autocomplete="off" />
                <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center rounded"
                    onclick="handleColorTheme('Blue_Theme')" for="Blue_Theme" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-title="BLUE_THEME">
                    <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-1">
                        <i class="ti ti-check text-white d-flex icon fs-5"></i>
                    </div>
                </label>

                <input type="radio" class="btn-check" name="color-theme-layout" id="Aqua_Theme" autocomplete="off" />
                <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center rounded"
                    onclick="handleColorTheme('Aqua_Theme')" for="Aqua_Theme" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-title="AQUA_THEME">
                    <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-2">
                        <i class="ti ti-check text-white d-flex icon fs-5"></i>
                    </div>
                </label>

                <input type="radio" class="btn-check" name="color-theme-layout" id="Purple_Theme"
                    autocomplete="off" />
                <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center rounded"
                    onclick="handleColorTheme('Purple_Theme')" for="Purple_Theme" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-title="PURPLE_THEME">
                    <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-3">
                        <i class="ti ti-check text-white d-flex icon fs-5"></i>
                    </div>
                </label>

                <input type="radio" class="btn-check" name="color-theme-layout" id="green-theme-layout"
                    autocomplete="off" />
                <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center rounded"
                    onclick="handleColorTheme('Green_Theme')" for="green-theme-layout" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-title="GREEN_THEME">
                    <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-4">
                        <i class="ti ti-check text-white d-flex icon fs-5"></i>
                    </div>
                </label>

                <input type="radio" class="btn-check" name="color-theme-layout" id="cyan-theme-layout"
                    autocomplete="off" />
                <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center rounded"
                    onclick="handleColorTheme('Cyan_Theme')" for="cyan-theme-layout" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-title="CYAN_THEME">
                    <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-5">
                        <i class="ti ti-check text-white d-flex icon fs-5"></i>
                    </div>
                </label>

                <input type="radio" class="btn-check" name="color-theme-layout" id="orange-theme-layout"
                    autocomplete="off" />
                <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center rounded"
                    onclick="handleColorTheme('Orange_Theme')" for="orange-theme-layout" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-title="ORANGE_THEME">
                    <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-6">
                        <i class="ti ti-check text-white d-flex icon fs-5"></i>
                    </div>
                </label>
            </div>

            <h6 class="mt-5 fw-semibold fs-4 mb-2">Layout Type</h6>
            <div class="d-flex flex-row gap-3 customizer-box" role="group">
                <div>
                    <input type="radio" class="btn-check" name="page-layout" id="vertical-layout"
                        autocomplete="off" />
                    <label class="btn p-9 btn-outline-primary rounded" for="vertical-layout">
                        <iconify-icon icon="solar:slider-vertical-minimalistic-linear"
                            class="icon fs-7 me-2"></iconify-icon>Vertical
                    </label>
                </div>
                <div>
                    <input type="radio" class="btn-check" name="page-layout" id="horizontal-layout"
                        autocomplete="off" />
                    <label class="btn p-9 btn-outline-primary rounded" for="horizontal-layout">
                        <iconify-icon icon="solar:slider-minimalistic-horizontal-outline"
                            class="icon fs-7 me-2"></iconify-icon>
                        Horizontal
                    </label>
                </div>
            </div>

            <h6 class="mt-5 fw-semibold fs-4 mb-2">Container Option</h6>

            <div class="d-flex flex-row gap-3 customizer-box" role="group">
                <input type="radio" class="btn-check" name="layout" id="boxed-layout" autocomplete="off" />
                <label class="btn p-9 btn-outline-primary rounded" for="boxed-layout">
                    <iconify-icon icon="solar:cardholder-linear" class="icon fs-7 me-2"></iconify-icon>
                    Boxed
                </label>

                <input type="radio" class="btn-check" name="layout" id="full-layout" autocomplete="off" />
                <label class="btn p-9 btn-outline-primary rounded" for="full-layout">
                    <iconify-icon icon="solar:scanner-linear" class="icon fs-7 me-2"></iconify-icon> Full
                </label>
            </div>

            <h6 class="fw-semibold fs-4 mb-2 mt-5">Sidebar Type</h6>
            <div class="d-flex flex-row gap-3 customizer-box" role="group">
                <a href="javascript:void(0)" class="fullsidebar">
                    <input type="radio" class="btn-check" name="sidebar-type" id="full-sidebar" autocomplete="off" />
                    <label class="btn p-9 btn-outline-primary rounded" for="full-sidebar"><iconify-icon
                            icon="solar:sidebar-minimalistic-outline" class="icon fs-7 me-2"></iconify-icon> Full</label>
                </a>
                <div>
                    <input type="radio" class="btn-check " name="sidebar-type" id="mini-sidebar"
                        autocomplete="off" />
                    <label class="btn p-9 btn-outline-primary rounded" for="mini-sidebar">
                        <iconify-icon icon="solar:siderbar-outline" class="icon fs-7 me-2"></iconify-icon>Collapse
                    </label>
                </div>
            </div>

            <h6 class="mt-5 fw-semibold fs-4 mb-2">Card With</h6>

            <div class="d-flex flex-row gap-3 customizer-box" role="group">
                <input type="radio" class="btn-check" name="card-layout" id="card-with-border" autocomplete="off" />
                <label class="btn p-9 btn-outline-primary rounded" for="card-with-border"><iconify-icon
                        icon="solar:library-broken" class="icon fs-7 me-2"></iconify-icon>Border</label>

                <input type="radio" class="btn-check" name="card-layout" id="card-without-border"
                    autocomplete="off" />
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
                    <input type="search" class="form-control fs-2" placeholder="Search here" id="search" />
                    <a href="javascript:void(0)" data-bs-dismiss="modal" class="lh-1">
                        <i class="ti ti-x fs-5 ms-3"></i>
                    </a>
                </div>
                <div class="modal-body message-body" data-simplebar="">
                    <h5 class="mb-0 fs-5 p-1">Quick Page Links</h5>
                    <ul class="list mb-0 py-2">
                        <li class="p-1 mb-1 px-2 rounded bg-hover-light-black">
                            <a href="javascript:void(0)">
                                <span class="h6 mb-1">Modern</span>
                                <span class="fs-2 text-muted d-block">/dashboards/dashboard1</span>
                            </a>
                        </li>
                        <li class="p-1 mb-1 px-2 rounded bg-hover-light-black">
                            <a href="javascript:void(0)">
                                <span class="h6 mb-1">Dashboard</span>
                                <span class="fs-2 text-muted d-block">/dashboards/dashboard2</span>
                            </a>
                        </li>
                        <li class="p-1 mb-1 px-2 rounded bg-hover-light-black">
                            <a href="javascript:void(0)">
                                <span class="h6 mb-1">Contacts</span>
                                <span class="fs-2 text-muted d-block">/apps/contacts</span>
                            </a>
                        </li>
                        <li class="p-1 mb-1 px-2 rounded bg-hover-light-black">
                            <a href="javascript:void(0)">
                                <span class="h6 mb-1">Posts</span>
                                <span class="fs-2 text-muted d-block">/apps/blog/posts</span>
                            </a>
                        </li>
                        <li class="p-1 mb-1 px-2 rounded bg-hover-light-black">
                            <a href="javascript:void(0)">
                                <span class="h6 mb-1">Detail</span>
                                <span
                                    class="fs-2 text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
                            </a>
                        </li>
                        <li class="p-1 mb-1 px-2 rounded bg-hover-light-black">
                            <a href="javascript:void(0)">
                                <span class="h6 mb-1">Shop</span>
                                <span class="fs-2 text-muted d-block">/apps/ecommerce/shop</span>
                            </a>
                        </li>
                        <li class="p-1 mb-1 px-2 rounded bg-hover-light-black">
                            <a href="javascript:void(0)">
                                <span class="h6 mb-1">Modern</span>
                                <span class="fs-2 text-muted d-block">/dashboards/dashboard1</span>
                            </a>
                        </li>
                        <li class="p-1 mb-1 px-2 rounded bg-hover-light-black">
                            <a href="javascript:void(0)">
                                <span class="h6 mb-1">Dashboard</span>
                                <span class="fs-2 text-muted d-block">/dashboards/dashboard2</span>
                            </a>
                        </li>
                        <li class="p-1 mb-1 px-2 rounded bg-hover-light-black">
                            <a href="javascript:void(0)">
                                <span class="h6 mb-1">Contacts</span>
                                <span class="fs-2 text-muted d-block">/apps/contacts</span>
                            </a>
                        </li>
                        <li class="p-1 mb-1 px-2 rounded bg-hover-light-black">
                            <a href="javascript:void(0)">
                                <span class="h6 mb-1">Posts</span>
                                <span class="fs-2 text-muted d-block">/apps/blog/posts</span>
                            </a>
                        </li>
                        <li class="p-1 mb-1 px-2 rounded bg-hover-light-black">
                            <a href="javascript:void(0)">
                                <span class="h6 mb-1">Detail</span>
                                <span
                                    class="fs-2 text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
                            </a>
                        </li>
                        <li class="p-1 mb-1 px-2 rounded bg-hover-light-black">
                            <a href="javascript:void(0)">
                                <span class="h6 mb-1">Shop</span>
                                <span class="fs-2 text-muted d-block">/apps/ecommerce/shop</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    </div>
    <div class="dark-transparent sidebartoggler"></div>
@endsection
