@extends('layouts.app')

@section('content')
<div class="container">
    

    <!-- Notifikasi -->
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-4 fw-black text-dark">Manajemen Barang</h4>
        <a href="{{ route('barang.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Barang</a>
    </div>
        <div>
            <!-- Form Pencarian -->
            <form action="{{ route('barang.index') }}" method="GET" class="mb-3 d-flex justify-content-between">
            <input type="text" name="search" class="form-control me-2" placeholder=" Cari Nama Barang" value="{{ request('search') }}">
            <button type="submit" class="btn btn-dark">Cari</button>
            </form>

            @if(request('search'))
            <p class="text-muted text-center">Menampilkan hasil pencarian untuk: <strong>{{ request('search') }}</strong></p>
            @endif
        </div>
        <!-- Tabel Barang -->
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
                    <td>{{ ($barang->currentPage() - 1) * $barang->perPage() + $loop->iteration }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $b->gambar) }}" alt="Gambar {{ $b->nama_barang }}" class="rounded" width="60">
                    </td>
                    <td class="fw-semibold">{{ $b->nama_barang }}</td>
                    <td>{{ $b->jumlah_barang }}</td>
                    <td>{{ $b->keterangan }}</td>
                    <td>
                        <a href="{{ route('barang.edit', $b->id) }}" class="btn btn-warning btn-sm me-1">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $b->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Tidak ada barang ditemukan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div>
        {{ $barang->links() }} <!-- Pagination links -->
    </div>
    
<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-danger" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                <p class="fw-semibold">Apakah Anda yakin ingin menghapus barang ini?</p>
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        let form = document.getElementById('deleteForm');
        form.action = `/admin/barang/${id}`;
        let modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }
</script>
@endsection
