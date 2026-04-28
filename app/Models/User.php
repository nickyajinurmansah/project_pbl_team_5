<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 📘 MODEL AUTENTIKASI (User)
 * Class ini berfungsi sebagai jembatan untuk login ke tabel 'Akun'.
 * Kita override settingan default Laravel agar membaca tabel 'Akun' 
 * dan kolom 'username', bukan 'users' dan 'email'.
 */
class User extends Authenticatable
{
    use Notifiable, HasFactory;

    // 1️⃣ Arahkan ke tabel 'Akun' di database
    protected $table = 'akun'; 

    // 2️⃣ Primary Key sesuai tabel Akun
    protected $primaryKey = 'id_Akun'; 

    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false; // Tabel Akun tidak punya created_at/updated_at

    // 3️⃣ Kolom yang boleh diisi (sesuai tabel Akun)
    protected $fillable = [
        'username', 
        'password', 
        'role', 
    ];
    
    // 4️⃣ Sembunyikan password saat dikonversi ke array/JSON (Keamanan)
    protected $hidden = [
        'password', 
    ];

    /**
     * 5️⃣ OVERRIDE IDENTIFIER
     * Laravel default login pakai 'email'. Kita ganti pakai 'username'.
     */
    public function getAuthIdentifierName()
    {
        return 'id_Akun'; //return 'Username' ini adalah masalah
    }
}