<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Absensi;

class SubmitAbsen extends Component
{
    public $image;
    public $lokasisiswa;
    public $successMessage;
    public $errorMessage;

    public function ambilAbsen()
    {
        $user = Auth::user();
        $nis = $user->siswa->nis;
        $status = 'Hadir';
        $date = date("Y-m-d");
        $jam = date("H:i:s");
        $koordinat = explode(", ", $this->lokasi);
        $latitudeuser = trim($koordinat[0]);
        $longitudeuser = trim($koordinat[1]);

        $image_parts = explode(";base64", $this->image);
        $image_base64 = base64_decode($image_parts[1]);

        $folderPath = "public/uploads/absensi/";
        $formatMasuk = $nis . "_" . $date . "_" . "masuk";
        $formatPulang = $nis . "_" . $date . "_" . "pulang";

        $cekabsen = Absensi::where('date', $date)
            ->where('nis', $nis)
            ->first();

        if ($cekabsen) {
            $fileName = $formatPulang . ".png";
            $cekabsen->update([
                'photo_out' => $fileName,
                'jam_pulang' => $jam,
                'titik_koordinat_pulang' => $latitudeuser . ',' . $longitudeuser,
            ]);
            Storage::put($folderPath . $fileName, $image_base64);

            return redirect()->route('absen-masuk')->with('berhasil', 'Terima Kasih!, Absen Pulang Berhasil Dicatat.');
        } else {
            $fileName = $formatMasuk . ".png";
            Absensi::create([
                'nis' => $nis,
                'status' => $status,
                'photo_in' => $fileName,
                'date' => $date,
                'jam_masuk' => $jam,
                'titik_koordinat_masuk' => $latitudeuser . ',' . $longitudeuser,
            ]);
            Storage::put($folderPath . $fileName, $image_base64);

            return redirect()->route('absen-masuk')->with('berhasil', 'Terima Kasih! Kehadiran Berhasil Dicatat.');
        }
    }

    public function render()
    {
        return view('livewire.submit-absen');
    }
}
