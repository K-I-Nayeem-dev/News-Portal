@foreach ($photos as $photo)
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="photo-item">
            <a data-fancybox="gallery" href="{{ asset($photo->image) }}" class="photo-wrapper">
                <img src="{{ asset($photo->image) }}"
                    alt="{{ session()->get('lang') == 'english' ? $photo->title_en : $photo->title_bn }}">
            </a>

            <div class="photo-title">
                @if (session()->get('lang') == 'english')
                    <a data-fancybox="gallery" href="{{ asset($photo->image) }}"
                        class="title-black">{{ \Illuminate\Support\Str::limit($photo->title_en, 40) }}</a>
                @else
                    <a data-fancybox="gallery" href="{{ asset($photo->image) }}"
                        class="title-black">{{ \Illuminate\Support\Str::limit($photo->title_bn, 40) }}</a>
                @endif
            </div>
        </div>
    </div>
@endforeach
