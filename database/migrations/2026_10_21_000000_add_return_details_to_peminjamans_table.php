<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            if (!Schema::hasColumn('peminjamans', 'tanggal_pengembalian')) {
                $table->date('tanggal_pengembalian')->nullable();
            }
            if (!Schema::hasColumn('peminjamans', 'kondisi_kembali')) {
                $table->string('kondisi_kembali')->nullable();
            }
            if (!Schema::hasColumn('peminjamans', 'catatan_kondisi')) {
                $table->text('catatan_kondisi')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            $columns = array_filter(
                ['tanggal_pengembalian', 'kondisi_kembali', 'catatan_kondisi'],
                static fn (string $column) => Schema::hasColumn('peminjamans', $column)
            );

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};
