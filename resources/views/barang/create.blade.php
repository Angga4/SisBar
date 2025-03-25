@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm p-4">
        <h2 class="fw-bold text-primary mb-4"><i class="fas fa-box"></i> Tambah Barang</h2>
        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="nama_barang" class="form-label fw-semibold">Nama Barang</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                    <input type="text" class="form-control" name="nama_barang" placeholder="Masukkan nama barang..." required>
                </div>
            </div>

            <div class="mb-3">
                <label for="jumlah_barang" class="form-label fw-semibold">Jumlah</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                    <input type="number" class="form-control" name="jumlah_barang" min="1" placeholder="Masukkan jumlah barang..." required>
                </div>
            </div>

            <div class="mb-3">
                <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                <textarea class="form-control" name="keterangan" rows="3" placeholder="Tambahkan keterangan barang..."></textarea>
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label fw-semibold">Upload Gambar</label>
                <input type="file" class="form-control" name="gambar" id="gambarInput" accept="image/*">
                <div class="mt-3">
                    <img id="previewGambar" class="img-thumbnail d-none" width="150">
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                <a href="{{ route('barang.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('gambarInput').addEventListener('change', function (event) {
        let reader = new FileReader();
        reader.onload = function () {
            let img = document.getElementById('previewGambar');
            img.src = reader.result;
            img.classList.remove('d-none');
        };
        reader.readAsDataURL(event.target.files[0]);
    });
</script>
@endsection
