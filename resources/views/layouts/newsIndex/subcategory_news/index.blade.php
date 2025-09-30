@extends('layouts.newsIndex.newsMaster')

@section('content')
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Container */
        .news-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Loading Styles */
        .loading-indicator {
            display: none;
            text-align: center;
            padding: 20px;
        }

        .loading-indicator p {
            font-weight: bold;
            font-size: 18px;
            color: #555;
            margin: 0 0 10px 0;
        }

        .spinner {
            margin: 0 auto;
            width: 30px;
            height: 30px;
            border: 4px solid #ddd;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Header Section */
        .category-header {
            border-bottom: 2px solid #DA0000;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .category-title {
            font-size: 15px;
            font-weight: bold;
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .category-title a {
            text-decoration: none;
            color: #333;
            transition: color 0.3s;
        }

        .category-title a:hover {
            color: #DA0000;
        }

        .category-title span {
            margin: 0 5px;
            color: #666;
        }

        /* First Row: Main News + 2 Middle News + Ad */
        .first-row {
            display: grid;
            grid-template-columns: 6fr 3fr 3fr;
            gap: 20px;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .main-news-section {
            width: 100%;
        }

        .middle-news-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .sidebar-ad-section {
            width: 100%;
        }

        .sidebar-ad-inner {
            position: sticky;
            top: 20px;
            will-change: transform;
            width: 100%;
        }

        /* Post Styles */
        .post--img {
            position: relative;
            overflow: hidden;
            background: #fff;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            transition: box-shadow 0.3s;
        }

        .post--img:hover {
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.12);
        }

        .post--img .thumb {
            display: block;
            text-decoration: none;
            overflow: hidden;
            border-radius: 4px 4px 0 0;
        }

        .post--img img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .post--img .thumb:hover img {
            transform: scale(1.05);
        }

        .main-news-section .post--img img {
            height: 400px;
            object-fit: cover;
        }

        .middle-news-section .post--img img {
            height: 190px;
            object-fit: cover;
        }

        .second-row .post--img img {
            height: 180px;
            object-fit: cover;
        }

        .posts-container .post--img img {
            height: 180px;
            object-fit: cover;
        }

        .post--info {
            padding: 12px 15px;
            background: #fff;
            border-radius: 0 0 4px 4px;
        }

        .post--info .title {
            margin: 0;
        }

        .post--info .title h2 {
            font-size: 15px;
            font-weight: 600;
            line-height: 1.5;
            margin: 0 0 8px 0;
            color: #222;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .main-news-section .post--info {
            padding: 18px 20px;
        }

        .main-news-section .post--info .title h2 {
            font-size: 26px;
            font-weight: 700;
            -webkit-line-clamp: 3;
            line-height: 1.4;
        }

        .middle-news-section .post--info .title h2 {
            font-size: 14px;
            -webkit-line-clamp: 2;
        }

        .post--info .title a {
            text-decoration: none;
            color: #222;
            transition: color 0.3s;
        }

        .post--info .title a:hover {
            color: #DA0000;
        }

        .post--info .title p {
            font-size: 13px;
            line-height: 1.6;
            color: #666;
            margin: 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .post--info .title p a {
            color: #666;
        }

        .post--info .title p a:hover {
            color: #DA0000;
        }

        /* Second Row: 4 News Grid */
        .second-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .second-row .post--info .title h2 {
            font-size: 15px;
            -webkit-line-clamp: 2;
        }

        /* Dynamic Posts Container - 4 columns */
        .posts-container-wrapper {
            margin-top: 30px;
        }

        .posts-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        /* Ad Widget */
        .sidebar-ad-section .widget {
            background: none !important;
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
        }

        .sidebar-ad-section .ad--widget {
            width: 100% !important;
            overflow: hidden;
            border-radius: 0;
            box-shadow: none;
            background: none !important;
            border: none !important;
            line-height: 0;
            padding: 0 !important;
            margin: 0 !important;
        }

        .sidebar-ad-section .ad--widget a {
            display: block;
            line-height: 0;
            width: 100%;
            padding: 0;
            margin: 0;
        }

        .ad--widget img {
            width: 100%;
            height: auto;
            display: block;
        }

        .sidebar-ad-section .ad--widget {
            height: 100%;
            display: flex;
            align-items: flex-start;
        }

        .sidebar-ad-section .ad--widget img {
            width: 100%;
            height: auto;
            max-height: 100%;
            object-fit: contain;
            display: block;
            margin: 0;
            padding: 0;
        }

        /* Tablet View (768px - 1024px) */
        @media (max-width: 1024px) {
            .first-row {
                grid-template-columns: 6fr 3fr 3fr;
                gap: 15px;
            }

            .second-row {
                grid-template-columns: repeat(3, 1fr);
                gap: 15px;
            }

            .posts-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .main-news-section .post--img img {
                height: 320px;
            }

            .middle-news-section .post--img img {
                height: 152px;
            }

            .sidebar-ad-section .ad--widget img {
                height: auto;
                max-height: none;
            }

            .main-news-section .post--info .title h2 {
                font-size: 22px;
            }

            .second-row .post--img img {
                height: 160px;
            }

            .posts-container .post--img img {
                height: 160px;
            }
        }

        /* Mobile View (max-width: 767px) */
        @media (max-width: 767px) {

            /* First Row: Stacked Layout */
            .first-row {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .main-news-section {
                order: 1;
            }

            .middle-news-section {
                order: 2;
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .sidebar-ad-section {
                order: 3;
            }

            .sidebar-ad-inner {
                position: static;
            }

            .main-news-section .post--img img {
                height: auto;
                object-fit: contain;
            }

            .middle-news-section .post--img img {
                height: auto;
                object-fit: contain;
            }

            .sidebar-ad-section .ad--widget img {
                height: auto;
            }

            /* Second Row: 2 columns */
            .second-row {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .second-row .post--img img {
                height: auto;
                object-fit: contain;
            }

            /* Dynamic Posts: 2 columns */
            .posts-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .posts-container .post--img img {
                height: auto;
                object-fit: contain;
            }

            .main-news-section .post--info .title h2 {
                font-size: 18px;
            }

            .post--info .title h2 {
                font-size: 14px;
            }

            .post--info .title p {
                font-size: 12px;
            }
        }

        /* Small Mobile View (max-width: 480px) */
        @media (max-width: 480px) {
            .middle-news-section {
                grid-template-columns: 1fr;
            }

            .middle-news-section .post--img img {
                height: auto;
                object-fit: contain;
            }

            .second-row {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .second-row .post--img img {
                height: auto;
                object-fit: contain;
            }

            .posts-container {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .posts-container .post--img img {
                height: auto;
                object-fit: contain;
            }

            .category-title {
                font-size: 14px;
                flex-wrap: wrap;
            }

            .main-news-section .post--info .title h2 {
                font-size: 17px;
            }

            .post--info .title h2 {
                font-size: 15px;
            }
        }
    </style>

    @php
        use Illuminate\Support\Str;

        $categorySlug = Str::slug($scnbt->newsCategory->category_en);
        $subcategorySlug = $scnbt->newsSubcategory ? Str::slug($scnbt->newsSubcategory->sub_cate_en) : null;
    @endphp

    <div class="news-container">
        <!-- Category Header -->
        <div class="category-header">
            <h2 class="category-title">
                <a href="{{ route('getCate.news', $category->slug) }}">
                    {{ session()->get('lang') == 'english' ? $category->category_en : $category->category_bn }}
                </a>
                <span>/</span>
                <span>{{ session()->get('lang') == 'english' ? $subCategory->sub_cate_en : $subCategory->sub_cate_bn }}</span>
            </h2>
        </div>

        <!-- First Row: 1 Main News + 2 Middle News + Ad -->
        <div class="first-row">
            <!-- Main News -->
            <div class="main-news-section">
                <div class="post--img">
                    <a href="{{ route('showFull.news', array_filter(['category' => $categorySlug, 'subcategory' => $subcategorySlug, 'id' => $scnbt->id])) }}"
                        class="thumb">
                        @php
                            $isPlaceholder = Str::contains($scnbt->thumbnail, 'via.placeholder.com');
                            $imageToShow =
                                !$isPlaceholder && !empty($scnbt->thumbnail)
                                    ? asset($scnbt->thumbnail)
                                    : asset('uploads/default_images/deafult_thumbnail.jpg');
                        @endphp
                        <img src="{{ $imageToShow }}" alt="{{ $scnbt->title_en }}">
                    </a>
                    <div class="post--info">
                        <div class="title">
                            <h2>
                                <a
                                    href="{{ route('showFull.news', array_filter(['category' => $categorySlug, 'subcategory' => $subcategorySlug, 'id' => $scnbt->id])) }}">
                                    {{ session()->get('lang') == 'english' ? $scnbt->title_en : $scnbt->title_bn }}
                                </a>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2 Middle News -->
            <div class="middle-news-section">
                @foreach ($scn2 as $row)
                    <div class="post--img">
                        <a href="{{ route('showFull.news', array_filter(['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id])) }}"
                            class="thumb">
                            @php
                                $isPlaceholder = Str::contains($row->thumbnail, 'via.placeholder.com');
                                $imageToShow =
                                    !$isPlaceholder && !empty($row->thumbnail)
                                        ? asset($row->thumbnail)
                                        : asset('uploads/default_images/deafult_thumbnail.jpg');
                            @endphp
                            <img src="{{ $imageToShow }}" alt="{{ $row->title_en }}">
                        </a>
                        <div class="post--info">
                            <div class="title">
                                <h2>{{ session()->get('lang') == 'english' ? Str::limit($row->title_en, 30, '...') : Str::limit($row->title_bn, 30, '...') }}
                                </h2>
                                <p>
                                    <a
                                        href="{{ route('showFull.news', array_filter(['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id])) }}">
                                        {!! session()->get('lang') == 'english'
                                            ? Str::limit($row->details_en, 80, '...')
                                            : Str::limit($row->details_bn, 80, '...') !!}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Sidebar Ad (Sticky) -->
            <aside class="sidebar-ad-section">
                <div class="sidebar-ad-inner">
                    <div class="widget">
                        <a href="{{ route('ads.trackClick', $scs1->id) }}" target="_blank">
                            <div class="ad--widget">
                                <img src="{{ $scs1 && file_exists(public_path($scs1->image)) ? asset($scs1->image) : asset('frontend_assets/img/ads-img/ad-300x250-1.jpg') }}"
                                    alt="{{ $scs1->title_en ?? 'Advertisement' }}" />
                            </div>
                        </a>
                    </div>
                    <div class="widget" style="margin-top: 20px !important">
                        <a href="{{ route('ads.trackClick', $scs2->id) }}" target="_blank">
                            <div class="ad--widget">
                                <img src="{{ $scs2 && file_exists(public_path($scs2->image)) ? asset($scs2->image) : asset('frontend_assets/img/ads-img/ad-300x250-1.jpg') }}"
                                    alt="{{ $scs2->title_en ?? 'Advertisement' }}" />
                            </div>
                        </a>
                    </div>
                </div>
            </aside>
        </div>

        <!-- Second Row: 4 News in Grid -->
        <div class="second-row">
            @foreach ($scn4 as $row)
                <div class="post--img">
                    <a href="{{ route('showFull.news', array_filter(['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id])) }}"
                        class="thumb">
                        @php
                            $isPlaceholder = Str::contains($row->thumbnail, 'via.placeholder.com');
                            $imageToShow =
                                !$isPlaceholder && !empty($row->thumbnail)
                                    ? asset($row->thumbnail)
                                    : asset('uploads/default_images/deafult_thumbnail.jpg');
                        @endphp
                        <img src="{{ $imageToShow }}" alt="{{ $row->title_en }}">
                    </a>
                    <div class="post--info">
                        <div class="title">
                            <h2>
                                <a
                                    href="{{ route('showFull.news', array_filter(['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id])) }}">{{ session()->get('lang') == 'english' ? $row->title_en : $row->title_bn }}</a>
                            </h2>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Dynamic Posts Container with Loading -->
        <div class="posts-container-wrapper">
            <div class="posts-container" id="posts-container">
                @include('layouts.newsIndex.subcategory_news.load')
            </div>
        </div>

        <!-- Loading Indicator -->
        <div id="loading" class="loading-indicator">
            <p>Loading...</p>
            <div class="spinner"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let nextPageUrl = '{{ $ascn->nextPageUrl() }}';
            let isLoading = false;

            $(window).on('scroll', function() {
                if (isLoading || !nextPageUrl) return;

                const scrollPosition = $(window).scrollTop() + $(window).height();
                const documentHeight = $(document).height();

                if (scrollPosition >= documentHeight - 200) {
                    loadMorePosts();
                }
            });

            function loadMorePosts() {
                if (isLoading || !nextPageUrl) return;

                isLoading = true;

                $.ajax({
                    url: nextPageUrl,
                    type: 'get',
                    beforeSend: function() {
                        $('#loading').show();
                    },
                    success: function(data) {
                        nextPageUrl = data.nextPageUrl;
                        $('#posts-container').append(data.view);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error loading more posts:", error);
                    },
                    complete: function() {
                        $('#loading').hide();
                        isLoading = false;
                    }
                });
            }
        });
    </script>
@endsection
