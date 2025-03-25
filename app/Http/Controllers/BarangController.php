<?php

namespace App\Http\Controllers;


use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use Illuminate\Http\Request;
use App\Models\Barang;
use Storage;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $barang = Barang::when($search, function ($query) use ($search) {
                        $query->where('nama_barang', 'like', "%$search%")
                              ->orWhere('keterangan', 'like', "%$search%");
                    })
                    ->paginate(10);
    
        return view('barang.index', compact('barang'));
    }
    

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah_barang' => 'required|integer',
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('barang', 'public');
        }
    
        Barang::create([
            'nama_barang' => $request->nama_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'keterangan' => $request->keterangan,
            'gambar' => $gambarPath,
        ]);
    
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }
    
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }
    

    public function update(Request $request, $id)
{
    $barang = Barang::findOrFail($id);

    $request->validate([
        'nama_barang' => 'required',
        'jumlah_barang' => 'required|integer',
        'keterangan' => 'nullable',
        'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $barang->nama_barang = $request->nama_barang;
    $barang->jumlah_barang = $request->jumlah_barang;
    $barang->keterangan = $request->keterangan;

    if ($request->hasFile('gambar')) {
        if ($barang->gambar) {
            Storage::delete('public/' . $barang->gambar);
        }

        $path = $request->file('gambar')->store('barang', 'public');
        $barang->gambar = $path;
    }

    $barang->save();

    return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui');
}

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        // Cek apakah barang masih dipinjam
        $barangDipinjam = DetailPeminjaman::where('id_barang', $barang->id)
            ->whereHas('peminjaman', function ($query) {
                $query->where('status_barang', 'Belum Dikembalikan');
            })
            ->exists();

        if ($barangDipinjam) {
            return redirect()->back()->with('error', 'Barang tidak bisa dihapus karena masih dipinjam!');
        }

        // Hapus gambar jika ada
        if ($barang->gambar) {
            Storage::delete('public/' . $barang->gambar);
        }

        // Hapus barang
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }




    public function indexLanding()
    {
        $barang = Barang::all();
        return view('landing.detail_barang', compact('barang'));
    }

    public function indexGuru()
    {
        $barang = Barang::all();
        return view('guru.barang', compact('barang'));
    }

}
