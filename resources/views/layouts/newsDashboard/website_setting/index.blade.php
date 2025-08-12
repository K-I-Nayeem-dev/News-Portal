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
                                    <li class="breadcrumb-item text-muted" aria-current="page">Website Settings</li>
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
                            <h5 class="card-header text-white" style="background-color: #1B84FF">Website Setting Update</h5>
                            <div class="card-body">
                                <form method="POST" action="{{ route('website_setting.update', $web_settings->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    {{-- For Website Logo --}}
                                    <div class="mt-3 d-flex align-items-center">

                                        <div class="{{ $web_settings->logo == null ? 'col-md-12' : 'col-md-6' }}">

                                            <label class='form-label' for="logo">Website Logo (Max 1 MB Size)</label>
                                            <input type="file" name="logo" id="logo" class="form-control"
                                                autocomplete="off" value="{{ old('logo') }}">

                                            @error('logo')
                                                <p class="text-danger mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        @if ($web_settings->logo)
                                            <div class="w-100 text-center mt-4">
                                                <img src="{{ asset($web_settings->logo) }}">
                                            </div>
                                        @endif

                                    </div>


                                    {{-- For Website About us --}}
                                    <div class="mt-3">

                                        <label class='form-label' for="about_us">About Us</label>
                                        <textarea name="about_us" id="about_us" cols="30" rows="5">{{ old('about_us' ,$web_settings->about_us) }}</textarea>

                                        @error('about_us')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- For Website Address --}}
                                    <div class="mt-3">

                                        <label class='form-label' for="address">Address</label>
                                        <textarea name="address" id="address" cols="30" rows="5">{{ old('address' ,$web_settings->address) }}</textarea>

                                        @error('address')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- For Website Editor Details --}}
                                    <div class="mt-3">

                                        <label class='form-label' for="editor_details">Editor Details</label>
                                        <textarea name="editor_details" id="editor_details" cols="30" rows="5">{{ old('editor_details' ,$web_settings->editor_details) }}</textarea>

                                        @error('editor_details')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">

                                        <label class='form-label' for="advertise_link">Advertise links</label>
                                        <input name="advertise_link" class="form-control" id="advertise_link" value="{{ old('advertise_link' ,$web_settings->advertise_link) }}" placeholder="Your social link for advertising contact" />

                                        @error('advertise_link')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>



                                    <button style="background-color: #1B84FF"
                                        class="btn text-white mt-3 w-100">Update</button>
                                </form>
                            </div>
                        </div>

                        @if (session('website_setting_update'))
                            <div class=" alert alert-success mt-3 text-center">{{ session('website_setting_update') }}</div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#about_us').summernote({
                height: 150, // Set editor height
                placeholder: 'Write something here...'
            });
        });
        $(document).ready(function() {
            $('#address').summernote({
                height: 150, // Set editor height
                placeholder: 'Write something here...'
            });
        });
        $(document).ready(function() {
            $('#editor_details').summernote({
                height: 150, // Set editor height
                placeholder: 'Write something here...'
            });
        });
    </script>
@endsection
