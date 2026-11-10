<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'status_akun')) {
                // Pilihan: pending, approved, rejected. Default 'approved' agar user petugas/siswa lama tetap bisa login
                $table->string('status_akun')->default('approved')->after('role');
            }
        });

        // Pastikan akun siswa yang sudah ada sebelumnya tetap aktif (approved)
        DB::table('users')->whereNull('status_akun')->update(['status_akun' => 'approved']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'status_akun')) {
                $table->dropColumn('status_akun');
            }
        });
    }
};
