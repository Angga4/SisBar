@extends('layouts.app')

@section('title', 'Daftar Peminjaman')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Daftar Peminjaman</h5>
                    <a href="{{ route('guru.peminjaman.create') }}" class="btn btn-light text-primary fw-bold">
                        <i class="fas fa-plus me-2"></i> Tambah Peminjaman
                    </a>
                </div>

                <div class="card-body">
                    <!-- Form Pencarian -->
                    <form action="{{ route('guru.peminjaman.index') }}" method="GET" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="🔍 Cari Nama Siswa..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-dark">
                                <i class="fas fa-search me-1"></i> Cari
                            </button>
                        </div>
                    </form>

                    @if(request('search'))
                        <div class="alert alert-info">
                            Menampilkan hasil pencarian untuk: <strong>{{ request('search') }}</strong>
                        </div>
                    @endif

                    <!-- Notifikasi -->
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Jika Tidak Ada Data -->
                    @if($peminjaman->isEmpty())
                        <div class="alert alert-warning text-center">
                            @if(request('search'))
                                <i class="fas fa-exclamation-circle me-2"></i> Tidak ada hasil pencarian untuk: <strong>{{ request('search') }}</strong>
                            @else
                                <i class="fas fa-info-circle me-2"></i> Belum ada data peminjaman.
                            @endif
                        </div>
                    @else
                        <div class="table-responsive shadow-sm rounded">
                            <table class="table table-hover align-middle">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th>Barang</th>
                                        <th>Jumlah</th>
                                        <th>Tempat</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($peminjaman as $key => $pinjam)
                                    <tr>
                                        <td class="text-center">{{ $peminjaman->firstItem() + $key }}</td>
                                        <td>{{ $pinjam->nama_siswa }}</td>
                                        <td>{{ $pinjam->kelas_jurusan }}</td>
                                        <td>
                                            @foreach ($pinjam->detailPeminjaman as $detail)
                                                <div class="mb-1">{{ $detail->barang->nama_barang }} ({{ $detail->jumlah_pinjam }})</div>
                                            @endforeach
                                        </td>
                                        <td class="text-center"><strong>{{ $pinjam->total_barang }}</strong></td>
                                        <td>{{ $pinjam->tempat_peminjaman }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->translatedFormat('d F Y') }}</td>
                                        <td class="text-center">
                                            <span class="badge {{ $pinjam->status_barang == 'Sudah Dikembalikan' ? 'bg-success' : 'bg-warning' }}">
                                                {{ $pinjam->status_barang }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 gap-2">
                        <div class="text-muted small">
                            Menampilkan <strong>{{ $peminjaman->firstItem() ?? 0 }}</strong> hingga <strong>{{ $peminjaman->lastItem() ?? 0 }}</strong> dari <strong>{{ $peminjaman->total() }}</strong> data
                        </div>
                        <div>
                            {{ $peminjaman->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto-hide alerts
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 4000);
</script>
@endpush
@endsection
