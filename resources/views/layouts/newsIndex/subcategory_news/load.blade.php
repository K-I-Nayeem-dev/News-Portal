@foreach ($ascn as $row)
    <div>
        <div class="post--img">
            <a href="{{ route('showFull.news', array_filter(['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id])) }}"
                class="thumb">
                @php
                    $isPlaceholder = Str::contains($row->thumbnail, 'via.placeholder.com');
                    $imageToShow =
                        !$isPlaceholder && !empty($row->thumbnail)
                            ? asset($row->thumbnail)
                            : asset('uploads/default_images/deafult_thumbnail.jpg');
                @endphp
                <img src="{{ $imageToShow }}" alt="{{ $row->title_en }}">
            </a>
            <div class="post--info">
                <div class="title">
                    <h2>
                        <a
                            href="{{ route('showFull.news', array_filter(['category' => $row->newsCategory->slug, 'subcategory' => $row->newsSubcategory->slug, 'id' => $row->id])) }}">
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
@endforeach
