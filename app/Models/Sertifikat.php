<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;

    protected $table = 'sertifikat';

    protected $fillable = [
        'nama_sertifikat',
        'file_path',
        'created_by',
        'status_pengajuan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
