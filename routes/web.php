<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (auth()->check()) {
        $role = auth()->user()->role;

        if ($role == 'kesiswaan') {
            return redirect('kesiswaan');
        } elseif ($role == 'siswa') {
            return redirect('siswa');
        } elseif ($role == 'wali') {
            return redirect('wali');
        } elseif ($role == 'operator') {
            return redirect('operator');
        } elseif ($role == 'walis') {
            return redirect('walis');
        } else {
            return redirect('/home');
        }
    }
    return view('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'Kesiswaan:kesiswaan'])->group(function () {

    // Dashboard
    Route::resource('kesiswaan', App\Http\Controllers\KesiswaanController::class);

    // Daftar Kelas
    Route::get('list-kelas', [App\Http\Controllers\KesiswaanController::class, 'listkelas'])->name('list-kelas');

    // Daftar Kelas -> Daftar Siswa
    Route::post('/tambah-siswa', [App\Http\Controllers\KesiswaanController::class, 'tambahsiswa'])->name('tambah-siswa'); // create
    Route::get('list-kelas/{id_kelas}/siswa', [App\Http\Controllers\KesiswaanController::class, 'listsiswaA'])->name('list-siswa-AD'); // Read
    Route::get('/edit-siswa/{nis}', [App\Http\Controllers\KesiswaanController::class, 'editsiswa'])->name('edit-siswa'); // form update
    Route::put('/update-siswa/{nis}', [App\Http\Controllers\KesiswaanController::class, 'updatesiswa'])->name('update-siswa'); // update
    Route::delete('/hapus-siswa/{nis}', [App\Http\Controllers\KesiswaanController::class, 'hapussiswa'])->name('hapus-siswa'); // delete

    // Laporan Absensi
    Route::get('laporan-A', [App\Http\Controllers\KesiswaanController::class, 'laporan'])->name('laporan-A');

    // Daftar Wali Kelas
    Route::get('daftar-wali', [App\Http\Controllers\KesiswaanController::class, 'daftarwali'])->name('daftar-wali');

    // Daftar Jurusan
    Route::get('list-jurusan', [App\Http\Controllers\KesiswaanController::class, 'listjurusan'])->name('list-jurusan');

});


Route::middleware(['auth', 'Siswa:siswa'])->group(function () {
    Route::resource('siswa', App\Http\Controllers\siswaController::class);
    Route::get('absen-masuk', [App\Http\Controllers\SiswaController::class, 'absen'])->name('absen-masuk');
    Route::post('/absen/store', [App\Http\Controllers\SiswaController::class, 'ambilabsen'])->name('ambil-absen');
    Route::post('upload-file', [App\Http\Controllers\SiswaController::class, 'uploadfile'])->name('upload-file');
    Route::get('rekap', [App\Http\Controllers\SiswaController::class, 'Rekap'])->name('rekap');
    Route::get('profile', [App\Http\Controllers\SiswaController::class, 'profile'])->name('profile');
    Route::post('edit-profile', [App\Http\Controllers\SiswaController::class, 'editprofile'])->name('edit-profile');
});

Route::middleware(['auth', 'WaliS:walis'])->group(function () {
    Route::resource('walis', App\Http\Controllers\WaliSiswaController::class);
    Route::get('profile-WS', [App\Http\Controllers\WaliSiswaController::class, 'profile'])->name('profile-WS');
    Route::post('edit-profile-WS', [App\Http\Controllers\WaliSiswaController::class, 'editprofile'])->name('edit-profile-WS');
});


Route::middleware(['auth', 'Wali:wali'])->group(function () {
    Route::resource('wali', App\Http\Controllers\WaliController::class);
    Route::get('list-siswa', [App\Http\Controllers\WaliController::class, 'listsiswa'])->name('list-siswa');
});

Route::middleware(['auth', 'Operator:operator'])->group(function () {
    Route::resource('operator', App\Http\Controllers\OperatorController::class);
    Route::get('wali-kelas-O', [App\Http\Controllers\OperatorController::class, 'walikelasO'])->name('wali-kelas-O');
    Route::get('wali-siswa-O', [App\Http\Controllers\OperatorController::class, 'walisiswaO'])->name('wali-siswa-O');
    Route::get('kesiswaan-O', [App\Http\Controllers\OperatorController::class, 'kesiswaanO'])->name('kesiswaan-O');
    Route::get('kelas-O', [App\Http\Controllers\OperatorController::class, 'kelasO'])->name('kelas-O');
    Route::get('siswa-O/{id_kelas}', [App\Http\Controllers\OperatorController::class, 'siswaO'])->name('siswa-O');
    Route::get('jurusan-O', [App\Http\Controllers\OperatorController::class, 'jurusanO'])->name('jurusan-O');
    Route::get('profile-O', [App\Http\Controllers\OperatorController::class, 'profileO'])->name('profile-O');
    Route::post('edit-profile-O', [App\Http\Controllers\OperatorController::class, 'editprofileO'])->name('edit-profile-O');

    // Route::post('/tambah-wali-O', [App\Http\Controllers\OperatorController::class, 'tambahwaliO'])->name('tambah-wali-O');

});
