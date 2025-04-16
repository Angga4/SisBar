<!-- @extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <!-- Header -->
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center py-3 px-4">
                    <h5 class="mb-0 fw-bold">Manajemen Akun Guru</h5>
                    <a href="{{ route('guru.create') }}" class="btn btn-light text-primary fw-bold">
                        Tambah Guru
                    </a>
                </div>

                <!-- Form Pencarian -->
                <div class="px-4 pt-3">
                    <form action="{{ route('guru.index') }}" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control me-2" placeholder="Cari Nama atau Email Guru" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-dark">Cari</button>
                    </form>
                    @if(request('search'))
                        <p class="text-muted text-center mt-2">Menampilkan hasil pencarian untuk: <strong>{{ request('search') }}</strong></p>
                    @endif
                </div>

                <div class="card-body">
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
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($guru as $index => $g)
                                <tr class="text-center">
                                    <td>{{ ($guru->currentPage() - 1) * $guru->perPage() + $loop->iteration }}</td>
                                    <td class="fw-semibold">{{ $g->name }}</td>
                                    <td>{{ $g->email }}</td>
                                    <td>
                                        <a href="{{ route('guru.edit', $g->id) }}" class="btn btn-warning btn-sm me-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $g->id }}" data-bs-toggle="tooltip" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Tidak ada akun guru ditemukan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            Menampilkan {{ $guru->firstItem() }} hingga {{ $guru->lastItem() }} dari {{ $guru->total() }} data
                        </div>
                        <div>
                            {{ $guru->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Apakah Anda yakin ingin menghapus akun guru ini?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let deleteId = null;
        let deleteForm = null;

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Cegah tindakan default
                deleteId = this.getAttribute('data-id');
                deleteForm = document.getElementById('delete-form-' + deleteId);
                var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
                confirmModal.show();
            });
        });

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (deleteForm) {
                deleteForm.submit();
            }
        });

        // Auto-hide alerts
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                new bootstrap.Alert(alert).close();
            });
        }, 4000);

        // Initialize DataTable for enhanced table features
        $(document).ready(function() {
            $('#guruTable').DataTable({
                responsive: true,
                paging: false, // Disable DataTable pagination to use Laravel pagination
                searching: true,
                ordering: true,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                    infoEmpty: "Menampilkan 0 hingga 0 dari 0 entri",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                }
            });
        });
    });
</script>
@endsection -->
