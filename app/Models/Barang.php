<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'nama_barang',
        'jumlah_barang',
        'keterangan',
        'gambar'
    ];

    
    public static function boot()
    {
        parent::boot();

        static::saving(function ($barang) {
            if ($barang->jumlah_barang < 0) {
                throw new \Exception('Jumlah barang tidak boleh negatif!');
            }
        });
    }

    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class, 'id_barang', 'id');
    }


}
