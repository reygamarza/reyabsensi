@extends('layouts.app')

@section('title', 'Alamat Sekolah dan Waktu Absen')

@section('content')
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
                                <li class="list-inline-item">Koordinat | Waktu Absen</li>
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
                    <h1 class="title-4 text-center">Setting Alamat Sekolah dan Waktu Absen</h1>
                    <hr class="line-seprate">
                </div>
            </div>
        </div>
    </section>
    <!-- END WELCOME-->

    <!-- INPUT BOXES -->
    <section class="p-t-20 p-b-20">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="statistic__item">
                        {{-- @livewire('jamabsen') --}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="statistic__item">
                        <h3 class="title-5 m-b-25 text-center">Koordinat Sekolah</h3>
                        {{-- @livewire('koordinat') --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END INPUT BOXES -->
@endsection
