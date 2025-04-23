@extends('layouts.app')

@section('title', 'Manajemen Barang')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <!-- Header -->
                <div class="card-header bg-gradient-primary d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-white fw-bold">Manajemen Barang</h5>
                    <a href="{{ route('barang.create') }}" class="btn btn-light text-primary fw-bold">
                        <i class="fas fa-plus me-2"></i> Tambah Barang
                    </a>
                </div>

                <!-- Form Pencarian -->
                <div class="card-body">
                    <form action="{{ route('barang.index') }}" method="GET" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari Nama Barang" value="{{ request('search') }}">
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

                    <!-- Tabel Data -->
                    <div class="table-responsive shadow-sm rounded">
                        <table class="table table-hover align-middle">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($barang as $index => $b)
                                <tr class="text-center">
                                    <td>{{ $barang->firstItem() + $index }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $b->gambar) }}" alt="{{ $b->nama_barang }}" class="rounded" width="60">
                                    </td>
                                    <td class="fw-semibold">{{ $b->nama_barang }}</td>
                                    <td>{{ $b->jumlah_barang }}</td>
                                    <td>{{ $b->keterangan }}</td>
                                    <td>
                                        <a href="{{ route('barang.edit', $b->id) }}" class="btn btn-warning btn-sm me-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $b->id }}" data-bs-toggle="tooltip" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <form id="delete-form-{{ $b->id }}" action="{{ route('barang.destroy', $b->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-3">Tidak ada data barang ditemukan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 gap-2">
                    <div class="text-muted small">
                        Menampilkan <strong>{{ $barang->firstItem() ?? 0 }}</strong> hingga <strong>{{ $barang->lastItem() ?? 0 }}</strong> dari <strong>{{ $barang->total() }}</strong> data
                    </div>
                    <div>
                        {{ $barang->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                <p class="fw-semibold">Apakah Anda yakin ingin menghapus barang ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let deleteId = null;
        let deleteForm = null;

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                deleteId = this.getAttribute('data-id');
                deleteForm = document.getElementById('delete-form-' + deleteId);
                let modal = new bootstrap.Modal(document.getElementById('confirmModal'));
                modal.show();
            });
        });

        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            if (deleteForm) {
                deleteForm.submit();
            }
        });

        // Auto-hide alerts
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 4000);

        // Tooltip
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(el => new bootstrap.Tooltip(el));
    });
</script>
@endpush

@endsection
