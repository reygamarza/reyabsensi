<?php

namespace Database\Seeders;

use App\Models\Absensi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AbsensiSeeder extends Seeder
{
    public function run()
    {
        // Daftar NIS siswa
        $nisList = ['0069584720', '0062894371', '0061748352']; // Tambahkan NIS siswa lainnya sesuai kebutuhan
        $titikKoordinat = '-6.890622076541303, 107.55806983605572'; // Ganti dengan koordinat yang sesuai
        $statuses = ['Hadir', 'Terlambat', 'Sakit', 'Izin', 'Alfa', 'TAP']; // Daftar status

        // Tanggal mulai dan akhir untuk data absensi
        $startDate = new \DateTime('2024-10-01'); // Ubah sesuai kebutuhan
        $endDate = new \DateTime('2024-10-31'); // Ubah sesuai kebutuhan

        // Menghitung selisih hari
        $interval = new \DateInterval('P1D'); // Interval 1 hari
        $dateRange = new \DatePeriod($startDate, $interval, $endDate->modify('+1 day')); // Termasuk hari terakhir

        foreach ($nisList as $nis) {
            foreach ($dateRange as $date) {
                // Hanya ambil hari kerja (Senin-Jumat)
                if ($date->format('N') <= 5) { // 1 = Senin, 7 = Minggu
                    $status = $statuses[array_rand($statuses)]; // Pilih status secara acak

                    // Inisialisasi variabel untuk foto dan keterlambatan
                    $photoIn = null;
                    $photoOut = null;
                    $jamMasuk = '06:12:34';
                    $jamPulang = '16:45:56';
                    $menitKeterlambatan = null;

                    // Logika untuk menentukan foto dan jam masuk/pulang berdasarkan status
                    switch ($status) {
                        case 'Hadir':
                        case 'Terlambat':
                        case 'TAP':
                            $photoIn = "0062894371_2024-08-07_masuk.png";
                            $photoOut = "0062894371_2024-08-07_masuk.png";
                            break;

                        case 'Sakit':
                        case 'Izin':
                            $photoIn = "0062894371_2024-10-15_izin.jpeg"; // Gunakan foto izin
                            $photoOut = "0062894371_2024-10-15_izin.jpeg"; // Foto yang sama
                            break;

                        case 'Alfa':
                            $jamMasuk = null;
                            $jamPulang = null;
                            break;
                    }

                    // Jika status terlambat, tentukan menit keterlambatan (misal 15 menit)
                    if ($status === 'Terlambat') {
                        $menitKeterlambatan = 15; // Ubah sesuai kebutuhan
                    }

                    // Buat data absensi
                    Absensi::create([
                        'nis' => $nis,
                        'status' => $status,
                        'photo_in' => $photoIn,
                        'photo_out' => $photoOut,
                        'date' => $date->format('Y-m-d'),
                        'jam_masuk' => $jamMasuk,
                        'jam_pulang' => $jamPulang,
                        'titik_koordinat_masuk' => $status === 'Alfa' || $status === 'Sakit' || $status === 'Izin' ? null : $titikKoordinat,
                        'titik_koordinat_pulang' => $status === 'Alfa' || $status === 'Sakit' || $status === 'Izin' ? null : $titikKoordinat,
                        'menit_keterlambatan' => $menitKeterlambatan,
                    ]);
                }
            }
        }
    }
    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {
    //     $nis = '0062894371';
    //     $titikKoordinat = '-6.890622076541303, 107.55806983605572';

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-01_masuk.png',
    //         'photo_out' => '0062894371_2024-08-01_keluar.png',
    //         'date' => '2024-07-01',
    //         'jam_masuk' => '06:12:34',
    //         'jam_pulang' => '16:45:56',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-02_masuk.png',
    //         'photo_out' => '0062894371_2024-08-02_keluar.png',
    //         'date' => '2024-07-02',
    //         'jam_masuk' => '06:45:12',
    //         'jam_pulang' => '16:30:22',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-03_masuk.png',
    //         'photo_out' => '0062894371_2024-08-03_keluar.png',
    //         'date' => '2024-07-03',
    //         'jam_masuk' => '06:30:45',
    //         'jam_pulang' => '17:15:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-04_masuk.png',
    //         'photo_out' => '0062894371_2024-08-04_keluar.png',
    //         'date' => '2024-07-04',
    //         'jam_masuk' => '07:10:00',
    //         'jam_pulang' => '16:55:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-05_masuk.png',
    //         'photo_out' => '0062894371_2024-08-05_keluar.png',
    //         'date' => '2024-07-05',
    //         'jam_masuk' => '06:00:00',
    //         'jam_pulang' => '16:00:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Sakit',
    //         'photo_in' => '0062894371_2024-08-06_masuk.png',
    //         'photo_out' => null,
    //         'date' => '2024-07-06',
    //         'jam_masuk' => null,
    //         'jam_pulang' => null,
    //         'titik_koordinat_masuk' => null,
    //         'titik_koordinat_pulang' => null,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Sakit',
    //         'photo_in' => '0062894371_2024-08-06_masuk.png',
    //         'photo_out' => null,
    //         'date' => '2024-07-07',
    //         'jam_masuk' => null,
    //         'jam_pulang' => null,
    //         'titik_koordinat_masuk' => null,
    //         'titik_koordinat_pulang' => null,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-08_masuk.png',
    //         'photo_out' => '0062894371_2024-08-08_keluar.png',
    //         'date' => '2024-07-08',
    //         'jam_masuk' => '06:55:00',
    //         'jam_pulang' => '16:50:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-09_masuk.png',
    //         'photo_out' => '0062894371_2024-08-09_keluar.png',
    //         'date' => '2024-07-09',
    //         'jam_masuk' => '06:15:00',
    //         'jam_pulang' => '17:10:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-10_masuk.png',
    //         'photo_out' => '0062894371_2024-08-10_keluar.png',
    //         'date' => '2024-07-10',
    //         'jam_masuk' => '07:00:00',
    //         'jam_pulang' => '16:25:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Izin',
    //         'photo_in' => '0062894371_2024-08-11_masuk.png',
    //         'photo_out' => null,
    //         'date' => '2024-07-11',
    //         'jam_masuk' => null,
    //         'jam_pulang' => null,
    //         'titik_koordinat_masuk' => null,
    //         'titik_koordinat_pulang' => null,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-12_masuk.png',
    //         'photo_out' => '0062894371_2024-08-12_keluar.png',
    //         'date' => '2024-07-12',
    //         'jam_masuk' => '06:35:00',
    //         'jam_pulang' => '16:32:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-13_masuk.png',
    //         'photo_out' => '0062894371_2024-08-13_keluar.png',
    //         'date' => '2024-07-13',
    //         'jam_masuk' => '06:20:00',
    //         'jam_pulang' => '16:40:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-14_masuk.png',
    //         'photo_out' => '0062894371_2024-08-14_keluar.png',
    //         'date' => '2024-07-14',
    //         'jam_masuk' => '06:50:00',
    //         'jam_pulang' => '16:15:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'TAP',
    //         'photo_in' => '0062894371_2024-08-15_masuk.png',
    //         'photo_out' => null,
    //         'date' => '2024-07-15',
    //         'jam_masuk' => '06:05:00',
    //         'jam_pulang' => null,
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => null,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Terlambat',
    //         'photo_in' => '0062894371_2024-08-16_masuk.png',
    //         'photo_out' => '0062894371_2024-08-16_keluar.png',
    //         'date' => '2024-07-16',
    //         'jam_masuk' => '08:15:00',
    //         'jam_pulang' => '16:50:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //         'menit_keterlambatan' => '180',
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-17_masuk.png',
    //         'photo_out' => '0062894371_2024-08-17_keluar.png',
    //         'date' => '2024-07-17',
    //         'jam_masuk' => '06:40:00',
    //         'jam_pulang' => '16:25:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-18_masuk.png',
    //         'photo_out' => '0062894371_2024-08-18_keluar.png',
    //         'date' => '2024-07-18',
    //         'jam_masuk' => '06:55:00',
    //         'jam_pulang' => '16:59:12',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Terlambat',
    //         'photo_in' => '0062894371_2024-08-19_masuk.png',
    //         'photo_out' => '0062894371_2024-08-19_keluar.png',
    //         'date' => '2024-07-19',
    //         'jam_masuk' => '08:12:01',
    //         'jam_pulang' => '17:15:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //         'menit_keterlambatan' => '60',
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Alfa',
    //         'photo_in' => null,
    //         'photo_out' => null,
    //         'date' => '2024-07-20',
    //         'jam_masuk' => null,
    //         'jam_pulang' => null,
    //         'titik_koordinat_masuk' => null,
    //         'titik_koordinat_pulang' => null,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-21_masuk.png',
    //         'photo_out' => '0062894371_2024-08-21_keluar.png',
    //         'date' => '2024-07-21',
    //         'jam_masuk' => '06:55:00',
    //         'jam_pulang' => '16:30:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-22_masuk.png',
    //         'photo_out' => '0062894371_2024-08-22_keluar.png',
    //         'date' => '2024-07-22',
    //         'jam_masuk' => '07:00:00',
    //         'jam_pulang' => '16:55:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-23_masuk.png',
    //         'photo_out' => '0062894371_2024-08-23_keluar.png',
    //         'date' => '2024-07-23',
    //         'jam_masuk' => '06:40:00',
    //         'jam_pulang' => '16:40:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'TAP',
    //         'photo_in' => '0062894371_2024-08-24_masuk.png',
    //         'photo_out' => '0062894371_2024-08-24_keluar.png',
    //         'date' => '2024-07-24',
    //         'jam_masuk' => '06:10:00',
    //         'jam_pulang' => null,
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => null,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-25_masuk.png',
    //         'photo_out' => '0062894371_2024-08-25_keluar.png',
    //         'date' => '2024-07-25',
    //         'jam_masuk' => '06:30:00',
    //         'jam_pulang' => '17:05:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-26_masuk.png',
    //         'photo_out' => '0062894371_2024-08-26_keluar.png',
    //         'date' => '2024-07-26',
    //         'jam_masuk' => '06:45:00',
    //         'jam_pulang' => '16:35:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-27_masuk.png',
    //         'photo_out' => '0062894371_2024-08-27_keluar.png',
    //         'date' => '2024-07-27',
    //         'jam_masuk' => '06:20:00',
    //         'jam_pulang' => '17:00:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Terlambat',
    //         'photo_in' => '0062894371_2024-08-28_masuk.png',
    //         'photo_out' => '0062894371_2024-08-28_keluar.png',
    //         'date' => '2024-07-28',
    //         'jam_masuk' => '07:40:00',
    //         'jam_pulang' => '17:10:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //         'menit_keterlambatan' => '43',
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Alfa',
    //         'photo_in' => null,
    //         'photo_out' => null,
    //         'date' => '2024-07-29',
    //         'jam_masuk' => null,
    //         'jam_pulang' => null,
    //         'titik_koordinat_masuk' => null,
    //         'titik_koordinat_pulang' => null,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-27_masuk.png',
    //         'photo_out' => '0062894371_2024-08-27_keluar.png',
    //         'date' => '2024-08-01',
    //         'jam_masuk' => '06:21:33',
    //         'jam_pulang' => '16:20:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-27_masuk.png',
    //         'photo_out' => '0062894371_2024-08-27_keluar.png',
    //         'date' => '2024-08-02',
    //         'jam_masuk' => '06:20:00',
    //         'jam_pulang' => '17:00:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-27_masuk.png',
    //         'photo_out' => '0062894371_2024-08-27_keluar.png',
    //         'date' => '2024-08-03',
    //         'jam_masuk' => '06:20:00',
    //         'jam_pulang' => '17:00:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-27_masuk.png',
    //         'photo_out' => '0062894371_2024-08-27_keluar.png',
    //         'date' => '2024-08-04',
    //         'jam_masuk' => '06:20:00',
    //         'jam_pulang' => '17:00:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-27_masuk.png',
    //         'photo_out' => '0062894371_2024-08-27_keluar.png',
    //         'date' => '2024-08-05',
    //         'jam_masuk' => '06:20:00',
    //         'jam_pulang' => '17:00:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-27_masuk.png',
    //         'photo_out' => '0062894371_2024-08-27_keluar.png',
    //         'date' => '2024-08-06',
    //         'jam_masuk' => '06:20:00',
    //         'jam_pulang' => '17:00:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-27_masuk.png',
    //         'photo_out' => '0062894371_2024-08-27_keluar.png',
    //         'date' => '2024-08-07',
    //         'jam_masuk' => '06:20:00',
    //         'jam_pulang' => '17:00:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-27_masuk.png',
    //         'photo_out' => '0062894371_2024-08-27_keluar.png',
    //         'date' => '2024-08-08',
    //         'jam_masuk' => '06:20:00',
    //         'jam_pulang' => '17:00:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-27_masuk.png',
    //         'photo_out' => '0062894371_2024-08-27_keluar.png',
    //         'date' => '2024-08-09',
    //         'jam_masuk' => '06:20:00',
    //         'jam_pulang' => '17:00:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-27_masuk.png',
    //         'photo_out' => '0062894371_2024-08-27_keluar.png',
    //         'date' => '2024-08-10',
    //         'jam_masuk' => '06:20:00',
    //         'jam_pulang' => '17:00:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-27_masuk.png',
    //         'photo_out' => '0062894371_2024-08-27_keluar.png',
    //         'date' => '2024-08-11',
    //         'jam_masuk' => '06:20:00',
    //         'jam_pulang' => '17:00:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);

    //     Absensi::create([
    //         'nis' => $nis,
    //         'status' => 'Hadir',
    //         'photo_in' => '0062894371_2024-08-27_masuk.png',
    //         'photo_out' => '0062894371_2024-08-27_keluar.png',
    //         'date' => '2024-08-12',
    //         'jam_masuk' => '06:20:00',
    //         'jam_pulang' => '17:00:00',
    //         'titik_koordinat_masuk' => $titikKoordinat,
    //         'titik_koordinat_pulang' => $titikKoordinat,
    //     ]);


    // }

}
