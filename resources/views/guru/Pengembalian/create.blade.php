<!-- @extends('layouts.app')

@section('content')
<div class="container">
    <h2>Form Pengembalian Barang</h2>

    <form action="{{ route('guru.pengembalian.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Pilih Barang yang Dikembalikan</label>
            <select name="id_peminjaman" class="form-control" required>
                <option value="">-- Pilih Barang --</option>
                @foreach ($peminjaman as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->barang->nama_barang }} - Dipinjam oleh: {{ $item->nama_siswa }} pada {{ $item->tanggal_pinjam }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Waktu Kembali</label>
            <input type="time" name="waktu_kembali" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Kondisi Barang</label>
            <select name="kondisi_barang" class="form-control" required>
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
                <option value="Hilang">Hilang</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Kembalikan Barang</button>
    </form>
</div>
@endsection -->
