<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanHarian extends Model
{
    use HasFactory;

    // KITA HAPUS 'protected $table' KARENA:
    // Secara default, Laravel otomatis menyambungkan Model 'LaporanHarian'
    // ke tabel 'laporan_harians' (yang sudah kita buat di migrasi tadi).

    // Gunakan guarded = [] agar semua kolom bisa diisi (Anti Ribet)
    // Ini menggantikan $fillable, jadi kalau nambah kolom gak perlu edit sini lagi.
    protected $guarded = [];

    // Relasi ke User (Mahasiswa)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}