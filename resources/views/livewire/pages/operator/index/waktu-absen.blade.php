<div class="card shadow-sm border-0 p-4">
    <h3 class="text-center mb-4">Waktu Absen</h3>
    <form wire:click.prevent="save">
        <div class="mb-3">
            <label for="absenMasuk" class="form-label">Mulai Absen Masuk</label>
            <input type="time" id="absenMasuk" name="absenMasuk" class="form-control" wire:model="absenMasuk"
                step="60">
        </div>
        <div class="mb-3">
            <label for="batasAbsenMasuk" class="form-label">Batas Absen Masuk</label>
            <input type="time" id="batasAbsenMasuk" name="batasAbsenMasuk" class="form-control"
                wire:model="batasAbsenMasuk" step="60">
        </div>
        <div class="mb-3">
            <label for="absenPulang" class="form-label">Batas Absen Pulang</label>
            <input type="time" id="absenPulang" name="absenPulang" class="form-control" wire:model="absenPulang"
                step="60">
        </div>
        <div class="mb-3">
            <label for="batasAbsenPulang" class="form-label">Batas Absen Pulang</label>
            <input type="time" id="batasAbsenPulang" name="batasAbsenPulang" class="form-control"
                wire:model="batasAbsenPulang" step="60">
        </div>
        <button type="submit" class="btn btn-primary w-100">Update Waktu Absen</button>
    </form>
</div>
