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
        'universitas',
        'jurusan',
        'prodi',            // PERBAIKAN: Sesuai nama kolom database (bukan program_studi)
        'dari_tanggal',
        'sampai_tanggal',
        'gambar',           // foto profil
        'cv',
        'surat_rekomendasi',
        'ktp',              // PERBAIKAN: Sesuai nama kolom database (bukan ktp_ktm)
        'proposal',
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