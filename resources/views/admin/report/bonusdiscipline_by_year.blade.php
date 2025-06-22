{{-- // filepath: resources/views/admin/reports/bonus_discipline_by_year.blade.php --}}
@extends('admin.layout.app')

@section('title', 'Báo cáo Khen thưởng/Kỷ luật')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thống kê Khen thưởng / Kỷ luật năm {{ $selectedYear }}</h3>
                        <div class="card-tools">
                            <form method="GET" action="{{ route('admin.bonus-discipline-by-year') }}" class="form-inline">
                                <label for="year" class="mr-2">Chọn năm:</label>
                                <select name="year" id="year" class="form-control mr-2"
                                    onchange="this.form.submit()">
                                    @foreach ($availableYears as $yearOption)
                                        <option value="{{ $yearOption }}"
                                            {{ $selectedYear == $yearOption ? 'selected' : '' }}>
                                            {{ $yearOption }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="width: 90%; margin: auto;">
                            <canvas id="bonusDisciplineChart"></canvas>
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
            const ctx = document.getElementById('bonusDisciplineChart').getContext('2d');
            const bonusDisciplineChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($labels),
                    datasets: [{
                            label: 'Khen thưởng',
                            data: @json($bonusCounts),
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Kỷ luật',
                            data: @json($disciplineCounts),
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
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
