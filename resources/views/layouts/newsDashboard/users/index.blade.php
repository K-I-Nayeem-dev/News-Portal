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
                                    <li class="breadcrumb-item text-muted" aria-current="page">Invite User</li>
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
                <div class="col-lg-5">
                    <div class="card">
                        <h5 class="card-header text-white" style="background-color: #1B84FF">Create User</h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('user.store') }}">

                                @csrf

                                <div class="mt-3">

                                    <label class='form-label' for="name">Name<sup><code
                                                style="font-size: 12px">*</code></sup></label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        autocomplete="off" value="{{ old('name') }}">

                                    @error('name')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>

                                <div class="mt-3">

                                    <label class='form-label' for="email">Email<sup><code
                                                style="font-size: 12px">*</code></sup></label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        autocomplete="off" value="{{ old('email') }}">

                                    @error('email')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>

                                <button class="btn btn-primary mt-3">Invite Member</button>

                            </form>

                            @if (session('invite_send'))
                                <div class=" alert alert-success mt-3 ">{{ session('invite_send') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card">
                        <h5 class="card-header text-white" style="background-color: #1B84FF">All Users</h5>
                        <div class="card-body">
                            <table class="table table-striped text-left">
                                <thead>
                                    <tr style="font-size: 12px">
                                        <th scope="col">SL</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Invited By Admin</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user)
                                        <tr style="font-size: 12px">
                                            <th>{{ ++$key }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role ? $user->role : 'Not Define' }}</td>
                                            <td class="text-center">
                                                {!! $user->invited_user !== null
                                                    ? '<i class="fa-solid fa-check text-green-500"></i>'
                                                    : '<i class="fa-solid fa-xmark text-red-500"></i>' !!}
                                            </td>
                                            <td width='100px'>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary rounded"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                                    <form method="POST"
                                                        action="{{ route('user.destroy', $user->id) }}"
                                                        onsubmit="confirm('Are you sure you want to delete {{ $user->name }}?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger"><i style="color: white" class="fa-solid fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
