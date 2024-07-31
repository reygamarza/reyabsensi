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
                        <div style="display: flex; align-items: center; justify-content: center;">
                            <a href="siswa" class="fas fa-chevron-left" style="font-size: 40px; color: #393939;"></a>
                            <div style="flex: 1;">
                                <h1 class="title-4 text-center" style="margin-bottom: 0;">Ambil Foto Absen Masuk</h1>
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
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <button class="buttonfoto bg-info col-md-4 col-lg-4 mx-1" onclick="bukaKamera()">
                                <div class="button-content">
                                    <i class="fas fa-circle-play"></i>
                                    <h2>Mulai Kamera</h2>
                                </div>
                            </button>
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
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <input id="lokasi" style="flex: 0.9; padding-right: 10px;" disabled></input>
                                <button id="ambilabsen" class="buttonfoto bg-success col-md-6 col-lg-6">
                                    <div class="button-content">
                                        <h2>Submit Bukti Absen</h2>
                                    </div>
                                </button>
                            </div>
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


@push('myscript')
    <script>
        let image = '';
        let isCameraOn = false;

        function bukaKamera() {
            if (!isCameraOn) {
                Webcam.set({
                    height: 385,
                    width: 520,
                    image_format: 'jpeg',
                    jpeg_quality: 90,
                    flip_horiz: true
                });
                Webcam.attach('#webcamCapture');
                isCameraOn = true;
            }
        }

        function ambilFoto() {
            if (isCameraOn) {
                Webcam.snap(function(data_uri) {
                    image = data_uri;
                    document.getElementById('result').src = data_uri;
                    document.getElementById('webcamCapture').style.display = 'none'; // Sembunyikan tampilan kamera
                    document.getElementById('result').style.display = 'block'; // Tampilkan hasil foto
                    isCameraOn = false;
                });
            }
        }

        function ambilUlang() {
            document.getElementById('result').src = '';
            document.getElementById('result').style.display = 'none'; // Sembunyikan hasil foto
            document.getElementById('webcamCapture').style.display = 'block'; // Tampilkan kembali tampilan kamera
            bukaKamera();
        }

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
            var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
            var circle = L.circle([-6.890514063926338, 107.55833180504669], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: 200
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

        $("#ambilabsen").click(function(e) {
            e.preventDefault(); // Prevent the default form submission
            var lokasi = $('#lokasi').val();
            $.ajax({
                type: 'POST',
                url: '{{ route('ambil-absen') }}', // Use the route name
                data: {
                    _token: "{{ csrf_token() }}",
                    image: image,
                    lokasi: lokasi
                },
                cache: false,
                success: function(response) {
                    if (response.success) {

                        toastr.success(response.message);

                        setTimeout(function() {
                            window.location.href = "{{ route('siswa.index') }}";
                        }, 2000);


                    }
                },
                error: function(response) {
                    if (response.error) {

                        toastr.error(response.message);

                        setTimeout(function() {
                            window.location.href = "{{ route('ambil-absen') }}";
                        }, 2000);
                    }
                }
            });
        });
    </script>
@endpush
