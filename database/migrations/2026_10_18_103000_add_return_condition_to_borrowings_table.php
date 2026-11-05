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
                $t->string('kode_pengembalian')->nullable()->unique();
            }
            if (!Schema::hasColumn('borrowings', 'nama_alat')) {
                $t->string('nama_alat')->nullable();
            }
            if (!Schema::hasColumn('borrowings', 'nama_siswa')) {
                $t->string('nama_siswa')->nullable();
            }
            if (!Schema::hasColumn('borrowings', 'nis')) {
                $t->string('nis', 20)->nullable();
            }
            if (!Schema::hasColumn('borrowings', 'kelas')) {
                $t->string('kelas', 30)->nullable();
            }
            if (!Schema::hasColumn('borrowings', 'ruangan')) {
                $t->string('ruangan')->nullable();
            }
            if (!Schema::hasColumn('borrowings', 'tanggal_pengembalian')) {
                $t->date('tanggal_pengembalian')->nullable();
            }
            if (!Schema::hasColumn('borrowings', 'kondisi_awal')) {
                $t->enum('kondisi_awal', ['baik', 'rusak_ringan', 'rusak_berat', 'tidak_terima'])->default('baik');
            }
            if (!Schema::hasColumn('borrowings', 'kondisi_kembali')) {
                $t->enum('kondisi_kembali', ['baik', 'rusak_ringan', 'rusak_berat', 'tidak_terima'], true)->nullable();
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
                'nama_alat',
                'nama_siswa',
                'nis',
                'kelas',
                'ruangan',
                'tanggal_pengembalian',
                'kondisi_awal',
                'kondisi_kembali',
                'catatan_kondisi',
            ]);
        });
    }
};