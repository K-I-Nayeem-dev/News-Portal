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
                                        <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">
                                        <a class="text-muted text-decoration-none" href="{{ route('permission.index') }}">Permission</a>
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">Edit</li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">{{ $permission->id }}</li>
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
            <div class="row justify-content-center">
                <div class="col-lg-6 px-1">
                    <div class="card">
                        <h5 class="card-header text-white" style="background-color: #1B84FF">Create Permission</h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('permission.update', $permission->id) }}">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label for="name" class="form-label">Permission Name</label>
                                    <input id='name' type="text" class="form-control" name="name"
                                        value="{{ old('name', $permission->name) }}" autocomplete="off">

                                    @error('name')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button style="background-color: #1B84FF" class="btn text-white mt-3">Update</button>
                                <a style="background-color: #1B84FF" href="{{ route('permission.index') }}" class="btn text-white mt-3">Back</a>
                            </form>
                        </div>
                    </div>

                    @if (session('name'))
                        <div class="alert alert-success mt-3">{{ session('name') }}</div>
                    @endif
                </div>
            </div>


        </div>
    </div>
@endsection
