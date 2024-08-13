<?php

namespace App\Livewire;

use App\Models\Waktu_Absen;
use Livewire\Component;

class Jamabsen extends Component
{
    public $jam_absen;
    public $batas_absen_masuk;
    public $jam_pulang;
    public $batas_absen_pulang;

    public function render()
    {
        $jam = Waktu_Absen::first();

        $this->jam_absen = $jam->jam_absen;
        $this->batas_absen_masuk = $jam->batas_absen_masuk;
        $this->jam_pulang = $jam->jam_pulang;
        $this->batas_absen_pulang = $jam->batas_absen_pulang;

        return view('livewire.jamabsen');
    }

    public function updatejam()
    {
        $jam = Waktu_Absen::first();

        if($jam)
        {
            $jam_absen = $this->jam_absen;
            $batas_absen_masuk = $this->batas_absen_masuk;
            $jam_pulang = $this->jam_pulang;
            $batas_absen_pulang = $this->batas_absen_pulang;

            $jam->update([
                'jam_absen' => $jam_absen,
                'batas_absen_masuk' => $batas_absen_masuk,
                'jam_pulang' => $jam_pulang,
                'batas_absen_pulang' => $batas_absen_pulang,
            ]);

            return redirect()->route('operator.index')->with('berhasil', 'Data Waktu Absen Berhasil Diubah');
        } else {
            return redirect()->route('operator.index')->with('gagal', 'Data Waktu Absen Gagal Ditemukan');
        }
    }
}
