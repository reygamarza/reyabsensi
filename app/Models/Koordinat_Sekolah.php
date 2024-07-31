<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koordinat_Sekolah extends Model
{
    use HasFactory;
    public $primaryKey = 'id_koordinat_sekolah';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'titik_koordinat',
        'radius',
    ];

    public function koordinat()
    {
        return $this->hasMany(Absensi::class, 'id_koordinat_sekolah');
    }

    public $timestamps = false;
}
