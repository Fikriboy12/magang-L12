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
        Schema::table('pendaftaran', function (Blueprint $table) {
            // A. Data Akademik Siswa
            if (!Schema::hasColumn('pendaftaran', 'nisn')) {
                $table->string('nisn')->nullable()->after('id_users');
            }
            if (!Schema::hasColumn('pendaftaran', 'nama_sekolah')) {
                $table->string('nama_sekolah')->nullable()->after('nisn');
            }
            if (!Schema::hasColumn('pendaftaran', 'kelas')) {
                $table->string('kelas')->nullable()->after('jurusan');
            }
            if (!Schema::hasColumn('pendaftaran', 'nama_guru_pembimbing')) {
                $table->string('nama_guru_pembimbing')->nullable()->after('kelas');
            }
            if (!Schema::hasColumn('pendaftaran', 'email_guru_pembimbing')) {
                $table->string('email_guru_pembimbing')->nullable()->after('nama_guru_pembimbing');
            }
            if (!Schema::hasColumn('pendaftaran', 'no_hp_guru_pembimbing')) {
                $table->string('no_hp_guru_pembimbing')->nullable()->after('email_guru_pembimbing');
            }

            // B. Data Orang Tua / Wali
            if (!Schema::hasColumn('pendaftaran', 'nama_wali')) {
                $table->string('nama_wali')->nullable()->after('no_hp_guru_pembimbing');
            }
            if (!Schema::hasColumn('pendaftaran', 'hubungan_wali')) {
                $table->string('hubungan_wali')->nullable()->after('nama_wali'); // Ayah / Ibu / Wali
            }
            if (!Schema::hasColumn('pendaftaran', 'no_hp_wali')) {
                $table->string('no_hp_wali')->nullable()->after('hubungan_wali');
            }
            if (!Schema::hasColumn('pendaftaran', 'email_wali')) {
                $table->string('email_wali')->nullable()->after('no_hp_wali');
            }

            // D. Dokumen Persyaratan
            if (!Schema::hasColumn('pendaftaran', 'surat_pengantar')) {
                $table->string('surat_pengantar')->nullable()->after('cv');
            }
            if (!Schema::hasColumn('pendaftaran', 'surat_izin_wali')) {
                $table->string('surat_izin_wali')->nullable()->after('surat_pengantar');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->dropColumn([
                'nisn',
                'nama_sekolah',
                'kelas',
                'nama_guru_pembimbing',
                'email_guru_pembimbing',
                'no_hp_guru_pembimbing',
                'nama_wali',
                'hubungan_wali',
                'no_hp_wali',
                'email_wali',
                'surat_pengantar',
                'surat_izin_wali'
            ]);
        });
    }
};
