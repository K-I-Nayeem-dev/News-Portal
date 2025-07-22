@extends('layouts.newsDashboard.dashboard')

@section('dashboard')
    <div class="body-wrapper">
        <div class="container-fluid">
            <!-- -------------------------------------------------------------- -->
            <!-- Breadcrumb -->
            <!-- -------------------------------------------------------------- -->
            <div class="font-weight-medium shadow-none position-relative overflow-hidden mb-7">
                <div class="card-body px-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-medium  mb-0">Dashboard</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('news.index') }}">All News
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">News : {{ $news->id }}
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- -------------------------------------------------------------- -->
            <!-- Breadcrumb End -->
            <!-- -------------------------------------------------------------- -->
            <!-- Row -->
            <div class="row">

                <div class="offset-lg-1 offset-md-1 offset-sm-1 col-lg-9 col-sm-9 col-md-9">

                    <div class="card">


                        <h5 class="card-header text-white d-flex justify-content-between" style="background-color: #1B84FF">

                            <span>

                                News : {{ $news->id }}



                                @if ($news->updated_at && Auth::user()->role == 'admin')
                                    <span class="ms-3">Edited By :

                                        {{ $news->editUser->name . ' AT ' . $news->updated_at->timezone('Asia/Dhaka')->format('l, d F Y' . ' ' . 'g:i A') }}</span>
                                @elseif($news->updated_at)
                                    <span class="ms-3">Edited</span>
                                @endif

                            </span>

                            <span>

                                <a class="text-white" href="{{ route('news.index') }}">Back</a>

                                <a class="text-white ms-2" href="{{ route('news.edit', $news->id) }}">Edit</a>

                            </span>

                        </h5>

                        <div class="card-body">

                            <div>

                                <p class="mb-2"
                                    style="font-size: 24px; border-bottom: 2px #768B9E solid;  display: inline-block; margin-bottom: 5px">
                                    {{ $news->newsCategory->category_en }}</p>

                                <h1 class="mb-2">{{ $news->title_en }}</h1>

                                <p class="mb-2" style="font-size: 14px;">{{ $news->news_source }}</p>

                                {{-- This is time English Format --}}
                                <p>
                                    <i class="fa-solid fa-calendar-days me-2"></i>
                                    <span>{{ $news->created_at->timezone('Asia/Dhaka')->format('l, d F Y') }}</span>
                                    <span>{{ $news->created_at->timezone('Asia/Dhaka')->format('g:i A') }}</span>
                                    <span class="ms-2">
                                        <span>{{ $news->newsDistrict->district_en }} - {{ $news->newsSubDist->sub_district_en }}</span>
                                    </span>
                                </p>


                            </div>

                            <hr>

                            <div>
                                <img src="{{ asset('uploads/news_photos/' . $news->news_photo) }}" class="w-100 h-100"
                                    alt="">
                                <p style="font-size: 14px" class="text-center">{{ $news->image_title }}</p>

                            </div>

                            {{-- This is main news Details or paragraph --}}

                            <div>
                                {!! $news->details_en !!}
                            </div>

                            @if ($news_photos->isNotEmpty())
                                @foreach ($news_photos as $photo)
                                    <div class="my-4">
                                        <img src="{{ asset('uploads/news_related_photos/' . $photo->photo) }}"
                                            class="w-100 h-100" alt="{{ $news->title }}">
                                    </div>
                                @endforeach
                            @endif


                            @if ($news->url)
                                <div class="ratio ratio-16x9 my-4">
                                    <iframe src="https://www.youtube.com/embed/{{ $news->url }}"
                                        title="Responsive iframe" allowfullscreen></iframe>
                                </div>
                            @endif

                            <div class="d-flex justify-content-center">
                                <a class="btn btn-primary rounded" href="{{ route('news.index') }}">Back</a>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
