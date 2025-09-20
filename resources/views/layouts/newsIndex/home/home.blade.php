@extends('layouts.newsIndex.newsMaster')

@section('content')
    {{-- @php
    $variables = ['fsbt', 'fs1', 'fs2', 'fs9', 'tn', 'sn', 'nnbt', 'nnln', 'nnrn', 'enbt', 'enrn', 'cnbt', 'cn1', 'cn2', 'innbt', 'inn2', 'inn4', 'snbt', 'sn2', 'sn4', 'lsnbt', 'lsnb', 'lsnr', 'lonbt', 'lonrn3', 'lon4', 'vgnbt', 'vgn3', 'pgnbt', 'pgn3', 'pnbt', 'pn3', 'fnbt', 'fn3'];

    $slugs = [];

    foreach ($variables as $var) {
        if (isset($$var)) { // $$var accesses variable by name
            $slugs[$var] = generateSlugs($$var);
        } else {
            $slugs[$var] = ['categorySlug' => null, 'subcategorySlug' => null];
        }
    }
@endphp --}}

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
        {{-- Main Headline or fisrt News Section & Frist Section 2 News Start --}}
        <div class="main--content">
            <div class="post--items post--items-1 pd--30-0">
                <div class="row gutter--15">
                    <div class="col-md-3">
                        <div class="row gutter--15">
                            {{-- First Section News --}}
                            @foreach ($fs1 as $index => $row)
                                <div class="col-md-12 col-xs-6 col-xxs-12">
                                    <div style="{{ $index != 0 ? 'margin-top:15px' : '' }}">
                                        <div class="post--img">
                                            <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                class="thumb"><img src="{{ $row->thumbnail }}"
                                                    alt="{{ $row->title }}" /></a>
                                            <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                class="cat">
                                                @if (session()->get('lang') == 'english')
                                                    {{ $row->newsCategory->category_en }}
                                                @else
                                                    {{ $row->newsCategory->category_bn }}
                                                @endif
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
                                <a href="{{ route('showFull.news', array_filter(['category' => $categorySlug, 'subcategory' => $subcategorySlug, 'id' => $fsbt->id])) }}"
                                    class="thumb"><img src="{{ $fsbt->thumbnail }}"alt="{{ $fsbt->title }}" /></a>
                                <a href="{{ route('showFull.news', ['category' => $fsbt->newsCategory->slug, 'subcategory' => $fsbt->newsSubcategory->slug, 'id' => $fsbt->id]) }}"
                                    class="cat">
                                    @if (session()->get('lang') == 'english')
                                        {{ $fsbt->newsCategory->category_en }}
                                    @else
                                        {{ $fsbt->newsCategory->category_bn }}
                                    @endif
                                </a>
                                <div class="post--info">
                                    <div class="title">
                                        <h2 class="h4">
                                            <a href="{{ route('showFull.news', ['category' => $fsbt->newsCategory->slug, 'subcategory' => $fsbt->newsSubcategory->slug, 'id' => $fsbt->id]) }}"
                                                class="btn-link">
                                                @if (session()->get('lang') == 'english')
                                                    <h2>{{ $fsbt->title_en }}</h2>
                                                @else
                                                    <h2>{{ $fsbt->title_bn }}</h2>
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
                            @foreach ($fs2 as $index => $row)
                                <div class="col-md-12 col-xs-6 col-xxs-12">
                                    <div style="{{ $index != 0 ? 'margin-top:15px' : '' }}">
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
                                                                : asset('uploads/default_images/deafult_thumbnail.jpg');
                                                    @endphp

                                                    <img src="{{ $imageToShow }}"
                                                        alt="{{ $row->title_en }}"class="img-fluid">

                                                </a>
                                            </a>
                                            <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                class="cat">
                                                @if (session()->get('lang') == 'english')
                                                    {{ $row->newsCategory->category_en }}
                                                @else
                                                    {{ $row->newsCategory->category_bn }}
                                                @endif
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
                </div>
            </div>
        </div>
        {{-- Main Headline or fisrt News Section & Frist Section 2 News End --}}


        {{-- fisrt Section 9 News with widget Start --}}
        <div class="row">
            <div class="main--content col-md-8 col-sm-7" data-sticky-content="true">
                <div class="sticky-content-inner">
                    <div class="row">
                        @foreach ($fs9 as $index => $row)
                            <div class="col-6 col-sm-6 col-md-4 mt-3" style="margin-top: 20px">
                                <div>
                                    <div class="post--img">
                                        <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                            class="thumb">
                                            @php
                                                $isPlaceholder = Str::contains($row->thumbnail, 'via.placeholder.com');
                                                $imageToShow =
                                                    !$isPlaceholder && !empty($row->thumbnail)
                                                        ? $row->thumbnail
                                                        : asset('uploads/default_images/deafult_thumbnail.jpg');
                                            @endphp

                                            <img src="{{ $imageToShow }}" alt="{{ $row->title_en }}" class="img-fluid">

                                        </a>
                                        <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                            class="cat">
                                            @if (session()->get('lang') == 'english')
                                                {{ $row->newsCategory->category_en }}
                                            @else
                                                {{ $row->newsCategory->category_bn }}
                                            @endif
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

                        <div class="col-md-12 ptop--30 pbottom--30">
                            <div class="ad--space">
                                <a
                                    href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}">
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
                                @if (session()->get('lang') == 'english')
                                    Featured News
                                @else
                                    আলোচিত খবর
                                @endif
                            </h2>
                            <i class="icon fa fa-newspaper-o"></i>
                        </div>
                        <div class="list--widget list--widget-1">
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
                                                                    <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}">
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
                            <div style="display: flex; justify-content: space-between">
                                <h2 class="h4">
                                    @if (session()->get('lang') == 'english')
                                        {{ $nnbt->newsCategory->category_en }}
                                    @else
                                        {{ $nnbt->newsCategory->category_bn }}
                                    @endif
                                </h2>
                                <a href="{{ route('getCate.news', $nnbt->newsCategory->slug) }}"
                                    style="font-size: 15px; font-weight: bold">{{ session()->get('lang') == 'english' ? 'More' : 'আরও' }}</a>
                            </div>
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
                                                    <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                        class="btn-link">
                                                        @if (session()->get('lang') == 'english')
                                                            {{ $nnbt->title_en }}
                                                        @else
                                                            {{ $nnbt->title_bn }}
                                                        @endif
                                                    </a>
                                                </h2>
                                                <p style="font-size: 16px; margin-top: -5px">
                                                    @if (session()->get('lang') == 'english')
                                                        {!! Str::limit($nnbt->details_en, 200, '...') !!}
                                                    @else
                                                        {!! Str::limit($nnbt->details_bn, 200, '...') !!}
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
                            <option value="{{ $division->id }}">{{ session()->get('lang') == 'english' ? $division->division_en : $division->division_bn }}</option>
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

                        {{-- Main Content --}}
                        <div class="main--content col-md-8 col-sm-7">
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
                                            @if (session()->get('lang') == 'english')
                                                Voting Poll
                                            @else
                                                অনলাইন জরিপ
                                            @endif
                                        </h2>
                                        <div class="nav"> <a
                                                href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                class="prev btn-link" data-ajax-action="load_prev_poll_widget"> <i
                                                    class="fa fa-long-arrow-left"></i> </a> <span class="divider">/</span>
                                            <a href="{{ route('showFull.news', ['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id]) }}"
                                                class="next btn-link" data-ajax-action="load_next_poll_widget"> <i
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
