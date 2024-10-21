<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Wali_Kelas;
use App\Models\Siswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class KesiswaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Data kehadiran
        $attendanceData = [
            'kelas10' => [],
            'kelas11' => [],
            'kelas12' => []
        ];

        $kelasList = Kelas::whereIn('tingkat', ['10', '11', '12'])->get();

        // Menghitung jumlah kehadiran untuk setiap kelas
        foreach ($kelasList as $kelas) {
            $siswaList = $kelas->siswa;
            $totalSiswa = $siswaList->count(); // Menghitung total siswa di kelas ini
            $kehadiranCount = 0; // Menghitung total kehadiran

            foreach ($siswaList as $siswa) {
                // Ambil data absensi untuk bulan ini
                $absensi = Absensi::where('nis', $siswa->nis)
                    ->whereMonth('date', date('m'))
                    ->whereYear('date', date('Y'))
                    ->get();

                $kehadiranCount += $absensi->where('status', 'Hadir')->count();
            }

            // Hitung persentase kehadiran
            $persentaseKehadiran = $totalSiswa > 0 ? ($kehadiranCount / $totalSiswa) * 100 : 0;

            // Masukkan data ke dalam array sesuai tingkat
            if ($kelas->tingkat == '10') {
                $attendanceData['kelas10'][] = $persentaseKehadiran;
            } elseif ($kelas->tingkat == '11') {
                $attendanceData['kelas11'][] = $persentaseKehadiran;
            } elseif ($kelas->tingkat == '12') {
                $attendanceData['kelas12'][] = $persentaseKehadiran;
            }
        }

        $today = date('Y-m-d');
        $attendanceTotal = [
            'Hadir' => Absensi::where('status', 'Hadir')->where('date', $today)->count(),
            'Terlambat' => Absensi::where('status', 'Terlambat')->where('date', $today)->count(),
            'TAP' => Absensi::where('status', 'TAP')->where('date', $today)->count(),
            'Alfa' => Absensi::where('status', 'Alfa')->where('date', $today)->count(),
            'Izin' => Absensi::where(function ($query) {
                $query->where('status', 'Sakit')
                    ->orWhere('status', 'Izin');
            })->where('date', $today)->count(),
        ];

        // Mengirim data ke view
        return view('kesiswaan.kesiswaan', compact('attendanceData', 'attendanceTotal'));
    }

    public function laporankelas(Request $request)
    {
        // Retrieve the date range from the request
        $startDate = $request->input('start');
        $endDate = $request->input('end');

        // Set default to current month if no dates are provided
        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->toDateString();
            $endDate = Carbon::now()->endOfMonth()->toDateString();
        }

        // Fetch all classes
        $kelasList = Kelas::with('siswa.absensi')->get();

        $kelasData = [];
        $totalPercentageHadir = 0;
        $totalClasses = count($kelasList);

        foreach ($kelasList as $kelas) {
            $siswaIds = $kelas->siswa->pluck('nis');

            // Modify the query to filter by date range
            $kelasAbsensi = Absensi::whereBetween('date', [$startDate, $endDate])
                ->whereIn('nis', $siswaIds)
                ->get();

            $totalKelasRecords = $kelasAbsensi->count();

            $kelasHadir = $kelasAbsensi->where('status', 'Hadir')->count();
            $kelasSakitIzin = ($kelasAbsensi->where('status', 'Sakit')->count()) + ($kelasAbsensi->where('status', 'Izin')->count());
            $kelasAlfa = $kelasAbsensi->where('status', 'Alfa')->count();
            $kelasTerlambat = $kelasAbsensi->where('status', 'Terlambat')->count();
            $kelasTAP = $kelasAbsensi->where('status', 'TAP')->count();

            // Calculate percentages for the class
            $kelasPercentageHadir = ($totalKelasRecords > 0) ? ($kelasHadir / $totalKelasRecords) * 100 : 0;
            $totalPercentageHadir += $kelasPercentageHadir;
            $kelasPercentageSakitIzin = ($totalKelasRecords > 0) ? ($kelasSakitIzin / $totalKelasRecords) * 100 : 0;
            $kelasPercentageAlfa = ($totalKelasRecords > 0) ? ($kelasAlfa / $totalKelasRecords) * 100 : 0;
            $kelasPercentageTerlambat = ($totalKelasRecords > 0) ? ($kelasTerlambat / $totalKelasRecords) * 100 : 0;
            $kelasPercentageTAP = ($totalKelasRecords > 0) ? ($kelasTAP / $totalKelasRecords) * 100 : 0;

            $kelasData[] = [
                'kelas_id' => $kelas->id_kelas,
                'kelas' => $kelas->tingkat . ' ' . $kelas->id_jurusan . ' ' . $kelas->nomor_kelas,
                'total' => $totalKelasRecords,
                'countHadir' => $kelasHadir,
                'percentageHadir' => $kelasPercentageHadir,
                'countSakitIzin' => $kelasSakitIzin,
                'percentageSakitIzin' => $kelasPercentageSakitIzin,
                'countAlfa' => $kelasAlfa,
                'percentageAlfa' => $kelasPercentageAlfa,
                'countTerlambat' => $kelasTerlambat,
                'percentageTerlambat' => $kelasPercentageTerlambat,
                'countTAP' => $kelasTAP,
                'percentageTAP' => $kelasPercentageTAP,
            ];
        }

        $averagePercentageHadir = ($totalClasses > 0) ? ($totalPercentageHadir / $totalClasses) : 0;

        return view('kesiswaan.kelas', [
            'title' => 'Dashboard',
            'kelasData' => $kelasData,
            'averagePercentageHadir' => $averagePercentageHadir,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }

    public function laporansiswa(Request $request, $kelas_id)
    {
        $startDate = $request->input('start');
        $endDate = $request->input('end');

        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->toDateString();
            $endDate = Carbon::now()->endOfMonth()->toDateString();
        }

        $kelas = Kelas::where('id_kelas', $kelas_id)->first();
        $students = Siswa::where('id_kelas', $kelas_id)->with('user')->get();
        $siswaIds = $students->pluck('nis');

        $siswaAbsensi = Absensi::whereIn('nis', $siswaIds)
            ->whereBetween('date', [$startDate, $endDate])
            ->get();

        $totalStudents = count($students);
        $attendanceCounts = [
            'Hadir' => $siswaAbsensi->where('status', 'Hadir')->count(),
            'Sakit' => $siswaAbsensi->where('status', 'Sakit')->count(),
            'Izin' => $siswaAbsensi->where('status', 'Izin')->count(),
            'Alfa' => $siswaAbsensi->where('status', 'Alfa')->count(),
            'Terlambat' => $siswaAbsensi->where('status', 'Terlambat')->count(),
            'TAP' => $siswaAbsensi->where('status', 'TAP')->count(),
        ];

        $studentsData = [];

        foreach ($students as $student) {
            $studentAttendance = $siswaAbsensi->where('nis', $student->nis);

            $totalAttendance = $studentAttendance->count();
            $studentData = [
                'nis' => $student->nis,
                'name' => $student->user->nama,
                'attendancePercentages' => [],
            ];

            if ($totalAttendance > 0) {
                foreach ($attendanceCounts as $status => $count) {
                    $studentStatusCount = $studentAttendance->where('status', $status)->count();
                    $percentage = ($studentStatusCount / $totalAttendance) * 100;
                    $studentData['attendancePercentages'][$status] = $percentage;
                }
            } else {
                $studentData['attendancePercentages'] = array_fill_keys(array_keys($attendanceCounts), 0);
            }

            $studentsData[] = $studentData;
        }

        $averageAttendancePercentages = [];

        $attendanceCounts['Sakit/Izin'] = $attendanceCounts['Sakit'] + $attendanceCounts['Izin'];

        foreach ($attendanceCounts as $status => $count) {
            $totalPercentage = 0;

            foreach ($studentsData as $studentData) {
                if ($status === 'Sakit/Izin') {
                    $totalPercentage += $studentData['attendancePercentages']['Sakit'] ?? 0;
                    $totalPercentage += $studentData['attendancePercentages']['Izin'] ?? 0;
                } else {
                    $totalPercentage += $studentData['attendancePercentages'][$status] ?? 0;
                }
            }

            $averageAttendancePercentages[$status] = $totalStudents > 0 ? $totalPercentage / $totalStudents : 0;
        }

        return view('kesiswaan.siswa', compact('studentsData', 'attendanceCounts', 'averageAttendancePercentages', 'kelas', 'startDate', 'endDate'));
    }

    public function laporandetailsiswa(Request $request, $id)
    {
        $startDate = $request->input('start');
        $endDate = $request->input('end');

        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->toDateString();
            $endDate = Carbon::now()->endOfMonth()->toDateString();
        }

        $present = Absensi::where('nis', $id)->whereBetween('date', [$startDate, $endDate])->orderBy('date', 'asc')->paginate(7)->appends($request->only(['start', 'end']));

        $students = Siswa::where('nis', $id)->with('user')->first();


        $totalRecords = $present->count();

        $attendanceCounts = [
            'Hadir' => $present->where('status', 'Hadir')->count(),
            'Sakit/Izin' => $present->where('status', 'Sakit')->count() + $present->where('status', 'Izin')->count(),
            'Alfa' => $present->where('status', 'Alfa')->count(),
            'Terlambat' => $present->where('status', 'Terlambat')->count(),
            'TAP' => $present->where('status', 'TAP')->count(),
        ];

        $attendancePercentage = [
            'percentageHadir' => ($totalRecords > 0) ? ($attendanceCounts['Hadir'] / $totalRecords) * 100 : 0,
            'percentageSakitIzin' => ($totalRecords > 0) ? ($attendanceCounts['Sakit/Izin'] / $totalRecords) * 100 : 0,
            'percentageAlfa' => ($totalRecords > 0) ? ($attendanceCounts['Alfa'] / $totalRecords) * 100 : 0,
            'percentageTerlambat' => ($totalRecords > 0) ? ($attendanceCounts['Terlambat'] / $totalRecords) * 100 : 0,
            'percentageTAP' => ($totalRecords > 0) ? ($attendanceCounts['TAP'] / $totalRecords) * 100 : 0,
        ];

        return view('kesiswaan.detailsiswa', compact('present', 'students', 'attendanceCounts', 'attendancePercentage', 'startDate', 'endDate'));
    }

    public function profileK()
    {
        $user = Auth::user();
        $id_user = $user->id;

        $kesiswaan = User::where('id', $id_user)->first();
        return view('kesiswaan.profile', [
            'title' => 'Profile',
            'kesiswaan' => $kesiswaan,
        ]);
    }

    public function editprofileK(Request $request)
    {
        $user = Auth::user();
        $id_user = $user->id;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $extension = $foto->getClientOriginalExtension();
            $folderPath = 'public/uploads/foto_profil/';
            $fileName = $user->nama . '.' . $extension;
            $file = $folderPath . $fileName;

            Storage::put($file, file_get_contents($foto));
        } else {
            $fileName = $user->foto;
        }

        $password = $request->password ? Hash::make($request->password) : $user->password;

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $password,
            'foto' => $fileName,
        ];

        $simpan = User::where('id', $id_user)->update($data);

        if ($simpan) {
            return redirect()->route('kesiswaan.profile')->with('berhasil', 'Profil Anda Berhasil Diubah.');
        } else {
            return redirect()->route('kesiswaan.profile')->with('gagal', 'Profil Gagal Diubah.');
        }
    }
}
