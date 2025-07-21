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
                <div class="col-lg">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Bangla Version
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $news->newsCategory->category_bn }}</h5>
                            <img class="w-100 my-3" src="{{ asset($news->thumbnail) }}" alt="{{ $news->title_bn }}">
                            <p class="card-text">{{ $news->title_bn }}</p>
                            <a href="{{ route('news_bn', $news->id) }}" class="btn btn-primary">Show</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Bangla Version
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $news->newsCategory->category_en }}</h5>
                            <img class="w-100 my-3" src="{{ asset($news->thumbnail) }}" alt="{{ $news->title_en }}">
                            <p class="card-text">{{ $news->title_en }}</p>
                            <a href="{{ route('news_en', $news->id) }}" class="btn btn-primary">Show</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
