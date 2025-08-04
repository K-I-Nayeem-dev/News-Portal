@extends('layouts.newsIndex.newsMaster')

@section('content')

    <style>
        @media (max-width: 768px) {
            .splide__arrow {
                display: none !important;
            }
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


        .video-wrapper img {
            width: 100%;
            height: auto;
            display: block;
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
    </style>
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

    <div class="container">
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

        <hr>

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Splide('#image-slider', {
                type: 'loop',
                perPage: 4,
                perMove: 1,
                autoplay: false,
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


@endsection
