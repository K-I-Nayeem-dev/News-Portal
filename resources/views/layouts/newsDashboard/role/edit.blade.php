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
                                    <li class="breadcrumb-item text-muted" aria-current="page">Role</li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">Edit</li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">{{ $role->id }}</li>
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
                <div class="col-lg-10 px-1">
                    <div class="card">
                        <h5 class="card-header text-white" style="background-color: #1B84FF">Edit Role</h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('role.update', $role->id) }}">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label for="name" class="form-label">Role Name</label>
                                    <input id='name' type="text" class="form-control" name="name"
                                        value="{{ old('name', $role->name) }}" autocomplete="off">

                                    @error('name')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="row">
                                    {{-- For Permissions select --}}
                                    @if ($permissions->isNotEmpty())
                                        @foreach ($permissions as $permission)
                                            <div class="col-md-3 mt-3">
                                                <input {{ $hasPermissions->contains($permission->name) ? 'checked' : '' }}
                                                    type="checkbox" id="perm_{{ $permission->id }}" name="permission[]"
                                                    class="form-check-input" value="{{ $permission->name }}">
                                                <label for="perm_{{ $permission->id }}" class="form-check-label">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    @endif

                                    {{-- @if ($permissions->isNotEmpty())
                                        @foreach ($permissions as $permission)
                                            <div class="mt-3">
                                                <input type="checkbox" id="{{ $permission->id }}" name="permission[]"
                                                    class="rounded" value="{{ $permission->name }}">
                                                <label for="{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>
                                        @endforeach
                                    @endif --}}

                                    @error('permission')
                                        <div class="col-12">
                                            <p class="text-danger text-sm mt-2">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>

                                <button style="background-color: #1B84FF" class="btn text-white mt-3">Update</button>
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
