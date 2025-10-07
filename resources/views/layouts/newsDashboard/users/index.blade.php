@extends('layouts.newsDashboard.dashboard')

@section('dashboard')
    <div class="body-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumb -->
            <div class="font-weight-medium shadow-none position-relative overflow-hidden mb-7">
                <div class="card-body px-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-medium mb-0">Dashboard</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">User Management</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- First Row: Invite Form and Pending Invitations -->
            <div class="row mb-4">
                <!-- Invite User Form -->
                <div class="col-lg-6 mb-3 mb-lg-0">
                    <div class="card shadow-sm border-0">
                        <div class="card-header text-white py-3"
                            style="background: linear-gradient(135deg, #1B84FF 0%, #0d6efd 100%);">
                            <h5 class="mb-0"><i class="fa fa-user-plus me-2"></i>Invite New User</h5>
                        </div>
                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('user.store') }}">
                                @csrf

                                <div class="mb-3">
                                    <label class='form-label fw-semibold' for="name">
                                        Name<sup><code style="font-size: 12px">*</code></sup>
                                    </label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Enter full name" autocomplete="off" value="{{ old('name') }}">
                                    @error('name')
                                        <p class="text-danger mt-2 small">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class='form-label fw-semibold' for="email">
                                        Email<sup><code style="font-size: 12px">*</code></sup>
                                    </label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="user@example.com" autocomplete="off" value="{{ old('email') }}">
                                    @error('email')
                                        <p class="text-danger mt-2 small">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Assign Roles</label>
                                    <div class="row">
                                        @if ($roles->isNotEmpty())
                                            @foreach ($roles as $role)
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-check">
                                                        <input type="checkbox" id="role_{{ $role->id }}" name="role[]"
                                                            class="form-check-input" value="{{ $role->name }}">
                                                        <label for="role_{{ $role->id }}" class="form-check-label">
                                                            {{ $role->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    @error('permission')
                                        <p class="text-danger small mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-2">
                                    <i class="fa fa-paper-plane me-2"></i>Send Invitation
                                </button>
                            </form>

                            @if (session('invite_send'))
                                <div class="alert alert-success mt-3 mb-0">
                                    <i class="fa fa-check-circle me-2"></i>{{ session('invite_send') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Pending Invitations -->
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-header text-white py-3"
                            style="background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);">
                            <h5 class="mb-0"><i class="fa fa-clock me-2"></i>Pending Invitations</h5>
                        </div>
                        <div class="card-body p-0" style="max-height: 445px; overflow-y: auto;">
                            @php
                                $pendingUsers = $users->where('invited_user', 1);
                            @endphp

                            @if ($pendingUsers->isEmpty())
                                <div class="text-center py-5">
                                    <i class="fa fa-inbox text-muted" style="font-size: 48px;"></i>
                                    <p class="text-muted mt-3">No pending invitations</p>
                                </div>
                            @else
                                <div class="list-group list-group-flush">
                                    @foreach ($pendingUsers as $user)
                                        <div class="list-group-item">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center flex-grow-1">
                                                    <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                                                        <i class="fa fa-user text-warning"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">{{ $user->name }}</h6>
                                                        <small class="text-muted">{{ $user->email }}</small>
                                                        <div>
                                                            <span class="badge bg-warning text-dark small">Pending</span>
                                                            @if ($user->roles->isNotEmpty())
                                                                <span
                                                                    class="badge bg-secondary small">{{ $user->roles->pluck('name')->first() }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <form method="POST" action="{{ route('user.destroy', $user->id) }}"
                                                        onsubmit="return confirm('Cancel invitation for {{ $user->name }}?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-outline-danger">
                                                            <i class="fa-solid fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if (session('user_delete'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle me-2"></i>{{ session('user_delete') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Second Row: Active User Cards -->
            <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-header text-white py-3"
                                style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0"><i class="fa fa-users me-2"></i>Active Users</h5>
                                    <span class="badge bg-light text-dark fs-3 px-3 py-2">
                                        <i class="fa fa-newspaper me-1"></i>Total News: {{ $users->sum('news_count') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                        $activeUsers = $users->where('invited_user', 0);
                    @endphp

                    @foreach ($activeUsers as $user)
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-3">
                            <div class="card shadow-sm border-0 h-100 hover-card"
                                style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                <div class="card-body text-center p-3">
                                    <!-- User Avatar -->
                                    <div class="mb-2">
                                        @if ($user->profile_picture)
                                            <img src="{{ asset('uploads/profile_pictures/' . $user->profile_picture) }}"
                                                alt="{{ $user->name }}"
                                                class="rounded-circle border border-2 border-primary"
                                                style="width: 70px; height: 70px; object-fit: cover;">
                                        @else
                                            <div class="rounded-circle border border-2 border-primary d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10"
                                                style="width: 70px; height: 70px;">
                                                <span class="text-primary fw-bold" style="font-size: 28px;">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- User Name -->
                                    <h6 class="card-title mb-1 fw-bold">{{ $user->name }}</h6>

                                    <!-- User Email -->
                                    <p class="text-muted small mb-2" style="font-size: 11px;">
                                        <i class="fa fa-envelope me-1"></i>{{ $user->email }}
                                    </p>

                                    <!-- Role Badge -->
                                    <div class="mb-2">
                                        @if ($user->roles->isNotEmpty())
                                            @foreach ($user->roles as $role)
                                                <span class="badge rounded-pill bg-primary mb-1" style="font-size: 10px;">
                                                    <i class="fa fa-shield-alt me-1"></i>{{ $role->name }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span class="badge rounded-pill bg-secondary" style="font-size: 10px;">
                                                <i class="fa fa-user me-1"></i>No Role
                                            </span>
                                        @endif
                                    </div>

                                    <!-- News Count -->
                                    <div class="bg-light rounded p-2 mb-2">
                                        <i class="fa fa-newspaper text-primary" style="font-size: 20px;"></i>
                                        <h5 class="mb-0 mt-1 fw-bold text-primary">
                                            {{ $user->news_count ?? 0 }}
                                        </h5>
                                        <small class="text-muted" style="font-size: 10px;">News Posts</small>
                                    </div>

                                    <!-- Action Buttons -->
                                    @if ($user->id == Auth::id())
                                        <span class="badge bg-success bg-opacity-10 text-success py-1 px-2"
                                            style="font-size: 11px;">
                                            <i class="fa fa-check-circle me-1"></i>You
                                        </span>
                                    @else
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{ route('user.edit', $user->id) }}"
                                                class="btn btn-sm btn-outline-primary flex-grow-1"
                                                style="font-size: 11px; padding: 4px 8px;">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <form method="POST" action="{{ route('user.destroy', $user->id) }}"
                                                onsubmit="return confirm('Are you sure you want to delete {{ $user->name }}?')"
                                                class="flex-grow-1">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger w-100"
                                                    style="font-size: 11px; padding: 4px 8px;">
                                                    <i class="fa-solid fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if ($activeUsers->isEmpty())
                        <div class="col-12">
                            <div class="text-center py-5">
                                <i class="fa fa-users text-muted" style="font-size: 64px;"></i>
                                <p class="text-muted mt-3">No active users found</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <style>
            .hover-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
            }

            .list-group-item {
                transition: background-color 0.2s ease;
            }

            .list-group-item:hover {
                background-color: #f8f9fa;
            }

            .card {
                border-radius: 12px;
                overflow: hidden;
            }

            .card-header {
                border-bottom: none;
            }

            .btn {
                border-radius: 8px;
            }

            .form-control {
                border-radius: 8px;
            }

            .badge {
                font-weight: 500;
            }
        </style>
    @endsection
