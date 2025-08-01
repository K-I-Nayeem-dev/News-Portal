@extends('layouts.newsIndex.newsMaster')

@section('content')
    {{-- Code for Responsive iframe livetv --}}
    <style>
        .responsive-iframe-container {
            position: relative;
            width: 100%;
            padding-bottom: 78.95%;
            /* (600 / 760) * 100 */
            height: 0;
            overflow: hidden;
        }

        .responsive-iframe-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }


        .video-wrapper img {
            width: 100%;
            height: auto;
            display: block;
        }

        .play-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -80%);
            background: rgba(0, 0, 0, 0.6);
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
        }

        .video-wrapper {
            overflow: hidden;
        }

        .card-body {
            min-height: 70px;
            /* keeps all titles aligned */
        }

        .title-black:hover {
            color: red !important;
        }
    </style>

    <div class="container">
        <div class="main--content">
            <div class="row">

                <div class="card-title" style="font-size: 1.5rem; color: black; margin-top: 20px; margin-left: 15px">
                    @if (session()->get('lang') == 'bangla')
                        <h3>ভিডিও গ্যালারি</h3>
                    @else
                        <h3>Video Gallery</h3>
                    @endif
                </div>

                @foreach ($videos as $video)
                    <div class="col-lg-3">
                        {{-- this iframe youtube video with fancybox and with thumbnail --}}
                        <div class="card" style="margin-top: 35px !important">
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
                                        <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                            alt="Video Thumbnail">
                                    @else
                                        <img src="{{ asset('default-thumb.jpg') }}" alt="Default Thumbnail">
                                    @endif

                                    <div class="play-overlay">
                                        <i class="fa fa-play" style="font-size: 24px; color: white !important"></i>
                                    </div>
                                </a>
                            @endif

                            <div class="card-body" style="margin-top: 10px !important;">
                                <a data-fancybox data-type="iframe" href="{{ $iframeSrc }}" class="card-link title-black"
                                    style="color: black; font-size: 18px;">{{ \Illuminate\Support\Str::limit($video->title, 38) }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
