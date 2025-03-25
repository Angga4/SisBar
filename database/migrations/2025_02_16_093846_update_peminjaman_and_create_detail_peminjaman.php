<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Menambahkan kolom kelas_jurusan ke tabel peminjaman
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->string('kelas_jurusan')->after('nama_siswa'); // Menambahkan kolom baru
            $table->dropForeign(['id_barang']); // Menghapus foreign key dari id_barang
            $table->dropColumn('id_barang'); // Menghapus kolom id_barang dari peminjaman
        });

        // Membuat tabel detail_peminjaman
        Schema::create('detail_peminjaman', function (Blueprint $table) {
            $table->id('id_detail');
            $table->foreignId('id_barang')->constrained('barang')->onDelete('cascade');
            $table->foreignId('id_peminjaman')->constrained('peminjaman')->onDelete('cascade');
            $table->integer('jumlah_pinjam');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Mengembalikan perubahan jika rollback
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->foreignId('id_barang')->constrained('barang')->onDelete('cascade');
            $table->dropColumn('kelas_jurusan');
        });

        // Menghapus tabel detail_peminjaman jika rollback
        Schema::dropIfExists('detail_peminjaman');
    }
};
