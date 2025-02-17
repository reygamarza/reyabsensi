<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiSekolah extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_lokasi_sekolah';
    protected $fillable = [
        'latitude',
        'longitude',
        'radius_maksimum'
    ];

    public $timestamps = true;
}
