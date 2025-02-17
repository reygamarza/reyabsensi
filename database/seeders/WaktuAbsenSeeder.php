<?php

namespace Database\Seeders;

use App\Models\Waktu_Absen;
use App\Models\WaktuAbsensi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaktuAbsenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WaktuAbsensi::create([
            'absen_masuk' => '06:15:00',
            'batas_absen_masuk' => '07:15:00',
            'absen_pulang' => '16:15:00',
            'batas_absen_pulang' => '18:15:00',
        ]);
    }
}
