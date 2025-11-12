<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';
    protected $fillable = [
        'id_galeri ', 'galeri_gambar', 'created_at', 'updated_at'
    ];
}
