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
                                    <li class="breadcrumb-item text-muted" aria-current="page">Social Links Settings</li>
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
                <div class="col-lg-6 offset-lg-3 mt-3">
                    <div class="card">
                        <h5 class="card-header text-white" style="background-color: #1B84FF">Social Links</h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('social.udpate', $social->id) }}">
                                @csrf
                                @method("PUT")

                                <div>
                                    <label for="facebook" class="form-label">Facebook</label>
                                    <input id='facebook' type="text" class="form-control" name="facebook" value="{{ old('facebook', $social->facebook) }}" autocomplete="off">
                                </div>
                                <div class="mt-3">
                                    <label for="instagram" class="form-label">Instagram</label>
                                    <input id='instagram' type="text" class="form-control" name="instagram" value="{{ old('instagram', $social->instagram) }}" autocomplete="off">
                                </div>
                                <div  class="mt-3">
                                    <label for="twitter" class="form-label">Twitter(X)</label>
                                    <input id='twitter' type="text" class="form-control" name="twitter" value="{{ old('twitter', $social->twitter) }}" autocomplete="off">
                                </div>
                                <div  class="mt-3">
                                    <label for="youtube" class="form-label">Youtube</label>
                                    <input id='youtube' type="text" class="form-control" name="youtube" value="{{ old('youtube', $social->youtube) }}" autocomplete="off">
                                </div>
                                <div  class="mt-3">
                                    <label for="linkedin" class="form-label">LinkedIn</label>
                                    <input id='linkedin' type="text" class="form-control" name="linkedin" value="{{ old('linkedin', $social->linkedin) }}" autocomplete="off">
                                </div>

                                <button style="background-color: #1B84FF" class="btn text-white mt-3">Update</button>

                            </form>
                        </div>
                    </div>

                    @if (session('social_update'))
                        <div class=" alert alert-success mt-3 ">{{ session('social_update') }}</div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
