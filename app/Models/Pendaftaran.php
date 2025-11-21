<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

    protected $fillable = [
        'id_users',             // SAYA SESUAIKAN JADI 'id_users' AGAR COCOK DGN CONTROLLER
        'universitas',
        'jurusan',
        'program_studi',
        'dari_tanggal',
        'sampai_tanggal',
        'gambar',               // foto/scan
        'cv',
        'surat_rekomendasi',
        'ktp_ktm',
        'proposal',
        // 'sertifikat',        // SAYA HAPUS SESUAI PERMINTAAN SEBELUMNYA
        'status_pendaftaran',   // misal: pending, diterima, ditolak
        'keterangan',           // catatan admin
    ];

    // ==========================================
    // TAMBAHAN PENTING: RELASI KE USER
    // ==========================================
    public function user()
    {
        // Ini menghubungkan kolom 'id_users' di tabel pendaftaran 
        // dengan kolom 'id' di tabel users.
        return $this->belongsTo(User::class, 'id_users', 'id');
    }
}