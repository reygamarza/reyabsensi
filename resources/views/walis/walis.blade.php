@extends('layouts.laywalis')

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
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="list-inline-item seprate">
                                        <span>/</span>
                                    </li>
                                    <li class="list-inline-item">Dashboard</li>
                                </ul>
                            </div>
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
                        <h1 class="title-4">Selamat Datang,
                            <span>{{ Auth::user()->nama }}!</span>
                        </h1>
                        <hr class="line-seprate">
                    </div>
                </div>
            </div>
        </section>
        <!-- END WELCOME-->

        <!-- KEHADIRAN ANAK -->
        <section class="attendance py-4">
            <div class="container">
                <div class="row justify-content-center">
                    @foreach ($dataAbsensiAnak as $data)
                        <div class="col-lg-6">
                            <div class="card shadow-sm">
                                <div class="card-header text-white">
                                    <h4 class="mb-0 text-white">Rekap Kehadiran {{ $data['nama'] }}</h4>
                                </div>
                                <div class="d-flex justify-content-center pt-3">
                                    <h2 class="text-center text-primary">Belum Absen</h2>
                                </div>
                                <div class="card-body">
                                    <ul class="nav nav-tabs mb-3 mt-0" id="attendanceTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="current-month-tab" data-toggle="tab"
                                                data-target="#current-month{{ $data['nis'] }}" type="button"
                                                role="tab">Bulan Ini</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="current-year-tab" data-toggle="tab"
                                                data-target="#current-year{{ $data['nis'] }}" type="button"
                                                role="tab">Tahun Ini</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="previous-month-tab" data-toggle="tab"
                                                data-target="#previous-month{{ $data['nis'] }}" type="button"
                                                role="tab">Bulan Sebelumnya</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="attendanceTabContent">
                                        <div class="tab-pane fade show active" id="current-month{{ $data['nis'] }}"
                                            role="tabpanel">
                                            <div class="progress mb-3">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: {{ $data['PersentaseBulanIni'] }}%"
                                                    aria-valuenow="{{ $data['PersentaseBulanIni'] }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    {{ $data['PersentaseBulanIni'] }}%
                                                </div>
                                            </div>
                                            <div class="attendance-item">
                                                <i class="fas fa-check-circle text-success"></i>
                                                <span>Hadir : {{ $data['BulanIni']['Hadir'] }} hari</span>
                                            </div>
                                            <div class="attendance-item">
                                                <i class="fas fa-user-md text-info"></i>
                                                <span>Sakit/Izin : {{ $data['BulanIni']['Sakit/Izin'] }} hari</span>
                                            </div>
                                            <div class="attendance-item">
                                                <i class="fas fa-clock text-warning"></i>
                                                <span>Terlambat : {{ $data['BulanIni']['Terlambat'] }} hari</span>
                                            </div>
                                            <div class="attendance-item">
                                                <i class="fas fa-times-circle text-danger"></i>
                                                <span>Alfa : {{ $data['BulanIni']['Alfa'] }} hari</span>
                                            </div>
                                            <div class="attendance-item">
                                                <i class="fas fa-bell text-primary"></i>
                                                <span>TAP : {{ $data['BulanIni']['TAP'] }} hari</span>
                                            </div>
                                            <div class="attendance-item">
                                                <i class="fas fa-user-clock text-secondary"></i>
                                                <span>Total Keterlambatan : {{ $data['BulanIni']['late'] }} Menit</span>
                                            </div>
                                        </div>

                                        <!-- Konten untuk Bulan Lalu -->
                                        <div class="tab-pane fade" id="previous-month{{ $data['nis'] }}" role="tabpanel">
                                            <div class="progress mb-3">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                    style="width: {{ $data['PersentaseBulanLalu'] }}%"
                                                    aria-valuenow="{{ $data['PersentaseBulanLalu'] }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    {{ $data['PersentaseBulanLalu'] }}%
                                                </div>
                                            </div>
                                            <div class="attendance-item">
                                                <i class="fas fa-check-circle text-success"></i>
                                                <span>Hadir : {{ $data['BulanLalu']['Hadir'] }} hari</span>
                                            </div>
                                            <div class="attendance-item">
                                                <i class="fas fa-user-md text-info"></i>
                                                <span>Sakit/Izin : {{ $data['BulanLalu']['Sakit/Izin'] }} hari</span>
                                            </div>
                                            <div class="attendance-item">
                                                <i class="fas fa-clock text-warning"></i>
                                                <span>Terlambat : {{ $data['BulanLalu']['Terlambat'] }} hari</span>
                                            </div>
                                            <div class="attendance-item">
                                                <i class="fas fa-times-circle text-danger"></i>
                                                <span>Alfa : {{ $data['BulanLalu']['Alfa'] }} hari</span>
                                            </div>
                                            <div class="attendance-item">
                                                <i class="fas fa-bell text-primary"></i>
                                                <span>TAP : {{ $data['BulanLalu']['TAP'] }} hari</span>
                                            </div>
                                            <div class="attendance-item">
                                                <i class="fas fa-user-clock text-secondary"></i>
                                                <span>Total Keterlambatan : {{ $data['BulanLalu']['late'] }} Menit</span>
                                            </div>
                                        </div>

                                        <!-- Konten untuk Tahun Ini -->
                                        <div class="tab-pane fade" id="current-year{{ $data['nis'] }}" role="tabpanel">
                                            <div class="progress mb-3">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                    style="width: {{ $data['PersentaseTahunIni'] }}%"
                                                    aria-valuenow="{{ $data['PersentaseTahunIni'] }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    {{ $data['PersentaseTahunIni'] }}%
                                                </div>
                                            </div>
                                            <div class="attendance-item">
                                                <i class="fas fa-check-circle text-success"></i>
                                                <span>Hadir : {{ $data['TahunIni']['Hadir'] }} hari</span>
                                            </div>
                                            <div class="attendance-item">
                                                <i class="fas fa-user-md text-info"></i>
                                                <span>Sakit/Izin : {{ $data['TahunIni']['Sakit/Izin'] }} hari</span>
                                            </div>
                                            <div class="attendance-item">
                                                <i class="fas fa-clock text-warning"></i>
                                                <span>Terlambat : {{ $data['TahunIni']['Terlambat'] }} hari</span>
                                            </div>
                                            <div class="attendance-item">
                                                <i class="fas fa-times-circle text-danger"></i>
                                                <span>Alfa : {{ $data['TahunIni']['Alfa'] }} hari</span>
                                            </div>
                                            <div class="attendance-item">
                                                <i class="fas fa-bell text-primary"></i>
                                                <span>TAP : {{ $data['TahunIni']['TAP'] }} hari</span>
                                            </div>
                                            <div class="attendance-item">
                                                <i class="fas fa-user-clock text-secondary"></i>
                                                <span>Total Keterlambatan : {{ $data['TahunIni']['late'] }} Menit</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- END KEHADIRAN ANAK -->

        <!-- COPYRIGHT-->
        <section class="p-t-60 p-b-20">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright">

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END COPYRIGHT-->
    </div>
@endsection
