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
        Schema::create('laporan_harian', function (Blueprint $table) {
            $table->id();
            
            // Kolom untuk menyambungkan laporan ini ke mahasiswa (user)
            $table->foreignId('user_id')
                  ->constrained('users')      // Merujuk ke kolom 'id' di tabel 'users'
                  ->onDelete('cascade');    // Jika user dihapus, laporannya ikut terhapus

            $table->date('tanggal');        // Tanggal laporan
            $table->text('kegiatan');       // Teks deskripsi kegiatan
            $table->string('foto');         // Path/nama file foto
            $table->text('catatan')->nullable(); // Catatan tambahan (boleh kosong)
            
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_harian');
    }
};