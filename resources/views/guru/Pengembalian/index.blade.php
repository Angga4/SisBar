@extends('layouts.app')

@section('title', 'Pengembalian Barang')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-gradient-primary text-white">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-undo-alt me-2"></i> Daftar Barang yang Dipinjam</h5>
                </div>

                <div class="card-body">
                    <!-- Form Pencarian -->
                    <form action="{{ route('guru.pengembalian.index') }}" method="GET" class="mb-4">
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
                    @if($pengembalian->isEmpty()) 
                        <div class="alert alert-warning text-center">
                            @if(request('search'))
                                <i class="fas fa-exclamation-circle me-2"></i> Tidak ada hasil pencarian untuk: <strong>{{ request('search') }}</strong>
                            @else
                                <i class="fas fa-info-circle me-2"></i> Belum ada data pengembalian.
                            @endif
                        </div>
                    @else
                        <div class="table-responsive shadow-sm rounded">
                            <table class="table table-hover align-middle">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Barang</th>
                                        <th>Nama Siswa</th>
                                        <th>Status Barang</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengembalian as $item)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-start">
                                                @foreach ($item->peminjaman->detailPeminjaman as $detail)
                                                    <div class="mb-1">{{ $detail->barang->nama_barang ?? 'Data Tidak Ditemukan' }} ({{ $detail->jumlah_pinjam }})</div>
                                                @endforeach
                                            </td>
                                            <td class="text-start">{{ $item->peminjaman->nama_siswa ?? 'Data Tidak Ditemukan' }}</td>
                                            <td>
                                                <span class="badge {{ $item->status_barang === 'Sudah dikembalikan' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $item->status_barang === 'Sudah dikembalikan' ? 'Sudah Dikembalikan' : 'Belum Dikembalikan' }}
                                                </span>
                                            </td>
                                            <td>
                                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $item->id }}">
                                                    <i class="fas fa-info-circle me-1"></i> Detail
                                                </button>
                                                @if ($item->status_barang !== 'Sudah dikembalikan')
                                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalKembalikan{{ $item->id }}">
                                                        <i class="fas fa-undo me-1"></i> Kembalikan
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>

                                        <!-- MODAL DETAIL -->
                                        <div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-info text-white">
                                                        <h5 class="modal-title"><i class="fas fa-info-circle me-2"></i> Detail Peminjaman</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card p-3 mb-3">
                                                            <h6 class="fw-bold"><i class="fas fa-clipboard-list me-2"></i> Informasi Peminjaman</h6>
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span class="fw-bold">Nama Siswa:</span>
                                                                    <span>{{ $item->peminjaman->nama_siswa ?? 'Data Tidak Ditemukan' }}</span>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span class="fw-bold">Tanggal Pinjam:</span>
                                                                    <span>{{ \Carbon\Carbon::parse($item->peminjaman->tanggal_pinjam)->translatedFormat('d F Y') ?? 'Data Tidak Ditemukan' }}</span>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span class="fw-bold">Lokasi Peminjaman:</span>
                                                                    <span>{{ $item->peminjaman->tempat_peminjaman ?? 'Data Tidak Ditemukan' }}</span>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span class="fw-bold">Keterangan:</span>
                                                                    <span>{{ $item->peminjaman->keterangan ?? '-' }}</span>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div class="card p-3">
                                                            <h6 class="fw-bold"><i class="fas fa-box me-2"></i> Barang yang Dipinjam</h6>
                                                            <ul class="list-group list-group-flush">
                                                                @foreach ($item->peminjaman->detailPeminjaman as $detail)
                                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                        <span>{{ $detail->barang->nama_barang ?? 'Data Tidak Ditemukan' }}</span>
                                                                        <span class="badge bg-primary rounded-pill">{{ $detail->jumlah_pinjam }}</span>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>

                                                        @if ($item->status_barang === 'Sudah dikembalikan')
                                                        <div class="card p-3 mt-3">
                                                            <h6 class="fw-bold text-success"><i class="fas fa-check-circle me-2"></i> Informasi Pengembalian</h6>
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span class="fw-bold">Tanggal Kembali:</span>
                                                                    <span>{{ \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('d F Y') }}</span>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span class="fw-bold">Waktu Kembali:</span>
                                                                    <span>{{ \Carbon\Carbon::parse($item->waktu_kembali)->format('H:i') }}</span>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span class="fw-bold">Kondisi Barang:</span>
                                                                    <span>{{ ucfirst($item->kondisi_barang) }}</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- MODAL PENGEMBALIAN -->
                                        @if ($item->status_barang !== 'Sudah dikembalikan')
                                        <div class="modal fade" id="modalKembalikan{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning text-dark">
                                                        <h5 class="modal-title"><i class="fas fa-undo me-2"></i> Konfirmasi Pengembalian</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('guru.pengembalian.update', $item->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <!-- Tanggal Kembali -->
                                                            <div class="mb-3">
                                                                <label class="form-label"><i class="fas fa-calendar-day me-2"></i> Tanggal Kembali</label>
                                                                <div class="input-group">
                                                                    <input type="date" class="form-control" id="tanggalKembali{{ $item->id }}" name="tanggal_kembali" required>
                                                                    <button type="button" class="btn btn-dark" onclick="isiTanggal({{ $item->id }})">Auto</button>
                                                                </div>
                                                            </div>

                                                            <!-- Waktu Kembali -->
                                                            <div class="mb-3">
                                                                <label class="form-label"><i class="fas fa-clock me-2"></i> Waktu Kembali</label>
                                                                <div class="input-group">
                                                                    <input type="time" class="form-control" id="waktuKembali{{ $item->id }}" name="waktu_kembali" required>
                                                                    <button type="button" class="btn btn-dark" onclick="isiWaktu({{ $item->id }})">Auto</button>
                                                                </div>
                                                            </div>

                                                            <!-- Kondisi Barang -->
                                                            <div class="mb-3">
                                                                <label class="form-label"><i class="fas fa-search me-2"></i> Kondisi Barang</label>
                                                                @foreach ($item->peminjaman->detailPeminjaman as $detail)
                                                                <div class="input-group mb-2">
                                                                    <span class="input-group-text">{{ $detail->barang->nama_barang ?? 'Data Tidak Ditemukan' }}</span>
                                                                    <select class="form-select kondisi-barang" name="kondisi_barang[{{ $detail->id_barang }}]" required onchange="toggleJumlahHilang(this, {{ $detail->jumlah_pinjam }})">
                                                                        <option value="Baik">Baik</option>
                                                                        <option value="Rusak">Rusak</option>
                                                                        <option value="Hilang">Hilang</option>
                                                                    </select>
                                                                    <input type="number" class="form-control jumlah-hilang" name="jumlah_hilang[{{ $detail->id_barang }}]" 
                                                                        placeholder="Jumlah Hilang" min="0" max="{{ $detail->jumlah_pinjam }}" style="display: none;">
                                                                </div>
                                                                @endforeach
                                                            </div>

                                                            <!-- Tombol Konfirmasi -->
                                                            <div class="d-flex justify-content-between">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                    <i class="fas fa-times me-2"></i> Batal
                                                                </button>
                                                                <button type="submit" class="btn btn-success">
                                                                    <i class="fas fa-check me-2"></i> Konfirmasi
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div>
                                Menampilkan {{ $pengembalian->firstItem() ?? 0 }} hingga {{ $pengembalian->lastItem() ?? 0 }} dari {{ $pengembalian->total() }} data
                            </div>
                            <div>
                                {{ $pengembalian->links() }}
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
    function isiTanggal(id) {
        let today = new Date().toISOString().split('T')[0];
        document.getElementById('tanggalKembali' + id).value = today;
    }

    function isiWaktu(id) {
        let now = new Date();
        let hours = String(now.getHours()).padStart(2, '0');
        let minutes = String(now.getMinutes()).padStart(2, '0');
        document.getElementById('waktuKembali' + id).value = hours + ':' + minutes;
    }

    function toggleJumlahHilang(select, maxJumlah) {
        let inputHilang = select.closest('.input-group').querySelector('.jumlah-hilang');
        if (select.value === 'Hilang') {
            inputHilang.style.display = 'block';
            inputHilang.setAttribute('max', maxJumlah);
            inputHilang.addEventListener('input', function () {
                if (parseInt(this.value) > maxJumlah) {
                    this.value = maxJumlah;
                }
            });
        } else {
            inputHilang.style.display = 'none';
            inputHilang.value = '';
        }
    }
    
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
