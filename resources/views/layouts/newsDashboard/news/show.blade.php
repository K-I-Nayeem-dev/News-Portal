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
                                    <li class="breadcrumb-item text-muted" aria-current="page">All News</li>
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
                        <h5 class="card-header text-white" style="background-color: #1B84FF">News : {{ $news->id }}</h5>
                        <div class="card-body">
                            <div>{{ $news->newsCategory->category_name }}</div>
                            <div>{{ $news->title }}</div>
                            <div>{{ $news->news_source }}</div>
                            <div>{{ $news->created_at }}</div>
                            <hr>
                            <div>
                                <img src="{{ asset('uploads/news_photos/'. $news->news_photo ) }}" class="w-100 h-100" alt="">
                                <p style="font-size: 14px" class="text-center">{{ $news->image_title }}</p>
                            </div>
                            <div>{{ $news->paragraph }}</div>
                            @if ($news->url)
                                <div class="ratio ratio-16x9">
                                    <iframe src="https://www.youtube.com/embed/{{ $news->url }}" title="Responsive iframe" allowfullscreen></iframe>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
