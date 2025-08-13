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
                <div class="col-lg col-lg-12 px-1">
                    <div class="card">
                        <h5 class="card-header text-white d-flex justify-content-between" style="background-color: #1B84FF">
                            <span>All Role</span>
                            <a href="{{ route('role.create') }}" class="btn btn-success">Create</a>
                        </h5>
                        <div class="card-body  p-0 p-md-3">
                            <table class="table table-striped table-bordered">
                                <thead class="bg-gray-50 rounded">
                                    <tr class="border-b">
                                        <th class="px-6 py-3 text-left d-none d-md-table-cell" width="60">#</th>
                                        <th class="px-6 py-3 text-left">Name</th>
                                        <th class="px-6 py-3 text-left">Permissions</th>
                                        <th class="px-6 py-3 text-left d-none d-md-table-cell" width="150" >Created</th>
                                        <th class="px-6 py-3 text-center" width="120">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @if ($roles->isNotEmpty())
                                        @forelse ($roles as $role)
                                            <tr class="border-b">
                                                <td class="px-6 py-3 d-none d-md-table-cell" width="60">
                                                    {{ $role->id }}
                                                </td>
                                                <td class="px-6 py-3 text-left">
                                                    {{ $role->name }}
                                                </td>
                                                <td class="px-6 py-3 text-left">
                                                    {{ $role->permissions->pluck('name')->implode(' , ') }}
                                                </td>
                                                <td class="px-6 py-3 text-left d-none d-md-table-cell" width="150">
                                                    {{ $role->created_at->format('d M, Y') }}
                                                </td>
                                                <td class="text-center" width="120">
                                                    <div class="d-flex justify-content-around align-items-center">
                                                        <a href="{{ route('role.edit', $role->id) }}"
                                                            class="btn btn-sm btn-primary me-1">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                        <form method="POST" action="{{ route('role.destroy', $role->id) }}"
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
                                        @endforelse
                                    @else
                                        <tr>
                                            <td class="px-6 py-3 text-center" colspan="5">
                                                <p>No Roles Found</p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if (session('role_created'))
                        <div class="alert alert-success mt-3">{{ session('role_created') }}</div>
                    @endif
                    @if (session('role_update'))
                        <div class="alert alert-success mt-3">{{ session('role_update') }}</div>
                    @endif
                    @if (session('role_delete'))
                        <div class="alert alert-danger mt-3">{{ session('role_delete') }}</div>
                    @endif
                    <div class="mt-3">
                        {{ $roles->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
