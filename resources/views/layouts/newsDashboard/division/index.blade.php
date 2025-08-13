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
                                    <li class="breadcrumb-item text-muted" aria-current="page">divisions</li>
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
                        <h5 class="card-header text-white" style="background-color: #1B84FF">Create division</h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('division.store') }}">
                                @csrf
                                <div>
                                    <label for="division_en" class="form-label">Division English</label>
                                    <input id='division_en' type="text" class="form-control" name="division_en"
                                        value="{{ old('division_en') }}" autocomplete="off">

                                    @error('division_en')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>
                                <div class="mt-3">
                                    <label for="division_bn" class="form-label">Division Bangla</label>
                                    <input id='division_bn' type="text" class="form-control" name="division_bn"
                                        value="{{ old('division_bn') }}" autocomplete="off">

                                    @error('division_bn')
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

                                <button style="background-color: #1B84FF" class="btn text-white mt-3 disabled">Create</button>

                            </form>
                        </div>
                    </div>

                    @if (session('division_create'))
                        <div class=" alert alert-success mt-3 ">{{ session('division_create') }}</div>
                    @endif

                </div>
                <div class="col-lg col-lg-8 px-1">
                    <div class="card">
                        <h5 class="card-header text-white d-flex justify-content-between" style="background-color: #1B84FF">
                            <span>All divisions</span>
                            <span>Total division : {{ $divisions->count() }}</span>
                        </h5>
                        <div class="card-body  p-0 p-md-5" style="height: 400px; overflow-y: auto; overflow-x: hidden;">
                            <table class="table table-striped table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col"  class="d-none d-md-table-cell">SL</th>
                                        <th scope="col">Division EN</th>
                                        <th scope="col">Division BN</th>
                                        <th scope="col">Actions</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($divisions as $key => $division)
                                        <tr>
                                            <th  class="d-none d-md-table-cell text-center" scope="row">{{ ++$key }}</th>
                                            <td>{{ $division->division_en }}</td>
                                            <td>{{ $division->division_bn }}</td>
                                            <td >
                                                <div class="d-flex  justify-content-around align-items-center">
                                                    <a class="btn btn-primary w-100"
                                                        href="{{ route('division.edit', $division->id) }}"><i
                                                            class="fa-solid fa-pen-to-square"></i></a>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if ($division->status == 1)
                                                    <span class="d-inline d-md-none text-success"
                                                        style="font-size: 1.5rem;">●</span>
                                                @else
                                                    <span class="d-inline d-md-none text-danger"
                                                        style="font-size: 1.5rem;">●</span>
                                                @endif
                                                <span class="d-none d-md-inline">
                                                    @if ($division->status == 1)
                                                        <p class="badge bg-success">Active</p>
                                                    @else
                                                        <p class="badge bg-danger">Deactive</p>
                                                    @endif
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No division Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if (session('division_create'))
                        <div class=" alert alert-success mt-3 ">{{ session('division_create') }}</div>
                    @endif
                    @if (session('division_delete'))
                        <div class=" alert alert-danger mt-3 ">{{ session('division_delete') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
