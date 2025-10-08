<div class="news-detail p-4">
    <h4 class="mb-3">{{ $news->title_en }}</h4>

    <div class="mb-3">
        <span class="badge bg-primary me-1">Category: {{ $news->newsCategory->category_en ?? 'No Category' }}</span>
        <span class="badge bg-secondary me-1">Subcategory:
            {{ $news->newsSubcategory->subcategory_en ?? 'No Subcategory' }}</span>
        <span class="badge bg-info text-dark me-1">Author: {{ $news->newsUser->name ?? 'No User' }}</span>
        <span class="badge bg-warning text-dark">Published: {{ $news->created_at->format('d M Y H:i') }}</span>
    </div>

    <hr>

    <div class="news-content" style="line-height: 1.8; font-size: 1rem; color: #333;">
        {!! $news->details_en !!}
    </div>
</div>

<style>
    .news-detail {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    .news-detail h4 {
        font-weight: 700;
        color: #1a1a1a;
    }

    .news-detail .badge {
        font-size: 0.85rem;
        padding: 0.45em 0.75em;
    }

    .news-detail .news-content img {
        max-width: 100%;
        height: auto;
        margin-bottom: 15px;
        border-radius: 5px;
    }

    .news-detail .news-content p {
        margin-bottom: 1rem;
    }

    .news-detail hr {
        border-top: 1px solid #dee2e6;
    }
</style>
