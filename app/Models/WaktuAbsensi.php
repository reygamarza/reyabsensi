<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuAbsensi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_waktu_absensi';
    protected $fillable = [
        'absen_masuk',
        'batas_absen_masuk',
        'absen_pulang',
        'batas_absen_pulang'
    ];

    public $timestamps = true;
}
