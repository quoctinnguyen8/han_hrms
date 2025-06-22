@extends('admin.layout.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Báo Cáo Thống Kê Nhân Viên Theo Loại Hợp Đồng</h2>
        <div style="width: 80%; margin: auto;">
            <canvas id="contractTypeChart"></canvas>
        </div>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Loại Hợp Đồng</th>
                    <th>Số Lượng Nhân Viên</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contractData as $index => $row)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $row->contract_type }}</td>
                        <td>{{ $row->employees_count }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Không có dữ liệu</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @section('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('contractTypeChart').getContext('2d');
                const contractTypeChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: @json($contractData->pluck('contract_type')),
                        datasets: [{
                            label: 'Số lượng nhân viên',
                            data: @json($contractData->pluck('employees_count')),
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
@endsection
