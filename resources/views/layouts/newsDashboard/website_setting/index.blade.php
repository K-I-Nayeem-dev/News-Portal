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
                    <div class="col-lg-12 mt-3 pe-2">
                        <div class="card">
                            <h5 class="card-header text-white" style="background-color: #1B84FF">Website Setting Update
                                Footer & Logo</h5>
                            <div class="card-body">
                                <form method="POST" action="{{ route('website_setting.update', $web_settings->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    {{-- For Website Logo --}}
                                    <div class="mt-3 row align-items-center">
                                        {{-- File Input --}}
                                        <div class="{{ $web_settings->logo == null ? 'col-12' : 'col-12 col-md-6' }}">
                                            <label class="form-label" for="logo">Website Logo (Max 1 MB Size)</label>
                                            <input type="file" name="logo" id="logo" class="form-control"
                                                autocomplete="off" value="{{ old('logo') }}">
                                            @error('logo')
                                                <p class="text-danger mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- Display Image --}}
                                        @if ($web_settings->logo)
                                            <div class="col-12 col-md-6 text-center mt-3 mt-md-0">
                                                <img src="{{ asset($web_settings->logo) }}" class="img-fluid"
                                                    alt="Website Logo" style="max-height: 150px;">
                                            </div>
                                        @endif
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-6">
                                            {{-- For Website About us --}}
                                            <div class="mt-3">

                                                <label class='form-label' for="about_us">About Us English</label>
                                                <textarea name="about_us" id="about_us" cols="30" rows="5">{{ old('about_us', $web_settings->about_us) }}</textarea>

                                                @error('about_us')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            {{-- For Website About us --}}
                                            <div class="mt-3">

                                                <label class='form-label' for="about_us_bangla">About Us Bangla</label>
                                                <textarea name="about_us_bangla" id="about_us_bangla" cols="30" rows="5">{{ old('about_us_bangla', $web_settings->about_us_bangla) }}</textarea>

                                                @error('about_us_bangla')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            {{-- For Website Address --}}
                                            <div class="mt-3">
                                                <label class='form-label' for="address">Address</label>
                                                <textarea name="address" id="address" cols="30" rows="5">{{ old('address', $web_settings->address) }}</textarea>

                                                @error('address')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            {{-- For Website Address --}}
                                            <div class="mt-3">
                                                <label class='form-label' for="address_bangla">Address Bangla</label>
                                                <textarea name="address_bangla" id="address_bangla" cols="30" rows="5">{{ old('address_bangla', $web_settings->address_bangla) }}</textarea>

                                                @error('address_bangla')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            {{-- For Website Editor Details --}}
                                            <div class="mt-3">

                                                <label class='form-label' for="editor_details">Editor Details</label>
                                                <textarea name="editor_details" id="editor_details" cols="30" rows="5">{{ old('editor_details', $web_settings->editor_details) }}</textarea>

                                                @error('editor_details')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-3">

                                                <label class='form-label' for="editor_details_bangla">Editor Details
                                                    Bangla</label>
                                                <textarea name="editor_details_bangla" id="editor_details_bangla" cols="30" rows="5">{{ old('editor_details_bangla', $web_settings->editor_details_bangla) }}</textarea>

                                                @error('editor_details_bangla')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mt-3">

                                                <label class='form-label' for="advertise_link">Advertise links</label>
                                                <input name="advertise_link" class="form-control" id="advertise_link"
                                                    value="{{ old('advertise_link', $web_settings->advertise_link) }}"
                                                    placeholder="Your social link for advertising contact" />

                                                @error('advertise_link')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-3">

                                                <label class='form-label' for="email">Email</label>
                                                <input name="email" type="email" class="form-control" id="email"
                                                    value="{{ old('email', $web_settings->email) }}"
                                                    placeholder="Email for Contact" />

                                                @error('email')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mt-3">
                                                <label class='form-label' for="phone">Phone</label>
                                                <input name="phone" class="form-control" id="phone"
                                                    value="{{ old('phone', $web_settings->phone) }}"
                                                    placeholder="Phone for Contact" />

                                                @error('phone')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-3">
                                                <label class='form-label' for="phone_bangla">Phone Bangla</label>
                                                <input name="phone_bangla" class="form-control" id="phone_bangla"
                                                    value="{{ old('phone_bangla', $web_settings->phone_bangla) }}"
                                                    placeholder="Phone for Contact" />

                                                @error('phone_bangla')
                                                    <p class="text-danger mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button style="background-color: #1B84FF"
                                            class="btn text-white mt-4 w-25">Update</button>
                                    </div>

                                </form>
                            </div>
                        </div>

                        @if (session('website_setting_update'))
                            <div class=" alert alert-success mt-3 text-center">{{ session('website_setting_update') }}
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Select all IDs at once
            $('#about_us, #address, #editor_details, #about_us_bangla, #address_bangla, #editor_details_bangla')
                .summernote({
                    height: 150, // Set editor height
                    placeholder: 'Write something here...'
                });
        });
    </script>
@endsection
