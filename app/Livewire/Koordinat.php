<?php

namespace App\Livewire;

use App\Models\Koordinat_Sekolah;
use Livewire\Component;

class Koordinat extends Component
{
    public $titik_koordinat;
    public $radius;

    public function render()
    {
        $koordinat = Koordinat_Sekolah::first();

        $this->titik_koordinat = $koordinat->titik_koordinat;
        $this->radius = $koordinat->radius;

        return view('livewire.koordinat');
    }

    public function updatekoordinat()
    {
        $koordinat = Koordinat_Sekolah::first();

        if ($koordinat) {
            $latitudesekolah = trim(explode(", ", $this->titik_koordinat)[0]);
            $longitudesekolah = trim(explode(", ", $this->titik_koordinat)[1]);
            $new_radius = $this->radius;

            $koordinat->update([
                'titik_koordinat' => $latitudesekolah . ', ' . $longitudesekolah,
                'radius' => $new_radius,
            ]);

            return redirect()->route('operator.index')->with('berhasil', 'Data Lokasi Sekolah Berhasil Diubah');
        } else {
            return redirect()->route('operator.index')->with('gagal', 'Data Lokasi Sekolah Gagal Ditemukan');
        }
    }
}
