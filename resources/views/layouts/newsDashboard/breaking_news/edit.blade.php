@extends('layouts.newsDashboard.dashboardMaster')

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
                                        <a class="text-muted text-decoration-none" href="">Home
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">Headline Edit</li>
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
                <div class="d-flex justify-content-center">
                    <div class="col-lg-8 px-1">
                        <div class="card">
                            <h5 class="card-header text-white" style="background-color: #1B84FF">Edit Headline News</h5>
                            <div class="card-body">
                                <form method="POST" action="{{ route('breaking_news.update', $breakings->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <div>

                                        <label for="BNE" class="form-label">Make English Headline</label>

                                        <textarea name="news_en" id="BNE" rows="5" class="form-control" autocomplete="off">{{ old('news_en', $breakings->news_en) }}</textarea>

                                        @error('news_en')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>
                                    <div class="mt-3">

                                        <label for="BNB" class="form-label">Make Bangla Headline</label>

                                        <textarea name="news_bn" id="BNB" rows="5" class="form-control" autocomplete="off">{{ old('news_bn', $breakings->news_bn) }}</textarea>

                                        @error('news_bn')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>

                                    <div class="mt-2">

                                        <label for="url" class="form-label">News Url</label>

                                        <input name="url" id="url" type="text"
                                            value="{{ old('url', $breakings->url) }}" class="form-control"
                                            autocomplete="off" />

                                        @error('url')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>

                                    <button style="background-color: #1B84FF" class="btn text-white mt-3">Update</button>
                                    <a class="btn btn-primary mt-3 ms-2" href="{{ route('breaking_news.index') }}">Back</a>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
