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
            'nuptk' => '1234567890123456',
            'id_user' => 6,
            'jenis_kelamin' => 'laki laki',
            'nip' => '198005052022011001',
        ]);

        Wali_Kelas::create([
            'nuptk' => '2345678901234567',
            'id_user' => 7,
            'jenis_kelamin' => 'perempuan',
            'nip' => '198107062022021002',
        ]);

        Wali_Kelas::create([
            'nuptk' => '3456789012345678',
            'id_user' => 8,
            'jenis_kelamin' => 'perempuan',
            'nip' => '198209072022031003',
        ]);
    }
}
