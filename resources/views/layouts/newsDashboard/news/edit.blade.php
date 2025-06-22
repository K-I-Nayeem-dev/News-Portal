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
                                    <li class="breadcrumb-item text-muted" aria-current="page">News Create</li>
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
                <div class="offset-lg-2 offset-md-2 offset-sm-2 col-lg-8 col-sm-8 col-md-8">
                    <div class="card">
                        <h5 class="card-header d-flex justify-content-between text-white" style="background-color: #1B84FF">
                            <span>Edit News</span>
                            <span>
                                News : {{ $news->id }}
                                <a class="text-white ms-3" href="{{ route('news.index') }}">Back</a>
                            </span>
                        </h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('news.update', $news->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <div>
                                    <label class='form-label' for="title">Title<sup><code style="font-size: 12px">*</code></sup></label>
                                    <input id="title" class="form-control" type="text" name="title"
                                        autocomplete="off" value="{{ old('title', $news->title) }}">
                                    @error('title')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mt-3">
                                    <label class='form-label' for="news_source">News Source<sup><code
                                                style="font-size: 12px">*</code></sup></label>
                                    <input id="news_source" class="form-control" type="text" name="news_source"
                                        autocomplete="off" value="{{ old('news_source' , $news->news_source) }}">
                                    @error('news_source')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mt-3">

                                    <label class='form-label' for="paragraph">paragraph<sup><code
                                                style="font-size: 12px">*</code></sup></label>
                                    <textarea style="line-height: 25px" name="paragraph" id="paragraph" rows="5" class="form-control"
                                        autocomplete="off">{{ old('paragraph', $news->paragraph) }}</textarea>

                                    @error('paragraph')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mt-3">

                                    <label class="form-label" for="category_id">Category<sup><code
                                                style="font-size: 12px">*</code></sup></label>
                                    <select class="form-select select2" name="category_id" id="category_id"
                                        autocomplete="off">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $cate)
                                            <option value="{{ $cate->id }}" {{ $cate->id == $news->category_id ? 'selected' : '' }}> {{ $cate->category_name }}</option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>

                                <div class="mt-3">

                                    <label class="form-label" for="sub_cate">Sub Category<sup><code
                                                style="font-size: 12px">*</code></sup></label>
                                    <select class="form-select " name="sub_cate_id" id="sub_cate" autocomplete="off">
                                        <option value="">Select Sub Category</option>
                                        @foreach ($sub_cates as $sub_cate)
                                            <option value="{{ $sub_cate->id }}" {{ $sub_cate->id == $news->sub_cate_id ? 'selected' : '' }}> {{ $sub_cate->sub_cate_name }}</option>
                                        @endforeach
                                    </select>

                                    @error('sub_cate_id')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>

                                <div class="mt-3">

                                    <label class='form-label' for="url">Only Youtube Video Url ID <code>(Optional)</code></label>
                                    <input name="url" id="url" class="form-control" autocomplete="off"
                                        value="{{ old('url', $news->url) }}">
                                </div>

                                <div class="mt-3">

                                    <label class='form-label' for="thumbnail">Thumbnail<sup><code style="font-size: 12px">*</code></sup> (Max 1 MB Size)</label>
                                    <input type="file" name="thumbnail" id="thumbnail" class="form-control" autocomplete="off" value="{{ old('thumbnail', $news->thumbnail) }}">

                                    @error('thumbnail')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                    {{-- <div class="my-3">
                                        <img class="w-100 h-100"  src="{{ asset('uploads/news_photos/'. $news->news_photo) }}"  alt="{{ $news->title }}">
                                    </div> --}}

                                    <div class="my-3">
                                        <img class="w-100 h-100"  src="{{ asset('uploads/news_photos/'. $news->news_photo) }}"  alt="{{ $news->title }}">
                                        {{-- <img class="w-100 h-100"  src="{{ asset('../'. $news->thumbnail) }}"  alt="{{ $news->title }}"> --}}
                                    </div>

                                </div>

                                <div class="mt-3">
                                    <label class='form-label' for="image_title">Image Caption<sup><code
                                                style="font-size: 12px">*</code></sup></label>
                                    <input id="image_title" class="form-control" type="text" name="image_title"
                                        autocomplete="off" value="{{ old('image_title', $news->image_title) }}">
                                    @error('image_title')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mt-3">


                                    <p class="d-inline-flex gap-1">
                                        <a class="btn btn-success" data-bs-toggle="collapse" href="#collapseExample"
                                            role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Add More Photos +
                                        </a>
                                    </p>

                                    <div class="collapse" id="collapseExample">
                                        <div class="card card-body">
                                            <label class='form-label' for="news_photos">More Photos</label>
                                            <input multiple id="news_photos" class="form-control" type="file"
                                                name="news_photos[]" autocomplete="off">
                                        </div>
                                    </div>


                                </div>

                                <div class="mt-3">
                                    <label class='form-label' for="status">Status<sup><code
                                                style="font-size: 12px">*</code></sup></label>

                                    <select class="form-select " name="status" id="status" autocomplete="off">

                                        <option value="">Select Status</option>
                                        <option value="1" {{ $news->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $news->status == 0 ? 'selected' : '' }}>Deactive</option>
                                    </select>

                                    @error('status')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button class="btn btn-primary mt-3">Update News</button>
                                <a href="{{ route('news.index') }}" class="btn btn-primary mt-3">Back</a>

                            </form>

                            @if (session('news_created'))
                                <div class=" alert alert-success mt-3 ">{{ session('news_created') }}</div>
                            @endif
                            @if (session('news_update'))
                                <div class=" alert alert-success mt-3 ">{{ session('news_update') }}</div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
