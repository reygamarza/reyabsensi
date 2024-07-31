<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Kelas;
use App\Models\Wali_Kelas;
use App\Models\Siswa;
use App\Models\User;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('operator.operator', [
            'title' => 'Koordinat dan Waktu'
        ]);
    }

    public function walikelasO()
    {
        return view('operator.walikelasO', [
            'title' => 'Wali Kelas'
        ]);
    }

    public function kesiswaanO()
    {
        return view('operator.kesiswaanO', [
            'title' => 'Kesiswaan'
        ]);
    }

    public function kelasO()
    {
        return view('operator.kelasO', [
            'title' => 'Kelas'
        ]);
    }

    public function siswaO($id_kelas)
    {
        $kelas = Kelas::with('jurusan')->findOrFail($id_kelas);

        return view('operator.siswaO', [
            'title' => 'Siswa',
            'id_kelas' => $id_kelas,
            'kelas' => $kelas
        ]);
    }

    public function jurusanO()
    {
        return view('operator.jurusanO', [
            'title' => 'Jurusan'
        ]);
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

    public function tambahwaliO(Request $request)
    {
        // $user = User::create([
        //     'email' => $request->input('email'),
        //     'password' => Hash::make($request->input('password')),
        //     'nama' => $request->input('nama'),
        //     'role' => 'wali',
        // ]);

        // Wali_Kelas::create([
        //     'nuptk' => $request->input('nuptk'),
        //     'jenis_kelamin' => $request->input('jenis_kelamin'),
        //     'nip' => $request->input('nip'),
        //     'id_user' => $user->id,
        // ]);

        // return redirect()->back()->with('berhasil', 'Data Wali Kelas Berhasil Ditambahkan');
    }

    public function updatewaliO(Request $request, $nuptk)
    {
        // $user->update([
        //     'email' => $request->input('email'),
        //     'name' => $request->input('nama'),
        //     'password' => $request->filled('password') ? Hash::make($request->input('password')) : $user->password,
        // ]);

        // $waliKelas->update([
        //     'nama' => $request->input('nama'),
        //     'jenis_kelamin' => $request->input('jenis_kelamin'),
        //     'nip' => $request->input('nip'),
        // ]);
        // return redirect()->route('list-siswa-AD', ['id_kelas' => $id_kelas])->with('berhasil', 'Data Siswa Berhasil Diubah');
    }
}
