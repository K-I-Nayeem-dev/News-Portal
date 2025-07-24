@extends('layouts.newsDashboard.dashboard')

@section('dashboard')
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
            <div class="row">
                <div class="d-flex justify-content-between">
                    <div class="col-lg-6 mt-3 pe-2">
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
                                                <code class="text-danger">Want to </code><a href="{{ route('liveTv.deactive', $liveTv->id) }}" class="btn btn-danger">Deactive</a>
                                            </span>
                                            @else
                                            <span>
                                                <code class="text-success">Want to </code><a href="{{ route('liveTV.active', $liveTv->id) }}" class="btn btn-success">Active</a>
                                            </span>
                                            @endif
                                        </label>
                                        <div>
                                            <textarea class="form-control mb-2" name="embed_code" id="embed_code" cols="30" rows="10">{{ old('embed_code', $liveTv->embed_code) }}</textarea>
                                            @if ($liveTv->status == 1)
                                                <code class="text-success fs-3">Live TV is now available for
                                                    streaming.</code>
                                            @else
                                                <code class="text-danger fs-3">Live TV is temporarily unavailable</code>
                                            @endif
                                        </div>
                                    </div>

                                    <button style="background-color: #1B84FF"
                                        class="btn text-white mt-3 w-100">Update</button>

                                </form>
                            </div>
                        </div>

                        @if (session('liveTV_update'))
                            <div class=" alert alert-success mt-3 ">{{ session('liveTV_update') }}</div>
                        @endif

                    </div>
                    <div class="col-lg-6 mt-3 pe-2">
                        <div class="card">
                            <h5 class="card-header text-white" style="background-color: #1B84FF">Live TV Watch</h5>
                            <div class="card-body">
                                @if ($liveTv->embed_code && $liveTv->status == 1)
                                    {!! $liveTv->embed_code !!}
                                @else
                                    <p class="text-center alert alert-danger">Live Tv Deactive</p>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
