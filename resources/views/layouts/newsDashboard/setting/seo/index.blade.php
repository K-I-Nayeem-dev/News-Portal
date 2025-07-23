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
                                    <li class="breadcrumb-item text-muted" aria-current="page">Seo Settings</li>
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
                        <h5 class="card-header text-white" style="background-color: #1B84FF">Seo</h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('seo.udpate', $seo->id) }}">
                                @csrf
                                @method('PUT')

                                <div>
                                    <label for="meta_author" class="form-label">Meta Author</label>
                                    <input id='meta_author' type="text" class="form-control" name="meta_author"
                                        value="{{ old('meta_author', $seo->meta_author) }}" autocomplete="off">
                                    <div>
                                        <label for="meta_title" class="form-label">Meta Title</label>
                                        <input id='meta_title' type="text" class="form-control" name="meta_title"
                                            value="{{ old('meta_title', $seo->meta_title) }}" autocomplete="off">
                                    </div>
                                    <div class="mt-3">
                                        <label for="meta_keyword" class="form-label">Meta Keyword</label>
                                        <input id='meta_keyword' type="text" class="form-control" name="meta_keyword"
                                            value="{{ old('meta_keyword', $seo->meta_keyword) }}" autocomplete="off">
                                    </div>
                                    <div class="mt-3">
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <input id='meta_description' type="text" class="form-control"
                                            name="meta_description"
                                            value="{{ old('meta_description', $seo->meta_description) }}"
                                            autocomplete="off">
                                    </div>
                                    <div class="mt-3">
                                        <label for="google_analytics" class="form-label">Google Analytics</label>
                                        <input id='google_analytics' type="text" class="form-control"
                                            name="google_analytics"
                                            value="{{ old('google_analytics', $seo->google_analytics) }}"
                                            autocomplete="off">
                                    </div>
                                    <div class="mt-3">
                                        <label for="goolge_verificatoins" class="form-label">Goolge Verificatoins</label>
                                        <input id='goolge_verificatoins' type="text" class="form-control"
                                            name="goolge_verificatoins"
                                            value="{{ old('goolge_verificatoins', $seo->goolge_verificatoins) }}"
                                            autocomplete="off">
                                    </div>
                                    <div class="mt-3">
                                        <label for="alexa_analytics" class="form-label">Alexa Analytics</label>
                                        <input id='alexa_analytics' type="text" class="form-control"
                                            name="alexa_analytics"
                                            value="{{ old('alexa_analytics', $seo->alexa_analytics) }}" autocomplete="off">
                                    </div>

                                    <button style="background-color: #1B84FF" class="btn text-white mt-3">Update</button>

                            </form>
                        </div>
                    </div>


                </div>
                @if (session('seo_update'))
                    <div class=" alert alert-success mt-3 ">{{ session('seo_update') }}</div>
                @endif
            </div>
        </div>
    </div>
@endsection
