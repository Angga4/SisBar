<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->integer('total_barang')->after('id_barang')->default(1);
            $table->enum('status_barang', ['Belum Dikembalikan', 'Sudah Dikembalikan'])->after('keterangan')->default('Belum Dikembalikan');
        });
    }

    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropColumn('total_barang');
            $table->dropColumn('status_barang');
        });
    }
};
