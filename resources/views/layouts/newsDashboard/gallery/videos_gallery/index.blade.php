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
                                    <form method="POST" action="{{ route('photogallery.store') }}">
                                        @csrf

                                        {{-- Image Upload for photos Gallery --}}
                                        <div class="mt-3">

                                            <div>
                                                <label class='form-label' for="title">Title<sup><code style="font-size: 12px">*</code></sup></label>
                                                <input id="title" class="form-control" type="text" name="title"
                                                    autocomplete="off" value="{{ old('title') }}">

                                                @error('title_en')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="mt-3">
                                                <label class='form-label' for="image">Embed Code</label>
                                                <textarea class="form-control" name="embed_code" id="image" cols="30" rows="10">{{ old('embed_code') }}</textarea>

                                                @error('embed_code')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label class='form-label' for="title">Title<sup><code style="font-size: 12px">*</code></sup></label>
                                                <input id="title" class="form-control" type="text" name="title"
                                                    autocomplete="off" value="{{ old('title') }}">

                                                @error('title_en')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                @enderror
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

                <div class="row g-3 justify-content-start">
                    @forelse ($videos as $video)
                        <div class="col-6 col-sm-4 col-md-3"">
                            <div class="card" style="width: 18rem;">
                                {!! $video->embed_code !!}
                                <div class="card-body">
                                    <p class="card-text">{{ $video->title }}</p>
                                    <div class="row">
                                        <div class="d-flex">
                                            <!-- Edit Button -->
                                            <div class="w-50 pe-1">
                                                <a class="btn btn-primary btn-sm w-100"
                                                    href="{{ route('photogallery.edit', $video->id) }}">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </a>
                                            </div>

                                            <!-- Delete Button Form -->
                                            <div class="w-50 ps-1">
                                                <form method="POST"
                                                    action="{{ route('photogallery.destroy', $video->id) }}"
                                                    onsubmit="return confirm('Are you sure you want to delete: {{ addslashes($video->title) }}?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm w-100">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="w-100 text-center">
                            <p class="alert alert-danger">No Video Found</p>
                        </div>
                    @endforelse

                    <!-- Pagination links -->
                    <div class="d-flex justify-content-start">
                        {{ $videos->links('pagination::bootstrap-5') }}
                    </div>

                </div>
                @if (session('video_uploaded'))
                    <div class=" alert alert-success mt-3 ">{{ session('video_uploaded') }}</div>
                @endif
            </div>
        </div>
    </div>
@endsection
