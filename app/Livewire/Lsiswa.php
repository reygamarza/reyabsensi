<?php

namespace App\Livewire;

use App\Imports\SiswaImport;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Wali_Siswa;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Lsiswa extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $email, $password, $nama, $nis, $jenis_kelamin, $nisn, $id_kelas, $id_user, $nis_lama, $nik_ayah, $nik_ibu, $nik_wali;
    public $file;
    public $searchsiswa = '';

    public function mount($id_kelas)
    {
        $this->id_kelas = $id_kelas;
    }

    public function render()
    {
        return view('livewire.lsiswa', [
            'daftarsiswa' => $this->getSiswa(),
            'daftarkelas' => Kelas::with('jurusan')->get(),
            'daftarortu' => Wali_Siswa::with('user')->get()
        ]);
    }

    protected function getSiswa()
    {
        return Siswa::with('user', 'kelas.jurusan')
            ->where('id_kelas', $this->id_kelas)
            ->when($this->searchsiswa, function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('nama', 'like', '%' . $this->searchsiswa . '%')
                        ->orWhere('email', 'like', '%' . $this->searchsiswa . '%');
                });
            })
            ->paginate(10);
    }

    public function tambahsiswa()
    {
        $this->validate($this->rules());

        $user = User::create([
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'nama' => $this->nama,
            'role' => 'siswa',
        ]);

        Siswa::create([
            'nis' => $this->nis,
            'jenis_kelamin' => $this->jenis_kelamin,
            'nisn' => $this->nisn,
            'id_user' => $user->id,
            'id_kelas' => $this->id_kelas,
            'nik_ayah' => empty($this->nik_ayah) ? null : $this->nik_ayah,
            'nik_ibu' => empty($this->nik_ibu) ? null : $this->nik_ibu,
            'nik_wali' => empty($this->nik_wali) ? null : $this->nik_wali,
        ]);

        return redirect()->route('siswa-O', ['id_kelas' => $this->id_kelas])->with('berhasil', 'Data Siswa Berhasil Ditambahkan');
        $this->clear();
    }

    public function editsiswa($nis)
    {
        $daftarsiswa = Siswa::with('user')->where('nis', $nis)->firstOrFail();

        $this->nis = $daftarsiswa->nis;
        $this->nis_lama = $daftarsiswa->nis;
        $this->jenis_kelamin = $daftarsiswa->jenis_kelamin;
        $this->nisn = $daftarsiswa->nisn;
        $this->nik_ayah = $daftarsiswa->nik_ayah;
        $this->nik_ibu = $daftarsiswa->nik_ibu;
        $this->nik_wali = $daftarsiswa->nik_wali;
        $this->email = $daftarsiswa->user->email;
        $this->nama = $daftarsiswa->user->nama;
        $this->id_user = $daftarsiswa->user->id;
    }

    public function updatesiswa()
    {
        $this->validate($this->rules());

        $user = User::findOrFail($this->id_user);
        $user->update([
            'email' => $this->email,
            'nama' => $this->nama,
            'password' => Hash::make($this->password),

        ]);

        Siswa::where('nis', $this->nis_lama)->update([
            'nis' => $this->nis,
            'jenis_kelamin' => $this->jenis_kelamin,
            'nisn' => $this->nisn,
            'id_kelas' => $this->id_kelas,
            'nik_ayah' => empty($this->nik_ayah) ? null : $this->nik_ayah,
            'nik_ibu' => empty($this->nik_ibu) ? null : $this->nik_ibu,
            'nik_wali' => empty($this->nik_wali) ? null : $this->nik_wali,
        ]);

        return redirect()->route('siswa-O', ['id_kelas' => $this->id_kelas])->with('berhasil', 'Data Siswa Berhasil Diubah');
    }

    public function hapussiswa($nis)
    {
        $siswa = Siswa::with('user')->where('nis', $nis)->firstOrFail();
        $siswa->delete();
        $siswa->user->delete();

        return redirect()->route('siswa-O', ['id_kelas' => $this->id_kelas])->with('berhasil', 'Data Siswa Berhasil Dihapus');
    }

    public function import()
    {
        $this->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new SiswaImport($this->id_kelas), $this->file);

        return redirect()->route('siswa-O', ['id_kelas' => $this->id_kelas])->with('berhasil', 'Data Siswa Berhasil Diimport');
    }

    public function clear()
    {
        $this->nis = $this->nama = $this->jenis_kelamin = $this->nisn = $this->nik_ayah = $this->nik_ibu = $this->nik_wali = $this->email = $this->password = '';
    }

    protected function rules()
    {
        return [
            'nis' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required|in:laki laki,perempuan',
            'nisn' => 'required',
            'nik_ayah' => 'nullable',
            'nik_ibu' => 'nullable',
            'nik_wali' => 'nullable',
            'email' => 'required|email',
        ];
    }
}
