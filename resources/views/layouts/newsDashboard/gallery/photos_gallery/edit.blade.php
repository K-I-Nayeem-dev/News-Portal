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
                                            href="{{ route('photogallery.index') }}">Photos Gallery
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">Edit</li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">{{ $photo->id }}</li>
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
                        <img src="{{ asset($photo->image) }}" class="card-img-top" alt="{{ $photo->title }}">
                        <div class="card-body">
                            <form method="POST" action="{{ route('photogallery.update', $photo->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method("PUT")

                                {{-- Image Upload for photos Gallery --}}
                                <div class="mt-3">

                                    <div>
                                        <label class='form-label' for="title_en">Title English</label>
                                        <input id="title_en" class="form-control" type="text" name="title_en"
                                            autocomplete="off" value="{{ old('title_en', $photo->title_en) }}">

                                        @error('title_en')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label class='form-label' for="title_bn">Title Bangla</label>
                                        <input id="title_bn" class="form-control" type="text" name="title_bn"
                                            autocomplete="off" value="{{ old('title_bn', $photo->title_bn) }}">

                                        @error('title_bn')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label class='form-label' for="image">Image</label>
                                        <input type="file" name="image" id="image" class="form-control"
                                            autocomplete="off" value="{{ old('image') }}">

                                        @error('image')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">

                                        <label class='form-label' for="type">Type</label>
                                        <select class="form-select select2" name="type" id="type"
                                            autocomplete="off">
                                            <option value="">Select Type</option>
                                            <option {{ $photo->type == 1 ? 'selected' : '' }} value="1">Big Photo
                                            </option>
                                            <option {{ $photo->type == 0 ? 'selected' : '' }} value="0">Small Photo
                                            </option>
                                        </select>

                                        @error('type')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-3 d-flex align-items-center justify-content-end">
                                    <a class="btn btn-primary" href="{{ route('photogallery.index') }}">Back</a>
                                    <button type="submit" class="btn btn-primary ms-2">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if (session('photo_updated'))
                        <div class=" alert alert-success mt-3 ">{{ session('photo_updated') }}</div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
