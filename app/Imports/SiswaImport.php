<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class SiswaImport implements ToModel, WithHeadingRow
{
    protected $id_kelas;

    public function __construct($id_kelas)
    {
        $this->id_kelas = $id_kelas; // Ambil ID kelas dari URL atau parameter
    }

    public function model(array $row)
    {
        $user = User::create([
            'nama'     => $row['nama'],
            'email'    => $row['email'],
            'password' => Hash::make($row['password']),
            'role'     => 'siswa',
        ]);

        return Siswa::create([
            'nis'            => $row['nis'],
            'id_user'        => $user->id,
            'id_kelas'       => $this->id_kelas,
            'nik'            => $row['nik'],
            'jenis_kelamin'  => $row['jenis_kelamin'],
            'nisn'           => '00' . $row['nisn'],
        ]);
    }
}


