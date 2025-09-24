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
                                    <li class="breadcrumb-item text-muted" aria-current="page">News Tags</li>
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
                        <h5 class="card-header text-white" style="background-color: #1B84FF">Create Tags</h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('tags.store') }}">
                                @csrf

                                <div class="mt-3">

                                    <label class='form-label' for="tags_en">Tags English<sup><code
                                                style="font-size: 12px">*</code></sup></label>
                                    <input type="text" name="tags_en" id="tags_en" class="form-control"
                                        autocomplete="off" value="{{ old('tags_en') }}">

                                    @error('tags_en')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>

                                <div class="mt-3">

                                    <label class='form-label' for="tags_bn">Tags Bangla<sup><code
                                                style="font-size: 12px">*</code></sup></label>
                                    <input type="tags_bn" name="tags_bn" id="tags_bn" class="form-control"
                                        autocomplete="off" value="{{ old('tags_bn') }}">

                                    @error('tags_bn')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>


                                <button class="btn btn-primary mt-3">Submit</button>

                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header text-white d-flex justify-content-between"
                            style="background-color: #1B84FF;">
                            <h5 class="text-white">All Tags</h5>
                            <h5 class="text-white">Total : {{ $tags->count() }}</h5>
                        </div>
                        <div class="card-body  p-0 p-md-3">
                            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                <table class="table table-striped text-left table-bordered">
                                    <thead>
                                        <tr style="font-size: 12px">
                                            <th scope="col" class="d-none d-md-table-cell">SL</th>
                                            <th scope="col">Tags English</th>
                                            <th scope="col" class="d-none d-md-table-cell">Tags Bangla</th>
                                            <th scope="col" class="d-none d-md-table-cell">Created At</th>
                                            <th scope="col" class="text-center">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($tags as $key => $tag)
                                            <tr style="font-size: 12px">
                                                <th class="d-none d-md-table-cell">{{ ++$key }}</th>
                                                <td>{{ $tag->tag_en }}</td>
                                                <td class="d-none d-md-table-cell">{{ $tag->tag_bn }}</td>
                                                <td class="d-none d-md-table-cell">
                                                    {{ $tag->created_at ? $tag->created_at->format('d M, Y h:i A') : '-' }}
                                                </td>
                                                <td width="100px">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <a href="{{ route('tags.edit', $tag->id) }}"
                                                            class="btn btn-sm btn-primary rounded">
                                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                                        </a>
                                                        <form method="POST" action="{{ route('tags.destroy', $tag->id) }}"
                                                            onsubmit="return confirm('Are you sure you want to delete {{ $tag->tag_en }}?')">
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
                                                <td colspan="5" class="text-center text-muted">No tags found.</td>
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
    </div>
@endsection
