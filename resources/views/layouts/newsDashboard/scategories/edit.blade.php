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
                            <h4 class="font-weight-medium  mb-0">Dashboard</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="">Home
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">Category Edit</li>
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
                            <h5 class="card-header text-white" style="background-color: #1B84FF">Edit Category</h5>
                            <div class="card-body">
                                <form method="POST" action="{{ route('sub_categories.update', $sub_cate->id) }}">
                                    @csrf
                                    @method('put')
                                    <div>
                                        <label for="SubcategoryName" class="form-label">Sub Category name</label>
                                        <input id='SubcategoryName' type="text" class="form-control" name="sub_cate_name" value="{{ old('sub_cate_name', $sub_cate->sub_cate_name) }}" autocomplete="off">

                                        @error('sub_cate_name')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label" for="status">Category Name</label>
                                        <select class="form-select select2" name="category_id" id="status" autocomplete="off" size="6" style="height: 150px; overflow-y: auto;">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $cate)
                                                <option value="{{ $cate->id }}" {{ $cate->id == $sub_cate->category->id ? 'selected' : ''}}>{{ $cate->category_name }}</option>
                                            @endforeach
                                        </select>

                                        @error('status')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label" for="status">Status</label>
                                        <select class="form-select" name="status" id="status" autocomplete="off">
                                            <option value="">Select Status</option>
                                            <option value="1" {{ $sub_cate->status == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ $sub_cate->status == 0 ? 'selected' : '' }}>Deactive
                                            </option>
                                        </select>

                                        @error('status')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>

                                    <button style="background-color: #1B84FF" class="btn text-white mt-3">Update</button>
                                    <a class="btn btn-primary mt-3 ms-2" href="{{ route('sub_categories.index') }}">Back</a>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
