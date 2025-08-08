@extends('layouts.newsIndex.newsMaster')

@section('meta')
    <meta property="og:url" content="{{ Request::fullUrl() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ session('lang') == 'english' ? $news->title_en : $news->title_bn }}" />
    <meta property="og:description" content="{{ session('lang') == 'english' ? Str::limit(strip_tags($news->details_en), 150) : Str::limit(strip_tags($news->details_bn), 150) }}" />
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
                    <a href="{{ route('home') }}" class="btn-link"><i class="fa fm fa-home"></i>Home</a>
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
    <div class="main-content--section pbottom--30">
        <div class="container">
            <div class="row">
                <div class="main--content col-md-8" data-sticky-content="true">
                    <div class="sticky-content-inner">
                        <div class="post--item post--single post--title-largest">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div class="post--tags">
                                    <ul class="nav">
                                        <li>
                                            <span><i class="fa fa-tags"></i></span>
                                        </li>
                                        @foreach ($tags as $tag)
                                            <li><a href="#">{{ $tag }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="post--social" style="margin-bottom: 15px">
                                    <!-- ShareThis START -->
                                    <div class="sharethis-inline-share-buttons"  data-href='{{ Request::url() }}'></div>
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

                                    <i class="fa-solid fa-location-dot"></i>
                                    <span class="breadcrumb-text">
                                        {{ $division }}  /
                                        {{ $district }}  /
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
                            </div>
                            <div class="ad--space pd--20-0-40">
                                <a href="#">
                                    <img src="{{ asset('frontend_assets/img/ads-img/ad-728x90-02.jpg') }}" alt="" class="center-block" />
                                </a>
                            </div>
                            <div class="post--author-info clearfix">

                            </div>
                            <div class="post--nav">
                                <ul class="nav row">
                                    <li class="col-xs-6 ptop--30 pbottom--30">
                                        <div class="post--item">
                                            <div class="post--img">
                                                <a href="#" class="thumb"><img
                                                        src="img/news-single-img/post-nav-prev.jpg" alt="" /></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Astaroth</a></li>
                                                        <li><a href="#">Yeasterday 03:52 pm</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4">
                                                            <a href="#" class="btn-link">On the other hand, we
                                                                denounce
                                                                with righteous
                                                                indignation and dislike demoralized</a>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xs-6 ptop--30 pbottom--30">
                                        <div class="post--item">
                                            <div class="post--img">
                                                <a href="#" class="thumb"><img
                                                        src="img/news-single-img/post-nav-next.jpg" alt="" /></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Astaroth</a></li>
                                                        <li><a href="#">Yeasterday 03:52 pm</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4">
                                                            <a href="#" class="btn-link">On the other hand, we
                                                                denounce
                                                                with righteous
                                                                indignation and dislike demoralized</a>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="post--related ptop--30">
                                <div class="post--items-title" data-ajax="tab">
                                    <h2 class="h4">You Might Also Like</h2>
                                    <div class="nav">
                                        <a href="#" class="prev btn-link"
                                            data-ajax-action="load_prev_related_posts">
                                            <i class="fa fa-long-arrow-left"></i>
                                        </a>
                                        <span class="divider">/</span>
                                        <a href="#" class="next btn-link"
                                            data-ajax-action="load_next_related_posts">
                                            <i class="fa fa-long-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="post--items post--items-2" data-ajax-content="outer">
                                    <ul class="nav row" data-ajax-content="inner">
                                        <li class="col-sm-6 pbottom--30">
                                            <div class="post--item post--layout-1">
                                                <div class="post--img">
                                                    <a href="#" class="thumb"><img
                                                            src="img/news-single-img/related-post-01.jpg"
                                                            alt="" /></a>
                                                    <a href="#" class="cat">Fitness</a>
                                                    <a href="#" class="icon"><i class="fa fa-flash"></i></a>
                                                    <div class="post--info">
                                                        <ul class="nav meta">
                                                            <li><a href="#">Astaroth</a></li>
                                                            <li><a href="#">Yeasterday 03:52 pm</a></li>
                                                        </ul>
                                                        <div class="title">
                                                            <h3 class="h4">
                                                                <a href="#" class="btn-link">On the other hand, we
                                                                    denounce with
                                                                    righteous indignation and dislike
                                                                    demoralized</a>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="post--content">
                                                    <p>
                                                        At vero eos et accusamus et iusto odio dignissimos
                                                        ducimus qui blanditiis praesentium voluptatum
                                                        deleniti atque corrupti quos mollitia animi, id
                                                        est laborum et dolorum fuga.
                                                    </p>
                                                </div>
                                                <div class="post--action">
                                                    <a href="#">Continue Reading... </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="col-sm-6 hidden-xs pbottom--30">
                                            <div class="post--item post--layout-1">
                                                <div class="post--img">
                                                    <a href="#" class="thumb"><img
                                                            src="img/news-single-img/related-post-02.jpg"
                                                            alt="" /></a>
                                                    <a href="#" class="cat">Fitness</a>
                                                    <a href="#" class="icon"><i class="fa fa-flash"></i></a>
                                                    <div class="post--info">
                                                        <ul class="nav meta">
                                                            <li><a href="#">Astaroth</a></li>
                                                            <li><a href="#">Yeasterday 03:52 pm</a></li>
                                                        </ul>
                                                        <div class="title">
                                                            <h3 class="h4">
                                                                <a href="#" class="btn-link">On the other hand, we
                                                                    denounce with
                                                                    righteous indignation and dislike
                                                                    demoralized</a>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="post--content">
                                                    <p>
                                                        At vero eos et accusamus et iusto odio dignissimos
                                                        ducimus qui blanditiis praesentium voluptatum
                                                        deleniti atque corrupti quos mollitia animi, id
                                                        est laborum et dolorum fuga.
                                                    </p>
                                                </div>
                                                <div class="post--action">
                                                    <a href="#">Continue Reading... </a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="preloader bg--color-0--b" data-preloader="1">
                                        <div class="preloader--inner"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="comment--list pd--30-0">
                                <div class="post--items-title">
                                    <h2 class="h4">03 Comments</h2>
                                    <i class="icon fa fa-comments-o"></i>
                                </div>
                                <ul class="comment--items nav">
                                    <li>
                                        <div class="comment--item clearfix">
                                            <div class="comment--img float--left">
                                                <img src="img/news-single-img/comment-avatar-01.jpg" alt="" />
                                            </div>
                                            <div class="comment--info">
                                                <div class="comment--header clearfix">
                                                    <p class="name">Karla Gleichauf</p>
                                                    <p class="date">12 May 2017 at 05:28 pm</p>
                                                    <a href="#" class="reply"><i class="fa fa-mail-reply"></i></a>
                                                </div>
                                                <div class="comment--content">
                                                    <p>
                                                        On the other hand, we denounce with righteous
                                                        indignation and dislike men who are so beguiled
                                                        and demoralized by the charms of pleasure of the
                                                        moment
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="comment--item clearfix">
                                            <div class="comment--img float--left">
                                                <img src="img/news-single-img/comment-avatar-02.jpg" alt="" />
                                            </div>
                                            <div class="comment--info">
                                                <div class="comment--header clearfix">
                                                    <p class="name">M Shyamalan</p>
                                                    <p class="date">12 May 2017 at 05:28 pm</p>
                                                    <a href="#" class="reply"><i class="fa fa-mail-reply"></i></a>
                                                </div>
                                                <div class="comment--content">
                                                    <p>
                                                        On the other hand, we denounce with righteous
                                                        indignation and dislike men who are so beguiled
                                                        and demoralized by the charms of pleasure of the
                                                        moment
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="comment--items nav">
                                            <li>
                                                <div class="comment--item clearfix">
                                                    <div class="comment--img float--left">
                                                        <img src="img/news-single-img/comment-avatar-03.jpg"
                                                            alt="" />
                                                    </div>
                                                    <div class="comment--info">
                                                        <div class="comment--header clearfix">
                                                            <p class="name">Liz Montano</p>
                                                            <p class="date">12 May 2017 at 05:28 pm</p>
                                                            <a href="#" class="reply"><i
                                                                    class="fa fa-mail-reply"></i></a>
                                                        </div>
                                                        <div class="comment--content">
                                                            <p>
                                                                On the other hand, we denounce with righteous
                                                                indignation and dislike men who are so
                                                                beguiled and demoralized by the charms of
                                                                pleasure of the moment
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="comment--form pd--30-0">
                                <div class="post--items-title">
                                    <h2 class="h4">Leave A Comment</h2>
                                    <i class="icon fa fa-pencil-square-o"></i>
                                </div>
                                <div class="comment-respond">
                                    <form action="#" data-form="validate">
                                        <p>
                                            Don’t worry ! Your email address will not be published.
                                            Required fields are marked (*).
                                        </p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>
                                                    <span>Comment *</span>
                                                    <textarea name="comment" class="form-control" required></textarea>
                                                </label>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>
                                                    <span>Name *</span>
                                                    <input type="text" name="name" class="form-control" required />
                                                </label>
                                                <label>
                                                    <span>Email Address *</span>
                                                    <input type="email" name="email" class="form-control" required />
                                                </label>
                                                <label>
                                                    <span>Website</span>
                                                    <input type="text" name="website" class="form-control" />
                                                </label>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">
                                                    Post a Comment
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endsection
