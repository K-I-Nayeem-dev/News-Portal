@extends('layouts.newsDashboard.dashboard')

@section('dashboard')
    <style>
        .selected-tag-item {
            background-color: #007bff !important;
            color: white !important;
        }

        .min-height-50 {
            min-height: 50px;
        }

        .tags-scroll-container {
            max-height: 200px;
            overflow-y: auto;
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
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none"
                                            href="{{ route('dashboard_news.index') }}">All News
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item " aria-current="page">
                                        <a class="text-muted" href="{{ route('dashboard_news.show', $news->id) }}">News :
                                            {{ $news->id }}</a>
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
                        <h5 class="card-header text-white d-flex justify-content-between align-items-center"
                            style="background-color: #1B84FF">
                            <span>Edit News</span>
                            <span><a href="{{ route('dashboard_news.index') }}"
                                    class="btn rounded ms-2 bg-success text-white hover-btn">Back</a></span>
                        </h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard_news.update', $news->id) }}"
                                enctype="multipart/form-data">
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
                                                <option value="{{ $cate->id }}"
                                                    {{ $cate->id == $news->category_id ? 'selected' : '' }}>
                                                    {{ $cate->category_en . ' | ' . $cate->category_bn }}</option>
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
                                            @foreach ($sub_cates as $subcate)
                                                <option value="{{ $subcate->id }}"
                                                    {{ $subcate->id == $news->sub_cate_id ? 'selected' : '' }}>
                                                    {{ $subcate->sub_cate_en . ' | ' . $subcate->sub_cate_bn }}</option>
                                            @endforeach
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
                                                <option value="{{ $division->id }}"
                                                    {{ $news->division_id == $division->id ? 'selected' : '' }}>
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
                                            @foreach ($districts as $district)
                                                <option value="{{ $district->id }}"
                                                    {{ $news->dist_id == $district->id ? 'selected' : '' }}>
                                                    {{ $district->district_en . ' | ' . $district->district_bn }}</option>
                                            @endforeach
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
                                            @foreach ($sub_dists as $sub_dist)
                                                <option value="{{ $sub_dist->id }}"
                                                    {{ $news->sub_dist_id == $sub_dist->id ? 'selected' : '' }}>
                                                    {{ $sub_dist->sub_district_en . ' | ' . $sub_dist->sub_district_bn }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('sub_dist_id')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>

                                </div>

                                {{-- Thumbnail for news --}}
                                <div class="row my-3 align-items-center">
                                    <div class="col-lg">
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
                                    <div class="col-lg text-center mt-3">
                                        <img class="w-50" src="{{ asset($news->thumbnail) }}"
                                            alt="{{ $news->title_bn . ' | ' . $news->title_en }}">
                                    </div>
                                </div>

                                {{-- Image Caption for thumbnail --}}
                                <div class="mt-3">
                                    <label class='form-label' for="image_title">Image Caption<sup><code
                                                style="font-size: 12px">*</code></sup></label>
                                    <input id="image_title" class="form-control" type="text" name="image_title"
                                        autocomplete="off" value="{{ old('image_title', $news->image_title) }}">
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

                                <!-- Tag Input Fields -->
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="tag_en">Tags English<sup><code
                                                    style="font-size: 12px">*</code></sup></label>
                                        <textarea name="tag_en" id="tag_en" class="form-control scrollable-input" autocomplete="off" readonly>{{ old('tag_en', $selected_tags->pluck('tag_en')->implode(', ')) }}</textarea>
                                        @error('tag_en')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="tag_bn">Tags Bangla<sup><code
                                                    style="font-size: 12px">*</code></sup></label>
                                        <textarea name="tag_bn" id="tag_bn" class="form-control scrollable-input" autocomplete="off" readonly>{{ old('tag_bn', $selected_tags->pluck('tag_bn')->implode(', ')) }}</textarea>
                                        @error('tag_bn')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Tags Dropdown Section -->
                                <div class="row mt-3">
                                    <div class="col-lg-12">
                                        <label class="form-label">Select Tags<sup><code
                                                    style="font-size: 12px">*</code></sup></label>
                                        <div class="dropdown mt-2">
                                            <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button"
                                                id="tagsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                Select Tags
                                            </button>
                                            <div class="dropdown-menu w-100" aria-labelledby="tagsDropdown"
                                                id="tags-dropdown-menu">
                                                <div id="tags-en-suggestions" class="tags-scroll-container">
                                                    @foreach ($all_tags as $tag)
                                                        <span
                                                            class="tag-suggestion cursor-pointer bg-gray-200 px-2 py-1 m-1 rounded dropdown-item-custom {{ in_array($tag->id, $selected_tag_ids) ? 'selected-tag-item' : '' }}"
                                                            data-id="{{ $tag->id }}" data-en="{{ $tag->tag_en }}"
                                                            data-bn="{{ $tag->tag_bn }}">
                                                            {{ $tag->tag_en }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Selected tags container -->
                                <div class="mt-3">
                                    <label class="form-label">Selected Tags:</label>
                                    <div id="selected-tags" class="mt-2 p-2 border rounded min-height-50">
                                        <!-- Pre-populate selected tags -->
                                        @foreach ($selected_tags as $tag)
                                            <span
                                                class="selected-tag bg-primary text-white px-2 py-1 m-1 rounded d-inline-flex align-items-center"
                                                data-id="{{ $tag->id }}" data-en="{{ $tag->tag_en }}"
                                                data-bn="{{ $tag->tag_bn }}">
                                                {{ $tag->tag_en }}
                                                <button type="button" class="btn-close btn-close-white ms-2 remove-tag"
                                                    style="font-size: 10px;"></button>
                                            </span>
                                        @endforeach
                                    </div>
                                </div>


                                {{-- News Details In Bangla --}}
                                <div class="mt-3">

                                    <label class='form-label' for="paragraph">Details Bangla<sup><code
                                                style="font-size: 12px">*</code></sup></label>
                                    {{-- <textarea style="line-height: 25px" name="paragraph" id="paragraph" rows="5" class="form-control"
                                        autocomplete="off">{{ old('paragraph') }}</textarea> --}}

                                    <textarea name="details_bn" id="summernoteBangla" cols="30" rows="10">{{ $news->details_bn }}</textarea>


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

                                    <textarea name="details_en" id="summernoteEnglish" cols="30" rows="10">{{ $news->details_en }}</textarea>


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
                                                <option {{ $news->status == 1 ? 'selected' : '' }} value="1">Active
                                                </option>
                                                <option {{ $news->status == 0 ? 'selected' : '' }} value="0">Deactive
                                                </option>
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
                                                name="news_source" autocomplete="off"
                                                value="{{ old('news_source', $news->news_source) }}">
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
                                                value="{{ old('url', $news->url) }}">
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
                                            <input type="hidden" name="firstSection_bigThumbnail" value="0">
                                            <input class="form-input me-2" type="checkbox"
                                                {{ $news->firstSection_bigThumbnail == 1 ? 'checked' : '' }}
                                                name="firstSection_bigThumbnail" id="firstSection_bigThumbnail"
                                                value="1">
                                            <label class='form-label mt-2' for="firstSection_bigThumbnail"
                                                style="font-size: 14px;">First Section Big Thumbnail</label>
                                        </div>

                                        <div class="col-lg-3">
                                            <input type="hidden" name="firstSection" value="0">
                                            <input class="form-input me-2" type="checkbox"
                                                {{ $news->firstSection == 1 ? 'checked' : '' }} name="firstSection"
                                                id="firstSection" value="1">
                                            <label class='form-label mt-2' for="firstSection"
                                                style="font-size: 14px;">First Section</label>
                                        </div>

                                        <div class="col-lg-3">
                                            <input type="hidden" name="trendyNews" value="0">
                                            <input class="form-input me-2" type="checkbox"
                                                {{ $news->trendyNews == 1 ? 'checked' : '' }} name="trendyNews"
                                                id="trendyNews" value="1">
                                            <label class='form-label mt-2' for="trendyNews"
                                                style="font-size: 14px;">Trending News</label>
                                        </div>
                                    </div>


                                    <div>
                                        <button class="btn btn-primary mt-3">Update News</button>
                                        <a class="btn btn-primary mt-3 ms-2"
                                            href="{{ route('dashboard_news.index') }}">Back</a>
                                    </div>

                            </form>

                            @if (session('news_update'))
                                <div class=" alert alert-success mt-3 ">{{ session('news_update') }}</div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- For Tags --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Pre-selected tag IDs from server
            const preSelectedTagIds = @json($selected_tag_ids);

            // Initialize the interface with existing selections
            initializeTagInterface();

            function initializeTagInterface() {
                // Mark pre-selected tags as selected
                preSelectedTagIds.forEach(function(tagId) {
                    const tagElement = document.querySelector(`[data-id="${tagId}"]`);
                    if (tagElement && tagElement.classList.contains('tag-suggestion')) {
                        tagElement.classList.add('selected-tag-item');
                    }
                });

                // Update textareas with existing tags
                updateTagTextareas();
            }

            // Your existing tag selection logic
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('tag-suggestion')) {
                    const tag = e.target;
                    const tagId = tag.dataset.id;
                    const tagEn = tag.dataset.en;
                    const tagBn = tag.dataset.bn;

                    if (!tag.classList.contains('selected-tag-item')) {
                        // Add tag
                        tag.classList.add('selected-tag-item');
                        addSelectedTag(tagId, tagEn, tagBn);
                    }
                }

                // Remove tag functionality
                if (e.target.classList.contains('remove-tag')) {
                    const tagContainer = e.target.closest('.selected-tag');
                    const tagId = tagContainer.dataset.id;

                    // Remove from selected tags container
                    tagContainer.remove();

                    // Remove selected state from dropdown
                    const dropdownTag = document.querySelector(`.tag-suggestion[data-id="${tagId}"]`);
                    if (dropdownTag) {
                        dropdownTag.classList.remove('selected-tag-item');
                    }

                    updateTagTextareas();
                }
            });

            function addSelectedTag(id, en, bn) {
                const selectedTagsContainer = document.getElementById('selected-tags');

                // Check if tag already exists
                if (selectedTagsContainer.querySelector(`[data-id="${id}"]`)) {
                    return;
                }

                const tagElement = document.createElement('span');
                tagElement.className =
                    'selected-tag bg-primary text-white px-2 py-1 m-1 rounded d-inline-flex align-items-center';
                tagElement.setAttribute('data-id', id);
                tagElement.setAttribute('data-en', en);
                tagElement.setAttribute('data-bn', bn);
                tagElement.innerHTML = `
            ${en}
            <button type="button" class="btn-close btn-close-white ms-2 remove-tag" style="font-size: 10px;"></button>
        `;

                selectedTagsContainer.appendChild(tagElement);
                updateTagTextareas();
            }

            function updateTagTextareas() {
                const selectedTags = document.querySelectorAll('#selected-tags .selected-tag');
                const enTags = [];
                const bnTags = [];

                selectedTags.forEach(tag => {
                    enTags.push(tag.dataset.en);
                    bnTags.push(tag.dataset.bn);
                });

                document.getElementById('tag_en').value = enTags.join(', ');
                document.getElementById('tag_bn').value = bnTags.join(', ');
            }
        });
    </script>

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
                            '<option selected disabled>== Sub Category ==</option>');
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
