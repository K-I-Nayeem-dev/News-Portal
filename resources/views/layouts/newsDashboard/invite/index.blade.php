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
                            <form method="POST" action="{{ route('invitations.store') }}">

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
                            <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
