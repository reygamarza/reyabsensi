<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Wali_Kelas;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class WaliKelasImport implements ToModel, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        $user = User::create([
            'nama'     => $row['nama'],
            'email'    => $row['email'],
            'password' => Hash::make($row['password']),
            'role'     => 'wali',
        ]);

        return Wali_Kelas::create([
            'nuptk' => '00' . strval($row['nuptk']),
            'id_user'        => $user->id,
            'jenis_kelamin'  => $row['jenis_kelamin'],
            'nip'           => $row['nip'],
        ]);
    }
}
