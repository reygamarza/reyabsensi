<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\User;
use App\Models\Wali_Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class WaliSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Auth::user()->ortu->siswa;
        // dd($siswa);
        $dataAbsensiAnak = [];
        foreach ($siswa as $s) {
            $nis = $s->nis;
            $late2 = Absensi::where('nis', $nis)->whereMonth('date', date('m', strtotime('first day of previous month')))->sum('menit_keterlambatan');
            $late = Absensi::where('nis', $nis)->whereMonth('date', date('m'))->sum('menit_keterlambatan');

            // Data absen bulan ini
            $dataBulanIni = Absensi::whereYear('date', date('Y'))
                ->where('nis', $nis)
                ->whereMonth('date', date('m'))
                ->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->pluck('total', 'status')
                ->toArray();

            // Data absen bulan sebelumnya
            $dataBulanSebelumnya = Absensi::whereYear('date', date('Y'))
                ->where('nis', $nis)
                ->whereMonth('date', date('m', strtotime('first day of previous month')))
                ->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->pluck('total', 'status')
                ->toArray();

            // Gabungkan 'Sakit' dan 'Izin' menjadi satu kategori
            $dataBulanIni['Sakit/Izin'] = ($dataBulanIni['Sakit'] ?? 0) + ($dataBulanIni['Izin'] ?? 0);
            unset($dataBulanIni['Sakit'], $dataBulanIni['Izin']);

            $dataBulanSebelumnya['Sakit/Izin'] = ($dataBulanSebelumnya['Sakit'] ?? 0) + ($dataBulanSebelumnya['Izin'] ?? 0);
            unset($dataBulanSebelumnya['Sakit'], $dataBulanSebelumnya['Izin']);

            // Status yang tersisa
            $statuses = ['Hadir', 'Sakit/Izin', 'Alfa', 'Terlambat', 'TAP'];
            foreach ($statuses as $status) {
                if (!array_key_exists($status, $dataBulanIni)) {
                    $dataBulanIni[$status] = 0;
                }
                if (!array_key_exists($status, $dataBulanSebelumnya)) {
                    $dataBulanSebelumnya[$status] = 0;
                }
            }

            // Menghitung total absen dan persentase hadir bulan ini
            $totalAbsenBulanIni = array_sum($dataBulanIni);
            $persentaseHadirBulanIni = $totalAbsenBulanIni > 0 ? round(($dataBulanIni['Hadir'] / $totalAbsenBulanIni) * 100) : 0;

            // Menghitung total absen dan persentase hadir bulan sebelumnya
            $totalAbsenBulanSebelumnya = array_sum($dataBulanSebelumnya);
            $persentaseHadirBulanSebelumnya = $totalAbsenBulanSebelumnya > 0 ? round(($dataBulanSebelumnya['Hadir'] / $totalAbsenBulanSebelumnya) * 100) : 0;

            // Menyimpan data absensi per siswa
            $dataAbsensiAnak[] = [
                'nama' => $s->user->nama,
                'nis' => $nis,
                'BulanIni' => [
                    'Hadir' => $dataBulanIni['Hadir'],
                    'Sakit/Izin' => $dataBulanIni['Sakit/Izin'],
                    'Alfa' => $dataBulanIni['Alfa'],
                    'Terlambat' => $dataBulanIni['Terlambat'],
                    'TAP' => $dataBulanIni['TAP']
                ],
                'BulanLalu' => [
                    'Hadir' => $dataBulanSebelumnya['Hadir'],
                    'Sakit/Izin' => $dataBulanSebelumnya['Sakit/Izin'],
                    'Alfa' => $dataBulanSebelumnya['Alfa'],
                    'Terlambat' => $dataBulanSebelumnya['Terlambat'],
                    'TAP' => $dataBulanSebelumnya['TAP']
                ],
                'PersentaseBulanIni' => $persentaseHadirBulanIni,
                'PersentaseBulanLalu' => $persentaseHadirBulanSebelumnya,
                'late' => $late,
                'late2' => $late2,
            ];
        }

        return view('walis.walis', compact('dataAbsensiAnak'));
    }

    public function profile()
    {
        $user = Auth::user();
        $nik = $user->ortu->nik;

        $ortu = Wali_Siswa::where('nik', $nik)->with('user')->first();
        return view('walis.profile', compact('ortu'));
    }

    public function editprofile(Request $request)
    {
        $user = Auth::user();
        $id_user = $user->id;
        $nik = $user->ortu->nik;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $extension = $foto->getClientOriginalExtension();
            $folderPath = 'public/uploads/foto_profil/';
            $fileName = $nik . '.' . $extension;
            $file = $folderPath . $fileName;

            Storage::put($file, file_get_contents($foto));
        } else {
            $fileName = $user->foto;
        }

        $password = $request->password ? Hash::make($request->password) : $user->password;

        $data = [
            'email' => $request->email,
            'password' => $password,
            'foto' => $fileName,
        ];

        $simpan = User::where('id', $id_user)->update($data);

        if ($simpan) {
            return redirect()->route('profile-WS')->with('berhasil', 'Profil Anda Berhasil Diubah.');
        } else {
            return redirect()->route('profile-WS')->with('gagal', 'Profil Gagal Diubah.');
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
