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

            /* Responsive */
            @media(max-width: 992px) {
                .kml-news-row {
                    flex-wrap: wrap;
                }

                .kml-col-left,
                .kml-col-center,
                .kml-col-right {
                    flex: 100%;
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



        {{-- Custom CSS for News Section --}}
<style>
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
    }

    .custom-news-section .post--img .thumb {
        display: block;
        overflow: hidden;
    }

    .custom-news-section .post--img img.img-fluid {
        width: 100%;
        display: block;
        transition: transform 0.3s ease;
        border-radius: 8px;
    }

    .custom-news-section .post--item:hover .post--img img {
        transform: scale(1.05);
    }

    /* Left Column - news items */
    .custom-news-section .col-md-3:first-child .post--img img {
        height: 180px;
        object-fit: cover;
    }

    /* Center Column - main news */
    .custom-news-section .col-md-6 .post--img img {
        height: 400px;
        object-fit: cover;
    }

    /* Right Column - small news items */
    .custom-news-section .col-md-3:last-child .post--img img {
        height: 75px;
        object-fit: cover;
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

    /* IMPROVED RESPONSIVE DESIGN */

    /* Large Tablets */
    @media (max-width: 1200px) {
        .custom-news-section .post--items {
            gap: 15px;
        }

        .custom-news-section .col-md-6 .post--img img {
            height: 350px;
        }

        .custom-news-section .col-md-3:first-child .post--img img {
            height: 160px;
        }
    }

    /* Medium Tablets */
    @media (max-width: 992px) {
        .custom-news-section .post--items-title {
            text-align: center;
        }

        .custom-news-section .post--items-title > div {
            flex-direction: column !important;
            gap: 10px;
        }

        .custom-news-section .post--items {
            flex-direction: column;
            gap: 30px;
        }

        .custom-news-section .post--items .col-md-3:first-child,
        .custom-news-section .post--items .col-md-6,
        .custom-news-section .post--items .col-md-3:last-child {
            flex: 1 1 100%;
            max-width: 100%;
        }

        /* Left column becomes horizontal scroll on tablet */
        .custom-news-section .col-md-3:first-child .nav.flex-column {
            display: flex;
            flex-direction: row;
            gap: 15px;
            overflow-x: auto;
            padding-bottom: 10px;
            scroll-snap-type: x mandatory;
        }

        .custom-news-section .col-md-3:first-child .nav.flex-column li {
            flex: 0 0 280px;
            scroll-snap-align: start;
        }

        .custom-news-section .col-md-3:first-child .nav.flex-column li+li {
            margin-top: 0 !important;
        }

        /* Right column becomes 2-column grid */
        .custom-news-section .col-md-3:last-child .nav {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .custom-news-section .col-md-3:last-child .nav li+li {
            margin-top: 0 !important;
        }

        .custom-news-section .col-md-3:first-child .post--img img,
        .custom-news-section .col-md-3:last-child .post--img img {
            height: 140px;
        }

        .custom-news-section .col-md-6 .post--img img {
            height: 280px;
        }

        .custom-news-section .divider {
            display: block;
            margin: 20px 0;
            border: 1px solid #e0e0e0;
        }

        /* Scrollbar styling for horizontal scroll */
        .custom-news-section .col-md-3:first-child .nav.flex-column::-webkit-scrollbar {
            height: 6px;
        }

        .custom-news-section .col-md-3:first-child .nav.flex-column::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .custom-news-section .col-md-3:first-child .nav.flex-column::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }
    }

    /* Mobile Phones - NEW IMPROVED MOBILE LAYOUT */
    @media (max-width: 768px) {
        .custom-news-section .main--content {
            padding: 20px 0;
        }

        .custom-news-section .post--items {
            gap: 25px;
            display: flex;
            flex-direction: column;
        }

        .custom-news-section .post--items-title h2 {
            font-size: 20px;
        }

        /* Reorder the columns for mobile */
        .custom-news-section .post--items .col-md-3:first-child {
            order: 1; /* Left column comes first */
        }

        .custom-news-section .post--items .col-md-3:last-child {
            order: 2; /* Right column comes second */
        }

        .custom-news-section .post--items .col-md-6 {
            order: 3; /* Middle column comes last */
        }

        /* Left column - first two items in flex row, rest in column */
        .custom-news-section .col-md-3:first-child .nav.flex-column {
            display: block; /* Reset from tablet layout */
            flex-direction: column;
            overflow-x: visible;
            padding-bottom: 0;
        }

        .custom-news-section .col-md-3:first-child .nav.flex-column li {
            flex: none;
            scroll-snap-align: none;
            width: 100%;
        }

        /* Create a flex container for the first two items */
        .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(-n+2) {
            display: inline-block;
            width: calc(50% - 10px);
            vertical-align: top;
            margin-bottom: 20px;
        }

        .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(1) {
            margin-right: 10px;
        }

        .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(2) {
            margin-left: 10px;
        }

        .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(n+3) {
            display: block;
            width: 100%;
            clear: both;
        }

        .custom-news-section .col-md-3:first-child .nav.flex-column li+li {
            margin-top: 20px !important;
        }

        /* Reset margins for the first two items */
        .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(2) {
            margin-top: 0 !important;
        }

        /* Right column - back to single column layout */
        .custom-news-section .col-md-3:last-child .nav {
            display: flex;
            flex-direction: column;
            grid-template-columns: 1fr;
            gap: 0;
        }

        .custom-news-section .col-md-3:last-child .nav li+li {
            margin-top: 15px !important;
        }

        /* Adjust image heights for mobile */
        .custom-news-section .col-md-6 .post--img img {
            height: 220px;
        }

        .custom-news-section .col-md-3:first-child .post--img img,
        .custom-news-section .col-md-3:last-child .post--img img {
            height: 120px;
        }

        /* Special styling for the first two items in left column */
        .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(-n+2) .post--img img {
            height: 100px;
        }

        .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(-n+2) .post--info .title h3 {
            font-size: 14px;
        }

        .custom-news-section .post--info .title h2 {
            font-size: 20px !important;
        }

        .custom-news-section .post--info .title h3 {
            font-size: 15px;
        }

        .custom-news-section .col-md-6 p {
            font-size: 14px !important;
        }

        .custom-news-section .divider {
            margin: 15px 0;
        }
    }

    /* Small Mobile Phones */
    @media (max-width: 580px) {
        .custom-news-section .post--items {
            gap: 20px;
        }

        /* Adjust the first two items for smaller screens */
        .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(-n+2) {
            width: calc(50% - 8px);
        }

        .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(1) {
            margin-right: 8px;
        }

        .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(2) {
            margin-left: 8px;
        }

        .custom-news-section .col-md-6 .post--img img {
            height: 200px;
        }

        .custom-news-section .col-md-3:first-child .post--img img,
        .custom-news-section .col-md-3:last-child .post--img img {
            height: 100px;
        }

        .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(-n+2) .post--img img {
            height: 90px;
        }

        .custom-news-section .post--info .title h2 {
            font-size: 18px !important;
        }

        .custom-news-section .post--info {
            padding: 12px 0;
        }

        .custom-news-section .col-md-6 .post--info {
            padding: 15px 0;
        }

        .custom-news-section .col-md-3:last-child .post--info {
            padding: 6px 0;
        }
    }

    /* Very Small Mobile */
    @media (max-width: 480px) {
        .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(-n+2) {
            width: calc(50% - 6px);
        }

        .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(1) {
            margin-right: 6px;
        }

        .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(2) {
            margin-left: 6px;
        }

        .custom-news-section .col-md-6 .post--img img {
            height: 180px;
        }

        .custom-news-section .col-md-3:first-child .post--img img,
        .custom-news-section .col-md-3:last-child .post--img img {
            height: 90px;
        }

        .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(-n+2) .post--img img {
            height: 80px;
        }

        .custom-news-section .post--info .title h3 {
            font-size: 14px;
        }

        .custom-news-section .col-md-3:last-child .post--info .title h3 {
            font-size: 12px;
        }
    }

    /* Extra Small Mobile */
    @media (max-width: 360px) {
        .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(-n+2) {
            width: calc(50% - 5px);
            display: block;
            float: left;
        }

        .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(1) {
            margin-right: 5px;
        }

        .custom-news-section .col-md-3:first-child .nav.flex-column li:nth-child(2) {
            margin-left: 5px;
        }

        .custom-news-section .col-md-3:first-child .nav.flex-column::after {
            content: "";
            display: table;
            clear: both;
        }

        .custom-news-section .post--items-title h2 {
            font-size: 18px;
        }

        .custom-news-section .post--items-title a {
            font-size: 13px !important;
        }
    }
</style>

        {{-- National Section News Start --}}
        @if (isset($nnbt) && $nnbt && isset($nnbt->newsCategory))
            <div class="custom-news-section">
                <div class="row">
                    <div class="main--content" data-sticky-content="true">
                        <div class="sticky-content-inner">
                            <div class="row">

                                {{-- Section Title --}}
                                <div class="post--items-title" data-ajax="tab" style="border-top: none; margin-top: 10px">
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
                                </div>

                                {{-- Main Content --}}
                                <div class="main--content pd--30-0">
                                    <div class="post--items post--items-4" data-ajax-content="outer">

                                        {{-- Left Column (col-md-3) --}}
                                        @if (isset($nnln) && $nnln->count() > 0)
                                            <div class="col-md-3">
                                                <ul class="nav flex-column">
                                                    @foreach ($nnln as $index => $row)
                                                        @if (isset($row->newsCategory) && isset($row->newsSubcategory))
                                                            <li style="{{ $index !== 0 ? 'margin-top: 20px;' : '' }}">
                                                                <div class="post--item">
                                                                    <div class="post--img">
                                                                        <a href="{{ route('showFull.news', [
                                                                            'category' => $row->newsCategory->slug ?? 'news',
                                                                            'subcategory' => $row->newsSubcategory->slug ?? 'general',
                                                                            'id' => $row->id,
                                                                        ]) }}"
                                                                            class="thumb">
                                                                            @php
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
                                                                            @endphp

                                                                            <img src="{{ $imageToShow }}"
                                                                                alt="{{ $row->title_en ?? 'News' }}"
                                                                                class="img-fluid" loading="lazy">
                                                                        </a>

                                                                        <div class="post--info">
                                                                            <div class="title">
                                                                                <h3 class="h4">
                                                                                    <a href="{{ route('showFull.news', [
                                                                                        'category' => $row->newsCategory->slug ?? 'news',
                                                                                        'subcategory' => $row->newsSubcategory->slug ?? 'general',
                                                                                        'id' => $row->id,
                                                                                    ]) }}"
                                                                                        class="btn-link">
                                                                                        @if (session()->get('lang') == 'english')
                                                                                            {{ Str::limit($row->title_en ?? 'Untitled News', 80) }}
                                                                                        @else
                                                                                            {{ Str::limit($row->title_bn ?? 'শিরোনামহীন সংবাদ', 80) }}
                                                                                        @endif
                                                                                    </a>
                                                                                </h3>
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

                                        {{-- Middle Column (col-md-6) --}}
                                        @if (isset($nnbt) && isset($nnbt->newsCategory) && isset($nnbt->newsSubcategory))
                                            <div class="col-md-6">
                                                <div class="post--img">
                                                    <a href="{{ route('showFull.news', [
                                                        'category' => $nnbt->newsCategory->slug ?? 'news',
                                                        'subcategory' => $nnbt->newsSubcategory->slug ?? 'general',
                                                        'id' => $nnbt->id,
                                                    ]) }}"
                                                        class="thumb">
                                                        @php
                                                            $isPlaceholder = isset($nnbt->thumbnail)
                                                                ? Str::contains($nnbt->thumbnail, 'via.placeholder.com')
                                                                : true;
                                                            $imageToShow =
                                                                !$isPlaceholder && !empty($nnbt->thumbnail)
                                                                    ? $nnbt->thumbnail
                                                                    : asset(
                                                                        'uploads/default_images/deafult_thumbnail.jpg',
                                                                    );
                                                        @endphp

                                                        <img src="{{ $imageToShow }}"
                                                            alt="{{ $nnbt->title_en ?? 'Main News' }}" class="img-fluid"
                                                            loading="lazy">
                                                    </a>

                                                    <div class="post--info">
                                                        <div class="title">
                                                            <h2 class="h4" style="font-size: 24px">
                                                                <a href="{{ route('showFull.news', [
                                                                    'category' => $nnbt->newsCategory->slug ?? 'news',
                                                                    'subcategory' => $nnbt->newsSubcategory->slug ?? 'general',
                                                                    'id' => $nnbt->id,
                                                                ]) }}"
                                                                    class="btn-link">
                                                                    @if (session()->get('lang') == 'english')
                                                                        {{ $nnbt->title_en ?? 'Untitled Main News' }}
                                                                    @else
                                                                        {{ $nnbt->title_bn ?? 'প্রধান সংবাদ' }}
                                                                    @endif
                                                                </a>
                                                            </h2>
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
                                        @endif

                                        {{-- Right Column (col-md-3) --}}
                                        @if (isset($nnrn) && $nnrn->count() > 0)
                                            <div class="col-md-3">
                                                <ul class="nav">
                                                    @foreach ($nnrn as $index => $row)
                                                        @if (isset($row->newsCategory) && isset($row->newsSubcategory))
                                                            <li style="{{ $index !== 0 ? 'margin-top: 15px;' : '' }}">
                                                                <div class="post--item post--layout-3">
                                                                    <div class="post--img">
                                                                        <a href="{{ route('showFull.news', [
                                                                            'category' => $row->newsCategory->slug ?? 'news',
                                                                            'subcategory' => $row->newsSubcategory->slug ?? 'general',
                                                                            'id' => $row->id,
                                                                        ]) }}"
                                                                            class="thumb">
                                                                            @php
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
                                                                            @endphp

                                                                            <img src="{{ $imageToShow }}"
                                                                                alt="{{ $row->title_en ?? 'News' }}"
                                                                                class="img-fluid" loading="lazy">
                                                                        </a>
                                                                        <div class="post--info">
                                                                            <div class="title">
                                                                                <h3 class="h4">
                                                                                    <a href="{{ route('showFull.news', [
                                                                                        'category' => $row->newsCategory->slug ?? 'news',
                                                                                        'subcategory' => $row->newsSubcategory->slug ?? 'general',
                                                                                        'id' => $row->id,
                                                                                    ]) }}"
                                                                                        class="btn-link">
                                                                                        @if (session()->get('lang') == 'english')
                                                                                            {{ Str::limit($row->title_en ?? 'Untitled News', 60) }}
                                                                                        @else
                                                                                            {{ Str::limit($row->title_bn ?? 'শিরোনামহীন সংবাদ', 60) }}
                                                                                        @endif
                                                                                    </a>
                                                                                </h3>
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
        {{-- National Section News End --}}

        <hr>

        {{-- Entertainment Section News Start  --}}
        <div class="row">
            <div class="main--content" data-sticky-content="true">
                <div class="sticky-content-inner">
                    <div class="row">

                        {{-- Section Title --}}
                        <div class="post--items-title" data-ajax="tab">
                            <div style="display: flex; justify-content: space-between">
                                <h2 class="h4">
                                    @if (session()->get('lang') == 'english')
                                        {{ $enbt->newsCategory->category_en }}
                                    @else
                                        {{ $enbt->newsCategory->category_bn }}
                                    @endif
                                </h2>
                                <a href="{{ route('getCate.news', $enbt->newsCategory->slug) }}"
                                    style="font-size: 15px; font-weight: bold">{{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}</a>
                            </div>
                        </div>

                        {{-- Main Content --}}
                        <div class="main--content pd--30-0">
                            <div class="post--items post--items-4" data-ajax-content="outer">
                                {{-- Middle Column (col-md-7) --}}
                                <div class="col-md-6">
                                    <div class="post--img">
                                        <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                            class="thumb">
                                            @php
                                                $isPlaceholder = Str::contains($enbt->thumbnail, 'via.placeholder.com');
                                                $imageToShow =
                                                    !$isPlaceholder && !empty($enbt->thumbnail)
                                                        ? $enbt->thumbnail
                                                        : asset('uploads/default_images/deafult_thumbnail.jpg');
                                            @endphp

                                            <img src="{{ $imageToShow }}" alt="{{ $enbt->title_en }}"
                                                class="img-fluid">
                                        </a>

                                        <div class="post--info">
                                            <div class="title">
                                                <h2 class="h4" style="font-size: 24px">
                                                    <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                        class="btn-link">
                                                        @if (session()->get('lang') == 'english')
                                                            {{ $enbt->title_en }}
                                                        @else
                                                            {{ $enbt->title_bn }}
                                                        @endif
                                                    </a>
                                                </h2>
                                                <p style="font-size: 16px; margin-top: -5px">
                                                    @if (session()->get('lang') == 'english')
                                                        {!! Str::limit($enbt->details_en, 200, '...') !!}
                                                    @else
                                                        {!! Str::limit($enbt->details_bn, 200, '...') !!}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="divider hidden-md hidden-lg">
                                </div>

                                {{-- Right Column (col-md-2) --}}
                                <div class="col-md-6">
                                    <div class="row">
                                        @foreach ($enrn as $index => $row)
                                            <div class="col-sm-12">
                                                <div
                                                    style="display: flex; align-items: center; margin-top: -18px !important;">
                                                    <!-- Text Block on the Left -->
                                                    <div class="pe-3 flex-grow-1">
                                                        <h2 class="h4" style="font-size: 18px; margin-bottom: 10px;">
                                                            <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                                class="btn-link">
                                                                @if (session()->get('lang') == 'english')
                                                                    {{ $row->title_en }}
                                                                @else
                                                                    {{ $row->title_bn }}
                                                                @endif
                                                            </a>
                                                        </h2>
                                                        <p style="font-size: 14px; margin: 0;">
                                                            <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                                class="btn-link">
                                                                @if (session()->get('lang') == 'english')
                                                                    {!! Str::limit($row->details_en, 200, '...') !!}
                                                                @else
                                                                    {!! Str::limit($row->details_bn, 200, '...') !!}
                                                                @endif
                                                            </a>
                                                        </p>
                                                    </div>

                                                    <!-- Image on the Right -->
                                                    <div style="flex-shrink: 0;">
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

                                                            <img width="150px" height="85" src="{{ $imageToShow }}"
                                                                alt="{{ $row->title_en }}" class="img-fluid">
                                                        </a>
                                                    </div>
                                                </div>
                                                @if (!$loop->last)
                                                    <hr>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Entertainment Section News End --}}

        {{-- Country Section News Start --}}
        <div class="row" style="margin-top: 30px">

            {{-- Section Title --}}
            <div class="post--items-title" data-ajax="tab">
                <div style="display: flex; justify-content: space-between">
                    <h2 class="h4">
                        @if (session()->get('lang') == 'english')
                            {{ $cnbt->newsCategory->category_en }}
                        @else
                            {{ $cnbt->newsCategory->category_bn }}
                        @endif
                    </h2>
                    <a href="{{ route('getCate.news', $cnbt->newsCategory->slug) }}"
                        style="font-size: 15px; font-weight: bold">{{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}</a>
                </div>
            </div>

            <style>
                /* Select styling */
                select {
                    width: 100%;
                    padding: 10px 15px;
                    border: 2px solid #ccc;
                    border-radius: 8px;
                    background-color: #fff;
                    font-size: 16px;
                    color: #333;
                    appearance: none;
                    /* Remove default arrow */
                    cursor: pointer;
                    transition: all 0.3s ease;
                    background-image: url("data:image/svg+xml;charset=US-ASCII,<svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24'><path fill='%23333' d='M7 10l5 5 5-5z'/></svg>");
                    background-repeat: no-repeat;
                    background-position: right 12px center;
                    background-size: 12px;
                }

                select:focus {
                    border-color: #1B84FF;
                    box-shadow: 0 0 5px rgba(27, 132, 255, 0.5);
                    outline: none;
                }

                /* Button styling */
                .button {
                    width: 100%;
                    padding: 12px;
                    font-size: 16px;
                    font-weight: bold;
                    color: #fff;
                    background: linear-gradient(45deg, #ff4b2b, #ff416c);
                    border: none;
                    border-radius: 8px;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 8px;
                }

                .button:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 4px 12px rgba(255, 65, 108, 0.4);
                }

                /* Responsive tweaks */
                @media (max-width: 768px) {
                    .col-md-3 {
                        flex: 1 1 48%;
                        margin-top: 15px;
                    }
                }

                @media (max-width: 480px) {
                    .col-md-3 {
                        flex: 1 1 100%;
                        margin-top: 15px;
                    }
                }
            </style>

            {{-- Category And Subcategory Row --}}
            <div class="row mt-3">
                <div class="col-md-3">
                    <select class="form-select select2" name="division_id" id="division_id" autocomplete="off">
                        <option value="">{{ session()->get('lang') == 'english' ? 'Division' : 'বিভাগ' }}</option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}">
                                {{ session()->get('lang') == 'english' ? $division->division_en : $division->division_bn }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <select class="form-select select2" name="dist_id" id="dist_id" autocomplete="off">
                        <option value="">{{ session()->get('lang') == 'english' ? 'District' : 'জেলা' }}</option>
                    </select>

                    @error('dist_id')
                        <p class="text-danger mt-2">{{ $message }}</p>
                    @enderror

                </div>
                <div class="col-md-3">

                    <select class="form-select select2" name="sub_dist_id" id="sub_dist_id" autocomplete="off">
                        <option value="">{{ session()->get('lang') == 'english' ? 'Subdistrict' : 'উপজেলা' }}
                        </option>
                    </select>
                </div>

                <div class="col-md-3">
                    <button class="button"
                        style="width: 100%">{{ session()->get('lang') == 'english' ? 'Search' : 'খুঁজুন' }} <i
                            class="fa fa-search"></i></button>
                </div>

            </div>

            <div class="main--content">
                <div class="post--items post--items-1 pd--30-0">
                    <div class="row gutter--15">
                        <div class="col-md-3">
                            <div class="row gutter--15">
                                {{-- First Section News --}}
                                @foreach ($cn1 as $row)
                                    <div class="col-md-12 col-xs-6 col-xxs-12">
                                        <div>
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
                                                                : asset('uploads/default_images/deafult_thumbnail.jpg');
                                                    @endphp

                                                    <img src="{{ $imageToShow }}"
                                                        alt="{{ $row->title_en }}"class="img-fluid">
                                                </a>
                                                <div class="post--info">
                                                    <div class="title">
                                                        <h2 class="h4">
                                                            <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                                class="btn-link">
                                                                @if (session()->get('lang') == 'english')
                                                                    {{ $row->title_en }}
                                                                @else
                                                                    {{ $row->title_bn }}
                                                                @endif
                                                            </a>
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="row gutter--15">
                                @foreach ($cn2 as $row)
                                    <div class="col-md-12 col-xs-6 col-xxs-12">
                                        <div>
                                            <div class="post--img">
                                                <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                    class="thumb">
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

                                                        <img src="{{ $imageToShow }}"
                                                            alt="{{ $row->title_en }}"class="img-fluid">

                                                    </a>
                                                </a>
                                                <div class="post--info">
                                                    <div class="title">
                                                        <h2 class="h4">
                                                            <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                                class="btn-link">
                                                                @if (session()->get('lang') == 'english')
                                                                    {{ $row->title_en }}
                                                                @else
                                                                    {{ $row->title_bn }}
                                                                @endif
                                                            </a>
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- This Section will Show Main news --}}
                        <div class="col-md-6">
                            <div>
                                <div class="post--img">
                                    {{-- <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}" class="thumb"><img src="{{ asset('uploads/news_photos/'. $fsbt->news_photo) }}"alt="{{ $fsbt->title }}" /></a> --}}
                                    <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                        class="thumb">
                                        @php
                                            $isPlaceholder = Str::contains($cnbt->thumbnail, 'via.placeholder.com');
                                            $imageToShow =
                                                !$isPlaceholder && !empty($cnbt->thumbnail)
                                                    ? $cnbt->thumbnail
                                                    : asset('uploads/default_images/deafult_thumbnail.jpg');
                                        @endphp

                                        <img src="{{ $imageToShow }}" alt="{{ $cnbt->title_en }}"class="img-fluid">
                                    </a>
                                    <div class="post--info">
                                        <div class="title">
                                            <h2 class="h4">
                                                <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                    class="btn-link">
                                                    @if (session()->get('lang') == 'english')
                                                        <h2>{{ $cnbt->title_en }}</h2>
                                                    @else
                                                        <h2>{{ $cnbt->title_bn }}</h2>
                                                    @endif

                                                </a>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Country Section News End --}}

        {{-- International Section News Start --}}
        <div class="row" style="margin-top: 30px">

            {{-- Section Title --}}
            <div class="post--items-title" data-ajax="tab">
                <div style="display: flex; justify-content: space-between">
                    <h2 class="h4">
                        @if (session()->get('lang') == 'english')
                            {{ $innbt->newsCategory->category_en }}
                        @else
                            {{ $innbt->newsCategory->category_bn }}
                        @endif
                    </h2>
                    </h2>
                    <a href="{{ route('getCate.news', $innbt->newsCategory->slug) }}"
                        style="font-size: 15px; font-weight: bold">{{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}</a>
                </div>
            </div>

            <div class="main--content">
                <div class="post--items post--items-1 pd--30-0">
                    <div class="row gutter--15">
                        {{-- This Section will Show Main news --}}
                        <div class="col-md-6">
                            <div>
                                <div class="post--img">
                                    {{-- <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}" class="thumb"><img src="{{ asset('uploads/news_photos/'. $fsbt->news_photo) }}"alt="{{ $fsbt->title }}" /></a> --}}
                                    <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                        class="thumb">
                                        @php
                                            $isPlaceholder = Str::contains($innbt->thumbnail, 'via.placeholder.com');
                                            $imageToShow =
                                                !$isPlaceholder && !empty($innbt->thumbnail)
                                                    ? $innbt->thumbnail
                                                    : asset('uploads/default_images/deafult_thumbnail.jpg');
                                        @endphp

                                        <img src="{{ $imageToShow }}" alt="{{ $innbt->title_en }}"class="img-fluid">
                                    </a>
                                    <div class="post--info">
                                        <div class="title">
                                            <h2 class="h4">
                                                <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                    class="btn-link">
                                                    @if (session()->get('lang') == 'english')
                                                        <h2>{{ $innbt->title_en }}</h2>
                                                    @else
                                                        <h2>{{ $innbt->title_bn }}</h2>
                                                    @endif

                                                </a>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="row gutter--15">
                                {{-- First Section News --}}
                                @foreach ($inn2 as $index => $row)
                                    <div class="col-md-12 col-xs-6 col-xxs-12">
                                        <div>
                                            <div class="post--img"
                                                style="{{ $index !== 0 ? 'margin-top: 15px;' : '' }}">
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
                                                                : asset('uploads/default_images/deafult_thumbnail.jpg');
                                                    @endphp

                                                    <img src="{{ $imageToShow }}"
                                                        alt="{{ $row->title_en }}"class="img-fluid">
                                                </a>
                                                <div class="post--info">
                                                    <div class="title">
                                                        <h2 class="h4">
                                                            <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                                class="btn-link">
                                                                @if (session()->get('lang') == 'english')
                                                                    {{ $row->title_en }}
                                                                @else
                                                                    {{ $row->title_bn }}
                                                                @endif
                                                            </a>
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="row gutter--15">
                                {{-- Right Column (col-md-2) --}}
                                <div class="col-md-12">
                                    <div class="row">
                                        @foreach ($inn4 as $index => $row)
                                            <div class="col-sm-12">
                                                <div
                                                    style="display: flex; align-items: center; margin-top: -5px !important; {{ $index !== 0 ? 'padding-top: 15px;' : '' }}">
                                                    <!-- Text Block on the Left -->
                                                    <div class="pe-3 flex-grow-1" style="padding-right: 50px !important">
                                                        <h2 class="h4" style="font-size: 18px; margin-bottom: 10px;">
                                                            <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                                class="btn-link">
                                                                @if (session()->get('lang') == 'english')
                                                                    {{ $row->title_en }}
                                                                @else
                                                                    {{ $row->title_bn }}
                                                                @endif
                                                            </a>
                                                        </h2>
                                                    </div>

                                                    <!-- Image on the Right -->
                                                    <div style="flex-shrink: 0;">
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

                                                            <img width="150px" height="85"
                                                                src="{{ $imageToShow }}" alt="{{ $row->title_en }}"
                                                                class="img-fluid">
                                                        </a>
                                                    </div>
                                                </div>
                                                @if (!$loop->last)
                                                    <hr>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- International Section News End --}}

        {{-- Sports Section News  Start --}}
        <div class="row">
            <div class="main--content" data-sticky-content="true">
                <div class="sticky-content-inner">
                    <div class="row">

                        {{-- Section Title --}}
                        <div class="post--items-title" data-ajax="tab">
                            <div style="display: flex; justify-content: space-between">
                                <h2 class="h4">
                                    @if (session()->get('lang') == 'english')
                                        {{ $snbt->newsCategory->category_en }}
                                    @else
                                        {{ $snbt->newsCategory->category_bn }}
                                    @endif
                                </h2>
                                <a href="{{ route('getCate.news', $snbt->newsCategory->slug) }}"
                                    style="font-size: 15px; font-weight: bold">{{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}</a>
                            </div>
                        </div>

                        {{-- Main Content --}}
                        <div class="main--content pd--30-0">
                            <div class="post--items post--items-4" data-ajax-content="outer">

                                {{-- Left Column (col-md-3) --}}
                                <div class="col-md-3">
                                    <ul class="nav flex-column">
                                        @foreach ($sn2 as $index => $row)
                                            <li style="{{ $index !== 0 ? 'margin-top: 20px;' : '' }}">
                                                <div class="post--item">
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
                                                            <div class="title">
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

                                {{-- Middle Column (col-md-7) --}}
                                <div class="col-md-6">
                                    <div class="post--img">
                                        <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                            class="thumb">
                                            @php
                                                $isPlaceholder = Str::contains($snbt->thumbnail, 'via.placeholder.com');
                                                $imageToShow =
                                                    !$isPlaceholder && !empty($snbt->thumbnail)
                                                        ? $snbt->thumbnail
                                                        : asset('uploads/default_images/deafult_thumbnail.jpg');
                                            @endphp

                                            <img src="{{ $imageToShow }}" alt="{{ $snbt->title_en }}"
                                                class="img-fluid">
                                        </a>

                                        <div class="post--info">
                                            <div class="title">
                                                <h2 class="h4" style="font-size: 24px">
                                                    <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                        class="btn-link">
                                                        @if (session()->get('lang') == 'english')
                                                            {{ $snbt->title_en }}
                                                        @else
                                                            {{ $snbt->title_bn }}
                                                        @endif
                                                    </a>
                                                </h2>
                                                <p style="font-size: 16px; margin-top: -5px">
                                                    @if (session()->get('lang') == 'english')
                                                        {!! Str::limit($snbt->details_en, 200, '...') !!}
                                                    @else
                                                        {!! Str::limit($snbt->details_bn, 200, '...') !!}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="divider hidden-md hidden-lg">
                                </div>

                                {{-- Right Column (col-md-2) --}}
                                <div class="col-md-3">
                                    @foreach ($sn4 as $index => $row)
                                        <div
                                            class="row"style="display: flex; justify-content: space-between; align-items: center; {{ $index !== 0 ? 'margin-top: 15px;' : '' }}">
                                            <div class="col-sm-6">
                                                @if (session()->get('lang') == 'english')
                                                    {{ $row->title_en }}
                                                @else
                                                    {{ $row->title_bn }}
                                                @endif
                                            </div>
                                            <div class="col-sm-6">
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
                                                                : asset('uploads/default_images/deafult_thumbnail.jpg');
                                                    @endphp

                                                    <img src="{{ $imageToShow }}" alt="{{ $row->title_en }}"
                                                        class="img-fluid">
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <hr>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        {{-- Sports Section News End --}}

        {{-- Lifestyle Section News  Start --}}
        <div class="row" style="margin-top: 30px">
            <div class="main--content" data-sticky-content="true">
                <div class="sticky-content-inner">

                    <div class="row">
                        {{-- Main Content --}}
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    {{-- Section Title --}}
                                    <div class="post--items-title" data-ajax="tab">
                                        <div style="display: flex; justify-content: space-between">
                                            <h2 class="h4">
                                                @if (session()->get('lang') == 'english')
                                                    {{ $lsnbt->newsCategory->category_en }}
                                                @else
                                                    {{ $lsnbt->newsCategory->category_bn }}
                                                @endif
                                            </h2>
                                            <a href="{{ route('getCate.news', $lsnbt->newsCategory->slug) }}"
                                                style="font-size: 15px; font-weight: bold">{{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}</a>
                                        </div>
                                    </div>
                                    <div class="post--items post--items-4" data-ajax-content="outer">

                                        {{-- Left Column (col-md-3) --}}
                                        <div class="col-md-6" style="margin: 0 !important; padding: 0 !important">
                                            <div class="post--img">
                                                <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                    class="thumb">
                                                    @php
                                                        $isPlaceholder = Str::contains(
                                                            $lsnbt->thumbnail,
                                                            'via.placeholder.com',
                                                        );
                                                        $imageToShow =
                                                            !$isPlaceholder && !empty($lsnbt->thumbnail)
                                                                ? $lsnbt->thumbnail
                                                                : asset('uploads/default_images/deafult_thumbnail.jpg');
                                                    @endphp

                                                    <img src="{{ $imageToShow }}" alt="{{ $lsnbt->title_en }}"
                                                        class="img-fluid">
                                                </a>

                                                <div class="post--info">
                                                    <div class="title">
                                                        <h2 class="h4" style="font-size: 24px">
                                                            <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                                class="btn-link">
                                                                @if (session()->get('lang') == 'english')
                                                                    {{ $lsnbt->title_en }}
                                                                @else
                                                                    {{ $lsnbt->title_bn }}
                                                                @endif
                                                            </a>
                                                        </h2>
                                                        <p style="font-size: 16px; margin-top: -5px">
                                                            @if (session()->get('lang') == 'english')
                                                                {!! Str::limit($lsnbt->details_en, 150, '...') !!}
                                                            @else
                                                                {!! Str::limit($lsnbt->details_bn, 150, '...') !!}
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="divider hidden-md hidden-lg">
                                            <div>
                                                <div
                                                    class="row"style="display: flex; justify-content: space-between; align-items: center; {{ $index !== 0 ? 'margin-top: 15px;' : '' }}">
                                                    <div class="col-sm-6">
                                                        @if (session()->get('lang') == 'english')
                                                            {{ $row->title_en }}
                                                        @else
                                                            {{ $row->title_bn }}
                                                        @endif
                                                    </div>
                                                    <div class="col-sm-6">
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Middle Column (col-md-7) --}}
                                        <div class="col-md-6">
                                            <div>
                                                @foreach ($sn4 as $index => $row)
                                                    <div
                                                        class="row"style="display: flex; justify-content: space-between; align-items: center; {{ $index !== 0 ? 'margin-top: 15px;' : '' }}">
                                                        <div class="col-sm-6">
                                                            @if (session()->get('lang') == 'english')
                                                                {{ $row->title_en }}
                                                            @else
                                                                {{ $row->title_bn }}
                                                            @endif
                                                        </div>
                                                        <div class="col-sm-6">
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

                                                                <img src="{{ $imageToShow }}"
                                                                    alt="{{ $row->title_en }}" class="img-fluid">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">

                                </div>
                            </div>
                        </div>
                        <div class="main--sidebar col-md-4 col-sm-5 ptop--30 pbottom--30"">
                            <div class="sticky-content-inner">
                                <div class="widget">
                                    <div class="poll--widget" data-ajax-content="outer">
                                        <div class="widget--title" style="border-top: none; !important">
                                            <h2 class="h4">
                                                @if (session()->get('lang') == 'english')
                                                    Voting Poll
                                                @else
                                                    অনলাইন জরিপ
                                                @endif
                                            </h2>
                                            <i class="icon fa-solid fa-chart-simple"></i>
                                        </div>
                                        <ul class="nav" data-ajax-content="inner">
                                            <li class="title">
                                                <h3 class="h4">Do you think the cost of sending money to mobile phone
                                                    should be reduced?</h3>
                                            </li>
                                            <li class="options">
                                                <form
                                                    action="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}">
                                                    <div class="radio"> <label> <input type="radio" name="option-1">
                                                            <span>Yes</span> </label>
                                                        <p>65%<span style="width: 65%;"></span></p>
                                                    </div>
                                                    <div class="radio"> <label> <input type="radio" name="option-1">
                                                            <span>No</span> </label>
                                                        <p>28%<span style="width: 28%;"></span></p>
                                                    </div>
                                                    <div class="radio"> <label> <input type="radio" name="option-1">
                                                            <span>Average</span> </label>
                                                        <p>07%<span style="width: 07%;"></span></p>
                                                    </div><button type="submit" class="btn btn-primary">
                                                        @if (session()->get('lang') == 'english')
                                                            Vote Now
                                                        @else
                                                            ভোট দিন
                                                        @endif
                                                    </button>
                                                </form>
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
        {{-- LifeStyle Section News End --}}

        {{-- Law-Order Section News  Start --}}
        <div class="row" style="margin-top: 30px">
            <div class="main--content" data-sticky-content="true">
                <div class="sticky-content-inner">
                    <div class="row">
                        {{-- Section Title --}}
                        <div class="post--items-title" data-ajax="tab">
                            <div style="display: flex; justify-content: space-between">
                                <h2 class="h4">
                                    @if (session()->get('lang') == 'english')
                                        {{ $lonbt->newsCategory->category_en }}
                                    @else
                                        {{ $lonbt->newsCategory->category_bn }}
                                    @endif
                                </h2>
                                <a href="{{ route('getCate.news', $lonbt->newsCategory->slug) }}"
                                    style="font-size: 15px; font-weight: bold">{{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}</a>
                            </div>
                        </div>

                        {{-- Main Content --}}
                        <div class="main--content col-md-8 col-sm-7">
                            <div class="post--items post--items-4" data-ajax-content="outer">
                                <div class="row">
                                    {{-- Left Column (col-md-3) --}}
                                    <div class="col-md-6" style="margin: 0 !important; padding: 0 !important">
                                        <div class="post--img">
                                            <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                class="thumb">
                                                @php
                                                    $isPlaceholder = Str::contains(
                                                        $lonbt->thumbnail,
                                                        'via.placeholder.com',
                                                    );
                                                    $imageToShow =
                                                        !$isPlaceholder && !empty($lonbt->thumbnail)
                                                            ? $lonbt->thumbnail
                                                            : asset('uploads/default_images/deafult_thumbnail.jpg');
                                                @endphp

                                                <img src="{{ $imageToShow }}" alt="{{ $lonbt->title_en }}"
                                                    class="img-fluid">
                                            </a>

                                            <div class="post--info">
                                                <div class="title">
                                                    <h2 class="h4" style="font-size: 24px">
                                                        <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                            class="btn-link">
                                                            @if (session()->get('lang') == 'english')
                                                                {{ $lonbt->title_en }}
                                                            @else
                                                                {{ $lonbt->title_bn }}
                                                            @endif
                                                        </a>
                                                    </h2>
                                                    <p style="font-size: 16px; margin-top: -5px">
                                                        @if (session()->get('lang') == 'english')
                                                            {!! Str::limit($lonbt->details_en, 150, '...') !!}
                                                        @else
                                                            {!! Str::limit($lonbt->details_bn, 150, '...') !!}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="divider hidden-md hidden-lg">
                                    </div>

                                    {{-- Middle Column (col-md-7) --}}
                                    <div class="col-md-6">
                                        <div>
                                            @foreach ($lonrn3 as $index => $row)
                                                <div
                                                    class="row"style="display: flex; justify-content: space-between; align-items: center; {{ $index !== 0 ? 'margin-top: 15px;' : '' }}">
                                                    <div class="col-sm-6">
                                                        @if (session()->get('lang') == 'english')
                                                            <h4>{{ $row->title_en }}</h4>
                                                        @else
                                                            <h4>{{ $row->title_bn }}</h4>
                                                        @endif
                                                    </div>
                                                    <div class="col-sm-6">
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
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 30px">
                                    @foreach ($lon4 as $index => $row)
                                        <div class="col-md-6"
                                            style="display: flex; align-items: center; margin: 0; padding: 0; {{ $index === 2 || $index === 3 ? 'margin-top: 30px;' : '' }}">
                                            <div class="col-md-8">
                                                <div>
                                                    @if (session()->get('lang') == 'english')
                                                        <h4>{{ $row->title_en }}</h4>
                                                    @else
                                                        <h4>{{ $row->title_bn }}</h4>
                                                    @endif
                                                </div>
                                                <div>
                                                    @if (session()->get('lang') == 'english')
                                                        {!! Str::limit($row->details_en, 80, '...') !!}
                                                    @else
                                                        {!! Str::limit($row->details_bn, 100, '...') !!}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
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
                                                                : asset('uploads/default_images/deafult_thumbnail.jpg');
                                                    @endphp

                                                    <img src="{{ $imageToShow }}" alt="{{ $row->title_en }}"
                                                        class="img-fluid">
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="main--sidebar col-md-4 col-sm-5 ptop--30 pbottom--30"">
                            <div class="sticky-content-inner">
                                <div class="widget">
                                    <div class="widget--title">
                                        <h2 class="h4">
                                            @if (session()->get('lang') == 'english')
                                                TAGS
                                            @else
                                                ট্যাগ সমূহ
                                            @endif
                                        </h2> <i class="icon fa fa-tags"></i>
                                    </div>
                                    <div class="tags--widget style--3">
                                        <ul class="nav">
                                            @foreach ($categoriesCount as $category)
                                                <li>
                                                    <a href="{{ route('getCate.news', $category->slug) }}">
                                                        @if (session()->get('lang') == 'english')
                                                            {{ $category->category_en }}
                                                        @else
                                                            {{ $category->category_bn }}
                                                        @endif
                                                        <span>{{ $category->news_count }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div style="display: flex; justify-content: center; margin-top: 30px;">
                                    <div class="calendar-box">
                                        <div
                                            style="background-color: #F0F0F0; margin-top: -10px !important; padding: 0px !important">
                                            <h4 style="padding: 15px 0 20px 0">
                                                @if (session()->get('lang') == 'english')
                                                    Archive
                                                @else
                                                    আর্কাইভ
                                                @endif
                                            </h4>
                                            <div class="calendar-header">
                                                <select id="yearSelect"></select>
                                                <select id="monthSelect"></select>
                                            </div>
                                            <div class="calendar-days" style=" border-bottom: 1px solid black;">
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
                    </div>
                </div>
            </div>
        </div>
        {{-- Law-Order Section News End --}}

        {{-- Video & Photo Gallery Section News Start --}}
        <div class="row" style="margin-top: 30px">

            <div class="main--content">
                <div class="post--items post--items-1 pd--30-0">
                    <div class="row gutter--15">
                        {{-- This Section will Show Main news --}}
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    {{-- Video Section  --}}

                                    <div class="post--items-title" data-ajax="tab">
                                        <div style="display: flex; justify-content: space-between">
                                            <h2 class="h4">
                                                @if (session()->get('lang') == 'english')
                                                    Video Gallery
                                                @else
                                                    ভিডিও গ্যালারী
                                                @endif
                                            </h2>
                                            <a href="{{ route('video.gallery') }}"
                                                style="font-size: 15px; font-weight: bold">{{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}</a>
                                        </div>
                                    </div>
                                    <div>
                                        @php
                                            $iframeSrc = null;
                                            $videoId = null;

                                            if (!empty($vgnbt->embed_code)) {
                                                // Extract src attribute from embed code
                                                if (preg_match('/src="([^"]+)"/', $vgnbt->embed_code, $matches)) {
                                                    $iframeSrc = $matches[1] ?? null;

                                                    // Check if it's a YouTube embed
        if ($iframeSrc && str_contains($iframeSrc, 'youtube.com')) {
            // Extract video ID from embed URL
            if (preg_match('/embed\/([^\?&"]+)/', $iframeSrc, $idMatch)) {
                                                            $videoId = $idMatch[1] ?? null;
                                                        }
                                                    }
                                                }
                                            }
                                        @endphp
                                        <div class="video-container">
                                            <a data-fancybox data-type="iframe" href="{{ $iframeSrc }}"
                                                class="video-wrapperg">
                                                @if ($videoId)
                                                    <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                                        alt="Video Thumbnail">
                                                @else
                                                    <img src="{{ asset('default-thumb.jpg') }}" alt="Default Thumbnail">
                                                @endif

                                                <div class="play-overlayg">
                                                    <i class="fa fa-play"></i>
                                                </div>
                                            </a>

                                            <div>
                                                <a data-fancybox data-type="iframe" href="{{ $iframeSrc }}"
                                                    class="card-link title-black" style="color: black; font-size: 18px;">
                                                    <h4 style="margin: 10 !important; padding: 0 !important;">
                                                        <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                            class="btn-link">
                                                            {{ session('lang') == 'english' ? $vgnbt->title_en : $vgnbt->title_bn }}
                                                        </a>
                                                    </h4>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                {{-- Loop for 3 videos --}}
                                @foreach ($vgn3 as $row)
                                    <div class="col-md-4" style="display:flex; margin-top: 30px">
                                        <div>
                                            @php
                                                preg_match('/src="([^"]+)"/', $row->embed_code, $matches);
                                                $iframeSrc = $matches[1] ?? null;
                                                $videoId = null;
                                                if ($iframeSrc && Str::contains($iframeSrc, 'youtube.com')) {
                                                    preg_match('/embed\/([^\?&"]+)/', $iframeSrc, $idMatch);
                                                    $videoId = $idMatch[1] ?? null;
                                                }
                                            @endphp

                                            @if ($iframeSrc)
                                                <a data-fancybox data-type="iframe" href="{{ $iframeSrc }}"
                                                    class="video-wrapper3">
                                                    @if ($videoId)
                                                        <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                                            alt="Video Thumbnail">
                                                    @else
                                                        <img src="{{ asset('default-thumb.jpg') }}"
                                                            alt="Default Thumbnail">
                                                    @endif
                                                    <div class="play-overlay3">
                                                        <i class="fa fa-play"
                                                            style="font-size: 24px; color: white !important"></i>
                                                    </div>
                                                </a>
                                            @endif

                                            <div class="post--info">
                                                <div class="title">
                                                    <h2 class="h4">
                                                        <a data-fancybox href="{{ $imageToShow }}"
                                                            style="margin-top: 10px" class="btn-link">
                                                            @if (session()->get('lang') == 'english')
                                                                {{ \Illuminate\Support\Str::limit($row->title_en, 38) }}
                                                            @else
                                                                {{ \Illuminate\Support\Str::limit($row->title_bn, 38) }}
                                                            @endif
                                                        </a>
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- This Section will Show Main news --}}
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    {{-- Photos Section --}}
                                    <div class="post--items-title" data-ajax="tab">
                                        <div style="display: flex; justify-content: space-between">
                                            <h2 class="h4">
                                                @if (session()->get('lang') == 'bangla')
                                                    ফটো গ্যালারী
                                                @else
                                                    Photo Gallery
                                                @endif
                                            </h2>
                                            <a href="{{ route('getCate.news', $nnbt->newsCategory->slug) }}"
                                                style="font-size: 15px; font-weight: bold">{{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}</a>
                                        </div>
                                    </div>

                                    <div>
                                        <a href="news-single-v1.html" class="thumb">
                                            @php
                                                $isPlaceholder = Str::contains(
                                                    $pgnbt->thumbnail,
                                                    'via.placeholder.com',
                                                );
                                                $imageToShow =
                                                    !$isPlaceholder && !empty($pgnbt->thumbnail)
                                                        ? $pgnbt->thumbnail
                                                        : $pgnbt->image;
                                            @endphp

                                            <img data-fancybox src="{{ $imageToShow }}" alt="{{ $pgnbt->title_en }}"
                                                class="img-fluid w-100" style="height: 433px !important">
                                        </a>

                                        <div class="post--info">
                                            <div class="title">
                                                <h4 style="margin: 10 !important; padding: 0 !important;">
                                                    <a data-fancybox href="{{ $imageToShow }}" class="btn-link"
                                                        data-fancybox>
                                                        {{ session('lang') == 'english' ? $pgnbt->title_en : $pgnbt->title_bn }}
                                                    </a>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Loop for 3 photos --}}
                                @foreach ($pgn3 as $row)
                                    <div class="col-md-4" style="display:flex; margin-top: 15px">
                                        <div class="post--img" style="{{ $index !== 0 ? 'margin-top: 15px;' : '' }}">
                                            <a data-fancybox href="news-single-v1.html" class="thumb">
                                                @php
                                                    $isPlaceholder = Str::contains(
                                                        $row->thumbnail,
                                                        'via.placeholder.com',
                                                    );
                                                    $imageToShow =
                                                        !$isPlaceholder && !empty($row->thumbnail)
                                                            ? $row->thumbnail
                                                            : $row->image;
                                                @endphp


                                                <img data-fancybox src="{{ $imageToShow }}"
                                                    alt="{{ $row->title_en }}"class="img-fluid"
                                                    style="width: 173px; height: 130px;">
                                            </a>
                                            <div class="post--info">
                                                <div class="title">
                                                    <h2 class="h4">
                                                        <a data-fancybox href="{{ $imageToShow }}"
                                                            style="margin-top: 10px" class="btn-link">
                                                            {{ session('lang') == 'english' ? $row->title_en : $row->title_bn }}
                                                        </a>
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Video & Photo Gallery Section News End --}}

        {{-- Polictics And Economics Section News  Start --}}
        <div class="row" style="margin-top: 30px">
            <div class="main--content" data-sticky-content="true">
                <div class="sticky-content-inner">
                    <div class="row">
                        {{-- Main Content --}}
                        <div class="main--content col-md-6 col-sm-7">
                            {{-- Politic Title --}}
                            <div class="post--items-title" data-ajax="tab">
                                <div style="display: flex; justify-content: space-between">
                                    <h2 class="h4">
                                        @if (session()->get('lang') == 'english')
                                            {{ $pnbt->newsCategory->category_en }}
                                        @else
                                            {{ $pnbt->newsCategory->category_bn }}
                                        @endif
                                    </h2>
                                    <a href="{{ route('getCate.news', $pnbt->newsCategory->slug) }}"
                                        style="font-size: 15px; font-weight: bold">{{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}</a>
                                </div>
                            </div>

                            <div class="post--items post--items-4" data-ajax-content="outer">

                                {{-- Left Column (col-md-3) --}}
                                <div class="col-md-6" style="margin: 0 !important; padding: 0 !important">
                                    <div class="post--img">
                                        <a href="{{ route('showFull.news', ['category' => $pnbt->newsCategory->slug, 'subcategory' => $pnbt->newsSubcategory->slug, 'id' => $pnbt->id]) }}"
                                            class="thumb">
                                            @php
                                                $isPlaceholder = Str::contains($pnbt->thumbnail, 'via.placeholder.com');
                                                $imageToShow =
                                                    !$isPlaceholder && !empty($pnbt->thumbnail)
                                                        ? $pnbt->thumbnail
                                                        : asset('uploads/default_images/deafult_thumbnail.jpg');
                                            @endphp

                                            <img src="{{ $imageToShow }}" alt="{{ $pnbt->title_en }}"
                                                class="img-fluid">
                                        </a>

                                        <div class="post--info">
                                            <div class="title">
                                                <h2 class="h4" style="font-size: 24px">
                                                    <a href="{{ route('showFull.news', ['category' => $pnbt->newsCategory->slug, 'subcategory' => $pnbt->newsSubcategory->slug, 'id' => $pnbt->id]) }}"
                                                        class="btn-link">
                                                        @if (session()->get('lang') == 'english')
                                                            {{ $pnbt->title_en }}
                                                        @else
                                                            {{ $pnbt->title_bn }}
                                                        @endif
                                                    </a>
                                                </h2>
                                                <p style="font-size: 16px; margin-top: -5px">
                                                    @if (session()->get('lang') == 'english')
                                                        {!! Str::limit($pnbt->details_en, 150, '...') !!}
                                                    @else
                                                        {!! Str::limit($pnbt->details_bn, 150, '...') !!}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Middle Column (col-md-7) --}}
                                <div class="col-md-6">
                                    <div>
                                        @foreach ($pn3 as $index => $row)
                                            <div
                                                class="row"style="display: flex; justify-content: space-between; align-items: center; {{ $index !== 0 ? 'margin-top: 15px;' : '' }}">
                                                <div class="col-sm-6">
                                                    @if (session()->get('lang') == 'english')
                                                        {{ $row->title_en }}
                                                    @else
                                                        {{ $row->title_bn }}
                                                    @endif
                                                </div>
                                                <div class="col-sm-6">
                                                    <h3>
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
                                                    </h3>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Finance Section --}}
                        <div class="main--content col-md-6 col-sm-7">
                            {{-- Finance Title --}}
                            <div class="post--items-title" data-ajax="tab">
                                <div style="display: flex; justify-content: space-between">
                                    <h2 class="h4">
                                        @if (session()->get('lang') == 'english')
                                            {{ $fnbt->newsCategory->category_en }}
                                        @else
                                            {{ $fnbt->newsCategory->category_bn }}
                                        @endif
                                    </h2>
                                    <a href="{{ route('getCate.news', $fnbt->newsCategory->slug) }}"
                                        style="font-size: 15px; font-weight: bold">{{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}</a>
                                </div>
                            </div>
                            <div class="post--items post--items-4" data-ajax-content="outer">

                                {{-- Left Column (col-md-3) --}}
                                <div class="col-md-6" style="margin: 0 !important; padding: 0 !important">
                                    <div class="post--img">
                                        <a href="{{ route('showFull.news', ['category' => $fnbt->newsCategory->slug, 'subcategory' => $fnbt->newsSubcategory->slug, 'id' => $fnbt->id]) }}"
                                            class="thumb">
                                            @php
                                                $isPlaceholder = Str::contains($fnbt->thumbnail, 'via.placeholder.com');
                                                $imageToShow =
                                                    !$isPlaceholder && !empty($fnbt->thumbnail)
                                                        ? $fnbt->thumbnail
                                                        : asset('uploads/default_images/deafult_thumbnail.jpg');
                                            @endphp

                                            <img src="{{ $imageToShow }}" alt="{{ $fnbt->title_en }}"
                                                class="img-fluid">
                                        </a>

                                        <div class="post--info">
                                            <div class="title">
                                                <h2 class="h4" style="font-size: 24px">
                                                    <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                        class="btn-link">
                                                        @if (session()->get('lang') == 'english')
                                                            {{ $fnbt->title_en }}
                                                        @else
                                                            {{ $fnbt->title_bn }}
                                                        @endif
                                                    </a>
                                                </h2>
                                                <p style="font-size: 16px; margin-top: -5px">
                                                    @if (session()->get('lang') == 'english')
                                                        {!! Str::limit($fnbt->details_en, 150, '...') !!}
                                                    @else
                                                        {!! Str::limit($fnbt->details_bn, 150, '...') !!}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Middle Column (col-md-7) --}}
                                <div class="col-md-6">
                                    <div>
                                        @foreach ($fn3 as $index => $row)
                                            <div
                                                class="row"style="display: flex; justify-content: space-between; align-items: center; {{ $index !== 0 ? 'margin-top: 15px;' : '' }}">
                                                <div class="col-sm-6">
                                                    @if (session()->get('lang') == 'bangla')
                                                        {{ $row->title_bn }}
                                                    @else
                                                        {{ $row->title_en }}
                                                    @endif
                                                </div>
                                                <div class="col-sm-6">
                                                    <h3>
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
                                                    </h3>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- Polictics And Economics Section News  End --}}


        {{-- Polictics And Economics Section News  Start --}}
        <div class="row" style="margin-top: 30px; margin-bottom: 20px">
            <div class="main--content" data-sticky-content="true">
                <div class="sticky-content-inner">
                    <div class="row">
                        {{-- Job Section Content --}}
                        <div class="main--content col-md-3 col-sm-7">
                            {{-- Politic Title --}}
                            <div class="post--items-title" data-ajax="tab">
                                <div style="display: flex; justify-content: space-between">
                                    <h2 class="h4">
                                        @if (session()->get('lang') == 'english')
                                            {{ $pnbt->newsCategory->category_en }}
                                        @else
                                            {{ $pnbt->newsCategory->category_bn }}
                                        @endif
                                    </h2>
                                    <a href="{{ route('getCate.news', $pnbt->newsCategory->slug) }}"
                                        style="font-size: 15px; font-weight: bold">{{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}</a>
                                </div>
                            </div>
                            <div class="post--items post--items-4" data-ajax-content="outer">

                                {{-- Left Column (col-md-3) --}}
                                <div class="col-md-12" style="margin: 0 !important; padding: 0 !important">
                                    <div class="post--img">
                                        <a href="{{ route('showFull.news', ['category' => $pnbt->newsCategory->slug, 'subcategory' => $pnbt->newsSubcategory->slug, 'id' => $pnbt->id]) }}"
                                            class="thumb">
                                            @php
                                                $isPlaceholder = Str::contains($pnbt->thumbnail, 'via.placeholder.com');
                                                $imageToShow =
                                                    !$isPlaceholder && !empty($pnbt->thumbnail)
                                                        ? $pnbt->thumbnail
                                                        : asset('uploads/default_images/deafult_thumbnail.jpg');
                                            @endphp

                                            <img src="{{ $imageToShow }}" alt="{{ $pnbt->title_en }}"
                                                class="img-fluid">
                                        </a>

                                        <div class="post--info">
                                            <div class="title">
                                                <h2 class="h4" style="font-size: 20.8px">
                                                    <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                        class="btn-link">
                                                        @if (session()->get('lang') == 'english')
                                                            {{ $pnbt->title_en }}
                                                        @else
                                                            {{ $pnbt->title_bn }}
                                                        @endif
                                                    </a>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach ([1, 2, 3] as $index => $row)
                                    <div class="col-md-12" style="margin: 0 !important; padding: 0 !important">
                                        <div class="post--info" style="margin-top: 15px;">
                                            <div class="title">
                                                <h2 class="h4" style="font-size: 19.2px">
                                                    <a href="#" class="btn-link posthover">
                                                        @if (session()->get('lang') == 'english')
                                                            {{ $pnbt->title_en }}
                                                        @else
                                                            {{ $pnbt->title_bn }}
                                                        @endif
                                                    </a>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- Other Section Content --}}
                        <div class="main--content col-md-3 col-sm-7">
                            {{-- Politic Title --}}
                            <div class="post--items-title" data-ajax="tab">
                                <div style="display: flex; justify-content: space-between">
                                    <h2 class="h4">
                                        @if (session()->get('lang') == 'english')
                                            {{ $pnbt->newsCategory->category_en }}
                                        @else
                                            {{ $pnbt->newsCategory->category_bn }}
                                        @endif
                                    </h2>
                                    <a href="{{ route('getCate.news', $pnbt->newsCategory->slug) }}"
                                        style="font-size: 15px; font-weight: bold">{{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}</a>
                                </div>
                            </div>
                            <div class="post--items post--items-4" data-ajax-content="outer">

                                {{-- Left Column (col-md-3) --}}
                                <div class="col-md-12" style="margin: 0 !important; padding: 0 !important">
                                    <div class="post--img">
                                        <a href="{{ route('showFull.news', ['category' => $pnbt->newsCategory->slug, 'subcategory' => $pnbt->newsSubcategory->slug, 'id' => $pnbt->id]) }}"
                                            class="thumb">
                                            @php
                                                $isPlaceholder = Str::contains($pnbt->thumbnail, 'via.placeholder.com');
                                                $imageToShow =
                                                    !$isPlaceholder && !empty($pnbt->thumbnail)
                                                        ? $pnbt->thumbnail
                                                        : asset('uploads/default_images/deafult_thumbnail.jpg');
                                            @endphp

                                            <img src="{{ $imageToShow }}" alt="{{ $pnbt->title_en }}"
                                                class="img-fluid">
                                        </a>

                                        <div class="post--info">
                                            <div class="title">
                                                <h2 class="h4" style="font-size: 20.8px">
                                                    <a href="{{ route('showFull.news', ['category' => $pnbt->newsCategory->slug, 'subcategory' => $pnbt->newsSubcategory->slug, 'id' => $pnbt->id]) }}"
                                                        class="btn-link">
                                                        @if (session()->get('lang') == 'english')
                                                            {{ $pnbt->title_en }}
                                                        @else
                                                            {{ $pnbt->title_bn }}
                                                        @endif
                                                    </a>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach ([1, 2, 3] as $index => $row)
                                    <div class="col-md-12" style="margin: 0 !important; padding: 0 !important">
                                        <div class="post--info" style="margin-top: 15px;">
                                            <div class="title">
                                                <h2 class="h4" style="font-size: 19.2px">
                                                    <a href="#" class="btn-link posthover">
                                                        @if (session()->get('lang') == 'english')
                                                            {{ $pnbt->title_en }}
                                                        @else
                                                            {{ $pnbt->title_bn }}
                                                        @endif
                                                    </a>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- Crime Section Content --}}
                        <div class="main--content col-md-3 col-sm-7">
                            {{-- Politic Title --}}
                            <div class="post--items-title" data-ajax="tab">
                                <div style="display: flex; justify-content: space-between">
                                    <h2 class="h4">
                                        @if (session()->get('lang') == 'english')
                                            {{ $pnbt->newsCategory->category_en }}
                                        @else
                                            {{ $pnbt->newsCategory->category_bn }}
                                        @endif
                                    </h2>
                                    <a href="{{ route('getCate.news', $pnbt->newsCategory->slug) }}"
                                        style="font-size: 15px; font-weight: bold">{{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}</a>
                                </div>
                            </div>
                            <div class="post--items post--items-4" data-ajax-content="outer">

                                {{-- Left Column (col-md-3) --}}
                                <div class="col-md-12" style="margin: 0 !important; padding: 0 !important">
                                    <div class="post--img">
                                        <a href="{{ route('showFull.news', ['category' => $pnbt->newsCategory->slug, 'subcategory' => $pnbt->newsSubcategory->slug, 'id' => $pnbt->id]) }}"
                                            class="thumb">
                                            @php
                                                $isPlaceholder = Str::contains($pnbt->thumbnail, 'via.placeholder.com');
                                                $imageToShow =
                                                    !$isPlaceholder && !empty($pnbt->thumbnail)
                                                        ? $pnbt->thumbnail
                                                        : asset('uploads/default_images/deafult_thumbnail.jpg');
                                            @endphp

                                            <img src="{{ $imageToShow }}" alt="{{ $pnbt->title_en }}"
                                                class="img-fluid">
                                        </a>

                                        <div class="post--info">
                                            <div class="title">
                                                <h2 class="h4" style="font-size: 20.8px">
                                                    <a href="{{ route('showFull.news', ['category' => $pnbt->newsCategory->slug, 'subcategory' => $pnbt->newsSubcategory->slug, 'id' => $pnbt->id]) }}"
                                                        class="btn-link">
                                                        @if (session()->get('lang') == 'english')
                                                            {{ $pnbt->title_en }}
                                                        @else
                                                            {{ $pnbt->title_bn }}
                                                        @endif
                                                    </a>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach ([1, 2, 3] as $index => $row)
                                    <div class="col-md-12" style="margin: 0 !important; padding: 0 !important">
                                        <div class="post--info" style="margin-top: 15px;">
                                            <div class="title">
                                                <h2 class="h4" style="font-size: 19.2px">
                                                    <a href="news-single-v1.html" class="btn-link posthover">
                                                        @if (session()->get('lang') == 'english')
                                                            {{ $pnbt->title_en }}
                                                        @else
                                                            {{ $pnbt->title_bn }}
                                                        @endif
                                                    </a>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- Technology Section Content --}}
                        <div class="main--content col-md-3 col-sm-7">
                            {{-- Politic Title --}}
                            <div class="post--items-title" data-ajax="tab">
                                <div style="display: flex; justify-content: space-between">
                                    <h2 class="h4">
                                        @if (session()->get('lang') == 'english')
                                            {{ $pnbt->newsCategory->category_en }}
                                        @else
                                            {{ $pnbt->newsCategory->category_bn }}
                                        @endif
                                    </h2>
                                    <a href="{{ route('getCate.news', $pnbt->newsCategory->slug) }}"
                                        style="font-size: 15px; font-weight: bold">{{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}</a>
                                </div>
                            </div>
                            <div class="post--items post--items-4" data-ajax-content="outer">

                                {{-- Left Column (col-md-3) --}}
                                <div class="col-md-12" style="margin: 0 !important; padding: 0 !important">
                                    <div class="post--img">
                                        <a href="{{ route('showFull.news', ['category' => $pnbt->newsCategory->slug, 'subcategory' => $pnbt->newsSubcategory->slug, 'id' => $pnbt->id]) }}"
                                            class="thumb">
                                            @php
                                                $isPlaceholder = Str::contains($pnbt->thumbnail, 'via.placeholder.com');
                                                $imageToShow =
                                                    !$isPlaceholder && !empty($pnbt->thumbnail)
                                                        ? $pnbt->thumbnail
                                                        : asset('uploads/default_images/deafult_thumbnail.jpg');
                                            @endphp

                                            <img src="{{ $imageToShow }}" alt="{{ $pnbt->title_en }}"
                                                class="img-fluid">
                                        </a>

                                        <div class="post--info">
                                            <div class="title">
                                                <h2 class="h4" style="font-size: 20.8px">
                                                    <a href="news-single-v1.html" class="btn-link">
                                                        @if (session()->get('lang') == 'english')
                                                            {{ $pnbt->title_en }}
                                                        @else
                                                            {{ $pnbt->title_bn }}
                                                        @endif
                                                    </a>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach ([1, 2, 3] as $index => $row)
                                    <div class="col-md-12" style="margin: 0 !important; padding: 0 !important">
                                        <div class="post--info" style="margin-top: 15px;">
                                            <div class="title">
                                                <h2 class="h4" style="font-size: 19.2px">
                                                    <a href="news-single-v1.html" class="btn-link posthover">
                                                        @if (session()->get('lang') == 'english')
                                                            {{ $pnbt->title_en }}
                                                        @else
                                                            {{ $pnbt->title_bn }}
                                                        @endif
                                                    </a>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- Polictics And Economics Section News  End --}}
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
