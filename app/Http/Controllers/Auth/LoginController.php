<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Siswa;
use App\Models\TenagaKependidikan;
use App\Models\WaliSiswa;

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

    protected $redirectTo = '/home';

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

        // Daftar model dan kolom yang digunakan untuk login
        $loginMethods = [
            ['model' => Siswa::class, 'column' => 'nis', 'role' => 'siswa'],
            ['model' => TenagaKependidikan::class, 'column' => 'nip', 'role' => 'kesiswaan'],
            ['model' => TenagaKependidikan::class, 'column' => 'nip', 'role' => 'waliKelas'],
            ['model' => WaliSiswa::class, 'column' => 'nik', 'role' => 'waliSiswa'],
        ];

        // Cek login berdasarkan daftar metode di atas
        foreach ($loginMethods as $method) {
            $model = $method['model']::where($method['column'], $request->identifier)->first();
            if ($model) {
                $user = User::find($model->id_user);
                if ($user && Hash::check($request->password, $user->password)) {
                    Auth::login($user);
                    return redirect()->intended($this->redirectTo($method['role']));
                }
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
        ])->withInput();
    }

    /**
     * Redirect user after login based on role.
     *
     * @param  string  $role
     * @return string
     */
    protected function redirectTo($role)
    {
        return match ($role) {
            'operator' => '/operator',
            'siswa' => '/siswa',
            'kesiswaan' => '/kesiswaan',
            'waliKelas' => '/wali-kelas',
            'waliSiswa' => '/wali-siswa',
            default => '/home',
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
