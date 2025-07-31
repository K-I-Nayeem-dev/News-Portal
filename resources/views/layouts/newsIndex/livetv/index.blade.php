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

        @keyframes pulsee-animation {
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
    </style>\

    <div class="container">
        <div class="main--content">
            <div class="row">
                <div class="main--content col-md-8 col-sm-7">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                @if (session()->get('lang') == 'bangla')
                                    <h3 style="color: black" class="pulsee">লাইভ টিভি</h3>
                                @else
                                    <h3 style="color: black" class="pulsee">Live TV</h3>
                                @endif
                            </div>
                            <div style="border-bottom: 2px solid #1B84FF; margin-bottom: 15px"></div>
                            <div class="responsive-iframe-container">
                                {!! $liveTv->embed_code !!}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- this section is for Add --}}
                <div class="main--sidebar col-md-4 col-sm-5 ptop--30 pbottom--30" style="margin-top: 21px;">
                    <div class="sticky-content-inner">
                        <div class="widget">
                            <div class="ad--widget">
                                <a href="#">
                                    <img src="{{ asset('frontend_assets') }}/img/ads-img/ad-300x250-1.jpg" alt="" />
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="sticky-content-inner">
                        <div class="widget">
                            <div class="ad--widget">
                                <a href="#">
                                    <img src="{{ asset('frontend_assets') }}/img/ads-img/ad-300x250-1.jpg" alt="" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
