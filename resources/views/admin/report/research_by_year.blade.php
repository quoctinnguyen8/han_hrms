{{-- // filepath: resources/views/admin/reports/research_by_year.blade.php --}}
@extends('admin.layout.app')

@section('title', 'Báo cáo Nghiên cứu Khoa học')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thống kê Đề tài / Bài báo khoa học ({{ $startYear }} - {{ $endYear }})
                        </h3>
                        <div class="card-tools">
                            <form method="GET" action="{{ route('admin.research-by-year') }}" class="form-inline">
                                <label for="start_year" class="mr-2">Từ năm:</label>
                                <select name="start_year" id="start_year" class="form-control mr-2">
                                    @foreach ($availableYears as $yearOption)
                                        <option value="{{ $yearOption }}"
                                            {{ $startYear == $yearOption ? 'selected' : '' }}>
                                            {{ $yearOption }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="end_year" class="mr-2">Đến năm:</label>
                                <select name="end_year" id="end_year" class="form-control mr-2">
                                    @foreach ($availableYears as $yearOption)
                                        <option value="{{ $yearOption }}" {{ $endYear == $yearOption ? 'selected' : '' }}>
                                            {{ $yearOption }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm">Xem</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="width: 90%; margin: auto;">
                            <canvas id="researchChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('researchChart').getContext('2d');
            const researchChart = new Chart(ctx, {
                type: 'line', // hoặc 'bar'
                data: {
                    labels: @json($labels),
                    datasets: [{
                            label: 'Số lượng Đề tài NCKH',
                            data: @json($topicCounts),
                            borderColor: 'rgba(54, 162, 235, 1)',
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            fill: true,
                            tension: 0.1
                        },
                        {
                            label: 'Số lượng Bài báo KH',
                            data: @json($workCounts),
                            borderColor: 'rgba(255, 159, 64, 1)',
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            fill: true,
                            tension: 0.1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: true,
                }
            });
        });
    </script>
@endsection
