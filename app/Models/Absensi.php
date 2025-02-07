<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_absensi';
    protected $fillable = [
        'nis',
        'status',
        'foto_masuk',
        'foto_pulang',
        'keterangan',
        'tanggal',
        'jam_masuk',
        'jam_pulang',
        'latitude_masuk',
        'longitude_masuk',
        'latitude_pulang',
        'longitude_pulang',
        'menit_keterlambatan'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis');
    }
}
