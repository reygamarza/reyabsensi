<?php

namespace Database\Seeders;

use App\Models\Waktu_Absen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaktuAbsenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Waktu_Absen::create([
            'jam_absen' => '06:00:00',
            'batas_absen_masuk' => '07:15:00',
            'jam_pulang' => '16:15:00',
            'batas_absen_pulang' => '18:30:00',
        ]);
    }
}
