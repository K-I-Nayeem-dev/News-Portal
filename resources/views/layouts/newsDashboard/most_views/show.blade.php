<div class="news-detail p-4">
    <h4 class="mb-3">{{ $news->title_bn }}</h4>

    <div class="news-meta mb-3 d-flex flex-wrap gap-2">
        <span class="badge badge-category">
            <i class="fa fa-folder-open me-1"></i>
            {{ $news->newsCategory->category_bn ?? 'No Category' }}
        </span>

        <span class="badge badge-subcategory">
            <i class="fa fa-tags me-1"></i>
            {{ $news->newsSubCategory->sub_cate_bn ?? 'No Subcategory' }}
        </span>

        <span class="badge badge-author">
            <i class="fa fa-user me-1"></i>
            {{ $news->newsUser->name ?? 'No User' }}
        </span>

        <span class="badge badge-date">
            <i class="fa fa-calendar-alt me-1"></i>
            {{ $news->created_at->format('d M Y H:i') }}
        </span>
    </div>

    <hr>

    <div class="news-content">
        {!! $news->details_bn !!}
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

    /* Meta badges container */
    .news-detail .news-meta {
        font-size: 0.9rem;
    }

    /* Common badge style */
    .news-detail .news-meta .badge {
        display: flex;
        align-items: center;
        gap: 4px;
        padding: 0.4em 0.65em;
        border-radius: 5px;
        font-weight: 500;
    }

    /* Individual colors */
    .news-detail .badge-category {
        background-color: #007bff;
        color: #fff;
    }

    .news-detail .badge-subcategory {
        background-color: #6c757d;
        color: #fff;
    }

    .news-detail .badge-author {
        background-color: #17a2b8;
        color: #fff;
    }

    .news-detail .badge-date {
        background-color: #ffc107;
        color: #212529;
    }

    /* News content */
    .news-detail .news-content {
        line-height: 1.8;
        font-size: 1rem;
        color: #333;
        margin-top: 1rem;
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
        margin: 1rem 0;
    }
</style>
