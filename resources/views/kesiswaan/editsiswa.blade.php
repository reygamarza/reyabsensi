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
                                    <li class="list-inline-item">Daftar Siswa</li>
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
                        <div style="display: flex; align-items: center; justify-content: center;">
                            <a href="{{ route('list-kelas') }}" class="fa-solid fa-left-long"
                                style="font-size: 50px; color: #393939;"></a>
                            <div style="flex: 1;">
                                <h1 class="title-4 text-center" style="margin-bottom: 0;">Edit Data Siswa </h1>
                            </div>
                        </div>
                        <hr class="line-seprate">
                    </div>
                </div>
            </div>
        </section>
        <!-- END WELCOME-->

        <section class="p-t-20">
            <div class="container">
                <div class="row justify-content-center mt-2">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header"></div>
                            <form action="{{ route('update-siswa', $siswa->nis) }}" method="POST" class="form-horizontal">
                                @csrf
                                @method('PUT')

                                <div class="card-body card-block">
                                    <div class="row form-group" style="margin-bottom: 25px;">
                                        <div class="col col-md-3">
                                            <label for="nis" class="form-control-label">NIS</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="nis" name="nis" placeholder="Masukan NIS"
                                                class="form-control" required value="{{ $siswa->nis }}" disabled>
                                        </div>
                                        <input type="hidden" name="nis" value="{{ $siswa->nis }}">
                                    </div>
                                    <div class="row form-group" style="margin-bottom: 25px;">
                                        <div class="col col-md-3">
                                            <label for="nama" class="form-control-label">Nama Lengkap</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="nama" name="nama"
                                                placeholder="Masukan Nama Lengkap" class="form-control" required
                                                value="{{ $siswa->nama }}">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="disabledSelect" class=" form-control-label">Kelas</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select name="id_kelas" id="id_kelas" disabled="" class="form-control"
                                                required>
                                                @foreach ($kelas as $k)
                                                    <option value="{{ $k->id_kelas }}"
                                                        {{ $k->id_kelas == $siswa->id_kelas ? 'selected' : '' }}>
                                                        {{ $k->tingkat }} {{ $k->jurusan->nama_jurusan }}
                                                        {{ $k->nomor_kelas }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" name="id_kelas" value="{{ $siswa->id_kelas }}">
                                    </div>
                                    <div class="row form-group" style="margin-bottom: 25px;">
                                        <div class="col col-md-3">
                                            <label class="form-control-label">Jenis Kelamin</label>
                                        </div>
                                        <div class="col col-md-9">
                                            <div class="form-check-inline form-check">
                                                <label for="inline-radio1" class="form-check-label mr-4">
                                                    <input type="radio" id="inline-radio1" name="jenis_kelamin"
                                                        value="laki laki" class="form-check-input"
                                                        {{ $siswa->jenis_kelamin == 'laki laki' ? 'checked' : '' }}>Laki -
                                                    Laki
                                                </label>
                                                <label for="inline-radio2" class="form-check-label">
                                                    <input type="radio" id="inline-radio2" name="jenis_kelamin"
                                                        value="perempuan" class="form-check-input"
                                                        {{ $siswa->jenis_kelamin == 'perempuan' ? 'checked' : '' }}>Perempuan
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group" style="margin-bottom: 25px;">
                                        <div class="col col-md-3">
                                            <label for="nik" class="form-control-label">NIK</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="nik" name="nik" placeholder="Masukan NIK"
                                                class="form-control" required value="{{ $siswa->nik }}">
                                        </div>
                                    </div>
                                    <div class="row form-group" style="margin-bottom: 25px;">
                                        <div class="col col-md-3">
                                            <label for="nisn" class="form-control-label">NISN</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="nisn" name="nisn"
                                                placeholder="Masukan NISN" class="form-control" required
                                                value="{{ $siswa->nisn }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer justify-content-end">
                                    <button type="reset" class="btn btn-danger btn-sm">
                                        <i class="fa fa-ban"></i> Reset
                                    </button>
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fa fa-dot-circle-o"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>


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
