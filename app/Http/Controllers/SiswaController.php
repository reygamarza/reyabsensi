<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Absensi;
use App\Models\Koordinat_Sekolah;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Waktu_Absen;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $koordinatsekolah = Koordinat_Sekolah::first();
        $jam = Waktu_Absen::first();
        $hariini = date("Y-m-d");
        $user = Auth::user();
        $nis = $user->siswa->nis;
        $late2 = Absensi::where('nis', $nis)->whereMonth('date', date('m', strtotime('first day of previous month')))->sum('menit_keterlambatan');
        $late = Absensi::where('nis', $nis)->whereMonth('date', date('m'))->sum('menit_keterlambatan');
        // return $late;

        // Mencari absensi berdasarkan tanggal hari ini dan NIS siswa.
        $cekabsen = Absensi::where('date', $hariini)
            ->where('nis', $nis)
            ->first();

        $dataBulanIni = Absensi::whereYear('date', date('Y'))
            ->where('nis', $nis)
            ->whereMonth('date', date('m'))
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

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

        $totalAbsenBulanIni = array_sum($dataBulanIni);
        $persentaseHadirBulanIni = $totalAbsenBulanIni > 0 ? round(($dataBulanIni['Hadir'] / $totalAbsenBulanIni) * 100) : 0;

        // Menghitung persentase hadir bulan sebelumnya
        $totalAbsenBulanSebelumnya = array_sum($dataBulanSebelumnya);
        $persentaseHadirBulanSebelumnya = $totalAbsenBulanSebelumnya > 0 ? round(($dataBulanSebelumnya['Hadir'] / $totalAbsenBulanSebelumnya) * 100) : 0;

        $startOfWeek = date('Y-m-d', strtotime('monday this week'));
        $endOfWeek = date('Y-m-d', strtotime('sunday this week'));

        $riwayatmingguini = Absensi::whereBetween('date', [$startOfWeek, $endOfWeek])
            ->where('nis', $nis) // Sesuaikan dengan kolom NIS siswa
            ->orderBy('date', 'DESC')
            ->get();

        // Jika absensi ditemukan, ambil statusnya. Jika tidak, setel status ke 'Belum Absen'.
        $statusAbsen = $cekabsen ? $cekabsen->status : 'Belum Absen';

        // Variabel untuk mengecek apakah siswa sudah absen masuk dan pulang.
        $absenMasuk = false;
        $absenPulang = false;

        // Jika absensi ditemukan, periksa apakah foto masuk dan pulang ada.
        if ($cekabsen) {
            $absenMasuk = !empty($cekabsen->photo_in);
            $absenPulang = !empty($cekabsen->photo_out);
        }

        $statusValidasi = $statusAbsen === "Izin" || $statusAbsen === "Sakit";

        $jamskrg = date("H:i:s");
        // Jika waktu saat ini lebih dari batas jam pulang atau kurang dari jam masuk, setel validasijam ke true.
        $validasijam = strtotime($jamskrg) > strtotime($jam->batas_absen_pulang) || strtotime($jamskrg) < strtotime($jam->jam_absen);

        return view('siswa.siswa', [
            'cekabsen' => $cekabsen ? 1 : 0,
            'absenMasuk' => $absenMasuk,
            'absenPulang' => $absenPulang,
            'statusAbsen' => $statusAbsen,
            'jam' => $jam,
            'validasijam' => $validasijam,
            'koordinatsekolah' => $koordinatsekolah,
            'dataBulanIni' => $dataBulanIni,
            'dataBulanSebelumnya' => $dataBulanSebelumnya,
            'late' => $late,
            'late2' => $late2,
            'persentaseHadirBulanIni' => $persentaseHadirBulanIni,
            'persentaseHadirBulanSebelumnya' => $persentaseHadirBulanSebelumnya,
            'riwayatmingguini' => $riwayatmingguini,
            'statusValidasi' => $statusValidasi
        ]);
    }

    public function profile()
    {
        $user = Auth::user();
        $nis = $user->siswa->nis;

        $siswa = Siswa::where('nis', $nis)->with('user', 'kelas')->first();
        return view('siswa.profile', compact('siswa'));
    }

    public function editprofile(Request $request)
    {
        $user = Auth::user();
        $id_user = $user->id;
        $nis = $user->siswa->nis;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $extension = $foto->getClientOriginalExtension();
            $folderPath = 'public/uploads/foto_profil/';
            $fileName = $nis . '.' . $extension;
            $file = $folderPath . $fileName;

            Storage::put($file, file_get_contents($foto));
        } else {
            $fileName = $user->foto;
        }

        $password = $request->password ? Hash::make($request->password) : $user->password;

        $data = [
            'password' => $password,
            'foto' => $fileName,
        ];

        $simpan = User::where('id', $id_user)->update($data);

        if ($simpan) {
            return redirect()->route('profile')->with('berhasil', 'Profil Anda Berhasil Diubah.');
        } else {
            return redirect()->route('profile')->with('gagal', 'Profil Gagal Diubah.');
        }
    }



    public function Absen()
    {
        $koordinatsekolah = Koordinat_Sekolah::first();
        return view('siswa.absen', [
            'koordinatsekolah' => $koordinatsekolah
        ]);
    }

    public function Rekap(Request $request)
    {
        $user = Auth::user();
        $nis = $user->siswa->nis;

        // Tentukan rentang tanggal
        $start_date = $request->input('start_date', date('Y-m-d'));
        $end_date = $request->input('end_date', date('Y-m-d'));

        // Query untuk semua data dalam rentang tanggal
        $allAbsensi = Absensi::where('nis', $nis)
            ->whereBetween('date', [$start_date, $end_date])
            ->get();

        // Hitung statistik
        $stats = $this->filterrekap($allAbsensi);

        // Query dengan paginasi untuk tampilan tabel
        $absensi = Absensi::where('nis', $nis)
            ->whereBetween('date', [$start_date, $end_date])
            ->paginate(7)
            ->appends($request->only(['start_date', 'end_date']));

        return view('siswa.rekap', array_merge(
            compact('absensi', 'start_date', 'end_date'),
            $stats
        ));
    }

    private function filterrekap($absensi)
    {
        $jumlahHadir = $absensi->where('status', 'Hadir')->count();
        $jumlahIzin = $absensi->whereIn('status', ['Sakit', 'Izin'])->count();
        $jumlahTerlambat = $absensi->where('status', 'Terlambat')->count();
        $jumlahAlfa = $absensi->where('status', 'Alfa')->count();
        $jumlahTap = $absensi->where('status', 'TAP')->count();
        $totalKeterlambatan = $absensi->sum('menit_keterlambatan');

        $totalAbsensi = $absensi->count();
        $persentaseHadir = $totalAbsensi > 0 ? round(($jumlahHadir / $totalAbsensi) * 100) : 0;

        return compact(
            'jumlahHadir',
            'jumlahIzin',
            'jumlahTerlambat',
            'jumlahAlfa',
            'jumlahTap',
            'totalKeterlambatan',
            'persentaseHadir'
        );
    }

    // public function filterrekap(Request $request)
    // {
    //     $siswa = Auth::user()->siswa;
    //     $nis = $siswa->nis;

    //     $start = Carbon::parse($request->input('start'))->format('Y-m-d');
    //     $end = Carbon::parse($request->input('end'))->format('Y-m-d');

    //     $absensi = Absensi::where('nis', $nis)->whereBetween('date', [$start, $end])->paginate(10);

    //     return $this->calculateAbsensi($absensi);
    // }

    // private function calculateAbsensi($absen)
    // {
    //     $jumlahHadir = $absen->where('status', 'Hadir')->count();
    //     $jumlahSakit = $absen->whereIn('status', ['Sakit', 'Izin'])->count();
    //     $jumlahTerlambat = $absen->where('status', 'Terlambat')->count();
    //     $jumlahAlfa = $absen->where('status', 'Alfa')->count();
    //     $jumlahTap = $absen->where('status', 'TAP')->count();
    //     $totalKeterlambatan = $absen->sum('menit_keterlambatan'); // Asumsi ada kolom keterlambatan dalam menit

    //     $totalAbsensi = $absen->count();
    //     $persentaseHadir = $totalAbsensi > 0 ? round(($jumlahHadir / $totalAbsensi) * 100) : 0;

    //     return view('siswa.rekap', compact('absen', 'jumlahHadir', 'jumlahSakit', 'jumlahTerlambat', 'jumlahAlfa', 'jumlahTap', 'totalKeterlambatan', 'persentaseHadir'));
    // }

    public function uploadfile(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'photo_in' => 'nullable|mimes:png,jpg,jpeg,pdf', // Field boleh kosong jika menggunakan webcam
            'photo_webcam' => 'nullable|string', // Field untuk gambar dari webcam
            'status' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        // Ambil data dari request
        $user = Auth::user();
        $nis = $user->siswa->nis;
        $date = date("Y-m-d");
        $status = $request->input('status');
        $keterangan = $request->input('keterangan');
        $fileName = null;

        if ($request->filled('photo_webcam')) {
            // Jika file webcam dikirim, simpan sebagai gambar
            $photoWebcam = $request->input('photo_webcam');

            // Decode Base64 ke file gambar
            $folderPath = 'public/uploads/absensi/';
            $fileName = $nis . '_' . $date . '_' . $status . '.png';
            $image_parts = explode(";base64", $photoWebcam);
            $image_base64 = base64_decode($image_parts[1]);

            Storage::put($folderPath . $fileName, $image_base64);
        } elseif ($request->hasFile('photo_in')) {
            // Cek jika file diupload
            $foto = $request->file('photo_in');

            // Menyimpan file dengan nama unik
            $extension = $foto->getClientOriginalExtension();
            $folderPath = 'public/uploads/absensi/';
            $fileName = $nis . '_' . $date . '_' . $status . '.' . $extension;
            $file = $folderPath . $fileName;

            // Pindahkan file ke folder public/uploads/absensi
            Storage::put($file, file_get_contents($foto));
        }

        if ($fileName) {
            // Simpan data ke database
            $data = [
                'nis' => $nis,
                'status' => $status,
                'photo_in' => $fileName, // Gunakan file yang sudah diproses
                'keterangan' => $keterangan,
                'date' => $date,
            ];

            $simpan = Absensi::create($data);
            if ($simpan) {
                return redirect()->route('siswa.index')->with('berhasil', 'Kehadiran berhasil dicatat.');
            } else {
                return redirect()->route('siswa.index')->with('gagal', 'Gagal menyimpan kehadiran.');
            }
        } else {
            return redirect()->route('siswa.index')->with('gagal', 'Tidak ada file yang dikirim.');
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

    public function ambilabsen(Request $request)
    {
        $user = Auth::user();
        $nis = $user->siswa->nis;
        $date = date("Y-m-d");
        $jam = date("H:i:s");
        $koordinatsiswa = $request->lokasi;

        $koordinatsekolah = Koordinat_Sekolah::first();
        $radiussekolah = $koordinatsekolah->radius;

        list($latitudesekolah, $longitudesekolah) = explode(', ', $koordinatsekolah->titik_koordinat);
        list($latitudeuser, $longitudeuser) = explode(', ', $koordinatsiswa);

        $jarak = $this->distance($latitudesekolah, $longitudesekolah, $latitudeuser, $longitudeuser);

        $image = $request->image;
        if (empty($image)) {
            return redirect()->back()->with('gagal', 'Kamu harus mengambil foto terlebih dahulu.');
        }


        // $faceConfidence = $request->faceConfidence;
        // if ($faceConfidence < 0.4) {
        //     return redirect()->back()->with('gagal', 'Deteksi wajah tidak berhasil, silakan coba lagi.');
        // }

        // if ($jarak['meters'] > $radiussekolah) {
        //     return redirect()->back()->with('gagal', 'Lokasi kamu berada diluar radius yang diizinkan.');
        // }

        $folderPath = "public/uploads/absensi/";
        $formatMasuk = $nis . "_" . $date . "_" . "masuk";
        $formatPulang = $nis . "_" . $date . "_" . "pulang";
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);

        $validasiAbsen = Waktu_Absen::first();

        $batas_absen_masuk = strtotime($validasiAbsen->batas_absen_masuk);
        $jam_absen = strtotime($jam);

        if ($jam_absen > $batas_absen_masuk) {
            $selisihDetik = $jam_absen - $batas_absen_masuk;
            $menit_terlambat = abs($selisihDetik) / 60;
            $status = 'terlambat';
        } else {
            $status = 'hadir';
            $menit_terlambat = null;
        }

        $cekabsen = Absensi::where('date', $date)
            ->where('nis', $nis)
            ->first();

        if ($cekabsen) {
            $fileName = $formatPulang . ".png";
            $datapulang = [
                'photo_out' => $fileName,
                'jam_pulang' => $jam,
                'titik_koordinat_pulang' => $koordinatsiswa,
            ];
            Absensi::where('date', $date)->where('nis', $nis)->update($datapulang);

            Storage::put($folderPath . $fileName, $image_base64);

            return redirect()->route('siswa.index')->with('berhasil', 'Absen pulang berhasil dicatat.');
        } else {
            $fileName = $formatMasuk . ".png";
            $data = [
                'nis' => $nis,
                'status' => $status,
                'photo_in' => $fileName,
                'date' => $date,
                'jam_masuk' => $jam,
                'titik_koordinat_masuk' => $koordinatsiswa,
                'menit_keterlambatan' => $menit_terlambat,
            ];
            Absensi::insert($data);

            Storage::put($folderPath . $fileName, $image_base64);

            return redirect()->route('siswa.index')->with('berhasil', 'Kehadiran berhasil dicatat.');
        }
    }

    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5200;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }
}
