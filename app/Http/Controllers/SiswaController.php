<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Absensi;
use App\Models\Koordinat_Sekolah;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hariini = date("Y-m-d");
        $user = Auth::user();
        $nis = $user->siswa->nis;

        $cekabsen = DB::table('absensis')
            ->where('date', $hariini)
            ->where('nis', $nis)
            ->first();

        $statusAbsen = $cekabsen ? $cekabsen->status : 'Belum Absen';

        $absenMasuk = false;
        $absenPulang = false;

        if ($cekabsen) {
            $absenMasuk = !empty($cekabsen->photo_in);
            $absenPulang = !empty($cekabsen->photo_out);
        }

        return view('siswa.siswa', [
            'cekabsen' => $cekabsen ? 1 : 0,
            'absenMasuk' => $absenMasuk,
            'absenPulang' => $absenPulang,
            'statusAbsen' => $statusAbsen,
        ]);
    }

    public function Absen()
    {
        return view('siswa.absen');
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
        $status = 'hadir';
        $date = date("Y-m-d");
        $jam = date("H:i:s");
        $koordinatsiswa = $request->lokasi;

        $koordinatsekolah = Koordinat_Sekolah::first();
        $radiussekolah = $koordinatsekolah->radius;

        list($latitudesekolah, $longitudesekolah) = explode(', ', $koordinatsekolah->titik_koordinat);
        list($latitudeuser, $longitudeuser) = explode(', ', $koordinatsiswa);

        $jarak = $this->distance($latitudesekolah, $longitudesekolah, $latitudeuser, $longitudeuser);

        if ($jarak['meters'] > $radiussekolah) {
            return response()->json([
                'success' => false,
                'message' => 'Lokasi Anda berada di luar radius yang diizinkan.'
            ]);
        }

        $image = $request->image;
        $folderPath = "public/uploads/absensi/";
        $formatMasuk = $nis . "_" . $date . "_" . "masuk";
        $formatPulang = $nis . "_" . $date . "_" . "pulang";
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);

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

            return response()->json([
                'success' => true,
                'message' => 'Terima Kasih! Absen Pulang Berhasil Dicatat.'
            ]);
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

            return response()->json([
                'success' => true,
                'message' => 'Terima Kasih! Kehadiran Berhasil Dicatat.'
            ]);
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
