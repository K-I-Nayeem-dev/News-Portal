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
                            <h4 class="font-weight-medium  mb-1">Dashboard</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('user.index') }}" class="text-muted text-decoration-none"
                                            href="">Users</a>
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">Edit</li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">{{ $user->name }}</li>
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
                            <h5 class="card-header text-white" style="background-color: #1B84FF">Edit User</h5>
                            <div class="card-body">
                                <form method="POST" action="{{ route('user.update', $user->id) }}">
                                    @csrf
                                    @method('put')

                                    <div class="mb-3">
                                        @if (!$user->profile_picture)
                                            <img src="{{ asset('dashboard_assets') }}/images/profile/user-1.jpg"
                                                alt="materialpro-img" class="img-fluid rounded-circle" width="250"
                                                height="200">
                                        @else
                                            <img width="250" height="200"
                                                src="{{ asset('uploads/profile_pictures/' . $user->profile_picture) }}"
                                                alt="{{ $user->name }}">
                                        @endif
                                    </div>
                                    <div>
                                        <label for="name" class="form-label">User Name</label>
                                        <input id='name' type="text" class="form-control" name="name"
                                            value="{{ old('name', $user->name) }}" autocomplete="off">

                                        @error('name')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>
                                    <div class="mt-3">
                                        <label for="email" class="form-label">User Email</label>
                                        <input id='email' type="email" class="form-control" name="email"
                                            value="{{ old('email', $user->email) }}" autocomplete="off">

                                        @error('email')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>

                                    <div class="row">
                                        <div class="mt-3">
                                            <label class="form-label">Roles</label>
                                        </div>
                                        {{-- For Permissions select --}}
                                        @if ($roles->isNotEmpty())
                                            @foreach ($roles as $role)
                                                <div class="col-md-3 mt-3">
                                                    <input {{ $hasRoles->contains($role->id) ? 'checked' : ' ' }} type="checkbox" id="perm_{{ $role->id }}" name="role[]"
                                                        class="form-check-input" value="{{ $role->name }}">
                                                    <label for="perm_{{ $role->id }}" class="form-check-label">
                                                        {{ $role->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        @endif

                                        @error('permission')
                                            <div class="col-12">
                                                <p class="text-danger text-sm mt-2">{{ $message }}</p>
                                            </div>
                                        @enderror
                                    </div>
                                    @if ($user->phone_number)
                                        <div class="mt-3 d-flex justify-content-start">
                                            <div>
                                                <label for="number" class="form-label">Phone Number</label>
                                                <input disabled id='number' type="number" class="form-control"
                                                    name="phone_number"
                                                    value="{{ old('phone_number', $user->phone_number) }}"
                                                    autocomplete="off">
                                            </div>
                                            <div class="align-self-end ms-2">
                                                <button name="reset_phone" class="btn btn-sm btn-success rounded">Reset
                                                    Phone Number</button>
                                            </div>
                                        </div>
                                    @else
                                        <div class="mt-3 d-flex justify-content-start">
                                            <div>
                                                <label for="number" class="form-label">Enter Phone Number</label>
                                                <input id='number' type="number" class="form-control"
                                                    name="phone_number" value="{{ old('phone_number') }}"
                                                    autocomplete="off">
                                            </div>
                                            <div class="align-self-end ms-2">
                                                <button name="add_phone_number" class="btn btn-sm btn-success rounded">Add
                                                    Phone Number</button>
                                            </div>
                                        </div>
                                        @error('add_phone_number')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    @endif

                                    <button name="update" style="background-color: #1B84FF"
                                        class="btn text-white mt-3">Update</button>
                                    <a class="btn btn-primary mt-3 ms-2" href="{{ route('user.index') }}">Back</a>

                                    @if (session('user_update'))
                                        <div x-data="{
                                            show: true,
                                            init() {
                                                setTimeout(() => {
                                                    this.show = false;
                                                }, 3000);
                                            }
                                        }" x-init="init">
                                            <div x-show="show" x-transition
                                                class="p-4 bg-green-200 alert alert-success mt-3">
                                                {{ session('user_update') }}
                                            </div>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
