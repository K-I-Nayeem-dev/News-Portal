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
                    @if (session()->get('lang') == 'english')
                        <h3>Video Gallery</h3>
                    @else
                        <h3>ভিডিও গ্যালারি</h3>
                    @endif
                </div>

                {{-- Horizontal line  --}}
                <div style="border-bottom: 2px solid #1B84FF; margin-bottom: 15px"></div>
            </div>

            <div class="row" id="postList">
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
                                @if (session()->get('lang') == 'english')
                                    <a data-fancybox data-type="iframe" href="{{ $iframeSrc }}"
                                        class="card-link title-black"
                                        style="color: black; font-size: 18px;">{{ \Illuminate\Support\Str::limit($video->title_en, 38) }}</a>
                                @else
                                    <a data-fancybox data-type="iframe" href="{{ $iframeSrc }}"
                                        class="card-link title-black"
                                        style="color: black; font-size: 18px;">{{ \Illuminate\Support\Str::limit($video->title_bn, 38) }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            {{-- For Ajax Lazy Load Button  --}}
            <div class="text-center">
                <button id="load_more_data" class="btn btn-primary"
                    style="border-radius: 5px; background-color: #1B84FF; color: white; border: none">Load More</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof $ !== 'undefined') {
                // Now safe to use jQuery
                var page = 1;
                $('#load_more_data').on('click', function() {

                    $(this).prop("disabled", true);
                    $(this).text('Loading...');

                    $.ajax({
                        type: "GET",
                        url: "{{ route('video.gallery') }}",
                        data: {
                            page: ++page
                        },
                        dataType: "html",
                        success: function(response) {
                            if ($.trim(response) === '') {
                                $('#load_more_data')
                            .hide(); // ← Only change: hide when no more data
                            } else {
                                $('#postList').append(response);
                                $("#load_more_data").prop("disabled", false);
                                $("#load_more_data").text('Load More');
                            }
                        }
                    })
                });

            } else {
                console.error('jQuery is still undefined');
            }
        });
    </script>
@endsection
