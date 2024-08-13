{{-- <div>
    <!-- Modal Formulir-->
    <div class="modal fade" id="FormulirModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-radius: 10px">
                <div class="modal-header">
                    <h5 class="modal-title fw-light" id="largeModalLabel"><strong>Formulir Keterangan</strong>
                        <small>Izin/Sakit</small>
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
                                placeholder="Masukan Nama Jurusan" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="nama_jurusan" class="form-control-label">Kirim File</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="file" class="filepond" name="filepond" id="filepond" multiple
                                data-allow-reorder="true" data-max-file-size="3MB" data-max-files="1">
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
    <!-- End Modal Formulir-->
</div>

@push('myscript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize FilePond
            FilePond.registerPlugin(FilePondPluginFileValidateType);

            // Select file input element
            const inputElement = document.querySelector('input[id="filepond"]');

            // Create FilePond instance
            const pond = FilePond.create(inputElement, {
                allowMultiple: true,
                acceptedFileTypes: ['image/*', 'application/pdf'],
                maxFileSize: '3MB',
                maxFiles: 3
            });
        });
    </script>
@endpush --}}
