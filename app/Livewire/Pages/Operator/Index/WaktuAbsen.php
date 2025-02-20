<?php

namespace App\Livewire\Pages\Operator\Index;

use App\Models\WaktuAbsensi;
use Livewire\Component;

class WaktuAbsen extends Component
{
    public $absenMasuk;
    public $batasAbsenMasuk;
    public $absenPulang;
    public $batasAbsenPulang;

    public function mount()
    {
        $waktuAbsen = WaktuAbsensi::first();

        $this->absenMasuk = $waktuAbsen->absen_masuk;
        $this->batasAbsenMasuk = $waktuAbsen->batas_absen_masuk;
        $this->absenPulang = $waktuAbsen->absen_pulang;
        $this->batasAbsenPulang = $waktuAbsen->batas_absen_pulang;
    }

    public function save()
    {
        $waktuAbsen = WaktuAbsensi::first();

        if ($waktuAbsen) {
            $waktuAbsen->update([
                'absen_masuk' => $this->absenMasuk,
                'batas_absen_masuk' => $this->batasAbsenMasuk,
                'absen_pulang' => $this->absenPulang,
                'batas_absen_pulang' => $this->batasAbsenPulang
            ]);
        }

        session()->flash('message', 'Waktu Absen berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.pages.operator.index.waktu-absen');
    }
}
