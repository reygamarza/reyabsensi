<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\User;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {
    //     Siswa::create([
    //         'nis' => '0061748352',
    //         'id_user' => 3,
    //         'id_kelas' => 1,
    //         'jenis_kelamin' => 'laki laki',
    //         'nik_ibu' => '8014821110742201',
    //         'nisn' => '0045678901',
    //     ]);

    //     Siswa::create([
    //         'nis' => '0061748353',
    //         'id_user' => 12,
    //         'id_kelas' => 1,
    //         'jenis_kelamin' => 'laki laki',
    //         'nisn' => '0045678907',
    //     ]);

    //     Siswa::create([
    //         'nis' => '0061748354',
    //         'id_user' => 13,
    //         'id_kelas' => 1,
    //         'jenis_kelamin' => 'laki laki',
    //         'nisn' => '0045678909',
    //     ]);

    //     Siswa::create([
    //         'nis' => '0062894371',
    //         'id_user' => 4,
    //         'id_kelas' => 2,
    //         'nik_ayah' => '5347370412765277',
    //         'jenis_kelamin' => 'laki laki',
    //         'nisn' => '0045678902',
    //     ]);

    //     Siswa::create([
    //         'nis' => '0069584720',
    //         'id_user' => 5,
    //         'id_kelas' => 3,
    //         'nik_ayah' => '5947550102888607',
    //         'jenis_kelamin' => 'perempuan',
    //         'nisn' => '0045678903',
    //     ]);

    // }

    public function run()
    {
        $kelas_ids = Kelas::pluck('id_kelas');

        foreach ($kelas_ids as $kelas_id) {
            // Buat 35 user siswa untuk setiap kelas
            for ($i = 1; $i <= 35; $i++) {
                // Buat user dummy dengan factory
                $user = User::factory()->create();

                // Buat data siswa dan hubungkan dengan user serta kelas terkait
                Siswa::factory()->create([
                    'id_user' => $user->id,
                    'id_kelas' => $kelas_id,
                ]);
            }
        }
    }
}
