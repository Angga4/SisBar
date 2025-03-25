@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-lg p-4">
        <h2 class="mb-4 text-center">📋 Daftar Peminjaman</h2>

        <!-- Form Pencarian -->
        <form action="{{ route('guru.peminjaman.index') }}" method="GET" class="mb-4 d-flex justify-content-between">
            <input type="text" name="search" class="form-control me-2" placeholder="🔍 Cari Nama Siswa  ..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-dark">Cari</button>
        </form>

        @if(request('search'))
            <p class="text-muted text-center">Menampilkan hasil pencarian untuk: <strong>{{ request('search') }}</strong></p>
        @endif

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('guru.peminjaman.create') }}" class="btn btn-primary">➕ Tambah Peminjaman</a>
        </div>

        <!-- Jika Tidak Ada Data -->
        @if($peminjaman->isEmpty())
            <div class="alert alert-warning text-center">
                @if(request('search'))
                    ❌ Tidak ada hasil pencarian untuk: <strong>{{ request('search') }}</strong>
                @else
                    📌 Belum ada data peminjaman.
                @endif
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas & Jurusan</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Tempat Peminjaman</th>
                            <th>Tanggal Pinjam</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peminjaman as $key => $pinjam)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $pinjam->nama_siswa }}</td>
                            <td>{{ $pinjam->kelas_jurusan }}</td>
                            <td>
                                @foreach ($pinjam->detailPeminjaman as $detail)
                                    {{ $detail->barang->nama_barang }} ({{ $detail->jumlah_pinjam }})<br>
                                @endforeach
                            </td>
                            <td class="text-center"><strong>{{ $pinjam->total_barang }}</strong></td>
                            <td>{{ $pinjam->tempat_peminjaman }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->translatedFormat('d F Y') }}</td>
                            <td class="text-center">
                                <span class="badge {{ $pinjam->status_barang == 'Sudah Dikembalikan' ? 'bg-success' : 'bg-warning' }}">
                                    {{ $pinjam->status_barang }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <div>
        {{ $peminjaman->links() }} <!-- Pagination links -->
    </div>
    </div>
    
</div>
@endsection