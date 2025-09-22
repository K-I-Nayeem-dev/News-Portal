@extends('layouts.newsDashboard.dashboardMaster')

@section('dashboard')
    <div class="body-wrapper">

        <div class="container-fluid">


            <!-- -------------------------------------------------------------- -->
            <!-- Breadcrumb -->
            <!-- -------------------------------------------------------------- -->


            <div class="font-weight-medium shadow-none position-relative overflow-hidden mb-7">
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <!-- Left content -->
                    <div class="card-body px-0">
                        <h4 class="font-weight-medium mb-1">Dashboard</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none" href="">Home</a>
                                </li>
                                <li class="breadcrumb-item text-muted" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>

                    <!-- Right content: Search + Jump -->
                    <div class="d-flex align-items-center gap-3 mt-3 mt-md-0">
                        <!-- Search bar -->
                        <input type="text" id="dashboard-search" class="form-control" placeholder="Search Dashboard..."
                            style="width:220px; border-radius:25px; padding:6px 16px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); transition: all 0.2s;">

                        <!-- Jump to select -->
                        <select id="dashboard-jump" class="form-select"
                            style="width:220px; border-radius:25px; padding:6px 16px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); transition: all 0.2s;">
                            <option value="">Jump to Card...</option>
                            <option value="Today's Visitor">Today's Visitor</option>
                            <option value="Total Visitor">Total Visitor</option>
                            <option value="Ads">Ads</option>
                            <option value="Headlines">Headlines</option>
                            <option value="News">News</option>
                            <option value="Categories">Categories</option>
                            <option value="Sub Categories">Sub Categories</option>
                            <option value="Photos">Photos</option>
                            <option value="Videos">Videos</option>
                            <option value="Live TV">Live TV</option>
                            <option value="Notice">Notice</option>
                            <option value="User">User</option>
                            <option value="Roles">Roles</option>
                            <option value="Permission">Permission</option>
                            <option value="Social Links">Social Links</option>
                            <option value="SEOs">SEOs</option>
                            <option value="Division">Division</option>
                            <option value="District">District</option>
                            <option value="Sub District">Sub District</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Optional CSS -->
            <style>
                #dashboard-search:focus,
                #dashboard-jump:focus {
                    outline: none;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                }

                #dashboard-jump option {
                    padding: 8px 16px;
                }

                /* Elegant highlight only on the card */
                .highlight-card {
                    position: relative;
                    border-radius: 12px;
                    /* match your card's radius */
                    box-shadow: 0 0 0 0 rgba(255, 200, 0, 0.7);
                    animation: card-glow 1s ease forwards;
                }

                @keyframes card-glow {
                    0% {
                        box-shadow: 0 0 0 0 rgba(255, 200, 0, 0.7);
                    }

                    50% {
                        box-shadow: 0 0 20px 8px rgba(255, 200, 0, 0.7);
                    }

                    100% {
                        box-shadow: 0 0 0 0 rgba(255, 200, 0, 0);
                    }
                }
            </style>


            <!-- -------------------------------------------------------------- -->
            <!-- Breadcrumb End -->
            <!-- -------------------------------------------------------------- -->


            <!-- Row -->
            <div class="row">

                <div class="row g-4">

                    {{-- Visitor Card --}}
                    <div class="col-lg-4 col-md-6 dashboard-card" data-title="Our Visitors">
                        <div class="card shadow-sm rounded-3">
                            <div class="card-body">
                                <h4 class="card-title">Our Visitors</h4>
                                <p class="card-subtitle text-muted">Different Devices Used to Visit</p>
                                <div id="our-visitors" style="min-height: 250px;"></div>
                            </div>
                            <div class="card-footer d-flex justify-content-center border-top">
                                <ul class="list-inline mb-0 d-flex gap-3">
                                    <li class="list-inline-item d-flex align-items-center gap-2 text-primary">
                                        <iconify-icon icon="ri:circle-fill" class="fs-2"></iconify-icon> Mobile
                                    </li>
                                    <li class="list-inline-item d-flex align-items-center gap-2 text-purple">
                                        <iconify-icon icon="ri:circle-fill" class="fs-2"></iconify-icon> Desktop
                                    </li>
                                    <li class="list-inline-item d-flex align-items-center gap-2 text-secondary">
                                        <iconify-icon icon="ri:circle-fill" class="fs-2"></iconify-icon> Tablet
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Weather Card --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="card mb-3">
                            <div class="card-body p-3">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-primary-subtle rounded-3 px-3 py-2 mb-3">
                                    <h4 class="mb-0">{{ $weather['name'] ?? 'Dhaka' }}</h4>
                                    <p class="mb-0">{{ now()->format('l d F') }}</p>
                                </div>

                                @if (isset($weather['main']))
                                    <div class="d-flex gap-4 align-items-center">
                                        <div
                                            class="bg-primary-subtle rounded-circle p-2 d-flex align-items-center justify-content-center">
                                            @php
                                                $iconCode = $weather['weather'][0]['icon'] ?? '01d';
                                                $iconUrl = "https://openweathermap.org/img/wn/{$iconCode}.png";
                                            @endphp
                                            <img src="{{ $iconUrl }}" alt="Weather Icon" class="icon-center">
                                        </div>
                                        <div>
                                            <h3 class="text-primary mb-1">{{ round($weather['main']['temp']) ?? '--' }}°C
                                            </h3>
                                            <p class="mb-0">{{ ucfirst($weather['weather'][0]['description'] ?? '') }}</p>
                                        </div>
                                        <div>
                                            <h3 class="mb-1">{{ round($weather['main']['temp_min']) ?? '--' }}°C</h3>
                                            <p class="mb-0">Tonight</p>
                                        </div>
                                    </div>
                                @else
                                    <p class="text-danger">{{ $weather['error'] ?? 'Weather data not available' }}</p>
                                @endif
                            </div>
                        </div>

                        {{-- Total Bandwidth --}}
                        <a href="{{ route('bandwidth.index') }}" class="text-decoration-none">
                            <div class="card overflow-hidden">
                                <div class="card-body bg-purple">
                                    <div class="hstack gap-6 mb-7">
                                        <div
                                            class="bg-black bg-opacity-10 round-48 rounded-circle d-flex align-items-center justify-content-center">
                                            <iconify-icon icon="solar:server-square-linear"
                                                class="fs-7 icon-center text-white"></iconify-icon>
                                        </div>
                                        <div>
                                            <h4 class="card-title text-white">Bandwidth usage</h4>
                                            <p class="card-subtitle text-white opacity-70">
                                                {{ $latestBandwidth->month ?? now()->format('F Y') }}</p>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <h2 class="mb-0 text-white text-nowrap">
                                                {{ function_exists('formatBytes') ? formatBytes($latestBandwidth->used_bytes ?? 0) : number_format(($latestBandwidth->used_bytes ?? 0) / (1024 * 1024), 2) . ' MB' }}
                                            </h2>
                                        </div>

                                        <div class="col-6">
                                            <!-- dashboard sparkline -->
                                            <div id="bandwidth-sparkline-latest" style="min-height:50px"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>


                    </div>

                    {{-- Browser Stats --}}
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Browser Stats</h4>
                                <table class="table table-borderless mt-3 mb-0">
                                    <tbody>
                                        @foreach ($browserCounts as $browser => $count)
                                            @php
                                                $logo = $browserLogos[$browser]['logo'] ?? 'default.png';
                                                $color = $browserLogos[$browser]['color'] ?? 'secondary';
                                                $percent =
                                                    $totalVisitors > 0
                                                        ? round(($count / $totalVisitors) * 100) . '%'
                                                        : '0%';
                                            @endphp
                                            <tr>
                                                <td class="ps-0 w35">
                                                    <img src="{{ asset('dashboard_assets/images/browser/' . $logo) }}"
                                                        class="img-fluid" alt="{{ $browser }}">
                                                </td>
                                                <td class="ps-0">{{ $browser }}</td>
                                                <td class="ps-0 text-end">
                                                    <span
                                                        class="badge bg-{{ $color }}-subtle text-{{ $color }}">{{ $percent }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>

                <!-- Today's Visitor Count -->
                <div class="col-lg-6 col-md-6 dashboard-card" data-title="Today's Visitor">
                    <div class="card" style="border-radius:12px; padding:20px; background-color:#fff;">
                        <div class="d-flex align-items-center gap-4">

                            <!-- Icon Circle -->
                            <div class="d-flex align-items-center justify-content-center rounded-circle text-white bg-primary"
                                style="width:50px; height:50px; font-size:22px;">
                                <i class="fa-solid fa-user-check"></i>
                            </div>

                            <!-- Text & Numbers -->
                            <div>
                                <span class="text-muted" style="font-size:14px; letter-spacing:0.5px;">Today's
                                    Visitor</span>

                                <div class="d-flex gap-3 align-items-baseline" style="margin-top:5px;">
                                    <!-- Total Headlines -->
                                    <h3 style="margin:0; font-size:32px; font-weight:800; color:#17a2b8;">
                                        {{ $todayVisitors }}
                                    </h3>
                                    <span class="text-muted" style="font-size:14px;">Total</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Total Visitor Count -->
                <div class="col-lg-6 col-md-6 dashboard-card" data-title="Total Visitor"">
                    <div class="card" style="border-radius:12px; padding:20px; background-color:#fff;">
                        <div class="d-flex align-items-center gap-4">

                            <!-- Icon Circle -->
                            <div class="d-flex align-items-center justify-content-center rounded-circle text-white bg-primary"
                                style="width:50px; height:50px; font-size:22px;">
                                <i class="fa-solid fa-user-group"></i>
                            </div>

                            <!-- Text & Numbers -->
                            <div>
                                <span class="text-muted" style="font-size:14px; letter-spacing:0.5px;">Total
                                    Visitor</span>

                                <div class="d-flex gap-3 align-items-baseline" style="margin-top:5px;">
                                    <!-- Total Headlines -->
                                    <h3 style="margin:0; font-size:32px; font-weight:800; color:#17a2b8;">
                                        {{ $totalVisitors }}
                                    </h3>
                                    <span class="text-muted" style="font-size:14px;">Total</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Total Categories Count --}}
                <div class="col-lg-6 col-md-6 dashboard-card" data-title="Categories">
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
                                    <span class="text-muted"
                                        style="font-size:14px; letter-spacing:0.5px;">Categories</span>

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
                <div class="col-lg-6 col-md-6 dashboard-card" data-title="Sub Categories">
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

                {{-- Total Photo Count --}}
                <div class="col-lg-6 col-md-6 dashboard-card" data-title="Photos">
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
                <div class="col-lg-6 col-md-6 dashboard-card" data-title="Videos">
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

                <!-- Total Ads Count -->
                <div class="col-lg-6 col-md-6 dashboard-card" data-title="Ads">
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

                <div class="col-lg-6 col-md-6 dashboard-card" data-title="Ads">
                    <a href="{{ route('ads.performance') }}" style="text-decoration: none;">
                        <div class="card" style="border-radius:12px; padding:20px; background-color:#fff;">
                            <div class="d-flex align-items-center gap-4">

                                <!-- Icon Circle -->
                                <div class="d-flex align-items-center justify-content-center rounded-circle text-white bg-primary"
                                    style="width:50px; height:50px; font-size:22px;">
                                    <i class="fa-solid fa-computer-mouse"></i>
                                </div>

                                <!-- Text & Numbers -->
                                <div>
                                    <span class="text-muted" style="font-size:14px; letter-spacing:0.5px;">Total Ads
                                        Click</span>

                                    <div class="d-flex gap-3 align-items-baseline" style="margin-top:5px;">
                                        <!-- Total Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#17a2b8;">
                                            {{ $totalClicks }}
                                        </h3>
                                        <span class="text-muted" style="font-size:14px;">Total</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>

                {{-- Total Headline Count --}}
                <div class="col-lg-6 col-md-6 dashboard-card" data-title="Headlines">
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
                                    <span class="text-muted"
                                        style="font-size:14px; letter-spacing:0.5px;">Headlines</span>

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
                <div class="col-lg-6 col-md-6 dashboard-card" data-title="News">
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

                {{-- Total Division Count --}}
                <div class="col-lg-4 col-md-6 dashboard-card" data-title="Division">
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
                <div class="col-lg-4 col-md-6 dashboard-card" data-title="District">
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

                {{-- Total Sub District Count --}}
                <div class="col-lg-4 col-md-6 dashboard-card" data-title="Sub District">
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

                {{-- Total User Count --}}
                <div class="col-lg-4 col-md-6 dashboard-card" data-title="User">
                    <a href="{{ route('user.index') }}" style="text-decoration: none;">
                        <div class="card" style="border-radius:12px; padding:20px; background-color:#fff;">
                            <div class="d-flex align-items-center gap-4">
                                <!-- Icon Circle -->
                                <div class="d-flex align-items-center justify-content-center rounded-circle text-white bg-info"
                                    style="width:50px; height:50px; font-size:22px;">
                                    <i class="fa-solid fa-users"></i>
                                </div>

                                <!-- Text & Numbers -->
                                <div>
                                    <span class="text-muted" style="font-size:14px; letter-spacing:0.5px;">User</span>

                                    <div class="d-flex gap-3 align-items-baseline" style="margin-top:5px;">
                                        <!-- Total Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#17a2b8;">
                                            {{ $users->count() }}
                                        </h3>
                                        <span class="text-muted" style="font-size:14px;">Total</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Total Roles Count --}}
                <div class="col-lg-4 col-md-6 dashboard-card" data-title="Roles">
                    <a href="{{ route('role.index') }}" style="text-decoration: none;">
                        <div class="card" style="border-radius:12px; padding:20px; background-color:#fff;">
                            <div class="d-flex align-items-center gap-4">
                                <!-- Icon Circle -->
                                <div class="d-flex align-items-center justify-content-center rounded-circle text-white bg-info"
                                    style="width:50px; height:50px; font-size:22px;">
                                    <i class="fa-solid fa-users-gear"></i>
                                </div>

                                <!-- Text & Numbers -->
                                <div>
                                    <span class="text-muted" style="font-size:14px; letter-spacing:0.5px;">Roles</span>

                                    <div class="d-flex gap-3 align-items-baseline" style="margin-top:5px;">
                                        <!-- Total Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#17a2b8;">
                                            {{ $roles->count() }}
                                        </h3>
                                        <span class="text-muted" style="font-size:14px;">Total</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Total Permissoin Count --}}
                <div class="col-lg-4 col-md-6 dashboard-card" data-title="Permission">
                    <a href="{{ route('permission.index') }}" style="text-decoration: none;">
                        <div class="card" style="border-radius:12px; padding:20px; background-color:#fff;">
                            <div class="d-flex align-items-center gap-4">
                                <!-- Icon Circle -->
                                <div class="d-flex align-items-center justify-content-center rounded-circle text-white bg-info"
                                    style="width:50px; height:50px; font-size:22px;">
                                    <i class="fa-solid fa-lock"></i>
                                </div>

                                <!-- Text & Numbers -->
                                <div>
                                    <span class="text-muted"
                                        style="font-size:14px; letter-spacing:0.5px;">Permission</span>

                                    <div class="d-flex gap-3 align-items-baseline" style="margin-top:5px;">
                                        <!-- Total Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#17a2b8;">
                                            {{ $permissions->count() }}
                                        </h3>
                                        <span class="text-muted" style="font-size:14px;">Total</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>


                {{-- Total Social Links Count --}}
                <div class="col-lg-3 col-md-6 dashboard-card" data-title="Social Links">
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
                                            {{ optional($social_links)->getAttributes()
                                                ? collect($social_links->getAttributes())->except(['id', 'created_at', 'updated_at'])->count()
                                                : 0 }}

                                        </h3>
                                        <span class="text-muted" style="font-size:14px;">Total</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>

                {{-- Total SEOs Count --}}
                <div class="col-lg-3 col-md-6 dashboard-card" data-title="SEOs">
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
                                            {{ optional($seos)->getAttributes()
                                                ? collect($seos->getAttributes())->except(['id', 'created_at', 'updated_at'])->count()
                                                : 0 }}

                                        </h3>
                                        <span class="text-muted" style="font-size:14px;">Total</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>

                {{-- Live TV --}}
                <div class="col-lg-3 col-md-6 dashboard-card" data-title="Live TV">
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
                                    <span class="text-muted" style="font-size:14px; letter-spacing:0.5px;">Live
                                        TV</span>

                                    <div class="d-flex gap-3 align-items-baseline" style="margin-top:5px;">
                                        <!-- Total Headlines -->
                                        <h3 style="margin:0; font-size:32px; font-weight:800; color:#17a2b8;">
                                            {{ optional($live_tv)->status == 1 ? 'Active' : 'Deactive' }}
                                        </h3>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>

                {{-- Notice Board --}}
                <div class="col-lg-3 col-md-6 dashboard-card" data-title="Notice">
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
                                            {{ optional($notice)->status == 1 ? 'Active' : 'Deactive' }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>

        </div>

        <!-- ApexCharts CDN (include once, e.g. in footer) -->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // latest chart data (MB)
                var latest = {!! json_encode($latestChartData ?? []) !!};

                var options = {
                    chart: {
                        type: 'line',
                        height: 50,
                        sparkline: {
                            enabled: true
                        }
                    },
                    series: [{
                        data: latest
                    }],
                    stroke: {
                        curve: 'smooth',
                        width: 2
                    },
                    colors: ['#ffffff'],
                    tooltip: {
                        theme: 'dark',
                        y: {
                            formatter: function(val) {
                                return val + ' MB';
                            }
                        }
                    }
                };

                if (document.querySelector('#bandwidth-sparkline-latest')) {
                    new ApexCharts(document.querySelector("#bandwidth-sparkline-latest"), options).render();
                }
            });
        </script>


        <script>
            const visitorsData = @json($visitorData);
        </script>

        <!-- JS for Dashboard Search -->
        <script>
            document.getElementById('dashboard-search').addEventListener('input', function() {
                let query = this.value.toLowerCase();
                document.querySelectorAll('.dashboard-card').forEach(function(card) {
                    let title = card.getAttribute('data-title').toLowerCase();
                    card.style.display = title.includes(query) ? 'block' : 'none';
                });
            });
        </script>

        <script>
            const jumpSelect = document.getElementById('dashboard-jump');

            jumpSelect.addEventListener('change', () => {
                const selected = jumpSelect.value;
                if (!selected) return;

                // Find the card by data-title
                const cardCol = document.querySelector(`.dashboard-card[data-title="${selected}"]`);
                if (!cardCol) return;

                const card = cardCol.querySelector('.card'); // target only inner card
                card.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });

                // Apply highlight
                card.classList.add('highlight-card');

                setTimeout(() => {
                    card.classList.remove('highlight-card');
                }, 1200);
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Data for card 1
                const options1 = {
                    chart: {
                        type: 'line',
                        height: 50,
                        sparkline: {
                            enabled: true
                        }
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 2
                    },
                    series: [{
                        name: 'Bandwidth',
                        data: [40, 50, 45, 60, 50, 55, 50] // example data
                    }],
                    colors: ['#ffffff'],
                    tooltip: {
                        enabled: false
                    }
                };
                const chart1 = new ApexCharts(document.querySelector("#bandwidth-usage-1"), options1);
                chart1.render();
            });
        </script>


    </div>
@endsection
