<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Barang;
use App\Models\DetailPeminjaman; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $guru_id = Auth::id();
        $search = $request->input('search'); 
        $perPage = $request->input('per_page', 10); 

        $peminjaman = Peminjaman::with('user', 'barang')
                    ->where('id_users', $guru_id) 
                    ->when($search, function ($query) use ($search) {
                        $query->where('nama_siswa', 'like', "%$search%")
                              ->orWhereHas('barang', function ($q) use ($search) {
                                  $q->where('nama_barang', 'like', "%$search%");
                              });
                    })
                    ->paginate($perPage);
    
        return view('guru.peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $barang = Barang::where('jumlah_barang', '>', 0)->get();
        return view('guru.peminjaman.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang' => 'required|array',
            'barang.*.id_barang' => 'required|exists:barang,id',
            'barang.*.jumlah_pinjam' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'waktu_pinjam' => 'required',
            'tempat_peminjaman' => 'required|string',
            'nama_siswa' => 'required|string',
            'kelas_jurusan' => 'required|string', 
            'keterangan' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $peminjaman = Peminjaman::create([
                'id_users' => auth()->id(),
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'waktu_pinjam' => $request->waktu_pinjam,
                'tempat_peminjaman' => $request->tempat_peminjaman,
                'nama_siswa' => $request->nama_siswa,
                'kelas_jurusan' => $request->kelas_jurusan, 
                'total_barang' => count($request->barang), 
                'keterangan' => $request->keterangan,
                'status_barang' => 'Belum Dikembalikan',
            ]);

            foreach ($request->barang as $item) {
                $barang = Barang::findOrFail($item['id_barang']);

                if ($barang->jumlah_barang < $item['jumlah_pinjam']) {
                    throw new \Exception('Stok barang tidak mencukupi!');
                }

                $barang->decrement('jumlah_barang', $item['jumlah_pinjam']);

                DetailPeminjaman::create([
                    'id_peminjaman' => $peminjaman->id,
                    'id_barang' => $item['id_barang'],
                    'jumlah_pinjam' => $item['jumlah_pinjam'],
                ]);
            }

            Pengembalian::create([
                'id_peminjaman' => $peminjaman->id,
                'tanggal_kembali' => null,
                'waktu_kembali' => null,
                'kondisi_barang' => null,
            ]);

            DB::commit();
            return redirect()->route('guru.peminjaman.index')->with('success', 'Peminjaman berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::with('detailPeminjaman.barang')->findOrFail($id);
        $barang = Barang::all(); 

        return view('guru.peminjaman.edit', compact('peminjaman', 'barang'));
    }

    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $request->validate([
            'barang' => 'required|array',
            'barang.*.id_barang' => 'required|exists:barang,id',
            'barang.*.jumlah_pinjam' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'waktu_pinjam' => 'required',
            'tempat_peminjaman' => 'required|string|max:255',
            'nama_siswa' => 'required|string|max:255',
            'kelas_jurusan' => 'required|string|max:255', 
            'keterangan' => 'nullable|string',
        ]);

        foreach ($peminjaman->detailPeminjaman as $detail) {
            $barang = Barang::find($detail->id_barang);
            if ($barang) {
                $barang->increment('jumlah_barang', $detail->jumlah_pinjam);
            }
        }

        $peminjaman->detailPeminjaman()->delete();

        $peminjaman->update([
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'waktu_pinjam' => $request->waktu_pinjam,
            'tempat_peminjaman' => $request->tempat_peminjaman,
            'nama_siswa' => $request->nama_siswa,
            'kelas_jurusan' => $request->kelas_jurusan, 
            'keterangan' => $request->keterangan ?? null,
        ]);

        foreach ($request->barang as $item) {
            $barang = Barang::findOrFail($item['id_barang']);

            if ($barang->jumlah_barang < $item['jumlah_pinjam']) {
                return back()->withErrors(['barang' => 'Stok barang tidak mencukupi!'])->withInput();
            }

            $barang->decrement('jumlah_barang', $item['jumlah_pinjam']);

            DetailPeminjaman::create([
                'id_peminjaman' => $peminjaman->id,
                'id_barang' => $item['id_barang'],
                'jumlah_pinjam' => $item['jumlah_pinjam'],
            ]);
        }

        return redirect()->route('guru.peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::with('detailPeminjaman')->findOrFail($id);

        DB::beginTransaction();
        try {
            foreach ($peminjaman->detailPeminjaman as $detail) {
                $barang = Barang::find($detail->id_barang);
                if ($barang) {
                    $barang->increment('jumlah_barang', $detail->jumlah_pinjam);
                }
            }

            $peminjaman->detailPeminjaman()->delete();

            $peminjaman->delete();

            DB::commit();
            return redirect()->route('guru.peminjaman.index')->with('success', 'Peminjaman berhasil dihapus dan barang dikembalikan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}