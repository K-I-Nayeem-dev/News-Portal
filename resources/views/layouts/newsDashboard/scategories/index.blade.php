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
                                    <li class="breadcrumb-item text-muted" aria-current="page">Sub Category Manage</li>
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
                <div class="col-lg col-lg-4 px-1">
                    <div class="card">
                        <h5 class="card-header text-white" style="background-color: #1B84FF">Create Sub Category</h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('sub_categories.store') }}">
                                @csrf
                                <div>
                                    <label for="sub_cate_en" class="form-label">Sub Category English</label>
                                    <input id='sub_cate_en' type="text" class="form-control" name="sub_cate_en"
                                        value="{{ old('sub_cate_en') }}" autocomplete="off">

                                    @error('sub_cate_en')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>
                                <div class="mt-3">
                                    <label for="sub_cate_bn" class="form-label">Sub Category Bangla</label>
                                    <input id='sub_cate_bn' type="text" class="form-control" name="sub_cate_bn"
                                        value="{{ old('sub_cate_bn') }}" autocomplete="off">

                                    @error('sub_cate_bn')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>

                                <div class="mt-2">
                                    <label class="form-label" for="category_id">Category</label>
                                    <select class="form-select" name="category_id" id="category_id" autocomplete="off">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_en . ' | ' . $category->category_bn }}</option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>

                                <div class="mt-2">
                                    <label class="form-label" for="status">Status</label>
                                    <select class="form-select" name="status" id="status" autocomplete="off">
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Deactive</option>
                                    </select>

                                    @error('status')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>

                                <button style="background-color: #1B84FF" class="btn text-white mt-3">Create</button>

                            </form>
                        </div>
                    </div>

                    @if (session('sub_cate_create'))
                        <div class=" alert alert-success mt-3 ">{{ session('sub_cate_create') }}</div>
                    @endif

                </div>
                <div class="col-lg col-lg-8 px-1">
                    <div class="card">
                        <h5 class="card-header text-white d-flex justify-content-between" style="background-color: #1B84FF">
                            <span>All Sub Categories</span>
                            <span>Total Sub Categories : {{ $sub_cates->count() }}</span>
                        </h5>
                        <div class="card-body" style="height: 400px; overflow-y: auto; overflow-x: hidden;">
                            <table class="table table-striped table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Sub Category English</th>
                                        <th scope="col">Sub Category Bangla</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Actions</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($sub_cates as $key => $sub_cate)
                                        <tr>
                                            <th class="text-center" scope="row">{{ ++$key }}</th>
                                            <td>{{ $sub_cate->sub_cate_en }}</td>
                                            <td>{{ $sub_cate->sub_cate_bn }}</td>
                                            <td>{{ $sub_cate->category->category_en . ' | ' . $sub_cate->category->category_bn }}</td>
                                            <td>
                                                <div class="d-flex  justify-content-between align-items-center">
                                                    <a
                                                        class="btn btn-sm btn-primary me-1"href="{{ route('sub_categories.edit', $sub_cate->id) }}"><i
                                                            class="fa-solid fa-pen-to-square"></i></a>
                                                    <form method="POST"
                                                        action="{{ route('sub_categories.destroy', $sub_cate->id) }}"
                                                        onsubmit="return confirm('Are you sure you want to delete this?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger"><i style="color: white"
                                                                class="fa-solid fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if ($sub_cate->status == 1)
                                                    <p class="badge bg-success">Active</p>
                                                @else
                                                    <p class="badge bg-danger">Deactive</p>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No Sub Category Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if (session('sub_cate_update'))
                        <div class=" alert alert-success mt-3 ">{{ session('sub_cate_update') }}</div>
                    @endif
                    @if (session('sub_cate_delete'))
                        <div class=" alert alert-danger mt-3 ">{{ session('sub_cate_delete') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
