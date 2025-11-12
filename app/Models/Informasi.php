<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    protected $table = 'informasi';
    protected $fillable = [
        'id_informasi', 'judul', 'deskripsi', 'penulis', 'gambar_informasi', 'tgl_informasi', 'created_at', 'updated_at'
    ];
}
