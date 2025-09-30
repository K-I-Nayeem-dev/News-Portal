@extends('layouts.newsIndex.newsMaster')

@section('content')
    <div class="container" style="padding: 30px 15px;">

        {{-- Tag Header --}}
        <div class="tag-header" style="margin-bottom: 30px; border-bottom: 3px solid #e74c3c; padding-bottom: 15px;">
            <h1 style="font-size: 28px; color: #333; margin: 0;">
                <i class="fa fa-tag" style="color: #e74c3c; margin-right: 10px;"></i>
                {{ $tag ? (session()->get('lang') == 'english' ? $tag->tag_en : $tag->tag_bn) : 'No tag found' }}
            </h1>

            @if ($tag)
                <p style="color: #666; margin-top: 10px; font-size: 14px;">
                    {{ $tagNews->total() }}
                    {{ session()->get('lang') == 'english' ? 'news found' : 'টি খবর পাওয়া গেছে' }}
                </p>
            @endif
        </div>

        {{-- News Grid --}}
        @if ($tagNews->isEmpty())
            <div style="text-align: center; padding: 60px 20px; background: #f8f9fa; border-radius: 8px;">
                <i class="fa fa-inbox" style="font-size: 48px; color: #ccc; margin-bottom: 20px;"></i>
                <p style="font-size: 18px; color: #666;">
                    @if ($tag)
                        {{ session()->get('lang') == 'english' ? 'No news found for this tag' : 'এই ট্যাগের জন্য কোন খবর পাওয়া যায়নি' }}
                    @else
                        {{ session()->get('lang') == 'english' ? 'Tag does not exist' : 'এই ট্যাগটি বিদ্যমান নেই' }}
                    @endif
                </p>
            </div>
        @else
            <div class="news-grid">
                @foreach ($tagNews as $news)
                    <a href="{{ route('showFull.news', ['category' => $news->newsCategory->slug ?? '', 'subcategory' => $news->newsSubcategory->slug ?? '', 'id' => $news->id]) }}"
                        class="news-card-link">
                        <div class="news-card">
                            <img src="{{ $news->thumbnail ? asset($news->thumbnail) : 'https://via.placeholder.com/640x480.png/00ff11?text=news+dolores' }}"
                                alt="{{ session()->get('lang') == 'english' ? $news->title_en : $news->title_bn }}">
                            <div class="news-content">
                                @if ($news->newsCategory)
                                    <span class="news-category">
                                        {{ session()->get('lang') == 'english' ? $news->newsCategory->category_en : $news->newsCategory->category_bn }}
                                    </span>
                                @endif
                                <h3>{{ session()->get('lang') == 'english' ? Str::limit($news->title_en, 60) : Str::limit($news->title_bn, 60) }}
                                </h3>
                                <p><i class="fa fa-calendar"></i> {{ $news->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div style="margin-top: 30px;">
                {{ $tagNews->links() }}
            </div>
        @endif

    </div>

    {{-- Responsive CSS --}}
    <style>
        /* Grid Setup */
        .news-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .news-card-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .news-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .news-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .news-content {
            padding: 15px;
        }

        .news-category {
            background: #3498db;
            color: white;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 11px;
            display: inline-block;
            margin-bottom: 10px;
        }

        .news-content h3 {
            margin: 0 0 10px 0;
            font-size: 16px;
            line-height: 1.4;
        }

        .news-content p {
            color: #666;
            font-size: 13px;
            margin: 0;
        }

        /* Responsive: Tablets */
        @media (max-width: 992px) {
            .news-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Responsive: Mobile */
        @media (max-width: 576px) {
            .news-grid {
                grid-template-columns: 1fr;
            }

            .news-card img {
                height: 180px;
            }
        }
    </style>
@endsection
