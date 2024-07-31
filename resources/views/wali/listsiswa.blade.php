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
                                        <li class="list-inline-item">List Siswa</li>
                                    </ul>
                                </div>
                                <form class="au-form-icon--sm" action="" method="post">
                                    <input class="au-input--w300 au-input--style2" type="text" placeholder="Cari Siswa">
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
                                <span>Absen Siswa 11 RPL 1</span>
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
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>NIK</th>
                                    <th>NISN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>0061748352</td>
                                    <td>Reyga Marza Ramadhan</td>
                                    <td>Laki - Laki</td>
                                    <td>3781945620341982</td>
                                    <td>2206510469</td>
                                </tr>
                                <tr>
                                    <td>0062894371</td>
                                    <td>Satria Galam Pratama</td>
                                    <td>Laki - Laki</td>
                                    <td>3567290841536724</td>
                                    <td>2206510470</td>
                                </tr>
                                <tr>
                                    <td>0069584720</td>
                                    <td>Haanun Syauqoni Al-fatir</td>
                                    <td>Laki - Laki</td>
                                    <td>3948571620837401</td>
                                    <td>2206510471</td>
                                </tr>
                                <tr>
                                    <td>0067352914</td>
                                    <td>Yudi Fatir Faturohman</td>
                                    <td>Laki - Laki</td>
                                    <td>3248956702938412</td>
                                    <td>2206510472</td>
                                </tr>
                                <tr>
                                    <td>0064829173</td>
                                    <td>Hariz May Rayhan</td>
                                    <td>Laki - Laki</td>
                                    <td>3482165094738261</td>
                                    <td>2206510473</td>
                                </tr>
                            </tbody>
                        </table>
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
