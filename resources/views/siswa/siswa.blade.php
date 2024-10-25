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
                        <h1 class="title-4">Selamat Datang,
                            <span>{{ Auth::user()->nama }}!</span>
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
                        @if ($absenPulang || $validasijam || $statusValidasi)
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
                                <h2 class="number">Mengisi Form Tidak Hadir Karena Alasan Tertentu</h2>
                                <h2 class="number"></h2>
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

                            <!-- Tabs untuk Pilihan Kirim File atau Webcam -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="file-tab" data-toggle="tab" href="#file"
                                        role="tab" aria-controls="file" aria-selected="true">Kirim File</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="webcam-tab" data-toggle="tab" href="#webcam" role="tab"
                                        aria-controls="webcam" aria-selected="false">Gunakan Webcam</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <!-- Tab Kirim File -->
                                <div class="tab-pane fade show active" id="file" role="tabpanel"
                                    aria-labelledby="file-tab">
                                    <div class="row form-group mt-3">
                                        <div class="col col-md-3">
                                            <label class="form-control-label">Kirim File</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="file" class="form-control" name="photo_in"
                                                accept="image/png, image/jpeg" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tab Gunakan Webcam -->
                                <div class="tab-pane fade" id="webcam" role="tabpanel" aria-labelledby="webcam-tab">
                                    <div class="row form-group mt-3">
                                        <div class="col col-md-3">
                                            <label class="form-control-label">Ambil Foto</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <!-- Placeholder untuk Webcam -->
                                            <div id="my_camera"
                                                style="border: 2px solid #ddd; border-radius: 10px; width: 320px; height: 240px;">
                                            </div>
                                            <!-- Tempat untuk menampilkan hasil foto -->
                                            <img id="result" style="display:none; margin-top: 10px;" />
                                            <!-- Tombol untuk mengambil gambar -->
                                            <button type="button" class="btn btn-primary mt-2"
                                                onclick="ambilFoto()">Ambil Foto</button>
                                            <!-- Tombol untuk mengambil ulang gambar -->
                                            <button type="button" class="btn btn-warning mt-2"
                                                onclick="ambilUlang()">Ambil Ulang</button>
                                            <!-- Input tersembunyi untuk menyimpan base64 dari gambar -->
                                            <input type="hidden" id="photo_webcam" name="photo_webcam">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Keterangan -->
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
                <div class="row justify-content-center">
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
                    {{-- <div class="col-lg-8">
                        <div class="au-card">
                            <div class="au-card-inner">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="col-lg-8">
                        <div class="au-card">
                            <h3 class="title-5 m-b-35 text-center"><strong>Riwayat Kehadiran Anda</strong></h3>
                            <div class="progress mb-2">
                                <div class="progress-bar bg-success" role="progressbar" style="width:70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">70%</div>
                            </div>
                            <div class="au-card-inner">
                                <div class="card">
                                    <div class="card-header p-0">
                                        <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                                href="#nav-home" role="tab" aria-controls="nav-home"
                                                aria-selected="true"><strong>Bulan Ini</strong></a>
                                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab"
                                                href="#nav-profile" role="tab" aria-controls="nav-profile"
                                                aria-selected="false"><strong>Bulan Sebelumnya</strong></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="nav-tabContent">
                                            <!-- Tab Bulan Ini -->
                                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                                aria-labelledby="nav-home-tab">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <i class="fas fa-check-circle text-success"></i> Hadir:
                                                        {{ $dataBulanIni['Hadir'] ?? 0 }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fas fa-user-md text-info"></i> Sakit/Izin:
                                                        {{ $dataBulanIni['Sakit/Izin'] ?? 0 }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fas fa-clock text-warning"></i> Terlambat:
                                                        {{ $dataBulanIni['Terlambat'] ?? 0 }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fas fa-times-circle text-danger"></i> Alfa:
                                                        {{ $dataBulanIni['Alfa'] ?? 0 }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fas fa-bell text-primary"></i> TAP:
                                                        {{ $dataBulanIni['TAP'] ?? 0 }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fas fa-user-clock text-secondary"></i> Total Keterlambatan:
                                                        {{ $late }} Menit
                                                    </li>
                                                </ul>
                                            </div>

                                            <!-- Tab Bulan Sebelumnya -->
                                            <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                                aria-labelledby="nav-profile-tab">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <i class="fas fa-check-circle text-success"></i> Hadir:
                                                        {{ $dataBulanSebelumnya['Hadir'] ?? 0 }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fas fa-user-md text-info"></i> Sakit/Izin:
                                                        {{ $dataBulanSebelumnya['Sakit/Izin'] ?? 0 }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fas fa-clock text-warning"></i> Terlambat:
                                                        {{ $dataBulanSebelumnya['Terlambat'] ?? 0 }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fas fa-times-circle text-danger"></i> Alfa:
                                                        {{ $dataBulanSebelumnya['Alfa'] ?? 0 }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fas fa-bell text-primary"></i> TAP:
                                                        {{ $dataBulanSebelumnya['TAP'] ?? 0 }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fas fa-user-clock text-secondary"></i> Total Keterlambatan:
                                                        {{ $late2 }} Menit
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-lg-8 text-center">
                        <h3 class="title-5 m-b-35 text-center">Riwayat Kehadiran Anda <strong>Minggu Ini</strong></h3>
                        <div class="table-responsive table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        {{-- <th>Absen Masuk</th>
                                        <th>Absen Pulang</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($riwayatmingguini as $riwayatM)
                                        <tr>
                                            <td>{{ $riwayatM->date }}</td>
                                            <td>
                                                @if ($riwayatM->status == 'Hadir')
                                                    <span class="status hadir">{{ $riwayatM->status }}</span>
                                                @elseif ($riwayatM->status == 'Terlambat')
                                                    <span class="status terlambat">{{ $riwayatM->status }}</span>
                                                @elseif ($riwayatM->status == 'TAP')
                                                    <span class="status tap">{{ $riwayatM->status }}</span>
                                                @elseif ($riwayatM->status == 'Sakit' || $riwayatM->status == 'Izin')
                                                    <span class="status izin">{{ $riwayatM->status }}</span>
                                                @elseif ($riwayatM->status == 'Alfa')
                                                    <span class="status alfa">{{ $riwayatM->status }}</span>
                                                @endif
                                            </td>
                                            {{-- <td>{{ $riwayatM->jam_masuk }}</td>
                                            <td>{{ $riwayatM->jam_pulang }}</td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="au-card">
                            <h3 class="title-5 m-b-35 text-center">Jumlah Kehadiran Anda</h3>
                            <div class="card-header p-0">
                                <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                        href="#nav-home" role="tab" aria-controls="nav-home"
                                        aria-selected="true"><strong>Bulan Ini</strong></a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab"
                                        href="#nav-profile" role="tab" aria-controls="nav-profile"
                                        aria-selected="false"><strong>Bulan Sebelumnya</strong></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="nav-tabContent">
                                    <!-- Tab Bulan Ini -->
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                        aria-labelledby="nav-home-tab">
                                        <div class="progress mb-2">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: {{ $persentaseHadirBulanIni }}%"
                                                aria-valuenow="{{ $persentaseHadirBulanIni }}" aria-valuemin="0"
                                                aria-valuemax="100">{{ $persentaseHadirBulanIni }}%
                                            </div>
                                        </div>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <i class="fas fa-check-circle text-success"></i> Hadir :
                                                {{ $dataBulanIni['Hadir'] ?? 0 }}
                                            </li>
                                            <li class="list-group-item">
                                                <i class="fas fa-user-md text-info"></i> Sakit/Izin :
                                                {{ $dataBulanIni['Sakit/Izin'] ?? 0 }}
                                            </li>
                                            <li class="list-group-item">
                                                <i class="fas fa-clock text-warning"></i> Terlambat :
                                                {{ $dataBulanIni['Terlambat'] ?? 0 }}
                                            </li>
                                            <li class="list-group-item">
                                                <i class="fas fa-times-circle text-danger"></i> Alfa :
                                                {{ $dataBulanIni['Alfa'] ?? 0 }}
                                            </li>
                                            <li class="list-group-item">
                                                <i class="fas fa-bell text-primary"></i> TAP :
                                                {{ $dataBulanIni['TAP'] ?? 0 }}
                                            </li>
                                            <li class="list-group-item">
                                                <i class="fas fa-user-clock text-secondary"></i> Total
                                                Keterlambatan :
                                                {{ $late }} Menit
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Tab Bulan Sebelumnya -->
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                        aria-labelledby="nav-profile-tab">
                                        <div class="progress mb-2">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: {{ $persentaseHadirBulanSebelumnya }}%"
                                                aria-valuenow="{{ $persentaseHadirBulanSebelumnya }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                                Persentase Hadir : {{ $persentaseHadirBulanSebelumnya }}%
                                            </div>
                                        </div>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <i class="fas fa-check-circle text-success"></i> Hadir :
                                                {{ $dataBulanSebelumnya['Hadir'] ?? 0 }}
                                            </li>
                                            <li class="list-group-item">
                                                <i class="fas fa-user-md text-info"></i> Sakit/Izin :
                                                {{ $dataBulanSebelumnya['Sakit/Izin'] ?? 0 }}
                                            </li>
                                            <li class="list-group-item">
                                                <i class="fas fa-clock text-warning"></i> Terlambat :
                                                {{ $dataBulanSebelumnya['Terlambat'] ?? 0 }}
                                            </li>
                                            <li class="list-group-item">
                                                <i class="fas fa-times-circle text-danger"></i> Alfa :
                                                {{ $dataBulanSebelumnya['Alfa'] ?? 0 }}
                                            </li>
                                            <li class="list-group-item">
                                                <i class="fas fa-bell text-primary"></i> TAP :
                                                {{ $dataBulanSebelumnya['TAP'] ?? 0 }}
                                            </li>
                                            <li class="list-group-item">
                                                <i class="fas fa-user-clock text-secondary"></i> Total
                                                Keterlambatan :
                                                {{ $late2 }} Menit
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
    <script src="{{ asset('assets/siswa/assets') }}/js/digitalclock.js"></script>
    <script>
        // Inisialisasi Webcam
        function startWebcam() {
            Webcam.set({
                width: 320,
                height: 240,
                image_format: 'jpeg',
                jpeg_quality: 90,
                flip_horiz: false // Nonaktifkan mirroring kamera
            });
            Webcam.attach('#my_camera'); // Menampilkan kamera di div dengan id 'my_camera'
        }

        // Ketika tab webcam diklik, jalankan fungsi startWebcam
        $('#webcam-tab').on('shown.bs.tab', function(e) {
            startWebcam();
        });

        // Ketika tab 'Kirim File' diklik, hentikan kamera
        $('#file-tab').on('shown.bs.tab', function(e) {
            Webcam.reset(); // Menonaktifkan dan menghentikan kamera
        });

        // Fungsi untuk mengambil gambar
        function ambilFoto() {
            Webcam.snap(function(data_uri) {
                // Simpan gambar dalam variabel image
                let image = data_uri;

                // Tampilkan gambar di elemen <img> dengan id 'result'
                document.getElementById('result').src = data_uri;
                document.getElementById('result').style.display = 'block';

                // Simpan data image dalam input tersembunyi untuk dikirim ke server
                document.getElementById('photo_webcam').value = image;

                // Sembunyikan tampilan kamera
                document.getElementById('my_camera').style.display = 'none';
            });
        }

        // Fungsi untuk mengulang mengambil foto
        function ambilUlang() {
            // Reset gambar dan tampilkan kembali kamera
            document.getElementById('result').style.display = 'none';
            document.getElementById('my_camera').style.display = 'block';
        }
    </script>
    <script>
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
