<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Lkesiswaan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $nama, $email, $password, $id;
    public $searchkesiswaan = '';

    public function render()
    {
        return view('livewire.lkesiswaan', [
            'daftarkesiswaan' => $this->getKesiswaan()
        ]);
    }

    protected function getKesiswaan()
    {
        return User::where('role', 'kesiswaan')
        ->when($this->searchkesiswaan, function ($query) {
            $query->where(function ($query) {
                $query->where('nama', 'like', '%' . $this->searchkesiswaan . '%')
                      ->orWhere('email', 'like', '%' . $this->searchkesiswaan . '%');
            });
        })
        ->paginate(7);
    }

    public function tambahkesiswaan()
    {
        $this->validate($this->rules());

        User::create([
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'nama' => $this->nama,
            'role' => 'kesiswaan',
        ]);

        return redirect()->route('kesiswaan-O')->with('berhasil', 'Data Kesiswaan Berhasil Ditambahkan');
        $this->clear();
    }

    public function editkesiswaan($id)
    {
        $daftarkesiswaan = User::findOrFail($id);

        $this->nama = $daftarkesiswaan->nama;
        $this->email = $daftarkesiswaan->email;
        $this->id = $daftarkesiswaan->id;
    }

    public function updatekesiswaan()
    {
        $this->validate($this->rules());

        $daftarkesiswaan = User::findOrFail($this->id);
        $daftarkesiswaan->update([
            'email' => $this->email,
            'nama' => $this->nama,
            'password' => Hash::make($this->password),
        ]);

        return redirect()->route('kesiswaan-O')->with('berhasil', 'Data Kesiswaan Berhasil Diubah');
    }

    public function hapuskesiswaan($id)
    {
        $kesiswaan = User::findOrFail($id);
        $kesiswaan->delete();

        return redirect()->route('kesiswaan-O')->with('berhasil', 'Data Kesiswaan Berhasil Dihapus');
    }

    public function clear()
    {
        $this->nama = $this->email = $this->password = '';
    }

    protected function rules()
    {
        return [
            'nama' => 'required',
            'email' => 'required',
        ];
    }
}
