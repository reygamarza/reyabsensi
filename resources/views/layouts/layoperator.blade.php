<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>ABAS | {{ $title }} </title>

    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Fontfaces CSS-->
    <link href="{{ asset('assets/kesiswaan') }}/css/font-face.css" rel="stylesheet" media="all">
    <link href="{{ asset('assets/kesiswaan') }}/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet"
        media="all">
    <link href="{{ asset('assets/kesiswaan') }}/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet"
        media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('assets/kesiswaan') }}/vendor/mdi-font/css/material-design-iconic-font.min.css"
        rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('assets/kesiswaan') }}/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">


    <!-- Vendor CSS-->
    <link href="{{ asset('assets/kesiswaan') }}/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="{{ asset('assets/kesiswaan') }}/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css"
        rel="stylesheet" media="all">
    <link href="{{ asset('assets/kesiswaan') }}/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="{{ asset('assets/kesiswaan') }}/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet"
        media="all">
    <link href="{{ asset('assets/kesiswaan') }}/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="{{ asset('assets/kesiswaan') }}/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="{{ asset('assets/kesiswaan') }}/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet"
        media="all">

    <!-- Main CSS-->
    <link href="{{ asset('assets/kesiswaan') }}/css/theme.css" rel="stylesheet" media="all">
    <link rel="shortcut icon" href="{{ asset('assets/kesiswaan') }}/images/icon/iconabas.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <style>
        #map {
            height: 300px;
            border-radius: 10px;
        }
    </style>

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop3 d-none d-lg-block">
            <div class="section__content section__content--p35">
                <div class="header3-wrap">
                    <div class="header__logo">
                        <a href="#">
                            <img src="{{ asset('assets/kesiswaan') }}/images/icon/logoabas1.png" width="140px"
                                height="auto" alt="CoolAdmin" />
                        </a>
                    </div>
                    <div class="header__navbar">
                        <ul class="list-unstyled">
                            <li class="">
                                <a href="{{ route('operator.index') }}">
                                    <i class="fa-solid fa-route"></i>Koordinat | Waktu Absen
                                    <span class="bot-line"></span>
                                </a>
                            </li>
                            <li class="has-sub">
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
                            </li>
                            <li class="has-sub">
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
                            </li>
                        </ul>
                    </div>
                    <div class="header__tool">
                        <div class="header-button-item has-noti js-item-menu">
                            <i class="zmdi zmdi-notifications"></i>
                            <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown">
                                <div class="notifi__title">
                                    <p>You have 3 Notifications</p>
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
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="{{ route('profile-O') }}">
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
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
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

        <!-- HEADER MOBILE-->
        <header class="header-mobile header-mobile-2 d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="{{ asset('assets/kesiswaan') }}/images/icon/logoabas1.png" width="140px"
                                height="auto" alt="ABAS" />
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
                            <a href="{{ route('operator.index') }}">
                                <i class="fa-solid fa-route"></i>Koordinat | Waktu Absen</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Kelas | Jurusan</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="{{ route('kelas-O') }}">Daftar Kelas</a>
                                </li>
                                <li>
                                    <a href="{{ route('jurusan-O') }}">Daftar Jurusan</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-duotone fa-users-between-lines"></i>Daftar Pengguna</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
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
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="sub-header-mobile-2 d-block d-lg-none">
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
                            <div class="account-dropdown__body">
                                <div class="account-dropdown__item">
                                    <a href="{{ route('profile-O') }}">
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
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END HEADER MOBILE -->
        @yield('content')

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }

                @if (Session::has('berhasil'))
                    toastr.success("{{ Session::get('berhasil') }}");
                @endif

                @if (Session::has('gagal'))
                    toastr.error("{{ Session::get('gagal') }}");
                @endif
            });
        </script>

        <!-- Jquery JS-->
        <script src="{{ asset('assets/kesiswaan') }}/vendor/jquery-3.2.1.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- Bootstrap JS-->
        <script src="{{ asset('assets/kesiswaan') }}/vendor/bootstrap-4.1/popper.min.js"></script>
        <script src="{{ asset('assets/kesiswaan') }}/vendor/bootstrap-4.1/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
        <!-- Vendor JS       -->
        <script src="{{ asset('assets/kesiswaan') }}/vendor/slick/slick.min.js"></script>
        <script src="{{ asset('assets/kesiswaan') }}/vendor/wow/wow.min.js"></script>
        <script src="{{ asset('assets/kesiswaan') }}/vendor/animsition/animsition.min.js"></script>
        <script src="{{ asset('assets/kesiswaan') }}/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <script src="{{ asset('assets/kesiswaan') }}/vendor/counter-up/jquery.waypoints.min.js"></script>
        <script src="{{ asset('assets/kesiswaan') }}/vendor/counter-up/jquery.counterup.min.js"></script>
        <script src="{{ asset('assets/kesiswaan') }}/vendor/circle-progress/circle-progress.min.js"></script>
        <script src="{{ asset('assets/kesiswaan') }}/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="{{ asset('assets/kesiswaan') }}/vendor/chartjs/Chart.bundle.min.js"></script>
        <script src="{{ asset('assets/kesiswaan') }}/vendor/select2/select2.min.js"></script>

        <!-- Main JS-->
        <script src="{{ asset('assets/kesiswaan') }}/js/main.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
            integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        @livewireScripts

        @stack('myscript')
</body>

</html>
<!-- end document-->
