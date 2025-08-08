@foreach ($videos as $video)
    <div class="col-lg-3">
        <div class="card" style="margin-top: 35px !important">
            @php
                preg_match('/src="([^"]+)"/', $video->embed_code, $matches);
                $iframeSrc = $matches[1] ?? null;
                $videoId = null;
                if ($iframeSrc && Str::contains($iframeSrc, 'youtube.com')) {
                    preg_match('/embed\/([^\?&"]+)/', $iframeSrc, $idMatch);
                    $videoId = $idMatch[1] ?? null;
                }
            @endphp

            @if ($iframeSrc)
                <a data-fancybox data-type="iframe" href="{{ $iframeSrc }}" class="video-wrapper">
                    @if ($videoId)
                        <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg" alt="Video Thumbnail">
                    @else
                        <img src="{{ asset('default-thumb.jpg') }}" alt="Default Thumbnail">
                    @endif
                    <div class="play-overlay">
                        <i class="fa fa-play" style="font-size: 24px; color: white !important"></i>
                    </div>
                </a>
            @endif

            <div class="card-body" style="margin-top: 10px !important;">
                @if (session()->get('lang') == 'english')
                    <a data-fancybox data-type="iframe" href="{{ $iframeSrc }}" class="card-link title-black"
                        style="color: black; font-size: 18px;">{{ \Illuminate\Support\Str::limit($video->title_en, 38) }}</a>
                @else
                    <a data-fancybox data-type="iframe" href="{{ $iframeSrc }}" class="card-link title-black"
                        style="color: black; font-size: 18px;">{{ \Illuminate\Support\Str::limit($video->title_bn, 38) }}</a>
                @endif
            </div>
        </div>
    </div>
@endforeach
