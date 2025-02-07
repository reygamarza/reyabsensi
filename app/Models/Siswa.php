<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $primaryKey = 'nis';
    protected $fillable = [
        'nis',
        'id_user',
        'nik_ayah',
        'nik_ibu',
        'nik_wali',
        'id_kelas',
        'jenis_kelamin',
        'nisn',
        'tempat_lahir',
        'tanggal_lahir'
    ];

    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function waliSiswa()
    {
        return $this->belongsTo(WaliSiswa::class, 'nik_ayah', 'nik')
                    ->orWhere('nik_ibu', 'nik')
                    ->orWhere('nik_wali', 'nik');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_kelas');
    }
}
