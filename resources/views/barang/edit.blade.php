@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm p-4">
        <h2 class="fw-bold text-warning mb-4"><i class="fas fa-edit"></i> Edit Barang</h2>
        <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_barang" class="form-label fw-semibold">Nama Barang</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                    <input type="text" name="nama_barang" class="form-control" value="{{ $barang->nama_barang }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="jumlah_barang" class="form-label fw-semibold">Jumlah Barang</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                    <input type="number" name="jumlah_barang" class="form-control" value="{{ $barang->jumlah_barang }}" min="1" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3">{{ $barang->keterangan }}</textarea>
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label fw-semibold">Gambar Barang</label>
                <input type="file" name="gambar" class="form-control" id="gambarInput" accept="image/*">
                <div class="mt-3">
                    @if($barang->gambar)
                        <img src="{{ asset('storage/' . $barang->gambar) }}" class="img-thumbnail" id="previewGambar" width="150">
                    @else
                        <img class="img-thumbnail d-none" id="previewGambar" width="150">
                    @endif
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning"><i class="fas fa-edit"></i> Update Barang</button>
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
