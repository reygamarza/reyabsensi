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
                        <input class="au-input--w300 au-input--style2" type="text" placeholder="Cari Jurusan"
                            wire:model.live.debounce="searchjurusan">
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
                            <th>ID Jurusan</th>
                            <th>Nama Jurusan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftarjurusan as $key => $j)
                            <tr>
                                <td>{{ $j->id_jurusan }}</td>
                                <td>{{ $j->nama_jurusan }}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a data-toggle="modal" data-target="#EditModal">
                                            <button class="item mr-1" data-toggle="tooltip" title="Edit"
                                                wire:click="editjurusan({{ $j->id_jurusan }})">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <button class="item mr-1" data-toggle="tooltip" data-placement="top"
                                            title="Delete" wire:click="hapusjurusan({{ $j->id_jurusan }})">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-container">
                    {{ $daftarjurusan->links() }}
                </div>
            </div>
        </div>
    </section>
    <!-- END DATA TABLE-->

    {{-- Modal Tambah Jurusan --}}
    <div class="modal fade" id="TambahModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-radius: 10px">
                <div class="modal-header">
                    <h5 class="modal-title fw-light" id="largeModalLabel"><strong>Tambah Data</strong>
                        <small>Jurusan</small>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="nama_jurusan" class="form-control-label">Nama Jurusan</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="nama_jurusan" name="nama_jurusan"
                                placeholder="Masukan Nama Jurusan" class="form-control" wire:model="nama_jurusan"
                                required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" wire:click="tambahjurusan()">Submit</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Tambah Jurusan --}}

    {{-- Modal Edit Jurusan --}}
    <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-radius: 10px">
                <div class="modal-header">
                    <h5 class="modal-title fw-light" id="largeModalLabel"><strong>Edit Data</strong>
                        <small>Jurusan</small>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="nama_jurusan" class="form-control-label">Nama Jurusan</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="nama_jurusan" name="nama_jurusan"
                                placeholder="Masukan Nama Jurusan" class="form-control" wire:model="nama_jurusan"
                                required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" wire:click="updatejurusan()">Submit</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Edit Jurusan --}}
</div>
