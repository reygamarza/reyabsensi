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
        $today = date('Y-m-d');

        $attendanceTotal = [
            'Hadir' => Absensi::whereIn('status', ['Hadir', 'Terlambat', 'TAP'])->where('date', $today)->count(),
            'Terlambat' => Absensi::where('status', 'Terlambat')->where('date', $today)->count(),
            'TAP' => Absensi::where('status', 'TAP')->where('date', $today)->count(),
            'Alfa' => Absensi::where('status', 'Alfa')->where('date', $today)->count(),
            'Izin' => Absensi::where(function ($query) {
                $query->where('status', 'Sakit')
                      ->orWhere('status', 'Izin');
            })->where('date', $today)->count(),
        ];

        $attendanceData = [];

        // Calculate last five weekdays (Monday to Friday)
        $fiveWeekdays = [];
        $date = Carbon::now();
        while (count($fiveWeekdays) < 5) {
            if (in_array($date->dayOfWeek, [1, 2, 3, 4, 5])) { // Monday to Friday
                $fiveWeekdays[] = $date->format('Y-m-d');
            }
            $date->subDay();
        }
        $fiveWeekdays = array_reverse($fiveWeekdays); // Oldest to latest

        // Process attendance for last five weekdays
        $kelasList = Kelas::with('siswa')->whereIn('tingkat', ['10', '11', '12'])->get();

        foreach ($fiveWeekdays as $index => $date) {
            foreach ($kelasList as $kelas) {
                $totalSiswa = $kelas->siswa->count();

                $kehadiranCount = Absensi::whereIn('nis', $kelas->siswa->pluck('nis'))
                    ->whereDate('date', $date)
                    ->whereIn('status', ['Hadir', 'Terlambat', 'TAP'])
                    ->count();

                $persentaseKehadiran = $totalSiswa > 0 ? ($kehadiranCount / $totalSiswa) * 100 : 0;

                if ($kelas->tingkat == '10') {
                    $attendanceData['kelas10'][$index] = $persentaseKehadiran;
                } elseif ($kelas->tingkat == '11') {
                    $attendanceData['kelas11'][$index] = $persentaseKehadiran;
                } elseif ($kelas->tingkat == '12') {
                    $attendanceData['kelas12'][$index] = $persentaseKehadiran;
                }
            }
        }

        return view('kesiswaan.kesiswaan', compact('attendanceData', 'attendanceTotal', 'fiveWeekdays'));
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

            $kelasHadir = $kelasAbsensi->whereIn('status', ["Hadir", "Terlambat", "TAP"])->count();
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

    public function laporanSiswa(Request $request, $kelas_id)
    {
        // Retrieve the date range from the request
        $startDate = $request->input('start');
        $endDate = $request->input('end');

        // Set default to the current month if no dates are provided
        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->toDateString();
            $endDate = Carbon::now()->endOfMonth()->toDateString();
        }

        // Fetch the search keyword for name or NIS
        $search = $request->input('search');

        // Fetch students in the class and apply search filter
        $kelas = Kelas::where('id_kelas', $kelas_id)->first();
        $studentsQuery = Siswa::where('id_kelas', $kelas_id)->with('user');

        if ($search) {
            // Filter by name or NIS
            $studentsQuery->whereHas('user', function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            })->orWhere('nis', 'like', '%' . $search . '%');
        }

        $students = $studentsQuery->get();
        $siswaIds = $students->pluck('nis');

        // Fetch attendance records for the students within the specified date range
        $siswaAbsensi = Absensi::whereIn('nis', $siswaIds)
            ->whereBetween('date', [$startDate, $endDate])
            ->get();

        $totalStudents = count($students);
        $attendanceCounts = [
            'Hadir' => $siswaAbsensi->whereIn('status', ['Hadir', 'Terlambat', 'TAP'])->count(),
            'Sakit/Izin' => $siswaAbsensi->whereIn('status', ['Sakit', 'Izin'])->count(),
            'Alfa' => $siswaAbsensi->where('status', 'Alfa')->count(),
        ];

        // Calculate the percentage of attendance for each student
        $studentsData = []; // Initialize the array to hold student data

        foreach ($students as $student) {
            // Get attendance records for the current student within the specified date range
            $studentAttendance = $siswaAbsensi->where('nis', $student->nis);
            $effectiveBusinessDaysCount = $studentAttendance->unique('date')->count();

            // Initialize the student data
            $studentData = [
                'nis' => $student->nis,
                'name' => $student->user->nama,
                'attendanceCounts' => [],
                'attendancePercentages' => [],
            ];

            // Count the status for this student
            foreach ($attendanceCounts as $status => $count) {
                if ($status === 'Hadir') {
                    // Count the combined status for 'Hadir'
                    $studentStatusCount = $studentAttendance->whereIn('status', ['Hadir', 'Terlambat', 'TAP'])->count();
                } elseif ($status === 'Sakit/Izin') {
                    // Calculate the count for combined status
                    $studentStatusCount = $studentAttendance->whereIn('status', ['Sakit', 'Izin'])->count();
                } else {
                    // Calculate count for individual statuses
                    $studentStatusCount = $studentAttendance->where('status', $status)->count();
                }

                $studentData['attendanceCounts'][$status] = $studentStatusCount; // Count for this status

                // Calculate the percentage for this status
                if ($effectiveBusinessDaysCount > 0) {
                    $percentage = round(($studentStatusCount / $effectiveBusinessDaysCount) * 100, 2);
                    $studentData['attendancePercentages'][$status] = $percentage;
                } else {
                    $studentData['attendancePercentages'][$status] = 0; // Set to 0 if no business days
                }
            }

            $studentsData[] = $studentData; // Add student data to the array
        }

        // Calculate average attendance percentages for all statuses
        $averageAttendancePercentages = [];
        foreach ($attendanceCounts as $status => $count) {
            $totalPercentage = 0;

            // Sum the individual percentages for this status
            foreach ($studentsData as $studentData) {
                $totalPercentage += $studentData['attendancePercentages'][$status] ?? 0;
            }

            // Calculate the average percentage
            $averageAttendancePercentages[$status] = $totalStudents > 0 ? round($totalPercentage / $totalStudents, 2) : 0;
        }

        // Create a pagination instance
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

        // Pass the data to the view
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
            'Hadir' => $present->whereIn('status', ['Hadir', 'Terlambat', 'TAP'])->count(),
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
