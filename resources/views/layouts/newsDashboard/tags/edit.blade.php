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
                                        <a class="text-muted text-decoration-none" href="{{ route('tags.index') }}">News Tags
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">Edit Tags</li>
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
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 ">
                    <div class="card">
                        <h5 class="card-header text-white" style="background-color: #1B84FF">Edit Tags</h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('tags.update', $tag->id) }}">
                                @csrf
                                @method("PUT")
                                <div class="mt-3">

                                    <label class='form-label' for="tags_en">Tags English<sup><code
                                                style="font-size: 12px">*</code></sup></label>
                                    <input type="text" name="tags_en" id="tags_en" class="form-control"
                                        autocomplete="off" value="{{ old('tags_en', $tag->tag_en) }}">

                                    @error('tags_en')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>

                                <div class="mt-3">

                                    <label class='form-label' for="tags_bn">Tags Bangla<sup><code
                                                style="font-size: 12px">*</code></sup></label>
                                    <input type="tags_bn" name="tags_bn" id="tags_bn" class="form-control"
                                        autocomplete="off" value="{{ old('tags_bn', $tag->tag_bn) }}">

                                    @error('tags_bn')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>


                                <button class="btn btn-primary mt-3">Update</button>
                                <a href="{{ route('tags.index') }}" class="btn btn-primary ms-2 mt-3">Back</a>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
