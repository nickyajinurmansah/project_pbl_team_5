<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAnak extends Model
{
    use HasFactory;

    protected $table = 'data_anak';
    protected $primaryKey = 'idanak_panti';
    public $incrementing = true;
    protected $keyType = 'integer';

    public $timestamps = false;

    protected $fillable = [
        'NIK',
        'nama',
        'tgl_lahir',
        'jns_kelamin',
        'alamat',
        'tgl_masuk',
        'status',
        'nama_Ortu',
        'Foto',
        'kategori_anak',
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
        'tgl_masuk' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}