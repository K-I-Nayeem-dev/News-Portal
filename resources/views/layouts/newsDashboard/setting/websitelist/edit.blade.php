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
                                    <li class="breadcrumb-item text-muted" aria-current="page">
                                        <a class="text-muted text-decoration-none" href="{{ route('websiteLIst.index') }}">Important Website Link
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">Edit Website Link</li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">{{ $website->id }}</li>
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
                <div class="d-flex justify-content-between">
                    <div class="col-lg-6 offset-lg-3 mt-3 pe-2">
                        <div class="card">
                            <h5 class="card-header text-white" style="background-color: #1B84FF">Website Link Edit</h5>
                            <div class="card-body">
                                <form method="POST" action="{{ route('websiteLIst.update', $website->id) }}">
                                    @csrf
                                    @method("PUT")
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Website name</label>
                                        <div>
                                            <input id="name" type="text" name="name" class="form-control"
                                                value="{{ old('name', $website->name) }}" autocomplete="off">
                                        </div>
                                    </div>

                                    <div>
                                        <label for="url" class="form-label "">URL</label>
                                        <div>
                                            <input id='url' type="text" name="url" class="form-control"
                                                value="{{ old('url', $website->url) }}" autocomplete="off">
                                        </div>
                                    </div>

                                    <button style="background-color: #1B84FF" class="btn text-white mt-3">Update</button>
                                    <a  style="background-color: #1B84FF" href="{{ route('websiteLIst.index') }}" class="btn text-white mt-3 ms-2">Back</a>

                                </form>
                            </div>
                        </div>

                        @if (session('website_update'))
                            <div class=" alert alert-success mt-3 ">{{ session('website_update') }}</div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
