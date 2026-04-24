<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    //
    Use hasFactory;

    // Menentukan nama tabel secara eksplisit (opsional tapi disarankan)
    protected $table = 'pengurus';

     protected $fillable = [
        'id',
        'nama',
        'jabatan', 
        'no_hp',
        'email', 
        'foto',
        'bio',
        'status', 
    ];
}
