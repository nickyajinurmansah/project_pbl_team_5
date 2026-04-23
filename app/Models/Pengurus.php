<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    use HasFactory;

    protected $table = 'pengguna';                
    protected $primaryKey = 'id_pengguna';        
    public $incrementing = true;
    protected $keyType = 'int';                   
    public $timestamps = true;                    

    protected $fillable = [
        'nama', 
        'no_hp', 
        'alamat', 
        'Akun_id_Akun'
    ];

    // Relasi ke tabel Akun (opsional)
    public function akun()
    {
        return $this->belongsTo(Akun::class, 'Akun_id_Akun', 'id_Akun');
    }
}