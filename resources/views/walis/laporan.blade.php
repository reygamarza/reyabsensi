@extends('layouts.laywalis')

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
                                        <a href="#">> Laporan Absensi / Siswa</a>
                                    </li>
                                    <li class="list-inline-item seprate">
                                        <span></span>
                                    </li>
                                    <li class="list-inline-item"></li>
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
                            <a href="{{ url()->previous() }}" class="fas fa-chevron-left"
                                style="font-size: 40px; color: #393939;"></a>
                            <div style="flex: 1;">
                                <h1 class="title-4 text-center" style="margin-bottom: 0;">Laporan Absensi Siswa</h1>
                            </div>
                        </div>
                        <hr class="line-seprate">
                    </div>
                </div>
            </div>
        </section>
        <!-- END WELCOME-->

        <!-- DATA TABLE-->
        <section class="p-t-20">
            <div class="container">
                <div class="table-data__tool">
                    <div class="table-data__tool-left" style="display:flex; align-items:center;">
                        <form action="{{ route('laporan-WS') }}" method="GET">
                            <div class="rs-select2--light rs-select2--md">
                                <select class="js-select2" name="status">
                                    <option selected="selected" value="">Semua Status</option>
                                    <option value="Hadir" {{ request('status') == "Hadir" ? 'selected' : '' }}>Hadir</option>
                                    <option value="Terlambat" {{ request('status') == "Terlambat" ? 'selected' : '' }}>Terlambat</option>
                                    <option value="TAP" {{ request('status') == "TAP" ? 'selected' : '' }}>TAP</option>
                                    <option value="Sakit" {{ request('status') == "Sakit" ? 'selected' : '' }}>Sakit</option>
                                    <option value="Izin" {{ request('status') == "Izin" ? 'selected' : '' }}>Izin</option>
                                    <option value="Alfa" {{ request('status') == "Alfa" ? 'selected' : '' }}>Alfa</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                    </div>
                    <div class="table-data__tool-right">
                            <div class="filter-group">
                                <label for="from-date">From</label>
                                <input type="date" id="from-date" name="start" class="au-btn-filter" value="{{ $startDate }}">
                                <label for="to-date">To</label>
                                <input type="date" id="to-date" name="end" class="au-btn-filter" value="{{ $endDate }}">
                                <button class="au-btn au-btn-icon au-btn--blue au-btn--small" type="submit">
                                    <i class="zmdi zmdi-search"></i>Filter
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="nisTab" role="tablist">
                    @foreach ($dataAbsensiAnak as $data)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $data['siswa']->nis }}"
                               data-toggle="tab" href="#nis-{{ $data['siswa']->nis }}" role="tab"
                               aria-controls="nis-{{ $data['siswa']->nis }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                {{ $data['siswa']->user->nama }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content" id="nisTabContent">
                    @foreach ($dataAbsensiAnak as $data)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="nis-{{ $data['siswa']->nis }}"
                             role="tabpanel" aria-labelledby="tab-{{ $data['siswa']->nis }}">
                            <div class="card">
                                <div class="card-header bg-info text-white text-center" style="font-size: 18px">
                                    <strong class="card-title">Ringkasan Kehadiran {{ $data['siswa']->user->nama }}</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col">
                                            <h4 class="text-success">{{ number_format($data['attendancePercentage']['percentageHadir']) }}%</h4>
                                            <small>Hadir</small>
                                        </div>
                                        <div class="col">
                                            <h4 class="text-info">{{ number_format($data['attendancePercentage']['percentageSakitIzin']) }}%</h4>
                                            <small>Sakit/Izin</small>
                                        </div>
                                        <div class="col">
                                            <h4 class="text-danger">{{ number_format($data['attendancePercentage']['percentageAlfa']) }}%</h4>
                                            <small>Alfa</small>
                                        </div>
                                        <div class="col">
                                            <h4 class="text-warning">{{ number_format($data['attendancePercentage']['percentageTerlambat']) }}%</h4>
                                            <small>Terlambat</small>
                                        </div>
                                        <div class="col">
                                            <h4 class="text-secondary">{{ number_format($data['attendancePercentage']['percentageTAP']) }}%</h4>
                                            <small>TAP</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <div class="table-responsive table--no-card m-b-30">
                                        <table class="table table-borderless table-striped table-earning">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Status</th>
                                                    <th>Detail Kehadiran</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data['absensiData'] as $absensi)
                                                    <tr>
                                                        <td>{{ $absensi->date }}</td>
                                                        <td>
                                                            @if ($absensi->status == 'Hadir')
                                                                <span class="status hadir">{{ $absensi->status }}</span>
                                                            @elseif ($absensi->status == 'Terlambat')
                                                                <span class="status terlambat">{{ $absensi->status }}</span>
                                                            @elseif ($absensi->status == 'TAP')
                                                                <span class="status tap">{{ $absensi->status }}</span>
                                                            @elseif ($absensi->status == 'Sakit' || $absensi->status == 'Izin')
                                                                <span class="status izin">{{ $absensi->status }}</span>
                                                            @elseif ($absensi->status == 'Alfa')
                                                                <span class="status alfa">{{ $absensi->status }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <button class="status bg-secondary" data-toggle="modal"
                                                                data-target="#DetailModal{{ $absensi->id_absensi }}">Lihat</button>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        @foreach ($data['absensiData'] as $absensi)
                                            {{-- Modal Detail Kehadiran --}}
                                            <div class="modal fade" id="DetailModal{{ $absensi->id_absensi }}" tabindex="-1"
                                                role="dialog" aria-labelledby="DetailModalLabel{{ $absensi->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content border-0 rounded-lg shadow-lg">
                                                        <div class="modal-header border-bottom-0">
                                                            <p class="modal-title" id="DetailModalLabel{{ $absensi->id }}">
                                                                Detail Kehadiran <strong>{{ $absensi->date }}</strong>
                                                            </p>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-start">
                                                            <table class="table table-borderless">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>Status:</th>
                                                                        <td>{{ $absensi->status }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Jam Masuk:</th>
                                                                        <td class="text-muted">
                                                                            {{ $absensi->jam_masuk ?? 'Tidak tersedia' }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Jam Pulang:</th>
                                                                        <td class="text-muted">
                                                                            {{ $absensi->jam_pulang ?? 'Tidak tersedia' }}
                                                                        </td>
                                                                    </tr>
                                                                    @if ($absensi->menit_keterlambatan > 0)
                                                                        <tr>
                                                                            <th>Menit Keterlambatan:</th>
                                                                            <td class="text-muted">
                                                                                {{ $absensi->menit_keterlambatan }} Menit
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                    @if ($absensi->status == 'Hadir' || $absensi->status == 'Terlambat' || $absensi->status == 'TAP')
                                                                        <tr>
                                                                            <th>Foto Masuk:</th>
                                                                            <td class="text-muted">
                                                                                @if ($absensi->photo_in)
                                                                                    <img src="{{ asset('storage/uploads/absensi/' . $absensi->photo_in) }}"
                                                                                        alt="Foto Masuk" style="width: 150px;">
                                                                                @else
                                                                                    Tidak tersedia
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Foto Pulang:</th>
                                                                            <td class="text-muted">
                                                                                @if ($absensi->photo_out)
                                                                                    <img src="{{ asset('storage/uploads/absensi/' . $absensi->photo_out) }}"
                                                                                        alt="Foto Pulang" style="width: 150px;">
                                                                                @else
                                                                                    Tidak tersedia
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                    @if ($absensi->status == 'Sakit' || $absensi->status == 'Izin')
                                                                        <tr>
                                                                            <th>Keterangan:</th>
                                                                            <td class="text-muted">
                                                                                {{ $absensi->keterangan ?? 'Tidak tersedia' }}
                                                                            </td>
                                                                        </tr>
                                                                        <th>Foto Keterangan:</th>
                                                                        <td class="text-muted">
                                                                            @if ($absensi->photo_in)
                                                                                <img src="{{ asset('storage/uploads/absensi/' . $absensi->photo_in) }}"
                                                                                    alt="Foto Pulang" style="width: 150px;">
                                                                            @else
                                                                                Tidak tersedia
                                                                            @endif
                                                                        </td>
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer border-top-0">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End Modal Detail Kehadiran --}}
                                        @endforeach
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        {{ $data['absensiData']->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>
        </section>
        <!-- END DATA TABLE-->

        <!-- COPYRIGHT-->
        <section class="p-t-60 p-b-20">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright">

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END COPYRIGHT-->
    </div>

    </div>
@endsection
