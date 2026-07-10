<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Kolom baru untuk data Orang Tua/Wali
            $table->string('nama_wali')->nullable()->after('no_telp');
            $table->string('email_wali')->nullable()->after('nama_wali');
            $table->string('no_hp_wali')->nullable()->after('email_wali');
            
            // Kolom untuk Biometrik Wajah
            $table->text('face_descriptor')->nullable()->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nama_wali', 'email_wali', 'no_hp_wali', 'face_descriptor']);
        });
    }
};