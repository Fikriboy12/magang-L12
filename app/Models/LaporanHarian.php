<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanHarian extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database
     */
    protected $table = 'laporan_harian';

    /**
     * Kolom yang boleh diisi secara massal (mass assignable).
     */
    protected $fillable = [
        'user_id',
        'tanggal',
        'kegiatan',
        'foto',
        'catatan',
    ];

    /**
     * Relasi: Satu Laporan Harian dimiliki oleh SATU User (Mahasiswa).
     */
    public function mahasiswa()
    {
        // 'user_id' adalah nama kolom di tabel 'laporan_harian'
        return $this->belongsTo(User::class, 'user_id');
    }
}