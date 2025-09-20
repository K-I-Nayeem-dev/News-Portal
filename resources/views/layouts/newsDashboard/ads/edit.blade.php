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
                                        <a class="text-muted text-decoration-none" href="{{ route('ads.index') }}">Create
                                            Ads
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">Edit</li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">{{ $ad->id }}</li>
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
            <div class="row mt-3">

                <div class="col-lg-6 offset-lg-3">
                    <div class="card mb-3">
                        <img src="{{ asset($ad->image) }}" class="card-img-top" alt="{{ $ad->title }}">
                        <div class="card-body">
                            <form method="POST" action="{{ route('ads.update', $ad->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- Image Upload for photos Gallery --}}

                                <div class="mt-3">

                                    <div>
                                        <label class='form-label' for="url">Ads Url</label>
                                        <input id="url" class="form-control" type="text" name="url"
                                            autocomplete="off" value="{{ old('url', $ad->url) }}">

                                        @error('url')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="mt-3">
                                        <label class='form-label' for="image">Image</label>
                                        <input type="file" name="image" id="image" class="form-control"
                                            autocomplete="off" value="{{ old('image') }}">

                                        @error('image')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-4">
                                        <label><strong>Ad Positions:</strong></label>

                                        <div class="row g-3 mt-3"> <!-- g-3 adds gap between columns -->
                                            <!-- Front Page Ads (728x90) -->
                                            <div class="col-md-6">
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="front_top_banner"
                                                        id="front_top_banner" value="1"
                                                        {{ old('front_top_banner', $ad->front_top_banner) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="front_top_banner">
                                                        Front Top Banner <span class="fs-1">(728x90)</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="front_bottom"
                                                        id="front_bottom" value="1"
                                                        {{ old('front_bottom', $ad->front_bottom) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="front_bottom">
                                                        Front Bottom <span class="fs-1">(728x90)</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- Full News Page Ads -->
                                            <div class="col-md-6">
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="news_left_banner"
                                                        id="news_left_banner" value="1"
                                                        {{ old('news_left_banner', $ad->news_left_banner) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="news_left_banner">
                                                        News Left Banner <span class="fs-1">(300x250)</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="news_3_sidebar"
                                                        id="news_3_sidebar" value="1"
                                                        {{ old('news_3_sidebar', $ad->news_3_sidebar) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="news_3_sidebar">
                                                        News 3 Sidebar <span class="fs-1">(300x250)</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="news_bottom"
                                                        id="news_bottom" value="1"
                                                        {{ old('news_bottom', $ad->news_bottom) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="news_bottom">
                                                        News Bottom <span class="fs-1">(728x90)</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- Category/Subcategory Ads -->
                                            <div class="col-md-6">
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="category_sidebar" id="category_sidebar" value="1"
                                                        {{ old('category_sidebar', $ad->category_sidebar) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="category_sidebar">
                                                        Category Sidebar <span class="fs-1">(300x250)</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="subcategory_sidebar" id="subcategory_sidebar"
                                                        value="1"
                                                        {{ old('subcategory_sidebar', $ad->subcategory_sidebar) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="subcategory_sidebar">
                                                        Subcategory Sidebar <span class="fs-1">(300x250)</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3">

                                        <label class='form-label' for="type">Type</label>
                                        <select class="form-select select2" name="type" id="type"
                                            autocomplete="off">
                                            <option value="">Select Type</option>
                                            <option {{ $ad->type == 1 ? 'selected' : '' }} value="1">Square
                                            </option>
                                            <option {{ $ad->type == 0 ? 'selected' : '' }} value="0">Horizontal
                                            </option>
                                        </select>

                                        @error('type')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mt-3 d-flex align-items-center justify-content-end">
                                    <a class="btn btn-primary" href="{{ route('ads.index') }}">Back</a>
                                    <button type="submit" class="btn btn-primary ms-2">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if (session('ads_updated'))
                        <div class=" alert alert-success mt-3 ">{{ session('ads_updated') }}</div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
