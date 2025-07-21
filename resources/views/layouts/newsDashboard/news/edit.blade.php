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
                                        <a class="text-muted text-decoration-none" href="{{ route('news.index') }}">All News
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item " aria-current="page">
                                        <a class="text-muted" href="{{ route('news.show', $news->id) }}">News : {{ $news->id }}</a>
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">Edit News</li>
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
                <div class="col-lg">
                    <div class="card">
                        <h5 class="card-header text-white d-flex justify-content-between align-items-center" style="background-color: #1B84FF">
                            <span>Edit News</span>
                            <span><a href="{{ route('news.index') }}" class="btn rounded ms-2 bg-success text-white hover-btn">Back</a></span>
                        </h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('news.update', $news->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                {{-- Title Bangla and English Row --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class='form-label' for="title_en">Title English<sup><code
                                                    style="font-size: 12px">*</code></sup></label>
                                        <input id="title_en" class="form-control" type="text" name="title_en"
                                            autocomplete="off" value="{{ old('title_en', $news->title_en) }}">
                                        @error('title_en')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class='form-label' for="title_bn">Title Bangla<sup><code
                                                    style="font-size: 12px">*</code></sup></label>
                                        <input id="title_bn" class="form-control" type="text" name="title_bn"
                                            autocomplete="off" value="{{ old('title_bn', $news->title_bn) }}">
                                        @error('title_bn')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Category And Subcategory Row --}}
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="category_id">Category<sup><code
                                                    style="font-size: 12px">*</code></sup></label>
                                        <select class="form-select select2" name="category_id" id="category_id"
                                            autocomplete="off">
                                            <option value="">== Select Category ==</option>
                                            @foreach ($categories as $cate)
                                                <option value="{{ $cate->id }}" {{ $cate->id == $news->category_id ? 'selected' : '' }}>{{ $cate->category_en }}</option>
                                            @endforeach
                                        </select>

                                        @error('category_id')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">

                                        <label class='form-label' for="sub_cate_id">Sub Category<sup><code
                                                    style="font-size: 12px">*</code></sup></label>

                                        <select class="form-select select2" name="sub_cate_id" id="sub_cate_id"
                                            autocomplete="off">
                                            <option value="">== Sub Category ==</option>
                                        </select>

                                    </div>
                                </div>

                                {{-- Category And Subcategory Row --}}
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="dist_id">District<sup><code
                                                    style="font-size: 12px">*</code></sup></label>
                                        <select class="form-select select2" name="dist_id" id="dist_id"
                                            autocomplete="off">
                                            <option value="">== Select District ==</option>
                                            @foreach ($districts as $dist)
                                                <option value="{{ $dist->id }}">
                                                    {{ $dist->district_en . ' | ' . $dist->district_bn }}</option>
                                            @endforeach
                                        </select>

                                        @error('dist_id')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">

                                        <label class='form-label' for="sub_dist_id">Sub District<sup><code
                                                    style="font-size: 12px">*</code></sup></label>

                                        <select class="form-select select2" name="sub_dist_id" id="sub_dist_id"
                                            autocomplete="off">
                                            <option value="">== Sub District ==</option>
                                        </select>

                                        @error('sub_dist_id')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>
                                </div>

                                {{-- Thumbnail for news --}}
                                <div class="mt-3">

                                    <label class='form-label' for="thumbnail">Thumbnail<sup><code
                                                style="font-size: 12px">*</code></sup> (Max 1 MB Size)</label>
                                    <input type="file" name="thumbnail" id="thumbnail" class="form-control"
                                        autocomplete="off" value="{{ old('thumbnail') }}">

                                    @if ($errors->any())
                                        <div class="alert alert-danger mt-3 text-sm">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @error('thumbnail')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Image Caption for thumbnail --}}
                                <div class="mt-3">
                                    <label class='form-label' for="image_title">Image Caption<sup><code
                                                style="font-size: 12px">*</code></sup></label>
                                    <input id="image_title" class="form-control" type="text" name="image_title"
                                        autocomplete="off">
                                    @error('image_title')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Add More Photos For News --}}
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

                                {{-- Tags Row --}}
                                <div class="row mt-3">
                                    <div class="col-md-6">

                                        <label class="form-label" for="tags_en">Tags English<sup><code
                                                    style="font-size: 12px">*</code></sup></label>
                                        <input name="tags_en" id="tags_en" class="form-control" autocomplete="off"
                                            value="{{ old('tags_en') }}">

                                        @error('tags_en')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="tags_bn">Tags Bangla<sup><code
                                                    style="font-size: 12px">*</code></sup></label>
                                        <input name="tags_bn" id="tags_bn" class="form-control" autocomplete="off"
                                            value="{{ old('tags_bn') }}">

                                        @error('tags_bn')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- News Details In Bangla --}}
                                <div class="mt-3">

                                    <label class='form-label' for="paragraph">Details Bangla<sup><code
                                                style="font-size: 12px">*</code></sup></label>
                                    {{-- <textarea style="line-height: 25px" name="paragraph" id="paragraph" rows="5" class="form-control"
                                        autocomplete="off">{{ old('paragraph') }}</textarea> --}}

                                    <textarea name="details_bn" id="summernoteBangla" cols="30" rows="10"></textarea>


                                    @error('details_bn')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- News Details In English --}}
                                <div class="mt-3">

                                    <label class='form-label' for="paragraph">Details English<sup><code
                                                style="font-size: 12px">*</code></sup></label>
                                    {{-- <textarea style="line-height: 25px" name="paragraph" id="paragraph" rows="5" class="form-control"
                                        autocomplete="off">{{ old('paragraph') }}</textarea> --}}

                                    <textarea name="details_en" id="summernoteEnglish" cols="30" rows="10"></textarea>


                                    @error('details_bn')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>

                                {{-- Image Caption for thumbnail --}}
                                <div class="mt-3">
                                    <label class='form-label' for="news_source">News Source<sup><code
                                                style="font-size: 12px">*</code></sup></label>
                                    <input id="news_source" class="form-control" type="text" name="news_source"
                                        autocomplete="off">
                                    @error('news_source')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- paste youtube video id for news --}}
                                <div class="mt-3">

                                    <label class='form-label' for="url">Only Youtube Video Url ID
                                        <code>(Optional)</code></label>
                                    <input name="url" id="url" class="form-control" autocomplete="off"
                                        value="{{ old('url') }}">
                                </div>

                                {{-- News Status Set --}}
                                <div class="mt-3">
                                    <label class='form-label' for="status">Status<sup><code
                                                style="font-size: 12px">*</code></sup></label>

                                    <select class="form-select " name="status" id="status" autocomplete="off">

                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Deactive</option>
                                    </select>

                                    @error('status')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button class="btn btn-primary mt-3">Update News</button>

                            </form>

                            @if (session('news_created'))
                                <div class=" alert alert-success mt-3 ">{{ session('news_created') }}</div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
