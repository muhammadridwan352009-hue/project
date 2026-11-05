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
                $t->string('nama_alat')->nullable()->after('item_id');
            }
            if (!Schema::hasColumn('borrowings', 'kategori_alat')) {
                $t->string('kategori_alat', 50)->nullable()->after('nama_alat');
            }
            if (!Schema::hasColumn('borrowings', 'nis')) {
                $t->string('nis', 20)->nullable()->after('nama_peminjam');
            }
            if (!Schema::hasColumn('borrowings', 'kelas')) {
                $t->string('kelas', 30)->nullable()->after('nis');
            }
            if (!Schema::hasColumn('borrowings', 'ruangan')) {
                $t->string('ruangan', 50)->nullable()->after('lokasi');
            }
            if (!Schema::hasColumn('borrowings', 'kondisi_alat')) {
                $t->enum('kondisi_alat', ['baik', 'rusak_ringan', 'rusak_berat'])->default('baik')->after('ruangan');
            }
            if (!Schema::hasColumn('borrowings', 'catatan_kondisi')) {
                $t->text('catatan_kondisi')->nullable()->after('kondisi_alat');
            }
            if (!Schema::hasColumn('borrowings', 'tanggal_pengembalian')) {
                $t->date('tanggal_pengembalian')->nullable()->after('tanggal_kembali');
            }
        });
    }

    public function down(): void
    {
        Schema::table('borrowings', function (Blueprint $t) {
            // rollback opsional
        });
    }
};