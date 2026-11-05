<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('borrowings', function (Blueprint $t) {
            if (!Schema::hasColumn('borrowings', 'nama_alat')) {
                $t->string('nama_alat')->nullable();
            }
            if (!Schema::hasColumn('borrowings', 'nama_siswa')) {
                $t->string('nama_siswa')->nullable();
            }
            if (!Schema::hasColumn('borrowings', 'kelas_siswa')) {
                $t->string('kelas_siswa')->nullable();
            }
            if (!Schema::hasColumn('borrowings', 'ruangan')) {
                $t->string('ruangan')->nullable();
            }
            if (!Schema::hasColumn('borrowings', 'tanggal_pengembalian')) {
                $t->date('tanggal_pengembalian')->nullable();
            }
            if (!Schema::hasColumn('borrowings', 'kondisi_awal')) {
                $t->enum('kondisi_awal', ['baik', 'rusak_ringan', 'rusak_berat'])->nullable();
            }
            if (!Schema::hasColumn('borrowings', 'kondisi_kembali')) {
                $t->enum('kondisi_kembali', ['baik', 'rusak_ringan', 'rusak_berat', 'tidak_terima'])->nullable();
            }
            if (!Schema::hasColumn('borrowings', 'catatan_kondisi')) {
                $t->text('catatan_kondisi')->nullable();
            }
            if (!Schema::hasColumn('borrowings', 'tanggal_kondisi')) {
                $t->timestamp('tanggal_kondisi')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('borrowings', function (Blueprint $t) {
            $cols = [
                'nama_alat', 'nama_siswa', 'kelas_siswa', 'ruangan',
                'tanggal_pengembalian', 'kondisi_awal', 'kondisi_kembali',
                'catatan_kondisi', 'tanggal_kondisi',
            ];
            foreach ($cols as $c) {
                if (Schema::hasColumn('borrowings', $c)) {
                    $t->dropColumn($c);
                }
            }
        });
    }
};
