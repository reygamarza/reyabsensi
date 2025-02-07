<?php

namespace Database\Seeders;

use App\Models\LokasiSekolah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LokasiSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LokasiSekolah::create([
            'latitude' => '-6.890409928305306',
            'longitude' => '107.55840519694338',
            'radius_maksimum' => '200',
        ]);
    }
}
