@extends('layouts.newsIndex.newsMaster')

@section('styles')
    <style>
        @media (max-width: 768px) {
            .news-tag {
                display: none !important;
            }

            .news-item {
                flex-direction: column;
            }

            .news-image {
                width: 100% !important;
                height: 200px !important;
                margin-right: 0 !important;
                margin-bottom: 15px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container" style="padding: 30px 15px;">
        <div class="search-results">

            {{-- Header --}}
            <div class="search-header" style="margin-bottom: 30px; border-bottom: 2px solid #e0e0e0; padding-bottom: 15px;">
                <h2 style="font-size: 28px; font-weight: 600; color: #333; margin-bottom: 10px;">
                    @if (session()->get('lang') == 'english')
                        Search Results for "{{ $query }}"
                    @else
                        "{{ $query }}" এর জন্য অনুসন্ধান ফলাফল
                    @endif
                </h2>
                <p style="color: #666; font-size: 16px;">
                    @if (session()->get('lang') == 'english')
                        Found {{ $news->total() }} results
                    @else
                        {{ $news->total() }} টি ফলাফল পাওয়া গেছে
                    @endif
                </p>
            </div>

            {{-- News List --}}
            @if ($news->count() > 0)
                <ul class="news-list" style="list-style: none; padding: 0; margin: 0;">
                    @foreach ($news as $item)
                        <li class="news-item"
                            style="display: flex; margin-bottom: 30px; padding-bottom: 30px; border-bottom: 1px solid #e5e5e5;">

                            {{-- Image --}}
                            <div class="news-image"
                                style="flex-shrink: 0; width: 280px; height: 180px; overflow: hidden; border-radius: 8px; margin-right: 25px;">
                                <a
                                    href="{{ route('showFull.news', [
                                        'category' => $item->newsCategory->slug ?? 'news',
                                        'subcategory' => $item->newsSubCategory->slug ?? '',
                                        'id' => $item->id,
                                    ]) }}">
                                    @php
                                        $isPlaceholder = Str::contains($item->thumbnail ?? '', 'via.placeholder.com');
                                        $imageToShow =
                                            !$isPlaceholder && !empty($item->thumbnail)
                                                ? $item->thumbnail
                                                : asset('uploads/default_images/deafult_thumbnail.jpg');
                                    @endphp

                                    <img src="{{ asset($imageToShow) }}"
                                        alt="@if (session()->get('lang') == 'english') {{ $item->title_en ?? 'News' }}@else{{ $item->title_bn ?? 'সংবাদ' }} @endif"
                                        style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;"
                                        onmouseover="this.style.transform='scale(1.05)'"
                                        onmouseout="this.style.transform='scale(1)'">
                                </a>
                            </div>

                            {{-- Content --}}
                            <div class="news-content" style="flex: 1; display: flex; flex-direction: column;">
                                <div class="news-top">
                                    {{-- Title --}}
                                    <h3 style="margin: 0 0 10px 0; font-size: 22px; font-weight: 600; line-height: 1.4;">
                                        <a href="{{ route('showFull.news', [
                                            'category' => $item->newsCategory->slug ?? 'news',
                                            'subcategory' => $item->newsSubCategory->slug ?? '',
                                            'id' => $item->id,
                                        ]) }}"
                                            style="color: #222; text-decoration: none; transition: color 0.3s ease;"
                                            onmouseover="this.style.color='#e74c3c'" onmouseout="this.style.color='#222'">
                                            @if (session()->get('lang') == 'english')
                                                {{ $item->title_en ?? 'No Title' }}
                                            @else
                                                {{ $item->title_bn ?? 'শিরোনাম নেই' }}
                                            @endif
                                        </a>
                                    </h3>

                                    {{-- Subtitle --}}
                                    @if (session()->get('lang') == 'english' && $item->title_bn)
                                        <h4 style="margin: 0 0 15px 0; font-size: 18px; font-weight: 500; color: #555;">
                                            {{ $item->title_bn }}
                                        </h4>
                                    @elseif(session()->get('lang') == 'bangla' && $item->title_en)
                                        <h4 style="margin: 0 0 15px 0; font-size: 18px; font-weight: 500; color: #555;">
                                            {{ $item->title_en }}
                                        </h4>
                                    @endif

                                    {{-- Meta --}}
                                    <div class="news-meta"
                                        style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px; flex-wrap: wrap;">
                                        @if ($item->newsCategory)
                                            <span
                                                style="background: #3498db; color: white; padding: 4px 12px; border-radius: 15px; font-size: 13px; font-weight: 500;">
                                                @if (session()->get('lang') == 'english')
                                                    {{ $item->newsCategory->category_en ?? 'Category' }}
                                                @else
                                                    {{ $item->newsCategory->category_bn ?? 'বিভাগ' }}
                                                @endif
                                            </span>
                                        @endif

                                        @if ($item->newsSubCategory)
                                            <span
                                                style="background: #95a5a6; color: white; padding: 4px 12px; border-radius: 15px; font-size: 13px; font-weight: 500;">
                                                @if (session()->get('lang') == 'english')
                                                    {{ $item->newsSubCategory->sub_cate_en ?? 'Subcategory' }}
                                                @else
                                                    {{ $item->newsSubCategory->sub_cate_bn ?? 'উপ-বিভাগ' }}
                                                @endif
                                            </span>
                                        @endif

                                        <span style="color: #999; font-size: 14px;">
                                            <i class="fa fa-clock-o" style="margin-right: 5px;"></i>
                                            {{ $item->created_at->format('d M Y') }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Description --}}
                                <div class="news-bottom" style="margin-top: auto;">
                                    <p style="margin: 0 0 15px 0; color: #666; font-size: 15px; line-height: 1.6;">
                                        @if (session()->get('lang') == 'english')
                                            {{ Str::limit(strip_tags($item->details_en ?? ''), 180) }}
                                        @else
                                            {{ Str::limit(strip_tags($item->details_bn ?? ''), 180) }}
                                        @endif
                                    </p>

                                    {{-- Tags --}}
                                    @if ($item->tags->count() > 0)
                                        <div class="tags" style="display: flex; gap: 8px; flex-wrap: wrap;">
                                            @foreach ($item->tags as $tag)
                                                <span class="news-tag"
                                                    style="background: #f8f9fa; color: #555; padding: 3px 10px; border-radius: 12px; font-size: 12px; border: 1px solid #e0e0e0;">
                                                    <i class="fa fa-tag" style="margin-right: 4px; font-size: 11px;"></i>
                                                    @if (session()->get('lang') == 'english')
                                                        {{ $tag->tag_en ?? 'Tag' }}
                                                    @else
                                                        {{ $tag->tag_bn ?? 'ট্যাগ' }}
                                                    @endif
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

                {{-- Pagination --}}
                <div style="display: flex; justify-content: center; margin-top: 40px;">
                    {{ $news->appends(['q' => $query])->links() }}
                </div>
            @else
                {{-- No Results --}}
                <div style="background: #e3f2fd; border-left: 4px solid #2196f3; padding: 20px 25px; border-radius: 6px;">
                    <h4 style="margin: 0 0 10px 0; color: #1976d2; font-size: 20px;">
                        @if (session()->get('lang') == 'english')
                            No results found
                        @else
                            কোন ফলাফল পাওয়া যায়নি
                        @endif
                    </h4>
                    <p style="margin: 0; color: #555; font-size: 15px;">
                        @if (session()->get('lang') == 'english')
                            Try different keywords or browse our
                            <a href="{{ route('home') }}" style="color: #2196f3; text-decoration: none; font-weight: 500;">
                                latest news
                            </a>
                        @else
                            বিভিন্ন কীওয়ার্ড চেষ্টা করুন অথবা আমাদের
                            <a href="{{ route('home') }}" style="color: #2196f3; text-decoration: none; font-weight: 500;">
                                সর্বশেষ সংবাদ
                            </a> ব্রাউজ করুন
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection
