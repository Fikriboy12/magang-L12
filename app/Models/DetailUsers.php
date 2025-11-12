<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailUsers extends Model
{
    protected $table = 'detail_users';
    protected $fillable = [
        'id_detail_users ', 'nim', 'nik', 'jenis_kelamin', 'agama', 'tanggal_lahir', 'tempat_lahir', 'alamat_lengkap', 'nama_lengkap','id_users','created_at', 'updated_at'
    ];
}
