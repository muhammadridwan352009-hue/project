<?php
// database/migrations/xxxx_add_detail_columns_to_alat_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alat', function (Blueprint $table) {
    $table->id();
    $table->string('nama_alat');
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::table('alat', function (Blueprint $table) {
            $table->dropColumn(['deskripsi', 'persyaratan', 'perlengkapan']);
        });
    }
};