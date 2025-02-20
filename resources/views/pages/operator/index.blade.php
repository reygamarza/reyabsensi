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
                                <li class="list-inline-item">Lokasi Sekolah | Waktu Absen</li>
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
                    <h1 class="title-4 text-center">Setting Lokasi Sekolah dan Waktu Absen</h1>
                    <hr class="line-seprate">
                </div>
            </div>
        </div>
    </section>
    <!-- END WELCOME-->

    <!-- FORM -->
    <section class="py-4">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6">
                    <livewire:pages.operator.index.lokasi-sekolah />
                </div>
                <div class="col-md-6">
                    <livewire:pages.operator.index.waktu-absen />
                </div>
            </div>
        </div>
    </section>
    <!-- END FORM -->
@endsection
