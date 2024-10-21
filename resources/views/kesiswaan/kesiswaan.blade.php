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
                                        <a href="#"></a>
                                    </li>
                                    <li class="list-inline-item seprate">
                                        <span>></span>
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
                        <h1 class="title-4">Selamat Datang
                            <span>{{ Auth::user()->nama }}!</span>
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
                                <h2 class="number">{{ $attendanceTotal['Hadir'] }}</h2>
                                <span class="desc">Total Hadir</span>
                            </div>
                            <div class="statistic__item statistic__item--orange">
                                <h2 class="number">{{ $attendanceTotal['Izin'] }}</h2>
                                <span class="desc">Total Sakit/Izin</span>
                            </div>
                            <div class="statistic__item statistic__item--blue">
                                <h2 class="number">{{ $attendanceTotal['Terlambat'] }}</h2>
                                <span class="desc">Total Terlambat</span>
                            </div>
                            <div class="statistic__item statistic__item--red">
                                <h2 class="number">{{ $attendanceTotal['Alfa'] }}</h2>
                                <span class="desc">Total Belum Absen</span>
                            </div>
                            <div class="statistic__item statistic__item--purple ">
                                <h2 class="number">{{ $attendanceTotal['TAP'] }}</h2>
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
                <div class="row">
                    <div class="col-md-12">
                        <section class="">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="title-5 m-b-35 text-center">Persentase Kehadiran Siswa Minggu Ini</h3>
                                        <div class="statistic__item">
                                            <canvas id="attendanceChart" height="100"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
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
    const attendanceData = {
        'kelas10': @json($attendanceData['kelas10']),
        'kelas11': @json($attendanceData['kelas11']),
        'kelas12': @json($attendanceData['kelas12']),
        'dates': ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] // Atur sesuai kebutuhan
    };

    const ctx = document.getElementById('attendanceChart').getContext('2d');
    const attendanceChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: attendanceData.dates,
            datasets: [{
                    label: 'Kelas 10',
                    data: attendanceData.kelas10,
                    backgroundColor: 'rgba(66, 135, 245, 0.8)',
                    borderColor: 'rgba(66, 135, 245, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Kelas 11',
                    data: attendanceData.kelas11,
                    backgroundColor: 'rgba(245, 203, 66, 0.8)',
                    borderColor: 'rgba(245, 203, 66, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Kelas 12',
                    data: attendanceData.kelas12,
                    backgroundColor: 'rgba(66, 245, 157, 0.8)',
                    borderColor: 'rgba(66, 245, 157, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Kehadiran (%)'
                    }
                }
            }
        }
    });
</script>
@endpush


