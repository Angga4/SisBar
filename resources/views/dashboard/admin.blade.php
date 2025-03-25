@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Kartu Total Barang -->
        <div class="col-md-6">
            <div class="card shadow-sm p-3 mb-4 text-center">
                <h5 class="fw-bold">Total Barang</h5>
                <h2 class="text-primary">{{ $totalBarang }}</h2>
            </div>
        </div>

        <!-- Kartu Total Guru -->
        <div class="col-md-6">
            <div class="card shadow-sm p-3 mb-4 text-center">
                <h5 class="fw-bold">Total Guru</h5>
                <h2 class="text-success">{{ $totalGuru }}</h2>
            </div>
        </div>
    </div>

    <!-- Filter Mingguan / Bulanan -->
    <div class="mb-4">
        <form method="GET" action="{{ route('admin.dashboard') }}">
            <label for="filter">Filter:</label>
            <select name="filter" id="filter" class="form-select w-auto d-inline" onchange="this.form.submit()">
                <option value="bulan" {{ $filter == 'bulan' ? 'selected' : '' }}>Bulanan</option>
                <option value="minggu" {{ $filter == 'minggu' ? 'selected' : '' }}>Mingguan</option>
            </select>
        </form>
    </div>

    <!-- Statistik Peminjaman -->
    <h2>Statistik Peminjaman</h2>
    <canvas id="peminjamanChart"></canvas>

    <!-- Statistik Pengembalian -->
    <h2 class="mt-5">Statistik Pengembalian</h2>
    <canvas id="pengembalianChart"></canvas>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let peminjamanValues = {!! json_encode($peminjamanChart) !!};
        let pengembalianValues = {!! json_encode($pengembalianChart) !!};
        let labels = {!! json_encode($labels) !!};

        let filter = "{{ $filter }}";

        new Chart(document.getElementById('peminjamanChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Peminjaman',
                    data: peminjamanValues,
                    borderColor: 'blue',
                    fill: false,
                    tension: 0.2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true, position: 'top' }
                },
                scales: {
                    x: { display: true },
                    y: { display: true }
                }
            }
        });

        new Chart(document.getElementById('pengembalianChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pengembalian',
                    data: pengembalianValues,
                    borderColor: 'green',
                    fill: false,
                    tension: 0.2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true, position: 'top' }
                },
                scales: {
                    x: { display: true },
                    y: { display: true }
                }
            }
        });
    });
</script>

@endsection
