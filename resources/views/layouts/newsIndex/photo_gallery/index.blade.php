@extends('layouts.newsIndex.newsMaster')

@section('content')
    <style>
        .photo-wrapper {
            position: relative;
            overflow: hidden;
            cursor: pointer;
            display: block;
        }

        .photo-wrapper img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
            transition: opacity 0.3s ease;
        }

        @media (max-width: 768px) {
            .photo-wrapper img {
                height: 200px;
            }
        }

        .photo-wrapper:hover img {
            opacity: 0.85;
        }

        .photo-title {
            margin-top: 10px;
            min-height: 50px;
        }

        .title-black {
            color: #333;
            font-size: 15px;
            text-decoration: none;
            display: block;
            line-height: 1.4;
        }

        .title-black:hover {
            color: #1B84FF !important;
            text-decoration: none;
        }

        .photo-item {
            margin-bottom: 30px;
        }
    </style>

    <div class="container">
        <div class="main--content">

            <div class="row">
                <div class="card-title" style="font-size: 1.5rem; color: black; margin-top: 20px; margin-left: 15px">
                    @if (session()->get('lang') == 'english')
                        <h3>Photo Gallery</h3>
                    @else
                        <h3>ফটো গ্যালারি</h3>
                    @endif
                </div>

                {{-- Horizontal line --}}
                <div style="border-bottom: 2px solid #1B84FF; margin-bottom: 15px"></div>
            </div>

            <div class="row" id="photoList">
                @foreach ($photos as $photo)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="photo-item">
                            <a data-fancybox="gallery" href="{{ asset($photo->image) }}" class="photo-wrapper">
                                <img src="{{ asset($photo->image) }}"
                                    alt="{{ session()->get('lang') == 'english' ? $photo->title_en : $photo->title_bn }}">
                                <div class="photo-overlay"></div>
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
            </div>

            {{-- Load More Button --}}
            <div class="text-center">
                <button id="load_more_photos" class="btn btn-primary"
                    style="border-radius: 5px; background-color: #1B84FF; color: white; border: none">Load More</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof $ !== 'undefined') {
                var page = 1;
                $('#load_more_photos').on('click', function() {

                    $(this).prop("disabled", true);
                    $(this).text('Loading...');

                    $.ajax({
                        type: "GET",
                        url: "{{ route('photo.gallery') }}",
                        data: {
                            page: ++page
                        },
                        dataType: "html",
                        success: function(response) {
                            if ($.trim(response) === '') {
                                $('#load_more_photos').hide();
                            } else {
                                $('#photoList').append(response);
                                $("#load_more_photos").prop("disabled", false);
                                $("#load_more_photos").text('Load More');
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
