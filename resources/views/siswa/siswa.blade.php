@extends('layouts.laysiswa')

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
                                    <li class="list-inline-item">Dashboard</li>
                                </ul>
                            </div>
                            <form class="au-form-icon--sm" action="" method="post">
                                <input class="au-input--w300 au-input--style2" type="text" placeholder="Search">
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
                        <h1 class="title-4">Selamat Datang
                            <span>Satria Galam Pratama!</span>
                        </h1>
                        <hr class="line-seprate">
                    </div>
                </div>
            </div>
        </section>
        <!-- END WELCOME-->

<!-- DASHBOARD INFO-->
<section class="statisticS">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-lg-3">
                <div class="statistic_siswa">
                    <h2 class="number" id="date">Senin 15 September 2024</h2>
                    <span class="desc">Tanggal</span>
                    <div class="icon">
                        <i class="fa-solid fa-calendar-days text-success"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3">
                <div class="statistic_siswa">
                    <h2 class="clock">
                        <ul>
                            <li id="jam">05</li>
                            <li id="point">:</li>
                            <li id="menit">20</li>
                            <li id="point">:</li>
                            <li id="detik">30</li>
                          </ul>
                    </h2>
                    <span class="desc">Jam</span>
                    <div class="icon">
                        <i class="fa-regular fa-clock text-warning"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3">
                <div class="statistic_siswa">
                    <h2 class="number">322 M</h2>
                    <span class="desc">Radius Dari Lokasi</span>
                    <div class="icon">
                        <i class="fa-solid fa-route text-danger"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3">
                <div class="statistic_siswa">
                    <h2 class="number">{{ $statusAbsen }}</h2>
                    <span class="desc">Keterangan Kehadiran</span>
                    <div class="icon">
                        <i class="fa-solid fa-user-check" style="color: #007bff"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END DASHBOARD INFO-->

<!-- Absen -->
<section class="absen">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-6">
                @if ($absenPulang)
                <a class="absen_item bg-secondary">
                    <div class="icon">
                        <div class="iconwrapper">
                            <i class="fa-solid fa-person-circle-check text-light"></i>
                            <p class="number">Absen Masuk</p>
                        </div>
                    </div>
                    <div class="textabsen">
                        <div class="textwrapperabsen">
                            <h2 class="number">Batas Absen</h2>
                            <h2 class="number">06 : 00 - 07:00 WIB</h2>
                        </div>
                    </div>
                </a>
                @elseif ($absenMasuk)
                <a href="{{ route('absen-masuk') }}" class="absen_item bg-danger">
                    <div class="icon">
                        <div class="iconwrapper">
                            <i class="fa-solid fa-person-circle-check text-light"></i>
                            <p class="number">Absen Pulang</p>
                        </div>
                    </div>
                    <div class="textabsen">
                        <div class="textwrapperabsen">
                            <h2 class="number">Batas Absen</h2>
                            <h2 class="number">16 : 00 - 20:00 WIB</h2>
                        </div>
                    </div>
                </a>
                @else
                <a href="{{ route('absen-masuk') }}" class="absen_item bg-success">
                    <div class="icon">
                        <div class="iconwrapper">
                            <i class="fa-solid fa-person-circle-check text-light"></i>
                            <p class="number">Absen Masuk</p>
                        </div>
                    </div>
                    <div class="textabsen">
                        <div class="textwrapperabsen">
                            <h2 class="number">Batas Absen</h2>
                            <h2 class="number">06 : 00 - 07:00 WIB</h2>
                        </div>
                    </div>
                </a>
                @endif
            </div>
            <div class="col-md-6 col-lg-6">
                @if ($cekabsen > 0)
                <a class="absen_item bg-secondary">
                @else
                <a href="" class="absen_item bg-primary">
                @endif
                    <div class="icon">
                        <div class="iconwrapper">
                            <i class="fa-solid fa-person-circle-xmark text-light"></i>
                            <p class="number">Izin / Sakit</p>
                        </div>
                    </div>
                    <div class="textabsen">
                        <div class="textwrapperabsen">
                            <h2 class="number">Mengisi Form Tidak Hadir</h2>
                            <h2 class="number">Karena Alasan Tertentu</h2>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- END Absen -->



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



