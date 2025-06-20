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
                        <h5 class="card-header text-white" style="background-color: #1B84FF">Create Water Mark</h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('watermark.store') }}" enctype="multipart/form-data">

                                @csrf

                                <div class="mt-3">

                                    <label class='form-label' for="watermark">Water Mark<sup><code
                                                style="font-size: 12px">*</code></sup> (Max 1 MB Size)</label>
                                    <input type="file" name="watermark" id="watermark" class="form-control"
                                        autocomplete="off" value="{{ old('watermark') }}">

                                    @error('watermark')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>


                                <div class="mt-3">
                                    <label class='form-label' for="status">Status</label>

                                    <select class="form-select " name="status" id="status" autocomplete="off">

                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Deactive</option>
                                    </select>

                                    @error('status')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>

                                <button class="btn btn-primary mt-3">Make Watermark</button>

                            </form>

                            @if (session('news_created'))
                                <div class=" alert alert-success mt-3 ">{{ session('news_created') }}</div>
                            @endif
                            @if ($watermarks->count() > 0)
                            @else
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
