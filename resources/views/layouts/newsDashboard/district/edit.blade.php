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
                                        <a class="text-muted text-decoration-none"
                                            href="{{ route('district.index') }}">District
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">Edit District</li>
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
                            <h5 class="card-header text-white" style="background-color: #1B84FF">Edit District</h5>
                            <div class="card-body">
                                <form method="POST" action="{{ route('district.update', $district->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <label for="district_en" class="form-label">District English</label>
                                        <input id='district_en' type="text" class="form-control" name="district_en"
                                            value="{{ old('district_en', $district->district_en) }}" autocomplete="off">

                                        @error('district_en')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>
                                    <div>
                                        <label for="district_bn" class="form-label">District Bangla</label>
                                        <input id='district_bn' type="text" class="form-control" name="district_bn"
                                            value="{{ old('district_bn', $district->district_bn) }}" autocomplete="off">

                                        @error('district_bn')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label" for="status">Status</label>
                                        <select class="form-select" name="status" id="status" autocomplete="off">
                                            <option value="">Select Status</option>
                                            <option {{ $district->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                            <option {{ $district->status == 0 ? 'selected' : '' }} value="0">Deactive</option>
                                        </select>

                                        @error('status')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>

                                    <button style="background-color: #1B84FF" class="btn text-white mt-3">Update</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
