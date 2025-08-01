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

    {{-- For Seo with dynamic name End  --}}


    <title>USNews - Multipurpose News, Magazine and Blog HTML5 Template</title>

    <meta name="author" content="ThemeLooks" />
    <meta name="description" content="USNews - Multipurpose News and Magazine Template" />
    <meta name="keywords"
        content="news, newspaper, magazine, blog, post, article, editorial, publishing, modern, responsive, html5, template" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="favicon.png" type="image/png" />
    <link rel="stylesheet" href="{{ asset('frontend_assets') }}/css?family=Source+Sans+Pro:400,600,700" />
    <link rel="stylesheet" href="{{ asset('frontend_assets') }}/css/font-awesome.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend_assets') }}/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend_assets') }}/css/fontawesome-stars-o.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend_assets') }}/css/style.css" />
    <link rel="stylesheet" href="{{ asset('frontend_assets') }}/css/responsive-style.css" />
    <link rel="stylesheet" href="{{ asset('frontend_assets') }}/css/colors/theme-color-1.css" id="changeColorScheme" />
    <link rel="stylesheet" href="{{ asset('frontend_assets') }}/css/custom.css" />

    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />



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
    </style>

</head>

<body>
    <div class="wrapper">
        <header class="header--section header--style-1">
            <div class="header--topbar bg--color-2">
                <div class="container">
                    <div class="float--left float--xs-none text-xs-center">
                        <ul class="header--topbar-info nav">
                            <li><i class="fa fm fa-map-marker"></i>{{ $position }}</li>
                            <li>
                                <i class="fa fm fa-calendar"></i>Today (Sunday 19 April 2017)
                            </li>
                            <li><i class="fa fm fa-mixcloud"></i><span id="date-today"></span></li>
                        </ul>
                    </div>
                    <div class="float--right float--xs-none text-xs-center">
                        <ul class="header--topbar-social nav hidden-sm hidden-xxs">
                            <li>
                                <a href="{{ $social->facebook }}">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $social->twitter }}">
                                    <i class="fa-brands fa-x-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $social->instagram }}">
                                    <i class="fa fa-instagram"></i>

                                </a>
                            </li>
                            <li>
                                <a href="{{ $social->youtube }}">
                                    <i class="fa fa-youtube-play"></i>

                                </a>
                            </li>
                            <li>
                                <a href="{{ $social->linkedin }}">
                                    <i class="fa fa-linkedin"></i>
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
                                        <img src="{{ asset('frontend_assets') }}/img/logo.png" alt="USNews Logo" />
                                        <span class="hidden">USNews Logo</span>
                                    </a>
                                </h1>
                            </div>
                            <div class="col-lg-8 col-md-6 col-sm-12">
                                <a href="#">
                                    <img src="{{ asset('frontend_assets') }}/img/ads-img/ad-728x90-01.jpg"
                                        alt="Advertisement" class="img-fluid" />
                                    <!-- Added img-fluid for better responsiveness -->
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-3">
                            <div class="col-12 col-md-12 col-sm-12 m-0 p-0">
                                <!-- Added d-flex align-items-center for the button container -->
                                <div
                                    style="display: flex !important; justify-content: space-around !important; align-items: center !important;">

                                    @if (DB::table('live_tvs')->where('status', 1)->first())
                                        @if (session()->get('lang') == 'bangla')
                                            <a href="{{ route('live.tv') }}" class="pulse" style="font-size: 12px">লাইভ টিভি</a>
                                        @else
                                            <a href="{{ route('live.tv') }}" class="pulse">Live Tv</a>
                                        @endif
                                    @endif
                                    <a href="{{ route('video.gallery') }}"><abbr style="border: none; cursor: pointer; font-size: 20px;"
                                            title="Video Gallery"><i class="fa fa-video-camera text-primary"
                                                aria-hidden="true"></abbr></i></a>
                                    @if (session()->get('lang') == 'bangla')
                                        <a href="{{ route('news.english') }}"style="padding: 2px 6px !important; border-radius: 2px; font-size: 14px; "
                                            id="banglaToEnglish" class="bg-primary">English</a>
                                    @else
                                        <a href="{{ route('news.bangla') }}"style="padding: 2px 6px !important; border-radius: 2px; font-size: 14px; "
                                            id="banglaToEnglish" class="bg-primary">বাংলা</a>
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
                                    <li class="dropdown @if (request()->is('category/' . $category->category_en)) active @endif">
                                        <a href="{{ route('news.cates', session()->get('lang') == 'bangla' ? $category->category_bn : $category->category_en) }}"
                                            class="dropdown-toggle" data-toggle="dropdown">
                                            {{ session()->get('lang') == 'bangla' ? $category->category_bn : $category->category_en }}
                                            @if ($sub_cates->count())
                                                <i class="fa flm fa-angle-down"></i>
                                            @endif
                                        </a>

                                        @if ($sub_cates->count())
                                            <ul class="dropdown-menu">
                                                @foreach ($sub_cates as $sub_cate)
                                                    <li class="@if (request()->is('news/subcategories/' .  session()->get('lang') == 'bangla' ? $sub_cate->sub_cate_bn : $sub_cate->sub_cate_en)) active @endif">
                                                        <a
                                                            href="{{ route('news.sub_cates', session()->get('lang') == 'bangla' ? $sub_cate->sub_cate_bn : $sub_cate->sub_cate_en) }}">
                                                            {{ session()->get('lang') == 'bangla' ? $sub_cate->sub_cate_bn  : $sub_cate->sub_cate_en }}
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
        <div class="main-content--section pbottom--30">
            @yield('content')
        </div>
        <footer class="footer--section">
            <div class="footer--widgets pd--30-0 bg--color-2">
                <div class="container">
                    <div class="row AdjustRow">
                        <div class="col-md-3 col-xs-6 col-xxs-12 ptop--30 pbottom--30">
                            <div class="widget">
                                <div class="widget--title">
                                    <h2 class="h4">About Us</h2>
                                    <i class="icon fa fa-exclamation"></i>
                                </div>
                                <div class="about--widget">
                                    <div class="content">
                                        <p>
                                            At vero eos et accusamus et iusto odio dignissimos
                                            ducimus qui blanditiis praesentium laborum et dolorum
                                            fuga.
                                        </p>
                                    </div>
                                    <div class="action">
                                        <a href="#" class="btn-link">Read More<i
                                                class="fa flm fa-angle-double-right"></i></a>
                                    </div>
                                    <ul class="nav">
                                        <li>
                                            <i class="fa fa-map"></i>
                                            <span>143/C, Fake Street, Melborne, Australia</span>
                                        </li>
                                        <li>
                                            <i class="fa fa-envelope-o"></i>
                                            <a href="mailto:example@example.com">example@example.com</a>
                                        </li>
                                        <li>
                                            <i class="fa fa-phone"></i>
                                            <a href="tel:+123456789">+123 456 (789)</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-6 col-xxs-12 ptop--30 pbottom--30">
                            <div class="widget">
                                <div class="widget--title">
                                    <h2 class="h4">Usefull Info Links</h2>
                                    <i class="icon fa fa-expand"></i>
                                </div>
                                <div class="links--widget">
                                    <ul class="nav">
                                        <li><a href="#" class="fa-angle-right">Gadgets</a></li>
                                        <li><a href="#" class="fa-angle-right">Shop</a></li>
                                        <li>
                                            <a href="#" class="fa-angle-right">Term and Conditions</a>
                                        </li>
                                        <li><a href="#" class="fa-angle-right">Forums</a></li>
                                        <li>
                                            <a href="#" class="fa-angle-right">Top News of This Week</a>
                                        </li>
                                        <li>
                                            <a href="#" class="fa-angle-right">Special Recipes</a>
                                        </li>
                                        <li><a href="#" class="fa-angle-right">Sign Up</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-6 col-xxs-12 ptop--30 pbottom--30">
                            <div class="widget">
                                <div class="widget--title">
                                    <h2 class="h4">Advertisements</h2>
                                    <i class="icon fa fa-bullhorn"></i>
                                </div>
                                <div class="links--widget">
                                    <ul class="nav">
                                        <li>
                                            <a href="#" class="fa-angle-right">Post an Add</a>
                                        </li>
                                        <li><a href="#" class="fa-angle-right">Adds Renew</a></li>
                                        <li>
                                            <a href="#" class="fa-angle-right">Price of Advertisements</a>
                                        </li>
                                        <li>
                                            <a href="#" class="fa-angle-right">Adds Closed</a>
                                        </li>
                                        <li>
                                            <a href="#" class="fa-angle-right">Monthly or Yearly</a>
                                        </li>
                                        <li><a href="#" class="fa-angle-right">Trial Adds</a></li>
                                        <li><a href="#" class="fa-angle-right">Add Making</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-6 col-xxs-12 ptop--30 pbottom--30">
                            <div class="widget">
                                <div class="widget--title">
                                    <h2 class="h4">Career</h2>
                                    <i class="icon fa fa-user-o"></i>
                                </div>
                                <div class="links--widget">
                                    <ul class="nav">
                                        <li>
                                            <a href="#" class="fa-angle-right">Available Post</a>
                                        </li>
                                        <li>
                                            <a href="#" class="fa-angle-right">Career Details</a>
                                        </li>
                                        <li>
                                            <a href="#" class="fa-angle-right">How to Apply?</a>
                                        </li>
                                        <li>
                                            <a href="#" class="fa-angle-right">Freelence Job</a>
                                        </li>
                                        <li>
                                            <a href="#" class="fa-angle-right">Be a Member</a>
                                        </li>
                                        <li><a href="#" class="fa-angle-right">Apply Now</a></li>
                                        <li>
                                            <a href="#" class="fa-angle-right">Send Your Resume</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer--copyright bg--color-3">
                <div class="social--bg bg--color-1"></div>
                <div class="container">
                    <p class="text float--left">
                        &copy; 2017 <a href="#">USNEWS</a>. All Rights Reserved.
                    </p>
                    <ul class="nav social float--right">
                        <li>
                            <a href="#">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa-brands fa-x-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-instagram"></i>

                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-youtube-play"></i>

                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav links float--right">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Support</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
    <div id="stickySocial" class="sticky--right">
        <ul class="nav">
            <li>
                <a href="{{ $social->facebook }}">
                    <i class="fa fa-facebook"></i> <span>Follow Us On Facebook</span>
                </a>
            </li>
            <li>
                <a href="{{ $social->twitter }}">
                    <i class="fa-brands fa-x-twitter"></i> <span style="color: white; background-color: black"">Follow
                        Us On Twitter</span>
                </a>
            </li>
            <li>
                <a href="{{ $social->instagram }}">
                    <i class="fa fa-instagram"></i>
                    <span>Follow Us On Instagram</span>
                </a>
            </li>
            <li>
                <a href="{{ $social->youtube }}">
                    <i class="fa fa-youtube-play"></i>
                    <span>Follow Us On Youtube Play</span>
                </a>
            </li>
            <li>
                <a href="{{ $social->linkedin }}">
                    <i class="fa fa-linkedin"></i> <span>Follow Us On LinkedIn</span>
                </a>
            </li>
        </ul>
    </div>
    <div id="backToTop">
        <a href="#"><i class="fa fa-angle-double-up"></i></a>
    </div>
    <script src="https://bangla.plus/scripts/bangladatetoday.min.js"></script>
    <script>
        dateToday('date-today', 'bangla');
    </script>
    <script src="{{ asset('frontend_assets') }}/js/jquery-3.2.1.min.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/jquery.sticky.min.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/jquery.hoverIntent.min.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/jquery.marquee.min.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/jquery.validate.min.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/isotope.min.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/resizesensor.min.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/theia-sticky-sidebar.min.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/jquery.zoom.min.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/jquery.barrating.min.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/jquery.countdown.min.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/retina.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBK9f7sXWmqQ1E-ufRXV3VpXOn_ifKsDuc"></script>
    {{-- <script src="{{ asset('frontend_assets') }}/js/color-switcher.min.js"></script> --}}
    <script src="{{ asset('frontend_assets') }}/js/main.js"></script>

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
    </script>

    <!-- Fancybox JS -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</body>

</html>
