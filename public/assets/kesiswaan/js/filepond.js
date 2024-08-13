document.addEventListener('DOMContentLoaded', function () {
    // Inisialisasi FilePond untuk upload file
    const inputElement = document.querySelector('input[id="file"]');
    const pond = FilePond.create(inputElement);

    pond.setOptions({
        server: {
            process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                Livewire.emit('uploadFile', file, load, error, progress);
            },
            revert: (filename, load) => {
                Livewire.emit('removeFile', filename, load);
            }
        }
    });
});

