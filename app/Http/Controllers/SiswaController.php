<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Absensi;
use App\Models\Koordinat_Sekolah;
use App\Models\Waktu_Absen;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

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


    public function Absen()
    {
        $koordinatsekolah = Koordinat_Sekolah::first();
        return view('siswa.absen', [
            'koordinatsekolah' => $koordinatsekolah
        ]);
    }

    public function Rekap()
    {
        $user = Auth::user();
        $nis = $user->siswa->nis;
        $hariini = date("Y-m-d");

        $absensi = Absensi::where('nis', $nis)->where('date', $hariini)->paginate(7);

        $jumlahHadir = $absensi->where('status', 'Hadir')->count();
        $jumlahIzin = $absensi->whereIn('status', ['Sakit', 'Izin'])->count();
        $jumlahTerlambat = $absensi->where('status', 'Terlambat')->count();
        $jumlahAlfa = $absensi->where('status', 'Alfa')->count();
        $jumlahTap = $absensi->where('status', 'TAP')->count();
        $totalKeterlambatan = $absensi->sum('menit_keterlambatan');

        $totalAbsensi = $absensi->count();
        $persentaseHadir = $totalAbsensi > 0 ? round(($jumlahHadir / $totalAbsensi) * 100) : 0;

        return view('siswa.rekap', compact('absensi',  'jumlahHadir', 'jumlahIzin', 'jumlahTerlambat', 'jumlahAlfa', 'jumlahTap', 'totalKeterlambatan', 'persentaseHadir'));
    }

    public function filterrekap(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $user = Auth::user();
        $nis = $user->siswa->nis;

        $absensi = Absensi::where('nis', $nis)->whereBetween('date', [$start_date, $end_date])->paginate(7)->appends(['start_date' => $start_date, 'end_date' => $end_date]);

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $user = Auth::user();
        $nis = $user->siswa->nis;

        // Query untuk semua data (tanpa paginasi)
        $allAbsensi = Absensi::where('nis', $nis)
            ->whereBetween('date', [$start_date, $end_date])
            ->get();

        // Hitung total berdasarkan semua data
        $jumlahHadir = $allAbsensi->where('status', 'Hadir')->count();
        $jumlahIzin = $allAbsensi->whereIn('status', ['Sakit', 'Izin'])->count();
        $jumlahTerlambat = $allAbsensi->where('status', 'Terlambat')->count();
        $jumlahAlfa = $allAbsensi->where('status', 'Alfa')->count();
        $jumlahTap = $allAbsensi->where('status', 'TAP')->count();
        $totalKeterlambatan = $allAbsensi->sum('menit_keterlambatan');

        $totalAbsensi = $allAbsensi->count();
        $persentaseHadir = $totalAbsensi > 0 ? round(($jumlahHadir / $totalAbsensi) * 100) : 0;
    
        // Query dengan paginasi hanya untuk menampilkan data di tabel
        $absensi = Absensi::where('nis', $nis)
            ->whereBetween('date', [$start_date, $end_date])
            ->paginate(7);

        return view('siswa.rekap', compact(
            'absensi',
            'jumlahHadir',
            'jumlahIzin',
            'jumlahTerlambat',
            'jumlahAlfa',
            'jumlahTap',
            'totalKeterlambatan',
            'persentaseHadir'
        ));

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
        $request->validate([
            'photo_in' => 'required|mimes:png,jpg,jpeg,pdf',
            'status' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        if ($request->hasFile('photo_in')) {
            // Ambil data dari request
            $user = Auth::user();
            $nis = $user->siswa->nis;
            $date = date("Y-m-d");
            $status = $request->input('status');
            $keterangan = $request->input('keterangan');

            // Ambil file dari request
            $foto = $request->file('photo_in');

            // Menyimpan file dengan nama unik
            $extension = $foto->getClientOriginalExtension();
            $folderPath = 'public/uploads/absensi/';
            $fileName = $nis . '_' . $date . '_' . $status . '.' . $extension;
            $file = $folderPath . $fileName;

            // Pindahkan file ke folder public/uploads/absensi
            // $foto->move($folderPath, $fileName);

            // Simpan data ke database
            $data = [
                'nis' => $nis,
                'status' => $status,
                'photo_in' => $fileName,
                'keterangan' => $keterangan,
                'date' => $date,
            ];

            $simpan = Absensi::create($data);
            if($simpan)
            {
                Storage::put($file, file_get_contents($foto));
                return redirect()->route('siswa.index')->with('berhasil', 'Kehadiran berhasil dicatat.');
            } else {
                return redirect()->route('siswa.index')->with('gagal', 'Fotonya gaada mas.');
            }

        }

         else {
            return redirect()->route('siswa.index')->with('gagal', 'File Tidak ada.');
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
