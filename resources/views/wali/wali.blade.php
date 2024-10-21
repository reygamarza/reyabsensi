@extends('layouts.laywali')

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
                            <form class="au-form-icon--sm" action="" method="post">
                                <input class="au-input--w300 au-input--style2" type="text" placeholder="Search">
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
                        <h1 class="title-4">Selamat Datang
                            <span>Wali Kelas 11 RPL 1!</span>
                        </h1>
                        <hr class="line-seprate">
                    </div>
                </div>
            </div>
        </section>
        <!-- END WELCOME-->

        <!-- STATISTIC-->
        <section class="statistic statistic2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="statistic_kesiswaan-container">
                            <div class="statistic__item statistic__item--green">
                                <h2 class="number">{{ $count['Hadir'] }}</h2>
                                <span class="desc">Total Hadir</span>
                            </div>
                            <div class="statistic__item statistic__item--blue">
                                <h2 class="number">{{ $count['Sakit'] + $count['Izin'] }}</h2>
                                <span class="desc">Total Sakit/Izin</span>
                            </div>
                            <div class="statistic__item statistic__item--orange">
                                <h2 class="number">{{ $count['Terlambat'] }}</h2>
                                <span class="desc">Total Terlambat</span>
                            </div>
                            <div class="statistic__item statistic__item--red">
                                <h2 class="number">{{ $count['Alfa'] }}</h2>
                                <span class="desc">Total Belum Absen</span>
                            </div>
                            <div class="statistic__item statistic__item--purple ">
                                <h2 class="number">{{ $count['TAP'] }}</h2>
                                <span class="desc">Total TAP</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- END STATISTIC-->


        <!-- DATA TABLE-->
        <section class="">
            <div class="container">
                <h3 class="m-b-35 text-center">Perbandingan Kehadiran Siswa</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="statistic__item">
                            <h3 class="title-5 m-b-20 text-center">Bulan Ini</h3>
                            <div class="chart-container-W">
                                <canvas width="400px" height="400px" id="attendanceChartCurrent"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="statistic__item">
                            <h3 class="title-5 m-b-20 text-center">Bulan Sebelumnya</h3>
                            <div class="chart-container-W">
                                <canvas width="400px" height="400px" id="attendanceChartPrevious"></canvas>
                            </div>
                        </div>
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

@push('myscript')
    <script>
        // Data dari controller (Bulan ini)
        const countCurrent = @json($countCurrent);

        // Data untuk chart bulan ini
        const ctxCurrent = document.getElementById('attendanceChartCurrent').getContext('2d');
        const dataCurrent = {
            labels: ['Hadir', 'Sakit/Izin', 'Terlambat', 'TAP', 'Alfa'],
            datasets: [{
                data: [countCurrent.Hadir, countCurrent.Sakit, countCurrent.Terlambat, countCurrent.TAP,
                    countCurrent.Alfa
                ],
                backgroundColor: ['#28a745', '#ffc107', '#007bff', '#6f42c1', '#dc3545'],
                hoverOffset: 4
            }]
        };

        const configCurrent = {
            type: 'pie',
            data: dataCurrent,
            options: {
                responsive: false,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                let total = tooltipItem.dataset.data.reduce((a, b) => a + b, 0);
                                let value = tooltipItem.raw;
                                let percentage = ((value / total) * 100).toFixed(2);
                                return `${tooltipItem.label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        };

        new Chart(ctxCurrent, configCurrent);

        // Data dari controller (Bulan sebelumnya)
        const countPrevious = @json($countPrevious);

        // Data untuk chart bulan sebelumnya
        const ctxPrevious = document.getElementById('attendanceChartPrevious').getContext('2d');
        const dataPrevious = {
            labels: ['Hadir', 'Sakit/Izin', 'Terlambat', 'TAP', 'Alfa'],
            datasets: [{
                data: [countPrevious.Hadir, countPrevious.Sakit, countPrevious.Terlambat, countPrevious.TAP,
                    countPrevious.Alfa
                ],
                backgroundColor: ['#28a745', '#ffc107', '#007bff', '#6f42c1', '#dc3545'],
                hoverOffset: 4
            }]
        };

        const configPrevious = {
            type: 'pie',
            data: dataPrevious,
            options: {
                responsive: false,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                let total = tooltipItem.dataset.data.reduce((a, b) => a + b, 0);
                                let value = tooltipItem.raw;
                                let percentage = ((value / total) * 100).toFixed(2);
                                return `${tooltipItem.label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        };

        new Chart(ctxPrevious, configPrevious);
    </script>
@endpush
