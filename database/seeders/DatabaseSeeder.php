<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Waktu_Absen;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            JurusanSeeder::class,
            WaliKelasSeeder::class,
            KelasSeeder::class,
            SiswaSeeder::class,
            WaktuAbsenSeeder::class,
            KoordinatSeeder::class,
        ]);
    }
}
