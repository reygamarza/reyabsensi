<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Siswa::create([
            'nis' => '0061748352',
            'id_user' => 3,
            'id_kelas' => 1,
            'nik' => '5347370412765277',
            'jenis_kelamin' => 'laki laki',
            'nisn' => '0045678901',
        ]);

        Siswa::create([
            'nis' => '0062894371',
            'id_user' => 4,
            'id_kelas' => 2,
            'nik' => '8014821110742201',
            'jenis_kelamin' => 'laki laki',
            'nisn' => '0045678902',
        ]);

        Siswa::create([
            'nis' => '0069584720',
            'id_user' => 5,
            'id_kelas' => 3,
            'nik' => '5947550102888607',
            'jenis_kelamin' => 'perempuan',
            'nisn' => '0045678903',
        ]);

    }
}
