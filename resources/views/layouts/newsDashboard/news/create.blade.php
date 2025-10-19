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
                                                <option value="{{ $cate->id }}"
                                                    {{ old('category_id') == $cate->id ? 'selected' : '' }}>
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
                                        </select>

                                        @error('sub_cate_id')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>
                                </div>

                                {{-- Division , District, and Subdistrict Row --}}
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label class="form-label" for="division_id">Division<sup><code
                                                    style="font-size: 12px">*</code></sup></label>
                                        <select class="form-select select2" name="division_id" id="division_id"
                                            autocomplete="off">
                                            <option value="">== Select Division ==</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}"
                                                    {{ old('division_id') == $division->id ? 'selected' : '' }}>
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
                                                autocomplete="off">

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
                                                name="image_title" autocomplete="off" value="{{ old('image_title') }}">
                                            @error('image_title')
                                                <p class="text-danger mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Tag Input Fields -->
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="tag_en">Tags English<sup><code
                                                    style="font-size: 12px">*</code></sup></label>
                                        <textarea name="tag_en" id="tag_en" class="form-control scrollable-input" autocomplete="off" readonly>{{ old('tag_en') }}</textarea>
                                        @error('tag_en')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="tag_bn">Tags Bangla<sup><code
                                                    style="font-size: 12px">*</code></sup></label>
                                        <textarea name="tag_bn" id="tag_bn" class="form-control scrollable-input" autocomplete="off" readonly>{{ old('tag_bn') }}</textarea>
                                        @error('tag_bn')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Tags Dropdown Section with Search -->
                                <div class="row mt-3">
                                    <div class="col-lg-12">
                                        <label class="form-label">Select Tags<sup><code
                                                    style="font-size: 12px">*</code></sup></label>
                                        <div class="dropdown mt-2">
                                            <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button"
                                                id="tagsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                Select Tags
                                            </button>
                                            <div class="dropdown-menu w-100 p-3" aria-labelledby="tagsDropdown"
                                                id="tags-dropdown-menu">
                                                <!-- Search Input -->
                                                <div class="mb-3">
                                                    <input type="text" id="tag-search-input" class="form-control"
                                                        placeholder="Search tags..." autocomplete="off">
                                                </div>

                                                <!-- Tags Container -->
                                                <div id="tags-en-suggestions" class="tags-scroll-container">
                                                    @foreach ($tags as $tag)
                                                        <span
                                                            class="tag-suggestion cursor-pointer bg-gray-200 px-2 py-1 m-1 rounded dropdown-item-custom"
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

                                <!-- Selected Tags Display with New Design -->
                                <div class="mt-3">
                                    <label class="form-label">Selected Tags:</label>
                                    <div id="selected-tags"
                                        class="mt-2 p-2 border rounded min-height-50 d-flex flex-wrap"></div>
                                </div>

                                <style>
                                    .tags-scroll-container {
                                        max-height: 300px;
                                        overflow-y: auto;
                                        display: flex;
                                        flex-wrap: wrap;
                                        gap: 8px;
                                    }

                                    .tag-suggestion {
                                        display: inline-block;
                                        transition: all 0.2s ease;
                                        border: 1px solid #ddd;
                                    }

                                    .tag-suggestion:hover {
                                        background-color: #007bff !important;
                                        color: white;
                                        transform: translateY(-2px);
                                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                                    }

                                    .selected-tag {
                                        display: inline-flex;
                                        align-items: center;
                                        gap: 8px;
                                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                        color: white;
                                        padding: 8px 12px;
                                        margin: 4px;
                                        border-radius: 20px;
                                        font-size: 14px;
                                        font-weight: 500;
                                        transition: all 0.3s ease;
                                        cursor: pointer;
                                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                                    }

                                    .selected-tag:hover {
                                        transform: translateY(-2px);
                                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                                        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
                                    }

                                    .selected-tag .remove-icon {
                                        display: inline-flex;
                                        align-items: center;
                                        justify-content: center;
                                        width: 18px;
                                        height: 18px;
                                        background: rgba(255, 255, 255, 0.3);
                                        border-radius: 50%;
                                        font-size: 14px;
                                        font-weight: bold;
                                        transition: all 0.2s ease;
                                    }

                                    .selected-tag:hover .remove-icon {
                                        background: rgba(255, 255, 255, 0.5);
                                        transform: rotate(90deg);
                                    }

                                    .tag-hidden {
                                        display: none !important;
                                    }

                                    #tag-search-input:focus {
                                        border-color: #667eea;
                                        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
                                    }
                                </style>


                                {{-- News Details In Bangla --}}
                                <div class="mt-3">

                                    <label class='form-label' for="paragraph">Details Bangla<sup><code
                                                style="font-size: 12px">*</code></sup></label>

                                    <textarea name="details_bn" id="summernoteBangla" cols="30" rows="10">{{ old('details_bn') }}</textarea>


                                    @error('details_bn')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- News Details In English --}}
                                <div class="mt-3">

                                    <label class='form-label' for="paragraph">Details English<sup><code
                                                style="font-size: 12px">*</code></sup></label>

                                    <textarea name="details_en" id="summernoteEnglish" cols="30" rows="10">{{ old('details_en') }}</textarea>


                                    @error('details_en')
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
                                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                                                    Deactive</option>
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
                                                name="news_source" autocomplete="off" value="{{ old('news_source') }}">
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
                                                name="firstSection_bigThumbnail" id="firstSection_bigThumbnail"
                                                {{ old('firstSection_bigThumbnail') ? 'checked' : '' }}>
                                            <label class='form-label mt-2' for="firstSection_bigThumbnail"
                                                style="font-size: 14px;">First Section Big Thumbnail</label>
                                        </div>
                                        <div class="col-lg-3">
                                            <input class="form-input me-2" type="checkbox" name="firstSection"
                                                id="firstSection" {{ old('firstSection') ? 'checked' : '' }}>
                                            <label class='form-label mt-2' for="firstSection"
                                                style="font-size: 14px;">First Section</label>
                                        </div>
                                        <div class="col-lg-3">
                                            <input class="form-input me-2" type="checkbox" name="trendyNews"
                                                id="trendyNews" {{ old('trendyNews') ? 'checked' : '' }}>
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

    {{-- For Tags --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tagEnInput = document.getElementById('tag_en');
            const tagBnInput = document.getElementById('tag_bn');
            const suggestions = document.getElementById('tags-en-suggestions');
            const selectedContainer = document.getElementById('selected-tags');
            const dropdownMenu = document.getElementById('tags-dropdown-menu');
            const searchInput = document.getElementById('tag-search-input');
            let selectedTags = [];

            // Restore old tag values if they exist
            const oldTagEn = @json(old('tag_en'));
            const oldTagBn = @json(old('tag_bn'));

            if (oldTagEn) {
                // Parse old tags and restore them
                const tagsEn = oldTagEn.split(', ').filter(t => t.trim());
                const tagsBn = oldTagBn ? oldTagBn.split(', ').filter(t => t.trim()) : [];

                // Get all tag suggestions to find matching IDs
                const allTagSuggestions = suggestions.querySelectorAll('.tag-suggestion');

                tagsEn.forEach((en, index) => {
                    const matchingTag = Array.from(allTagSuggestions).find(tag => tag.dataset.en === en);
                    if (matchingTag) {
                        selectedTags.push({
                            id: matchingTag.dataset.id,
                            en: en,
                            bn: tagsBn[index] || ''
                        });
                        // Remove from suggestions
                        matchingTag.remove();
                    }
                });

                renderSelectedTags();
            }

            // Search functionality
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase().trim();
                const allTags = suggestions.querySelectorAll('.tag-suggestion');

                allTags.forEach(tag => {
                    const tagText = tag.textContent.toLowerCase();
                    const tagBn = tag.dataset.bn.toLowerCase();

                    if (tagText.includes(searchTerm) || tagBn.includes(searchTerm)) {
                        tag.classList.remove('tag-hidden');
                    } else {
                        tag.classList.add('tag-hidden');
                    }
                });
            });

            // Click on suggestion
            suggestions.addEventListener('click', function(e) {
                if (e.target.classList.contains('tag-suggestion')) {
                    const id = e.target.dataset.id;
                    const en = e.target.dataset.en;
                    const bn = e.target.dataset.bn;

                    // Prevent duplicates
                    if (!selectedTags.some(t => t.id == id)) {
                        selectedTags.push({
                            id,
                            en,
                            bn
                        });
                        renderSelectedTags();

                        // Remove from suggestions with animation
                        e.target.style.opacity = '0';
                        setTimeout(() => {
                            if (e.target.parentNode) {
                                e.target.remove();
                            }
                        }, 200);
                    }

                    // Clear search
                    searchInput.value = '';
                    const allTags = suggestions.querySelectorAll('.tag-suggestion');
                    allTags.forEach(tag => tag.classList.remove('tag-hidden'));

                    e.stopPropagation();
                }
            });

            // Prevent dropdown from closing
            dropdownMenu.addEventListener('click', function(e) {
                e.stopPropagation();
            });

            // Keep focus on search input when dropdown opens
            document.getElementById('tagsDropdown').addEventListener('click', function() {
                setTimeout(() => {
                    searchInput.focus();
                }, 100);
            });

            function renderSelectedTags() {
                selectedContainer.innerHTML = '';

                if (selectedTags.length === 0) {
                    selectedContainer.innerHTML = '<span class="text-muted">No tags selected</span>';
                } else {
                    selectedTags.forEach(tag => {
                        const span = document.createElement('span');
                        span.classList.add('selected-tag');
                        span.innerHTML = `
                        ${tag.en}
                        <span class="remove-icon">×</span>
                    `;
                        span.dataset.id = tag.id;

                        // Click to remove
                        span.addEventListener('click', function() {
                            removeTag(tag.id);
                        });

                        selectedContainer.appendChild(span);
                    });
                }

                // Update inputs
                tagEnInput.value = selectedTags.map(t => t.en).join(', ');
                tagBnInput.value = selectedTags.map(t => t.bn).join(', ');
            }

            function removeTag(id) {
                const tag = selectedTags.find(t => t.id == id);
                if (!tag) return;

                selectedTags = selectedTags.filter(t => t.id != id);

                // Add back to suggestions
                const span = document.createElement('span');
                span.classList.add('tag-suggestion', 'cursor-pointer', 'bg-gray-200', 'px-2', 'py-1', 'm-1',
                    'rounded', 'dropdown-item-custom');
                span.dataset.id = tag.id;
                span.dataset.en = tag.en;
                span.dataset.bn = tag.bn;
                span.textContent = tag.en;

                // Add with animation
                span.style.opacity = '0';
                suggestions.appendChild(span);
                setTimeout(() => {
                    span.style.opacity = '1';
                }, 10);

                renderSelectedTags();
            }

            // Initialize
            renderSelectedTags();
        });
    </script>


    {{-- Select Subcategories while dropdown to categories --}}
    <script>
        $(document).ready(function() {
            // Restore old subcategory value
            const oldSubCateId = @json(old('sub_cate_id'));
            const oldCategoryId = @json(old('category_id'));

            if (oldCategoryId && oldSubCateId) {
                $.ajax({
                    url: '/get/subcategories/' + oldCategoryId,
                    type: 'GET',
                    success: function(data) {
                        $('#sub_cate_id').empty();
                        $('#sub_cate_id').append('<option value="">== Select Sub Category ==</option>');
                        $.each(data, function(key, value) {
                            const selected = value.id == oldSubCateId ? 'selected' : '';
                            $('#sub_cate_id').append('<option value="' + value.id + '" ' +
                                selected + '>' +
                                value.sub_cate_en + ' | ' + value.sub_cate_bn + '</option>');
                        });
                    }
                });
            }

            $('#category_id').on('change', function() {
                var categoryID = $(this).val();

                if (categoryID) {
                    $.ajax({
                        url: '/get/subcategories/' + categoryID,
                        type: 'GET',
                        success: function(data) {
                            $('#sub_cate_id').empty();
                            $('#sub_cate_id').append(
                                '<option value="">== Select Sub Category ==</option>');
                            $.each(data, function(key, value) {
                                $('#sub_cate_id').append('<option value="' + value.id +
                                    '">' + value
                                    .sub_cate_en + ' | ' + value.sub_cate_bn +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('#sub_cate_id').empty();
                }
            });
        });
    </script>


    {{-- Select Districts while dropdown to Division --}}
    <script>
        $(document).ready(function() {
            // Restore old district value
            const oldDistId = @json(old('dist_id'));
            const oldDivisionId = @json(old('division_id'));

            if (oldDivisionId && oldDistId) {
                $.ajax({
                    url: '/get/dist/' + oldDivisionId,
                    type: 'GET',
                    success: function(data) {
                        $('#dist_id').empty();
                        $('#dist_id').append('<option value="">== Select District ==</option>');
                        $.each(data, function(key, value) {
                            const selected = value.id == oldDistId ? 'selected' : '';
                            $('#dist_id').append('<option value="' + value.id + '" ' +
                                selected + '>' +
                                value.district_en + ' | ' + value.district_bn + '</option>');
                        });
                    }
                });
            }

            $('#division_id').on('change', function() {
                var division_id = $(this).val();

                if (division_id) {
                    $.ajax({
                        url: '/get/dist/' + division_id,
                        type: 'GET',
                        success: function(data) {
                            $('#dist_id').empty();
                            $('#dist_id').append(
                                '<option value="">== Select District ==</option>');
                            $.each(data, function(key, value) {
                                $('#dist_id').append('<option value="' + value.id +
                                    '">' + value
                                    .district_en + ' | ' + value.district_bn +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('#dist_id').empty();
                }
            });
        });
    </script>

    {{-- Select Subdistricts while dropdown to Districts --}}
    <script>
        $(document).ready(function() {
            // Restore old sub-district value
            const oldSubDistId = @json(old('sub_dist_id'));
            const oldDistId = @json(old('dist_id'));

            if (oldDistId && oldSubDistId) {
                $.ajax({
                    url: '/get/subdist/' + oldDistId,
                    type: 'GET',
                    success: function(data) {
                        $('#sub_dist_id').empty();
                        $('#sub_dist_id').append('<option value="">== Select Sub District ==</option>');
                        $.each(data, function(key, value) {
                            const selected = value.id == oldSubDistId ? 'selected' : '';
                            $('#sub_dist_id').append('<option value="' + value.id + '" ' +
                                selected + '>' +
                                value.sub_district_en + ' | ' + value.sub_district_bn +
                                '</option>');
                        });
                    }
                });
            }

            $('#dist_id').on('change', function() {
                var distID = $(this).val();

                if (distID) {
                    $.ajax({
                        url: '/get/subdist/' + distID,
                        type: 'GET',
                        success: function(data) {
                            $('#sub_dist_id').empty();
                            $('#sub_dist_id').append(
                                '<option value="">== Select Sub District ==</option>');
                            $.each(data, function(key, value) {
                                $('#sub_dist_id').append('<option value="' + value.id +
                                    '">' + value
                                    .sub_district_en + ' | ' + value
                                    .sub_district_bn +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('#sub_dist_id').empty();
                }
            });
        });
    </script>
@endsection
