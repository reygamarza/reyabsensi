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
                            <h2 class="number" id="distance">322 M</h2>
                            <input type="hidden" name="lokasi" id="lokasi">
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
                        @if ($absenPulang || $validasijam || $cekabsen > 0)
                            <a class="absen_item bg-secondary">
                                <div class="icon">
                                    <div class="iconwrapper">
                                        <i class="fa-solid fa-person-circle-check text-light"></i>
                                        <p class="number">Mantap!</p>
                                    </div>
                                </div>
                                <div class="textabsen">
                                    <div class="textwrapperabsen">
                                        <h2 class="number">Selamat beristirahat dan sampai jumpa besok!</h2>
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
                                        <h2 class="number">{{ \Carbon\Carbon::parse($jam->jam_pulang)->format('H : i') }} -
                                            {{ \Carbon\Carbon::parse($jam->batas_absen_pulang)->format('H : i') }} WIB</h2>
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
                                        <h2 class="number">{{ \Carbon\Carbon::parse($jam->jam_absen)->format('H : i') }} -
                                            {{ \Carbon\Carbon::parse($jam->batas_absen_masuk)->format('H : i') }} WIB</h2>
                                    </div>
                                </div>
                            </a>
                        @endif
                    </div>
                    <div class="col-md-6 col-lg-6">
                        @if ($cekabsen > 0 || $validasijam)
                            <a class="absen_item bg-secondary">
                            @else
                                <a href="" data-toggle="modal" data-target="#FormulirModal"
                                    class="absen_item bg-primary">
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

        <!-- Modal Formulir-->
        <div class="modal fade" id="FormulirModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" style="border-radius: 10px">
                    <div class="modal-header">
                        <h5 class="modal-title fw-light" id="largeModalLabel">
                            <strong>Formulir Keterangan</strong>
                            <small>Izin/Sakit</small>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('upload-file') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label">Status Kehadiran</label>
                                </div>
                                <div class="col col-md-9">
                                    <div class="form-check-inline form-check">
                                        <label for="inline-radio1" class="form-check-label mr-4">
                                            <input type="radio" id="inline-radio1" name="status" value="sakit"
                                                class="form-check-input" required>Sakit
                                        </label>
                                        <label for="inline-radio2" class="form-check-label">
                                            <input type="radio" id="inline-radio2" name="status" value="izin"
                                                class="form-check-input" required>Izin
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label">Kirim File</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="file" class="form-control" name="photo_in" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="keterangan" class="form-control-label">Keterangan</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="keterangan" name="keterangan" placeholder="..."
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal Formulir-->
        <section class="riwayatkehadiran p-t-50">
            <div class="container">
                <h3 class="title-5 m-b-35 text-center">Riwayat Kehadiran Anda <strong>Bulan Ini</strong></h3>
                <div class="row">
                    {{-- <div class="col-md-8 text-center">
                        <div class="table-responsive table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Absen Masuk</th>
                                        <th>Absen Pulang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($riwayatkehadiran as $rk)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($rk->date)->format('Y - m - d') }}</td>
                                            <td>
                                                @if ($rk->status == 'Hadir')
                                                    <span class="status hadir">{{ $rk->status }}</span>
                                                @elseif ($rk->status == 'Sakit' || $rk->status == 'Izin')
                                                    <span class="status izin">{{ $rk->status }}</span>
                                                @elseif ($rk->status == 'Terlambat')
                                                    <span class="status terlambat">{{ $rk->status }}</span>
                                                @elseif ($rk->status == 'TAP')
                                                    <span class="status tap">{{ $rk->status }}</span>
                                                @elseif ($rk->status == 'Alfa')
                                                    <span class="status alfa">{{ $rk->status }}</span>
                                                @else
                                                    {{ $rk->status }}
                                                @endif

                                            </td>
                                            <td>
                                                @if ($rk->jam_masuk)
                                                    {{ \Carbon\Carbon::parse($rk->jam_masuk)->format('H : i : s') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($rk->jam_pulang)
                                                    {{ \Carbon\Carbon::parse($rk->jam_pulang)->format('H : i : s') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $riwayatkehadiran->links('pagination::bootstrap-4') }}
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>

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
        // Register the plugin if needed

        // Initialize FilePond


        document.addEventListener('DOMContentLoaded', function() {
            // FilePond.registerPlugin(FilePondPluginImagePreview);

            // const pond = FilePond.create(document.querySelector('input[id="file"]'), {
            //     allowImagePreview: true,
            //     imagePreviewMaxHeight: 100,
            //     allowMultiple: false,
            //     instantUpload: false,
            //     acceptedFileTypes: ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'],
            // });

            // // Handle form submission
            // const form = document.getElementById('uploadForm');
            // form.addEventListener('submit', function(event) {
            //     event.preventDefault();

            //     const formData = new FormData(form);

            //     // Add files from FilePond to FormData
            //     const files = pond.getFiles();
            //     files.forEach(fileItem => {
            //         formData.append('file', fileItem.file);
            //     });

            //     // Send form data with AJAX
            //     fetch('{{ route('upload-file') }}', {
            //             method: 'POST',
            //             body: formData,
            //             headers: {
            //                 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            //             }
            //         })
            //         .then(response => response.json())
            //         .then(data => {
            //             if (data.success) {
            //                 alert('File berhasil diupload!');
            //                 // Optionally, redirect or update UI
            //             } else {
            //                 alert('Gagal mengupload file.');
            //             }
            //         })
            //         .catch(error => {
            //             console.error('Error:', error);
            //         });
            // });
            var ctx = document.getElementById("pieChart");
            if (ctx) {
                ctx.height = 275;
                var chartriwayatkehadiran = @json($chartriwayatkehadiran);

                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        datasets: [{
                            data: Object.values(chartriwayatkehadiran),
                            backgroundColor: [
                                "#57b846", // Hadir
                                "#ffc107", // Terlambat
                                "#fa4251", // Alfa
                                "#ff8300", // Sakit/Izin
                                "#00b5e9", // TAP
                            ],
                            hoverBackgroundColor: [
                                "#3a9d3f",
                                "#e6b700",
                                "#e23e3e",
                                "#e57c00",
                                "#0092d9",
                            ]
                        }],
                        labels: Object.keys(chartriwayatkehadiran)
                    },
                    options: {
                        legend: {
                            position: 'top',
                            labels: {
                                fontFamily: 'Poppins'
                            }
                        },
                        responsive: true
                    }
                });
            }
        });

        const ctx = document.getElementById('myChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Hadir', 'Sakit/Izin', ' Alfa', 'Terlambat', 'Alfa'],
                datasets: [
                    {
                        label: 'Bulan Ini',
                        data: [23, 2, 1, 3, 2],
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Bulan Sebelumnya',
                        data: [20, 2, 4, 2, 3],
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += context.parsed.y;
                                }
                                return label;
                            }
                        }
                    },
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Bar Chart - Multiple'
                    }
                },
                scales: {
                    x: {
                        stacked: true,
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true
                    }
                }
            }
        });

        function radius() {
            var lokasi = document.getElementById('lokasi');
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
            }

            var koordinatsekolah = "{{ $koordinatsekolah->titik_koordinat }}";
            var radius = parseFloat("{{ $koordinatsekolah->radius }}");
            console.log('koordinatsekolah:', koordinatsekolah);
            console.log('radius:', radius);

            function successCallback(position) {
                console.log('User coordinates:', position.coords.latitude, position.coords.longitude);
                var lat_user = position.coords.latitude;
                var long_user = position.coords.longitude;

                var lok = koordinatsekolah.split(",");
                var lat_sekolah = lok[0];
                var long_sekolah = lok[1];

                var userLatLng = L.latLng(lat_user, long_user);
                var schoolLatLng = L.latLng(lat_sekolah, long_sekolah);

                var distance = userLatLng.distanceTo(schoolLatLng).toFixed(0);
                var distanceInKm = (distance / 1000).toFixed(2);

                document.getElementById('distance').innerText = distance + ' M';

                console.log('Distance (meters):', distance);
                console.log('Distance (km):', distanceInKm);
            }

            function errorCallback(error) {
                console.error("Error retrieving location:", error);
            }

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        var inter = setInterval(radius, 1000)
    </script>
@endpush
