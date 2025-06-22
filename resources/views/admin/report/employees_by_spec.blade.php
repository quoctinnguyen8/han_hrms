@extends('admin.layout.app')

@section('title', 'Báo cáo nhân sự theo chuyên môn')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thống kê nhân sự theo chuyên môn/ngành đào tạo</h3>
                    </div>
                    <div class="card-body">
                        <div style="width: 60%; margin: auto;"> {{-- Điều chỉnh kích thước cho biểu đồ tròn --}}
                            <canvas id="specializationChart"></canvas>
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
            const ctx = document.getElementById('specializationChart').getContext('2d');
            const specializationChart = new Chart(ctx, {
                type: 'pie', // hoặc 'bar'
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Số lượng nhân viên',
                        data: @json($data),
                        backgroundColor: [ // Thêm nhiều màu cho biểu đồ tròn
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(255, 206, 86, 0.7)',
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(153, 102, 255, 0.7)',
                            'rgba(255, 159, 64, 0.7)',
                            'rgba(199, 199, 199, 0.7)',
                            'rgba(83, 102, 255, 0.7)',
                            'rgba(40, 159, 64, 0.7)'
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                }
            });
        });
    </script>
@endsection
