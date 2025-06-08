@extends('layouts.newsDashboard.dashboardMaster')

@section('dashboard')
    <div class="body-wrapper">
        <div class="container-fluid">
            <div class="font-weight-medium shadow-none position-relative overflow-hidden mb-7">
                <div class="card-body px-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-medium  mb-0">User Profile</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="">Home
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">User Profile</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card overflow-hidden">
                <div class="card-body p-0">
                    <img src="{{ asset('dashboard_assets') }}/images/backgrounds/profilebg.jpg" alt="materialpro-img"
                        class="img-fluid">
                    <div class="row align-items-center">
                        <div class="col-lg-4 order-lg-1 order-2">

                            <div class="d-flex align-items-center justify-content-around m-4">
                                <div class="text-center">
                                    <i class="ti ti-file-description fs-6 d-block mb-2"></i>
                                    <h4 class="mb-0 fw-semibold lh-1">938</h4>
                                    <p class="mb-0 ">Posts</p>
                                </div>

                                <div class="text-center">
                                    <i class="ti ti-user-circle fs-6 d-block mb-2"></i>
                                    <h4 class="mb-0 fw-semibold lh-1">3,586</h4>
                                    <p class="mb-0 ">Followers</p>
                                </div>

                                <div class="text-center">
                                    <i class="ti ti-user-check fs-6 d-block mb-2"></i>
                                    <h4 class="mb-0 fw-semibold lh-1">2,659</h4>
                                    <p class="mb-0 ">Following</p>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4 mt-n3 order-lg-2 order-1">
                            <div class="mt-n5">
                                <div class="d-flex align-items-center justify-content-center mb-2">
                                    <div class="d-flex align-items-center justify-content-center round-110">
                                        <div
                                            class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden round-100">
                                            <img src="{{ asset('dashboard_assets') }}/images/profile/user-1.jpg"
                                                alt="materialpro-img" class="w-100 h-100">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                                    <p class="mb-0">{{ Auth::user()->role }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 order-last">
                            <ul
                                class="list-unstyled d-flex align-items-center justify-content-center justify-content-lg-end my-3 mx-4 pe-4 gap-3">
                                <li>
                                    <a class="d-flex align-items-center justify-content-center btn btn-primary p-2 fs-4 rounded-circle"
                                        href="javascript:void(0)" width="30" height="30">
                                        <i class="ti ti-brand-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="btn btn-secondary d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle"
                                        href="javascript:void(0)">
                                        <i class="ti ti-brand-dribbble"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="btn btn-danger d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle"
                                        href="javascript:void(0)">
                                        <i class="ti ti-brand-youtube"></i>
                                    </a>
                                </li>
                                <li>
                                    <button class="btn btn-primary text-nowrap">Add To Story</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <ul class="nav nav-pills user-profile-tab justify-content-end mt-2 bg-primary-subtle rounded-2 rounded-top-0"
                        id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active hstack gap-2 rounded-0 fs-12 py-6" id="pills-profile-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab"
                                aria-controls="pills-profile" aria-selected="true">
                                <i class="ti ti-user-circle fs-5"></i>
                                <span class="d-none d-md-block">Profile</span>
                            </button>
                        </li>

                        @if (Auth::user()->role == 'admin')
                            <li class="nav-item" role="presentation">
                                <button class="nav-link hstack gap-2 rounded-0 fs-12 py-6" id="pills-friends-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-friends" type="button" role="tab"
                                    aria-controls="pills-friends" aria-selected="false">
                                    <i class="ti ti-user-circle fs-5"></i>
                                    <span class="d-none d-md-block">Members</span>
                                </button>
                            </li>
                        @endif

                        <li class="nav-item" role="presentation">
                            <button class="nav-link hstack gap-2 rounded-0 fs-12 py-6" id="pills-news-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-news" type="button" role="tab"
                                aria-controls="pills-news" aria-selected="false">
                                <i class="ti ti-photo-plus fs-5"></i>
                                <span class="d-none d-md-block">News</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade show active" id="pills-profile" role="tabpanel"
                    aria-labelledby="pills-profile-tab" tabindex="0">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card shadow-none border">
                                <div class="card-body">
                                    <h4 class="mb-3">Introduction</h4>
                                    <p class="card-subtitle">Hello, I am Markarn Doe. I love making websites and graphics.
                                        Lorem
                                        ipsum dolor sit amet,
                                        consectetur adipiscing elit.</p>
                                    <div class="vstack gap-3 mt-4">
                                        <div class="hstack gap-6">
                                            <i class="ti ti-briefcase text-dark fs-6"></i>
                                            <h6 class=" mb-0">Sir, P P Institute Of Science</h6>
                                        </div>
                                        <div class="hstack gap-6">
                                            <i class="ti ti-mail text-dark fs-6"></i>
                                            <h6 class=" mb-0">markrarn@wrappixel.com</h6>
                                        </div>
                                        <div class="hstack gap-6">
                                            <i class="ti ti-device-desktop text-dark fs-6"></i>
                                            <h6 class=" mb-0">www.xyz.com</h6>
                                        </div>
                                        <div class="hstack gap-6">
                                            <i class="ti ti-map-pin text-dark fs-6"></i>
                                            <h6 class=" mb-0">Newyork, USA - 100001</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow-none border">
                                <div class="card-body">
                                    <h4 class="fw-semibold mb-3">Photos</h4>
                                    <div class="row">
                                        <div class="col-4">
                                            <img src="{{ asset('dashboard_assets') }}/images/profile/user-1.jpg"
                                                alt="materialpro-img" class="rounded-1 img-fluid mb-9">
                                        </div>
                                        <div class="col-4">
                                            <img src="{{ asset('dashboard_assets') }}/images/profile/user-2.jpg"
                                                alt="materialpro-img" class="rounded-1 img-fluid mb-9">
                                        </div>
                                        <div class="col-4">
                                            <img src="{{ asset('dashboard_assets') }}/images/profile/user-3.jpg"
                                                alt="materialpro-img" class="rounded-1 img-fluid mb-9">
                                        </div>
                                        <div class="col-4">
                                            <img src="{{ asset('dashboard_assets') }}/images/profile/user-4.jpg"
                                                alt="materialpro-img" class="rounded-1 img-fluid mb-9">
                                        </div>
                                        <div class="col-4">
                                            <img src="{{ asset('dashboard_assets') }}/images/profile/user-5.jpg"
                                                alt="materialpro-img" class="rounded-1 img-fluid mb-9">
                                        </div>
                                        <div class="col-4">
                                            <img src="{{ asset('dashboard_assets') }}/images/profile/user-6.jpg"
                                                alt="materialpro-img" class="rounded-1 img-fluid mb-9">
                                        </div>
                                        <div class="col-4">
                                            <img src="{{ asset('dashboard_assets') }}/images/profile/user-7.jpg"
                                                alt="materialpro-img" class="rounded-1 img-fluid mb-6">
                                        </div>
                                        <div class="col-4">
                                            <img src="{{ asset('dashboard_assets') }}/images/profile/user-8.jpg"
                                                alt="materialpro-img" class="rounded-1 img-fluid mb-6">
                                        </div>
                                        <div class="col-4">
                                            <img src="{{ asset('dashboard_assets') }}/images/profile/user-1.jpg"
                                                alt="materialpro-img" class="rounded-1 img-fluid mb-6">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card shadow-none border">
                                <div class="card-body">
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control h-140" placeholder="Leave a comment here" id="floatingTextarea2"></textarea>
                                        <label for="floatingTextarea2">Share your thoughts</label>
                                    </div>
                                    <div class="d-flex align-items-center gap-6 flex-wrap">
                                        <a class="d-flex align-items-center round-32 justify-content-center btn btn-primary rounded-circle p-0"
                                            href="javascript:void(0)">
                                            <i class="ti ti-photo"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="text-dark link-primary pe-3 py-2">Photo /
                                            Video</a>

                                        <a class="d-flex align-items-center round-32 justify-content-center btn btn-secondary rounded-circle p-0"
                                            href="javascript:void(0)">
                                            <i class="ti ti-notebook"></i>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="text-dark link-secondary pe-3 py-2">Article</a>


                                        <button class="btn btn-primary ms-auto">Post</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if (Auth::user()->role == 'admin')
                    <div class="tab-pane fade" id="pills-friends" role="tabpanel" aria-labelledby="pills-friends-tab"
                        tabindex="0">
                        <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
                            <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">Members <span
                                    class="badge text-bg-secondary fs-2 rounded-4 py-1 px-2 ms-2">20</span>
                            </h3>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-lg-4">
                                <div class="card hover-img">
                                    <div class="card-body p-4 text-center border-bottom">
                                        <img src="{{ asset('dashboard_assets') }}/images/profile/user-3.jpg"
                                            alt="materialpro-img" class="rounded-circle mb-3" width="80"
                                            height="80">
                                        <h5 class="fw-semibold mb-0">Betty Adams</h5>
                                        <span class="text-dark fs-2">Medical Secretary</span>
                                    </div>
                                    <ul
                                        class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                                        <li class="position-relative">
                                            <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold"
                                                href="javascript:void(0)">
                                                <i class="ti ti-brand-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="position-relative">
                                            <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                                                href="javascript:void(0)">
                                                <i class="ti ti-brand-instagram"></i>
                                            </a>
                                        </li>
                                        <li class="position-relative">
                                            <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                                                href="javascript:void(0)">
                                                <i class="ti ti-brand-github"></i>
                                            </a>
                                        </li>
                                        <li class="position-relative">
                                            <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                                                href="javascript:void(0)">
                                                <i class="ti ti-brand-twitter"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="tab-pane fade" id="pills-news" role="tabpanel" aria-labelledby="pills-news-tab"
                    tabindex="0">
                    <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
                        <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">News <span
                                class="badge text-bg-secondary fs-2 rounded-4 py-1 px-2 ms-2">12</span>
                        </h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="card hover-img overflow-hidden rounded-2">
                                <div class="card-body p-0">
                                    <img src="{{ asset('dashboard_assets') }}/images/products/s1.jpg"
                                        alt="materialpro-img" height="220" class="w-100 object-fit-cover">
                                    <div class="p-4 d-flex align-items-center justify-content-between">
                                        <div>
                                            <h6 class="mb-0">Isuava wakceajo fe.jpg</h6>
                                            <span class="text-dark fs-2">Wed, Dec 14, 2023</span>
                                        </div>
                                        <div class="dropdown">
                                            <a class="text-muted fw-semibold d-flex align-items-center p-1"
                                                href="javascript:void(0)" role="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu overflow-hidden">
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0)">Isuava wakceajo
                                                        fe.jpg</a>
                                                </li>
                                            </ul>
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
@endsection
