<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuAbsensi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_waktu_absensi';
    protected $fillable = [
        'absensi_masuk',
        'batas_absensi_masuk',
        'absensi_pulang',
        'batas_absensi_pulang'
    ];

    public $timestamps = true;
}
