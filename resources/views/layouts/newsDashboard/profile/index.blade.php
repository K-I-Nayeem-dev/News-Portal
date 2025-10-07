@extends('layouts.newsDashboard.dashboardMaster')
@section('dashboard')
    <style>
        html {
            scroll-behavior: auto !important;
        }
    </style>
    <div class="body-wrapper">
        <div class="container-fluid">
            <div class="font-weight-medium shadow-none position-relative overflow-hidden mb-7">
                <div class="card-body px-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-medium  mb-0">User Profile</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="">Home
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">User Profile</li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">{{ Auth::user()->name }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card overflow-hidden">
                <div class="card-body pb-1">
                    <img src="{{ asset('dashboard_assets') }}/images/backgrounds/profilebg.jpg" alt="materialpro-img"
                        class="img-fluid">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-lg-4 mt-n3 order-lg-2 order-1">
                            <div class="mt-n5">
                                <div class="d-flex align-items-center justify-content-center mb-2">
                                    <div class="d-flex align-items-center justify-content-center round-110">
                                        <div
                                            class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden round-100">
                                            @if (!Auth::user()->profile_picture)
                                                <img src="{{ asset('dashboard_assets') }}/images/profile/user-1.jpg"
                                                    alt="materialpro-img" class="img-fluid rounded-circle" width="120"
                                                    height="120">
                                            @else
                                                <img style="border-radius: 50%" width="120" height="120"
                                                    src="{{ asset('uploads/profile_pictures/' . Auth::user()->profile_picture) }}"
                                                    alt="{{ Auth::user()->name }}">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center align-items-center">
                                    <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                                    <span
                                        style="font-size: 12px; margin-left: 5px">({{ ucfirst(Auth::user()->roles->pluck('name')->implode(', ')) }})</span>
                                </div>
                                <div class="d-flex justify-content-center align-items-center">
                                    <p class="text-muted py-2">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Published News Section -->
            <div class="container mt-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0 fw-semibold">আমার প্রকাশিত সংবাদ</h5>
                    <span class="badge bg-primary rounded-pill">{{ $publishedNews->total() }} টি সংবাদ</span>
                </div>

                @if ($publishedNews->count() > 0)
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                        @foreach ($publishedNews as $news)
                            <div class="col">
                                <div class="card h-100 shadow-sm border-0">
                                    <!-- Image -->
                                    <div class="position-relative overflow-hidden" style="height: 200px;">
                                        @php
                                            $isPlaceholder = Str::contains(
                                                $news->thumbnail ?? '',
                                                'via.placeholder.com',
                                            );
                                            $imageToShow =
                                                !$isPlaceholder && !empty($news->thumbnail)
                                                    ? $news->thumbnail
                                                    : asset('uploads/default_images/deafult_thumbnail.jpg');
                                        @endphp

                                        <a href="{{ route('showFull.news', [
                                            'category' => optional($news->newsCategory)->slug ?? 'news',
                                            'subcategory' => optional($news->newsSubcategory)->slug ?? 'general',
                                            'id' => $news->id ?? 0,
                                        ]) }}"
                                            class="thumb">
                                            <img src="{{ $imageToShow }}" alt="{{ $news->title_en ?? 'News' }}"
                                                class="card-img-top w-100 h-100 object-fit-cover" loading="lazy">
                                        </a>
                                    </div>

                                    <div class="card-body d-flex flex-column">
                                        <!-- Category & Subcategory -->
                                        <div class="mb-2">
                                            <span class="badge bg-primary text-white small">
                                                {{ $news->newsCategory->category_bn ?? 'N/A' }}
                                            </span>
                                            @if ($news->newsSubcategory)
                                                <span class="badge bg-light text-primary border border-primary small ms-1">
                                                    {{ $news->newsSubcategory->sub_cate_bn }}
                                                </span>
                                            @endif
                                        </div>

                                        <!-- Title -->
                                        <h6 class="card-title fw-semibold lh-base mb-2 flex-grow-1"
                                            style="font-size: 14px;">
                                            {{ Str::limit($news->title_bn, 65) }}
                                        </h6>

                                        <!-- Time -->
                                        <div class="d-flex align-items-center text-muted mb-3 small">
                                            <i class="fa-regular fa-clock me-1"></i>
                                            <span>{{ $news->created_at->diffForHumans() }}</span>
                                        </div>

                                        <!-- Actions -->
                                        <div class="d-flex gap-2 pt-2 border-top mt-auto">
                                            <a href="{{ route('news_bn', $news->id) }}"
                                                class="btn btn-sm btn-outline-primary flex-fill">
                                                <i class="fa-regular fa-eye"></i> দেখুন
                                            </a>
                                            <a href="{{ route('dashboard_news.edit', $news->id) }}"
                                                class="btn btn-sm btn-outline-secondary flex-fill">
                                                <i class="fa-regular fa-pen-to-square"></i> সম্পাদনা
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $publishedNews->links('pagination::bootstrap-5') }}
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="card shadow-sm">
                        <div class="card-body text-center py-5">
                            <i class="fa-solid fa-newspaper fa-5x text-muted mb-3"></i>
                            <h5 class="text-muted mb-2 fw-semibold">কোনো সংবাদ প্রকাশিত হয়নি</h5>
                            <p class="text-muted mb-3">আপনার প্রথম সংবাদ প্রকাশ করুন!</p>
                            <a href="{{ route('dashboard_news.create') }}" class="btn btn-primary">
                                <i class="fa-solid fa-plus me-1"></i> নতুন সংবাদ যোগ করুন
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
