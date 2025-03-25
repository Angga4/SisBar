<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Barang;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function index(Request $request)
    {
        $guru_id = Auth::id(); // Ambil ID guru yang sedang login
        $search = $request->input('search'); // Ambil input pencarian
        $perPage = $request->input('per_page', 10); // Default 10 data per halaman
    
        // Query dasar dengan eager loading
        $pengembalian = Pengembalian::whereHas('peminjaman', function ($query) use ($guru_id) {
            $query->where('id_users', $guru_id);
        })->with('peminjaman.detailPeminjaman.barang');
    
        // Filter berdasarkan nama siswa jika ada pencarian
        if (!empty($search)) {
            $pengembalian->whereHas('peminjaman', function ($query) use ($search) {
                $query->where('nama_siswa', 'LIKE', "%$search%");
            });
        }
    
        // Ambil hasil dengan pagination
        $pengembalian = $pengembalian->paginate($perPage);
    
        return view('guru.pengembalian.index', compact('pengembalian', 'search'));
    }
    

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'tanggal_kembali' => 'required|date',
        //     'waktu_kembali' => 'required',
        //     'kondisi_barang' => 'required|in:Baik,Rusak,Hilang',
        // ]);

        // Ambil data pengembalian
        $pengembalian = Pengembalian::where('id', $id)->firstOrFail();
        $peminjaman = Peminjaman::where('id', $pengembalian->id_peminjaman)->firstOrFail();
        // $barang = Barang::where('id', $peminjaman->id_barang)->firstOrFail();

        // Update data pengembalian
        $pengembalian->update([
            'tanggal_kembali' => $request->tanggal_kembali,
            'waktu_kembali' => $request->waktu_kembali,
            'kondisi_barang' => $request->kondisi_barang,
            'status_barang' => 'Sudah Dikembalikan',
        ]);

        // Update status peminjaman
        $peminjaman->update([
            'status_barang' => 'Sudah Dikembalikan',
        ]);

        // Tambahkan kembali stok barang jika barang tidak hilang
        if ($request->kondisi_barang !== 'Hilang') {
            foreach($peminjaman->detailPeminjaman as $detail) {
                $barang = $detail->barang;
                $barang->jumlah_barang += $detail->jumlah_pinjam;
                $barang->save();
            }
            // $barang->jumlah_barang += $peminjaman->total_barang;
            // $barang->save();
        }

        return redirect()->route('guru.pengembalian.index')->with('success', 'Barang berhasil dikembalikan!');
    }
    
}
