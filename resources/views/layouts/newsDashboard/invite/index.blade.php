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
                <div class="col-lg-5">
                    <div class="card">
                        <h5 class="card-header text-white" style="background-color: #1B84FF">Create Water Mark</h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('watermark.store') }}">

                                @csrf

                                <div class="mt-3">

                                    <label class='form-label' for="name">Name<sup><code style="font-size: 12px">*</code></sup> (Max 1 MB Size)</label>
                                    <input name="name" id="name" class="form-control" autocomplete="off" value="{{ old('name') }}">

                                    @error('name')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>

                                <div class="mt-3">

                                    <label class='form-label' for="email">Email<sup><code style="font-size: 12px">*</code></sup> (Max 1 MB Size)</label>
                                    <input name="email" id="email" class="form-control" autocomplete="off" value="{{ old('email') }}">

                                    @error('email')
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
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">

                </div>
            </div>
        </div>
    </div>
@endsection
