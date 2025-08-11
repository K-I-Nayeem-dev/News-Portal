@foreach ($ascn as $row)
    <div class="col-md-3">
        <div class="col-md-12 col-xs-6 col-xxs-12">
            <div>
                <div class="post--img">
                    <a href="news-single-v1.html" class="thumb">
                        <a href="news-single-v1.html" class="thumb">
                            @php
                                $isPlaceholder = Str::contains($row->thumbnail, 'via.placeholder.com');
                                $imageToShow =
                                    !$isPlaceholder && !empty($row->thumbnail)
                                        ? asset($row->thumbnail)
                                        : asset('uploads/default_images/deafult_thumbnail.jpg');
                            @endphp

                            <img src="{{ $imageToShow }}" alt="{{ $row->title_en }}"class="img-fluid">

                        </a>
                    </a>
                    {{-- <a href="#" class="cat">
                                            @if (session()->get('lang') == 'english')
                                                {{ $row->newsCategory->category_en }}
                                            @else
                                                {{ $row->newsCategory->category_bn }}
                                            @endif
                                        </a> --}}
                    <div class="post--info">
                        <div class="title">
                            <h2 class="h4">
                                <a href="news-single-v1.html" class="btn-link">
                                    @if (session()->get('lang') == 'english')
                                        {{ $row->title_en }}
                                    @else
                                        {{ $row->title_bn }}
                                    @endif
                                </a>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

<div style="display: none">
    {{ $ascn->links() }}
</div>
{{-- fisrt Section 9 News with widget  End --}}
