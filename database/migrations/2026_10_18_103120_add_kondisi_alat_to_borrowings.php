<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('borrowings', function (Blueprint $t) {
            if (!Schema::hasColumn('borrowings', 'kode_pengembalian')) {
                $t->string('kode_pengembalian')->unique()->nullable();
            }
            if (!Schema::hasColumn('borrowings', 'nama_siswa')) {
                $t->string('nama_siswa')->nullable();
            }
            if (!Schema::hasColumn('borrowings', 'nis_siswa')) {
                $t->string('nis_siswa', 40)->nullable();
            }
            if (!Schema::hasColumn('borrowings', 'kelas_siswa')) {
                $t->string('kelas_siswa', 30)->nullable();
            }
            if (!Schema::hasColumn('borrowings', 'ruangan_guru')) {
                $t->string('ruangan_guru')->nullable();
            }
            if (!Schema::hasColumn('borrowings', 'nama_alat')) {
                $t->string('nama_alat')->nullable();
            }
            if (!Schema::hasColumn('borrowings', 'jumlah_alat')) {
                $t->integer('jumlah_alat')->default(1);
            }
            if (!Schema::hasColumn('borrowings', 'tanggal_pengembalian')) {
                $t->date('tanggal_pengembalian')->nullable();
            }
            if (!Schema::hasColumn('borrowings', 'kondisi_alat')) {
                $t->enum('kondisi_alat', ['baik', 'rusak_ringan', 'rusak_berat'])->nullable();
            }
            if (!Schema::hasColumn('borrowings', 'catatan_kondisi')) {
                $t->text('catatan_kondisi')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('borrowings', function (Blueprint $t) {
            $t->dropColumn([
                'kode_pengembalian',
                'nama_siswa',
                'nis_siswa',
                'kelas_siswa',
                'ruangan_guru',
                'nama_alat',
                'jumlah_alat',
                'tanggal_pengembalian',
                'kondisi_alat',
                'catatan_kondisi',
            ]);
        });
    }
};