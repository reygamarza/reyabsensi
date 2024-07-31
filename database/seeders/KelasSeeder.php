<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelas::create([
            'id_jurusan' => 9,
            'nuptk' => '1234567890123456',
            'nomor_kelas' => 2,
            'tingkat' => '10',
        ]);

        Kelas::create([
            'id_jurusan' => 10,
            'nuptk' => 2345678901234567,
            'nomor_kelas' => 1,
            'tingkat' => '11',
        ]);

        Kelas::create([
            'id_jurusan' => 10,
            'nuptk' => 3456789012345678,
            'nomor_kelas' => 1,
            'tingkat' => '12',
        ]);
    }
}
