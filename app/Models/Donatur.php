<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    use HasFactory;

    protected $table = 'donatur';                 
    protected $primaryKey = 'id_donatur';         
    public $incrementing = true;
    protected $keyType = 'int';                   
    public $timestamps = true;                    

    protected $fillable = [
        'nama_donatur', 
        'no_hp', 
        'email', 
        'alamat',
        'foto',
    ];

    protected $casts = [
        'created_at' => 'datetime:d M Y, H:i',
        'updated_at' => 'datetime:d M Y, H:i',
    ];

}