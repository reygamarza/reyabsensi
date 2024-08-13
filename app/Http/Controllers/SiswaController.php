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

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $koordinatsekolah = Koordinat_Sekolah::first();
        $jam = Waktu_Absen::first();
        $hariini = date("Y-m-d");
        $user = Auth::user();
        $nis = $user->siswa->nis;

        // Mencari absensi berdasarkan tanggal hari ini dan NIS siswa.
        $cekabsen = Absensi::where('date', $hariini)
            ->where('nis', $nis)
            ->first();

        // Mengambil Absen bulan ini
        $tanggalawal = date("Y-m-01");
        $tanggalakhir = date("Y-m-t");

        $riwayatkehadiran = Absensi::whereBetween('date', [$tanggalawal, $tanggalakhir])
            ->where('nis', $nis)->paginate(7);

        $chartriwayatkehadiran = Absensi::whereBetween('date', [$tanggalawal, $tanggalakhir])
            ->where('nis', $nis)
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        // Gabungkan 'Sakit' dan 'Izin' menjadi satu kategori
        $chartriwayatkehadiran['Sakit/Izin'] = ($chartriwayatkehadiran['Sakit'] ?? 0) + ($chartriwayatkehadiran['Izin'] ?? 0);
        unset($chartriwayatkehadiran['Sakit'], $chartriwayatkehadiran['Izin']); // Hapus status 'Sakit' dan 'Izin'

        // Status yang tersisa
        $statuses = ['Hadir', 'Sakit/Izin', 'Alfa', 'Terlambat', 'TAP'];
        foreach ($statuses as $status) {
            if (!array_key_exists($status, $chartriwayatkehadiran)) {
                $chartriwayatkehadiran[$status] = 0;
            }
        }

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
            'riwayatkehadiran' => $riwayatkehadiran,
            'chartriwayatkehadiran' => $chartriwayatkehadiran,
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
        return view('siswa.rekap');
    }

    public function uploadfile(Request $request)
    {
        $request->validate([
            'photo_in' => 'required|mimes:png,jpg,jpeg,pdf', // Maksimal 10MB
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
            $folderPath = public_path("uploads/absensi/");
            $fileName = $nis . '_' . $date . '_' . $status . '.' . $extension;

            // Pindahkan file ke folder public/uploads/absensi
            $foto->move($folderPath, $fileName);

            // Simpan data ke database
            $data = [
                'nis' => $nis,
                'status' => $status,
                'photo_in' => $fileName,
                'keterangan' => $keterangan,
                'date' => $date,
            ];

            Absensi::create($data);

            return redirect()->route('siswa.index')->with('berhasil', 'Kehadiran berhasil dicatat.');
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

        $batas_jam_masuk = strtotime($validasiAbsen->batas_jam_masuk);
        $jam_absen = strtotime($jam);

        if ($jam_absen > $batas_jam_masuk) {
            $status = 'terlambat';
        } else {
            $status = 'hadir';
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
