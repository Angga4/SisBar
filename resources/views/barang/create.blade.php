@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-box me-2"></i> Tambah Barang</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">
                            {{-- Nama Barang --}}
                            <div class="col-md-6">
                                <label for="nama_barang" class="form-label fw-semibold">Nama Barang</label>
                                <input type="text" name="nama_barang" id="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" placeholder="Masukkan nama barang..." required>
                                @error('nama_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Jumlah Barang --}}
                            <div class="col-md-6">
                                <label for="jumlah_barang" class="form-label fw-semibold">Jumlah</label>
                                <input type="number" name="jumlah_barang" id="jumlah_barang" min="1" class="form-control @error('jumlah_barang') is-invalid @enderror" placeholder="Masukkan jumlah barang..." required>
                                @error('jumlah_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Keterangan --}}
                            <div class="col-12">
                                <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3" placeholder="Tambahkan keterangan barang..."></textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Gambar --}}
                            <div class="col-12">
                                <label for="gambar" class="form-label fw-semibold">Upload Gambar</label>
                                <input type="file" name="gambar" id="gambarInput" class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <div class="mt-3">
                                    <img id="previewGambar" class="img-thumbnail d-none" width="150" alt="Preview Gambar">
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script preview gambar --}}
@push('scripts')
<script>
    document.getElementById('gambarInput').addEventListener('change', function (event) {
        if (event.target.files && event.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const preview = document.getElementById('previewGambar');
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    });
</script>
@endpush

@endsection
