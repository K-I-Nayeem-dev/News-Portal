@foreach ($videos as $video)
    <div class="col-6 col-sm-4 col-md-3 mt-3">

        {{-- this iframe youtube video with fancybox and with thumbnail --}}
        <div class="card">
            @php
                // Extract iframe src
                preg_match('/src="([^"]+)"/', $video->embed_code, $matches);
                $iframeSrc = $matches[1] ?? null;

                // Try to extract the YouTube video ID
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
                        <i class="fa fa-play text-white" style="font-size: 24px;"></i>
                    </div>
                </a>
            @endif

            <div class="card-body" style="margin-top: 10px !important;">
                <a href="#" class="card-link title-black"
                    style="color: black; font-size: 18px;">{{ \Illuminate\Support\Str::limit($video->title, 38) }}</a>
            </div>
        </div>
    </div>
@endforeach
