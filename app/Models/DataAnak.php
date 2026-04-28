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

     // ← PENTING: Set false karena tabel tidak punya created_at/updated_at
    public $timestamps = false;

    protected $fillable = [
        'NIK',
        'nama_lengkap',
        'tanggal_lahir',
        'jenis_kelamin',      // ← PERBAIKAN
        'alamat',
        'tanggal_masuk',
        'status',
        'nama_ayah',
        'nama_ibu',
        'alamat_orang_tua',
        'foto_anak',          // ← PERBAIKAN (dari 'Foto')
        'kategori_anak',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk' => 'date',
    ];
}