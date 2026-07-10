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
        // PENTING: Nama tabel menggunakan akhiran 's' (laporan_harians)
        // agar otomatis terbaca oleh Model Laravel tanpa setting tambahan.
        Schema::create('laporan_harians', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel users
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->date('tanggal');
            $table->text('kegiatan');
            $table->string('foto'); // Pastikan ini string untuk menyimpan path file
            $table->text('catatan')->nullable();

            // Kolom status langsung dibuat di sini agar tidak error
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_harians');
    }
};