<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';
    protected $fillable = [
        'id_perusahaan ', 'nama_perusahaan', 'misi', 'depthead_email', 'visi', 'no_hp', 'facebook','email', 'instagram', 'id_users', 'gambar_perusahaan', 'alamat', 'created_at', 'updated_at'
    ];
}
