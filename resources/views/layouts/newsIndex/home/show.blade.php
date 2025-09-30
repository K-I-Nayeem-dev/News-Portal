@extends('layouts.newsIndex.newsMaster')

@section('meta')
    <meta property="og:url" content="{{ Request::fullUrl() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ session('lang') == 'english' ? $news->title_en : $news->title_bn }}" />
    <meta property="og:description"
        content="{{ session('lang') == 'english' ? Str::limit(strip_tags($news->details_en), 150) : Str::limit(strip_tags($news->details_bn), 150) }}" />
    <meta property="og:image" content="{{ asset($news->thumbnail) }}" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
@endsection

@section('content')
    <style>
        .video-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
        }


        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>

    <div class="main--breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}" class="btn-link"><i
                            class="fa fm fa-home"></i>{{ session()->get('lang') == 'english' ? 'Home' : 'হোম' }}</a>
                </li>
                <li>
                    <a href="travel.html" class="btn-link">
                        {{ session()->get('lang') == 'english' ? $news->newsCategory->category_en : $news->newsCategory->category_bn }}
                    </a>
                </li>
                @if ($news->sub_cate_id)
                    <li class="active">
                        <span>{{ session()->get('lang') == 'english' ? $news->newsSubCategory->sub_cate_en : $news->newsSubCategory->sub_cate_bn }}</span>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <div class="main-content--section">
        <div class="container">
            <div class="row">
                <div class="main--content col-md-8" data-sticky-content="true">
                    <div class="sticky-content-inner">
                        <div class="post--item post--single post--title-largest">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div class="post--tags">
                                    <ul class="nav" style="display: flex; list-style: none; padding: 0; margin: 0;">
                                        <li style="margin-right: 10px;">
                                            <span><i class="fa fa-folder"></i></span>
                                        </li>

                                        {{-- Category --}}
                                        @if ($news->newsCategory)
                                            <li style="margin-right: 10px; display: inline-block;">
                                                <a href="{{ route('getCate.news', $news->newsCategory->slug) }}"
                                                    style="text-decoration: none; padding: 5px 10px; background: #3498db; color: white; border-radius: 3px;">
                                                    @if (session()->get('lang') == 'english')
                                                        {{ $news->newsCategory->category_en ?? 'Category' }}
                                                    @else
                                                        {{ $news->newsCategory->category_bn ?? 'ক্যাটেগরি' }}
                                                    @endif
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Subcategory --}}
                                        @if ($news->newsSubCategory)
                                            <li style="margin-right: 10px; display: inline-block;">
                                                <a href="{{ route('news.sub_cates', [$news->newsCategory->slug, $news->newsSubCategory->slug]) }}"
                                                    style="text-decoration: none; padding: 5px 10px; background: #e74c3c; color: white; border-radius: 3px;">
                                                    @if (session()->get('lang') == 'english')
                                                        {{ $news->newsSubCategory->subcategory_en ?? 'Subcategory' }}
                                                    @else
                                                        {{ $news->newsSubCategory->subcategory_bn ?? 'সাবক্যাটেগরি' }}
                                                    @endif
                                                </a>
                                            </li>
                                        @endif

                                        {{-- If no category or subcategory exists --}}
                                        @if (!$news->newsCategory && !$news->newsSubCategory)
                                            <li style="color: #666;">No category found</li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="post--social" style="margin-bottom: 15px">
                                    <!-- ShareThis START -->
                                    <div class="sharethis-inline-share-buttons" data-href='{{ Request::url() }}'></div>
                                    <!-- ShareThis END -->
                                </div>
                            </div>
                            <div class="post--img">
                                @php
                                    $isPlaceholder = Str::contains($news->news_photo, 'via.placeholder.com');
                                    $imageToShow =
                                        !$isPlaceholder && !empty($news->news_photo)
                                            ? asset('uploads/news_photos/' . $news->news_photo)
                                            : asset('uploads/default_images/deafult_thumbnail.jpg');
                                @endphp

                                <img src="{{ $imageToShow }}" alt="{{ $news->title_en }}" class="img-fluid">
                                <div style="margin-top: 10px">
                                    @php
                                        $isEnglish = session()->get('lang') === 'english';

                                        $division = $isEnglish
                                            ? $news->newsDivision->division_en
                                            : $news->newsDivision->division_bn;
                                        $district = $isEnglish
                                            ? $news->newsDistrict->district_en
                                            : $news->newsDistrict->district_bn;
                                        $subDistrict = $isEnglish
                                            ? $news->newsSubDist->sub_district_en
                                            : $news->newsSubDist->sub_district_bn;
                                    @endphp

                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <span class="breadcrumb-text">
                                        {{ $division }} /
                                        {{ $district }} /
                                        {{ $subDistrict }}
                                    </span>
                                </div>
                            </div>
                            <div class="post--info">
                                <ul class="nav meta">
                                    <li><a href="#">{{ $news->newsUser->name }}</a></li>
                                    <li>
                                        <span>{{ session()->get('lang') == 'english' ? $news->created_at->format('j F Y') : formatBanglaDate($news->created_at) }}</span>
                                    </li>
                                    {{-- This section is for views And Comment count --}}
                                    {{-- <li>
                                        <span><i class="fa fm fa-eye"></i>45k</span>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fm fa-comments-o"></i>02</a>
                                    </li> --}}
                                </ul>
                                <div class="title">
                                    <h2 class="h4">
                                        {{ session()->get('lang') == 'english' ? $news->title_en : $news->title_bn }}
                                    </h2>
                                </div>
                            </div>
                            <div class="post--content">

                                <div style="margin-bottom: 15px">
                                    {!! session()->get('lang') == 'english' ? $news->details_en : $news->details_bn !!}
                                </div>

                                @if ($news->url)
                                    <div class="video-container">
                                        <iframe src="https://www.youtube.com/embed/{{ $news->url }}"
                                            title="Responsive iframe" frameborder="0" allowfullscreen>
                                        </iframe>
                                    </div>
                                @endif

                                <div
                                    style="display: flex; justify-content: space-between; align-items: flex-start; margin: 20px 0;">
                                    <div class="post--tags"
                                        style="flex: 1; max-width: 100%; display: flex; align-items: flex-start; gap: 10px;">
                                        <div style="color: #666; padding-top: 6px; flex-shrink: 0;">
                                            <i class="fa fa-tags" style="font-size: 16px;"></i>
                                        </div>
                                        <ul class="nav"
                                            style="display: flex; flex-wrap: wrap; list-style: none; padding: 0; margin: 0; align-items: flex-start; row-gap: 8px; column-gap: 8px; flex: 1;">
                                            @if ($news->tags && $news->tags->count() > 0)
                                                @foreach ($news->tags as $tag)
                                                    <li style="display: inline-flex;">
                                                        <a href="{{ route('tag.news', $tag->slug) }}"

                                                            style="text-decoration: none; padding: 5px 12px; background: #f0f0f0; border-radius: 20px; display: inline-block; font-size: 13px; color: #333;"
                                                            onmouseover="this.style.background='#e74c3c'; this.style.color='white';"
                                                            onmouseout="this.style.background='#f0f0f0'; this.style.color='#333';">
                                                            @if (session()->get('lang') == 'english')
                                                                {{ $tag->tag_en }}
                                                            @else
                                                                {{ $tag->tag_bn }}
                                                            @endif
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li style="color: #999; font-size: 13px;">No tags found</li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <div class="ad--space pd--20-0-40">
                                <a href="{{ route('ads.trackClick', $nm->id) }}" target="_blank">
                                    <img src="{{ $nm && file_exists(public_path($nm->image))
                                        ? asset($nm->image)
                                        : asset('frontend_assets/img/ads-img/ad-728x90-01.jpg') }}"
                                        alt="{{ $nm->title_en ?? 'Advertisement' }}" class="img-fluid" />
                                </a>
                            </div>

                            @if ($morePhotos->count() > 0)
                                @foreach ($morePhotos as $row)
                                    <div style="width: 100%; padding: 20px 0">
                                        <img src="{{ asset('uploads/news_related_photos/' . $row->photo) }}"
                                            alt="{{ $news->title_en }}" class="img-fluid">
                                    </div>
                                @endforeach
                            @endif

                            {{-- Facebook comment For news --}}
                            <div class="comment--form pd--30-0">
                                <div class="fb-comments" data-href="{{ Request::fullUrl() }}" data-width="100%"
                                    data-numposts="5"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="main--sidebar col-md-4 col-sm-5 ptop--30 pbottom--30" data-sticky-content="true">
                    <div class="sticky-content-inner"
                        style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">
                        <div class="widget">
                            <div class="ad--widget">
                                <a href="{{ route('ads.trackClick', $nlb->id) }}" target="_blank">
                                    <img src="{{ $nlb && file_exists(public_path($nlb->image))
                                        ? asset($nlb->image)
                                        : asset('frontend_assets/img/ads-img/ad-300x250-1.jpg') }}"
                                        alt="{{ $nlb->title_en ?? 'Advertisement' }}" data-rjs="2"
                                        class="img-fluid" />
                                </a>
                            </div>
                        </div>

                        <div class="news-peoples-choice-section">
                            <div style="margin-top: 30px;">
                                <h3
                                    style="font-size: 18px; font-weight: bold; display: inline; border-bottom: 2px solid #DA0000; padding-bottom: 10px">
                                    {!! session()->get('lang') == 'english'
                                        ? $news->newsCategory->category_en . '<span> Peoples Choice </span>'
                                        : $news->newsCategory->category_bn . '<span> এর পাঠক প্রিয় </span>' !!}
                                </h3>
                            </div>

                            <div class="news-items-container">
                                @foreach ($relatedNews as $row)
                                    <div class="news-item-wrapper">
                                        <a href="{{ route('showFull.news', [
                                            'category' => $row->newsCategory->slug ?? '',
                                            'subcategory' => $row->newsSubcategory->slug ?? '',
                                            'id' => $row->id,
                                        ]) }}"
                                            class="news-content-link">

                                            <div class="news-text-content">
                                                <h3 class="news-item-title">{{ $row->title_en }}</h3>
                                                <p class="news-item-excerpt">
                                                    {!! session()->get('lang') == 'english'
                                                        ? \Illuminate\Support\Str::limit($row->details_en, 60)
                                                        : \Illuminate\Support\Str::limit($row->details_bn, 60) !!}
                                                </p>
                                            </div>

                                            <div class="news-thumbnail-wrapper">
                                                @php
                                                    $isPlaceholder = Str::contains(
                                                        $row->thumbnail,
                                                        'via.placeholder.com',
                                                    );
                                                    $imageToShow =
                                                        !$isPlaceholder && !empty($row->thumbnail)
                                                            ? asset($row->thumbnail)
                                                            : asset('uploads/default_images/deafult_thumbnail.jpg');
                                                @endphp
                                                <img src="{{ $imageToShow }}" alt="{{ $row->title_en }}"
                                                    class="news-thumbnail-img">
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <style>
                            /* Scoped styles for news peoples choice section */
                            .news-peoples-choice-section .news-items-container {
                                margin-top: 20px;
                            }

                            .news-peoples-choice-section .news-item-wrapper {
                                margin-bottom: 20px;
                                border-bottom: 1px solid #e0e0e0;
                                padding-bottom: 15px;
                            }

                            .news-peoples-choice-section .news-item-wrapper:last-child {
                                border-bottom: none;
                            }

                            .news-peoples-choice-section .news-content-link {
                                display: flex;
                                align-items: center;
                                gap: 15px;
                                text-decoration: none;
                                color: inherit;
                            }

                            .news-peoples-choice-section .news-text-content {
                                flex: 1;
                                min-width: 0;
                                /* Allows text to shrink properly */
                            }

                            .news-peoples-choice-section .news-item-title {
                                font-size: 19.2px;
                                margin: 0 0 10px 0;
                                line-height: 1.4;
                                color: #333;
                            }

                            .news-peoples-choice-section .news-item-excerpt {
                                margin: 0;
                                color: #666;
                                font-size: 14px;
                                line-height: 1.5;
                            }

                            .news-peoples-choice-section .news-thumbnail-wrapper {
                                flex-shrink: 0;
                                width: 120px;
                                height: 80px;
                            }

                            .news-peoples-choice-section .news-thumbnail-img {
                                width: 100%;
                                height: 100%;
                                object-fit: cover;
                                display: block;
                                border-radius: 4px;
                            }

                            /* Responsive styles */
                            @media (max-width: 768px) {
                                .news-peoples-choice-section .news-thumbnail-wrapper {
                                    width: 100px;
                                    height: 70px;
                                }

                                .news-peoples-choice-section .news-item-title {
                                    font-size: 16px;
                                }

                                .news-peoples-choice-section .news-item-excerpt {
                                    font-size: 13px;
                                }
                            }

                            @media (max-width: 480px) {
                                .news-peoples-choice-section .news-content-link {
                                    gap: 10px;
                                }

                                .news-peoples-choice-section .news-thumbnail-wrapper {
                                    width: 90px;
                                    height: 60px;
                                }

                                .news-peoples-choice-section .news-item-title {
                                    font-size: 15px;
                                }

                                .news-peoples-choice-section .news-item-excerpt {
                                    font-size: 12px;
                                }
                            }

                            /* Hover effect */
                            .news-peoples-choice-section .news-content-link:hover .news-item-title {
                                color: #DA0000;
                            }

                            .news-peoples-choice-section .news-content-link:hover .news-thumbnail-img {
                                opacity: 0.9;
                                transform: scale(1.02);
                                transition: all 0.3s ease;
                            }
                        </style>

                        <div class="resize-sensor"
                            style="position: absolute; inset: 0px; overflow: hidden; z-index: -1; visibility: hidden;">
                            <div class="resize-sensor-expand"
                                style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                                <div
                                    style="position: absolute; left: 0px; top: 0px; transition: all; width: 400px; height: 4061px;">
                                </div>
                            </div>
                            <div class="resize-sensor-shrink"
                                style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                                <div
                                    style="position: absolute; left: 0; top: 0; transition: 0s; width: 200%; height: 200%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content--section">
        <div class="container">
            <div class="row">
                <div class="main--content col-md-8 col-sm-7" data-sticky-content="true">
                    <div class="sticky-content-inner">
                        <div class="row">
                            @foreach ($randomNews as $row)
                                <div class="col-6 col-sm-6 col-md-4 mt-3" style="margin-top: 20px">
                                    <div>
                                        <div class="post--img">
                                            <a href="{{ route('showFull.news', [
                                                'category' => $row->newsCategory->slug ?? '',
                                                'subcategory' => $row->newsSubcategory->slug ?? '',
                                                'id' => $row->id,
                                            ]) }}"
                                                class="thumb">
                                                @php
                                                    $isPlaceholder = Str::contains(
                                                        $row->thumbnail,
                                                        'via.placeholder.com',
                                                    );
                                                    $imageToShow =
                                                        !$isPlaceholder && !empty($row->thumbnail)
                                                            ? asset($row->thumbnail)
                                                            : asset('uploads/default_images/deafult_thumbnail.jpg');
                                                @endphp

                                                <img src="{{ $imageToShow }}" alt="{{ $row->title_en }}"
                                                    class="img-fluid">

                                            </a>
                                            <a class="cat">
                                                @if (session()->get('lang') == 'english')
                                                    {{ $row->newsCategory->category_en }}
                                                @else
                                                    {{ $row->newsCategory->category_bn }}
                                                @endif
                                            </a>
                                            <div class="post--info">

                                                <div class="title">
                                                    <h2 class="h4">
                                                        <a href="{{ route('showFull.news', [
                                                            'category' => $row->newsCategory->slug ?? '',
                                                            'subcategory' => $row->newsSubcategory->slug ?? '',
                                                            'id' => $row->id,
                                                        ]) }}"
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
                                    <a href="{{ route('ads.trackClick', $nb->id) }}" target="_blank">
                                        <img src="{{ $nb && file_exists(public_path($nb->image))
                                            ? asset($nb->image)
                                            : asset('frontend_assets/img/ads-img/ad-728x90-01.jpg') }}"
                                            alt="{{ $nb->title_en ?? 'Advertisement' }}" class="img-fluid" />
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="main--sidebar col-md-4 col-sm-5 ptop--30 pbottom--30" data-sticky-content="true">
                    <div class="sticky-content-inner"
                        style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">
                        <div class="widget">
                            <div class="ad--widget">
                                <a href="{{ route('ads.trackClick', $n3s_1->id) }}" target="_blank">
                                    <img src="{{ $n3s_1 && file_exists(public_path($n3s_1->image))
                                        ? asset($n3s_1->image)
                                        : asset('frontend_assets/img/ads-img/ad-300x250-1.jpg') }}"
                                        alt="{{ $n3s_1->title_en ?? 'Advertisement' }}" data-rjs="2"
                                        class="img-fluid" />
                                </a>
                            </div>
                            <div class="ad--widget" style="margin-top: 30px">
                                <a href="{{ route('ads.trackClick', $n3s_2->id) }}" target="_blank">
                                    <img src="{{ $n3s_2 && file_exists(public_path($n3s_2->image))
                                        ? asset($n3s_2->image)
                                        : asset('frontend_assets/img/ads-img/ad-300x250-1.jpg') }}"
                                        alt="{{ $n3s_2->title_en ?? 'Advertisement' }}" data-rjs="2"
                                        class="img-fluid" />
                                </a>
                            </div>
                            <div class="ad--widget" style="margin-top: 30px">
                                <a href="{{ route('ads.trackClick', $n3s_3->id) }}" target="_blank">
                                    <img src="{{ $n3s_3 && file_exists(public_path($n3s_3->image))
                                        ? asset($n3s_3->image)
                                        : asset('frontend_assets/img/ads-img/ad-300x250-1.jpg') }}"
                                        alt="{{ $n3s_3->title_en ?? 'Advertisement' }}" data-rjs="2"
                                        class="img-fluid" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
