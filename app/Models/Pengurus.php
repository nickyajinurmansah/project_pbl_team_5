<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengurus extends Model
{
    use HasFactory;

    protected $table = 'pengurus';

    protected $fillable = [
        'nama',
        'jenisKelamin',
        'jabatan',
        'no_hp',
        'email',
        'foto',
        'bio',
        'status',
        'alamat',
    ];
}