@extends('template')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Daily Summary</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Total Harga per Hari
                </div>
                <div class="card-body">
                    <canvas id="myBarChartTotalHarga" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Total Pesanan per Hari
                </div>
                <div class="card-body">
                    <canvas id="myBarChartTotalPesanan" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Ambil data dari Laravel
            const dates = @json($dates); // Data tanggal
            const totalHarga = @json($totalHarga); // Data total harga
            const totalPesanan = @json($totalPesanan); // Data total pesanan
    
            // Konfigurasi untuk Bar Chart Total Harga
            const barChartConfigTotalHarga = {
                type: 'bar',
                data: {
                    labels: dates, // Sumbu X untuk tanggal
                    datasets: [{
                        label: 'Total Harga per Hari',
                        data: totalHarga, // Sumbu Y untuk total harga
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    }
                }
            };
    
            // Inisiasi Bar Chart Total Harga
            const barCtxTotalHarga = document.getElementById('myBarChartTotalHarga').getContext('2d');
            new Chart(barCtxTotalHarga, barChartConfigTotalHarga);
    
            // Konfigurasi untuk Bar Chart Total Pesanan
            const barChartConfigTotalPesanan = {
                type: 'bar',
                data: {
                    labels: dates, // Sumbu X untuk tanggal
                    datasets: [{
                        label: 'Total Pesanan per Hari',
                        data: totalPesanan, // Sumbu Y untuk total pesanan
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1 // Langkah per tick pada sumbu Y
                            }
                        }
                    }
                }
            };
    
            // Inisiasi Bar Chart Total Pesanan
            const barCtxTotalPesanan = document.getElementById('myBarChartTotalPesanan').getContext('2d');
            new Chart(barCtxTotalPesanan, barChartConfigTotalPesanan);
        });
    </script>
</div>
@endsection
