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
        
        // FIELD DARI PROFILE
        'nama_lengkap',
        'nim',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat_lengkap', 

        // TAMBAHKAN 'pembimbing_id' AGAR BISA DISIMPAN OLEH ADMIN
        'pembimbing_id',

        // ==========================================
        // == TAMBAHAN BARU: DATA WALI & BIOMETRIK ==
        // ==========================================
        'nama_wali',
        'email_wali',
        'no_hp_wali',
        'face_descriptor',
        'otp_code', // Wajib dimasukkan agar sistem bisa menyimpan OTP saat registrasi
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


    // ===================================================================
    // == RELASI DATABASE ==
    // ===================================================================

    /**
     * Relasi: Satu Pembimbing punya BANYAK Mahasiswa.
     */
    public function mahasiswaYangDibimbing()
    {
        // 'pembimbing_id' adalah nama kolom di tabel 'users'
        return $this->hasMany(User::class, 'pembimbing_id');
    }

    /**
     * Relasi: Satu Mahasiswa punya SATU Pembimbing.
     */
    public function pembimbing()
    {
        // 'pembimbing_id' adalah nama kolom di tabel 'users'
        return $this->belongsTo(User::class, 'pembimbing_id');
    }

    /**
     * Relasi: Satu Mahasiswa punya BANYAK Laporan Harian.
     */
    public function laporanHarian()
    {
        // 'user_id' adalah nama kolom di tabel 'laporan_harian'
        return $this->hasMany(LaporanHarian::class, 'user_id');
    }
}