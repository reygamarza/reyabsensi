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


Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'Kesiswaan:kesiswaan'])->group(function () {
    Route::resource('kesiswaan', App\Http\Controllers\KesiswaanController::class);
    Route::get('laporan-kelas', [App\Http\Controllers\KesiswaanController::class, 'laporankelas'])->name('kesiswaan.kelas');
    Route::get('laporan-siswa-K/{kelas_id}', [App\Http\Controllers\KesiswaanController::class, 'laporansiswa'])->name('kesiswaan.siswa');
    Route::get('laporan-detailsiswa-K/{kelas_id}/{id}', [App\Http\Controllers\KesiswaanController::class, 'laporandetailsiswa'])->name('kesiswaan.detailsiswa');
    Route::get('profile-K', [App\Http\Controllers\KesiswaanController::class, 'profileK'])->name('kesiswaan.profile');
    Route::post('editprofile-K', [App\Http\Controllers\KesiswaanController::class, 'editprofileK'])->name('kesiswaan.editprofile');
});


Route::middleware(['auth', 'Siswa:siswa'])->group(function () {
    Route::resource('siswa', App\Http\Controllers\SiswaController::class);
    Route::get('absen-masuk', [App\Http\Controllers\SiswaController::class, 'absen'])->name('absen-masuk');
    Route::post('/absen/store', [App\Http\Controllers\SiswaController::class, 'ambilabsen'])->name('ambil-absen');
    Route::post('upload-file', [App\Http\Controllers\SiswaController::class, 'uploadfile'])->name('upload-file');
    Route::get('rekap', [App\Http\Controllers\SiswaController::class, 'Rekap'])->name('rekap');
    Route::get('profile-S', [App\Http\Controllers\SiswaController::class, 'profile'])->name('profile');
    Route::post('edit-profile', [App\Http\Controllers\SiswaController::class, 'editprofile'])->name('edit-profile');
});

Route::middleware(['auth', 'WaliS:walis'])->group(function () {
    Route::resource('walis', App\Http\Controllers\WaliSiswaController::class);
    Route::get('laporan-siswa-WS', [App\Http\Controllers\WaliSiswaController::class, 'laporan'])->name('laporan-WS');
    Route::get('profile-WS', [App\Http\Controllers\WaliSiswaController::class, 'profile'])->name('profile-WS');
    Route::post('edit-profile-WS', [App\Http\Controllers\WaliSiswaController::class, 'editprofile'])->name('edit-profile-WS');
});


Route::middleware(['auth', 'Wali:wali'])->group(function () {
    Route::resource('wali', App\Http\Controllers\WaliController::class);
    Route::get('laporan-siswa', [App\Http\Controllers\WaliController::class, 'siswa'])->name('WaliKelas.siswa');
    Route::get('laporan-detailsiswa{id}', [App\Http\Controllers\WaliController::class, 'detailsiswa'])->name('WaliKelas.detailsiswa');
    Route::get('profile', [App\Http\Controllers\WaliController::class, 'profile'])->name('WaliKelas.profile');
    Route::post('edit-profile', [App\Http\Controllers\WaliController::class, 'editprofile'])->name('WaliKelas.editprofile');
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
    Route::post('edit-profile-O', [App\Http\Controllers\OperatorController::class, 'editprofileO'])->name('operator.editprofile');

    // Route::post('/tambah-wali-O', [App\Http\Controllers\OperatorController::class, 'tambahwaliO'])->name('tambah-wali-O');

});
