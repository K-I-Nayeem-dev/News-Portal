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
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .subcategory-list {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            margin-bottom: 5px;
            list-style: none;
            gap: 15px;
        }

        .subcategory-item {
            font-size: 14px;
        }

        .subcategory-item p {
            margin: 0;
        }

        .subcategory-item span {
            margin-right: 4px;
            color: #007acc;
            font-size: 15px;
        }

        .subcategory-item a {
            text-decoration: none;
            color: #333;
            transition: color 0.3s;
        }

        .subcategory-item a:hover {
            color: #007acc;
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
            .subcategory-list {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

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
                font-size: 18px;
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

        // Original slugs
        $categorySlug = isset($cnbt?->newsCategory?->category_en) ? Str::slug($cnbt->newsCategory->category_en) : null;

        $subcategorySlug = isset($cnbt?->newsSubcategory?->sub_cate_en)
            ? Str::slug($cnbt->newsSubcategory->sub_cate_en)
            : null;

        // Always have a non-empty category slug for routes
        $safeCategorySlug = !empty($categorySlug)
            ? $categorySlug
            : Str::slug($category->category_en ?? 'uncategorized');
    @endphp

    <div class="news-container">

        <!-- Category Header -->
        <div class="category-header">
            <h2 class="category-title">
                {{ session('lang') == 'english' ? $category->category_en ?? 'Category' : $category->category_bn ?? 'ক্যাটাগরি' }}
            </h2>

            @if (!empty($get_subcates) && $get_subcates->count())
                <ul class="subcategory-list">
                    @foreach ($get_subcates as $row)
                        <li class="subcategory-item">
                            <p>
                                <span>•</span>
                                <a
                                    href="{{ route('news.sub_cates', [
                                        'category' => trim($category->slug ?? ''),
                                        'subcategory' => trim($row->slug ?? ''),
                                    ]) }}">
                                    {{ session('lang') == 'english' ? $row->sub_cate_en ?? '' : $row->sub_cate_bn ?? '' }}
                                </a>
                            </p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- First Row: Main News + 2 Middle News + Ad -->
        <div class="first-row">

            <!-- Main News -->
            <div class="main-news-section">
                @if (!empty($cnbt))
                    @php
                        $isPlaceholder = Str::contains($cnbt->thumbnail ?? '', 'via.placeholder.com');
                        $imageToShow =
                            !$isPlaceholder && !empty($cnbt->thumbnail)
                                ? asset($cnbt->thumbnail)
                                : asset('uploads/default_images/deafult_thumbnail.jpg');
                    @endphp
                    <div class="post--img">
                        <a href="{{ route('showFull.news', [
                            'category' => $safeCategorySlug,
                            'subcategory' => $subcategorySlug ?? null,
                            'id' => $cnbt->id ?? 0,
                        ]) }}"
                            class="thumb">
                            <img src="{{ $imageToShow }}" alt="{{ $cnbt->title_en ?? '' }}">
                        </a>
                        <div class="post--info">
                            <div class="title">
                                <h2>
                                    <a
                                        href="{{ route('showFull.news', [
                                            'category' => $safeCategorySlug,
                                            'subcategory' => $subcategorySlug ?? null,
                                            'id' => $cnbt->id ?? 0,
                                        ]) }}">
                                        {{ session('lang') == 'english' ? $cnbt->title_en ?? '' : $cnbt->title_bn ?? '' }}
                                    </a>
                                </h2>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- 2 Middle News -->
            <div class="middle-news-section">
                @forelse($cn2 ?? [] as $row)
                    @php
                        $isPlaceholder = Str::contains($row->thumbnail ?? '', 'via.placeholder.com');
                        $imageToShow =
                            !$isPlaceholder && !empty($row->thumbnail)
                                ? asset($row->thumbnail)
                                : asset('uploads/default_images/deafult_thumbnail.jpg');
                    @endphp
                    <div class="post--img">
                        <a href="{{ route('showFull.news', [
                            'category' => $safeCategorySlug,
                            'subcategory' => $subcategorySlug ?? null,
                            'id' => $row->id ?? 0,
                        ]) }}"
                            class="thumb">
                            <img src="{{ $imageToShow }}" alt="{{ $row->title_en ?? '' }}">
                        </a>
                        <div class="post--info">
                            <div class="title">
                                <h2>
                                    {{ session('lang') == 'english'
                                        ? Str::limit($row->title_en ?? '', 30, '...')
                                        : Str::limit($row->title_bn ?? '', 30, '...') }}
                                </h2>
                                <p>
                                    <a
                                        href="{{ route('showFull.news', [
                                            'category' => $safeCategorySlug,
                                            'subcategory' => $subcategorySlug ?? null,
                                            'id' => $row->id ?? 0,
                                        ]) }}">
                                        {!! session('lang') == 'english'
                                            ? Str::limit($row->details_en ?? '', 80, '...')
                                            : Str::limit($row->details_bn ?? '', 80, '...') !!}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- no middle news --}}
                @endforelse
            </div>

            <!-- Sidebar Ads -->
            <aside class="sidebar-ad-section">
                <div class="sidebar-ad-inner">

                    {{-- Ad 1 --}}
                    @if (!empty($cs1))
                        <div class="widget">
                            <a href="{{ route('ads.trackClick', $cs1->id) }}" target="_blank">
                                <div class="ad--widget">
                                    <img src="{{ !empty($cs1->image) && file_exists(public_path($cs1->image))
                                        ? asset($cs1->image)
                                        : asset('frontend_assets/img/ads-img/ad-300x250-1.jpg') }}"
                                        alt="{{ $cs1->title_en ?? 'Advertisement' }}" />
                                </div>
                            </a>
                        </div>
                    @endif

                    {{-- Ad 2 --}}
                    @if (!empty($cs2))
                        <div class="widget" style="margin-top:20px !important">
                            <a href="{{ route('ads.trackClick', $cs2->id) }}" target="_blank">
                                <div class="ad--widget">
                                    <img src="{{ !empty($cs2->image) && file_exists(public_path($cs2->image))
                                        ? asset($cs2->image)
                                        : asset('frontend_assets/img/ads-img/ad-300x250-1.jpg') }}"
                                        alt="{{ $cs2->title_en ?? 'Advertisement' }}" />
                                </div>
                            </a>
                        </div>
                    @endif

                </div>
            </aside>
        </div>

        <!-- Second Row -->
        <div class="second-row">
            @forelse($cn4 ?? [] as $row)
                @php
                    $isPlaceholder = Str::contains($row->thumbnail ?? '', 'via.placeholder.com');
                    $imageToShow =
                        !$isPlaceholder && !empty($row->thumbnail)
                            ? asset($row->thumbnail)
                            : asset('uploads/default_images/deafult_thumbnail.jpg');
                @endphp
                <div class="post--img">
                    <a href="{{ route('showFull.news', [
                        'category' => $safeCategorySlug,
                        'subcategory' => $subcategorySlug ?? null,
                        'id' => $row->id ?? 0,
                    ]) }}"
                        class="thumb">
                        <img src="{{ $imageToShow }}" alt="{{ $row->title_en ?? '' }}">
                    </a>
                    <div class="post--info">
                        <div class="title">
                            <h2>
                                <a
                                    href="{{ route('showFull.news', [
                                        'category' => $safeCategorySlug,
                                        'subcategory' => $subcategorySlug ?? null,
                                        'id' => $row->id ?? 0,
                                    ]) }}">
                                    {{ session('lang') == 'english' ? $row->title_en ?? '' : $row->title_bn ?? '' }}
                                </a>
                            </h2>
                        </div>
                    </div>
                </div>
            @empty
                {{-- no second-row news --}}
            @endforelse
        </div>

        <!-- Dynamic Posts -->
        <div class="posts-container-wrapper">
            <div class="posts-container" id="posts-container">
                @includeWhen(isset($acn), 'layouts.newsIndex.category_news.load')
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
        $(function() {
            let nextPageUrl = '{{ $acn->nextPageUrl() ?? '' }}';
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
                    beforeSend: () => $('#loading').show(),
                    success: function(data) {
                        nextPageUrl = data.nextPageUrl;
                        $('#posts-container').append(data.view);
                    },
                    error: (xhr, status, error) => console.error(error),
                    complete: function() {
                        $('#loading').hide();
                        isLoading = false;
                    }
                });
            }
        });
    </script>
@endsection
