<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'id_users', 'total_barang', 'tanggal_pinjam', 'waktu_pinjam', 
        'tempat_peminjaman', 'nama_siswa', 'kelas_jurusan', 'keterangan', 'status_barang'
    ];
    
    protected $attributes = [
        'keterangan' => null, 
    ];

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'id_peminjaman');
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
    
    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class, 'id_peminjaman', 'id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
    
}
