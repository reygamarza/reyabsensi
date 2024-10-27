<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Wali_Siswa;
use App\Models\Wali_Kelas;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    protected $redirectTo = '/siswa';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'identifier' => 'required',
            'password'   => 'required',
        ]);

        // Cek login untuk Siswa berdasarkan NIS
        $siswa = Siswa::where('nis', $request->identifier)->first();
        if ($siswa) {
            $user = User::find($siswa->id_user);
            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->intended($this->redirectTo('siswa'));
            }
        }

        // Cek login untuk Wali Siswa berdasarkan NIK
        $waliSiswa = Wali_Siswa::where('nik', $request->identifier)->first();
        if ($waliSiswa) {
            $user = User::find($waliSiswa->id_user);
            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->intended($this->redirectTo('walis'));
            }
        }

        // Cek login untuk Wali Kelas berdasarkan NUPTK
        $waliKelas = Wali_Kelas::where('nip', $request->identifier)->first();
        if ($waliKelas) {
            $user = User::find($waliKelas->id_user);
            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->intended($this->redirectTo('wali'));
            }
        }

        // Cek login untuk Kesiswaan atau Operator berdasarkan Email
        $user = User::where('email', $request->identifier)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->intended($this->redirectTo($user->role));
        }

        // Jika login gagal
        return back()->withErrors([
            'identifier' => 'Data login tidak valid.',
        ]);
    }

    /**
     * Redirect user after login based on role.
     *
     * @param  string  $role
     * @return string
     */
    protected function redirectTo($role)
    {
        switch ($role) {
            case 'siswa':
                return '/siswa';
            case 'walis':
                return '/walis';
            case 'wali':
                return '/wali';
            case 'operator':
                return '/operator';
            case 'kesiswaan':
                return '/kesiswaan';
            default:
                return '/home';
        }
    }

    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/'); // Mengarahkan pengguna kembali ke halaman login
}
}

