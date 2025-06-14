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
                                                @if (!Auth::user()->profile_picture)
                                                    <img src="{{ asset('dashboard_assets') }}/images/profile/user-1.jpg"
                                                        alt="materialpro-img" class="img-fluid rounded-circle"
                                                        width="120" height="120">
                                                @else
                                                    <img style="border-radius: 50%"
                                                        src="{{ asset('uploads/profile_pictures/' . Auth::user()->profile_picture) }}"
                                                        alt="{{ Auth::user()->name }}">
                                                @endif
                                                <div class="d-flex align-items-center justify-content-center my-4 gap-6">
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"> Upload Photo </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                        Profile Picture Update</h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>

                                                                {{-- For Profile Picture Upload --}}
                                                                <form method="POST" action="{{ route('photo.upload') }}"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="modal-body">

                                                                        <input class="form-control" type="file"
                                                                            name="photo" autocomplete="off">

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save
                                                                            changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <button class="btn bg-danger-subtle text-danger">Reset</button> --}}
                                                </div>
                                                <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                                @if (session('photo_upload'))
                                                    <div class=" alert alert-success mt-3 ">{{ session('photo_upload') }}
                                                    </div>
                                                @endif

                                                @error('photo')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex align-items-stretch">
                                    <div class="card w-100 border position-relative overflow-hidden">
                                        <div class="card-body p-4">
                                            <h4 class="card-title">Change Password</h4>
                                            <p class="card-subtitle mb-4">To change your password please confirm here</p>

                                            <form method="POST" action="{{ route('password.update') }}">

                                                @csrf
                                                @method('put')

                                                <div class="mb-3">
                                                    <label for="current_password" class="form-label">Current
                                                        Password</label>
                                                    <input class="form-control" id="update_password_current_password"
                                                        name="current_password" type="password" class="mt-1 block w-full"
                                                        autocomplete="current-password">

                                                    @error('current_password')
                                                        <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror

                                                </div>

                                                <div class="mb-3">
                                                    <label for="exampleInputPassword2" class="form-label">New
                                                        Password</label>
                                                    <input class="form-control" id="update_password_password"
                                                        name="password" type="password" class="mt-1 block w-full"
                                                        autocomplete="new-password">

                                                    @error('password')
                                                        <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror

                                                </div>

                                                <div>
                                                    <label for="exampleInputPassword3" class="form-label">Confirm
                                                        Password</label>
                                                    <input class="form-control" id="update_password_password_confirmation"
                                                        name="password_confirmation" type="password"
                                                        class="mt-1 block w-full" autocomplete="new-password">

                                                    @error('password_confirmation')
                                                        <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror

                                                </div>

                                                <button type="submit" class="btn btn-primary mt-4">Change
                                                    Password</button>


                                                @if (session('statuss'))
                                                    <div class=" alert alert-success mt-3 ">{{ session('statuss') }}</div>
                                                @endif

                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card w-100 border position-relative overflow-hidden mb-0">
                                        <div class="card-body p-4">
                                            <h4 class="card-title">Personal Details</h4>
                                            <p class="card-subtitle mb-4">To change your personal detail , edit and save
                                                from here</p>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <form method="POST" action="{{ route('profile.update') }}">
                                                        @csrf
                                                        @method('patch')

                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Your Name</label>
                                                            <input class="form-control" id="name" name="name"
                                                                type="text" class="mt-1 block w-full"
                                                                value="{{ old('name', $user->name) }}" required
                                                                autocomplete="name">
                                                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                                        </div>
                                                        <div>
                                                            <x-input-label for="email" :value="__('Email')" />
                                                            <input class="form-control" id="email" name="email"
                                                                type="email" class="mt-1 block w-full"
                                                                value="{{ old('email', $user->email) }}" required
                                                                autocomplete="username" />
                                                            <x-input-error class="mt-2" :messages="$errors->get('email')" />

                                                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                                                <div>
                                                                    <p
                                                                        class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                                                        {{ __('Your email address is unverified.') }}

                                                                        <button form="send-verification"
                                                                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                                                            {{ __('Click here to re-send the verification email.') }}
                                                                        </button>
                                                                    </p>

                                                                    @if (session('status') === 'verification-link-sent')
                                                                        <p
                                                                            class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                                                            {{ __('A new verification link has been sent to your email address.') }}
                                                                        </p>
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <button class="btn btn-primary mt-3">Save</button>
                                                        {{-- <button class="btn bg-danger-subtle text-danger ms-2">Cancel</button> --}}

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
                                                <p class="card-subtitle mb-4">Status : <span
                                                        class="badge bg-danger text-sm text-white">No Number Added</span>
                                                </p>
                                            @elseif(Auth::user()->phone_number && Auth::user()->phone_verify == 0)
                                                <p class="card-subtitle mb-4">Status : <span
                                                        class="badge bg-danger text-sm text-white">Not Verify</span> </p>
                                            @else
                                                <p class="card-subtitle mb-4">Status : <span
                                                        class="badge bg-success text-sm text-white">Verify</span> </p>
                                            @endif
                                            <div class="row">
                                                <div class="col-12">

                                                    @if (!Auth::user()->phone_number)
                                                        <form method="POST" action="{{ route('phone.add') }}">

                                                            @csrf

                                                            <div class="mb-3">

                                                                <label for="phone_number" class="form-label">Phone
                                                                    number</label>
                                                                <input id="phone_number" type="number"
                                                                    class="form-control no-spinners" name="phone_number">


                                                                @error('phone_number')
                                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                                @enderror

                                                            </div>

                                                            <div>
                                                                <button class="btn btn-primary">Add Number</button>
                                                                {{-- <button class="btn bg-danger-subtle text-danger ms-2">Cancel</button> --}}
                                                            </div>

                                                            @if (session('phone_add'))
                                                                <div class=" alert alert-success mt-3 ">
                                                                    {{ session('phone_add') }}</div>
                                                            @endif

                                                        </form>
                                                    @elseif(Auth::user()->phone_number && Auth::user()->phone_verify == 0)
                                                        @if (Auth::user()->otp_send == 0)
                                                            <form method="POST" action="{{ route('otp.send') }}">

                                                                @csrf

                                                                <div class="mb-3">

                                                                    {{-- <label for="phone_number" class="form-label">Verify Phone Number</label> --}}
                                                                    {{-- <input id="phone_number" type="number" class="form-control no-spinners" value="0"> --}}

                                                                    <p>Your Phone Number : {{ Auth::user()->phone_number }}
                                                                    </p>

                                                                </div>

                                                                <div>
                                                                    <button class="btn btn-primary">Want's To
                                                                        Verify</button>
                                                                    {{-- <button class="btn bg-danger-subtle text-danger ms-2">Cancel</button> --}}
                                                                </div>

                                                                @if (session('otp_send'))
                                                                    <div class=" alert alert-success mt-3 ">
                                                                        {{ session('otp_send') }}</div>
                                                                @endif
                                                            </form>
                                                        @else
                                                            <form method="POST" action="{{ route('verify.number') }}">

                                                                @csrf

                                                                <div class="mb-3">

                                                                    <label for="otp" class="form-label">Enter
                                                                        OTP</label>
                                                                    <input id="otp" type="number"
                                                                        class="form-control" name="otp">

                                                                    @if (session('wrong_otp'))
                                                                        <div class=" alert alert-danger mt-3 ">
                                                                            {{ session('wrong_otp') }}</div>
                                                                    @endif


                                                                    <div class="mt-3">
                                                                        <button class="btn btn-primary">Verify
                                                                            Number</button>
                                                                        {{-- <button class="btn bg-danger-subtle text-danger ms-2">Cancel</button> --}}
                                                                    </div>

                                                                    @error('otp')
                                                                        <p class="text-danger mt-2">{{ $message }}</p>
                                                                    @enderror

                                                                </div>

                                                            </form>
                                                        @endif
                                                    @else
                                                        <form method="POST" action="{{ route('update.number') }}">

                                                            @csrf

                                                            <div class="mb-3">
                                                                <p>Number : {{ Auth::user()->phone_number }}</p>
                                                            </div>

                                                            @if (Auth::user()->phone_update == 0)
                                                                <div>
                                                                    <button class="btn btn-primary">Update Phone
                                                                        Number</button>
                                                                    {{-- <button class="btn bg-danger-subtle text-danger ms-2">Cancel</button> --}}
                                                                </div>
                                                            @else
                                                                <div>
                                                                    <button class="btn btn-primary disabled">Update
                                                                        Request Pending</button>
                                                                    {{-- <button class="btn bg-danger-subtle text-danger ms-2">Cancel</button> --}}
                                                                </div>
                                                            @endif

                                                            @if (session('verify_number'))
                                                                <div class=" alert alert-success mt-3 ">
                                                                    {{ session('verify_number') }}</div>
                                                            @endif

                                                            @if (session('update_request'))
                                                                <div class=" alert alert-success mt-3 ">
                                                                    {{ session('update_request') }}</div>
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
