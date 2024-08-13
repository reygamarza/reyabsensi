<div>
    <h3 class="title-5 m-b-25">Waktu Absen</h3>
    <div class="form-group">
        <label for="jam_absen">Jam Masuk</label>
        <input type="time" id="jam_absen" name="jam_absen" class="form-control" wire:model="jam_absen" step="60">
    </div>
    <div class="form-group">
        <label for="batas_absen_masuk">Batas Jam Masuk</label>
        <input type="time" id="batas_absen_masuk" name="batas_absen_masuk" class="form-control" wire:model="batas_absen_masuk" step="60">
    </div>
    <div class="form-group">
        <label for="jam_pulang">Jam Pulang</label>
        <input type="time" id="jam_pulang" name="jam_pulang" class="form-control" wire:model="jam_pulang" step="60">
    </div>
    <div class="form-group">
        <label for="batas_absen_pulang">Batas Jam Pulang</label>
        <input type="time" id="batas_absen_pulang" name="batas_absen_pulang" class="form-control" wire:model="batas_absen_pulang" step="60">
    </div>
    <button type="button" class="btn btn-primary" wire:click="updatejam">Update Waktu Absen</button>
</div>
