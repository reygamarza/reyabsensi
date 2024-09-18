<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Wali_Siswa;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Walisiswa extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $nama, $email, $password, $id, $nik, $jenis_kelamin, $nik_lama, $id_user;
    public $searchwalisiswa = '';

    public function render()
    {
        return view('livewire.walisiswa', [
            'daftarwalisiswa' => $this->getWalisiswa()
        ]);
    }

    protected function getWaliSiswa()
    {
        return Wali_Siswa::with('user')
            ->when($this->searchwalisiswa, function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('nama', 'like', '%' . $this->searchwalisiswa . '%')
                    ->orWhere('email', 'like', '%' . $this->searchwalisiswa . '%');
                });
            })
        ->paginate(10);
    }

    public function tambahwalisiswa()
    {
        $this->validate($this->rules());

        $user = User::create([
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'nama' => $this->nama,
            'role' => 'walis',
        ]);

        Wali_Siswa::create([
            'nik' => $this->nik,
            'jenis_kelamin' => $this->jenis_kelamin,
            'id_user' => $user->id,
        ]);

        return redirect()->route('wali-siswa-O')->with('berhasil', 'Data Wali Siswa Berhasil Ditambahkan');
        $this->clear();
    }

    public function clear()
    {
        $this->nik = $this->nama = $this->jenis_kelamin = $this->email = $this->password = '';
    }

    public function editwalisiswa($id)
    {
        $daftarwalisiswa = Wali_Siswa::with('user')->findOrFail($id);

        $this->nik = $daftarwalisiswa->nik;
        $this->nik_lama = $daftarwalisiswa->nik;
        $this->jenis_kelamin = $daftarwalisiswa->jenis_kelamin;
        $this->email = $daftarwalisiswa->user->email;
        $this->nama = $daftarwalisiswa->user->nama;
        $this->id_user = $daftarwalisiswa->user->id;
    }

    public function updatewalisiswa()
    {
        $this->validate($this->rules());

        $user = User::findOrFail($this->id_user);
        $user->update([
            'email' => $this->email,
            'nama' => $this->nama,
            'password' => Hash::make($this->password),
        ]);

        Wali_Siswa::where('nik', $this->nik_lama)->update([
            'nik' => $this->nik,
            'jenis_kelamin' => $this->jenis_kelamin,
        ]);

        return redirect()->route('wali-siswa-O')->with('berhasil', 'Data Wali Siswa Berhasil Diubah');
    }

    public function hapuswalisiswa($id)
    {
        $walisiswa = Wali_Siswa::with('user')->findOrFail($id);
        $walisiswa->delete();
        $walisiswa->user->delete();

        return redirect()->route('wali-kelas-O')->with('berhasil', 'Data Wali Kelas Berhasil Dihapus');
    }

    protected function rules()
    {
        return [
            'nik' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required|in:laki laki,perempuan',
            'email' => 'required|email',
        ];
    }
}
