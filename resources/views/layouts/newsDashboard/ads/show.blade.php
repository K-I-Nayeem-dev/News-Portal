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
                                <li class="breadcrumb-item text-muted" aria-current="page">Ads Performance</li>
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
                                <span>Ad Performance</span>
                                <a href="{{ route('ads.index') }}" class="btn btn-success">Create Ad</a>
                            </h5>
                            <div class="card-body p-0 p-md-3">
                                <table class="table table-bordered table-hover align-middle text-center">
                                    <thead class="text-center">
                                        <tr>
                                            <th scope="col" width="60">#</th>
                                            <th scope="col" width="150" class="d-none d-md-table-cell">Ad Image</th>
                                            <th scope="col" width="120">Total Clicks</th>
                                            <th scope="col" width="120">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($ads as $key => $ad)
                                            <tr>
                                                <td class="text-center">{{ ++$key }}</td>

                                                {{-- Image Card --}}
                                                <td>
                                                    <div class="d-flex justify-content-center align-items-center"
                                                        style="height: 120px;">
                                                        <img src="{{ file_exists(public_path($ad->image))
                                                            ? asset($ad->image)
                                                            : asset('frontend_assets/img/ads-img/ad-300x250-1.jpg') }}"
                                                            alt="{{ $ad->title_en }}" class="img-fluid rounded"
                                                            style="max-height: 100px;">
                                                    </div>
                                                </td>

                                                {{-- Clicks Card --}}
                                                <td>
                                                    <div class="d-flex justify-content-center align-items-center"
                                                        style="height: 120px;">
                                                        <span
                                                            class="badge bg-success fs-3 px-4 py-2">{{ $ad->clicks_count }}</span>
                                                    </div>
                                                </td>

                                                {{-- Actions --}}
                                                <td>
                                                    <div class="d-flex justify-content-around align-items-center">
                                                        <a href="{{ route('ads.view', $ad->id) }}" class="btn rounded btn-primary me-1">
                                                            View Ad Performance
                                                        </a>
                                                        </form>
                                                    </div>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">No Ads Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            {{-- <div class="mt-3 px-3">
                                {{ $ads->links('pagination::bootstrap-5') }}
                            </div> --}}
                        </div>
                    </div>
                </div>



            </div>

        </div>


    </div>
@endsection
