<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF');

            DB::statement("
                CREATE TABLE laporan_kondisi_alats_temp (
                    id integer primary key autoincrement not null,
                    user_id integer null,
                    peminjaman_id integer null,
                    alat_id integer null,
                    nama_peminjam varchar not null,
                    kode_inventaris varchar null,
                    kategori varchar null,
                    lokasi_kegiatan varchar null,
                    tanggal_pengembalian varchar null,
                    kondisi_terima varchar not null default 'rusak_ringan',
                    deskripsi_kerusakan text not null,
                    kirim_dengan_foto tinyint(1) not null default 0,
                    foto varchar null,
                    status varchar not null default 'menunggu',
                    catatan_petugas text null,
                    created_at datetime null,
                    updated_at datetime null,
                    foreign key(user_id) references users(id) on delete set null,
                    foreign key(peminjaman_id) references peminjamans(id) on delete set null,
                    foreign key(alat_id) references alats(id) on delete set null
                )
            ");

            if (Schema::hasTable('laporan_kondisi_alats')) {
                // If there were any rows, copy what exists
                $existingCols = Schema::getColumnListing('laporan_kondisi_alats');
                $hasPeminjaman = in_array('peminjaman_id', $existingCols);
                
                DB::statement("
                    INSERT INTO laporan_kondisi_alats_temp (
                        id, peminjaman_id, nama_peminjam, kode_inventaris, kategori,
                        lokasi_kegiatan, tanggal_pengembalian, kondisi_terima,
                        deskripsi_kerusakan, kirim_dengan_foto, created_at, updated_at
                    )
                    SELECT 
                        id, peminjaman_id, nama_peminjam, kode_inventaris, kategori,
                        lokasi_kegiatan, tanggal_pengembalian, kondisi_terima,
                        deskripsi_kerusakan, kirim_dengan_foto, created_at, updated_at
                    FROM laporan_kondisi_alats
                ");
            }

            Schema::dropIfExists('laporan_kondisi_alats');
            DB::statement('ALTER TABLE laporan_kondisi_alats_temp RENAME TO laporan_kondisi_alats');
            DB::statement('PRAGMA foreign_keys = ON');
        } else {
            Schema::table('laporan_kondisi_alats', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->onDelete('set null');
                $table->foreignId('alat_id')->nullable()->after('peminjaman_id')->constrained('alats')->onDelete('set null');
                $table->string('foto')->nullable()->after('kirim_dengan_foto');
                $table->string('status')->default('menunggu')->after('foto');
                $table->text('catatan_petugas')->nullable()->after('status');
                $table->foreignId('peminjaman_id')->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        // Reversal logic if necessary
    }
};
