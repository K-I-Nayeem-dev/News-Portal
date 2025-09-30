@extends('layouts.newsIndex.newsMaster')

@section('content')
    @php
        use Illuminate\Support\Str;

        $categorySlug = Str::slug($fsbt->newsCategory->category_en);
        $subcategorySlug = $fsbt->newsSubcategory ? Str::slug($fsbt->newsSubcategory->sub_cate_en) : null;

    @endphp

    {{-- Custom CSS Code section Start --}}
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif !important;
        }

        @media (max-width: 768px) {
            .splide__arrow {
                display: none !important;
            }
        }

        .calendar-box {
            border: 1px solid #ccc;
            text-align: center;
            width: 100%;
            max-width: 320px;
            font-family: 'Siyam Rupali', sans-serif;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid black;
        }

        .calendar-header {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 10px;
            padding-bottom: 20px;
        }

        .calendar-header select {
            padding: 4px 6px;
            font-size: 14px;
        }

        .calendar-days,
        .calendar-dates {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 6px;
            padding: 10px 15px;
        }

        .calendar-days div {
            font-weight: bold;
        }

        .calendar-dates div {
            padding: 6px;
            cursor: pointer;
            border-radius: 4px;
        }

        .calendar-dates div:hover,
        .calendar-dates .selected {
            background-color: #3498db;
            color: #fff;
        }

        .disabled {
            color: #ccc;
            pointer-events: none;
        }

        .splide__pagination {
            display: none;
        }

        .splide__arrow {
            -ms-flex-align: center;
            align-items: center;
            background: #ccc;
            border: 0;
            border-radius: 50%;
            cursor: pointer;
            display: -ms-flexbox;
            display: flex;
            height: 2em;
            -ms-flex-pack: center;
            justify-content: center;
            opacity: .7;
            padding: 0;
            position: absolute;
            top: 40%;
            transform: translateY(-50%);
            width: 2em;
            z-index: 1;
            left: 101.3%;
        }

        .splide__arrow--prev {
            left: -3em;
        }

        .gbt {
            width: 800px !important;
            height: 185px !important;
        }

        .responsive-iframe-container {
            position: relative;
            width: 100%;
            padding-bottom: 78.95%;
            /* (600 / 760) * 100 */
            height: 0;
            overflow: hidden;
        }

        .responsive-iframe-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }


        .play-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.6);
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
        }

        .video-wrapper {
            overflow: hidden;
        }

        .card-body {
            min-height: 70px;
            /* keeps all titles aligned */
        }

        .title-black:hover {
            color: red !important;
        }

        .video-wrapper3 img {
            width: 100%;
            height: auto;
            display: block;
        }

        .video-wrapper3 {
            position: relative;
            display: inline-block;
        }

        .play-overlay3 {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .video-wrapperg {
            position: relative;
            display: block;
            width: 100%;
            max-width: 100%;
        }

        .video-wrapperg img {
            display: block;
            width: 100%;
            height: auto;
        }

        .play-overlayg {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            justify-content: center;
            align-items: center;
            pointer-events: none;
        }

        .play-overlayg i.fa-play {
            font-size: 40px;
            color: white;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
        }

        .posthover {
            transition: transform 0.1s ease-in-out;
            cursor: pointer;
            display: inline-block;
            /* needed to scale properly */
        }

        .posthover:hover {
            transform: scale(1.05);
        }

        /* General container for select */
        .custom-select {
            position: relative;
            display: inline-block;
            width: 100%;
            max-width: 200px;
            /* optional */
        }
    </style>
    {{-- Custom CSS Code section End --}}


    {{-- Breaking News Section Start --}}
    <div>
        @if ($breaking_news->count() > 0)
            <div class="news--ticker">
                <div class="container">
                    <div class="title">
                        @if (session()->get('lang') == 'english')
                            <h2>Headline</h2>
                        @else
                            <h2>শিরোনাম</h2>
                        @endif
                        {{-- <span>(Update {{ \Carbon\Carbon::parse($time->created_at)->diffForHumans() }})</span> --}}
                    </div>
                    <div class="news-updates--list" data-marquee="true">
                        <ul class="nav">
                            @foreach ($breaking_news as $news)
                                <li>
                                    @if (session()->get('lang') == 'english')
                                        <h3 class="h3">
                                            <a target="_blank" {{ $news->url ? 'href=' . $news->url . ' ' : '' }}> **
                                                {{ $news->news_en }} ** </a>
                                        </h3>
                                    @else
                                        <h3 class="h3">
                                            <a target="_blank" {{ $news->url ? 'href=' . $news->url . ' ' : '' }}> **
                                                {{ $news->news_bn }} ** </a>
                                        </h3>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>
    {{-- Breaking News Section End --}}

    {{-- Notice Section Start --}}
    <div>
        @if ($notice)
            <div class="news--ticker">
                <div class="container">
                    <div class="title">
                        @if (session()->get('lang') == 'english')
                            <h2>Notice</h2>
                        @else
                            <h2>নোটিশ</h2>
                        @endif
                        {{-- <span>(Update {{ \Carbon\Carbon::parse($time->created_at)->diffForHumans() }})</span> --}}
                    </div>
                    <div class="news-updates--list" data-marquee="true">
                        <ul class="nav">
                            @if (session()->get('lang') == 'english')
                                <li>
                                    <h3 class="h3">
                                        <a> !!! {{ $notice->notice_en }} !!! </a>
                                    </h3>
                                </li>
                            @else
                                <li>
                                    <h3 class="h3">
                                        <a> !!! {{ $notice->notice_bn }} !!! </a>
                                    </h3>
                                </li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>
    {{-- Notice News Section End --}}

    <div class="container">

        <style>
            /* === Unique CSS for News Row Layout === */
            .kml-top-news {
                margin-top: 20px;
                /* 👈 শুধু পুরো Top News section এর উপরে space */
            }

            .kml-news-row {
                display: flex;
                align-items: flex-start;
                gap: 15px;
                width: 100%;
                box-sizing: border-box;
            }

            /* Columns */
            .kml-news-col {
                display: flex;
                flex-direction: column;
                gap: 15px;
                margin: 0;
                padding: 0;
            }

            /* Widths */
            .kml-col-left,
            .kml-col-right {
                flex: 1;
            }

            .kml-col-center {
                flex: 2;
            }

            /* Post */
            .kml-post {
                position: relative;
                width: 100%;
            }

            .kml-post img {
                width: 100%;
                height: auto;
                border-radius: 6px;
                display: block;
            }

            .kml-cat {
                position: absolute;
                top: 10px;
                left: 10px;
                background: #000;
                color: #fff;
                font-size: 12px;
                padding: 3px 6px;
                border-radius: 3px;
                text-decoration: none;
            }

            .kml-title {
                margin-top: 6px;
                font-size: 15px;
                font-weight: 600;
                line-height: 1.4;
            }

            .kml-title a {
                text-decoration: none;
                color: #111;
            }

            .kml-title a:hover {
                color: #ff4500;
            }

            /* Responsive for Mobile & Tablet */
            @media(max-width: 992px) {
                .kml-news-row {
                    flex-direction: column;
                    gap: 20px;
                }

                /* Left column - 2 news side by side in 1 row */
                .kml-col-left {
                    order: 1;
                    flex-direction: row;
                    gap: 15px;
                }

                /* Center column - 1 news in full row */
                .kml-col-center {
                    order: 2;
                    width: 100%;
                }

                /* Right column - 2 news side by side in 1 row */
                .kml-col-right {
                    order: 3;
                    flex-direction: row;
                    gap: 15px;
                }

                /* Make posts in left and right columns equal width */
                .kml-col-left .kml-post,
                .kml-col-right .kml-post {
                    flex: 1;
                }
            }

            /* For very small screens (phones) */
            @media(max-width: 576px) {

                .kml-col-left,
                .kml-col-right {
                    flex-direction: column;
                }

                .kml-title {
                    font-size: 14px;
                }

                .kml-cat {
                    font-size: 11px;
                    padding: 2px 5px;
                }
            }
        </style>

        <div class="kml-news-row kml-top-news">

            {{-- Left Column (2 news) --}}
            @if (!empty($fs1) && $fs1->count())
                <div class="kml-news-col kml-col-left">
                    @foreach ($fs1->take(2) as $row)
                        <div class="kml-post">
                            <a
                                href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}">
                                <img src="{{ $row->thumbnail }}" alt="{{ $row->title }}">
                            </a>
                            <a class="kml-cat"
                                href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}">
                                {{ session('lang') == 'english' ? $row->newsCategory->category_en : $row->newsCategory->category_bn }}
                            </a>
                            <div class="kml-title">
                                <a
                                    href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}">
                                    {{ session('lang') == 'english' ? $row->title_en : $row->title_bn }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Center Column (main news) --}}
            @if (!empty($fsbt))
                <div class="kml-news-col kml-col-center">
                    <div class="kml-post">
                        <a
                            href="{{ route('showFull.news', ['category' => $fsbt->newsCategory->slug, 'subcategory' => $fsbt->newsSubcategory->slug, 'id' => $fsbt->id]) }}">
                            <img src="{{ $fsbt->thumbnail }}" alt="{{ $fsbt->title }}">
                        </a>
                        <a class="kml-cat"
                            href="{{ route('showFull.news', ['category' => $fsbt->newsCategory->slug, 'subcategory' => $fsbt->newsSubcategory->slug, 'id' => $fsbt->id]) }}">
                            {{ session('lang') == 'english' ? $fsbt->newsCategory->category_en : $fsbt->newsCategory->category_bn }}
                        </a>
                        <div class="kml-title">
                            <a
                                href="{{ route('showFull.news', ['category' => $fsbt->newsCategory->slug, 'subcategory' => $fsbt->newsSubcategory->slug, 'id' => $fsbt->id]) }}">
                                {{ session('lang') == 'english' ? $fsbt->title_en : $fsbt->title_bn }}
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Right Column (2 news) --}}
            @if (!empty($fs2) && $fs2->count())
                <div class="kml-news-col kml-col-right">
                    @foreach ($fs2->take(2) as $row)
                        @php
                            $isPlaceholder = Str::contains($row->thumbnail, 'via.placeholder.com');
                            $imageToShow =
                                !$isPlaceholder && !empty($row->thumbnail)
                                    ? $row->thumbnail
                                    : asset('uploads/default_images/deafult_thumbnail.jpg');
                        @endphp
                        <div class="kml-post">
                            <a
                                href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}">
                                <img src="{{ $imageToShow }}" alt="{{ $row->title_en }}">
                            </a>
                            <a class="kml-cat"
                                href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}">
                                {{ session('lang') == 'english' ? $row->newsCategory->category_en : $row->newsCategory->category_bn }}
                            </a>
                            <div class="kml-title">
                                <a
                                    href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}">
                                    {{ session('lang') == 'english' ? $row->title_en : $row->title_bn }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>

        {{-- fisrt Section 9 News with widget Start --}}
        <div class="row" style="margin-bottom: 15pxp">
            <div class="main--content col-md-8 col-sm-7" data-sticky-content="true">
                <div class="sticky-content-inner">
                    {{-- ====== 3-in-row News (fs9) + Ad (error-safe) ====== --}}
                    @if (!empty($fs9) && $fs9->count())
                        <style>
                            .custom-news-grid {
                                display: flex;
                                flex-wrap: wrap;
                                gap: 20px;
                                margin-top: 20px;
                            }

                            .custom-news-card {
                                flex: 1 1 calc(33.333% - 20px);
                                /* 3 in a row */
                                box-sizing: border-box;
                            }

                            @media (max-width: 768px) {
                                .custom-news-card {
                                    flex: 1 1 calc(50% - 20px);
                                    /* 2 in tablet */
                                }
                            }

                            @media (max-width: 576px) {
                                .custom-news-card {
                                    flex: 1 1 100%;
                                    /* 1 in mobile */
                                }
                            }

                            .custom-news-card img {
                                width: 100%;
                                height: auto;
                                border-radius: 6px;
                                display: block;
                            }

                            .custom-news-card .cat {
                                display: inline-block;
                                margin-top: 6px;
                                font-size: 13px;
                                font-weight: bold;
                                color: #d32f2f;
                                text-decoration: none;
                            }

                            .custom-news-card .title {
                                margin-top: 8px;
                            }

                            .custom-news-card .title a {
                                font-size: 16px;
                                font-weight: 600;
                                color: #222;
                                text-decoration: none;
                                line-height: 1.4;
                            }

                            .custom-news-card .title a:hover {
                                color: #d32f2f;
                            }

                            /* Ad */
                            .custom-ad-space {
                                width: 100%;
                                margin-top: 30px;
                                text-align: center;
                            }

                            .custom-ad-space img {
                                max-width: 100%;
                                height: auto;
                                display: inline-block;
                                border-radius: 4px;
                            }
                        </style>

                        <div class="custom-news-grid">
                            @foreach ($fs9 as $row)
                                @php
                                    $catSlug = optional($row->newsCategory)->slug;
                                    $subSlug = optional($row->newsSubcategory)->slug;
                                    $routeArgs = array_filter([
                                        'category' => $catSlug,
                                        'subcategory' => $subSlug,
                                        'id' => $row->id,
                                    ]);
                                    try {
                                        $newsUrl = route('showFull.news', $routeArgs);
                                    } catch (\Throwable $e) {
                                        $newsUrl = url('/news/' . ($row->id ?? ''));
                                    }

                                    $thumb = $row->thumbnail ?? '';
                                    $isPlaceholder = is_string($thumb) && Str::contains($thumb, 'via.placeholder.com');
                                    $imageToShow =
                                        !$isPlaceholder && !empty($thumb)
                                            ? $thumb
                                            : asset('uploads/default_images/deafult_thumbnail.jpg');

                                    $titleText = $row->title_en ?? ($row->title_bn ?? 'News');
                                @endphp

                                <div class="custom-news-card">
                                    <div class="post--img">
                                        <a href="{{ $newsUrl }}" class="thumb">
                                            <img src="{{ $imageToShow }}" alt="{{ e($titleText) }}">
                                        </a>

                                        @if (!empty($row->newsCategory))
                                            <a href="{{ $newsUrl }}" class="cat">
                                                {{ session()->get('lang') == 'english' ? $row->newsCategory->category_en : $row->newsCategory->category_bn }}
                                            </a>
                                        @endif

                                        <div class="post--info">
                                            <div class="title">
                                                <h2 class="h4">
                                                    <a href="{{ $newsUrl }}" class="btn-link">
                                                        {{ session()->get('lang') == 'english' ? $row->title_en ?? $row->title_bn : $row->title_bn ?? $row->title_en }}
                                                    </a>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Ad Section --}}
                        <div class="custom-ad-space">
                            @php
                                $fallbackAd = asset('frontend_assets/img/ads-img/ad-728x90-01.jpg');
                                $adSrc = $fallbackAd;
                                if (!empty($fbp) && !empty($fbp->image) && file_exists(public_path($fbp->image))) {
                                    $adSrc = asset($fbp->image);
                                } elseif (!empty($fbp) && !empty($fbp->image)) {
                                    $adSrc = $fbp->image;
                                }
                            @endphp

                            @if (!empty($fbp) && !empty($fbp->id))
                                <a href="{{ route('ads.trackClick', $fbp->id) }}" target="_blank">
                                    <img src="{{ $adSrc }}" alt="{{ e($fbp->title_en ?? 'Advertisement') }}">
                                </a>
                            @else
                                <img src="{{ $adSrc }}" alt="Advertisement">
                            @endif
                        </div>
                    @endif

                </div>
            </div>
            <div class="main--sidebar col-md-4 col-sm-5 ptop--30 pbottom--30" data-sticky-content="true">
                <div class="sticky-content-inner">
                    <div class="widget">
                        <div class="list--widget list--widget-1">
                            <div class="widget--title" style="border-top: none; !important">
                                <h2 class="h4">
                                    @if (session()->get('lang') == 'english')
                                        Featured News
                                    @else
                                        আলোচিত খবর
                                    @endif
                                </h2>
                                <i class="icon fa fa-newspaper-o"></i>
                            </div>
                            <div class="list--widget-nav" data-ajax="tab">
                                <ul class="nav nav-justified">
                                    <li class="active">
                                        <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                            data-ajax-action="load_widget_trendy_news">
                                            @if (session()->get('lang') == 'english')
                                                Trendy News
                                            @else
                                                টেন্ডিং নিউজ
                                            @endif
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                            data-ajax-action="load_widget_most_watched">
                                            @if (session()->get('lang') == 'english')
                                                Most Watched
                                            @else
                                                সর্বাধিক দেখা
                                            @endif
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="post--items post--items-3" data-ajax-content="outer">
                                <div style="max-height: 400px; overflow-y: auto;">
                                    <ul class="nav" data-ajax-content="inner">
                                        @foreach ($tn as $index => $row)
                                            <li style="{{ $index !== 0 ? 'margin-top: 15px;' : '' }}">
                                                <div class="post--item post--layout-3">
                                                    <div class="post--img">
                                                        <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                            class="thumb">

                                                            @php
                                                                $isPlaceholder = Str::contains(
                                                                    $row->thumbnail,
                                                                    'via.placeholder.com',
                                                                );
                                                                $imageToShow =
                                                                    !$isPlaceholder && !empty($row->thumbnail)
                                                                        ? $row->thumbnail
                                                                        : asset(
                                                                            'uploads/default_images/deafult_thumbnail.jpg',
                                                                        );
                                                            @endphp

                                                            <img src="{{ $imageToShow }}" alt="{{ $row->title_en }}"
                                                                class="img-fluid">

                                                        </a>
                                                        <div class="post--info">
                                                            <ul class="nav meta" style="margin-top: 5px;">
                                                                <li>
                                                                    <a
                                                                        href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}">
                                                                        {{-- {{ $row->newsUser->name }} --}}
                                                                        {{ $row->newsUser->name ?? 'No User' }}
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a
                                                                        href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}">
                                                                        @if (session()->get('lang') == 'bangla')
                                                                            {{ formatBanglaDateTime($row->created_at) }}
                                                                        @else
                                                                            {{ $row->created_at->format('j F Y') }}
                                                                        @endif
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <div class="title" style="margin-top: -4px;">
                                                                <h3 class="h4">
                                                                    <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                                        class="btn-link">
                                                                        @if (session()->get('lang') == 'english')
                                                                            {{ $row->title_en }}
                                                                        @else
                                                                            {{ $row->title_bn }}
                                                                        @endif
                                                                    </a>
                                                                </h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Salah Time --}}

                    <!-- Beautiful Prayer Times Card -->
                    <div class="prayer-times-card">
                        <div class="prayer-times-header">
                            <h3 class="prayer-title">
                                <span>🕌</span>
                                <span class="prayer-text" data-en="Today's Prayer Times"
                                    data-bn="আজকের নামাজের সময়সূচি"></span>
                            </h3>
                            <div class="prayer-subtitle prayer-text" data-en="Dhaka, Bangladesh"
                                data-bn="ঢাকা, বাংলাদেশ"></div>
                        </div>

                        <div class="prayer-times-body">
                            <table class="prayer-times-table">
                                <thead>
                                    <tr>
                                        <th class="prayer-text" data-en="Prayer" data-bn="নামাজ"></th>
                                        <th class="prayer-text" data-en="Time" data-bn="সময়"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="prayer-text" data-en="Fajr" data-bn="ফজর"></td>
                                        <td id="fajr" class="prayer-time"></td>
                                    </tr>
                                    <tr>
                                        <td class="prayer-text" data-en="Dhuhr" data-bn="যোহর"></td>
                                        <td id="dhuhr" class="prayer-time"></td>
                                    </tr>
                                    <tr>
                                        <td class="prayer-text" data-en="Asr" data-bn="আসর"></td>
                                        <td id="asr" class="prayer-time"></td>
                                    </tr>
                                    <tr>
                                        <td class="prayer-text" data-en="Maghrib" data-bn="মাগরিব"></td>
                                        <td id="maghrib" class="prayer-time"></td>
                                    </tr>
                                    <tr>
                                        <td class="prayer-text" data-en="Isha" data-bn="ইশা"></td>
                                        <td id="isha" class="prayer-time"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="prayer-times-footer">
                            <p class="update-time prayer-text" data-en="Automatically updated"
                                data-bn="স্বয়ংক্রিয়ভাবে আপডেট"></p>
                        </div>
                    </div>

                    <style>
                        /* === BEAUTIFUL PRAYER TIMES CARD === */
                        .prayer-times-card {
                            background-color: var(--widget-bg, #ffffff) !important;
                            border: 1px solid var(--widget-border, #e0e0e0) !important;
                            border-radius: 12px !important;
                            box-shadow: var(--widget-shadow, 0 4px 6px rgba(0, 0, 0, 0.05)) !important;
                            overflow: hidden !important;
                            margin: 25px 0 !important;
                            transition: all 0.3s ease !important;
                        }

                        .prayer-times-card:hover {
                            box-shadow: var(--widget-shadow-hover, 0 8px 15px rgba(0, 0, 0, 0.1)) !important;
                            transform: translateY(-2px) !important;
                        }

                        .prayer-times-header {
                            background: linear-gradient(135deg, var(--prayer-header-bg, #28a745), var(--prayer-header-dark, #1e7e34)) !important;
                            padding: 20px !important;
                            text-align: center !important;
                            border-bottom: none !important;
                        }

                        .prayer-times-header .prayer-title {
                            color: #ffffff !important;
                            font-weight: 700 !important;
                            font-size: 1.8rem !important;
                            /* CHANGED: 1.4rem to 1.8rem */
                            margin: 0 !important;
                            display: flex !important;
                            align-items: center !important;
                            justify-content: center !important;
                            gap: 10px !important;
                        }

                        .prayer-times-header .prayer-title i {
                            font-size: 1.6rem !important;
                        }

                        .prayer-times-header .prayer-subtitle {
                            color: rgba(255, 255, 255, 0.9) !important;
                            font-size: 1.1rem !important;
                            /* CHANGED: 0.9rem to 1.1rem */
                            margin: 5px 0 0 0 !important;
                            font-weight: 500 !important;
                        }

                        .prayer-times-body {
                            padding: 0 !important;
                        }

                        .prayer-times-table {
                            width: 100% !important;
                            border: none !important;
                            margin: 0 !important;
                            border-collapse: collapse !important;
                        }

                        .prayer-times-table thead {
                            background: linear-gradient(135deg, var(--table-header-bg, #f8f9fa), var(--table-header-dark, #e9ecef)) !important;
                        }

                        .prayer-times-table th {
                            color: var(--text-primary, #2c3e50) !important;
                            font-weight: 700 !important;
                            font-size: 1.1rem !important;
                            /* CHANGED: 0.95rem to 1.1rem */
                            padding: 15px 10px !important;
                            border: none !important;
                            text-align: center !important;
                        }

                        .prayer-times-table tbody tr {
                            transition: all 0.3s ease !important;
                            border-bottom: 1px solid var(--border-color, #f0f0f0) !important;
                        }

                        .prayer-times-table tbody tr:last-child {
                            border-bottom: none !important;
                        }

                        .prayer-times-table tbody tr:hover {
                            background-color: var(--hover-bg, #f8f9fa) !important;
                        }

                        .prayer-times-table td {
                            color: var(--text-primary, #2c3e50) !important;
                            font-weight: 600 !important;
                            padding: 12px 10px !important;
                            border: none !important;
                            text-align: center !important;
                            font-size: 1.05rem !important;
                            /* CHANGED: 0.9rem to 1.05rem */
                        }

                        .prayer-times-table td:first-child {
                            border-right: 1px solid var(--border-color, #f0f0f0) !important;
                            font-weight: 700 !important;
                            width: 40% !important;
                        }

                        .prayer-times-table .prayer-time {
                            font-family: 'Courier New', monospace !important;
                            font-weight: 700 !important;
                            color: var(--primary-color, #007bff) !important;
                            font-size: 1.2rem !important;
                            /* CHANGED: 1rem to 1.2rem */
                        }

                        .prayer-times-table .current-prayer {
                            background: linear-gradient(135deg, var(--current-prayer-bg, #e3f2fd), var(--current-prayer-dark, #bbdefb)) !important;
                            border-left: 4px solid var(--primary-color, #007bff) !important;
                        }

                        .prayer-times-table .current-prayer td {
                            color: var(--primary-color, #007bff) !important;
                            font-weight: 800 !important;
                        }

                        .prayer-times-table .current-prayer .prayer-time {
                            color: var(--primary-dark, #0056b3) !important;
                            font-weight: 900 !important;
                        }

                        .prayer-times-footer {
                            background-color: var(--footer-bg, #f8f9fa) !important;
                            padding: 12px 20px !important;
                            text-align: center !important;
                            border-top: 1px solid var(--border-color, #e0e0e0) !important;
                        }

                        .prayer-times-footer .update-time {
                            color: var(--text-muted, #6c757d) !important;
                            font-size: 1rem !important;
                            /* CHANGED: 0.8rem to 1rem */
                            font-style: italic !important;
                            margin: 0 !important;
                        }

                        /* Loading animation */
                        .prayer-time.loading {
                            color: var(--text-muted, #6c757d) !important;
                            font-style: italic !important;
                        }

                        .prayer-time.error {
                            color: #dc3545 !important;
                            font-style: italic !important;
                        }

                        /* === CSS VARIABLES FOR PRAYER TIMES === */
                        :root {
                            --prayer-header-bg: #28a745;
                            --prayer-header-dark: #1e7e34;
                            --table-header-bg: #f8f9fa;
                            --table-header-dark: #e9ecef;
                            --current-prayer-bg: #e3f2fd;
                            --current-prayer-dark: #bbdefb;
                            --footer-bg: #f8f9fa;
                        }

                        body.dark-mode {
                            --prayer-header-bg: #28a745;
                            --prayer-header-dark: #1e7e34;
                            --table-header-bg: #3a3a3a;
                            --table-header-dark: #444;
                            --current-prayer-bg: #2a4365;
                            --current-prayer-dark: #1e3a5f;
                            --footer-bg: #2d2d2d;
                        }

                        /* === RESPONSIVE DESIGN === */
                        @media (max-width: 768px) {
                            .prayer-times-card {
                                margin: 15px 0 !important;
                            }

                            .prayer-times-header {
                                padding: 15px !important;
                            }

                            .prayer-times-header .prayer-title {
                                font-size: 1.5rem !important;
                                /* CHANGED: 1.2rem to 1.5rem */
                                flex-direction: column !important;
                                gap: 5px !important;
                            }

                            .prayer-times-table th,
                            .prayer-times-table td {
                                padding: 10px 8px !important;
                                font-size: 1rem !important;
                                /* CHANGED: 0.85rem to 1rem */
                            }

                            .prayer-times-table .prayer-time {
                                font-size: 1.1rem !important;
                                /* CHANGED: 0.9rem to 1.1rem */
                            }

                            .prayer-times-footer .update-time {
                                font-size: 0.9rem !important;
                                /* CHANGED: added for mobile */
                            }
                        }
                    </style>

                    <script>
                        // Prayer Times API Integration - Works with your session language
                        document.addEventListener("DOMContentLoaded", function() {
                            const prayerIds = ["fajr", "dhuhr", "asr", "maghrib", "isha"];

                            // Get current language from your session (adjust based on your implementation)
                            const currentLang = '<?php echo session()->get('lang', 'bangla'); ?>'; // Adjust this line

                            // Add loading class initially with correct language
                            prayerIds.forEach(id => {
                                const element = document.getElementById(id);
                                if (element) {
                                    const loadingText = currentLang === 'english' ? 'Loading...' : 'লোড হচ্ছে...';
                                    element.textContent = loadingText;
                                    element.classList.add('loading');
                                }
                            });

                            fetch("https://api.aladhan.com/v1/timingsByCity?city=Dhaka&country=Bangladesh&method=2")
                                .then(res => {
                                    if (!res.ok) throw new Error('Network response was not ok');
                                    return res.json();
                                })
                                .then(data => {
                                    if (data.code === 200) {
                                        const t = data.data.timings;

                                        // Update prayer times
                                        document.getElementById("fajr").textContent = t.Fajr;
                                        document.getElementById("dhuhr").textContent = t.Dhuhr;
                                        document.getElementById("asr").textContent = t.Asr;
                                        document.getElementById("maghrib").textContent = t.Maghrib;
                                        document.getElementById("isha").textContent = t.Isha;

                                        // Remove loading class
                                        prayerIds.forEach(id => {
                                            const element = document.getElementById(id);
                                            if (element) {
                                                element.classList.remove('loading');
                                                element.classList.add('loaded');
                                            }
                                        });

                                        // Highlight current prayer
                                        highlightCurrentPrayer();

                                    } else {
                                        throw new Error('API returned error');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error fetching prayer times:', error);
                                    prayerIds.forEach(id => {
                                        const element = document.getElementById(id);
                                        if (element) {
                                            const errorText = currentLang === 'english' ? 'Error!' : 'ত্রুটি!';
                                            element.textContent = errorText;
                                            element.classList.remove('loading');
                                            element.classList.add('error');
                                        }
                                    });
                                });
                        });

                        // Highlight current prayer time
                        function highlightCurrentPrayer() {
                            const prayers = [{
                                    name: 'fajr',
                                    element: document.getElementById('fajr')
                                },
                                {
                                    name: 'dhuhr',
                                    element: document.getElementById('dhuhr')
                                },
                                {
                                    name: 'asr',
                                    element: document.getElementById('asr')
                                },
                                {
                                    name: 'maghrib',
                                    element: document.getElementById('maghrib')
                                },
                                {
                                    name: 'isha',
                                    element: document.getElementById('isha')
                                }
                            ];

                            // Remove current prayer class from all
                            prayers.forEach(prayer => {
                                if (prayer.element && prayer.element.parentElement) {
                                    prayer.element.parentElement.classList.remove('current-prayer');
                                }
                            });

                            // Simple logic to determine current prayer
                            const now = new Date();
                            const currentTime = now.getHours() * 60 + now.getMinutes();

                            // Get prayer times and convert to minutes
                            const prayerTimes = {};
                            prayers.forEach(prayer => {
                                if (prayer.element) {
                                    const timeStr = prayer.element.textContent;
                                    if (timeStr.includes(':')) {
                                        const [hours, minutes] = timeStr.split(':').map(Number);
                                        prayerTimes[prayer.name] = hours * 60 + minutes;
                                    }
                                }
                            });

                            // Determine current prayer
                            if (prayerTimes.fajr && currentTime >= prayerTimes.fajr && currentTime < (prayerTimes.dhuhr || Infinity)) {
                                document.getElementById('fajr').parentElement.classList.add('current-prayer');
                            } else if (prayerTimes.dhuhr && currentTime >= prayerTimes.dhuhr && currentTime < (prayerTimes.asr ||
                                    Infinity)) {
                                document.getElementById('dhuhr').parentElement.classList.add('current-prayer');
                            } else if (prayerTimes.asr && currentTime >= prayerTimes.asr && currentTime < (prayerTimes.maghrib ||
                                    Infinity)) {
                                document.getElementById('asr').parentElement.classList.add('current-prayer');
                            } else if (prayerTimes.maghrib && currentTime >= prayerTimes.maghrib && currentTime < (prayerTimes.isha ||
                                    Infinity)) {
                                document.getElementById('maghrib').parentElement.classList.add('current-prayer');
                            } else if (prayerTimes.isha && currentTime >= prayerTimes.isha) {
                                document.getElementById('isha').parentElement.classList.add('current-prayer');
                            }
                        }

                        // Function to update prayer text when language changes (call this when your session changes)
                        function updatePrayerLanguage(lang) {
                            const elements = document.querySelectorAll('.prayer-text');
                            elements.forEach(element => {
                                const text = element.getAttribute(`data-${lang === 'english' ? 'en' : 'bn'}`);
                                if (text) {
                                    element.textContent = text;
                                }
                            });

                            // Also update loading/error texts if needed
                            const prayerIds = ["fajr", "dhuhr", "asr", "maghrib", "isha"];
                            prayerIds.forEach(id => {
                                const element = document.getElementById(id);
                                if (element && (element.classList.contains('loading') || element.classList.contains('error'))) {
                                    if (element.classList.contains('loading')) {
                                        element.textContent = lang === 'english' ? 'Loading...' : 'লোড হচ্ছে...';
                                    } else if (element.classList.contains('error')) {
                                        element.textContent = lang === 'english' ? 'Error!' : 'ত্রুটি!';
                                    }
                                }
                            });
                        }

                        // Initialize with current session language on page load
                        document.addEventListener("DOMContentLoaded", function() {
                            const currentLang = '<?php echo session()->get('lang', 'bangla'); ?>'; // Adjust this line
                            updatePrayerLanguage(currentLang);
                        });
                    </script>
                    {{-- Salah Time --}}

                </div>
            </div>
        </div>
        {{-- fisrt Section 9 News with widget  End --}}

        {{-- Special Report Section News with video slide Start --}}
        @if ($sn->count() > 0)
            <div class="main--content pd--30-0">
                <div class="post--items-title" data-ajax="tab">
                    <h2 class="h4">
                        @if (session()->get('lang') == 'english')
                            Special Report
                        @else
                            বিশেষ খবর
                        @endif
                    </h2>
                </div>

                {{-- Video Slider For Special News --}}
                <div id="image-slider" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($sn as $row)
                                @php
                                    preg_match('/src="([^"]+)"/', $row->embed_code, $matches);
                                    $iframeSrc = $matches[1] ?? null;
                                @endphp

                                @if ($iframeSrc)
                                    <li style="cursor: pointer" class="splide__slide">
                                        <div style="padding: 0 15px">
                                            <a data-fancybox data-type="iframe" href="{{ $iframeSrc }}"
                                                class="video-wrapper">
                                                @php
                                                    $videoId = null;
                                                    if (Str::contains($iframeSrc, 'youtube.com')) {
                                                        preg_match('/embed\/([^\?&"]+)/', $iframeSrc, $idMatch);
                                                        $videoId = $idMatch[1] ?? null;
                                                    }
                                                @endphp

                                                @if ($videoId)
                                                    <img style="border-radius: 10px"
                                                        src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                                        alt="Video Thumbnail">
                                                @else
                                                    <img src="{{ asset('default-thumb.jpg') }}" alt="Default Thumbnail">
                                                @endif

                                                <div class="play-overlay">
                                                    <i class="fa fa-play"
                                                        style="font-size: 24px; color: white !important"></i>
                                                </div>
                                            </a>

                                            <div>
                                                <a data-fancybox data-type="iframe" href="{{ $iframeSrc }}"
                                                    class="card-link title-black text-center"
                                                    style="color: black; font-size: 18px;">
                                                    {{ \Illuminate\Support\Str::limit($row->title, 38) }}
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        {{-- Special Report Section News with video slide End --}}



        {{-- National Section News Start --}}

        @if (isset($nnbt) && $nnbt && isset($nnbt->newsCategory))
            <div class="custom-news-section">
                <div class="row">
                    <div class="main--content" data-sticky-content="true">
                        <div class="sticky-content-inner">
                            <div class="row"> {{-- Section Title --}} <div class="post--items-title" data-ajax="tab"
                                    style="border-top: none; margin-top: 10px">
                                    <div style="display: flex; justify-content: space-between">
                                        <h2 class="h4">
                                            @if (session()->get('lang') == 'english')
                                                {{ $nnbt->newsCategory->category_en ?? 'News' }}
                                            @else
                                                {{ $nnbt->newsCategory->category_bn ?? 'সংবাদ' }}
                                            @endif
                                        </h2>
                                        @if (isset($nnbt->newsCategory->slug))
                                            <a href="{{ route('getCate.news', $nnbt->newsCategory->slug) }}"
                                                style="font-size: 15px; font-weight: bold">{{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}</a>
                                        @endif
                                    </div>
                                </div> {{-- Main Content --}} <div class="main--content pd--30-0">
                                    <div class="post--items post--items-4" data-ajax-content="outer">
                                        {{-- Left Column (col-md-3) --}} @if (isset($nnln) && $nnln->count() > 0)
                                            <div class="col-md-3">
                                                <ul class="nav flex-column">
                                                    @foreach ($nnln as $index => $row)
                                                        @if (isset($row->newsCategory) && isset($row->newsSubcategory))
                                                            <li style="{{ $index !== 0 ? 'margin-top: 20px;' : '' }}">
                                                                <div class="post--item">
                                                                    <div class="post--img"> <a
                                                                            href="{{ route('showFull.news', ['category' => $row->newsCategory->slug ?? 'news', 'subcategory' => $row->newsSubcategory->slug ?? 'general', 'id' => $row->id]) }}"
                                                                            class="thumb"> @php
                                                                                $isPlaceholder = isset($row->thumbnail)
                                                                                    ? Str::contains(
                                                                                        $row->thumbnail,
                                                                                        'via.placeholder.com',
                                                                                    )
                                                                                    : true;
                                                                                $imageToShow =
                                                                                    !$isPlaceholder &&
                                                                                    !empty($row->thumbnail)
                                                                                        ? $row->thumbnail
                                                                                        : asset(
                                                                                            'uploads/default_images/deafult_thumbnail.jpg',
                                                                                        );
                                                                            @endphp <img
                                                                                src="{{ $imageToShow }}"
                                                                                alt="{{ $row->title_en ?? 'News' }}"
                                                                                class="img-fluid" loading="lazy"> </a>
                                                                        <div class="post--info">
                                                                            <div class="title">
                                                                                <h3 class="h4"> <a
                                                                                        href="{{ route('showFull.news', ['category' => $row->newsCategory->slug ?? 'news', 'subcategory' => $row->newsSubcategory->slug ?? 'general', 'id' => $row->id]) }}"
                                                                                        class="btn-link">
                                                                                        @if (session()->get('lang') == 'english')
                                                                                            {{ Str::limit($row->title_en ?? 'Untitled News', 80) }}
                                                                                        @else
                                                                                            {{ Str::limit($row->title_bn ?? 'শিরোনামহীন সংবাদ', 80) }}
                                                                                        @endif
                                                                                    </a> </h3>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif {{-- Middle Column (col-md-6) --}} @if (isset($nnbt) && isset($nnbt->newsCategory) && isset($nnbt->newsSubcategory))
                                                <div class="col-md-6">
                                                    <div class="post--img"> <a
                                                            href="{{ route('showFull.news', ['category' => $nnbt->newsCategory->slug ?? 'news', 'subcategory' => $nnbt->newsSubcategory->slug ?? 'general', 'id' => $nnbt->id]) }}"
                                                            class="thumb"> @php
                                                                $isPlaceholder = isset($nnbt->thumbnail)
                                                                    ? Str::contains(
                                                                        $nnbt->thumbnail,
                                                                        'via.placeholder.com',
                                                                    )
                                                                    : true;
                                                                $imageToShow =
                                                                    !$isPlaceholder && !empty($nnbt->thumbnail)
                                                                        ? $nnbt->thumbnail
                                                                        : asset(
                                                                            'uploads/default_images/deafult_thumbnail.jpg',
                                                                        );
                                                            @endphp <img
                                                                src="{{ $imageToShow }}"
                                                                alt="{{ $nnbt->title_en ?? 'Main News' }}"
                                                                class="img-fluid" loading="lazy"> </a>
                                                        <div class="post--info">
                                                            <div class="title">
                                                                <h2 class="h4" style="font-size: 24px"> <a
                                                                        href="{{ route('showFull.news', ['category' => $nnbt->newsCategory->slug ?? 'news', 'subcategory' => $nnbt->newsSubcategory->slug ?? 'general', 'id' => $nnbt->id]) }}"
                                                                        class="btn-link">
                                                                        @if (session()->get('lang') == 'english')
                                                                            {{ $nnbt->title_en ?? 'Untitled Main News' }}
                                                                        @else
                                                                            {{ $nnbt->title_bn ?? 'প্রধান সংবাদ' }}
                                                                        @endif
                                                                    </a> </h2>
                                                                <p style="font-size: 16px; margin-top: -5px">
                                                                    @if (session()->get('lang') == 'english')
                                                                        {!! Str::limit($nnbt->details_en ?? '', 200, '...') !!}
                                                                    @else
                                                                        {!! Str::limit($nnbt->details_bn ?? '', 200, '...') !!}
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="divider hidden-md hidden-lg">
                                                </div>
                                                @endif {{-- Right Column (col-md-3) --}} @if (isset($nnrn) && $nnrn->count() > 0)
                                                    <div class="col-md-3">
                                                        <ul class="nav">
                                                            @foreach ($nnrn as $index => $row)
                                                                @if (isset($row->newsCategory) && isset($row->newsSubcategory))
                                                                    <li
                                                                        style="{{ $index !== 0 ? 'margin-top: 15px;' : '' }}">
                                                                        <div class="post--item post--layout-3">
                                                                            <div class="post--img"> <a
                                                                                    href="{{ route('showFull.news', ['category' => $row->newsCategory->slug ?? 'news', 'subcategory' => $row->newsSubcategory->slug ?? 'general', 'id' => $row->id]) }}"
                                                                                    class="thumb"> @php
                                                                                        $isPlaceholder = isset(
                                                                                            $row->thumbnail,
                                                                                        )
                                                                                            ? Str::contains(
                                                                                                $row->thumbnail,
                                                                                                'via.placeholder.com',
                                                                                            )
                                                                                            : true;
                                                                                        $imageToShow =
                                                                                            !$isPlaceholder &&
                                                                                            !empty($row->thumbnail)
                                                                                                ? $row->thumbnail
                                                                                                : asset(
                                                                                                    'uploads/default_images/deafult_thumbnail.jpg',
                                                                                                );
                                                                                    @endphp <img
                                                                                        src="{{ $imageToShow }}"
                                                                                        alt="{{ $row->title_en ?? 'News' }}"
                                                                                        class="img-fluid" loading="lazy">
                                                                                </a>
                                                                                <div class="post--info">
                                                                                    <div class="title">
                                                                                        <h3 class="h4"> <a
                                                                                                href="{{ route('showFull.news', ['category' => $row->newsCategory->slug ?? 'news', 'subcategory' => $row->newsSubcategory->slug ?? 'general', 'id' => $row->id]) }}"
                                                                                                class="btn-link">
                                                                                                @if (session()->get('lang') == 'english')
                                                                                                    {{ Str::limit($row->title_en ?? 'Untitled News', 60) }}
                                                                                                @else
                                                                                                    {{ Str::limit($row->title_bn ?? 'শিরোনামহীন সংবাদ', 60) }}
                                                                                                @endif
                                                                                            </a> </h3>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <style>
            /* Exact Desktop Style - Keep Original Design */
            .custom-news-section .post--items-title {
                margin-bottom: 20px;
                padding-bottom: 10px;
                border-bottom: 2px solid #e0e0e0;
            }

            .custom-news-section .post--items-title h2 {
                margin: 0;
                font-size: 24px;
                font-weight: 700;
                color: #333;
            }

            .custom-news-section .post--items-title a {
                font-size: 15px !important;
                font-weight: bold !important;
                color: #007bff;
                text-decoration: none;
                transition: color 0.3s ease;
            }

            .custom-news-section .post--items-title a:hover {
                color: #0056b3;
                text-decoration: none;
            }

            .custom-news-section .main--content.pd--30-0 {
                padding: 30px 0;
            }

            .custom-news-section .post--items.post--items-4 {
                display: flex;
                gap: 20px;
                align-items: flex-start;
            }

            .custom-news-section .post--items .col-md-3:first-child {
                flex: 0 0 25%;
            }

            .custom-news-section .post--items .col-md-6 {
                flex: 0 0 50%;
            }

            .custom-news-section .post--items .col-md-3:last-child {
                flex: 0 0 25%;
            }

            .custom-news-section .nav.flex-column {
                list-style: none;
                padding: 0;
                margin: 0;
                display: flex;
                flex-direction: column;
            }

            .custom-news-section .nav:not(.flex-column) {
                list-style: none;
                padding: 0;
                margin: 0;
                display: flex;
                flex-direction: column;
            }

            .custom-news-section .nav li {
                margin: 0 !important;
            }

            .custom-news-section .nav.flex-column li+li {
                margin-top: 20px !important;
            }

            .custom-news-section .nav:not(.flex-column) li+li {
                margin-top: 15px !important;
            }

            .custom-news-section .post--item {
                display: block;
                transition: transform 0.3s ease;
            }

            .custom-news-section .post--item:hover {
                transform: translateY(-2px);
            }

            .custom-news-section .post--img {
                position: relative;
                overflow: hidden;
                border-radius: 10px;
            }

            .custom-news-section .post--img .thumb {
                display: block;
                overflow: hidden;
                border-radius: 10px;
            }

            .custom-news-section .post--img img.img-fluid {
                width: 100%;
                display: block;
                transition: transform 0.3s ease;
                border-radius: 10px;
                object-fit: cover;
            }

            .custom-news-section .post--item:hover .post--img img {
                transform: scale(1.05);
            }

            /* Desktop Image Heights - NO CROPPING FOR FULL IMAGES */
            .custom-news-section .col-md-3:first-child .post--img img {
                height: auto;
                min-height: 180px;
                max-height: none;
                object-fit: contain;
            }

            .custom-news-section .col-md-6 .post--img img {
                height: auto;
                min-height: 400px;
                max-height: none;
                object-fit: contain;
            }

            .custom-news-section .col-md-3:last-child .post--img img {
                height: auto;
                min-height: 75px;
                max-height: none;
                object-fit: contain;
            }

            .custom-news-section .post--info {
                padding: 15px 0;
            }

            .custom-news-section .col-md-6 .post--info {
                padding: 20px 0;
            }

            .custom-news-section .col-md-3:last-child .post--info {
                padding: 8px 0;
            }

            .custom-news-section .post--info .title {
                margin: 0;
            }

            .custom-news-section .post--info .title h2,
            .custom-news-section .post--info .title h3 {
                margin: 0 0 10px 0;
                line-height: 1.3;
            }

            .custom-news-section .post--info .title h2 {
                font-size: 24px !important;
                font-weight: 700;
            }

            .custom-news-section .post--info .title h3 {
                font-size: 16px;
                font-weight: 600;
            }

            .custom-news-section .col-md-3:last-child .post--info .title h3 {
                font-size: 13px;
            }

            .custom-news-section .btn-link {
                color: #333;
                text-decoration: none;
                transition: color 0.3s ease;
            }

            .custom-news-section .btn-link:hover {
                color: #007bff;
                text-decoration: none;
            }

            .custom-news-section .col-md-6 p {
                font-size: 16px !important;
                line-height: 1.6;
                color: #666;
                margin-top: -5px !important;
                margin-bottom: 0 !important;
            }

            .custom-news-section .divider {
                display: none;
            }

            /* Mobile/Tablet - Bootstrap Compatible Solution */
            @media (max-width: 991px) {

                /* Override Bootstrap's flexbox completely */
                .custom-news-section .post--items {
                    display: block !important;
                }

                /* Force all columns to behave like regular divs */
                .custom-news-section .col-md-3,
                .custom-news-section .col-md-6 {
                    width: 100% !important;
                    max-width: 100% !important;
                    flex: none !important;
                    position: relative !important;
                    min-height: 1px !important;
                    padding-right: 15px !important;
                    padding-left: 15px !important;
                    box-sizing: border-box !important;
                    float: none !important;
                    display: block !important;
                    margin-bottom: 25px !important;
                }

                /* Reset Bootstrap's row behavior */
                .custom-news-section .row {
                    margin-right: 0 !important;
                    margin-left: 0 !important;
                    display: block !important;
                }

                /* Left Column - FORCE 2 news side by side with stronger overrides */
                .custom-news-section .col-md-3:first-child .nav.flex-column {
                    display: block !important;
                    width: 100% !important;
                    padding: 0 !important;
                    margin: 0 !important;
                    list-style: none !important;
                    overflow: hidden !important;
                }

                .custom-news-section .col-md-3:first-child .nav.flex-column::after {
                    content: "" !important;
                    display: table !important;
                    clear: both !important;
                }

                .custom-news-section .col-md-3:first-child .nav.flex-column li {
                    display: block !important;
                    margin: 0 !important;
                    padding: 0 !important;
                    list-style: none !important;
                    box-sizing: border-box !important;
                }

                /* First 2 items side by side */
                .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(1) {
                    float: left !important;
                    width: 48% !important;
                    margin-right: 4% !important;
                    margin-bottom: 15px !important;
                }

                .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(2) {
                    float: left !important;
                    width: 48% !important;
                    margin-right: 0 !important;
                    margin-bottom: 15px !important;
                }

                /* Items 3+ full width */
                .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(n+3) {
                    float: none !important;
                    width: 100% !important;
                    clear: both !important;
                    margin-top: 15px !important;
                    margin-right: 0 !important;
                    margin-bottom: 15px !important;
                }

                /* Middle Column - DON'T CROP THE IMAGE */
                .custom-news-section .col-md-6 .post--img img {
                    height: auto !important;
                    min-height: 200px !important;
                    max-height: none !important;
                    width: 100% !important;
                    object-fit: cover !important;
                }

                /* Right Column - Perfect 2x2 grid for first 4 items, last item full width */
                .custom-news-section .col-md-3:last-child .nav {
                    display: block !important;
                    width: 100% !important;
                    padding: 0 !important;
                    margin: 0 !important;
                    list-style: none !important;
                    overflow: hidden !important;
                }

                /* Clearfix for the nav */
                .custom-news-section .col-md-3:last-child .nav::after {
                    content: "" !important;
                    display: table !important;
                    clear: both !important;
                }

                /* Row 1: Items 1 and 2 side by side with perfect spacing */
                .custom-news-section .col-md-3:last-child .nav li:nth-child(1) {
                    float: left !important;
                    width: 48% !important;
                    margin-right: 4% !important;
                    margin-top: 0 !important;
                    margin-bottom: 15px !important;
                }

                .custom-news-section .col-md-3:last-child .nav li:nth-child(2) {
                    float: left !important;
                    width: 48% !important;
                    margin-top: 0 !important;
                    margin-bottom: 15px !important;
                }

                /* Row 2: Items 3 and 4 side by side with perfect spacing */
                .custom-news-section .col-md-3:last-child .nav li:nth-child(3) {
                    float: left !important;
                    width: 48% !important;
                    margin-right: 4% !important;
                    margin-top: 0 !important;
                    margin-bottom: 15px !important;
                    clear: left !important;
                }

                .custom-news-section .col-md-3:last-child .nav li:nth-child(4) {
                    float: left !important;
                    width: 48% !important;
                    margin-top: 0 !important;
                    margin-bottom: 15px !important;
                }

                /* Row 3: Item 5+ full width with proper spacing */
                .custom-news-section .col-md-3:last-child .nav li:nth-child(5),
                .custom-news-section .col-md-3:last-child .nav li:nth-child(n+5) {
                    float: none !important;
                    width: 100% !important;
                    clear: both !important;
                    display: block !important;
                    margin-top: 15px !important;
                    margin-right: 0 !important;
                    margin-left: 0 !important;
                    margin-bottom: 15px !important;
                }

                .custom-news-section .col-md-3:last-child .nav li:nth-child(n+6) {
                    float: none !important;
                    width: 100% !important;
                    margin-top: 0 !important;
                    margin-bottom: 15px !important;
                    margin-right: 0 !important;
                    margin-left: 0 !important;
                    clear: both !important;
                    display: block !important;
                }

                /* Left column image heights - NO CROPPING */
                .custom-news-section .col-md-3:first-child .post--img img {
                    height: auto !important;
                    min-height: 100px !important;
                    max-height: none !important;
                    width: 100% !important;
                    object-fit: contain !important;
                }

                /* Right column image heights - NO CROPPING */
                .custom-news-section .col-md-3:last-child .post--img img {
                    height: auto !important;
                    min-height: 60px !important;
                    max-height: none !important;
                    width: 100% !important;
                    object-fit: contain !important;
                }

                /* Ensure consistent spacing for all items */
                .custom-news-section .col-md-3:last-child .post--item {
                    margin-bottom: 0 !important;
                }

                /* Typography */
                .custom-news-section .post--items-title h2 {
                    font-size: 20px;
                }

                .custom-news-section .post--info .title h2 {
                    font-size: 18px !important;
                }

                .custom-news-section .post--info .title h3 {
                    font-size: 14px;
                }

                .custom-news-section .col-md-6 p {
                    font-size: 14px !important;
                }
            }

            /* Small Mobile - Stack everything in single column */
            @media (max-width: 575px) {

                /* Single column layout for very small screens */
                .custom-news-section .col-md-3:first-child .nav.flex-column li {
                    float: none !important;
                    width: 100% !important;
                    margin-right: 0 !important;
                    margin-bottom: 15px !important;
                    clear: both !important;
                }

                .custom-news-section .col-md-3:last-child .nav li {
                    float: none !important;
                    width: 100% !important;
                    margin-right: 0 !important;
                    margin-bottom: 15px !important;
                    clear: both !important;
                }

                /* Middle image - responsive but not cropped */
                .custom-news-section .col-md-6 .post--img img {
                    height: auto !important;
                    min-height: 180px !important;
                    max-height: none !important;
                }

                /* Adjust other image heights for small screens - NO CROPPING */
                .custom-news-section .col-md-3:first-child .post--img img,
                .custom-news-section .col-md-3:last-child .post--img img {
                    height: auto !important;
                    min-height: 80px !important;
                    max-height: none !important;
                    object-fit: contain !important;
                }

                .custom-news-section .post--items-title h2 {
                    font-size: 18px;
                }

                .custom-news-section .post--info .title h2 {
                    font-size: 16px !important;
                }

                .custom-news-section .post--info .title h3 {
                    font-size: 13px;
                }

                .custom-news-section .col-md-6 p {
                    font-size: 12px !important;
                }
            }

            /* Medium Mobile - Keep 2-column layout where appropriate */
            @media (min-width: 576px) and (max-width: 767px) {

                /* Left column - maintain 2-column layout for first 2 items */
                .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(1),
                .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(2) {
                    float: left !important;
                    width: 48% !important;
                }

                .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(1) {
                    margin-right: 4% !important;
                }

                .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(2) {
                    margin-right: 0 !important;
                }

                .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(n+3) {
                    float: none !important;
                    width: 100% !important;
                    clear: both !important;
                }

                /* Right column - maintain float-based grid */
                .custom-news-section .col-md-3:last-child .nav li:nth-child(1),
                .custom-news-section .col-md-3:last-child .nav li:nth-child(2),
                .custom-news-section .col-md-3:last-child .nav li:nth-child(3),
                .custom-news-section .col-md-3:last-child .nav li:nth-child(4) {
                    width: 48% !important;
                    margin-right: 4% !important;
                }

                .custom-news-section .col-md-3:last-child .nav li:nth-child(2),
                .custom-news-section .col-md-3:last-child .nav li:nth-child(4) {
                    margin-right: 0 !important;
                }

                .custom-news-section .col-md-3:last-child .nav li:nth-child(3) {
                    clear: left !important;
                    margin-right: 4% !important;
                }

                .custom-news-section .col-md-3:last-child .nav li:nth-child(5) {
                    width: 100% !important;
                    clear: both !important;
                }

                /* Middle image - responsive */
                .custom-news-section .col-md-6 .post--img img {
                    height: auto !important;
                    min-height: 220px !important;
                    max-height: none !important;
                }

                /* Adjust image heights for medium mobile - NO CROPPING */
                .custom-news-section .col-md-3:first-child .post--img img {
                    height: auto !important;
                    min-height: 90px !important;
                    max-height: none !important;
                    object-fit: contain !important;
                }

                .custom-news-section .col-md-3:last-child .post--img img {
                    height: auto !important;
                    min-height: 70px !important;
                    max-height: none !important;
                    object-fit: contain !important;
                }
            }
        </style>

        {{-- National Section News End --}}


        {{-- Entertainment Section News Start --}}

        @if (isset($enbt) && $enbt) {{-- Only show if main news exists --}}
            <div class="entertainment-section">

                {{-- Section Title --}}
                <div class="post--items-title" data-ajax="tab"
                    style="border-top: none; border-bottom: 2px solid #e0e0e0; margin-top: 10px; margin-bottom: 20px; padding-bottom: 10px;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h2 class="h4">
                            @if (session()->get('lang') == 'english')
                                {{ $enbt->newsCategory->category_en ?? 'News' }}
                            @else
                                {{ $enbt->newsCategory->category_bn ?? 'সংবাদ' }}
                            @endif
                        </h2>

                        @if (!empty($enbt->newsCategory->slug))
                            <a href="{{ route('getCate.news', $enbt->newsCategory->slug) }}"
                                style="font-size: 15px; font-weight: bold;">
                                {{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}
                            </a>
                        @endif
                    </div>
                </div>

                <div class="main-content">
                    <!-- Middle News -->
                    <div class="middle-news">
                        <div class="image-block">
                            @php
                                $isPlaceholder = Str::contains($enbt->thumbnail, 'via.placeholder.com');
                                $imageToShow =
                                    !$isPlaceholder && !empty($enbt->thumbnail)
                                        ? $enbt->thumbnail
                                        : asset('uploads/default_images/deafult_thumbnail.jpg');
                            @endphp
                            <a
                                href="{{ route('showFull.news', [
                                    'category' => $enbt->newsCategory->slug ?? 'news',
                                    'subcategory' => $enbt->newsSubcategory->slug ?? '',
                                    'id' => $enbt->id,
                                ]) }}">
                                <img src="{{ $imageToShow }}" alt="{{ $enbt->title_en ?? 'News' }}">
                            </a>
                        </div>
                        <div class="text-block">
                            <h3>
                                <a
                                    href="{{ route('showFull.news', [
                                        'category' => $enbt->newsCategory->slug ?? 'news',
                                        'subcategory' => $enbt->newsSubcategory->slug ?? '',
                                        'id' => $enbt->id,
                                    ]) }}">
                                    @if (session()->get('lang') == 'english')
                                        {{ $enbt->title_en ?? 'No Title' }}
                                    @else
                                        {{ $enbt->title_bn ?? 'শিরোনাম নেই' }}
                                    @endif
                                </a>
                            </h3>
                            <p>
                                @if (session()->get('lang') == 'english')
                                    {!! $enbt->details_en ? Str::limit($enbt->details_en, 200, '...') : 'No details available.' !!}
                                @else
                                    {!! $enbt->details_bn ? Str::limit($enbt->details_bn, 200, '...') : 'বিস্তারিত নেই।' !!}
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Right News -->
                    @if (isset($enrn) && $enrn->count())
                        <div class="right-news">
                            @foreach ($enrn as $row)
                                <div class="right-news-item">
                                    <div class="text-left">
                                        <h4>
                                            <a
                                                href="{{ route('showFull.news', [
                                                    'category' => $row->newsCategory->slug ?? 'news',
                                                    'subcategory' => $row->newsSubcategory->slug ?? '',
                                                    'id' => $row->id,
                                                ]) }}">
                                                @if (session()->get('lang') == 'english')
                                                    {{ $row->title_en ?? 'No Title' }}
                                                @else
                                                    {{ $row->title_bn ?? 'শিরোনাম নেই' }}
                                                @endif
                                            </a>
                                        </h4>
                                        <p>
                                            <a
                                                href="{{ route('showFull.news', [
                                                    'category' => $row->newsCategory->slug ?? 'news',
                                                    'subcategory' => $row->newsSubcategory->slug ?? '',
                                                    'id' => $row->id,
                                                ]) }}">
                                                @if (session()->get('lang') == 'english')
                                                    {!! $row->details_en ? Str::limit($row->details_en, 120, '...') : 'No details available.' !!}
                                                @else
                                                    {!! $row->details_bn ? Str::limit($row->details_bn, 120, '...') : 'বিস্তারিত নেই।' !!}
                                                @endif
                                            </a>
                                        </p>
                                    </div>
                                    <div class="image-right">
                                        @php
                                            $isPlaceholder = Str::contains($row->thumbnail, 'via.placeholder.com');
                                            $imageToShow =
                                                !$isPlaceholder && !empty($row->thumbnail)
                                                    ? $row->thumbnail
                                                    : asset('uploads/default_images/deafult_thumbnail.jpg');
                                        @endphp
                                        <a
                                            href="{{ route('showFull.news', [
                                                'category' => $row->newsCategory->slug ?? 'news',
                                                'subcategory' => $row->newsSubcategory->slug ?? '',
                                                'id' => $row->id,
                                            ]) }}">
                                            <img src="{{ $imageToShow }}" alt="{{ $row->title_en ?? 'News' }}">
                                        </a>
                                    </div>
                                </div>
                                @if (!$loop->last)
                                    <hr>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endif


        <style>
            /* === General Section Styles === */
            .entertainment-section {
                margin: 20px 0;
            }

            .section-title {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }

            .section-title h2 {
                font-size: 24px;
                font-weight: 700;
                margin: 0;
            }

            .section-title a {
                font-size: 15px;
                font-weight: bold;
            }

            /* === Middle News === */
            .middle-news {
                display: flex;
                flex-direction: column;
                gap: 15px;
                margin-bottom: 30px;
            }

            .middle-news .image-block img {
                width: 100%;
                border-radius: 8px;
                object-fit: cover;
            }

            .middle-news .text-block h3,
            .middle-news .text-block h3 a {
                color: #000 !important;
                /* black title */
                font-size: 24px;
                margin: 10px 0 5px 0;
            }

            .middle-news .text-block p {
                color: #666 !important;
                /* gray paragraph */
                font-size: 14px;
                margin: 0;
            }

            /* === Right News === */
            .right-news .right-news-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                /* vertically center text and image */
                gap: 15px;
                margin-bottom: 15px;
                flex-wrap: nowrap;
            }

            .right-news .text-left h4,
            .right-news .text-left h4 a {
                color: #000 !important;
                /* black title */
                font-size: 18px;
                margin-bottom: 5px;
            }

            .right-news .text-left p,
            .right-news .text-left p a {
                color: #666 !important;
                /* gray paragraph */
                font-size: 14px;
                margin: 0;
            }

            .right-news .image-right img {
                width: 150px;
                height: 85px;
                object-fit: cover;
                border-radius: 8px;
                flex-shrink: 0;
            }

            /* === Responsive Styles === */

            /* Tablet & Mobile (max-width: 991px) */
            @media (max-width: 991px) {
                .main-content {
                    display: flex;
                    flex-direction: column;
                    gap: 30px;
                }

                .middle-news {
                    width: 100%;
                    margin-bottom: 30px;
                }

                .right-news {
                    width: 100%;
                }

                .right-news .right-news-item {
                    flex-direction: row;
                    /* keep text-left / image-right */
                    align-items: center;
                    /* vertically center */
                    gap: 15px;
                }

                .right-news .text-left {
                    flex-basis: calc(100% - 140px);
                    /* slightly smaller image */
                }

                .right-news .image-right img {
                    width: 140px;
                    height: 80px;
                }
            }

            /* Desktop (min-width: 992px) */
            @media (min-width: 992px) {
                .main-content {
                    display: flex;
                    gap: 30px;
                    align-items: flex-start;
                }

                .middle-news {
                    flex: 2;
                    max-width: 66.66%;
                    margin-bottom: 0;
                }

                .right-news {
                    flex: 1;
                    max-width: 33.33%;
                }

                .right-news .right-news-item {
                    flex-direction: row;
                    align-items: center;
                    /* vertically center text and image */
                }

                .right-news .text-left {
                    flex-basis: calc(100% - 165px);
                }

                .right-news .image-right img {
                    width: 150px;
                    height: 85px;
                }
            }
        </style>




        {{-- Entertainment Section News End --}}


        {{-- Country Section News Start --}}
        <div class="container">

            {{-- Section Title --}}
            @if (isset($cnbt) && $cnbt && isset($cnbt->newsCategory))
                <div class="post--items-title" style="border-top: none">
                    <div class="title-row">
                        <h2>
                            @if (session()->get('lang') == 'english')
                                {{ $cnbt->newsCategory->category_en ?? 'News' }}
                            @else
                                {{ $cnbt->newsCategory->category_bn ?? 'সংবাদ' }}
                            @endif
                        </h2>
                        @if (!empty($cnbt->newsCategory->slug))
                            <a href="{{ route('getCate.news', $cnbt->newsCategory->slug) }}">
                                {{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}
                            </a>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Filter Row --}}
            <div class="country-filter-container">
                <div class="country-filter-row">
                    <div class="country-filter-inputs">
                        <div class="country-filter-col">
                            <select name="division_id" id="division_id">
                                <option value="">
                                    {{ session()->get('lang') == 'english' ? 'Division' : 'বিভাগ' }}
                                </option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}">
                                        {{ session()->get('lang') == 'english' ? $division->division_en : $division->division_bn }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="country-filter-col">
                            <select name="dist_id" id="dist_id">
                                <option value="">
                                    {{ session()->get('lang') == 'english' ? 'District' : 'জেলা' }}
                                </option>
                            </select>
                        </div>
                        <div class="country-filter-col">
                            <select name="sub_dist_id" id="sub_dist_id">
                                <option value="">
                                    {{ session()->get('lang') == 'english' ? 'Subdistrict' : 'উপজেলা' }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="country-filter-button-col">
                        <button class="country-filter-button">
                            {{ session()->get('lang') == 'english' ? 'Search' : 'খুঁজুন' }}
                        </button>
                    </div>
                </div>
            </div>

            {{-- News Columns --}}
            <div class="main--content">
                <div class="post--items post--items-1">
                    <div class="news-grid">

                        {{-- Left Column --}}
                        @if (isset($cn1) && count($cn1))
                            <div class="news-column news-column-1">
                                <div class="news-items">
                                    @foreach ($cn1 as $row)
                                        <div class="news-item">
                                            <div class="post--img">
                                                @php
                                                    $isPlaceholder = Str::contains(
                                                        $row->thumbnail ?? '',
                                                        'via.placeholder.com',
                                                    );
                                                    $imageToShow =
                                                        !$isPlaceholder && !empty($row->thumbnail)
                                                            ? $row->thumbnail
                                                            : asset('uploads/default_images/deafult_thumbnail.jpg');
                                                @endphp
                                                <a
                                                    href="{{ route('showFull.news', [
                                                        'category' => $row->newsCategory->slug ?? 'news',
                                                        'subcategory' => $row->newsSubcategory->slug ?? '',
                                                        'id' => $row->id,
                                                    ]) }}">
                                                    <img src="{{ $imageToShow }}"
                                                        alt="{{ $row->title_en ?? 'News' }}" class="img-rounded">
                                                </a>
                                                <div class="post--info">
                                                    <h2>
                                                        <a
                                                            href="{{ route('showFull.news', [
                                                                'category' => $row->newsCategory->slug ?? 'news',
                                                                'subcategory' => $row->newsSubcategory->slug ?? '',
                                                                'id' => $row->id,
                                                            ]) }}">
                                                            @if (session()->get('lang') == 'english')
                                                                {{ $row->title_en ?? 'No Title' }}
                                                            @else
                                                                {{ $row->title_bn ?? 'শিরোনাম নেই' }}
                                                            @endif
                                                        </a>
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Middle Column --}}
                        @if (isset($cn2) && count($cn2))
                            <div class="news-column news-column-2">
                                <div class="news-items">
                                    @foreach ($cn2 as $row)
                                        <div class="news-item">
                                            <div class="post--img">
                                                @php
                                                    $isPlaceholder = Str::contains(
                                                        $row->thumbnail ?? '',
                                                        'via.placeholder.com',
                                                    );
                                                    $imageToShow =
                                                        !$isPlaceholder && !empty($row->thumbnail)
                                                            ? $row->thumbnail
                                                            : asset('uploads/default_images/deafult_thumbnail.jpg');
                                                @endphp
                                                <a
                                                    href="{{ route('showFull.news', [
                                                        'category' => $row->newsCategory->slug ?? 'news',
                                                        'subcategory' => $row->newsSubcategory->slug ?? '',
                                                        'id' => $row->id,
                                                    ]) }}">
                                                    <img src="{{ $imageToShow }}"
                                                        alt="{{ $row->title_en ?? 'News' }}" class="img-rounded">
                                                </a>
                                                <div class="post--info">
                                                    <h2>
                                                        <a
                                                            href="{{ route('showFull.news', [
                                                                'category' => $row->newsCategory->slug ?? 'news',
                                                                'subcategory' => $row->newsSubcategory->slug ?? '',
                                                                'id' => $row->id,
                                                            ]) }}">
                                                            @if (session()->get('lang') == 'english')
                                                                {{ $row->title_en ?? 'No Title' }}
                                                            @else
                                                                {{ $row->title_bn ?? 'শিরোনাম নেই' }}
                                                            @endif
                                                        </a>
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Main News Column --}}
                        @if (isset($cnbt) && $cnbt)
                            <div class="news-main">
                                <div class="post--img">
                                    @php
                                        $isPlaceholder = Str::contains($cnbt->thumbnail ?? '', 'via.placeholder.com');
                                        $imageToShow =
                                            !$isPlaceholder && !empty($cnbt->thumbnail)
                                                ? $cnbt->thumbnail
                                                : asset('uploads/default_images/deafult_thumbnail.jpg');
                                    @endphp
                                    <a
                                        href="{{ route('showFull.news', [
                                            'category' => $cnbt->newsCategory->slug ?? 'news',
                                            'subcategory' => $cnbt->newsSubcategory->slug ?? '',
                                            'id' => $cnbt->id,
                                        ]) }}">
                                        <img src="{{ $imageToShow }}" alt="{{ $cnbt->title_en ?? 'News' }}"
                                            class="img-rounded">
                                    </a>
                                    <div class="post--info">
                                        <h2>
                                            <a
                                                href="{{ route('showFull.news', [
                                                    'category' => $cnbt->newsCategory->slug ?? 'news',
                                                    'subcategory' => $cnbt->newsSubcategory->slug ?? '',
                                                    'id' => $cnbt->id,
                                                ]) }}">
                                                @if (session()->get('lang') == 'english')
                                                    {{ $cnbt->title_en ?? 'No Title' }}
                                                @else
                                                    {{ $cnbt->title_bn ?? 'শিরোনাম নেই' }}
                                                @endif
                                            </a>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

        </div>

        <style>
            /* Container */
            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 15px;
            }

            /* Section title */
            .post--items-title {
                border-bottom: 2px solid #e0e0e0;
                margin: 10px 0 20px;
                padding-bottom: 10px;
            }

            .post--items-title .title-row {
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
            }

            .post--items-title h2 {
                margin: 0;
                color: #000;
            }

            .post--items-title a {
                font-size: 15px;
                font-weight: bold;
                text-decoration: none;
            }

            /* Filter / Search */
            .country-filter-container {
                margin-bottom: 25px;
            }

            .country-filter-row {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
            }

            .country-filter-inputs {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                flex: 1;
            }

            .country-filter-col {
                flex: 1 1 auto;
                min-width: 120px;
            }

            .country-filter-col select {
                width: 100%;
                padding: 10px;
                border-radius: 8px;
                border: 2px solid #ccc;
                font-size: 14px;
                cursor: pointer;
            }

            .country-filter-button-col {
                flex: none;
                min-width: 120px;
            }

            .country-filter-button {
                width: 100%;
                padding: 12px;
                font-weight: bold;
                background: #1b84ff;
                color: #fff;
                border: none;
                border-radius: 8px;
                cursor: pointer;
            }

            /* News Grid */
            .news-grid {
                display: flex;
                gap: 15px;
            }

            .news-column,
            .news-main {
                display: flex;
                flex-direction: column;
                gap: 15px;
            }

            .news-column-1,
            .news-column-2 {
                flex: 1;
            }

            .news-main {
                flex: 2;
            }

            /* News Item */
            .post--img {
                position: relative;
            }

            .post--img img.img-rounded {
                border-radius: 12px;
                width: 100%;
                height: auto;
                object-fit: cover;
            }

            .post--info h2 {
                margin-top: 8px;
                font-size: 18px;
                line-height: 1.3;
                color: #000;
            }

            .post--info h2 a {
                color: #000;
                text-decoration: none;
            }

            .post--info h2 a:hover {
                text-decoration: underline;
            }

            /* Responsive - Tablet and Mobile */
            @media (max-width: 991px) {

                /* Filter - Inputs in row, button full width below */
                .country-filter-row {
                    flex-direction: column;
                }

                .country-filter-button-col {
                    margin-top: 10px;
                    width: 100%;
                }

                /* News columns */
                .news-grid {
                    flex-direction: column;
                    gap: 15px;
                }

                .news-column-1 .news-items,
                .news-column-2 .news-items {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 10px;
                }

                .news-column-1 .news-item,
                .news-column-2 .news-item {
                    flex: 0 0 calc(50% - 5px);
                }

                .news-main {
                    width: 100%;
                    margin-top: 15px;
                }
            }
        </style>
        {{-- Country Section News end --}}

        {{-- International Section News Start --}}


        <div class="intl-container">

            {{-- Section Title --}}
            @if (isset($innbt) && $innbt && isset($innbt->newsCategory))
                <div class="intl-section-title">
                    <div class="intl-title-wrap">
                        <h2 class="intl-heading">
                            @if (session()->get('lang') == 'english')
                                {{ $innbt->newsCategory->category_en ?? 'International' }}
                            @else
                                {{ $innbt->newsCategory->category_bn ?? 'আন্তর্জাতিক' }}
                            @endif
                        </h2>
                        @if (!empty($innbt->newsCategory->slug))
                            <a href="{{ route('getCate.news', $innbt->newsCategory->slug) }}" class="intl-more-link">
                                {{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}
                            </a>
                        @endif
                    </div>
                </div>
            @endif

            <div class="intl-main-content">
                <div class="intl-grid">

                    {{-- Main News --}}
                    @if (isset($innbt) && $innbt)
                        @php
                            $isPlaceholder = Str::contains($innbt->thumbnail ?? '', 'via.placeholder.com');
                            $imageToShow =
                                !$isPlaceholder && !empty($innbt->thumbnail)
                                    ? $innbt->thumbnail
                                    : asset('uploads/default_images/deafult_thumbnail.jpg');
                        @endphp
                        <div class="intl-col intl-main-news">
                            <div class="intl-post-img">
                                <a
                                    href="{{ route('showFull.news', [
                                        'category' => $innbt->newsCategory->slug ?? 'news',
                                        'subcategory' => $innbt->newsSubcategory->slug ?? '',
                                        'id' => $innbt->id,
                                    ]) }}">
                                    <img src="{{ $imageToShow }}" alt="{{ $innbt->title_en ?? 'News' }}">
                                </a>
                                <div class="intl-post-info">
                                    <h2>
                                        <a
                                            href="{{ route('showFull.news', [
                                                'category' => $innbt->newsCategory->slug ?? 'news',
                                                'subcategory' => $innbt->newsSubcategory->slug ?? '',
                                                'id' => $innbt->id,
                                            ]) }}">
                                            @if (session()->get('lang') == 'english')
                                                {{ $innbt->title_en ?? 'No Title' }}
                                            @else
                                                {{ $innbt->title_bn ?? 'শিরোনাম নেই' }}
                                            @endif
                                        </a>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Middle 2 News --}}
                    @if (isset($inn2) && count($inn2))
                        <div class="intl-col intl-middle-news">
                            @foreach ($inn2 as $row)
                                @php
                                    $isPlaceholder = Str::contains($row->thumbnail ?? '', 'via.placeholder.com');
                                    $imageToShow =
                                        !$isPlaceholder && !empty($row->thumbnail)
                                            ? $row->thumbnail
                                            : asset('uploads/default_images/deafult_thumbnail.jpg');
                                @endphp
                                <div class="intl-post-img">
                                    <a
                                        href="{{ route('showFull.news', [
                                            'category' => $row->newsCategory->slug ?? 'news',
                                            'subcategory' => $row->newsSubcategory->slug ?? '',
                                            'id' => $row->id,
                                        ]) }}">
                                        <img src="{{ $imageToShow }}" alt="{{ $row->title_en ?? 'News' }}">
                                    </a>
                                    <div class="intl-post-info">
                                        <h3>
                                            <a
                                                href="{{ route('showFull.news', [
                                                    'category' => $row->newsCategory->slug ?? 'news',
                                                    'subcategory' => $row->newsSubcategory->slug ?? '',
                                                    'id' => $row->id,
                                                ]) }}">
                                                @if (session()->get('lang') == 'english')
                                                    {{ $row->title_en ?? 'No Title' }}
                                                @else
                                                    {{ $row->title_bn ?? 'শিরোনাম নেই' }}
                                                @endif
                                            </a>
                                        </h3>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Right 4 News --}}
                    @if (isset($inn4) && count($inn4))
                        <div class="intl-col intl-right-news">
                            @foreach ($inn4 as $row)
                                @php
                                    $isPlaceholder = Str::contains($row->thumbnail ?? '', 'via.placeholder.com');
                                    $imageToShow =
                                        !$isPlaceholder && !empty($row->thumbnail)
                                            ? $row->thumbnail
                                            : asset('uploads/default_images/deafult_thumbnail.jpg');
                                @endphp
                                <div class="intl-flex-item">
                                    <div class="intl-flex-text">
                                        <h4>
                                            <a
                                                href="{{ route('showFull.news', [
                                                    'category' => $row->newsCategory->slug ?? 'news',
                                                    'subcategory' => $row->newsSubcategory->slug ?? '',
                                                    'id' => $row->id,
                                                ]) }}">
                                                @if (session()->get('lang') == 'english')
                                                    {{ $row->title_en ?? 'No Title' }}
                                                @else
                                                    {{ $row->title_bn ?? 'শিরোনাম নেই' }}
                                                @endif
                                            </a>
                                        </h4>
                                    </div>
                                    <div class="intl-flex-img">
                                        <a
                                            href="{{ route('showFull.news', [
                                                'category' => $row->newsCategory->slug ?? 'news',
                                                'subcategory' => $row->newsSubcategory->slug ?? '',
                                                'id' => $row->id,
                                            ]) }}">
                                            <img src="{{ $imageToShow }}" alt="{{ $row->title_en ?? 'News' }}">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <style>
            /* ===== Base ===== */
            .intl-container {
                margin-top: 20px;
            }

            .intl-section-title {
                border-bottom: 2px solid #e0e0e0;
                margin-bottom: 15px;
                padding-bottom: 10px;
            }

            .intl-title-wrap {
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
            }

            .intl-heading {
                font-size: 20px;
                margin: 0;
            }

            .intl-more-link {
                font-size: 14px;
                font-weight: bold;
                text-decoration: none;
            }

            /* ===== Desktop Layout ===== */
            .intl-grid {
                display: grid;
                grid-template-columns: 2fr 1fr 1.5fr;
                /* main / middle / right */
                gap: 20px;
            }

            .intl-post-img img {
                width: 100%;
                height: auto;
                /* keep natural height */
                border-radius: 8px;
            }

            .intl-right-news .intl-flex-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 10px;
                margin-bottom: 12px;
            }

            .intl-right-news .intl-flex-text {
                flex: 2;
            }

            .intl-right-news .intl-flex-img {
                flex: 1;
                max-width: 120px;
            }

            .intl-right-news .intl-flex-img img {
                width: 100%;
                height: auto;
                /* no cut */
                border-radius: 5px;
            }

            /* Make all news titles black */
            .intl-post-info h2 a,
            .intl-post-info h3 a,
            .intl-flex-text h4 a {
                color: #000 !important;
                text-decoration: none;
                font-weight: 600;
                /* optional: bold for better readability */
            }

            /* Optional hover color */
            .intl-post-info h2 a:hover,
            .intl-post-info h3 a:hover,
            .intl-flex-text h4 a:hover {
                color: #d32f2f;
                /* or any color you want on hover */
            }



            /* ===== Responsive (Tablet & Mobile) ===== */
            @media (max-width: 991px) {
                .intl-grid {
                    grid-template-columns: 1fr;
                    gap: 15px;
                }

                /* Middle 2 -> 2 per row */
                .intl-middle-news {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 12px;
                }

                /* Right 4 -> 2 per row, stack img+text */
                .intl-right-news {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 12px;
                }

                .intl-right-news .intl-flex-item {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .intl-right-news .intl-flex-img {
                    max-width: 100%;
                    margin-top: 6px;
                }
            }
        </style>
        {{-- International Section News End --}}



        {{-- Sports Section News Start --}}
        <div class="sports-section">
            <div class="sports-title">
                <h2>
                    @if (session()->get('lang') == 'english')
                        {{ $snbt->newsCategory->category_en ?? 'Sports' }}
                    @else
                        {{ $snbt->newsCategory->category_bn ?? 'স্পোর্টস' }}
                    @endif
                </h2>
                @if (!empty($snbt?->newsCategory?->slug))
                    <a href="{{ route('getCate.news', $snbt->newsCategory->slug) }}">
                        {{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}
                    </a>
                @endif
            </div>

            <div class="sports-grid">
                {{-- Left Column (2 news) --}}
                @if (!empty($sn2) && count($sn2) > 0)
                    <div class="sports-left">
                        @foreach ($sn2 as $row)
                            @php
                                $isPlaceholder = Str::contains($row->thumbnail ?? '', 'via.placeholder.com');
                                $imageToShow =
                                    !$isPlaceholder && !empty($row->thumbnail)
                                        ? $row->thumbnail
                                        : asset('uploads/default_images/deafult_thumbnail.jpg');
                            @endphp
                            <div class="sports-item">
                                <a href="{{ route('showFull.news', [
                                    'category' => $row->newsCategory->slug ?? '#',
                                    'subcategory' => $row->newsSubcategory->slug ?? '#',
                                    'id' => $row->id ?? 0,
                                ]) }}"
                                    class="thumb">
                                    <img src="{{ $imageToShow }}" alt="{{ $row->title_en ?? 'No title' }}">
                                </a>
                                <h3>
                                    <a
                                        href="{{ route('showFull.news', [
                                            'category' => $row->newsCategory->slug ?? '#',
                                            'subcategory' => $row->newsSubcategory->slug ?? '#',
                                            'id' => $row->id ?? 0,
                                        ]) }}">
                                        @if (session()->get('lang') == 'english')
                                            {{ $row->title_en ?? 'No title' }}
                                        @else
                                            {{ $row->title_bn ?? 'কোনো শিরোনাম নেই' }}
                                        @endif
                                    </a>
                                </h3>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Middle Column (big thumbnail) --}}
                @if (!empty($snbt))
                    @php
                        $isPlaceholder = Str::contains($snbt->thumbnail ?? '', 'via.placeholder.com');
                        $imageToShow =
                            !$isPlaceholder && !empty($snbt->thumbnail)
                                ? $snbt->thumbnail
                                : asset('uploads/default_images/deafult_thumbnail.jpg');
                    @endphp
                    <div class="sports-middle">
                        <a href="{{ route('showFull.news', [
                            'category' => $snbt->newsCategory->slug ?? '#',
                            'subcategory' => $snbt->newsSubcategory->slug ?? '#',
                            'id' => $snbt->id ?? 0,
                        ]) }}"
                            class="thumb">
                            <img src="{{ $imageToShow }}" alt="{{ $snbt->title_en ?? 'No title' }}">
                        </a>
                        <h2>
                            <a
                                href="{{ route('showFull.news', [
                                    'category' => $snbt->newsCategory->slug ?? '#',
                                    'subcategory' => $snbt->newsSubcategory->slug ?? '#',
                                    'id' => $snbt->id ?? 0,
                                ]) }}">
                                @if (session()->get('lang') == 'english')
                                    {{ $snbt->title_en ?? 'No title' }}
                                @else
                                    {{ $snbt->title_bn ?? 'কোনো শিরোনাম নেই' }}
                                @endif
                            </a>
                        </h2>
                        <a
                            href="{{ route('showFull.news', [
                                'category' => $snbt->newsCategory->slug ?? '#',
                                'subcategory' => $snbt->newsSubcategory->slug ?? '#',
                                'id' => $snbt->id ?? 0,
                            ]) }}">
                            @if (session()->get('lang') == 'english')
                                {!! Str::limit($snbt->details_en ?? '', 200, '...') !!}
                            @else
                                {!! Str::limit($snbt->details_bn ?? '', 200, '...') !!}
                            @endif
                        </a>
                    </div>
                @endif

                {{-- Right Column (4 news) --}}
                @if (!empty($sn4) && count($sn4) > 0)
                    <div class="sports-right">
                        @foreach ($sn4 as $row)
                            @php
                                $isPlaceholder = Str::contains($row->thumbnail ?? '', 'via.placeholder.com');
                                $imageToShow =
                                    !$isPlaceholder && !empty($row->thumbnail)
                                        ? $row->thumbnail
                                        : asset('uploads/default_images/deafult_thumbnail.jpg');
                            @endphp
                            <div class="sports-item-row">
                                <div class="sports-text">
                                    <a
                                        href="{{ route('showFull.news', [
                                            'category' => $row->newsCategory->slug ?? '#',
                                            'subcategory' => $row->newsSubcategory->slug ?? '#',
                                            'id' => $row->id ?? 0,
                                        ]) }}">
                                        @if (session()->get('lang') == 'english')
                                            {{ $row->title_en ?? 'No title' }}
                                        @else
                                            {{ $row->title_bn ?? 'কোনো শিরোনাম নেই' }}
                                        @endif
                                    </a>
                                </div>
                                <div class="sports-thumb">
                                    <a
                                        href="{{ route('showFull.news', [
                                            'category' => $row->newsCategory->slug ?? '#',
                                            'subcategory' => $row->newsSubcategory->slug ?? '#',
                                            'id' => $row->id ?? 0,
                                        ]) }}">
                                        <img src="{{ $imageToShow }}" alt="{{ $row->title_en ?? 'No title' }}">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        {{-- Sports Section News End --}}

        <style>
            /* Sports Section Base */
            .sports-section {
                margin: 20px 0;
            }

            .sports-title {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 2px solid #e0e0e0;
                margin-bottom: 20px;
                padding-bottom: 10px;
            }

            .sports-title h2 a {
                margin: 0;
                font-size: 20px;
                color: black !important;
            }

            .sports-title a {
                font-size: 15px;
                font-weight: bold;
                text-decoration: none;
                color: gray !important;
            }

            /* Grid layout */
            .sports-grid {
                display: grid;
                grid-template-columns: 1fr 2fr 1fr;
                gap: 20px;
            }

            /* Left */
            .sports-left {
                display: flex;
                flex-direction: column;
                gap: 20px;
            }

            .sports-left .sports-item img {
                width: 100%;
                border-radius: 10px;
            }

            .sports-left h3 {
                font-size: 16px;
                margin-top: 8px;
                color: black !important;
            }

            .sports-item h3 a {
                color: #000 !important;
                font-size: 18px;
            }

            /* Middle */
            .sports-middle img {
                width: 100%;
                border-radius: 10px;
            }

            .sports-middle h2 a {
                font-size: 24px;
                margin: 5px 0 5px;
                color: black !important;
                font-weight: bold;
            }

            .sports-middle a {
                font-size: 14px;
                color: gray !important;
            }

            /* Right */
            .sports-right {
                display: flex;
                flex-direction: column;
                gap: 15px;
            }

            .sports-item-row {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .sports-item-row img {
                width: 100%;
                max-width: 130px;
                /* slightly bigger */
                border-radius: 10px;
            }

            .sports-text {
                flex: 1;
            }

            .sports-text a {
                color: #000 !important;
            }


            /* Responsive */
            @media (max-width: 991px) {
                .sports-grid {
                    grid-template-columns: 1fr;
                }

                /* Left 2 news in row */
                .sports-left {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 15px;
                }

                /* Middle full row */
                .sports-middle {
                    margin-top: 20px;
                }

                /* Right 4 news in 2x2 grid */
                .sports-right {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 15px;
                    margin-top: 20px;
                }

                .sports-item-row {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .sports-item-row img {
                    max-width: 100%;
                }
            }
        </style>


        {{-- Lifestyle Section News Start --}}
        <div class="lifestyle-section">
            {{-- Section Header --}}
            @if (isset($lsnbt) && $lsnbt?->newsCategory)
                <div class="lifestyle-section-header">
                    <h2 class="lifestyle-section-title">
                        {{ session('lang') === 'english'
                            ? $lsnbt->newsCategory->category_en ?? ''
                            : $lsnbt->newsCategory->category_bn ?? '' }}
                    </h2>
                    @if (!empty($lsnbt->newsCategory->slug))
                        <a href="{{ route('getCate.news', $lsnbt->newsCategory->slug) }}" class="lifestyle-more-link">
                            {{ session('lang') === 'english' ? 'More' : 'আরও' }}
                        </a>
                    @endif
                </div>
            @endif

            <div class="lifestyle-news-container">
                <div class="lifestyle-news-grid">
                    {{-- Left Column --}}
                    <div class="lifestyle-left-column">
                        {{-- Featured Article --}}
                        @if (!empty($lsnbt))
                            @php
                                $featuredThumb = $lsnbt->thumbnail ?? '';
                                $featuredImg =
                                    !empty($featuredThumb) && !Str::contains($featuredThumb, 'via.placeholder.com')
                                        ? $featuredThumb
                                        : asset('uploads/default_images/deafult_thumbnail.jpg');
                            @endphp
                            <div class="lifestyle-featured-article">
                                <a
                                    href="{{ route('showFull.news', [
                                        'category' => optional($lsnbt->newsCategory)->slug ?? '',
                                        'subcategory' => optional($lsnbt->newsSubcategory)->slug ?? '',
                                        'id' => $lsnbt->id ?? 0,
                                    ]) }}">
                                    <img src="{{ $featuredImg }}" alt="{{ $lsnbt->title_en ?? '' }}"
                                        class="lifestyle-featured-img">
                                </a>
                                <div class="lifestyle-featured-content">
                                    <h3 class="lifestyle-featured-title">
                                        <a
                                            href="{{ route('showFull.news', [
                                                'category' => optional($lsnbt->newsCategory)->slug ?? '',
                                                'subcategory' => optional($lsnbt->newsSubcategory)->slug ?? '',
                                                'id' => $lsnbt->id ?? 0,
                                            ]) }}">
                                            {{ session('lang') === 'english' ? $lsnbt->title_en ?? '' : $lsnbt->title_bn ?? '' }}
                                        </a>
                                    </h3>
                                    <p class="lifestyle-featured-excerpt">
                                        {{ session('lang') === 'english'
                                            ? Str::limit($lsnbt->details_en ?? '', 150, '...')
                                            : Str::limit($lsnbt->details_bn ?? '', 150, '...') }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        {{-- Prepare small-news collection --}}
                        @php
                            $smallNewsCollection = collect();
                            if (
                                !empty($smallNews) &&
                                (is_array($smallNews) || $smallNews instanceof \Illuminate\Support\Collection)
                            ) {
                                $smallNewsCollection = collect($smallNews);
                            } elseif (!empty($row)) {
                                $smallNewsCollection = collect([$row]);
                            }
                        @endphp

                        {{-- Small News --}}
                        @foreach ($smallNewsCollection as $rowItem)
                            @php
                                $thumb = $rowItem->thumbnail ?? '';
                                $smallImg =
                                    !empty($thumb) && !Str::contains($thumb, 'via.placeholder.com')
                                        ? $thumb
                                        : asset('uploads/default_images/deafult_thumbnail.jpg');
                            @endphp
                            <div class="lifestyle-small-news-item">
                                <a
                                    href="{{ route('showFull.news', [
                                        'category' => optional($rowItem->newsCategory)->slug ?? '',
                                        'subcategory' => optional($rowItem->newsSubcategory)->slug ?? '',
                                        'id' => $rowItem->id ?? 0,
                                    ]) }}">
                                    <img src="{{ $smallImg }}" alt="{{ $rowItem->title_en ?? '' }}"
                                        class="lifestyle-small-news-img">
                                </a>
                                <div class="lifestyle-small-news-content">
                                    <h4 class="lifestyle-small-news-title">
                                        <a
                                            href="{{ route('showFull.news', [
                                                'category' => optional($rowItem->newsCategory)->slug ?? '',
                                                'subcategory' => optional($rowItem->newsSubcategory)->slug ?? '',
                                                'id' => $rowItem->id ?? 0,
                                            ]) }}">
                                            {{ session('lang') === 'english' ? $rowItem->title_en ?? '' : $rowItem->title_bn ?? '' }}
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Right Column: 4 News --}}
                    <div class="lifestyle-right-column">
                        @if (!empty($sn4) && (is_array($sn4) || $sn4 instanceof \Illuminate\Support\Collection))
                            @foreach ($sn4 as $news)
                                @php
                                    $thumb = $news->thumbnail ?? '';
                                    $newsImg =
                                        !empty($thumb) && !Str::contains($thumb, 'via.placeholder.com')
                                            ? $thumb
                                            : asset('uploads/default_images/deafult_thumbnail.jpg');
                                @endphp
                                <div class="lifestyle-news-item lifestyle-news-item-horizontal">
                                    <div class="lifestyle-news-item-content">
                                        <h4 class="lifestyle-news-item-title">
                                            <a style="color: #000; font-size: 14px; font-weight: bold;"
                                                href="{{ route('showFull.news', [
                                                    'category' => optional($news->newsCategory)->slug ?? '',
                                                    'subcategory' => optional($news->newsSubcategory)->slug ?? '',
                                                    'id' => $news->id ?? 0,
                                                ]) }}">
                                                {{ session('lang') === 'english' ? $news->title_en ?? '' : $news->title_bn ?? '' }}
                                            </a>
                                        </h4>
                                    </div>
                                    <a
                                        href="{{ route('showFull.news', [
                                            'category' => optional($news->newsCategory)->slug ?? '',
                                            'subcategory' => optional($news->newsSubcategory)->slug ?? '',
                                            'id' => $news->id ?? 0,
                                        ]) }}">
                                        <img src="{{ $newsImg }}" alt="{{ $news->title_en ?? '' }}"
                                            class="lifestyle-news-item-img">
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                {{-- Voting Poll --}}
                <div class="lifestyle-sidebar-poll">
                    <div class="lifestyle-poll-widget">
                        <h3 class="lifestyle-poll-title">
                            {{ session('lang') === 'english' ? '📊 Voting Poll' : '📊 অনলাইন জরিপ' }}
                        </h3>
                        <div class="lifestyle-poll-question">
                            {{ session('lang') === 'english'
                                ? 'Do you think the cost of sending money to mobile phone should be reduced?'
                                : 'আপনি কি মনে করেন মোবাইল ফোনে টাকা পাঠানোর খরচ কমানো উচিত?' }}
                        </div>
                        <form class="lifestyle-poll-form">
                            <div class="lifestyle-poll-options">
                                <div class="lifestyle-poll-option">
                                    <label>
                                        <input type="radio" name="poll" value="yes">
                                        {{ session('lang') === 'english' ? 'Yes' : 'হ্যাঁ' }}
                                    </label>
                                    <span class="lifestyle-poll-percentage">65%</span>
                                </div>
                                <div class="lifestyle-progress-bar">
                                    <div class="lifestyle-progress-fill" style="width:65%;"></div>
                                </div>

                                <div class="lifestyle-poll-option">
                                    <label>
                                        <input type="radio" name="poll" value="no">
                                        {{ session('lang') === 'english' ? 'No' : 'না' }}
                                    </label>
                                    <span class="lifestyle-poll-percentage">28%</span>
                                </div>
                                <div class="lifestyle-progress-bar">
                                    <div class="lifestyle-progress-fill" style="width:28%;"></div>
                                </div>

                                <div class="lifestyle-poll-option">
                                    <label>
                                        <input type="radio" name="poll" value="average">
                                        {{ session('lang') === 'english' ? 'Average' : 'মাঝামাঝি' }}
                                    </label>
                                    <span class="lifestyle-poll-percentage">7%</span>
                                </div>
                                <div class="lifestyle-progress-bar">
                                    <div class="lifestyle-progress-fill" style="width:7%;"></div>
                                </div>
                            </div>
                            <button type="submit" class="lifestyle-vote-btn">
                                {{ session('lang') === 'english' ? 'Vote Now' : 'ভোট দিন' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Lifestyle Section End --}}


        {{-- Scoped CSS (same as before, scoped to .lifestyle-section) --}}
        <style>
            /* Base */
            .lifestyle-section {
                margin-top: 30px;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                max-width: 1200px;
                margin-left: auto;
                margin-right: auto;
                padding: 0 20px;
            }

            .lifestyle-section * {
                box-sizing: border-box;
            }

            /* Header */
            .lifestyle-section-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 25px;
                border-bottom: 3px solid #007bff;
                padding-bottom: 15px;
            }

            .lifestyle-section-title {
                font-size: 28px;
                font-weight: bold;
                color: #333;
                margin: 0;
            }

            .lifestyle-more-link {
                font-size: 16px;
                font-weight: 600;
                color: #007bff;
                text-decoration: none;
                padding: 8px 16px;
                border-radius: 20px;
                transition: all 0.3s ease;
            }

            .lifestyle-more-link:hover {
                background-color: #007bff;
                color: #fff;
                transform: translateY(-1px);
            }

            /* Container & Grid */
            .lifestyle-news-container {
                display: grid;
                gap: 30px;
            }

            @media(min-width:1024px) {
                .lifestyle-news-container {
                    grid-template-columns: 2fr 1fr;
                }
            }

            @media(max-width:1023px) {
                .lifestyle-news-container {
                    grid-template-columns: 1fr;
                }
            }

            .lifestyle-news-grid {
                display: grid;
                gap: 25px;
                background: white;
                padding: 25px;
                border-radius: 15px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            }

            @media(min-width:1024px) {
                .lifestyle-news-grid {
                    grid-template-columns: 1fr 1fr;
                }
            }

            @media(max-width:1023px) {
                .lifestyle-news-grid {
                    grid-template-columns: 1fr;
                }
            }

            /* Left Column / Featured */
            .lifestyle-left-column {
                display: flex;
                flex-direction: column;
                gap: 20px;
            }

            .lifestyle-featured-article {
                background: #fff;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            }

            .lifestyle-featured-article:hover {
                transform: translateY(-3px);
                box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
            }

            .lifestyle-featured-img {
                width: 100%;
                height: auto;
                object-fit: contain;
                border-radius: 12px 12px 0 0;
                transition: transform 0.3s ease;
            }

            .lifestyle-featured-article:hover .lifestyle-featured-img {
                transform: scale(1.02);
            }

            .lifestyle-featured-content {
                padding: 20px;
            }

            .lifestyle-featured-title {
                font-size: 20px;
                font-weight: bold;
                margin: 0 0 12px 0;
                line-height: 1.4;
            }

            .lifestyle-featured-title a {
                color: #333;
                text-decoration: none;
                transition: color 0.3s ease;
            }

            .lifestyle-featured-title a:hover {
                color: #007bff;
            }

            .lifestyle-featured-excerpt {
                font-size: 14px;
                color: #666;
                line-height: 1.6;
                margin: 0;
            }

            /* Small News */
            .lifestyle-small-news-item {
                display: flex;
                gap: 15px;
                background: #fff;
                padding: 15px;
                border-radius: 12px;
                box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
                align-items: center;
                transition: all 0.3s ease;
            }

            .lifestyle-small-news-item:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.12);
            }

            .lifestyle-small-news-img {
                width: 120px;
                height: 80px;
                object-fit: cover;
                border-radius: 8px;
                flex-shrink: 0;
                transition: transform 0.3s ease;
            }

            .lifestyle-small-news-item:hover .lifestyle-small-news-img {
                transform: scale(1.05);
            }

            .lifestyle-small-news-content {
                flex: 1;
            }

            .lifestyle-small-news-title {
                font-size: 16px;
                font-weight: 600;
                margin: 0;
                line-height: 1.4;
            }

            .lifestyle-small-news-title a {
                color: #333;
                text-decoration: none;
                transition: color 0.3s ease;
            }

            .lifestyle-small-news-title a:hover {
                color: #007bff;
            }

            /* Right Column / Horizontal news items */
            .lifestyle-right-column {
                display: flex;
                flex-direction: column;
                gap: 15px;
            }

            .lifestyle-news-item-horizontal {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 15px;
                background: #fff;
                padding: 15px;
                border-radius: 12px;
                box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            }

            .lifestyle-news-item-horizontal:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.12);
            }

            .lifestyle-news-item-horizontal .lifestyle-news-item-content {
                flex: 1;
            }

            .lifestyle-news-item-img {
                width: 120px;
                height: 80px;
                object-fit: cover;
                border-radius: 8px;
                flex-shrink: 0;
                transition: transform 0.3s ease;
            }

            .lifestyle-news-item-horizontal:hover .lifestyle-news-item-img {
                transform: scale(1.05);
            }

            /* Sidebar Poll */
            .lifestyle-sidebar-poll {
                background: white;
                padding: 25px;
                border-radius: 15px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                height: fit-content;
            }

            @media(min-width:1024px) {
                .lifestyle-sidebar-poll {
                    position: sticky;
                    top: 20px;
                }
            }

            @media(max-width:1023px) {
                .lifestyle-sidebar-poll {
                    width: 100%;
                    margin-top: 0;
                }
            }

            /* Poll widget styles */
            .lifestyle-poll-widget {
                text-align: center;
            }

            .lifestyle-poll-title {
                font-size: 22px;
                font-weight: bold;
                color: #333;
                margin: 0 0 20px 0;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
            }

            .lifestyle-poll-question {
                font-size: 16px;
                font-weight: 500;
                color: #555;
                margin-bottom: 25px;
                line-height: 1.5;
                text-align: left;
            }

            .lifestyle-poll-option {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 12px;
                padding: 12px;
                background: #f8f9fa;
                border-radius: 8px;
                transition: background-color 0.3s ease;
            }

            .lifestyle-poll-option:hover {
                background: #e9ecef;
            }

            .lifestyle-poll-option input[type="radio"] {
                margin: 0;
                transform: scale(1.2);
            }

            .lifestyle-poll-percentage {
                font-weight: bold;
                color: #007bff;
                font-size: 14px;
            }

            .lifestyle-progress-bar {
                width: 100%;
                height: 6px;
                background: #e9ecef;
                border-radius: 3px;
                margin-bottom: 15px;
                overflow: hidden;
            }

            .lifestyle-progress-fill {
                height: 100%;
                background: linear-gradient(90deg, #007bff, #0056b3);
                border-radius: 3px;
                transition: width 0.5s ease;
            }

            .lifestyle-vote-btn {
                background: linear-gradient(135deg, #007bff, #0056b3);
                color: white;
                border: none;
                padding: 14px 30px;
                border-radius: 25px;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                width: 100%;
                transition: all 0.3s ease;
            }

            .lifestyle-vote-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(0, 123, 255, 0.3);
            }

            /* Show 2 news in 1 row on mobile & tablet */
            @media (max-width: 1023px) {
                .lifestyle-right-column {
                    display: grid;
                    grid-template-columns: repeat(2, 1fr);
                    gap: 15px;
                }

                /* Make each news item stack internally */
                .lifestyle-right-column .lifestyle-news-item-horizontal {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .lifestyle-right-column .lifestyle-news-item-img {
                    width: 100%;
                    height: auto;
                    margin-top: 8px;
                }
            }


            @media(max-width:768px) {
                .lifestyle-featured-img {
                    height: 200px;
                }

                .lifestyle-news-grid {
                    padding: 20px;
                }

                .lifestyle-section-title {
                    font-size: 24px;
                }

                .lifestyle-small-news-img,
                .lifestyle-news-item-img {
                    width: 100px;
                    height: 70px;
                }

                .lifestyle-small-news-title,
                .lifestyle-news-item-title {
                    font-size: 14px;
                }

                .lifestyle-poll-title {
                    font-size: 20px;
                }

                .lifestyle-poll-question {
                    font-size: 14px;
                }
            }

            @media(max-width:480px) {

                .lifestyle-small-news-img,
                .lifestyle-news-item-img {
                    width: 80px;
                    height: 60px;
                }

                .lifestyle-featured-img {
                    height: 180px;
                }

                .lifestyle-news-grid {
                    padding: 15px;
                }
            }
        </style>
        {{-- Lifestyle Section News End --}}




        {{-- Custom CSS for Responsive News Section --}}

        <style>
            .custom-news-wrapper {
                margin-top: 30px;
            }

            .custom-section-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }

            .custom-main-container {
                display: flex;
                gap: 30px;
            }

            .custom-content-area {
                flex: 2;
            }

            .custom-sidebar-area {
                flex: 1;
                min-width: 300px;
                position: sticky;
                top: 20px;
                align-self: flex-start;
            }

            .custom-top-section {
                display: flex;
                gap: 20px;
                margin-bottom: 30px;
            }

            /* Desktop: 8/4 layout (66.67% / 33.33%) */
            .custom-main-news {
                flex: 2;
            }

            .custom-main-news img {
                width: 100%;
                height: auto;
                object-fit: contain;
                border-radius: 5px;
            }

            .custom-right-news {
                flex: 1;
            }

            .custom-right-news-item {
                display: flex;
                align-items: center;
                gap: 15px;
                margin-bottom: 15px;
            }

            .custom-right-news-item:last-child {
                margin-bottom: 0;
            }

            .custom-right-text {
                flex: 1;
            }

            .custom-right-image {
                flex-shrink: 0;
                width: 120px;
                height: auto;
            }

            .custom-right-image img {
                width: 100%;
                height: auto;
                object-fit: contain;
                border-radius: 4px;
            }

            .custom-bottom-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
                margin-top: 30px;
            }

            .custom-bottom-item {
                display: flex;
                align-items: flex-start;
                gap: 15px;
            }

            .custom-bottom-content {
                flex: 1;
            }

            .custom-bottom-image {
                flex-shrink: 0;
                width: 180px;
                height: auto;
            }

            .custom-bottom-image img {
                width: 100%;
                height: auto;
                object-fit: contain;
                border-radius: 4px;
            }

            .calendar-container {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100%;
                margin-top: 30px;
                padding: 0 15px;
            }

            .calendar-box {
                width: 100%;
                max-width: 300px;
                text-align: center;
            }

            .no-data-message {
                text-align: center;
                padding: 40px 20px;
                background-color: #f8f9fa;
                border-radius: 8px;
                color: #6c757d;
                font-style: italic;
            }

            /* Tags Widget Scrollable Desktop */
            .tags--widget.style--3 {
                max-height: 500px;
                /* fixed height for desktop */
                overflow-y: auto;
                /* vertical scroll if content overflows */
                padding-right: 5px;
                /* space for scrollbar */
            }

            .tags--widget.style--3::-webkit-scrollbar {
                width: 6px;
            }

            .tags--widget.style--3::-webkit-scrollbar-thumb {
                background-color: rgba(0, 0, 0, 0.2);
                border-radius: 3px;
            }

            .tags--widget.style--3::-webkit-scrollbar-track {
                background-color: transparent;
            }

            /* Mobile Styles */
            @media (max-width: 767px) {

                .custom-main-container {
                    flex-direction: column;
                    gap: 20px;
                }

                .custom-sidebar-area {
                    min-width: auto;
                    position: static;
                }

                .custom-top-section {
                    flex-direction: column;
                    gap: 25px;
                }

                .custom-main-news {
                    flex: none;
                    order: 1;
                }

                .custom-main-news img {
                    height: auto !important;
                    object-fit: contain !important;
                }

                .custom-right-news {
                    flex: none;
                    order: 2;
                    overflow-x: auto;
                    padding-bottom: 10px;
                    margin: 0 -15px;
                    -webkit-overflow-scrolling: touch;
                    scroll-behavior: smooth;
                    scrollbar-width: none;
                    -ms-overflow-style: none;
                }

                .custom-right-news::-webkit-scrollbar {
                    display: none;
                }

                .custom-right-news-container {
                    display: flex;
                    gap: 12px;
                    min-width: max-content;
                    padding: 0 15px;
                    touch-action: pan-x;
                }

                .custom-right-news-item {
                    flex-direction: column;
                    min-width: 50vw;
                    max-width: 60vw;
                    text-align: center;
                    margin-bottom: 0;
                }

                .custom-right-text {
                    order: 2;
                }

                .custom-right-text h4 {
                    font-size: 14px;
                    line-height: 1.3;
                    margin: 10px 0 0 0;
                }

                .custom-right-image {
                    max-width: none;
                    width: 100%;
                    height: auto !important;
                    order: 1;
                }

                .custom-right-image img {
                    width: 100%;
                    height: auto !important;
                    object-fit: contain !important;
                    border-radius: 4px;
                }

                .custom-bottom-grid {
                    grid-template-columns: 1fr;
                    gap: 15px;
                }

                .custom-tags-hide {
                    display: none;
                }

                .custom-sidebar-area {
                    width: 100% !important;
                    flex: none !important;
                    max-width: 100% !important;
                    position: static !important;
                    margin-top: 20px;
                }

                .calendar-container {
                    width: 100% !important;
                    padding: 0 !important;
                    margin-top: 20px !important;
                    justify-content: center;
                }

                .calendar-box {
                    max-width: none !important;
                    width: 100% !important;
                    min-width: auto !important;
                    font-size: 16px;
                    margin: 0;
                    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                    border-radius: 8px;
                    overflow: hidden;
                }
            }

            @media (max-width: 480px) {
                .custom-right-news-item {
                    min-width: 55vw;
                    max-width: 65vw;
                }

                .custom-right-text h4 {
                    font-size: 13px;
                }
            }

            @media (max-width: 991px) and (min-width: 768px) {
                .custom-tags-hide {
                    display: none;
                }

                .custom-main-container {
                    gap: 20px;
                    flex-direction: column;
                }

                .custom-sidebar-area {
                    width: 100% !important;
                    flex: none !important;
                    max-width: 100% !important;
                    position: static !important;
                    margin-top: 20px;
                }

                .calendar-container {
                    width: 100% !important;
                    padding: 0 !important;
                    margin-top: 20px !important;
                    justify-content: center;
                }

                .calendar-box {
                    max-width: none !important;
                    width: 100% !important;
                    min-width: auto !important;
                }
            }

            @media (min-width: 992px) and (max-width: 1200px) {
                .calendar-box {
                    max-width: 350px;
                }

                .tags--widget.style--3 {
                    max-height: 500px;
                    overflow-y: auto;
                    padding-right: 5px;
                }

                .tags--widget.style--3::-webkit-scrollbar {
                    width: 6px;
                }

                .tags--widget.style--3::-webkit-scrollbar-thumb {
                    background-color: rgba(0, 0, 0, 0.2);
                    border-radius: 3px;
                }

                .tags--widget.style--3::-webkit-scrollbar-track {
                    background-color: transparent;
                }
            }

            @media (min-width: 1200px) {
                /* extra large screens - keep original styling */
            }
        </style>


        {{-- Law-Order Section News Start --}}
        <div class="custom-news-wrapper">
            <div class="main--content" data-sticky-content="true">
                <div class="sticky-content-inner">

                    {{-- Section Title --}}
                    @if (!empty($lonbt) && isset($lonbt->newsCategory) && $lonbt->newsCategory)
                        <div class="custom-section-header">
                            <h2 class="h4">
                                @if (session()->get('lang') == 'english')
                                    {{ $lonbt->newsCategory->category_en ?? 'News' }}
                                @else
                                    {{ $lonbt->newsCategory->category_bn ?? 'খবর' }}
                                @endif
                            </h2>
                            <a href="{{ route('getCate.news', $lonbt->newsCategory->slug ?? '#') }}"
                                style="font-size: 15px; font-weight: bold">
                                {{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}
                            </a>
                        </div>
                    @else
                        <div class="custom-section-header">
                            <h2 class="h4">
                                {{ session()->get('lang') == 'english' ? 'Latest News' : 'সর্বশেষ খবর' }}
                            </h2>
                        </div>
                    @endif

                    <div class="custom-main-container">
                        {{-- Main Content --}}
                        <div class="custom-content-area">

                            {{-- Check if we have any news data --}}
                            @if (!empty($lonbt) || (!empty($lonrn3) && count($lonrn3) > 0) || (!empty($lon4) && count($lon4) > 0))

                                {{-- Top News Section --}}
                                <div class="custom-top-section">

                                    {{-- Left Main News --}}
                                    @if (!empty($lonbt))
                                        <div class="custom-main-news">
                                            <div class="post--img">
                                                @php
                                                    $isPlaceholder = Str::contains(
                                                        $lonbt->thumbnail ?? '',
                                                        'via.placeholder.com',
                                                    );
                                                    $imageToShow =
                                                        !$isPlaceholder && !empty($lonbt->thumbnail)
                                                            ? $lonbt->thumbnail
                                                            : asset('uploads/default_images/deafult_thumbnail.jpg');
                                                @endphp

                                                <a href="{{ route('showFull.news', [
                                                    'category' => optional($lonbt->newsCategory)->slug ?? 'news',
                                                    'subcategory' => optional($lonbt->newsSubcategory)->slug ?? 'general',
                                                    'id' => $lonbt->id ?? 0,
                                                ]) }}"
                                                    class="thumb">
                                                    <img src="{{ $imageToShow }}"
                                                        alt="{{ $lonbt->title_en ?? 'News' }}" class="img-fluid">
                                                </a>

                                                <div class="post--info">
                                                    <div class="title">
                                                        <h2 class="h4" style="font-size: 24px; margin-top: 10px">
                                                            <a href="{{ route('showFull.news', [
                                                                'category' => optional($lonbt->newsCategory)->slug ?? 'news',
                                                                'subcategory' => optional($lonbt->newsSubcategory)->slug ?? 'general',
                                                                'id' => $lonbt->id ?? 0,
                                                            ]) }}"
                                                                class="btn-link">
                                                                @if (session()->get('lang') == 'english')
                                                                    {{ $lonbt->title_en ?? 'No Title Available' }}
                                                                @else
                                                                    {{ $lonbt->title_bn ?? 'শিরোনাম নেই' }}
                                                                @endif
                                                            </a>
                                                        </h2>
                                                        <p style="font-size: 16px; ">
                                                            @if (session()->get('lang') == 'english')
                                                                {!! Str::limit($lonbt->details_en ?? '', 150, '...') !!}
                                                            @else
                                                                {!! Str::limit($lonbt->details_bn ?? '', 150, '...') !!}
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="custom-main-news">
                                            <div class="no-data-message">
                                                {{ session()->get('lang') == 'english' ? 'No featured news available' : 'কোনো প্রধান খবর নেই' }}
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Right 3 News --}}
                                    <div class="custom-right-news">
                                        <div class="custom-right-news-container">
                                            @forelse ($lonrn3 ?? [] as $row)
                                                <div class="custom-right-news-item">
                                                    <div class="custom-right-text">
                                                        <h4>
                                                            <a href="{{ route('showFull.news', [
                                                                'category' => optional($row->newsCategory)->slug ?? 'news',
                                                                'subcategory' => optional($row->newsSubcategory)->slug ?? 'general',
                                                                'id' => $row->id ?? 0,
                                                            ]) }}"
                                                                style="color: #333; text-decoration: none;">
                                                                {{ session()->get('lang') == 'english' ? $row->title_en ?? 'No Title' : $row->title_bn ?? 'শিরোনাম নেই' }}
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div class="custom-right-image">
                                                        @php
                                                            $isPlaceholder = Str::contains(
                                                                $row->thumbnail ?? '',
                                                                'via.placeholder.com',
                                                            );
                                                            $imageToShow =
                                                                !$isPlaceholder && !empty($row->thumbnail)
                                                                    ? $row->thumbnail
                                                                    : asset(
                                                                        'uploads/default_images/deafult_thumbnail.jpg',
                                                                    );
                                                        @endphp
                                                        <a href="{{ route('showFull.news', [
                                                            'category' => optional($row->newsCategory)->slug ?? 'news',
                                                            'subcategory' => optional($row->newsSubcategory)->slug ?? 'general',
                                                            'id' => $row->id ?? 0,
                                                        ]) }}"
                                                            class="thumb">
                                                            <img src="{{ $imageToShow }}"
                                                                alt="{{ $row->title_en ?? 'News' }}" class="img-fluid">
                                                        </a>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="no-data-message" style="min-width: 200px;">
                                                    {{ session()->get('lang') == 'english' ? 'No recent news available' : 'কোনো সাম্প্রতিক খবর নেই' }}
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>

                                {{-- Bottom 4 News Grid --}}
                                <div class="custom-bottom-grid">
                                    @forelse ($lon4 ?? [] as $row)
                                        <div class="custom-bottom-item">
                                            <div class="custom-bottom-content">
                                                <h4>
                                                    <a href="{{ route('showFull.news', [
                                                        'category' => optional($row->newsCategory)->slug ?? 'news',
                                                        'subcategory' => optional($row->newsSubcategory)->slug ?? 'general',
                                                        'id' => $row->id ?? 0,
                                                    ]) }}"
                                                        style="color: #333; text-decoration: none;">
                                                        {{ session()->get('lang') == 'english' ? $row->title_en ?? 'No Title' : $row->title_bn ?? 'শিরোনাম নেই' }}
                                                    </a>
                                                </h4>
                                                <div>
                                                    @if (session()->get('lang') == 'english')
                                                        {!! Str::limit($row->details_en ?? '', 80, '...') !!}
                                                    @else
                                                        {!! Str::limit($row->details_bn ?? '', 100, '...') !!}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="custom-bottom-image">
                                                @php
                                                    $isPlaceholder = Str::contains(
                                                        $row->thumbnail ?? '',
                                                        'via.placeholder.com',
                                                    );
                                                    $imageToShow =
                                                        !$isPlaceholder && !empty($row->thumbnail)
                                                            ? $row->thumbnail
                                                            : asset('uploads/default_images/deafult_thumbnail.jpg');
                                                @endphp
                                                <a href="{{ route('showFull.news', [
                                                    'category' => optional($row->newsCategory)->slug ?? 'news',
                                                    'subcategory' => optional($row->newsSubcategory)->slug ?? 'general',
                                                    'id' => $row->id ?? 0,
                                                ]) }}"
                                                    class="thumb">
                                                    <img src="{{ $imageToShow }}"
                                                        alt="{{ $row->title_en ?? 'News' }}" class="img-fluid">
                                                </a>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="no-data-message" style="grid-column: 1 / -1;">
                                            {{ session()->get('lang') == 'english' ? 'No additional news available' : 'কোনো অতিরিক্ত খবর নেই' }}
                                        </div>
                                    @endforelse
                                </div>
                            @else
                                {{-- No data available message --}}
                                <div class="no-data-message">
                                    <h3>{{ session()->get('lang') == 'english' ? 'No News Available' : 'কোনো খবর পাওয়া যায়নি' }}
                                    </h3>
                                    <p>{{ session()->get('lang') == 'english' ? 'Please check back later for updates.' : 'আপডেটের জন্য পরে চেক করুন।' }}
                                    </p>
                                </div>
                            @endif

                        </div>

                        {{-- Sidebar --}}
                        <div class="custom-sidebar-area">
                            <div class="sticky-content-inner">
                                {{-- Tags Widget --}}
                                @if (!empty($tagsWithNewsCount) && $tagsWithNewsCount->count() > 0)
                                    <div class="widget custom-tags-hide">
                                        <div class="widget--title">
                                            <h2 class="h4">
                                                {{ session()->get('lang') == 'english' ? 'TAGS' : 'ট্যাগ সমূহ' }}
                                            </h2>
                                            <i class="icon fa fa-tags"></i>
                                        </div>
                                        <div class="tags--widget style--3">
                                            <ul class="nav">
                                                @foreach ($tagsWithNewsCount as $tag)
                                                    <li>
                                                        <a href="{{ route('tag.news', $tag->slug) }}">
                                                            {{ session()->get('lang') == 'english' ? $tag->tag_en : $tag->tag_bn }}
                                                            <span>{{ $tag->news_count }}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                {{-- Calendar Widget - Always Visible --}}
                                <div class="calendar-container">
                                    <div class="calendar-box">
                                        <div style="background-color: #F0F0F0; margin-top: -10px; padding: 0;">
                                            <h4 style="padding: 15px 0 20px 0">
                                                {{ session()->get('lang') == 'english' ? 'Archive' : 'আর্কাইভ' }}
                                            </h4>
                                            <div class="calendar-header">
                                                <select id="yearSelect"></select>
                                                <select id="monthSelect"></select>
                                            </div>
                                            <div class="calendar-days" style="border-bottom: 1px solid black;">
                                                <div>রবি</div>
                                                <div>সোম</div>
                                                <div>মঙ্গল</div>
                                                <div>বুধ</div>
                                                <div>বৃহঃ</div>
                                                <div>শুক্র</div>
                                                <div>শনি</div>
                                            </div>
                                        </div>
                                        <div class="calendar-dates" id="calendarDates"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> {{-- /.custom-main-container --}}
                </div>
            </div>
        </div>

        {{-- Law-Order Section News End --}}

        {{-- Video & Photo Gallery Section News Start --}}
        <style>
            .gallery-container {
                margin-top: 30px;
            }

            .gallery-row {
                display: flex;
                gap: 30px;
                flex-wrap: wrap;
            }

            .gallery-column {
                flex: 1;
                min-width: 300px;
            }

            .section-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
                border-top: 3px solid #e74c3c;
                padding-top: 15px;
            }

            .section-title {
                font-size: 20px;
                font-weight: bold;
                color: #333;
                margin: 0;
            }

            .more-link {
                font-size: 15px;
                font-weight: bold;
                color: #e74c3c;
                text-decoration: none;
            }

            .more-link:hover {
                color: #c0392b;
            }

            .main-video-container,
            .main-photo-container {
                margin-bottom: 30px;
            }

            .video-wrapper {
                position: relative;
                cursor: pointer;
                margin-bottom: 15px;
            }

            .video-wrapper img,
            .main-photo img {
                width: 100%;
                height: 433px;
                object-fit: cover;
                border-radius: 5px;
            }

            .play-overlay {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: rgba(231, 76, 60, 0.8);
                border-radius: 50%;
                width: 60px;
                height: 60px;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
            }

            .play-overlay i {
                font-size: 24px;
                color: white;
                margin-left: 3px;
            }

            .play-overlay:hover {
                background: rgba(231, 76, 60, 1);
                transform: translate(-50%, -50%) scale(1.1);
            }

            .main-title h4 {
                font-size: 18px;
                color: #333;
                margin: 10px 0;
                line-height: 1.4;
            }

            .main-title a {
                color: #333;
                text-decoration: none;
            }

            .main-title a:hover {
                color: #e74c3c;
            }

            .small-items-container {
                position: relative;
            }

            .small-items-row {
                display: flex;
                gap: 15px;
                overflow-x: hidden;
                transition: transform 0.3s ease;
            }

            .small-item {
                flex: 0 0 calc(33.333% - 10px);
                margin-top: 15px;
            }

            .small-video-wrapper {
                position: relative;
                cursor: pointer;
                margin-bottom: 10px;
            }

            .small-video-wrapper img,
            .small-photo img {
                width: 100%;
                height: 130px;
                object-fit: cover;
                border-radius: 5px;
            }

            .small-play-overlay {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: rgba(231, 76, 60, 0.8);
                border-radius: 50%;
                width: 35px;
                height: 35px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .small-play-overlay i {
                font-size: 14px;
                color: white;
                margin-left: 2px;
            }

            .small-title h2 {
                font-size: 14px;
                color: #333;
                margin: 10px 0;
                line-height: 1.3;
            }

            .small-title a {
                color: #333;
                text-decoration: none;
            }

            .small-title a:hover {
                color: #e74c3c;
            }

            .no-data {
                text-align: center;
                padding: 40px 20px;
                color: #666;
                font-size: 16px;
            }

            .slider-controls {
                display: none;
                justify-content: center;
                gap: 10px;
                margin-top: 15px;
            }

            .slider-btn {
                background: #e74c3c;
                color: white;
                border: none;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: background 0.3s ease;
            }

            .slider-btn:hover {
                background: #c0392b;
            }

            .slider-btn:disabled {
                background: #ccc;
                cursor: not-allowed;
            }

            /* Mobile and Tablet Responsive */
            @media (max-width: 768px) {
                .gallery-row {
                    flex-direction: column;
                    gap: 40px;
                }

                .gallery-column {
                    min-width: auto;
                }

                .small-items-row {
                    overflow-x: auto;
                    scroll-behavior: smooth;
                    -webkit-overflow-scrolling: touch;
                    scrollbar-width: none;
                    -ms-overflow-style: none;
                }

                .small-items-row::-webkit-scrollbar {
                    display: none;
                }

                .small-item {
                    flex: 0 0 250px;
                }

                .slider-controls {
                    display: flex;
                }
            }

            @media (max-width: 480px) {
                .gallery-container {
                    margin-top: 20px;
                    padding: 0 10px;
                }

                .section-title {
                    font-size: 18px;
                }

                .small-item {
                    flex: 0 0 220px;
                }

                .video-wrapper img,
                .main-photo img {
                    height: 250px;
                }
            }
        </style>

        <div class="gallery-container">
            <div class="main--content">
                <div class="post--items post--items-1 pd--30-0">
                    <div class="gallery-row">
                        {{-- Video Section --}}
                        <div class="gallery-column">
                            {{-- Video Section Header --}}
                            <div class="section-header">
                                <h2 class="section-title">
                                    @if (session()->get('lang') == 'english')
                                        Video Gallery
                                    @else
                                        ভিডিও গ্যালারী
                                    @endif
                                </h2>
                                <a href="{{ route('video.gallery') }}" class="more-link">
                                    {{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}
                                </a>
                            </div>

                            @if (isset($vgnbt) && !empty($vgnbt))
                                {{-- Main Video --}}
                                <div class="main-video-container">
                                    @php
                                        $iframeSrc = null;
                                        $videoId = null;

                                        if (!empty($vgnbt->embed_code)) {
                                            if (preg_match('/src="([^"]+)"/', $vgnbt->embed_code, $matches)) {
                                                $iframeSrc = $matches[1] ?? null;

                                                if ($iframeSrc && str_contains($iframeSrc, 'youtube.com')) {
                                                    if (preg_match('/embed\/([^\?&"]+)/', $iframeSrc, $idMatch)) {
                                                        $videoId = $idMatch[1] ?? null;
                                                    }
                                                }
                                            }
                                        }
                                    @endphp

                                    @if ($iframeSrc)
                                        <div class="video-wrapper">
                                            <a data-fancybox data-type="iframe" href="{{ $iframeSrc }}">
                                                @if ($videoId)
                                                    <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                                        alt="Video Thumbnail">
                                                @else
                                                    <img src="{{ asset('default-thumb.jpg') }}" alt="Default Thumbnail">
                                                @endif

                                                <div class="play-overlay">
                                                    <i class="fa fa-play"></i>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="main-title">
                                            <h4>
                                                <a
                                                    href="{{ isset($vgnbt->newsCategory) && isset($vgnbt->newsSubcategory) ? route('showFull.news', ['category' => $vgnbt->newsCategory->slug, 'subcategory' => $vgnbt->newsSubcategory->slug, 'id' => $vgnbt->id]) : '#' }}">
                                                    {{ session('lang') == 'english' ? $vgnbt->title_en ?? 'No Title' : $vgnbt->title_bn ?? 'শিরোনাম নেই' }}
                                                </a>
                                            </h4>
                                        </div>
                                    @endif
                                </div>

                                {{-- Small Videos --}}
                                @if (isset($vgn3) && count($vgn3) > 0)
                                    <div class="small-items-container">
                                        <div class="small-items-row" id="videoSlider">
                                            @foreach ($vgn3 as $row)
                                                <div class="small-item">
                                                    @php
                                                        $iframeSrc = null;
                                                        $videoId = null;
                                                        if (!empty($row->embed_code)) {
                                                            if (
                                                                preg_match(
                                                                    '/src="([^"]+)"/',
                                                                    $row->embed_code,
                                                                    $matches,
                                                                )
                                                            ) {
                                                                $iframeSrc = $matches[1] ?? null;
                                                                if (
                                                                    $iframeSrc &&
                                                                    Str::contains($iframeSrc, 'youtube.com')
                                                                ) {
                                                                    if (
                                                                        preg_match(
                                                                            '/embed\/([^\?&"]+)/',
                                                                            $iframeSrc,
                                                                            $idMatch,
                                                                        )
                                                                    ) {
                                                                        $videoId = $idMatch[1] ?? null;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    @endphp

                                                    @if ($iframeSrc)
                                                        <div class="small-video-wrapper">
                                                            <a data-fancybox data-type="iframe"
                                                                href="{{ $iframeSrc }}">
                                                                @if ($videoId)
                                                                    <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                                                        alt="Video Thumbnail">
                                                                @else
                                                                    <img src="{{ asset('default-thumb.jpg') }}"
                                                                        alt="Default Thumbnail">
                                                                @endif
                                                                <div class="small-play-overlay">
                                                                    <i class="fa fa-play"></i>
                                                                </div>
                                                            </a>
                                                        </div>

                                                        <div class="small-title">
                                                            <h2>
                                                                <a
                                                                    href="{{ isset($row->newsCategory) && isset($row->newsSubcategory) ? route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) : '#' }}">
                                                                    @if (session()->get('lang') == 'english')
                                                                        {{ \Illuminate\Support\Str::limit($row->title_en ?? 'No Title', 38) }}
                                                                    @else
                                                                        {{ \Illuminate\Support\Str::limit($row->title_bn ?? 'শিরোনাম নেই', 38) }}
                                                                    @endif
                                                                </a>
                                                            </h2>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="slider-controls">
                                            <button class="slider-btn" id="videoPrev">
                                                <i class="fa fa-chevron-left"></i>
                                            </button>
                                            <button class="slider-btn" id="videoNext">
                                                <i class="fa fa-chevron-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="no-data">
                                    {{ session()->get('lang') == 'english' ? 'No videos available' : 'কোনো ভিডিও পাওয়া যায়নি' }}
                                </div>
                            @endif
                        </div>

                        {{-- Photo Section --}}
                        <div class="gallery-column">
                            {{-- Photo Section Header --}}
                            <div class="section-header">
                                <h2 class="section-title">
                                    @if (session()->get('lang') == 'bangla')
                                        ফটো গ্যালারী
                                    @else
                                        Photo Gallery
                                    @endif
                                </h2>
                                <a href="{{ isset($pgnbt->newsCategory) ? route('getCate.news', $pgnbt->newsCategory->slug) : '#' }}"
                                    class="more-link">
                                    {{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}
                                </a>
                            </div>

                            @if (isset($pgnbt) && !empty($pgnbt))
                                {{-- Main Photo --}}
                                <div class="main-photo-container">
                                    @php
                                        $isPlaceholder = isset($pgnbt->thumbnail)
                                            ? Str::contains($pgnbt->thumbnail, 'via.placeholder.com')
                                            : true;
                                        $imageToShow =
                                            !$isPlaceholder && !empty($pgnbt->thumbnail)
                                                ? $pgnbt->thumbnail
                                                : $pgnbt->image ?? asset('default-thumb.jpg');
                                    @endphp

                                    <div class="main-photo">
                                        <a data-fancybox href="{{ $imageToShow }}">
                                            <img src="{{ $imageToShow }}" alt="{{ $pgnbt->title_en ?? 'Photo' }}">
                                        </a>
                                    </div>

                                    <div class="main-title">
                                        <h4>
                                            <a data-fancybox href="{{ $imageToShow }}">
                                                {{ session('lang') == 'english' ? $pgnbt->title_en ?? 'No Title' : $pgnbt->title_bn ?? 'শিরোনাম নেই' }}
                                            </a>
                                        </h4>
                                    </div>
                                </div>

                                {{-- Small Photos --}}
                                @if (isset($pgn3) && count($pgn3) > 0)
                                    <div class="small-items-container">
                                        <div class="small-items-row" id="photoSlider">
                                            @foreach ($pgn3 as $row)
                                                <div class="small-item">
                                                    @php
                                                        $isPlaceholder = isset($row->thumbnail)
                                                            ? Str::contains($row->thumbnail, 'via.placeholder.com')
                                                            : true;
                                                        $imageToShow =
                                                            !$isPlaceholder && !empty($row->thumbnail)
                                                                ? $row->thumbnail
                                                                : $row->image ?? asset('default-thumb.jpg');
                                                    @endphp

                                                    <div class="small-photo">
                                                        <a data-fancybox href="{{ $imageToShow }}">
                                                            <img src="{{ $imageToShow }}"
                                                                alt="{{ $row->title_en ?? 'Photo' }}">
                                                        </a>
                                                    </div>

                                                    <div class="small-title">
                                                        <h2>
                                                            <a data-fancybox href="{{ $imageToShow }}">
                                                                {{ session('lang') == 'english' ? $row->title_en ?? 'No Title' : $row->title_bn ?? 'শিরোনাম নেই' }}
                                                            </a>
                                                        </h2>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="slider-controls">
                                            <button class="slider-btn" id="photoPrev">
                                                <i class="fa fa-chevron-left"></i>
                                            </button>
                                            <button class="slider-btn" id="photoNext">
                                                <i class="fa fa-chevron-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="no-data">
                                    {{ session()->get('lang') == 'english' ? 'No photos available' : 'কোনো ছবি পাওয়া যায়নি' }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Video slider functionality
                const videoSlider = document.getElementById('videoSlider');
                const videoPrev = document.getElementById('videoPrev');
                const videoNext = document.getElementById('videoNext');

                if (videoSlider) {
                    let videoScrollPosition = 0;
                    const videoItemWidth = 265; // 250px + 15px gap

                    if (videoNext) {
                        videoNext.addEventListener('click', function() {
                            const maxScroll = videoSlider.scrollWidth - videoSlider.clientWidth;
                            if (videoScrollPosition < maxScroll) {
                                videoScrollPosition = Math.min(videoScrollPosition + videoItemWidth, maxScroll);
                                videoSlider.scrollTo({
                                    left: videoScrollPosition,
                                    behavior: 'smooth'
                                });
                            }
                            updateVideoButtons();
                        });
                    }

                    if (videoPrev) {
                        videoPrev.addEventListener('click', function() {
                            if (videoScrollPosition > 0) {
                                videoScrollPosition = Math.max(videoScrollPosition - videoItemWidth, 0);
                                videoSlider.scrollTo({
                                    left: videoScrollPosition,
                                    behavior: 'smooth'
                                });
                            }
                            updateVideoButtons();
                        });
                    }

                    function updateVideoButtons() {
                        if (videoPrev) videoPrev.disabled = videoScrollPosition <= 0;
                        if (videoNext) videoNext.disabled = videoScrollPosition >= videoSlider.scrollWidth - videoSlider
                            .clientWidth;
                    }

                    updateVideoButtons();
                }

                // Photo slider functionality
                const photoSlider = document.getElementById('photoSlider');
                const photoPrev = document.getElementById('photoPrev');
                const photoNext = document.getElementById('photoNext');

                if (photoSlider) {
                    let photoScrollPosition = 0;
                    const photoItemWidth = 265; // 250px + 15px gap

                    if (photoNext) {
                        photoNext.addEventListener('click', function() {
                            const maxScroll = photoSlider.scrollWidth - photoSlider.clientWidth;
                            if (photoScrollPosition < maxScroll) {
                                photoScrollPosition = Math.min(photoScrollPosition + photoItemWidth, maxScroll);
                                photoSlider.scrollTo({
                                    left: photoScrollPosition,
                                    behavior: 'smooth'
                                });
                            }
                            updatePhotoButtons();
                        });
                    }

                    if (photoPrev) {
                        photoPrev.addEventListener('click', function() {
                            if (photoScrollPosition > 0) {
                                photoScrollPosition = Math.max(photoScrollPosition - photoItemWidth, 0);
                                photoSlider.scrollTo({
                                    left: photoScrollPosition,
                                    behavior: 'smooth'
                                });
                            }
                            updatePhotoButtons();
                        });
                    }

                    function updatePhotoButtons() {
                        if (photoPrev) photoPrev.disabled = photoScrollPosition <= 0;
                        if (photoNext) photoNext.disabled = photoScrollPosition >= photoSlider.scrollWidth - photoSlider
                            .clientWidth;
                    }

                    updatePhotoButtons();
                }
            });
        </script>

        {{-- Video & Photo Gallery Section News End --}}




        {{-- =================== POLITICS & ECONOMICS SECTION =================== --}}
        <!-- Swiper CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

        <style>
            /* Desktop (keep 2 sections in 1 row, boxed) */
            .news-sections-wrapper {
                display: flex;
                gap: 20px;
                max-width: 1200px;
                margin: 30px auto 0;
            }

            /* ====== WRAPPER ====== */
            .news-sections-wrapper {
                max-width: 1200px;
                margin: 30px auto 0;
            }

            /* Each section */
            .news-section {
                flex: 1;
            }

            /* Section header */
            .section-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 2px solid #e0e0e0;
                margin-bottom: 15px;
                padding-bottom: 5px;
            }

            .section-header h2 {
                font-size: 22px;
                margin: 0;
            }

            .section-header a {
                text-decoration: none;
                font-weight: 600;
                color: #0077cc;
                font-size: 15px;
            }

            /* Section content desktop layout: 60/40 */
            .section-content {
                display: flex;
                gap: 15px;
            }

            .section-content .main-news-wrapper {
                width: 60%;
            }

            .section-content .side-news-wrapper {
                width: 40%;
                display: flex;
                flex-direction: column;
                gap: 15px;
            }

            /* Main news styles */
            .main-news img {
                width: 100%;
                height: auto;
                object-fit: contain;
                /* no crop, but may leave blank space */
            }


            .main-news h3 {
                font-size: 20px;
                margin: 6px 0;
            }

            .main-news p {
                font-size: 14px;
                color: #555;
            }

            /* Side news styles (desktop) */
            .side-news {
                display: flex;
                align-items: center;
                gap: 10px;
                border: 1px solid #e9e9e9;
                padding: 6px;
            }

            .side-news img {
                width: 100px;
                height: 80px;
                object-fit: cover;
            }

            .side-news h4 {
                font-size: 15px;
                margin: 0;
            }

            /* Slider container hidden by default */
            .swiper-container {
                display: none;
            }

            /* Slider slides */
            .swiper-slide {
                background: #fff;
                border: 1px solid #e9e9e9;
                border-radius: 4px;
                overflow: hidden;
            }

            .swiper-slide img {
                width: 100%;
                height: 180px;
                object-fit: cover;
            }

            .swiper-slide h4 {
                font-size: 15px;
                margin: 5px;
            }

            /* ====== MOBILE & TABLET ====== */
            @media(max-width:992px) {

                .news-sections-wrapper {
                    flex-direction: column;
                    /* stack sections */
                    max-width: 100% !important;
                    margin: 0 !important;
                    padding: 0 !important;
                }

                .main-news img {
                    width: 100vw;
                    /* full screen width */
                    height: auto;
                    display: block;
                }


                .section-content {
                    flex-direction: column;
                }

                /* Main news takes full width on mobile */
                .section-content .main-news-wrapper {
                    width: 100% !important;
                }

                .section-content .side-news-wrapper {
                    width: 100%;
                }

                /* COMPLETELY hide desktop side news */
                .side-news-wrapper {
                    display: none !important;
                }

                .side-news {
                    display: none !important;
                }

                /* Show slider instead */
                .swiper-container {
                    display: block !important;
                }

            }
        </style>

        <div class="news-sections-wrapper">

            {{-- =================== POLITICS =================== --}}
            <section class="news-section">
                <div class="section-header" style="border-top: none">
                    <h2>{{ session()->get('lang') == 'english' ? $pnbt->newsCategory->category_en ?? 'Politics' : $pnbt->newsCategory->category_bn ?? 'রাজনীতি' }}
                    </h2>
                    <a href="{{ isset($pnbt->newsCategory) ? route('getCate.news', $pnbt->newsCategory->slug) : '#' }}">
                        {{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}
                    </a>
                </div>

                <div class="section-content">
                    {{-- Main News --}}
                    <div class="main-news-wrapper">
                        @if ($pnbt)
                            @php
                                $img =
                                    !empty($pnbt->thumbnail) && !Str::contains($pnbt->thumbnail, 'via.placeholder.com')
                                        ? $pnbt->thumbnail
                                        : asset('uploads/default_images/deafult_thumbnail.jpg');
                            @endphp
                            <div class="main-news">
                                <a style="color: black !important"
                                    href="{{ route('showFull.news', ['category' => $pnbt->newsCategory->slug ?? '', 'subcategory' => $pnbt->newsSubcategory->slug ?? '', 'id' => $pnbt->id]) }}">
                                    <img src="{{ $img }}" alt="{{ $pnbt->title_en }}">
                                </a>
                                <h3>
                                    <a style="color: black !important"
                                        href="{{ route('showFull.news', ['category' => $pnbt->newsCategory->slug ?? '', 'subcategory' => $pnbt->newsSubcategory->slug ?? '', 'id' => $pnbt->id]) }}">
                                        {{ session()->get('lang') == 'english' ? $pnbt->title_en : $pnbt->title_bn }}
                                    </a>
                                </h3>
                                <p>{{ session()->get('lang') == 'english' ? Str::limit($pnbt->details_en, 150, '...') : Str::limit($pnbt->details_bn, 150, '...') }}
                                </p>
                            </div>
                        @endif
                    </div>

                    {{-- Side news (desktop list) --}}
                    <div class="side-news-wrapper">
                        @forelse($pn3 as $row)
                            @php
                                $img =
                                    !empty($row->thumbnail) && !Str::contains($row->thumbnail, 'via.placeholder.com')
                                        ? $row->thumbnail
                                        : asset('uploads/default_images/deafult_thumbnail.jpg');
                            @endphp
                            <div class="side-news">
                                <img src="{{ $img }}" alt="{{ $row->title_en }}">
                                <h4>
                                    <a style="color: black"
                                        href="{{ route('showFull.news', ['category' => $row->newsCategory->slug ?? '', 'subcategory' => $row->newsSubcategory->slug ?? '', 'id' => $row->id]) }}">
                                        {{ session()->get('lang') == 'english' ? $row->title_en : $row->title_bn }}
                                    </a>
                                </h4>
                            </div>
                        @empty
                            <p>No news available</p>
                        @endforelse
                    </div>

                    {{-- Slider for mobile --}}
                    <div class="swiper-container swiper-politics">
                        <div class="swiper-wrapper">
                            @foreach ($pn3 as $row)
                                @php
                                    $img =
                                        !empty($row->thumbnail) &&
                                        !Str::contains($row->thumbnail, 'via.placeholder.com')
                                            ? $row->thumbnail
                                            : asset('uploads/default_images/deafult_thumbnail.jpg');
                                @endphp
                                <div class="swiper-slide">
                                    <a style="color: black"
                                        href="{{ route('showFull.news', ['category' => $row->newsCategory->slug ?? '', 'subcategory' => $row->newsSubcategory->slug ?? '', 'id' => $row->id]) }}">
                                        <img src="{{ $img }}" alt="{{ $row->title_en }}">
                                        <h4>{{ session()->get('lang') == 'english' ? $row->title_en : $row->title_bn }}
                                        </h4>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </section>

            {{-- =================== ECONOMICS =================== --}}
            <section class="news-section">
                <div class="section-header" style="border-top: none">
                    <h2>{{ session()->get('lang') == 'english' ? $fnbt->newsCategory->category_en ?? 'Economics' : $fnbt->newsCategory->category_bn ?? 'অর্থনীতি' }}
                    </h2>
                    <a href="{{ isset($fnbt->newsCategory) ? route('getCate.news', $fnbt->newsCategory->slug) : '#' }}">
                        {{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}
                    </a>
                </div>

                <div class="section-content">
                    {{-- Main News --}}
                    <div class="main-news-wrapper">
                        @if ($fnbt)
                            @php
                                $img =
                                    !empty($fnbt->thumbnail) && !Str::contains($fnbt->thumbnail, 'via.placeholder.com')
                                        ? $fnbt->thumbnail
                                        : asset('uploads/default_images/deafult_thumbnail.jpg');
                            @endphp
                            <div class="main-news">
                                <a style="color: black; !important"
                                    href="{{ route('showFull.news', ['category' => $fnbt->newsCategory->slug ?? '', 'subcategory' => $fnbt->newsSubcategory->slug ?? '', 'id' => $fnbt->id]) }}">
                                    <img src="{{ $img }}" alt="{{ $fnbt->title_en }}">
                                </a>
                                <h3>
                                    <a style="color: black; !important"
                                        href="{{ route('showFull.news', ['category' => $fnbt->newsCategory->slug ?? '', 'subcategory' => $fnbt->newsSubcategory->slug ?? '', 'id' => $fnbt->id]) }}">
                                        {{ session()->get('lang') == 'english' ? $fnbt->title_en : $fnbt->title_bn }}
                                    </a>
                                </h3>
                                <p>{{ session()->get('lang') == 'english' ? Str::limit($fnbt->details_en, 150, '...') : Str::limit($fnbt->details_bn, 150, '...') }}
                                </p>
                            </div>
                        @endif
                    </div>

                    {{-- Side news (desktop list) --}}
                    <div class="side-news-wrapper">
                        @forelse($fn3 as $row)
                            @php
                                $img =
                                    !empty($row->thumbnail) && !Str::contains($row->thumbnail, 'via.placeholder.com')
                                        ? $row->thumbnail
                                        : asset('uploads/default_images/deafult_thumbnail.jpg');
                            @endphp
                            <div class="side-news">
                                <img src="{{ $img }}" alt="{{ $row->title_en }}">
                                <h4>
                                    <a style="color: black"
                                        href="{{ route('showFull.news', ['category' => $row->newsCategory->slug ?? '', 'subcategory' => $row->newsSubcategory->slug ?? '', 'id' => $row->id]) }}">
                                        {{ session()->get('lang') == 'english' ? $row->title_en : $row->title_bn }}
                                    </a>
                                </h4>
                            </div>
                        @empty
                            <p>No news available</p>
                        @endforelse
                    </div>

                    {{-- Slider for mobile --}}
                    <div class="swiper-container swiper-economics">
                        <div class="swiper-wrapper">
                            @foreach ($fn3 as $row)
                                @php
                                    $img =
                                        !empty($row->thumbnail) &&
                                        !Str::contains($row->thumbnail, 'via.placeholder.com')
                                            ? $row->thumbnail
                                            : asset('uploads/default_images/deafult_thumbnail.jpg');
                                @endphp
                                <div class="swiper-slide">
                                    <a style="color: black"
                                        href="{{ route('showFull.news', ['category' => $row->newsCategory->slug ?? '', 'subcategory' => $row->newsSubcategory->slug ?? '', 'id' => $row->id]) }}">
                                        <img src="{{ $img }}" alt="{{ $row->title_en }}">
                                        <h4>{{ session()->get('lang') == 'english' ? $row->title_en : $row->title_bn }}
                                        </h4>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </section>

        </div>

        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                new Swiper('.swiper-politics', {
                    slidesPerView: 1.2,
                    spaceBetween: 12,
                    grabCursor: true,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true
                    },
                    breakpoints: {
                        480: {
                            slidesPerView: 1.5
                        },
                        640: {
                            slidesPerView: 2
                        }
                    }
                });
                new Swiper('.swiper-economics', {
                    slidesPerView: 1.2,
                    spaceBetween: 12,
                    grabCursor: true,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true
                    },
                    breakpoints: {
                        480: {
                            slidesPerView: 1.5
                        },
                        640: {
                            slidesPerView: 2
                        }
                    }
                });
            });
        </script>

        {{-- =================== POLITICS & ECONOMICS SECTION =================== --}}


        {{-- Politics And Economics Section News Start --}}
        <div class="news-section">
            <div class="news-container">

                {{-- Example Section --}}
                @if (isset($pnbt) && $pnbt && isset($pnbt->newsCategory))
                    <div class="news-block">
                        {{-- Section Title --}}
                        <div class="news-header">
                            <h2>
                                @if (session()->get('lang') == 'english')
                                    {{ $pnbt->newsCategory->category_en ?? '' }}
                                @else
                                    {{ $pnbt->newsCategory->category_bn ?? '' }}
                                @endif
                            </h2>
                            <a href="{{ route('getCate.news', $pnbt->newsCategory->slug ?? '#') }}">
                                {{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}
                            </a>
                        </div>

                        {{-- Big News --}}
                        @if (isset($pnbt->id))
                            <div class="news-main">
                                <a
                                    href="{{ route('showFull.news', [
                                        'category' => $pnbt->newsCategory->slug ?? '',
                                        'subcategory' => $pnbt->newsSubcategory->slug ?? '',
                                        'id' => $pnbt->id,
                                    ]) }}">
                                    @php
                                        $isPlaceholder =
                                            isset($pnbt->thumbnail) &&
                                            Str::contains($pnbt->thumbnail, 'via.placeholder.com');
                                        $imageToShow =
                                            isset($pnbt->thumbnail) && !$isPlaceholder && !empty($pnbt->thumbnail)
                                                ? $pnbt->thumbnail
                                                : asset('uploads/default_images/deafult_thumbnail.jpg');
                                    @endphp
                                    <img src="{{ $imageToShow }}" alt="{{ $pnbt->title_en ?? '' }}">
                                </a>
                                <h3>
                                    <a
                                        href="{{ route('showFull.news', [
                                            'category' => $pnbt->newsCategory->slug ?? '',
                                            'subcategory' => $pnbt->newsSubcategory->slug ?? '',
                                            'id' => $pnbt->id,
                                        ]) }}">
                                        @if (session()->get('lang') == 'english')
                                            {{ $pnbt->title_en ?? '' }}
                                        @else
                                            {{ $pnbt->title_bn ?? '' }}
                                        @endif
                                    </a>
                                </h3>
                            </div>
                        @endif

                        {{-- Small News --}}
                        @if (isset($pnbt) && !empty($pnbt->title_en))
                            <div class="news-list">
                                @foreach ([1, 2, 3] as $row)
                                    <h4>
                                        <a href="#">
                                            @if (session()->get('lang') == 'english')
                                                {{ $pnbt->title_en ?? '' }}
                                            @else
                                                {{ $pnbt->title_bn ?? '' }}
                                            @endif
                                        </a>
                                    </h4>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif

                {{-- Example Section --}}
                @if (isset($pnbt) && $pnbt && isset($pnbt->newsCategory))
                    <div class="news-block">
                        {{-- Section Title --}}
                        <div class="news-header">
                            <h2>
                                @if (session()->get('lang') == 'english')
                                    {{ $pnbt->newsCategory->category_en ?? '' }}
                                @else
                                    {{ $pnbt->newsCategory->category_bn ?? '' }}
                                @endif
                            </h2>
                            <a href="{{ route('getCate.news', $pnbt->newsCategory->slug ?? '#') }}">
                                {{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}
                            </a>
                        </div>

                        {{-- Big News --}}
                        @if (isset($pnbt->id))
                            <div class="news-main">
                                <a
                                    href="{{ route('showFull.news', [
                                        'category' => $pnbt->newsCategory->slug ?? '',
                                        'subcategory' => $pnbt->newsSubcategory->slug ?? '',
                                        'id' => $pnbt->id,
                                    ]) }}">
                                    @php
                                        $isPlaceholder =
                                            isset($pnbt->thumbnail) &&
                                            Str::contains($pnbt->thumbnail, 'via.placeholder.com');
                                        $imageToShow =
                                            isset($pnbt->thumbnail) && !$isPlaceholder && !empty($pnbt->thumbnail)
                                                ? $pnbt->thumbnail
                                                : asset('uploads/default_images/deafult_thumbnail.jpg');
                                    @endphp
                                    <img src="{{ $imageToShow }}" alt="{{ $pnbt->title_en ?? '' }}">
                                </a>
                                <h3>
                                    <a
                                        href="{{ route('showFull.news', [
                                            'category' => $pnbt->newsCategory->slug ?? '',
                                            'subcategory' => $pnbt->newsSubcategory->slug ?? '',
                                            'id' => $pnbt->id,
                                        ]) }}">
                                        @if (session()->get('lang') == 'english')
                                            {{ $pnbt->title_en ?? '' }}
                                        @else
                                            {{ $pnbt->title_bn ?? '' }}
                                        @endif
                                    </a>
                                </h3>
                            </div>
                        @endif

                        {{-- Small News --}}
                        @if (isset($pnbt) && !empty($pnbt->title_en))
                            <div class="news-list">
                                @foreach ([1, 2, 3] as $row)
                                    <h4>
                                        <a href="#">
                                            @if (session()->get('lang') == 'english')
                                                {{ $pnbt->title_en ?? '' }}
                                            @else
                                                {{ $pnbt->title_bn ?? '' }}
                                            @endif
                                        </a>
                                    </h4>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif

                {{-- Example Section --}}
                @if (isset($pnbt) && $pnbt && isset($pnbt->newsCategory))
                    <div class="news-block">
                        {{-- Section Title --}}
                        <div class="news-header">
                            <h2>
                                @if (session()->get('lang') == 'english')
                                    {{ $pnbt->newsCategory->category_en ?? '' }}
                                @else
                                    {{ $pnbt->newsCategory->category_bn ?? '' }}
                                @endif
                            </h2>
                            <a href="{{ route('getCate.news', $pnbt->newsCategory->slug ?? '#') }}">
                                {{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}
                            </a>
                        </div>

                        {{-- Big News --}}
                        @if (isset($pnbt->id))
                            <div class="news-main">
                                <a
                                    href="{{ route('showFull.news', [
                                        'category' => $pnbt->newsCategory->slug ?? '',
                                        'subcategory' => $pnbt->newsSubcategory->slug ?? '',
                                        'id' => $pnbt->id,
                                    ]) }}">
                                    @php
                                        $isPlaceholder =
                                            isset($pnbt->thumbnail) &&
                                            Str::contains($pnbt->thumbnail, 'via.placeholder.com');
                                        $imageToShow =
                                            isset($pnbt->thumbnail) && !$isPlaceholder && !empty($pnbt->thumbnail)
                                                ? $pnbt->thumbnail
                                                : asset('uploads/default_images/deafult_thumbnail.jpg');
                                    @endphp
                                    <img src="{{ $imageToShow }}" alt="{{ $pnbt->title_en ?? '' }}">
                                </a>
                                <h3>
                                    <a
                                        href="{{ route('showFull.news', [
                                            'category' => $pnbt->newsCategory->slug ?? '',
                                            'subcategory' => $pnbt->newsSubcategory->slug ?? '',
                                            'id' => $pnbt->id,
                                        ]) }}">
                                        @if (session()->get('lang') == 'english')
                                            {{ $pnbt->title_en ?? '' }}
                                        @else
                                            {{ $pnbt->title_bn ?? '' }}
                                        @endif
                                    </a>
                                </h3>
                            </div>
                        @endif

                        {{-- Small News --}}
                        @if (isset($pnbt) && !empty($pnbt->title_en))
                            <div class="news-list">
                                @foreach ([1, 2, 3] as $row)
                                    <h4>
                                        <a href="#">
                                            @if (session()->get('lang') == 'english')
                                                {{ $pnbt->title_en ?? '' }}
                                            @else
                                                {{ $pnbt->title_bn ?? '' }}
                                            @endif
                                        </a>
                                    </h4>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif

                {{-- Example Section --}}
                @if (isset($pnbt) && $pnbt && isset($pnbt->newsCategory))
                    <div class="news-block">
                        {{-- Section Title --}}
                        <div class="news-header">
                            <h2>
                                @if (session()->get('lang') == 'english')
                                    {{ $pnbt->newsCategory->category_en ?? '' }}
                                @else
                                    {{ $pnbt->newsCategory->category_bn ?? '' }}
                                @endif
                            </h2>
                            <a href="{{ route('getCate.news', $pnbt->newsCategory->slug ?? '#') }}">
                                {{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}
                            </a>
                        </div>

                        {{-- Big News --}}
                        @if (isset($pnbt->id))
                            <div class="news-main">
                                <a
                                    href="{{ route('showFull.news', [
                                        'category' => $pnbt->newsCategory->slug ?? '',
                                        'subcategory' => $pnbt->newsSubcategory->slug ?? '',
                                        'id' => $pnbt->id,
                                    ]) }}">
                                    @php
                                        $isPlaceholder =
                                            isset($pnbt->thumbnail) &&
                                            Str::contains($pnbt->thumbnail, 'via.placeholder.com');
                                        $imageToShow =
                                            isset($pnbt->thumbnail) && !$isPlaceholder && !empty($pnbt->thumbnail)
                                                ? $pnbt->thumbnail
                                                : asset('uploads/default_images/deafult_thumbnail.jpg');
                                    @endphp
                                    <img src="{{ $imageToShow }}" alt="{{ $pnbt->title_en ?? '' }}">
                                </a>
                                <h3>
                                    <a
                                        href="{{ route('showFull.news', [
                                            'category' => $pnbt->newsCategory->slug ?? '',
                                            'subcategory' => $pnbt->newsSubcategory->slug ?? '',
                                            'id' => $pnbt->id,
                                        ]) }}">
                                        @if (session()->get('lang') == 'english')
                                            {{ $pnbt->title_en ?? '' }}
                                        @else
                                            {{ $pnbt->title_bn ?? '' }}
                                        @endif
                                    </a>
                                </h3>
                            </div>
                        @endif

                        {{-- Small News --}}
                        @if (isset($pnbt) && !empty($pnbt->title_en))
                            <div class="news-list">
                                @foreach ([1, 2, 3] as $row)
                                    <h4>
                                        <a href="#">
                                            @if (session()->get('lang') == 'english')
                                                {{ $pnbt->title_en ?? '' }}
                                            @else
                                                {{ $pnbt->title_bn ?? '' }}
                                            @endif
                                        </a>
                                    </h4>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif

            </div>
        </div>


        <style>
            .news-section {
                margin: 30px 0;
            }

            .news-container {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 20px;
            }

            .news-block {
                display: flex;
                flex-direction: column;
                border: 1px solid #ddd;
                /* border around each block */
                padding: 12px;
                border-radius: 6px;
                background: #fff;
            }

            .news-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 12px;
                border-bottom: 1px solid #ddd;
                /* divider under section title */
                padding-bottom: 6px;
            }

            .news-header h2 {
                font-size: 20px;
                margin: 0;
            }

            .news-header a {
                font-size: 14px;
                font-weight: bold;
                text-decoration: none;
            }

            .news-main {
                margin: 10px 0;
                padding-bottom: 10px;
                border-bottom: 1px solid #ddd;
                /* divider after big news */
            }

            .news-main img {
                width: 100%;
                height: auto;
                border-radius: 6px;
                display: block;
            }

            .news-main h3 {
                font-size: 18px;
                margin: 10px 0 0;
            }

            .news-list {
                display: flex;
                flex-direction: column;
                gap: 10px;
                padding-top: 10px;
            }

            .news-list h4 {
                font-size: 15px;
                margin: 0;
            }

            .news-list a {
                text-decoration: none;
                display: block;
            }

            /* Tablet */
            @media (max-width: 992px) {
                .news-container {
                    grid-template-columns: 1fr 1fr;
                }
            }

            /* Mobile */
            @media (max-width: 768px) {
                .news-container {
                    grid-template-columns: 1fr;
                }

                .news-list {
                    flex-direction: row;
                    /* 3 in a row */
                    justify-content: space-between;
                    gap: 12px;
                    border-top: 1px solid #ddd;
                    /* top border for clarity */
                    padding-top: 10px;
                }

                .news-list h4 {
                    flex: 1;
                    font-size: 14px;
                    text-align: center;
                }
            }
        </style>

        {{-- Politics And Economics Section News End --}}



    </div>
    </div>
    </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    {{-- slider for special report --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Splide('#image-slider', {
                perPage: 4,
                perMove: 1,
                autoplay: false,
                omitEnd: true,
                breakpoints: {
                    1024: {
                        perPage: 3,
                    },
                    768: {
                        perPage: 2,
                    },
                    480: {
                        perPage: 1,
                    },
                },
            }).mount();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr("#archiveDate", {
                dateFormat: "Y-m-d",
                defaultDate: new Date(),
                onChange: function(selectedDates, dateStr, instance) {
                    fetchArchiveNews(dateStr);
                }
            });

            function fetchArchiveNews(date) {
                $('#archive-news-widget .preloader').show();

                $.ajax({
                    url: "",
                    method: "GET",
                    data: {
                        date: date
                    },
                    success: function(response) {
                        $('#archive-news-widget').html(response);
                    },
                    error: function() {
                        $('#archive-news-widget').html('<p>নিউজ লোড করা যাচ্ছে না।</p>');
                    }
                });
            }
        });
    </script>

    <script>
        const monthsBn = [
            'জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন',
            'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'
        ];

        const today = new Date();
        const monthSelect = document.getElementById('monthSelect');
        const yearSelect = document.getElementById('yearSelect');
        const calendarDates = document.getElementById('calendarDates');

        // Populate years
        const currentYear = today.getFullYear();
        for (let y = currentYear; y >= currentYear - 5; y--) {
            const option = document.createElement('option');
            option.value = y;
            option.textContent = y;
            yearSelect.appendChild(option);
        }

        // Populate months
        monthsBn.forEach((m, i) => {
            const option = document.createElement('option');
            option.value = i;
            option.textContent = m;
            monthSelect.appendChild(option);
        });

        // Set current month/year
        monthSelect.value = today.getMonth();
        yearSelect.value = today.getFullYear();

        function renderCalendar() {
            const month = parseInt(monthSelect.value);
            const year = parseInt(yearSelect.value);
            const firstDay = new Date(year, month, 1).getDay();
            const totalDays = new Date(year, month + 1, 0).getDate();

            calendarDates.innerHTML = '';

            for (let i = 0; i < firstDay; i++) {
                const empty = document.createElement('div');
                calendarDates.appendChild(empty);
            }

            for (let d = 1; d <= totalDays; d++) {
                const date = document.createElement('div');
                date.textContent = d;
                date.addEventListener('click', () => {
                    document.querySelectorAll('.calendar-dates div').forEach(el => el.classList.remove('selected'));
                    date.classList.add('selected');
                    const selectedDate =
                        `${year}-${String(month + 1).padStart(2, '0')}-${String(d).padStart(2, '0')}`;
                    fetchNewsForDate(selectedDate);
                });
                calendarDates.appendChild(date);
            }
        }

        function fetchNewsForDate(date) {
            document.getElementById("archive-news-widget").innerHTML = "<p>লোড হচ্ছে...</p>";
            fetch(`/archive-news?date=${date}`)
                .then(res => res.text())
                .then(html => {
                    document.getElementById("archive-news-widget").innerHTML = html;
                })
                .catch(() => {
                    document.getElementById("archive-news-widget").innerHTML = "<p>নিউজ লোড করা যাচ্ছে না।</p>";
                });
        }

        monthSelect.addEventListener('change', renderCalendar);
        yearSelect.addEventListener('change', renderCalendar);

        renderCalendar();
    </script>

    <script>
        // Always set CSRF token for AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    {{-- Select Districts while dropdown to Division --}}
    <script>
        $('#division_id').on('change', function() {
            var division_id = $(this).val();

            if (division_id) {
                $.ajax({
                    url: '/get/dist/' + division_id,
                    type: 'GET',
                    success: function(data) {
                        $('#dist_id').empty();
                        $('#dist_id').append(
                            '<option selected disabled>== Select District ==</option>');
                        $.each(data, function(key, value) {
                            $('#dist_id').append('<option value="' + value.id + '">' + value
                                .district_en + ' | ' + value.district_bn +
                                '</option>');
                        });
                    }
                });
            } else {
                $('#dist_id').empty();
            }
        });
    </script>

    {{-- Select Subdistricts while dropdown to Districts --}}

    <script>
        $('#dist_id').on('change', function() {
            var distID = $(this).val();

            if (distID) {
                $.ajax({
                    url: '/get/subdist/' + distID,
                    type: 'GET',
                    success: function(data) {
                        $('#sub_dist_id').empty();
                        $('#sub_dist_id').append(
                            '<option selected disabled>== Select Sub Category ==</option>');
                        $.each(data, function(key, value) {
                            $('#sub_dist_id').append('<option value="' + value.id + '">' + value
                                .sub_district_en + ' | ' + value.sub_district_bn +
                                '</option>');
                        });
                    }
                });
            } else {
                $('#sub_dist_id').empty();
            }
        });
    </script>




@endsection
