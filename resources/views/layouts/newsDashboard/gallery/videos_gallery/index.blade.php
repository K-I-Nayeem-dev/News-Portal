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
                                    <li class="breadcrumb-item text-muted" aria-current="page">Video Gallery</li>
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
                <div class="mb-3">
                    <div class="d-flex justify-content-end">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#videoGallery">
                            Add Video
                        </button>
                    </div>

                    @if (session('photo_delete'))
                        <div class=" alert alert-danger mt-3 text-center">{{ session('photo_delete') }}</div>
                    @endif

                    <!-- Modal -->
                    <div class="modal fade" id="videoGallery" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Video To Gallery</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('videogallery.store') }}">
                                        @csrf

                                        {{-- Image Upload for photos Gallery --}}
                                        <div class="mt-3">

                                            <div>
                                                <label class='form-label' for="title_en">Title English<sup><code
                                                            style="font-size: 12px">*</code></sup></label>
                                                <input id="title_en" class="form-control" type="text" name="title_en"
                                                    autocomplete="off" value="{{ old('title_en') }}">

                                                @error('title_en')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="mt-3">
                                                <label class='form-label' for="title_bn">Title Bangla<sup><code
                                                            style="font-size: 12px">*</code></sup></label>
                                                <input id="title_bn" class="form-control" type="text" name="title_bn"
                                                    autocomplete="off" value="{{ old('title_bn') }}">

                                                @error('title_bn')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="mt-3">
                                                <label class='form-label' for="image">Embed Code</label>
                                                <textarea class="form-control" name="embed_code" id="image" cols="30" rows="10" autocomplete="off"">{{ old('embed_code') }}</textarea>

                                                @error('embed_code')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="mt-3">
                                                <label class='form-label' for="type">Type<sup><code
                                                            style="font-size: 12px">*</code></sup></label>

                                                <select class="form-select select2" name="type" id="type"
                                                    autocomplete="off">
                                                    <option value="">Select Type</option>
                                                    <option value="1">Big Video</option>
                                                    <option value="0">Small Video</option>
                                                </select>
                                            </div>


                                        </div>
                                        <div class="mt-3 d-flex justify-content-end">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary ms-2">Upload</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row g-3">
                    @forelse ($videos as $video)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card h-100">
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
                                    <a data-fancybox href="{{ $iframeSrc }}" class="position-relative d-block">
                                        @if ($videoId)
                                            <div class="video-thumb-wrapper position-relative"
                                                style="padding-top: 56.25%; overflow: hidden; border-radius: 10px 10px 0 0;">
                                                <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                                    class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"
                                                    alt="{{ $video->title_en }}" style="cursor: pointer;">
                                                <!-- Play button overlay -->
                                                <div class="position-absolute top-50 start-50 translate-middle bg-dark bg-opacity-50 rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 60px; height: 60px;">
                                                    <i class="fa fa-play text-white fs-4"></i>
                                                </div>
                                            </div>
                                        @else
                                            <img src="{{ asset('default-thumb.jpg') }}" class="img-fluid rounded"
                                                alt="{{ $video->title_en }}">
                                        @endif
                                    </a>
                                @endif

                                <div class="card-body d-flex flex-column">
                                    <p class="card-text text-truncate mb-2">{{ $video->title_en }}</p>
                                    <p class="badge {{ $video->type == 1 ? 'bg-info' : 'bg-primary' }}">
                                        {{ $video->type == 1 ? 'Big Video' : 'Small Video' }}
                                    </p>

                                    <div class="mt-auto d-flex gap-2">
                                        <!-- Edit Button -->
                                        <a class="btn btn-primary btn-sm flex-fill"
                                            href="{{ route('videogallery.edit', $video->id) }}">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>

                                        <!-- Delete Button Form -->
                                        <form method="POST" action="{{ route('videogallery.destroy', $video->id) }}"
                                            onsubmit="return confirm('Are you sure you want to delete: {{ addslashes($video->title_en) }}?');"
                                            class="flex-fill">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm w-100">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="alert alert-danger">No Video Found</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination links -->
                <div class="mt-3">
                    {{ $videos->links('pagination::bootstrap-5') }}
                </div>

                @if (session('video_uploaded'))
                    <div class=" alert alert-success mt-3 ">{{ session('video_uploaded') }}</div>
                @endif
                @if (session('video_delete'))
                    <div class=" alert alert-success mt-3 ">{{ session('video_delete') }}</div>
                @endif
            </div>
        </div>
    </div>
@endsection
