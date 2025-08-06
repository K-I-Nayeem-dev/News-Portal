@extends('layouts.newsIndex.newsMaster')

@section('content')

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
            transform: translate(-50%, -80%);
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
    </style>
    {{-- Custom CSS Code section End --}}


    {{-- Breaking News Section Start --}}
    <div>
        @if ($breaking_news->count() > 0)
            <div class="news--ticker">
                <div class="container">
                    <div class="title">
                        @if (session()->get('lang') == 'bangla')
                            <h2>শিরোনাম</h2>
                        @else
                            <h2>Headline</h2>
                        @endif
                        {{-- <span>(Update {{ \Carbon\Carbon::parse($time->created_at)->diffForHumans() }})</span> --}}
                    </div>
                    <div class="news-updates--list" data-marquee="true">
                        <ul class="nav">
                            @foreach ($breaking_news as $news)
                                <li>
                                    <h3 class="h3">
                                        <a target="_blank" {{ $news->url ? 'href=' . $news->url . ' ' : '' }}> **
                                            {{ $news->news }} ** </a>
                                    </h3>
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
                        @if (session()->get('lang') == 'bangla')
                            <h2>নোটিশ</h2>
                        @else
                            <h2>Notice</h2>
                        @endif
                        {{-- <span>(Update {{ \Carbon\Carbon::parse($time->created_at)->diffForHumans() }})</span> --}}
                    </div>
                    <div class="news-updates--list" data-marquee="true">
                        <ul class="nav">
                            @if (session()->get('lang') == 'bangla')
                                <li>
                                    <h3 class="h3">
                                        <a> !!! {{ $notice->notice_bn }} !!! </a>
                                    </h3>
                                </li>
                            @else
                                <li>
                                    <h3 class="h3">
                                        <a> !!! {{ $notice->notice_en }} !!! </a>
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
        {{-- Main Headline or fisrt News Section & Frist Section 2 News Start --}}
        <div class="main--content">
            <div class="post--items post--items-1 pd--30-0">
                <div class="row gutter--15">
                    <div class="col-md-3">
                        <div class="row gutter--15">
                            {{-- First Section News --}}
                            @foreach ($fs1 as $row)
                                <div class="col-md-12 col-xs-6 col-xxs-12">
                                    <div>
                                        <div class="post--img">
                                            <a href="news-single-v1.html" class="thumb"><img src="{{ $row->thumbnail }}"
                                                    alt="{{ $row->title }}" /></a>
                                            <a href="#" class="cat">
                                                @if (session()->get('lang') == 'bangla')
                                                    {{ $row->newsCategory->category_bn }}
                                                @else
                                                    {{ $row->newsCategory->category_en }}
                                                @endif
                                            </a>
                                            <div class="post--info">
                                                <div class="title">
                                                    <h2 class="h4">
                                                        <a href="news-single-v1.html" class="btn-link">
                                                            @if (session()->get('lang') == 'bangla')
                                                                {{ $row->title_bn }}
                                                            @else
                                                                {{ $row->title_en }}
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
                                {{-- <a href="news-single-v1.html" class="thumb"><img src="{{ asset('uploads/news_photos/'. $fsbt->news_photo) }}"alt="{{ $fsbt->title }}" /></a> --}}
                                <a href="news-single-v1.html" class="thumb"><img
                                        src="{{ $fsbt->thumbnail }}"alt="{{ $fsbt->title }}" /></a>
                                <a href="#" class="cat">
                                    @if (session()->get('lang') == 'bangla')
                                        {{ $fsbt->newsCategory->category_bn }}
                                    @else
                                        {{ $fsbt->newsCategory->category_en }}
                                    @endif
                                </a>
                                <div class="post--info">
                                    <div class="title">
                                        <h2 class="h4">
                                            <a href="news-single-v1.html" class="btn-link">
                                                @if (session()->get('lang') == 'bangla')
                                                    <h2>{{ $fsbt->title_bn }}</h2>
                                                @else
                                                    <h2>{{ $fsbt->title_en }}</h2>
                                                @endif

                                            </a>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row gutter--15">
                            @foreach ($fs2 as $row)
                                <div class="col-md-12 col-xs-6 col-xxs-12">
                                    <div>
                                        <div class="post--img">
                                            <a href="news-single-v1.html" class="thumb">
                                                <a href="news-single-v1.html" class="thumb">
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
                                            </a>
                                            <a href="#" class="cat">
                                                @if (session()->get('lang') == 'bangla')
                                                    {{ $row->newsCategory->category_bn }}
                                                @else
                                                    {{ $row->newsCategory->category_en }}
                                                @endif
                                            </a>
                                            <div class="post--info">
                                                <div class="title">
                                                    <h2 class="h4">
                                                        <a href="news-single-v1.html" class="btn-link">
                                                            @if (session()->get('lang') == 'bangla')
                                                                {{ $row->title_bn }}
                                                            @else
                                                                {{ $row->title_en }}
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
                </div>
            </div>
        </div>
        {{-- Main Headline or fisrt News Section & Frist Section 2 News End --}}


        {{-- fisrt Section 9 News with widget Start --}}
        <div class="row">
            <div class="main--content col-md-8 col-sm-7" data-sticky-content="true">
                <div class="sticky-content-inner">
                    <div class="row">
                        @foreach ($fs9 as $row)
                            <div class="col-6 col-sm-6 col-md-4 mt-3" style="margin-top: 20px">
                                <div>
                                    <div class="post--img">
                                        <a href="news-single-v1.html" class="thumb">
                                            @php
                                                $isPlaceholder = Str::contains($row->thumbnail, 'via.placeholder.com');
                                                $imageToShow =
                                                    !$isPlaceholder && !empty($row->thumbnail)
                                                        ? $row->thumbnail
                                                        : asset('uploads/default_images/deafult_thumbnail.jpg');
                                            @endphp

                                            <img src="{{ $imageToShow }}" alt="{{ $row->title_en }}" class="img-fluid">

                                        </a>
                                        <a href="#" class="cat">
                                            @if (session()->get('lang') == 'bangla')
                                                {{ $row->newsCategory->category_bn }}
                                            @else
                                                {{ $row->newsCategory->category_en }}
                                            @endif
                                        </a>
                                        <div class="post--info">

                                            <div class="title">
                                                <h2 class="h4">
                                                    <a href="news-single-v1.html" class="btn-link">
                                                        @if (session()->get('lang') == 'bangla')
                                                            {{ $row->title_bn }}
                                                        @else
                                                            {{ $row->title_en }}
                                                        @endif
                                                    </a>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-md-12 ptop--30 pbottom--30">
                            <div class="ad--space">
                                <a href="#">
                                    <img src="{{ asset('frontend_assets') }}/img/ads-img/ad-728x90-01.jpg" alt=""
                                        class="center-block" />
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="main--sidebar col-md-4 col-sm-5 ptop--30 pbottom--30" data-sticky-content="true">
                <div class="sticky-content-inner">
                    <div class="widget">
                        <div class="widget--title">
                            <h2 class="h4">
                                @if (session()->get('lang') == 'bangla')
                                    আলোচিত খবর
                                @else
                                    Featured News
                                @endif
                            </h2>
                            <i class="icon fa fa-newspaper-o"></i>
                        </div>
                        <div class="list--widget list--widget-1">
                            <div class="list--widget-nav" data-ajax="tab">
                                <ul class="nav nav-justified">
                                    <li class="active">
                                        <a href="#" data-ajax-action="load_widget_trendy_news">
                                            @if (session()->get('lang') == 'bangla')
                                                টেন্ডিং নিউজ
                                            @else
                                                Trendy News
                                            @endif
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-ajax-action="load_widget_most_watched">
                                            @if (session()->get('lang') == 'bangla')
                                                সর্বাধিক দেখা
                                            @else
                                                Most Watched
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
                                                        <a href="news-single-v1.html" class="thumb">

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
                                                                <li><a href="#">{{ $row->newsUser->name }}</a></li>
                                                                <li>
                                                                    <a href="#">
                                                                        @if (session()->get('lang') == 'bangla')
                                                                            {{ formatBanglaDate($row->created_at) }}
                                                                        @else
                                                                            {{ $row->created_at->format('j F Y') }}
                                                                        @endif
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <div class="title" style="margin-top: -4px;">
                                                                <h3 class="h4">
                                                                    <a href="news-single-v1.html" class="btn-link">
                                                                        @if (session()->get('lang') == 'bangla')
                                                                            {{ $row->title_bn }}
                                                                        @else
                                                                            {{ $row->title_en }}
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
                    <div class="card mb-4" style="margin-top: 25px">
                        <div class="card-header bg-success text-white">
                            🕌 আজকের নামাজের সময়সূচি
                        </div>
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm mb-0 text-center" id="namaz-times-table">
                                    <thead class="table-light">
                                        <tr>
                                            <th>নামাজ</th>
                                            <th>সময়</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>ফজর</td>
                                            <td id="fajr">লোড হচ্ছে...</td>
                                        </tr>
                                        <tr>
                                            <td>যোহর</td>
                                            <td id="dhuhr">লোড হচ্ছে...</td>
                                        </tr>
                                        <tr>
                                            <td>আসর</td>
                                            <td id="asr">লোড হচ্ছে...</td>
                                        </tr>
                                        <tr>
                                            <td>মাগরিব</td>
                                            <td id="maghrib">লোড হচ্ছে...</td>
                                        </tr>
                                        <tr>
                                            <td>ইশা</td>
                                            <td id="isha">লোড হচ্ছে...</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- fisrt Section 9 News with widget  End --}}

        {{-- Special Report Section News with video slide  Start --}}
        <div class="main--content pd--30-0">
            <div class="post--items-title" data-ajax="tab">
                <h2 class="h4">
                    @if (session()->get('lang') == 'bangla')
                        বিশেষ খবর
                    @else
                        Special Report
                    @endif
                </h2>
            </div>

            {{-- Video Slider For Special News --}}
            <div id="image-slider" class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($sn as $row)
                            <li style="cursor: pointer" class="splide__slide">
                                <div style="padding: 0 15px">
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
                                            class="video-wrapper">
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
                                    @endif

                                    <div>
                                        <a data-fancybox data-type="iframe" href="{{ $iframeSrc }}"
                                            class="card-link title-black text-center"
                                            style="color: black; font-size: 18px;">{{ \Illuminate\Support\Str::limit($row->title, 38) }}</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>

        {{-- Special Report Section News with video slide End --}}


        {{-- National Section News  Start --}}
        <div class="row">
            <div class="main--content" data-sticky-content="true">
                <div class="sticky-content-inner">
                    <div class="row">

                        {{-- Section Title --}}
                        <div class="post--items-title" data-ajax="tab">
                            <h2 class="h4">
                                @if (session()->get('lang') == 'bangla')
                                    {{ $nnbt->newsCategory->category_bn }}
                                @else
                                    {{ $nnbt->newsCategory->category_en }}
                                @endif
                            </h2>
                        </div>

                        {{-- Main Content --}}
                        <div class="main--content pd--30-0">
                            <div class="post--items post--items-4" data-ajax-content="outer">

                                {{-- Left Column (col-md-3) --}}
                                <div class="col-md-3">
                                    <ul class="nav flex-column">
                                        @foreach ($nnln as $index => $row)
                                            <li style="{{ $index !== 0 ? 'margin-top: 20px;' : '' }}">
                                                <div class="post--item">
                                                    <div class="post--img">
                                                        <a href="news-single-v1.html" class="thumb">
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
                                                                    <a href="news-single-v1.html" class="btn-link">
                                                                        @if (session()->get('lang') == 'bangla')
                                                                            {{ $row->title_bn }}
                                                                        @else
                                                                            {{ $row->title_en }}
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
                                        <a href="news-single-v1.html" class="thumb">
                                            @php
                                                $isPlaceholder = Str::contains($nnbt->thumbnail, 'via.placeholder.com');
                                                $imageToShow =
                                                    !$isPlaceholder && !empty($nnbt->thumbnail)
                                                        ? $nnbt->thumbnail
                                                        : asset('uploads/default_images/deafult_thumbnail.jpg');
                                            @endphp

                                            <img src="{{ $imageToShow }}" alt="{{ $nnbt->title_en }}"
                                                class="img-fluid">
                                        </a>

                                        <div class="post--info">
                                            <div class="title">
                                                <h2 class="h4" style="font-size: 24px">
                                                    <a href="news-single-v1.html" class="btn-link">
                                                        @if (session()->get('lang') == 'bangla')
                                                            {{ $nnbt->title_bn }}
                                                        @else
                                                            {{ $nnbt->title_en }}
                                                        @endif
                                                    </a>
                                                </h2>
                                                <p style="font-size: 16px; margin-top: -5px">
                                                    @if (session()->get('lang') == 'bangla')
                                                        {!! Str::limit($nnbt->details_bn, 200, '...') !!}
                                                    @else
                                                        {!! Str::limit($nnbt->details_en, 200, '...') !!}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="divider hidden-md hidden-lg">
                                </div>

                                {{-- Right Column (col-md-2) --}}
                                <div class="col-md-3">
                                    <ul class="nav ">
                                        @foreach ($nnrn as $index => $row)
                                            {{-- Replace this with real loop if needed --}}
                                            <li style="{{ $index !== 0 ? 'margin-top: 15px;' : '' }}">
                                                <div class="post--item post--layout-3">
                                                    <div class="post--img">
                                                        <a href="news-single-v1.html" class="thumb">
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
                                                                    <a href="news-single-v1.html" class="btn-link">
                                                                        @if (session()->get('lang') == 'bangla')
                                                                            {{ $row->title_bn }}
                                                                        @else
                                                                            {{ $row->title_en }}
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
                </div>
            </div>

        </div>
        {{-- National Section News End --}}

        <hr>

        {{-- Entertainment Section News Start  --}}
        <div class="row">
            <div class="main--content" data-sticky-content="true">
                <div class="sticky-content-inner">
                    <div class="row">

                        {{-- Section Title --}}
                        <div class="post--items-title" data-ajax="tab">
                            <h2 class="h4">
                                @if (session()->get('lang') == 'bangla')
                                    {{ $enbt->newsCategory->category_bn }}
                                @else
                                    {{ $enbt->newsCategory->category_en }}
                                @endif
                            </h2>
                        </div>

                        {{-- Main Content --}}
                        <div class="main--content pd--30-0">
                            <div class="post--items post--items-4" data-ajax-content="outer">
                                {{-- Middle Column (col-md-7) --}}
                                <div class="col-md-6">
                                    <div class="post--img">
                                        <a href="news-single-v1.html" class="thumb">
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
                                                    <a href="news-single-v1.html" class="btn-link">
                                                        @if (session()->get('lang') == 'bangla')
                                                            {{ $enbt->title_bn }}
                                                        @else
                                                            {{ $enbt->title_en }}
                                                        @endif
                                                    </a>
                                                </h2>
                                                <p style="font-size: 16px; margin-top: -5px">
                                                    @if (session()->get('lang') == 'bangla')
                                                        {!! Str::limit($enbt->details_bn, 200, '...') !!}
                                                    @else
                                                        {!! Str::limit($enbt->details_en, 200, '...') !!}
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
                                                            <a href="#" class="btn-link">
                                                                @if (session()->get('lang') == 'bangla')
                                                                    {{ $row->title_bn }}
                                                                @else
                                                                    {{ $row->title_en }}
                                                                @endif
                                                            </a>
                                                        </h2>
                                                        <p style="font-size: 14px; margin: 0;">
                                                            <a href="#" class="btn-link">
                                                                @if (session()->get('lang') == 'bangla')
                                                                    {!! Str::limit($row->details_bn, 200, '...') !!}
                                                                @else
                                                                    {!! Str::limit($row->details_en, 200, '...') !!}
                                                                @endif
                                                            </a>
                                                        </p>
                                                    </div>

                                                    <!-- Image on the Right -->
                                                    <div style="flex-shrink: 0;">
                                                        <a href="news-single-v1.html" class="thumb">
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
                <h2 class="h4">
                    @if (session()->get('lang') == 'bangla')
                        {{ $cnbt->newsCategory->category_bn }}
                    @else
                        {{ $cnbt->newsCategory->category_en }}
                    @endif
                </h2>
            </div>

            <div class="d-flex justify-content-between" style="margin-bottom: 40px">
                <div class="col-md-3">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-md-3 w-100">
                    <button class="btn btn-primary">Search <i class="fa fa-search" style="margin-left: 20px"
                            aria-hidden="true"></i></button>
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
                                                <a href="news-single-v1.html" class="thumb">
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
                                                            <a href="news-single-v1.html" class="btn-link">
                                                                @if (session()->get('lang') == 'bangla')
                                                                    {{ $row->title_bn }}
                                                                @else
                                                                    {{ $row->title_en }}
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
                                                <a href="news-single-v1.html" class="thumb">
                                                    <a href="news-single-v1.html" class="thumb">
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
                                                            <a href="news-single-v1.html" class="btn-link">
                                                                @if (session()->get('lang') == 'bangla')
                                                                    {{ $row->title_bn }}
                                                                @else
                                                                    {{ $row->title_en }}
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
                                    {{-- <a href="news-single-v1.html" class="thumb"><img src="{{ asset('uploads/news_photos/'. $fsbt->news_photo) }}"alt="{{ $fsbt->title }}" /></a> --}}
                                    <a href="news-single-v1.html" class="thumb">
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
                                                <a href="news-single-v1.html" class="btn-link">
                                                    @if (session()->get('lang') == 'bangla')
                                                        <h2>{{ $cnbt->title_bn }}</h2>
                                                    @else
                                                        <h2>{{ $cnbt->title_en }}</h2>
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
                <h2 class="h4">
                    @if (session()->get('lang') == 'bangla')
                        {{ $innbt->newsCategory->category_bn }}
                    @else
                        {{ $innbt->newsCategory->category_en }}
                    @endif
                </h2>
            </div>

            <div class="main--content">
                <div class="post--items post--items-1 pd--30-0">
                    <div class="row gutter--15">
                        {{-- This Section will Show Main news --}}
                        <div class="col-md-6">
                            <div>
                                <div class="post--img">
                                    {{-- <a href="news-single-v1.html" class="thumb"><img src="{{ asset('uploads/news_photos/'. $fsbt->news_photo) }}"alt="{{ $fsbt->title }}" /></a> --}}
                                    <a href="news-single-v1.html" class="thumb">
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
                                                <a href="news-single-v1.html" class="btn-link">
                                                    @if (session()->get('lang') == 'bangla')
                                                        <h2>{{ $innbt->title_bn }}</h2>
                                                    @else
                                                        <h2>{{ $innbt->title_en }}</h2>
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
                                            <div class="post--img" style="{{ $index !== 0 ? 'margin-top: 15px;' : '' }}">
                                                <a href="news-single-v1.html" class="thumb">
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
                                                            <a href="news-single-v1.html" class="btn-link">
                                                                @if (session()->get('lang') == 'bangla')
                                                                    {{ $row->title_bn }}
                                                                @else
                                                                    {{ $row->title_en }}
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
                                                            <a href="#" class="btn-link">
                                                                @if (session()->get('lang') == 'bangla')
                                                                    {{ $row->title_bn }}
                                                                @else
                                                                    {{ $row->title_en }}
                                                                @endif
                                                            </a>
                                                        </h2>
                                                    </div>

                                                    <!-- Image on the Right -->
                                                    <div style="flex-shrink: 0;">
                                                        <a href="news-single-v1.html" class="thumb">
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
                            <h2 class="h4">
                                @if (session()->get('lang') == 'bangla')
                                    {{ $snbt->newsCategory->category_bn }}
                                @else
                                    {{ $snbt->newsCategory->category_en }}
                                @endif
                            </h2>
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
                                                        <a href="news-single-v1.html" class="thumb">
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
                                                                    <a href="news-single-v1.html" class="btn-link">
                                                                        @if (session()->get('lang') == 'bangla')
                                                                            {{ $row->title_bn }}
                                                                        @else
                                                                            {{ $row->title_en }}
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
                                        <a href="news-single-v1.html" class="thumb">
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
                                                    <a href="news-single-v1.html" class="btn-link">
                                                        @if (session()->get('lang') == 'bangla')
                                                            {{ $snbt->title_bn }}
                                                        @else
                                                            {{ $snbt->title_en }}
                                                        @endif
                                                    </a>
                                                </h2>
                                                <p style="font-size: 16px; margin-top: -5px">
                                                    @if (session()->get('lang') == 'bangla')
                                                        {!! Str::limit($snbt->details_bn, 200, '...') !!}
                                                    @else
                                                        {!! Str::limit($snbt->details_en, 200, '...') !!}
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
                                                @if (session()->get('lang') == 'bangla')
                                                    {{ $row->title_bn }}
                                                @else
                                                    {{ $row->title_en }}
                                                @endif
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="news-single-v1.html" class="thumb">
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

                        {{-- Section Title --}}
                        <div class="post--items-title" data-ajax="tab">
                            <h2 class="h4">
                                @if (session()->get('lang') == 'bangla')
                                    {{ $lsnbt->newsCategory->category_bn }}
                                @else
                                    {{ $lsnbt->newsCategory->category_en }}
                                @endif
                            </h2>
                        </div>

                        {{-- Main Content --}}
                        <div class="main--content col-md-8 col-sm-7">
                            <div class="post--items post--items-4" data-ajax-content="outer">

                                {{-- Left Column (col-md-3) --}}
                                <div class="col-md-6" style="margin: 0 !important; padding: 0 !important">
                                    <div class="post--img">
                                        <a href="news-single-v1.html" class="thumb">
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
                                                    <a href="news-single-v1.html" class="btn-link">
                                                        @if (session()->get('lang') == 'bangla')
                                                            {{ $lsnbt->title_bn }}
                                                        @else
                                                            {{ $lsnbt->title_en }}
                                                        @endif
                                                    </a>
                                                </h2>
                                                <p style="font-size: 16px; margin-top: -5px">
                                                    @if (session()->get('lang') == 'bangla')
                                                        {!! Str::limit($lsnbt->details_bn, 150, '...') !!}
                                                    @else
                                                        {!! Str::limit($lsnbt->details_en, 150, '...') !!}
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
                                                @if (session()->get('lang') == 'bangla')
                                                    {{ $row->title_bn }}
                                                @else
                                                    {{ $row->title_en }}
                                                @endif
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="news-single-v1.html" class="thumb">
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
                                    </div>
                                </div>

                                {{-- Middle Column (col-md-7) --}}
                                <div class="col-md-6">
                                    <div>
                                        @foreach ($sn4 as $index => $row)
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
                                                    <a href="news-single-v1.html" class="thumb">
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
                        </div>
                        <div class="main--sidebar col-md-4 col-sm-5 ptop--30 pbottom--30"">
                            <div class="sticky-content-inner">
                                <div class="widget">
                                    <div class="widget--title" data-ajax="tab">
                                        <h2 class="h4">
                                            @if (session()->get('lang') == 'bangla')
                                                অনলাইন জরিপ
                                            @else
                                                Voting Poll
                                            @endif
                                        </h2>
                                        <div class="nav"> <a href="#" class="prev btn-link"
                                                data-ajax-action="load_prev_poll_widget"> <i
                                                    class="fa fa-long-arrow-left"></i> </a> <span class="divider">/</span>
                                            <a href="#" class="next btn-link"
                                                data-ajax-action="load_next_poll_widget"> <i
                                                    class="fa fa-long-arrow-right"></i> </a>
                                        </div>
                                    </div>
                                    <div class="poll--widget" data-ajax-content="outer">
                                        <ul class="nav" data-ajax-content="inner">
                                            <li class="title">
                                                <h3 class="h4">Do you think the cost of sending money to mobile phone
                                                    should be reduced?</h3>
                                            </li>
                                            <li class="options">
                                                <form action="#">
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
                                                        @if (session()->get('lang') == 'bangla')
                                                            ভোট দিন
                                                        @else
                                                            Vote Now
                                                        @endif
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                        <div class="preloader bg--color-0--b" data-preloader="1">
                                            <div class="preloader--inner"></div>
                                        </div>
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
                            <h2 class="h4">
                                @if (session()->get('lang') == 'bangla')
                                    {{ $lonbt->newsCategory->category_bn }}
                                @else
                                    {{ $lonbt->newsCategory->category_en }}
                                @endif
                            </h2>
                        </div>

                        {{-- Main Content --}}
                        <div class="main--content col-md-8 col-sm-7">
                            <div class="post--items post--items-4" data-ajax-content="outer">
                                <div class="row">
                                    {{-- Left Column (col-md-3) --}}
                                    <div class="col-md-6" style="margin: 0 !important; padding: 0 !important">
                                        <div class="post--img">
                                            <a href="news-single-v1.html" class="thumb">
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
                                                        <a href="news-single-v1.html" class="btn-link">
                                                            @if (session()->get('lang') == 'bangla')
                                                                {{ $lonbt->title_bn }}
                                                            @else
                                                                {{ $lonbt->title_en }}
                                                            @endif
                                                        </a>
                                                    </h2>
                                                    <p style="font-size: 16px; margin-top: -5px">
                                                        @if (session()->get('lang') == 'bangla')
                                                            {!! Str::limit($lonbt->details_bn, 150, '...') !!}
                                                        @else
                                                            {!! Str::limit($lonbt->details_en, 150, '...') !!}
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
                                                        @if (session()->get('lang') == 'bangla')
                                                            <h4>{{ $row->title_bn }}</h4>
                                                        @else
                                                            <h4>{{ $row->title_en }}</h4>
                                                        @endif
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <a href="news-single-v1.html" class="thumb">
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
                                                    @if (session()->get('lang') == 'bangla')
                                                        <h4>{{ $row->title_bn }}</h4>
                                                    @else
                                                        <h4>{{ $row->title_en }}</h4>
                                                    @endif
                                                </div>
                                                <div>
                                                    @if (session()->get('lang') == 'bangla')
                                                        {!! Str::limit($row->details_bn, 100, '...') !!}
                                                    @else
                                                        {!! Str::limit($row->details_en, 80, '...') !!}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <a href="news-single-v1.html" class="thumb">
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
                                            @if (session()->get('lang') == 'bangla')
                                                ট্যাগ সমূহ
                                            @else
                                                TAGS
                                            @endif
                                        </h2> <i class="icon fa fa-tags"></i>
                                    </div>
                                    <div class="tags--widget style--3">
                                        <ul class="nav">
                                            @foreach ($categoriesCount as $category)
                                                <li>
                                                    <a href="#">
                                                        @if (session()->get('lang') == 'bangla')
                                                            {{ $category->category_bn }}
                                                        @else
                                                            {{ $category->category_en }}
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
                                                @if (session()->get('lang') == 'bangla')
                                                    আর্কাইভ
                                                @else
                                                    Archive
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
                                        <h2 class="h4">
                                            @if (session()->get('lang') == 'bangla')
                                                ভিডিও গ্যালারী
                                            @else
                                                Video Gallery
                                            @endif
                                        </h2>
                                    </div>
                                    <div>
                                        @php
                                            preg_match('/src="([^"]+)"/', $vgnbt->embed_code, $matches);
                                            $iframeSrc = $matches[1] ?? null;
                                            $videoId = null;
                                            if ($iframeSrc && Str::contains($iframeSrc, 'youtube.com')) {
                                                preg_match('/embed\/([^\?&"]+)/', $iframeSrc, $idMatch);
                                                $videoId = $idMatch[1] ?? null;
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
                                                        <a href="news-single-v1.html" class="btn-link">
                                                            {{ session('lang') == 'bangla' ? $vgnbt->title_bn : $vgnbt->title_en }}
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
                                                            @if (session()->get('lang') == 'bangla')
                                                                {{ \Illuminate\Support\Str::limit($row->title_bn, 38) }}
                                                            @else
                                                                {{ \Illuminate\Support\Str::limit($row->title_en, 38) }}
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
                                        <h2 class="h4">
                                            @if (session()->get('lang') == 'bangla')
                                                ফটো গ্যালারী
                                            @else
                                                Photo Gallery
                                            @endif
                                        </h2>
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
                                                        {{ session('lang') == 'bangla' ? $pgnbt->title_bn : $pgnbt->title_en }}
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
                                                            {{ session('lang') == 'bangla' ? $row->title_bn : $row->title_en }}
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
                                <h2 class="h4">
                                    @if (session()->get('lang') == 'bangla')
                                        {{ $pnbt->newsCategory->category_bn }}
                                    @else
                                        {{ $pnbt->newsCategory->category_en }}
                                    @endif
                                </h2>
                            </div>
                            <div class="post--items post--items-4" data-ajax-content="outer">

                                {{-- Left Column (col-md-3) --}}
                                <div class="col-md-6" style="margin: 0 !important; padding: 0 !important">
                                    <div class="post--img">
                                        <a href="news-single-v1.html" class="thumb">
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
                                                    <a href="news-single-v1.html" class="btn-link">
                                                        @if (session()->get('lang') == 'bangla')
                                                            {{ $pnbt->title_bn }}
                                                        @else
                                                            {{ $pnbt->title_en }}
                                                        @endif
                                                    </a>
                                                </h2>
                                                <p style="font-size: 16px; margin-top: -5px">
                                                    @if (session()->get('lang') == 'bangla')
                                                        {!! Str::limit($pnbt->details_bn, 150, '...') !!}
                                                    @else
                                                        {!! Str::limit($pnbt->details_en, 150, '...') !!}
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
                                                    @if (session()->get('lang') == 'bangla')
                                                        {{ $row->title_bn }}
                                                    @else
                                                        {{ $row->title_en }}
                                                    @endif
                                                </div>
                                                <div class="col-sm-6">
                                                    <h3>
                                                        <a href="news-single-v1.html" class="thumb">
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
                                <h2 class="h4">
                                    @if (session()->get('lang') == 'bangla')
                                        {{ $fnbt->newsCategory->category_bn }}
                                    @else
                                        {{ $fnbt->newsCategory->category_en }}
                                    @endif
                                </h2>
                            </div>
                            <div class="post--items post--items-4" data-ajax-content="outer">

                                {{-- Left Column (col-md-3) --}}
                                <div class="col-md-6" style="margin: 0 !important; padding: 0 !important">
                                    <div class="post--img">
                                        <a href="news-single-v1.html" class="thumb">
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
                                                    <a href="news-single-v1.html" class="btn-link">
                                                        @if (session()->get('lang') == 'bangla')
                                                            {{ $fnbt->title_bn }}
                                                        @else
                                                            {{ $fnbt->title_en }}
                                                        @endif
                                                    </a>
                                                </h2>
                                                <p style="font-size: 16px; margin-top: -5px">
                                                    @if (session()->get('lang') == 'bangla')
                                                        {!! Str::limit($fnbt->details_bn, 150, '...') !!}
                                                    @else
                                                        {!! Str::limit($fnbt->details_en, 150, '...') !!}
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
                                                        <a href="news-single-v1.html" class="thumb">
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
        <div class="row" style="margin-top: 30px">
            <div class="main--content" data-sticky-content="true">
                <div class="sticky-content-inner">
                    <div class="row">
                        {{-- Job Section Content --}}
                        <div class="main--content col-md-3 col-sm-7">
                            {{-- Politic Title --}}
                            <div class="post--items-title" data-ajax="tab">
                                <h2 class="h4">
                                    @if (session()->get('lang') == 'bangla')
                                        {{ $pnbt->newsCategory->category_bn }}
                                    @else
                                        {{ $pnbt->newsCategory->category_en }}
                                    @endif
                                </h2>
                            </div>
                            <div class="post--items post--items-4" data-ajax-content="outer">

                                {{-- Left Column (col-md-3) --}}
                                <div class="col-md-12" style="margin: 0 !important; padding: 0 !important">
                                    <div class="post--img">
                                        <a href="news-single-v1.html" class="thumb">
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
                                                        @if (session()->get('lang') == 'bangla')
                                                            {{ $pnbt->title_bn }}
                                                        @else
                                                            {{ $pnbt->title_en }}
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
                                                        @if (session()->get('lang') == 'bangla')
                                                            {{ $pnbt->title_bn }}
                                                        @else
                                                            {{ $pnbt->title_en }}
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
                                <h2 class="h4">
                                    @if (session()->get('lang') == 'bangla')
                                        {{ $pnbt->newsCategory->category_bn }}
                                    @else
                                        {{ $pnbt->newsCategory->category_en }}
                                    @endif
                                </h2>
                            </div>
                            <div class="post--items post--items-4" data-ajax-content="outer">

                                {{-- Left Column (col-md-3) --}}
                                <div class="col-md-12" style="margin: 0 !important; padding: 0 !important">
                                    <div class="post--img">
                                        <a href="news-single-v1.html" class="thumb">
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
                                                        @if (session()->get('lang') == 'bangla')
                                                            {{ $pnbt->title_bn }}
                                                        @else
                                                            {{ $pnbt->title_en }}
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
                                                        @if (session()->get('lang') == 'bangla')
                                                            {{ $pnbt->title_bn }}
                                                        @else
                                                            {{ $pnbt->title_en }}
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
                                <h2 class="h4">
                                    @if (session()->get('lang') == 'bangla')
                                        {{ $pnbt->newsCategory->category_bn }}
                                    @else
                                        {{ $pnbt->newsCategory->category_en }}
                                    @endif
                                </h2>
                            </div>
                            <div class="post--items post--items-4" data-ajax-content="outer">

                                {{-- Left Column (col-md-3) --}}
                                <div class="col-md-12" style="margin: 0 !important; padding: 0 !important">
                                    <div class="post--img">
                                        <a href="news-single-v1.html" class="thumb">
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
                                                        @if (session()->get('lang') == 'bangla')
                                                            {{ $pnbt->title_bn }}
                                                        @else
                                                            {{ $pnbt->title_en }}
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
                                                        @if (session()->get('lang') == 'bangla')
                                                            {{ $pnbt->title_bn }}
                                                        @else
                                                            {{ $pnbt->title_en }}
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
                                <h2 class="h4">
                                    @if (session()->get('lang') == 'bangla')
                                        {{ $pnbt->newsCategory->category_bn }}
                                    @else
                                        {{ $pnbt->newsCategory->category_en }}
                                    @endif
                                </h2>
                            </div>
                            <div class="post--items post--items-4" data-ajax-content="outer">

                                {{-- Left Column (col-md-3) --}}
                                <div class="col-md-12" style="margin: 0 !important; padding: 0 !important">
                                    <div class="post--img">
                                        <a href="news-single-v1.html" class="thumb">
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
                                                        @if (session()->get('lang') == 'bangla')
                                                            {{ $pnbt->title_bn }}
                                                        @else
                                                            {{ $pnbt->title_en }}
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
                                                        @if (session()->get('lang') == 'bangla')
                                                            {{ $pnbt->title_bn }}
                                                        @else
                                                            {{ $pnbt->title_en }}
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

            <div class="main--content col-md-12 col-sm-7" style="margin-top: 35px; border-top: 1px solid black;">
        <div class="container">
            <div class="row">
                <div padding: 5px 5px;">
                    <ul style="display: flex; justify-content: center;">
                        @foreach ([1, 2, 3, 4, 5, 6] as $row)
                            <li>hi</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    {{-- Salat Time will Update Dynamically with api --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch("https://api.aladhan.com/v1/timingsByCity?city=Dhaka&country=Bangladesh&method=2")
                .then(res => res.json())
                .then(data => {
                    const t = data.data.timings;
                    document.getElementById("fajr").textContent = t.Fajr;
                    document.getElementById("dhuhr").textContent = t.Dhuhr;
                    document.getElementById("asr").textContent = t.Asr;
                    document.getElementById("maghrib").textContent = t.Maghrib;
                    document.getElementById("isha").textContent = t.Isha;
                })
                .catch(() => {
                    const fields = ["fajr", "dhuhr", "asr", "maghrib", "isha"];
                    fields.forEach(id => {
                        document.getElementById(id).textContent = "ত্রুটি!";
                    });
                });
        });
    </script>

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




@endsection
