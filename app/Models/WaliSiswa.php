<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliSiswa extends Model
{
    use HasFactory;

    protected $primaryKey = 'nik';
    protected $fillable = [
        'nik',
        'id_user',
        'jenis_kelamin',
        'no_telp',
        'alamat'
    ];

    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'nik_ayah')
                    ->orWhere('nik_ibu', $this->nik)
                    ->orWhere('nik_wali', $this->nik);
    }
}
