<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('laporan_harian', function (Blueprint $table) {
            // Menambah kolom status dengan default 'pending'
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('foto_kegiatan');
        });
    }

    public function down()
    {
        Schema::table('laporan_harian', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};