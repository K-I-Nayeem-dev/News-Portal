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
                                    <li class="breadcrumb-item text-muted" aria-current="page">Permission</li>
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
                <div class="col-lg col-lg-8 px-1">
                    <div class="card">
                        <h5 class="card-header text-white d-flex justify-content-between" style="background-color: #1B84FF">
                            <span>All Permissions</span>
                            <a href="{{ route('permission.create') }}" class="btn btn-success">Create</a>
                        </h5>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col" width="60">SL</th>
                                        <th scope="col" style="text-align: left">Name</th>
                                        <th scope="col" width="150">Created</th>
                                        <th scope="col" width="120">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($permissions->isNotEmpty())
                                        @forelse($permissions as $key => $permission)
                                            <tr>
                                                <th class="text-center" scope="row" width="60">{{ ++$key }}
                                                </th>
                                                <td>{{ $permission->name }}</td>
                                                <td width="150">{{ $permission->created_at->format('d M, Y') }}</td>
                                                <td class="text-center" width="120">
                                                    <div class="d-flex justify-content-around align-items-center">
                                                        <a href="{{ route('permission.edit', $permission->id) }}"
                                                            class="btn btn-sm btn-primary me-1">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                        <form method="POST"
                                                            action="{{ route('permission.destroy', $permission->id) }}"
                                                            onsubmit="return confirm('Are you sure you want to delete this?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger">
                                                                <i style="color: white" class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No Permission Found</td>
                                            </tr>
                                        @endforelse
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if (session('permission_created'))
                        <div class="alert alert-success mt-3">{{ session('permission_created') }}</div>
                    @endif
                    @if (session('permission_update'))
                        <div class="alert alert-success mt-3">{{ session('permission_update') }}</div>
                    @endif
                    @if (session('permission_delete'))
                        <div class="alert alert-danger mt-3">{{ session('permission_delete') }}</div>
                    @endif
                    <div class="mt-3">
                        {{ $permissions->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
