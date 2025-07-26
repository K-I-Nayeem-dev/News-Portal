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
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none"
                                            href="{{ route('videogallery.index') }}">videos Gallery
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">Edit</li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">{{ $video->id }}</li>
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
            <div class="row mt-3">

                <div class="col-lg-6 offset-lg-3">
                    <div class="card mb-3">
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
                        @if ($videoId)
                            <img width="100%" height="200px" src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                style="cursor: pointer; border-radius: 10px 10px 0 0;" />
                        @else
                            <img src="{{ asset('default-thumb.jpg') }}" class="img-fluid rounded" />
                        @endif
                        <div class="card-body">
                            <form method="POST" action="{{ route('videogallery.update', $video->id) }}">
                                @csrf
                                @method('PUT')

                                {{-- Image Upload for videos Gallery --}}
                                <div class="mt-3">

                                    <div>
                                        <label class='form-label' for="title">Title</label>
                                        <input id="title" class="form-control" type="text" name="title"
                                            autocomplete="off" value="{{ old('title', $video->title) }}">

                                        @error('title_en')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label class='form-label' for="image">Embed Code</label>
                                        <textarea class="form-control" name="embed_code" id="image" cols="30" rows="10" autocomplete="off"">{{ old('embed_code',$video->embed_code) }}</textarea>

                                        @error('embed_code')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">

                                        <label class='form-label' for="type">Type</label>
                                        <select class="form-select select2" name="type" id="type"
                                            autocomplete="off">
                                            <option value="">Select Type</option>
                                            <option {{ $video->type == 1 ? 'selected' : '' }} value="1">Big video
                                            </option>
                                            <option {{ $video->type == 0 ? 'selected' : '' }} value="0">Small video
                                            </option>
                                        </select>

                                        @error('type')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-3 d-flex align-items-center justify-content-end">
                                    <a class="btn btn-primary" href="{{ route('videogallery.index') }}">Back</a>
                                    <button type="submit" class="btn btn-primary ms-2">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if (session('video_update'))
                        <div class=" alert alert-success mt-3 ">{{ session('video_update') }}</div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
