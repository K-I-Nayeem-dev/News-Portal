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
                                    <li class="breadcrumb-item text-muted" aria-current="page">News Post Create</li>
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
                        <h5 class="card-header text-white d-flex justify-content-between align-items-center"
                            style="background-color: #1B84FF">
                            <span>Post News</span>
                            <span><a href="{{ route('dashboard_news.index') }}"
                                    class="btn rounded ms-2 bg-success text-white hover-btn">All News</a></span>
                        </h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard_news.store') }}" enctype="multipart/form-data">
                                @csrf

                                {{-- Title Bangla and English Row --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class='form-label' for="title_en">Title English<sup><code
                                                    style="font-size: 12px">*</code></sup></label>
                                        <input id="title_en" class="form-control" type="text" name="title_en"
                                            autocomplete="off" value="{{ old('title_en') }}">
                                        @error('title_en')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class='form-label' for="title_bn">Title Bangla<sup><code
                                                    style="font-size: 12px">*</code></sup></label>
                                        <input id="title_bn" class="form-control" type="text" name="title_bn"
                                            autocomplete="off" value="{{ old('title_bn') }}">
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
                                                <option value="{{ $cate->id }}">{{ $cate->category_en }}</option>
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
                                    <div class="col-md-4">
                                        <label class="form-label" for="division_id">Division<sup><code
                                                    style="font-size: 12px">*</code></sup></label>
                                        <select class="form-select select2" name="division_id" id="division_id"
                                            autocomplete="off">
                                            <option value="">== Select Division ==</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}">
                                                    {{ $division->division_en . ' | ' . $division->division_bn }}</option>
                                            @endforeach
                                        </select>

                                        @error('division_id')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">

                                        <label class='form-label' for="dist_id">District<sup><code
                                                    style="font-size: 12px">*</code></sup></label>

                                        <select class="form-select select2" name="dist_id" id="dist_id"
                                            autocomplete="off">
                                            <option value="">== Select District ==</option>
                                        </select>

                                        @error('dist_id')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>
                                    <div class="col-md-4">

                                        <label class='form-label' for="sub_dist_id">Sub District<sup><code
                                                    style="font-size: 12px">*</code></sup></label>

                                        <select class="form-select select2" name="sub_dist_id" id="sub_dist_id"
                                            autocomplete="off">
                                            <option value="">== Select Sub District ==</option>
                                        </select>

                                        @error('sub_dist_id')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- Thumbnail for news --}}
                                        <div class="mt-3">

                                            <label class='form-label' for="thumbnail">Thumbnail<sup><code
                                                        style="font-size: 12px">*</code></sup> (Max 1 MB Size)</label>
                                            <input type="file" name="thumbnail" id="thumbnail" class="form-control"
                                                autocomplete="off" value="{{ old('thumbnail') }}">

                                            @error('thumbnail')
                                                <p class="text-danger mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        {{-- Add More Photos For News --}}
                                        <div class="mt-3">
                                            <p class="d-inline-flex gap-1">
                                                <a class="btn btn-success" data-bs-toggle="collapse"
                                                    href="#collapseExample" role="button" aria-expanded="false"
                                                    aria-controls="collapseExample">
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
                                    </div>
                                    <div class="col-md-6">
                                        {{-- Image Caption for thumbnail --}}
                                        <div class="mt-3">
                                            <label class='form-label' for="image_title">Image Caption<sup><code
                                                        style="font-size: 12px">*</code></sup></label>
                                            <input id="image_title" class="form-control" type="text"
                                                name="image_title" autocomplete="off">
                                            @error('image_title')
                                                <p class="text-danger mt-2">{{ $message }}</p>
                                            @enderror
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

                                <div class="row">
                                    <div class="col-md-4">
                                        {{-- News Status Set --}}
                                        <div class="mt-3">
                                            <label class='form-label' for="status">Status<sup><code
                                                        style="font-size: 12px">*</code></sup></label>

                                            <select class="form-select " name="status" id="status"
                                                autocomplete="off">

                                                <option value="">Select Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">Deactive</option>
                                            </select>

                                            @error('status')
                                                <p class="text-danger mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        {{-- Image Caption for thumbnail --}}
                                        <div class="mt-3">
                                            <label class='form-label' for="news_source">News Source<sup><code
                                                        style="font-size: 12px">*</code></sup></label>
                                            <input id="news_source" class="form-control" type="text"
                                                name="news_source" autocomplete="off">
                                            @error('news_source')
                                                <p class="text-danger mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        {{-- paste youtube video id for news --}}
                                        <div class="mt-3">

                                            <label class='form-label' for="url">Only Youtube Video Url ID
                                                <code>(Optional)</code></label>
                                            <input name="url" id="url" class="form-control" autocomplete="off"
                                                value="{{ old('url') }}">
                                        </div>
                                    </div>
                                </div>

                                {{-- News Field set for first Section --}}
                                <div class="mt-3">

                                    <div>
                                        <label class='form-label' for="status">--Extra Options For Headline News
                                            Section--</label>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3">
                                            <input class="form-input me-2" type="checkbox"
                                                name="firstSection_bigThumbnail" id="firstSection_bigThumbnail">
                                            <label class='form-label mt-2' for="firstSection_bigThumbnail"
                                                style="font-size: 14px;">First Section Big Thumbnail</label>
                                        </div>
                                        <div class="col-lg-3">
                                            <input class="form-input me-2" type="checkbox" name="firstSection"
                                                id="firstSection">
                                            <label class='form-label mt-2' for="firstSection"
                                                style="font-size: 14px;">First Section</label>
                                        </div>
                                        <div class="col-lg-3">
                                            <input class="form-input me-2" type="checkbox" name="trendyNews"
                                                id="trendyNews">
                                            <label class='form-label mt-2' for="trendyNews"
                                                style="font-size: 14px;">Trending News</label>
                                        </div>
                                    </div>

                                </div>

                                <button class="btn btn-primary mt-3">Create News</button>

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

    {{-- Select Subcategories while dropdown to categories --}}
    <script>
        $('#category_id').on('change', function() {
            var categoryID = $(this).val();

            if (categoryID) {
                $.ajax({
                    url: '/get/subcategories/' + categoryID,
                    type: 'GET',
                    success: function(data) {
                        $('#sub_cate_id').empty();
                        $('#sub_cate_id').append(
                            '<option selected disabled>== Select Sub Category ==</option>');
                        $.each(data, function(key, value) {
                            $('#sub_cate_id').append('<option value="' + value.id + '">' + value
                                .sub_cate_en + ' | ' + value.sub_cate_bn + '</option>');
                        });
                    }
                });
            } else {
                $('#sub_cate_id').empty();
            }
        });
    </script>


    {{-- Select Districts while dropdown to Division --}}
    <script>
        $('#division_id').on('change', function() {
            var division_id = $(this).val();

            if (division_id) {
                $.ajax({
                    url: '/get/dist/' + division_id,
                    type: 'GET',
                    success: function(data) {
                        $('#dist_id').empty();
                        $('#dist_id').append(
                            '<option selected disabled>== Select District ==</option>');
                        $.each(data, function(key, value) {
                            $('#dist_id').append('<option value="' + value.id + '">' + value
                                .district_en + ' | ' + value.district_bn +
                                '</option>');
                        });
                    }
                });
            } else {
                $('#dist_id').empty();
            }
        });
    </script>

    {{-- Select Subdistricts while dropdown to Districts --}}

    <script>
        $('#dist_id').on('change', function() {
            var distID = $(this).val();

            if (distID) {
                $.ajax({
                    url: '/get/subdist/' + distID,
                    type: 'GET',
                    success: function(data) {
                        $('#sub_dist_id').empty();
                        $('#sub_dist_id').append(
                            '<option selected disabled>== Select Sub Category ==</option>');
                        $.each(data, function(key, value) {
                            $('#sub_dist_id').append('<option value="' + value.id + '">' + value
                                .sub_district_en + ' | ' + value.sub_district_bn +
                                '</option>');
                        });
                    }
                });
            } else {
                $('#sub_dist_id').empty();
            }
        });
    </script>
@endsection
