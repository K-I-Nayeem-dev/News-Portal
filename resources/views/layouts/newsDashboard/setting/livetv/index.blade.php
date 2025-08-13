@extends('layouts.newsDashboard.dashboard')

@section('dashboard')
    {{-- Code for Responsive iframe livetv --}}
    <style>
        .responsive-iframe-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            /* 16:9 Aspect Ratio */
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
    </style>

    <div class="body-wrapper">
        <div class="container-fluid">
            <!-- -------------------------------------------------------------- -->
            <!-- Breadcrumb -->
            <!-- -------------------------------------------------------------- -->
            <div class="font-weight-medium shadow-none position-relative overflow-hidden mb-7">
                <div class="card-body px-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-medium  mb-0">Dashboard</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">Live TV Settings</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- -------------------------------------------------------------- -->
            <!-- Breadcrumb End -->
            <!-- -------------------------------------------------------------- -->
            <!-- Row -->
            <div class="row g-3">
                <div class="col-12 col-lg-6 mt-3">
                    <div class="card">
                        <h5 class="card-header text-white" style="background-color: #1B84FF">Live TV</h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('liveTv.udpate', $liveTv->id) }}">
                                @csrf
                                @method('PUT')

                                <div>
                                    <label for="embed_code"
                                        class="form-label d-flex justify-content-between align-items-center">
                                        <span>Embed Code</span>
                                        @if ($liveTv->status == 1)
                                            <span>
                                                <code class="text-danger">Want to </code>
                                                <a href="{{ route('liveTv.deactive', $liveTv->id) }}"
                                                    class="btn btn-danger">Deactive</a>
                                            </span>
                                        @else
                                            <span>
                                                <code class="text-success">Want to </code>
                                                <a href="{{ route('liveTV.active', $liveTv->id) }}"
                                                    class="btn btn-success">Active</a>
                                            </span>
                                        @endif
                                    </label>
                                    <div>
                                        <textarea class="form-control mb-2" name="embed_code" id="embed_code" cols="30" rows="10">{{ old('embed_code', $liveTv->embed_code) }}</textarea>
                                        @if ($liveTv->status == 1)
                                            <code class="text-success fs-3">Live TV is now available for streaming.</code>
                                        @else
                                            <code class="text-danger fs-3">Live TV is temporarily unavailable</code>
                                        @endif
                                    </div>
                                </div>

                                <button style="background-color: #1B84FF" class="btn text-white mt-3 w-100">Update</button>
                            </form>
                        </div>
                    </div>

                    @if (session('liveTV_update'))
                        <div class="alert alert-success mt-3">{{ session('liveTV_update') }}</div>
                    @endif
                </div>

                <div class="col-12 col-lg-6 mt-3">
                    <div class="card ">
                        <h5 class="card-header text-white" style="background-color: #1B84FF">Live TV Watch</h5>
                        <div class="card-body  p-0 p-md-3">
                            @if ($liveTv->embed_code && $liveTv->status == 1)
                                <div class="responsive-iframe-container"
                                    style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                                    {!! $liveTv->embed_code !!}
                                </div>
                            @else
                                <p class="text-center alert alert-danger">Live TV Deactive</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection
