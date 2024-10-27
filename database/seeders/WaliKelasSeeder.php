<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Wali_Kelas;

class WaliKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Wali_Kelas::create([
            'nip' => '198005052022041001',
            'id_user' => 3,
            'jenis_kelamin' => 'perempuan',
            'nuptk' => '4567890123456781',
        ]);

        Wali_Kelas::create([
            'nip' => '198005052022011002',
            'id_user' => 4,
            'jenis_kelamin' => 'perempuan',
            'nuptk' => '4567890123456782',
        ]);

        Wali_Kelas::create([
            'nip' => '198005052022011003',
            'id_user' => 5,
            'jenis_kelamin' => 'perempuan',
            'nuptk' => '4567890123456783',
        ]);

        Wali_Kelas::create([
            'nip' => '198005052022011004',
            'id_user' => 6,
            'jenis_kelamin' => 'laki laki',
            'nuptk' => '4567890123456784',
        ]);

        Wali_Kelas::create([
            'nip' => '198005052022011005',
            'id_user' => 7,
            'jenis_kelamin' => 'perempuan',
            'nuptk' => '4567890123456785',
        ]);

        Wali_Kelas::create([
            'nip' => '198005052022011006',
            'id_user' => 8,
            'jenis_kelamin' => 'perempuan',
            'nuptk' => '4567890123456786',
        ]);
    }
}
