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
                        <input class="au-input--w300 au-input--style2" type="text" placeholder="Cari Kesiswaan"
                            wire:model.live.debounce="searchkesiswaan">
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
                            <th>ID User</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftarkesiswaan as $key => $k)
                            <tr>
                                <td>{{ $k->id }}</td>
                                <td>{{ $k->nama }}</td>
                                <td>{{ $k->email }}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a data-toggle="modal" data-target="#EditModal">
                                            <button class="item mr-1" data-toggle="tooltip" title="Edit"
                                                wire:click="editkesiswaan({{ $k->id }})">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <button class="item mr-1" data-toggle="tooltip" data-placement="top"
                                            title="Delete" wire:click="hapuskesiswaan({{ $k->id }})">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-container">
                    {{ $daftarkesiswaan->links() }}
                </div>
            </div>
        </div>
    </section>
    <!-- END DATA TABLE-->

    {{-- Modal Tambah Kesiswaan --}}
    <div class="modal fade" id="TambahModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-radius: 10px">
                <div class="modal-header">
                    <h5 class="modal-title fw-light" id="largeModalLabel"><strong>Tambah Data</strong>
                        <small>Kesiswaan</small>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row form-group" style="margin-bottom: 25px;">
                        <div class="col col-md-3">
                            <label for="nama" class="form-control-label">Nama Lengkap</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="nama" name="nama" placeholder="Masukan Nama Lengkap"
                                class="form-control" wire:model="nama" required>
                        </div>
                    </div>
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
                            <input type="text" id="password" name="password" placeholder="Masukan Password"
                                class="form-control" required wire:model="password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" wire:click="tambahkesiswaan()">Submit</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Tambah Kesiswaan --}}

    {{-- Modal Edit Kesiswaan --}}
    <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-radius: 10px">
                <div class="modal-header">
                    <h5 class="modal-title fw-light" id="largeModalLabel"><strong>Edit Data</strong>
                        <small>Kesiswaan</small>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row form-group" style="margin-bottom: 25px;">
                        <div class="col col-md-3">
                            <label for="nama" class="form-control-label">Nama Lengkap</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="nama" name="nama" placeholder="Masukan Nama Lengkap"
                                class="form-control" wire:model="nama" required>
                        </div>
                    </div>
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
                            <input type="text" id="password" name="password" placeholder="Masukan Password"
                                class="form-control" required wire:model="password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" wire:click="updatekesiswaan()">Submit</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Edit Kesiswaan --}}
</div>