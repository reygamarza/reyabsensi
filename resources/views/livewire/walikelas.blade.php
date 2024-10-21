<div>
    <!-- DATA TABLE-->
    <section class="p-t-20">
        <div class="container">
            <div class="table-data__tool">
                <div class="table-data__tool-left">
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal"
                        data-target="#TambahModal" wire:click="clear()">
                        <i class="zmdi zmdi-plus"></i>Tambah</button>
                    <button class="au-btn au-btn-icon au-btn--blue au-btn--small" data-toggle="modal"
                        data-target="#ImportModal">
                        <i class="zmdi zmdi-file"></i>Import</button>
                </div>
                <div class="table-data__tool-right">
                    <div class="au-form-icon--sm">
                        <input class="au-input--w300 au-input--style2" type="text" placeholder="Cari Wali Kelas"
                            wire:model.live.debounce="searchwali">
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
                            <th>NUPTK</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>JK</th>
                            <th>NIP</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftarwali as $w)
                            <tr>
                                <td>{{ $w->nuptk }}</td>
                                <td>{{ $w->user->email }}</td>
                                <td>{{ $w->user->nama }}</td>
                                <td>{{ $w->jenis_kelamin }}</td>
                                <td>{{ $w->nip }}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a data-toggle="modal" data-target="#EditModal">
                                            <button class="item mr-1" data-toggle="tooltip" title="Edit"
                                                wire:click="editwali({{ $w->nuptk }})">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <button class="item mr-1" data-toggle="tooltip" data-placement="top"
                                            title="Delete" wire:click="hapuswali({{ $w->nuptk }})">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-container">
                    {{ $daftarwali->links() }}
                </div>
            </div>
        </div>
    </section>
    <!-- END DATA TABLE-->

    {{-- Modal Tambah Wali Kelas --}}
    <div class="modal fade" id="TambahModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-radius: 10px">
                <div class="modal-header">
                    <h5 class="modal-title fw-light" id="largeModalLabel"><strong>Tambah Data</strong>
                        <small>Wali Kelas</small>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Biodata Wali Column -->
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">Biodata Wali Kelas</h6>
                            <div class="row form-group" style="margin-bottom: 25px;">
                                <div class="col col-md-3">
                                    <label for="nuptk" class="form-control-label">NUPTK</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="nuptk" name="nuptk" placeholder="Masukan NUPTK"
                                        class="form-control" wire:model="nuptk" required>
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
                                    <label for="nip" class="form-control-label">NIP</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="nip" name="nip" placeholder="Masukan NIP"
                                        class="form-control" required wire:model="nip">
                                </div>
                            </div>
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
                    <button type="submit" class="btn btn-success" wire:click="tambahwali()">Submit</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Tambah Wali --}}

    {{-- Modal Edit Wali Kelas --}}
    <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-radius: 10px">
                <div class="modal-header">
                    <h5 class="modal-title fw-light" id="largeModalLabel"><strong>Edit Data</strong>
                        <small>Wali Kelas</small>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Biodata Wali Column -->
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">Biodata Wali Kelas</h6>
                            <div class="row form-group" style="margin-bottom: 25px;">
                                <div class="col col-md-3">
                                    <label for="nuptk" class="form-control-label">NUPTK</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="nuptk" name="nuptk" placeholder="Masukan NUPTK"
                                        class="form-control" wire:model="nuptk" required>
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
                                    <label for="nip" class="form-control-label">NIP</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="nip" name="nip" placeholder="Masukan NIP"
                                        class="form-control" required wire:model="nip">
                                </div>
                            </div>
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
                    <button type="submit" class="btn btn-success" wire:click="updatewali()">Submit</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Edit Wali --}}

    {{-- Modal Import Wali Kelas --}}
    <div class="modal fade" id="ImportModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-radius: 10px">
                <div class="modal-header">
                    <h5 class="modal-title fw-light" id="largeModalLabel"><strong>Import Data</strong>
                        <small>Wali Kelas</small>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="import" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="file" class="form-control-label">Pilih File</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="file" id="file" name="file" placeholder="Input file"
                                    wire:model="file" required>
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
    {{-- End Modal Import Wali Kelas --}}
</div>
