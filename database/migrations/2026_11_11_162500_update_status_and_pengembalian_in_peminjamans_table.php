<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Untuk SQLite, mengubah enum constraint memerlukan recreate tabel sementara atau alter table
        // Laravel Schema di SQLite dapat mengubah kolom menjadi string biasa agar fleksibel untuk status baru
        // Kita juga tambahkan kolom tanggal_pengajuan_kembali jika belum ada
        
        // Cek driver
        if (DB::getDriverName() === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF');
            
            // Buat tabel peminjamans_new dengan status yang mencakup 'menunggu_konfirmasi'
            DB::statement("
                CREATE TABLE peminjamans_temp (
                    id integer primary key autoincrement not null,
                    user_id integer not null,
                    alat_id integer not null,
                    kategori varchar not null,
                    tanggal_pinjam date not null,
                    tanggal_kembali date not null,
                    keperluan varchar not null,
                    lokasi_penggunaan varchar not null,
                    keterangan text,
                    status varchar not null default 'menunggu',
                    created_at datetime,
                    updated_at datetime,
                    tanggal_pengembalian date,
                    kondisi_kembali varchar,
                    catatan_kondisi text,
                    tanggal_pengajuan_kembali datetime,
                    foreign key(user_id) references users(id) on delete cascade,
                    foreign key(alat_id) references alats(id) on delete cascade
                )
            ");

            // Salin data lama
            DB::statement("
                INSERT INTO peminjamans_temp (
                    id, user_id, alat_id, kategori, tanggal_pinjam, tanggal_kembali,
                    keperluan, lokasi_penggunaan, keterangan, status, created_at, updated_at,
                    tanggal_pengembalian, kondisi_kembali, catatan_kondisi
                )
                SELECT 
                    id, user_id, alat_id, kategori, tanggal_pinjam, tanggal_kembali,
                    keperluan, lokasi_penggunaan, keterangan, status, created_at, updated_at,
                    tanggal_pengembalian, kondisi_kembali, catatan_kondisi
                FROM peminjamans
            ");

            DB::statement("DROP TABLE peminjamans");
            DB::statement("ALTER TABLE peminjamans_temp RENAME TO peminjamans");
            DB::statement('PRAGMA foreign_keys = ON');
        } else {
            Schema::table('peminjamans', function (Blueprint $table) {
                if (!Schema::hasColumn('peminjamans', 'tanggal_pengajuan_kembali')) {
                    $table->dateTime('tanggal_pengajuan_kembali')->nullable()->after('catatan_kondisi');
                }
            });
        }
    }

    public function down(): void
    {
        // No-op rollback to preserve data integrity
    }
};
