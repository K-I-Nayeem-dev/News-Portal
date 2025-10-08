@extends('layouts.newsDashboard.dashboardMaster')
@section('dashboard')
    <div class="body-wrapper">
        <div class="container-fluid">
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
                                    <li class="breadcrumb-item text-muted" aria-current="page">Track Most Viewd News</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0 text-white">News Views Tracker</h4>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive" style="overflow: hidden">
                                <table class="table align-middle table-hover table-bordered mb-0 table-striped">
                                    <thead class="table-dark text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>News Title</th>
                                            <th>IP Address</th>
                                            <th>Browser</th>
                                            <th>Device</th>
                                            <th>Total Views</th> {{-- New Column --}}
                                            <th>Viewed At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($newsViews as $key => $view)
                                            <tr>
                                                <td>{{ $loop->iteration + ($newsViews->currentPage() - 1) * $newsViews->perPage() }}
                                                </td>

                                                <td>
                                                    <div class="d-flex align-items-center" style="gap: 10px;">
                                                        {{-- Left side: thumbnail with default fallback --}}
                                                        @php
                                                            $thumbnail = $view->news->thumbnail ?? null;

                                                            $isPlaceholder = $thumbnail
                                                                ? Str::contains($thumbnail, 'via.placeholder.com')
                                                                : true;

                                                            $imageToShow =
                                                                !$isPlaceholder &&
                                                                !empty($thumbnail) &&
                                                                file_exists(public_path($thumbnail))
                                                                    ? asset($thumbnail)
                                                                    : asset(
                                                                        'uploads/default_images/deafult_thumbnail.jpg',
                                                                    );
                                                        @endphp

                                                        <img src="{{ $imageToShow }}"
                                                            alt="{{ $view->news->title_bn ?? 'News' }}" class="rounded"
                                                            style="width: 60px; height: 60px; object-fit: cover;">

                                                        {{-- Right side: title --}}
                                                        <div>
                                                            <strong
                                                                class="d-block">{{ $view->news->title_bn ?? 'No Title' }}</strong>
                                                            <small class="text-muted d-block">
                                                                {{ Str::limit($view->news->title_bn ?? '', 50) }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                </td>


                                                <td>
                                                    <span
                                                        class="badge bg-info text-dark">{{ $view->ip_address ?? 'N/A' }}</span>
                                                </td>
                                                <td>
                                                    <span class="text-truncate d-block" style="max-width: 200px;"
                                                        title="{{ $view->browser }}">
                                                        {{ $view->browser ?? 'Unknown' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($view->device_type)
                                                        <span
                                                            class="badge bg-success">{{ ucfirst($view->device_type) }}</span>
                                                    @else
                                                        <span class="badge bg-secondary">Unknown</span>
                                                    @endif
                                                </td>
                                                {{-- Total Views --}}
                                                <td class="text-center">
                                                    <span class="badge bg-primary">{{ $view->total_views ?? 0 }}</span>
                                                </td>
                                                <td>{{ $view->viewed_at ? $view->viewed_at->format('d M Y H:i') : 'N/A' }}
                                                </td>

                                                <td>
                                                    <button class="btn btn-sm btn-primary view-news-btn"
                                                        data-id="{{ $view->news_id }}">
                                                        <i class="fa fa-eye me-1"></i> View
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">No news views found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>


                        <!-- Pagination links -->
                        <div class="d-flex justify-content-end mt-3 me-2">
                            {{ $newsViews->links('pagination::bootstrap-4') }}
                        </div>


                        <!-- Optional: Add custom CSS -->
                        <style>
                            thead.table-dark th {
                                color: #fff !important;
                            }

                            .table-hover tbody tr:hover {
                                background-color: #f1f5f9 !important;
                                transform: scale(1.01);
                                transition: all 0.2s ease-in-out;
                            }

                            .badge {
                                font-size: 0.85rem;
                            }

                            .view-news-btn {
                                transition: all 0.2s ease-in-out;
                            }

                            .view-news-btn:hover {
                                transform: scale(1.05);
                            }
                        </style>

                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="newsModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">News Details</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" id="newsModalContent">
                            <!-- AJAX content will load here -->
                            <div class="text-center py-5">
                                <div class="spinner-border text-primary" role="status"></div>
                                <p class="mt-3">Loading...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    $('.view-news-btn').on('click', function() {
                        var newsId = $(this).data('id');
                        $('#newsModalContent').html(`
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="mt-3">Loading...</p>
                </div>
            `);
                        $('#newsModal').modal('show');

                        $.ajax({
                            url: '/admin/track/most-views/' + newsId,
                            type: 'GET',
                            success: function(data) {
                                $('#newsModalContent').html(data);
                            },
                            error: function() {
                                $('#newsModalContent').html(
                                    '<p class="text-danger text-center">Failed to load news!</p>');
                            }
                        });
                    });
                });
            </script>

        </div>
    </div>
@endsection
