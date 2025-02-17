<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kelas';
    protected $fillable = [
        'id_jurusan',
        'nip',
        'nomor_kelas',
        'tingkat',
        'kapasitas'
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }

    public function tenagaKependidikan()
    {
        return $this->belongsTo(TenagaKependidikan::class, 'nip');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_kelas');
    }
}
