<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Wali_Kelas;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Walikelas extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $email, $password, $nama, $nuptk, $jenis_kelamin, $nip, $nuptk_lama, $id_user;
    public $searchwali = '';

    public function render()
    {
        return view('livewire.walikelas', [
            'daftarwali' => $this->getWaliKelas()
        ]);
    }

    protected function getWaliKelas()
    {
        return Wali_Kelas::with('user')
            ->when($this->searchwali, function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('nama', 'like', '%' . $this->searchwali . '%')
                    ->orWhere('email', 'like', '%' . $this->searchwali . '%');
                });
            })
        ->paginate(10);
    }

    public function tambahwali()
    {
        $this->validate($this->rules());

        $user = User::create([
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'nama' => $this->nama,
            'role' => 'wali',
        ]);

        Wali_Kelas::create([
            'nuptk' => $this->nuptk,
            'jenis_kelamin' => $this->jenis_kelamin,
            'nip' => $this->nip,
            'id_user' => $user->id,
        ]);

        return redirect()->route('wali-kelas-O')->with('berhasil', 'Data Wali Kelas Berhasil Ditambahkan');
        $this->clear();
    }

    public function editwali($id)
    {
        $daftarwali = Wali_Kelas::with('user')->findOrFail($id);

        $this->nuptk = $daftarwali->nuptk;
        $this->nuptk_lama = $daftarwali->nuptk;
        $this->jenis_kelamin = $daftarwali->jenis_kelamin;
        $this->nip = $daftarwali->nip;
        $this->email = $daftarwali->user->email;
        $this->nama = $daftarwali->user->nama;
        $this->id_user = $daftarwali->user->id;
    }

    public function updatewali()
    {
        $this->validate($this->rules());

        $user = User::findOrFail($this->id_user);
        $user->update([
            'email' => $this->email,
            'nama' => $this->nama,
            'password' => Hash::make($this->password),
        ]);

        Wali_Kelas::where('nuptk', $this->nuptk_lama)->update([
            'nuptk' => $this->nuptk,
            'jenis_kelamin' => $this->jenis_kelamin,
            'nip' => $this->nip,
        ]);

        return redirect()->route('wali-kelas-O')->with('berhasil', 'Data Wali Kelas Berhasil Diubah');
    }

    public function hapuswali($id)
    {
        $wali = Wali_Kelas::with('user')->findOrFail($id);
        $wali->delete();
        $wali->user->delete();

        return redirect()->route('wali-kelas-O')->with('berhasil', 'Data Wali Kelas Berhasil Dihapus');
    }

    public function clear()
    {
        $this->nuptk = $this->nama = $this->jenis_kelamin = $this->nip = $this->email = $this->password = '';
    }

    protected function rules()
    {
        return [
            'nuptk' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required|in:laki laki,perempuan',
            'nip' => 'required',
            'email' => 'required|email',
        ];
    }
}
