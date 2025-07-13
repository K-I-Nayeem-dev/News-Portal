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
                                    <li class="breadcrumb-item text-muted" aria-current="page">Sub Districts</li>
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
                <div class="col-lg col-lg-4 px-1">
                    <div class="card">
                        <h5 class="card-header text-white" style="background-color: #1B84FF">Create District</h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('subdistrict.store') }}">
                                @csrf
                                <div>
                                    <label for="subdistrict_en" class="form-label">Sub District English</label>
                                    <input id='subdistrict_en' type="text" class="form-control" name="subdistrict_en"
                                        value="{{ old('subdistrict_en') }}" autocomplete="off">

                                    @error('subdistrict_en')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>
                                <div>
                                    <label for="subdistrict_bn" class="form-label">Sub District Bangla</label>
                                    <input id='subdistrict_bn' type="text" class="form-control" name="subdistrict_bn"
                                        value="{{ old('subdistrict_bn') }}" autocomplete="off">

                                    @error('subdistrict_bn')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>

                                <div class="mt-2">
                                    <label class="form-label" for="district">District</label>
                                    <select class="form-select" name="district" id="district" autocomplete="off">
                                        <option value="">Select District</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->district_en }} |
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
                                        <option value="1">Active</option>
                                        <option value="0">Deactive</option>
                                    </select>

                                    @error('status')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>

                                <button style="background-color: #1B84FF" class="btn text-white mt-3">Create</button>

                            </form>
                        </div>
                    </div>

                    @if (session('subdistrict_create'))
                        <div class=" alert alert-success mt-3 ">{{ session('subdistrict_create') }}</div>
                    @endif

                </div>
                <div class="col-lg col-lg-8 px-1">
                    <div class="card">
                        <h5 class="card-header text-white d-flex justify-content-between" style="background-color: #1B84FF">
                            <span>All Sub Districts</span>
                            <span>Total Sub District : {{ $subdistricts->count() }}</span>
                        </h5>
                        <div class="card-body" style="height: 400px; overflow-y: auto; overflow-x: hidden;">
                            <table class="table table-striped table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Sub District EN</th>
                                        <th scope="col">Sub District BN</th>
                                        <th scope="col">District</th>
                                        <th scope="col">Actions</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($subdistricts as $key => $subdistrict)
                                            <tr onclick="window.location='{{ route('subdistrict.edit', $subdistrict->id) }}'" style="cursor: pointer;">
                                                <th class="text-center" scope="row">{{ ++$key }}</th>
                                                <td>{{ $subdistrict->sub_district_en }}</td>
                                                <td>{{ $subdistrict->sub_district_bn }}</td>
                                                <td>{{ $subdistrict->district->district_en . ' | ' . $subdistrict->district->district_bn }}
                                                </td>
                                                <td class="d-flex  justify-content-around align-items-center">
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('subdistrict.edit', $subdistrict->id) }}"><i
                                                            class="fa-solid fa-pen-to-square"></i></a>
                                                    <form method="POST"
                                                        action="{{ route('subdistrict.destroy', $subdistrict->id) }}"
                                                        onsubmit="return confirm('Are you sure you want to delete this?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger"><i style="color: white"
                                                                class="fa-solid fa-trash"></i></button>
                                                    </form>
                                                </td>
                                                <td class="text-center">
                                                    @if ($subdistrict->status == 1)
                                                        <p class="badge bg-success">Active</p>
                                                    @else
                                                        <p class="badge bg-danger">Deactive</p>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No SubDistrict Found</td>
                                            </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if (session('district_update'))
                        <div class=" alert alert-success mt-3 ">{{ session('district_update') }}</div>
                    @endif
                    @if (session('subdistrict_delete'))
                        <div class=" alert alert-danger mt-3 ">{{ session('subdistrict_delete') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
