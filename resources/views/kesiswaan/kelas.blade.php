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
                            <form class="au-form-icon--sm" action="" method="post">
                                <input class="au-input--w300 au-input--style2" type="text" placeholder="Cari">
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
                    <div class="table-data__tool-left">
                        <button class="au-btn au-btn-icon au-btn--grey au-btn--small">
                            <i class="zmdi zmdi-download"></i>Export</button>
                        {{-- <div class="rs-select2--light rs-select2--sm">
                            <select class="js-select2" name="time">
                                <option selected="selected">Kelas</option>
                                <option value="">XII</option>
                                <option value="">XI</option>
                                <option value="">X</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div> --}}
                        {{-- <input type="date" name="" id="" class="au-btn-filter mr-2"> --}}
                    </div>
                    <div class="table-data__tool-right">
                        <form action="{{ route('kesiswaan.kelas') }}" method="GET">
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
                                <div class="attendance-content">
                                    <div class="attendance-bar">
                                        <div class="attendance-progress" style="width: {{ number_format($kelas['percentageHadir']) }}%;">
                                            <span class="attendance-percentage">{{ number_format($kelas['percentageHadir']) }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
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
