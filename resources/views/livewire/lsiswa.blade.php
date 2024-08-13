<div>
    <!-- DATA TABLE-->
    <section class="p-t-20">
        <div class="container">
            <div class="table-data__tool">
                <div class="table-data__tool-left">
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal"
                        data-target="#TambahModal" wire:click="clear()">
                        <i class="zmdi zmdi-plus"></i>Tambah</button>
                    {{-- <button class="au-btn-filter mr-2">
                        <i></i>Semua</button> --}}
                </div>
                <div class="table-data__tool-right">
                    <div class="au-form-icon--sm">
                        <input class="au-input--w300 au-input--style2" type="text" placeholder="Cari Siswa"
                            wire:model.live.debounce="searchsiswa">
                        <button class="au-btn--submit2" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jenis Kelamin</th>
                            <th>NISN</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftarsiswa as $key => $s)
                            <tr>
                                <td>{{ $s->nis }}</td>
                                <td>{{ $s->user->nama }}</td>
                                <td>{{ $s->user->email }}</td>
                                <td>{{ $s->jenis_kelamin }}</td>
                                <td>{{ $s->nisn }}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a data-toggle="modal" data-target="#EditModal">
                                            <button class="item mr-1" data-toggle="tooltip" title="Edit"
                                                wire:click="editsiswa({{ $s->nis }})">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <button class="item mr-1" data-toggle="tooltip" data-placement="top"
                                            title="Delete" wire:click="hapussiswa({{ $s->nis }})">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                        {{-- <button class="item mr-1" data-toggle="tooltip" data-placement="top"
                                                title="Daftar Siswa {{ $k->tingkat }} {{ $k->jurusan->nama_jurusan }} {{ $k->nomor_kelas }}">
                                                <i class="zmdi zmdi-more"></i>
                                            </button> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-container">
                    {{ $daftarsiswa->links() }}
                </div>
            </div>
        </div>
    </section>
    <!-- END DATA TABLE-->

    {{-- Modal Tambah Siswa --}}
    <div class="modal fade" id="TambahModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-radius: 10px">
                <div class="modal-header">
                    <h5 class="modal-title fw-light" id="largeModalLabel"><strong>Tambah Data</strong>
                        <small>Siswa</small>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Biodata Wali Column -->
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">Biodata Siswa</h6>
                            <div class="row form-group" style="margin-bottom: 25px;">
                                <div class="col col-md-3">
                                    <label for="nis" class="form-control-label">NIS</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="nis" name="nis" placeholder="Masukan NIS"
                                        class="form-control" wire:model="nis" required>
                                </div>
                            </div>
                            <div class="row form-group" style="margin-bottom: 25px;">
                                <div class="col col-md-3">
                                    <label for="nama" class="form-control-label">Nama Lengkap</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="nama" name="nama"
                                        placeholder="Masukan Nama Lengkap" class="form-control" wire:model="nama"
                                        required>
                                </div>
                            </div>
                            <div class="row form-group" style="margin-bottom: 25px;">
                                <div class="col col-md-3">
                                    <label class="form-control-label">Jenis Kelamin</label>
                                </div>
                                <div class="col col-md-9">
                                    <div class="form-check-inline form-check">
                                        <label for="inline-radio1" class="form-check-label mr-4">
                                            <input type="radio" id="inline-radio1" name="jenis_kelamin"
                                                value="laki laki" class="form-check-input" wire:model="jenis_kelamin"
                                                required>Laki - Laki
                                        </label>
                                        <label for="inline-radio2" class="form-check-label">
                                            <input type="radio" id="inline-radio2" name="jenis_kelamin"
                                                value="perempuan" class="form-check-input" wire:model="jenis_kelamin"
                                                required>Perempuan
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group" style="margin-bottom: 25px;">
                                <div class="col col-md-3">
                                    <label for="nisn" class="form-control-label">NISN</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="nisn" name="nisn" placeholder="Masukan NISN"
                                        class="form-control" required wire:model="nisn">
                                </div>
                            </div>
                            <div class="row form-group" style="margin-bottom: 25px;">
                                <div class="col col-md-3">
                                    <label for="nik" class="form-control-label">NIK Ortu</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="nik" tabindex="1" wire:model="nik" class="form-control">
                                        @foreach ($daftarortu as $o)
                                            <option value="{{ $o->nik }}">{{ $o->user->nama }} - {{ $o->nik }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="id_kelas" class="form-control-label">Kelas</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="id_kelas" tabindex="1" wire:model="id_kelas"
                                        class="form-control">
                                        @foreach ($daftarkelas as $k)
                                            <option value="{{ $k->id_kelas }}">
                                                {{ $k->tingkat }} {{ $k->jurusan->nama_jurusan }}
                                                {{ $k->nomor_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                        </div>
                        <!-- Akun Wali Column -->
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">Akun Wali Kelas</h6>
                            <div class="row form-group" style="margin-bottom: 25px;">
                                <div class="col col-md-3">
                                    <label for="email" class="form-control-label">Email</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="email" id="email" name="email" placeholder="Masukan Email"
                                        class="form-control" wire:model="email" required>
                                </div>
                            </div>
                            <div class="row form-group" style="margin-bottom: 25px;">
                                <div class="col col-md-3">
                                    <label for="password" class="form-control-label">Password</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="password" name="password"
                                        placeholder="Masukan Password" class="form-control" required
                                        wire:model="password">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" wire:click="tambahsiswa()">Submit</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Tambah Siswa --}}

    {{-- Modal Edit Siswa --}}
    <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-radius: 10px">
                <div class="modal-header">
                    <h5 class="modal-title fw-light" id="largeModalLabel"><strong>Edit Data</strong>
                        <small>Siswa</small>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Biodata Siswa Column -->
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">Biodata Siswa</h6>
                            <div class="row form-group" style="margin-bottom: 25px;">
                                <div class="col col-md-3">
                                    <label for="nis" class="form-control-label">NIS</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="nis" name="nis" placeholder="Masukan NIS"
                                        class="form-control" wire:model="nis" required>
                                </div>
                            </div>
                            <div class="row form-group" style="margin-bottom: 25px;">
                                <div class="col col-md-3">
                                    <label for="nama" class="form-control-label">Nama Lengkap</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="nama" name="nama"
                                        placeholder="Masukan Nama Lengkap" class="form-control" wire:model="nama"
                                        required>
                                </div>
                            </div>
                            <div class="row form-group" style="margin-bottom: 25px;">
                                <div class="col col-md-3">
                                    <label class="form-control-label">Jenis Kelamin</label>
                                </div>
                                <div class="col col-md-9">
                                    <div class="form-check-inline form-check">
                                        <label for="inline-radio1" class="form-check-label mr-4">
                                            <input type="radio" id="inline-radio1" name="jenis_kelamin"
                                                value="laki laki" class="form-check-input" wire:model="jenis_kelamin"
                                                required>Laki - Laki
                                        </label>
                                        <label for="inline-radio2" class="form-check-label">
                                            <input type="radio" id="inline-radio2" name="jenis_kelamin"
                                                value="perempuan" class="form-check-input" wire:model="jenis_kelamin"
                                                required>Perempuan
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group" style="margin-bottom: 25px;">
                                <div class="col col-md-3">
                                    <label for="nisn" class="form-control-label">NISN</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="nisn" name="nisn" placeholder="NISN"
                                        class="form-control" required wire:model="nisn">
                                </div>
                            </div>
                            <div class="row form-group" style="margin-bottom: 25px;">
                                <div class="col col-md-3">
                                    <label for="nik" class="form-control-label">NIK Ortu</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="nik" tabindex="1" wire:model="nik" class="form-control">
                                        @foreach ($daftarortu as $o)
                                            <option value="{{ $o->nik }}">{{ $o->user->nama }} - {{ $o->nik }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="id_kelas" class="form-control-label">Kelas</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="id_kelas" tabindex="1" wire:model="id_kelas"
                                        class="form-control">
                                        @foreach ($daftarkelas as $k)
                                            <option value="{{ $k->id_kelas }}">
                                                {{ $k->tingkat }} {{ $k->jurusan->nama_jurusan }}
                                                {{ $k->nomor_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                        </div>
                        <!-- Akun Siswa Column -->
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">Akun Siswa</h6>
                            <div class="row form-group" style="margin-bottom: 25px;">
                                <div class="col col-md-3">
                                    <label for="email" class="form-control-label">Email</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="email" id="email" name="email" placeholder="Masukan Email"
                                        class="form-control" wire:model="email" required>
                                </div>
                            </div>
                            <div class="row form-group" style="margin-bottom: 25px;">
                                <div class="col col-md-3">
                                    <label for="password" class="form-control-label">Password</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="password" name="password"
                                        placeholder="Masukan Password" class="form-control" required
                                        wire:model="password">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" wire:click="updatesiswa()">Submit</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Edit Siswa --}}


</div>
