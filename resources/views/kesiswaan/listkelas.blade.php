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
                                        <a href="#">> Kelas</a>
                                    </li>
                                    <li class="list-inline-item seprate">
                                        <span>/</span>
                                    </li>
                                    <li class="list-inline-item">Daftar Kelas</li>
                                </ul>
                            </div>
                            <form class="au-form-icon--sm" action="" method="post">
                                <input class="au-input--w300 au-input--style2" type="text" placeholder="Cari Kelas">
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
                            <span>Daftar Kelas</span>
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
                        <button class="au-btn-filter mr-2">
                            <i></i>Semua</button>
                        <button class="au-btn-filter mr-2">
                            <i></i>Kelas X</button>
                        <button class="au-btn-filter mr-2">
                            <i></i>Kelas XI</button>
                        <button class="au-btn-filter mr-2">
                            <i></i>Kelas XII</button>
                    </div>
                    <div class="table-data__tool-right">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>Tambah</button>
                    </div>
                </div>
                <div class="table-responsive m-b-40">
                    <table class="table table-borderless table-data3">
                        <thead>
                            <tr>
                                <th>Kelas</th>
                                <th>Wali Kelas</th>
                                <th>Jumlah Siswa</th>
                                <th>Daftar Siswa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $k )
                            <tr>
                                <td>{{ $k->tingkat }} {{ $k->jurusan->nama_jurusan }} {{ $k->nomor_kelas }}</td>
                                <td>{{ $k->walikelas->nama }}</td>
                                <td>{{ $k->jumlah_siswa }}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{ route('list-siswa-AD', ['id_kelas' => $k->id_kelas]) }}" class="item" data-toggle="tooltip" data-placement="top" title="Kelas {{ $k->tingkat }} {{ $k->jurusan->nama_jurusan }} {{ $k->nomor_kelas }}">
                                            <i class="zmdi zmdi-more"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
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
