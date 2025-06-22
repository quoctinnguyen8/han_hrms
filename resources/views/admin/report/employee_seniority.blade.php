{{-- // filepath: resources/views/admin/reports/employee_seniority.blade.php --}}
@extends('admin.layout.app')

@section('title', 'Báo cáo thâm niên công tác')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thống kê thâm niên công tác</h3>
                    </div>
                    <div class="card-body">
                        <div style="width: 80%; margin: auto;">
                            <canvas id="seniorityChart"></canvas>
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
            const ctx = document.getElementById('seniorityChart').getContext('2d');
            const seniorityChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Số lượng nhân viên',
                        data: @json($data),
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }]
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
