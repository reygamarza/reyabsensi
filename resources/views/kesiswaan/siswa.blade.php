@extends('layouts.laykesiswaan')

@section('content')
    <!-- PAGE CONTENT-->
    <div class="page-content--bgf7">
        <!-- BREADCRUMB-->
        <section class="au-breadcrumb2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="au-breadcrumb-content">
                            <div class="au-breadcrumb-left">
                                <ul class="list-unstyled list-inline au-breadcrumb__list">
                                    <li class="list-inline-item active">
                                        <a href="#">> Laporan Absensi / Siswa</a>
                                    </li>
                                    <li class="list-inline-item seprate">
                                        <span></span>
                                    </li>
                                    <li class="list-inline-item"></li>
                                </ul>
                            </div>
                            <form class="au-form-icon--sm" action="{{ route('kesiswaan.siswa', ['kelas_id' => $kelas->id_kelas] ) }}" method="GET">
                                <input class="au-input--w300 au-input--style2" type="text" name="search" placeholder="Cari Siswa..." value="{{ request('search') }}">
                                <button class="au-btn--submit2" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END BREADCRUMB-->

        <!-- WELCOME-->
        <section class="welcome">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div style="display: flex; align-items: center; justify-content: center;">
                            <a href="{{ route('kesiswaan.kelas') }}" class="fas fa-chevron-left" style="font-size: 40px; color: #393939;"></a>
                            <div style="flex: 1;">
                                <h1 class="title-4 text-center" style="margin-bottom: 0;">Laporan Absensi Siswa</h1>
                            </div>
                        </div>
                        <hr class="line-seprate">
                    </div>
                </div>
            </div>
        </section>
        <!-- END WELCOME-->

        <!-- DATA TABLE-->
        <section class="p-t-20">
            <div class="container">
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <button class="au-btn au-btn-icon au-btn--grey au-btn--small">
                            <i class="zmdi zmdi-download"></i>Export</button>
                    </div>
                    <div class="table-data__tool-right">
                        <form action="{{ route('kesiswaan.siswa', ['kelas_id' => $kelas->id_kelas] ) }}" method="GET">
                            <div class="filter-group">
                                <label for="from-date">From</label>
                                <input type="date" id="from-date" name="start" class="au-btn-filter" value="{{ $startDate }}">
                                <label for="to-date">To</label>
                                <input type="date" id="to-date" name="end" class="au-btn-filter" value="{{ $endDate }}">
                                <button class="au-btn au-btn-icon au-btn--blue au-btn--small" type="submit">
                                    <i class="zmdi zmdi-search"></i>Filter
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-info bg-gradient text-white text-center" style="font-size: 18px">
                                    <strong class="card-title">Ringkasan Kehadiran Siswa {{ $kelas->tingkat }} {{ $kelas->id_jurusan }} {{ $kelas->nomor_kelas }}</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col">
                                            <h4 class="text-success">{{ number_format($averageAttendancePercentages['Hadir']) }}%</h4>
                                            <small>Hadir</small>
                                        </div>
                                        <div class="col">
                                            <h4 class="text-info">{{ number_format($averageAttendancePercentages['Sakit/Izin']) }}%</h4>
                                            <small>Sakit/Izin</small>
                                        </div>
                                        <div class="col">
                                            <h4 class="text-danger">{{ number_format($averageAttendancePercentages['Alfa']) }}%</h4>
                                            <small>Alfa</small>
                                        </div>
                                        <div class="col">
                                            <h4 class="text-warning">{{ number_format($averageAttendancePercentages['Terlambat']) }}%</h4>
                                            <small>Terlambat</small>
                                        </div>
                                        <div class="col">
                                            <h4 class="text-secondary">{{ number_format($averageAttendancePercentages['TAP']) }}%</h4>
                                            <small>TAP</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($studentsData as $student)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-secondary text-white">
                                    <strong class="card-title mb-3">{{ $student['name'] }}</strong>
                                    <strong>
                                        <span class="float-right">{{ $student['nis'] }}</span>
                                    </strong>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="location text-sm-center">Persentase Kehadiran</div>
                                        <div class="attendance-bar">
                                            <div class="attendance-progress" style="width: {{ $student['attendancePercentages']['Hadir'] }}%;">
                                                <span class="attendance-percentage">{{ number_format($student['attendancePercentages']['Hadir']) }}%</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-end">
                                        <a href="{{ route('kesiswaan.detailsiswa', ['kelas_id' => $kelas->id_kelas, 'id' => $student['nis']]) }}">
                                            <button class="btn btn-secondary">
                                                <i class="fa fa-tasks"></i> Detail
                                            </button>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $studentsData->links() }}
                    </div>
                </div>
            </div>
        </section>
        <!-- END DATA TABLE-->

        <!-- COPYRIGHT-->
        <section class="p-t-60 p-b-20">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright">
                            <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a
                                    href="https://colorlib.com">Colorlib</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END COPYRIGHT-->
    </div>

    </div>
@endsection
