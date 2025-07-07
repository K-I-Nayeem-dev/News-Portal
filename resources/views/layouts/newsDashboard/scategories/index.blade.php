
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
                <div class="col-lg col-lg-5 px-1">
                    <div class="card">
                        <h5 class="card-header text-white" style="background-color: #1B84FF">Create Sub Category</h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('sub_categories.store') }}">
                                @csrf
                                <div>
                                    <label for="sub_categoryName" class="form-label">Sub Category name</label>
                                    <input id='sub_categoryName' type="text" class="form-control" name="sub_cate_name" value="{{ old('sub_cate_name') }}" autocomplete="off">

                                    @error('sub_cate_name')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>

                                <div class="mt-2">
                                    <label class="form-label" for="category_id">Category</label>
                                    <select class="form-select" name="category_id" id="category_id" autocomplete="off">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_en }}</option>
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
                <div class="col-lg col-lg-7 px-1">
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
                                        <th scope="col">Sub Category Name</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Actions</th>
                                        <th scope="col">Created AT</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($sub_cates as $key => $sub_cate)
                                        <tr>
                                            <th class="text-center" scope="row">{{ ++$key }}</th>
                                            <td>{{ $sub_cate->sub_cate_en }}</td>
                                            <td>{{ $sub_cate->category->category_en }}</td>
                                            <td class="d-flex  justify-content-around">
                                                <a class="btn btn-sm btn-primary"href="{{ route('sub_categories.edit', $sub_cate->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <form method="POST" action="{{ route('sub_categories.destroy', $sub_cate->id) }}" onsubmit="return confirm('Are you sure you want to delete this?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger"><i style="color: white" class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($sub_cate->created_at)->diffForHumans() }}</td>
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
                                            <td colspan="5" class="text-center">No Category Found</td>
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
