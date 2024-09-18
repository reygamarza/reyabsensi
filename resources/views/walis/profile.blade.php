@extends('layouts.laywalis')

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
                                    <li class="list-inline-item">Profil</li>
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
                    <div class="col-md-12 text-center">
                        <h1 class="title-4">Profil Anda
                        </h1>
                        <hr class="line-seprate">
                    </div>
                </div>
            </div>
        </section>
        <!-- END WELCOME-->

        <section class="profil">
            <div class="container mt-4">
                <div class="row">
                    <!-- Profil Siswa -->
                    <div class="col-md-4 mb-4">
                        <div class="au-card p-4 text-center shadow-sm">
                            <img src="{{ asset('storage/uploads/foto_profil/' . $ortu->user->foto) }}" alt="Foto Profil" class="rounded-circle mb-3" width="150px" height="150px" style="object-fit: cover;">
                            <h5 class="font-weight-bold">{{ $ortu->user->nama }}</h5>
                            <p class="text-muted">{{ $ortu->user->email }}</p>

                            <div class="mt-3">
                                <button class="btn btn-outline-primary" onclick="document.getElementById('uploadFoto').click();">
                                    Ganti Foto Profil
                                </button>
                                <!-- Menampilkan Nama File yang Dipilih -->
                                <span id="namaFile" class="ml-2 text-muted"></span>
                            </div>

                            <!-- Input File yang Disembunyikan -->
                        </div>
                    </div>
                    <!-- Form Edit Profil -->
                    <div class="col-md-8">
                        <div class="au-card p-4 shadow-sm">
                            <form action="{{ route('edit-profile-WS') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <input type="file" id="uploadFoto" name="foto" style="display: none;" accept="image/*" onchange="tampilkanNamaFile()">
                            <div class="row form-group mb-3">
                                <div class="col-lg-12">
                                    <label for="nama" class="form-control-label"><b>Nama Lengkap</b></label>
                                    <input type="text" id="nama" name="nama" placeholder="Masukan Nama Lengkap" class="form-control" value="{{ $ortu->user->nama }}" required disabled>
                                </div>
                            </div>
                            <div class="row form-group mb-3">
                                <div class="col-lg-12">
                                    <label for="nik" class="form-control-label"><b>NIK</b></label>
                                    <input type="text" id="nik" name="nik" placeholder="Masukan NIK" class="form-control" value="{{ $ortu->nik }}" required disabled>
                                </div>
                            </div>
                            <div class="row form-group mb-3">
                                <div class="col-lg-12">
                                    <label for="email" class="form-control-label"><b>Email</b></label>
                                    <input type="email" id="email" name="email" placeholder="Masukan Email" class="form-control" value="{{ $ortu->user->email }}" required>
                                </div>
                            </div>
                            <div class="row form-group mb-3">
                                <div class="col-lg-12">
                                    <label for="password" class="form-control-label"><b>Password</b></label>
                                    <input type="password" id="password" name="password" placeholder="Masukan Password Baru" class="form-control">
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
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

                </div>
            </div>
        </section>
        <!-- END COPYRIGHT-->
    </div>
@endsection

@push('myscript')

<script>
    function tampilkanNamaFile() {
        var input = document.getElementById('uploadFoto');
        var namaFile = input.files[0] ? input.files[0].name : 'Tidak ada file yang dipilih';
        document.getElementById('namaFile').textContent = namaFile;
    }
</script>
@endpush

