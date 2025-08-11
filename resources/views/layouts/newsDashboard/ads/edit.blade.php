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
                                            href="{{ route('ads.index') }}">Create Ads
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">Edit</li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">{{ $ad->id }}</li>
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
                        <img src="{{ asset($ad->image) }}" class="card-img-top" alt="{{ $ad->title }}">
                        <div class="card-body">
                            <form method="POST" action="{{ route('ads.update', $ad->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method("PUT")

                                {{-- Image Upload for photos Gallery --}}
                                <div class="mt-3">

                                    <div>
                                        <label class='form-label' for="url">Ads Url</label>
                                        <input id="url" class="form-control" type="text" name="url"
                                            autocomplete="off" value="{{ old('url', $ad->url) }}">

                                        @error('url')
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
                                            <option {{ $ad->type == 1 ? 'selected' : '' }} value="1">Square
                                            </option>
                                            <option {{ $ad->type == 0 ? 'selected' : '' }} value="0">Horizontal
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
                    @if (session('ads_updated'))
                        <div class=" alert alert-success mt-3 ">{{ session('ads_updated') }}</div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
