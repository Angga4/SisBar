@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid">
    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Barang</p>
                                <h5 class="font-weight-bolder mb-0 text-primary">
                                    {{ $totalBarang }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-primary text-white rounded-circle shadow text-center "style="width : 50px; height: 50px; justify-content: center; display: flex; align-items: center;">
                                <i class="fas fa-box fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Guru</p>
                                <h5 class="font-weight-bolder mb-0 text-success">
                                    {{ $totalGuru }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-success text-white rounded-circle shadow text-center"style="width : 50px; height: 50px; justify-content: center; display: flex; align-items: center;">
                                <i class="fas fa-user-tie fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.dashboard') }}" class="d-flex align-items-center">
                <label for="filter" class="me-2 mb-0">Filter:</label>
                <select name="filter" id="filter" class="form-select w-auto" onchange="this.form.submit()">
                    <option value="bulan" {{ $filter == 'bulan' ? 'selected' : '' }}>Bulanan</option>
                    <option value="minggu" {{ $filter == 'minggu' ? 'selected' : '' }}>Mingguan</option>
                </select>
            </form>
        </div>
    </div>

    <!-- Charts -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Statistik Peminjaman</h6>
                </div>
                <div class="card-body">
                    <canvas id="peminjamanChart" height="300"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Statistik Pengembalian</h6>
                </div>
                <div class="card-body">
                    <canvas id="pengembalianChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let peminjamanValues = {!! json_encode($peminjamanChart) !!};
        let pengembalianValues = {!! json_encode($pengembalianChart) !!};
        let labels = {!! json_encode($labels) !!};

        let filter = "{{ $filter }}";

        // Chart configuration
        const chartConfig = {
            type: 'line',
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: true, position: 'top' }
                },
                scales: {
                    x: { display: true },
                    y: { display: true, beginAtZero: true }
                }
            }
        };

        // Peminjaman Chart
        new Chart(document.getElementById('peminjamanChart').getContext('2d'), {
            ...chartConfig,
            data: {
                labels: labels,
                datasets: [{
                    label: 'Peminjaman',
                    data: peminjamanValues,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            }
        });

        // Pengembalian Chart
        new Chart(document.getElementById('pengembalianChart').getContext('2d'), {
            ...chartConfig,
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pengembalian',
                    data: pengembalianValues,
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            }
        });
    });
</script>
@endpush
@endsection
