<!-- @extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Test ubah ini : Daftar Barang yang Tersedia</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah Tersedia</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barang as $item)
            <tr>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->jumlah_barang }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>
                    <a href="#" class="btn btn-primary">Pinjam</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection -->
