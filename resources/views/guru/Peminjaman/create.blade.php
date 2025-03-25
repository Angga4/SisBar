@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-lg p-4 rounded border-0" style="background-color: #f8f9fa;">
        <h2 class="mb-4 text-center">📦 Form Peminjaman Barang</h2>

        <form action="{{ route('guru.peminjaman.store') }}" method="POST">
            @csrf
            
            <!-- Nama Siswa -->
            <div class="mb-3">
                <label for="nama_siswa" class="form-label fw-bold">Nama Siswa:</label>
                <input type="text" name="nama_siswa" class="form-control" placeholder="Masukkan nama siswa" required>
                @error('nama_siswa') <div class="alert alert-danger mt-2">⚠ {{ $message }}</div> @enderror
            </div>

            <!-- Kelas & Jurusan -->
            <div class="mb-3">
                <label for="kelas_jurusan" class="form-label fw-bold">Kelas & Jurusan:</label>
                <input type="text" name="kelas_jurusan" class="form-control" placeholder="Contoh: XII RPL 1" required>
                @error('kelas_jurusan') <div class="alert alert-danger mt-2">⚠ {{ $message }}</div> @enderror
            </div>

            <hr>

            <!-- Pilihan Barang -->
            <h5 class="fw-bold">🛒 Barang yang Dipinjam</h5>
            <div id="barang-container">
                <div class="barang-item mb-3 row">
                    <div class="col-md-6">
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
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Jumlah Dipinjam:</label>
                        <input type="number" name="barang[0][jumlah_pinjam]" class="form-control total-barang" min="1" required oninput="cekMaksimal(this)">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapusBarang(this)">❌</button>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary btn-sm mt-2" onclick="tambahBarang()">➕ Tambah Barang</button>

            <hr>

            <!-- Tanggal & Waktu Pinjam -->
            <div class="row">
                <div class="col-md-6">
                    <label for="tanggal_pinjam" class="form-label fw-bold">📅 Tanggal Pinjam:</label>
                    <div class="input-group">
                        <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" class="form-control" required>
                        <button type="button" class="btn btn-outline-secondary" onclick="isiTanggalOtomatis()">Auto</button>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="waktu_pinjam" class="form-label fw-bold">⏰ Waktu Pinjam:</label>
                    <div class="input-group">
                        <input type="time" id="waktu_pinjam" name="waktu_pinjam" class="form-control" required>
                        <button type="button" class="btn btn-outline-secondary" onclick="isiWaktuOtomatis()">Auto</button>
                    </div>
                </div>
            </div>

            <!-- Tempat Peminjaman -->
            <div class="mb-3 mt-3">
                <label for="tempat_peminjaman" class="form-label fw-bold">📍 Tempat Peminjaman:</label>
                <input type="text" name="tempat_peminjaman" class="form-control" placeholder="Contoh: Lab TKJ" required>
            </div>

            <!-- Keterangan -->
            <div class="mb-3">
                <label for="keterangan" class="form-label fw-bold">📜 Keterangan (Opsional):</label>
                <textarea name="keterangan" class="form-control" placeholder="Tambahkan keterangan jika perlu"></textarea>
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('guru.peminjaman.index') }}" class="btn btn-secondary">⬅️ Kembali</a>
                <button type="submit" class="btn btn-success">✅ Pinjam Barang</button>
            </div>
        </form>
    </div>
</div>

<script>
    let barangIndex = 1;

    function tambahBarang() {
        let container = document.getElementById("barang-container");
        let newBarang = document.createElement("div");
        newBarang.classList.add("barang-item", "mb-3", "row");
        newBarang.innerHTML = `
            <div class="col-md-6">
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
            <div class="col-md-4">
                <label class="form-label fw-bold">Jumlah Dipinjam:</label>
                <input type="number" name="barang[${barangIndex}][jumlah_pinjam]" class="form-control total-barang" min="1" required oninput="cekMaksimal(this)">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-sm" onclick="hapusBarang(this)">❌</button>
            </div>
        `;
        container.appendChild(newBarang);
        barangIndex++;
    }

    function hapusBarang(button) {
        button.parentElement.parentElement.remove();
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

    function cekMaksimal(input) {
        let max = parseInt(input.closest('.barang-item').querySelector('.barang-select').selectedOptions[0].dataset.stok);
        if (parseInt(input.value) > max) {
            input.value = max;
            alert('Jumlah pinjaman tidak boleh lebih dari stok yang tersedia!');
        }
    }
</script>

@endsection
