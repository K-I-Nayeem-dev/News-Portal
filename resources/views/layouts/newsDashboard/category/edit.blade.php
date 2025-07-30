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
                                <form method="POST" action="{{ route('categories.update', $category->id) }}">
                                    @csrf
                                    @method('put')
                                    <div>
                                        <label for="category_en" class="form-label">Category English</label>
                                        <input id='category_en' type="text" class="form-control" name="category_en"
                                            value="{{ old('category_en',$category->category_en) }}" autocomplete="off">

                                        @error('category_en')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>
                                    <div class="mt-3">
                                        <label for="category_bn" class="form-label">Category Bangla</label>
                                        <input id='category_bn' type="text" class="form-control" name="category_bn"
                                            value="{{ old('category_bn',$category->category_bn) }}" autocomplete="off">

                                        @error('category_bn')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label" for="status">Status</label>
                                        <select class="form-select" name="status" id="status" autocomplete="off">
                                            <option value="">Select Status</option>
                                            <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Deactive
                                            </option>
                                        </select>

                                        @error('status')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                    </div>

                                    <button style="background-color: #1B84FF" class="btn text-white mt-3">Update</button>
                                    <a class="btn btn-primary mt-3 ms-2" href="{{ route('categories.index') }}">Back</a>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
