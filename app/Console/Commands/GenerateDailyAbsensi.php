<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Siswa;
use App\Models\Absensi;
use Carbon\Carbon;

class GenerateDailyAbsensi extends Command
{
    protected $signature = 'absensi:generate-daily';
    protected $description = 'Generate default daily absensi for all students';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = Carbon::today();

        // Cek apakah hari ini akhir pekan
        if ($today->isWeekend()) {
            $this->info('Hari ini adalah akhir pekan, absensi tidak dibuat.');
            return;
        }

        // Dapatkan semua siswa
        $siswaList = Siswa::all();
        $todayDate = $today->toDateString();

        foreach ($siswaList as $siswa) {
            // Cek apakah absensi untuk siswa ini dan tanggal hari ini sudah ada
            $absensi = Absensi::where('nis', $siswa->nis)
                              ->whereDate('date', $todayDate)
                              ->first();

            if (!$absensi) {
                // Jika tidak ada, buat absensi baru dengan status 'Alfa'
                Absensi::create([
                    'nis' => $siswa->nis,
                    'status' => 'Alfa',
                    'date' => $todayDate,
                ]);
            }
        }

        $this->info('Default absensi created successfully for all students.');
    }
}
