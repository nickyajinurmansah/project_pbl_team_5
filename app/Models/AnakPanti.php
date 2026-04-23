<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnakPanti extends Model
{
    protected $table = 'data_anak';
    protected $primaryKey = 'idanak_panti'; // 
    public $incrementing = true;
    protected $keyType = 'int'; // 
    public $timestamps = true; // 

    protected $fillable = [
        'NIK', 'nama', 'tgl_lahir', 'jns_kelamin', 'alamat', 
        'tgl_masuk', 'status', 'nama_Ortu', 'Foto', 'kategori_anak'
    ];
}
