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
                                        <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">Bandwidth Usage (All months)
                                    </li>
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
                @foreach ($bandwidths as $bw)
                    @php
                        $dailyData = is_string($bw->daily_data) ? json_decode($bw->daily_data, true) : $bw->daily_data;
                    @endphp

                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm border-0 h-100 overflow-hidden"
                            style="border-radius: 0.75rem; background: linear-gradient(135deg,#6a11cb,#2575fc);">
                            <div class="card-body text-white p-3">

                                <!-- Header -->
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <h4 class="fw-bold mb-3" style="color: white !important;">{{ $bw->month }}</h4>
                                        <small class="text-warning">Total Usage</small>
                                    </div>
                                    <div
                                        class="bg-white bg-opacity-10 rounded-circle p-2 d-flex align-items-center justify-content-center">
                                        <iconify-icon icon="solar:server-square-linear"
                                            class="fs-5 text-white"></iconify-icon>
                                    </div>
                                </div>

                                <!-- Total Value -->
                                <h4 class="fw-bold mb-2 text-white">
                                    {{ function_exists('formatBytes') ? formatBytes($bw->used_bytes) : number_format($bw->used_bytes / (1024 * 1024), 2) . ' MB' }}
                                </h4>

                                <!-- Sparkline -->
                                <div id="bw-spark-{{ $bw->id }}" style="min-height:40px;"></div>

                                <!-- Daily Breakdown -->
                                <details class="mt-2">
                                    <summary class="fw-semibold text-white small">📊 Daily Breakdown</summary>
                                    <div class="mt-2 bg-light rounded p-2"
                                        style="max-height:150px; overflow-y:auto; font-size:13px;">
                                        <table class="table table-sm table-striped table-bordered mb-0">
                                            <tbody>
                                                @foreach ($dailyData ?? [] as $date => $bytes)
                                                    <tr>
                                                        <td>{{ \Carbon\Carbon::parse($date)->format('d M') }}</td>
                                                        <td>
                                                            {{ function_exists('formatBytes')
                                                                ? formatBytes((int) $bytes)
                                                                : number_format($bytes / (1024 * 1024), 2) . ' MB' }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </details>

                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // allChartsData defined by AppServiceProvider (id => series array in MB)
            var charts = {!! json_encode($allChartsData ?? []) !!};

            Object.keys(charts).forEach(function(id) {
                var data = charts[id] || [];
                var el = document.querySelector('#bw-spark-' + id);
                if (!el) return;

                var options = {
                    chart: {
                        type: 'line',
                        height: 50,
                        sparkline: {
                            enabled: true
                        }
                    },
                    series: [{
                        data: data
                    }],
                    stroke: {
                        curve: 'smooth',
                        width: 2
                    },
                    colors: ['#ffffff'],
                    tooltip: {
                        theme: 'dark',
                        y: {
                            formatter: function(val) {
                                return val + ' MB';
                            }
                        }
                    }
                };

                new ApexCharts(el, options).render();
            });
        });
    </script>
@endsection
