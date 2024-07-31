<?php

namespace App\Livewire;

use App\Models\Waktu_Absen;
use Livewire\Component;

class Jamabsen extends Component
{
    public $jam_masuk;
    public $batas_jam_masuk;
    public $jam_pulang;
    public $batas_jam_pulang;

    public function render()
    {
        $jam = Waktu_Absen::first();

        $this->jam_masuk = $jam->jam_masuk;
        $this->batas_jam_masuk = $jam->batas_jam_masuk;
        $this->jam_pulang = $jam->jam_pulang;
        $this->batas_jam_pulang = $jam->batas_jam_pulang;

        return view('livewire.jamabsen');
    }

    public function updatejam()
    {
        $jam = Waktu_Absen::first();

        if($jam)
        {
            $jam_masuk = $this->jam_masuk;
            $batas_jam_masuk = $this->batas_jam_masuk;
            $jam_pulang = $this->jam_pulang;
            $batas_jam_pulang = $this->batas_jam_pulang;

            $jam->update([
                'jam_masuk' => $jam_masuk,
                'batas_jam_masuk' => $batas_jam_masuk,
                'jam_pulang' => $jam_pulang,
                'batas_jam_pulang' => $batas_jam_pulang,
            ]);

            return redirect()->route('operator.index')->with('berhasil', 'Data Waktu Absen Berhasil Diubah');
        } else {
            return redirect()->route('operator.index')->with('gagal', 'Data Waktu Absen Gagal Ditemukan');
        }
    }
}
