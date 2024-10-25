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
                                        <a href="#">> </a>
                                    </li>
                                    <li class="list-inline-item">Kelas | Jurusan / Daftar Kelas / Daftar Siswa</li>
                                </ul>
                            </div>
                            {{-- <div class="au-form-icon--sm">
                                <input class="au-input--w300 au-input--style2" type="text" placeholder="Cari Wali Kelas" wire:model.live.debounce="searchwali">
                                <button class="au-btn--submit2" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </div> --}}
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
                            <a href="{{ url()->previous() }}" class="fas fa-chevron-left" style="font-size: 40px; color: #393939;"></a>
                            <div style="flex: 1;">
                                <h1 class="title-4 text-center" style="margin-bottom: 0;">Daftar Siswa {{ $kelas->tingkat }} {{ $kelas->jurusan->id_jurusan }} {{ $kelas->nomor_kelas }}</h1>
                            </div>
                        </div>
                        <hr class="line-seprate">
                    </div>
                </div>
        </section>
        <!-- END WELCOME-->

        @livewire('lsiswa', ['id_kelas' => $id_kelas])

        <!-- COPYRIGHT-->
        <section class="p-t-60 p-b-20">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright">

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END COPYRIGHT-->
    </div>

    </div>
@endsection
