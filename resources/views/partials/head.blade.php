<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ ucwords(preg_replace('/([a-z])([A-Z])/', '$1 $2', Auth::user()->role)) }} | @yield('title', 'MyApp')</title>

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
<link href="{{ asset('assets/kesiswaan') }}/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet"
    media="all">

<!-- Bootstrap CSS-->
<link href="{{ asset('assets/kesiswaan') }}/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">


<!-- Vendor CSS-->
<link href="{{ asset('assets/kesiswaan') }}/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
<link href="{{ asset('assets/kesiswaan') }}/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css"
    rel="stylesheet" media="all">
<link href="{{ asset('assets/kesiswaan') }}/vendor/wow/animate.css" rel="stylesheet" media="all">
<link href="{{ asset('assets/kesiswaan') }}/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
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

@livewireStyles
