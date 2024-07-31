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
                        <h1 class="title-4">Selamat Datang
                            <span>Pak Kesiswaan!</span>
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
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item statistic__item--green">
                            <h2 class="number">195</h2>
                            <span class="desc">Jumlah Siswa Hadir</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item statistic__item--orange">
                            <h2 class="number">10</h2>
                            <span class="desc">Jumlah Siswa Sakit/Izin</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item statistic__item--blue">
                            <h2 class="number">7</h2>
                            <span class="desc">Jumlah Siswa Terlambat</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item statistic__item--red">
                            <h2 class="number">12</h2>
                            <span class="desc">Jumlah Siswa Belum Hadir</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END STATISTIC-->


        <!-- DATA TABLE-->
        <section class="p-t-20">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="title-5 m-b-35 text-center">Ringkasan Data Kehadiran Siswa Setiap Kelas</h3>
                        <section class="p-t-10">
                            <div class="container">
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <button class="au-btn-filter mr-2">
                                            <i></i>Kelas X</button>
                                        <button class="au-btn-filter mr-2">
                                            <i></i> Kelas XI</button>
                                        <button class="au-btn-filter mr-2">
                                            <i></i>Kelas XII</button>
                                    </div>
                                </div>
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>Kelas</th>
                                                <th>Hadir</th>
                                                <th>Sakit</th>
                                                <th>Izin</th>
                                                <th>Terlambat</th>
                                                <th>Tidak Hadir</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>XI TKJ</td>
                                                <td>32</td>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>2</td>
                                                <td>1</td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Detail">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>XI DKV</td>
                                                <td>32</td>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>2</td>
                                                <td>1</td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Detail">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>X MPLB</td>
                                                <td>32</td>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>2</td>
                                                <td>1</td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Detail">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>X PPLG</td>
                                                <td>32</td>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>2</td>
                                                <td>1</td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Detail">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>XI RPL</td>
                                                <td>32</td>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>2</td>
                                                <td>1</td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Detail">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
