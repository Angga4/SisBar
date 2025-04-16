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
        $guru_id = Auth::id(); 
        $search = $request->input('search'); 
        $perPage = $request->input('per_page', 10); 
    
        $pengembalian = Pengembalian::whereHas('peminjaman', function ($query) use ($guru_id) {
            $query->where('id_users', $guru_id);
        })->with('peminjaman.detailPeminjaman.barang');
    
        if (!empty($search)) {
            $pengembalian->whereHas('peminjaman', function ($query) use ($search) {
                $query->where('nama_siswa', 'LIKE', "%$search%");
            });
        }
    
        $pengembalian = $pengembalian->paginate($perPage);
    
        return view('guru.pengembalian.index', compact('pengembalian', 'search'));
    }
    

    public function update(Request $request, $id)
    {
       

        $pengembalian = Pengembalian::where('id', $id)->firstOrFail();
        $peminjaman = Peminjaman::where('id', $pengembalian->id_peminjaman)->firstOrFail();
        $pengembalian->update([
            'tanggal_kembali' => $request->tanggal_kembali,
            'waktu_kembali' => $request->waktu_kembali,
            'kondisi_barang' => $request->kondisi_barang,
            'status_barang' => 'Sudah Dikembalikan',
        ]);

        $peminjaman->update([
            'status_barang' => 'Sudah Dikembalikan',
        ]);

        if ($request->kondisi_barang !== 'Hilang') {
            foreach($peminjaman->detailPeminjaman as $detail) {
                $barang = $detail->barang;
                $barang->jumlah_barang += $detail->jumlah_pinjam;
                $barang->save();
            }
        }

        return redirect()->route('guru.pengembalian.index')->with('success', 'Barang berhasil dikembalikan!');
    }
    
}
