@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Biểu đồ doanh thu</h2>
    <canvas id="revenueChart" style="max-width: 100%;"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');

    // Tạo màu gradient cho từng cột
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(66, 69, 64, 0.5)'); // Màu đầu
    gradient.addColorStop(1, 'rgba(16, 63, 40, 0.5)'); // Màu cuối

    const revenueChart = new Chart(ctx, {
        type: 'bar', // Vẽ biểu đồ cột
        data: {
            labels: @json($dates), // Các ngày
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: @json($revenues), // Tổng doanh thu
                backgroundColor: gradient, // Màu gradient
                borderColor: 'rgba(37, 69, 25, 0.5)', // Viền cột
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Ngày' // Tiêu đề trục x
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Doanh thu (VNĐ)' // Tiêu đề trục y
                    },
                    beginAtZero: true // Bắt đầu từ 0
                }
            }
        }
    });
</script>
@endsection
