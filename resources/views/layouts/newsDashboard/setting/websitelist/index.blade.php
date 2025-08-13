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
                                    <li class="breadcrumb-item text-muted" aria-current="page">Important Website Link</li>
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
            <div class="row g-3">
                <!-- Left column: Website Form -->
                <div class="col-12 col-lg-6 mt-3">
                    <div class="card">
                        <h5 class="card-header text-white" style="background-color: #1B84FF">Website Link Add</h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('websiteLIst.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Website name</label>
                                    <input id="name" type="text" name="name" class="form-control"
                                        value="{{ old('name') }}" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="url" class="form-label">URL</label>
                                    <input id="url" type="text" name="url" class="form-control"
                                        value="{{ old('url') }}" autocomplete="off">
                                </div>
                                <button style="background-color: #1B84FF" class="btn text-white mt-3 w-100">Create</button>
                            </form>
                        </div>
                    </div>

                    @if (session('website_add'))
                        <div class="alert alert-success mt-3">{{ session('website_add') }}</div>
                    @endif
                </div>

                <!-- Right column: Website Table -->
                <div class="col-12 col-lg-6 mt-3">
                    <div class="card">
                        <h5 class="card-header text-white d-flex justify-content-between" style="background-color: #1B84FF">
                            Website Link Add
                            <span>Total Websites: {{ $websites->count() }}</span>
                        </h5>
                        <div class="card-body  p-0 p-md-3">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="60px"  class="d-none d-md-table-cell">Sl</th>
                                            <th scope="col" width="180px">Name</th>
                                            <th scope="col">Url</th>
                                            <th scope="col" width="50px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($websites as $key => $website)
                                            <tr>
                                                <th scope="row" class="d-none d-md-table-cell">{{ ++$key }}</th>
                                                <td>{{ $website->name }}</td>
                                                <td>{{ $website->url }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <a class="btn btn-primary btn-sm"
                                                            href="{{ route('websiteLIst.edit', $website->id) }}"><i
                                                                class="fa fa-edit"></i></a>
                                                        <form method="POST"
                                                            action="{{ route('websiteLIst.destroy', $website->id) }}"
                                                            style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger ms-2 btn-sm"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="alert alert-danger text-center">No Website Found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    @if (session('website_delete'))
                        <div class="alert alert-danger mt-3">{{ session('website_delete') }}</div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
