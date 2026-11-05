<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_kondisi_alats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_id')->constrained('peminjamans')->onDelete('cascade');
            $table->string('nama_peminjam');
            $table->string('kode_inventaris');
            $table->string('kategori');
            $table->string('lokasi_kegiatan');
            $table->string('tanggal_pengembalian')->nullable();
            $table->enum('kondisi_terima', ['baik', 'rusak_ringan', 'rusak_berat', 'belum_dipakai'])->default('belum_dipakai');
            $table->text('deskripsi_kerusakan')->nullable();
            $table->boolean('kirim_dengan_foto')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_kondisi_alats');
    }
};