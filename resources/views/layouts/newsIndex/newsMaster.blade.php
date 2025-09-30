<!DOCTYPE html>
<html dir="ltr"lang="bn">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    {{-- For Seo with dynamic name Start  --}}

    <meta name="meta_author" content="{{ $meta?->meta_author }}" />
    <meta name="meta_title" content="{{ $meta?->meta_title }}" />
    <meta name="meta_keyword" content="{{ $meta?->meta_keyword }}" />
    <meta name="meta_description" content="{{ $meta?->meta_description }}" />
    <meta name="google_analytics" content="{{ $meta?->google_analytics }}" />
    <meta name="google_verifications" content="{{ $meta?->google_verifications }}" />
    <meta name="alexa_analytics" content="{{ $meta?->alexa_analytics }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    {{-- For Seo with dynamic name End  --}}


    <title>USNews - Multipurpose News, Magazine and Blog HTML5 Template</title>

    <meta name="author" content="ThemeLooks" />
    <meta name="description" content="USNews - Multipurpose News and Magazine Template" />
    <meta name="keywords"
        content="news, newspaper, magazine, blog, post, article, editorial, publishing, modern, responsive, html5, template" />
    <link rel="icon" href="favicon.png" type="image/png" />
    {{-- <link rel="stylesheet" href="{{ asset('frontend_assets') }}/css?family=Source+Sans+Pro:400,600,700" /> --}}
    <link rel="stylesheet" href="{{ asset('frontend_assets') }}/css/font-awesome.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend_assets') }}/css/bootstrap.min.css" />
    {{-- <link rel="stylesheet" href="{{ asset('frontend_assets') }}/css/fontawesome-stars-o.min.css" /> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/brands.min.css" /> --}}
    <!-- Add this in <head> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('frontend_assets') }}/css/style.css" />
    <link rel="stylesheet" href="{{ asset('frontend_assets') }}/css/responsive-style.css" />
    <link rel="stylesheet" href="{{ asset('frontend_assets') }}/css/colors/theme-color-1.css" id="changeColorScheme" />
    <link rel="stylesheet" href="{{ asset('frontend_assets') }}/css/custom.css" />

    <!-- Splide CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">

    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        body {
            font-family: 'open-sans'
        }

        #banglaToEnglish:hover {
            color: white !important;
            transition: 0.5 ease-in-out;
        }

        .pulse {
            display: inline-flex;
            align-items: center;
            /* space between dot and text */
            text-decoration: none;
            color: black;
            font-weight: bold;
            border: 1px solid black;
            padding: 2px 8px;
            border-radius: 5px;
        }

        .pulse::before {
            content: "";
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 5px;
            background-color: red;
            display: inline-block;
            animation: pulse-animation 1.5s infinite;
        }

        @keyframes pulse-animation {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 0, 0, 0.7);
            }

            70% {
                box-shadow: 0 0 0 8px rgba(255, 0, 0, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(255, 0, 0, 0);
            }
        }

        .catehover {
            transition: transform 0.1s ease-in-out;
            cursor: pointer;
            display: inline-block;
            /* needed to scale properly */
        }

        .catehover:hover {
            transform: scale(1.05);
        }

        /* Search form align fix */
        .header--search-form {
            display: flex;
            align-items: center;
            margin-left: 15px;
            /* menu থেকে সামান্য gap */
        }

        /* Only search icon white */
        #openSearch .header--search-btn {
            padding: 0;
            border-radius: 0;
            box-shadow: none;
            background: transparent !important;
            color: #fff !important;
            /* শুধু icon সাদা */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50px;
            /* menu height এর সাথে match করবে */
        }

        #openSearch .header--search-btn i {
            margin-top: 5px;
            font-size: 20px;
            /* icon size */
            line-height: 1;
        }
    </style>



    <script type='text/javascript'
        src='https://platform-api.sharethis.com/js/sharethis.js#property=6896161ae700c1c978e64e5f&product=sop'
        async='async'></script>
</head>

