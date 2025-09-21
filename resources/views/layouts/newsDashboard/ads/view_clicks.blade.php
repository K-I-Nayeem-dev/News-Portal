@extends('layouts.newsDashboard.dashboardMaster')

@section('dashboard')
    <div class="body-wrapper">

        <div class="container-fluid">


            <!-- -------------------------------------------------------------- -->
            <!-- Breadcrumb -->
            <!-- -------------------------------------------------------------- -->


            <div class="font-weight-medium shadow-none position-relative overflow-hidden mb-7">
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <!-- Left content -->
                    <div class="card-body px-0">
                        <h4 class="font-weight-medium mb-1">Dashboard</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none" href="{{ route('ads.performance') }}">Ads
                                        Performance</a>
                                </li>
                                <li class="breadcrumb-item text-muted" aria-current="page">View Ads Clicks</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>


            <!-- -------------------------------------------------------------- -->
            <!-- Breadcrumb End -->
            <!-- -------------------------------------------------------------- -->


            <!-- Row -->
            <div class="row">
                <div class="row justify-content-center">
                    <div class="col-lg-10 px-1">
                        <div class="card">
                            <h5 class="card-header text-white d-flex justify-content-between"
                                style="background-color: #1B84FF">
                                <span>Ad Click Details - {{ $ad->title_en }}</span>
                                <a href="{{ route('ads.performance') }}" class="btn btn-success">Ads Performance</a>
                            </h5>
                            <div class="card-body p-0 p-md-3">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered align-middle text-center">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>IP</th>
                                                <th>User Agent</th>
                                                <th>Clicked At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($clicks as $key => $click)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $click->ip }}</td>
                                                    <td>
                                                        @php
                                                            $agent = new Jenssegers\Agent\Agent();
                                                            $agent->setUserAgent($click->user_agent);
                                                            $browser = $agent->browser(); // e.g., Firefox
                                                            $version = $agent->version($browser); // e.g., 143.0
                                                            $platform = $agent->platform(); // e.g., Windows 10
                                                        @endphp
                                                        {{ $browser }} {{ $version }} on {{ $platform }}
                                                    </td>
                                                    <td>{{ $click->created_at->format('d M, Y H:i:s') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">No Clicks Found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Pagination if needed --}}
                            {{-- <div class="mt-3 px-3">
                {{ $clicks->links('pagination::bootstrap-5') }}
            </div> --}}
                        </div>
                    </div>
                </div>

            </div>

        </div>


    </div>
@endsection
