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
                                    <li class="breadcrumb-item text-muted" aria-current="page">Create Ads</li>
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
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-custom-class="custom-tooltip" title="Click To Show Ads Performance">
                                <a href="{{ route('ads.performance') }}">Total Ads : {{ $ads->count() }}</a>
                            </h5>
                        </div>
                        @hasanyrole('superadmin|admin|advertiser|moderator')
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#photosGallery">
                                Add Photo
                            </button>
                        @endhasrole
                    </div>


                    @if (session('photo_delete'))
                        <div class=" alert alert-danger mt-3 text-center">{{ session('photo_delete') }}</div>
                    @endif

                    <!-- Modal -->
                    <div class="modal fade" id="photosGallery" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Photo To Ads</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('ads.store') }}" enctype="multipart/form-data">
                                        @csrf

                                        {{-- Image Upload for photos Gallery --}}
                                        <div class="mt-3">

                                            <div>
                                                <label class='form-label' for="url">Ads Url<sup><code
                                                            style="font-size: 12px">*</code></sup></label>
                                                <input id="url" class="form-control" type="text" name="url"
                                                    autocomplete="off" value="{{ old('url') }}">

                                                @error('url')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="mt-3">
                                                <label class='form-label' for="image">Ads Image<sup><code
                                                            style="font-size: 12px">*</code></sup> (Max 1 MB Size)</label>
                                                <input type="file" name="image" id="image" class="form-control"
                                                    autocomplete="off" value="{{ old('image') }}">

                                                @error('image')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>


                                            <div class="mt-4">
                                                <label><strong>Ad Positions:</strong></label>

                                                <div class="row g-3 mt-3"> <!-- g-3 adds gap between columns -->
                                                    <!-- Front Page Ads (728x90) -->
                                                    <div class="col-md-6">
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="front_top_banner" id="front_top_banner"
                                                                value="1">
                                                            <label class="form-check-label" for="front_top_banner">
                                                                Front Top Banner <span class="fs-1">(728x90)</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="front_bottom" id="front_bottom" value="1">
                                                            <label class="form-check-label" for="front_bottom">
                                                                Front Bottom <span class="fs-1">(728x90)</span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <!-- Full News Page Ads -->
                                                    <div class="col-md-6">
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="news_left_banner" id="news_left_banner"
                                                                value="1">
                                                            <label class="form-check-label" for="news_left_banner">
                                                                News Left Banner <span class="fs-1">(300x250)</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="news_3_sidebar" id="news_3_sidebar" value="1">
                                                            <label class="form-check-label" for="news_3_sidebar">
                                                                News 3 Sidebar <span class="fs-1">(300x250)</span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="news_details_middle" id="news_details_middle"
                                                                value="1">
                                                            <label class="form-check-label" for="news_details_middle">
                                                                News Middle <span class="fs-1">(728x90)</span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="news_bottom" id="news_bottom" value="1">
                                                            <label class="form-check-label" for="news_bottom">
                                                                News Bottom <span class="fs-1">(728x90)</span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <!-- Category/Subcategory Ads -->
                                                    <div class="col-md-6">
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="category_sidebar1" id="category_sidebar1"
                                                                value="1">
                                                            <label class="form-check-label" for="category_sidebar1">
                                                                Category Sidebar 1<span class="fs-1">(300x250)</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="category_sidebar2" id="category_sidebar2"
                                                                value="1">
                                                            <label class="form-check-label" for="category_sidebar2">
                                                                Category Sidebar 2<span class="fs-1">(300x250)</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="subcategory_sidebar1" id="subcategory_sidebar1"
                                                                value="1">
                                                            <label class="form-check-label" for="subcategory_sidebar1">
                                                                Subcategory Sidebar 1<span class="fs-1">(300x250)</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="subcategory_sidebar2" id="subcategory_sidebar2"
                                                                value="1">
                                                            <label class="form-check-label" for="subcategory_sidebar2">
                                                                Subcategory Sidebar 2<span class="fs-1">(300x250)</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="liveTv_sidebar1" id="livetv_sidebar1"
                                                                value="1">
                                                            <label class="form-check-label" for="livetv_sidebar1">
                                                                LiveTv Sidebar 1<span class="fs-1">(300x250)</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="liveTv_sidebar2" id="livetv_sidebar2"
                                                                value="1">
                                                            <label class="form-check-label" for="livetv_sidebar2">
                                                                LiveTv Sidebar 2<span class="fs-1">(300x250)</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="liveTv_bottom" id="livetv_bottom" value="1">
                                                            <label class="form-check-label" for="livetv_bottom">
                                                                LiveTV Bottom<span class="fs-1">(728x90)</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="mt-3">
                                                    <label class='form-label' for="type">Ads Type<sup><code
                                                                style="font-size: 12px">*</code></sup></label>

                                                    <select class="form-select select2" name="type" id="type"
                                                        autocomplete="off">
                                                        <option value="">Select Type</option>
                                                        <option value="1">Square</option>
                                                        <option value="0">Horizontal</option>
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

                <div class="row g-3 justify-content-start mt-3">
                    @forelse ($ads as $row)
                        <div class="col-6 col-sm-4 col-md-3">
                            <div class="card" style="width: 18rem;">
                                <a data-fancybox="gallery" href="{{ asset($row->image) }}">
                                    <img src="{{ asset($row->image) }}" class="card-img-top"
                                        alt="{{ $row->title_en }}">
                                </a>
                                <div class="card-body px-3">
                                    <div class="row">
                                        @php
                                            $active = [];
                                            foreach ($positions as $col => $label) {
                                                if ((int) $row->$col === 1) {
                                                    $active[] = $label;
                                                }
                                            }
                                        @endphp

                                        <h6 class="text-muted">Ads Positions :</h6>
                                        <ul class="mb-2">
                                            @forelse ($active as $pos)
                                                <li class="mb-2">-{{ $pos }}</li>
                                            @empty
                                                <li>None</li>
                                            @endforelse
                                        </ul>
                                        <div class="mb-3">
                                            <code> (Ad #{{ $row->id }})</code>
                                        </div>


                                        <div class="d-flex">
                                            <!-- Edit Button -->
                                            <div class="w-50 pe-1">
                                                <a class="btn btn-primary btn-sm w-100"
                                                    href="{{ route('ads.edit', $row->id) }}">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </a>
                                            </div>

                                            <!-- Delete Button Form -->
                                            <div class="w-50 ps-1">
                                                <form method="POST" action="{{ route('ads.destroy', $row->id) }}"
                                                    onsubmit="return confirm('Are you sure you want to delete: {{ addslashes($row->title_en) }}?');">
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
                            <p class="alert alert-danger">No Ads Photo Found</p>
                        </div>
                    @endforelse

                    <!-- Pagination links -->
                    <div class="d-flex justify-content-start">
                        {{ $ads->links('pagination::bootstrap-5') }}
                    </div>
                </div>

                @if (session('ads_photo_uploaded'))
                    <div class=" alert alert-success mt-3 ">{{ session('ads_photo_uploaded') }}</div>
                @endif
            </div>
        </div>
    </div>
@endsection
