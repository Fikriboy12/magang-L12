<?php

namespace App\Models;

// Tambahan standar Laravel 10
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Diperlukan untuk Sanctum (Anda punya ini)

class User extends Authenticatable
{
    // Tambahkan HasApiTokens dan HasFactory
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // Field Asli Anda
        'name',
        'email',
        'password',
        'role',
        'no_telp',
        'status',
        'alamat',
        
        // ===========================================
        // PERBAIKAN: TAMBAHKAN SEMUA FIELD BARU DARI PROFILE
        // Ini akan mengizinkan Controller untuk menyimpannya ke database
        // ===========================================
        'nama_lengkap',
        'nim',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat_lengkap', // Sesuai dengan form Anda
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
