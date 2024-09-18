@extends('layouts.layoperator')

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
                            <img src="{{ asset('assets/kesiswaan') }}/images/icon/admin.jpg"
                            alt="Operator" class="rounded-circle mb-3" width="150px" height="150px" style="object-fit: cover;" />
                            <h5 class="font-weight-bold">{{ $operator->nama }}</h5>
                            <p class="text-muted">{{ $operator->email }}</p>
                        </div>
                    </div>
                    <!-- Form Edit Profil -->
                    <div class="col-md-8">
                        <div class="au-card p-4 shadow-sm">
                            <form action="{{ route('edit-profile-O') }}" method="POST">
                                @csrf
                            <div class="row form-group mb-3">
                                <div class="col-lg-12">
                                    <label for="nama" class="form-control-label"><b>Nama</b></label>
                                    <input type="text" id="nama" name="nama" placeholder="Masukan Nama" class="form-control" value="{{ $operator->nama }}" required>
                                </div>
                            </div>
                            <div class="row form-group mb-3">
                                <div class="col-lg-12">
                                    <label for="email" class="form-control-label"><b>Email</b></label>
                                    <input type="email" id="email" name="email" placeholder="Masukan Email" class="form-control" value="{{ $operator->email }}" required>
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
                    <div class="col-md-12">
                        <div class="copyright">
                            <p>Copyright © 2024 ABAS. All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END COPYRIGHT-->
    </div>
@endsection


