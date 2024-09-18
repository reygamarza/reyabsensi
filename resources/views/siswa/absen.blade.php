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
                            <a href="siswa" class="fas fa-chevron-left" style="font-size: 40px; color: #393939;"></a>
                            <div style="flex: 1;">
                                <h1 class="title-4 text-center" style="margin-bottom: 0;">Ambil Foto Absen</h1>
                            </div>
                        </div>
                        <hr class="line-seprate">
                    </div>
                </div>
        </section>
        <!-- END WELCOME-->

        <!-- DASHBOARD INFO-->
        <section class="statistic">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-lg-5 mb-3">
                        <p class="mb-1 text-center">Tampilan Kamera / Hasil</p>
                        <div class="ambilfotowrapper">
                            <div class="webcam-container">
                                <div class="webcam-capture" id="webcamCapture"></div>
                                <img id="result" class="foto">
                                <canvas id="faceCanvas" style="position: absolute; top: 0; left: 0;"></canvas>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <button class="buttonfoto bg-info col-md-4 col-lg-4 mx-1" onclick="ambilFoto()">
                                <div class="button-content">
                                    <i class="fas fa-camera"></i>
                                    <h2>Ambil Gambar</h2>
                                </div>
                            </button>
                            <button class="buttonfoto bg-info col-md-4 col-lg-4 mx-1" onclick="ambilUlang()">
                                <div class="button-content">
                                    <i class="fas fa-redo-alt"></i>
                                    <h2>Ambil Ulang Gambar</h2>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-7">
                        <p class="mb-1 text-center"><b>Lokasi Anda Saat Ini</b></p>
                        <div class="statistic__item">
                            <div id="map"></div>
                            <p><i>*Pastikan kamu berada di dalam radius yang diizinkan (<
                                        {{ $koordinatsekolah->radius }}M)</i>
                            </p>
                            <form action="{{ route('ambil-absen') }}" method="POST">
                                @csrf
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <input type="hidden" id="faceConfidence" name="faceConfidence">
                                    <input id="lokasi" name="lokasi" type="hidden"></input>
                                    <input id="image" name="image" type="hidden"></input>
                                    <button id="ambilabsen" class="buttonfoto bg-success col-md-12 col-lg-12">
                                        <div class="button-content">
                                            <h2>Submit Bukti Absen</h2>
                                        </div>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END DASHBOARD INFO-->

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
<script src="{{ asset('assets/kesiswaan') }}/js/kamera.js"></script>
    <script>

        // lokasi
        var lokasi = document.getElementById('lokasi');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        }

        function successCallback(position) {
            lokasi.value = position.coords.latitude + ", " + position.coords.longitude;
            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 15);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            // Custom icon for user
            var userIcon = L.icon({
                iconUrl: '{{ asset('assets/kesiswaan') }}/images/icon/markersiswa.png',
                iconSize: [45, 45], // size of the icon
                iconAnchor: [19, 38], // point of the icon which will correspond to marker's location
                popupAnchor: [0, -38] // point from which the popup should open relative to the iconAnchor
            });

            // Custom icon for school
            var schoolIcon = L.icon({
                iconUrl: '{{ asset('assets/kesiswaan') }}/images/icon/markerschool.png',
                iconSize: [45, 45], // size of the icon
                iconAnchor: [19, 38], // point of the icon which will correspond to marker's location
                popupAnchor: [0, -38] // point from which the popup should open relative to the iconAnchor
            });

            var markerUser = L.marker([position.coords.latitude, position.coords.longitude], {
                icon: userIcon
            }).addTo(map);
            var markerSchool = L.marker([{{ $koordinatsekolah->titik_koordinat }}], {
                icon: schoolIcon
            }).addTo(map);
            var circle = L.circle([{{ $koordinatsekolah->titik_koordinat }}], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: {{ $koordinatsekolah->radius }}
            }).addTo(map);
        }

        function errorCallback(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    lokasi.innerHTML = "Izin untuk mendapatkan lokasi tidak diberikan oleh pengguna.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    lokasi.innerHTML = "Informasi lokasi tidak tersedia.";
                    break;
                case error.TIMEOUT:
                    lokasi.innerHTML = "Waktu permintaan lokasi habis.";
                    break;
                case error.UNKNOWN_ERROR:
                    lokasi.innerHTML = "Terjadi kesalahan yang tidak diketahui.";
                    break;
            }
        }
    </script>
@endpush
