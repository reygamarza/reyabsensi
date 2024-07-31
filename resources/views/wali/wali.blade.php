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
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--green">
                                <h2 class="number">30</h2>
                                <span class="desc">Jumlah Siswa Hadir</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--orange">
                                <h2 class="number">1</h2>
                                <span class="desc">Jumlah Siswa Izin</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--blue">
                                <h2 class="number">2</h2>
                                <span class="desc">Jumlah Siswa Sakit</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--red">
                                <h2 class="number">2</h2>
                                <span class="desc">Jumlah Siswa Tidak Hadir</span>
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
                            <h3 class="title-5 m-b-35 text-center" >Ringkasan Data Kehadiran Siswa</h3>
                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <div class="rs-select2--light rs-select2--md">
                                        <select class="js-select2" name="property">
                                            <option selected="selected">Hari Ini</option>
                                            <option value="">3 Hari</option>
                                            <option value="">1 Minggu</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                    {{-- <div class="rs-select2--light rs-select2--sm">
                                        <select class="js-select2" name="time">
                                            <option selected="selected">Hari Ini</option>
                                            <option value="">3 Hari</option>
                                            <option value="">1 Minggu</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div> --}}
                                    <button class="au-btn-filter">
                                        <i class="zmdi zmdi-filter-list"></i>filters</button>
                                </div>
                                <div class="table-data__tool-right">
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                        <i class="zmdi zmdi-plus"></i>Tambah</button>
                                    <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                                        <select class="js-select2" name="type">
                                            <option selected="selected">Export</option>
                                            <option value="">Option 1</option>
                                            <option value="">Option 2</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2">
                                    <thead>
                                        <tr>
                                            <!-- <th>
                                                <label class="au-checkbox">
                                                    <input type="checkbox">
                                                    <span class="au-checkmark"></span>
                                                </label>
                                            </th> -->
                                            <th>nama</th>
                                            <th>status</th>
                                            <th>tanggal</th>
                                            <th>keterangan</th>
                                            <th>bukti</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr class="tr-shadow">
                                                <td>Reyga Marza Ramadhan</td>
                                                <td>
                                                    <span class="status hadir">Hadir</span>
                                                </td>
                                                <td>2024-05-01</td>
                                                <td>-</td>
                                                <td class="desc">Sudah Absen</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Lihat Bukti">
                                                        <i class="zmdi zmdi-eye"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                        <tr class="tr-shadow">
                                            <td>Satria Galam Pratama</td>
                                            <td>
                                                <span class="status sakit">Sakit</span>
                                            </td>
                                            <td>2024-05-01</td>
                                            <td>tidak bisa hadir karena sakit</td>
                                            <td class="desc">image.jpg</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Lihat Bukti">
                                                    <i class="zmdi zmdi-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="tr-shadow">
                                        <td>Sammuel Nisjatel</td>
                                        <td>
                                            <span class="status izin">Izin</span>
                                        </td>
                                        <td>2024-05-01</td>
                                        <td>izin mengikuti lomba</td>
                                        <td class="desc">image.png</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Lihat Bukti">
                                                <i class="zmdi zmdi-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                    <tr class="spacer"></tr>
                                    </tbody>
                                </table>
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
                                <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END COPYRIGHT-->
        </div>

    </div>
@endsection
