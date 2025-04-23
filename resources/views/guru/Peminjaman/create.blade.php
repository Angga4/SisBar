@extends('layouts.app')

@section('title', 'Tambah Peminjaman')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-clipboard-list me-2"></i> Form Peminjaman Barang</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('guru.peminjaman.store') }}" method="POST">
                        @csrf
                        
                        <div class="row g-3">
                            <!-- Nama Siswa -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_siswa" class="form-label fw-bold">Nama Siswa:</label>
                                    <input type="text" name="nama_siswa" class="form-control @error('nama_siswa') is-invalid @enderror" value="{{ old('nama_siswa') }}" placeholder="Masukkan nama siswa" required>
                                    @error('nama_siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Kelas & Jurusan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kelas_jurusan" class="form-label fw-bold">Kelas & Jurusan:</label>
                                    <input type="text" name="kelas_jurusan" class="form-control @error('kelas_jurusan') is-invalid @enderror" value="{{ old('kelas_jurusan') }}" placeholder="Contoh: XII RPL 1" required>
                                    @error('kelas_jurusan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Pilihan Barang -->
                        <h5 class="fw-bold mb-3"><i class="fas fa-box me-2"></i> Barang yang Dipinjam</h5>
                        <div id="barang-container">
                            <div class="barang-item mb-3 p-3 rounded">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Pilih Barang:</label>
                                        <select name="barang[0][id_barang]" class="form-select barang-select" required onchange="updateStok(this)">
                                            <option value="" disabled selected>🔽 Pilih Barang</option>
                                            @foreach($barang as $b)
                                                <option value="{{ $b->id }}" data-stok="{{ $b->jumlah_barang }}">
                                                    {{ $b->nama_barang }} (Stok: {{ $b->jumlah_barang }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Jumlah Dipinjam:</label>
                                        <input type="number" name="barang[0][jumlah_pinjam]" class="form-control total-barang" min="1" required oninput="cekMaksimal(this)">
                                    </div>
                                    <div class="col-md-2 mb-3 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger btn-sm" onclick="hapusBarang(this)">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary btn-sm mb-4" onclick="tambahBarang()">
                            <i class="fas fa-plus me-1"></i> Tambah Barang
                        </button>

                        <hr class="my-4">

                        <!-- Tanggal & Waktu Pinjam -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_pinjam" class="form-label fw-bold"><i class="fas fa-calendar me-2"></i> Tanggal Pinjam:</label>
                                    <div class="input-group">
                                        <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" class="form-control @error('tanggal_pinjam') is-invalid @enderror" value="{{ old('tanggal_pinjam') }}" required>
                                        <button type="button" class="btn btn-outline-secondary" onclick="isiTanggalOtomatis()">Auto</button>
                                    </div>
                                    @error('tanggal_pinjam')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="waktu_pinjam" class="form-label fw-bold"><i class="fas fa-clock me-2"></i> Waktu Pinjam:</label>
                                    <div class="input-group">
                                        <input type="time" id="waktu_pinjam" name="waktu_pinjam" class="form-control @error('waktu_pinjam') is-invalid @enderror" value="{{ old('waktu_pinjam') }}" required>
                                        <button type="button" class="btn btn-outline-secondary" onclick="isiWaktuOtomatis()">Auto</button>
                                    </div>
                                    @error('waktu_pinjam')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tempat Peminjaman -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tempat_peminjaman" class="form-label fw-bold"><i class="fas fa-map-marker-alt me-2"></i> Tempat Peminjaman:</label>
                                    <input type="text" name="tempat_peminjaman" class="form-control @error('tempat_peminjaman') is-invalid @enderror" value="{{ old('tempat_peminjaman') }}" placeholder="Contoh: Lab TKJ" required>
                                    @error('tempat_peminjaman')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Keterangan -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="keterangan" class="form-label fw-bold"><i class="fas fa-sticky-note me-2"></i> Keterangan (Opsional):</label>
                                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" placeholder="Tambahkan keterangan jika perlu">{{ old('keterangan') }}</textarea>
                                    @error('keterangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('guru.peminjaman.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check-circle me-2"></i> Pinjam Barang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let barangIndex = 1;

    function tambahBarang() {
        let container = document.getElementById("barang-container");
        let newBarang = document.createElement("div");
        newBarang.classList.add("barang-item", "mb-3", "p-3", "rounded");
        newBarang.innerHTML = `
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Pilih Barang:</label>
                    <select name="barang[${barangIndex}][id_barang]" class="form-select barang-select" required onchange="updateStok(this)">
                        <option value="" disabled selected>🔽 Pilih Barang</option>
                        @foreach($barang as $b)
                            <option value="{{ $b->id }}" data-stok="{{ $b->jumlah_barang }}">
                                {{ $b->nama_barang }} (Stok: {{ $b->jumlah_barang }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Jumlah Dipinjam:</label>
                    <input type="number" name="barang[${barangIndex}][jumlah_pinjam]" class="form-control total-barang" min="1" required oninput="cekMaksimal(this)">
                </div>
                <div class="col-md-2 mb-3 d-flex align-items-end">
                    <button type="button" class="btn btn-danger btn-sm" onclick="hapusBarang(this)">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </button>
                </div>
            </div>
        `;
        container.appendChild(newBarang);
        barangIndex++;
    }

    function hapusBarang(button) {
        button.closest('.barang-item').remove();
    }

    function isiTanggalOtomatis() {
        let today = new Date().toISOString().split('T')[0];
        document.getElementById("tanggal_pinjam").value = today;
    }

    function isiWaktuOtomatis() {
        let now = new Date();
        let hours = String(now.getHours()).padStart(2, '0');
        let minutes = String(now.getMinutes()).padStart(2, '0');
        document.getElementById("waktu_pinjam").value = `${hours}:${minutes}`;
    }

    function updateStok(select) {
        // This function can be used to update UI based on selected item
        // For example, showing available stock
    }

    function cekMaksimal(input) {
        let max = parseInt(input.closest('.row').querySelector('.barang-select').selectedOptions[0].dataset.stok);
        if (parseInt(input.value) > max) {
            input.value = max;
            alert('Jumlah pinjaman tidak boleh lebih dari stok yang tersedia!');
        }
    }
    function isBarangSudahDipilih(idBarang) {
    const allSelects = document.querySelectorAll('.barang-select');
    let count = 0;
    allSelects.forEach(select => {
        if (select.value === idBarang) {
            count++;
        }
    });
    return count > 1;
    }

    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('barang-select')) {
            const selectedId = e.target.value;
            if (selectedId && isBarangSudahDipilih(selectedId)) {
                alert('Barang ini sudah dipilih. Pilih barang lain.');
                e.target.value = '';
            }
        }
    });
</script>
@endpush
@endsection
