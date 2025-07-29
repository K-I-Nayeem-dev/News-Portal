@extends('layouts.newsDashboard.dashboardMaster')

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
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none"
                                            href="{{ route('division.index') }}">Division
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">Edit Division</li>
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
                <div class="d-flex justify-content-center">
                    <div class="col-lg-8 px-1">
                        <div class="card">
                            <h5 class="card-header text-white" style="background-color: #1B84FF">Edit Division</h5>
                            <div class="card-body">
                                <form method="POST" action="{{ route('division.update', $division->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <label for="division_en" class="form-label">Division English</label>
                                        <input id='division_en' type="text" class="form-control" name="division_en"
                                            value="{{ old('division_en', $division->division_en) }}" autocomplete="off">

                                        @error('division_en')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>
                                    <div class="mt-3">
                                        <label for="division_bn" class="form-label">Division Bangla</label>
                                        <input id='division_bn' type="text" class="form-control" name="division_bn"
                                            value="{{ old('division_bn', $division->division_bn) }}" autocomplete="off">

                                        @error('division_bn')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label" for="status">Status</label>
                                        <select class="form-select" name="status" id="status" autocomplete="off">
                                            <option value="">Select Status</option>
                                            <option {{ $division->status == 1 ? 'selected' : '' }} value="1">Active
                                            </option>
                                            <option {{ $division->status == 0 ? 'selected' : '' }} value="0">Deactive
                                            </option>
                                        </select>

                                        @error('status')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>

                                    <button style="background-color: #1B84FF" class="btn text-white mt-3">Update</button>
                                    <a href="{{ route('division.index') }}" class="btn btn-primary mt-3 ms-2 text-white">Back</a>

                                </form>
                            </div>
                        </div>
                        @if (session('division_update'))
                            <div class=" alert alert-success mt-3 ">{{ session('division_update') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endsection
