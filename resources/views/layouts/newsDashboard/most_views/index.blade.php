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
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>News Title</th>
                                            <th>IP Address</th>
                                            <th>User Agent</th>
                                            <th>Device</th>
                                            <th>Viewed At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($newsViews as $view)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <strong>{{ $view->news->title_en ?? 'No Title' }}</strong>
                                                    <br>
                                                    <small
                                                        class="text-muted">{{ Str::limit($view->news->title_en ?? '', 50) }}</small>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info text-dark">{{ $view->ip_address }}</span>
                                                </td>
                                                <td>
                                                    <span class="text-truncate d-block" style="max-width: 200px;"
                                                        title="{{ $view->user_agent }}">
                                                        {{ $view->browser }}
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
                                                <td>{{ $view->viewed_at ?? $view->created_at->format('d M Y H:i') }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary view-news-btn"
                                                        data-id="{{ $view->news_id }}">
                                                        <i class="fa fa-eye me-1"></i> View
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Optional: Add custom CSS -->
                        <style>
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
