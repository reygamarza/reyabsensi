<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Wali_Kelas;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Lkesiswaan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $email, $password, $nama, $nip, $jenis_kelamin, $nuptk, $nip_lama, $id_user;
    public $searchkesiswaan = '';

    public function render()
    {
        return view('livewire.lkesiswaan', [
            'daftarkesiswaan' => $this->getKesiswaan()
        ]);
    }

    protected function getKesiswaan()
    {
        return Wali_Kelas::with('user')
        ->whereHas('user', function ($q) {
            $q->where('role', 'kesiswaan');
        })
        ->when($this->searchkesiswaan, function ($query) {
            $query->whereHas('user', function ($q) {
                $q->where(function ($q2) {
                    $q2->where('nama', 'like', '%' . $this->searchkesiswaan . '%')
                        ->orWhere('email', 'like', '%' . $this->searchkesiswaan . '%');
                });
            });
        })
        ->paginate(10);
    }

    public function tambahkesiswaan()
    {
        $this->validate($this->rules());

        $user = User::create([
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'nama' => $this->nama,
            'role' => 'kesiswaan',
        ]);

        Wali_Kelas::create([
            'nip' => $this->nip,
            'jenis_kelamin' => $this->jenis_kelamin,
            'nuptk' => $this->nuptk,
            'id_user' => $user->id,
        ]);

        return redirect()->route('kesiswaan-O')->with('berhasil', 'Data Kesiswaan Berhasil Ditambahkan');
        $this->clear();
    }

    public function editkesiswaan($id)
    {
        $daftarkesiswaan = Wali_Kelas::with('user')->findOrFail($id);

        $this->nuptk = $daftarkesiswaan->nuptk;
        $this->nip_lama = $daftarkesiswaan->nip;
        $this->jenis_kelamin = $daftarkesiswaan->jenis_kelamin;
        $this->nip = $daftarkesiswaan->nip;
        $this->email = $daftarkesiswaan->user->email;
        $this->nama = $daftarkesiswaan->user->nama;
        $this->id_user = $daftarkesiswaan->user->id;
    }

    public function updatekesiswaan()
    {
        $this->validate($this->rules());

        $user = User::findOrFail($this->id_user);
        $user->update([
            'email' => $this->email,
            'nama' => $this->nama,
            'password' => Hash::make($this->password),
        ]);

        Wali_Kelas::where('nip', $this->nip_lama)->update([
            'nip' => $this->nip,
            'jenis_kelamin' => $this->jenis_kelamin,
            'nuptk' => $this->nuptk,
        ]);

        return redirect()->route('kesiswaan-O')->with('berhasil', 'Data Kesiswaan Berhasil Diubah');
    }

    public function hapuskesiswaan($id)
    {
        $kesiswaan = Wali_Kelas::with('user')->findOrFail($id);
        $kesiswaan->delete();
        $kesiswaan->user->delete();

        return redirect()->route('kesiswaan-O')->with('berhasil', 'Data Kesiswaan Berhasil Dihapus');
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
