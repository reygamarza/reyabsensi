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

                    {{-- <button class="au-btn-filter mr-2">
                        <i></i>Semua</button> --}}
                </div>
                <div class="table-data__tool-right">
                    <div class="au-form-icon--sm">
                        <input class="au-input--w300 au-input--style2" type="text" placeholder="Cari Kelas"
                            wire:model.live.debounce="searchkelas">
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
                            <th>Kelas</th>
                            <th>Wali Kelas</th>
                            <th>Jumlah Siswa</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftarkelas as $key => $k)
                            <tr>
                                <td>{{ $k->tingkat }} {{ $k->jurusan->id_jurusan }} {{ $k->nomor_kelas }}</td>
                                <td>
                                    @if ($k->waliKelas && $k->waliKelas->user)
                                        {{ $k->waliKelas->user->nama }}
                                    @else
                                        <strong>Belum Mempunyai Wali Kelas</strong>
                                    @endif
                                </td>
                                <td>55 </td>
                                <td>
                                    <div class="table-data-feature">
                                        <a data-toggle="modal" data-target="#EditModal">
                                            <button class="item mr-1" data-toggle="tooltip" title="Edit"
                                                wire:click="editwali({{ $k->id_kelas }})">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <button class="item mr-1" data-toggle="tooltip" data-placement="top"
                                            title="Delete" wire:click="hapuskelas({{ $k->id_kelas }})">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                        <button class="item mr-1" data-toggle="tooltip" data-placement="top"
                                            title="Daftar Siswa {{ $k->tingkat }} {{ $k->jurusan->id_jurusan }} {{ $k->nomor_kelas }}"
                                            wire:click="redirectSiswa({{ $k->id_kelas }})">
                                            <i class="zmdi zmdi-more"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-container">
                    {{ $daftarkelas->links() }}
                </div>
            </div>
        </div>
    </section>
    <!-- END DATA TABLE-->

    {{-- Modal Tambah Kelas --}}
    <div class="modal fade" id="TambahModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-radius: 10px">
                <div class="modal-header">
                    <h5 class="modal-title fw-light" id="largeModalLabel"><strong>Tambah Data</strong>
                        <small>Kelas</small>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="tingkat" class="form-control-label">Tingkat Kelas</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="tingkat" tabindex="1" wire:model="tingkat" class="form-control">
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="id_jurusan" class="form-control-label">Nama Jurusan</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="id_jurusan" tabindex="1" wire:model="id_jurusan" class="form-control">
                                @foreach ($daftarjurusan as $j)
                                    <option value="{{ $j->id_jurusan }}">{{ $j->id_jurusan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="nomor_kelas" class="form-control-label">Nomor Kelas</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="nomor_kelas" name="nomor_kelas" placeholder="Masukan Nomor Kelas"
                                class="form-control" wire:model="nomor_kelas" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="nuptk" class="form-control-label">Pilih Wali Kelas</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="nuptk" tabindex="1" wire:model="nuptk" class="form-control">
                                @foreach ($daftarwali as $w)
                                    <option value="{{ $w->nuptk }}">{{ $w->user->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" wire:click="tambahkelas()">Submit</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Tambah Kelas --}}

    {{-- Modal Edit Kelas --}}
    <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-radius: 10px">
                <div class="modal-header">
                    <h5 class="modal-title fw-light" id="largeModalLabel"><strong>Edit Data</strong>
                        <small>Kelas</small>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="tingkat" class="form-control-label">Tingkat Kelas</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="tingkat" tabindex="1" wire:model="tingkat" class="form-control">
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="id_jurusan" class="form-control-label">Nama Jurusan</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="id_jurusan" tabindex="1" wire:model="id_jurusan" class="form-control">
                                @foreach ($daftarjurusan as $j)
                                    <option value="{{ $j->id_jurusan }}">{{ $j->id_jurusan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="nomor_kelas" class="form-control-label">Nomor Kelas</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="nomor_kelas" name="nomor_kelas"
                                placeholder="Masukan Nomor Kelas" class="form-control" wire:model="nomor_kelas"
                                required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="nuptk" class="form-control-label">Pilih Wali Kelas</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="nuptk" tabindex="1" wire:model="nuptk" class="form-control">
                                @foreach ($daftarwali as $w)
                                    <option value="{{ $w->nuptk }}">{{ $w->user->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" wire:click="updatekelas()">Submit</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Edit Kelas --}}

    {{-- Modal Edit Kelas --}}
    <div class="modal fade" id="ImportModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-radius: 10px">
                <div class="modal-header">
                    <h5 class="modal-title fw-light" id="largeModalLabel"><strong>Edit Data</strong>
                        <small>Kelas</small>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="nomor_kelas" class="form-control-label">Pilih File</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="file" id="import_file" name="import_file"
                                placeholder="Masukan Nomor Kelas" wire:model="import_file"
                                required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Edit Kelas --}}
</div>
