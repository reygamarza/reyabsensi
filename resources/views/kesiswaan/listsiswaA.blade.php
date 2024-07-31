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
                                        <a href="#">> List</a>
                                    </li>
                                    <li class="list-inline-item seprate">
                                        <span>/</span>
                                    </li>
                                    <li class="list-inline-item">Daftar Siswa {{ $kelas->tingkat }}
                                        {{ $kelas->jurusan->nama_jurusan }} {{ $kelas->nomor_kelas }}</li>
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
                        <div style="display: flex; align-items: center; justify-content: center;">
                            <a href="{{ route('list-kelas') }}" class="fas fa-chevron-left"
                                style="font-size: 40px; color: #393939;"></a>
                            <div style="flex: 1;">
                                <h1 class="title-4 text-center" style="margin-bottom: 0;">Daftar Siswa {{ $kelas->tingkat }}
                                    {{ $kelas->jurusan->nama_jurusan }}
                                    {{ $kelas->nomor_kelas }}</< /h1>
                            </div>
                        </div>
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
                            <i></i>Urutkan A - Z</button>
                    </div>
                    <div class="table-data__tool-right">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal"
                            data-target="#TambahModal">
                            <i class="zmdi zmdi-plus"></i>Tambah</button>
                    </div>

                    {{-- Modal Tambah Siswa --}}
                    <div class="modal fade" id="TambahModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content" style="border-radius: 10px">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-light" id="largeModalLabel"><strong>Edit Data</strong>
                                        <small>Siswa</small>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('tambah-siswa') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row form-group" style="margin-bottom: 25px;">
                                            <div class="col col-md-3">
                                                <label for="nis" class="form-control-label">NIS</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="nis" name="nis"
                                                    placeholder="Masukan NIS" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row form-group" style="margin-bottom: 25px;">
                                            <div class="col col-md-3">
                                                <label for="nama" class="form-control-label">Nama Lengkap</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="nama" name="nama"
                                                    placeholder="Masukan Nama Lengkap" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="disabledSelect" class=" form-control-label">Kelas</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select name="id_kelas" id="id_kelas" disabled="" class="form-control"
                                                    required>
                                                    <option value="{{ $kelas->id_kelas }}">{{ $kelas->tingkat }}
                                                        {{ $kelas->jurusan->nama_jurusan }}
                                                        {{ $kelas->nomor_kelas }}</option>
                                                </select>
                                            </div>
                                            <input type="hidden" name="id_kelas" value="{{ $kelas->id_kelas }}">
                                        </div>
                                        {{-- <div class="row form-group" style="margin-bottom: 25px;">
                                        <div class="col col-md-3">
                                            <label for="email-input" class=" form-control-label">Kelas</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select class="form-control selectpicker" data-live-search="true">
                                                @foreach ($listkelas as $lk)
                                                <option data-tokens="">{{ $lk->kelas }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}
                                        <div class="row form-group" style="margin-bottom: 25px;">
                                            <div class="col col-md-3">
                                                <label class="form-control-label">Jenis Kelamin</label>
                                            </div>
                                            <div class="col col-md-9">
                                                <div class="form-check-inline form-check">
                                                    <label for="inline-radio1" class="form-check-label mr-4">
                                                        <input type="radio" id="inline-radio1" name="jenis_kelamin"
                                                            value="laki laki" class="form-check-input">Laki - Laki
                                                    </label>
                                                    <label for="inline-radio2" class="form-check-label">
                                                        <input type="radio" id="inline-radio2" name="jenis_kelamin"
                                                            value="perempuan" class="form-check-input">Perempuan
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group" style="margin-bottom: 25px;">
                                            <div class="col col-md-3">
                                                <label for="nik" class="form-control-label">NIK</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="nik" name="nik"
                                                    placeholder="Masukan NIK" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row form-group" style="margin-bottom: 25px;">
                                            <div class="col col-md-3">
                                                <label for="nisn" class="form-control-label">NISN</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="nisn" name="nisn"
                                                    placeholder="Masukan NISN" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- End Modal Tambah Siswa --}}

                    {{-- Modal Edit Siswa --}}
                    <div class="modal fade" id="EditModal" tabindex="-1" role="dialog"
                        aria-labelledby="largeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content" style="border-radius: 10px">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-light" id="largeModalLabel"><strong>Tambah Data</strong>
                                        <small>Siswa</small>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('tambah-siswa') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row form-group" style="margin-bottom: 25px;">
                                            <div class="col col-md-3">
                                                <label for="nis" class="form-control-label">NIS</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="nis" name="nis"
                                                    placeholder="Masukan NIS" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row form-group" style="margin-bottom: 25px;">
                                            <div class="col col-md-3">
                                                <label for="nama" class="form-control-label">Nama Lengkap</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="nama" name="nama"
                                                    placeholder="Masukan Nama Lengkap" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="disabledSelect" class=" form-control-label">Kelas</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select name="id_kelas" id="id_kelas" disabled=""
                                                    class="form-control" required>
                                                    <option value="{{ $kelas->id_kelas }}">{{ $kelas->tingkat }}
                                                        {{ $kelas->jurusan->nama_jurusan }}
                                                        {{ $kelas->nomor_kelas }}</option>
                                                </select>
                                            </div>
                                            <input type="hidden" name="id_kelas" value="{{ $kelas->id_kelas }}">
                                        </div>
                                        {{-- <div class="row form-group" style="margin-bottom: 25px;">
                                                        <div class="col col-md-3">
                                                            <label for="email-input" class=" form-control-label">Kelas</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <select class="form-control selectpicker" data-live-search="true">
                                                                @foreach ($listkelas as $lk)
                                                                <option data-tokens="">{{ $lk->kelas }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div> --}}
                                        <div class="row form-group" style="margin-bottom: 25px;">
                                            <div class="col col-md-3">
                                                <label class="form-control-label">Jenis Kelamin</label>
                                            </div>
                                            <div class="col col-md-9">
                                                <div class="form-check-inline form-check">
                                                    <label for="inline-radio1" class="form-check-label mr-4">
                                                        <input type="radio" id="inline-radio1" name="jenis_kelamin"
                                                            value="laki laki" class="form-check-input">Laki - Laki
                                                    </label>
                                                    <label for="inline-radio2" class="form-check-label">
                                                        <input type="radio" id="inline-radio2" name="jenis_kelamin"
                                                            value="perempuan" class="form-check-input">Perempuan
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group" style="margin-bottom: 25px;">
                                            <div class="col col-md-3">
                                                <label for="nik" class="form-control-label">NIK</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="nik" name="nik"
                                                    placeholder="Masukan NIK" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row form-group" style="margin-bottom: 25px;">
                                            <div class="col col-md-3">
                                                <label for="nisn" class="form-control-label">NISN</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="nisn" name="nisn"
                                                    placeholder="Masukan NISN" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success"
                                            id="submitberhasil">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- End Modal Edit Siswa --}}
                </div>
                <div class="table-responsive m-b-40">
                    <table class="table table-borderless table-data3">
                        <thead>
                            <tr>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>JK</th>
                                <th>NIK</th>
                                <th>NISN</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $s)
                                <tr>
                                    <td>{{ $s->nis }}</td>
                                    <td>{{ $s->nama }}</td>
                                    <td>{{ $s->jenis_kelamin }}</td>
                                    <td>{{ $s->nik }}</td>
                                    <td>{{ $s->nisn }}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="{{ route('edit-siswa', $s->nis) }}">
                                                <button class="item mr-1" data-toggle="tooltip" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                            </a>
                                            <form action="{{ route('hapus-siswa', $s->nis) }}" method="POST">
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
