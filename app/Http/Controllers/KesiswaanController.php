<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Wali_Kelas;
use App\Models\Siswa;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Pagination\LengthAwarePaginator;
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
        // Data kehadiran untuk chart
        $attendanceData = [
            'kelas10' => [],
            'kelas11' => [],
            'kelas12' => []
        ];

        // Mendapatkan tanggal Senin dan Jumat minggu ini
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::FRIDAY);

        // Mendapatkan jumlah hari kerja (Senin hingga Jumat)
        $workDays = CarbonPeriod::create($startOfWeek, $endOfWeek)->filter(function ($date) {
            return in_array($date->dayOfWeek, [1, 2, 3, 4, 5]); // Senin - Jumat
        })->count();

        // Mengambil kelas tingkat 10, 11, dan 12 beserta siswa-siswanya
        $kelasList = Kelas::with('siswa')->whereIn('tingkat', ['10', '11', '12'])->get();

        foreach ($kelasList as $kelas) {
            $totalSiswa = $kelas->siswa->count(); // Total siswa per kelas

            // Ambil jumlah kehadiran siswa dalam minggu ini
            $kehadiranCount = Absensi::whereIn('nis', $kelas->siswa->pluck('nis')) // Ambil NIS semua siswa di kelas
                ->whereBetween('date', [$startOfWeek, $endOfWeek]) // Ambil absensi hanya dalam minggu ini
                ->where('status', 'Hadir') // Hanya hitung yang statusnya "Hadir"
                ->count();

            // Hitung persentase kehadiran
            $persentaseKehadiran = $totalSiswa > 0 ? ($kehadiranCount / ($totalSiswa * $workDays)) * 100 : 0;

            // Simpan data berdasarkan tingkat kelas
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
        // dd($request->all());
        $jurusans = Jurusan::all();

        $startDate = $request->input('start');
        $endDate = $request->input('end');
        $tingkat = $request->input('tingkat');
        $id_jurusan = $request->input('id_jurusan');

        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->toDateString();
            $endDate = Carbon::now()->endOfMonth()->toDateString();
        }

        $kelasList = Kelas::with('siswa.absensi');

        if ($tingkat) {
            $kelasList->where('tingkat', $tingkat);
        }

        if ($id_jurusan) {
            $kelasList->where('id_jurusan', $id_jurusan);
        }

        $kelasList = $kelasList->get();

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

        $kelasDataCollection = collect($kelasData);

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 6;
        $paginateData = new LengthAwarePaginator(
            $kelasDataCollection->forPage($currentPage, $perPage),
            $kelasDataCollection->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        $paginatedData = $paginateData->appends($request->only(['start', 'end']));

        return view('kesiswaan.kelas', [
            'title' => 'Dashboard',
            'kelasData' => $paginatedData,
            'averagePercentageHadir' => $averagePercentageHadir,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'jurusans' => $jurusans,
        ]);
    }

    public function laporansiswa(Request $request, $kelas_id)
    {
        // dd($request->all());
        $startDate = $request->input('start');
        $endDate = $request->input('end');
        $search = $request->input('search');

        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->toDateString();
            $endDate = Carbon::now()->endOfMonth()->toDateString();
        }

        $kelas = Kelas::where('id_kelas', $kelas_id)->first();
        $students = Siswa::where('id_kelas', $kelas_id)->with('user');

        if ($search) {
            $students->where(function ($s) use ($search) {
                $s->whereHas('user', function ($query) use ($search) {
                    $query->where('nama', 'like', '%' . $search . '%');
                })
                    ->orWhere('nis', 'like', '%' . $search . '%');
            });
        }
        $students = $students->get();

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

        $siswaDataCollection = collect($studentsData);

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 9;
        $paginateData = new LengthAwarePaginator(
            $siswaDataCollection->forPage($currentPage, $perPage),
            $siswaDataCollection->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        $paginatedData = $paginateData->appends($request->only(['start', 'end', 'search']));

        return view('kesiswaan.siswa', [
            'studentsData' => $paginatedData,
            'attendanceCounts' => $attendanceCounts,
            'averageAttendancePercentages' => $averageAttendancePercentages,
            'kelas' => $kelas,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'search' => $search
        ]);
    }

    public function laporandetailsiswa(Request $request, $kelas_id, $id)
    {
        $startDate = $request->input('start');
        $endDate = $request->input('end');
        $status = $request->input('status');

        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->toDateString();
            $endDate = Carbon::now()->endOfMonth()->toDateString();
        }

        $kelas = Kelas::where('id_kelas', $kelas_id)->first();

        $present = Absensi::where('nis', $id)->whereBetween('date', [$startDate, $endDate])->orderBy('date', 'DESC');

        if ($status) {
            $present->where('status', $status);
        }

        $present = $present->get();

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

        $presentDataCollection = collect($present);

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $paginateData = new LengthAwarePaginator(
            $presentDataCollection->forPage($currentPage, $perPage),
            $presentDataCollection->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        $paginatedData = $paginateData->appends($request->only(['start', 'end']));

        // dd($paginateData);

        return view('kesiswaan.detailsiswa', [
            'present' => $paginatedData,
            'students' => $students,
            'attendanceCounts' => $attendanceCounts,
            'attendancePercentage' => $attendancePercentage,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'kelas' => $kelas,
        ]);
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
