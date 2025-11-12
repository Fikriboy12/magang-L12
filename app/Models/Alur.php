<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alur extends Model
{
    protected $table = 'alur';
    protected $fillable = [
        'id_alur ', 'judul', 'deskripsi', '','created_at', 'updated_at'
    ];
}
