<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';
    protected $primaryKey = 'nis';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nis',
        'id_user',
        'id_kelas',
        'nama',
        'jenis_kelamin',
        'nik_ayah',
        'nik_ibu',
        'nik_wali',
        'nisn',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'nis');
    }

    public function ortu()
    {
        return $this->belongsTo(Wali_Siswa::class, 'nik');
    }

    public $timestamps = false;
}
