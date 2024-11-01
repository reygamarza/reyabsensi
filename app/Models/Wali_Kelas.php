<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wali_Kelas extends Model
{
    use HasFactory;

    protected $table = 'wali__kelas';
    public $primaryKey = 'nip';
    // public $incrementing = false;
    // protected $keyType = 'string';

    protected $fillable = [
        'nip',
        'id_user',
        'jenis_kelamin',
        'nuptk',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public $timestamps = false;
}
