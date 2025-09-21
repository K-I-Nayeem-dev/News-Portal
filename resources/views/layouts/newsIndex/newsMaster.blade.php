<!DOCTYPE html>
<html dir="ltr"lang="bn">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    {{-- For Seo with dynamic name Start  --}}

    <meta name="meta_author" content="{{ $meta->meta_author }}" />
    <meta name="meta_title" content="{{ $meta->meta_title }}" />
    <meta name="meta_keyword" content="{{ $meta->meta_keyword }}" />
    <meta name="meta_description" content="{{ $meta->meta_description }}" />
    <meta name="google_analytics" content="{{ $meta->google_analytics }}" />
    <meta name="goolge_verificatoins" content="{{ $meta->goolge_verificatoins }}" />
    <meta name="alexa_analytics" content="{{ $meta->alexa_analytics }}" />
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




    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>



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
                                {{ session('lang') == 'english'
                                    ? \Carbon\Carbon::now()->setTimezone('Asia/Dhaka')->format('j F Y, g:i A')
                                    : formatBanglaDateTime(now()) }}

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
                    </div>
                </div>
            </div>
            <div style="margin-top: 10px !important;">
                <div class="container">
                    <div class="row"
                        style="margin-bottom: 10px !important; display: flex !important; align-items: center !important;">
                        <!-- Added align-items-center here -->
                        <div class="col-lg-9 col-9 ">
                            <div class="col-lg-4 col-md-6">
                                <h1 class="h1">
                                    <a href="{{ route('home') }}" class="btn-link">
                                        @if ($webSite_setting->logo)
                                            <img src="{{ asset($webSite_setting->logo) }}" alt="">
                                        @else
                                            <img src="{{ asset('frontend_assets') }}/img/logo.png" alt="USNews Logo" />
                                        @endif
                                        <span class="hidden">USNews Logo</span>
                                    </a>
                                </h1>
                            </div>
                            <div class="col-lg-8 col-md-6 col-sm-12">
                                <a href="{{ route('ads.trackClick', $ftp->id) }}" target="_blank">
                                    <img src="{{ $ftp && file_exists(public_path($ftp->image))
                                        ? asset($ftp->image)
                                        : asset('frontend_assets/img/ads-img/ad-728x90-01.jpg') }}"
                                        alt="{{ $ftp->title_en ?? 'Advertisement' }}" class="img-fluid" />
                                </a>

                            </div>
                        </div>
                        <div class="col-lg-3 col-3">
                            <div class="col-12 col-md-12 col-sm-12 m-0 p-0">
                                <!-- Added d-flex align-items-center for the button container -->
                                <div
                                    style="display: flex !important; justify-content: space-around !important; align-items: center !important;">

                                    @if (DB::table('live_tvs')->where('status', 1)->first())
                                        @if (session()->get('lang') == 'english')
                                            <a href="{{ route('live.tv') }}" class="pulse">Live Tv</a>
                                        @else
                                            <a href="{{ route('live.tv') }}" class="pulse"
                                                style="font-size: 12px">লাইভ টিভি</a>
                                        @endif
                                    @endif
                                    <a href="{{ route('video.gallery') }}"><abbr
                                            style="border: none; cursor: pointer; font-size: 20px;"
                                            title="Video Gallery"><i class="fa fa-video-camera text-primary"
                                                aria-hidden="true"></abbr></i></a>
                                    @if (session()->get('lang') == 'english')
                                        <a href="{{ route('news.bangla') }}"style="padding: 2px 6px !important; border-radius: 2px; font-size: 14px; "
                                            id="banglaToEnglish" class="bg-primary">বাংলা</a>
                                    @else
                                        <a href="{{ route('news.english') }}"style="padding: 2px 6px !important; border-radius: 2px; font-size: 14px; "
                                            id="banglaToEnglish" class="bg-primary">English</a>
                                    @endif
                                    <button id="theme-toggle" class="text-gray-500 dark:text-yellow-300">
                                        <span id="icon-moon" class="hidden">🌙</span>
                                        <span id="icon-sun" class="hidden">☀️</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                            <ul class="header--menu-links nav navbar-nav" data-trigger="hoverIntent">
                                @foreach ($categories as $category)
                                    @php
                                        $sub_cates = DB::table('sub_categories')
                                            ->where('category_id', $category->id)
                                            ->where('status', 1)
                                            ->get();
                                    @endphp
                                    <li class="dropdown @if (request()->is('news/' . $category->slug)) active @endif">
                                        <a href="{{ route('getCate.news', $category->slug) }}"
                                            class="dropdown-toggle category-link" data-toggle="dropdown">
                                            {{ session()->get('lang') == 'english' ? $category->category_en : $category->category_bn }}
                                            @if ($sub_cates->count())
                                                <i class="fa flm fa-angle-down"></i>
                                            @endif
                                        </a>

                                        @if ($sub_cates->count())
                                            <ul class="dropdown-menu">
                                                @foreach ($sub_cates as $sub_cate)
                                                    <li
                                                        class="{{ request()->is('news/' . $category->slug . '/' . $sub_cate->slug) ? 'active' : '' }}">
                                                        <a
                                                            href="{{ route('news.sub_cates', [
                                                                'category' => trim($category->slug),
                                                                'subcategory' => trim($sub_cate->slug),
                                                            ]) }}">
                                                            {{ session()->get('lang') == 'english' ? $sub_cate->sub_cate_en : $sub_cate->sub_cate_bn }}
                                                        </a>

                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <form action="#" class="header--search-form float--right" data-form="validate">
                            <input type="search" name="search" placeholder="Search..."
                                class="header--search-control form-control" required="" />
                            <button type="submit" class="header--search-btn btn">
                                <i class="header--search-icon fa fa-search"></i>
                            </button>
                        </form>
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
    <script>
        const html = document.documentElement;
        const themeToggle = document.getElementById('theme-toggle');
        const iconMoon = document.getElementById('icon-moon');
        const iconSun = document.getElementById('icon-sun');

        // Load current theme from localStorage
        const currentTheme = localStorage.getItem('color-theme');
        const systemPrefDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (currentTheme === 'dark' || (!currentTheme && systemPrefDark)) {
            html.classList.add('dark');
            iconSun.classList.remove('hidden');
        } else {
            html.classList.remove('dark');
            iconMoon.classList.remove('hidden');
        }

        // Toggle handler
        themeToggle.addEventListener('click', () => {
            iconSun.classList.toggle('hidden');
            iconMoon.classList.toggle('hidden');
            html.classList.toggle('dark');

            if (html.classList.contains('dark')) {
                localStorage.setItem('color-theme', 'dark');
            } else {
                localStorage.setItem('color-theme', 'light');
            }
        });

        // For Category Switch
        document.querySelectorAll('.category-link').forEach(function(link) {
            link.addEventListener('click', function(e) {
                window.location = this.getAttribute('href');
            });
        });
    </script>

    <!-- Fancybox JS -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
</body>

</html>
