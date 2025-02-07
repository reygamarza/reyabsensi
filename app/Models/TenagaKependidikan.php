<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenagaKependidikan extends Model
{
    use HasFactory;

    protected $primaryKey = 'nip';
    protected $fillable = [
        'nip',
        'id_user',
        'jenis_kelamin',
        'nuptk',
        'no_telp'
    ];

    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'nip');
    }
}
