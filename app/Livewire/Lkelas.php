<?php

namespace App\Livewire;

use App\Imports\KelasImport;
use App\Models\Kelas;
use App\Models\Wali_Kelas;
use App\Models\Jurusan;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;


class Lkelas extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $id_kelas, $id_jurusan, $nuptk, $nomor_kelas, $tingkat;
    public $import_file;
    public $searchkelas = '';

    public function render()
    {
        return view('livewire.lkelas', [
            'daftarkelas' => $this->getKelas(),
            'daftarjurusan' => Jurusan::all(),
            'daftarwali' => Wali_kelas::with('user')->get(),
        ]);
    }

    protected function getKelas()
    {
        return Kelas::with('jurusan', 'waliKelas.user')
            ->when($this->searchkelas, function ($query) {
                $query->whereHas('jurusan', function ($q) {
                    $q->where('id_jurusan', 'like', '%' . $this->searchkelas . '%');
                })
                    ->orWhere('nomor_kelas', 'like', '%' . $this->searchkelas . '%')
                    ->orWhere('tingkat', 'like', '%' . $this->searchkelas . '%');
            })
            ->paginate(10);
    }

    public function tambahkelas()
    {
        $this->validate($this->rules());

        Kelas::create([
            'id_jurusan' => $this->id_jurusan,
            'nuptk' => $this->nuptk,
            'nomor_kelas' => $this->nomor_kelas,
            'tingkat' => $this->tingkat,
        ]);

        return redirect()->route('kelas-O')->with('berhasil', 'Data Kelas Berhasil Ditambahkan');
        $this->clear();
    }

    public function editwali($id_kelas)
    {
        $daftarkelas = Kelas::with('jurusan', 'waliKelas.user')->findOrFail($id_kelas);

        $this->id_kelas = $daftarkelas->id_kelas;
        $this->nuptk = $daftarkelas->nuptk;
        $this->id_jurusan = $daftarkelas->id_jurusan;
        $this->tingkat = $daftarkelas->tingkat;
        $this->nomor_kelas = $daftarkelas->nomor_kelas;
    }

    public function updatekelas()
    {
        $this->validate($this->rules());

        $kelas = Kelas::findOrFail($this->id_kelas);
        $kelas->update([
            'nuptk' => $this->nuptk,
            'id_jurusan' => $this->id_jurusan,
            'tingkat' => $this->tingkat,
            'nomor_kelas' => $this->nomor_kelas,
        ]);

        return redirect()->route('kelas-O')->with('berhasil', 'Data Kelas Berhasil Diubah');
    }

    public function hapuskelas($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('kelas-O')->with('berhasil', 'Data Kelas Berhasil Dihapus');
    }

    // public function importkelas()
    // {
    //     $this->validate([
    //         'import_file' => 'required|file|mimes:xls,xlsx',
    //     ]);

    //     try {
    //         Excel::import(new KelasImport, $this->import_file->getRealPath());
    //         return redirect()->route('kelas-O')->with('berhasil', 'Data Kelas Berhasil Diimport');
    //     } catch (\Exception $e) {
    //         return redirect()->route('kelas-O')->with('gagal', 'Terjadi Kesalahan Saat Mengimport Data');
    //     }
    // }

    public function clear()
    {
        $this->id_jurusan = $this->nomor_kelas = $this->tingkat = $this->nuptk = '';
    }

    protected function rules()
    {
        return [
            'id_jurusan' => 'required',
            'nuptk' => 'required',
            'nomor_kelas' => 'required',
            'tingkat' => 'required',
        ];
    }

    public function redirectSiswa($id_kelas)
    {
        return redirect()->route('siswa-O', ['id_kelas' => $id_kelas]);
    }
}
