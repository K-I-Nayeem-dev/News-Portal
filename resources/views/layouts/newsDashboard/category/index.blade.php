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
                                    <li class="breadcrumb-item text-muted" aria-current="page">Category Manage</li>
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
                        <h5 class="card-header text-white" style="background-color: #1B84FF">Create Category</h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('categories.store') }}">
                                @csrf
                                <div>
                                    <label for="categoryName" class="form-label">Category name</label>
                                    <input id='categoryName' type="text" class="form-control" name="category_name"
                                        value="{{ old('category_name') }}" autocomplete="off">

                                    @error('category_name')
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

                    @if (session('cate_create'))
                        <div class=" alert alert-success mt-3 ">{{ session('cate_create') }}</div>
                    @endif

                </div>
                <div class="col-lg col-lg-7 px-1">
                    <div class="card">
                        <h5 class="card-header text-white d-flex justify-content-between" style="background-color: #1B84FF">
                            <span>All Categories</span>
                            <span>Total Categories : {{ $categories->count() }}</span>
                        </h5>
                        <div class="card-body" style="height: 400px; overflow-y: auto; overflow-x: hidden;">
                            <table class="table table-striped table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Actions</th>
                                        <th scope="col">Created AT</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($categories as $key => $category)
                                        <tr>
                                            <th class="text-center" scope="row">{{ ++$key }}</th>
                                            <td>{{ $category->category_en }}</td>
                                            <td >
                                                <div class="d-flex  justify-content-around align-items-center">
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('categories.edit', $category->id) }}"><i
                                                            class="fa-solid fa-pen-to-square"></i></a>
                                                    <form method="POST"
                                                        action="{{ route('categories.destroy', $category->id) }}"
                                                        onsubmit="return confirm('Are you sure you want to delete this?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger"><i style="color: white"
                                                                class="fa-solid fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($category->created_at)->diffForHumans() }}</td>
                                            <td class="text-center">
                                                @if ($category->status == 1)
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
                    @if (session('cate_update'))
                        <div class=" alert alert-success mt-3 ">{{ session('cate_update') }}</div>
                    @endif
                    @if (session('cate_delete'))
                        <div class=" alert alert-danger mt-3 ">{{ session('cate_delete') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
