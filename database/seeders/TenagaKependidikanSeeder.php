<?php

namespace Database\Seeders;

use App\Models\TenagaKependidikan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenagaKependidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TenagaKependidikan::create([
            'nip' => '196206111988001009',
            'id_user' => '3',
            'jenis_kelamin' => 'Perempuan',
            'nuptk' => '1600318900754702',
            'no_telp' => '0895330552456',
        ]);

        TenagaKependidikan::create([
            'nip' => '196206111988001010',
            'id_user' => '4',
            'jenis_kelamin' => 'Perempuan',
            'nuptk' => '1600318900754703',
            'no_telp' => '0895330552457',
        ]);
    }
}
