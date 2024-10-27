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
            'id_jurusan' => 'PPLG',
            'nomor_kelas' => 1,
            'nip' => '198005052022041001',
            'tingkat' => '10',
        ]);

        Kelas::create([
            'id_jurusan' => 'DKV',
            'nomor_kelas' => 1,
            'nip' => '198005052022011002',
            'tingkat' => '10',
        ]);

        Kelas::create([
            'id_jurusan' => 'RPL',
            'nomor_kelas' => 1,
            'nip' => '198005052022011003',
            'tingkat' => '11',
        ]);

        Kelas::create([
            'id_jurusan' => 'AK',
            'nomor_kelas' => 3,
            'nip' => '198005052022011004',
            'tingkat' => '11',
        ]);

        Kelas::create([
            'id_jurusan' => 'RPL',
            'nomor_kelas' => 1,
            'nip' => '198005052022011005',
            'tingkat' => '12',
        ]);

        Kelas::create([
            'id_jurusan' => 'RPL',
            'nomor_kelas' => 2,
            'nip' => '198005052022011006',
            'tingkat' => '12',
        ]);
    }
}
