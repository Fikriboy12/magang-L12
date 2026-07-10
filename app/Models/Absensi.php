<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensis';
    
    protected $fillable = [
        'id_users',
        'tgl_absen',
        'jam_masuk',
        'jam_keluar',
        'status',
        'foto_bukti',   // Foto Masuk
        'foto_keluar',  // Foto Pulang
        'lokasi_masuk',
        'lokasi_keluar',
        'keterangan',
        'status_validasi'
    ];

    // Relasi ke User (Mahasiswa)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}