@extends('layouts.app')

@section('title', 'Dashboard Guru')

@section('content')
<div class="container-fluid guru-dashboard">
    <div class="row">
        <!-- Total Barang Card -->
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold text-muted">Total Barang</p>
                            <h5 class="font-weight-bolder mb-0 text-primary">
                                {{ \App\Models\Barang::sum('jumlah_barang') }}
                            </h5>
                            <p class="mb-0 text-sm text-muted">Barang tersedia</p>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-primary text-white rounded-circle shadow text-center" style="width : 50px; height: 50px; justify-content: center; display: flex; align-items: center;">
                                <i class="fas fa-box"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Peminjaman Card -->
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold text-muted">Total Peminjaman</p>
                            <h5 class="font-weight-bolder mb-0 text-warning">
                                {{ \App\Models\Peminjaman::where('id_users', Auth::id())->count() }}
                            </h5>
                            <p class="mb-0 text-sm text-muted">Data peminjaman</p>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-warning text-white rounded-circle shadow text-center"style="width : 50px; height: 50px; justify-content: center; display: flex; align-items: center;">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pengembalian Card -->
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold text-muted">Total Pengembalian</p>
                            <h5 class="font-weight-bolder mb-0 text-success">
                                {{ \App\Models\Pengembalian::whereHas('peminjaman', function ($query) {
                                    $query->where('id_users', Auth::id());
                                })->count() }}
                            </h5>
                            <p class="mb-0 text-sm text-muted">Data pengembalian</p>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-success text-white rounded-circle shadow text-center"style="width : 50px; height: 50px; justify-content: center; display: flex; align-items: center;">
                                <i class="fas fa-undo-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Aksi Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('guru.peminjaman.create') }}" class="btn btn-primary w-100">
                                <i class="fas fa-plus me-2"></i> Tambah Peminjaman Baru
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('guru.pengembalian.index') }}" class="btn btn-success w-100">
                                <i class="fas fa-undo-alt me-2"></i> Kelola Pengembalian
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
