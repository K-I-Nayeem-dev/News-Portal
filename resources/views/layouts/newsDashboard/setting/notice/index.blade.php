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
                                    <li class="breadcrumb-item text-muted" aria-current="page">Notice Settings</li>
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
                            <h5 class="card-header text-white" style="background-color: #1B84FF">Announce Notice</h5>
                            <div class="card-body">
                                <form method="POST" action="{{ route('notice.udpate', $notice->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <div>
                                        <label for="notice"
                                            class="form-label d-flex justify-content-between align-items-center">
                                            <span>Notice English</span>
                                            @if ($notice->status == 1)
                                                <span>
                                                    <code class="text-danger">Want to </code><a
                                                        href="{{ route('notice.deactive', $notice->id) }}"
                                                        class="btn btn-danger">Deactive</a>
                                                </span>
                                            @else
                                                <span>
                                                    <code class="text-success">Want to </code><a
                                                        href="{{ route('notice.active', $notice->id) }}"
                                                        class="btn btn-success">Active</a>
                                                </span>
                                            @endif
                                        </label>
                                        <div>
                                            <textarea class="form-control mb-2" name="notice_en" id="notice" cols="30" rows="10">{{ old('notice', $notice->notice_en) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label for="notice_bn" class="form-label"><span>Notice Bangla</span></label>
                                        <div>
                                            <textarea class="form-control mb-2" name="notice_bn" id="notice" cols="30" rows="10">{{ old('notice', $notice->notice_bn) }}</textarea>
                                            @if ($notice->status == 1)
                                                <code class="text-success fs-3">Notice Available.</code>
                                            @else
                                                <code class="text-danger fs-3">Notice unavailable</code>
                                            @endif
                                        </div>
                                    </div>

                                    <button style="background-color: #1B84FF"
                                        class="btn text-white mt-3 w-100">Update</button>

                                </form>
                            </div>
                        </div>

                        @if (session('notice_update'))
                            <div class=" alert alert-success mt-3 text-center">{{ session('notice_update') }}</div>
                        @endif

                        @if (session('notice_active'))
                            <div class=" alert alert-success mt-3 text-center">{{ session('notice_active') }}</div>
                        @endif

                        @if (session('notice_deactive'))
                            <div class=" alert alert-danger mt-3 text-center">{{ session('notice_deactive') }}</div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
