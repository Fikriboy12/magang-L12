<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Nama class akan berbeda sesuai tanggal Anda, TAPI ITU TIDAK MASALAH
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Kita akan mengubah tabel 'users'
        Schema::table('users', function (Blueprint $table) {
            
            // Tambahkan semua kolom baru ini
            // 'nullable()' berarti kolomnya boleh kosong
            $table->string('nama_lengkap')->nullable()->after('name');
            $table->string('nim')->nullable()->after('nama_lengkap');
            $table->string('nik')->nullable()->after('nim');
            $table->string('tempat_lahir')->nullable()->after('nik');
            $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            $table->string('jenis_kelamin')->nullable()->after('tanggal_lahir');
            $table->string('agama')->nullable()->after('jenis_kelamin');
            $table->text('alamat_lengkap')->nullable()->after('alamat'); // Tambahkan kolom alamat_lengkap
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Ini adalah kode untuk 'undo'
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'nama_lengkap',
                'nim',
                'nik',
                'tempat_lahir',
                'tanggal_lahir',
                'jenis_kelamin',
                'agama',
                'alamat_lengkap'
            ]);
        });
    }
};