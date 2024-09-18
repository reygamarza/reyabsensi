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
                                    <li class="list-inline-item">Rekap Absensi</li>
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
                        <h1 class="title-4 text-center">Rekap Absensi Anda</h1>
                        <hr class="line-seprate">
                    </div>
                </div>
            </div>
        </section>
        <!-- END WELCOME-->

        <!-- DASHBOARD INFO-->
        <section class="statisticrekap p-t-20">
            <div class="container">
                <div class="table-data__tool">
                    <div class="table-data__tool-left"></div>
                    <div class="table-data__tool-right">
                        <form action="{{ route('rekap') }}" method="GET">
                            <div class="filter-group">
                                <label for="from-date">From</label>
                                <input type="date" id="from-date" name="start_date" class="au-btn-filter">
                                <label for="to-date">To</label>
                                <input type="date" id="to-date" name="end_date" class="au-btn-filter">
                                <button class="au-btn au-btn-icon au-btn--blue au-btn--small" type="submit">
                                    <i class="zmdi zmdi-search"></i>Cari
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 text-center">
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
                                    @foreach ($absensi as $a)
                                        <tr>
                                            <td>{{ $a->date }}</td>
                                            <td>
                                                @if ($a->status == 'Hadir')
                                                    <span class="status hadir">{{ $a->status }}</span>
                                                @elseif ($a->status == 'Terlambat')
                                                    <span class="status terlambat">{{ $a->status }}</span>
                                                @elseif ($a->status == 'TAP')
                                                    <span class="status tap">{{ $a->status }}</span>
                                                @elseif ($a->status == 'Sakit' || $a->status == 'Izin')
                                                    <span class="status izin">{{ $a->status }}</span>
                                                @elseif ($a->status == 'Alfa')
                                                    <span class="status alfa">{{ $a->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="status bg-secondary" data-toggle="modal"
                                                    data-target="#DetailModal{{ $a->id_absensi }}">Lihat</button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            @foreach ($absensi as $a)
                            {{-- Modal Detail Kehadiran --}}
                            <div class="modal fade" id="DetailModal{{ $a->id_absensi }}" tabindex="-1" role="dialog"
                                aria-labelledby="DetailModalLabel{{ $a->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content border-0 rounded-lg shadow-lg">
                                        <div class="modal-header border-bottom-0">
                                            <p class="modal-title" id="DetailModalLabel{{ $a->id }}">
                                                Detail Kehadiran <strong>{{ $a->date }}</strong>
                                            </p>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <th>Status:</th>
                                                        <td>{{ $a->status }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Jam Masuk:</th>
                                                        <td class="text-muted">
                                                            {{ $a->jam_masuk ?? 'Tidak tersedia' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Jam Pulang:</th>
                                                        <td class="text-muted">
                                                            {{ $a->jam_pulang ?? 'Tidak tersedia' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Menit Keterlambatan:</th>
                                                        <td class="text-muted">
                                                            {{ $a->menit_keterlambatan ? $a->menit_keterlambatan . ' menit' : 'Tidak tersedia' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Keterangan:</th>
                                                        <td class="text-muted">
                                                            {{ $a->keterangan ?? 'Tidak tersedia' }}
                                                        </td>
                                                    </tr>
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
                            {{ $absensi->links() }}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="au-card">
                            <h3 class="title-5 m-b-35 text-center">Jumlah Kehadiran Anda</h3>
                            <div class="au-card-inner">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="tab-content" id="nav-tabContent">
                                            <!-- Tab Bulan Ini -->
                                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                                aria-labelledby="nav-home-tab">
                                                <div class="progress mb-2">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: {{ $persentaseHadir }}%"
                                                        aria-valuenow="{{ $persentaseHadir }}" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        Persentase Hadir : {{ $persentaseHadir }}%
                                                    </div>
                                                </div>
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <i class="fas fa-check-circle text-success"></i> Hadir :
                                                        {{ $jumlahHadir }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fas fa-user-md text-info"></i> Sakit/Izin :
                                                        {{ $jumlahIzin }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fas fa-clock text-warning"></i> Terlambat :
                                                        {{ $jumlahTerlambat }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fas fa-times-circle text-danger"></i> Alfa :
                                                        {{ $jumlahAlfa }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fas fa-bell text-primary"></i> TAP :
                                                        {{ $jumlahTap }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fas fa-user-clock text-secondary"></i> Total
                                                        Keterlambatan : {{ $totalKeterlambatan }} Menit
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

                </div>
            </div>
        </section>
        <!-- END COPYRIGHT-->
    </div>
@endsection

@push('myscript')
    <script type="text/javascript">
        // $(function() {

        //     var start = moment().subtract(29, 'days');
        //     var end = moment();

        //     document.getElementById('start').value = start;
        //     document.getElementById('end').value = end;

        //     function cb(start, end) {
        //         $('#reportrange span').html(start.format('MMMM D YYYY') + ' - ' + end.format('MMMM D YYYY'));
        //     }

        //     $('#reportrange').daterangepicker({
        //         startDate: start,
        //         endDate: end,
        //         ranges: {
        //             'Hari Ini': [moment(), moment()],
        //             'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        //             '7 Minggu Terakhir': [moment().subtract(6, 'days'), moment()],
        //             '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
        //             'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
        //             'Bulan Terakhir': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
        //                 'month').endOf('month')]
        //         }
        //     }, cb);

        //     cb(start, end);

        // });

        $(function() {
            // Set tanggal mulai dan akhir ke 29 hari yang lalu dan hari ini
            var start = $('#start').val() ? moment($('#start').val()) : moment().subtract(29, 'days').startOf(
                'day');
            var end = $('#end').val() ? moment($('#end').val()) : moment().endOf('day');

            // Fungsi callback untuk memperbarui teks di tombol dan input hidden
            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D YYYY') + ' - ' + end.format('MMMM D YYYY'));
                // Update input hidden dengan format tanggal YYYY-MM-DD
                $('#start').val(start.format('YYYY-MM-DD'));
                $('#end').val(end.format('YYYY-MM-DD'));
            }

            // Inisialisasi daterangepicker
            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Hari Ini': [moment().startOf('day'), moment().endOf('day')],
                    'Kemarin': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days')
                        .endOf('day')
                    ],
                    '7 Hari Terakhir': [moment().subtract(6, 'days').startOf('day'), moment().endOf('day')],
                    '30 Hari Terakhir': [moment().subtract(29, 'days').startOf('day'), moment().endOf(
                        'day')],
                    'Bulan Ini': [moment().startOf('month').startOf('day'), moment().endOf('month').endOf(
                        'day')],
                    'Bulan Sebelumnya': [moment().subtract(1, 'month').startOf('month').startOf('day'),
                        moment().subtract(1, 'month').endOf('month').endOf('day')
                    ]
                }
            }, cb);

            // Panggil callback untuk set teks default dan input hidden
            cb(start, end);
        });
    </script>
@endpush
