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
        Schema::table('users', function (Blueprint $table) {
            // Kolom untuk membedakan role: 'admin', 'pelamar', 'pembimbing'
            // Kita set 'pelamar' sebagai default saat register
            $table->string('role')->default('pelamar')->after('email');
            
            // Kolom untuk menyambungkan mahasiswa ke pembimbingnya
            // Ini adalah Foreign Key ke tabel 'users' itu sendiri
            $table->foreignId('pembimbing_id')
                  ->nullable()              // Boleh kosong (untuk admin & pembimbing)
                  ->constrained('users')    // Merujuk ke kolom 'id' di tabel 'users'
                  ->onDelete('set null');  // Jika pembimbing dihapus, ID-nya jadi null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus foreign key constraint terlebih dahulu
            $table->dropForeign(['pembimbing_id']);
            
            // Hapus kedua kolom
            $table->dropColumn(['role', 'pembimbing_id']);
        });
    }
};