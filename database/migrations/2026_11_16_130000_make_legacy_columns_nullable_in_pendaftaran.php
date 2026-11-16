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
        // Ubah kolom-kolom warisan lama agar nullable sehingga tidak memicu SQL Error 1364
        if (Schema::hasTable('pendaftaran')) {
            try {
                DB::statement("ALTER TABLE pendaftaran MODIFY ktp VARCHAR(255) NULL DEFAULT NULL");
            } catch (\Throwable $e) {}

            try {
                DB::statement("ALTER TABLE pendaftaran MODIFY proposal VARCHAR(255) NULL DEFAULT NULL");
            } catch (\Throwable $e) {}

            try {
                DB::statement("ALTER TABLE pendaftaran MODIFY surat_rekomendasi VARCHAR(255) NULL DEFAULT NULL");
            } catch (\Throwable $e) {}

            try {
                DB::statement("ALTER TABLE pendaftaran MODIFY cv VARCHAR(255) NULL DEFAULT NULL");
            } catch (\Throwable $e) {}
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak perlu di-revert agar tidak merusak data jika ada
    }
};
