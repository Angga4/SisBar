<!-- @extends('layouts.app')

@section('content')
    <h1>Form Peminjaman Barang</h1>

    <form action="{{ route('guru.peminjaman.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_barang">Pilih Barang:</label>
            <select name="id_barang" class="form-control" required>
                @foreach($barang as $b)
                    <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="nama_siswa">Nama Siswa:</label>
            <input type="text" name="nama_siswa" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="tanggal_pinjam">Tanggal Pinjam:</label>
            <input type="date" name="tanggal_pinjam" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="waktu_pinjam">Waktu Pinjam:</label>
            <input type="time" name="waktu_pinjam" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="tempat_peminjaman">Tempat Peminjaman:</label>
            <input type="text" name="tempat_peminjaman" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="keterangan">Keterangan (Opsional):</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Pinjam Barang</button>
    </form>
@endsection -->
