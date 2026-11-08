<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->foreignId('alat_id')
                ->nullable()
                ->unique()
                ->constrained('alats')
                ->nullOnDelete();
        });

        Schema::table('alats', function (Blueprint $table) {
            $table->string('foto')->nullable();
            $table->boolean('is_active')->default(true);
        });
    }

    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign(['alat_id']);
            $table->dropUnique(['alat_id']);
            $table->dropColumn('alat_id');
        });

        Schema::table('alats', function (Blueprint $table) {
            $table->dropColumn(['foto', 'is_active']);
        });
    }
};
