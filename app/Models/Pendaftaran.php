<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

    protected $fillable = [
        'user_id',              // ID user pelamar
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
        'sertifikat',           // tambahan file sertifikat jika mau
        'status_pendaftaran',   // misal: pending, diterima, ditolak
        'keterangan',           // catatan admin
    ];
}
