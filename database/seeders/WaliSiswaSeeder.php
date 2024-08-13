<?php

namespace Database\Seeders;

use App\Models\Wali_Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaliSiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Wali_Siswa::create([
            'nik' => '5347370412765277',
            'id_user' => 9,
            'jenis_kelamin' => 'laki laki',
        ]);

        Wali_Siswa::create([
            'nik' => '8014821110742201',
            'id_user' => 10,
            'jenis_kelamin' => 'perempuan',
        ]);

        Wali_Siswa::create([
            'nik' => '5947550102888607',
            'id_user' => 11,
            'jenis_kelamin' => 'laki laki',
        ]);
    }
}
