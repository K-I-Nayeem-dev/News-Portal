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
                                    <li class="breadcrumb-item text-muted" aria-current="page">Watermark</li>
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
                <div class="col-lg-6 col-sm-6 col-md-6">
                    <div class="card">
                        <h5 class="card-header text-white" style="background-color: #1B84FF">Create Water Mark</h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('watermark.store') }}" enctype="multipart/form-data">

                                @csrf

                                <div class="mt-3">

                                    <label class='form-label' for="watermark">Water Mark<sup><code
                                                style="font-size: 12px">*</code></sup> (Max 1 MB Size)</label>
                                    <input type="file" name="watermark" id="watermark" class="form-control"
                                        autocomplete="off" value="{{ old('watermark') }}">

                                    @error('watermark')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>


                                <div class="mt-3">
                                    <label class='form-label' for="status">Status</label>

                                    <select class="form-select " name="status" id="status" autocomplete="off">

                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Deactive</option>

                                    </select>

                                    @error('status')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>

                                <button class="btn btn-primary mt-3">Make Watermark</button>

                            </form>

                            @if (session('add_watermart'))
                                <div x-data="{
                                    show: true,
                                    init() {
                                        setTimeout(() => {
                                            this.show = false;
                                        }, 3000);
                                    }
                                }" x-init="init">
                                    <div x-show="show" x-transition class="p-4 bg-green-200 alert alert-success mt-3">
                                        {{ session('add_watermart') }}
                                    </div>
                                </div>
                            @endif
                            @if (session('watermarkdelete'))
                                <div x-data="{
                                    show: true,
                                    init() {
                                        setTimeout(() => {
                                            this.show = false;
                                        }, 3000);
                                    }
                                }" x-init="init">
                                    <div x-show="show" x-transition class="p-4 bg-green-200 alert alert-danger mt-3">
                                        {{ session('watermarkdelete') }}
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6">
                    <div class="card">
                        <h5 class="card-header text-white" style="background-color: #1B84FF">All Watermarks</h5>

                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Watermark Image</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($watermarks as $key => $watermark)
                                        <tr>
                                            <th scope="row">{{ ++$key }}</th>
                                            <td><img width="300" height="20" src="{{ asset($watermark->watermark) }} "
                                                    alt="{{ $watermark->watermark }}"></td>
                                            <td>
                                                <form method="POST" action="{{ route('watermark.update', $watermark->id) }}">
                                                    @csrf
                                                    @method("PUT")
                                                    <select name="status" class="form-select" id="watermark" onchange="this.form.submit()">
                                                        <option value="">Select Status</option>
                                                        <option {{ $watermark->status == 1 ? 'selected' : '' }}
                                                            value="1">
                                                            Active</option>
                                                        <option {{ $watermark->status == 0 ? 'selected' : '' }}
                                                            value="0">
                                                            Deactive</option>
                                                    </select>
                                                </form>
                                            </td>
                                            <td class="text-center">
                                                <form method="POST"
                                                    action="{{ route('watermark.destroy', $watermark->id) }}"
                                                    onsubmit="confirm('Are you sure you want to delete?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger"><i style="color: white"
                                                            class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center"><code>No Watermark Found</code></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
