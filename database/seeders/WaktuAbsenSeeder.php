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
            'jam_masuk' => '07:00:00',
            'batas_jam_masuk' => '07:30:00',
            'jam_pulang' => '15:00:00',
            'batas_jam_pulang' => '15:30:00',
        ]);
    }
}
