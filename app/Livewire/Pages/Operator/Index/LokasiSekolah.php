<?php

namespace App\Livewire\Pages\Operator\Index;

use App\Models\LokasiSekolah as ModelsLokasiSekolah;
use Livewire\Component;

class LokasiSekolah extends Component
{
    public $latitude = '';
    public $longitude = '';
    public $radius = '';

    public function mount()
    {
        $lokasiSekolah = ModelsLokasiSekolah::first();

        $this->latitude = $lokasiSekolah->latitude;
        $this->longitude = $lokasiSekolah->longitude;
        $this->radius = $lokasiSekolah->radius_maksimum;
    }

    public function save()
    {
        $lokasiSekolah = ModelsLokasiSekolah::first();

        if ($lokasiSekolah) {
            $lokasiSekolah->update([
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'radius_maksimum' => $this->radius
            ]);
        }

        $this->dispatch(
            'lokasi-updated',
            latitude: $this->latitude,
            longitude: $this->longitude,
            radius: $this->radius
        );

        session()->flash('message', 'Lokasi berhasil diperbarui!');
    }
    
    public function render()
    {
        return view('livewire.pages.operator.index.lokasi-sekolah');
    }
}
