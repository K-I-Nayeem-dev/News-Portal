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
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none"
                                            href="{{ route('subdistrict.index') }}">Sub District
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">Edit Sub District</li>
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
                                <form method="POST" action="{{ route('subdistrict.update', $subdistrict->id) }}">
                                    @csrf
                                    @method('put')
                                    <div>
                                        <label for="subdistrict_en" class="form-label">Sub District English</label>
                                        <input id='subdistrict_en' type="text" class="form-control" name="subdistrict_en"
                                            value="{{ old('subdistrict_en', $subdistrict->sub_district_en) }}"
                                            autocomplete="off">

                                        @error('subdistrict_en')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>
                                    <div>
                                        <label for="subdistrict_bn" class="form-label">Sub District Bangla</label>
                                        <input id='subdistrict_bn' type="text" class="form-control" name="subdistrict_bn"
                                            value="{{ old('subdistrict_bn', $subdistrict->sub_district_bn) }}"
                                            autocomplete="off">

                                        @error('subdistrict_bn')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label" for="district">District</label>
                                        <select class="form-select" name="district" id="district" autocomplete="off">
                                            <option value="">Select District</option>
                                            @foreach ($districts as $district)
                                                <option {{ $district->id == $subdistrict->district_id ? 'selected' : ' ' }}
                                                    value="{{ $district->id }}">{{ $district->district_en }} |
                                                    {{ $district->district_bn }} </option>
                                            @endforeach
                                        </select>

                                        @error('district')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label" for="status">Status</label>
                                        <select class="form-select" name="status" id="status" autocomplete="off">
                                            <option value="">Select Status</option>
                                            <option {{ $subdistrict->status == '1' ? 'selected' : '' }} value="1">
                                                Active</option>
                                            <option {{ $subdistrict->status == '0' ? 'selected' : '' }} value="0">
                                                Deactive</option>
                                        </select>

                                        @error('status')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>

                                    <button style="background-color: #1B84FF" class="btn text-white mt-3">Update</button>
                                    <a href="{{ route('subdistrict.index') }}" style="background-color: #1B84FF"
                                        class="btn  text-white mt-3">back</a>

                                </form>
                            </div>
                        </div>

                        @if (session('subdistrict_update'))
                            <div class=" alert alert-success mt-3 ">{{ session('subdistrict_update') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
