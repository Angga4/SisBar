@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-edit me-2"></i> Edit Barang</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            {{-- Nama Barang --}}
                            <div class="col-md-6">
                                <label class="form-label">Nama Barang</label>
                                <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" class="form-control @error('nama_barang') is-invalid @enderror" required>
                                @error('nama_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Jumlah --}}
                            <div class="col-md-6">
                                <label class="form-label">Jumlah Barang</label>
                                <input type="number" name="jumlah_barang" value="{{ old('jumlah_barang', $barang->jumlah_barang) }}" class="form-control @error('jumlah_barang') is-invalid @enderror" min="1" required>
                                @error('jumlah_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Keterangan --}}
                            <div class="col-12">
                                <label class="form-label">Keterangan</label>
                                <textarea name="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $barang->keterangan) }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Gambar --}}
                            <div class="col-12">
                                <label class="form-label">Gambar</label>
                                <input type="file" name="gambar" id="gambarInput" class="form-control" accept="image/*">

                                <div class="mt-3">
                                @if($barang->gambar && Storage::disk('public')->exists($barang->gambar))
                                    <img id="previewGambar" src="{{ asset('storage/' . $barang->gambar) }}" class="img-thumbnail" width="150" alt="Gambar Barang">
                                @else
                                    <img id="previewGambar" src="https://via.placeholder.com/150?text=Tidak+Ada+Gambar" class="img-thumbnail" width="150" alt="Tidak ada gambar">
                                @endif
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary text-white">
                                <i class="fas fa-save me-2"></i> Update
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
    document.getElementById('gambarInput').addEventListener('change', function (event) {
        if (event.target.files && event.target.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                let img = document.getElementById('previewGambar');
                img.src = e.target.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    });
</script>
@endpush
@endsection