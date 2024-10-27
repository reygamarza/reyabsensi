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
    <title>ABAS | </title>

    <!-- Fontfaces CSS-->
    <link href="{{asset ("assets/kesiswaan")}}/css/font-face.css" rel="stylesheet" media="all">
    <link href="{{asset ("assets/kesiswaan")}}/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="{{asset ("assets/kesiswaan")}}/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="{{asset ("assets/kesiswaan")}}/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Bootstrap CSS-->
    <link href="{{asset ("assets/kesiswaan")}}/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{asset ("assets/kesiswaan")}}/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="{{asset ("assets/kesiswaan")}}/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="{{asset ("assets/kesiswaan")}}/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="{{asset ("assets/kesiswaan")}}/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="{{asset ("assets/kesiswaan")}}/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="{{asset ("assets/kesiswaan")}}/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="{{asset ("assets/kesiswaan")}}/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset ("assets/kesiswaan")}}/css/theme.css" rel="stylesheet" media="all">
    <link rel="shortcut icon" href="{{asset ("assets/kesiswaan")}}/images/icon/iconabas.png">
    <style>
        .card-header {
            background-color: #393939;
        }
        .attendance-item {
            border-left: 4px solid #393939;
            bor
            background-color: #f8f9fa;
            margin-bottom: 10px;
            padding: 10px;
        }
        .attendance-item i {
            margin-right: 10px;
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
                            <img src="{{asset ("assets/kesiswaan")}}/images/icon/logoabas1.png" width="140px" height="auto" alt="CoolAdmin" />
                        </a>
                    </div>
                    <div class="header__navbar">
                        <ul class="list-unstyled">
                            <li class="has-sub">
                                <a href="{{ route('wali.index') }}">
                                    <i class="fas fa-tv"></i>
                                    <span class="bot-line"></span>Dashboard
                                </a>
                            </li>
                            <li class="has-sub">
                                <a href="{{ route('laporan-WS') }}">
                                    <i class="fas fa-duotone fa-book-open"></i>
                                    <span class="bot-line"></span>Laporan Absensi
                                </a>
                            </li>
                        </ul>
                    </div>
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
                                            <a href="{{ route('profile-WS') }}">
                                                <i class="zmdi zmdi-account"></i>Profile</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__footer">
                                        <a href="{{ route('logout') }}" class="dropdown-item zmdi zmdi-power" onclick="event.preventDefault();
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
                            <a href="{{ route('siswa.index') }}">
                                <i class="fas fa-tv"></i>Dashboard
                                <span class="bot-line"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="sub-header-mobile-2 d-block d-lg-none">
            <div class="header__tool">
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
                                    <a href="{{ route('profile') }}">
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
                @if (Session::has('berhasil'))
                    Swal.fire({
                        icon: "success",
                        title: "Terima Kasih! 🙂",
                        text: "{{ Session::get('berhasil') }}",
                    });
                @endif

                @if (Session::has('gagal'))
                    Swal.fire({
                        icon: "error",
                        title: "weeladalahh 😮",
                        text: "{{ Session::get('gagal') }}",
                    });
                @endif
            });
        </script>

    <!-- Jquery JS-->
    <script src="{{asset ("assets/kesiswaan")}}/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="{{asset ("assets/kesiswaan")}}/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="{{asset ("assets/kesiswaan")}}/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="{{asset ("assets/kesiswaan")}}/vendor/slick/slick.min.js"></script>
    <script src="{{asset ("assets/kesiswaan")}}/vendor/wow/wow.min.js"></script>
    <script src="{{asset ("assets/kesiswaan")}}/vendor/animsition/animsition.min.js"></script>
    <script src="{{asset ("assets/kesiswaan")}}/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="{{asset ("assets/kesiswaan")}}/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="{{asset ("assets/kesiswaan")}}/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="{{asset ("assets/kesiswaan")}}/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="{{asset ("assets/kesiswaan")}}/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{asset ("assets/kesiswaan")}}/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="{{asset ("assets/kesiswaan")}}/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="{{asset ("assets/kesiswaan")}}/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('myscript')


</body>

</html>
<!-- end document-->