<body>
    <div class="wrapper">
        <header class="header--section header--style-1">


            <div class="header--topbar bg--color-2">
                <div class="container">
                    <div class="float--left float--xs-none text-xs-center">
                        <ul class="header--topbar-info nav">
                            <li><i
                                    class="fa fm fa-map-marker"></i>{{ session('lang') == 'english' ? $position_en : $position_bn }}
                            </li>
                            <li>
                                <i class="fa fm fa-calendar"></i>
                                {{ session('lang') == 'english' ? \Carbon\Carbon::now()->setTimezone('Asia/Dhaka')->format('j F Y, g:i A') : formatBanglaDateTime(now()) }}
                            </li>
                            @if (session('lang') != 'english')
                                <li>
                                    <i class="fa-solid fa-cloud-sun"></i><span style="margin-left: 2px"
                                        id="date-today"></span>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="float--right float--xs-none text-xs-center">
                        <ul class="header--topbar-social nav hidden-sm hidden-xxs">
                            <li><a href="{{ $social->facebook }}"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="{{ $social->twitter }}"><i class="fa-brands fa-x-twitter"></i></a></li>
                            <li><a href="{{ $social->instagram }}"><i class="fa-brands fa-instagram"></i></a></li>
                            <li><a href="{{ $social->youtube }}"><i class="fa-brands fa-youtube"></i></a></li>
                            <li><a href="{{ $social->linkedin }}"><i class="fa-brands fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <style>
                /* Hide header topbar on mobile screens only */
                @media only screen and (max-width: 767px) {
                    .header--topbar {
                        display: none;
                    }
                }

                /* Visible on tablet and desktop */
                @media only screen and (min-width: 768px) {
                    .header--topbar {
                        display: flex;
                        /* use flex if your layout needs alignment */
                        justify-content: space-between;
                        /* optional, for left-right alignment */
                        align-items: center;
                        /* vertical centering */
                    }
                }
            </style>

            <div style="margin-top: 10px !important;">
                <div class="header-container" style="margin-bottom: 10px !important;">
                    <div class="header-row">
                        <!-- Logo + Ads -->
                        <div class="logo-ads-row">
                            <!-- Logo -->
                            <div class="logo">
                                <a href="{{ route('home') }}">
                                    @if ($webSite_setting->logo)
                                        <img src="{{ asset($webSite_setting->logo) }}" alt="Logo">
                                    @else
                                        <img src="{{ asset('frontend_assets/img/logo.png') }}" alt="Logo">
                                    @endif
                                </a>
                            </div>

                            <!-- Ads (hide on mobile) -->
                            <div class="ads">
                                <a href="{{ route('ads.trackClick', $ftp->id) }}" target="_blank">
                                    <img src="{{ $ftp && file_exists(public_path($ftp->image)) ? asset($ftp->image) : asset('frontend_assets/img/ads-img/ad-728x90-01.jpg') }}"
                                        alt="Advertisement">
                                </a>
                            </div>

                            <!-- Buttons -->
                            <div class="button-row">
                                @if (DB::table('live_tvs')->where('status', 1)->first())
                                    <a href="{{ route('live.tv') }}"
                                        class="pulse">{{ session()->get('lang') == 'english' ? 'Live Tv' : 'লাইভ টিভি' }}</a>
                                @endif
                                <a href="{{ route('video.gallery') }}" title="Video Gallery">
                                    <i class="fa fa-video-camera"></i>
                                </a>
                                @if (session()->get('lang') == 'english')
                                    <a href="{{ route('news.bangla') }}" class="lang-btn">বাংলা</a>
                                @else
                                    <a href="{{ route('news.english') }}" class="lang-btn">English</a>
                                @endif
                                <button id="theme-toggle">
                                    <span id="icon-moon">🌙</span>
                                    <span id="icon-sun" class="hidden">☀️</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    .header-container {
                        max-width: 1200px;
                        margin: 0 auto;
                        padding: 0 15px;
                    }

                    .header-row {
                        display: flex;
                        flex-direction: column;
                        /* default for stacking if needed */
                    }

                    /* Logo + Ads + Buttons row */
                    .logo-ads-row {
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        gap: 15px;
                        flex-wrap: wrap;
                        /* ❌ this is the problem */
                        width: 100%;
                    }


                    .logo img {
                        height: 60px;
                        display: block;
                    }



                    .ads {
                        flex: 1;
                        text-align: center;
                    }

                    .ads img {
                        max-width: 100%;
                        height: auto;
                        display: block;
                    }

                    .button-row {
                        display: flex;
                        align-items: center;
                        gap: 10px;
                        flex-shrink: 0;
                    }

                    .button-row a,
                    .button-row button {
                        font-size: 14px;
                        text-decoration: none;
                        padding: 4px 8px;
                        border-radius: 4px;
                        cursor: pointer;
                    }

                    .button-row a.lang-btn {
                        background: #007bff;
                        color: #fff;
                    }

                    .button-row i {
                        font-size: 20px;
                        color: #007bff;
                    }

                    /* Dark mode */
                    body.dark-mode {
                        background: #121212;
                        color: #fff;
                    }

                    body.dark-mode .header-container {
                        background: #1e1e1e;
                    }

                    /* More targeted dark mode text styling */
                    body.dark-mode {
                        color: #ffffff !important;
                    }

                    /* Dark Mode - Make main content white */
                    body.dark-mode {
                        color: #ffffff !important;
                    }

                    /* Dark Mode - Force ALL text to white by default */
                    body.dark-mode * {
                        color: #ffffff !important;
                    }

                    /* ===== PERMANENT BEAUTIFUL WIDGET DESIGNS FOR LIGHT & DARK MODES ===== */

                    /* === FEATURED NEWS WIDGET === */
                    .list--widget {
                        background-color: var(--widget-bg, #ffffff) !important;
                        border: 1px solid var(--widget-border, #e0e0e0) !important;
                        border-radius: 12px !important;
                        padding: 20px !important;
                        box-shadow: var(--widget-shadow, 0 4px 6px rgba(0, 0, 0, 0.05)) !important;
                        transition: all 0.3s ease !important;
                        margin-bottom: 25px !important;
                    }

                    .list--widget:hover {
                        box-shadow: var(--widget-shadow-hover, 0 8px 15px rgba(0, 0, 0, 0.1)) !important;
                        transform: translateY(-2px) !important;
                    }

                    .list--widget .widget--title {
                        border-bottom: 2px solid var(--primary-color, #007bff) !important;
                        padding-bottom: 15px !important;
                        margin-bottom: 20px !important;
                        display: flex !important;
                        justify-content: space-between !important;
                        align-items: center !important;
                    }

                    .list--widget .widget--title h2 {
                        color: var(--text-primary, #2c3e50) !important;
                        font-weight: 700 !important;
                        font-size: 1.4rem !important;
                        margin: 0 !important;
                    }

                    .list--widget .widget--title i {
                        color: var(--primary-color, #007bff) !important;
                        font-size: 1.2rem !important;
                    }

                    .list--widget .post--item {
                        border-bottom: 1px solid var(--border-color, #f0f0f0) !important;
                        padding: 15px 0 !important;
                        transition: all 0.3s ease !important;
                    }

                    .list--widget .post--item:hover {
                        background-color: var(--hover-bg, #f8f9fa) !important;
                        border-radius: 8px !important;
                        padding-left: 10px !important;
                        padding-right: 10px !important;
                        margin: 0 -10px !important;
                    }

                    .list--widget .post--item:last-child {
                        border-bottom: none !important;
                    }

                    .list--widget .post--img .thumb img {
                        border-radius: 8px !important;
                        transition: transform 0.3s ease !important;
                    }

                    .list--widget .post--img .thumb:hover img {
                        transform: scale(1.05) !important;
                    }

                    .list--widget .post--info .meta li a {
                        color: var(--text-muted, #6c757d) !important;
                        font-size: 12px !important;
                        font-weight: 500 !important;
                    }

                    .list--widget .post--info .title h3.h4 a {
                        color: var(--text-primary, #2c3e50) !important;
                        font-weight: 600 !important;
                        line-height: 1.4 !important;
                        font-size: 1.1rem !important;
                        transition: color 0.3s ease !important;
                    }

                    .list--widget .post--info .title h3.h4 a:hover {
                        color: var(--primary-color, #007bff) !important;
                    }

                    /* === CALENDAR WIDGET === */
                    .calendar-box {
                        background-color: var(--widget-bg, #ffffff) !important;
                        border: 1px solid var(--widget-border, #e0e0e0) !important;
                        border-radius: 12px !important;
                        overflow: hidden !important;
                        box-shadow: var(--widget-shadow, 0 4px 6px rgba(0, 0, 0, 0.05)) !important;
                        margin-bottom: 25px !important;
                    }

                    .calendar-box>div:first-child {
                        background: linear-gradient(135deg, var(--primary-color, #007bff), var(--primary-dark, #0056b3)) !important;
                        border-bottom: none !important;
                    }

                    .calendar-box h4 {
                        color: #ffffff !important;
                        font-weight: 700 !important;
                        margin: 0 !important;
                        padding: 20px 0 !important;
                        text-align: center !important;
                        font-size: 1.3rem !important;
                    }

                    .calendar-header {
                        background-color: var(--header-bg, #f8f9fa) !important;
                        padding: 15px !important;
                        display: flex !important;
                        gap: 10px !important;
                        justify-content: center !important;
                    }

                    .calendar-header select {
                        background-color: var(--input-bg, #ffffff) !important;
                        color: var(--text-primary, #2c3e50) !important;
                        border: 1px solid var(--input-border, #ddd) !important;
                        border-radius: 6px !important;
                        padding: 8px 12px !important;
                        font-weight: 600 !important;
                        transition: all 0.3s ease !important;
                    }

                    .calendar-header select:hover {
                        border-color: var(--primary-color, #007bff) !important;
                    }

                    .calendar-days {
                        background-color: var(--header-bg, #f8f9fa) !important;
                        border-bottom: 1px solid var(--border-color, #e0e0e0) !important;
                        padding: 10px 15px !important;
                    }

                    .calendar-days div {
                        color: var(--text-primary, #2c3e50) !important;
                        font-weight: 700 !important;
                        font-size: 0.9rem !important;
                    }

                    .calendar-dates {
                        background-color: var(--widget-bg, #ffffff) !important;
                        padding: 15px !important;
                    }

                    .calendar-dates div {
                        color: var(--text-primary, #2c3e50) !important;
                        border-radius: 6px !important;
                        transition: all 0.3s ease !important;
                        font-weight: 600 !important;
                        padding: 8px 0 !important;
                    }

                    .calendar-dates div:hover {
                        background-color: var(--primary-color, #007bff) !important;
                        color: #ffffff !important;
                        transform: scale(1.1) !important;
                    }

                    .calendar-dates div.selected {
                        background: linear-gradient(135deg, var(--primary-color, #007bff), var(--primary-dark, #0056b3)) !important;
                        color: #ffffff !important;
                    }

                    /* === VOTING POLL WIDGET - FULL FIX === */

                    /* Container */
                    .poll--widget {
                        background-color: var(--widget-bg, #ffffff) !important;
                        border: 1px solid var(--widget-border, #e0e0e0) !important;
                        border-radius: 12px !important;
                        padding: 25px !important;
                        box-shadow: var(--widget-shadow, 0 4px 6px rgba(0, 0, 0, 0.05)) !important;
                        margin-bottom: 25px !important;
                        transition: all 0.3s ease !important;
                    }

                    /* Title */
                    .poll--widget .title h3.h4 {
                        color: var(--text-primary, #2c3e50) !important;
                        font-weight: 700 !important;
                        margin-bottom: 25px !important;
                        line-height: 1.5 !important;
                        border-bottom: 2px solid var(--primary-color, #007bff) !important;
                        padding-bottom: 15px !important;
                        font-size: 1.3rem !important;
                    }

                    /* Option card */
                    .poll--widget .options .radio {
                        margin-bottom: 15px !important;
                        padding: 15px !important;
                        background-color: var(--card-bg, #f8f9fa) !important;
                        border-radius: 8px !important;
                        border: 2px solid transparent !important;
                        transition: all 0.3s ease !important;
                    }

                    .poll--widget .options .radio:hover {
                        background-color: var(--hover-bg, #e3f2fd) !important;
                        border-color: var(--primary-color, #007bff) !important;
                        transform: translateX(5px) !important;
                    }

                    /* Radio label */
                    .poll--widget .options .radio label {
                        color: var(--text-primary, #2c3e50) !important;
                        font-weight: 600 !important;
                        display: flex !important;
                        align-items: center !important;
                        margin-bottom: 10px !important;
                        cursor: pointer !important;
                    }

                    .poll--widget .options .radio input[type="radio"] {
                        margin-right: 12px !important;
                        accent-color: var(--primary-color, #007bff) !important;
                        transform: scale(1.2) !important;
                    }

                    .poll--widget .options .radio span {
                        color: var(--text-primary, #2c3e50) !important;
                        font-size: 14px !important;
                    }

                    /* Progress container */
                    .poll--widget .options .radio p {
                        display: flex !important;
                        flex-direction: column !important;
                        /* stack text and bar */
                        gap: 5px !important;
                        margin: 8px 0 0 0 !important;
                    }

                    /* Percentage text */
                    .poll--widget .options .radio p .percent-text {
                        color: var(--text-muted, #6c757d) !important;
                        font-size: 13px !important;
                        font-weight: 600 !important;
                    }

                    /* Progress bar */
                    .poll--widget .options .radio p span.progress-bar {
                        display: block !important;
                        height: 8px !important;
                        border-radius: 4px !important;
                        background: linear-gradient(90deg, var(--primary-color, #007bff), var(--primary-dark, #0056b3)) !important;
                        width: 0%;
                        /* updated dynamically via JS */
                        max-width: 100% !important;
                        transition: width 0.5s ease !important;
                        min-width: 50px !important;
                    }

                    /* Submit button */
                    .poll--widget .btn-primary {
                        background: linear-gradient(135deg, var(--primary-color, #007bff), var(--primary-dark, #0056b3)) !important;
                        border: none !important;
                        color: #ffffff !important;
                        padding: 15px 30px !important;
                        border-radius: 8px !important;
                        font-weight: 700 !important;
                        width: 100% !important;
                        margin-top: 20px !important;
                        transition: all 0.3s ease !important;
                        font-size: 1rem !important;
                    }

                    .poll--widget .btn-primary:hover {
                        transform: translateY(-3px) !important;
                        box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4) !important;
                    }

                    /* Dark mode support */
                    body.dark-mode .poll--widget {
                        background-color: #2d2d2d !important;
                        border-color: #444 !important;
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3) !important;
                    }

                    body.dark-mode .poll--widget .title h3.h4,
                    body.dark-mode .poll--widget .options .radio label,
                    body.dark-mode .poll--widget .options .radio span,
                    body.dark-mode .poll--widget .options .radio p .percent-text {
                        color: #ffffff !important;
                    }

                    body.dark-mode .poll--widget .options .radio {
                        background-color: #3a3a3a !important;
                        border-color: transparent !important;
                    }

                    body.dark-mode .poll--widget .options .radio:hover {
                        background-color: #444 !important;
                        border-color: var(--primary-color, #007bff) !important;
                    }

                    body.dark-mode .poll--widget .options .radio p span.progress-bar {
                        background: linear-gradient(90deg, #007bff, #0056b3) !important;
                    }



                    /* === TAGS WIDGET - COMPACT & FLEXIBLE === */
                    .tags--widget {
                        background-color: var(--widget-bg, #ffffff) !important;
                        border: 1px solid var(--widget-border, #e0e0e0) !important;
                        border-radius: 12px !important;
                        padding: 20px !important;
                        box-shadow: var(--widget-shadow, 0 4px 6px rgba(0, 0, 0, 0.05)) !important;
                        margin-bottom: 25px !important;
                    }

                    .tags--widget .widget--title {
                        border-bottom: 2px solid var(--primary-color, #007bff) !important;
                        padding-bottom: 12px !important;
                        margin-bottom: 15px !important;
                    }

                    .tags--widget .widget--title h2 {
                        color: var(--text-primary, #2c3e50) !important;
                        font-weight: 700 !important;
                        font-size: 1.2rem !important;
                        margin: 0 !important;
                    }

                    .tags--widget .widget--title i {
                        color: var(--primary-color, #007bff) !important;
                        font-size: 1.1rem !important;
                    }

                    .tags--widget .nav {
                        display: flex !important;
                        flex-wrap: wrap !important;
                        gap: 6px !important;
                        align-items: center !important;
                        justify-content: flex-start !important;
                    }

                    .tags--widget .nav li {
                        margin: 0 !important;
                        flex-shrink: 0 !important;
                    }

                    .tags--widget .nav li a {
                        background: linear-gradient(135deg, var(--tag-bg, #f8f9fa), var(--tag-bg-dark, #e9ecef)) !important;
                        color: var(--text-primary, #2c3e50) !important;
                        padding: 6px 12px !important;
                        border-radius: 16px !important;
                        border: 1px solid var(--tag-border, #e0e0e0) !important;
                        font-size: 11px !important;
                        font-weight: 600 !important;
                        transition: all 0.3s ease !important;
                        display: inline-flex !important;
                        align-items: center !important;
                        gap: 5px !important;
                        line-height: 1 !important;
                        text-decoration: none !important;
                        white-space: nowrap !important;
                    }

                    .tags--widget .nav li a:hover {
                        background: linear-gradient(135deg, var(--primary-color, #007bff), var(--primary-dark, #0056b3)) !important;
                        color: #ffffff !important;
                        border-color: var(--primary-color, #007bff) !important;
                        transform: translateY(-1px) !important;
                        box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3) !important;
                    }

                    .tags--widget .nav li a span {
                        background: var(--primary-color, #007bff) !important;
                        color: #ffffff !important;
                        padding: 2px 6px !important;
                        border-radius: 8px !important;
                        font-size: 9px !important;
                        font-weight: 700 !important;
                        min-width: 20px !important;
                        text-align: center !important;
                        line-height: 1 !important;
                    }

                    .tags--widget .nav li a:hover span {
                        background: #ffffff !important;
                        color: var(--primary-color, #007bff) !important;
                    }

                    /* === MORE COMPACT VERSION (Even Smaller) === */
                    /* If you want even smaller tags, use this instead: */
                    .tags--widget.compact .nav li a {
                        padding: 4px 10px !important;
                        font-size: 10px !important;
                        border-radius: 12px !important;
                    }

                    .tags--widget.compact .nav li a span {
                        padding: 1px 4px !important;
                        font-size: 8px !important;
                        min-width: 16px !important;
                    }

                    /* === RESPONSIVE TAGS === */
                    @media (max-width: 768px) {
                        .tags--widget {
                            padding: 15px !important;
                        }

                        .tags--widget .nav {
                            gap: 5px !important;
                        }

                        .tags--widget .nav li a {
                            padding: 5px 10px !important;
                            font-size: 10px !important;
                        }

                        .tags--widget .nav li a span {
                            padding: 1px 5px !important;
                            font-size: 8px !important;
                        }
                    }

                    /* Update CSS Variables for tags */
                    :root {
                        --tag-bg: #f8f9fa;
                        --tag-bg-dark: #e9ecef;
                        --tag-border: #e0e0e0;
                    }

                    body.dark-mode {
                        --tag-bg: #3a3a3a;
                        --tag-bg-dark: #444;
                        --tag-border: #555;
                    }

                    /* === CSS VARIABLES FOR LIGHT MODE === */
                    :root {
                        --widget-bg: #ffffff;
                        --widget-border: #e0e0e0;
                        --widget-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
                        --widget-shadow-hover: 0 8px 15px rgba(0, 0, 0, 0.1);
                        --text-primary: #2c3e50;
                        --text-muted: #6c757d;
                        --primary-color: #007bff;
                        --primary-dark: #0056b3;
                        --border-color: #f0f0f0;
                        --hover-bg: #f8f9fa;
                        --header-bg: #f8f9fa;
                        --input-bg: #ffffff;
                        --input-border: #ddd;
                        --card-bg: #f8f9fa;
                        --tag-bg: #f8f9fa;
                        --tag-bg-dark: #e9ecef;
                    }

                    /* === CSS VARIABLES FOR DARK MODE === */
                    body.dark-mode {
                        --widget-bg: #2d2d2d;
                        --widget-border: #444;
                        --widget-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
                        --widget-shadow-hover: 0 8px 15px rgba(0, 0, 0, 0.3);
                        --text-primary: #ffffff;
                        --text-muted: #cccccc;
                        --primary-color: #007bff;
                        --primary-dark: #0056b3;
                        --border-color: #444;
                        --hover-bg: #3a3a3a;
                        --header-bg: #3a3a3a;
                        --input-bg: #2d2d2d;
                        --input-border: #666;
                        --card-bg: #3a3a3a;
                        --tag-bg: #3a3a3a;
                        --tag-bg-dark: #444;
                    }

                    /* === ENSURE DARK MODE TEXT CONTRAST === */
                    body.dark-mode .main--content *:not(.main--sidebar *) {
                        color: #ffffff !important;
                    }

                    /* === RESPONSIVE DESIGN === */
                    @media (max-width: 768px) {

                        .list--widget,
                        .calendar-box,
                        .poll--widget,
                        .tags--widget {
                            margin: 10px 0 !important;
                            padding: 15px !important;
                        }

                        .calendar-header {
                            flex-direction: column !important;
                            gap: 10px !important;
                        }

                        .tags--widget .nav {
                            gap: 8px !important;
                        }

                        .tags--widget .nav li a {
                            padding: 8px 15px !important;
                            font-size: 13px !important;
                        }
                    }

                    /* === SMOOTH TRANSITIONS === */
                    .list--widget,
                    .calendar-box,
                    .poll--widget,
                    .tags--widget,
                    .list--widget .post--item,
                    .poll--widget .options .radio,
                    .tags--widget .nav li a,
                    .calendar-dates div {
                        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                    }

                    /* Responsive */
                    @media (max-width: 767px) {
                        .ads {
                            display: none;
                        }

                        .logo-ads-row {
                            justify-content: space-between;
                            flex-wrap: nowrap;
                            /* keep in one row */
                        }

                        .logo img {
                            height: 40px;
                            /* smaller height for mobile */
                            width: auto;
                            /* keep aspect ratio */
                        }

                        .button-row {
                            flex: 0 0 auto;
                            display: flex;
                            gap: 6px;
                        }

                        .button-row a,
                        .button-row button {
                            font-size: 13px;
                            padding: 3px 6px;
                        }

                    }
                </style>

                <script>
                    const toggleBtn = document.getElementById('theme-toggle');
                    const body = document.body;
                    const iconMoon = document.getElementById('icon-moon');
                    const iconSun = document.getElementById('icon-sun');

                    // Load saved theme
                    if (localStorage.getItem('dark-mode') === 'true') {
                        body.classList.add('dark-mode');
                        iconMoon.classList.add('hidden');
                        iconSun.classList.remove('hidden');
                    }

                    toggleBtn.addEventListener('click', () => {
                        body.classList.toggle('dark-mode');
                        const isDark = body.classList.contains('dark-mode');
                        localStorage.setItem('dark-mode', isDark);
                        iconMoon.classList.toggle('hidden');
                        iconSun.classList.toggle('hidden');
                    });
                </script>
            </div>





            <div class="header--navbar style--1 navbar bd--color-1 bg--color-1" data-trigger="sticky">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#headerNav" aria-expanded="false" aria-controls="headerNav">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span> <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>


                    <div id="headerNav" class="navbar-collapse collapse float--left">
                        <ul style="font-size: 14.5px !important;" class="header--menu-links nav navbar-nav"
                            data-trigger="hoverIntent">

                            @php
                                $lang = session()->get('lang');
                                $limit = $lang == 'bangla' ? 10 : 8;

                                // force limit before collection
                                $categories = $categories->take($limit + $categories->count());

                                $mainCategories = $categories->take($limit);
                                $moreCategories = $categories->slice($limit);
                                $allCategories = $categories;
                            @endphp


                            {{-- Main Categories --}}
                            @foreach ($mainCategories as $category)
                                @php
                                    $sub_cates = DB::table('sub_categories')
                                        ->where('category_id', $category->id)
                                        ->where('status', 1)
                                        ->get();
                                @endphp
                                <li class="dropdown @if (request()->is('news/' . $category->slug)) active @endif">
                                    <a href="{{ route('getCate.news', $category->slug) }}"
                                        class="dropdown-toggle category-link">
                                        {{ $lang == 'english' ? $category->category_en : $category->category_bn }}
                                        @if ($sub_cates->count())
                                            <i class="fa flm fa-angle-down"></i>
                                        @endif
                                    </a>

                                    {{-- Subcategories dropdown --}}
                                    @if ($sub_cates->count())
                                        <ul class="dropdown-menu fast-menu">
                                            @foreach ($sub_cates as $sub_cate)
                                                <li
                                                    class="{{ request()->is('news/' . $category->slug . '/' . $sub_cate->slug) ? 'active' : '' }}">
                                                    <a
                                                        href="{{ route('news.sub_cates', ['category' => trim($category->slug), 'subcategory' => trim($sub_cate->slug)]) }}">
                                                        {{ $lang == 'english' ? $sub_cate->sub_cate_en : $sub_cate->sub_cate_bn }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach

                            {{-- Desktop: Mega Menu for remaining categories --}}
                            @if ($moreCategories->count())
                                <li class="dropdown megamenu desktop-only">
                                    <a href="#" class="dropdown-toggle category-link" data-toggle="dropdown">
                                        {{ $lang == 'english' ? 'More' : 'আরও' }} <i class="fa flm fa-angle-down"></i>
                                    </a>

                                    <div class="dropdown-menu mega-menu">
                                        <div class="container-fluid">
                                            <div class="row">
                                                @foreach ($moreCategories as $category)
                                                    @php
                                                        $sub_cates = DB::table('sub_categories')
                                                            ->where('category_id', $category->id)
                                                            ->where('status', 1)
                                                            ->get();
                                                    @endphp
                                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                                        <div class="mega-menu-category">
                                                            <h5 class="mega-menu-title">
                                                                <a href="{{ route('getCate.news', $category->slug) }}"
                                                                    class="category-main-link">
                                                                    <i class="fa fa-folder-o mr-2"></i>
                                                                    {{ $lang == 'english' ? $category->category_en : $category->category_bn }}
                                                                </a>
                                                            </h5>

                                                            @if ($sub_cates->count())
                                                                <ul class="mega-submenu-list">
                                                                    @foreach ($sub_cates as $sub_cate)
                                                                        <li class="mega-submenu-item">
                                                                            <a class="mega-submenu-link"
                                                                                href="{{ route('news.sub_cates', ['category' => trim($category->slug), 'subcategory' => trim($sub_cate->slug)]) }}">
                                                                                <i class="fa fa-angle-right mr-2"></i>
                                                                                {{ $lang == 'english' ? $sub_cate->sub_cate_en : $sub_cate->sub_cate_bn }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif

                            {{-- Mobile: Show remaining categories as simple dropdown items --}}
                            @if ($moreCategories->count())
                                @foreach ($moreCategories as $category)
                                    @php
                                        $sub_cates = DB::table('sub_categories')
                                            ->where('category_id', $category->id)
                                            ->where('status', 1)
                                            ->get();
                                    @endphp
                                    <li class="dropdown mobile-only @if (request()->is('news/' . $category->slug)) active @endif">
                                        <a href="{{ route('getCate.news', $category->slug) }}"
                                            class="dropdown-toggle category-link">
                                            {{ $lang == 'english' ? $category->category_en : $category->category_bn }}
                                            @if ($sub_cates->count())
                                                <i class="fa flm fa-angle-down"></i>
                                            @endif
                                        </a>

                                        {{-- Subcategories dropdown --}}
                                        @if ($sub_cates->count())
                                            <ul class="dropdown-menu fast-menu">
                                                @foreach ($sub_cates as $sub_cate)
                                                    <li
                                                        class="{{ request()->is('news/' . $category->slug . '/' . $sub_cate->slug) ? 'active' : '' }}">
                                                        <a
                                                            href="{{ route('news.sub_cates', ['category' => trim($category->slug), 'subcategory' => trim($sub_cate->slug)]) }}">
                                                            {{ $lang == 'english' ? $sub_cate->sub_cate_en : $sub_cate->sub_cate_bn }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            @endif

                            <style>
                                /* Hide mobile-only items on desktop */
                                @media (min-width: 992px) {
                                    .mobile-only {
                                        display: none !important;
                                    }
                                }

                                /* Hide desktop-only items on mobile */
                                @media (max-width: 991px) {
                                    .desktop-only {
                                        display: none !important;
                                    }
                                }

                                /* Mega menu wrapper */
                                .megamenu {
                                    position: relative;
                                    /* parent কে reference করা হবে */
                                }

                                .mega-menu {
                                    position: absolute;
                                    top: 100%;
                                    left: 0;
                                    /* এখন parent item (Sports) থেকে শুরু হবে */
                                    width: 1000px;
                                    /* তোমার পছন্দমতো fixed width */
                                    max-width: 100vw;
                                    /* screen overflow ঠেকাতে */
                                    display: none;
                                    padding: 30px;
                                    background: #ffffff;
                                    z-index: 9999;
                                    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
                                    border-top: 3px solid #e74c3c;
                                    border-radius: 0 0 10px 10px;
                                    animation: fadeInDown 0.3s ease;
                                }

                                /* Show on hover */
                                .megamenu:hover .mega-menu {
                                    display: block !important;
                                }

                                /* Flexbox layout for categories */
                                .mega-menu .row {
                                    display: flex;
                                    flex-wrap: wrap;
                                    gap: 20px;
                                    /* কলাম গ্যাপ */
                                }

                                /* Each category column */
                                .mega-menu-category {
                                    flex: 1 1 22%;
                                    /* 4 কলাম desktop */
                                    min-width: 200px;
                                    background: #fff;
                                    padding: 15px 20px;
                                    border-radius: 8px;
                                    transition: all 0.3s ease;
                                }

                                .mega-menu-category:hover {
                                    background: #f8f9fa;
                                    transform: translateY(-3px);
                                }

                                /* Category title */
                                .mega-menu-title {
                                    margin-bottom: 12px;
                                    border-bottom: 2px solid #f0f0f0;
                                    padding-bottom: 8px;
                                }

                                .mega-menu-title a.category-main-link {
                                    color: #2c3e50 !important;
                                    font-weight: 600;
                                    font-size: 16px;
                                    text-decoration: none;
                                    display: flex;
                                    align-items: center;
                                    gap: 6px;
                                    transition: all 0.3s ease;
                                }

                                .mega-menu-title a.category-main-link:hover {
                                    color: #e74c3c !important;
                                    transform: translateX(5px);
                                }

                                /* Submenu */
                                .mega-submenu-list {
                                    list-style: none;
                                    margin: 0;
                                    padding: 0;
                                }

                                .mega-submenu-item {
                                    margin-bottom: 6px;
                                }

                                .mega-submenu-link {
                                    font-size: 14px;
                                    color: #5a6c7d !important;
                                    text-decoration: none;
                                    display: block;
                                    padding: 5px 0 5px 12px;
                                    border-left: 3px solid transparent;
                                    transition: all 0.3s ease;
                                }

                                .mega-submenu-link:hover {
                                    color: #e74c3c !important;
                                    background: #f9f9f9;
                                    border-left: 3px solid #e74c3c;
                                    padding-left: 16px;
                                }

                                /* Responsive */
                                @media (max-width: 991px) {
                                    .mega-menu {
                                        position: static !important;
                                        padding: 20px 15px;
                                        box-shadow: none;
                                        border: 1px solid #ddd;
                                    }

                                    .mega-menu .row {
                                        flex-direction: column;
                                    }

                                    .mega-menu-category {
                                        flex: 1 1 100%;
                                        min-width: auto;
                                    }
                                }

                                .navbar-nav {
                                    position: static;
                                }

                                .navbar-collapse {
                                    overflow: visible !important;
                                }
                            </style>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const megaMenu = document.querySelector('.megamenu');
                                    const megaDropdown = document.querySelector('.mega-menu');

                                    if (megaMenu && megaDropdown) {
                                        let menuTimeout;

                                        megaMenu.addEventListener('mouseenter', function() {
                                            clearTimeout(menuTimeout);
                                            megaDropdown.style.display = 'block';
                                        });

                                        megaMenu.addEventListener('mouseleave', function(e) {
                                            menuTimeout = setTimeout(function() {
                                                if (!megaDropdown.matches(':hover')) {
                                                    megaDropdown.style.display = 'none';
                                                }
                                            }, 200);
                                        });

                                        megaDropdown.addEventListener('mouseenter', function() {
                                            clearTimeout(menuTimeout);
                                            this.style.display = 'block';
                                        });

                                        megaDropdown.addEventListener('mouseleave', function() {
                                            menuTimeout = setTimeout(function() {
                                                this.style.display = 'none';
                                            }.bind(this), 200);
                                        });
                                    }
                                });
                            </script>

                        </ul>
                    </div>


                    <form action="javascript:void(0)" class="header--search-form float--right" id="openSearch">
                        <button type="submit" class="header--search-btn btn">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>

                    <div class="search-megamenu" id="searchMegaMenu">
                        <div class="container">
                            <div class="search-box">
                                <input type="text" placeholder="খুঁজুন..." id="searchInput" />
                                <div class="btn-group">
                                    <button type="button" class="btn btn-search"><i
                                            class="fa fa-search"></i></button>
                                    <button type="button" class="btn btn-close" id="closeSearch"><i
                                            class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const openSearchBtn = document.querySelector("#openSearch .header--search-btn");
                            const searchMegaMenu = document.getElementById("searchMegaMenu");
                            const closeSearch = document.getElementById("closeSearch");
                            const searchInput = document.getElementById("searchInput");

                            // Select all mega menus
                            const megaMenus = document.querySelectorAll(".megamenu");

                            // Store original hover events if needed
                            megaMenus.forEach(menu => {
                                menu.originalPointerEvents = menu.style.pointerEvents || "";
                            });

                            // Function to toggle mega menu hover
                            function toggleMegaMenuHover(disable) {
                                megaMenus.forEach(menu => {
                                    if (disable) {
                                        menu.style.pointerEvents = "none"; // disables hover interaction
                                    } else {
                                        menu.style.pointerEvents = menu.originalPointerEvents || "auto";
                                    }
                                });
                            }

                            // Open search
                            openSearchBtn.addEventListener("click", function() {
                                searchMegaMenu.classList.add("active");
                                toggleMegaMenuHover(true);
                                setTimeout(() => searchInput.focus(), 200);
                            });

                            // Close search function
                            function closeSearchMenu() {
                                searchMegaMenu.classList.remove("active");
                                toggleMegaMenuHover(false);
                            }

                            // Close search on button click
                            closeSearch.addEventListener("click", closeSearchMenu);

                            // Close search on click outside
                            document.addEventListener("click", function(e) {
                                if (!searchMegaMenu.contains(e.target) && !openSearchBtn.contains(e.target)) {
                                    closeSearchMenu();
                                }
                            });
                        });
                    </script>



                    <style>
                        /* Mega menu search wrapper */
                        .search-megamenu {
                            position: absolute;
                            top: 100%;
                            left: 0;
                            width: 100%;
                            background: #fff;
                            padding: 20px 0;
                            border-top: 2px solid #3498db;
                            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                            display: none;
                            z-index: 9999;
                        }

                        .search-megamenu.active {
                            display: block;
                            animation: fadeInDown 0.3s ease;
                        }

                        /* Container */
                        .search-megamenu .container {
                            max-width: 1140px;
                            margin: 0 auto;
                            padding: 0 20px;
                        }

                        /* Search box */
                        .search-box {
                            display: flex;
                            align-items: center;
                            background: #f9f9f9;
                            border: 1px solid #ddd;
                            border-radius: 50px;
                            padding: 8px 12px;
                        }

                        .search-box input {
                            flex: 1;
                            border: none;
                            background: transparent;
                            font-size: 16px;
                            padding: 10px;
                            outline: none;
                            color: #333;
                        }

                        .search-box input::placeholder {
                            color: #999;
                            opacity: 1;
                        }

                        .btn-group {
                            display: flex;
                            gap: 8px;
                        }

                        .btn {
                            border: none;
                            border-radius: 50%;
                            padding: 12px 14px;
                            font-size: 16px;
                            cursor: pointer;
                            transition: all 0.3s ease;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                        }

                        /* Search button */
                        .btn-search {
                            background: linear-gradient(135deg, #3498db, #2980b9);
                            color: #fff;
                        }

                        .btn-search:hover {
                            background: linear-gradient(135deg, #2980b9, #1f6391);
                            transform: scale(1.05);
                        }

                        /* Close button */
                        .btn-close {
                            background: linear-gradient(135deg, #e74c3c, #c0392b);
                            color: #fff;
                        }

                        .btn-close:hover {
                            background: linear-gradient(135deg, #c0392b, #962d22);
                            transform: scale(1.05);
                        }

                        /* Animation */
                        @keyframes fadeInDown {
                            from {
                                opacity: 0;
                                transform: translateY(-10px);
                            }

                            to {
                                opacity: 1;
                                transform: translateY(0);
                            }
                        }

                        /* Responsive */
                        @media (max-width: 768px) {
                            .search-box {
                                flex-direction: row;
                                /* ✅ keep input + buttons side by side */
                                border-radius: 50px;
                                /* same as desktop */
                                padding: 8px 12px;
                                /* tighter padding for small screens */
                            }

                            .search-box input {
                                flex: 1;
                                /* take available space */
                                margin-bottom: 0;
                                /* remove mobile-only margin */
                                font-size: 14px;
                                /* slightly smaller text */
                            }

                            .btn-group {
                                gap: 6px;
                                /* reduce button spacing */
                            }

                            .btn {
                                padding: 10px 12px;
                                /* smaller buttons */
                                font-size: 14px;
                            }
                        }


                        /* Custom CSS to override the search button styles */
                        #openSearch .header--search-btn {
                            padding: 0;
                            border-radius: 0;
                            box-shadow: none;
                            background: transparent !important;
                            color: #3498db;
                            /* Match the search bar color */
                        }

                        #openSearch .header--search-btn:hover {
                            background: transparent !important;
                            transform: scale(1.1);
                            /* Subtle hover effect */
                        }

                        #openSearch .header--search-btn i {
                            font-size: 24px;
                            /* Make the icon bigger */
                        }
                    </style>



                </div>
            </div>

    </div>
    </header>
    <div class="main-content--section">
        @yield('content')
    </div>
    <!-- Full-width border -->
    <div style="border-top: 1px solid #727272; border-bottom: 1px solid #727272; width: 100%; margin: 20px 0;">

        <div style="padding: 5px 0; display: flex; justify-content: center;">

            @foreach ($getCates as $row)
                <div style="margin: 0 15px; font-size: 16px; font-weight: bold;">
                    <a href="{{ route('getCate.news', $row->slug) }}" class="catehover">
                        @if (session()->get('lang') == 'english')
                            {{ $row->category_en }}
                        @else
                            {{ $row->category_bn }}
                        @endif
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <footer class="footer--section">
        <div class="footer--widgets pd--30-0 bg--color-2">
            <div class="container">
                <div class="row AdjustRow">
                    <div class="col-md-4 col-xs-6 col-xxs-12 ptop--30 pbottom--30">
                        <div style="width: 100%; padding: 20px 0;">

                            <!-- Logo -->
                            <div style="margin-bottom: 15px;">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset($logo) }}" alt="{{ config('app.name') }}"
                                        style="max-height: 150px;">
                                </a>
                            </div>

                            <!-- About Us -->
                            <div style="margin-bottom: 15px;">
                                @if (session('lang') != 'english')
                                    <p>{!! $footer_details['about_us_bangla'] ?? 'বাংলা তথ্য পাওয়া যায়নি' !!}</p>
                                @else
                                    <p>{!! $footer_details['about_us'] ?? 'About us text not available' !!}</p>
                                @endif
                            </div>

                            <!-- Bottom Links -->
                            <div style="margin-bottom: 10px; text-align: center;">
                                <a style="color: #fff;" href="#">Privacy Policy</a> |
                                <a style="color: #fff;" href="#">Terms of Use</a> |
                                <a style="color: #fff;" href="#">Advertisement</a>
                            </div>

                        </div>



                    </div>
                    <div class="col-md-5 col-xs-6 col-xxs-12 ptop--30 pbottom--30">
                        <div class="widget">
                            <div class="about--widget">
                                {{-- <div class="content">
                                        <p>
                                            {{ $footer_details['about_us'] ?? 'About us text not available' }}
                                        </p>
                                    </div> --}}

                                <ul class="nav" style="text-decoration: none">
                                    <li>
                                        @if (session('lang') != 'english')
                                            <span style="font-size: 24px !important">
                                                {!! $footer_details['editor_details_bangla'] ?? 'বাংলা সম্পাদক তথ্য নেই' !!}</span>
                                        @else
                                            <span style="font-size: 24px !important">Chief Editor :
                                                {!! $footer_details['editor_details'] ?? 'Editor not available' !!}</span>
                                        @endif
                                    </li>

                                    <li style="font-size: 15.6px !important; margin-top: 20px">
                                        @if (session('lang') != 'english')
                                            <span>{!! $footer_details['address_bangla'] ?? 'বাংলা ঠিকানা নেই' !!}</span>
                                        @else
                                            <span>{!! $footer_details['address'] ?? 'Address not available' !!}</span>
                                        @endif
                                    </li>

                                    <li style="font-size: 15.6px !important; margin-top: -20px">

                                        @if (session('lang') != 'english')
                                            ইমেইল : <a href="mailto:{{ $footer_details['email'] }}">
                                                {{ $footer_details['email'] }}</a>
                                        @else
                                            Email : <a href="mailto:{{ $footer_details['email'] }}">
                                                {{ $footer_details['email'] }}</a>
                                        @endif
                                    </li>

                                    <li style="font-size: 15.6px !important; margin-top: 15px">
                                        <i class="fa fa-phone"></i>
                                        @if (!empty($footer_details['phone']))
                                            <a href="tel:{{ $footer_details['phone'] }}">
                                                {{ $footer_details['phone'] }}
                                            </a>
                                        @else
                                            <span>+123 456 789</span>
                                        @endif
                                    </li>
                                </ul>
                            </div>


                        </div>
                    </div>
                    <div class="col-md-3 col-xs-6 col-xxs-12 ptop--30 pbottom--30">
                        <div class="widget">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer--copyright bg--color-3">
            <div class="social--bg bg--color-1"></div>
            <div class="container">
                <p class="text float--left">
                    &copy; {{ date('Y') }} <a href="#">USNEWS</a>. All Rights Reserved.
                </p>
                <ul class="nav social float--right">
                    <li>
                        <a href="{{ $social->facebook }}">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ $social->twitter }}">
                            <!-- Then use -->
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ $social->instagram }}">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ $social->youtube }}">
                            <i class="fa-brands fa-youtube"></i>

                        </a>
                    </li>
                    <li>
                        <a href="{{ $social->linkedin }}">
                            <i class="fa-brands fa-linkedin"></i>
                        </a>
                    </li>
                </ul>
                <ul class="nav links float--right">
                    <li><a href="#">Home</a></li>
                    {{-- <li><a href="#">FAQ</a></li>
                        <li><a href="#">Support</a></li> --}}
                </ul>
            </div>
        </div>
    </footer>
    </div>

    <div id="backToTop">
        <a href="#"><i class="fa fa-angle-double-up"></i></a>
    </div>

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0">
    </script>

    <script src="https://bangla.plus/scripts/bangladatetoday.min.js"></script>
    <script>
        dateToday('date-today', 'bangla');
    </script>
    {{-- <script src="{{ asset('frontend_assets') }}/js/jquery-3.2.1.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script src="{{ asset('frontend_assets') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/jquery.sticky.min.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/jquery.hoverIntent.min.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/jquery.marquee.min.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/jquery.validate.min.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/isotope.min.js"></script>
    {{-- <script src="{{ asset('frontend_assets') }}/js/resizesensor.min.js"></script> --}}
    <script src="{{ asset('frontend_assets') }}/js/theia-sticky-sidebar.min.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/jquery.zoom.min.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/jquery.barrating.min.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/jquery.countdown.min.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/retina.min.js"></script>
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBK9f7sXWmqQ1E-ufRXV3VpXOn_ifKsDuc"></script> --}}
    {{-- <script src="{{ asset('frontend_assets') }}/js/color-switcher.min.js"></script> --}}
    <script src="{{ asset('frontend_assets') }}/js/main.js"></script>

    <!-- Splide JS -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>


    {{-- For user location Detect --}}

    <script type="text/javascript">
        // Initialize the map

        function initMap() {
            var banglaLocation = {
                lat: 23.8103,
                lng: 90.4125
            }; // Example coordinates for Dhaka
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10,
                center: banglaLocation
            });

            // Add a marker with a Bengali label
            var marker = new google.maps.Marker({
                position: banglaLocation,
                map: map,
                title: "ঢাকা", // Bengali name
                label: "ড" // Bengali label
            });
        }
    </script>

    {{-- For Dark Mode --}}
    <script></script>

    <!-- Fancybox JS -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
</body>

</html>
