@extends('layouts.newsIndex.newsMaster')

@section('content')
    <style>
        #loading {
            display: none;
            text-align: center;
            padding: 20px;
        }

        #loading p {
            font-weight: bold;
            font-size: 18px;
            color: #555;
            margin: 0 0 10px 0;
        }

        /* Simple spinner */
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
    </style>
    @php
        use Illuminate\Support\Str;

        $categorySlug = Str::slug($cnbt->newsCategory->category_en);
        $subcategorySlug = $cnbt->newsSubcategory ? Str::slug($cnbt->newsSubcategory->sub_cate_en) : null;
    @endphp

    <div class="container">
        {{-- fisrt Section 9 News with widget Start --}}
        <div class="row">
            <div style="border-bottom: 2px solid #DA0000; margin-top: 20px" data-ajax="tab">
                <h2 style="font-size: 20px; font-weight: bold;">
                    {{ session()->get('lang') == 'english' ? $category->category_en : $category->category_bn }}
                </h2>
                @if ($get_subcates->count() > 0)
                    <!-- Option 2: CSS pseudo-element approach -->
                    <ul
                        style="display: flex; align-items: center; margin-bottom: 5px; margin-left: -40px; list-style: none;">
                        @foreach ($get_subcates as $index => $row)
                            <li style="{{ $index != 0 ? 'padding-left:15px;' : '' }} font-size: 14px;">
                                <p>
                                    <span style="margin-right: 4px; color: #007acc; font-size: 15px;">•</span>
                                    <a
                                        href="{{ route('news.sub_cates', [
                                            'category' => trim($category->slug),
                                            'subcategory' => trim($row->slug),
                                        ]) }}">{{ session()->get('lang') == 'english' ? $row->sub_cate_en : $row->sub_cate_bn }}</a>
                                </p>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="main--content col-md-8 col-sm-7" data-sticky-content="true" style="margin-top: 30px;">
                {{-- This Section will Show Main news --}}
                <div class="col-md-8">
                    <div>
                        <div class="post--img">
                            {{-- <a href="news-single-v1.html" class="thumb"><img src="{{ asset('uploads/news_photos/'. $fsbt->news_photo) }}"alt="{{ $fsbt->title }}" /></a> --}}
                            <a href="{{ route('showFull.news', array_filter(['category' => $categorySlug, 'subcategory' => $subcategorySlug, 'id' => $cnbt->id])) }}"
                                class="thumb">
                                @php
                                    $isPlaceholder = Str::contains($cnbt->thumbnail, 'via.placeholder.com');
                                    $imageToShow =
                                        !$isPlaceholder && !empty($cnbt->thumbnail)
                                            ? asset($cnbt->thumbnail)
                                            : asset('uploads/default_images/deafult_thumbnail.jpg');
                                @endphp

                                <img src="{{ $imageToShow }}" alt="{{ $cnbt->title_en }}"class="img-fluid">

                            </a>
                            {{-- <a href="#" class="cat">
                                @if (session()->get('lang') == 'english')
                                    {{ $cnbt->newsCategory->category_en }}
                                @else
                                    {{ $cnbt->newsCategory->category_bn }}
                                @endif
                            </a> --}}
                            <div class="post--info">
                                <div class="title">
                                    <h2 class="h4">
                                        <a href="news-single-v1.html" class="btn-link">
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
                <div class="col-md-4">
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
                                                            ? asset($row->thumbnail)
                                                            : asset('uploads/default_images/deafult_thumbnail.jpg');
                                                @endphp

                                                <img src="{{ $imageToShow }}" alt="{{ $row->title_en }}"class="img-fluid">

                                            </a>
                                        </a>
                                        {{-- <a href="#" class="cat">
                                            @if (session()->get('lang') == 'english')
                                                {{ $row->newsCategory->category_en }}
                                            @else
                                                {{ $row->newsCategory->category_bn }}
                                            @endif
                                        </a> --}}
                                        <div class="post--info">
                                            <div class="title">
                                                <h2 class="h4">
                                                    {{ session()->get('lang') == 'engilsh' ? \Illuminate\Support\Str::limit($row->title_en, 30, '...') : \Illuminate\Support\Str::limit($row->title_bn, 30, '...') }}
                                                </h2>
                                                <p>
                                                    <a href="news-single-v1.html" class="btn-link">
                                                        {!! session()->get('lang') == 'engilsh'
                                                            ? \Illuminate\Support\Str::limit($row->details_en, 80, '...')
                                                            : \Illuminate\Support\Str::limit($row->details_bn, 80, '...') !!}
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="main--sidebar col-md-4 col-sm-5 ptop--30 pbottom--30" data-sticky-content="true">
                <div class="sticky-content-inner"
                    style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">
                    <div class="widget">
                        <a href="{{ route('ads.trackClick', $cs->id) }}" target="_blank">
                            <div class="ad--widget">
                                <img src="{{ $cs && file_exists(public_path($cs->image))
                                    ? asset($cs->image)
                                    : asset('frontend_assets/img/ads-img/ad-300x250-1.jpg') }}"
                                    alt="{{ $cs->title_en ?? 'Advertisement' }}" data-rjs="2" class="img-fluid" />
                            </div>
                        </a>



                    </div>
                </div>
            </div>

        </div>
        {{-- fisrt Section 9 News with widget  End --}}

        {{-- fisrt Section 9 News with widget Start --}}
        <div class="row">
            <div class="main--content col-md-12 col-sm-7" data-sticky-content="true" style="margin-top: 30px">
                <div style="display: flex; align-items: center">
                    @foreach ($cn4 as $row)
                        <div class="col-md-3">
                            <div class="col-md-12 col-xs-6 col-xxs-12">
                                <div>
                                    <div class="post--img">
                                        <a href="news-single-v1.html" class="thumb">
                                            @php
                                                $isPlaceholder = Str::contains($row->thumbnail, 'via.placeholder.com');
                                                $imageToShow =
                                                    !$isPlaceholder && !empty($row->thumbnail)
                                                        ? asset($row->thumbnail)
                                                        : asset('uploads/default_images/deafult_thumbnail.jpg');
                                            @endphp

                                            <img src="{{ $imageToShow }}" alt="{{ $row->title_en }}"class="img-fluid">

                                        </a>
                                        {{-- <a href="#" class="cat">
                                            @if (session()->get('lang') == 'english')
                                                {{ $row->newsCategory->category_en }}
                                            @else
                                                {{ $row->newsCategory->category_bn }}
                                            @endif
                                        </a> --}}
                                        <div class="post--info">
                                            <div class="title">
                                                <h2 class="h4">
                                                    <a href="news-single-v1.html" class="btn-link">
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
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- fisrt Section 9 News with widget  End --}}

        {{-- Data Load When Scroll And down but  --}}
        <div class="main--content col-md-12 col-sm-7" data-sticky-content="true" style="margin-top: 30px">
            <div id="posts-container">
                @include('layouts.newsIndex.category_news.load')
            </div>
        </div>

        {{-- Loading animation --}}
        <div id="loading">
            <p>Loading...</p>
            <div class="spinner"></div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            let nextPageUrl = '{{ $acn->nextPageUrl() }}';

            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                    if (nextPageUrl) {
                        loadMorePosts();
                    }
                }
            });

            function loadMorePosts() {
                $.ajax({
                    url: nextPageUrl,
                    type: 'get',
                    beforeSend: function() {
                        // Show loading button
                        $('#loading').show();
                        // Prevent multiple requests
                        nextPageUrl = '';
                    },
                    success: function(data) {
                        nextPageUrl = data.nextPageUrl;
                        $('#posts-container').append(data.view);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error loading more posts:", error);
                    },
                    complete: function() {
                        // Hide loading button after request finished
                        $('#loading').hide();
                    }
                });
            }
        });
    </script>
@endsection
