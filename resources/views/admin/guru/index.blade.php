@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Manajemen Akun Guru</h5>
                    <a href="{{ route('guru.create') }}" class="btn btn-light text-primary fw-bold">
                        <i class="fas fa-plus"></i> Tambah Guru
                    </a>
                </div>
                <div>
                                <!-- Form Pencarian -->
                    <form action="{{ route('guru.index') }}" method="GET" class="mb-3 d-flex justify-content-between">
                        <input type="text" name="search" class="form-control me-2" placeholder=" Cari Nama Guru / Gmail Guru" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-dark">Cari</button>
                    </form>

                    @if(request('search'))
                        <p class="text-muted text-center">Menampilkan hasil pencarian untuk: <strong>{{ request('search') }}</strong></p>
                    @endif
                </div>
                <div class="card-body">
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
                    </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle" id="guruTable">
                            <thead class="bg-light">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($guru as $index => $g)
                                <tr>
                                    <td>{{ $guru->firstItem() + $index }}</td>
                                    <td>{{ $g->name }}</td>
                                    <td>{{ $g->email }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('guru.edit', $g->id) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" onclick="confirmDelete({{ $g->id }})" data-bs-toggle="tooltip" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <form id="delete-form-{{ $g->id }}" action="{{ route('guru.destroy', $g->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            Menampilkan {{ $guru->firstItem() }} hingga {{ $guru->lastItem() }} dari {{ $guru->total() }} data
                        </div>
                        <div>
                            {{ $guru->links() }} <!-- ✅ Pagination Laravel -->
                        </div>
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
    let deleteId = null;
    function confirmDelete(id) {
        deleteId = id;
        var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
        confirmModal.show();
    }
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (deleteId) {
            document.getElementById('delete-form-' + deleteId).submit();
        }
    });

    // Auto-hide alerts
    setTimeout(() => {
        let alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
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
</script>
@endsection