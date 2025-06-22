@extends('admin.layout.app')
@section('title', 'Dashboard - Hệ thống quản lý nhân sự')
@section('sidebar-key', 'admin.dashboard')

@section('content')

    <style>
        .dashboard-main {
            min-height: 100vh;
            background: #f8f9fa;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        .widget {
            background: #fff;
            border-radius: 0.75rem;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.07);
            padding: 2rem 1.5rem;
            margin-bottom: 2rem;
            transition: transform 0.2s, box-shadow 0.2s;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .widget:hover {
            transform: translateY(-4px) scale(1.03);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.13);
        }


        .btn-group .btn {
            min-width: 120px;
        }

        .widget h3 {
            font-size: 1.15rem;
            font-weight: 600;
            color: #495057;
            margin-bottom: 1rem;
        }

        .widget p,
        .widget ul {
            margin-bottom: 0;
        }

        .widget .display-6 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .widget .text-blue {
            color: #2563eb;
        }

        .widget .text-red {
            color: #dc2626;
        }

        .widget .text-green {
            color: #16a34a;
        }

        .widget ul {
            padding-left: 1.2rem;
        }

        .widget ul li {
            margin-bottom: 0.5rem;
        }

        /* Chart container for better aspect ratio */
        .chart-container {
            position: relative;
            width: 100%;
            min-height: 260px;
            height: 260px;
            margin-top: 1rem;
        }

        .widget canvas {
            width: 100% !important;
            height: 100% !important;
            max-height: 240px;
            background: #f3f4f6;
            border-radius: 0.5rem;
            padding: 0.5rem;
        }

        @media (max-width: 991.98px) {
            .chart-container {
                min-height: 220px;
                height: 220px;
            }
        }
    </style>

    <div class="dashboard-main">
        <div class="container py-5">
            <!-- Main Content -->
            <main>
                <div class="d-flex justify-content-between mb-4">
                    <h2>Tổng quan nhân sự</h2>

                    <button class="btn btn-outline-primary">
                        Xuất file PDF
                    </button>
                    <a href="{{ route('admin.exportExcel') }}" class="btn btn-outline-success">
                        <i class="ri-file-excel-line"></i> Xuất file Excel
                    </a>
                    <button class="btn btn-outline-danger">
                        Xóa dữ liệu
                    </button>

                </div>
                <div class="row g-4">
                    <!-- Widget: Tổng số nhân viên -->
                    <div class="col-12 col-md-6 col-lg-4 d-flex">
                        <div class="widget w-100">
                            <h3>Tổng số nhân viên</h3>
                            <p class="display-6 fw-bold text-blue">150</p>
                            <p class="text-muted small">+5 so với tháng trước</p>
                        </div>
                    </div>
                    <!-- Widget: Hợp đồng sắp hết hạn -->
                    <div class="col-12 col-md-6 col-lg-4 d-flex">
                        <div class="widget w-100">
                            <h3>Hợp đồng sắp hết hạn</h3>
                            <p class="display-6 fw-bold text-red">12</p>
                            <p class="text-muted small">Trong 30 ngày tới</p>
                        </div>
                    </div>
                    <!-- Widget: Khen thưởng gần đây -->
                    <div class="col-12 col-md-6 col-lg-4 d-flex">
                        <div class="widget w-100">
                            <h3>Khen thưởng gần đây</h3>
                            <ul class="small text-secondary">
                                <li>Nguyễn Văn Thiên - Nhân viên tiêu biểu (10/05/2025)</li>
                                <li>Nguyễn Chí Thành - Nghiên cứu tiêu biểu (08/05/2025)</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Widget: Công trình khoa học -->
                    <div class="col-12 col-md-6 col-lg-6 d-flex">
                        <div class="widget w-100">
                            <h3>Công trình khoa học</h3>
                            <div class="chart-container">
                                <canvas id="researchChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- Widget: Đào tạo sau đại học -->
                    <div class="col-12 col-md-6 col-lg-6 d-flex">
                        <div class="widget w-100">
                            <h3>Đào tạo sau đại học</h3>
                            <div class="chart-container">
                                <canvas id="trainingChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- Widget: Thông báo công việc trong tháng -->
                    <div class="col-12 d-flex">
                        <div class="widget w-100">
                            <h3>Thông báo công việc trong tháng</h3>
                            <ul class="small mt-3 text-secondary">
                                <li class="mb-2">- Họp phòng nhân sự (15/05/2025)</li>
                                <li class="mb-2">- Đào tạo kỹ năng mềm (20/05/2025)</li>
                                <li>- Báo cáo tiến độ dự án (25/05/2025)</li>
                            </ul>
                            <p class="small mt-3 fst-italic text-muted">Hãy đảm bảo hoàn thành đúng hạn!</p>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <!-- Footer -->
        <footer class="bg-white py-3 text-center text-muted mt-4">
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    if (typeof Chart !== 'undefined') {
                        // Biểu đồ Công trình khoa học
                        const researchCtx = document.getElementById('researchChart').getContext('2d');
                        new Chart(researchCtx, {
                            type: 'bar',
                            data: {
                                labels: ['Bài báo', 'Sách', 'Đề tài'],
                                datasets: [{
                                    label: 'Số lượng',
                                    data: [20, 5, 10],
                                    backgroundColor: [
                                        'rgba(59, 130, 246, 0.85)',
                                        'rgba(139, 92, 246, 0.85)',
                                        'rgba(16, 185, 129, 0.85)'
                                    ],
                                    borderRadius: 8,
                                    maxBarThickness: 48
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: false
                                    },
                                    title: {
                                        display: false
                                    }
                                },
                                animation: {
                                    duration: 1000,
                                    easing: 'easeOutQuart'
                                },
                                scales: {
                                    x: {
                                        grid: {
                                            display: false
                                        }
                                    },
                                    y: {
                                        beginAtZero: true,
                                        grid: {
                                            color: '#e5e7eb'
                                        }
                                    }
                                }
                            }
                        });

                        // Biểu đồ Đào tạo sau đại học
                        const trainingCtx = document.getElementById('trainingChart').getContext('2d');
                        new Chart(trainingCtx, {
                            type: 'doughnut',
                            data: {
                                labels: ['Thạc sĩ', 'Tiến sĩ', 'Khác'],
                                datasets: [{
                                    data: [30, 15, 5],
                                    backgroundColor: [
                                        'rgba(59, 130, 246, 0.85)',
                                        'rgba(139, 92, 246, 0.85)',
                                        'rgba(16, 185, 129, 0.85)'
                                    ],
                                    borderWidth: 2
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                cutout: '65%',
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'bottom',
                                        labels: {
                                            boxWidth: 16,
                                            font: {
                                                size: 13
                                            }
                                        }
                                    }
                                },
                                animation: {
                                    duration: 1000,
                                    easing: 'easeOutQuart'
                                }
                            }
                        });
                    } else {
                        console.error('Chart.js library is not loaded.');
                    }
                });
            </script>
            <!-- Chart.js -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.min.js"></script>
        </footer>
    </div>
@endsection
