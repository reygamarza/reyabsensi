<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            WaliSiswaSeeder::class,
            KelasSeeder::class,
            SiswaSeeder::class,
            WaktuAbsenSeeder::class,
            KoordinatSeeder::class,
            AbsensiSeeder::class,
        ]);
    }
}
