@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📋 Daftar Barang yang Dipinjam</h2>

    <!-- Form Pencarian -->
    <form action="{{ route('guru.pengembalian.index') }}" method="GET" class="mb-4 d-flex justify-content-between">
        <input type="text" name="search" class="form-control me-2" placeholder="🔍 Cari Nama Siswa ..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-dark">Cari</button>
    </form>

    @if(request('search'))
        <p class="text-muted text-center">Menampilkan hasil pencarian untuk: <strong>{{ request('search') }}</strong></p>
    @endif

    <!-- Jika Tidak Ada Data -->
    @if($pengembalian->isEmpty()) 
        <div class="alert alert-warning text-center">
            @if(request('search'))
                ❌ Tidak ada hasil pencarian untuk: <strong>{{ request('search') }}</strong>
            @else
                📌 Belum ada data pengembalian.
            @endif
        </div>
    @else

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark text-center">
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
                                {{ $detail->barang->nama_barang ?? 'Data Tidak Ditemukan' }} ({{ $detail->jumlah_pinjam }})<br>
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
                                Detail
                            </button>
                            @if ($item->status_barang !== 'Sudah dikembalikan')
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalKembalikan{{ $item->id }}">
                                    Kembalikan
                                </button>
                            @endif
                        </td>
                    </tr>

                    <!-- MODAL DETAIL -->

                    <div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content shadow-lg rounded">
                                <div class="modal-header bg-info text-white">
                                    <h5 class="modal-title">📋 Detail Peminjaman</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="card p-3 mb-3 shadow-sm">
                                        <h6 class="fw-bold">📄 Informasi Peminjaman</h6>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><strong>Nama Siswa:</strong> {{ $item->peminjaman->nama_siswa ?? 'Data Tidak Ditemukan' }}</li>
                                            <li class="list-group-item"><strong>Tanggal Pinjam:</strong> {{ \Carbon\Carbon::parse($item->peminjaman->tanggal_pinjam)->translatedFormat('d F Y') ?? 'Data Tidak Ditemukan' }}</li>
                                            <li class="list-group-item"><strong>Lokasi Peminjaman:</strong> {{ $item->peminjaman->tempat_peminjaman ?? 'Data Tidak Ditemukan' }}</li>
                                            <li class="list-group-item"><strong>Keterangan:</strong> {{ $item->peminjaman->keterangan ?? '-' }}</li>
                                        </ul>
                                    </div>

                                    <div class="card p-3 shadow-sm">
                                        <h6 class="fw-bold">📦 Barang yang Dipinjam</h6>
                                        <ul class="list-group list-group-flush">
                                            @foreach ($item->peminjaman->detailPeminjaman as $detail)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    {{ $detail->barang->nama_barang ?? 'Data Tidak Ditemukan' }} ({{ $detail->jumlah_pinjam }})
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    @if ($item->status_barang === 'Sudah dikembalikan')
                                    <div class="card p-3 mt-3 shadow-sm">
                                        <h6 class="fw-bold text-success">✅ Informasi Pengembalian</h6>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><strong>Tanggal Kembali:</strong> {{ \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('d F Y') }}</li>
                                            <li class="list-group-item"><strong>Waktu Kembali:</strong> {{ \Carbon\Carbon::parse($item->waktu_kembali)->format('H:i') }}</li>
                                            <li class="list-group-item"><strong>Kondisi Barang:</strong> {{ ucfirst($item->kondisi_barang) }}</li>
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- MODAL PENGEMBALIAN -->
                    @if ($item->status_barang !== 'Sudah dikembalikan')
                    <div class="modal fade" id="modalKembalikan{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content shadow-lg rounded">
                                <div class="modal-header bg-warning text-dark">
                                    <h5 class="modal-title"><i class="fas fa-undo"></i> Konfirmasi Pengembalian</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('guru.pengembalian.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <!-- Tanggal Kembali -->
                                        <div class="mb-3">
                                            <label class="form-label"><i class="fas fa-calendar-day"></i> Tanggal Kembali</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" id="tanggalKembali{{ $item->id }}" name="tanggal_kembali" required>
                                                <button type="button" class="btn btn-dark" onclick="isiTanggal({{ $item->id }})">Auto</button>
                                            </div>
                                        </div>

                                        <!-- Waktu Kembali -->
                                        <div class="mb-3">
                                            <label class="form-label"><i class="fas fa-clock"></i> Waktu Kembali</label>
                                            <div class="input-group">
                                                <input type="time" class="form-control" id="waktuKembali{{ $item->id }}" name="waktu_kembali" required>
                                                <button type="button" class="btn btn-dark" onclick="isiWaktu({{ $item->id }})">Auto</button>
                                            </div>
                                        </div>

                                        <!-- Kondisi Barang -->
                                        <div class="mb-3">
                                            <label class="form-label"><i class="fas fa-search"></i> Kondisi Barang</label>
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
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                                            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Konfirmasi</button>
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
    <!-- Pagination Links -->
<div class="d-flex justify-content-between align-items-center mt-3">
    <div>
        Menampilkan {{ $pengembalian->firstItem() }} hingga {{ $pengembalian->lastItem() }} dari {{ $pengembalian->total() }} data
    </div>
    <div>
        {{ $pengembalian->links() }} 
    </div>
</div>

    @endif
</div>

<script>
    function isiTanggal(id) {
        let today = new Date().toISOString().split('T')[0];
        document.getElementById('tanggalKembali' + id).value = today;
    }

    function isiWaktu(id) {
        let now = new Date().toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit' });
        document.getElementById('waktuKembali' + id).value = now;
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
</script>


@endsection