@extends('layouts.newsDashboard.dashboardMaster')

@section('dashboard')
    <div class="body-wrapper">
        <div class="container-fluid">
            <!-- -------------------------------------------------------------- -->
            <!-- Breadcrumb -->
            <!-- -------------------------------------------------------------- -->
            <div class="font-weight-medium shadow-none position-relative overflow-hidden mb-7">
                <div class="card-body px-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-medium  mb-0">Dashboard</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="">Home
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">dashboard</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- -------------------------------------------------------------- -->
            <!-- Breadcrumb End -->
            <!-- -------------------------------------------------------------- -->
            <!-- Row -->
            <div class="row">

                <!-- Total Ads Count -->
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('ads.index') }}" style="text-decoration: none;">
                        <div class="card" style="border-radius:12px; padding:20px; background-color:#fff;">
                            <div class="d-flex align-items-center gap-4">

                                <!-- Icon Circle -->
                                <div class="d-flex align-items-center justify-content-center rounded-circle text-white bg-primary"
                                    style="width:50px; height:50px; font-size:22px;">
                                    <i class="fa-solid fa-rectangle-ad"></i>
                                </div>

                                <!-- Text & Numbers -->
                                <div>
                                    <span class="text-muted" style="font-size:14px; letter-spacing:0.5px;">Ads</span>

                                    <div class="d-flex gap-3 align-items-baseline" style="margin-top:5px;">
                                        <!-- Total Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#17a2b8;">
                                            {{ $ads->count() }}
                                        </h3>
                                        <span class="text-muted" style="font-size:14px;">Total</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>

                {{-- Total Headline Count --}}
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('breaking_news.index') }}" style="text-decoration: none;">
                        <div class="card" style="border-radius:12px; padding:20px; background-color:#fff;">
                            <div class="d-flex align-items-center gap-4">

                                <!-- Icon Circle -->
                                <div class="d-flex align-items-center justify-content-center rounded-circle text-white bg-info"
                                    style="width:50px; height:50px; font-size:22px;">
                                    <i class="fa-solid fa-heading"></i>
                                </div>

                                <!-- Text & Numbers -->
                                <div>
                                    <span class="text-muted" style="font-size:14px; letter-spacing:0.5px;">Headlines</span>

                                    <div class="d-flex gap-3 align-items-baseline" style="margin-top:5px;">
                                        <!-- Total Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#17a2b8;">
                                            {{ $headlines->count() }}
                                        </h3>
                                        <span class="text-muted" style="font-size:14px;">Total</span>

                                        <!-- Active Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#28a745;">
                                            {{ $headlines_active->count() }}
                                        </h3>
                                        <span class="text-muted" style="font-size:14px;">Active</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>

                {{-- Total News Count --}}
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('dashboard_news.index') }}" style="text-decoration: none;">
                        <div class="card" style="border-radius:12px; padding:20px; background-color:#fff;">
                            <div class="d-flex align-items-center gap-4">

                                <!-- Icon Circle -->
                                <div class="d-flex align-items-center justify-content-center rounded-circle text-white bg-info"
                                    style="width:50px; height:50px; font-size:22px;">
                                    <i class="fa-solid fa-newspaper"></i>
                                </div>

                                <!-- Text & Numbers -->
                                <div>
                                    <span class="text-muted" style="font-size:14px; letter-spacing:0.5px;">News</span>

                                    <div class="d-flex gap-3 align-items-baseline" style="margin-top:5px;">
                                        <!-- Total Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#17a2b8;">
                                            {{ $news->count() }}
                                        </h3>
                                        <span class="text-muted" style="font-size:14px;">Total</span>

                                        <!-- Active Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#28a745;">
                                            {{ $news_active->count() }}
                                        </h3>
                                        <span class="text-muted" style="font-size:14px;">Active</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>


                {{-- Total Categories Count --}}
                <div class="col-lg-6 col-md-6">
                    <a href="{{ route('categories.index') }}" style="text-decoration: none;">
                        <div class="card" style="border-radius:12px; padding:20px; background-color:#fff;">
                            <div class="d-flex align-items-center gap-4">

                                <!-- Icon Circle -->
                                <div class="d-flex align-items-center justify-content-center rounded-circle text-white bg-info"
                                    style="width:50px; height:50px; font-size:22px;">
                                    <i class="fa-solid fa-layer-group"></i>
                                </div>

                                <!-- Text & Numbers -->
                                <div>
                                    <span class="text-muted" style="font-size:14px; letter-spacing:0.5px;">Categories</span>

                                    <div class="d-flex gap-3 align-items-baseline" style="margin-top:5px;">
                                        <!-- Total Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#17a2b8;">
                                            {{ $categories->count() }}
                                        </h3>
                                        <span class="text-muted" style="font-size:14px;">Total</span>

                                        <!-- Active Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#28a745;">
                                            {{ $categories_active->count() }}
                                        </h3>
                                        <span class="text-muted" style="font-size:14px;">Active</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>

                {{-- Total SubCategories Count --}}
                <div class="col-lg-6 col-md-6">
                    <a href="{{ route('sub_categories.index') }}" style="text-decoration: none;">
                        <div class="card" style="border-radius:12px; padding:20px; background-color:#fff;">
                            <div class="d-flex align-items-center gap-4">

                                <!-- Icon Circle -->
                                <div class="d-flex align-items-center justify-content-center rounded-circle text-white bg-info"
                                    style="width:50px; height:50px; font-size:22px;">
                                    <i class="fa-solid fa-layer-group"></i>
                                </div>

                                <!-- Text & Numbers -->
                                <div>
                                    <span class="text-muted" style="font-size:14px; letter-spacing:0.5px;">Sub
                                        Categories</span>

                                    <div class="d-flex gap-3 align-items-baseline" style="margin-top:5px;">
                                        <!-- Total Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#17a2b8;">
                                            {{ $sub_categories->count() }}
                                        </h3>
                                        <span class="text-muted" style="font-size:14px;">Total</span>

                                        <!-- Active Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#28a745;">
                                            {{ $sub_categories_active->count() }}
                                        </h3>
                                        <span class="text-muted" style="font-size:14px;">Active</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>

                {{-- Total Division Count --}}
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('division.index') }}" style="text-decoration: none;">
                        <div class="card" style="border-radius:12px; padding:20px; background-color:#fff;">
                            <div class="d-flex align-items-center gap-4">

                                <!-- Icon Circle -->
                                <div class="d-flex align-items-center justify-content-center rounded-circle text-white bg-info"
                                    style="width:50px; height:50px; font-size:22px;">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>

                                <!-- Text & Numbers -->
                                <div>
                                    <span class="text-muted" style="font-size:14px; letter-spacing:0.5px;">Division</span>

                                    <div class="d-flex gap-3 align-items-baseline" style="margin-top:5px;">
                                        <!-- Total Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#17a2b8;">
                                            {{ $division->count() }}
                                        </h3>
                                        <span class="text-muted" style="font-size:14px;">Total</span>

                                        <!-- Active Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#28a745;">
                                            {{ $division_active->count() }}
                                        </h3>
                                        <span class="text-muted" style="font-size:14px;">Active</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>

                {{-- Total District Count --}}
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('district.index') }}" style="text-decoration: none;">
                        <div class="card" style="border-radius:12px; padding:20px; background-color:#fff;">
                            <div class="d-flex align-items-center gap-4">

                                <!-- Icon Circle -->
                                <div class="d-flex align-items-center justify-content-center rounded-circle text-white bg-info"
                                    style="width:50px; height:50px; font-size:22px;">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>

                                <!-- Text & Numbers -->
                                <div>
                                    <span class="text-muted" style="font-size:14px; letter-spacing:0.5px;">District</span>

                                    <div class="d-flex gap-3 align-items-baseline" style="margin-top:5px;">
                                        <!-- Total Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#17a2b8;">
                                            {{ $district->count() }}
                                        </h3>
                                        <span class="text-muted" style="font-size:14px;">Total</span>

                                        <!-- Active Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#28a745;">
                                            {{ $district_active->count() }}
                                        </h3>
                                        <span class="text-muted" style="font-size:14px;">Active</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>

                {{-- Total District Count --}}
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('subdistrict.index') }}" style="text-decoration: none;">
                        <div class="card" style="border-radius:12px; padding:20px; background-color:#fff;">
                            <div class="d-flex align-items-center gap-4">

                                <!-- Icon Circle -->
                                <div class="d-flex align-items-center justify-content-center rounded-circle text-white bg-info"
                                    style="width:50px; height:50px; font-size:22px;">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>

                                <!-- Text & Numbers -->
                                <div>
                                    <span class="text-muted" style="font-size:14px; letter-spacing:0.5px;">Sub
                                        District</span>

                                    <div class="d-flex gap-3 align-items-baseline" style="margin-top:5px;">
                                        <!-- Total Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#17a2b8;">
                                            {{ $sub_district->count() }}
                                        </h3>
                                        <span class="text-muted" style="font-size:14px;">Total</span>

                                        <!-- Active Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#28a745;">
                                            {{ $sub_district_active->count() }}
                                        </h3>
                                        <span class="text-muted" style="font-size:14px;">Active</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>

                {{-- Total Photo Count --}}
                <div class="col-lg-6 col-md-6">
                    <a href="{{ route('photogallery.index') }}" style="text-decoration: none;">
                        <div class="card" style="border-radius:12px; padding:20px; background-color:#fff;">
                            <div class="d-flex align-items-center gap-4">

                                <!-- Icon Circle -->
                                <div class="d-flex align-items-center justify-content-center rounded-circle text-white bg-info"
                                    style="width:50px; height:50px; font-size:22px;">
                                    <i class="fa-solid fa-image"></i>
                                </div>

                                <!-- Text & Numbers -->
                                <div>
                                    <span class="text-muted" style="font-size:14px; letter-spacing:0.5px;">Photos</span>

                                    <div class="d-flex gap-3 align-items-baseline" style="margin-top:5px;">
                                        <!-- Total Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#17a2b8;">
                                            {{ $photo->count() }}
                                        </h3>
                                        <span class="text-muted" style="font-size:14px;">Total</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>

                {{-- Total Video Count --}}
                <div class="col-lg-6 col-md-6">
                    <a href="{{ route('videogallery.index') }}" style="text-decoration: none;">
                        <div class="card" style="border-radius:12px; padding:20px; background-color:#fff;">
                            <div class="d-flex align-items-center gap-4">

                                <!-- Icon Circle -->
                                <div class="d-flex align-items-center justify-content-center rounded-circle text-white bg-info"
                                    style="width:50px; height:50px; font-size:22px;">
                                    <i class="fa-solid fa-video"></i>
                                </div>

                                <!-- Text & Numbers -->
                                <div>
                                    <span class="text-muted" style="font-size:14px; letter-spacing:0.5px;">Vidoes</span>

                                    <div class="d-flex gap-3 align-items-baseline" style="margin-top:5px;">
                                        <!-- Total Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#17a2b8;">
                                            {{ $video->count() }}
                                        </h3>
                                        <span class="text-muted" style="font-size:14px;">Total</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>


                {{-- Total Social Links Count --}}
                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('social.index') }}" style="text-decoration: none;">
                        <div class="card" style="border-radius:12px; padding:20px; background-color:#fff;">
                            <div class="d-flex align-items-center gap-4">

                                <!-- Icon Circle -->
                                <div class="d-flex align-items-center justify-content-center rounded-circle text-white bg-info"
                                    style="width:50px; height:50px; font-size:22px;">
                                    <i class="fa-solid fa-square-share-nodes"></i>
                                </div>

                                <!-- Text & Numbers -->
                                <div>
                                    <span class="text-muted" style="font-size:14px; letter-spacing:0.5px;">Social
                                        Links</span>

                                    <div class="d-flex gap-3 align-items-baseline" style="margin-top:5px;">
                                        <!-- Total Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#17a2b8;">
                                            {{ count(collect($social_links->getAttributes())->except(['id', 'created_at', 'updated_at'])) }}
                                        </h3>
                                        <span class="text-muted" style="font-size:14px;">Total</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>

                {{-- Total District Count --}}
                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('seo.index') }}" style="text-decoration: none;">
                        <div class="card" style="border-radius:12px; padding:20px; background-color:#fff;">
                            <div class="d-flex align-items-center gap-4">

                                <!-- Icon Circle -->
                                <div class="d-flex align-items-center justify-content-center rounded-circle text-white bg-info"
                                    style="width:50px; height:50px; font-size:22px;">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </div>

                                <!-- Text & Numbers -->
                                <div>
                                    <span class="text-muted" style="font-size:14px; letter-spacing:0.5px;">Seos</span>

                                    <div class="d-flex gap-3 align-items-baseline" style="margin-top:5px;">
                                        <!-- Total Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#17a2b8;">
                                            {{ count(collect($seos->getAttributes())->except(['id', 'created_at', 'updated_at'])) }}
                                        </h3>
                                        <span class="text-muted" style="font-size:14px;">Total</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>

                {{-- Total District Count --}}
                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('liveTV.index') }}" style="text-decoration: none;">
                        <div class="card" style="border-radius:12px; padding:20px; background-color:#fff;">
                            <div class="d-flex align-items-center gap-4">

                                <!-- Icon Circle -->
                                <div class="d-flex align-items-center justify-content-center rounded-circle text-white bg-info"
                                    style="width:50px; height:50px; font-size:22px;">
                                    <i class="fa-solid fa-tv"></i>
                                </div>

                                <!-- Text & Numbers -->
                                <div>
                                    <span class="text-muted" style="font-size:14px; letter-spacing:0.5px;">Live TV</span>

                                    <div class="d-flex gap-3 align-items-baseline" style="margin-top:5px;">
                                        <!-- Total Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#17a2b8;">
                                            {{ $live_tv->status == 1 ? 'Active' : 'Deactive' }}
                                        </h3>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>

                {{-- Total District Count --}}
                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('notice.index') }}" style="text-decoration: none;">
                        <div class="card" style="border-radius:12px; padding:20px; background-color:#fff;">
                            <div class="d-flex align-items-center gap-4">

                                <!-- Icon Circle -->
                                <div class="d-flex align-items-center justify-content-center rounded-circle text-white bg-info"
                                    style="width:50px; height:50px; font-size:22px;">
                                    <i class="fa-solid fa-flag"></i>
                                </div>

                                <!-- Text & Numbers -->
                                <div>
                                    <span class="text-muted" style="font-size:14px; letter-spacing:0.5px;">Notice</span>

                                    <div class="d-flex gap-3 align-items-baseline" style="margin-top:5px;">
                                        <!-- Total Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#17a2b8;">
                                            {{ $notice->status == 1 ? 'Active' : 'Deactive' }}
                                        </h3>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>


            </div>
        </div>
    </div>
@endsection
