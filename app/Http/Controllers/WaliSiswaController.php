<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Waktu_Absen;
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
        $walisiswa = Wali_Siswa::where('id_user', Auth::user()->id)->with('user')->first();

        if ($walisiswa->jenis_kelamin == "laki laki") {
            $siswa = Siswa::with('user', 'kelas')->where('nik_ayah', '=', $walisiswa->nik)->orWhere('nik_wali', '=', $walisiswa->nik)->get();
        } elseif ($walisiswa->jenis_kelamin == "perempuan") {
            $siswa = Siswa::with('user', 'kelas')->where('nik_ibu', '=', $walisiswa->nik)->orWhere('nik_wali', '=', $walisiswa->nik)->get();
        }

        $dataAbsensiAnak = [];
        foreach ($siswa as $s) {
            $tahunIni = Absensi::where('nis', $s->nis)->whereYear('date', date('Y'))->get();
            $ini = Absensi::whereYear('date', date('Y'))->where('nis', $s->nis)->whereMonth('date', date('m'))->get();
            $lalu = Absensi::whereYear('date', date('Y'))->where('nis', $s->nis)->whereMonth('date', date('m', strtotime('first day of previous month')))->get();

            $jumlah = [
                'tahunIni' => $tahunIni->count(),
                'hadirTahunIni' => $tahunIni->where('status', "Hadir")->count(),
                'terlambatTahunIni' => $tahunIni->where('status', "Terlambat")->count(),
                'tapTahunIni' => $tahunIni->where('status', "TAP")->count(),
                'alfaTahunIni' => $tahunIni->where('status', "Alfa")->count(),
                'sakitIzinTahunIni' => $tahunIni->whereIn('status', ["Sakit", "Izin"])->count(),
                'menitTerlambatTahunIni' => $tahunIni->sum('menit_keterlambatan'),

                'ini' => $ini->count(),
                'hadirIni' => $ini->where('status', "Hadir")->count(),
                'terlambatIni' => $ini->where('status', "Terlambat")->count(),
                'tapIni' => $ini->where('status', "TAP")->count(),
                'alfaIni' => $ini->where('status', "Alfa")->count(),
                'sakitIzinIni' => $ini->whereIn('status', ["Sakit", "Izin"])->count(),
                'menitTerlambatBulanIni' => $ini->sum('menit_keterlambatan'),

                'lalu' => $lalu->count(),
                'hadirLalu' => $lalu->where('status', "Hadir")->count(),
                'terlambatLalu' => $lalu->where('status', "Terlambat")->count(),
                'tapLalu' => $lalu->where('status', "TAP")->count(),
                'alfaLalu' => $lalu->where('status', "Alfa")->count(),
                'sakitIzinLalu' => $lalu->whereIn('status', ["Sakit", "Izin"])->count(),
                'menitTerlambatBulanLalu' => $lalu->sum('menit_keterlambatan'),
            ];

            $persentase = [
                'PersentaseBulanIni' => $jumlah['hadirIni'] > 0 ? round(($jumlah['hadirIni'] / $jumlah['ini']) * 100, 1) : 0,
                'PersentaseBulanLalu' => $jumlah['hadirLalu'] > 0 ? round(($jumlah['hadirLalu'] / $jumlah['lalu']) * 100, 1) : 0,
                'PersentaseTahunIni' => $jumlah['hadirTahunIni'] > 0 ? round(($jumlah['hadirTahunIni'] / $jumlah['tahunIni']) * 100, 1) : 0,
            ];

            $dataAbsensiAnak[] = [
                'nis' => $s->nis,
                'nama' => strtolower($s->user->nama),
                'BulanIni' => [
                    'Hadir' => $jumlah['hadirIni'],
                    'Terlambat' => $jumlah['terlambatIni'],
                    'Sakit/Izin' => $jumlah['sakitIzinIni'],
                    'Alfa' => $jumlah['alfaIni'],
                    'TAP' => $jumlah['tapIni'],
                    'late' => $jumlah['menitTerlambatBulanIni'],
                ],
                'BulanLalu' => [
                    'Hadir' => $jumlah['hadirLalu'],
                    'Terlambat' => $jumlah['terlambatLalu'],
                    'Sakit/Izin' => $jumlah['sakitIzinLalu'],
                    'Alfa' => $jumlah['alfaLalu'],
                    'TAP' => $jumlah['tapLalu'],
                    'late' => $jumlah['menitTerlambatBulanLalu'],
                ],
                'TahunIni' => [
                    'Hadir' => $jumlah['hadirTahunIni'],
                    'Terlambat' => $jumlah['terlambatTahunIni'],
                    'Sakit/Izin' => $jumlah['sakitIzinTahunIni'],
                    'Alfa' => $jumlah['alfaTahunIni'],
                    'TAP' => $jumlah['tapTahunIni'],
                    'late' => $jumlah['menitTerlambatTahunIni'],
                ],
                'PersentaseBulanIni' => $persentase['PersentaseBulanIni'],
                'PersentaseBulanLalu' => $persentase['PersentaseBulanLalu'],
                'PersentaseTahunIni' => $persentase['PersentaseTahunIni'],
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
