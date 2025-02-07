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
        $classData = [
            [
                'id_jurusan' => 'RPL',
                'nip' => '196206111988001009',
                'nomor_kelas' => '1',
                'tingkat' => '10',
                'kapasitas' => '35',
            ],
            [
                'id_jurusan' => 'TJKT',
                'nip' => '196206111988001010',
                'nomor_kelas' => '3',
                'tingkat' => '12',
                'kapasitas' => '36',
            ],
            [
                'id_jurusan' => 'DKV',
                'nip' => null,
                'nomor_kelas' => '2',
                'tingkat' => '11',
                'kapasitas' => '36',
            ],
            [
                'id_jurusan' => 'MPLB',
                'nip' => null,
                'nomor_kelas' => '4',
                'tingkat' => '10',
                'kapasitas' => '34',
            ]
        ];

        foreach ($classData as $class) {
            Kelas::create($class);
        }
    }
}
