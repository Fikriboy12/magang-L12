<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id('id_pendaftaran');
            $table->string('gambar')->nullable();
            $table->string('ktp')->nullable();
            $table->string('prodi')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('surat_rekomendasi')->nullable();
            $table->string('cv')->nullable();
            $table->string('proposal')->nullable();
            $table->unsignedBigInteger('id_users')->nullable();
            $table->string('universitas')->nullable();
            $table->date('dari_tanggal')->nullable();
            $table->date('sampai_tanggal')->nullable();
            $table->string('status_pendaftaran')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
