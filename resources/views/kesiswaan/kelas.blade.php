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
                                        <a href="#">> Laporan Absensi</a>
                                    </li>
                                    <li class="list-inline-item seprate">
                                        <span></span>
                                    </li>
                                    <li class="list-inline-item"></li>
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
                        <h1 class="title-4 text-center">
                            <span>Laporan Absensi Kelas</span>
                        </h1>
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
                    <div class="table-data__tool-left" style="display:flex; align-items:center;">
                        <button class="au-btn au-btn-icon au-btn--grey au-btn--small mr-2">
                            <i class="zmdi zmdi-download"></i>Export</button>
                        <form action="{{ route('kesiswaan.kelas') }}" method="GET">
                            <div class="rs-select2--light rs-select2--md mr-2">
                                <select class="js-select2" name="tingkat">
                                    <option selected="selected" value="">Semua Tingkat</option>
                                    <option value="10" {{ request('tingkat') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="11" {{ request('tingkat') == 11 ? 'selected' : '' }}>11</option>
                                    <option value="12" {{ request('tingkat') == 12 ? 'selected' : '' }}>12</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                            <div class="rs-select2--light rs-select2--md">
                                <select class="js-select2" name="id_jurusan">
                                    <option selected="selected" value="">Semua Jurusan</option>
                                    @foreach ($jurusans as $j)
                                        <option value="{{ $j->id_jurusan }}"
                                            {{ request('id_jurusan') == $j->id_jurusan ? 'selected' : '' }}>
                                            {{ $j->id_jurusan }}</option>
                                    @endforeach
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                    </div>
                    <div class="table-data__tool-right">
                        <div class="filter-group">
                            <label for="from-date">From</label>
                            <input type="date" id="from-date" name="start" class="au-btn-filter"
                                value="{{ $startDate }}">
                            <label for="to-date">To</label>
                            <input type="date" id="to-date" name="end" class="au-btn-filter"
                                value="{{ $endDate }}">
                            <button class="au-btn au-btn-icon au-btn--blue au-btn--small" type="submit">
                                <i class="zmdi zmdi-search"></i>Filter
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
                <div>
                    <div class="row">
                        @foreach ($kelasData as $kelas)
                            <div class="col-md-6">
                                <div class="attendance-card">
                                    <div class="attendance-header">
                                        <span class="class-name">{{ $kelas['kelas'] }}</span>
                                        <a href="{{ route('kesiswaan.siswa', ['kelas_id' => $kelas['kelas_id']]) }}">
                                            <div class="attendance-detail-button">
                                                <i class="fas fa-eye"></i> Detail
                                            </div>
                                        </a>
                                    </div>
                                    <div class="attendance-content p-4">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span>Hadir</span>
                                            <span class="fw-medium">{{ number_format($kelas['percentageHadir']) }}%</span>
                                        </div>
                                        <div class="attendance-bar mb-3">
                                            <div class="attendance-progress bg-success"
                                                 style="width: {{ number_format($kelas['percentageHadir']) }}%">
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span>Sakit/Izin</span>
                                            <span class="fw-medium">{{ number_format($kelas['percentageSakitIzin']) }}%</span>
                                        </div>
                                        <div class="attendance-bar mb-3">
                                            <div class="attendance-progress bg-primary"
                                                 style="width: {{ number_format($kelas['percentageSakitIzin']) }}%">
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span>Terlambat</span>
                                            <span class="fw-medium">{{ number_format($kelas['percentageTerlambat']) }}%</span>
                                        </div>
                                        <div class="attendance-bar mb-3">
                                            <div class="attendance-progress bg-warning"
                                                 style="width: {{ number_format($kelas['percentageTerlambat']) }}%">
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span>TAP</span>
                                            <span class="fw-medium">{{ number_format($kelas['percentageTAP']) }}%</span>
                                        </div>
                                        <div class="attendance-bar mb-3">
                                            <div class="attendance-progress"
                                                 style="width: {{ number_format($kelas['percentageTAP']) }}%; background-color: #6610f2;">
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span>Alfa</span>
                                            <span class="fw-medium">{{ number_format($kelas['percentageAlfa']) }}%</span>
                                        </div>
                                        <div class="attendance-bar mb-3">
                                            <div class="attendance-progress bg-danger"
                                                 style="width: {{ number_format($kelas['percentageAlfa']) }}%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $kelasData->links() }}
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
