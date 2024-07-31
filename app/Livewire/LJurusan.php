<?php

namespace App\Livewire;

use App\Models\Jurusan;
use Livewire\WithPagination;
use Livewire\Component;

class LJurusan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $nama_jurusan, $id_jurusan;
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
            'nama_jurusan' => $this->nama_jurusan,
        ]);

        return redirect()->route('jurusan-O')->with('berhasil', 'Data Jurusan Berhasil Ditambahkan');
        $this->clear();
    }

    public function editjurusan($id)
    {
        $daftarjurusan = Jurusan::findOrFail($id);

        $this->id_jurusan = $daftarjurusan->id_jurusan;
        $this->nama_jurusan = $daftarjurusan->nama_jurusan;
    }

    public function updatejurusan()
    {
        $jurusan = Jurusan::findOrFail($this->id_jurusan);
        $jurusan->update([
            'nama_jurusan' => $this->nama_jurusan,
        ]);

        return redirect()->route('jurusan-O')->with('berhasil', 'Data Jurusan Berhasil Diubah');
    }

    public function hapusjurusan($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();

        return redirect()->route('jurusan-O')->with('berhasil', 'Data Jurusan Berhasil Dihapus');
    }

    public function clear()
    {
        $this->nama_jurusan;
    }

    protected function rules()
    {
        return [
            'nama_jurusan' => 'required',
        ];
    }
}
