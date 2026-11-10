<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('items', function (Blueprint $table) {
            if (!Schema::hasColumn('items', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('nama_barang');
            }
        });

        Schema::table('alats', function (Blueprint $table) {
            if (!Schema::hasColumn('alats', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('nama_alat');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            if (Schema::hasColumn('items', 'deskripsi')) {
                $table->dropColumn('deskripsi');
            }
        });

        Schema::table('alats', function (Blueprint $table) {
            if (Schema::hasColumn('alats', 'deskripsi')) {
                $table->dropColumn('deskripsi');
            }
        });
    }
};
