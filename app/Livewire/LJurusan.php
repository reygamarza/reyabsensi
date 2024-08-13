<?php

namespace App\Livewire;

use App\Models\Jurusan;
use Livewire\WithPagination;
use Livewire\Component;

class LJurusan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $nama_jurusan, $id_jurusan, $id_jurusan_lama;
    public $searchjurusan = '';

    public function render()
    {
        return view('livewire.ljurusan', [
            'daftarjurusan' => $this->getJurusan()
        ]);
    }

    protected function getJurusan()
    {
        return Jurusan::when($this->searchjurusan, function ($query) {
            $query->where('nama_jurusan', 'like', '%' . $this->searchjurusan . '%');
        })->paginate(7);

    }

    public function tambahjurusan()
    {
        $this->validate($this->rules());

        Jurusan::create([
            'id_jurusan' => $this->id_jurusan,
            'nama_jurusan' => $this->nama_jurusan,
        ]);

        return redirect()->route('jurusan-O')->with('berhasil', 'Data Jurusan Berhasil Ditambahkan');
        $this->clear();
    }

    public function editjurusan($id_jurusan)
    {
        $daftarjurusan = Jurusan::findOrFail($id_jurusan);

        $this->id_jurusan = $daftarjurusan->id_jurusan;
        $this->id_jurusan_lama = $daftarjurusan->id_jurusan;
        $this->nama_jurusan = $daftarjurusan->nama_jurusan;
    }

    public function updatejurusan()
    {
        $this->validate($this->rules());

        $jurusan = Jurusan::where('id_jurusan', $this->id_jurusan_lama);
        $jurusan->update([
            'id_jurusan' => $this->id_jurusan,
            'nama_jurusan' => $this->nama_jurusan,
        ]);

        return redirect()->route('jurusan-O')->with('berhasil', 'Data Jurusan Berhasil Diubah');
    }

    public function hapusjurusan($id_jurusan)
    {
        $jurusan = Jurusan::findOrFail($id_jurusan);
        $jurusan->delete();

        return redirect()->route('jurusan-O')->with('berhasil', 'Data Jurusan Berhasil Dihapus');
    }

    public function clear()
    {
        $this->id_jurusan = "";
        $this->nama_jurusan = "";
    }

    protected function rules()
    {
        return [
            'id_jurusan' => 'required',
            'nama_jurusan' => 'required',
        ];
    }
}
