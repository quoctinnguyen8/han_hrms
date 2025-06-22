@extends('admin.layout.app') {{-- Hoặc layout admin của bạn --}}

@section('title', 'Báo cáo nhân viên theo phòng ban')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thống kê số lượng nhân viên theo phòng ban</h3>
                    </div>
                    <div class="card-body">
                        <div style="width: 80%; margin: auto;">
                            <canvas id="departmentChart"></canvas>
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
            const ctx = document.getElementById('departmentChart').getContext('2d');
            const departmentChart = new Chart(ctx, {
                type: 'bar', // hoặc 'pie'
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Số lượng nhân viên',
                        data: @json($data),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1 // Đảm bảo trục y chỉ hiển thị số nguyên nếu là số lượng
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
