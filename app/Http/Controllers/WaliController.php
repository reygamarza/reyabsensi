<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Wali_Kelas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WaliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Wali_Kelas::where('id_user', auth()->id())->with('kelas')->first();
        $kelas = Kelas::where('nuptk', $user->nuptk)->first();

        // Hitung jumlah siswa di kelas
        $jumlahsiswa = Siswa::where('id_kelas', $kelas->id_kelas)->count();

        // Data absensi untuk hari ini
        $harini = Absensi::where('date', date('Y-m-d'))
            ->whereIn('nis', Siswa::where('id_kelas', $kelas->id_kelas)->pluck('nis'))
            ->get();

        $count = [
            'Hadir' => $harini->where('status', 'Hadir')->count(),
            'Sakit' => $harini->where('status', 'Sakit')->count(),
            'Izin' => $harini->where('status', 'Izin')->count(),
            'Terlambat' => $harini->where('status', 'Terlambat')->count(),
            'Alfa' => $harini->where('status', 'Alfa')->count(),
            'TAP' => $harini->where('status', 'TAP')->count(),
        ];

        // Data untuk bulan ini
        $bulanIni = Absensi::whereMonth('date', date('m'))
            ->whereIn('nis', Siswa::where('id_kelas', $kelas->id_kelas)->pluck('nis'))
            ->get();

        $countCurrent = [
            'Hadir' => $bulanIni->where('status', 'Hadir')->count(),
            'Sakit' => $bulanIni->where('status', 'Sakit')->count(),
            'Izin' => $bulanIni->where('status', 'Izin')->count(),
            'Terlambat' => $bulanIni->where('status', 'Terlambat')->count(),
            'Alfa' => $bulanIni->where('status', 'Alfa')->count(),
            'TAP' => $bulanIni->where('status', 'TAP')->count(),
        ];

        // Data untuk bulan sebelumnya
        $bulanSebelumnya = Absensi::whereMonth('date', date('m', strtotime('-1 month')))
            ->whereIn('nis', Siswa::where('id_kelas', $kelas->id_kelas)->pluck('nis'))
            ->get();

        $countPrevious = [
            'Hadir' => $bulanSebelumnya->where('status', 'Hadir')->count(),
            'Sakit' => $bulanSebelumnya->where('status', 'Sakit')->count(),
            'Izin' => $bulanSebelumnya->where('status', 'Izin')->count(),
            'Terlambat' => $bulanSebelumnya->where('status', 'Terlambat')->count(),
            'Alfa' => $bulanSebelumnya->where('status', 'Alfa')->count(),
            'TAP' => $bulanSebelumnya->where('status', 'TAP')->count(),
        ];

        return view('wali.wali', compact('user', 'kelas', 'count', 'countCurrent', 'countPrevious'));
    }

    public function siswa(Request $request)
    {
        $startDate = $request->input('start');
        $endDate = $request->input('end');

        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->toDateString();
            $endDate = Carbon::now()->endOfMonth()->toDateString();
        }

        $user = Wali_Kelas::where('id_user', auth()->id())->with('kelas')->first();
        $kelas = Kelas::where('nuptk', $user->nuptk)->first();
        $students = Siswa::where('id_kelas', $kelas->id_kelas)->with('user')->get();
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

        return view('wali.siswa', compact('studentsData', 'attendanceCounts', 'averageAttendancePercentages', 'kelas', 'startDate', 'endDate'));
    }

    public function detailSiswa(Request $request, $id)
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

        return view('wali.detailsiswa', compact('present', 'students', 'attendanceCounts', 'attendancePercentage', 'startDate', 'endDate'));
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

    public function listsiswa()
    {
        return view('wali.listsiswa', [
            "title" => "Absen Siswa"
        ]);
    }
}
