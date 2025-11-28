<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanHarian extends Model
{
    use HasFactory;

    // WAJIB ADA: Karena nama tabel Anda 'laporan_harian' (bukan laporan_harians)
    protected $table = 'laporan_harian'; 

    protected $fillable = [
        'user_id',  // Pastikan ini user_id
        'tanggal',
        'kegiatan',
        'foto',     // Pastikan ini foto (sesuai DB)
        'catatan',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
