<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_peminjaman')->constrained('peminjaman')->onDelete('cascade');
            $table->date('tanggal_kembali')->nullable();
            $table->time('waktu_kembali')->nulllable();
            $table->enum('status_barang', ['Sudah dikembalikan', 'Belum dikembalikan'])->default('Belum dikembalikan');
            $table->string('kondisi_barang')->nullable(); // Bisa ditambah "Baik/Rusak/Hilang"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengembalian');
    }
};
