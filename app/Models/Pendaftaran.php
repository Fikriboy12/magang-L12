<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';
    protected $primaryKey = 'id_pendaftaran'; // Pastikan Primary Key didefinisikan jika bukan 'id'

    protected $fillable = [
        'id_users',
        
        // A. Data Akademik Siswa
        'nisn',
        'nama_sekolah',
        'universitas',      // Kompatibilitas dengan sistem lama
        'jurusan',
        'prodi',            // Kompatibilitas sistem lama
        'kelas',
        'nama_guru_pembimbing',
        'email_guru_pembimbing',
        'no_hp_guru_pembimbing',

        // B. Data Orang Tua / Wali
        'nama_wali',
        'hubungan_wali',
        'no_hp_wali',
        'email_wali',

        // C. Data Pelaksanaan Magang
        'dari_tanggal',
        'sampai_tanggal',

        // D. Dokumen Persyaratan
        'gambar',           // Pas foto siswa (JPG/PNG)
        'cv',               // CV siswa (PDF)
        'surat_pengantar',  // Surat pengantar sekolah (PDF)
        'surat_rekomendasi',// Kompatibilitas sistem lama
        'surat_izin_wali',  // Surat izin orang tua/wali (PDF)
        'ktp',              // Kompatibilitas sistem lama
        'proposal',         // Kompatibilitas sistem lama
        'sertifikat',

        'status_pendaftaran',
        'keterangan',
    ];

    // ==========================================
    // RELASI KE USER
    // ==========================================
    public function user()
    {
        // Parameter ke-2: FK di tabel pendaftaran (id_users)
        // Parameter ke-3: PK di tabel users (id)
        return $this->belongsTo(User::class, 'id_users', 'id');
    }
}