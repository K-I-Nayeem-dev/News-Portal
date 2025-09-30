@extends('layouts.newsIndex.newsMaster')

@section('content')
    {{-- Code for Responsive iframe livetv --}}
    <style>
        .responsive-iframe-container {
            position: relative;
            width: 100%;
            padding-bottom: 78.95%;
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

        .pulsee {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            color: black;
        }

        .pulsee::before {
            content: "";
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 15px;
            background-color: red;
            display: inline-block;
            animation: pulse-animation 1.5s infinite;
        }

        @keyframes pulse-animation {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 0, 0, 0.7);
            }
            70% {
                box-shadow: 0 0 0 8px rgba(255, 0, 0, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(255, 0, 0, 0);
            }
        }
    </style>

    <div class="container">
        <div class="main--content">
            <div class="row">
                <div class="main--content col-md-8 col-sm-7">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                @if (session()->get('lang') == 'english')
                                    <h3 style="color: black" class="pulsee">Live TV</h3>
                                @else
                                    <h3 style="color: black" class="pulsee">লাইভ টিভি</h3>
                                @endif
                            </div>
                            <div style="border-bottom: 2px solid #1B84FF; margin-bottom: 15px"></div>

                            @if(!empty($liveTv?->embed_code))
                                <div class="responsive-iframe-container">
                                    {!! $liveTv->embed_code !!}
                                </div>
                            @else
                                <p style="color: red;">No Live TV available currently.</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Sidebar Ads --}}
                <div class="main--sidebar col-md-4 col-sm-5 ptop--30 pbottom--30" style="margin-top: 21px;">
                    @foreach ([$ls1, $ls2] as $ad)
                        @if(!empty($ad?->id) && file_exists(public_path($ad?->image ?? '')))
                            <div class="sticky-content-inner" style="margin-top: 20px !important">
                                <div class="widget">
                                    <a href="{{ route('ads.trackClick', $ad->id) }}" target="_blank">
                                        <div class="ad--widget">
                                            <img src="{{ asset($ad->image) }}" alt="{{ $ad->title_en ?? 'Advertisement' }}" />
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="sticky-content-inner" style="margin-top: 20px !important">
                                <div class="widget">
                                    <div class="ad--widget">
                                        <img src="{{ asset('frontend_assets/img/ads-img/ad-300x250-1.jpg') }}" alt="Advertisement" />
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Bottom Ad --}}
            <div class="row">
                <div class="col-md-12 pbottom--30">
                    <div class="widget">
                        @if(!empty($lb?->id) && file_exists(public_path($lb?->image ?? '')))
                            <a href="{{ route('ads.trackClick', $lb->id) }}" target="_blank">
                                <div class="ad--widget">
                                    <img src="{{ asset($lb->image) }}" alt="{{ $lb->title_en ?? 'Advertisement' }}" />
                                </div>
                            </a>
                        @else
                            <div class="ad--widget">
                                <img src="{{ asset('frontend_assets/img/ads-img/ad-300x250-1.jpg') }}" alt="Advertisement" />
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
