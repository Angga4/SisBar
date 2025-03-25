<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $guru = User::where('role', 'guru')
                    ->when($search, function ($query) use ($search) {
                        $query->where(function ($q) use ($search) {
                            $q->where('name', 'like', "%$search%")
                              ->orWhere('email', 'like', "%$search%");
                        });
                    })
                    ->paginate(10);
    
        return view('admin.guru.index', compact('guru'));
    }
    

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'guru', 
    ]);

    return redirect()->route('guru.index')->with('success', 'Akun guru berhasil ditambahkan.');
}


    public function edit($id)
    {
        $guru = User::findOrFail($id);
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $guru = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $guru->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('guru.index')->with('success', 'Akun guru berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Cek jika user adalah guru dan masih memiliki peminjaman dengan status "belum dikembalikan"
        if ($user->role === 'guru' && $user->peminjaman()->where('status_barang', 'Belum Dikembalikan')->exists()) {
            return redirect()->back()->with('error', 'Akun guru tidak dapat dihapus karena masih ada peminjaman barang yang belum dikembalikan.');
        }

        // Jika tidak ada peminjaman yang belum dikembalikan, maka bisa dihapus
        $user->delete();
        return redirect()->back()->with('success', 'Akun guru berhasil dihapus.');
    }
}
