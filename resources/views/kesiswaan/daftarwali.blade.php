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
                                            <a href="#">> </a>
                                        </li>
                                        <li class="list-inline-item">Daftar Wali Kelas</li>
                                    </ul>
                                </div>
                                <form class="au-form-icon--sm" action="" method="post">
                                    <input class="au-input--w300 au-input--style2" type="text" placeholder="Cari Guru">
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
                                <span>Daftar Wali Kelas</span>
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
                            <div class="rs-select2--light rs-select2--md">
                                <select class="js-select2" name="property">
                                    <option selected="selected">Kelas</option>
                                    <option value="">XII</option>
                                    <option value="">XI</option>
                                    <option value="">X</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                            <div class="rs-select2--light rs-select2--md">
                                <select class="js-select2" name="property">
                                    <option selected="selected">Jurusan</option>
                                    <option value="">RPL</option>
                                    <option value="">DKV</option>
                                    <option value="">TKJ</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
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
                                    <th>NUPTK</th>
                                    <th>Nama</th>
                                    <th>JK</th>
                                    <th>Kelas</th>
                                    <th>NIK</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelas as $w)
                                <tr>
                                    <td>{{ $w->nuptk }}</td>
                                    <td>{{ $w->walikelas->nama }}</td>
                                    <td>{{ $w->walikelas->jenis_kelamin }}</td>
                                    <td>{{ $w->tingkat }} {{ $w->jurusan->nama_jurusan }} {{ $w->nomor_kelas }}</td>
                                    <td>{{ $w->walikelas->nik }}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="">
                                                <button class="item mr-1" data-toggle="tooltip" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                            </a>
                                            <form action="" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="item mr-1" data-toggle="tooltip" data-placement="top"
                                                    title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </form>
                                            <button class="item mr-1" data-toggle="tooltip" data-placement="top"
                                                title="Detail">
                                                <i class="zmdi zmdi-more"></i>
                                            </button>
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
