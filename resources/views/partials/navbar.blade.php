<!-- HEADER DESKTOP-->
<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="#">
                    <img src="{{ asset('assets/kesiswaan') }}/images/icon/logoabas1.png" width="140px" height="auto"
                        alt="CoolAdmin" />
                </a>
            </div>
            <div class="header__navbar">
                <ul class="list-unstyled">
                    @if (Auth::user()->role == 'operator')
                        <li class="">
                            <a href="{{ route('operator.index') }}">
                                <i class="fa-solid fa-route"></i>Koordinat | Waktu Absen
                                <span class="bot-line"></span>
                            </a>
                        </li>
                        {{-- <li class="has-sub">
                                    <a href="#">
                                        <i class="fas fa-duotone fa-building-user"></i>Kelas | Jurusan
                                        <span class="bot-line"></span>
                                    </a>
                                    <ul class="header3-sub-list list-unstyled">
                                        <li>
                                            <a href="{{ route('kelas-O') }}">Daftar Kelas</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('jurusan-O') }}">Daftar Jurusan</a>
                                        </li>
                                    </ul>
                                </li> --}}
                        {{-- <li class="has-sub">
                                    <a href="#">
                                        <i class="fas fa-duotone fa-users-between-lines"></i>Daftar Pengguna
                                        <span class="bot-line"></span>
                                    </a>
                                    <ul class="header3-sub-list list-unstyled">
                                        <li>
                                            <a href="{{ route('kesiswaan-O') }}">Daftar Kesiswaan</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('wali-kelas-O') }}">Daftar Wali Kelas</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('wali-siswa-O') }}">Daftar Wali Siswa</a>
                                        </li>
                                    </ul>
                                </li> --}}
                    @elseif(Auth::user()->role == 'siswa')
                        {{-- <li>
                                    <a href="{{ route('siswa.index') }}">
                                        <i class="fas fa-tv"></i>Dashboard
                                        <span class="bot-line"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('rekap') }}">
                                        <i class="fas fa-duotone fa-book-open"></i>Rekap Absensi
                                        <span class="bot-line"></span>
                                    </a>
                                </li> --}}
                    @elseif(Auth::user()->role == 'kesiswaan')
                        {{-- <li>
                                    <a href="{{ route('kesiswaan.index') }}">
                                        <i class="fas fa-tv"></i>Dashboard
                                        <span class="bot-line"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('kesiswaan.kelas') }}">
                                        <i class="fas fa-duotone fa-book-open"></i>Laporan Absensi
                                        <span class="bot-line"></span>
                                    </a>
                                </li> --}}
                    @elseif(Auth::user()->role == 'waliKelas')
                        {{-- <li>
                                    <a href="{{ route('wali.index') }}">
                                        <i class="fas fa-tv"></i>
                                        <span class="bot-line"></span>Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('WaliKelas.siswa') }}">
                                        <i class="fas fa-duotone fa-book-open"></i>
                                        <span class="bot-line"></span>Laporan Absensi
                                    </a>
                                </li> --}}
                    @elseif(Auth::user()->role == 'waliSiswa')
                        {{-- <li class="has-sub">
                                    <a href="{{ route('walis.index') }}">
                                        <i class="fas fa-tv"></i>
                                        <span class="bot-line"></span>Dashboard
                                    </a>
                                </li>
                                <li class="has-sub">
                                    <a href="{{ route('laporan-WS') }}">
                                        <i class="fas fa-duotone fa-book-open"></i>
                                        <span class="bot-line"></span>Laporan Absensi
                                    </a>
                                </li> --}}
                    @endif
                </ul>
            </div>
            <div class="header__tool">
                <div class="header-button-item has-noti js-item-menu">
                    <i class="zmdi zmdi-notifications"></i>
                    <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown">
                        <div class="notifi__title">
                            <p>You have 3 Notifications</p>
                        </div>
                        <div class="notifi__item">
                            <div class="bg-c1 img-cir img-40">
                                <i class="zmdi zmdi-email-open"></i>
                            </div>
                            <div class="content">
                                <p>You got a email notification</p>
                                <span class="date">April 12, 2018 06:50</span>
                            </div>
                        </div>
                        <div class="notifi__item">
                            <div class="bg-c2 img-cir img-40">
                                <i class="zmdi zmdi-account-box"></i>
                            </div>
                            <div class="content">
                                <p>Your account has been blocked</p>
                                <span class="date">April 12, 2018 06:50</span>
                            </div>
                        </div>
                        <div class="notifi__item">
                            <div class="bg-c3 img-cir img-40">
                                <i class="zmdi zmdi-file-text"></i>
                            </div>
                            <div class="content">
                                <p>You got a new file</p>
                                <span class="date">April 12, 2018 06:50</span>
                            </div>
                        </div>
                        <div class="notifi__footer">
                            <a href="#">All notifications</a>
                        </div>
                    </div>
                </div>
                <div class="header-button-item js-item-menu">
                    <i class="zmdi zmdi-settings"></i>
                </div>
                <div class="account-wrap">
                    <div class="account-item account-item--style2 clearfix js-item-menu">
                        <div class="image">
                            <img src={{ asset('storage/uploads/foto_profil/' . Auth::user()->foto) }}
                                alt="Foto Profil" />
                        </div>
                        <div class="content">
                            <a class="js-acc-btn" href="#">{{ Auth::user()->nama }}</a>
                        </div>
                        <div class="account-dropdown js-dropdown">
                            <div class="info clearfix">
                                <div class="image">
                                    <a href="#">
                                        <img src={{ asset('storage/uploads/foto_profil/' . Auth::user()->foto) }}
                                            alt="Foto Profil" />
                                    </a>
                                </div>
                                <div class="content">
                                    <h5 class="name">
                                        <a href="#">{{ Auth::user()->nama }}</a>
                                    </h5>
                                    <span class="email">{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                            {{-- <div class="account-dropdown__body">
                                <div class="account-dropdown__item">
                                    <a href="{{ route('kesiswaan.profile') }}">
                                        <i class="zmdi zmdi-account"></i>Profile</a>
                                </div>
                            </div> --}}
                            <div class="account-dropdown__footer">
                                <a href="{{ route('logout') }}" class="dropdown-item zmdi zmdi-power"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    <i class="icon-key"></i>
                                    <span class="ml-2">Logout </span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- END HEADER DESKTOP-->

{{-- <!-- HEADER MOBILE-->
<header class="header-mobile header-mobile-2 d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="index.html">
                    <img src="{{ asset('assets/kesiswaan') }}/images/icon/logoabas1.png" width="140px" height="auto"
                        alt="CoolAdmin" />
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li>
                    <a href="{{ route('kesiswaan.index') }}">
                        <i class="fas fa-tv"></i>Dashboard
                        <span class="bot-line"></span>
                    </a>
                </li>
                <li class="">
                    <a href="{{ route('kesiswaan.kelas') }}">
                        <i class="fas fa-duotone fa-book-open"></i>Rekap Absensi
                        <span class="bot-line"></span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="sub-header-mobile-2 d-block d-lg-none">
    <div class="header__tool">
        <div class="header-button-item has-noti js-item-menu">
            <i class="zmdi zmdi-notifications"></i>
        </div>
        <div class="header-button-item js-item-menu">
            <i class="zmdi zmdi-settings"></i>
        </div>
        <div class="account-wrap">
            <div class="account-item account-item--style2 clearfix js-item-menu">
                <div class="image">
                    <img src={{ asset('storage/uploads/foto_profil/' . Auth::user()->foto) }} alt="Foto Profil" />
                </div>
                <div class="content">
                    <a class="js-acc-btn" href="#">{{ Auth::user()->nama }}</a>
                </div>
                <div class="account-dropdown js-dropdown">
                    <div class="info clearfix">
                        <div class="image">
                            <a href="#">
                                <img src={{ asset('storage/uploads/foto_profil/' . Auth::user()->foto) }}
                                    alt="Foto Profil" />
                            </a>
                        </div>
                        <div class="content">
                            <h5 class="name">
                                <a href="#">{{ Auth::user()->nama }}</a>
                            </h5>
                            <span class="email">{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                    <div class="account-dropdown__body">
                        <div class="account-dropdown__item">
                            <a href="{{ route('kesiswaan.profile') }}">
                                <i class="zmdi zmdi-account"></i>Profile</a>
                        </div>
                    </div>
                    <div class="account-dropdown__footer">
                        <a href="{{ route('logout') }}" class="dropdown-item zmdi zmdi-power"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            <i class="icon-key"></i>
                            <span class="ml-2">Logout </span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END HEADER MOBILE --> --}}
