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
                                    <li class="breadcrumb-item text-muted" aria-current="page">Districts</li>
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
                            <form method="POST" action="{{ route('district.store') }}">
                                @csrf
                                <div>
                                    <label for="district_en" class="form-label">District English</label>
                                    <input id='district_en' type="text" class="form-control" name="district_en"
                                        value="{{ old('district_en') }}" autocomplete="off">

                                    @error('district_en')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>
                                <div class="mt-3">
                                    <label for="district_bn" class="form-label">District Bangla</label>
                                    <input id='district_bn' type="text" class="form-control" name="district_bn"
                                        value="{{ old('district_bn') }}" autocomplete="off">

                                    @error('district_bn')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>

                                <div class="mt-3">
                                    <label class="form-label" for="division_id">Division</label>
                                    <select class="form-select" name="division_id" id="division_id" autocomplete="off">
                                        <option value="">Select Division</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}">
                                                {{ $division->division_en . ' | ' . $division->division_bn }}</option>
                                        @endforeach
                                    </select>

                                    @error('division_id')
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

                                <button style="background-color: #1B84FF"
                                    class="btn text-white mt-3 disabled">Create</button>

                            </form>
                        </div>
                    </div>

                    @if (session('district_create'))
                        <div class=" alert alert-success mt-3 ">{{ session('district_create') }}</div>
                    @endif

                </div>
                <div class="col-lg col-lg-8 px-1 table-responsive">
                    <div class="card">
                        <h5 class="card-header text-white d-flex justify-content-between" style="background-color: #1B84FF">
                            <span>All Districts</span>
                            <span>Total District : {{ $districts->count() }}</span>
                        </h5>
                        <div class="card-body  p-0 p-md-5" style="height: 400px; overflow-y: auto; overflow-x: hidden;">
                            <table class="table table-striped table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col" class="d-none d-md-table-cell">SL</th>
                                        <th scope="col" class="fs-2 fs-md-4">District EN</th>
                                        <th scope="col" class="d-none d-md-table-cell">District BN</th>
                                        <th scope="col" class="fs-2 fs-md-4">Division</th>
                                        <th scope="col" class="fs-2 fs-md-4">Actions</th>
                                        <th scope="col" class="fs-2 fs-md-4">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($districts as $key => $district)
                                        <tr onclick="window.location='{{ route('district.edit', $district->id) }}'"
                                            style="cursor: pointer;">
                                            <th class="d-none d-md-table-cell text-center" scope="row">
                                                {{ ++$key }}</th>
                                            <td  class="fs-2 fs-md-4">{{ $district->district_en }}</td>
                                            <td class="d-none d-md-table-cell fs-2 fs-md-4">{{ $district->district_bn }}</td>
                                            {{-- <td>{{ $district->division->division_en . ' | ' . $district->division->division_bn }} --}}
                                            <td class="fs-2 fs-md-4">
                                                <span
                                                    class="d-inline d-md-none">{{ $district->division->division_en }}</span>
                                                <span class="d-none d-md-inline">
                                                    {{ $district->division->division_en }} |
                                                    {{ $district->division->division_bn }}
                                                </span>
                                            </td>
                                            </td>
                                            <td>
                                                <div class="d-flex  justify-content-around align-items-center">
                                                    <a class="btn btn-sm btn-primary me-1 w-100"
                                                        href="{{ route('district.edit', $district->id) }}"><i
                                                            class="fa-solid fa-pen-to-square"></i></a>
                                                    {{-- <form method="POST"
                                                        action="{{ route('district.destroy', $district->id) }}"
                                                        onsubmit="return confirm('Are you sure you want to delete this?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger"><i style="color: white"
                                                                class="fa-solid fa-trash"></i></button>
                                                    </form> --}}
                                                </div>
                                            </td>
                                            <td class="text-center fs-2 fs-md-4">
                                                @if ($district->status == 1)
                                                    <span class="d-inline d-md-none text-success"
                                                        style="font-size: 1.5rem;">●</span>
                                                @else
                                                    <span class="d-inline d-md-none text-danger"
                                                        style="font-size: 1.5rem;">●</span>
                                                @endif
                                                <span class="d-none d-md-inline">
                                                    @if ($district->status == 1)
                                                        <p class="badge bg-success">Active</p>
                                                    @else
                                                        <p class="badge bg-danger">Deactive</p>
                                                    @endif
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No District Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if (session('district_delete'))
                        <div class=" alert alert-danger mt-3 ">{{ session('district_delete') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
